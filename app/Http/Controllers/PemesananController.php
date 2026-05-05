<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Produk;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Admin tidak akses pemesanan
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        $query = Pemesanan::with(['cabang', 'user'])->latest();

        if ($user->role === 'kasir' && $user->cabang_id) {
            $query->where('cabang_id', $user->cabang_id);
        }

        $pemesanans = $query->paginate(20);
        return view('pemesanan.index', compact('pemesanans'));
    }

    public function create()
    {
        // Admin tidak perlu akses halaman pemesanan
        if (auth()->user()->role === 'admin') {
            return redirect()->route('dashboard')->with('info', 'Halaman pemesanan hanya untuk kasir.');
        }

        $user = Auth::user();
        $cabang_id = $user->cabang_id ?? session('cabang_id');

        if ($cabang_id) {
            $produks = Produk::with(['kategori', 'stokCabangs' => fn($q) => $q->where('cabang_id', $cabang_id)])
                ->whereHas('stokCabangs', fn($q) => $q->where('cabang_id', $cabang_id)->where('stok', '>', 0))
                ->get();

            // Fallback: kalau tidak ada stok cabang, tampilkan semua produk
            if ($produks->isEmpty()) {
                $produks = Produk::with('kategori')->get();
            }
        } else {
            $produks = Produk::with('kategori')->where('stok', '>', 0)->get();
        }

        $cabangs = Cabang::where('is_active', true)->get();
        return view('pemesanan.create', compact('produks', 'cabangs', 'cabang_id'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard');
        }

        $request->validate([
            'kasir'          => 'required|string|max:100',
            'nama_pelanggan' => 'nullable|string|max:100',
            'items'          => 'required|array|min:1',
            'items.*.produk_id' => 'required|exists:produks,id',
            'items.*.jumlah'    => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $cabang_id = $user->cabang_id ?? session('cabang_id');

            $total = 0;
            foreach ($request->items as $item) {
                $produk = Produk::find($item['produk_id']);
                $total += $produk->harga * $item['jumlah'];
            }

            $kode = 'PES-' . date('Ymd') . '-' . str_pad(Pemesanan::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

            $pemesanan = Pemesanan::create([
                'kode_pesan'     => $kode,
                'cabang_id'      => $cabang_id,
                'user_id'        => $user->id,
                'nama_pelanggan' => $request->nama_pelanggan,
                'total'          => $total,
                'status'         => 'pending',
                'kasir'          => $request->kasir,
            ]);

            foreach ($request->items as $item) {
                $produk = Produk::find($item['produk_id']);
                PemesananDetail::create([
                    'pemesanan_id' => $pemesanan->id,
                    'produk_id'    => $produk->id,
                    'jumlah'       => $item['jumlah'],
                    'harga'        => $produk->harga,
                    'subtotal'     => $produk->harga * $item['jumlah'],
                ]);
            }

            DB::commit();
            // Log aktivitas kasir
            if (auth()->user()->role === 'kasir') {
                \App\Models\AktivitasKasir::create([
                    'user_id'    => auth()->id(),
                    'aksi'       => 'pemesanan',
                    'keterangan' => 'Buat pesanan ' . $kode . ($request->nama_pelanggan ? ' untuk ' . $request->nama_pelanggan : ''),
                    'nominal'    => $total,
                ]);
            }
            return redirect()->route('pemesanan.nota', $pemesanan->id)->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function bayar(Request $request, Pemesanan $pemesanan)
    {
        $request->validate(['bayar' => 'required|numeric|min:0']);

        if ($request->bayar < $pemesanan->total) {
            return back()->with('error', 'Uang bayar kurang!');
        }

        // Buat transaksi dari pesanan
        DB::beginTransaction();
        try {
            $transaksi = \App\Models\Transaksi::create([
                'cabang_id'       => $pemesanan->cabang_id,
                'kode_transaksi'  => 'TRX-' . date('Ymd') . '-' . str_pad(\App\Models\Transaksi::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT),
                'tanggal'         => now(),
                'total'           => $pemesanan->total,
                'bayar'           => $request->bayar,
                'kembalian'       => $request->bayar - $pemesanan->total,
                'kasir'           => $pemesanan->kasir,
            ]);

            foreach ($pemesanan->details as $detail) {
                \App\Models\TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id'    => $detail->produk_id,
                    'jumlah'       => $detail->jumlah,
                    'harga'        => $detail->harga,
                    'subtotal'     => $detail->subtotal,
                ]);

                // Kurangi stok
                if ($pemesanan->cabang_id) {
                    \App\Models\StokCabang::where('cabang_id', $pemesanan->cabang_id)
                        ->where('produk_id', $detail->produk_id)
                        ->decrement('stok', $detail->jumlah);
                } else {
                    Produk::find($detail->produk_id)->decrement('stok', $detail->jumlah);
                }
            }

            $pemesanan->update(['status' => 'dibayar']);
            DB::commit();

            return redirect()->route('transaksi.struk', $transaksi->id)->with('success', 'Pembayaran berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function batal(Pemesanan $pemesanan)
    {
        $pemesanan->update(['status' => 'batal']);
        return back()->with('success', 'Pesanan dibatalkan.');
    }

    public function nota(Pemesanan $pemesanan)
    {
        $pemesanan->load('details.produk', 'cabang');
        $toko = \App\Models\Toko::first();
        return view('pemesanan.nota', compact('pemesanan', 'toko'));
    }
}

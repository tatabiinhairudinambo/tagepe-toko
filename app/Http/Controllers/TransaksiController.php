<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Produk;
use App\Models\Cabang;
use App\Models\StokCabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // Halaman kasir (input transaksi)
    public function index()
    {
        // Ambil semua cabang yang aktif
        $cabangs = Cabang::where('is_active', true)->get();
        
        // Ambil produk dengan stok cabang jika ada cabang_id di session
        $cabang_id = session('cabang_id');
        
        if ($cabang_id) {
            // Ambil produk yang ada stoknya di cabang ini
            $produks = Produk::with(['kategori', 'stokCabangs' => function($q) use ($cabang_id) {
                $q->where('cabang_id', $cabang_id);
            }])
            ->whereHas('stokCabangs', function($q) use ($cabang_id) {
                $q->where('cabang_id', $cabang_id)->where('stok', '>', 0);
            })
            ->get();
        } else {
            // Jika belum pilih cabang, tampilkan semua produk (untuk backward compatibility)
            $produks = Produk::with('kategori')->where('stok', '>', 0)->get();
        }
        
        return view('transaksi.index', compact('produks', 'cabangs', 'cabang_id'));
    }
    
    // Set cabang untuk transaksi
    public function setCabang(Request $request)
    {
        $request->validate([
            'cabang_id' => 'required|exists:cabangs,id'
        ]);
        
        session(['cabang_id' => $request->cabang_id]);
        return back()->with('success', 'Cabang berhasil dipilih');
    }

    // Simpan transaksi
    public function store(Request $request)
    {
        $request->validate([
            'cabang_id' => 'nullable|exists:cabangs,id',
            'items' => 'required|array|min:1',
            'items.*.produk_id' => 'required|exists:produks,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'bayar' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $cabang_id = $request->cabang_id ?? session('cabang_id');
            
            // Hitung total & validasi stok
            $total = 0;
            foreach ($request->items as $item) {
                $produk = Produk::find($item['produk_id']);
                $total += $produk->harga * $item['jumlah'];
                
                // Cek stok cabang jika ada cabang_id
                if ($cabang_id) {
                    $stokCabang = StokCabang::where('cabang_id', $cabang_id)
                        ->where('produk_id', $produk->id)
                        ->first();
                    
                    if (!$stokCabang || $stokCabang->stok < $item['jumlah']) {
                        return back()->with('error', 'Stok ' . $produk->nama_produk . ' tidak cukup di cabang ini!');
                    }
                } else {
                    // Fallback ke stok global
                    if ($produk->stok < $item['jumlah']) {
                        return back()->with('error', 'Stok ' . $produk->nama_produk . ' tidak cukup!');
                    }
                }
            }

            // Validasi bayar
            if ($request->bayar < $total) {
                return back()->with('error', 'Uang bayar kurang!');
            }

            // Generate kode transaksi
            $kode = 'TRX-' . date('Ymd') . '-' . str_pad(Transaksi::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

            // Simpan transaksi
            $transaksi = Transaksi::create([
                'cabang_id' => $cabang_id,
                'kode_transaksi' => $kode,
                'tanggal' => now(),
                'total' => $total,
                'bayar' => $request->bayar,
                'kembalian' => $request->bayar - $total,
                'kasir' => auth()->user()->name ?? 'Admin',
            ]);

            // Simpan detail & kurangi stok
            foreach ($request->items as $item) {
                $produk = Produk::find($item['produk_id']);
                
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $produk->id,
                    'jumlah' => $item['jumlah'],
                    'harga' => $produk->harga,
                    'subtotal' => $produk->harga * $item['jumlah'],
                ]);

                // Kurangi stok cabang atau stok global
                if ($cabang_id) {
                    $stokCabang = StokCabang::where('cabang_id', $cabang_id)
                        ->where('produk_id', $produk->id)
                        ->first();
                    $stokCabang->decrement('stok', $item['jumlah']);
                } else {
                    $produk->decrement('stok', $item['jumlah']);
                }
            }

            DB::commit();
            return redirect()->route('transaksi.struk', $transaksi->id)->with('success', 'Transaksi berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Transaksi gagal: ' . $e->getMessage());
        }
    }

    // Tampilkan struk
    public function struk($id)
    {
        $transaksi = Transaksi::with('details.produk')->findOrFail($id);
        $toko = \App\Models\Toko::first();
        return view('transaksi.struk', compact('transaksi', 'toko'));
    }

    // Laporan transaksi
    public function laporan(Request $request)
    {
        $query = Transaksi::with('details');

        if ($request->tanggal_dari) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->tanggal_sampai) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        $transaksis = $query->latest()->paginate(20);
        $total_pendapatan = $query->sum('total');

        return view('transaksi.laporan', compact('transaksis', 'total_pendapatan'));
    }

    // Detail transaksi
    public function show($id)
    {
        $transaksi = Transaksi::with('details.produk')->findOrFail($id);
        $toko = \App\Models\Toko::first();
        return view('transaksi.detail', compact('transaksi', 'toko'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // Halaman kasir (input transaksi)
    public function index()
    {
        $produks = Produk::with('kategori')->where('stok', '>', 0)->get();
        return view('transaksi.index', compact('produks'));
    }

    // Simpan transaksi
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.produk_id' => 'required|exists:produks,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'bayar' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Hitung total
            $total = 0;
            foreach ($request->items as $item) {
                $produk = Produk::find($item['produk_id']);
                $total += $produk->harga * $item['jumlah'];
            }

            // Validasi bayar
            if ($request->bayar < $total) {
                return back()->with('error', 'Uang bayar kurang!');
            }

            // Generate kode transaksi
            $kode = 'TRX-' . date('Ymd') . '-' . str_pad(Transaksi::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

            // Simpan transaksi
            $transaksi = Transaksi::create([
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

                // Kurangi stok
                $produk->decrement('stok', $item['jumlah']);
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

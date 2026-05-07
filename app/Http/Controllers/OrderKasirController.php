<?php

namespace App\Http\Controllers;

use App\Models\OrderPublik;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\StokCabang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderKasirController extends Controller
{
    // Daftar order publik untuk kasir
    public function index()
    {
        $user = Auth::user();
        $query = OrderPublik::with(['details.produk', 'cabang'])->latest();

        if ($user->role === 'kasir' && $user->cabang_id) {
            $query->where(function($q) use ($user) {
                $q->where('cabang_id', $user->cabang_id)->orWhereNull('cabang_id');
            });
        }

        $orders = $query->paginate(20);
        $menunggu = (clone $query)->where('status', 'menunggu')->count();

        return view('order.kasir', compact('orders', 'menunggu'));
    }

    // Proses order — ubah status jadi diproses
    public function proses(OrderPublik $order)
    {
        $order->update(['status' => 'diproses']);
        return back()->with('success', 'Order ' . $order->kode_order . ' sedang diproses.');
    }

    // Selesaikan order — buat transaksi dan kurangi stok
    public function selesai(Request $request, OrderPublik $order)
    {
        $request->validate(['bayar' => 'required|numeric|min:0']);

        if ($request->bayar < $order->total) {
            return back()->with('error', 'Uang bayar kurang!');
        }

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $cabang_id = $order->cabang_id ?? $user->cabang_id;

            $kode = 'TRX-' . date('Ymd') . '-' . str_pad(Transaksi::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

            $transaksi = Transaksi::create([
                'cabang_id'      => $cabang_id,
                'kode_transaksi' => $kode,
                'tanggal'        => now(),
                'total'          => $order->total,
                'bayar'          => $request->bayar,
                'kembalian'      => $request->bayar - $order->total,
                'kasir'          => $user->name,
            ]);

            foreach ($order->details as $detail) {
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id'    => $detail->produk_id,
                    'jumlah'       => $detail->jumlah,
                    'harga'        => $detail->harga,
                    'subtotal'     => $detail->subtotal,
                ]);

                if ($cabang_id) {
                    StokCabang::where('cabang_id', $cabang_id)
                        ->where('produk_id', $detail->produk_id)
                        ->decrement('stok', $detail->jumlah);
                } else {
                    Produk::find($detail->produk_id)->decrement('stok', $detail->jumlah);
                }
            }

            $order->update(['status' => 'selesai']);
            DB::commit();

            return redirect()->route('transaksi.struk', $transaksi->id)->with('success', 'Order selesai!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    // Batalkan order
    public function batal(OrderPublik $order)
    {
        $order->update(['status' => 'batal']);
        return back()->with('success', 'Order dibatalkan.');
    }
}

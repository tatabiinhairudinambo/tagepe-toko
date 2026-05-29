<?php

namespace App\Http\Controllers;

use App\Models\OrderPublik;
use App\Models\OrderPublikDetail;
use App\Models\Produk;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderPublikController extends Controller
{
    // Halaman order publik
    public function index(Request $request)
    {
        $cabangs = Cabang::where('is_active', true)->get();
        $cabang_id = $request->cabang_id;
        $search = $request->search;

        $produks = Produk::with('kategori')
            ->where('status', 'aktif')
            ->where('stok', '>', 0)
            ->when($search, fn($q) => $q->where('nama', 'like', "%$search%")
                ->orWhereHas('kategori', fn($k) => $k->where('nama', 'like', "%$search%")))
            ->get();

        return view('frontend.order.index', compact('produks', 'cabangs', 'cabang_id', 'search'));
    }

    // Pencarian produk via server
    public function cari(Request $request)
    {
        return $this->index($request);
    }

    // Simpan order dari customer
    public function store(Request $request)
    {
        $request->validate([
            'nama_customer' => 'required|string|max:100',
            'telepon'       => 'nullable|string|max:20',
            'catatan'       => 'nullable|string|max:255',
            'cabang_id'     => 'nullable|exists:cabangs,id',
            'items'         => 'required|array|min:1',
            'items.*.produk_id' => 'required|exists:produks,id',
            'items.*.jumlah'    => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($request->items as $item) {
                $produk = Produk::find($item['produk_id']);
                $total += $produk->harga * $item['jumlah'];
            }

            $kode = 'ORD-' . date('Ymd') . '-' . str_pad(OrderPublik::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

            $order = OrderPublik::create([
                'kode_order'    => $kode,
                'nama_customer' => $request->nama_customer,
                'telepon'       => $request->telepon,
                'catatan'       => $request->catatan,
                'total'         => $total,
                'status'        => 'menunggu',
                'cabang_id'     => $request->cabang_id,
            ]);

            foreach ($request->items as $item) {
                $produk = Produk::find($item['produk_id']);
                OrderPublikDetail::create([
                    'order_publik_id' => $order->id,
                    'produk_id'       => $produk->id,
                    'jumlah'          => $item['jumlah'],
                    'harga'           => $produk->harga,
                    'subtotal'        => $produk->harga * $item['jumlah'],
                ]);
            }

            DB::commit();
            return redirect()->route('order.sukses', $order->kode_order);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat order: ' . $e->getMessage());
        }
    }

    // Halaman sukses order
    public function sukses($kode)
    {
        $order = OrderPublik::with('details.produk', 'cabang')->where('kode_order', $kode)->firstOrFail();
        return view('frontend.order.sukses', compact('order'));
    }

    // Cek status order
    public function cekStatus(Request $request)
    {
        $order = null;
        if ($request->kode) {
            $order = OrderPublik::with('details.produk', 'cabang')->where('kode_order', $request->kode)->first();
        }
        return view('frontend.order.cek-status', compact('order'));
    }
}

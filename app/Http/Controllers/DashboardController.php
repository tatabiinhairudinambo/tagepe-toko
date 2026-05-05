<?php

namespace App\Http\Controllers;

// ============================================================
// MATERI: Controller di Laravel
// Controller adalah kelas PHP yang bertugas menerima request
// dari user, mengambil data dari Model, lalu mengirim data
// ke View untuk ditampilkan ke browser.
// ============================================================

// "use" dipakai untuk mengimpor kelas Model agar bisa dipakai di sini
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\AktivitasKasir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cabang_id = ($user->role === 'kasir') ? $user->cabang_id : null;

        // Query transaksi — kasir hanya lihat cabang mereka
        $transaksiQuery = Transaksi::query();
        if ($cabang_id) {
            $transaksiQuery->where('cabang_id', $cabang_id);
        }

        // Grafik pendapatan per bulan
        $grafikQuery = Transaksi::select(
                DB::raw("DATE_FORMAT(tanggal, '%Y-%m') as bulan"),
                DB::raw('SUM(total) as total_pendapatan'),
                DB::raw('COUNT(*) as jumlah_transaksi')
            )
            ->whereDate('tanggal', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('bulan')
            ->orderBy('bulan');

        if ($cabang_id) {
            $grafikQuery->where('cabang_id', $cabang_id);
        }

        return view('dashboard', [
            'totalKategori'    => Kategori::count(),
            'totalProduk'      => Produk::count(),
            'totalNilai'       => Produk::selectRaw('SUM(harga * stok) as total')->value('total') ?? 0,
            'produkTerbaru'    => Produk::with('kategori')->latest()->take(5)->get(),
            'totalPendapatan'  => (clone $transaksiQuery)->sum('total'),
            'totalTransaksi'   => (clone $transaksiQuery)->count(),
            'cabang'           => $cabang_id ? \App\Models\Cabang::find($cabang_id) : null,
            'grafikBulan'      => $grafikQuery->get(),
            // Riwayat aktivitas kasir hari ini (admin only)
            'aktivitasHariIni' => $user->role === 'admin'
                ? AktivitasKasir::with('user')->whereDate('created_at', today())->latest()->get()
                : collect(),
            // Produk pending approval (admin only)
            'produkPending'    => $user->role === 'admin'
                ? Produk::with(['kategori', 'dibuatOleh'])->where('status', 'pending')->get()
                : collect(),
        ]);
    }
}

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

        // Shift Info - Cari login terakhir user ini hari ini
        $loginLogToday = null;
        $shiftDuration = null;
        if ($user->role === 'kasir') {
            $loginLogToday = \App\Models\LoginLog::where('user_id', $user->id)
                ->where('aksi', 'login')
                ->whereDate('created_at', today())
                ->latest()
                ->first();
            
            if ($loginLogToday) {
                $shiftDuration = now()->diffInMinutes($loginLogToday->created_at);
            }
        }

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

        // Data khusus untuk KASIR
        $kasirData = [];
        if ($user->role === 'kasir' && $cabang_id) {
            // Shift Summary - Transaksi hari ini
            $transaksiHariIni = Transaksi::where('cabang_id', $cabang_id)
                ->whereDate('tanggal', today())
                ->get();
            
            // Top Products Today - Produk terlaris hari ini
            $topProductsToday = DB::table('transaksi_details')
                ->join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
                ->join('produks', 'transaksi_details.produk_id', '=', 'produks.id')
                ->where('transaksis.cabang_id', $cabang_id)
                ->whereDate('transaksis.tanggal', today())
                ->select('produks.nama', DB::raw('SUM(transaksi_details.jumlah) as total_terjual'))
                ->groupBy('produks.id', 'produks.nama')
                ->orderByDesc('total_terjual')
                ->limit(5)
                ->get();
            
            // Recent Transactions - 5 transaksi terakhir
            $recentTransactions = Transaksi::where('cabang_id', $cabang_id)
                ->latest('tanggal')
                ->latest('id')
                ->take(5)
                ->get();
            
            // Low Stock Alert - Produk stok menipis di cabang kasir
            $lowStockProducts = \App\Models\StokCabang::with('produk')
                ->where('cabang_id', $cabang_id)
                ->whereHas('produk', fn($q) => $q->where('status', 'aktif'))
                ->whereColumn('stok', '<=', DB::raw('(SELECT stok_minimum FROM produks WHERE produks.id = stok_cabangs.produk_id)'))
                ->orderBy('stok', 'asc')
                ->limit(10)
                ->get();
            
            // Customer Orders Queue - Order online pending untuk cabang ini
            $pendingOrders = \App\Models\OrderPublik::where('cabang_id', $cabang_id)
                ->where('status', 'pending')
                ->count();
            
            $processingOrders = \App\Models\OrderPublik::where('cabang_id', $cabang_id)
                ->where('status', 'diproses')
                ->count();
            
            $completedOrdersToday = \App\Models\OrderPublik::where('cabang_id', $cabang_id)
                ->where('status', 'selesai')
                ->whereDate('created_at', today())
                ->count();

            $kasirData = [
                'transaksiHariIni' => $transaksiHariIni,
                'jumlahTransaksiHariIni' => $transaksiHariIni->count(),
                'totalPendapatanHariIni' => $transaksiHariIni->sum('total'),
                'totalItemTerjualHariIni' => DB::table('transaksi_details')
                    ->join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
                    ->where('transaksis.cabang_id', $cabang_id)
                    ->whereDate('transaksis.tanggal', today())
                    ->sum('transaksi_details.jumlah'),
                'rataRataPerTransaksi' => $transaksiHariIni->count() > 0 
                    ? $transaksiHariIni->sum('total') / $transaksiHariIni->count() 
                    : 0,
                'topProductsToday' => $topProductsToday,
                'recentTransactions' => $recentTransactions,
                'lowStockProducts' => $lowStockProducts,
                'pendingOrders' => $pendingOrders,
                'processingOrders' => $processingOrders,
                'completedOrdersToday' => $completedOrdersToday,
            ];
        }

        return view('backend.dashboard.index', array_merge([
            'totalKategori'    => Kategori::count(),
            'totalProduk'      => Produk::count(),
            'totalNilai'       => Produk::selectRaw('SUM(harga * stok) as total')->value('total') ?? 0,
            'produkTerbaru'    => Produk::with('kategori')->latest()->take(5)->get(),
            'totalPendapatan'  => (clone $transaksiQuery)->sum('total'),
            'totalTransaksi'   => (clone $transaksiQuery)->count(),
            'cabang'           => $cabang_id ? \App\Models\Cabang::find($cabang_id) : null,
            'grafikBulan'      => $grafikQuery->get(),
            // Shift Info untuk kasir
            'loginLogToday'    => $loginLogToday,
            'shiftDuration'    => $shiftDuration,
            // Riwayat aktivitas kasir hari ini (admin only)
            'aktivitasHariIni' => $user->role === 'admin'
                ? AktivitasKasir::with('user')->whereDate('created_at', today())->latest()->get()
                : collect(),
            // Produk pending approval (admin only)
            'produkPending'    => $user->role === 'admin'
                ? Produk::with(['kategori', 'dibuatOleh'])->where('status', 'pending')->get()
                : collect(),
            // Riwayat login hari ini (admin only)
            'loginLogs'        => $user->role === 'admin'
                ? \App\Models\LoginLog::with('user')->whereDate('created_at', today())->latest()->get()
                : collect(),
        ], $kasirData));
    }
}

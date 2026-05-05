<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TokoController;
use Illuminate\Support\Facades\Route;

// Halaman publik - katalog produk (tanpa login)
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');

// Test upload
Route::get('/test-upload', function() { return view('test-upload'); });
Route::post('/test-upload', function(\Illuminate\Http\Request $request) {
    $result = "hasFile: " . ($request->hasFile('foto') ? 'YES' : 'NO') . "\n";
    $result .= "files: " . json_encode($request->allFiles()) . "\n";
    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('test', 'public');
        $result .= "Saved to: " . $path;
    }
    return back()->with('result', $result);
})->name('test.upload.post');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman yang butuh login
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Kasir (semua user bisa akses)
    Route::get('/transaksi', [\App\Http\Controllers\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [\App\Http\Controllers\TransaksiController::class, 'store'])->name('transaksi.store');
    Route::post('/transaksi/set-cabang', [\App\Http\Controllers\TransaksiController::class, 'setCabang'])->name('transaksi.setCabang');

    // Admin only
    Route::middleware('role:admin')->group(function () {
        Route::get('/transaksi/laporan', [\App\Http\Controllers\TransaksiController::class, 'laporan'])->name('transaksi.laporan');
        Route::get('/transaksi/export/pdf', [\App\Http\Controllers\TransaksiController::class, 'exportPdf'])->name('transaksi.export.pdf');
        Route::get('/transaksi/export/csv', [\App\Http\Controllers\TransaksiController::class, 'exportCsv'])->name('transaksi.export.csv');
        Route::resource('kategori', KategoriController::class)->except(['show']);
        Route::resource('produk', ProdukController::class)->except(['show', 'index', 'create', 'store']);
        Route::patch('/produk/{produk}/approve', [ProdukController::class, 'approve'])->name('produk.approve');
        Route::resource('toko', TokoController::class)->only(['index', 'edit', 'update']);
        Route::resource('cabang', \App\Http\Controllers\CabangController::class)->except(['show']);
        Route::get('/cabang/{id}/stok', [\App\Http\Controllers\CabangController::class, 'stok'])->name('cabang.stok');
        Route::put('/cabang/{id}/stok', [\App\Http\Controllers\CabangController::class, 'updateStok'])->name('cabang.updateStok');
        Route::resource('user', \App\Http\Controllers\UserController::class)->except(['show']);
    });

    // Route dengan parameter harus di bawah route statis
    Route::get('/transaksi/{id}', [\App\Http\Controllers\TransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('/transaksi/{id}/struk', [\App\Http\Controllers\TransaksiController::class, 'struk'])->name('transaksi.struk');

    // Produk - kasir hanya bisa lihat + ajukan produk baru
    Route::get('/produk', [\App\Http\Controllers\ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [\App\Http\Controllers\ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [\App\Http\Controllers\ProdukController::class, 'store'])->name('produk.store');

    // Pemesanan
    Route::get('/pemesanan', [\App\Http\Controllers\PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/pemesanan/create', [\App\Http\Controllers\PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pemesanan', [\App\Http\Controllers\PemesananController::class, 'store'])->name('pemesanan.store');
    Route::patch('/pemesanan/{pemesanan}/bayar', [\App\Http\Controllers\PemesananController::class, 'bayar'])->name('pemesanan.bayar');
    Route::patch('/pemesanan/{pemesanan}/batal', [\App\Http\Controllers\PemesananController::class, 'batal'])->name('pemesanan.batal');
    Route::get('/pemesanan/{pemesanan}/nota', [\App\Http\Controllers\PemesananController::class, 'nota'])->name('pemesanan.nota');
});

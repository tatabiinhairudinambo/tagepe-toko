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
    Route::resource('kategori', KategoriController::class)->except(['show']);
    Route::resource('produk', ProdukController::class)->except(['show']);
    Route::resource('toko', TokoController::class)->only(['index', 'edit', 'update']);
    
    // Transaksi
    Route::get('/transaksi', [\App\Http\Controllers\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [\App\Http\Controllers\TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/laporan', [\App\Http\Controllers\TransaksiController::class, 'laporan'])->name('transaksi.laporan');
    Route::get('/transaksi/{id}', [\App\Http\Controllers\TransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('/transaksi/{id}/struk', [\App\Http\Controllers\TransaksiController::class, 'struk'])->name('transaksi.struk');
});

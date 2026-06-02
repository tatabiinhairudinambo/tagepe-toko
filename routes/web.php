<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TokoController;
use Illuminate\Support\Facades\Route;

// ============================================
// FRONTEND ROUTES (Public)
// ============================================
// Homepage = Login page dengan Landing Content (Sistem Utama)
Route::get('/', [AuthController::class, 'showLogin'])->name('home');

// Toko Online Routes (Untuk Customer)
Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Frontend\ShopController::class, 'index'])->name('home');
});

// Legacy routes - removed (tidak digunakan)

// Order publik
Route::get('/order', [\App\Http\Controllers\OrderPublikController::class, 'index'])->name('order.index');
Route::get('/order/cari', [\App\Http\Controllers\OrderPublikController::class, 'cari'])->name('order.cari');
Route::post('/order', [\App\Http\Controllers\OrderPublikController::class, 'store'])->name('order.store');
Route::get('/order/sukses/{kode}', [\App\Http\Controllers\OrderPublikController::class, 'sukses'])->name('order.sukses');
Route::get('/order/cek', [\App\Http\Controllers\OrderPublikController::class, 'cekStatus'])->name('order.cek');

// ============================================
// AUTHENTICATION ROUTES
// ============================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// ============================================
// BACKEND ROUTES (Protected)
// ============================================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');

    // Kasir & semua user
    Route::get('/transaksi', [\App\Http\Controllers\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [\App\Http\Controllers\TransaksiController::class, 'store'])->name('transaksi.store');
    Route::post('/transaksi/set-cabang', [\App\Http\Controllers\TransaksiController::class, 'setCabang'])->name('transaksi.setCabang');

    // Produk - kasir bisa lihat + ajukan
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');

    // Pemesanan
    Route::get('/pemesanan', [\App\Http\Controllers\PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/pemesanan/create', [\App\Http\Controllers\PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pemesanan', [\App\Http\Controllers\PemesananController::class, 'store'])->name('pemesanan.store');
    Route::patch('/pemesanan/{pemesanan}/bayar', [\App\Http\Controllers\PemesananController::class, 'bayar'])->name('pemesanan.bayar');
    Route::patch('/pemesanan/{pemesanan}/batal', [\App\Http\Controllers\PemesananController::class, 'batal'])->name('pemesanan.batal');
    Route::get('/pemesanan/{pemesanan}/nota', [\App\Http\Controllers\PemesananController::class, 'nota'])->name('pemesanan.nota');

    // Order dari customer (kasir kelola)
    Route::get('/order-kasir', [\App\Http\Controllers\OrderKasirController::class, 'index'])->name('order.kasir.index');
    Route::patch('/order-kasir/{order}/proses', [\App\Http\Controllers\OrderKasirController::class, 'proses'])->name('order.kasir.proses');
    Route::patch('/order-kasir/{order}/selesai', [\App\Http\Controllers\OrderKasirController::class, 'selesai'])->name('order.kasir.selesai');
    Route::patch('/order-kasir/{order}/batal', [\App\Http\Controllers\OrderKasirController::class, 'batal'])->name('order.kasir.batal');

    // Admin only
    Route::middleware('role:admin')->group(function () {
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

    // Laporan transaksi - bisa diakses semua user yang login
    Route::get('/transaksi/laporan', [\App\Http\Controllers\TransaksiController::class, 'laporan'])->name('transaksi.laporan');

    // Quick search produk untuk dashboard
    Route::get('/api/produk/search', [ProdukController::class, 'quickSearch'])->name('produk.quickSearch');

    // Route parameter di bawah route statis
    Route::get('/transaksi/{id}', [\App\Http\Controllers\TransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('/transaksi/{id}/struk', [\App\Http\Controllers\TransaksiController::class, 'struk'])->name('transaksi.struk');
});

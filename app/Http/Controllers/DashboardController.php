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

// DashboardController mewarisi (extends) Controller bawaan Laravel
class DashboardController extends Controller
{
    // Method index() dipanggil saat user membuka halaman /dashboard
    public function index()
    {
        return view('dashboard', [
            // Kategori::count() → menghitung total baris di tabel kategoris
            'totalKategori' => Kategori::count(),

            // Produk::count() → menghitung total baris di tabel produks
            'totalProduk'   => Produk::count(),

            // selectRaw() → menjalankan SQL mentah: SUM(harga * stok)
            // value('total') → mengambil satu nilai kolom saja
            // ?? 0 → jika hasilnya NULL, gunakan 0 sebagai default
            'totalNilai'    => Produk::selectRaw('SUM(harga * stok) as total')->value('total') ?? 0,

            // with('kategori') → Eager Loading, memuat relasi kategori sekaligus
            //   agar tidak terjadi N+1 query problem
            // latest() → urut berdasarkan created_at DESC (terbaru dulu)
            // take(5) → ambil maksimal 5 data saja
            // get() → eksekusi query dan kembalikan Collection
            'produkTerbaru' => Produk::with('kategori')->latest()->take(5)->get(),
        ]);
    }
}

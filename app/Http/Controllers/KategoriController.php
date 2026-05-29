<?php

namespace App\Http\Controllers;

// ============================================================
// MATERI: Resource Controller (CRUD)
// Controller ini menangani semua operasi CRUD untuk Kategori:
//   index   → tampilkan daftar
//   create  → tampilkan form tambah
//   store   → simpan data baru
//   edit    → tampilkan form edit
//   update  → simpan perubahan
//   destroy → hapus data
// ============================================================

use App\Models\Kategori;
use Illuminate\Http\Request; // Kelas untuk membaca data dari form/request

class KategoriController extends Controller
{
    // -------------------------------------------------------
    // READ - Menampilkan semua kategori
    // -------------------------------------------------------
    public function index()
    {
        // withCount('produks') → menambahkan kolom "produks_count"
        // yang berisi jumlah produk di tiap kategori (pakai SQL COUNT)
        $kategoris = Kategori::withCount('produks')->get();

        // compact('kategoris') → shortcut untuk ['kategoris' => $kategoris]
        // Mengirim variabel $kategoris ke view kategori/index.blade.php
        return view('backend.kategori.index', compact('kategoris'));
    }

    // -------------------------------------------------------
    // CREATE - Menampilkan form tambah kategori
    // -------------------------------------------------------
    public function create()
    {
        // Hanya menampilkan view form kosong (tidak perlu data dari DB)
        return view('backend.kategori.form');
    }

    // -------------------------------------------------------
    // STORE - Menyimpan kategori baru ke database
    // -------------------------------------------------------
    public function store(Request $request)
    {
        // validate() → memvalidasi input dari form sebelum disimpan
        // 'required' → wajib diisi
        // 'string'   → harus berupa teks
        // 'max:100'  → maksimal 100 karakter
        $request->validate(['nama' => 'required|string|max:100']);

        // Kategori::create() → INSERT INTO kategoris (...)
        // only('nama', 'deskripsi') → hanya ambil field ini dari request
        //   (keamanan: mencegah mass assignment dari field yang tidak diinginkan)
        Kategori::create($request->only('nama', 'deskripsi'));

        // redirect()->route() → arahkan user ke halaman lain setelah simpan
        // with('success', '...') → kirim pesan flash (tampil sekali lalu hilang)
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // -------------------------------------------------------
    // EDIT - Menampilkan form edit kategori
    // Route Model Binding: Laravel otomatis cari Kategori by ID dari URL
    // -------------------------------------------------------
    public function edit(Kategori $kategori)
    {
        // $kategori sudah otomatis diisi oleh Laravel (Route Model Binding)
        // compact() mengirim data kategori ke view untuk mengisi form
        return view('backend.kategori.form', compact('kategori'));
    }

    // -------------------------------------------------------
    // UPDATE - Menyimpan perubahan kategori ke database
    // -------------------------------------------------------
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate(['nama' => 'required|string|max:100']);

        // $kategori->update() → UPDATE kategoris SET ... WHERE id = ?
        $kategori->update($request->only('nama', 'deskripsi'));

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // -------------------------------------------------------
    // DESTROY - Menghapus kategori dari database
    // -------------------------------------------------------
    public function destroy(Kategori $kategori)
    {
        // $kategori->delete() → DELETE FROM kategoris WHERE id = ?
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

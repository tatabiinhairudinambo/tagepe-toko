<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // READ - Tampilkan semua produk
    // with('kategori') = Eager Loading: muat relasi sekaligus
    // agar tidak terjadi N+1 query problem
    public function index()
    {
        $produks = Produk::with('kategori')->get();
        return view('produk.index', compact('produks'));
    }

    // CREATE - Tampilkan form tambah produk
    // Perlu $kategoris untuk isi dropdown pilihan kategori
    public function create()
    {
        $kategoris = Kategori::all();
        return view('produk.form', compact('kategoris'));
    }

    // STORE - Simpan produk baru ke database
    // exists:kategoris,id = pastikan kategori_id ada di DB
    // numeric = boleh desimal, integer = harus bilangan bulat
    // min:0 = tidak boleh negatif
    // only() = hanya ambil field ini, cegah mass assignment berbahaya
    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
        ]);
        Produk::create($request->only('nama', 'kategori_id', 'harga', 'stok', 'deskripsi'));
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // EDIT - Tampilkan form edit produk
    // Route Model Binding: Laravel otomatis cari Produk by ID dari URL
    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        return view('produk.form', compact('produk', 'kategoris'));
    }

    // UPDATE - Simpan perubahan produk ke database
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama'        => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
        ]);
        $produk->update($request->only('nama', 'kategori_id', 'harga', 'stok', 'deskripsi'));
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // DESTROY - Hapus produk dari database
    // DELETE FROM produks WHERE id = ?
    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
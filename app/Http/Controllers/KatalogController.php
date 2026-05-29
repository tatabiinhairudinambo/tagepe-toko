<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;

class KatalogController extends Controller
{
    public function index()
    {
        return view('frontend.katalog.index', [
            'produks'       => Produk::with('kategori')->get(),
            'kategoris'     => Kategori::all(),
            'totalProduk'   => Produk::count(),
            'totalKategori' => Kategori::count(),
        ]);
    }
}

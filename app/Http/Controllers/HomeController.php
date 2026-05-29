<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Artikel;
use App\Models\Testimoni;
use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $toko = Toko::first();
        $banners = Banner::aktif()->get();
        $produkUnggulan = Produk::where('status', 'approved')
            ->where('stok', '>', 0)
            ->latest()
            ->take(8)
            ->get();
        $artikels = Artikel::published()->take(3)->get();
        $testimonis = Testimoni::aktif()->take(6)->get();
        
        return view('frontend.home', compact(
            'toko',
            'banners',
            'produkUnggulan',
            'artikels',
            'testimonis'
        ));
    }
}

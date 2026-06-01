<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Artikel;
use App\Models\Testimoni;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Toko;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Halaman utama toko online
     * Menampilkan banner, produk unggulan, artikel, testimoni
     */
    public function index()
    {
        $toko = Toko::first();
        
        // Cek apakah tabel banner ada
        $banners = collect([]);
        try {
            if (\Schema::hasTable('banners')) {
                $banners = Banner::where('status', 'aktif')->get();
            }
        } catch (\Exception $e) {
            // Jika error, biarkan banners kosong
        }
        
        // Ambil produk unggulan (8 produk terbaru yang ada stok)
        // Tidak perlu cek status 'approved' jika belum ada workflow approval
        $produkUnggulan = Produk::where('stok', '>', 0)
            ->latest()
            ->take(8)
            ->get();
        
        // Cek apakah tabel artikel ada
        $artikels = collect([]);
        try {
            if (\Schema::hasTable('artikels')) {
                $artikels = Artikel::where('status', 'published')
                    ->orderBy('created_at', 'desc')
                    ->take(3)
                    ->get();
            }
        } catch (\Exception $e) {
            // Jika error, biarkan artikels kosong
        }
        
        // Cek apakah tabel testimoni ada
        $testimonis = collect([]);
        try {
            if (\Schema::hasTable('testimonis')) {
                $testimonis = Testimoni::where('status', 'aktif')
                    ->orderBy('created_at', 'desc')
                    ->take(6)
                    ->get();
            }
        } catch (\Exception $e) {
            // Jika error, biarkan testimonis kosong
        }
        
        return view('frontend.shop.home', compact(
            'toko',
            'banners',
            'produkUnggulan',
            'artikels',
            'testimonis'
        ));
    }
    
    /**
     * Halaman katalog produk
     * Menampilkan semua produk dengan filter dan pagination
     */
    public function katalog()
    {
        $produks = Produk::with('kategori')
            ->where('status', 'approved')
            ->paginate(16);
        
        $toko = Toko::first();
        
        // Data artikel
        $artikels = [
            [
                'id' => 1,
                'judul' => 'Tips Belanja Hemat di ' . ($toko->nama_toko ?? 'Toko Kami'),
                'excerpt' => 'Dapatkan tips dan trik belanja hemat untuk kebutuhan sehari-hari Anda.',
                'gambar' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=400&fit=crop',
                'tanggal' => '2026-05-25',
                'kategori' => 'Tips Belanja'
            ],
            [
                'id' => 2,
                'judul' => 'Produk Terlaris Bulan Ini',
                'excerpt' => 'Lihat produk-produk favorit pelanggan kami yang paling banyak dibeli.',
                'gambar' => 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=800&h=400&fit=crop',
                'tanggal' => '2026-05-20',
                'kategori' => 'Produk'
            ],
            [
                'id' => 3,
                'judul' => 'Promo Spesial Akhir Bulan',
                'excerpt' => 'Nikmati diskon hingga 50% untuk produk pilihan. Promo terbatas!',
                'gambar' => 'https://images.unsplash.com/photo-1607083206968-13611e3d76db?w=800&h=400&fit=crop',
                'tanggal' => '2026-05-15',
                'kategori' => 'Promo'
            ]
        ];
        
        // Data promosi
        $promosis = [
            [
                'judul' => 'Diskon 50% Produk Pilihan',
                'deskripsi' => 'Promo spesial akhir bulan! Belanja sekarang dan hemat lebih banyak.',
                'gambar' => 'https://images.unsplash.com/photo-1607082349566-187342175e2f?w=600&h=300&fit=crop',
                'badge' => 'HOT DEAL',
                'warna' => 'danger'
            ],
            [
                'judul' => 'Gratis Ongkir Min. Belanja 100rb',
                'deskripsi' => 'Nikmati gratis ongkir untuk pembelian minimal Rp 100.000',
                'gambar' => 'https://images.unsplash.com/photo-1566576721346-d4a3b4eaeb55?w=600&h=300&fit=crop',
                'badge' => 'FREE SHIPPING',
                'warna' => 'success'
            ],
            [
                'judul' => 'Cashback 20% Setiap Hari',
                'deskripsi' => 'Dapatkan cashback hingga 20% untuk setiap transaksi Anda.',
                'gambar' => 'https://images.unsplash.com/photo-1607082350899-7e105aa886ae?w=600&h=300&fit=crop',
                'badge' => 'CASHBACK',
                'warna' => 'warning'
            ]
        ];
        
        return view('frontend.shop.katalog.index', [
            'produks'       => $produks,
            'kategoris'     => Kategori::all(),
            'totalProduk'   => Produk::where('status', 'approved')->count(),
            'totalKategori' => Kategori::count(),
            'artikels'      => $artikels,
            'promosis'      => $promosis,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $toko = Toko::first();
        
        // Data artikel (nanti bisa dari database)
        $artikels = [
            [
                'id' => 1,
                'judul' => 'Tips Belanja Hemat di ' . ($toko->nama_toko ?? 'Toko Kami'),
                'excerpt' => 'Dapatkan tips dan trik belanja hemat untuk kebutuhan sehari-hari Anda. Hemat hingga 30% dengan strategi yang tepat!',
                'gambar' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=400&fit=crop',
                'tanggal' => '2026-05-25',
                'kategori' => 'Tips Belanja'
            ],
            [
                'id' => 2,
                'judul' => 'Produk Terlaris Bulan Ini',
                'excerpt' => 'Lihat produk-produk favorit pelanggan kami yang paling banyak dibeli bulan ini. Jangan sampai kehabisan!',
                'gambar' => 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=800&h=400&fit=crop',
                'tanggal' => '2026-05-20',
                'kategori' => 'Produk'
            ],
            [
                'id' => 3,
                'judul' => 'Promo Spesial Akhir Bulan',
                'excerpt' => 'Nikmati diskon hingga 50% untuk produk pilihan. Promo terbatas hanya sampai akhir bulan ini!',
                'gambar' => 'https://images.unsplash.com/photo-1607083206968-13611e3d76db?w=800&h=400&fit=crop',
                'tanggal' => '2026-05-15',
                'kategori' => 'Promo'
            ],
            [
                'id' => 4,
                'judul' => 'Cara Mudah Berbelanja Online',
                'excerpt' => 'Panduan lengkap berbelanja online di toko kami. Mudah, cepat, dan aman!',
                'gambar' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&h=400&fit=crop',
                'tanggal' => '2026-05-10',
                'kategori' => 'Panduan'
            ],
            [
                'id' => 5,
                'judul' => 'Kenapa Harus Belanja di ' . ($toko->nama_toko ?? 'Toko Kami') . '?',
                'excerpt' => 'Temukan alasan mengapa ribuan pelanggan memilih kami sebagai toko kepercayaan mereka.',
                'gambar' => 'https://images.unsplash.com/photo-1534452203293-494d7ddbf7e0?w=800&h=400&fit=crop',
                'tanggal' => '2026-05-05',
                'kategori' => 'Tentang Kami'
            ],
            [
                'id' => 6,
                'judul' => 'Program Loyalitas Pelanggan',
                'excerpt' => 'Dapatkan poin reward setiap kali berbelanja dan tukarkan dengan hadiah menarik!',
                'gambar' => 'https://images.unsplash.com/photo-1513885535751-8b9238bd345a?w=800&h=400&fit=crop',
                'tanggal' => '2026-05-01',
                'kategori' => 'Program'
            ]
        ];
        
        // Data promosi/iklan
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
        
        return view('frontend.artikel.index', compact('toko', 'artikels', 'promosis'));
    }
}

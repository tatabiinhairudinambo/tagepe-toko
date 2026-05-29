<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Artikel;
use App\Models\Testimoni;
use Illuminate\Database\Seeder;

class FrontendSeeder extends Seeder
{
    public function run(): void
    {
        // Banners
        Banner::create([
            'judul' => 'Promo Spesial Akhir Bulan',
            'deskripsi' => 'Diskon hingga 50% untuk semua produk pilihan',
            'gambar' => 'https://images.unsplash.com/photo-1607082349566-187342175e2f?w=1200&h=500&fit=crop',
            'link' => '/katalog',
            'urutan' => 1,
            'aktif' => true
        ]);

        Banner::create([
            'judul' => 'Gratis Ongkir Se-Indonesia',
            'deskripsi' => 'Untuk pembelian minimal Rp 100.000',
            'gambar' => 'https://images.unsplash.com/photo-1566576721346-d4a3b4eaeb55?w=1200&h=500&fit=crop',
            'link' => '/order',
            'urutan' => 2,
            'aktif' => true
        ]);

        Banner::create([
            'judul' => 'Produk Terbaru Telah Tiba',
            'deskripsi' => 'Koleksi terbaru dengan kualitas premium',
            'gambar' => 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=1200&h=500&fit=crop',
            'link' => '/katalog',
            'urutan' => 3,
            'aktif' => true
        ]);

        // Artikels
        Artikel::create([
            'judul' => 'Tips Belanja Hemat di Era Digital',
            'slug' => 'tips-belanja-hemat-di-era-digital',
            'excerpt' => 'Pelajari cara berbelanja online yang cerdas dan hemat untuk kebutuhan sehari-hari Anda.',
            'konten' => '<p>Belanja online kini menjadi pilihan utama banyak orang. Dengan tips yang tepat, Anda bisa berhemat hingga 30%!</p><p>Berikut adalah beberapa tips yang bisa Anda terapkan...</p>',
            'gambar' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=400&fit=crop',
            'kategori_artikel' => 'Tips Belanja',
            'published' => true
        ]);

        Artikel::create([
            'judul' => 'Panduan Memilih Produk Berkualitas',
            'slug' => 'panduan-memilih-produk-berkualitas',
            'excerpt' => 'Ketahui cara memilih produk yang berkualitas dengan harga terjangkau untuk kebutuhan Anda.',
            'konten' => '<p>Memilih produk berkualitas tidak harus mahal. Simak panduan lengkapnya di sini...</p>',
            'gambar' => 'https://images.unsplash.com/photo-1607082349566-187342175e2f?w=800&h=400&fit=crop',
            'kategori_artikel' => 'Panduan',
            'published' => true
        ]);

        Artikel::create([
            'judul' => 'Promo Menarik Bulan Ini',
            'slug' => 'promo-menarik-bulan-ini',
            'excerpt' => 'Jangan lewatkan berbagai promo menarik yang kami tawarkan khusus untuk Anda bulan ini.',
            'konten' => '<p>Bulan ini kami hadirkan berbagai promo spesial yang sayang untuk dilewatkan...</p>',
            'gambar' => 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=800&h=400&fit=crop',
            'kategori_artikel' => 'Promo',
            'published' => true
        ]);

        // Testimonis
        Testimoni::create([
            'nama' => 'Budi Santoso',
            'foto' => null,
            'testimoni' => 'Pelayanan sangat memuaskan! Produk berkualitas dan pengiriman cepat. Recommended!',
            'rating' => 5,
            'aktif' => true
        ]);

        Testimoni::create([
            'nama' => 'Siti Nurhaliza',
            'foto' => null,
            'testimoni' => 'Harga terjangkau dengan kualitas yang tidak mengecewakan. Pasti akan belanja lagi!',
            'rating' => 5,
            'aktif' => true
        ]);

        Testimoni::create([
            'nama' => 'Ahmad Fauzi',
            'foto' => null,
            'testimoni' => 'Website mudah digunakan, proses order cepat. Customer service juga responsif.',
            'rating' => 5,
            'aktif' => true
        ]);

        Testimoni::create([
            'nama' => 'Dewi Lestari',
            'foto' => null,
            'testimoni' => 'Produknya original dan sesuai deskripsi. Packaging rapi dan aman. Terima kasih!',
            'rating' => 5,
            'aktif' => true
        ]);

        Testimoni::create([
            'nama' => 'Rudi Hermawan',
            'foto' => null,
            'testimoni' => 'Belanja online jadi lebih mudah dan menyenangkan. Promo-promonya juga menarik!',
            'rating' => 5,
            'aktif' => true
        ]);

        Testimoni::create([
            'nama' => 'Linda Wijaya',
            'foto' => null,
            'testimoni' => 'Sangat puas dengan pelayanan dan produknya. Akan merekomendasikan ke teman-teman!',
            'rating' => 5,
            'aktif' => true
        ]);
    }
}

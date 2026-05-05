<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cabang;
use App\Models\Produk;
use App\Models\StokCabang;

class CabangSeeder extends Seeder
{
    public function run(): void
    {
        // Buat cabang pusat
        $pusat = Cabang::create([
            'kode_cabang' => 'PUSAT',
            'nama_cabang' => 'Cabang Pusat',
            'alamat' => 'Jl. Raya Utama No. 1, Jakarta',
            'telepon' => '021-12345678',
            'email' => 'pusat@datatoko.com',
            'is_active' => true,
        ]);

        // Buat cabang 1
        $cabang1 = Cabang::create([
            'kode_cabang' => 'CBG-001',
            'nama_cabang' => 'Cabang Bandung',
            'alamat' => 'Jl. Asia Afrika No. 10, Bandung',
            'telepon' => '022-87654321',
            'email' => 'bandung@datatoko.com',
            'is_active' => true,
        ]);

        // Buat cabang 2
        $cabang2 = Cabang::create([
            'kode_cabang' => 'CBG-002',
            'nama_cabang' => 'Cabang Surabaya',
            'alamat' => 'Jl. Tunjungan No. 5, Surabaya',
            'telepon' => '031-11223344',
            'email' => 'surabaya@datatoko.com',
            'is_active' => true,
        ]);

        // Isi stok untuk setiap cabang (ambil dari stok produk yang ada)
        $produks = Produk::all();
        
        foreach ($produks as $produk) {
            // Distribusi stok ke cabang
            $stokPusat = floor($produk->stok * 0.5); // 50% ke pusat
            $stokCabang1 = floor($produk->stok * 0.3); // 30% ke cabang 1
            $stokCabang2 = $produk->stok - $stokPusat - $stokCabang1; // sisanya ke cabang 2
            
            StokCabang::create([
                'cabang_id' => $pusat->id,
                'produk_id' => $produk->id,
                'stok' => $stokPusat,
            ]);
            
            StokCabang::create([
                'cabang_id' => $cabang1->id,
                'produk_id' => $produk->id,
                'stok' => $stokCabang1,
            ]);
            
            StokCabang::create([
                'cabang_id' => $cabang2->id,
                'produk_id' => $produk->id,
                'stok' => $stokCabang2,
            ]);
        }
    }
}


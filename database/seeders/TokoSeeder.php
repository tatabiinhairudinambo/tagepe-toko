<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TokoSeeder extends Seeder
{
    public function run(): void
    {
        // Hanya insert jika tabel masih kosong
        if (DB::table('toko')->count() === 0) {
            DB::table('toko')->insert([
                'nama_toko'  => 'Tagepe Toko',
                'alamat'     => 'Jl buntu.  no 1, Kota buta huruf',
                'telepon'    => '082213840415',
                'email'      => 'toko@datatoko.com',
                'logo'       => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

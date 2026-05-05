<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Cek dulu, kalau sudah ada tidak dibuat lagi
        if (!DB::table('users')->where('email', 'admin@datatoko.com')->exists()) {
            DB::table('users')->insert([
                'name'       => 'Admin',
                'email'      => 'admin@datatoko.com',
                'password'   => Hash::make('admin'), // password "admin" di-hash/enkripsi
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

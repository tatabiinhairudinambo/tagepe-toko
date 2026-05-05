<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    // Nama tabel eksplisit karena bukan plural otomatis Laravel
    protected $table = 'toko';

    protected $fillable = [
        'nama_toko',
        'alamat',
        'telepon',
        'email',
        'logo',
    ];
}

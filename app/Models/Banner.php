<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'link',
        'urutan',
        'aktif'
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->orderBy('urutan');
    }
}

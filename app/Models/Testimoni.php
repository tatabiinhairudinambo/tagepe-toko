<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $fillable = [
        'nama',
        'foto',
        'testimoni',
        'rating',
        'aktif'
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->latest();
    }
}

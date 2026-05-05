<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama', 'kategori_id', 'harga', 'stok', 'deskripsi', 'foto'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}

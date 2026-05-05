<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama', 'kategori_id', 'harga', 'stok', 'stok_minimum', 'deskripsi', 'foto', 'status', 'dibuat_oleh'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    
    public function stokCabangs()
    {
        return $this->hasMany(StokCabang::class);
    }
    
    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    public function dibuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}

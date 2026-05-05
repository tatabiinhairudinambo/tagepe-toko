<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama_produk', 'kode_produk', 'kategori_id', 'harga', 'stok', 'deskripsi', 'foto'];

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
}

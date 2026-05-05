<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cabang extends Model
{
    protected $fillable = [
        'kode_cabang',
        'nama_cabang',
        'alamat',
        'telepon',
        'email',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function stokCabangs(): HasMany
    {
        return $this->hasMany(StokCabang::class);
    }

    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }

    // Get stok produk di cabang ini
    public function getStokProduk($produk_id)
    {
        $stok = $this->stokCabangs()->where('produk_id', $produk_id)->first();
        return $stok ? $stok->stok : 0;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPublikDetail extends Model
{
    public $timestamps = false;
    protected $fillable = ['order_publik_id', 'produk_id', 'jumlah', 'harga', 'subtotal'];

    public function produk() { return $this->belongsTo(Produk::class); }
}

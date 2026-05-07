<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPublik extends Model
{
    protected $fillable = ['kode_order', 'nama_customer', 'telepon', 'catatan', 'total', 'status', 'cabang_id'];

    public function details() { return $this->hasMany(OrderPublikDetail::class); }
    public function cabang()  { return $this->belongsTo(Cabang::class); }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = ['kode_pesan', 'cabang_id', 'user_id', 'nama_pelanggan', 'total', 'status', 'kasir'];

    public function cabang() { return $this->belongsTo(Cabang::class); }
    public function user()   { return $this->belongsTo(User::class); }
    public function details(){ return $this->hasMany(PemesananDetail::class); }
}

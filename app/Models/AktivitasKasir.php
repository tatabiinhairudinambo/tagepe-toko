<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktivitasKasir extends Model
{
    protected $table = 'aktivitas_kasir';
    protected $fillable = ['user_id', 'aksi', 'keterangan', 'nominal'];

    public function user() { return $this->belongsTo(User::class); }
}

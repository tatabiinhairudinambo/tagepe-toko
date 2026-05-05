<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokCabang extends Model
{
    protected $fillable = [
        'cabang_id',
        'produk_id',
        'stok'
    ];

    protected $casts = [
        'stok' => 'integer',
    ];

    public function cabang(): BelongsTo
    {
        return $this->belongsTo(Cabang::class);
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}

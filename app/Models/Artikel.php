<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{
    protected $fillable = [
        'judul',
        'slug',
        'excerpt',
        'konten',
        'gambar',
        'kategori_artikel',
        'views',
        'published'
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('published', true)->latest();
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($artikel) {
            if (empty($artikel->slug)) {
                $artikel->slug = Str::slug($artikel->judul);
            }
        });
    }
}

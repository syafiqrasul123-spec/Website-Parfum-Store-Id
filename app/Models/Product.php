<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Tambahkan baris ini untuk mengizinkan kolom-kolom ini diisi
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'tiktok_affiliate_url',
    ];

    public function carts()
    {
    return $this->hasMany(Cart::class);
    }
}

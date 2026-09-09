<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];


/**
     * Hubungkan Keranjang ke Model Product (Satu baris keranjang punya satu produk)
     */
    public function product()
    {
        return $this->belongsTO(Product::class);
    }

    /**
     * Hubungkan Keranjang ke Model User (Satu baris keranjang milik satu user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
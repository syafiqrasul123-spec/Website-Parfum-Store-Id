<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan semua katalog parfum di halaman depan
    public function index()
    {
        $products = Product::all();
        return view('perfume.index', compact('products'));
    }

    // Menampilkan detail satu parfum saat diklik
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('perfume.show', compact('product'));
    }
}

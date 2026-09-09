<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Pastikan hanya user yang sudah login yang bisa mengakses keranjang
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 1. Menampilkan Isi Keranjang Belanja User
     */
    public function index()
    {
        // Mengambil semua item keranjang milik user yang sedang login beserta data produknya
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        
        // Menghitung total harga belanjaan
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        return view('perfume.cart', compact('cartItems', 'totalPrice'));
    }

    /**
     * 2. Menambahkan Produk ke Dalam Keranjang
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Cek apakah produk tersebut sudah ada di keranjang user
        $existingCart = Cart::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->first();

        if ($existingCart) {
            // Jika sudah ada, tinggal tambahkan kuantitinya
            $existingCart->increment('quantity', $request->quantity);
        } else {
            // Jika belum ada, buat data keranjang baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Parfum berhasil dimasukkan ke keranjang!');
    }

    /**
     * 3. Mengupdate Jumlah (Quantity) Item di Keranjang
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cart->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->route('cart.index')->with('success', 'Jumlah pesanan berhasil diperbarui!');
    }

    /**
     * 4. Menghapus Satu Item dari Keranjang
     */
    public function destroy($id)
    {
        $cart = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}


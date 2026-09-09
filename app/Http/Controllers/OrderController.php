<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    // Menampilkan Form Checkout
    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjangmu kosong, bro.');
        }

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        return view('perfume.checkout', compact('cartItems', 'totalPrice'));
    }

    // Memproses Data Formulir & Bukti Transfer
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->get();
        
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        // Upload Bukti Transfer
        $imagePath = null;
        if ($request->hasFile('payment_proof')) {
            $imagePath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // Simpan ke tabel orders
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'total_price' => $totalPrice,
            'payment_proof' => $imagePath,
            'status' => 'pending',
        ]);

        // Pindahkan item keranjang ke order_items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
            
            // Kurangi stok produk asli
            $item->product->decrement('stock', $item->quantity);
        }

        // Kosongkan keranjang belanja user
        Cart::where('user_id', Auth::id())->delete();
        

        return redirect()->route('checkout.success', $order->id);
    }

       public function success($id)
{
    // Cari order berdasarkan ID dan pastikan milik user yang sedang login
    $order = Order::where('user_id', \Auth::id())->with('items.product')->findOrFail($id);

    return view('perfume.success', compact('order'));
}

// Menampilkan Daftar Pesanan Milik User yang Sedang Login
public function myOrders()
{
    // Ambil semua order milik user ini, diurutkan dari yang paling baru
    $orders = Order::where('user_id', Auth::id())->with('items.product')->latest()->get();

    return view('perfume.my_orders', compact('orders'));
}

// Menampilkan Semua Pesanan Masuk (Sisi Admin)
public function adminIndex()
{
    // Batasi akses: Hanya email admin123@gmail.com yang boleh masuk
    if (\Auth::user()->email !== 'admin123@gmail.com') {
        abort(403, 'Anda bukan admin, bro.');
    }

    // Ambil seluruh data order dari semua user, urutkan dari yang paling baru
    $orders = Order::with(['user', 'items.product'])->latest()->get();

    return view('admin.admin_orders', compact('orders'));
}

// Mengubah Status Pesanan (Sisi Admin)
public function updateStatus(Request $request, $id)
{
    if (\Auth::user()->email !== 'admin123@gmail.com') {
        abort(403);
    }

    $request->validate([
        'status' => 'required|in:pending,approved,completed,rejected'
    ]);

    $order = Order::findOrFail($id);
    $order->update([
        'status' => $request->status
    ]);

    return redirect()->back()->with('success', 'Status pesanan #ORD-' . $id . ' berhasil diperbarui!');
}

}
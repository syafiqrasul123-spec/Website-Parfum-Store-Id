<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Otomatis dari Laravel UI Auth
Auth::routes(); 

// Route untuk Pengunjung Umum
Route::get('/', [ProductController::class, 'index'])->name('perfume.index');
Route::get('/parfum/{slug}', [ProductController::class, 'show'])->name('perfume.show');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

// Route khusus Admin (Harus Login) untuk input produk
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('products', AdminProductController::class);
});

// / Group Route khusus Keranjang Belanja (Harus Login dulu)
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{id}', [OrderController::class, 'success'])->name('checkout.success');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
    Route::patch('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});
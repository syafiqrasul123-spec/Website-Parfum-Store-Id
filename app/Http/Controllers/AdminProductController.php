<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;     // Ditambahkan untuk menghitung statistik keuangan
use App\Models\OrderItem; // Ditambahkan untuk menghitung performa produk terlaris
use App\Models\Visitor;   // Ditambahkan untuk menghitung statistik pengunjung (Namespace A Besar)
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;       // Ditambahkan untuk menjalankan query raw grouping database

class AdminProductController extends Controller
{
    /**
     * Batasi akses seluruh method di controller ini hanya untuk Admin tunggal
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Pastikan user sudah login DAN emailnya cocok dengan email admin kamu
            if (!Auth::check() || Auth::user()->email !== 'admin123@gmail.com') {
                abort(403, 'Maaf bro, halaman ini khusus area Admin Syafiq!');
            }
            return $next($request);
        });
    }

    /**
     * 1. Menampilkan Semua Produk + Kalkulasi Grafik & Statistik Toko
     */
    public function index()
    {
        // A. Hitung Ringkasan Data Angka untuk Widget Dashboard (Penjualan)
        $totalRevenue = Order::whereIn('status', ['approved', 'completed'])->sum('total_price');
        $totalOrdersSuccess = Order::whereIn('status', ['approved', 'completed'])->count();
        $totalOrdersPending = Order::where('status', 'pending')->count();
        $totalProducts = Product::count();

        // B. Hitung Statistik Pengunjung Website (Visitor Tracking)
        $totalVisitors  = Visitor::count();
        $uniqueVisitors = Visitor::distinct('ip_address')->count('ip_address');
        $todayVisitors  = Visitor::whereDate('created_at', today())->count();

        // C. Tarik Data 5 Produk Terlaris dari Tabel Order Items (Grafik Chart.js)
        $bestSellers = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty', 'desc')
            ->with('product')
            ->take(5)
            ->get();

        $productLabels = [];
        $productSalesData = [];

        foreach ($bestSellers as $seller) {
            if ($seller->product) {
                $productLabels[] = $seller->product->name;
                $productSalesData[] = $seller->total_qty;
            }
        }

        // D. Ambil semua data produk untuk tabel manajemen bawaan admin
        $products = Product::latest()->get();

        // Mengelompokkan semua data yang dibutuhkan untuk dikirim ke view index.blade.php
        $data = [
            'products' => $products,
            'totalRevenue' => $totalRevenue,
            'totalOrdersSuccess' => $totalOrdersSuccess,
            'totalOrdersPending' => $totalOrdersPending,
            'totalProducts' => $totalProducts,
            'totalVisitors' => $totalVisitors,
            'uniqueVisitors' => $uniqueVisitors,
            'todayVisitors' => $todayVisitors,
            'productLabels' => $productLabels,
            'productSalesData' => $productSalesData
        ];
        // E. Lempar SELURUH DATA dalam 1x return view ke file index.blade.php
        return view('admin.products.index', $data);
    }

    /**
     * 2. Menampilkan Form Tambah Produk Baru
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * 3. Memproses Penyimpanan Produk Baru ke Database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description'=> 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'tiktok_affiliate_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_url' => 'nullable|url'
        ]);

        // Logika pemilihan gambar: Prioritaskan Link URL jika diisi, jika tidak baru cek file upload lokal
        $imagePath = null;
        if ($request->filled('image_url')) {
            $imagePath = $request->image_url;
        } elseif ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'tiktok_affiliate_url' => $request->tiktok_affiliate_url ?? '',
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Parfum baru berhasil ditambahkan!');
    }

    /**
     * Halaman detail (Dilewati untuk dashboard admin)
     */
    public function show(string $id)
    {
        //
    }

    /**
     * 4. Menampilkan Form Edit Produk Berdasarkan ID
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * 5. Memproses Perubahan Data Produk (Update)
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description'=> 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'tiktok_affiliate_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_url' => 'nullable|url'
        ]);

        $imagePath = $product->image;

        if ($request->filled('image_url')) {
            if ($product->image && !Str::startsWith($product->image, ['http://', 'https://'])) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->image_url;
        } elseif ($request->hasFile('image')) {
            if ($product->image && !Str::startsWith($product->image, ['http://', 'https://'])) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'tiktok_affiliate_url' => $request->tiktok_affiliate_url ?? '',
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Data parfum berhasil diperbarui!');
    }

    /**
     * 6. Menghapus Produk dari Database dan Storage
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Parfum berhasil dihapus!');
    }
}
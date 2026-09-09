@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="row g-0">
                    <div class="col-md-6">
                        @if($product->image)
    <img src="{{ \Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://']) ? $product->image : asset('storage/' . $product->image) }}" class="img-fluid rounded-start w-100 h-100" alt="{{ $product->name }}" style="object-fit: cover; min-height: 400px;">
@else
    <div class="bg-light d-flex align-items-center justify-content-center h-100" style="min-height: 400px;">
        <span class="text-muted">Tidak ada foto</span>
    </div>
@endif
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="card-body p-4">
                            <h2 class="fw-bold mb-2">{{ $product->name }}</h2>
                            <h3 class="text-danger fw-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                            
                            <h5 class="fw-bold">Deskripsi Produk:</h5>
                            <p class="text-muted mb-4" style="white-space: pre-line;">{{ $product->description }}</p>
                            
                            <p class="mb-4"><strong>Stok Tersedia:</strong> {{ $product->stock }} botol</p>

                            <!-- FORM UTAMA: TAMBAH KE KERANJANG TOKO -->
                            <form action="{{ route('cart.store') }}" method="POST" class="mb-4">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="row g-2 align-items-center mb-3">
                                    <div class="col-auto">
                                        <label class="fw-bold text-muted small">Jumlah:</label>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" name="quantity" class="form-control text-center" value="1" min="1" max="{{ $product->stock }}" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-dark btn-lg w-100 fw-bold rounded-pill shadow-sm mb-2">
                                    🛒 Tambah ke Keranjang
                                </button>
                            </form>

                            <hr class="text-muted">

                            <!-- JALUR ALTERNATIF: PROMO TIKTOK AFFILIATE -->
                            <div class="mt-3">
                                <p class="text-center small text-muted mb-2">- ATAU DAPATKAN HARGA PROMO -</p>
                                @if($product->tiktok_affiliate_url)
                                    <a href="{{ $product->tiktok_affiliate_url }}" target="_blank" class="btn btn-outline-danger w-100 fw-bold rounded-pill shadow-sm">
                                        🎵 Beli di TikTok Shop (Diskon Affiliate)
                                    </a>
                                @else
                                    <button class="btn btn-secondary w-100 fw-bold rounded-pill" disabled>
                                        Belum Tersedia di TikTok Shop
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
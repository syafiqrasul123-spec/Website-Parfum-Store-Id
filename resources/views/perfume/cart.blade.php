@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Keranjang Belanja Anda 🛒</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> 
    @endif

    @if($cartItems->isEmpty())
        <div class="text-center py-5 card border-0 shadow-sm p-5">
            <h4 class="text-muted mb-3">Keranjangmu masih kosong nih, bro.</h4>
            <div>
                <a href="{{ route('perfume.index') }}" class="btn btn-dark px-4 fw-bold rounded-pill">Lihat Katalog Parfum</a>
            </div>
        </div>
    @else
        <div class="row g-4">
            <!-- Kolom List Item -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr class="text-muted small">
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th style="width: 130px;">Jumlah</th>
                                    <th>Subtotal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            @if($item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}" class="rounded shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light text-muted rounded d-flex align-items-center justify-content-center border" style="width: 60px; height: 60px; font-size: 11px;">No Img</div>
                                            @endif
                                            <div>
                                                <span class="fw-bold d-block text-dark">{{ $item->product->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                    <td>
                                        <!-- Form Update Jumlah (Quantity) -->
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center gap-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" class="form-control form-control-sm text-center" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" style="width: 60px;" onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="fw-bold">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <!-- Tombol Hapus Item -->
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus parfum ini dari keranjang?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm border-0">
                                                ❌ Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Kolom Ringkasan Belanja & Checkout -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 bg-light">
                    <h5 class="fw-bold border-bottom pb-2 mb-3">Ringkasan Belanja</h5>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="text-muted fs-5">Total Harga:</span>
                        <span class="fw-bold text-danger fs-4">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>
                    
                    <!-- Link Lanjut ke Form Checkout Mandiri -->
                    <a href="{{ route('checkout.index') }}" class="btn btn-dark btn-lg w-100 fw-bold rounded-pill mb-2 shadow-sm">
                        Lanjut ke Pembayaran 💳
                    </a>
                    <a href="{{ route('perfume.index') }}" class="btn btn-outline-secondary w-100 rounded-pill btn-sm">
                        ← Kembali Belanja
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
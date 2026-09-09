@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Formulir Alamat & Pembayaran 💳</h2>
    <div class="row g-4">
        <!-- Kolom Form Pengisian -->
        <div class="col-md-7">
            <div class="card border-0 shadow-sm p-4">
                <!-- Tambahkan ini tepat di atas tag <form> untuk melihat letak error-nya -->
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
                <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Penerima</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor WhatsApp/HP</label>
                        <input type="text" name="phone" class="form-control" placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat Pengiriman Lengkap</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Nama jalan, nomor rumah, RT/RW, Kecamatan, Kota" required></textarea>
                    </div>
                    
                    <div class="p-3 bg-light rounded mb-3 border">
                        <h6 class="fw-bold text-dark m-0 mb-2">Informasi Rekening Bank Toko:</h6>
                        <p class="small text-muted m-0">Bank BSI: <strong>7712345678</strong> a/n Parfum Store Indonesia</p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Upload Bukti Transfer</label>
                        <input type="file" name="payment_proof" class="form-control" accept="image/*" required>
                        <small class="text-muted">Format file: JPG, JPEG, PNG. Maksimal 2MB.</small>
                    </div>

                    <button type="submit" class="btn btn-danger btn-lg w-100 fw-bold rounded-pill shadow-sm">
                        Kirim Bukti & Selesaikan Pesanan
                    </button>
                </form>
            </div>
        </div>

        <!-- Kolom Review Belanja Ringkas -->
        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4 bg-dark text-white">
                <h5 class="fw-bold border-bottom pb-2 mb-3">Pesanan Anda</h5>
                @foreach($cartItems as $item)
                <div class="d-flex justify-content-between small mb-2">
                    <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                    <span>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                </div>
                @endforeach
                <div class="d-flex justify-content-between border-top pt-2 mt-3 fs-5 fw-bold text-warning">
                    <span>Total Bayar:</span>
                    <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
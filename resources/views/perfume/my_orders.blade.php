@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Pesanan Saya 📦</h2>

    @if($orders->isEmpty())
        <div class="text-center py-5 card border-0 shadow-sm p-5">
            <h4 class="text-muted mb-3">Kamu belum pernah melakukan pemesanan nih, bro.</h4>
            <div>
                <a href="{{ route('perfume.index') }}" class="btn btn-dark px-4 fw-bold rounded-pill">Mulai Belanja</a>
            </div>
        </div>
    @else
        <div class="row g-3">
            @foreach($orders as $order)
            <div class="col-12">
                <div class="card border-0 shadow-sm p-4 mb-2">
                    <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-3 mb-3">
                        <div>
                            <span class="text-muted small">Nota:</span>
                            <span class="fw-bold text-dark me-3">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <span class="text-muted small">Tanggal:</span>
                            <span class="text-dark">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                        </div>
                        <div>
                            <!-- Badge Status Pesanan -->
                            @if($order->status === 'pending')
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">⏳ Menunggu Verifikasi</span>
                            @elseif($order->status === 'approved')
                                <span class="badge bg-primary px-3 py-2 rounded-pill">📦 Sedang Diproses</span>
                            @elseif($order->status === 'completed')
                                <span class="badge bg-success px-3 py-2 rounded-pill">✅ Selesai</span>
                            @else
                                <span class="badge bg-danger px-3 py-2 rounded-pill">❌ Ditolak</span>
                            @endif
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="fw-bold text-muted small mb-2">Rincian Produk:</h6>
                            <ul class="list-unstyled mb-0">
                                @foreach($order->items as $item)
                                <li class="text-dark small mb-1">
                                    🛍️ <strong>{{ $item->product->name }}</strong> — {{ $item->quantity }} botol x Rp {{ number_format($item->price, 0, ',', '.') }}
                                </li>
                                @endforeach
                            </ul>
                            <p class="text-muted small mt-2 mb-0">📍 <strong>Alamat Kirim:</strong> {{ $order->address }}</p>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0 border-top pt-3 border-md-top-0 pt-md-0">
                            <span class="text-muted d-block small">Total Pembayaran:</span>
                            <span class="fw-bold text-danger fs-5">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
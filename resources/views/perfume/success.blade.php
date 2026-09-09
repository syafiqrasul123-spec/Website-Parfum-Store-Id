@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm text-center p-5 rounded-4 bg-white">
                
                <!-- =================================================================== -->
                <!-- 1. AREA STRUK PEMBAYARAN (DIPINDAHKAN KE SINI AGAR CENTANG HIJAU IKUT TERFOTO) -->
                <!-- =================================================================== -->
                <div id="receipt-card" class="bg-white p-3 rounded-4"> 
                    
                    <!-- Ikon Centang Minimalis Modern -->
                    <div class="mb-4 d-flex justify-content-center">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 80px; height: 80px;">
                            <span class="fs-1 fw-bold">&checkmark;</span>
                        </div>
                    </div>
                    
                    <h3 class="fw-bold text-dark mb-2">Pesanan Berhasil Dikirim!</h3>
                    <p class="text-muted small mb-4">Terima kasih telah berbelanja. Admin Syafiq akan segera memverifikasi bukti pembayaran Anda.</p>
                    
                    <!-- Detail Struk Ringkas -->
                    <div class="p-4 bg-light rounded-3 text-start mb-4 border border-dashed">
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted">ID Transaksi:</span>
                            <span class="fw-bold text-dark">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted">Nama Penerima:</span>
                            <span class="text-dark">{{ $order->name }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 small">
                            <span class="text-muted">No. WhatsApp:</span>
                            <span class="text-dark">{{ $order->phone }}</span>
                        </div>
                        
                        <hr class="text-muted my-2">
                        
                        <h6 class="fw-bold text-dark mb-2 small">Daftar Produk:</h6>
                        @foreach($order->items as $item)
                        <div class="d-flex justify-content-between small text-muted mb-1">
                            <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                            <span>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                        
                        <hr class="text-muted my-2">

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="fw-bold text-dark">Total Bayar:</span>
                            <span class="fw-bold text-danger fs-5">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                <!-- =================================================================== -->
                <!-- BATAS PENUTUP AREA BUNGKUS STRUK -->
                <!-- =================================================================== -->

                <!-- =================================================================== -->
                <!-- 2. DUA TOMBOL BARU AKSES CEPAT (TARUH TEPAT DI BAWAHNYA) -->
                <!-- =================================================================== -->
                <div class="d-flex gap-2 mb-3">
                    <button type="button" id="btn-download" class="btn btn-outline-primary fw-bold w-50 py-2">
                        💾 Download Struk
                    </button>
                    <button type="button" id="btn-share" class="btn btn-outline-success fw-bold w-50 py-2">
                        🔗 Bagikan Struk
                    </button>
                </div>

                <!-- Tombol Navigasi Kembali -->
                <div class="d-grid gap-2">
                    <a href="{{ route('perfume.index') }}" class="btn btn-dark btn-lg fw-bold rounded-pill shadow-sm">
                        Belanja Parfum Lagi
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- PANGGIL LIBRARY HTML2CANVAS VIA CDN -->
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const receiptElement = document.getElementById('receipt-card');
    const btnDownload = document.getElementById('btn-download');
    const btnShare = document.getElementById('btn-share');

    // 1. FITUR TOMBOL DOWNLOAD STRUK (JADI GAMBAR)
    btnDownload.addEventListener('click', function () {
        html2canvas(receiptElement, { scale: 2, useCORS: true }).then(canvas => {
            const image = canvas.toDataURL('image/png');
            const link = document.createElement('a');
            
            link.download = 'Struk-Transaksi.png';
            link.href = image;
            link.click();
        });
    });

    // 2. FITUR TOMBOL BAGIKAN STRUK (MENGGUNAKAN WEB SHARE API / COPY LINK)
    btnShare.addEventListener('click', function () {
        if (navigator.share) {
            navigator.share({
                title: 'Struk Pembayaran ParfumStore.id',
                text: 'Halo bro, ini bukti transaksi pemesanan parfum saya.',
                url: window.location.href
            }).catch(console.error);
        } else {
            navigator.clipboard.writeText(window.location.href);
            alert('Link struk berhasil disalin ke clipboard, silakan bagikan langsung ke WhatsApp, bro!');
        }
    });
});
</script>

<style>
    /* Desain garis putus-putus estetis untuk ringkasan nota belanja */
    .border-dashed {
        border-style: dashed !important;
        border-width: 1px !important;
    }
</style>
@endsection
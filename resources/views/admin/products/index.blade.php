@extends('layouts.app')

@section('content')
<div class="container py-4"> <!-- Diubah ke py-4 agar jarak atas lebih pas -->
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <!-- JUDUL HALAMAN UTAMA -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold m-0">Dashboard Admin - Analisis & List Parfum 📊</h3>
                <a href="{{ route('products.create') }}" class="btn btn-primary fw-bold px-3">+ Tambah Parfum</a>
            </div>

            <!-- =================================================================== -->
            <!-- 1. ROW WIDGET KARTU RINGKASAN ANGKA (DISELIPKAN DI SINI) -->
            <!-- =================================================================== -->
            <div class="row g-3 mb-4">
                <!-- Total Pendapatan -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-3 bg-success text-white rounded-3">
                        <span class="small opacity-75 d-block mb-1" style="font-size: 0.85rem;">Total Pendapatan</span>
                        <h4 class="fw-bold m-0" style="font-size: 1.35rem;">Beta Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                    </div>
                </div>
                <!-- Pesanan Sukses -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-3 bg-dark text-white rounded-3">
                        <span class="small opacity-75 d-block mb-1" style="font-size: 0.85rem;">Pesanan Sukses</span>
                        <h4 class="fw-bold m-0" style="font-size: 1.35rem;">{{ $totalOrdersSuccess }} Transaksi</h4>
                    </div>
                </div>
                <!-- Pesanan Pending -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-3 bg-warning text-dark rounded-3">
                        <span class="small text-muted d-block mb-1" style="font-size: 0.85rem; font-weight: 500;">Butuh Verifikasi</span>
                        <h4 class="fw-bold m-0" style="font-size: 1.35rem;">{{ $totalOrdersPending }} Transaksi</h4>
                    </div>
                </div>
                <!-- Total Jenis Parfum -->
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm p-3 bg-primary text-white rounded-3">
                        <span class="small opacity-75 d-block mb-1" style="font-size: 0.85rem;">Katalog Varian</span>
                        <h4 class="fw-bold m-0" style="font-size: 1.35rem;">{{ $totalProducts }} Produk</h4>
                    </div>
                </div>
            </div>

            @include('layouts.statistik_admin')

            <!-- =================================================================== -->
            <!-- 2. ROW GRAFIK VISUALISASI CHART.JS (DISELIPKAN DI SINI) -->
            <!-- =================================================================== -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm p-4 rounded-3 bg-white">
                        <h5 class="fw-bold text-dark mb-3" style="font-size: 1rem;">📊 Grafik 5 Varian Parfum Terlaris (Terjual)</h5>
                        <!-- Canvas tempat grafik merender dirinya -->
                        <div style="position: relative; height: 260px;">
                            <canvas id="perfumeSalesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4 text-muted opacity-25">

            <!-- ALERT NOTIFIKASI BAWAAN ASLI -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- =================================================================== -->
            <!-- TABEL MANAJEMEN BAWAAN ASLI (JALAN TERUS TANPA DIUBAH) -->
            <!-- =================================================================== -->
            <div class="card shadow-sm border-0 mb-5">
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-3" style="width: 90px;">Foto</th>
                                <th>Nama Parfum</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th class="text-center" style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <!-- CARI KODE COCOK DI TABEL ADMIN KAMU SEBELUMNYA: -->
<td class="ps-3">
    @if($product->image)
        <!-- GANTI TAG IMG-NYA JADI SEPERTI DI BAWAH INI: -->
        <img src="{{ \Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://']) ? $product->image : asset('storage/' . $product->image) }}" class="rounded shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
    @else
        <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center fw-bold" style="width: 60px; height: 60px; font-size: 12px;">No Img</div>
    @endif
</td>
                                <td>
                                    <span class="fw-bold text-dark">{{ $product->name }}</span>
                                </td>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ $product->stock }} pcs</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm px-3 text-white fw-bold">Edit</a>
                                        
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus parfum {{ $product->name }} ini, bro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm px-3 fw-bold">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center p-4 text-muted">Belum ada koleksi parfum yang ditambahkan. Silakan klik Tambah Parfum!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- =================================================================== -->
<!-- 3. SCRIPT INJEKSI CHART.JS (DI BAGIAN PALING BAWAH FILE) -->
<!-- =================================================================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Konversi data array dari PHP controller ke JavaScript array
        const labelsData = {!! json_encode($productLabels) !!};
        const salesData = {!! json_encode($productSalesData) !!};

        const ctx = document.getElementById('perfumeSalesChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelsData.length > 0 ? labelsData : ['Belum Ada Data Terjual'],
                datasets: [{
                    label: 'Jumlah Botol Terjual',
                    data: salesData.length > 0 ? salesData : [0],
                    backgroundColor: '#dc3545', // Warna merah premium cerah
                    borderRadius: 6,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Sembunyikan label kotak atas biar clean
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Angka bulat (1, 2, 3...)
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
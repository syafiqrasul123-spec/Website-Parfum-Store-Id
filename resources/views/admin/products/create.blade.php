@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white fw-bold py-3">Tambah Koleksi Parfum Baru</div>
        <div class="card-body p-4">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Parfum</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Savage Oud Eau de Parfum" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Jelaskan notes keharuman parfum..." required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Harga (Rp)</label>
                        <input type="number" name="price" class="form-control" placeholder="150000" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Stok</label>
                        <input type="number" name="stock" class="form-control" placeholder="100" required>
                    </div>
                </div>
                <div class="mb-3">
    <label for="tiktok_affiliate_url" class="form-label fw-bold">Link TikTok Affiliate</label>
    <!-- UBAH TYPE MENJADI TEXT DAN PASTIKAN TIDAK ADA ATRIBUT REQUIRED -->
    <input type="text" class="form-control" id="tiktok_affiliate_url" name="tiktok_affiliate_url" placeholder="https://vt.tiktok.com/... (Boleh dikosongkan)">
</div>
    <label for="image" class="form-label fw-bold">Foto Produk (Pilih salah satu)</label>
    
    <!-- Opsi A: Upload File Lokal -->
    <input class="form-control mb-2" type="file" id="image" name="image">
    
    <div class="text-muted small mb-2">— ATAU —</div>
    
    <!-- Opsi B: Input Link URL Gambar Internet -->
    <input type="url" class="form-control" id="image_url" name="image_url" placeholder="Masukkan URL Gambar dari Internet (https://...)">
</div>
                <button type="submit" class="btn btn-success fw-bold px-4">Simpan Produk</button>
            </form>
        </div>
    </div>
</div>
@endsection
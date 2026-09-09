@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white fw-bold py-3">Edit Data Koleksi Parfum</div>
                <div class="card-body p-4">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Parfum</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label fw-bold">Harga (Rp)</label>
                                <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                            </div>
                            <div class="col">
                                <label class="form-label fw-bold">Stok</label>
                                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
    <label for="tiktok_affiliate_url" class="form-label fw-bold">Link TikTok Affiliate</label>
    <!-- UBAH TYPE MENJADI TEXT -->
    <input type="text" class="form-control" id="tiktok_affiliate_url" name="tiktok_affiliate_url" 
           value="{{ $product->tiktok_affiliate_url }}" placeholder="https://vt.tiktok.com/... (Boleh dikosongkan)">
                            <small class="text-muted">Kosongkan saja jika belum ada video/link affiliate.</small>
                        </div>

                        <div class="mb-4">
    <label class="form-label fw-bold">Ubah Foto Produk</label>
    
    <!-- Tampilkan preview gambar yang sedang aktif saat ini -->
    <div class="mb-2">
        <small class="text-muted d-block mb-1">Foto saat ini:</small>
        @if($product->image)
            <img src="{{ \Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://']) ? $product->image : asset('storage/' . $product->image) }}" 
                 class="img-thumbnail shadow-sm" 
                 style="max-height: 120px; object-fit: cover;">
        @else
            <span class="badge bg-secondary">Belum ada foto</span>
        @endif
    </div>

    <!-- Opsi A: Upload Lokal Baru -->
    <input type="file" name="image" id="image" class="form-control mb-2">
    
    <div class="text-muted small mb-2 text-center fw-bold">— ATAU —</div>
    
    <!-- Opsi B: Tempel Link URL Baru dari Internet -->
    <input type="url" name="image_url" id="image_url" class="form-control" 
           value="{{ \Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://']) ? $product->image : '' }}" 
           placeholder="Masukkan URL Gambar resmi dari Google (https://...)">
    
    <small class="text-muted d-block mt-1">Isi salah satu saja: unggah file baru dari penyimpanan lokal atau tempel tautan URL gambar dari internet.</small>
</div>

                        <div class="d-flex gap-2 border-top pt-3">
                            <button type="submit" class="btn btn-success px-4 fw-bold">Simpan Perubahan</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
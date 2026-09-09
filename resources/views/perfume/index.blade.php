@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2 class="text-center mb-5 fw-bold">Koleksi Parfum Premium</h2>
    <div class="row">
        @forelse($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                @if($product->image)
                    <img src="{{ \Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://']) ? $product->image : asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                        <span class="text-muted">Tidak ada foto</span>
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($product->description, 90) }}</p>
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-dark fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <a href="{{ route('perfume.show', $product->slug) }}" class="btn btn-outline-dark btn-sm rounded-pill">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted fs-5">Belum ada koleksi parfum tersedia.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
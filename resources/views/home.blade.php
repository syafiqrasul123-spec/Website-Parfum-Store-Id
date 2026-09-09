@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow border-0 p-5 bg-dark text-white rounded-3">
                <h1 class="fw-bold mb-3">Selamat Datang di Perfume Store, {{ Auth::user()->name }}! ✨</h1>
                <p class="fs-5 text-secondary mb-4">Temukan berbagai pilihan wewangian premium yang siap meningkatkan rasa percaya dirimu setiap hari.</p>
                
                @if (session('status'))
                    <div class="alert alert-success my-3" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="mt-2">
                    <a href="{{ route('perfume.index') }}" class="btn btn-light btn-lg fw-bold px-4 rounded-pill shadow-sm">Mulai Jelajahi Katalog</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
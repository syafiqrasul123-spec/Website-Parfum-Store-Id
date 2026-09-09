<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PerfumeStore.id') }}</title>

    <!-- Favicon / Icon Tab Browser -->
    <link rel="icon" href="{{ asset('logo.jpeg') }}" type="image/jpeg">
    <link rel="shortcut icon" href="{{ asset('logo.jpeg') }}" type="image/jpeg">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Bootstrap CSS CDN (Cukup jalankan php artisan serve tanpa npm run dev!) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Asset Vite Bawaan (Memastikan JS Laravel Tetap Terpanggil) -->


    <style>
        /* 1. HIASAN BACKGROUND KIRI & KANAN (Aura Gradasi Lembut) */
        body {
            background-color: #f4f7f6;
            background-image:
                radial-gradient(at 0% 0%, rgba(220, 53, 69, 0.06) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(13, 110, 253, 0.06) 0px, transparent 50%);
            background-attachment: fixed;
            min-height: 100vh;
        }

        /* BUNGKUSAN UTAMA BIAR ESTATIK DI TENGAH (Maksimal 1200px) */
        .main-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* 2. NAVBAR KAPSUL HITAM MELAYANG */
        .floating-navbar {
            background-color: #1a1a1a !important;
            border-radius: 50px;
            padding: 8px 20px;
            margin-top: 20px;
            margin-bottom: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        /* NAV LINK DI DALAM KAPSUL */
        .floating-navbar .nav-link {
            color: #b3b3b3 !important;
            font-weight: 500;
            padding: 8px 16px !important;
            transition: all 0.2s ease;
        }

        .floating-navbar .nav-link:hover,
        .floating-navbar .nav-link.active {
            color: #ffffff !important;
        }

        /* STYLING KHUSUS TOGGLER / HAMBURGER PADA CAPSULE NAVBAR */
        .floating-navbar .navbar-toggler {
            border: none !important;
            padding: 4px 8px;
            box-shadow: none !important;
        }

        /* Mengubah warna gariss icon hamburger menjadi putih terang */
        .floating-navbar .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        /* Agar tampilan menu collapsible saat dibuka di HP tidak merusak kapsul */
        @media (max-width: 767.98px) {
            .floating-navbar {
                border-radius: 25px !important;
                padding: 10px 16px !important;
            }

            .floating-navbar .navbar-collapse {
                margin-top: 12px;
                padding-top: 10px;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                text-align: center;
            }

            .floaating-navbar .nav-link {
                padding: 8px 0 !important;
            }
        }

        /* TOMBOL NAVIGASI KIRI */
        .btn-nav-circle {
            width: 34px;
            height: 34px;
            border-color: #404040 !important;
            color: #ffffff !important;
        }

        .btn-nav-circle:hover {
            background-color: #ffffff !important;
            color: #1a1a1a !important;
        }

        /* DROPDOWN USER DENGAN BENTUK PIL PUTIH ESTATIK */
        .user-capsule-dropdown .dropdown-toggle {
            background-color: #ffffff;
            color: #1a1a1a !important;
            padding: 6px 18px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .user-capsule-dropdown .dropdown-toggle::after {
            margin-left: 8px;
        }
    </style>
</head>

<body>
    <div id="app" class="main-wrapper">

        <!-- NAVBAR CAPSULE RESPONSIVE -->
        <nav class="navbar navbar-expand-md floating-navbar">
            <div class="container-fluid p-0 d-flex align-items-center justify-content-between">

                <!-- SISI KIRI: TOMBOL MAJU/MUNDUR & LOGO BRAND -->
                <div class="d-flex align-items-center gap-2">
                    <!-- Tombol Navigasi Kembali & Maju -->
                    <div class="d-flex gap-1 me-1">
                        <button onclick="window.history.back()"
                            class="btn btn-nav-circle btn-sm rounded-circle d-flex align-items-center justify-content-center"
                            title="Kembali">
                            <i class="bi bi-arrow-left"></i>
                        </button>
                        <button onclick="window.history.forward()"
                            class="btn btn-nav-circle btn-sm rounded-circle d-flex align-items-center justify-content-center"
                            title="Maju">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>

                    <!-- Brand Logo + Gambar Logo Bundar -->
                    <a class="navbar-brand fw-bold text-white m-0 d-flex align-items-center gap-2"
                        href="{{ url('/') }}" style="font-size: 1.05rem;">
                        <img src="{{ asset('logo.jpeg') }}" alt="Logo" width="28" height="28"
                            class="rounded-circle" style="object-fit: cover;">
                        {{ config('app.name', 'Perfume Store') }}
                    </a>
                </div>

                <!-- SISI KANAN (HP): TOMBOL HAMBURGER 3 GARIS -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- MENU NAVIGASI (COLLAPSIBLE) -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Sisi Kiri Menu -->
                    <ul class="navbar-nav me-auto align-items-center my-2 my-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('perfume.index') }}">Katalog Toko</a>
                        </li>

                        @auth
                            @if (Auth::user()->email === 'admin123@gmail.com')
                                <li class="nav-item">
                                    <a class="nav-link fw-bold text-danger" href="{{ route('products.index') }}">Dashboard
                                        Admin</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold text-white" href="{{ route('admin.orders.index') }}">🛒
                                        Kelola Pesanan</a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Sisi Kanan Menu (Auth/Guest) -->
                    <ul class="navbar-nav ms-auto align-items-center gap-2">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- Keranjang Belanja -->
                            <li class="nav-item me-2">
                                <a class="nav-link position-relative p-1" href="{{ route('cart.index') }}"
                                    title="Keranjang Belanja">
                                    <span class="fs-5">🛒</span>
                                    @if (isset($cartCount) && $cartCount > 0)
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                            style="font-size: 0.65rem;">
                                            {{ $cartCount }}
                                        </span>
                                    @endif
                                </a>
                            </li>

                            <!-- Dropdown User Profile -->
                            <li class="nav-item dropdown user-capsule-dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                    @if (Auth::user()->email === 'admin123@gmail.com')
                                        <span class="badge bg-danger ms-1">Admin</span>
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 rounded-3"
                                    aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->email !== 'admin123@gmail.com')
                                        <a class="dropdown-item" href="{{ route('orders.my') }}">
                                            📦 Pesanan Saya
                                        </a>
                                        <hr class="dropdown-divider">
                                    @endif

                                    <a class="dropdown-item text-danger fw-bold" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-2">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS CDN (Interaktivitas Dropdown/Navbar Mobile) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

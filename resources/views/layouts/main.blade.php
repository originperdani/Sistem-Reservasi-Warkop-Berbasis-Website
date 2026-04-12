<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Warkop Pamulang')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-red: #9B1B30;
            --secondary-red: #7A1526;
            --cream-bg: #F5E6D3;
            --cream-light: #FEFBF6;
            --header-gradient: linear-gradient(135deg, var(--primary-red) 0%, var(--secondary-red) 100%);
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream-light);
            background-image: 
                radial-gradient(at 0% 0%, rgba(245, 230, 211, 0.5) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(155, 27, 48, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(245, 230, 211, 0.5) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(155, 27, 48, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: #4A1E1B;
            overflow-x: hidden;
        }
        .navbar {
            background: rgba(254, 251, 246, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(155, 27, 48, 0.05);
            transition: all 0.3s ease;
        }
        .nav-link {
            color: #4A1E1B !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: var(--primary-red) !important;
        }
        .nav-link.active {
            color: var(--primary-red) !important;
            font-weight: 700;
        }
        .btn-primary {
            background: var(--header-gradient);
            border: none;
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 10px 20px rgba(155, 27, 48, 0.2);
            transition: all 0.3s ease;
            color: white !important;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(155, 27, 48, 0.3);
        }
        .btn-outline-custom {
            color: var(--primary-red);
            border: 2px solid var(--primary-red);
            border-radius: 50px;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            background: transparent;
        }
        .btn-outline-custom:hover {
            background: var(--primary-red);
            color: white;
            transform: translateY(-3px);
        }
        .footer {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--secondary-red) 100%);
            padding: 80px 0 30px;
            position: relative;
            color: white !important;
        }
        .footer h5 {
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
        .footer ul li {
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            opacity: 0.85;
        }
        .footer a {
            color: white !important;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .footer a:hover {
            color: var(--cream-bg) !important;
            padding-left: 5px;
        }
        .footer .bi {
            font-size: 1.2rem;
            vertical-align: middle;
        }
        .footer .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
            font-size: 0.85rem;
        }
        .footer hr {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 40px 0 25px;
        }
        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: var(--primary-red);
            filter: blur(120px);
            border-radius: 50%;
            z-index: -1;
            opacity: 0.07;
            animation: float 20s infinite alternate;
        }
        @keyframes float {
            from { transform: translate(0, 0); }
            to { transform: translate(100px, 100px); }
        }
        .text-custom-red { color: var(--primary-red) !important; }
        .bg-custom-red { background-color: var(--primary-red) !important; color: white !important; }
        .btn-custom-red { 
            background: var(--header-gradient) !important;
            color: white !important;
            border: none;
            box-shadow: 0 5px 15px rgba(155, 27, 48, 0.2);
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="blob" style="top: -10%; left: -10%;"></div>
    <div class="blob" style="top: 40%; right: -10%; background: var(--cream-bg); opacity: 0.15;"></div>
    <div class="blob" style="bottom: -10%; left: 20%;"></div>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <i class="bi bi-cup-hot-fill me-2 text-custom-red" style="font-size: 1.5rem;"></i>
                <span class="fw-bold text-custom-red">Warkop Pamulang</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('menu.*') ? 'active' : '' }}" href="{{ auth()->check() ? route('menu.index') : route('login') }}">Menu</a></li>
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ auth()->check() ? route('dashboard') : route('login') }}">Reservasi Meja</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle px-3" href="#" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Keluar</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link px-3" href="{{ route('login') }}">Masuk</a></li>
                            @if (Route::has('register'))
                                <li class="nav-item"><a class="btn btn-primary ms-2 rounded-pill px-4" href="{{ route('register') }}">Daftar</a></li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="footer">
        <div class="container" data-aos="fade-up">
            <div class="row g-4 align-items-start">
                <!-- Column 1: Toko Kami -->
                <div class="col-lg-2 col-md-6 text-center text-lg-start">
                    <h5 class="fw-bold mb-3">Toko Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-white text-decoration-none hover:text-cream-bg transition">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('menu.index') }}" class="text-white text-decoration-none hover:text-cream-bg transition">Menu</a></li>
                        <li class="mb-2"><a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="text-white text-decoration-none hover:text-cream-bg transition">Reservasi</a></li>
                    </ul>
                </div>

                <!-- Column 2: Kontak -->
                <div class="col-lg-2 col-md-6 text-center text-lg-start">
                    <h5 class="fw-bold mb-3">Kontak Admin</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="https://wa.me/6285793930723?text=Halo%20Admin%20Warkop%20Pamulang%2C%20%0ASaya%20ingin%20reservasi%20dengan%20detail%3A%20%0A%20%0ANama%3A%20%0ATanggal%3A%20%0AWaktu%3A%20%0AJumlah%20Orang%3A%20%0APilihan%20Meja%20(VIP%2FOutdoor%2FIndoor)%3A%20%0A%20%0AMohon%20konfirmasi%20ketersediaannya.%20%0ATerima%20kasih." target="_blank" class="text-white text-decoration-none hover:text-cream-bg transition d-inline-flex align-items-center">
                                <i class="bi bi-whatsapp me-2"></i> Admin 1
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://wa.me/6289524673814?text=Halo%20Admin%20Warkop%20Pamulang%2C%20%0ASaya%20ingin%20reservasi%20dengan%20detail%3A%20%0A%20%0ANama%3A%20%0ATanggal%3A%20%0AWaktu%3A%20%0AJumlah%20Orang%3A%20%0APilihan%20Meja%20(VIP%2FOutdoor%2FIndoor)%3A%20%0A%20%0AMohon%20konfirmasi%20ketersediaannya.%20%0ATerima%20kasih." target="_blank" class="text-white text-decoration-none hover:text-cream-bg transition d-inline-flex align-items-center">
                                <i class="bi bi-whatsapp me-2"></i> Admin 2
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://wa.me/6281287225850?text=Halo%20Admin%20Warkop%20Pamulang%2C%20%0ASaya%20ingin%20reservasi%20dengan%20detail%3A%20%0A%20%0ANama%3A%20%0ATanggal%3A%20%0AWaktu%3A%20%0AJumlah%20Orang%3A%20%0APilihan%20Meja%20(VIP%2FOutdoor%2FIndoor)%3A%20%0A%20%0AMohon%20konfirmasi%20ketersediaannya.%20%0ATerima%20kasih." target="_blank" class="text-white text-decoration-none hover:text-cream-bg transition d-inline-flex align-items-center">
                                <i class="bi bi-whatsapp me-2"></i> Admin 3
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Branding (Absolute Center) -->
                <div class="col-lg-4 col-md-12 text-center position-relative">
                    <h5 class="mb-3 invisible">Spacer</h5>
                    <div class="position-relative mb-4">
                        <i class="bi bi-cup-hot-fill position-absolute start-50 translate-middle-x" style="font-size: 2.5rem; top: -4.5rem;"></i>
                        <h2 class="fw-bold mb-2">Warkop Pamulang</h2>
                    </div>
                    <p class="opacity-75 mb-0 small" style="line-height: 1.8; letter-spacing: 0.05em;">
                        Nikmati suasana santai dengan hidangan berkualitas dan kopi pilihan terbaik.
                    </p>
                </div>

                <!-- Column 4: Alamat Kami -->
                <div class="col-lg-4 col-md-12 text-center text-lg-end">
                    <h5 class="fw-bold mb-3">Alamat Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a href="https://maps.app.goo.gl/NJNd3rnqHpyWFJQP7" target="_blank" class="d-inline-flex justify-content-lg-end align-items-start text-decoration-none text-white hover:text-cream-bg transition">
                                <span class="me-3 small text-lg-end">Jl. Raya Puspitek No.31, Buaran, Serpong, Tangsel</span>
                                <i class="bi bi-geo-alt-fill flex-shrink-0"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="text-muted mb-0">Copyright &copy; 2026 Warkop Pamulang</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: false,
            mirror: true,
            offset: 120,
            easing: 'ease-in-out-cubic'
        });
    </script>
    @stack('scripts')
</body>
</html>

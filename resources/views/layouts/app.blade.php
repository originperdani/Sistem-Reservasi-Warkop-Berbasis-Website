<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'warkop-red': '#9B1B30',
                            'warkop-red-dark': '#7A1526',
                            'warkop-cream': '#F5E6D3',
                            'warkop-cream-light': '#FEFBF6',
                        },
                        fontFamily: {
                            sans: ['Poppins', 'sans-serif'],
                        },
                    }
                }
            }
        </script>
        <style>
            :root {
                --primary-red: #9B1B30;
                --secondary-red: #7A1526;
                --cream-bg: #F5E6D3;
                --cream-light: #FEFBF6;
                --header-gradient: linear-gradient(135deg, var(--primary-red) 0%, var(--secondary-red) 100%);
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
         </style>
         @stack('styles')
         {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
    <body class="font-sans antialiased bg-warkop-cream-light text-[#4A1E1B] overflow-x-hidden">
        <div class="blob" style="top: -10%; left: -10%;"></div>
        <div class="blob" style="top: 40%; right: -10%; background: var(--cream-bg); opacity: 0.15;"></div>
        <div class="blob" style="bottom: -10%; left: 20%;"></div>

        <div class="min-h-screen bg-transparent overflow-x-hidden">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-warkop-red/10">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <footer class="footer overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start" data-aos="fade-up">
                    <!-- Column 1: Admin Quick Links -->
                    <div class="col-span-1 md:col-span-3 text-center md:text-left">
                        <h5 class="fw-bold mb-3">Manajemen</h5>
                        <ul class="list-unstyled space-y-2">
                            <li><a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none hover:text-cream-bg transition">Beranda</a></li>
                            <li><a href="{{ route('admin.reservasis') }}" class="text-white text-decoration-none hover:text-cream-bg transition">Reservasi</a></li>
                            <li><a href="{{ route('menus.index') }}" class="text-white text-decoration-none hover:text-cream-bg transition">Menu</a></li>
                            <li><a href="{{ route('mejas.index') }}" class="text-white text-decoration-none hover:text-cream-bg transition">Meja</a></li>
                        </ul>
                    </div>

                    <!-- Column 2: Branding -->
                    <div class="col-span-1 md:col-span-6 text-center">
                        <div class="relative mb-4 pt-12">
                            <i class="bi bi-cup-hot-fill absolute top-0 left-1/2 -translate-x-1/2" style="font-size: 2.5rem;"></i>
                            <h2 class="fw-bold mb-2">Panel Admin</h2>
                            <p class="small opacity-75">Warkop Pamulang Management</p>
                        </div>
                    </div>

                    <!-- Column 3: Alamat & Support -->
                    <div class="col-span-1 md:col-span-3 text-center md:text-right">
                        <h5 class="fw-bold mb-3">Alamat & Support</h5>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <a href="https://maps.app.goo.gl/NJNd3rnqHpyWFJQP7" target="_blank" class="inline-flex items-start gap-2 text-decoration-none text-white hover:text-cream-bg transition">
                                    <span class="small text-right max-w-[200px]">Jl. Raya Puspitek No.31, Buaran, Serpong, Tangsel</span>
                                    <i class="bi bi-geo-alt-fill flex-shrink-0"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr style="border-top: 1px solid rgba(255, 255, 255, 0.1); margin: 40px 0 25px;">
                <div class="text-center">
                    <p class="mb-0 opacity-50 small">Copyright &copy; 2026 Warkop Pamulang - Admin Panel</p>
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

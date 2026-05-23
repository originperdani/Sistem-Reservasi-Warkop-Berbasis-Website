<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=1200">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
             @import url(https://db.onlinewebfonts.com/c/515d706c09a027aff7369b0cabd4c7aa?family=Nagoda);
             @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap');
         </style>
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
            html, body {
                margin: 0;
                padding: 0;
                height: 100%;
            }
            body {
                min-width: 1200px;
                width: 100%;
                overflow-x: hidden;
                display: flex;
                flex-direction: column;
                align-items: center;
                font-family: 'Lucida Bright', 'Lucida Serif', 'Georgia', serif !important;
            }
            body :not(input):not(textarea):not(select):not(option):not([contenteditable="true"]):not([contenteditable="plaintext-only"]) {
                caret-color: transparent;
            }
            h1, h2, h3, h4, h5, h6, p, span, a, button, img, i {
                -webkit-user-select: none;
                user-select: none;
            }
            img {
                -webkit-user-drag: none;
            }
            input, textarea, select, option, [contenteditable="true"], [contenteditable="plaintext-only"] {
                -webkit-user-select: text;
                user-select: text;
                caret-color: auto;
            }
            
            h1, h2, h3, h4, h5, h6 {
                font-family: 'Nagoda', sans-serif !important;
            }
            .main-content {
                flex: 1 0 auto;
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                position: relative;
            }
            .container, .max-w-7xl, .max-w-\[1200px\] {
                max-width: 1200px !important;
                width: 1200px !important;
                margin-left: auto;
                margin-right: auto;
            }
            
            /* Responsive Font scaling */
            @media (max-width: 1199px) {
                html { font-size: 14px; }
            }
            @media (max-width: 768px) {
                html { font-size: 12px; }
                .container, .max-w-7xl {
                    padding-left: 1rem;
                    padding-right: 1rem;
                }
            }
            :root {
                --primary-red: #9B1B30;
                --secondary-red: #7A1526;
                --cream-bg: #F5E6D3;
                --cream-light: #FEFBF6;
                --header-gradient: linear-gradient(135deg, var(--primary-red) 0%, var(--secondary-red) 100%);
            }
            .footer {
                flex-shrink: 0;
                width: 100%;
                background: linear-gradient(135deg, var(--primary-red) 0%, var(--secondary-red) 100%);
                padding: 80px 0 30px;
                position: relative;
                color: white !important;
                z-index: 10;
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
    <body class="font-sans antialiased bg-warkop-cream-light text-[#4A1E1B]">
        <div class="main-content bg-transparent">
            <div class="blob" style="top: -10%; left: -10%;"></div>
            <div class="blob" style="top: 40%; right: -10%; background: var(--cream-bg); opacity: 0.15;"></div>
            <div class="blob" style="bottom: -10%; left: 20%;"></div>
            
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-warkop-red/10">
                    <div class="max-w-[1200px] mx-auto py-6 px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <footer class="footer">
            <div class="max-w-[1200px] mx-auto px-8">
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

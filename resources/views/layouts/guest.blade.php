<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=1200">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <style>
            @import url(https://db.onlinewebfonts.com/c/515d706c09a027aff7369b0cabd4c7aa?family=Nagoda);
            @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap');
        </style>

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'warkop-red': '#9B1B30',
                        'warkop-red-dark': '#7A1526',
                        'warkop-cream': '#F5E6D3',
                        'warkop-cream-light': '#FEFBF6',
                    }
                }
            }
        }

        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
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
                display: flex;
                flex-direction: column;
                align-items: center;
                overflow-x: hidden;
                font-family: 'Lucida Bright', 'Lucida Serif', 'Georgia', serif;
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
            .bg-warkop-login {
                background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), 
                            url('https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&q=80&w=1200');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen w-full flex flex-col justify-center items-center bg-warkop-login py-12">
            <div class="w-full max-w-[1200px] flex flex-col items-center">
                <div class="w-full max-w-md space-y-4">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/20 backdrop-blur-md mb-2 shadow-2xl border border-white/30">
                            <i class="bi bi-cup-hot-fill text-3xl text-white"></i>
                        </div>
                        <h2 class="text-3xl font-extrabold text-white tracking-tight drop-shadow-lg">Warkop Pamulang</h2>
                        <p class="text-[10px] text-white/90 font-medium uppercase tracking-[0.2em] drop-shadow-md">Premium Coffee & Meals</p>
                    </div>

                    <div class="glass-card p-6 shadow-2xl rounded-[30px]">
                        {{ $slot }}
                    </div>

                    <div class="text-center mt-2">
                        <a href="{{ route('home') }}" class="text-white hover:text-white/80 transition-colors text-xs flex items-center justify-center gap-1 drop-shadow-md font-medium">
                            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

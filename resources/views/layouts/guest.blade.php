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
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

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
            body {
                font-family: 'Poppins', sans-serif;
            }
            .bg-warkop-login {
                background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=1600');
                background-size: cover;
                background-position: center;
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
        </style>
    </head>
    <body class="antialiased overflow-hidden">
        <div class="h-screen w-screen flex flex-col justify-center items-center bg-warkop-login px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-md space-y-4">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/20 backdrop-blur-md mb-2 shadow-2xl">
                        <i class="bi bi-cup-hot-fill text-3xl text-white"></i>
                    </div>
                    <h2 class="text-3xl font-extrabold text-white tracking-tight">Warkop Pamulang</h2>
                    <p class="text-[10px] text-white/80 font-medium uppercase tracking-[0.2em]">Premium Coffee & Meals</p>
                </div>

                <div class="glass-card p-6 shadow-2xl rounded-[30px]">
                    {{ $slot }}
                </div>

                <div class="text-center mt-2">
                    <a href="{{ route('home') }}" class="text-white/70 hover:text-white transition-colors text-xs flex items-center justify-center gap-1">
                        <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>

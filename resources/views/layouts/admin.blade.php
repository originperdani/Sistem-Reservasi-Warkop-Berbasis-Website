<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Admin') }} - Admin Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'warkop-red': '#9B1B30',
                        'warkop-red-dark': '#7A1526',
                        'warkop-red-deep': '#4A0D17',
                        'premium-bg': '#F8FAFC',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #F8FAFC;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #1E293B;
        }

        /* Sidebar Styling based on Image 2 */
        .sidebar-container {
            background-color: #9B1B30; /* Red color scheme */
            width: 280px;
            height: 100%;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 50;
        }

        .sidebar-item {
            position: relative;
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 2rem;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none !important;
        }

        .sidebar-item:hover {
            color: white;
            background: rgba(255, 255, 255, 0.05);
        }

        /* Curved Active Indicator Effect */
        .sidebar-item.active {
            color: #9B1B30 !important;
            background-color: #F8FAFC; /* Matches main content bg */
            border-radius: 40px 0 0 40px;
            margin-left: 1rem;
        }

        /* The curve top/bottom for active item */
        .sidebar-item.active::before,
        .sidebar-item.active::after {
            content: "";
            position: absolute;
            right: 0;
            width: 40px;
            height: 40px;
            background-color: transparent;
            pointer-events: none;
        }

        .sidebar-item.active::before {
            top: -40px;
            border-radius: 0 0 40px 0;
            box-shadow: 20px 20px 0 20px #F8FAFC;
        }

        .sidebar-item.active::after {
            bottom: -40px;
            border-radius: 0 40px 0 0;
            box-shadow: 20px -20px 0 20px #F8FAFC;
        }

        /* Improved Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        .main-content {
            flex: 1;
            height: 100%;
            overflow-y: auto;
            background-color: #F8FAFC;
        }

        .top-nav {
            height: 80px;
            background: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 3rem;
            position: sticky;
            top: 0;
            z-index: 40;
        }
    </style>
</head>
<body class="antialiased h-full">
    <div class="flex h-full overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar-container overflow-hidden flex flex-col">
            <!-- Profile Section (Top) -->
            <div class="p-8 flex flex-col items-center border-b border-white/10 mb-6">
                <div class="relative mb-4">
                    <div class="w-20 h-20 rounded-full border-2 border-white/30 p-1">
                        <img src="{{ Auth::user()->getProfilePhotoUrl() }}" 
                             alt="Profile" 
                             class="w-full h-full rounded-full object-cover">
                    </div>
                </div>
                <h3 class="text-white font-bold text-center text-lg leading-tight">{{ Auth::user()->name }}</h3>
                <p class="text-white/50 text-[11px] font-medium text-center mt-1 break-all px-4">{{ Auth::user()->email }}</p>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto custom-scrollbar space-y-1 py-4">
                <a href="{{ route('admin.dashboard') }}" 
                   class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill text-xl"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('admin.reservasis') }}" 
                   class="sidebar-item {{ request()->routeIs('admin.reservasis') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check-fill text-xl"></i>
                    <span>Reservasi</span>
                </a>

                <a href="{{ route('menus.index') }}" 
                   class="sidebar-item {{ request()->routeIs('menus.*') ? 'active' : '' }}">
                    <i class="bi bi-cup-straw text-xl"></i>
                    <span>Menu Warkop</span>
                </a>

                <a href="{{ route('mejas.index') }}" 
                   class="sidebar-item {{ request()->routeIs('mejas.*') ? 'active' : '' }}">
                    <i class="bi bi-door-closed-fill text-xl"></i>
                    <span>Kelola Meja</span>
                </a>

                <a href="{{ route('admin.laporan') }}" 
                   class="sidebar-item {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-bar-graph-fill text-xl"></i>
                    <span>Laporan</span>
                </a>

                <a href="{{ route('profile.edit') }}" 
                   class="sidebar-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="bi bi-gear-fill text-xl"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>

            <!-- Logout (Bottom) -->
            <div class="p-6 mt-auto border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="sidebar-item w-full text-left !p-4 hover:bg-white/10 rounded-xl">
                        <i class="bi bi-power text-xl"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Content Area -->
        <div class="flex-1 flex flex-col h-full overflow-hidden bg-[#F8FAFC]">
            <!-- Top Nav -->
            <header class="top-nav">
                <div class="flex items-center flex-1">
                    <h2 class="text-lg font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                </div>

                <div class="flex items-center gap-6">
                    {{-- Notification Bell --}}
                    @php
                        $pendingReservasis = \App\Models\Reservasi::where('status', 'pending')
                            ->with(['user', 'meja'])
                            ->orderBy('created_at', 'desc')
                            ->take(10)
                            ->get();
                        $pendingCount = $pendingReservasis->count();
                    @endphp
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="relative p-2 text-gray-400 hover:text-warkop-red transition-colors">
                            <i class="bi bi-bell text-xl"></i>
                            @if($pendingCount > 0)
                            <span class="absolute top-1 right-1 w-4 h-4 bg-rose-500 rounded-full border-2 border-white text-[8px] text-white font-black flex items-center justify-center">{{ $pendingCount }}</span>
                            @endif
                        </button>

                        {{-- Dropdown Panel --}}
                        <div x-show="open" 
                             @click.outside="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                             x-cloak
                             class="absolute right-0 top-14 w-96 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-50">
                            
                            {{-- Header --}}
                            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 bg-warkop-red/10 rounded-lg flex items-center justify-center">
                                        <i class="bi bi-bell-fill text-warkop-red text-sm"></i>
                                    </div>
                                    <span class="font-bold text-gray-900 text-sm">Notifikasi</span>
                                </div>
                                @if($pendingCount > 0)
                                <span class="px-2 py-0.5 bg-rose-100 text-rose-600 text-[10px] font-black rounded-full">{{ $pendingCount }} baru</span>
                                @endif
                            </div>

                            {{-- Notification List --}}
                            <div class="max-h-80 overflow-y-auto">
                                @if($pendingCount > 0)
                                    @foreach($pendingReservasis as $notif)
                                    <a href="{{ route('admin.reservasis') }}" class="block px-5 py-3.5 hover:bg-gray-50 transition-colors border-b border-gray-50">
                                        <div class="flex items-start gap-3">
                                            <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                                <i class="bi bi-calendar-plus text-amber-600 text-sm"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-xs font-bold text-gray-900 truncate">
                                                    {{ $notif->user->name }} — Reservasi Baru
                                                </p>
                                                <p class="text-[11px] text-gray-500 mt-0.5">
                                                    {{ $notif->meja->nama_meja }} · {{ $notif->tanggal->format('d M Y') }} · {{ $notif->waktu }}
                                                </p>
                                                <p class="text-[10px] text-gray-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                                            </div>
                                            <span class="px-2 py-0.5 bg-amber-100 text-amber-700 text-[9px] font-black rounded-full uppercase flex-shrink-0">Pending</span>
                                        </div>
                                    </a>
                                    @endforeach
                                @else
                                    <div class="px-5 py-10 text-center">
                                        <i class="bi bi-check-circle text-3xl text-gray-200"></i>
                                        <p class="text-xs text-gray-400 font-medium mt-2">Tidak ada reservasi menunggu</p>
                                    </div>
                                @endif
                            </div>

                            {{-- Footer --}}
                            @if($pendingCount > 0)
                            <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/50">
                                <a href="{{ route('admin.reservasis') }}" class="text-xs font-bold text-warkop-red hover:underline flex items-center justify-center gap-1">
                                    Lihat Semua Reservasi <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 pl-4 border-l border-gray-100">
                        <div class="text-right">
                            <p class="text-xs font-bold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Admin</p>
                        </div>
                        <img src="{{ Auth::user()->getProfilePhotoUrl() }}" 
                             class="w-10 h-10 rounded-xl shadow-sm object-cover">
                    </div>
                </div>
            </header>

            <!-- Main Page Content -->
            <main class="main-content custom-scrollbar p-10">
                @if (isset($header))
                    <div class="mb-10" data-aos="fade-up">
                        {{ $header }}
                    </div>
                @endif

                <div class="animate-fade-in">
                    {{ $slot }}
                </div>

                <!-- Footer Section -->
                <div class="mt-20 pt-10 border-t border-gray-100">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-warkop-red rounded-lg flex items-center justify-center text-white text-xs">
                                <i class="bi bi-cup-hot-fill"></i>
                            </div>
                            <span class="font-serif font-black text-gray-900 tracking-tight">WARKOP <span class="text-warkop-red">PAMULANG</span></span>
                        </div>
                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                            &copy; {{ date('Y') }} Premium Management System &bull; All Rights Reserved
                        </div>
                        <div class="flex gap-4">
                            <a href="#" class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:text-warkop-red hover:bg-warkop-red/5 transition-all">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:text-warkop-red hover:bg-warkop-red/5 transition-all">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-cubic'
        });
    </script>
    @stack('scripts')
</body>
</html>

<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-xl border-b border-warkop-red/5 sticky top-0 z-50 w-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-[1200px] mx-auto px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <i class="bi bi-cup-hot-fill text-2xl text-warkop-red"></i>
                        <span class="font-black text-xl tracking-tight text-gray-900">WARKOP <span class="text-warkop-red">PAMULANG</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="space-x-8 -my-px ms-10 flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('admin.dashboard')" class="font-semibold transition-colors duration-200">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    @if(auth()->user()->role == 'admin')
                        <x-nav-link :href="route('admin.reservasis')" :active="request()->routeIs('admin.reservasis')" class="font-semibold transition-colors duration-200">
                            {{ __('Reservasi') }}
                        </x-nav-link>
                        <x-nav-link :href="route('menus.index')" :active="request()->routeIs('menus.*')" class="font-semibold transition-colors duration-200">
                            {{ __('Menu') }}
                        </x-nav-link>
                        <x-nav-link :href="route('mejas.index')" :active="request()->routeIs('mejas.*')" class="font-semibold transition-colors duration-200">
                            {{ __('Meja') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="flex items-center ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-warkop-red/10 text-sm leading-4 font-bold rounded-full text-gray-700 bg-white/50 hover:bg-white hover:text-warkop-red focus:outline-none transition ease-in-out duration-200">
                            <div class="flex items-center gap-2">
                                <i class="bi bi-person-circle text-lg"></i>
                                {{ Auth::user()->name }}
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="bi bi-person-circle me-2"></i> {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="text-rose-600">
                                <i class="bi bi-box-arrow-right me-2"></i> {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
    </div>
</nav>

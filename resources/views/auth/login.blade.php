<x-guest-layout>
    <div class="mb-4 text-center">
        <h3 class="text-2xl font-bold text-warkop-red">User Login</h3>
        <p class="text-gray-500 text-xs mt-1">Silakan masuk ke akun Anda</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-2" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="bi bi-person text-warkop-red text-lg"></i>
            </div>
            <input id="email" 
                class="block w-full pl-10 pr-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-warkop-red/20 transition duration-300 placeholder-gray-400 text-sm font-medium" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                placeholder="Username / Email"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="bi bi-lock text-warkop-red text-lg"></i>
            </div>
            <input id="password" 
                class="block w-full pl-10 pr-12 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-warkop-red/20 transition duration-300 placeholder-gray-400 text-sm font-medium"
                type="password"
                name="password"
                placeholder="Password"
                required autocomplete="current-password" />
            <button type="button" onclick="togglePassword('password', 'password-icon')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-warkop-red transition-colors">
                <i id="password-icon" class="bi bi-eye"></i>
            </button>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-warkop-red shadow-sm focus:ring-warkop-red/20 w-4 h-4" name="remember">
                <span class="ms-2 text-xs text-gray-600 font-medium">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-warkop-red hover:text-warkop-red-dark font-semibold transition" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div>
            <button type="submit" class="w-full bg-gradient-to-r from-warkop-red to-warkop-red-dark text-white py-3 rounded-xl font-bold text-base shadow-lg hover:scale-[1.01] active:scale-95 transition-all duration-300 uppercase tracking-wider">
                Sign In
            </button>
        </div>

        <div class="text-center pt-2">
            <p class="text-xs text-gray-500 font-medium">Belum punya akun? 
                <a href="{{ route('register') }}" class="text-warkop-red hover:underline font-bold">Daftar Sekarang</a>
            </p>
        </div>
    </form>
</x-guest-layout>

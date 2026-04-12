<x-guest-layout>
    <div class="mb-4 text-center">
        <h3 class="text-2xl font-bold text-warkop-red">Daftar Akun</h3>
        <p class="text-gray-500 text-xs mt-1">Bergabunglah dengan Warkop Pamulang</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-3">
        @csrf

        <!-- Name -->
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="bi bi-person-badge text-warkop-red text-lg"></i>
            </div>
            <input id="name" 
                class="block w-full pl-10 pr-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-warkop-red/20 transition duration-300 placeholder-gray-400 text-sm font-medium" 
                type="text" 
                name="name" 
                value="{{ old('name') }}" 
                placeholder="Nama Lengkap"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="bi bi-envelope text-warkop-red text-lg"></i>
            </div>
            <input id="email" 
                class="block w-full pl-10 pr-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-warkop-red/20 transition duration-300 placeholder-gray-400 text-sm font-medium" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                placeholder="Alamat Email"
                required autocomplete="username" />
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
                required autocomplete="new-password" />
            <button type="button" onclick="togglePassword('password', 'password-icon')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-warkop-red transition-colors">
                <i id="password-icon" class="bi bi-eye"></i>
            </button>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="bi bi-lock-check text-warkop-red text-lg"></i>
            </div>
            <input id="password_confirmation" 
                class="block w-full pl-10 pr-12 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-warkop-red/20 transition duration-300 placeholder-gray-400 text-sm font-medium"
                type="password"
                name="password_confirmation"
                placeholder="Konfirmasi Password"
                required autocomplete="new-password" />
            <button type="button" onclick="togglePassword('password_confirmation', 'confirm-password-icon')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-warkop-red transition-colors">
                <i id="confirm-password-icon" class="bi bi-eye"></i>
            </button>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-gradient-to-r from-warkop-red to-warkop-red-dark text-white py-3 rounded-xl font-bold text-base shadow-lg hover:scale-[1.01] active:scale-95 transition-all duration-300 uppercase tracking-wider">
                Daftar Sekarang
            </button>
        </div>

        <div class="text-center pt-2">
            <p class="text-xs text-gray-500 font-medium">Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-warkop-red hover:underline font-bold">Masuk di sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>

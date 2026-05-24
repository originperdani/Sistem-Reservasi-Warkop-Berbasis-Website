<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-black text-gray-900 mb-2">Pengaturan Profil</h1>
        <p class="text-gray-500 font-medium">Kelola informasi akun dan keamanan administrator.</p>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column: Photo --}}
        <div class="lg:col-span-1">
            <div class="glass-card premium-shadow p-6 text-center" data-aos="fade-up">
                <div class="relative inline-block mb-4">
                    <img src="{{ $user->getProfilePhotoUrl() }}" 
                         id="photoPreview"
                         class="w-28 h-28 rounded-2xl object-cover shadow-lg border-4 border-white">
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-warkop-red rounded-xl flex items-center justify-center text-white shadow-lg cursor-pointer hover:bg-warkop-red-dark transition-all"
                         onclick="document.getElementById('photoInput').click()">
                        <i class="bi bi-camera-fill text-xs"></i>
                    </div>
                </div>
                <h3 class="font-bold text-gray-900">{{ $user->name }}</h3>
                <p class="text-xs text-gray-400 font-medium">{{ $user->email }}</p>
                <span class="inline-block mt-2 px-3 py-1 bg-warkop-red/10 text-warkop-red text-[10px] font-black rounded-full uppercase tracking-wider">Administrator</span>

                <form method="POST" action="{{ route('profile.photo') }}" enctype="multipart/form-data" id="photoForm" class="mt-4">
                    @csrf
                    <input type="file" id="photoInput" name="profile_photo" accept="image/*" class="hidden" onchange="previewAndSubmit(this)">
                    <p class="text-[10px] text-gray-400">Klik ikon kamera untuk ganti foto.<br>Max 2MB (JPG, PNG, WebP)</p>
                    @if($errors->has('profile_photo'))
                        <p class="text-xs text-rose-500 font-bold mt-2">{{ $errors->first('profile_photo') }}</p>
                    @endif
                    @if (session('status') === 'photo-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" 
                           class="text-xs text-emerald-600 font-bold mt-2 flex items-center justify-center gap-1">
                            <i class="bi bi-check-circle-fill"></i> Foto diperbarui!
                        </p>
                    @endif
                </form>
            </div>
        </div>

        {{-- Right Column: Forms --}}
        <div class="lg:col-span-2 space-y-5">
            {{-- Profile Info --}}
            <div class="glass-card premium-shadow border-l-4 border-warkop-red p-6" data-aos="fade-up">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-9 h-9 bg-warkop-red/10 rounded-xl flex items-center justify-center text-warkop-red">
                        <i class="bi bi-person-badge-fill text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-black text-gray-900">Informasi Profil</h2>
                        <p class="text-[11px] text-gray-400 font-medium">Perbarui nama dan email akun Anda.</p>
                    </div>
                </div>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf
                    @method('patch')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1 block mb-1">Nama Lengkap</label>
                            <input id="name" name="name" type="text" 
                                   class="w-full rounded-xl border-none bg-gray-50 focus:ring-2 focus:ring-warkop-red/20 py-3 px-4 font-bold text-sm text-gray-900 transition-all" 
                                   value="{{ old('name', $user->name) }}" required autofocus>
                            <x-input-error class="mt-1" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1 block mb-1">Alamat Email</label>
                            <input id="email" name="email" type="email" 
                                   class="w-full rounded-xl border-none bg-gray-50 focus:ring-2 focus:ring-warkop-red/20 py-3 px-4 font-bold text-sm text-gray-900 transition-all" 
                                   value="{{ old('email', $user->email) }}" required>
                            <x-input-error class="mt-1" :messages="$errors->get('email')" />
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" class="px-4 py-2 bg-warkop-red text-white rounded-lg font-bold shadow-sm hover:bg-warkop-red-dark transition-all text-[11px]">
                            Simpan
                        </button>
                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" 
                               class="text-xs text-emerald-600 font-black flex items-center gap-1">
                                <i class="bi bi-check-circle-fill"></i> Tersimpan.
                            </p>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Password --}}
            <div class="glass-card premium-shadow border-l-4 border-warkop-red p-6" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-9 h-9 bg-warkop-red/10 rounded-xl flex items-center justify-center text-warkop-red">
                        <i class="bi bi-shield-lock-fill text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-black text-gray-900">Keamanan Akun</h2>
                        <p class="text-[11px] text-gray-400 font-medium">Gunakan kata sandi yang kuat.</p>
                    </div>
                </div>

                <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                    @csrf
                    @method('put')

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1 block mb-1">Kata Sandi Saat Ini</label>
                        <input id="current_password" name="current_password" type="password" 
                               class="w-full rounded-xl border-none bg-gray-50 focus:ring-2 focus:ring-warkop-red/20 py-3 px-4 font-bold text-sm text-gray-900 transition-all" 
                               autocomplete="current-password">
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1 block mb-1">Kata Sandi Baru</label>
                            <input id="password" name="password" type="password" 
                                   class="w-full rounded-xl border-none bg-gray-50 focus:ring-2 focus:ring-warkop-red/20 py-3 px-4 font-bold text-sm text-gray-900 transition-all" 
                                   autocomplete="new-password">
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1 block mb-1">Konfirmasi Sandi</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" 
                                   class="w-full rounded-xl border-none bg-gray-50 focus:ring-2 focus:ring-warkop-red/20 py-3 px-4 font-bold text-sm text-gray-900 transition-all" 
                                   autocomplete="new-password">
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1" />
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" class="px-6 py-3 bg-warkop-red text-white rounded-xl font-black shadow-sm hover:bg-warkop-red-dark transition-all text-xs uppercase tracking-widest">
                            Perbarui Sandi
                        </button>
                        @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" 
                               class="text-xs text-emerald-600 font-black flex items-center gap-1">
                                <i class="bi bi-check-circle-fill"></i> Diperbarui.
                            </p>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Danger Zone --}}
            <div class="glass-card premium-shadow border-l-4 border-rose-400 p-6 bg-rose-50/20" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-rose-100 rounded-xl flex items-center justify-center text-rose-500">
                            <i class="bi bi-exclamation-triangle-fill text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-black text-gray-900">Zona Bahaya</h2>
                            <p class="text-[11px] text-gray-400 font-medium">Akun akan dihapus permanen.</p>
                        </div>
                    </div>
                    <button class="px-5 py-2.5 bg-white border-2 border-rose-200 text-rose-600 rounded-xl font-black hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all text-[10px] uppercase tracking-widest"
                            x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                        Hapus Akun
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Confirmation Modal --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-8 bg-white rounded-2xl">
            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-5">
                @csrf
                @method('delete')

                <h2 class="text-2xl font-black text-gray-900">Hapus Akun Permanen?</h2>
                <p class="text-sm text-gray-500">Masukkan kata sandi untuk mengonfirmasi.</p>

                <div>
                    <input id="delete_password" name="password" type="password" 
                           class="w-full rounded-xl border-none bg-gray-50 focus:ring-2 focus:ring-rose-500/20 py-3 px-4 font-bold text-gray-900" 
                           placeholder="Kata sandi Anda">
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1" />
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-black hover:bg-gray-200 transition-all text-xs uppercase tracking-widest">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-3 bg-rose-600 text-white rounded-xl font-black hover:bg-rose-700 transition-all text-xs uppercase tracking-widest">
                        Hapus Sekarang
                    </button>
                </div>
            </form>
        </div>
    </x-modal>

    @push('scripts')
    <script>
        function previewAndSubmit(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('photoPreview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
                // Auto submit after short delay for preview
                setTimeout(() => {
                    document.getElementById('photoForm').submit();
                }, 500);
            }
        }
    </script>
    @endpush
</x-admin-layout>

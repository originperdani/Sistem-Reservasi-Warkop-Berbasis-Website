<section>
    <header class="mb-4">
        <h4 class="fw-bold text-dark flex items-center">
            <i class="bi bi-info-circle me-2 text-custom-red"></i> {{ __('Informasi Profil') }}
        </h4>
        <p class="text-muted small mb-0">
            {{ __("Perbarui informasi profil akun dan alamat email Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-4">
            <label class="form-label">Nama Lengkap</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mb-4">
            <label class="form-label">Alamat Email</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-light rounded-3 border border-warning-subtle">
                    <p class="text-sm text-dark mb-2">
                        {{ __('Alamat email Anda belum diverifikasi.') }}
                    </p>
                    <button form="send-verification" class="btn btn-sm btn-link text-decoration-none p-0 text-custom-red fw-bold">
                        {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 fw-bold text-sm text-success">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-custom-red px-5 py-2 rounded-pill font-bold shadow-sm">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-success fw-bold"
                ><i class="bi bi-check-circle me-1"></i> {{ __('Tersimpan.') }}</span>
            @endif
        </div>
    </form>
</section>

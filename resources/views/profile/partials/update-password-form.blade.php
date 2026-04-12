<section>
    <header class="mb-4">
        <h4 class="fw-bold text-dark flex items-center">
            <i class="bi bi-shield-lock me-2 text-custom-red"></i> {{ __('Perbarui Kata Sandi') }}
        </h4>
        <p class="text-muted small mb-0">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-4">
            <label class="form-label">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger small" />
        </div>

        <div class="mb-4">
            <label class="form-label">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger small" />
        </div>

        <div class="mb-4">
            <label class="form-label">Konfirmasi Kata Sandi Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger small" />
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-custom-red px-5 py-2 rounded-pill font-bold shadow-sm">
                {{ __('Ganti Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-success fw-bold"
                ><i class="bi bi-check-circle me-1"></i> {{ __('Berhasil Diperbarui.') }}</span>
            @endif
        </div>
    </form>
</section>

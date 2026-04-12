<section>
    <header class="mb-4">
        <h4 class="fw-bold text-danger flex items-center">
            <i class="bi bi-exclamation-triangle me-2"></i> {{ __('Hapus Akun') }}
        </h4>
        <p class="text-muted small mb-0">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.') }}
        </p>
    </header>

    <button 
        class="btn btn-outline-danger px-4 py-2 rounded-pill font-bold transition shadow-sm"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Hapus Akun') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-5 bg-white rounded-4 border-0">
            @csrf
            @method('delete')

            <h4 class="fw-bold text-dark mb-3">
                {{ __('Apakah Anda yakin ingin menghapus akun?') }}
            </h4>

            <p class="text-muted small mb-4">
                {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Harap masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun secara permanen.') }}
            </p>

            <div class="mb-4">
                <label class="form-label">Kata Sandi Konfirmasi</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control"
                    placeholder="{{ __('Kata Sandi') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-danger small" />
            </div>

            <div class="d-flex justify-content-end gap-3">
                <button type="button" class="btn btn-light px-4 py-2 rounded-pill font-bold" x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </button>

                <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill font-bold shadow-sm">
                    {{ __('Hapus Akun Permanen') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>

<x-guest-layout>
    <div class="text-center mb-4">
        <h2 class="fw-bold mb-2" style="background: linear-gradient(135deg, #4A90E2 0%, #56CCF2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            Daftar TemuKost
        </h2>
        <p class="text-muted">Mulai cari kost impianmu</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" 
                   class="form-control form-control-lg" required autofocus>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" 
                   class="form-control form-control-lg" required>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mb-3">
            <label for="role" class="form-label fw-semibold">Daftar sebagai</label>
            <select id="role" name="role" class="form-select form-select-lg" required>
                <option value="seeker" {{ old('role') == 'seeker' ? 'selected' : '' }}>
                    Pencari Kost
                </option>
                <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>
                    Pemilik Kost
                </option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input id="password" type="password" name="password" 
                   class="form-control form-control-lg" required>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" 
                   class="form-control form-control-lg" required>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Actions -->
        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
            Daftar Sekarang
        </button>

        <div class="text-center">
            <span class="text-muted">Sudah punya akun?</span>
            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Masuk</a>
        </div>
    </form>
</x-guest-layout>
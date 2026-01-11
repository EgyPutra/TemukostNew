<x-guest-layout>
    <div class="text-center mb-4">
        <h2 class="fw-bold mb-2" style="background: linear-gradient(135deg, #4A90E2 0%, #56CCF2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            Masuk ke TemuKost
        </h2>
        <p class="text-muted">Temukan kost impianmu di Bali</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" 
                   class="form-control form-control-lg" required autofocus autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input id="password" type="password" name="password" 
                   class="form-control form-control-lg" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
            <label for="remember_me" class="form-check-label">
                Ingat saya
            </label>
        </div>

        <!-- Actions -->
        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none">
                    Lupa password?
                </a>
            @endif

            <button type="submit" class="btn btn-primary btn-lg px-5">
                Masuk
            </button>
        </div>

        <div class="text-center mt-3">
            <span class="text-muted">Belum punya akun?</span>
            <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Daftar</a>
        </div>
    </form>
</x-guest-layout>
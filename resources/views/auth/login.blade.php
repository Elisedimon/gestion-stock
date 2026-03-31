<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-3" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="vous@exemple.com"
                   required
                   autofocus
                   autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password"
                   type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="••••••••"
                   required
                   autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me + Forgot -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                <label class="form-check-label" for="remember_me">
                    Remember me
                </label>
            </div>
            @if (Route::has('password.request'))
                <a class="forgot-link" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-login">
            <i class="fas fa-sign-in-alt me-2"></i> Se connecter
        </button>
    </form>
</x-guest-layout>

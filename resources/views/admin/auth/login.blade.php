<x-admin-guest-layout :title="'Inqilab Admin Login'">
    <section class="authentication-background">
        <!-- Logo -->
        <div class="mb-5 text-center">
            <a href="{{ route('admin.dashboard') }}">
                <img alt="Logo"
                    src="{{ !empty($site->site_logo) && file_exists(public_path('storage/settings/' . $site->site_logo))
                        ? asset('storage/settings/' . $site->site_logo)
                        : asset('images/logo.webp') }}"
                    class="h-60px logo w-200px">
            </a>
        </div>

        <!-- Login Card -->
        <div class="shadow-sm signin-card">
            <!-- Heading -->
            <h2 class="mb-0">Welcome Back</h2>
            <p class="pt-2 para">
                Please log in to access your account and explore all features.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Login Form -->
            <form class="pt-5 form" action="{{ route('admin.login') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <x-metronic.label for="email" class="form-label fw-semibold">
                        {{ __('Email') }}
                    </x-metronic.label>
                    <x-metronic.input type="email" name="email" id="email" class="form-control"
                        placeholder="Enter your email" required value="{{ old('email') }}" autocomplete="off" />
                </div>

                <!-- Password -->
                <div class="mb-3 position-relative">
                    <x-metronic.label for="passwordField" class="form-label fw-semibold">
                        {{ __('Password') }}
                    </x-metronic.label>

                    <x-metronic.input type="password" name="password" id="passwordField" class="form-control pe-5"
                        placeholder="Enter password" required />

                    <!-- Eye icon button -->
                    <button type="button"
                        class="btn btn-sm btn-link position-absolute end-0 translate-middle-y me-2 eye-btn"
                        onclick="togglePasswordVisibility()" style="z-index: 2">
                        <i id="eyeIcon" class="bi bi-eye-slash fs-5 text-muted"></i>
                    </button>
                </div>


                <!-- Remember Me & Forgot Password -->
                <div class="py-5 d-flex justify-content-between align-items-center">
                    <div class="mb-0 form-check">
                        <input type="checkbox" class="form-check-input remember-me" id="remember_me" name="remember" />
                        <x-metronic.label class="form-check-label" for="remember_me">
                            {{ __('Remember me') }}
                        </x-metronic.label>
                    </div>

                    @if (Route::has('admin.password.request'))
                        <a href="{{ route('admin.password.request') }}" class="text-decoration-none">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <x-metronic.button type="submit" class="py-3 btn btn-danger w-100">
                    {{ __('Login Now') }}
                </x-metronic.button>
            </form>
        </div>
    </section>

    @push('scripts')
        <script>
            function togglePasswordVisibility() {
                const passwordField = document.getElementById('passwordField');
                const eyeIcon = document.getElementById('eyeIcon');
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
                } else {
                    passwordField.type = 'password';
                    eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
                }
            }
        </script>
    @endpush
</x-admin-guest-layout>

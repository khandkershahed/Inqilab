<x-admin-guest-layout :title="'Inqilab Admin Login'">
    <section class="authentication-background">
        <canvas id="snowCanvas"
            style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; pointer-events: none;"></canvas>
        <!-- Logo -->
        <div class="login-form">
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
                <div class="text-center">
                    <h2 class="mb-0">Welcome Back</h2>
                    <p class="pt-2 para">
                        Please log in to access your account and explore all features.
                    </p>
                </div>

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
                            <input type="checkbox" class="form-check-input remember-me" id="remember_me"
                                name="remember" />
                            <x-metronic.label class="form-check-label" for="remember_me">
                                {{ __('Remember me') }}
                            </x-metronic.label>
                        </div>

                        {{-- @if (Route::has('admin.password.request'))
                        <a href="{{ route('admin.password.request') }}" class="text-decoration-none">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif --}}
                    </div>

                    <!-- Submit Button -->
                    <x-metronic.button type="submit" class="py-3 btn btn-success w-100">
                        {{ __('Login Now') }}
                    </x-metronic.button>
                </form>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Green snow particles using requestAnimationFrame
            const canvas = document.getElementById('snowCanvas');
            const ctx = canvas.getContext('2d');
            let particles = [];

            function resizeCanvas() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            }

            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();

            // Create particles
            for (let i = 0; i < 250; i++) {
                particles.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    r: Math.random() * 3 + 1, // radius
                    d: Math.random() * 1 // density
                });
            }

            // Draw and update particles
            function draw() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.fillStyle = "#86e3b7";
                ctx.beginPath();

                particles.forEach(p => {
                    ctx.moveTo(p.x, p.y);
                    ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2, true);
                });

                ctx.fill();
                update();
            }

            function update() {
                for (let i = 0; i < particles.length; i++) {
                    let p = particles[i];
                    p.y += Math.cos(p.d) + 3 + Math.random() * 1; // fall speed
                    p.x += Math.sin(p.d) * 0.5; // sway

                    // Respawn at top if out of view
                    if (p.y > canvas.height) {
                        p.y = 0;
                        p.x = Math.random() * canvas.width;
                    }
                }
            }

            // Smooth animation
            function animate() {
                draw();
                requestAnimationFrame(animate);
            }

            animate();
        </script>

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

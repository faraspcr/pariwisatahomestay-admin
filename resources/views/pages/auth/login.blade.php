@extends('layouts.auth-app')
@section('content')
    <!-- Left Side - Branding with Carousel -->
    <div class="login-left">
        <!-- Carousel -->
        <div class="carousel">
            <div class="carousel-slide active" style="background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80')"></div>
            <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80')"></div>
            <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80')"></div>
            <div class="carousel-overlay"></div>
        </div>

        <!-- Carousel Controls -->
        <div class="carousel-controls">
            <button class="carousel-btn prev">❮</button>
            <div class="carousel-indicators">
                <div class="carousel-indicator active"></div>
                <div class="carousel-indicator"></div>
                <div class="carousel-indicator"></div>
            </div>
            <button class="carousel-btn next">❯</button>
        </div>

        <div class="brand-section">
            <div class="brand-logo">
                🏝️
            </div>
            <h1>PARIWISATA DESA</h1>
            <p>Selamat datang di sistem administrasi Pariwisata dan Homestay desa.</p>
        </div>

        <ul class="features">
            <li>Kelola data destinasi wisata</li>
            <li>Monitor booking homestay</li>
            <li>Kelola ulasan pengunjung</li>
            <li>Laporan statistik lengkap</li>
        </ul>
    </div>

    <!-- Right Side - Login Form -->
    <div class="login-right">
        <div class="login-header">
            <h2>Login Admin</h2>
            <p>Akses sistem pengelolaan pariwisata desa</p>
        </div>

        <!-- TAMBAHKAN: Flash messages dari Laravel -->
        @if(session('success'))
            <div class="flash-message flash-success" style="display: flex;">
                <i class="mdi mdi-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="flash-message flash-error" style="display: flex;">
                <i class="mdi mdi-alert-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Flash Message Area -->
        <div id="flashMessage" style="display: none;"></div>

        <!-- PERBAIKAN: Gunakan route 'login.submit' bukan 'auth.login.submit' -->
        <form id="loginForm" action="{{ route('login.submit') }}" method="POST">
            @csrf <!-- TAMBAHKAN: CSRF token -->
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-with-icon">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <input type="email"
                           name="email"
                           id="email"
                           class="form-control"
                           placeholder="Masukkan email"
                           value="{{ old('email') }}"
                           required>
                </div>
                <!-- Error dari JavaScript -->
                <div id="jsEmailError" class="error-message" style="display: none;"></div>
                <!-- Error dari Laravel -->
                @error('email')
                    <div id="laravelEmailError" class="error-message" style="display: flex;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-with-icon">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control"
                           placeholder="Masukkan password"
                           required>
                </div>
                <!-- Error dari JavaScript -->
                <div id="jsPasswordError" class="error-message" style="display: none;"></div>
                <!-- Error dari Laravel -->
                @error('password')
                    <div id="laravelPasswordError" class="error-message" style="display: flex;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">
                Login
            </button>
        </form>

        <div class="form-footer">
            <!-- PERBAIKAN: Gunakan route 'register' bukan 'auth.register' -->
            Belum punya akun? <a href="{{ route('register') }}" id="registerLink">Daftar di sini</a>
        </div>
    </div>

    <style>
        /* CSS untuk error states */
        .form-control.error {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
            align-items: center;
            gap: 0.5rem;
        }

        .flash-message {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.375rem;
            display: none;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
        }

        .flash-success {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .flash-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c2c7;
        }
    </style>

    <script>
        // FUNGSI UTAMA - VALIDASI JAVASCRIPT + LARAVEL
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');

            // 1. SAAT FORM DISUBMIT
            loginForm.addEventListener('submit', function(e) {
                console.log('Form submit triggered');

                // Reset error JavaScript dulu
                resetJSErrors();

                // Ambil nilai input
                const email = emailInput.value.trim();
                const password = passwordInput.value;

                let isValid = true;

                // 2. VALIDASI EMAIL (JavaScript)
                if (!email) {
                    showJSError('email', 'Email harus diisi');
                    isValid = false;
                } else if (!isValidEmail(email)) {
                    showJSError('email', 'Format email tidak valid');
                    isValid = false;
                }

                // 3. VALIDASI PASSWORD (JavaScript)
                if (!password) {
                    showJSError('password', 'Password harus diisi');
                    isValid = false;
                } else if (password.length < 6) {
                    showJSError('password', 'Password minimal 6 karakter');
                    isValid = false;
                }

                // 4. JIKA ADA ERROR DARI JAVASCRIPT, STOP SUBMIT
                if (!isValid) {
                    e.preventDefault(); // Hentikan submit
                    showFlashMessage('Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.', 'error');

                    // Scroll ke error pertama
                    const firstError = document.querySelector('.error-message[style*="display: flex"]');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                } else {
                    console.log('Form valid, submitting to Laravel...');
                    // Biarkan form submit ke Laravel
                    // Laravel akan handle validasi server-side
                }
            });

            // 5. SAAT USER MENGISI ULANG, HAPUS ERROR
            emailInput.addEventListener('input', function() {
                if (this.value.trim()) {
                    removeError('email');
                }
            });

            passwordInput.addEventListener('input', function() {
                if (this.value) {
                    removeError('password');
                }
            });

            // 6. FUNGSI VALIDASI EMAIL
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            // 7. FUNGSI TAMPILKAN ERROR JAVASCRIPT
            function showJSError(field, message) {
                const errorElement = document.getElementById(`js${capitalizeFirstLetter(field)}Error`);
                const inputElement = document.getElementById(field);

                if (errorElement && inputElement) {
                    errorElement.textContent = message;
                    errorElement.style.display = 'flex';
                    inputElement.classList.add('error');
                }
            }

            // 8. FUNGSI HAPUS ERROR
            function removeError(field) {
                const jsErrorElement = document.getElementById(`js${capitalizeFirstLetter(field)}Error`);
                const inputElement = document.getElementById(field);

                if (jsErrorElement) {
                    jsErrorElement.style.display = 'none';
                }
                if (inputElement) {
                    inputElement.classList.remove('error');
                }
            }

            // 9. FUNGSI RESET SEMUA ERROR JAVASCRIPT
            function resetJSErrors() {
                // Reset JavaScript errors
                document.querySelectorAll('[id^="js"]').forEach(element => {
                    if (element.id.includes('Error')) {
                        element.style.display = 'none';
                    }
                });

                // Reset error class pada input
                document.querySelectorAll('.form-control.error').forEach(input => {
                    input.classList.remove('error');
                });
            }

            // 10. FUNGSI TAMPILKAN FLASH MESSAGE
            function showFlashMessage(message, type) {
                const flashMessage = document.getElementById('flashMessage');
                if (flashMessage) {
                    flashMessage.textContent = message;
                    flashMessage.className = `flash-message flash-${type}`;
                    flashMessage.style.display = 'flex';

                    // Auto hide setelah 5 detik
                    setTimeout(() => {
                        flashMessage.style.display = 'none';
                    }, 5000);
                }
            }

            // 11. HELPER FUNCTION
            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            // 12. INISIALISASI CAROUSEL (jika ada)
            initCarousel();
        });

        // FUNGSI CAROUSEL
        function initCarousel() {
            const slides = document.querySelectorAll('.carousel-slide');
            const indicators = document.querySelectorAll('.carousel-indicator');
            const prevBtn = document.querySelector('.carousel-btn.prev');
            const nextBtn = document.querySelector('.carousel-btn.next');

            if (!slides.length) return;

            let currentSlide = 0;

            function showSlide(index) {
                // Reset semua slide
                slides.forEach(slide => slide.classList.remove('active'));
                indicators.forEach(indicator => indicator.classList.remove('active'));

                // Update index
                currentSlide = (index + slides.length) % slides.length;

                // Tampilkan slide aktif
                slides[currentSlide].classList.add('active');
                indicators[currentSlide].classList.add('active');
            }

            // Event listeners untuk tombol
            if (prevBtn) {
                prevBtn.addEventListener('click', () => showSlide(currentSlide - 1));
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', () => showSlide(currentSlide + 1));
            }

            // Event listeners untuk indicators
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => showSlide(index));
            });

            // Auto slide setiap 5 detik
            setInterval(() => {
                showSlide(currentSlide + 1);
            }, 5000);
        }
    </script>
@endsection

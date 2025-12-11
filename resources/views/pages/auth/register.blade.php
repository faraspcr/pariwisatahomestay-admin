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

    <!-- Right Side - Register Form -->
    <div class="login-right">
        <div class="login-header">
            <h2>Registrasi</h2>
            <p>Buat akun baru untuk mengakses dashboard</p>
        </div>

        <!-- Flash Message Area -->
        <div id="flashMessage" style="display: none;"></div>

        <form id="registerForm">
            <div class="form-group">
                <label for="fullName">Nama Lengkap</label>
                <div class="input-with-icon">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <input type="text"
                           name="fullName"
                           id="fullName"
                           class="form-control"
                           placeholder="Masukkan nama lengkap"
                           required>
                </div>
                <div id="fullNameError" class="error-message" style="display: none;"></div>
            </div>

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
                           required>
                </div>
                <div id="emailError" class="error-message" style="display: none;"></div>
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
                           placeholder="Masukkan password (min. 8 karakter)"
                           required>
                </div>
                <div id="passwordError" class="error-message" style="display: none;"></div>

                <!-- Password Requirements -->
                <div class="password-requirements">
                    <div id="reqLength" class="requirement unmet">
                        <span>✓</span> Minimal 8 karakter
                    </div>
                    <div id="reqCapital" class="requirement unmet">
                        <span>✓</span> Diawali huruf kapital
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Konfirmasi Password</label>
                <div class="input-with-icon">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <input type="password"
                           name="confirmPassword"
                           id="confirmPassword"
                           class="form-control"
                           placeholder="Ulangi password"
                           required>
                </div>
                <div id="confirmPasswordError" class="error-message" style="display: none;"></div>
            </div>

            <button type="submit" class="btn-login">
                Daftar
            </button>
        </form>

        <div class="form-footer">
            Sudah punya akun? <a href="/login" id="loginLink">Login di sini</a>
        </div>
    </div>

    <script>
        // Real-time password validation
        document.getElementById('password').addEventListener('input', function() {
            validatePassword(this.value);
        });

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const fullName = document.getElementById('fullName').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            // Reset semua error
            resetErrors();

            // Validasi
            let isValid = true;

            // Validasi Nama Lengkap
            if (fullName.trim().length < 2) {
                showError('fullName', 'Nama lengkap harus minimal 2 karakter');
                isValid = false;
            }

            // Validasi Email
            if (!isValidEmail(email)) {
                showError('email', 'Format email tidak valid');
                isValid = false;
            }

            // Validasi Password
            const passwordValidation = validatePassword(password);
            if (!passwordValidation.isValid) {
                showError('password', passwordValidation.message);
                isValid = false;
            }

            // Validasi Konfirmasi Password
            if (password !== confirmPassword) {
                showError('confirmPassword', 'Konfirmasi password tidak sesuai');
                isValid = false;
            }

            if (!isValid) {
                showFlashMessage('Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.', 'error');
                return;
            }

            // Simulasi proses registrasi
            simulateRegistration(fullName, email, password);
        });

        function validatePassword(password) {
            const reqLength = document.getElementById('reqLength');
            const reqCapital = document.getElementById('reqCapital');

            let isValid = true;
            let message = '';

            // Check length
            if (password.length >= 8) {
                reqLength.classList.remove('unmet');
                reqLength.classList.add('met');
            } else {
                reqLength.classList.remove('met');
                reqLength.classList.add('unmet');
                isValid = false;
                message = 'Password harus minimal 8 karakter';
            }

            // Check capital letter at start
            if (password.length > 0 && /^[A-Z]/.test(password)) {
                reqCapital.classList.remove('unmet');
                reqCapital.classList.add('met');
            } else {
                reqCapital.classList.remove('met');
                reqCapital.classList.add('unmet');
                isValid = false;
                if (!message) message = 'Password harus diawali huruf kapital';
            }

            return { isValid, message };
        }

        function simulateRegistration(fullName, email, password) {
            showFlashMessage('Sedang memproses registrasi...', 'info');

            setTimeout(() => {
                if (fullName.length >= 2 && isValidEmail(email) && validatePassword(password).isValid) {
                    showFlashMessage('Registrasi berhasil! Mengarahkan ke halaman login...', 'success');
                    setTimeout(() => {
                        window.location.href = '/login?success=1&email=' + encodeURIComponent(email);
                    }, 2000);
                } else {
                    showFlashMessage('Terjadi kesalahan saat registrasi. Silakan coba lagi.', 'error');
                }
            }, 2000);
        }
    </script>
@endsection

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pariwisata Desa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #1f2937;
            padding: 20px;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            height: auto;
            min-height: 600px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .login-left {
            flex: 1;
            background: linear-gradient(to bottom right, #1f2937, #374151);
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.05)"/></svg>');
            background-size: cover;
        }

        .brand-section {
            position: relative;
            z-index: 2;
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #10b981, #3b82f6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .login-left h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-weight: 700;
            color: white;
            text-align: center;
        }

        .login-left p {
            font-size: 1.1rem;
            color: #d1d5db;
            line-height: 1.6;
            margin-bottom: 30px;
            text-align: center;
        }

        .features {
            margin-top: 20px;
            list-style: none;
        }

        .features li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            font-size: 1rem;
            color: #e5e7eb;
        }

        .features li::before {
            content: '✓';
            margin-right: 12px;
            background: #10b981;
            color: white;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .login-right {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            font-size: 2rem;
            color: #111827;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #6b7280;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }

        .input-with-icon {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 45px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            color: #1f2937;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-control.error {
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .form-control.success {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #9ca3af;
            z-index: 2;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
        }

        /* Flash Message Styles */
        .flash-message {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .flash-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .flash-error {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .flash-info {
            background: #eff6ff;
            color: #1e40af;
            border: 1px solid #dbeafe;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .success-message {
            color: #10b981;
            font-size: 0.875rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 16px;
            height: 16px;
        }

        .checkbox-group label {
            margin-bottom: 0;
            font-size: 0.95rem;
            color: #374151;
        }

        .form-footer {
            text-align: center;
            margin-top: 25px;
            font-size: 0.95rem;
            color: #6b7280;
        }

        .form-footer a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                height: auto;
            }

            .login-left, .login-right {
                padding: 40px 30px;
            }

            .login-left h1 {
                font-size: 2rem;
            }

            .login-header h2 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Left Side - Branding -->
    <div class="login-left">
        <div class="brand-section">
            <div class="brand-logo">
                🏝️
            </div>
            <h1>PARIWISATA DESA</h1>
            <p>Selamat datang di sistem administrasi destinasi wisata dan homestay desa.</p>
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

        <!-- Flash Message Area -->
        <div id="flashMessage" style="display: none;"></div>

        <form id="loginForm">
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
                           value=""
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
                           placeholder="Masukkan password"
                           required>
                </div>
                <div id="passwordError" class="error-message" style="display: none;"></div>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">
                Login
            </button>
        </form>

        <div class="form-footer">
            Belum punya akun? <a href="register" id="registerLink">Daftar di sini</a>
        </div>
    </div>
</div>

<script>
    // Simulasi flash message dari session (contoh: setelah redirect dari registrasi)
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);

        // Jika ada parameter success dari halaman registrasi
        if (urlParams.get('success') === '1') {
            const email = urlParams.get('email') || '';
            showFlashMessage('Registrasi berhasil! Silakan login dengan akun Anda.', 'success');

            // Pre-fill email field jika ada
            if (email) {
                document.getElementById('email').value = decodeURIComponent(email);
            }
        }

        // Jika ada parameter error (contoh: login gagal)
        if (urlParams.get('error') === '1') {
            showFlashMessage('Email atau password salah. Silakan coba lagi.', 'error');
        }
    });

    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const remember = document.getElementById('remember').checked;

        // Reset semua error
        resetErrors();

        // Validasi
        let isValid = true;

        // Validasi Email
        if (!isValidEmail(email)) {
            showError('email', 'Format email tidak valid');
            isValid = false;
        }

        // Validasi Password
        if (password.length < 6) {
            showError('password', 'Password harus minimal 6 karakter');
            isValid = false;
        }

        if (!isValid) {
            showFlashMessage('Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.', 'error');
            return;
        }

        // Simulasi proses login
        simulateLogin(email, password, remember);
    });

    function showError(field, message) {
        const errorElement = document.getElementById(field + 'Error');
        const inputElement = document.getElementById(field);

        errorElement.textContent = message;
        errorElement.style.display = 'flex';
        inputElement.classList.add('error');
        inputElement.classList.remove('success');
    }

    function hideError(field) {
        const errorElement = document.getElementById(field + 'Error');
        const inputElement = document.getElementById(field);

        errorElement.style.display = 'none';
        inputElement.classList.remove('error');
        inputElement.classList.add('success');
    }

    function resetErrors() {
        const errorElements = document.querySelectorAll('.error-message');
        const inputElements = document.querySelectorAll('.form-control');

        errorElements.forEach(element => {
            element.style.display = 'none';
        });

        inputElements.forEach(element => {
            element.classList.remove('error', 'success');
        });
    }

    function showFlashMessage(message, type) {
        const flashMessage = document.getElementById('flashMessage');
        flashMessage.textContent = message;
        flashMessage.className = 'flash-message flash-' + type;
        flashMessage.style.display = 'flex';

        // Auto hide setelah 5 detik
        setTimeout(() => {
            flashMessage.style.display = 'none';
        }, 5000);
    }

function simulateLogin(email, password, remember) {
    // Simulasi proses login
    showFlashMessage('Sedang memproses login...', 'info');

    setTimeout(() => {
        // UNTUK DEMO - TERIMA SEMUA EMAIL YANG VALID DENGAN PASSWORD MINIMAL 6 KARAKTER
        if (isValidEmail(email) && password.length >= 6) {
            showFlashMessage('Login berhasil! Mengarahkan ke dashboard...', 'success');
            // Redirect ke DASHBOARD setelah 2 detik
            setTimeout(() => {
                window.location.href = '/dashboard';
            }, 2000);
        } else {
            // Simulasi login gagal
            showFlashMessage('Email atau password salah. Silakan coba lagi.', 'error');
            showError('password', 'Email atau password tidak sesuai');
        }
    }, 2000);
}

    // Fungsi validasi email
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
</script>

</body>
</html>

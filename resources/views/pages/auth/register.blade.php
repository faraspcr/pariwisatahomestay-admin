<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Pariwisata Desa</title>
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

        .register-container {
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

        .register-left {
            flex: 1;
            background: linear-gradient(to bottom right, #1f2937, #374151);
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-left h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-weight: 700;
            color: white;
        }

        .register-left p {
            font-size: 1.1rem;
            color: #d1d5db;
            line-height: 1.6;
            margin-bottom: 30px;
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

        .register-right {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            font-size: 2rem;
            color: #111827;
            margin-bottom: 10px;
        }

        .register-header p {
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

        .form-control.field-error {
            border-color: #dc2626;
            background-color: #fdf2f2;
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

        .btn-register {
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

        .btn-register:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
        }

        /* Error Message Styles */
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

        /* Alert Styles */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid;
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border-color: #bbf7d0;
        }

        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }

        .alert-info {
            background: #eff6ff;
            color: #1e40af;
            border-color: #dbeafe;
        }

        .alert-icon {
            width: 20px;
            height: 20px;
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

        /* Password Requirements */
        .password-requirements {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 12px;
            margin-top: 8px;
            font-size: 0.875rem;
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
            color: #64748b;
        }

        .requirement.met {
            color: #10b981;
        }

        .requirement.unmet {
            color: #dc2626;
        }

        .requirement-icon {
            width: 16px;
            height: 16px;
        }

        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
                height: auto;
            }

            .register-left, .register-right {
                padding: 40px 30px;
            }

            .register-left h1 {
                font-size: 2rem;
            }

            .register-header h2 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>

<div class="register-container">
    <!-- Left Side - Branding -->
    <div class="register-left">
        <h1>🏝️ PARIWISATA DESA</h1>
        <p>Selamat datang di sistem administrasi destinasi wisata dan homestay desa.</p>

        <ul class="features">
            <li>Kelola data destinasi wisata</li>
            <li>Monitor booking homestay</li>
            <li>Kelola ulasan pengunjung</li>
            <li>Laporan statistik lengkap</li>
        </ul>
    </div>

    <!-- Right Side - Register Form -->
    <div class="register-right">
        <div class="register-header">
            <h2>Registrasi</h2>
            <p>Buat akun baru untuk mengakses dashboard</p>
        </div>

        <!-- Alert Area -->
        <div id="alertArea"></div>

        <form id="registrationForm">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <div class="input-with-icon">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control"
                           placeholder="Masukkan nama lengkap"
                           value=""
                           required>
                </div>
                <div id="nameError" class="error-message" style="display: none;"></div>
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
                           placeholder="Masukkan password (min. 8 karakter)"
                           required>
                </div>
                <!-- Password Requirements -->
                <div class="password-requirements">
                    <div class="requirement" id="reqLength">
                        <svg class="requirement-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Minimal 8 karakter
                    </div>
                    <div class="requirement" id="reqCapital">
                        <svg class="requirement-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Diawali huruf kapital
                    </div>
                </div>
                <div id="passwordError" class="error-message" style="display: none;"></div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-with-icon">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           class="form-control"
                           placeholder="Ulangi password"
                           required>
                </div>
                <div id="confirmPasswordError" class="error-message" style="display: none;"></div>
            </div>

            <button type="submit" class="btn-register">
                Daftar
            </button>
        </form>

        <div class="form-footer">
            Sudah punya akun? <a href="login" id="loginLink">Login di sini</a>
        </div>
    </div>
</div>

<script>
    let hasSubmitted = false;

    document.addEventListener('DOMContentLoaded', function() {
        // Cek jika ada parameter success di URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success') === '1') {
            showAlert('Registrasi berhasil! Silakan login dengan akun Anda.', 'success');
        }

        // Validasi real-time untuk password
        document.getElementById('password').addEventListener('input', updatePasswordRequirements);
        document.getElementById('password_confirmation').addEventListener('input', updateConfirmPasswordIndicator);
    });

    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        hasSubmitted = true;

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;

        // Reset semua error
        resetErrors();
        clearAlert();

        // Validasi
        let isValid = true;
        const errors = [];

        // Validasi Nama
        if (name.length === 0) {
            showError('name', 'Nama lengkap wajib diisi');
            errors.push('Nama lengkap wajib diisi');
            isValid = false;
        } else if (name.length < 3) {
            showError('name', 'Nama harus minimal 3 karakter');
            errors.push('Nama harus minimal 3 karakter');
            isValid = false;
        }

        // Validasi Email
        if (email.length === 0) {
            showError('email', 'Email wajib diisi');
            errors.push('Email wajib diisi');
            isValid = false;
        } else if (!isValidEmail(email)) {
            showError('email', 'Format email tidak valid');
            errors.push('Format email tidak valid');
            isValid = false;
        }

        // Validasi Password
        const passwordValidation = validatePassword(password);
        if (!passwordValidation.isValid) {
            showError('password', passwordValidation.errors.join(', '));
            passwordValidation.errors.forEach(error => errors.push(error));
            isValid = false;
        }

        // Validasi Konfirmasi Password
        const confirmValidation = validateConfirmPassword(password, confirmPassword);
        if (!confirmValidation.isValid) {
            showError('confirmPassword', confirmValidation.error);
            errors.push(confirmValidation.error);
            isValid = false;
        }

        if (!isValid) {
            // Tampilkan alert error di atas form dengan daftar error
            showErrorAlert('Terjadi kesalahan! Silakan perbaiki data berikut:', errors);
            return;
        }

        // Simulasi proses registrasi berhasil
        simulateRegistration(name, email, password);
    });

    function updatePasswordRequirements() {
        const password = document.getElementById('password').value;

        // Update requirement indicators
        const reqLength = document.getElementById('reqLength');
        const reqCapital = document.getElementById('reqCapital');

        // Check length
        if (password.length >= 8) {
            reqLength.classList.add('met');
            reqLength.classList.remove('unmet');
        } else {
            reqLength.classList.remove('met');
            reqLength.classList.add('unmet');
        }

        // Check capital letter
        if (password.length > 0 && /^[A-Z]/.test(password)) {
            reqCapital.classList.add('met');
            reqCapital.classList.remove('unmet');
        } else {
            reqCapital.classList.remove('met');
            reqCapital.classList.add('unmet');
        }

        // Hanya tampilkan error jika form sudah pernah disubmit
        if (hasSubmitted) {
            const passwordValidation = validatePassword(password);
            if (!passwordValidation.isValid) {
                showError('password', passwordValidation.errors.join(', '));
            } else {
                hideError('password');
            }
        }
    }

    function updateConfirmPasswordIndicator() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;

        if (confirmPassword && password !== confirmPassword) {
            document.getElementById('password_confirmation').classList.add('field-error');
            document.getElementById('password_confirmation').classList.remove('success');

            // Hanya tampilkan error jika form sudah pernah disubmit
            if (hasSubmitted) {
                showError('confirmPassword', 'Konfirmasi password tidak cocok');
            }
        } else if (confirmPassword) {
            document.getElementById('password_confirmation').classList.remove('field-error');
            document.getElementById('password_confirmation').classList.add('success');
            hideError('confirmPassword');
        }
    }

    function validatePassword(password) {
        const errors = [];
        let isValid = true;

        if (password.length === 0) {
            errors.push('Password wajib diisi');
            isValid = false;
        } else {
            // Check length
            if (password.length < 8) {
                errors.push('Minimal 8 karakter');
                isValid = false;
            }

            // Check capital letter
            if (!/^[A-Z]/.test(password)) {
                errors.push('Diawali huruf kapital');
                isValid = false;
            }
        }

        return { isValid, errors };
    }

    function validateConfirmPassword(password, confirmPassword) {
        if (confirmPassword.length === 0) {
            return { isValid: false, error: 'Konfirmasi password wajib diisi' };
        }
        if (password !== confirmPassword) {
            return { isValid: false, error: 'Konfirmasi password tidak cocok' };
        }
        return { isValid: true, error: '' };
    }

    function showError(field, message) {
        const errorElement = document.getElementById(field + 'Error');
        const inputElement = document.getElementById(field);

        errorElement.textContent = message;
        errorElement.style.display = 'flex';
        inputElement.classList.add('field-error');
        inputElement.classList.remove('success');
    }

    function hideError(field) {
        const errorElement = document.getElementById(field + 'Error');
        const inputElement = document.getElementById(field);

        errorElement.style.display = 'none';
        inputElement.classList.remove('field-error');
        inputElement.classList.add('success');
    }

    function resetErrors() {
        const errorElements = document.querySelectorAll('.error-message');
        const inputElements = document.querySelectorAll('.form-control');

        errorElements.forEach(element => {
            element.style.display = 'none';
        });

        inputElements.forEach(element => {
            element.classList.remove('field-error', 'success');
        });
    }

    function showErrorAlert(title, errors) {
        const alertArea = document.getElementById('alertArea');
        const alertHtml = `
            <div class="alert alert-danger">
                <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <strong>${title}</strong>
                    <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                        ${errors.map(error => `<li>${error}</li>`).join('')}
                    </ul>
                </div>
            </div>
        `;
        alertArea.innerHTML = alertHtml;

        // Auto hide setelah 8 detik
        setTimeout(() => {
            clearAlert();
        }, 8000);
    }

    function showAlert(message, type) {
        const alertArea = document.getElementById('alertArea');
        const icon = type === 'success' ?
            '<svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' :
            '<svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';

        const alertHtml = `
            <div class="alert alert-${type}">
                ${icon}
                <div>${message}</div>
            </div>
        `;
        alertArea.innerHTML = alertHtml;

        // Auto hide setelah 5 detik
        setTimeout(() => {
            clearAlert();
        }, 5000);
    }

    function clearAlert() {
        document.getElementById('alertArea').innerHTML = '';
    }

    function simulateRegistration(name, email, password) {
        // Simulasi proses registrasi
        showAlert('Sedang memproses registrasi...', 'info');

        setTimeout(() => {
            // Redirect ke halaman login dengan parameter success
            window.location.href = 'login?success=1&email=' + encodeURIComponent(email);
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

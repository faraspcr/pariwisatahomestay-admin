<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pariwisata Desa</title>

    {{-- ====================== START CSS ====================== --}}
    <style>
        /* SEMUA CSS YANG SAMA DI LOGIN & REGISTER */
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
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-left {
            flex: 1;
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .carousel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .carousel-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .carousel-slide.active {
            opacity: 1;
        }

        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(31, 41, 55, 0.6), rgba(55, 65, 81, 0.7));
            z-index: 1;
        }

        .carousel-overlay::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.05)"/></svg>');
            background-size: cover;
        }

        .carousel-controls {
            position: absolute;
            bottom: 20px;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            z-index: 3;
        }

        .carousel-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            font-size: 1.2rem;
            font-weight: bold;
        }

        .carousel-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .carousel-indicators {
            display: flex;
            gap: 8px;
        }

        .carousel-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-indicator.active {
            background: white;
            transform: scale(1.2);
        }

        .brand-section {
            position: relative;
            z-index: 2;
            text-align: center;
            margin-bottom: 30px;
            animation: slideInFromLeft 0.8s ease-out 0.2s both;
        }

        @keyframes slideInFromLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
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
            animation: bounceIn 1s ease-out 0.4s both;
        }

        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }

        .login-left h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-weight: 700;
            color: white;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .login-left p {
            font-size: 1.1rem;
            color: #e5e7eb;
            line-height: 1.6;
            margin-bottom: 30px;
            text-align: center;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .features {
            margin-top: 20px;
            list-style: none;
            animation: slideInFromRight 0.8s ease-out 0.6s both;
        }

        @keyframes slideInFromRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .features li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            font-size: 1rem;
            color: #f3f4f6;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.6s ease-out both;
        }

        .features li:nth-child(1) { animation-delay: 0.8s; }
        .features li:nth-child(2) { animation-delay: 0.9s; }
        .features li:nth-child(3) { animation-delay: 1.0s; }
        .features li:nth-child(4) { animation-delay: 1.1s; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .login-right {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
            animation: slideInFromRight 0.8s ease-out 0.4s both;
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
            transform: translateY(-2px);
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
            transition: color 0.3s ease;
        }

        .form-control:focus + .input-icon {
            color: #3b82f6;
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
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
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
            animation: slideInDown 0.5s ease-out;
        }

        @keyframes slideInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
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
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
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
            position: relative;
        }

        .form-footer a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #3b82f6;
            transition: width 0.3s ease;
        }

        .form-footer a:hover::after {
            width: 100%;
        }

        /* Styles khusus untuk Register */
        .password-requirements {
            margin-top: 10px;
            font-size: 0.85rem;
            color: #6b7280;
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }

        .requirement.met {
            color: #10b981;
        }

        .requirement.unmet {
            color: #9ca3af;
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

            .carousel-controls {
                bottom: 10px;
            }
        }
    </style>
    {{-- ====================== END CSS ====================== --}}

</head>
<body>

    {{-- ====================== START LOGIN CONTAINER ====================== --}}
    <div class="login-container">
        @yield('content')
    </div>
    {{-- ====================== END LOGIN CONTAINER ====================== --}}

    {{-- ====================== START JS ====================== --}}
    <script>
        // Carousel Functionality (COMMON JS UNTUK AUTH)
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.carousel-slide');
            const indicators = document.querySelectorAll('.carousel-indicator');
            const prevBtn = document.querySelector('.carousel-btn.prev');
            const nextBtn = document.querySelector('.carousel-btn.next');
            let currentSlide = 0;

            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove('active'));
                indicators.forEach(indicator => indicator.classList.remove('active'));

                slides[index].classList.add('active');
                indicators[index].classList.add('active');
                currentSlide = index;
            }

            function nextSlide() {
                let nextIndex = (currentSlide + 1) % slides.length;
                showSlide(nextIndex);
            }

            function prevSlide() {
                let prevIndex = (currentSlide - 1 + slides.length) % slides.length;
                showSlide(prevIndex);
            }

            // Event listeners
            if (nextBtn) nextBtn.addEventListener('click', nextSlide);
            if (prevBtn) prevBtn.addEventListener('click', prevSlide);

            // Add click events to indicators
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => showSlide(index));
            });

            // Auto slide every 5 seconds
            setInterval(nextSlide, 5000);

            // Simulasi flash message dari session
            const urlParams = new URLSearchParams(window.location.search);

            if (urlParams.get('success') === '1') {
                const email = urlParams.get('email') || '';
                showFlashMessage('Registrasi berhasil! Silakan login dengan akun Anda.', 'success');

                if (email && document.getElementById('email')) {
                    document.getElementById('email').value = decodeURIComponent(email);
                }
            }

            if (urlParams.get('error') === '1') {
                showFlashMessage('Terjadi kesalahan. Silakan coba lagi.', 'error');
            }
        });

        // Fungsi umum untuk validasi
        function showError(field, message) {
            const errorElement = document.getElementById(field + 'Error');
            const inputElement = document.getElementById(field);

            if (errorElement && inputElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'flex';
                inputElement.classList.add('error');
                inputElement.classList.remove('success');
            }
        }

        function hideError(field) {
            const errorElement = document.getElementById(field + 'Error');
            const inputElement = document.getElementById(field);

            if (errorElement && inputElement) {
                errorElement.style.display = 'none';
                inputElement.classList.remove('error');
                inputElement.classList.add('success');
            }
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
            if (flashMessage) {
                flashMessage.textContent = message;
                flashMessage.className = 'flash-message flash-' + type;
                flashMessage.style.display = 'flex';

                // Auto hide setelah 5 detik
                setTimeout(() => {
                    flashMessage.style.display = 'none';
                }, 5000);
            }
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    </script>
    {{-- ====================== END JS ====================== --}}

    @stack('scripts')
</body>
</html>

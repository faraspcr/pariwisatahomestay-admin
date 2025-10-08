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
            background: linear-gradient(135deg, #004030 0%, #4A9782 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #004030;
        }

        .login-container {
            display: flex;
            width: 900px;
            height: 500px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #004030 0%, #4A9782 100%);
            color: white;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .login-left p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .features {
            margin-top: 30px;
            list-style: none;
        }

        .features li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
        }

        .features li::before {
            content: '✓';
            margin-right: 10px;
            background: #DCD0A8;
            color: #004030;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .login-right {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #F2EFE7;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            font-size: 2rem;
            color: #004030;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #4A9782;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #004030;
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #DCD0A8;
            border-radius: 10px;
            background: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #4A9782;
            box-shadow: 0 0 0 3px rgba(74, 151, 130, 0.1);
        }

        .form-control::placeholder {
            color: #9CA3AF;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #004030;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #4A9782;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 64, 48, 0.3);
        }

        .alert-danger {
            background: #FEE2E2;
            color: #DC2626;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid #FECACA;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .alert-danger ul {
            margin: 0;
            padding-left: 20px;
        }

        .password-requirements {
            font-size: 0.8rem;
            color: #4A9782;
            margin-top: 5px;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            font-size: 1.8rem;
            color: #004030;
            margin-bottom: 5px;
        }

        .logo p {
            color: #4A9782;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Left Side - Branding -->
    <div class="login-left">
        <h1>🏝️ PARIWISATA DESA</h1>
        <p>Selamat datang di sistem administrasi destinasi wisata dan homestay desa.</p>

        <ul class="features">
            <li>Kelola data destinasi wisata</li>
            <li>Monitor booking homestay</li>
            <li>Kelola ulasan pengunjung</li>
            <li>Laporan statistik lengkap</li>
        </ul>
    </div>

    <!-- Right Side - Login Form -->
    <div class="login-right">
        <div class="logo">
            <h1>Admin Panel</h1>
            <p>Masuk ke dashboard Anda</p>
        </div>

        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text"
                       name="username"
                       id="username"
                       class="form-control"
                       placeholder="Masukkan username Anda"
                       value="{{ old('username') }}"
                       required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password"
                       name="password"
                       id="password"
                       class="form-control"
                       placeholder="Masukkan password Anda"
                       required>
                <div class="password-requirements">
                    • Minimal 3 karakter • Harus mengandung huruf kapital
                </div>
            </div>

            <button type="submit" class="btn-login">
                🚪 Masuk ke Dashboard
            </button>
        </form>
    </div>
</div>

</body>
</html>

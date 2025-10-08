<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin - Pariwisata Desa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #F2EFE7;
            color: #004030;
            line-height: 1.6;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background: #004030;
            color: #F2EFE7;
            padding: 0;
        }

        .logo {
            padding: 24px;
            border-bottom: 1px solid #4A9782;
        }

        .logo h1 {
            font-size: 18px;
            font-weight: 600;
        }

        .logo p {
            font-size: 12px;
            opacity: 0.8;
            margin-top: 4px;
        }

        .nav-section {
            padding: 20px 0;
        }

        .nav-title {
            padding: 0 24px 12px;
            font-size: 12px;
            color: #DCD0A8;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nav-links {
            list-style: none;
        }

        .nav-links a {
            display: block;
            padding: 10px 24px;
            color: #F2EFE7;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: #4A9782;
            color: #F2EFE7;
            border-left-color: #DCD0A8;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 24px;
            background: #F2EFE7;
        }

        /* Header */
        .header {
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .header-content h1 {
            font-size: 24px;
            font-weight: 600;
            color: #004030;
            margin-bottom: 4px;
        }

        .header-content p {
            color: #4A9782;
            font-size: 14px;
        }

        .logout-btn {
            background: #dc2626;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: #b91c1c;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #DCD0A8;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(74, 151, 130, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .stat-card:hover::before {
            left: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(74, 151, 130, 0.2);
            border-color: #4A9782;
        }

        .stat-icon {
            font-size: 32px;
            margin-bottom: 12px;
            opacity: 0;
            transform: scale(0.8);
            animation: fadeInScale 0.6s ease forwards;
        }

        .stat-card:nth-child(1) .stat-icon { animation-delay: 0.1s; }
        .stat-card:nth-child(2) .stat-icon { animation-delay: 0.2s; }
        .stat-card:nth-child(3) .stat-icon { animation-delay: 0.3s; }
        .stat-card:nth-child(4) .stat-icon { animation-delay: 0.4s; }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #004030;
            margin-bottom: 8px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }

        .stat-card:nth-child(1) .stat-number { animation-delay: 0.2s; }
        .stat-card:nth-child(2) .stat-number { animation-delay: 0.3s; }
        .stat-card:nth-child(3) .stat-number { animation-delay: 0.4s; }
        .stat-card:nth-child(4) .stat-number { animation-delay: 0.5s; }

        .stat-label {
            font-size: 12px;
            color: #4A9782;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }

        .stat-card:nth-child(1) .stat-label { animation-delay: 0.3s; }
        .stat-card:nth-child(2) .stat-label { animation-delay: 0.4s; }
        .stat-card:nth-child(3) .stat-label { animation-delay: 0.5s; }
        .stat-card:nth-child(4) .stat-label { animation-delay: 0.6s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInScale {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Content Area */
        .content-area {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        /* Table */
        .table-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #DCD0A8;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .table-card:hover {
            box-shadow: 0 8px 25px rgba(74, 151, 130, 0.1);
        }

        .table-header {
            padding: 20px;
            border-bottom: 1px solid #DCD0A8;
            background: #F2EFE7;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h2 {
            font-size: 18px;
            font-weight: 600;
            color: #004030;
        }

        .add-btn {
            background: #4A9782;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .add-btn:hover {
            background: #004030;
            transform: translateY(-1px);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: #F2EFE7;
            padding: 15px 20px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #004030;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #DCD0A8;
        }

        .table td {
            padding: 15px 20px;
            font-size: 13px;
            color: #004030;
            border-bottom: 1px solid #F2EFE7;
            transition: all 0.2s ease;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .table tr {
            opacity: 0;
            transform: translateX(-20px);
            animation: slideInRow 0.5s ease forwards;
        }

        .table tr:nth-child(1) { animation-delay: 0.1s; }
        .table tr:nth-child(2) { animation-delay: 0.2s; }
        .table tr:nth-child(3) { animation-delay: 0.3s; }

        @keyframes slideInRow {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .table tr:hover {
            background: #F2EFE7;
        }

        .table tr:hover td {
            background: #F2EFE7;
        }

        .id-cell {
            color: #4A9782;
            font-weight: 600;
            font-size: 12px;
        }

        .name-cell {
            font-weight: 600;
            color: #004030;
        }

        .price-cell {
            color: #059669;
            font-weight: 600;
        }

        .contact-cell {
            color: #0369a1;
            font-weight: 500;
        }

        /* Activity */
        .activity-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #DCD0A8;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .activity-card:hover {
            box-shadow: 0 8px 25px rgba(74, 151, 130, 0.1);
        }

        .activity-header {
            padding: 20px;
            border-bottom: 1px solid #DCD0A8;
            background: #F2EFE7;
        }

        .activity-header h2 {
            font-size: 18px;
            font-weight: 600;
            color: #004030;
        }

        .activity-list {
            padding: 0;
        }

        .activity-item {
            padding: 16px 20px;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateX(20px);
            animation: slideInActivity 0.5s ease forwards;
        }

        .activity-item:nth-child(1) { animation-delay: 0.1s; }
        .activity-item:nth-child(2) { animation-delay: 0.2s; }
        .activity-item:nth-child(3) { animation-delay: 0.3s; }
        .activity-item:nth-child(4) { animation-delay: 0.4s; }
        .activity-item:nth-child(5) { animation-delay: 0.5s; }

        @keyframes slideInActivity {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .activity-item:hover {
            background: #F2EFE7;
            border-left-color: #4A9782;
            transform: translateX(5px);
        }

        .activity-text {
            font-size: 13px;
            color: #004030;
            margin-bottom: 6px;
            line-height: 1.4;
            font-weight: 500;
        }

        .activity-time {
            font-size: 11px;
            color: #4A9782;
            display: flex;
            align-items: center;
        }

        .activity-time::before {
            content: '🕒';
            margin-right: 6px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h1>🏝️ PARIWISATA DESA</h1>
                <p>Admin Panel</p>
            </div>

            <div class="nav-section">
                <div class="nav-title">Menu Utama</div>
                <ul class="nav-links">
                    <li><a href="#" class="active">📊 Dashboard</a></li>
                    <li><a href="#">🏝️ Destinasi Wisata</a></li>
                    <li><a href="#">🏠 Homestay</a></li>
                    <li><a href="#">🛏️ Kamar</a></li>
                    <li><a href="#">📅 Booking</a></li>
                    <li><a href="#">⭐ Ulasan & Rating</a></li>
                </ul>
            </div>

            <div class="nav-section">
                <div class="nav-title">Laporan</div>
                <ul class="nav-links">
                    <li><a href="#">📈 Statistik Pengunjung</a></li>
                    <li><a href="#">💰 Laporan Keuangan</a></li>
                    <li><a href="#">📋 Laporan Bulanan</a></li>
                </ul>
            </div>

            <div class="nav-section">
                <div class="nav-title">Pengaturan</div>
                <ul class="nav-links">
                    <li><a href="#">⚙️ Pengaturan Sistem</a></li>
                    <li><a href="#">👥 Kelola Admin</a></li>
                    <li><a href="#">🔐 Keamanan</a></li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
<div class="header">
    <div class="header-content">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang, {{ $username }}! Kelola data destinasi wisata dan homestay desa dengan mudah</p>
    </div>

    <!--FORM LOGOUT -->
    <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="logout-btn">
            <span>🚪</span>
            Logout ({{ $username }})
        </button>
    </form>
</div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">🏝️</div>
                    <div class="stat-number">3</div>
                    <div class="stat-label">Total Destinasi</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">🏠</div>
                    <div class="stat-number">2</div>
                    <div class="stat-label">Total Homestay</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">📅</div>
                    <div class="stat-number">5</div>
                    <div class="stat-label">Total Booking</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">⭐</div>
                    <div class="stat-number">12</div>
                    <div class="stat-label">Total Ulasan</div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Table -->
                <div class="table-card">
                    <div class="table-header">
                        <h2>Data Destinasi Wisata</h2>
                        <button class="add-btn">+ Tambah Destinasi</button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Destinasi</th>
                                <th>Deskripsi</th>
                                <th>Alamat</th>
                                <th>RT/RW</th>
                                <th>Jam Buka</th>
                                <th>Tiket</th>
                                <th>Kontak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($destinasi as $item)
                            <tr>
                                <td class="id-cell">#{{ $item['destinasi_id'] }}</td>
                                <td class="name-cell">{{ $item['nama'] }}</td>
                                <td>{{ $item['deskripsi'] }}</td>
                                <td>{{ $item['alamat'] }}</td>
                                <td>{{ $item['rt'] }}/{{ $item['rw'] }}</td>
                                <td>{{ $item['jam_buka'] }}</td>
                                <td class="price-cell">Rp {{ number_format($item['tiket'], 0, ',', '.') }}</td>
                                <td class="contact-cell">{{ $item['kontak'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Activity -->
                <div class="activity-card">
                    <div class="activity-header">
                        <h2>Aktivitas Terbaru</h2>
                    </div>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-text">Admin menambahkan destinasi wisata baru</div>
                            <div class="activity-time">2 jam yang lalu</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-text">Booking homestay "Indah View" telah dikonfirmasi</div>
                            <div class="activity-time">5 jam yang lalu</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-text">Ulasan baru dari pengunjung Pantai Indah</div>
                            <div class="activity-time">1 hari yang lalu</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-text">Update harga tiket destinasi Air Terjun Segar</div>
                            <div class="activity-time">2 hari yang lalu</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-text">Backup data sistem berhasil dilakukan</div>
                            <div class="activity-time">3 hari yang lalu</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

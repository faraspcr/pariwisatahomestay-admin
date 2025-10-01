<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin Pariwisata Desa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            margin: 0;
        }

        header {
            background: #00695c;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        nav {
            width: 200px;
            background: #004d40;
            position: fixed;
            top: 0;
            bottom: 0;
            padding-top: 60px;
        }

        nav a {
            display: block;
            color: #fff;
            padding: 12px;
            text-decoration: none;
        }

        nav a:hover {
            background: #00796b;
        }

        .container {
            margin-left: 220px;
            padding: 20px;
        }

        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            flex: 1;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            margin: 0;
            font-size: 16px;
            color: #555;
        }

        .card p {
            font-size: 22px;
            font-weight: bold;
            margin: 5px 0 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #00695c;
            color: #fff;
        }
    </style>
</head>

<body>
    <header>
        <h1>Dashboard Admin Pariwisata & Homestay Desa</h1>
    </header>

    <nav>
        <a href="#">Dashboard</a>
        <a href="#">Destinasi</a>
        <a href="#">Homestay</a>
        <a href="#">Kamar</a>
        <a href="#">Booking</a>
        <a href="#">Ulasan</a>
    </nav>

    <div class="container">
        <!-- Statistik -->
        <div class="cards">
            <div class="card">
                <h3>Total Destinasi</h3>
                <p>3</p>
            </div>
            <div class="card">
                <h3>Total Homestay</h3>
                <p>2</p>
            </div>
            <div class="card">
                <h3>Total Booking</h3>
                <p>5</p>
            </div>
            <div class="card">
                <h3>Total Ulasan</h3>
                <p>12</p>
            </div>
        </div>

        <!-- Data Destinasi Wisata -->
        <h2>Data Destinasi Wisata</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Alamat</th>
                <th>RT/RW</th>
                <th>Jam Buka</th>
                <th>Tiket</th>
                <th>Kontak</th>
            </tr>
            @foreach($destinasi as $item)
            <tr>
                <td>{{ $item['destinasi_id'] }}</td>
                <td>{{ $item['nama'] }}</td>
                <td>{{ $item['deskripsi'] }}</td>
                <td>{{ $item['alamat'] }}</td>
                <td>{{ $item['rt'] }}/{{ $item['rw'] }}</td>
                <td>{{ $item['jam_buka'] }}</td>
                <td>Rp {{ number_format($item['tiket'], 0, ',', '.') }}</td>
                <td>{{ $item['kontak'] }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>

</html>

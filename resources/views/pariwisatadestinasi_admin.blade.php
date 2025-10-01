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

        <!-- Order Terbaru -->
        <h2>Order Terbaru</h2>
        <table>
            <tr>
                <th>Pemesan</th>
                <th>Tanggal Checkin</th>
                <th>Homestay</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>Rafa</td>
                <td>2025-10-01</td>
                <td>Homestay Indah</td>
                <td>Rp 250.000</td>
                <td>Selesai</td>
            </tr>
            <tr>
                <td>Raka</td>
                <td>2025-10-05</td>
                <td>Homestay Sejuk</td>
                <td>Rp 300.000</td>
                <td>Pending</td>
            </tr>
        </table>
    </div>
</body>

</html>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendapatan - Admin Panel</title>

    <!-- Import Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Quantico:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            color: #333;
            background-color: #f4f6f9;
            margin: 0;
        }
        .sidebar {
            width: 240px;
            background-color: #152732;
            color: #ffffff;
            height: 100vh;
            padding-top: 30px;
            position: fixed;
            display: flex;
            flex-direction: column;
        }
        .sidebar h2 {
            font-family: 'Quantico', sans-serif;
            font-size: 22px;
            text-align: center;
            color: #ffffff;
            margin-bottom: 20px;
            font-weight: 700;
        }
        .sidebar a {
            color: #b0bec5;
            padding: 15px 20px;
            text-decoration: none;
            display: block;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #009603;
            color: #ffffff;
        }
        .sidebar i {
            margin-right: 10px;
        }
        .main-content {
            margin-left: 240px;
            padding: 20px;
        }
        .header h1 {
            font-family: 'Quantico', sans-serif;
            font-weight: 700;
            color: #333;
            margin-top: 0;
        }
        .revenue-summary {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: #ffffff;
            color: #333;
            border-radius: 8px;
            padding: 20px;
            flex: 1;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .card h2 {
            font-size: 24px;
            color: #009603;
            margin: 0;
        }
        .card p {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
            font-size: 14px;
            color: #333;
        }
        th {
            background-color: #152732;
            color: #ffffff;
        }
        td {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Panel Admin</h2>
        <a href="adminpanel.php"><i class="fa fa-dashboard"></i> Beranda</a>
        <a href="manageuser.php"><i class="fa fa-users"></i> User</a>
        <a href="managefotografer.php"><i class="fa fa-camera"></i> Fotografer</a>
        <a href="pendapatan.php"><i class="fa fa-money"></i> Pendapatan</a>
        <a href="#logout"><i class="fa fa-sign-out"></i> Logout</a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Pendapatan</h1>
        </div>

        <!-- Ringkasan Pendapatan -->
        <div class="revenue-summary">
            <div class="card">
                <h2>Rp 50.000.000</h2>
                <p>Total Pendapatan</p>
            </div>
            <div class="card">
                <h2>Rp 5.000.000</h2>
                <p>Pendapatan Bulan Ini</p>
            </div>
            <div class="card">
                <h2>Rp 500.000</h2>
                <p>Pendapatan Hari Ini</p>
            </div>
        </div>

        <!-- Tabel Pendapatan -->
        <table>
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Layanan</th>
                    <th>Fotografer</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>TRX001</td>
                    <td>01-11-2024</td>
                    <td>Pre-wedding</td>
                    <td>John Doe</td>
                    <td>Rp 2.000.000</td>
                </tr>
                <tr>
                    <td>TRX002</td>
                    <td>02-11-2024</td>
                    <td>Wedding</td>
                    <td>Jane Smith</td>
                    <td>Rp 3.000.000</td>
                </tr>
                <!-- Tambahkan data transaksi lainnya di sini -->
            </tbody>
        </table>
    </div>

</body>
</html>

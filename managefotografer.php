<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotografer - Admin Panel</title>

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
        }
        /* Tabel Fotografer */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        th {
            background-color: #152732;
            color: #fff;
            text-align: left;
            font-weight: 600;
        }
        td {
            text-align: left;
        }
        .action-buttons button {
            margin-right: 5px;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            color: #fff;
            border-radius: 4px;
        }
        .edit-btn {
            background-color: #009603;
        }
        .delete-btn {
            background-color: #e53935;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Panel Admin</h2>
        <a href="adminpanel.php"><i class="fa fa-dashboard"></i> Beranda</a>
        <a href="manageuser.php"><i class="fa fa-users"></i> Pengguna</a>
        <a href="managefotografer.php"><i class="fa fa-camera"></i> Fotografer</a>
        <a href="pendapatan.php"><i class="fa fa-money"></i> Pendapatan</a>
        <a href="#logout"><i class="fa fa-sign-out"></i> Logout</a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Fotografer</h1>
        </div>

        <!-- Tabel Data Fotografer -->
        <table>
            <tr>
                <th>ID</th>
                <th>Profil</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Aksi</th>
            </tr>

            <!-- Contoh data fotografer, gantikan dengan PHP untuk mengambil dari database -->
            <tr>
                <td>1</td>
                <td><img src="path/to/profile1.jpg" alt="Profil" width="40" height="40" style="border-radius: 50%;"></td>
                <td>John Doe</td>
                <td>john@example.com</td>
                <td>+6281234567890</td>
                <td class="action-buttons">
                    <button class="edit-btn">Edit</button>
                    <button class="delete-btn">Hapus</button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td><img src="path/to/profile2.jpg" alt="Profil" width="40" height="40" style="border-radius: 50%;"></td>
                <td>Jane Smith</td>
                <td>jane@example.com</td>
                <td>+6281234567891</td>
                <td class="action-buttons">
                    <button class="edit-btn">Edit</button>
                    <button class="delete-btn">Hapus</button>
                </td>
            </tr>
            <!-- Tambahkan lebih banyak data fotografer di sini -->
        </table>
    </div>

</body>
</html>

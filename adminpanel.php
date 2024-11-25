<?php
session_start();

// Cek jika pengguna belum login atau bukan admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); // Arahkan ke halaman login jika bukan admin
    exit();
}

// Jika logout diakses, akhiri sesi dan arahkan ke halaman login
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php"); // Ganti dengan halaman login Anda
    exit();
}

// Koneksi ke database
require_once 'koneksi.php';

// Hitung total pengguna
$queryTotalUsers = $conn->query("SELECT COUNT(*) AS total_users FROM users");
$totalUsers = $queryTotalUsers->fetch(PDO::FETCH_ASSOC)['total_users'];

// Hitung total fotografer
$queryTotalFotografer = $conn->query("SELECT COUNT(*) AS total_fotografer FROM users WHERE role = 'fotografer'");
$totalFotografer = $queryTotalFotografer->fetch(PDO::FETCH_ASSOC)['total_fotografer'];

// Pagination untuk tabel pengguna
$limit = 6; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Ambil data pengguna dari database dengan batasan pagination
$queryUsers = $conn->query("SELECT name, email, role FROM users LIMIT $limit OFFSET $offset");
$users = $queryUsers->fetchAll(PDO::FETCH_ASSOC);

// Hitung total halaman
$totalUsersQuery = $conn->query("SELECT COUNT(*) AS total FROM users");
$totalRecords = $totalUsersQuery->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalRecords / $limit);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <!-- Import Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Quantico:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">

    <style>
        /* CSS styling sama seperti sebelumnya */
        body {
            font-family: 'Open Sans', sans-serif;
            color: #333;
            background-color: #f4f6f9;
            margin: 0;
            display: flex;
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
            flex: 1;
        }
        .header h1 {
            font-family: 'Quantico', sans-serif;
            font-weight: 700;
            color: #333;
        }
        .dashboard-wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 20px;
        }
        .dashboard-cards {
            display: flex;
            gap: 15px;
            justify-content: space-between;
        }
        .card {
            flex: 1;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        .card h3 {
            font-size: 16px;
            color: #666;
            font-weight: 600;
            margin: 5px 0;
        }
        .card p {
            font-size: 22px;
            font-weight: 700;
            color: #333;
        }
        .data-table {
            margin-top: 20px;
        }
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
            color: #333;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .pagination {
            display: flex;
            justify-content: center;
            padding: 10px;
            margin-top: 10px;
        }
        .pagination a {
            padding: 8px 12px;
            margin: 0 4px;
            border-radius: 5px;
            background-color: #ddd;
            color: #333;
            text-decoration: none;
        }
        .pagination a.active, .pagination a:hover {
            background-color: #009603;
            color: #fff;
        }
    </style>

    <script>
        // Fungsi Logout dengan konfirmasi
        function logout() {
            if (confirm("Apakah anda yakin ingin keluar?")) {
                window.location.href = 'adminpanel.php?logout=true';
            }
        }
    </script>
</head>
<body>

    <div class="sidebar">
        <h2>Panel Admin</h2>
        <a href="adminpanel.php"><i class="fa fa-dashboard"></i> Beranda</a>
        <a href="manageuser.php"><i class="fa fa-users"></i> User</a>
        <a href="managefotografer.php"><i class="fa fa-camera"></i> Fotografer</a>
        <a href="pendapatan.php"><i class="fa fa-money"></i> Pendapatan</a> <!-- Menu Pendapatan -->
        <a href="javascript:void(0);" onclick="logout()"><i class="fa fa-sign-out"></i> Logout</a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Dashboard</h1>
        </div>

        <div class="dashboard-wrapper">
            <div class="dashboard-cards">
                <div class="card">
                    <h3>Total Pengguna</h3>
                    <p><?php echo $totalUsers; ?></p>
                </div>
                <div class="card">
                    <h3>Total Fotografer</h3>
                    <p><?php echo $totalFotografer; ?></p>
                </div>
                <div class="card">
                    <h3>Total Pendapatan</h3>
                    <p>Rp 0</p>
                </div>
            </div>

            <div class="data-table">
                <h2>Data Pengguna</h2>
                <table>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <div class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" class="<?php if ($page == $i) echo 'active'; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

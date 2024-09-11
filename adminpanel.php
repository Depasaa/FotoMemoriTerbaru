<?php
require 'koneksi.php'; // Menghubungkan ke database

// Mengambil data jumlah user dari database
$stmtUserCount = $conn->prepare("SELECT COUNT(*) AS user_count FROM users");
$stmtUserCount->execute();
$userCount = $stmtUserCount->fetch(PDO::FETCH_ASSOC)['user_count'];

// Mengambil data jumlah fotografer dari database
$stmtFotograferCount = $conn->prepare("SELECT COUNT(*) AS fotografer_count FROM users WHERE role = 'fotografer'");
$stmtFotograferCount->execute();
$fotograferCount = $stmtFotograferCount->fetch(PDO::FETCH_ASSOC)['fotografer_count'];

// Mengambil data pendapatan dari database (misal, total pendapatan bisa ditambahkan)
// $stmtPendapatan = $conn->prepare("SELECT SUM(amount) AS total_pendapatan FROM transactions");
// $stmtPendapatan->execute();
// $pendapatan = $stmtPendapatan->fetch(PDO::FETCH_ASSOC)['total_pendapatan'];

// Mengambil data user dari database
$stmt = $conn->prepare("SELECT id, name, email, role FROM users ORDER BY id ASC");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Panel">
    <meta name="author" content="Depasaa">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Admin Panel - FotoMemori</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="dist/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navmenu-reveal.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* CSS tambahan untuk centering */
        .table td,
        .table th {
            text-align: center;
            /* Mengatur text-align ke center */
            vertical-align: middle;
            /* Untuk vertikal align di tengah */
        }

        .panel-body {
            text-align: center;
            /* Center text dalam panel */
        }

        /* Responsive adjustments */
        .table-responsive {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="bar">
        <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-recalc="false" data-target=".navmenu"
            data-canvas=".canvas">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <div class="navmenu navmenu-default navmenu-fixed-left">
        <ul class="nav navmenu-nav">
            <li><a href="adminpanel.php">Dashboard</a></li>
            <li><a href="manageuser.php">Manage User</a></li>
            <li><a href="managefotografer.php">Manage Fotografer</a></li>
            <li><a href="pendapatan.html">Pendapatan</a></li>
            <li><a href="masukan.php">Masukan</a></li>
            <li><a href="logout.html">Logout</a></li>
        </ul>
        <a class="navmenu-brand" href="#"><img src="LogoFotoMemoriRevTransparant.png" width="160"></a>
        <div class="social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>
        </div>
        <div class="copyright-text">©Copyright <a href="https://themewagon.com/"> Depasaa</a> 2024</div>
    </div>

    <div class="canvas">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">Admin Dashboard</h1>

                    <!-- Section for Statistics -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Jumlah User</h3>
                                </div>
                                <div class="panel-body">
                                    <h1><?php echo $userCount; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Jumlah Fotografer</h3>
                                </div>
                                <div class="panel-body">
                                    <h1><?php echo $fotograferCount; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Pendapatan</h3>
                                </div>
                                <div class="panel-body">
                                    <h1>$0</h1> <!-- Contoh pendapatan, sesuaikan sesuai data -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section for Manage Users -->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <h2 class="h4 mb-3">Data Semua User</h2>
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="dist/js/jasny-bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>

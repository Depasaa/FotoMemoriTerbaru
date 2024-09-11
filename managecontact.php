<?php
require 'koneksi.php'; // Menghubungkan ke database

// Delete Feedback
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM contact WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: managefeedback.php");
    exit();
}

// Mengambil data feedback dari database
$stmt = $conn->prepare("SELECT id, name, email, message, created_at FROM contact ORDER BY created_at DESC");
$stmt->execute();
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Panel">
    <meta name="author" content="Depasaa">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Admin Panel - Manage Feedback</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="dist/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navmenu-reveal.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* CSS tambahan untuk centering */
        .table td, .table th {
            text-align: center; /* Mengatur text-align ke center */
            vertical-align: middle; /* Untuk vertikal align di tengah */
        }
        .panel-body {
            text-align: center; /* Center text dalam panel */
        }
        /* Responsive adjustments */
        .table-responsive {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="bar">
        <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-recalc="false" data-target=".navmenu" data-canvas=".canvas">
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
                    <h1 class="page-header">Manage Feedback</h1>

                    <!-- Section for Statistics -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Jumlah Feedback</h3>
                                </div>
                                <div class="panel-body">
                                    <h1><?php echo count($feedbacks); ?></h1> <!-- Example number -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section for Manage Feedback -->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <h2 class="h4 mb-3">User Feedback</h2>
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($feedbacks as $feedback): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($feedback['id']); ?></td>
                                        <td><?php echo htmlspecialchars($feedback['name']); ?></td>
                                        <td><?php echo htmlspecialchars($feedback['email']); ?></td>
                                        <td><?php echo htmlspecialchars($feedback['message']); ?></td>
                                        <td><?php echo htmlspecialchars($feedback['created_at']); ?></td>
                                        <td>
                                            <!-- Delete Button -->
                                            <form method="post" action="managefeedback.php" style="display:inline;">
                                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($feedback['id']); ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" name="delete">Delete</button>
                                            </form>
                                        </td>
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

    <!-- JavaScript files -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/navmenu.js"></script>
    <script src="dist/js/jasny-bootstrap.min.js"></script>
</body>
</html>

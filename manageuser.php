<?php
require 'koneksi.php'; // Menghubungkan ke database

// Update User
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    $sql = "UPDATE users SET name = ?, email = ?, role = ?";
    $params = [$name, $email, $role];

    if (!empty($password)) {
        $sql .= ", password = ?";
        $params[] = password_hash($password, PASSWORD_DEFAULT);
    }

    $sql .= " WHERE id = ?";
    $params[] = $id;

    $stmt = $conn->prepare($sql);
    $stmt->execute($params);

    // Set a session variable or a flag for notification
    $_SESSION['notification'] = 'Profil berhasil diperbarui!';

    header("Location: edituser.php?id=$id"); // Redirect kembali ke halaman edituser
    exit();
}

// Mengambil data pengguna dari database
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT id, name, email, role FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edit User">
    <meta name="author" content="Depasaa">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Edit User - FotoMemori</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="dist/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navmenu-reveal.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* CSS tambahan untuk centering */
        .form-control {
            border-radius: 0;
        }
        .modal-content {
            border-radius: 0;
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
            <li><a href="adminpanel.html">Dashboard</a></li>
            <li><a href="manageuser.php">Manage User</a></li>
            <li><a href="managefotografer.php">Manage Fotografer</a></li>
            <li><a href="pendapatan.html">Pendapatan</a></li>
            <li><a href="managecontact.php">Masukan</a></li>
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
                    <h1 class="page-header">Edit User</h1>

                    <!-- Show notification if set -->
                    <?php if (isset($_SESSION['notification'])): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['notification']; unset($_SESSION['notification']); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Edit User Form -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Edit User</h3>
                                </div>
                                <div class="panel-body">
                                    <form method="post" action="edituser.php">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select class="form-control" id="role" name="role" required>
                                                <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                                <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
                                                <option value="fotografer" <?php if ($user['role'] == 'fotografer') echo 'selected'; ?>>Fotografer</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="update">Update Profil</button>
                                    </form>
                                </div>
                            </div>
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

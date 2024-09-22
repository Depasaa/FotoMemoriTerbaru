<?php
require 'koneksi.php'; // Menghubungkan ke database

// Create User
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $password, $role]);

    header("Location: manageuser.php");
    exit();
}

// Update User
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?");
    $stmt->execute([$name, $email, $role, $id]);

    header("Location: manageuser.php");
    exit();
}

// Delete User Permanently
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: manageuser.php");
    exit();
}

// Mengambil data jumlah user dari database
$stmtUserCount = $conn->prepare("SELECT COUNT(*) AS user_count FROM users");
$stmtUserCount->execute();
$userCount = $stmtUserCount->fetch(PDO::FETCH_ASSOC)['user_count'];

// Mengambil data jumlah fotografer dari database
$stmtFotograferCount = $conn->prepare("SELECT COUNT(*) AS fotografer_count FROM users WHERE role = 'fotografer'");
$stmtFotograferCount->execute();
$fotograferCount = $stmtFotograferCount->fetch(PDO::FETCH_ASSOC)['fotografer_count'];

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
    <link href="dist/css/jasny-bootstraps.min.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
  <link href="css/bootstrapss.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Custom styles for this template -->
  <link href="css/navmenu-reveals.css" rel="stylesheet">
  <link href="css/styless.css" rel="stylesheet">
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
    <div class="navmenu navmenu-default navmenu-fixed-left in">
    <ul class="nav navmenu-nav">
    <li><a href="adminpanel.php"><i class="fa fa-home nav-icon"></i> Dashboard</a></li>
      <li><a href="manageuser.php"><i class="fa fa-image nav-icon"></i> Manage User</a></li>
      <li><a href="managefotografer.php"><i class="fa fa-camera nav-icon"></i> Manage Fotografer</a></li>
        <li><a href="logout.php" onclick="return confirmLogout();"><i class="fa fa-sign-out-alt nav-icon"></i> Logout</a></li>
    </ul>
    <a class="navmenu-brand" href="#"><img src="LogoFotoMemoriRevTransparant.png" width="160"></a>
    <div class="social">
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-youtube"></i></a>
    </div>

    <div class="copyright-text">©Copyright <a href="https://themewagon.com/"> Depasaa</a> 2024</div>
  </div>

    <div class="canvas">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">Manage User</h1>

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

                    <!-- Button to Create User -->
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#createUserModal">Create User</button>
                        </div>
                    </div>

                    <!-- Section for Manage Users -->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <h2 class="h4 mb-3">Data User</h2>
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editUserModal" data-id="<?php echo htmlspecialchars($user['id']); ?>" data-name="<?php echo htmlspecialchars($user['name']); ?>" data-email="<?php echo htmlspecialchars($user['email']); ?>" data-role="<?php echo htmlspecialchars($user['role']); ?>">Edit</button>
                                            <!-- Delete Button -->
                                            <form method="post" action="manageuser.php" style="display:inline;">
                                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
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

 <!-- Modal for Create User -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Create New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="manageuser.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="fotografer">Fotografer</option> <!-- Tambahkan opsi Fotografer -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="create">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Modal for Edit User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="manageuser.php">
                    <div class="modal-body">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-name">Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-email">Email</label>
                            <input type="email" class="form-control" id="edit-email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-role">Role</label>
                            <select class="form-control" id="edit-role" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="user">Fotografer</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="update">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript files -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/navmenu.js"></script>
    <script src="dist/js/jasny-bootstrap.min.js"></script>
    <script>
        $('#editUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes
            var name = button.data('name');
            var email = button.data('email');
            var role = button.data('role');
            
            var modal = $(this);
            modal.find('.modal-body #edit-id').val(id);
            modal.find('.modal-body #edit-name').val(name);
            modal.find('.modal-body #edit-email').val(email);
            modal.find('.modal-body #edit-role').val(role);
        });
    </script>
</body>
</html>

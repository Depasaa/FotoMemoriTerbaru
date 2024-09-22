<?php
// Include file koneksi ke database
include 'koneksi.php';

session_start();

$user_id = $_SESSION['user_id']; // Ambil user_id dari sesi yang sedang login

// Mengambil data user dari database berdasarkan user_id
try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Memproses form update profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $old_password = $_POST['old_password']; // Password lama yang dimasukkan user

    try {
        if (!empty($password)) {
            // Verifikasi password lama
            if (password_verify($old_password, $user['password'])) {
                // Jika cocok, hash password baru dan update
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ?, password = ? WHERE id = ?");
                $stmt->execute([$name, $email, $phone, $hashed_password, $user_id]);
                $success = "Password berhasil diperbarui.";
            } else {
                // Jika password lama salah
                $error = "Password lama salah. Coba lagi.";
            }
        } else {
            // Jika password tidak diubah, hanya update data lain
            $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?");
            $stmt->execute([$name, $email, $phone, $user_id]);
            $success = "Profil berhasil diperbarui.";
        }

        // Fetch data user yang telah diperbarui dari database
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        $error = "Terjadi kesalahan saat memperbarui profil: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User</title>
    <link href="dist/css/jasny-bootstraps.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href="css/bootstrapss.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/navmenu-reveals.css" rel="stylesheet">
    <link href="css/styless.css" rel="stylesheet">
    <link href="css/edituserr.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .nav-icon {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="navmenu navmenu-default navmenu-fixed-left in">
        <ul class="nav navmenu-nav">
            <li><a href="index.php"><i class="fa fa-home nav-icon"></i> Beranda</a></li>
            <li><a href="works.php"><i class="fa fa-image nav-icon"></i> Galeri Karya</a></li>
            <li><a href="blog.php"><i class="fa fa-camera nav-icon"></i> Fotografer</a></li>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <li><a href="membership.php"><i class="fa fa-users nav-icon"></i> Membership</a></li>
                <li><a href="edituser.php"><i class="fa fa-cog nav-icon"></i> Pengaturan</a></li>
                <li><a href="logout.php" onclick="return confirmLogout();"><i class="fa fa-sign-out-alt nav-icon"></i> Logout</a></li>
            <?php else: ?>
                <li><a href="login.php"><i class="fa fa-sign-in-alt nav-icon"></i> Login</a></li>
            <?php endif; ?>
        </ul>
        <a class="navmenu-brand" href="#"><img src="LogoFotoMemoriRevTransparant.png" width="160"></a>
        <div class="social">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
        <div class="copyright-text">©Copyright <a href="https://themewagon.com/"> Depasaa</a> 2024</div>
    </div>
    <div class="container">
        <h1>Account Information</h1>
        <div class="card-container">
            <div class="card-profile">
                <img class="round" src="https://randomuser.me/api/portraits/women/79.jpg" alt="user" />
                <h1><?php echo htmlspecialchars($user['name']); ?></h1>
                <h4><?php echo htmlspecialchars($user['role']); ?></h6>
            </div>

            <div class="skills">
                <ul>
                    <li><span>Username:</span> <?php echo htmlspecialchars($user['name']); ?></li>
                    <li><span>Email:</span> <?php echo htmlspecialchars($user['email']); ?></li>
                    <li><span>Phone:</span> <?php echo htmlspecialchars($user['phone']); ?></li>
                </ul>
            </div>
        </div>
        <div class="buttons">
            <button class="primary" id="editBtn">Edit Profil</button>
        </div>
    </div>

    <!-- Modal Edit Profil -->
    <div id="editModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Profil</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone']); ?>" placeholder="Masukkan nomor hp anda apabila perlu">
                </div>
                <div class="form-group">
                    <label for="old_password">Password Lama:</label>
                    <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Masukkan password lama">
                </div>
                <div class="form-group">
                    <label for="password">Password Baru:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password baru jika ingin mengganti">
                </div>

                <button type="submit" name="update" class="primary">Update Profil</button>
            </form>
        </div>
    </div>

    <script>
        // JavaScript untuk menampilkan modal dengan efek memudar
        var modal = document.getElementById("editModal");
        var btn = document.getElementById("editBtn");
        var span = document.getElementsByClassName("close")[0];

        // Menampilkan modal dengan efek memudar
        btn.onclick = function () {
            modal.classList.add("show");
            setTimeout(function () {
                modal.querySelector(".modal-content").style.opacity = "1";
                modal.querySelector(".modal-content").style.transform = "translateY(0)";
            }, 10); // Sedikit delay untuk memulai transisi
        }

        // Menutup modal
        span.onclick = function () {
            modal.querySelector(".modal-content").style.opacity = "0";
            modal.querySelector(".modal-content").style.transform = "translateY(-30px)";
            setTimeout(function () {
                modal.classList.remove("show");
            }, 400); // Sesuaikan dengan durasi transisi CSS
        }

        // Menyembunyikan modal jika klik di luar modal
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.querySelector(".modal-content").style.opacity = "0";
                modal.querySelector(".modal-content").style.transform = "translateY(-30px)";
                setTimeout(function () {
                    modal.classList.remove("show");
                }, 400);
            }
        }

        // Notifikasi berhasil atau gagal menggunakan SweetAlert
        <?php if (isset($success)) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?php echo $success; ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php } elseif (isset($error)) { ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?php echo $error; ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php } ?>
    </script>
</body>
</html>

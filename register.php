<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'db_fotomemori');

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message_status = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

    // Query untuk menyimpan data
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Pendaftaran berhasil
        $message_status = "success";
    } else {
        // Pendaftaran gagal
        $message_status = "error";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Register Form</title>
    <link rel="stylesheet" href="login.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <img src="LogoFotoMemoriRev.jpeg" alt="">
                <div class="text">
                    <span class="text-1">Halo, Semuanya! <br>Selamat Datang</span>
                    <span class="text-2">Daftarkan diri anda dan mulai gunakan layanan kami segera</span>
                </div>
            </div>
            <div class="back">
                <img class="backImg" src="LogoFotoMemoriRev.jpeg" alt="">
                <div class="text">
                    <span class="text-1">Complete miles of journey <br> with one step</span>
                    <span class="text-2">Let's get started</span>
                </div>
            </div>
        </div>
        <div class="forms">
            <div class="form-content">
                <div class="signup-form">
                    <div class="title">Register</div>
                    <form action="register.php" method="POST">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" placeholder="Nama" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Sandi" required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Submit">
                            </div>
                            <div class="text sign-up-text">Sudah punya akun? <a href="login.php">Login</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 Notification -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var status = "<?php echo $message_status; ?>";

            if (status === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'Pendaftaran Berhasil!',
                    text: 'Anda akan segera dialihkan ke halaman login.',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'login.php'; // Redirect ke halaman user.html setelah berhasil
                });
            } else if (status === "error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Pendaftaran Gagal!',
                    text: 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
</body>

</html>

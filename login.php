<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'db_fotomemori');

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message_status = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Login berhasil
            $message_status = "success";
        } else {
            // Password salah
            $message_status = "error_password";
        }
    } else {
        // Email tidak ditemukan
        $message_status = "error_email";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
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
        <div class="login-form">
          <div class="title">Login</div>
          <form action="login.php" method="POST">
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
            <div class="text sign-up-text">Tidak punya akun? <a href="register.php">Register</a></div>
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
                title: 'Login Berhasil!',
                text: 'Anda akan segera dialihkan ke halaman user.',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = 'user.html'; // Redirect ke halaman user.html
            });
        } else if (status === "error_password") {
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: 'Password yang Anda masukkan salah. Coba lagi.',
                confirmButtonText: 'OK'
            });
        } else if (status === "error_email") {
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: 'Email tidak ditemukan. Silakan periksa kembali atau daftar akun baru.',
                confirmButtonText: 'OK'
            });
        }
    });
  </script>
</body>
</html>

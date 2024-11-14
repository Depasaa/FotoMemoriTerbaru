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
  $role = 'user'; // Set peran default sebagai 'user'
  $profiluser = ''; // Atau bisa diset NULL
  $phone = ''; // Atau bisa diset NULL

  // Query untuk memeriksa apakah email sudah terdaftar
  $checkEmailSql = "SELECT * FROM users WHERE email = '$email'";
  $checkEmailResult = $conn->query($checkEmailSql);

  if ($checkEmailResult->num_rows > 0) {
    // Email sudah terdaftar
    $message_status = "error_email";
  } else {
    // Query untuk menyimpan data termasuk peran (role) dan kolom lainnya
    $sql = "INSERT INTO users (profiluser, name, email, password, phone, role) 
                VALUES ('$profiluser', '$name', '$email', '$password', '$phone', '$role')";

    if ($conn->query($sql) === TRUE) {
      // Pendaftaran berhasil
      $message_status = "success";
    } else {
      // Pendaftaran gagal
      $message_status = "error";
    }
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form in HTML and CSS | CodingNepal</title>
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Quantico:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

  <!-- Css Styles -->
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
  <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
  <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <link rel="stylesheet" href="login.css" />
</head>

<body>
  <div class="login_form">
    <!-- Form untuk pendaftaran -->
    <form action="register.php" method="POST">
      <h3>REGISTER</h3>

      <!-- Nama input box -->
      <div class="input_box">
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" placeholder="Enter your name" required
          value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" />
      </div>

      <!-- Email input box -->
      <div class="input_box">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter email address" required
          value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
      </div>

      <!-- Password input box -->
      <div class="input_box">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required />
      </div>

      <!-- Tombol Register -->
      <button type="submit">Register</button>

      <p class="sign_up">Sudah punya akun? <a href="login.php">Login</a></p>
    </form>
  </div>

<!-- SweetAlert2 Notification -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var status = "<?php echo $message_status; ?>";

    if (status === "success") {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Pendaftaran berhasil. Anda akan dialihkan ke halaman login.',
        confirmButtonText: 'OK',
        confirmButtonColor: '#28a745',
        background: '#ffffff',
        color: '#333',
        iconColor: '#28a745',
        customClass: {
          popup: 'swal-square'
        }
      }).then(function () {
        window.location.href = 'login.php';
      });
    } else if (status === "error_email") {
      Swal.fire({
        icon: 'error',
        title: 'Email Sudah Terdaftar!',
        text: 'Gunakan email lain atau masuk ke akun Anda.',
        confirmButtonText: 'OK',
        confirmButtonColor: '#dc3545',
        background: '#ffffff',
        color: '#333',
        iconColor: '#dc3545',
        customClass: {
          popup: 'swal-square'
        }
      });
    } else if (status === "error") {
      Swal.fire({
        icon: 'error',
        title: 'Oops, Terjadi Kesalahan!',
        text: 'Gagal mendaftar. Silakan coba lagi nanti.',
        confirmButtonText: 'OK',
        confirmButtonColor: '#dc3545',
        background: '#ffffff',
        color: '#333',
        iconColor: '#dc3545',
        customClass: {
          popup: 'swal-square'
        }
      });
    }
  });
</script>

<style>
  .swal-square {
    border-radius: 0 !important; /* Menghilangkan sudut membulat */
  }
</style>

</body>

</html>
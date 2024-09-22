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
<html>
<head>
<link href="loginn.css" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <style>
  @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@200;300;400;500;600;700&display=swap");

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Open Sans", sans-serif;
  }

  body {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    width: 100%;
    padding: 0 10px;
  }

  body::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background: url("blogin.jpg"), #000;
    background-position: center;
    background-size: cover;
  }

  .wrapper {
    width: 400px;
    border-radius: 8px;
    padding: 30px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
  }

  form {
    display: flex;
    flex-direction: column;
  }

  h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    color: #fff;
  }

  .input-field {
    position: relative;
    border-bottom: 2px solid #ccc;
    margin: 15px 0;
  }

  .input-field label {
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    color: #fff;
    font-size: 16px;
    pointer-events: none;
    transition: 0.15s ease;
  }

  .input-field input {
    width: 100%;
    height: 40px;
    background: transparent;
    border: none;
    outline: none;
    font-size: 16px;
    color: #fff;
  }

  .input-field input:focus~label,
  .input-field input:valid~label {
    font-size: 0.8rem;
    top: 10px;
    transform: translateY(-120%);
  }

  button {
    background: #fff;
    color: #000;
    font-weight: 600;
    border: none;
    padding: 12px 20px;
    cursor: pointer;
    border-radius: 3px;
    font-size: 16px;
    border: 2px solid transparent;
    transition: 0.3s ease;
  }

  button:hover {
    color: #fff;
    border-color: #fff;
    background: rgba(255, 255, 255, 0.15);
  }

  .register {
    text-align: center;
    margin-top: 30px;
    color: #fff;
  }
  </style>
  
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <div class="wrapper">
    <form action="register.php" method="POST">
      <h2>Register</h2>
      
      <!-- Input for Name -->
      <div class="input-field">
        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
        <label>Masukan Nama</label>
      </div>
      
      <!-- Input for Email -->
      <div class="input-field">
        <input type="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
        <label>Masukan Email</label>
      </div>
      
      <!-- Input for Password -->
      <div class="input-field">
        <input type="password" name="password" required>
        <label>Masukan Sandi</label>
      </div>
      
      <button type="submit">Register</button>
      
      <div class="register">
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
      </div>
    </form>
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
                confirmButtonText: 'OK',
                confirmButtonColor: '#28a745', // Warna tombol OK
                background: '#343a40', // Background alert
                color: '#fff', // Teks alert
                iconColor: '#28a745' // Warna icon success
            }).then(function() {
                window.location.href = 'login.php'; // Redirect ke halaman login setelah berhasil
            });
        } else if (status === "error_email") {
            Swal.fire({
                icon: 'error',
                title: 'Pendaftaran Gagal!',
                text: 'Email ini sudah terdaftar. Silakan gunakan email lain atau masuk ke akun Anda.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#dc3545', // Warna tombol OK
                background: '#343a40', // Background alert
                color: '#fff', // Teks alert
                iconColor: '#dc3545' // Warna icon error
            });
        } else if (status === "error") {
            Swal.fire({
                icon: 'error',
                title: 'Pendaftaran Gagal!',
                text: 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#dc3545', // Warna tombol OK
                background: '#343a40', // Background alert
                color: '#fff', // Teks alert
                iconColor: '#dc3545' // Warna icon error
            });
        }
    });
  </script>
</body>
</html>

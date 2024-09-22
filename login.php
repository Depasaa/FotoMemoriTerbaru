<?php
session_start(); // Mulai sesi
$conn = new mysqli('localhost', 'root', '', 'db_fotomemori');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message_status = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
          // Login berhasil
          $_SESSION['loggedin'] = true; // Set sesi loggedin
          $_SESSION['user_id'] = $user['id']; // Set sesi user_id jika diperlukan
          header("Location: index.php"); // Redirect langsung ke halaman index
          exit(); // Menghentikan eksekusi script lebih lanjut
      }
       else {
            $message_status = "error_password";
        }
    } else {
        $message_status = "error_email";
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
  <title>Login</title>
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

  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <div class="wrapper">
    <form action="login.php" method="POST">
      <h2>Login</h2>
      <div class="input-field">
        <input type="email" name="email" placeholder="Masukkan Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required >
        <label>Masukkan Email</label>
      </div>
      <div class="input-field">
        <input type="password" name="password" placeholder="Masukkan Sandi" required>
        <label>Masukkan Sandi</label>
      </div>
      <button type="submit">Log In</button>
      <div class="register">
        <p>Belum punya akun? <a href="register.php">Register</a></p>
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
                title: 'Login Berhasil!',
                text: 'Anda akan segera dialihkan ke halaman beranda.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#28a745', // Warna tombol OK
                background: '#343a40', // Background alert
                color: '#fff', // Teks alert
                iconColor: '#28a745' // Warna icon success
            }).then(function() {
                window.location.href = 'index.php'; // Redirect ke halaman user.html
            });
        } else if (status === "error_password") {
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: 'Password yang Anda masukkan salah. Coba lagi.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#dc3545', // Warna tombol OK
                background: '#343a40', // Background alert
                color: '#fff', // Teks alert
                iconColor: '#dc3545' // Warna icon error
            });
        } else if (status === "error_email") {
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: 'Email tidak ditemukan. Silakan periksa kembali atau daftar akun baru.',
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

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
            $_SESSION['role'] = $user['role']; // Set sesi role untuk menentukan hak akses

            // Arahkan berdasarkan role
            if ($user['role'] === 'admin') {
                header("Location: adminpanel.php"); // Redirect ke halaman admin panel untuk admin
            } else {
                header("Location: index.php"); // Redirect ke halaman index untuk user biasa
            }
            exit(); // Menghentikan eksekusi script lebih lanjut
        } else {
            $message_status = "error_password"; // Salah password
        }
    } else {
        $message_status = "error_email"; // Email tidak ditemukan
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form | Fotomemori</title>
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
        <!-- Login form container -->
        <form action="login.php" method="POST">
            <h3>LOGIN</h3>

            <!-- Email input box -->
            <div class="input_box">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter email address" required />
            </div>

            <!-- Password input box -->
            <div class="input_box">
                <div class="password_title">
                    <label for="password">Password</label>
                    <a href="#">Lupa Sandi?</a>
                </div>
                <input type="password" name="password" id="password" placeholder="Enter your password" required />
            </div>

            <!-- Login button -->
            <button type="submit">Log In</button>

            <p class="sign_up">Don't have an account? <a href="register.php">Sign up</a></p>
        </form>
    </div>

    <!-- SweetAlert2 Notification -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var status = "<?php echo $message_status; ?>";

            if (status === "error_password") {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal!',
                    text: 'Password yang Anda masukkan salah. Coba lagi.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#e74c3c',
                    background: '#ffffff',
                    color: '#333',
                    iconColor: '#e74c3c',
                    customClass: {
                        popup: 'border-rounded' // Tambahkan class CSS untuk tepi kotak
                    }
                });
            } else if (status === "error_email") {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal!',
                    text: 'Email tidak ditemukan. Silakan periksa kembali atau daftar akun terlebih dahulu.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#e74c3c',
                    background: '#ffffff',
                    color: '#333',
                    iconColor: '#e74c3c',
                    customClass: {
                        popup: 'border-rounded'
                    }
                });
            }
        });
    </script>

    <!-- Custom CSS untuk tampilan kotak pada SweetAlert2 -->
    <style>
        .border-rounded {
            border-radius: 0px; /* Sisi kotak */
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
        }
    </style>
</body>

</html>

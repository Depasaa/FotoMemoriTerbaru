<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'db_fotomemori');

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

    // Query untuk menyimpan data
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman login atau halaman lain setelah pendaftaran berhasil
        header("Location: index.html"); // Ganti 'login.php' dengan halaman yang diinginkan
        exit(); // Menghentikan eksekusi skrip untuk mencegah output lebih lanjut
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Login and Registration Form</title>
    <link rel="stylesheet" href="login.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</body>

</html>
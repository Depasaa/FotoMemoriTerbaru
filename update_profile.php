<?php
session_start(); // Memulai sesi

// Cek apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.php'); // Arahkan ke halaman login jika tidak
    exit();
}

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'db_fotomemori');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$user_id = $_SESSION['user_id']; // Ambil ID pengguna dari sesi

// Cek jika password diisi
if (!empty($password)) {
    // Hash password baru
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET username=?, email=?, phone=?, password=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssi', $username, $email, $phone, $password_hash, $user_id);
} else {
    $sql = "UPDATE users SET username=?, email=?, phone=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $username, $email, $phone, $user_id);
}

// Eksekusi query
if ($stmt->execute()) {
    // Redirect ke halaman profil dengan pesan sukses
    header('Location: profil.php?status=success');
} else {
    // Redirect ke halaman profil dengan pesan error
    header('Location: profil.php?status=error');
}

$stmt->close();
$conn->close();
?>

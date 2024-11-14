<?php
session_start();
include 'koneksi.php'; // Pastikan file koneksi.php sudah terhubung

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Ambil ID pengguna yang sudah login
$user_id = $_SESSION['user_id'];

// Periksa apakah form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $bio = $_POST['bio'];

    // Update profil pengguna di database
    $statement = $conn->prepare("UPDATE users SET name = :name, email = :email, phone = :phone, bio = :bio WHERE id = :id");
    $statement->bindParam(':name', $name);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':phone', $phone);
    $statement->bindParam(':bio', $bio);
    $statement->bindParam(':id', $user_id);
    $statement->execute();

    // Redirect kembali ke halaman profil setelah berhasil
    header("Location: profiluser.php");
    exit();
}
?>

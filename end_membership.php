<?php
session_start();
include('koneksi.php'); // Pastikan koneksi database sudah terhubung

// Cek apakah user_id dikirim dan user sedang login
if (!isset($_POST['user_id']) || !isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_POST['user_id'];

// Update role pengguna menjadi 'user' dalam database
$query = "UPDATE users SET role = 'user' WHERE id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();

// Set session untuk menampilkan modal berhasil
$_SESSION['membership_ended'] = true;

// Redirect ke halaman membership_details.php dengan status berhasil
header("Location: membership_details.php");
exit();
?>

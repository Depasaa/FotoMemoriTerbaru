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

// Ambil data pengguna dari database
$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindParam(':id', $user_id);
$stmt->execute();
$user = $stmt->fetch();

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

    // Jika pengguna adalah fotografer, update keahlian mereka
    if ($user['role'] === 'fotografer') {
        // Ambil keahlian yang dipilih
        $skills = isset($_POST['skills']) ? implode(',', $_POST['skills']) : '';

        // Update keahlian fotografer di database
        $stmt = $conn->prepare("UPDATE users SET skills = :skills WHERE id = :id");
        $stmt->bindParam(':skills', $skills);
        $stmt->bindParam(':id', $user_id); // Menggunakan $user_id karena sudah ada di session
        $stmt->execute();
    }

    // Redirect kembali ke halaman profil setelah berhasil
    header("Location: profiluser.php");
    exit();
}
?>

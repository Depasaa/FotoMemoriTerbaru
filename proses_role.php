<?php
require 'koneksi.php'; // Pastikan file koneksi database Anda sudah benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Decode data JSON yang dikirim dari callback Midtrans
        $data = json_decode($_POST['json'], true);

        // Pastikan data email atau ID pengguna sudah sesuai
        if (!empty($data['email'])) {
            $email = htmlspecialchars($data['email']);

            // Update role menjadi 'fotografer'
            $update = $conn->prepare("UPDATE users SET role = 'fotografer' WHERE email = :email");
            $update->bindParam(':email', $email);
            $update->execute();

            if ($update->rowCount() > 0) {
                echo "<script>alert('Role berhasil diubah menjadi fotografer.'); window.location.href='dashboard.php';</script>";
            } else {
                echo "<script>alert('Email tidak ditemukan atau role sudah diubah.'); window.location.href='error.php';</script>";
            }
        } else {
            echo "<script>alert('Data email tidak valid.'); window.location.href='error.php';</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Metode akses tidak valid.'); window.history.back();</script>";
}
?>

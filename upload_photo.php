<?php
session_start();
include 'koneksi.php'; // Pastikan file koneksi.php sudah terhubung

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Arahkan ke halaman login jika belum login
    exit();
}

// Ambil ID pengguna yang sudah login
$user_id = $_SESSION['user_id'];

// Pastikan file gambar diunggah
if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
    $target_dir = "uploads/";
    
    // Pastikan folder uploads ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Membuat folder jika belum ada
    }

    // Sanitasi nama file untuk menghindari spasi dan karakter ilegal
    $file_name = basename($_FILES["profile_photo"]["name"]);
    $file_name = preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $file_name); // Ganti spasi dengan _
    
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file adalah gambar
    if (getimagesize($_FILES["profile_photo"]["tmp_name"])) {
        // Pindahkan file ke direktori uploads
        if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
            // Perbarui foto profil pengguna di database
            $statement = $conn->prepare("UPDATE users SET profiluser = :profiluser WHERE id = :id");
            $statement->bindParam(':profiluser', $file_name, PDO::PARAM_STR);
            $statement->bindParam(':id', $user_id, PDO::PARAM_INT);
            $statement->execute();

            // Redirect ke halaman profil setelah berhasil
            header("Location: profiluser.php");
            exit();
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar.";
        }
    } else {
        echo "File yang diunggah bukan gambar.";
    }
} else {
    echo "Tidak ada file yang diunggah atau terjadi kesalahan saat pengunggahan.";
}
?>

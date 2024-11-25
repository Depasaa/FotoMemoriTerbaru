<?php
// Pastikan Anda sudah menghubungkan dengan database
include('koneksi.php');

// Periksa apakah ID ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Siapkan query untuk menghapus pengguna berdasarkan ID
    $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Jalankan query dan cek jika penghapusan berhasil
    if ($stmt->execute()) {
        // Penghapusan berhasil, alihkan ke halaman admin atau halaman sukses
        header("Location: managefotografer.php?message=User berhasil dihapus");
        exit();
    } else {
        // Penghapusan gagal
        echo "Gagal menghapus pengguna.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>

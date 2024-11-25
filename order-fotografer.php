<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah pengguna sudah login
    if (!isset($_SESSION['user_id'])) {
        die("Anda harus login untuk melakukan pemesanan.");
    }

    if (!isset($_SESSION['fotografer_id']) && isset($_GET['fotografer_id'])) {
        $fotografer_id = $_GET['fotografer_id'];
    } else {
        $fotografer_id = $_SESSION['fotografer_id'];
    }

    // Query untuk mendapatkan data fotografer berdasarkan ID dan role 'fotografer'
    $query = $conn->prepare("SELECT * FROM users WHERE id = :id AND role = 'fotografer'");
    $query->bindParam(':id', $fotografer_id, PDO::PARAM_INT);
    $query->execute();
    $fotografer = $query->fetch(PDO::FETCH_ASSOC);

    if (!$fotografer) {
        die("Fotografer tidak ditemukan atau ID tidak valid.");
    }

    // Ambil data dari form
    $user_id = $_SESSION['user_id'];
    $tanggal = $_POST['tanggal'] ?? null;
    $jam = $_POST['jam'] ?? null;
    $lokasi = $_POST['lokasi'] ?? null;
    $kategori = $_POST['kategori'] ?? null;
    $pesan = $_POST['pesan'] ?? null;

    // Validasi input
    if (empty($tanggal) || empty($jam) || empty($lokasi) || empty($kategori)) {
        echo "<script>
            alert('Semua kolom wajib diisi.');
            window.history.back();
        </script>";
        exit;
    }

    // Simpan pemesanan ke database
    $sql = "INSERT INTO tb_pemesanan (user_id, fotografer_id, tanggal, jam, lokasi, kategori, pesan, status)
            VALUES (:user_id, :fotografer_id, :tanggal, :jam, :lokasi, :kategori, :pesan, 'pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':fotografer_id', $fotografer_id);
    $stmt->bindParam(':tanggal', $tanggal);
    $stmt->bindParam(':jam', $jam);
    $stmt->bindParam(':lokasi', $lokasi);
    $stmt->bindParam(':kategori', $kategori);
    $stmt->bindParam(':pesan', $pesan);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>
            alert('Anda berhasil melakukan order, tunggu fotografer yang bersangkutan sampai menghubungi anda untuk konfirmasi lebih lanjut!');
            window.location.href = 'profilfotografer.php?id=" . $fotografer_id . "';
        </script>";
    } else {
        echo "<script>
            alert('Pemesanan gagal. Silakan coba lagi.');
            window.history.back();
        </script>";
    }
}
?>

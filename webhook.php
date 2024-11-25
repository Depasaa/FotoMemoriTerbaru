<?php
// Pastikan untuk memuat file yang diperlukan
require_once 'koneksi.php'; // Koneksi ke database
require_once 'vendor/autoload.php'; // Autoload Midtrans

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'SB-Mid-server-YRtF6v9UqDDfyW4LeOSther8';
\Midtrans\Config::$isProduction = false;

$input = json_decode(file_get_contents('php://input'), true); // Ambil input JSON dari Midtrans

// Validasi Signature Key
$signature = $_SERVER['HTTP_X_MIDTRANS_SIGNATURE'];
$expected_signature = hash_hmac('sha512', json_encode($input), \Midtrans\Config::$serverKey);

// Jika signature tidak cocok, hentikan proses
if ($signature != $expected_signature) {
    echo 'Invalid signature';
    exit();
}

// Ambil informasi transaksi
$order_id = $input['order_id'];
$transaction_status = $input['transaction_status']; // Status transaksi dari Midtrans

// Cek apakah statusnya 'settlement' (berhasil)
if ($transaction_status == 'settlement') {
    // Ambil user_id dari order_id, misalnya dengan mencari di database
    $sql = "SELECT user_id FROM tb_membership WHERE order_id = :order_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':order_id', $order_id);
    $stmt->execute();
    $membership = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($membership) {
        $user_id = $membership['user_id'];

        // Ubah role pengguna menjadi 'fotografer'
        $sql = "UPDATE users SET role = 'fotografer' WHERE id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);

        if ($stmt->execute()) {
            echo 'Role updated to photographer';
        } else {
            echo 'Failed to update role';
        }
    } else {
        echo 'Membership not found';
    }
} else {
    echo 'Transaction not successful';
}
?>

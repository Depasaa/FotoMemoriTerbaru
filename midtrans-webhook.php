<?php
session_start();
require_once 'koneksi.php'; // Pastikan koneksi ke database
require_once 'vendor/autoload.php'; // Path autoload Midtrans

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'SB-Mid-server-YRtF6v9UqDDfyW4LeOSther8';
\Midtrans\Config::$isProduction = false;

// Mendapatkan data dari webhook
$data = file_get_contents('php://input');
$notification = json_decode($data, true);

// Mengecek apakah status pembayaran adalah "settlement" (berhasil)
if ($notification['transaction_status'] == 'settlement') {
    $order_id = $notification['order_id']; // Mengambil order_id
    $transaction_id = $notification['transaction_id']; // Mengambil transaction_id
    $user_id = substr($order_id, 6); // Mengambil user_id dari order_id yang sudah diberi prefix "ORDER-"

    // Mengupdate status pembayaran dan role menjadi 'fotografer' setelah pembayaran berhasil
    $sql = "UPDATE tb_membership SET payment_status = 'settlement' WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    // Mengupdate role pengguna menjadi 'fotografer' setelah pembayaran berhasil
    $sql_update_role = "UPDATE users SET role = 'fotografer' WHERE id = :user_id";
    $stmt_update_role = $conn->prepare($sql_update_role);
    $stmt_update_role->bindParam(':user_id', $user_id);
    $stmt_update_role->execute();

    // Kirimkan response success untuk Midtrans
    echo "OK";
} else {
    echo "Payment not settled";
}
?>

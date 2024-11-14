<?php
// proses_pembayaran.php

// Memuat SDK Midtrans
require_once './vendor/autoload.php';  // Pastikan path ke autoload.php sesuai

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'SB-Mid-server-YRtF6v9UqDDfyW4LeOSther8'; // Ganti dengan server key Midtrans Anda
\Midtrans\Config::$clientKey = 'SB-Mid-client-Qvh1BNENrpm1dwOr'; // Ganti dengan client key Midtrans Anda
\Midtrans\Config::$isProduction = false;  // Set ke true jika sudah live, false untuk sandbox

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['membership_id'])) {
    $membership_id = $_POST['membership_id'];

    // Koneksi ke database
    include('koneksi.php'); 

    // Periksa apakah membership_id valid
    $query = "SELECT * FROM memberships WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $membership_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $membership = $result->fetch_assoc();

    if (!$membership) {
        echo "Membership tidak ditemukan.";
        exit();
    }

    // Menyiapkan data untuk pembayaran
    $transaction_details = array(
        'order_id' => 'ORDER-' . uniqid(),  // ID unik untuk setiap transaksi
        'gross_amount' => $membership['price'], // Harga membership
    );

    $customer_details = array(
        'first_name'    => 'John', // Ganti dengan nama pelanggan
        'last_name'     => 'Doe',  // Ganti dengan nama belakang pelanggan
        'email'         => 'john.doe@example.com', // Ganti dengan email pelanggan
        'phone'         => '081234567890' // Ganti dengan nomor telepon pelanggan
    );

    // Membuat transaksi Midtrans
    $transaction = array(
        'payment_type' => 'credit_card',  // Atau gunakan metode lain sesuai dengan kebutuhan (e.g., bank_transfer, etc.)
        'credit_card' => array(
            'secure' => true  // Untuk autentikasi 3D Secure
        ),
        'transaction_details' => $transaction_details,
        'customer_details' => $customer_details
    );

    try {
        // Request ke Midtrans untuk membuat transaksi
        $charge = \Midtrans\Transaction::create($transaction);

        // Redirect ke halaman pembayaran Midtrans
        header('Location: ' . $charge->redirect_url);
        exit();
    } catch (Exception $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
        exit();
    }
}
?>

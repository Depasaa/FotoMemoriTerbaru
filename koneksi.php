<?php
$host = 'localhost'; // Sesuaikan dengan host database Anda
$db   = 'db_fotomemori'; // Nama database Anda
$user = 'root'; // Username database Anda
$pass = ''; // Password database Anda (biarkan kosong jika tidak ada)

$dsn = "mysql:host=$host;dbname=$db;charset=utf8";

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

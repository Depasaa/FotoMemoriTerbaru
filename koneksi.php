<?php
try {
    // Ubah sesuai konfigurasi MySQL
    $conn = new PDO("mysql:host=localhost;dbname=db_fotomemori", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

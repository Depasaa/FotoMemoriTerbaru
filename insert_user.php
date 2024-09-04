<?php
// Koneksi ke database
include 'koneksi.php'; // Asumsi 'koneksi.php' menggunakan PDO

// Data user yang ingin dimasukkan
$email = 'admin@fotomemory.com';
$password = 'admin123'; // Password asli

// Buat hash dari password menggunakan password_hash()
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    // Siapkan query SQL untuk memasukkan data
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);

    // Bind parameter dan eksekusi statement
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);
    
    if ($stmt->execute()) {
        echo "Data user berhasil disimpan!";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Tutup koneksi
$conn = null;
?>
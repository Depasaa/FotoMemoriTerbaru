<?php
// Pastikan koneksi database di-*include*
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $bio = $_POST['bio'];
    $role = $_POST['role'];

    try {
        // Siapkan pernyataan SQL
        $stmt = $conn->prepare("UPDATE users SET name = :name, email = :email, phone = :phone, role = :role WHERE id = :id");

        // Mengikat parameter
        $stmt = $conn->prepare("UPDATE users SET name = :name, email = :email, phone = :phone, bio = :bio, role = :role WHERE id = :id");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);  // Mengikat parameter untuk kolom bio
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);

        $stmt->execute();


        // Eksekusi pernyataan
        $stmt->execute();

        // Kembali ke halaman yang sama dengan notifikasi sukses
        header("Location: managefotografer.php?update=success");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
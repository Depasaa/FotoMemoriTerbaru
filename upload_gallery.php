<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['new_image_url']) && isset($_POST['image_id'])) {
        $newImageUrl = $_POST['new_image_url'];
        $imageId = $_POST['image_id'];
        
        // Update URL gambar di database
        $stmt = $conn->prepare("UPDATE gallery SET file_name = :new_image_url WHERE id = :image_id");
        $stmt->bindParam(':new_image_url', $newImageUrl);
        $stmt->bindParam(':image_id', $imageId);
        $stmt->execute();

        echo "Gambar berhasil diperbarui!";
    } else {
        echo "Data tidak lengkap!";
    }
}
?>

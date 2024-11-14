<?php
session_start();

// Menghancurkan session untuk logout
session_unset();
session_destroy();

// Arahkan pengguna ke halaman index.php (berstatus belum login)
header('Location: index.php');
exit();
?>

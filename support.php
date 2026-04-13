<?php
require __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    mysqli_query($conn, "UPDATE cerita SET supports = supports + 1 WHERE id = $id");
    
    // Ambil id cerita lalu redirect balik ke halaman detail
    header("Location: detail.php?id=$id");
    exit;
}

// Kalau diakses langsung tanpa POST, redirect ke beranda
header("Location: index.php");
exit;
?>
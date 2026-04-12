<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cerita_id'], $_POST['isi'])) {
    $cerita_id = (int) $_POST['cerita_id'];
    $isi = trim($_POST['isi']);

    if ($isi && strlen($isi) <= 100) {
        $isi = mysqli_real_escape_string($conn, $isi);
        mysqli_query($conn, "INSERT INTO komentar (cerita_id, isi) VALUES ('$cerita_id', '$isi')");
    }

    header("Location: detail.php?id=$cerita_id");
    exit;
}

header("Location: index.php");
exit;
?>
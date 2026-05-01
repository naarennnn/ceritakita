<?php
require __DIR__ . '/db.php';
header('Content-Type: application/json');

$ids = $_GET['ids'] ?? '';
$ids = array_filter(array_map('intval', explode(',', $ids)));

if (empty($ids)) {
    echo json_encode([]);
    exit;
}

$idList = implode(',', $ids);
$result = mysqli_query($conn, "SELECT id, judul, isi, kategori, nama, anonim, supports FROM cerita WHERE id IN ($idList)");
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($data);
?>
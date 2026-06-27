<?php
require __DIR__ . '/db.php';

$id     = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$action = isset($_POST['action']) ? $_POST['action'] : 'like';

if (!$id) {
    echo json_encode(['total' => 0]);
    exit;
}

if ($action === 'unlike') {
    mysqli_query($conn, "UPDATE cerita SET supports = GREATEST(supports - 1, 0) WHERE id = $id");
} else {
    mysqli_query($conn, "UPDATE cerita SET supports = supports + 1 WHERE id = $id");
}

$result = mysqli_query($conn, "SELECT supports FROM cerita WHERE id = $id");
$row    = mysqli_fetch_assoc($result);

header('Content-Type: application/json');
echo json_encode(['total' => (int)$row['supports']]);

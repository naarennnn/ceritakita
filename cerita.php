<?php
require 'db.php';

$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Ambil kategori otomatis dari database
$katResult = mysqli_query($conn, "SELECT DISTINCT kategori FROM cerita ORDER BY kategori ASC");
$kategoriValid = [];
while ($row = mysqli_fetch_assoc($katResult)) {
    $kategoriValid[] = $row['kategori'];
}
if ($kategori && in_array($kategori, $kategoriValid)) {
    $k = mysqli_real_escape_string($conn, $kategori);
    $result = mysqli_query($conn,
        "SELECT * FROM cerita WHERE kategori = '$k' ORDER BY created_at DESC");
} else {
    $result = mysqli_query($conn,
        "SELECT * FROM cerita ORDER BY created_at DESC");
}

$semuaCerita = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Semua Cerita - CeritaKita</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<div class="page-hero">
  <h1>Semua Cerita</h1>
  <p>Cerita nyata dari perempuan nyata. Kamu gak sendiri.</p>
</div>

<div class="filter-bar">
  <a href="cerita.php" class="filter-chip <?= !$kategori ? 'active' : '' ?>">Semua</a>
  <?php foreach ($kategoriValid as $k): ?>
    <a href="cerita.php?kategori=<?= urlencode($k) ?>"
       class="filter-chip <?= $kategori === $k ? 'active' : '' ?>">
      <?= $k ?>
    </a>
  <?php endforeach; ?>
</div>

<div class="stories-list">
  <?php foreach ($semuaCerita as $c): ?>
    <?php include 'includes/card.php'; ?>
  <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'db.php';

$highlight = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT * FROM cerita WHERE highlight = 1 ORDER BY created_at DESC LIMIT 1"));

$result = mysqli_query($conn,
    "SELECT * FROM cerita ORDER BY created_at DESC LIMIT 3");
$ceritaTerbaru = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CeritaKita</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<div class="hero">
  <div class="hero-badge">Anonim. Aman. Nyata.</div>
  <h1>Tempat perempuan bercerita,<br><em>tanpa harus terlihat baik-baik saja</em></h1>
  <p>Kadang kita hanya butuh tempat yang bisa mendengarkan tanpa langsung kasih saran.</p>
  <div class="hero-btns">
    <a href="tulis.php" class="btn-primary">Tulis ceritamu</a>
    <a href="cerita.php" class="btn-secondary">Baca cerita orang</a>
  </div>
</div>

<?php if ($highlight): ?>
<div class="divider"><hr></div>
<div class="home-feed">
  <div class="highlight-banner">
    <div class="highlight-label">✦ Pilihan hari ini</div>
    <div class="highlight-text">"<?= htmlspecialchars(substr($highlight['isi'], 0, 120)) ?>..."</div>
  </div>
</div>
<?php endif; ?>

<div class="home-feed">
  <div class="home-feed-header">
    <h2>Cerita terbaru</h2>
    <a href="cerita.php" class="see-all">Lihat semua →</a>
  </div>
  <div class="stories-grid">
    <?php foreach ($ceritaTerbaru as $c): ?>
      <?php include 'includes/card.php'; ?>
    <?php endforeach; ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
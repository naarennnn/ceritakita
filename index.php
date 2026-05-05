<?php
require __DIR__ . '/db.php';

$highlight = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT * FROM cerita WHERE highlight = 1 ORDER BY created_at DESC LIMIT 1"));

$result = mysqli_query($conn,
    "SELECT * FROM cerita ORDER BY created_at DESC LIMIT 3");
$ceritaTerbaru = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='8' fill='%23FAF7F2'/><text x='3' y='23' font-family='Georgia,serif' font-size='20' font-weight='700' fill='%235C4A32'>C</text><text x='15' y='23' font-family='Georgia,serif' font-size='16' font-style='italic' fill='%23C4A882'>K</text></svg>" type="image/svg+xml">
  <title>CeritaKita</title>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include __DIR__ . '/includes/navbar.php'; ?>

<div class="hero">
  <div class="hero-badge">Anonim. Aman. Nyata.</div>
  <h1>Tempat perempuan bercerita,<br><em>tanpa takut dihakimi</em></h1>
  <p>Kadang kita butuh tempat yang bisa dengerin tanpa langsung kasih saran.</p>
  <div class="hero-btns">
    <a href="tulis.php" class="btn-hero">Tulis ceritamu</a>
    <a href="cerita.php" class="btn-hero">Baca cerita orang</a>
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
      <?php include __DIR__ . '/includes/card.php'; ?>
    <?php endforeach; ?>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
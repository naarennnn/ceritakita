<?php
require __DIR__ . '/db.php';

$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

$katResult = mysqli_query($conn, "SELECT DISTINCT kategori FROM cerita ORDER BY kategori ASC");
$kategoriValid = [];
while ($row = mysqli_fetch_assoc($katResult)) {
    $kategoriValid[] = $row['kategori'];
}

if ($kategori && in_array($kategori, $kategoriValid)) {
    $k = mysqli_real_escape_string($conn, $kategori);
    $result = mysqli_query($conn, "SELECT * FROM cerita WHERE kategori = '$k' ORDER BY created_at DESC");
} else {
    $result = mysqli_query($conn, "SELECT * FROM cerita ORDER BY created_at DESC");
}

$semuaCerita = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='8' fill='%23FAF7F2'/><text x='3' y='23' font-family='Georgia,serif' font-size='20' font-weight='700' fill='%235C4A32'>C</text><text x='15' y='23' font-family='Georgia,serif' font-size='16' font-style='italic' fill='%23C4A882'>K</text></svg>" type="image/svg+xml">
  <title>Semua Cerita - CeritaKita</title>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link rel="stylesheet" href="assets/style.css">
  <style>
    .filter-bar {
      position: relative;
      display: flex;
      gap: 0;
      flex-wrap: nowrap;
      overflow-x: auto;
      padding: 0.35rem;
      background: var(--cream2);
      border-radius: 100px;
      max-width: 900px;
      margin: 0 auto 1.5rem;
      scrollbar-width: none;
    }
    .filter-bar::-webkit-scrollbar { display: none; }
    .filter-pill {
      position: absolute;
      height: calc(100% - 0.7rem);
      top: 0.35rem;
      background: #fff;
      border-radius: 100px;
      box-shadow: 0 1px 4px rgba(92,74,50,0.12);
      transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
      pointer-events: none;
      z-index: 0;
    }
    .filter-chip {
      position: relative;
      z-index: 1;
      white-space: nowrap;
      padding: 0.4rem 1rem;
      border-radius: 100px;
      font-size: 0.78rem;
      font-family: 'Poppins', sans-serif;
      font-weight: 400;
      color: var(--text-muted) !important;
      border: none;
      background: none;
      cursor: pointer;
      transition: color 0.2s;
      text-decoration: none !important;
      display: inline-block;
    }
    .filter-chip:hover { color: var(--brown-dark) !important; }
    .filter-chip.active { color: var(--brown-dark) !important; font-weight: 500; }
  </style>
</head>
<body>

<?php include __DIR__ . '/includes/navbar.php'; ?>

<div class="page-hero">
  <h1>Semua Cerita</h1>
  <p>Cerita nyata dari orang-orang nyata. Kamu gak sendiri.</p>
</div>

<div class="filter-bar" id="filter-bar">
  <div class="filter-pill" id="filter-pill"></div>
  <a href="cerita.php" class="filter-chip <?= !$kategori ? 'active' : '' ?>" data-kat="">Semua</a>
  <?php foreach ($kategoriValid as $k): ?>
    <a href="cerita.php?kategori=<?= urlencode($k) ?>"
       class="filter-chip <?= $kategori === $k ? 'active' : '' ?>"
       data-kat="<?= htmlspecialchars($k) ?>">
      <?= $k ?>
    </a>
  <?php endforeach; ?>
</div>

<div class="stories-list">
  <?php foreach ($semuaCerita as $c): ?>
    <?php include __DIR__ . '/includes/card.php'; ?>
  <?php endforeach; ?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const bar    = document.getElementById('filter-bar');
  const pill   = document.getElementById('filter-pill');
  const chips  = document.querySelectorAll('.filter-chip');
  const active = document.querySelector('.filter-chip.active');

  function movePill(el) {
    if (!el) return;
    pill.style.width  = el.offsetWidth + 'px';
    pill.style.left   = el.offsetLeft + 'px';
    pill.style.opacity = '1';
  }

  // Set posisi awal ke chip yang aktif
  if (active) movePill(active);

  chips.forEach(chip => {
    chip.addEventListener('mouseenter', function() {
      movePill(this);
    });
    chip.addEventListener('mouseleave', function() {
      if (active) movePill(active);
    });
  });
});
</script>

</body>
</html>
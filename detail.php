<?php
require __DIR__ . '/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$result = mysqli_query($conn, "SELECT * FROM cerita WHERE id = $id");
$c = mysqli_fetch_assoc($result);

if (!$c) {
    header("Location: index.php");
    exit;
}

$catClass = [
    'Akademik'           => 'cat-akademik',
    'Keluarga'           => 'cat-keluarga',
    'Percintaan'         => 'cat-percintaan',
    'Karir & Masa Depan' => 'cat-karir',
    'Mental Health'      => 'cat-mentalhealth',
    'Pertemanan'         => 'cat-pertemanan',
    'Identitas Diri'     => 'cat-identitas',
    'Tekanan Sosial'     => 'cat-tekanansoial',
];

$komResult = mysqli_query($conn, "SELECT * FROM komentar WHERE cerita_id = $id ORDER BY created_at DESC");
$komentars = mysqli_fetch_all($komResult, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='8' fill='%23FAF7F2'/><text x='3' y='23' font-family='Georgia,serif' font-size='20' font-weight='700' fill='%235C4A32'>C</text><text x='15' y='23' font-family='Georgia,serif' font-size='16' font-style='italic' fill='%23C4A882'>K</text></svg>" type="image/svg+xml">
  <title><?= htmlspecialchars($c['judul']) ?> - CeritaKita</title>

  <!-- Open Graph / Preview Card -->
  <meta property="og:type"        content="article">
  <meta property="og:site_name"   content="CeritaKita">
  <meta property="og:title"       content="<?= htmlspecialchars($c['judul']) ?>">
  <meta property="og:description" content="<?= htmlspecialchars(substr($c['isi'], 0, 150)) ?>...">
  <meta property="og:url"         content="https://ceritakita.id/detail.php?id=<?= $c['id'] ?>">
  <meta property="og:image"       content="https://ceritakita.id/assets/og-image.png">
  <meta property="og:image:width"  content="1200">
  <meta property="og:image:height" content="630">

  <!-- Twitter Card -->
  <meta name="twitter:card"        content="summary_large_image">
  <meta name="twitter:title"       content="<?= htmlspecialchars($c['judul']) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars(substr($c['isi'], 0, 150)) ?>...">
  <meta name="twitter:image"       content="https://ceritakita.id/assets/og-image.png">

  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include __DIR__ . '/includes/navbar.php'; ?>

<div class="detail-wrap">

  <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:2rem">
    <a href="cerita.php" class="back-btn">← Kembali</a>
    <span class="detail-cat <?= $catClass[$c['kategori']] ?? '' ?>">
      <?= $c['kategori'] ?>
    </span>
  </div>

  <div class="detail-title"><?= htmlspecialchars($c['judul']) ?></div>

  <div class="detail-meta">
    <span><?= $c['anonim'] ? 'Anonim' : htmlspecialchars($c['nama']) ?></span>
    <span>·</span>
    <span><?= date('d M Y', strtotime($c['created_at'])) ?></span>
  </div>

  <!-- Konten cerita dalam card -->
  <div style="background:#fff;border:1px solid var(--cream2);border-radius:16px;padding:2rem;margin-bottom:2rem;line-height:1.9;font-size:0.95rem;color:var(--text-main);font-weight:300;font-family:'Poppins',sans-serif">
    <?= nl2br(htmlspecialchars($c['isi'])) ?>
  </div>

  <!-- Like & Aksi -->
  <div class="support-big">
    <p>Cerita ini menyentuh hatimu?</p>
    <button class="support-big-btn" id="detail-like-btn" onclick="toggleLike(null, <?= $c['id'] ?>)">
      <i class="ph ph-heart" id="like-icon-<?= $c['id'] ?>" style="font-size:1.1rem"></i>
      <span id="like-label-<?= $c['id'] ?>">Suka</span>
    </button>
    <span class="support-count">
      <span id="like-count-<?= $c['id'] ?>"><?= $c['supports'] ?></span> orang menyukai cerita ini
    </span>
    <div style="display:flex;gap:0.75rem;margin-top:0.75rem;flex-wrap:wrap;justify-content:center">
      <button class="action-btn" id="detail-save-btn"
        onclick="toggleBookmark(null, <?= $c['id'] ?>, '<?= addslashes(htmlspecialchars($c['judul'])) ?>')">
        <i class="ph ph-star"></i> Simpan
      </button>
      <button class="action-btn" onclick="showShareCard(event,
        <?= $c['id'] ?>,
        '<?= addslashes(htmlspecialchars($c['judul'])) ?>',
        '<?= addslashes(htmlspecialchars(substr($c['isi'], 0, 200))) ?>',
        '<?= addslashes($c['kategori']) ?>'
      )">
        <i class="ph ph-share-network"></i> Bagikan
      </button>
    </div>
  </div>

</div>

<!-- Komentar -->
<div class="komentar-wrap">
  <h3 class="komentar-title">Pesan untuk penulis</h3>
  <p class="komentar-subtitle">Semua pesan anonim. Jaga kata-katamu ya
    <i class="ph-fill ph-heart-straight" style="color:#C0547A;font-size:0.9rem;vertical-align:middle"></i>
  </p>

  <form action="komentar.php" method="POST" class="komentar-form">
    <input type="hidden" name="cerita_id" value="<?= $c['id'] ?>">
    <div class="komentar-input-wrap">
      <input type="text" name="isi" class="komentar-input"
             placeholder="Tulis pesanmu... (maks. 100 karakter)"
             maxlength="100" required>
      <button type="submit" class="komentar-submit">
        <i class="ph-fill ph-paper-plane-right" style="color:#FAF7F2;font-size:1rem"></i> Kirim
      </button>
    </div>
    <span class="komentar-hint">
      <i class="ph ph-lock-simple" style="color:#5C4A32;font-size:1rem"></i>
      <span style="color:#5C4A32;font-size:0.8rem">Pesanmu tidak akan menampilkan namamu</span>
    </span>
  </form>

  <?php if (count($komentars) > 0): ?>
    <div class="komentar-list">
      <?php foreach ($komentars as $k): ?>
        <div class="komentar-item">
          <div class="komentar-avatar"><i class="ph ph-user"></i></div>
          <div class="komentar-content">
            <p><?= htmlspecialchars($k['isi']) ?></p>
            <span>Anonim · <?= date('d M Y', strtotime($k['created_at'])) ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p class="komentar-empty">
      Belum ada pesan. Jadilah yang pertama menyemangati
      <i class="ph-fill ph-heart-straight" style="color:#C0547A;font-size:0.9rem;vertical-align:middle"></i>
    </p>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
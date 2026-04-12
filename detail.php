<?php
require 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$result = mysqli_query($conn, "SELECT * FROM cerita WHERE id = $id");
$c = mysqli_fetch_assoc($result);

if (!$c) {
    header("Location: index.php");
    exit;
}

$catClass = [
    'Kuliah'             => 'cat-kuliah',
    'Keluarga'           => 'cat-keluarga',
    'Percintaan'         => 'cat-percintaan',
    'Self Growth'        => 'cat-selfgrowth',
    'Mental Health'      => 'cat-mentalhealth',
    'Toxic Relationship' => 'cat-toxicrelationship',
    'Insecure'           => 'cat-insecure',
    'Ekspetasi Sosial'   => 'cat-ekspetasisosial',
];

$supportText = [
    'Kuliah'             => 'Kamu hanya sedang capek, bukan gagal',
    'Keluarga'           => 'Gak semuanya harus kamu tanggung sendiri',
    'Percintaan'         => 'Kalo hanya rasa sakit, itu bukan cinta',
    'Self Growth'        => 'Pelan-pelan aja ya, gak semua hal harus instan',
    'Mental Health'      => 'Kamu sedang berjuang, bukan lemah',
    'Toxic Relationship' => 'Dia gak berubah, kamu yang harus pergi',
    'Insecure'           => 'Kamu cukup tanpa menjadi orang lain',
    'Ekspetasi Sosial'   => 'Hidup kamu bukan standar mereka',
];
$support = $supportText[$c['kategori']] ?? 'Kamu gak sendiri';

$komResult = mysqli_query($conn, "SELECT * FROM komentar WHERE cerita_id = $id ORDER BY created_at DESC");
$komentars = mysqli_fetch_all($komResult, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($c['judul']) ?> - CeritaKita</title>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<div class="detail-wrap">
  <a href="cerita.php" class="back-btn">← Kembali</a>

  <span class="detail-cat <?= $catClass[$c['kategori']] ?? '' ?>">
    <?= $c['kategori'] ?>
  </span>

  <div class="detail-title"><?= htmlspecialchars($c['judul']) ?></div>

  <div class="detail-meta">
    <span><?= $c['anonim'] ? 'Anonim' : htmlspecialchars($c['nama']) ?></span>
    <span>·</span>
    <span><?= date('d M Y', strtotime($c['created_at'])) ?></span>
  </div>

  <div class="detail-body">
    <?= nl2br(htmlspecialchars($c['isi'])) ?>
  </div>

  <div class="support-big">
    <p>Cerita ini menyentuh hatimu?</p>
    <form action="support.php" method="POST">
      <input type="hidden" name="id" value="<?= $c['id'] ?>">
      <button type="submit" class="support-big-btn">
        <i class="ph-fill ph-heart-straight" style="color:#C0547A;font-size:1.1rem"></i> <?= $support ?>
      </button>
    </form>
    <span class="support-count">
      <?= $c['supports'] ?> Semua orang merasakan hal yang sama
    </span>
  </div>
</div>

<div class="komentar-wrap">
  <h3 class="komentar-title">
    Pesan untuk penulis.
  </h3>
  <p class="komentar-subtitle">
    Semua pesan anonim. Jaga kata-katamu ya. 
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
          <div class="komentar-avatar">
            <i class="ph ph-user"></i>
          </div>
          <div class="komentar-content">
            <p><?= htmlspecialchars($k['isi']) ?></p>
            <span>Anonim · <?= date('d M Y', strtotime($k['created_at'])) ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p class="komentar-empty">
      Belum ada pesan. Jadilah yang pertama menyemangati!
      <i class="ph-fill ph-heart-straight" style="color:#C0547A;font-size:0.9rem;vertical-align:middle"></i>
    </p>
  <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
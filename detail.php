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
    'Kuliah'             => 'Kamu hanya sedang lelah, bukan berarti lemah.',
    'Keluarga'           => 'Aku ngerasain juga',
    'Percintaan'         => 'Pelukanku untukmu',
    'Self Growth'        => 'Kamu udah hebat',
    'Mental Health'      => 'Kamu kuat',
    'Toxic Relationship' => 'Kamu berharga',
    'Insecure'           => 'Kamu cukup',
    'Ekspetasi Sosial'   => 'Jadilah dirimu',
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
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='8' fill='%23FAF7F2'/><text x='3' y='23' font-family='Georgia,serif' font-size='20' font-weight='700' fill='%235C4A32'>C</text><text x='15' y='23' font-family='Georgia,serif' font-size='16' font-style='italic' fill='%23C4A882'>K</text></svg>" type="image/svg+xml">
  <title><?= htmlspecialchars($c['judul']) ?> - CeritaKita</title>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include __DIR__ . '/includes/navbar.php'; ?>

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
      <?= $c['supports'] ?> orang merasakan hal yang sama
    </span>
    <div style="display:flex;gap:0.75rem;margin-top:0.75rem;flex-wrap:wrap;justify-content:center">
      <button class="action-btn" id="detail-save-btn"
        onclick="toggleBookmark(null, <?= $c['id'] ?>, '<?= addslashes(htmlspecialchars($c['judul'])) ?>')">
        <i class="ph ph-star"></i> Simpan
      </button>
      <button class="action-btn" onclick="showShareCard(
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

<!-- Share Card Modal -->
<div id="share-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:999;display:none;align-items:center;justify-content:center;padding:1rem">
  <div style="background:#fff;border-radius:20px;padding:1.5rem;max-width:400px;width:100%">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem">
      <span style="font-family:'Poppins',sans-serif;font-size:0.875rem;font-weight:500;color:var(--brown-dark)">Bagikan Cerita</span>
      <button onclick="closeShareModal()" style="background:none;border:none;cursor:pointer;font-size:1.25rem;color:var(--text-muted)">×</button>
    </div>

    <!-- Preview Card yang akan di-screenshot -->
    <div id="share-card" style="background:linear-gradient(135deg,#FAF7F2,#F2EDE4);border-radius:16px;padding:1.5rem;margin-bottom:1rem;border:1px solid #E8C5B5">
      <div style="font-family:'Georgia',serif;font-size:0.7rem;font-weight:700;color:#C4A882;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:0.75rem">CeritaKita</div>
      <div id="share-card-cat" style="display:inline-block;font-size:0.65rem;font-weight:600;padding:0.2rem 0.6rem;border-radius:100px;margin-bottom:0.6rem;text-transform:uppercase;letter-spacing:0.05em;background:#EEF2FF;color:#5B6FA6"></div>
      <div id="share-card-title" style="font-family:'Georgia',serif;font-size:1rem;font-weight:700;color:#5C4A32;margin-bottom:0.6rem;line-height:1.3"></div>
      <div id="share-card-preview" style="font-size:0.8rem;color:#8A7060;line-height:1.6;font-style:italic"></div>
      <div style="margin-top:1rem;padding-top:0.75rem;border-top:1px solid #E8C5B5;font-size:0.7rem;color:#B8A090;font-family:'Georgia',serif">
        Baca selengkapnya di CeritaKita 💛
      </div>
    </div>

    <div style="display:flex;gap:0.75rem">
      <button onclick="downloadShareCard()" class="action-btn" style="flex:1;justify-content:center">
        <i class="ph ph-download-simple"></i> Simpan Gambar
      </button>
      <button onclick="copyShareLink()" class="action-btn" style="flex:1;justify-content:center">
        <i class="ph ph-link"></i> Salin Link
      </button>
    </div>
  </div>
</div>

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

<script>
let currentShareId = null;

function showShareCard(id, judul, preview, kategori) {
  currentShareId = id;
  document.getElementById('share-card-title').textContent = judul;
  document.getElementById('share-card-preview').textContent = preview + '...';
  document.getElementById('share-card-cat').textContent = kategori;
  document.getElementById('share-modal').style.display = 'flex';
}

function closeShareModal() {
  document.getElementById('share-modal').style.display = 'none';
}

function downloadShareCard() {
  const card = document.getElementById('share-card');
  html2canvas(card, { scale: 2, backgroundColor: null }).then(canvas => {
    const link = document.createElement('a');
    link.download = 'ceritakita-' + currentShareId + '.png';
    link.href = canvas.toDataURL();
    link.click();
  });
}

function copyShareLink() {
  const url = window.location.origin + '/detail.php?id=' + currentShareId;
  navigator.clipboard.writeText(url).then(() => {
    showToast('Link berhasil disalin! 💛');
    closeShareModal();
  });
}

// Close modal kalau klik di luar
document.getElementById('share-modal').addEventListener('click', function(e) {
  if (e.target === this) closeShareModal();
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
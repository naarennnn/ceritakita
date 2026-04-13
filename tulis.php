<?php
require __DIR__ . '/db.php';

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul    = trim($_POST['judul']);
    $isi      = trim($_POST['isi']);
    $kategori = $_POST['kategori'] === 'lainnya'
                ? trim($_POST['kategori_custom'])
                : $_POST['kategori'];
    $nama     = trim($_POST['nama']) ?: 'Anonim';
    $anonim   = isset($_POST['anonim']) ? 1 : 0;

    if (!$judul || !$isi || !$kategori) {
        $error = 'Judul, isi, dan kategori wajib diisi ya 💛';
    } else {
        $judul    = mysqli_real_escape_string($conn, $judul);
        $isi      = mysqli_real_escape_string($conn, $isi);
        $kategori = mysqli_real_escape_string($conn, $kategori);
        $nama     = mysqli_real_escape_string($conn, $nama);

        mysqli_query($conn,
            "INSERT INTO cerita (judul, isi, kategori, nama, anonim)
             VALUES ('$judul', '$isi', '$kategori', '$nama', '$anonim')");
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tulis Cerita - CeritaKita</title>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<div class="form-wrap">
  <div class="form-title">Tulis ceritamu</div>
  <p class="form-sub">Ceritamu gak harus sempurna. Cukup jujur aja. Kamu bisa pilih anonim kalau belum siap.</p>

  <?php if ($success): ?>
    <div class="success-msg">
      Ceritamu sudah terkirim 💛 Terima kasih sudah berani berbagi.
    </div>
  <?php endif; ?>

  <?php if ($error): ?>
    <div style="background:#FFF0F0;border:1px solid #F0B8B8;border-radius:12px;padding:1rem;color:#C0547A;margin-bottom:1.5rem;font-size:0.9rem">
      <?= $error ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="tulis.php">

    <div class="form-group">
      <label class="form-label">Kategori</label>
      <div class="custom-select-wrap">
        <div class="custom-select-display" onclick="toggleDropdown()">
          <span id="selected-text">Pilih kategori...</span>
          <i class="ph ph-caret-down" id="caret-icon"></i>
        </div>
        <div class="custom-select-options" id="custom-options">
          <?php
          $kategoriList = ['Kuliah','Keluarga','Percintaan','Self Growth','Mental Health','Toxic Relationship','Insecure','Ekspetasi Sosial','Lainnya...'];
          foreach ($kategoriList as $k): ?>
            <div class="custom-option" onclick="pilihKategori('<?= $k ?>')">
              <?= $k ?>
            </div>
          <?php endforeach; ?>
        </div>
        <input type="hidden" name="kategori" id="kategori-value">
      </div>
      <input class="form-input" type="text" id="kategori-custom" name="kategori_custom"
             placeholder="Tulis kategorimu sendiri..."
             style="display:none;margin-top:0.75rem">
    </div>

    <div class="form-group">
      <label class="form-label">Judul cerita</label>
      <input class="form-input" type="text" name="judul"
             placeholder="Tulis judul yang jujur..." required>
    </div>

    <div class="form-group">
      <label class="form-label">Isi cerita</label>
      <textarea class="form-textarea" name="isi"
                placeholder="Ceritain aja semuanya di sini..." required></textarea>
    </div>

    <div class="form-group">
      <label class="form-label">Nama / Inisial (opsional)</label>
      <input class="form-input" type="text" name="nama"
             placeholder="Atau biarkan kosong untuk anonim">
    </div>

    <div class="form-group">
      <label class="anon-label">
        <input type="checkbox" name="anonim" value="1" class="anon-check">
        <div class="anon-box">
          <i class="ph ph-mask-happy" style="font-size:1.1rem;color:var(--brown-light)"></i>
          <span>Sembunyikan nama saya (anonim)</span>
        </div>
      </label>
    </div>

    <button type="submit" class="form-submit">Kirim ceritaku →</button>
  </form>
</div>

<?php include 'includes/footer.php'; ?>

<script>
function toggleDropdown() {
  const options = document.getElementById('custom-options');
  const display = document.querySelector('.custom-select-display');
  const caret = document.getElementById('caret-icon');
  options.classList.toggle('show');
  display.classList.toggle('open');
  caret.style.transform = options.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0)';
}

function pilihKategori(val) {
  const display = document.getElementById('selected-text');
  const input = document.getElementById('kategori-value');
  const custom = document.getElementById('kategori-custom');
  const options = document.getElementById('custom-options');
  const displayWrap = document.querySelector('.custom-select-display');
  const caret = document.getElementById('caret-icon');

  document.querySelectorAll('.custom-option').forEach(o => o.classList.remove('active'));
  event.target.classList.add('active');

  display.textContent = val;
  displayWrap.classList.add('selected');
  options.classList.remove('show');
  displayWrap.classList.remove('open');
  caret.style.transform = 'rotate(0)';

  if (val === 'Lainnya...') {
    input.value = 'lainnya';
    custom.style.display = 'block';
    custom.required = true;
  } else {
    input.value = val;
    custom.style.display = 'none';
    custom.required = false;
  }
}

document.addEventListener('click', function(e) {
  if (!e.target.closest('.custom-select-wrap')) {
    document.getElementById('custom-options').classList.remove('show');
    document.querySelector('.custom-select-display').classList.remove('open');
    document.getElementById('caret-icon').style.transform = 'rotate(0)';
  }
});
</script>

</body>
</html>
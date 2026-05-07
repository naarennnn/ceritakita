<?php
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

$catIcon = [
    'Kuliah'             => 'ph-book-open',
    'Keluarga'           => 'ph-house',
    'Percintaan'         => 'ph-heart',
    'Self Growth'        => 'ph-leaf',
    'Mental Health'      => 'ph-brain',
    'Toxic Relationship' => 'ph-warning',
    'Insecure'           => 'ph-cloud-rain',
    'Ekspetasi Sosial'   => 'ph-users',
];

$supportText = [
    'Kuliah'             => 'Kamu hanya sedang lelah, bukan berarti lemah.',
    'Keluarga'           => 'Istirahat dulu yuk, kamu gak harus menanggung semua beban sendiri.',
    'Percintaan'         => 'Cinta memang indah, tapi kalo udah gak bisa diperbaiki, tinggalin aja ya.',
    'Self Growth'        => 'Kamu bukan lambat, tapi kamu sedang berjalan dengan perlahan.',
    'Mental Health'      => 'Nangis dulu yuk, kamu juga berhak mengeluarkan air mata.',
    'Toxic Relationship' => 'Meninggalkan memang berat, tapi kamu berhak bahagia.',
    'Insecure'           => 'Standar mereka bukan patokan hidup kamu. Be yourself!',
    'Ekspetasi Sosial'   => 'Hidup kamu hanya untuk kamu, ikuti kata hati bukan kata manusia.',
];

$icon = $catIcon[$c['kategori']] ?? 'ph-star';
$support = $supportText[$c['kategori']] ?? 'Kamu gak sendiri';
?>
<a href="detail.php?id=<?= $c['id'] ?>" class="card-link">
  <div class="story-card">
    <div class="card-thumb">
      <i class="ph <?= $icon ?>"></i>
    </div>
    <div class="card-body">
      <span class="story-cat <?= $catClass[$c['kategori']] ?? '' ?>">
        <?= $c['kategori'] ?>
      </span>
      <div class="story-title"><?= htmlspecialchars($c['judul']) ?></div>
      <div class="story-preview">
        <?= htmlspecialchars(substr($c['isi'], 0, 100)) ?>...
      </div>
      <div class="story-meta">
        <span class="story-author">
          <?= $c['anonim'] ? 'Anonim' : htmlspecialchars($c['nama']) ?>
        </span>
        <div style="display:flex;align-items:center;gap:0.5rem">
          <button class="bookmark-btn" onclick="toggleBookmark(event, <?= $c['id'] ?>, '<?= addslashes(htmlspecialchars($c['judul'])) ?>')" title="Simpan">
            <i class="ph ph-star" id="star-<?= $c['id'] ?>"></i>
          </button>
          <button class="share-btn" onclick="showShareCard(event, <?= $c['id'] ?>, '<?= addslashes(htmlspecialchars($c['judul'])) ?>', '<?= addslashes(htmlspecialchars(substr($c['isi'], 0, 200))) ?>', '<?= addslashes($c['kategori']) ?>')" title="Bagikan">
  <i class="ph ph-share-network"></i>
</button>
          <span class="support-btn">
            <i class="ph ph-heart-straight-fill"></i> <?= $c['supports'] ?>
          </span>
        </div>
      </div>
    </div>
  </div>
</a>
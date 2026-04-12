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
    'Kuliah'             => 'Kamu hanya sedang lelah, bukan berarti lemah. Semangat yaaa',
    'Keluarga'           => 'Istirahat dulu yuk, kamu gak harus menanggung semua beban masalah rumah kamu',
    'Percintaan'         => 'Cinta memang indah, tapi kalo udah jelek dan gak bisa di perbaiki tinggalin aja yaa',
    'Self Growth'        => 'Kamu bukan lambat, tapi kamu sedang berjalan dengan perlahan',
    'Mental Health'      => 'Kamu gak papa? nangis dulu yuk, kamu juga berhak mengeluarkan air mata kamu',
    'Toxic Relationship' => 'Meninggalkan emang berat, tapi kalo kamu terus bertahan kamu yang akan teracuni',
    'Insecure'           => 'Standar mereka bukan patokan hidup kamu, So be yourself oke.',
    'Ekspetasi Sosial'   => 'Hidup kamu hanya untuk kamu, ikuti aja kata hati bukan kata manusia.',
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
      <span class="story-cat <?= $catClass[$c['kategori']] ?>">
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
        <span class="support-btn">
          <i class="ph ph-heart-straight-fill"></i>
        </span>
      </div>
    </div>
  </div>
</a>
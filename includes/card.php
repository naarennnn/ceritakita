<?php
$catClass = [
    'Akademik'       => 'cat-akademik',
    'Keluarga'       => 'cat-keluarga',
    'Percintaan'     => 'cat-percintaan',
    'Karir & Masa Depan' => 'cat-karir',
    'Mental Health'  => 'cat-mentalhealth',
    'Pertemanan'     => 'cat-pertemanan',
    'Identitas Diri' => 'cat-identitas',
    'Tekanan Sosial' => 'cat-tekanansoial',
];

$catIcon = [
    'Akademik'           => 'ph-graduation-cap',
    'Keluarga'           => 'ph-house',
    'Percintaan'         => 'ph-heart',
    'Karir & Masa Depan' => 'ph-briefcase',
    'Mental Health'      => 'ph-brain',
    'Pertemanan'         => 'ph-users-three',
    'Identitas Diri'     => 'ph-person',
    'Tekanan Sosial'     => 'ph-megaphone',
];

$supportText = [
    'Akademik'           => 'Nilaimu bukan cerminan nilaimu sebagai manusia.',
    'Keluarga'           => 'Kamu gak harus menanggung semua beban ini sendirian.',
    'Percintaan'         => 'Rasa sakit ini nyata, tapi kamu juga bisa melewatinya.',
    'Karir & Masa Depan' => 'Kamu bukan lambat. Kamu sedang membangun fondasi.',
    'Mental Health'      => 'Minta bantuan itu berani, bukan lemah.',
    'Pertemanan'         => 'Lingkungan yang baik adalah hakmu, bukan kemewahan.',
    'Identitas Diri'     => 'Standar mereka bukan patokan hidupmu.',
    'Tekanan Sosial'     => 'Hidupmu adalah milikmu. Ikuti kata hatimu.',
];

$icon    = $catIcon[$c['kategori']]    ?? 'ph-star';
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

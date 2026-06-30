<?php
require __DIR__ . '/db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='8' fill='%23FAF7F2'/><text x='3' y='23' font-family='Georgia,serif' font-size='20' font-weight='700' fill='%235C4A32'>C</text><text x='15' y='23' font-family='Georgia,serif' font-size='16' font-style='italic' fill='%23C4A882'>K</text></svg>" type="image/svg+xml">
  <title>Cerita Tersimpan - CeritaKita</title>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include __DIR__ . '/includes/navbar.php'; ?>

<div class="saved-page">
  <h1>Cerita Tersimpan</h1>
  <p>Cerita yang pernah kamu bintangi akan muncul di sini 💛</p>
  <div id="saved-container">
    <div class="saved-empty">
      <i class="ph ph-star"></i>
      <p>Belum ada cerita yang disimpan.</p>
      <a href="cerita.php" class="btn-primary" style="margin-top:1rem;display:inline-block">Jelajahi Cerita</a>
    </div>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const bookmarks = JSON.parse(localStorage.getItem('ck_bookmarks') || '[]');
  const container = document.getElementById('saved-container');

  if (bookmarks.length === 0) return;

  const ids = bookmarks.map(b => b.id).join(',');

  fetch('api_saved.php?ids=' + ids)
    .then(r => r.json())
    .then(data => {
      if (data.length === 0) return;

      container.innerHTML = '<div class="stories-grid" id="saved-grid"></div>';
      const grid = document.getElementById('saved-grid');

      const catIcon = {
        'Akademik'           : 'ph-graduation-cap',
        'Keluarga'           : 'ph-house',
        'Percintaan'         : 'ph-heart',
        'Karir & Masa Depan' : 'ph-briefcase',
        'Mental Health'      : 'ph-brain',
        'Pertemanan'         : 'ph-users-three',
        'Identitas Diri'     : 'ph-person',
        'Tekanan Sosial'     : 'ph-megaphone',
      };

      const catClass = {
        'Akademik'           : 'cat-akademik',
        'Keluarga'           : 'cat-keluarga',
        'Percintaan'         : 'cat-percintaan',
        'Karir & Masa Depan' : 'cat-karir',
        'Mental Health'      : 'cat-mentalhealth',
        'Pertemanan'         : 'cat-pertemanan',
        'Identitas Diri'     : 'cat-identitas',
        'Tekanan Sosial'     : 'cat-tekanansoial',
      };

      data.forEach(c => {
        const icon  = catIcon[c.kategori]  || 'ph-star';
        const kelas = catClass[c.kategori] || '';
        const nama  = c.anonim == 1 ? 'Anonim' : c.nama;
        const preview = c.isi.substring(0, 100) + '...';

        grid.innerHTML += `
          <a href="detail.php?id=${c.id}" class="card-link">
            <div class="story-card">
              <div class="card-thumb">
                <i class="ph ${icon}"></i>
              </div>
              <div class="card-body">
                <span class="story-cat ${kelas}">${c.kategori}</span>
                <div class="story-title">${c.judul}</div>
                <div class="story-preview">${preview}</div>
                <div class="story-meta">
                  <span class="story-author">${nama}</span>
                  <button class="bookmark-btn" onclick="removeBookmark(event, ${c.id})" title="Hapus dari simpanan">
                    <i class="ph ph-star-fill" style="color:var(--brown)"></i>
                  </button>
                </div>
              </div>
            </div>
          </a>`;
      });
    });
});

function removeBookmark(e, id) {
  e.preventDefault();
  let bookmarks = JSON.parse(localStorage.getItem('ck_bookmarks') || '[]');
  bookmarks = bookmarks.filter(b => b.id !== id);
  localStorage.setItem('ck_bookmarks', JSON.stringify(bookmarks));
  location.reload();
}
</script>
</body>
</html>
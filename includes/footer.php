<footer>
  Dibuat dengan cinta untuk para perempuan yang butuh didengar · <span>CeritaKita</span>
</footer>

<div id="share-toast" style="display:none;position:fixed;bottom:2rem;left:50%;transform:translateX(-50%);background:var(--brown-dark);color:var(--cream);padding:0.75rem 1.5rem;border-radius:100px;font-size:0.85rem;z-index:999;font-family:'Poppins',sans-serif">
  Link berhasil disalin! 💛
</div>

<script>
function toggleBookmark(e, id, judul) {
  if (e) e.preventDefault();
  let bookmarks = JSON.parse(localStorage.getItem('ck_bookmarks') || '[]');
  const exists = bookmarks.find(b => b.id === id);

  if (exists) {
    bookmarks = bookmarks.filter(b => b.id !== id);
    showToast('Cerita dihapus dari simpanan');
  } else {
    bookmarks.push({ id, judul });
    showToast('Cerita berhasil disimpan! ⭐');
  }

  localStorage.setItem('ck_bookmarks', JSON.stringify(bookmarks));
  updateBookmarkIcons();
}

function updateBookmarkIcons() {
  const bookmarks = JSON.parse(localStorage.getItem('ck_bookmarks') || '[]');
  const ids = bookmarks.map(b => b.id);

  document.querySelectorAll('[id^="bookmark-"]').forEach(el => {
    const id = parseInt(el.id.replace('bookmark-', ''));
    if (ids.includes(id)) {
      el.className = 'ph ph-bookmark-simple-fill';
      el.style.color = 'var(--brown)';
    } else {
      el.className = 'ph ph-bookmark-simple';
      el.style.color = '';
    }
  });

  const detailBtn = document.getElementById('bookmark-detail');
  if (detailBtn) {
    const urlId = new URLSearchParams(window.location.search).get('id');
    const saved = ids.includes(parseInt(urlId));
    detailBtn.innerHTML = saved
      ? '<i class="ph ph-bookmark-simple-fill" style="color:var(--brown)"></i> Tersimpan'
      : '<i class="ph ph-bookmark-simple"></i> Simpan';
  }
}

function shareCerita(e, id, judul) {
  if (e) e.preventDefault();
  const url = window.location.origin + '/detail.php?id=' + id;
  if (navigator.share) {
    navigator.share({ title: judul, text: 'Baca cerita ini di CeritaKita', url });
  } else {
    navigator.clipboard.writeText(url).then(() => showToast('Link berhasil disalin! 💛'));
  }
}

function showToast(msg) {
  const toast = document.getElementById('share-toast');
  toast.textContent = msg;
  toast.style.display = 'block';
  setTimeout(() => toast.style.display = 'none', 2500);
}

document.addEventListener('DOMContentLoaded', updateBookmarkIcons);
</script>
<footer>
  Dibuat dengan cinta untuk para perempuan yang butuh didengar · <span>CeritaKita</span>
</footer>

<div id="share-toast" style="display:none;position:fixed;bottom:2rem;left:50%;transform:translateX(-50%);background:var(--brown-dark);color:var(--cream);padding:0.75rem 1.5rem;border-radius:100px;font-size:0.85rem;z-index:1000;font-family:'Poppins',sans-serif;white-space:nowrap">
  💛
</div>

<script>
function getBookmarks() {
  return JSON.parse(localStorage.getItem('ck_bookmarks') || '[]');
}

function saveBookmarks(data) {
  localStorage.setItem('ck_bookmarks', JSON.stringify(data));
}

function toggleBookmark(e, id, judul) {
  if (e) e.preventDefault();
  let bookmarks = getBookmarks();
  const exists = bookmarks.find(b => b.id === id);

  if (exists) {
    bookmarks = bookmarks.filter(b => b.id !== id);
    showToast('Cerita dihapus dari simpanan');
  } else {
    bookmarks.push({ id, judul, savedAt: new Date().toISOString() });
    showToast('Cerita berhasil disimpan ⭐');
  }

  saveBookmarks(bookmarks);
  updateStarIcons();
}

function updateStarIcons() {
  const bookmarks = getBookmarks();
  const ids = bookmarks.map(b => b.id);

  document.querySelectorAll('[id^="star-"]').forEach(el => {
    const id = parseInt(el.id.replace('star-', ''));
    if (ids.includes(id)) {
      el.className = 'ph ph-star-fill';
      el.style.color = 'var(--brown)';
    } else {
      el.className = 'ph ph-star';
      el.style.color = '';
    }
  });

  const detailSaveBtn = document.getElementById('detail-save-btn');
  if (detailSaveBtn) {
    const urlId = parseInt(new URLSearchParams(window.location.search).get('id'));
    const saved = ids.includes(urlId);
    detailSaveBtn.className = 'action-btn' + (saved ? ' saved' : '');
    detailSaveBtn.innerHTML = saved
      ? '<i class="ph ph-star-fill"></i> Tersimpan'
      : '<i class="ph ph-star"></i> Simpan';
  }
}

function showToast(msg) {
  const toast = document.getElementById('share-toast');
  if (!toast) return;
  toast.textContent = msg;
  toast.style.display = 'block';
  setTimeout(() => toast.style.display = 'none', 2500);
}

document.addEventListener('DOMContentLoaded', updateStarIcons);
</script>
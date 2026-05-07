<footer>
  Dibuat dengan cinta untuk para perempuan yang butuh didengar · <span>CeritaKita</span>
</footer>

<!-- Toast -->
<div id="share-toast" style="display:none;position:fixed;bottom:2rem;left:50%;transform:translateX(-50%);background:var(--brown-dark);color:var(--cream);padding:0.75rem 1.5rem;border-radius:100px;font-size:0.85rem;z-index:1001;font-family:'Poppins',sans-serif;white-space:nowrap">💛</div>

<!-- Share Modal -->
<div id="share-modal" onclick="if(event.target===this)closeShareModal()" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:1000;align-items:center;justify-content:center;padding:1rem">
  <div style="background:#fff;border-radius:20px;padding:1.5rem;max-width:380px;width:100%;box-shadow:0 20px 60px rgba(0,0,0,0.2)">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem">
      <span style="font-family:'Poppins',sans-serif;font-size:0.875rem;font-weight:600;color:var(--brown-dark)">Bagikan Cerita</span>
      <button onclick="closeShareModal()" style="background:none;border:none;cursor:pointer;font-size:1.5rem;color:var(--text-muted);line-height:1">×</button>
    </div>

    <!-- Preview Card -->
    <div id="share-card" style="background:linear-gradient(135deg,#FAF7F2 0%,#F2EDE4 100%);border-radius:16px;padding:1.25rem;margin-bottom:1.25rem;border:1px solid #E8C5B5;position:relative;overflow:hidden">
      <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#C4A882,#E8C5B5)"></div>
      <div style="font-family:'Georgia',serif;font-size:0.65rem;font-weight:700;color:#C4A882;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:0.75rem;margin-top:0.25rem">CeritaKita 💛</div>
      <div id="sc-cat" style="display:inline-block;font-size:0.62rem;font-weight:600;padding:0.2rem 0.6rem;border-radius:100px;margin-bottom:0.6rem;text-transform:uppercase;letter-spacing:0.05em;background:#EEF2FF;color:#5B6FA6;font-family:'Poppins',sans-serif"></div>
      <div id="sc-title" style="font-family:'Georgia',serif;font-size:0.95rem;font-weight:700;color:#5C4A32;margin-bottom:0.6rem;line-height:1.3"></div>
      <div id="sc-preview" style="font-size:0.78rem;color:#8A7060;line-height:1.65;font-style:italic;display:-webkit-box;-webkit-line-clamp:4;-webkit-box-orient:vertical;overflow:hidden"></div>
      <div style="margin-top:0.85rem;padding-top:0.75rem;border-top:1px solid rgba(200,169,126,0.3);font-size:0.68rem;color:#B8A090;font-family:'Poppins',sans-serif">
        Baca selengkapnya di <strong style="color:#8B6F4E">ceritakita.app</strong>
      </div>
    </div>

    <!-- Actions -->
    <div style="display:flex;gap:0.75rem">
      <button onclick="downloadShareCard()" style="flex:1;display:flex;align-items:center;justify-content:center;gap:0.4rem;background:var(--brown-dark);color:var(--cream);border:none;padding:0.75rem;border-radius:12px;font-family:'Poppins',sans-serif;font-size:0.82rem;font-weight:500;cursor:pointer;transition:all 0.2s">
        <i class="ph ph-image"></i> Simpan Gambar
      </button>
      <button onclick="copyShareLink()" style="flex:1;display:flex;align-items:center;justify-content:center;gap:0.4rem;background:var(--cream2);color:var(--brown-dark);border:none;padding:0.75rem;border-radius:12px;font-family:'Poppins',sans-serif;font-size:0.82rem;font-weight:500;cursor:pointer;transition:all 0.2s">
        <i class="ph ph-link"></i> Salin Link
      </button>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
let currentShareId = null;

// Bookmark functions
function getBookmarks() {
  return JSON.parse(localStorage.getItem('ck_bookmarks') || '[]');
}

function toggleBookmark(e, id, judul) {
  if (e) e.preventDefault();
  let bookmarks = getBookmarks();
  const exists = bookmarks.find(b => b.id === id);
  if (exists) {
    bookmarks = bookmarks.filter(b => b.id !== id);
    showToast('Dihapus dari simpanan');
  } else {
    bookmarks.push({ id, judul, savedAt: new Date().toISOString() });
    showToast('Berhasil disimpan ⭐');
  }
  localStorage.setItem('ck_bookmarks', JSON.stringify(bookmarks));
  updateStarIcons();
}

function updateStarIcons() {
  const ids = getBookmarks().map(b => b.id);
  document.querySelectorAll('[id^="star-"]').forEach(el => {
    const id = parseInt(el.id.replace('star-', ''));
    el.className = ids.includes(id) ? 'ph ph-star-fill' : 'ph ph-star';
    el.style.color = ids.includes(id) ? 'var(--brown)' : '';
  });
  const btn = document.getElementById('detail-save-btn');
  if (btn) {
    const urlId = parseInt(new URLSearchParams(window.location.search).get('id'));
    const saved = ids.includes(urlId);
    btn.className = 'action-btn' + (saved ? ' saved' : '');
    btn.innerHTML = saved ? '<i class="ph ph-star-fill"></i> Tersimpan' : '<i class="ph ph-star"></i> Simpan';
  }
}

// Share functions
function showShareCard(e, id, judul, preview, kategori) {
  if (e) e.preventDefault();
  currentShareId = id;
  document.getElementById('sc-title').textContent = judul;
  document.getElementById('sc-preview').textContent = preview + '...';
  document.getElementById('sc-cat').textContent = kategori;
  const modal = document.getElementById('share-modal');
  modal.style.display = 'flex';
}

function closeShareModal() {
  document.getElementById('share-modal').style.display = 'none';
}

function downloadShareCard() {
  const card = document.getElementById('share-card');
  html2canvas(card, {
    scale: 3,
    backgroundColor: '#FAF7F2',
    useCORS: true,
    logging: false
  }).then(canvas => {
    const link = document.createElement('a');
    link.download = 'ceritakita-story.png';
    link.href = canvas.toDataURL('image/png');
    link.click();
    showToast('Gambar berhasil disimpan! 💛');
  });
}

function copyShareLink() {
  const url = window.location.origin + '/detail.php?id=' + currentShareId;
  if (navigator.clipboard) {
    navigator.clipboard.writeText(url).then(() => {
      showToast('Link disalin! 💛');
      closeShareModal();
    });
  } else {
    const el = document.createElement('textarea');
    el.value = url;
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
    showToast('Link disalin! 💛');
    closeShareModal();
  }
}

function showToast(msg) {
  const toast = document.getElementById('share-toast');
  if (!toast) return;
  toast.textContent = msg;
  toast.style.display = 'block';
  setTimeout(() => { toast.style.display = 'none'; }, 2500);
}

document.addEventListener('DOMContentLoaded', updateStarIcons);
</script>
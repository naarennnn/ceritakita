<footer>
  Dibuat dengan cinta untuk semua orang yang butuh didengar · <span>CeritaKita</span>
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

    <!-- Simpan & Salin -->
    <div style="display:flex;gap:0.75rem;margin-bottom:1rem">
      <button onclick="downloadShareCard()" style="flex:1;display:flex;align-items:center;justify-content:center;gap:0.4rem;background:var(--brown-dark);color:var(--cream);border:none;padding:0.75rem;border-radius:12px;font-family:'Poppins',sans-serif;font-size:0.82rem;font-weight:500;cursor:pointer;transition:all 0.2s">
        <i class="ph ph-image"></i> Simpan Gambar
      </button>
      <button onclick="copyShareLink()" style="flex:1;display:flex;align-items:center;justify-content:center;gap:0.4rem;background:var(--cream2);color:var(--brown-dark);border:none;padding:0.75rem;border-radius:12px;font-family:'Poppins',sans-serif;font-size:0.82rem;font-weight:500;cursor:pointer;transition:all 0.2s">
        <i class="ph ph-link"></i> Salin Link
      </button>
    </div>

    <!-- Divider -->
    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem">
      <div style="flex:1;height:1px;background:var(--cream2)"></div>
      <span style="font-size:0.72rem;color:var(--text-light);font-family:'Poppins',sans-serif">atau bagikan ke</span>
      <div style="flex:1;height:1px;background:var(--cream2)"></div>
    </div>

    <!-- Tombol Sosmed -->
    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:0.6rem">

      <!-- WhatsApp -->
      <button onclick="shareToWhatsApp()" style="display:flex;align-items:center;gap:0.5rem;background:#25D366;color:#fff;border:none;padding:0.65rem 1rem;border-radius:12px;font-family:'Poppins',sans-serif;font-size:0.8rem;font-weight:500;cursor:pointer;transition:all 0.2s">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        WhatsApp
      </button>

      <!-- Twitter/X -->
      <button onclick="shareToTwitter()" style="display:flex;align-items:center;gap:0.5rem;background:#000;color:#fff;border:none;padding:0.65rem 1rem;border-radius:12px;font-family:'Poppins',sans-serif;font-size:0.8rem;font-weight:500;cursor:pointer;transition:all 0.2s">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.736-8.849L1.255 2.25H8.08l4.214 5.567 5.95-5.567zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
        Twitter / X
      </button>

      <!-- Telegram -->
      <button onclick="shareToTelegram()" style="display:flex;align-items:center;gap:0.5rem;background:#229ED9;color:#fff;border:none;padding:0.65rem 1rem;border-radius:12px;font-family:'Poppins',sans-serif;font-size:0.8rem;font-weight:500;cursor:pointer;transition:all 0.2s">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
        Telegram
      </button>

      <!-- Facebook -->
      <button onclick="shareToFacebook()" style="display:flex;align-items:center;gap:0.5rem;background:#1877F2;color:#fff;border:none;padding:0.65rem 1rem;border-radius:12px;font-family:'Poppins',sans-serif;font-size:0.8rem;font-weight:500;cursor:pointer;transition:all 0.2s">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
        Facebook
      </button>

      <!-- TikTok -->
      <button onclick="shareToTikTok()" style="display:flex;align-items:center;gap:0.5rem;background:#010101;color:#fff;border:none;padding:0.65rem 1rem;border-radius:12px;font-family:'Poppins',sans-serif;font-size:0.8rem;font-weight:500;cursor:pointer;transition:all 0.2s">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.78a4.85 4.85 0 01-1.01-.09z"/></svg>
        TikTok
      </button>

      <!-- Instagram -->
      <button onclick="shareToInstagram()" style="display:flex;align-items:center;gap:0.5rem;background:linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888);color:#fff;border:none;padding:0.65rem 1rem;border-radius:12px;font-family:'Poppins',sans-serif;font-size:0.8rem;font-weight:500;cursor:pointer;transition:all 0.2s">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
        Instagram
      </button>

      <!-- Threads -->
      <button onclick="shareToThreads()" style="display:flex;align-items:center;gap:0.5rem;background:#101010;color:#fff;border:none;padding:0.65rem 1rem;border-radius:12px;font-family:'Poppins',sans-serif;font-size:0.8rem;font-weight:500;cursor:pointer;transition:all 0.2s">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.44 1.5 15.586 1.472 12.01v-.017c.03-3.579.879-6.43 2.525-8.482C5.851 1.205 8.6.024 12.18 0h.014c2.746.02 5.043.725 6.826 2.098 1.677 1.29 2.858 3.13 3.509 5.467l-2.04.569c-1.104-3.96-3.898-5.984-8.304-6.015-2.91.022-5.11.936-6.54 2.717C4.307 6.504 3.616 8.914 3.589 12c.027 3.086.718 5.496 2.057 7.164 1.43 1.781 3.631 2.695 6.54 2.717 2.623-.02 4.358-.631 5.813-2.045 1.646-1.598 1.62-3.503 1.087-4.662-.373-.812-1.області-1.424-2.502-1.652-.362 2.dress-1.448 4.083-4.144 4.267-1.819.122-3.522-.47-4.342-1.535a3.51 3.51 0 01-.584-2.898c.33-1.269 1.26-2.116 2.66-2.39.581-.114 1.195-.17 1.837-.17.523 0 1.031.039 1.517.116-.149-.734-.49-1.29-1.022-1.664-.635-.44-1.532-.665-2.669-.665-1.946 0-3.029.616-3.568 1.127l-1.366-1.51C7.285 7.972 8.874 7.09 11.5 7.09c1.593 0 2.918.328 3.94 1.013 1.21.814 1.928 2.036 2.13 3.636.17-.006.34-.01.513-.01 2.047 0 3.706.632 4.8 1.83C24 14.7 24.3 17.2 23.1 19.4c-1.378 2.55-3.95 3.978-7.228 4.067-.226.006-.452.009-.677.009-.346 0-.694-.008-1.009-.024z"/></svg>
        Threads
      </button>

    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
let currentShareId = null;

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

function getShareUrl() {
  return window.location.origin + '/detail.php?id=' + currentShareId;
}

function getShareText() {
  const judul = document.getElementById('sc-title').textContent;
  return '"' + judul + '" — baca cerita ini di CeritaKita 💛';
}

function shareToWhatsApp() {
  const text = encodeURIComponent(getShareText() + '\n' + getShareUrl());
  window.open('https://wa.me/?text=' + text, '_blank');
  closeShareModal();
}

function shareToTwitter() {
  const text = encodeURIComponent(getShareText());
  const url = encodeURIComponent(getShareUrl());
  window.open('https://twitter.com/intent/tweet?text=' + text + '&url=' + url, '_blank');
  closeShareModal();
}

function shareToTelegram() {
  const text = encodeURIComponent(getShareText());
  const url = encodeURIComponent(getShareUrl());
  window.open('https://t.me/share/url?url=' + url + '&text=' + text, '_blank');
  closeShareModal();
}

function shareToFacebook() {
  const url = encodeURIComponent(getShareUrl());
  window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, '_blank');
  closeShareModal();
}

function shareToTikTok() {
  const url = getShareUrl();
  navigator.clipboard.writeText(url).then(() => {
    showToast('Link disalin! Paste di TikTok ya 🎵');
    closeShareModal();
  });
}

function shareToInstagram() {
  const url = getShareUrl();
  navigator.clipboard.writeText(url).then(() => {
    showToast('Link disalin! Paste di Instagram ya 📸');
    closeShareModal();
  });
}

function shareToThreads() {
  const text = encodeURIComponent(getShareText() + ' ' + getShareUrl());
  window.open('https://www.threads.net/intent/post?text=' + text, '_blank');
  closeShareModal();
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
  const url = getShareUrl();
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

function getLikes() {
  return JSON.parse(localStorage.getItem('ck_likes') || '[]');
}

function toggleLike(e, id) {
  if (e) e.preventDefault();
  let likes = getLikes();
  const liked = likes.includes(id);

  fetch('support.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'id=' + id + '&action=' + (liked ? 'unlike' : 'like')
  })
  .then(r => r.json())
  .then(data => {
    if (liked) {
      likes = likes.filter(l => l !== id);
    } else {
      likes.push(id);
    }
    localStorage.setItem('ck_likes', JSON.stringify(likes));

    const countEl = document.getElementById('like-count-' + id);
    if (countEl) countEl.textContent = data.total;

    const iconEl = document.getElementById('like-icon-' + id);
    if (iconEl) {
      iconEl.className = likes.includes(id) ? 'ph ph-heart-fill' : 'ph ph-heart';
      iconEl.style.color = likes.includes(id) ? '#C0547A' : '';
    }

    const labelEl = document.getElementById('like-label-' + id);
    if (labelEl) labelEl.textContent = likes.includes(id) ? 'Disukai' : 'Suka';

    const detailBtn = document.getElementById('detail-like-btn');
    if (detailBtn) detailBtn.style.background = likes.includes(id) ? '#C0547A' : '';
  });
}

function updateLikeIcons() {
  const likes = getLikes();
  likes.forEach(id => {
    const iconEl = document.getElementById('like-icon-' + id);
    if (iconEl) {
      iconEl.className = 'ph ph-heart-fill';
      iconEl.style.color = '#C0547A';
    }
    const labelEl = document.getElementById('like-label-' + id);
    if (labelEl) labelEl.textContent = 'Disukai';
    const detailBtn = document.getElementById('detail-like-btn');
    if (detailBtn) detailBtn.style.background = '#C0547A';
  });
}



document.addEventListener('DOMContentLoaded', () => {
  updateStarIcons();
  updateLikeIcons();
});
</script>
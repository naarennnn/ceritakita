<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
<nav>
  <div class="nav-inner">
    <a href="index.php" class="logo">Cerita<span>Kita</span></a>

    <!-- Desktop menu -->
    <div class="nav-menu" id="nav-menu">
      <div class="nav-pill" id="nav-pill"></div>
      <a href="index.php"     class="nav-item <?= $currentPage === 'index.php'     ? 'active' : '' ?>">Beranda</a>
      <a href="tulis.php"     class="nav-item <?= $currentPage === 'tulis.php'     ? 'active' : '' ?>">Tulis Cerita</a>
      <a href="cerita.php"    class="nav-item <?= $currentPage === 'cerita.php'    ? 'active' : '' ?>">Cerita</a>
      <a href="tersimpan.php" class="nav-item <?= $currentPage === 'tersimpan.php' ? 'active' : '' ?>">
        <i class="ph ph-star" style="font-size:0.9rem"></i> Tersimpan
      </a>
      <a href="tentang.php"   class="nav-item <?= $currentPage === 'tentang.php'   ? 'active' : '' ?>">Tentang</a>
    </div>

    <!-- Hamburger button -->
    <button class="hamburger" id="hamburger" onclick="toggleMenu()" aria-label="Menu">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</nav>

<!-- Mobile dropdown -->
<div class="mobile-menu" id="mobile-menu">
  <a href="index.php"     class="mobile-item <?= $currentPage === 'index.php'     ? 'active' : '' ?>">Beranda</a>
  <a href="tulis.php"     class="mobile-item <?= $currentPage === 'tulis.php'     ? 'active' : '' ?>">Tulis Cerita</a>
  <a href="cerita.php"    class="mobile-item <?= $currentPage === 'cerita.php'    ? 'active' : '' ?>">Cerita</a>
  <a href="tersimpan.php" class="mobile-item <?= $currentPage === 'tersimpan.php' ? 'active' : '' ?>">Tersimpan</a>
  <a href="tentang.php"   class="mobile-item <?= $currentPage === 'tentang.php'   ? 'active' : '' ?>">Tentang</a>
</div>

<style>
.hamburger{display:none;flex-direction:column;gap:5px;background:none;border:none;cursor:pointer;padding:0.5rem;z-index:101}
.hamburger span{display:block;width:22px;height:2px;background:var(--brown-dark);border-radius:2px;transition:all 0.3s cubic-bezier(0.4,0,0.2,1)}
.hamburger.open span:nth-child(1){transform:translateY(7px) rotate(45deg)}
.hamburger.open span:nth-child(2){opacity:0}
.hamburger.open span:nth-child(3){transform:translateY(-7px) rotate(-45deg)}

.mobile-menu{
  position:fixed;
  top:60px;left:0;right:0;
  background:rgba(250,247,242,0.98);
  backdrop-filter:blur(12px);
  border-bottom:1px solid var(--cream2);
  display:flex;
  flex-direction:column;
  padding:0.5rem 1rem 1rem;
  z-index:99;
  visibility:hidden;
  pointer-events:none;
  opacity:0;
  transform:translateY(-12px);
  transition:opacity 0.3s cubic-bezier(0.4,0,0.2,1), transform 0.3s cubic-bezier(0.4,0,0.2,1);
}

.mobile-item{
  padding:0.85rem 1rem;
  font-family:'Poppins',sans-serif;
  font-size:0.9rem;
  color:var(--text-muted)!important;
  border-radius:12px;
  transition:all 0.2s;
  font-weight:400;
}
.mobile-item:hover{background:var(--cream2);color:var(--brown-dark)!important}
.mobile-item.active{color:var(--brown-dark)!important;font-weight:500;background:var(--cream2)}

@media(max-width:640px){
  .nav-menu{display:none!important}
  .hamburger{display:flex}
}
</style>

<script>
function toggleMenu() {
  const menu = document.getElementById('mobile-menu');
  const btn  = document.getElementById('hamburger');
  btn.classList.toggle('open');

  if (btn.classList.contains('open')) {
    menu.style.visibility = 'visible';
    menu.style.pointerEvents = 'auto';
    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        menu.style.opacity = '1';
        menu.style.transform = 'translateY(0)';
      });
    });
  } else {
    menu.style.opacity = '0';
    menu.style.transform = 'translateY(-12px)';
    setTimeout(() => {
      menu.style.visibility = 'hidden';
      menu.style.pointerEvents = 'none';
    }, 300);
  }
}

document.addEventListener('click', function(e) {
  const menu = document.getElementById('mobile-menu');
  const btn  = document.getElementById('hamburger');
  if (!menu.contains(e.target) && !btn.contains(e.target) && btn.classList.contains('open')) {
    btn.classList.remove('open');
    menu.style.opacity = '0';
    menu.style.transform = 'translateY(-12px)';
    setTimeout(() => {
      menu.style.visibility = 'hidden';
      menu.style.pointerEvents = 'none';
    }, 300);
  }
});

document.addEventListener('DOMContentLoaded', function() {
  const pill   = document.getElementById('nav-pill');
  const items  = document.querySelectorAll('.nav-item');
  const active = document.querySelector('.nav-item.active');

  function movePill(el) {
    if (!el) return;
    pill.style.width   = el.offsetWidth + 'px';
    pill.style.left    = el.offsetLeft + 'px';
    pill.style.opacity = '1';
  }

  if (active) movePill(active);

  items.forEach(item => {
    item.addEventListener('mouseenter', function() { movePill(this); });
    item.addEventListener('mouseleave', function() { if (active) movePill(active); });
  });
});
</script>
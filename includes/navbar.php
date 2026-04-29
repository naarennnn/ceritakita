<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
<nav>
  <div class="nav-inner">
    <a href="index.php" class="logo">Cerita<span>Kita</span></a>
    <ul class="nav-links">
      <li><a href="index.php" class="<?= $currentPage === 'index.php' ? 'active' : '' ?>">Beranda</a></li>
      <li><a href="cerita.php" class="<?= $currentPage === 'cerita.php' ? 'active' : '' ?>">Cerita</a></li>
      <li><a href="tentang.php" class="<?= $currentPage === 'tentang.php' ? 'active' : '' ?>">Tentang</a></li>
      <li><a href="tulis.php" class="nav-cta <?= $currentPage === 'tulis.php' ? 'nav-cta-active' : '' ?>">Tulis Cerita</a></li>
    </ul>
    <div class="nav-indicator" id="nav-indicator"></div>
  </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const activeLink = document.querySelector('.nav-links .active');
  const indicator = document.getElementById('nav-indicator');
  const navInner = document.querySelector('.nav-inner');

  function moveIndicator(el) {
    if (!el) return;
    const rect = el.getBoundingClientRect();
    const navRect = navInner.getBoundingClientRect();
    indicator.style.width = rect.width + 'px';
    indicator.style.left = (rect.left - navRect.left) + 'px';
    indicator.style.opacity = '1';
  }

  // Set posisi awal
  if (activeLink) moveIndicator(activeLink);

  // Move saat hover
  document.querySelectorAll('.nav-links a:not(.nav-cta)').forEach(link => {
    link.addEventListener('mouseenter', function() {
      moveIndicator(this);
    });
    link.addEventListener('mouseleave', function() {
      if (activeLink) moveIndicator(activeLink);
      else indicator.style.opacity = '0';
    });
  });
});
</script>
<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
<nav>
  <div class="nav-inner">
    <a href="index.php" class="logo">Cerita<span>Kita</span></a>
    <div class="nav-menu">
      <div class="nav-pill" id="nav-pill"></div>
      <a href="index.php" class="nav-item <?= $currentPage === 'index.php' ? 'active' : '' ?>">Beranda</a>
      <a href="cerita.php" class="nav-item <?= $currentPage === 'cerita.php' ? 'active' : '' ?>">Cerita</a>
      <a href="tentang.php" class="nav-item <?= $currentPage === 'tentang.php' ? 'active' : '' ?>">Tentang</a>
      <a href="tulis.php" class="nav-item <?= $currentPage === 'tulis.php' ? 'active' : '' ?>">Tulis Cerita</a>
    </div>
  </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const pill = document.getElementById('nav-pill');
  const items = document.querySelectorAll('.nav-item');
  const activeItem = document.querySelector('.nav-item.active');

  function movePill(el) {
    if (!el) return;
    pill.style.width = el.offsetWidth + 'px';
    pill.style.left = el.offsetLeft + 'px';
    pill.style.opacity = '1';
  }

  if (activeItem) movePill(activeItem);

  items.forEach(item => {
    item.addEventListener('mouseenter', function() { movePill(this); });
    item.addEventListener('mouseleave', function() {
      if (activeItem) movePill(activeItem);
    });
  });
});
</script>
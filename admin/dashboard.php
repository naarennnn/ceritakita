<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
require __DIR__ . '/../db.php';

// Handle highlight
if (isset($_GET['highlight'])) {
    $id = (int)$_GET['highlight'];
    mysqli_query($conn, "UPDATE cerita SET highlight = 0");
    mysqli_query($conn, "UPDATE cerita SET highlight = 1 WHERE id = $id");
    header("Location: dashboard.php");
    exit;
}

// Handle hapus
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($conn, "DELETE FROM cerita WHERE id = $id");
    header("Location: dashboard.php");
    exit;
}

// Ambil semua cerita
$result = mysqli_query($conn, "SELECT * FROM cerita ORDER BY created_at DESC");
$cerita = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - CeritaKita</title>
  <link rel="stylesheet" href="../assets/style.css">
  <style>
    .admin-wrap{max-width:900px;margin:0 auto;padding:2rem}
    .admin-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;padding-bottom:1rem;border-bottom:1px solid var(--cream2)}
    .admin-title{font-family:'Playfair Display',serif;font-size:1.75rem;color:var(--brown-dark)}
    .logout{font-size:0.85rem;color:var(--text-muted)}
    .admin-table{width:100%;border-collapse:collapse;background:#fff;border-radius:16px;overflow:hidden;border:1px solid var(--cream2)}
    .admin-table th{background:var(--cream2);padding:0.85rem 1rem;text-align:left;font-size:0.78rem;font-weight:600;color:var(--brown-dark);text-transform:uppercase;letter-spacing:0.05em}
    .admin-table td{padding:0.85rem 1rem;font-size:0.875rem;color:var(--text-main);border-top:1px solid var(--cream2);vertical-align:top}
    .admin-table tr:hover td{background:var(--pink-pale)}
    .badge-highlight{background:#FFF8EE;color:#A07030;font-size:0.72rem;padding:0.2rem 0.6rem;border-radius:100px;font-weight:500}
    .btn-sm{font-size:0.78rem;padding:0.3rem 0.75rem;border-radius:100px;border:none;cursor:pointer;font-family:'Poppins',sans-serif;font-weight:500;transition:all 0.2s;text-decoration:none;display:inline-block;margin-right:0.35rem}
    .btn-highlight{background:var(--brown-light);color:var(--cream)}
    .btn-highlight:hover{background:var(--brown)}
    .btn-hapus{background:#FFF0F0;color:#C0392B}
    .btn-hapus:hover{background:#FFD5D5}
    .stat-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:2rem}
    .stat-card{background:#fff;border:1px solid var(--cream2);border-radius:16px;padding:1.25rem;text-align:center}
    .stat-num{font-family:'Playfair Display',serif;font-size:2rem;color:var(--brown-dark);font-weight:700}
    .stat-label{font-size:0.78rem;color:var(--text-muted);margin-top:0.25rem}
    @media (max-width: 768px) {
  .admin-wrap{padding:1rem}
  .stat-cards{grid-template-columns:1fr 1fr}
  .admin-table{display:block;overflow-x:auto}
  .admin-header{flex-direction:column;align-items:flex-start;gap:0.5rem}
  .btn-sm{margin-bottom:0.35rem;display:block;text-align:center}
}
@media (max-width:480px){
  .stat-cards{grid-template-columns:1fr}
}
  </style>
</head>
<body style="background:var(--cream);padding-top:2rem">

<div class="admin-wrap">
  <div class="admin-header">
    <div class="admin-title">Dashboard Admin</div>
    <a href="logout.php" class="logout">Logout →</a>
  </div>

  <?php
  $totalCerita = count($cerita);
  $totalSupport = array_sum(array_column($cerita, 'supports'));
  $totalKomentar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM komentar"))['total'];
  ?>

  <div class="stat-cards">
    <div class="stat-card">
      <div class="stat-num"><?= $totalCerita ?></div>
      <div class="stat-label">Total Cerita</div>
    </div>
    <div class="stat-card">
      <div class="stat-num"><?= $totalSupport ?></div>
      <div class="stat-label">Total Support</div>
    </div>
    <div class="stat-card">
      <div class="stat-num"><?= $totalKomentar ?></div>
      <div class="stat-label">Total Komentar</div>
    </div>
  </div>

  <table class="admin-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Penulis</th>
        <th>Support</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cerita as $c): ?>
      <tr>
        <td><?= $c['id'] ?></td>
        <td>
          <?= htmlspecialchars($c['judul']) ?>
          <?php if ($c['highlight']): ?>
            <span class="badge-highlight">⭐ Highlight</span>
          <?php endif; ?>
        </td>
        <td><?= $c['kategori'] ?></td>
        <td><?= $c['anonim'] ? 'Anonim' : htmlspecialchars($c['nama']) ?></td>
        <td><?= $c['supports'] ?></td>
        <td><?= date('d M Y', strtotime($c['created_at'])) ?></td>
        <td>
          <a href="dashboard.php?highlight=<?= $c['id'] ?>" class="btn-sm btn-highlight">⭐ Highlight</a>
          <a href="dashboard.php?hapus=<?= $c['id'] ?>" class="btn-sm btn-hapus" onclick="return confirm('Yakin hapus cerita ini?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

</body>
</html>
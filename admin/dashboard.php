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

// Handle hapus cerita
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($conn, "DELETE FROM komentar WHERE cerita_id = $id");
    mysqli_query($conn, "DELETE FROM cerita WHERE id = $id");
    header("Location: dashboard.php");
    exit;
}

// Handle hapus komentar
if (isset($_GET['hapus_komen'])) {
    $id = (int)$_GET['hapus_komen'];
    mysqli_query($conn, "DELETE FROM komentar WHERE id = $id");
    header("Location: dashboard.php?tab=komentar");
    exit;
}

$tab = $_GET['tab'] ?? 'cerita';

// Ambil semua cerita
$result  = mysqli_query($conn, "SELECT * FROM cerita ORDER BY created_at DESC");
$cerita  = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Ambil semua komentar
$komResult = mysqli_query($conn, "SELECT k.*, c.judul FROM komentar k LEFT JOIN cerita c ON k.cerita_id = c.id ORDER BY k.created_at DESC");
$komentars = mysqli_fetch_all($komResult, MYSQLI_ASSOC);

$totalCerita   = count($cerita);
$totalLike     = array_sum(array_column($cerita, 'supports'));
$totalKomentar = count($komentars);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='8' fill='%23FAF7F2'/><text x='3' y='23' font-family='Georgia,serif' font-size='20' font-weight='700' fill='%235C4A32'>C</text><text x='15' y='23' font-family='Georgia,serif' font-size='16' font-style='italic' fill='%23C4A882'>K</text></svg>" type="image/svg+xml">
  <title>Dashboard Admin - CeritaKita</title>
  <link rel="stylesheet" href="../assets/style.css">
  <style>
    body{padding-top:2rem;background:var(--cream)}
    .admin-wrap{max-width:960px;margin:0 auto;padding:2rem}
    .admin-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;padding-bottom:1rem;border-bottom:1px solid var(--cream2)}
    .admin-title{font-family:'Playfair Display',serif;font-size:1.75rem;color:var(--brown-dark)}
    .admin-title span{font-size:0.85rem;color:var(--text-muted);font-family:'Poppins',sans-serif;font-weight:400;margin-left:0.5rem}
    .logout{font-size:0.85rem;color:var(--text-muted);display:flex;gap:1rem;align-items:center}
    .logout a{color:var(--brown)}
    .stat-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:2rem}
    .stat-card{background:#fff;border:1px solid var(--cream2);border-radius:16px;padding:1.25rem;text-align:center}
    .stat-num{font-family:'Playfair Display',serif;font-size:2rem;color:var(--brown-dark);font-weight:700}
    .stat-label{font-size:0.78rem;color:var(--text-muted);margin-top:0.25rem}
    .tab-bar{display:flex;gap:0.5rem;margin-bottom:1.5rem;background:var(--cream2);border-radius:100px;padding:0.25rem;width:fit-content}
    .tab-btn{padding:0.4rem 1.25rem;border-radius:100px;border:none;background:none;font-family:'Poppins',sans-serif;font-size:0.82rem;color:var(--text-muted);cursor:pointer;transition:all 0.2s;font-weight:400}
    .tab-btn.active{background:#fff;color:var(--brown-dark);font-weight:500;box-shadow:0 1px 4px rgba(92,74,50,0.12)}
    .admin-table{width:100%;border-collapse:collapse;background:#fff;border-radius:16px;overflow:hidden;border:1px solid var(--cream2)}
    .admin-table th{background:var(--cream2);padding:0.85rem 1rem;text-align:left;font-size:0.75rem;font-weight:600;color:var(--brown-dark);text-transform:uppercase;letter-spacing:0.05em}
    .admin-table td{padding:0.85rem 1rem;font-size:0.82rem;color:var(--text-main);border-top:1px solid var(--cream2);vertical-align:middle}
    .admin-table tr:hover td{background:var(--pink-pale)}
    .badge-highlight{background:#FFF8EE;color:#A07030;font-size:0.68rem;padding:0.2rem 0.5rem;border-radius:100px;font-weight:500;margin-left:0.35rem}
    .badge-cat{font-size:0.68rem;padding:0.2rem 0.5rem;border-radius:100px;font-weight:500;background:var(--cream2);color:var(--brown)}
    .btn-sm{font-size:0.75rem;padding:0.3rem 0.75rem;border-radius:100px;border:none;cursor:pointer;font-family:'Poppins',sans-serif;font-weight:500;transition:all 0.2s;text-decoration:none;display:inline-block;margin-right:0.25rem}
    .btn-highlight{background:var(--brown-light);color:#fff}
    .btn-highlight:hover{background:var(--brown)}
    .btn-hapus{background:#FFF0F0;color:#C0392B}
    .btn-hapus:hover{background:#FFD5D5}
    .btn-view{background:var(--cream2);color:var(--brown-dark)}
    .btn-view:hover{background:var(--brown-light);color:#fff}
    .like-count{display:flex;align-items:center;gap:0.3rem;color:#C0547A;font-weight:500}
    @media(max-width:768px){
      .admin-wrap{padding:1rem}
      .stat-cards{grid-template-columns:1fr 1fr}
      .admin-table{display:block;overflow-x:auto}
      .admin-header{flex-direction:column;align-items:flex-start;gap:0.5rem}
    }
    @media(max-width:480px){.stat-cards{grid-template-columns:1fr}}
  </style>
</head>
<body>

<div class="admin-wrap">
  <div class="admin-header">
    <div class="admin-title">Dashboard <span>CeritaKita</span></div>
    <div class="logout">
      <a href="../index.php" target="_blank">Lihat Web →</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <!-- Stat Cards -->
  <div class="stat-cards">
    <div class="stat-card">
      <div class="stat-num"><?= $totalCerita ?></div>
      <div class="stat-label">Total Cerita</div>
    </div>
    <div class="stat-card">
      <div class="stat-num"><?= $totalLike ?></div>
      <div class="stat-label">Total Like ❤️</div>
    </div>
    <div class="stat-card">
      <div class="stat-num"><?= $totalKomentar ?></div>
      <div class="stat-label">Total Komentar</div>
    </div>
  </div>

  <!-- Tab Bar -->
  <div class="tab-bar">
    <button class="tab-btn <?= $tab === 'cerita' ? 'active' : '' ?>" onclick="switchTab('cerita')">
      📖 Cerita (<?= $totalCerita ?>)
    </button>
    <button class="tab-btn <?= $tab === 'komentar' ? 'active' : '' ?>" onclick="switchTab('komentar')">
      💬 Komentar (<?= $totalKomentar ?>)
    </button>
  </div>

  <!-- Tab Cerita -->
  <div id="tab-cerita" style="display:<?= $tab === 'cerita' ? 'block' : 'none' ?>">
    <table class="admin-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Judul & Kategori</th>
          <th>Penulis</th>
          <th>Like</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cerita as $c): ?>
        <tr>
          <td style="color:var(--text-muted)"><?= $c['id'] ?></td>
          <td>
            <?= htmlspecialchars($c['judul']) ?>
            <?php if ($c['highlight']): ?>
              <span class="badge-highlight">⭐ Highlight</span>
            <?php endif; ?>
            <br>
            <span class="badge-cat"><?= $c['kategori'] ?></span>
          </td>
          <td><?= $c['anonim'] ? '<em style="color:var(--text-muted)">Anonim</em>' : htmlspecialchars($c['nama']) ?></td>
          <td>
            <span class="like-count">❤️ <?= $c['supports'] ?></span>
          </td>
          <td style="color:var(--text-muted);white-space:nowrap"><?= date('d M Y', strtotime($c['created_at'])) ?></td>
          <td style="white-space:nowrap">
            <a href="../detail.php?id=<?= $c['id'] ?>" target="_blank" class="btn-sm btn-view">Lihat</a>
            <a href="dashboard.php?highlight=<?= $c['id'] ?>" class="btn-sm btn-highlight">⭐ Highlight</a>
            <a href="dashboard.php?hapus=<?= $c['id'] ?>" class="btn-sm btn-hapus" onclick="return confirm('Yakin hapus cerita ini? Semua komentar juga akan terhapus.')">Hapus</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Tab Komentar -->
  <div id="tab-komentar" style="display:<?= $tab === 'komentar' ? 'block' : 'none' ?>">
    <table class="admin-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Komentar</th>
          <th>Di Cerita</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($komentars as $k): ?>
        <tr>
          <td style="color:var(--text-muted)"><?= $k['id'] ?></td>
          <td><?= htmlspecialchars($k['isi']) ?></td>
          <td>
            <a href="../detail.php?id=<?= $k['cerita_id'] ?>" target="_blank" style="color:var(--brown)">
              <?= htmlspecialchars($k['judul'] ?? '-') ?>
            </a>
          </td>
          <td style="color:var(--text-muted);white-space:nowrap"><?= date('d M Y', strtotime($k['created_at'])) ?></td>
          <td>
            <a href="dashboard.php?hapus_komen=<?= $k['id'] ?>" class="btn-sm btn-hapus" onclick="return confirm('Yakin hapus komentar ini?')">Hapus</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</div>

<script>
function switchTab(tab) {
  document.getElementById('tab-cerita').style.display = tab === 'cerita' ? 'block' : 'none';
  document.getElementById('tab-komentar').style.display = tab === 'komentar' ? 'block' : 'none';
  document.querySelectorAll('.tab-btn').forEach((btn, i) => {
    btn.classList.toggle('active', (i === 0 && tab === 'cerita') || (i === 1 && tab === 'komentar'));
  });
}
</script>

</body>
</html>

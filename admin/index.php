<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    if ($password === 'ceritakita2024') {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = 'Password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - CeritaKita</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="form-wrap" style="max-width:400px">
  <div class="form-title">Admin Login</div>
  <p class="form-sub">Halaman khusus admin CeritaKita.</p>

  <?php if (isset($error)): ?>
    <div style="background:#FFF0F0;border:1px solid #F0B8B8;border-radius:12px;padding:1rem;color:#C0547A;margin-bottom:1.5rem;font-size:0.9rem">
      <?= $error ?>
    </div>
  <?php endif; ?>

  <form method="POST">
    <div class="form-group">
      <label class="form-label">Password</label>
      <input class="form-input" type="password" name="password" placeholder="Masukkan password admin..." required>
    </div>
    <button type="submit" class="form-submit">Masuk →</button>
  </form>
</div>
</body>
</html>
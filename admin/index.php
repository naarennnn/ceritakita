<?php
session_start();

if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    // Ganti username dan password sesuai keinginan kamu
    if ($user === 'admin' && $pass === 'ceritakita2024') {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='8' fill='%23FAF7F2'/><text x='3' y='23' font-family='Georgia,serif' font-size='20' font-weight='700' fill='%235C4A32'>C</text><text x='15' y='23' font-family='Georgia,serif' font-size='16' font-style='italic' fill='%23C4A882'>K</text></svg>" type="image/svg+xml">
  <title>Admin Login - CeritaKita</title>
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    :root{--cream:#FAF7F2;--cream2:#F2EDE4;--brown-light:#C4A882;--brown:#8B6F4E;--brown-dark:#5C4A32;--pink-pale:#F7EEE9;--pink-soft:#E8C5B5;--text-main:#3D2B1F;--text-muted:#8A7060}
    body{background:var(--cream);font-family:'Poppins',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:1rem}
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap');
    .login-box{background:#fff;border-radius:24px;padding:2.5rem;width:100%;max-width:380px;border:1px solid var(--cream2);box-shadow:0 20px 60px rgba(92,74,50,0.08)}
    .login-logo{font-family:'Playfair Display',serif;font-size:1.75rem;font-weight:700;color:var(--brown-dark);text-align:center;margin-bottom:0.25rem}
    .login-logo span{color:var(--brown-light)}
    .login-sub{text-align:center;font-size:0.78rem;color:var(--text-muted);margin-bottom:2rem}
    .login-label{display:block;font-size:0.7rem;font-weight:600;color:var(--brown);margin-bottom:0.5rem;text-transform:uppercase;letter-spacing:0.1em}
    .login-input{width:100%;background:var(--cream);border:1.5px solid var(--cream2);border-radius:12px;padding:0.85rem 1rem;font-family:'Poppins',sans-serif;font-size:0.875rem;color:var(--text-main);outline:none;transition:all 0.2s;margin-bottom:1.25rem}
    .login-input:focus{border-color:var(--brown-light);background:var(--pink-pale)}
    .login-btn{width:100%;background:var(--brown-light);color:#fff;border:none;padding:1rem;border-radius:100px;font-family:'Poppins',sans-serif;font-size:0.875rem;font-weight:600;cursor:pointer;transition:all 0.2s;margin-top:0.5rem}
    .login-btn:hover{background:var(--brown)}
    .login-error{background:#FFF0F0;border:1px solid #F0B8B8;border-radius:12px;padding:0.75rem 1rem;color:#C0392B;font-size:0.82rem;margin-bottom:1.25rem;text-align:center}
    .back-link{display:block;text-align:center;margin-top:1.25rem;font-size:0.78rem;color:var(--text-muted)}
    .back-link a{color:var(--brown)}
  </style>
</head>
<body>
<div class="login-box">
  <div class="login-logo">Cerita<span>Kita</span></div>
  <div class="login-sub">Admin Panel</div>

  <?php if ($error): ?>
    <div class="login-error"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST">
    <label class="login-label">Username</label>
    <input class="login-input" type="text" name="username" placeholder="Masukkan username" required autofocus>

    <label class="login-label">Password</label>
    <input class="login-input" type="password" name="password" placeholder="Masukkan password" required>

    <button type="submit" class="login-btn">Masuk →</button>
  </form>

  <div class="back-link"><a href="../index.php">← Kembali ke CeritaKita</a></div>
</div>
</body>
</html>

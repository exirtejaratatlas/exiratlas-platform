<?php
// First-run setup: creates the first admin user. Disabled once any user exists.
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/layout.php';

$count = (int) db()->query('SELECT COUNT(*) FROM users')->fetchColumn();
if ($count > 0) {
  render_auth_header('راه‌اندازی');
  echo "<div class='auth-card'><div class='auth-top'><div class='logo-box'>".eta_logo(46)."</div><h1>راه‌اندازی انجام شده</h1></div>";
  echo "<div class='auth-body'><p class='muted' style='text-align:center'>حساب مدیر قبلاً ساخته شده است. برای ورود به صفحه‌ی ورود بروید.</p>";
  echo "<a class='btn btn-jade' style='width:100%;justify-content:center;margin-top:14px' href='login.php'>رفتن به ورود</a></div></div>";
  render_auth_footer(); exit;
}

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? ''); $email = trim($_POST['email'] ?? ''); $pass = $_POST['password'] ?? '';
  if (!$name || !$email || strlen($pass) < 8) { $err = 'نام، ایمیل و رمز حداقل ۸ کاراکتری لازم است.'; }
  else {
    q('INSERT INTO users (name,email,password_hash,role,active) VALUES (?,?,?,?,1)',
      [$name, $email, password_hash($pass, PASSWORD_DEFAULT), 'admin']);
    header('Location: login.php'); exit;
  }
}
render_auth_header('راه‌اندازی اولیه');
?>
<div class="auth-card">
  <div class="auth-top"><div class="logo-box"><?= eta_logo(46) ?></div><h1>ساخت حساب مدیر</h1><p>راه‌اندازی اولیه سامانه ETA</p></div>
  <div class="auth-body">
    <?php if ($err) echo "<div class='alert alert-danger'>".e($err)."</div>"; ?>
    <form method="post">
      <div class="fg"><label>نام و نام خانوادگی</label><input name="name" re
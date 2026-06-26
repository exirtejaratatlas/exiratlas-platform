<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/layout.php';

if (current_user()) { header('Location: index.php'); exit; }
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (login($_POST['email'] ?? '', $_POST['password'] ?? '')) { header('Location: index.php'); exit; }
  $err = 'ایمیل یا رمز عبور اشتباه است.';
}
render_auth_header('ورود');
?>
<div class="auth-card">
  <div class="auth-top">
    <div class="logo-box"><?= eta_logo(46) ?></div>
    <h1>سامانه عملیاتی ETA</h1>
    <p>Exir Tejarat Atlas — Operations Portal</p>
  </div>
  <div class="auth-body">
    <?php if ($err) echo "<div class='alert alert-danger'>".e($err)."</div>"; ?>
    <form method="post">
      <div class="fg"><label>ایمیل</label><input name="email" type="email" required autofocus placeholder="ai@exiratlas.com"></div>
      <div class="fg"><label>رمز عبور</label><input name="password" type="password" required placeholder="••••••••"></div>
      <button class="btn btn-primary">ورود 
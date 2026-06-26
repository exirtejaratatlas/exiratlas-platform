<?php
require_once __DIR__ . '/auth.php';

function eta_logo($height = 40) {
  $svg = @file_get_contents(__DIR__ . '/assets/logo.svg');
  if ($svg === false) return '<strong style="color:#0B5D52">ETA</strong>';
  return preg_replace('/<svg /', '<svg style="height:' . (int)$height . 'px;width:auto;display:block" preserveAspectRatio="xMidYMid meet" ', $svg, 1);
}

function eta_head($title) {
  $t = $title ? e($title) . ' — ' . APP_NAME : APP_NAME;
  echo "<!doctype html><html lang='fa' dir='rtl'><head><meta charset='utf-8'>";
  echo "<meta name='viewport' content='width=device-width, initial-scale=1'><title>" . $t . "</title>";
  echo "<link rel='preconnect' href='https://fonts.googleapis.com'><link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>";
  echo "<link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto+Condensed:wght@400;500;700&family=Vazirmatn:wght@400;500;600;700&display=swap' rel='stylesheet'>";
  echo "<link rel='stylesheet' href='assets/app.css'>";
  echo "</head><body>";
}

function render_header($title = '') {
  $u = current_user();
  eta_head($title);
  $cur = basename($_SERVER['PHP_SELF']);
  $nav = array(array('index.php','داشبورد','🏠'), array('customers.php','مشتریان','👥'));
  if (is_admin()) { $nav[] = array('suppliers.php','ساپلایرها','🏭'); $nav[] = array('manufacturers.php','تولیدکننده‌ها','⚙️'); }
  $nav[] = array('rfqs.php','استعلام‌ها (RFQ)','📋');
  if (is_admin()) $nav[] = array('users.php','کاربران','🔑');

  echo "<div class='app'><aside class='sidebar'>";
  echo "<div class='brand'><div class='logo-box'>" . eta_logo(30) . "</div><div><div class='bt'>ETA Portal</div><div class='bv'>OPERATIONS</div></div></div>";
  foreach ($nav as $it) {
    $a = $cur === $it[0] ? ' active' : '';
    echo "<a class='nav-item" . $a . "' href='" . $it[0] . "'><span class='ic'>" . $it[2] . "</span>" . e($it[1]) . "</a>";
  }
  echo "<div class='nav-spacer'></div>";
  echo "<div class='nav-foot'><b>Exir Tejarat Atlas</b><br>Industrial Trading<br>Oil &amp; Gas · Petrochem · Steel</div>";
  echo "</aside><main class='main'>";

  if ($u) {
        $initial = preg_match('/^./u', $u['name'], $m) ? $m[0] : 'E';
    echo "<div class='topbar'><div></div><div class='userchip'>";
    echo "<a class='btn btn-ghost btn-sm' href='logout.php'>خروج</a>";
    echo "<div style='text-align:left'><div class='un'>" . e($u['name']) . "</div><div class='ur'>" . ($u['role'] === 'admin' ? 'مدیر' : 'همکار') . "</div></div>";
    echo "<div class='av'>" . e($initial) . "</div></div></div>";
  }
}
function render_footer() { echo "</main></div></body></html>"; }

function render_auth_header($title = '') { eta_head($title); echo "<div class='auth-wrap'>"; }
function render_auth_footer() { echo "</div></body></html>"; }

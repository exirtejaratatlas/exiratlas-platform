<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/layout.php';
require_login();
$u = current_user();
$action = $_GET['action'] ?? 'list';

if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $code = next_code('CUST', 'customers');
  q('INSERT INTO customers (code,legal_name,industry,sub_segment,city,country,status,payment_rating,source,owner_user_id,notes)
     VALUES (?,?,?,?,?,?,?,?,?,?,?)', [
    $code, trim($_POST['legal_name']), $_POST['industry'] ?: null, $_POST['sub_segment'] ?: null,
    $_POST['city'] ?: null, $_POST['country'] ?: 'Iran', $_POST['status'] ?: 'Lead',
    $_POST['payment_rating'] ?: null, $_POST['source'] ?: null, $u['id'], $_POST['notes'] ?: null,
  ]);
  header('Location: customers.php'); exit;
}
if ($action === 'add_contact' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  q('INSERT INTO contacts (customer_id,full_name,title,decision_power,phone,email,language) VALUES (?,?,?,?,?,?,?)', [
    (int)$_POST['customer_id'], trim($_POST['full_name']), $_POST['title'] ?: null,
    $_POST['decision_power'] ?: null, $_POST['phone'] ?: null, $_POST['email'] ?: null, $_POST['language'] ?: 'FA',
  ]);
  header('Location: customers.php?action=view&id=' . (int)$_POST['customer_id']); exit;
}
if ($action === 'delete' && is_admin()) {
  q('DELETE FROM customers WHERE id = ?', [(int)$_GET['id']]);
  q('DELETE FROM contacts WHERE customer_id = ?', [(int)$_GET['id']]);
  header('Location: customers.php'); exit;
}

render_header('مشتریان');

if ($action === 'view') {
  $id = (int)$_GET['id'];
  $c = q('SELECT * FROM customers WHERE id = ?', [$id])->fetch();
  if (!$c || (!is_admin() && $c['owner_user_id'] != $u['id'])) { echo "<div class='alert alert-danger'>یافت نشد یا دسترسی ندارید.</div>"; render_footer(); exit; }
  $contacts = q('SELECT * FROM contacts WHERE customer_id = ? ORDER BY id DESC', [$id])->fetchAll();
  echo "<a href='customers.php' class='btn btn-ghost btn-sm' style='margin-bottom:16px'>→ بازگشت به فهرست</a>";
  echo "<div class='panel'>";
  echo "<div style='display:flex;justify-content:space-between;align-items:flex-start;gap:12px;flex-wrap:wrap'>";
  echo "<div><h2 style='margin-bottom:4px'>".e($c['legal_name'])."</h2><div class='muted'>".e($c['industry'])." · ".e($c['sub_segment'])." · ".e($c['city']).", ".e($c['country'])."</div></div>";
  echo "<span class='pill'>".e($c['code'])."</span></div>";
  echo "<div style='display:flex;gap:24px;margin-top:14px;font-size:13.5px;flex-wrap:wrap'>";
  echo "<div><span class='muted'>وضعیت:</span> <b>".e($c['status'])."</b></div>";
  echo "<div><span class='muted'>اعتبار پرداخت:</span> <b>".e($c['payment_rating'] ?: '—')."</b></div>";
  echo "<div><span class='muted'>منبع:</span> <b>".e($c['source'] ?: '—')."</b></div></div>";
  if ($c['notes']) echo "<p style='margin-top:12px;background:#fafbfb;border-right:3px solid var(--line);padding:10px 12px;border-radius:8px 0 0 8px'>".nl2br(e($c['notes']))."</p>";
  echo "</div>";

  echo "<div class='panel'><h3>مخاطبین</h3>";
  if ($contacts) {
    echo "<table class='tbl'><thead><tr><th>نام</th><th>سمت</th><th>قدرت تصمیم</th><th>تلفن</th><th>ایمیل</th></tr></thead><tbody>";
    foreach ($contacts as $ct) echo "<tr><td>".e($ct['full_name'])."</td><td>".e($ct['title'])."</td><td>".e($ct['decision_power'])."</td><td>".e($ct['phone'])."</td><td>".e($ct['email'])."</td></tr>";
    echo "</tbody></table>";
  } else echo "<p class='muted'>هنوز مخاطبی ثبت نشده.</p>";
  echo "<h3 style='margin-top:20px;font-size:14px'>افزودن مخاطب</h3>";
  echo "<form method='post' action='customers.php?action=add_contact' class='grid2'>";
  echo "<input type='hidden' name='customer_id' value='$id'>";
  echo "<div class='fg' style='margin:0'><input name='full_name' placeholder='نام *' required></div>";
  echo "<div class='fg' style='margin:0'><input name='title' placeholder='سمت'></div>";
  echo "<div class='fg' style='margin:0'><select name='decision_power'><option value=''>قدرت تصمیم…</option><option value='decision-maker'>تصمیم‌گیرنده</option><option value='influencer'>تأثیرگذار</option><option value='user'>کاربر</option></select></div>";
  echo "<div class='fg' style='margin:0'><input name='phone' placeholder='تلفن'></div>";
  echo "<div class='fg' style='margin:0'><input name='email' placeholder='ایمیل'></div>";
  echo "<div class='fg' style='margin:0'><button class='btn btn-jade' style='width:100%'>افزودن</button></div>";
  echo "</form></div>";
  render_footer(); exit;
}

$rows = is_admin()
  ? db()->query('SELECT * FROM customers ORDER BY id DESC')->fetchAll()
  : q('SELECT * FROM customers WHERE owner_user_id = ? ORDER BY id DESC', [$u['id']])->fetchAll();

echo "<div class='toolbar'><h1>مشتریان (CRM)</h1>";
echo "<button class='btn btn-primary' onclick=\"document.getElementById('addForm').style.display=document.getElementById('addForm').style.display==='none'?'block':'none'\">+ مشتری جدید</button></div>";

echo "<div class='panel' id='addForm' style='display:none'><h3>افزودن مشتری</h3><form method='post' action='customers.php?action=create'>";
echo "<div class='grid2'>";
echo "<div class='fg'><label>نام شرکت <span class='req'>*</span></label><input name='legal_name' required></div>";
echo "<div class='fg'><label>صنعت</label><select name='industry'><option value=''>—</option><option>Oil &amp; Gas</option><option>Petrochemical</option><option>Steel</option><option>Mining</option><option>Power</option><option>Other</option></select></div>";
echo "<div class='fg'><label>زیرشاخه</label><input name='sub_segment'></div>";
echo "<div class='fg'><label>شهر</label><input name='city'></div>";
echo "<div class='fg'><label>کشور</label><input name='country' value='Iran'></div>";
echo "<div class='fg'><label>وضعیت</label><select name='status'><option>Lead</option><option>Active</option><option>Dormant</option></select></div>";
echo "<div class='fg'><label>اعتبار پرداخت</label><select name='payment_rating'><option value=''>—</option><option>A</option><option>B</option><option>C</option><option>D</option></select></div>";
echo "<div class='fg'><label>منبع</label><input name='source'></div>";
echo "</div>";
echo "<div class='fg'><label>یادداشت</label><textarea name='notes'></textarea></div>";
echo "<button class='btn btn-jade'>ذخیره مشتری</button></form></div>";

echo "<div class='panel'>";
if ($rows) {
  echo "<table class='tbl'><thead><tr><th>کد</th><th>نام شرکت</th><th>صنعت</th><th>شهر</th><th>وضعیت</th><th></th></tr></thead><tbody>";
  foreach ($rows as $r) {
    echo "<tr><td><span class='pill'>".e($r['code'])."</span></td><td><b>".e($r['legal_name'])."</b></td><td>".e($r['industry'])."</td><td>".e($r['city'])."</td><td>".e($r['status'])."</td>";
    echo "<td style='text-align:left;white-space:nowrap'><a class='btn btn-ghost btn-sm' href='customers.php?action=view&id=".$r['id']."'>مشاهده</a>";
    if (is_admin()) echo " <a class='btn btn-danger btn-sm' href='customers.php?action=delete&id=".$r['id']."' onclick=\"return confirm('حذف شود؟')\">حذف</a>";
    echo "</td></tr>";
  }
  echo "</tbody></table>";
} else echo "<div style='text-align:center;padding:50px 20px' class='muted'><div style='font-size:42px;opacity:.3'>👥</div><h3 style='margin-top:10px;color:var(--ink)'>هنوز مشتری‌ای ثبت نشده</h3><p>روی «مشتری جدید» بزنید تا اولین مشتری را اضافه کنید.</p></div>";
echo "</div>
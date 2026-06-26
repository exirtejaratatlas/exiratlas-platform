<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
register_shutdown_function(function () {
  $e = error_get_last();
  if ($e) {
    echo "\n\n===FATAL===\n" . $e['message'] . "\nFILE: " . $e['file'] . "\nLINE: " . $e['line'] . "\n";
  }
});
header('Content-Type: text/plain; charset=utf-8');
echo "PHP " . PHP_VERSION . "\n";
echo "mbstring=" . (function_exists('mb_substr') ? 'YES' : 'NO') . "\n";
echo "pdo_mysql=" . (extension_loaded('pdo_mysql') ? 'YES' : 'NO') . "\n";
require __DIR__ . '/auth.php';
echo "auth OK\n";
require __DIR__ . '/layout.php';
echo "layout OK\n";
try {
  $n = db()->query('SELECT COUNT(*) FROM customers')->fetchColumn();
  echo "db OK, customers=$n\n";
} catch (Throwable $t) {
  echo "DB ERROR: " . $t->getMessage() . "\n";
}
$_SESSION['user'] = ['id' => 1, 'name' => 'Ali', 'role' => 'admin'];
echo "calling render_header...\n";
render_header('Diag');
echo "\n===DONE===\n";

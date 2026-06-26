<?php
// ===== ETA Portal configuration =====
// Edit these values after you create the MySQL database in DirectAdmin.

define('DB_HOST', 'localhost');
define('DB_NAME', 'gzfwmapb_portal');   // your database (already created)
define('DB_USER', 'gzfwmapb_portal');   // your database user
define('DB_PASS', 'PUT_YOUR_DB_PASSWORD_HERE'); // <-- ONLY YOU: paste the password you saved when creating the DB

define('APP_NAME', 'ETA Portal');
define('APP_URL', 'https://portal.exiratlas.com');

// Token n8n must send to use the API (api.php). Pre-generated for you:
define('API_TOKEN', '7pFS2quqvEF7TBeNStNKkil-E3X_MI3YxloTXcIGJKI');

date_default_timezone_set('Asia/Tehran');

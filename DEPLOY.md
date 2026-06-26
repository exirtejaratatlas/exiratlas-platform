<?php
require_once __DIR__ . '/auth.php';

/* Official ETA logo (approved SVG). Renders at given pixel height. */
function eta_logo($height = 40) {
  $svg = file_get_contents(__DIR__ . '/assets/logo.svg');
  if ($svg === false) return '<strong>ETA</strong>';
  // inject sizing
  $svg = preg_replace('/<svg /', '<svg style="height:' . (int)$height . 'px;width:auto;display:block" preserveAspectRatio="xMidYMid meet" ', $svg, 1);
  return $svg;
}

function eta_styles() { ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto+Condensed:wght@400;500;700&family=Vazirmatn:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --jade:#0B5D52; --jade-d:#084a41; --jade-l:#e7f1ef; --jade-deep:#063b34;
  --orange:#E66A1F; --orange-d:#c85512;
  --ink:#2D3136; --ink-soft:#5a6068; --line:#e3e7ea; --bg:#f4f6f7; --white:#fff;
  --ok:#1f9d6b; --warn:#e6a91f; --info:#2f74c0; --done:#6c757d; --danger:#c0392b;
  --radius:14px;
  --shadow:0 1px 3px rgba(45,49,54,.08),0 6px 24px rgba(45,49,54,.06);
  --font:'Vazirmatn','Montserrat',system-ui,sans-serif;
  --mono:'Roboto Condensed','Vazirmatn',sans-serif;
}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:var(--font);background:var(--bg);color:var(--ink);line-height:1.6;-webkit-font-smoothing:antialiased}
a{text-decoration:none;color:inherit}
button{font-family:inherit;cursor:pointer;border:none}
input,select,textarea{font-family:inherit;font-size:14px}

/* ---------- App shell (RTL: sidebar on right) ---------- */
.app{display:grid;grid-template-columns:250px 1fr;min-height:100vh}
.sidebar{background:linear-gradient(180deg,var(--jade) 0%,var(--jade-deep) 100%);color:#dff0ed;padding:22px 16px;display:flex;flex-direction:column;gap:6px;position:sticky;top:0;height:100vh}
.brand{display:flex;align-items:center;gap:11px;padding-bottom:18px;margin-bottom:10px;border-bottom:1px solid rgba(255,255,255,.12)}
.brand .logo-box{background:#fff;border-radius:9px;padding:7px 9px;display:flex;align-items:center}
.brand .bt{fon
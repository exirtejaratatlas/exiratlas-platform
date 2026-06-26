:root{--jade:#0B5D52;--jade-d:#084a41;--jade-l:#e7f1ef;--jade-deep:#063b34;--orange:#E66A1F;--orange-d:#c85512;--ink:#2D3136;--ink-soft:#5a6068;--line:#e3e7ea;--bg:#f4f6f7;--white:#fff;--ok:#1f9d6b;--info:#2f74c0;--danger:#c0392b;--radius:14px;--shadow:0 1px 3px rgba(45,49,54,.08),0 6px 24px rgba(45,49,54,.06);--font:'Vazirmatn','Montserrat',system-ui,sans-serif;--mono:'Roboto Condensed','Vazirmatn',sans-serif}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:var(--font);background:var(--bg);color:var(--ink);line-height:1.6;-webkit-font-smoothing:antialiased}
a{text-decoration:none;color:inherit}button{font-family:inherit;cursor:pointer;border:none}
input,select,textarea{font-family:inherit;font-size:14px}
.app{display:grid;grid-template-columns:250px 1fr;min-height:100vh}
.sidebar{background:linear-gradient(180deg,var(--jade),var(--jade-deep));color:#dff0ed;padding:22px 16px;display:flex;flex-direction:column;gap:6px;position:sticky;top:0;height:100vh}
.brand{display:flex;align-items:center;gap:11px;padding-bottom:18px;margin-bottom:10px;border-bottom:1px solid rgba(255,255,255,.12)}
.brand .logo-box{background:#fff;border-radius:9px;padding:7px 9px;display:flex;align-items:center}
.brand .bt{font-family:'Montserrat',sans-serif;font-weight:700;font-size:15px;color:#fff}
.brand .bv{font-family:var(--mono);font-size:10px;letter-spacing:1.5px;color:var(--orange);font-weight:700}
.nav-item{display:flex;align-items:center;gap:11px;padding:11px 13px;border-radius:10px;color:#cfe6e2;font-size:14px;font-weight:500;transition:.15s}
.nav-item.active{background:rgba(255,255,255,.13);color:#fff;box-shadow:inset 3px 0 0 var(--orange)}
.nav-item:hover{background:rgba(255,255,255,.08);color:#fff}
.nav-item .ic{width:20px;text-align:center;font-size:15px}
.nav-spacer{flex:1}
.nav-foot{font-size:11px;color:#9fc4be;line-height:1.7;border-top:1px solid rgba(255,255,255,.12);padding-top:14px}
.nav-foot b{color:#dff0ed;font-weight:600}
.main{padding:26px 32px;max-width:1500px}
.topbar{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:24px;flex-wrap:wrap}
.topbar h1{font-size:22px;font-weight:700}
.userchip{display:flex;align-items:center;gap:10px}
.userchip .av{width:38px;height:38px;border-radius:50%;background:var(--jade);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-family:var(--mono)}
.userchip .un{font-weight:600;font-size:13.5px}.userchip .ur{font-size:11.5px;color:var(--ink-soft)}
.btn{display:inline-flex;align-items:center;gap:8px;padding:11px 18px;border-radius:10px;font-weight:600;font-size:14px;transition:.15s;color:var(--ink)}
.btn-primary{background:var(--orange);color:#fff}.btn-primary:hover{background:var(--orange-d)}
.btn-jade{background:var(--jade);color:#fff}.btn-jade:hover{background:var(--jade-d)}
.btn-ghost{background:var(--white);color:var(--ink);border:1px solid var(--line)}.btn-ghost:hover{border-color:var(--jade);color:var(--jade)}
.btn-sm{padding:7px 13px;font-size:12.5px;border-radius:8px}
.btn-danger{background:#fdecea;color:var(--danger)}.btn-danger:hover{background:var(--danger);color:#fff}
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:26px}
.stat{background:var(--white);border:1px solid var(--line);border-radius:var(--radius);padding:18px 20px;box-shadow:var(--shadow);position:relative;overflow:hidden}
.stat:before{content:'';position:absolute;top:0;right:0;width:4px;height:100%;background:var(--jade)}
.stat.s-orange:before{background:var(--orange)}.stat.s-info:before{background:var(--info)}.stat.s-ok:before{background:var(--ok)}
.stat .n{font-size:30px;font-weight:700;font-family:var(--mono);color:var(--jade)}
.stat.s-orange .n{color:var(--orange)}.stat.s-info .n{color:var(--info)}.stat.s-ok .n{color:var(--ok)}
.stat .l{font-size:13px;color:var(--ink-soft);font-weight:500;margin-top:3px}
.panel{background:var(--white);border:1px solid var(--line);border-radius:var(--radius);box-shadow:var(--shadow);padding:22px;margin-bottom:18px}
.panel h2,.panel h3{font-size:16px;font-weight:700;margin-bottom:14px}
.toolbar{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:18px;flex-wrap:wrap}
.toolbar h1{font-size:21px;font-weight:700}
table.tbl{width:100%;border-collapse:collapse;font-size:14px}
table.tbl th{text-align:right;font-size:12px;font-weight:600;color:var(--ink-soft);text-transform:uppercase;letter-spacing:.4px;padding:10px 12px;border-bottom:2px solid var(--line)}
table.tbl td{padding:13px 12px;border-bottom:1px solid var(--line)}
table.tbl tr:hover td{background:#fafbfb}
.pill{display:inline-block;font-size:11.5px;font-weight:700;padding:4px 11px;border-radius:20px;font-family:var(--mono);background:var(--jade-l);color:var(--jade)}
.fg{margin-bottom:15px}
.fg label{display:block;font-size:12.5px;font-weight:600;margin-bottom:6px;color:var(--ink)}
.fg label .req{color:var(--orange-d)}
.fg input,.fg select,.fg textarea{width:100%;padding:11px 13px;border:1px solid var(--line);border-radius:10px;background:#fcfdfd;transition:.15s}
.fg input:focus,.fg select:focus,.fg textarea:focus{outline:none;border-color:var(--jade);background:#fff;box-shadow:0 0 0 3px rgba(11,93,82,.12)}
.fg textarea{resize:vertical;min-height:74px}
.grid2{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:14px}
.alert{padding:12px 15px;border-radius:10px;font-size:13.5px;margin-bottom:16px}
.alert-danger{background:#fdecea;color:var(--danger);border:1px solid #f5c6cb}
.muted{color:var(--ink-soft)}
.auth-wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;background:linear-gradient(135deg,var(--jade),var(--jade-deep) 60%,#04302b);position:relative;overflow:hidden}
.auth-wrap:before{content:'';position:absolute;inset:0;background-image:radial-gradient(circle at 80% 15%,rgba(230,106,31,.18),transparent 40%),radial-gradient(circle at 15% 85%,rgba(40,160,154,.16),transparent 38%)}
.auth-card{position:relative;background:var(--white);border-radius:20px;width:100%;max-width:430px;box-shadow:0 24px 70px rgba(0,0,0,.35);overflow:hidden}
.auth-top{padding:32px 36px 20px;text-align:center;border-bottom:1px solid var(--line)}
.auth-top .logo-box{display:inline-flex;background:#fff;padding:6px 4px;margin-bottom:14px}
.auth-top h1{font-size:19px;font-weight:700;color:var(--jade)}
.auth-top p{font-size:12.5px;color:var(--ink-soft);margin-top:4px}
.auth-body{padding:26px 36px 32px}.auth-body .btn{width:100%;justify-content:center;margin-top:6px}
.auth-foot{text-align:center;font-size:11px;color:var(--ink-soft);padding:0 36px 24px}
.auth-foot .mono{font-family:var(--mono);letter-spacing:.5px}
@media(max-width:820px){.app{grid-template-columns:1fr}.sidebar{position:static;height:auto}.nav-foot{display:none}.stats{grid-template-columns:repeat(2,1fr)}.main{padding:18px}}

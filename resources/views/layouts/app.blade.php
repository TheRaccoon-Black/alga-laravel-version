<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Sispak Kulit')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root{--primary:#1e40af;--primary-light:#3b82f6;--bg:#f1f5f9;--surface:#fff;--text:#1e293b;--muted:#64748b;--border:#e2e8f0;--radius:12px}
body{background:var(--bg);color:var(--text);font-family:'Segoe UI',system-ui,sans-serif;min-height:100vh}
.nav{background:var(--surface);border-bottom:1px solid var(--border);padding:0 24px;display:flex;align-items:center;justify-content:space-between;height:60px;position:sticky;top:0;z-index:100;box-shadow:0 1px 0 rgba(0,0,0,.06)}
.nav-brand{font-weight:700;font-size:15px;color:var(--primary);text-decoration:none}
.nav-links{display:flex;gap:4px}
.nav-links a{text-decoration:none;color:var(--muted);font-size:14px;font-weight:500;padding:6px 14px;border-radius:8px}
.nav-links a:hover,.nav-links a.active{color:var(--primary);background:#eff6ff}
.wrap{max-width:1080px;margin:0 auto;padding:24px 20px 60px}
.hero{background:var(--primary);color:#fff;border-radius:var(--radius);padding:24px 28px;margin-bottom:24px}
.hero h1{font-size:18px;font-weight:700;margin-bottom:6px}
.hero p{font-size:13px;opacity:.85;margin-bottom:12px}
.badge-on{display:inline-flex;align-items:center;gap:6px;padding:5px 14px;border-radius:20px;font-size:13px;font-weight:600;background:#dcfce7;color:#166534}
.badge-off{display:inline-flex;align-items:center;gap:6px;padding:5px 14px;border-radius:20px;font-size:13px;font-weight:600;background:#fee2e2;color:#991b1b}
.stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;margin-bottom:28px}
.stat-card{background:var(--surface);border-radius:var(--radius);padding:18px 16px;text-align:center;box-shadow:0 1px 2px rgba(0,0,0,.06);border:1px solid var(--border)}
.stat-card .angka{font-size:28px;font-weight:800;color:var(--primary);line-height:1.2}
.stat-card .label{font-size:12px;color:var(--muted);margin-top:4px;font-weight:500}
.section-title{font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);margin-bottom:12px;padding-left:2px}
.menu{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:12px;margin-bottom:32px}
.menu a{display:flex;align-items:flex-start;gap:14px;background:var(--surface);padding:18px 20px;border-radius:var(--radius);text-decoration:none;color:var(--text);box-shadow:0 1px 2px rgba(0,0,0,.06);border:1px solid var(--border)}
.menu a:hover{border-color:var(--primary-light)}
.menu .ikon{font-size:24px;line-height:1;flex-shrink:0;margin-top:2px}
.menu b{display:block;font-size:14px;font-weight:600}
.menu small{display:block;font-size:12px;color:var(--muted);margin-top:2px;line-height:1.4}
.menu a.utama{background:var(--primary);border-color:transparent;color:#fff}
.menu a.utama b{color:#fff}
.menu a.utama small{color:rgba(255,255,255,.8)}
.card{background:var(--surface);border-radius:var(--radius);padding:28px;box-shadow:0 1px 2px rgba(0,0,0,.06);border:1px solid var(--border);margin-bottom:20px}
.card h2{font-size:18px;font-weight:700;margin-bottom:4px}
.card .sub{font-size:13px;color:var(--muted);margin-bottom:20px}
.checkbox-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:8px;margin:16px 0}
.checkbox-grid label{display:flex;align-items:center;gap:10px;padding:10px 14px;background:var(--bg);border:1px solid var(--border);border-radius:8px;cursor:pointer;font-size:14px}
.checkbox-grid label:hover{border-color:var(--primary-light);background:#f8faff}
.checkbox-grid input[type=checkbox]{width:16px;height:16px;accent-color:var(--primary)}
.btn{display:inline-flex;align-items:center;gap:6px;padding:9px 20px;border-radius:8px;font-size:14px;font-weight:600;text-decoration:none;border:none;cursor:pointer}
.btn-primary{background:var(--primary);color:#fff}
.btn-primary:hover{background:#1e3a8a}
.btn-outline{background:transparent;color:var(--primary);border:1px solid var(--border)}
.btn-outline:hover{background:#eff6ff;border-color:var(--primary-light)}
.btn-sm{padding:6px 12px;font-size:13px}
.btn-danger{background:#dc2626;color:#fff}
.btn-danger:hover{background:#b91c1c}
.alert{padding:12px 16px;border-radius:8px;font-size:14px;margin-bottom:16px}
.alert-info{background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe}
.alert-success{background:#dcfce7;color:#166534;border:1px solid #bbf7d0}
.alert-warn{background:#fef3c7;color:#92400e;border:1px solid #fde68a}
.alert-error{background:#fee2e2;color:#991b1b;border:1px solid #fca5a5}
.result-list{display:flex;flex-direction:column;gap:8px;margin:16px 0}
.result-item{display:flex;align-items:center;justify-content:space-between;padding:14px 18px;background:var(--surface);border:1px solid var(--border);border-radius:10px}
.result-item:first-child{border-color:var(--primary-light);background:#eff6ff}
.result-item .rank{font-weight:700;color:var(--muted);font-size:13px;width:24px}
.result-item .name{font-weight:600;font-size:14px;flex:1}
.result-item .pct{font-weight:700;color:var(--primary);font-size:15px}
.result-item.top .name::after{content:' ← hasil utama';font-size:12px;color:#16a34a;font-weight:600}
.progress-row{display:flex;align-items:center;gap:10px}
.progress-bar{flex:1;height:8px;background:var(--border);border-radius:99px;overflow:hidden}
.progress-bar .fill{height:100%;background:var(--primary);border-radius:99px}
.result-item.top .progress-bar .fill{background:#16a34a}
.table-wrap{overflow-x:auto;border-radius:var(--radius);border:1px solid var(--border);background:var(--surface)}
table{width:100%;border-collapse:collapse;font-size:14px}
th,td{padding:10px 14px;text-align:left;border-bottom:1px solid var(--border);white-space:nowrap}
th{background:#f8fafc;font-weight:600;color:var(--muted);font-size:12px;text-transform:uppercase;letter-spacing:.04em}
tr:last-child td{border-bottom:none}
tr:hover td{background:#f8fafc}
footer{text-align:center;font-size:12px;color:var(--muted);padding:20px 0 0;border-top:1px solid var(--border)}
.cm-cell{padding:8px 12px;border-radius:4px;font-weight:600;font-size:13px}
.cm-diag{background:#dcfce7;color:#166534}
.cm-salah{background:#fee2e2;color:#991b1b}
.cm-kosong{background:#f8fafc;color:var(--muted)}
@media(max-width:640px){.nav{padding:0 16px}.nav-links a{padding:6px 10px;font-size:13px}.wrap{padding:16px 14px 48px}.card{padding:18px}}
</style>
</head>
<body>
<nav class="nav">
  <a class="nav-brand" href="{{ route('home') }}">Sispak Kulit</a>
  <div class="nav-links">
    <a href="{{ route('home') }}"{{ request()->routeIs('home') ? ' class="active"' : '' }}>Beranda</a>
    <a href="{{ route('konsultasi.index') }}"{{ request()->routeIs('konsultasi*') ? ' class="active"' : '' }}>Konsultasi</a>
    <a href="{{ route('admin.evaluation.index') }}"{{ request()->routeIs('admin.evaluation*') ? ' class="active"' : '' }}>Evaluasi</a>
  </div>
</nav>

<div class="wrap">
@yield('content')
<footer>Prototype skripsi — Algalin Zakawali (G1A021077) — Informatika, Universitas Bengkulu</footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>

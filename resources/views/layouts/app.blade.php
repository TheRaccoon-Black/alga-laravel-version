<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Sispak Kulit')</title>
<style>
:root {
  --sidebar-w: 248px;
  --topbar-h: 52px;
  --nav-bg: #0f1c3f;
  --nav-text: rgba(255,255,255,.65);
  --nav-active: #ffffff;
  --nav-hover: rgba(255,255,255,.08);
  --accent: #2563eb;
  --accent-dark: #1d4ed8;
  --page-bg: #f0f2f7;
  --surface: #ffffff;
  --border: #d8dce8;
  --text: #1e293b;
  --text-sec: #64748b;
  --success: #16a34a;
  --warn: #d97706;
  --danger: #dc2626;
  --radius: 8px;
}
*{margin:0;padding:0;box-sizing:border-box}
body{background:var(--page-bg);color:var(--text);font-family:'Segoe UI',system-ui,-apple-system,sans-serif;min-height:100vh}
a{text-decoration:none;color:inherit}

/* ── Topbar ── */
.topbar{
  position:fixed;top:0;left:0;right:0;height:var(--topbar-h);
  background:var(--surface);border-bottom:1px solid var(--border);
  display:flex;align-items:center;padding:0 24px;
  z-index:200;gap:16px;
}
.topbar-brand{
  font-size:14px;font-weight:700;color:var(--accent-dark);
  white-space:nowrap;letter-spacing:.01em;
}
.topbar-brand span{color:var(--text);font-weight:400;font-size:12px;margin-left:6px}
.topbar-links{display:flex;gap:4px;margin-left:auto}
.topbar-links a{
  padding:5px 12px;border-radius:6px;font-size:13px;font-weight:500;
  color:var(--text-sec);transition:all .15s;
}
.topbar-links a:hover,.topbar-links a.active{color:var(--accent);background:#eff6ff}
.hamburger{display:none;background:none;border:none;cursor:pointer;padding:4px;color:var(--text)}

/* ── Sidebar ── */
.sidebar{
  position:fixed;top:var(--topbar-h);left:0;bottom:0;
  width:var(--sidebar-w);background:var(--nav-bg);
  overflow-y:auto;z-index:150;
  scrollbar-width:thin;scrollbar-color:rgba(255,255,255,.15) transparent;
}
.sidebar::-webkit-scrollbar{width:4px}
.sidebar::-webkit-scrollbar-thumb{background:rgba(255,255,255,.15);border-radius:2px}
.sidebar-section{padding:12px 0 4px}
.sidebar-label{
  font-size:10px;font-weight:700;text-transform:uppercase;
  letter-spacing:.1em;color:rgba(255,255,255,.3);
  padding:0 16px;margin-bottom:4px;
}
.sidebar-nav{list-style:none}
.sidebar-nav li{}

/* Group header (dropdown toggle) */
.sidebar-group{border-top:1px solid rgba(255,255,255,.07)}
.sidebar-group-header{
  display:flex;align-items:center;gap:10px;
  padding:8px 16px;font-size:12px;font-weight:700;
  text-transform:uppercase;letter-spacing:.08em;
  color:rgba(255,255,255,.35);cursor:pointer;
  transition:color .15s;user-select:none;
}
.sidebar-group-header:hover{color:rgba(255,255,255,.6)}
.sidebar-group-header .arrow{
  margin-left:auto;font-size:10px;transition:transform .2s;
  color:rgba(255,255,255,.3);
}
.sidebar-group.open .sidebar-group-header .arrow{transform:rotate(90deg)}

.sidebar-nav a{
  display:flex;align-items:center;gap:10px;
  padding:7px 16px 7px 28px;font-size:13px;font-weight:500;
  color:var(--nav-text);border-left:3px solid transparent;
  transition:all .15s;
}
.sidebar-nav a:hover{color:var(--nav-active);background:var(--nav-hover)}
.sidebar-nav a.active{
  color:var(--nav-active);background:rgba(255,255,255,.07);
  border-left-color:var(--accent);
}
.sidebar-nav a .icon{width:18px;height:18px;flex-shrink:0;color:currentColor}

.sidebar-group-items{display:none}
.sidebar-group.open .sidebar-group-items{display:block}

.sidebar-footer{
  margin-top:auto;padding:16px;border-top:1px solid rgba(255,255,255,.07);
  font-size:11px;color:rgba(255,255,255,.3);line-height:1.6;
}

/* ── Main ── */
.main{
  margin-left:var(--sidebar-w);margin-top:var(--topbar-h);
  padding:28px 32px 60px;min-height:calc(100vh - var(--topbar-h));
}

/* ── Cards & Components ── */
.page-header{margin-bottom:24px}
.page-title{font-size:18px;font-weight:700;color:var(--text);margin-bottom:4px}
.page-sub{font-size:13px;color:var(--text-sec)}
.section-label{
  font-size:11px;font-weight:700;text-transform:uppercase;
  letter-spacing:.08em;color:var(--text-sec);margin-bottom:12px;
}
.card{
  background:var(--surface);border:1px solid var(--border);
  border-radius:var(--radius);padding:24px;margin-bottom:20px;
  box-shadow:0 1px 3px rgba(0,0,0,.04);
}
.card h2{font-size:16px;font-weight:700;margin-bottom:4px;color:var(--text)}
.card .sub{font-size:13px;color:var(--text-sec);margin-bottom:20px}

/* Buttons */
.btn{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 18px;border-radius:6px;font-size:13px;font-weight:600;
  border:none;cursor:pointer;transition:all .15s;text-decoration:none;
}
.btn-primary{background:var(--accent);color:#fff}
.btn-primary:hover{background:var(--accent-dark)}
.btn-outline{background:transparent;color:var(--accent);border:1px solid var(--border)}
.btn-outline:hover{background:#eff6ff;border-color:var(--accent)}
.btn-danger{background:var(--danger);color:#fff}
.btn-danger:hover{background:#b91c1c}
.btn-sm{padding:5px 12px;font-size:12px}

/* Form */
.form-group{margin-bottom:16px}
.form-label{display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:5px}
.form-control{
  width:100%;padding:8px 12px;border:1px solid var(--border);
  border-radius:6px;font-size:14px;color:var(--text);background:var(--surface);
  transition:border-color .15s;
}
.form-control:focus{outline:none;border-color:var(--accent);box-shadow:0 0 0 3px rgba(37,99,235,.1)}
.form-select{
  width:100%;padding:8px 12px;border:1px solid var(--border);
  border-radius:6px;font-size:14px;color:var(--text);background:var(--surface);
  appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
  background-repeat:no-repeat;background-position:right 10px center;padding-right:30px;
}
.form-check{display:flex;align-items:flex-start;gap:8px;margin-bottom:10px;cursor:pointer}
.form-check input{width:15px;height:15px;margin-top:2px;accent-color:var(--accent);flex-shrink:0}
.form-check-label{font-size:13px;color:var(--text);line-height:1.4}
.checkbox-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:6px;margin:12px 0}
.checkbox-grid label{
  display:flex;align-items:center;gap:8px;padding:9px 12px;
  background:#f8fafc;border:1px solid var(--border);border-radius:6px;
  cursor:pointer;font-size:13px;color:var(--text);transition:all .15s;
}
.checkbox-grid label:hover{border-color:var(--accent);background:#eff6ff}
.checkbox-grid input{accent-color:var(--accent);width:14px;height:14px}

/* Alerts */
.alert{padding:11px 14px;border-radius:6px;font-size:13px;margin-bottom:14px;line-height:1.5}
.alert-info{background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe}
.alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0}
.alert-warn{background:#fffbeb;color:#92400e;border:1px solid #fde68a}
.alert-error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca}

/* Tables */
.table-wrap{overflow-x:auto;border:1px solid var(--border);border-radius:var(--radius);background:var(--surface)}
table{width:100%;border-collapse:collapse;font-size:13px}
th,td{padding:9px 14px;text-align:left;border-bottom:1px solid var(--border);white-space:nowrap}
th{background:#f8fafc;font-weight:600;color:var(--text-sec);font-size:11px;text-transform:uppercase;letter-spacing:.05em}
tr:last-child td{border-bottom:none}
tr:hover td{background:#f8fafc}

/* Stats */
.stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(130px,1fr));gap:10px;margin-bottom:28px}
.stat-card{
  background:var(--surface);border:1px solid var(--border);
  border-radius:var(--radius);padding:16px;text-align:center;
  box-shadow:0 1px 2px rgba(0,0,0,.04);
}
.stat-card .angka{font-size:26px;font-weight:800;color:var(--accent);line-height:1.2}
.stat-card .label{font-size:11px;color:var(--text-sec);margin-top:4px;font-weight:500;text-transform:uppercase;letter-spacing:.04em}

/* Menu cards */
.menu{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:10px;margin-bottom:28px}
.menu a{
  display:flex;align-items:flex-start;gap:12px;
  background:var(--surface);padding:16px;border-radius:var(--radius);
  border:1px solid var(--border);text-decoration:none;color:var(--text);
  transition:all .15s;box-shadow:0 1px 2px rgba(0,0,0,.04);
}
.menu a:hover{border-color:var(--accent);box-shadow:0 2px 8px rgba(37,99,235,.1)}
.menu .ikon{width:22px;height:22px;flex-shrink:0;margin-top:1px;color:var(--accent)}
.menu b{display:block;font-size:13px;font-weight:600;margin-bottom:2px}
.menu small{display:block;font-size:11px;color:var(--text-sec);line-height:1.4}
.menu a.primary{background:var(--accent);border-color:transparent;color:#fff}
.menu a.primary b{color:#fff}
.menu a.primary small{color:rgba(255,255,255,.8)}

/* Results */
.result-list{display:flex;flex-direction:column;gap:6px;margin:14px 0}
.result-item{
  display:flex;align-items:center;justify-content:space-between;
  padding:11px 14px;background:var(--surface);border:1px solid var(--border);
  border-radius:6px;
}
.result-item:first-child{border-color:var(--accent);background:#eff6ff}
.result-item .rank{font-weight:700;color:var(--text-sec);font-size:12px;width:22px;text-align:center}
.result-item .name{font-weight:600;font-size:13px;flex:1;padding:0 10px}
.result-item .pct{font-weight:700;color:var(--accent);font-size:13px}
.result-item.top .name::after{content:' [utama]';font-size:11px;color:var(--success);font-weight:600}
.progress-row{display:flex;align-items:center;gap:8px;flex:1;margin:0 12px}
.progress-bar{flex:1;height:6px;background:var(--border);border-radius:99px;overflow:hidden}
.progress-bar .fill{height:100%;background:var(--accent);border-radius:99px}
.result-item.top .progress-bar .fill{background:var(--success)}

/* Confusion matrix */
.cm-cell{padding:7px 10px;border-radius:4px;font-weight:600;font-size:12px}
.cm-diag{background:#dcfce7;color:#166534}
.cm-salah{background:#fee2e2;color:#991b1b}
.cm-kosong{background:#f8fafc;color:var(--text-sec)}

/* Hero (home page only) */
.hero{
  background:linear-gradient(135deg,#0f1c3f 0%,#1e3a8a 100%);
  color:#fff;border-radius:var(--radius);padding:24px 28px;margin-bottom:24px;
}
.hero h1{font-size:17px;font-weight:700;margin-bottom:6px}
.hero p{font-size:12px;opacity:.8;margin-bottom:12px}
.badge-on{display:inline-flex;align-items:center;gap:5px;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;background:#166534;color:#dcfce7}
.badge-off{display:inline-flex;align-items:center;gap:5px;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;background:#991b1b;color:#fee2e2}

/* Pagination */
.pagination-wrap{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-top:16px}
.pagination-info{font-size:12px;color:var(--text-sec)}
.pagination{display:flex;align-items:center;gap:4px;list-style:none;padding:0;margin:0}
.pagination li a,.pagination li span{
  display:inline-flex;align-items:center;justify-content:center;
  min-width:32px;height:32px;padding:0 10px;
  border:1px solid var(--border);border-radius:6px;
  font-size:13px;color:var(--text);text-decoration:none;
  background:var(--surface);transition:all .15s;
}
.pagination li a:hover{border-color:var(--accent);color:var(--accent);background:#eff6ff}
.pagination li.active span,.pagination li.active a{
  background:var(--accent);border-color:var(--accent);color:#fff;
}
.pagination li.disabled span{color:var(--border);cursor:default}
.pagination li.dots span{border:none;background:none;cursor:default;color:var(--text-sec);min-width:auto;height:auto;padding:0 4px}

/* Footer */
footer{
  margin-top:32px;padding:16px 0;border-top:1px solid var(--border);
  text-align:center;font-size:11px;color:var(--text-sec);
}

/* Row / col grid */
.row{display:flex;gap:12px;flex-wrap:wrap}
.col-md-6{flex:1;min-width:200px}
.col-md-4{flex:1;min-width:150px}
.mb-3{margin-bottom:12px}
.mb-4{margin-bottom:20px}
.mt-3{margin-top:12px}
.mt-4{margin-top:20px}
.text-center{text-align:center}
.text-danger{color:var(--danger)}
.text-decoration-none{text-decoration:none}
code{background:#f1f5f9;padding:1px 5px;border-radius:4px;font-size:12px;color:#1e40af}

/* Steps indicator */
.steps{
  display:flex;align-items:center;gap:0;overflow-x:auto;
  padding:8px 0;margin-bottom:24px;
}
.step{
  display:flex;flex-direction:column;align-items:center;gap:6px;
  min-width:80px;position:relative;z-index:1;
}
.step-circle{
  width:30px;height:30px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:12px;font-weight:700;
  border:2px solid var(--border);background:var(--surface);color:var(--text-sec);
  transition:all .2s;
}
.step.active .step-circle{background:var(--accent);border-color:var(--accent);color:#fff}
.step.done .step-circle{background:#16a34a;border-color:#16a34a;color:#fff}
.step-label{font-size:11px;font-weight:600;color:var(--text-sec);text-align:center;white-space:nowrap}
.step.active .step-label{color:var(--accent)}
.step.done .step-label{color:var(--success)}
.step-line{
  flex:1;height:2px;background:var(--border);margin:0 -4px;
  align-self:center;margin-bottom:18px;
}

@media(max-width:900px){
  .sidebar{transform:translateX(-100%);transition:transform .25s}
  .sidebar.open{transform:translateX(0)}
  .main{margin-left:0}
  .hamburger{display:block}
  .topbar-links{display:none}
}
@media(max-width:640px){
  .main{padding:16px 14px 48px}
  .stats{grid-template-columns:repeat(3,1fr)}
  .menu{grid-template-columns:1fr}
}
</style>
</head>
<body>

<!-- Topbar -->
<header class="topbar">
  <button class="hamburger" onclick="document.querySelector('.sidebar').classList.toggle('open')" aria-label="Menu">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
  </button>
  <a class="topbar-brand" href="{{ route('home') }}">
    Sispak Kulit<span>RSUD Hasanuddin</span>
  </a>
  <nav class="topbar-links">
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
    <a href="{{ route('konsultasi.index') }}" class="{{ request()->routeIs('konsultasi*') ? 'active' : '' }}">Konsultasi</a>
    <a href="{{ route('konsultasi.riwayat') }}" class="{{ request()->routeIs('konsultasi.riwayat') ? 'active' : '' }}">Riwayat</a>
    <a href="{{ route('admin.import.index') }}" class="{{ request()->routeIs('admin*') ? 'active' : '' }}">Admin</a>
  </nav>
</header>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
  <ul class="sidebar-nav">

    {{-- Public Section --}}
    <div class="sidebar-section">
      <div class="sidebar-label">Publik</div>
      <li>
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
          <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41m11.32-11.32l1.41-1.41"/></svg></span> Beranda
        </a>
      </li>
      <li>
        <a href="{{ route('konsultasi.index') }}" class="{{ request()->routeIs('konsultasi*') ? 'active' : '' }}">
          <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L9.5 20m0 0L7 12m2.5 8L12 4l2.5 14m0 0L17 12m-2.5-8L12 20"/></svg></span> Konsultasi
        </a>
      </li>
      <li>
        <a href="{{ route('konsultasi.riwayat') }}" class="{{ request()->routeIs('konsultasi.riwayat') ? 'active' : '' }}">
          <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10,9 9,9 8,9"/></svg></span> Riwayat
        </a>
      </li>
    </div>

    {{-- Data --}}
    <div class="sidebar-section">
      <div class="sidebar-label">Data</div>
      <li class="sidebar-group" data-group="data-group">
        <div class="sidebar-group-header" onclick="toggleGroup(this)">
          <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg></span>
          Kelola Data
          <span class="arrow">&#9654;</span>
        </div>
        <div class="sidebar-group-items">
          <li>
            <a href="{{ route('admin.import.index') }}" class="{{ request()->routeIs('admin.import*') ? 'active' : '' }}">
              <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg></span>
              Import CSV
            </a>
          </li>
          <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
              <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
              Tambah Kasus
            </a>
          </li>
          <li>
            <a href="{{ route('admin.delete.index') }}" class="{{ request()->routeIs('admin.delete*') ? 'active' : '' }}">
              <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg></span>
              Hapus Dataset
            </a>
          </li>
        </div>
      </li>
    </div>

    {{-- Model --}}
    <div class="sidebar-section">
      <div class="sidebar-label">Model</div>
      <li class="sidebar-group" data-group="model-group">
        <div class="sidebar-group-header" onclick="toggleGroup(this)">
          <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg></span>
          Latih Model
          <span class="arrow">&#9654;</span>
        </div>
        <div class="sidebar-group-items">
          <li>
            <a href="{{ route('admin.split.index') }}" class="{{ request()->routeIs('admin.split*') ? 'active' : '' }}">
              <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg></span>
              Pisah Data
            </a>
          </li>
          <li>
            <a href="{{ route('admin.train.index') }}" class="{{ request()->routeIs('admin.train*') ? 'active' : '' }}">
              <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></span>
              Latih Sekarang
            </a>
          </li>
          <li>
            <a href="{{ route('admin.evaluation.index') }}" class="{{ request()->routeIs('admin.evaluation*') ? 'active' : '' }}">
              <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/><path d="M9 15l2 2 4-4"/></svg></span>
              Evaluasi
            </a>
          </li>
        </div>
      </li>
      <li>
        <a href="{{ route('admin.model.index') }}" class="{{ request()->routeIs('admin.model*') ? 'active' : '' }}">
          <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg></span>
          Parameter Model
        </a>
      </li>
    </div>

    {{-- Master --}}
    <div class="sidebar-section">
      <div class="sidebar-label">Master</div>
      <li>
        <a href="{{ route('admin.penyakit.index') }}" class="{{ request()->routeIs('admin.penyakit*') ? 'active' : '' }}">
          <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></span>
          Master Penyakit
        </a>
      </li>
    </div>

    <div class="sidebar-footer">
      Prototype Skripsi<br>
      Algalin Zakawali<br>
      Informatika, Univ. Bengkulu
    </div>
  </ul>
</aside>

<!-- Main Content -->
<div class="main">
@yield('content')
<footer>
  Sistem Pakar Diagnosis Penyakit Kulit &mdash; Na&iuml;ve Bayes &mdash; RSUD Hasanuddin, Bengkulu Selatan
</footer>
</div>

<script>
function toggleGroup(header) {
  header.closest('.sidebar-group').classList.toggle('open');
}

// Auto-open groups whose child link is active on page load
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.sidebar-group').forEach(function(group) {
    if (group.querySelector('a.active')) group.classList.add('open');
  });
});

// Close sidebar on outside click (mobile)
document.addEventListener('click', function(e){
  const sb = document.getElementById('sidebar');
  const hb = document.querySelector('.hamburger');
  if(window.innerWidth <= 900 && sb.classList.contains('open')
      && !sb.contains(e.target) && !hb.contains(e.target)){
    sb.classList.remove('open');
  }
});
</script>
@stack('scripts')
</body>
</html>

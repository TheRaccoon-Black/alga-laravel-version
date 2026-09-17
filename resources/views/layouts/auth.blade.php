<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Sispak Kulit')</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
  --accent: #2563eb;
  --accent-dark: #1d4ed8;
  --surface: #ffffff;
  --bg: #f0f4f8;
  --text: #1e293b;
  --text-sec: #64748b;
  --border: #e2e8f0;
  --radius: 12px;
}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',system-ui,sans-serif;background:var(--bg);color:var(--text);min-height:100vh}
a{text-decoration:none;color:inherit}
.form-group{margin-bottom:16px}
.form-label{display:block;font-size:13px;font-weight:600;color:var(--text);margin-bottom:6px}
.form-control{width:100%;padding:10px 14px;border:1.5px solid var(--border);border-radius:var(--radius);font-size:14px;font-family:inherit;transition:border-color .15s}
.form-control:focus{outline:none;border-color:var(--accent);box-shadow:0 0 0 3px rgba(37,99,235,.1)}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:6px;padding:10px 20px;border-radius:var(--radius);font-size:14px;font-weight:600;cursor:pointer;border:none;transition:all .15s;font-family:inherit}
.btn-primary{background:var(--accent);color:#fff}
.btn-primary:hover{background:var(--accent-dark)}
.btn-outline{background:transparent;border:1.5px solid var(--border);color:var(--text)}
.btn-outline:hover{border-color:var(--accent);color:var(--accent)}
.btn-danger{background:#dc2626;color:#fff}
.btn-danger:hover{background:#b91c1c}
.btn-sm{padding:6px 12px;font-size:12px}
.err{font-size:12px;color:#dc2626;margin-top:4px}
.alert{padding:12px 16px;border-radius:var(--radius);margin-bottom:16px;font-size:13px}
.alert-success{background:#dcfce7;color:#166534;border:1px solid #bbf7d0}
.alert-error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca}
.alert-info{background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe}
</style>
@stack('styles')
</head>
<body>
<div style="min-height:100vh;display:flex">
  {{-- Left: Landing / Branding --}}
  <div style="flex:1;background:linear-gradient(135deg,#0f1c3f 0%,#1e3a5f 50%,#2563eb 100%);display:flex;flex-direction:column;justify-content:center;padding:60px;color:#fff;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;opacity:.12" aria-hidden="true">
      <svg viewBox="0 0 800 800" preserveAspectRatio="none" style="width:100%;height:100%">
        <defs>
          <pattern id="dots" width="32" height="32" patternUnits="userSpaceOnUse">
            <circle cx="16" cy="16" r="1.5" fill="#fff"/>
          </pattern>
        </defs>
        <rect fill="url(#dots)" width="800" height="800"/>
      </svg>
    </div>
    <div style="position:relative;z-index:1;max-width:440px">
      <div style="margin-bottom:40px">
        <div>
          <div style="font-size:18px;font-weight:700">Sispak Kulit</div>
          <div style="font-size:12px;opacity:.7">RSUD Hasanuddin Bengkulu Selatan</div>
        </div>
      </div>
      <h1 style="font-size:32px;font-weight:800;line-height:1.3;margin-bottom:16px">
        Sistem Pakar Diagnosis<br>Penyakit Kulit
      </h1>
      <p style="font-size:14px;line-height:1.8;opacity:.8;margin-bottom:32px">
        Diagnostic tool menggunakan metode Naïve Bayes untuk membantu identifikasi penyakit kulit berdasarkan gejala yang dirasakan.
      </p>
      <div style="display:flex;gap:24px;flex-wrap:wrap">
        <div>
          <div style="font-size:24px;font-weight:800">{{ \App\Models\Penyakit::count() ?? 12 }}</div>
          <div style="font-size:12px;opacity:.7">Penyakit Terdaftar</div>
        </div>
        <div>
          <div style="font-size:24px;font-weight:800">{{ \App\Models\Gejala::count() ?? 20 }}</div>
          <div style="font-size:12px;opacity:.7">Gejala Tercatat</div>
        </div>
        <div>
          <div style="font-size:24px;font-weight:800">NB</div>
          <div style="font-size:12px;opacity:.7">Metode</div>
        </div>
      </div>
    </div>
  </div>

  {{-- Right: Form Area --}}
  <div style="flex:1;display:flex;align-items:center;justify-content:center;padding:40px">
    <div style="width:100%;max-width:400px">
      <div style="margin-bottom:32px">
        <div style="font-size:20px;font-weight:700;color:var(--text);margin-bottom:4px">@yield('form-title', 'Masuk')</div>
        <div style="font-size:13px;color:var(--text-sec)">@yield('form-subtitle', 'Masuk ke akun Anda untuk melanjutkan')</div>
      </div>
      @yield('form-content')
    </div>
  </div>
</div>
</body>
</html>

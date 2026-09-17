@extends('layouts.app')
@section('title', 'Import CSV — Sispak Kulit')
@section('content')
<div class="page-header">
  <div class="page-title">Import Data CSV</div>
  <div class="page-sub">Masukkan data kasus penyakit kulit dari file CSV atau TXT.</div>
</div>

<!-- Steps -->
<div class="steps">
  <div class="step active"><div class="step-circle">1</div><div class="step-label">Import CSV</div></div>
  <div class="step-line"></div>
  <div class="step"><div class="step-circle">2</div><div class="step-label">Pisah Data</div></div>
  <div class="step-line"></div>
  <div class="step"><div class="step-circle">3</div><div class="step-label">Latih Model</div></div>
  <div class="step-line"></div>
  <div class="step"><div class="step-circle">4</div><div class="step-label">Evaluasi</div></div>
</div>

@if(session('error'))<div class="alert alert-error">{{ session('error') }}</div>@endif
@if(session('success'))<div class="alert alert-success">{!! session('success') !!}</div>@endif

<div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start">

  <!-- Upload Card -->
  <div class="card">
    <h2>Unggah File</h2>
    <p class="sub">Seret file ke area berikut atau klik untuk memilih.</p>

    <form method="post" enctype="multipart/form-data" id="uploadForm">
      @csrf

      <div id="dropZone"
        style="border:2px dashed var(--border);border-radius:var(--radius);padding:32px 20px;text-align:center;cursor:pointer;transition:all .2s;position:relative;margin-bottom:18px"
        ondragover="event.preventDefault();this.style.borderColor='var(--accent)';this.style.background='#eff6ff'"
        ondragleave="this.style.borderColor='var(--border)';this.style.background=''"
        ondrop="event.preventDefault();this.style.borderColor='var(--border)';this.style.background='';handleDrop(event)"
        onclick="document.getElementById('csvFile').click()">
        <input type="file" name="csv_file" id="csvFile" accept=".csv,.txt" required
               style="position:absolute;inset:0;opacity:0;cursor:pointer"
               onchange="handleFileSelect(this)">
        <div style="margin-bottom:6px"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg></div>
        <div style="font-size:14px;font-weight:600;color:var(--text)" id="dropLabel">Klik atau seret file CSV/TXT</div>
        <div style="font-size:11px;color:var(--text-sec);margin-top:3px" id="dropHint">Delimiter ; atau , &middot; 25 kolom</div>
        <div id="fileInfo" style="margin-top:10px;display:none">
          <span style="display:inline-flex;align-items:center;gap:6px;background:#f0fdf4;color:#166534;padding:4px 10px;border-radius:20px;font-size:12px;font-weight:600">
            <span id="fileName"></span>
            <span id="fileSize" style="font-weight:400;color:#16a34a"></span>
          </span>
        </div>
      </div>

      <div style="background:#f8fafc;border:1px solid var(--border);border-radius:6px;padding:12px 14px;margin-bottom:18px">
        <label class="form-check" style="margin:0">
          <input type="checkbox" name="kosongkan" id="kosongkan" checked>
          <span class="form-check-label">
            <b>Kosongkan dataset lama</b> &mdash; hapus semua data kasus sebelum import (disarankan)
          </span>
        </label>
      </div>

      <div style="display:flex;gap:10px">
        <button type="submit" class="btn btn-primary" style="flex:1">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
          Unggah &amp; Import
        </button>
        <a href="{{ route('home') }}" class="btn btn-outline">Kembali</a>
      </div>
    </form>
  </div>

  <!-- Sidebar Info -->
  <div style="display:flex;flex-direction:column;gap:14px">

    <div class="card" style="padding:18px;margin:0">
      <div style="font-size:12px;font-weight:700;margin-bottom:10px;color:var(--text)">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        Spesifikasi CSV
      </div>
      <table style="font-size:11px;margin-bottom:10px">
        <thead><tr><th> Kolom </th><th> Isi </th></tr></thead>
        <tbody>
          <tr><td style="color:var(--text-sec)">1&ndash;4</td><td>Identitas</td></tr>
          <tr><td style="color:var(--text-sec)">5&ndash;24</td><td>Gejala (0 / 1)</td></tr>
          <tr><td style="color:var(--text-sec)">25</td><td>Nama penyakit</td></tr>
        </tbody>
      </table>
      <div style="font-size:10px;color:var(--text-sec);line-height:1.8">
        Delimiter otomatis: <code>;</code> atau <code>,</code><br>
        Header baris pertama dilewati<br>
        Kode pasien harus unik
      </div>
    </div>

    <div class="card" style="padding:18px;margin:0">
      <div style="font-size:12px;font-weight:700;margin-bottom:10px;color:var(--text)">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
        Contoh Format
      </div>
      <pre style="background:#0f172a;color:#e2e8f0;border-radius:6px;padding:10px;font-size:10px;overflow-x:auto;line-height:1.6;margin:0">K001,2024-01-15,0,0,1,0,1,0,0,1,0,0,0,1,0,0,0,0,1,0,0,0,1,0,Scabies
K002,2024-01-16,0,0,0,1,0,1,0,0,1,0,0,0,0,1,0,0,0,0,0,0,0,1,Fungal
K003,2024-01-17,1,0,0,0,1,0,0,0,0,1,0,0,1,0,0,0,0,1,0,0,0,0,Eksem</pre>
      <p style="font-size:10px;color:var(--text-sec);margin:6px 0 0">Data contoh &mdash; sesuaikan dengan master.</p>
    </div>

    <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:var(--radius);padding:12px 14px;font-size:11px;color:#1e40af;line-height:1.8">
      <b>
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:3px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
        Tips:
      </b>
      <ul style="margin:4px 0 0;padding-left:14px">
        <li>Pastikan nama penyakit ada di Master</li>
        <li>Gunakan hanya <code>0</code> dan <code>1</code></li>
        <li>Baris kosong otomatis dilewati</li>
      </ul>
    </div>

  </div>
</div>

@endsection

@push('scripts')
<script>
function handleFileSelect(input){
  const file=input.files[0];if(!file)return;
  document.getElementById('fileName').textContent=file.name;
  document.getElementById('fileSize').textContent='('+formatSize(file.size)+')';
  document.getElementById('fileInfo').style.display='block';
  document.getElementById('dropLabel').textContent=file.name;
  document.getElementById('dropHint').textContent='';
}
function handleDrop(e){
  const file=e.dataTransfer.files[0];if(!file)return;
  const input=document.getElementById('csvFile');
  const dt=new DataTransfer();dt.items.add(file);input.files=dt.files;
  handleFileSelect(input);
}
function formatSize(b){return b<1024?b+' B':b<1048576?(b/1024).toFixed(1)+' KB':(b/1048576).toFixed(1)+' MB'}
</script>
@endpush

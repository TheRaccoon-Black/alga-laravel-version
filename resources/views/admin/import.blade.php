@extends('layouts.app')
@section('title', 'Import CSV — Sispak Kulit')
@section('content')
<h2 class="section-title">Panel Admin — Import Data</h2>

@if(session('error'))<div class="alert alert-error">{{ session('error') }}</div>@endif
@if(session('success'))<div class="alert alert-success">{!! session('success') !!}</div>@endif

<!-- Step Indicator -->
<div class="card mb-4" style="padding:20px 28px">
  <div style="display:flex;align-items:center;gap:0;overflow-x:auto">
    @foreach([
      ['num'=>1,'label'=>'Import CSV','route'=>route('admin.import.index'),'active'=>true],
      ['num'=>2,'label'=>'Pisah Data','route'=>route('admin.split.index'),'active'=>false],
      ['num'=>3,'label'=>'Latih Model','route'=>route('admin.train.index'),'active'=>false],
      ['num'=>4,'label'=>'Evaluasi','route'=>route('admin.evaluation.index'),'active'=>false],
    ] as $i => $step)
      @if($i > 0)
        <div style="flex-shrink:0;width:32px;height:2px;background:var(--border);margin:0 4px;display:flex;align-items:center">
          <div style="width:8px;height:8px;border-radius:50%;background:var(--border);margin:0 auto"></div>
        </div>
      @endif
      <a href="{{ $step['route'] }}" style="display:flex;flex-direction:column;align-items:center;gap:6px;text-decoration:none;min-width:90px;position:relative">
        <div style="
          width:36px;height:36px;border-radius:50%;
          display:flex;align-items:center;justify-content:center;
          font-size:14px;font-weight:700;
          {{ $step['active'] ? 'background:var(--primary);color:#fff' : 'background:var(--bg);color:var(--muted);border:2px solid var(--border)' }}
        ">
          {{ $step['num'] }}
        </div>
        <span style="font-size:12px;font-weight:600;color:{{ $step['active'] ? 'var(--primary)' : 'var(--muted)' }};text-align:center;white-space:nowrap">{{ $step['label'] }}</span>
      </a>
    @endforeach
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start">

  <!-- Upload Card -->
  <div class="card" style="margin-bottom:0">
    <h2 style="margin-bottom:2px">Unggah File CSV</h2>
    <p class="sub" style="margin-bottom:20px">Import data kasus penyakit kulit dari file CSV/TXT.</p>

    <form method="post" enctype="multipart/form-data" id="uploadForm">
      @csrf

      <!-- Drop Zone -->
      <div id="dropZone" style="
        border:2px dashed var(--border);border-radius:var(--radius);
        padding:36px 24px;text-align:center;cursor:pointer;
        transition:border-color .2s,background .2s;
        margin-bottom:20px;position:relative;
      " ondragover="event.preventDefault();this.style.borderColor='var(--primary-light)';this.style.background='#eff6ff'"
         ondragleave="this.style.borderColor='var(--border)';this.style.background=''"
         ondrop="event.preventDefault();this.style.borderColor='var(--border)';this.style.background='';handleDrop(event)"
         onclick="document.getElementById('csvFile').click()">
        <input type="file" name="csv_file" id="csvFile" accept=".csv,.txt" required
               style="position:absolute;inset:0;opacity:0;cursor:pointer"
               onchange="handleFileSelect(this)">
        <div style="font-size:32px;margin-bottom:8px">📁</div>
        <div style="font-size:15px;font-weight:600;color:var(--text)" id="dropLabel">
          Klik atau seret file ke sini
        </div>
        <div style="font-size:12px;color:var(--muted);margin-top:4px" id="dropHint">
          Format: CSV / TXT, delimiter ; atau ,
        </div>
        <div id="fileInfo" style="margin-top:12px;display:none">
          <span style="
            display:inline-flex;align-items:center;gap:6px;
            background:#dcfce7;color:#166534;
            padding:5px 12px;border-radius:20px;font-size:13px;font-weight:600;
          ">
            <span id="fileName"></span>
            <span id="fileSize" style="font-weight:400;color:#16a34a"></span>
          </span>
        </div>
      </div>

      <!-- Options -->
      <div style="
        background:var(--bg);border:1px solid var(--border);
        border-radius:10px;padding:14px 16px;margin-bottom:20px;
      ">
        <label style="display:flex;align-items:flex-start;gap:10px;cursor:pointer;font-size:14px">
          <input type="checkbox" name="kosongkan" id="kosongkan" class="form-check-input" checked
                 style="width:16px;height:16px;margin-top:2px;accent-color:var(--primary);flex-shrink:0">
          <div>
            <div style="font-weight:600;color:var(--text)">Kosongkan dataset lama terlebih dahulu</div>
            <div style="font-size:12px;color:var(--muted);margin-top:2px">
              Centang untuk menghapus semua data kasus yang ada sebelum import. <b>Disarankan</b> saat import ulang dari sumber baru.
            </div>
          </div>
        </label>
      </div>

      <div style="display:flex;gap:10px">
        <button type="submit" class="btn btn-primary" id="submitBtn" style="flex:1">
          Unggah &amp; Import
        </button>
        <a href="{{ route('home') }}" class="btn btn-outline">Kembali</a>
      </div>
    </form>
  </div>

  <!-- Sidebar: CSV Spec -->
  <div style="display:flex;flex-direction:column;gap:16px">

    <!-- Format Spec -->
    <div class="card" style="margin-bottom:0;padding:20px">
      <h3 style="font-size:14px;font-weight:700;margin-bottom:12px;color:var(--text)">
        📋 Spesifikasi CSV
      </h3>
      <table style="font-size:12px;margin-bottom:12px">
        <thead><tr><th> Kolom </th><th> Isi </th></tr></thead>
        <tbody>
          <tr><td style="color:var(--muted)">1–4</td><td>Identitas (kode, tanggal, dll)</td></tr>
          <tr><td style="color:var(--muted)">5–24</td><td>Gejala (<code>0</code> / <code>1</code>)</td></tr>
          <tr><td style="color:var(--muted)">25</td><td>Nama penyakit</td></tr>
        </tbody>
      </table>
      <div style="font-size:11px;color:var(--muted);line-height:1.7">
        • Delimiter otomatis: <code>;</code> atau <code>,</code><br>
        • Header baris pertama dilewati otomatis<br>
        • Kode pasien harus unik per kasus
      </div>
    </div>

    <!-- Sample Preview -->
    <div class="card" style="margin-bottom:0;padding:20px">
      <h3 style="font-size:14px;font-weight:700;margin-bottom:12px;color:var(--text)">
        🔍 Contoh Format
      </h3>
      <pre style="
        background:#0f172a;color:#e2e8f0;
        border-radius:8px;padding:12px;font-size:11px;
        overflow-x:auto;line-height:1.6;margin:0;
      ">K001,2024-01-15,0,0,1,0,1,0,0,1,0,0,0,1,0,0,0,0,1,0,0,0,1,0,Scabies
K002,2024-01-16,0,0,0,1,0,1,0,0,1,0,0,0,0,1,0,0,0,0,0,0,0,1,Fungal
K003,2024-01-17,1,0,0,0,1,0,0,0,0,1,0,0,1,0,0,0,0,1,0,0,0,0,Eksem</pre>
      <p style="font-size:11px;color:var(--muted);margin:8px 0 0">
        *Data contoh saja — sesuaikan dengan master gejala Anda.
      </p>
    </div>

    <!-- Tips -->
    <div style="
      background:#eff6ff;border:1px solid #bfdbfe;
      border-radius:var(--radius);padding:14px 16px;font-size:12px;
      color:#1e40af;line-height:1.7;
    ">
      <b>💡 Tips:</b>
      <ul style="margin:6px 0 0;padding-left:16px">
        <li>Pastikan semua nama penyakit sudah ada di <b>Master Penyakit</b></li>
        <li>Gunakan <code>0</code> dan <code>1</code> saja untuk gejala</li>
        <li>Baris kosong akan otomatis dilewati</li>
      </ul>
    </div>

  </div>
</div>

@endsection

@push('scripts')
<script>
function handleFileSelect(input) {
  const file = input.files[0];
  if (!file) return;
  document.getElementById('fileName').textContent = file.name;
  document.getElementById('fileSize').textContent = '(' + formatSize(file.size) + ')';
  document.getElementById('fileInfo').style.display = 'block';
  document.getElementById('dropLabel').textContent = file.name;
  document.getElementById('dropHint').textContent = '';
}
function handleDrop(e) {
  const file = e.dataTransfer.files[0];
  if (!file) return;
  const input = document.getElementById('csvFile');
  const dt = new DataTransfer();
  dt.items.add(file);
  input.files = dt.files;
  handleFileSelect(input);
}
function formatSize(bytes) {
  if (bytes < 1024) return bytes + ' B';
  if (bytes < 1048576) return (bytes/1024).toFixed(1) + ' KB';
  return (bytes/1048576).toFixed(1) + ' MB';
}
</script>
@endpush

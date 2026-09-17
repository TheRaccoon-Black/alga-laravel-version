@extends('layouts.app')
@section('title', 'Hasil Konsultasi — Sispak Kulit')
@section('content')
@php $top = array_key_first($post); @endphp

<div class="page-header">
  <div class="page-title">Hasil Diagnosa</div>
  <div class="page-sub">Prediksi penyakit berdasarkan gejala yang dipilih.</div>
</div>

{{-- Hero — Diagnosa Utama --}}
<div class="hero" style="text-align:center;margin-bottom:24px">
  <div style="font-size:12px;opacity:.8;margin-bottom:6px">Diagnosa Utama</div>
  <div style="font-size:24px;font-weight:800;margin-bottom:6px">{{ $nama[$top] ?? $top }}</div>
  <div style="display:inline-flex;align-items:center;gap:10px;background:rgba(255,255,255,.15);padding:6px 18px;border-radius:20px">
    <span style="font-size:20px;font-weight:700">{{ round($post[$top]*100, 2) }}%</span>
    <span style="font-size:12px;opacity:.8">probabilitas</span>
  </div>
</div>

{{-- Stats --}}
<div class="stats mb-4">
  <div class="stat-card">
    <div class="angka">{{ count($dipilih) }}</div>
    <div class="label">Gejala Dipilih</div>
  </div>
  <div class="stat-card">
    <div class="angka">{{ count($post) }}</div>
    <div class="label">Total Penyakit</div>
  </div>
</div>

{{-- Detail Penyakit Utama --}}
@if(isset($detail[$top]))
<div class="card mb-4" style="border-color:var(--accent)">
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
    <div>
      <h2 style="margin-bottom:2px">{{ $nama[$top] ?? $top }}</h2>
      <div style="font-size:12px;color:var(--text-sec)">Detail penyakit &mdash; probabilitas {{ round($post[$top]*100, 2) }}%</div>
    </div>
    <span style="background:var(--accent);color:#fff;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700">HASIL UTAMA</span>
  </div>

  <div style="display:flex;justify-content:center;margin-bottom:16px">
    @if($detail[$top]['gambar'])
      <img src="{{ Storage::url($detail[$top]['gambar']) }}" alt="{{ $nama[$top] ?? $top }}"
           style="max-width:260px;width:100%;border-radius:10px;box-shadow:0 4px 20px rgba(0,0,0,.15)">
    @endif
  </div>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
    {{-- Penyebab --}}
    <div style="background:#f8fafc;border:1px solid var(--border);border-radius:6px;padding:14px">
      <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--accent);margin-bottom:6px">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
        Penyebab
      </div>
      <p style="font-size:13px;line-height:1.7;color:var(--text)">{{ $detail[$top]['penyebab'] }}</p>
    </div>

    {{-- Ciri-Ciri --}}
    <div style="background:#f8fafc;border:1px solid var(--border);border-radius:6px;padding:14px">
      <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--accent);margin-bottom:6px">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        Ciri-Ciri
      </div>
      <p style="font-size:13px;line-height:1.7;color:var(--text)">{{ $detail[$top]['ciri_ciri'] }}</p>
    </div>
  </div>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:14px">
    {{-- Treatment --}}
    <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:6px;padding:14px">
      <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#166534;margin-bottom:6px">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px"><polyline points="20 6 9 17 4 12"/></svg>
        Pengobatan
      </div>
      <p style="font-size:13px;line-height:1.7;color:#14532d">{{ $detail[$top]['treatment'] }}</p>
    </div>

    {{-- Obat --}}
    <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:6px;padding:14px">
      <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#1e40af;margin-bottom:6px">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0016.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 002 8.5c0 2.3 1.5 4.05 3 5.5l7 7z"/></svg>
        Obat
      </div>
      <p style="font-size:13px;line-height:1.7;color:#1e3a8a">{{ $detail[$top]['obat'] }}</p>
    </div>
  </div>

  <div style="margin-top:14px;padding-top:14px;border-top:1px solid var(--border)">
    <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--text-sec);margin-bottom:8px">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.05 9 11.05"/></svg>
      Kecocokan Gejala
    </div>
    <div class="checkbox-grid" style="margin:0">
      @foreach($dipilih as $gId)
        @php
          $gejalaNama = DB::table('gejalas')->where('id_gejala', $gId)->value('nama_gejala') ?? $gId;
          // ambil likelihood dari model stored data
          $likelihood = DB::table('model_likelihood')->where('id_penyakit', $top)->where('id_gejala', $gId)->value('p_ada') ?? 0;
          $matchPct = round($likelihood * 100);
        @endphp
        <label style="background:{{ $likelihood > 0.5 ? '#dcfce7' : '#f8fafc' }};border-color:{{ $likelihood > 0.5 ? '#bbf7d0' : 'var(--border)' }}">
          <input type="checkbox" checked disabled>
          <span>{{ $gejalaNama }}</span>
          @if($likelihood > 0)
            <span style="margin-left:auto;font-size:11px;font-weight:700;color:{{ $likelihood > 0.5 ? '#166534' : 'var(--accent)' }}">{{ $matchPct }}%</span>
          @endif
        </label>
      @endforeach
    </div>
  </div>
</div>
@else
<div class="alert alert-warn mb-4">Detail informasi penyakit untuk <b>{{ $nama[$top] ?? $top }}</b> belum tersedia. Silakan konsultasikan dengan dokter.</div>
@endif

{{-- Semua Hasil Prediksi --}}
<div class="card mb-4">
  <h2>SEMUA HASIL PREDIKSI</h2>
  <p class="sub">Urutan berdasarkan probabilitas tertinggi.</p>
  <div class="result-list">
    @foreach($post as $idP => $p)
    <div class="result-item{{ $idP === $top ? ' top' : '' }}">
      <span class="rank">{{ $loop->iteration }}</span>
      <div style="flex:1;display:flex;flex-direction:column;gap:3px;padding:0 10px">
        <span class="name">{{ $nama[$idP] ?? $idP }}</span>
        <div class="progress-bar"><div class="fill" style="width:{{ max(round($p*100), 1) }}%"></div></div>
      </div>
      <span class="pct">{{ round($p*100, 2) }}%</span>
    </div>
    @endforeach
  </div>
</div>

{{-- Detail Penyakit Lainnya (ringkas) --}}
@if(count($detail) > 1)
<div class="card mb-4">
  <h2>DETAIL PENYAKIT LAINNYA</h2>
  <p class="sub">Klik setiap penyakit untuk melihat penjelasan lengkap.</p>
  <div style="display:grid;gap:10px">
    @foreach($post as $idP => $p)
      @if($idP !== $top && isset($detail[$idP]))
      <details style="background:#f8fafc;border:1px solid var(--border);border-radius:6px;overflow:hidden">
        <summary style="
          padding:12px 16px;cursor:pointer;font-size:13px;font-weight:600;
          display:flex;align-items:center;justify-content:space-between;
          list-style:none;user-select:none;
        ">
          <span>{{ $nama[$idP] ?? $idP }}</span>
          <span style="font-size:12px;color:var(--accent);font-weight:700">{{ round($p*100, 2) }}%</span>
        </summary>
        <div style="padding:0 16px 14px;font-size:12px;line-height:1.8;color:var(--text-sec);border-top:1px solid var(--border)">
          <div style="margin-top:10px"><b style="color:var(--text)">Penyebab:</b> {{ $detail[$idP]['penyebab'] }}</div>
          <div><b style="color:var(--text)">Ciri-ciri:</b> {{ $detail[$idP]['ciri_ciri'] }}</div>
          <div><b style="color:var(--text)">Pengobatan:</b> {{ $detail[$idP]['treatment'] }}</div>
          <div><b style="color:var(--text)">Obat:</b> {{ $detail[$idP]['obat'] }}</div>
        </div>
      </details>
      @endif
    @endforeach
  </div>
</div>
@endif


{{-- Penjelasan Hasil --}}
@if(count($explanation) > 0)
<div class="card mb-4" style="border-color:#bbf7d0;background:#f0fdf4">
  <div style="display:flex;align-items:center;gap:8px;margin-bottom:16px">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#166534" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
    <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#166534">
      Gejala Penentu Diagnosis
    </div>
  </div>
  <p style="font-size:12px;color:var(--text-sec);margin-bottom:14px">
    Berikut gejala yang paling banyak mempengaruhi prediksi <b>{{ $nama[$top] ?? $top }}</b>:
  </p>
  <div style="display:flex;flex-direction:column;gap:8px">
    @foreach(array_slice($explanation, 0, 5) as $i => $e)
    <div style="display:flex;align-items:center;gap:12px;padding:10px 14px;background:#fff;border:1px solid #bbf7d0;border-radius:6px">
      <span style="width:22px;height:22px;border-radius:50%;background:{{ $e['kontribusi'] >= 0 ? '#16a34a' : '#d97706' }};color:#fff;font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0">{{ $i + 1 }}</span>
      <span style="flex:1;font-size:13px;font-weight:500;color:var(--text)">{{ $e['nama_gejala'] }}</span>
      <span style="font-size:12px;font-weight:700;padding:3px 10px;border-radius:20px;
        @if($e['kontribusi'] >= 0) background:#dcfce7;color:#166534;
        @else background:#fef3c7;color:#92400e;@endif">
        @if($e['p_ada'] !== null)
          P({{ $e['id_gejala'] }}|{{ $nama[$top] }}) = {{ round($e['p_ada'] * 100, 1) }}%
          @if($e['kontribusi'] >= 0)
            &nbsp;· &uarr;{{ round($e['kontribusi'], 1) }}%
          @else
            &nbsp;· &darr;{{ round(abs($e['kontribusi']), 1) }}%
          @endif
        @else
          tidak ada data
        @endif
      </span>
    </div>
    @endforeach
  </div>
  @if(count($explanation) > 5)
  <div style="margin-top:10px;font-size:12px;color:var(--text-sec)">
    + {{ count($explanation) - 5 }} gejala lainnya juga berkontribusi
  </div>
  @endif
</div>
@endif

<div class="alert alert-info" style="margin-top:8px">
  <b>Catatan:</b> Hasil ini hanya bersifat praduga berdasarkan metode Na&iuml;ve Bayes.
  Konsultasikan dengan dokter untuk diagnosis yang pasti.
</div>

<div style="display:flex;gap:10px;margin-top:16px">
  <a href="{{ route('konsultasi.index', ['baru'=>1]) }}" class="btn btn-outline">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Konsultasi Baru
  </a>
  <a href="{{ route('home') }}" class="btn btn-outline">Ke Beranda</a>
</div>
@endsection

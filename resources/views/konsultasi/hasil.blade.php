@extends('layouts.app')
@section('title', 'Hasil Konsultasi — Sispak Kulit')
@section('content')
@php $top = array_key_first($post); @endphp

<div class="hero" style="text-align:center;margin-bottom:28px">
  <div style="font-size:13px;opacity:.8;margin-bottom:8px">Diagnosa Utama</div>
  <div style="font-size:26px;font-weight:800;margin-bottom:6px">{{ $nama[$top] ?? $top }}</div>
  <div style="display:inline-flex;align-items:center;gap:12px;background:rgba(255,255,255,.15);padding:8px 20px;border-radius:30px">
    <span style="font-size:22px;font-weight:700">{{ round($post[$top]*100, 2) }}%</span>
    <span style="font-size:13px;opacity:.8">probabilitas</span>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px">
  <div style="background:var(--surface);border-radius:var(--radius);padding:20px;border:1px solid var(--border);text-align:center">
    <div style="font-size:12px;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:6px">Gejala Dipilih</div>
    <div style="font-size:28px;font-weight:800;color:var(--primary)">{{ count($dipilih) }}</div>
  </div>
  <div style="background:var(--surface);border-radius:var(--radius);padding:20px;border:1px solid var(--border);text-align:center">
    <div style="font-size:12px;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:6px">Total Penyakit</div>
    <div style="font-size:28px;font-weight:800;color:var(--primary)">{{ count($post) }}</div>
  </div>
</div>

<div class="card">
  <h2 style="font-size:16px;font-weight:700;margin-bottom:16px">Semua Hasil Prediksi</h2>
  <div class="result-list">
    @php $no = 0; @endphp
    @foreach($post as $idP => $p)
    @php $no++; @endphp
    <div class="result-item{{ $no === 1 ? ' top' : '' }}" style="justify-content:flex-start;gap:0">
      <span class="rank" style="width:36px;text-align:center">{{ $loop->iteration }}</span>
      <div style="flex:1;display:flex;flex-direction:column;gap:4px;padding:0 12px">
        <span class="name">{{ $nama[$idP] ?? $idP }}</span>
        <div class="progress-bar"><div class="fill" style="width:{{ max(round($p*100), 1) }}%"></div></div>
      </div>
      <span class="pct" style="min-width:60px;text-align:right">{{ round($p*100, 2) }}%</span>
    </div>
    @endforeach
  </div>
</div>

<div style="display:flex;gap:10px;margin-top:20px">
  <a href="{{ route('konsultasi.index', ['baru'=>1]) }}" class="btn btn-outline">&#8592; Konsultasi Baru</a>
  <a href="{{ route('home') }}" class="btn btn-outline">Ke Beranda</a>
</div>
@endsection

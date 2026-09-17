@extends('layouts.app')
@section('title', 'Pisah Data — Sispak Kulit')
@section('content')
<div class="page-header">
  <div class="page-title">Pisah Data Latih &amp; Uji</div>
  <div class="page-sub">Membagi dataset menjadi 80% data latih dan 20% data uji secara stratified.</div>
</div>

<!-- Steps -->
<div class="steps">
  <div class="step done"><div class="step-circle"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><div class="step-label">Import</div></div>
  <div class="step-line"></div>
  <div class="step active"><div class="step-circle">2</div><div class="step-label">Pisah Data</div></div>
  <div class="step-line"></div>
  <div class="step"><div class="step-circle">3</div><div class="step-label">Latih Model</div></div>
  <div class="step-line"></div>
  <div class="step"><div class="step-circle">4</div><div class="step-label">Evaluasi</div></div>
</div>

@if($sukses)
  <div class="alert alert-success">Data berhasil dipisah!</div>
  <div class="stats mb-4">
    <div class="stat-card" style="background:#eff6ff;border-color:#bfdbfe">
      <div class="angka" style="color:#1e40af">{{ $latih }}</div>
      <div class="label">Data Latih (80%)</div>
    </div>
    <div class="stat-card" style="background:#fffbeb;border-color:#fde68a">
      <div class="angka" style="color:#92400e">{{ $uji }}</div>
      <div class="label">Data Uji (20%)</div>
    </div>
  </div>
  <div style="display:flex;gap:10px">
    <a href="{{ route('admin.train.index') }}" class="btn btn-primary">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
      Latih Model
    </a>
    <a href="{{ route('home') }}" class="btn btn-outline">Ke Beranda</a>
  </div>
@elseif($totalKasus > 0)
  <div class="card">
    <h2>Konfirmasi Pemisahan</h2>
    <p class="sub">Total <b>{{ $totalKasus }}</b> kasus akan dibagi secara acak per jenis penyakit.</p>
    <div class="alert alert-info">
      Pembagian: <b>80%</b> data latih &mdash; <b>20%</b> data uji (stratified random split).
    </div>
    <form method="post">
      @csrf
      <input type="hidden" name="konfirmasi" value="1">
      <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin ingin memisah data?')">Pisah Data Sekarang</button>
      <a href="{{ route('home') }}" class="btn btn-outline">Kembali</a>
    </form>
  </div>
@else
  <div class="alert alert-error">Belum ada data. Silakan <a href="{{ route('admin.import.index') }}"><b>Import Data CSV</b></a> terlebih dahulu.</div>
@endif
@endsection

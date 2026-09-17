@extends('layouts.app')
@section('title', 'Beranda — Sispak Kulit')
@section('content')
<div class="hero">
  <h1>Sistem Pakar Diagnosis Penyakit Kulit</h1>
  <p>Metode Na&iuml;ve Bayes &mdash; Studi Kasus RSUD Hasanuddin, Bengkulu Selatan</p>
  @if($siap)
    <span class="badge-on">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
      Model siap ({{ $stat['model'] }} parameter likelihood)
    </span>
  @else
    <span class="badge-off">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
      Model belum dilatih
    </span>
  @endif
</div>

<div class="stats">
  <div class="stat-card"><div class="angka">{{ $stat['penyakit'] }}</div><div class="label">Penyakit</div></div>
  <div class="stat-card"><div class="angka">{{ $stat['gejala'] }}</div><div class="label">Gejala</div></div>
  <div class="stat-card"><div class="angka">{{ $stat['kasus'] }}</div><div class="label">Total Kasus</div></div>
  <div class="stat-card"><div class="angka">{{ $stat['latih'] }}</div><div class="label">Data Latih</div></div>
  <div class="stat-card"><div class="angka">{{ $stat['uji'] }}</div><div class="label">Data Uji</div></div>
  <div class="stat-card"><div class="angka">{{ $stat['konsul'] }}</div><div class="label">Konsultasi</div></div>
</div>

<h2 class="section-label">Untuk Pengguna</h2>
<div class="menu">
  <a class="primary" href="{{ route('konsultasi.index') }}">
    <span class="ikon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L9.5 20m0 0L7 12m2.5 8L12 4l2.5 14m0 0L17 12m-2.5-8L12 20"/></svg></span>
    <span>
      <b>Mulai Konsultasi</b>
      <small>Pilih gejala yang dialami, dapatkan diagnosis awal secara otomatis</small>
    </span>
  </a>
</div>

<h2 class="section-label">Panel Admin</h2>
<div class="menu">
  <a href="{{ route('admin.import.index') }}">
    <span class="ikon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg></span>
    <span><b>Import Data CSV</b><small>Masukkan data kasus dari file Excel/CSV</small></span>
  </a>
  <a href="{{ route('admin.dashboard') }}">
    <span class="ikon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
    <span><b>Tambah Kasus Manual</b><small>Input satu data pasien secara langsung</small></span>
  </a>
  <a href="{{ route('admin.delete.index') }}">
    <span class="ikon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg></span>
    <span><b>Hapus Dataset</b><small>Kosongkan data kasus untuk import ulang</small></span>
  </a>
  <a href="{{ route('admin.split.index') }}">
    <span class="ikon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg></span>
    <span><b>Pisah Data</b><small>Bagi dataset 80% latih : 20% uji</small></span>
  </a>
  <a href="{{ route('admin.train.index') }}">
    <span class="ikon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg></span>
    <span><b>Latih Model</b><small>Hitung prior &amp; likelihood (Na&iuml;ve Bayes)</small></span>
  </a>
  <a href="{{ route('admin.evaluation.index') }}">
    <span class="ikon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/><path d="M9 15l2 2 4-4"/></svg></span>
    <span><b>Evaluasi Model</b><small>Akurasi, precision, recall, F1-score</small></span>
  </a>
</div>
@endsection

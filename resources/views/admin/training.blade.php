@extends('layouts.app')
@section('title', 'Latih Model — Sispak Kulit')
@section('content')
<div class="page-header">
  <div class="page-title">Latih Model Na&iuml;ve Bayes</div>
  <div class="page-sub">Menghitung prior P(K) dan likelihood P(G|K) dari data latih.</div>
</div>

<!-- Steps -->
<div class="steps">
  <div class="step done"><div class="step-circle"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><div class="step-label">Import</div></div>
  <div class="step-line"></div>
  <div class="step done"><div class="step-circle"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><div class="step-label">Pisah</div></div>
  <div class="step-line"></div>
  <div class="step active"><div class="step-circle">3</div><div class="step-label">Latih Model</div></div>
  <div class="step-line"></div>
  <div class="step"><div class="step-circle">4</div><div class="step-label">Evaluasi</div></div>
</div>

@if($sukses)
  <div class="alert alert-success">{{ $pesan }}</div>
  <div class="stats mb-4">
    <div class="stat-card"><div class="angka">{{ $statPrior }}</div><div class="label">Prior</div></div>
    <div class="stat-card"><div class="angka">{{ $statModel }}</div><div class="label">Likelihood</div></div>
    <div class="stat-card"><div class="angka">{{ $statKasus }}</div><div class="label">Data Latih</div></div>
  </div>
  <div style="display:flex;gap:10px">
    <a href="{{ route('admin.evaluation.index') }}" class="btn btn-primary">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/><path d="M9 15l2 2 4-4"/></svg>
      Evaluasi Model
    </a>
    <a href="{{ route('home') }}" class="btn btn-outline">Ke Beranda</a>
  </div>
@else
  @if($statKasus === 0)
    <div class="alert alert-error">
      Belum ada data latih. Silakan <a href="{{ route('admin.import.index') }}"><b>Import CSV</b></a> dan <a href="{{ route('admin.split.index') }}"><b>Pisah Data</b></a> terlebih dahulu.
    </div>
  @elseif($statModel > 0)
    <div class="alert alert-warn">Model sudah ada ({{ $statModel }} parameter). Pelatihan ulang akan <b>menghapus model lama</b>.</div>
  @endif

  <div class="card">
    <h2>Pelatihan Model</h2>
    <p class="sub">Langkah perhitungan Na&iuml;ve Bayes:</p>
    <div style="font-size:13px;line-height:2;margin-bottom:18px">
      <div><b>1.</b> Hitung Prior &mdash; P(K) = jumlah kasus penyakit K / total data latih</div>
      <div><b>2.</b> Hitung Likelihood &mdash; P(G|K) = (frekuensi + 1) / (jumlah kasus K + 2) <i>(Laplace smoothing)</i></div>
      <div><b>3.</b> Simpan &mdash; hasil disimpan ke tabel <code>model_prior</code> dan <code>model_likelihood</code></div>
    </div>
    <form method="post" onsubmit="return confirm('Yakin ingin melatih ulang model?')">
      @csrf
      <input type="hidden" name="konfirmasi" value="1">
      <button type="submit" class="btn btn-primary">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
        Latih Model Sekarang
      </button>
      <a href="{{ route('home') }}" class="btn btn-outline">Kembali</a>
    </form>
  </div>
@endif
@endsection

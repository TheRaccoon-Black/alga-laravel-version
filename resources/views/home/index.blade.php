@extends('layouts.app')
@section('title', 'Beranda — Sispak Kulit')
@section('content')
<div class="hero">
  <h1>Sistem Pakar Diagnosis Penyakit Kulit</h1>
  <p>Metode Naïve Bayes \u2014 Studi Kasus RSUD Hasanuddin, Bengkulu Selatan</p>
  @if($siap)
    <span class="badge-on">Model siap ({{ $stat['model'] }} parameter likelihood)</span>
  @else
    <span class="badge-off">Model belum dilatih \u2014 jalankan Latih Model dulu</span>
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

<h2 class="section-title">Untuk Pengguna</h2>
<div class="menu">
  <a class="utama" href="{{ route('konsultasi.index') }}">
    <span>
      <b>Mulai Konsultasi</b>
      <small>Pilih gejala yang dialami, dapatkan diagnosis awal secara otomatis</small>
    </span>
  </a>
</div>

<h2 class="section-title">Panel Admin</h2>
<div class="menu">
  <a href="{{ route('admin.import.index') }}"><span><b>Import Data CSV</b><small>Masukkan data kasus dari file Excel/CSV</small></span></a>
  <a href="{{ route('admin.dashboard') }}"><span><b>Tambah Kasus Manual</b><small>Input satu data pasien secara langsung</small></span></a>
  <a href="{{ route('admin.delete.index') }}"><span><b>Hapus Dataset</b><small>Kosongkan data kasus untuk import ulang</small></span></a>
  <a href="{{ route('admin.split.index') }}"><span><b>Pisah Data</b><small>Bagi dataset 80% latih : 20% uji</small></span></a>
  <a href="{{ route('admin.train.index') }}"><span><b>Latih Model</b><small>Hitung nilai prior &amp; likelihood (Naïve Bayes)</small></span></a>
  <a href="{{ route('admin.evaluation.index') }}"><span><b>Evaluasi Model</b><small>Akurasi, precision, recall, F1-score</small></span></a>
</div>
@endsection
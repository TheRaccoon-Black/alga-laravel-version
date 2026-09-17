@extends('layouts.app')
@section('title', 'Pisah Data — Sispak Kulit')
@section('content')
<h2 class="section-title">Panel Admin \u2014 Pisah Data</h2>

@if($sukses)
  <div class="alert alert-success">Data berhasil dipisah!</div>
  <div class="row mb-4">
    <div class="col-md-6">
      <div class="card text-center" style="background:#eff6ff">
        <div class="card-body py-4">
          <div style="font-size:32px;font-weight:800;color:var(--primary)">{{ $latih }}</div>
          <div style="font-size:14px;font-weight:600">Data Latih</div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card text-center" style="background:#fef3c7">
        <div class="card-body py-4">
          <div style="font-size:32px;font-weight:800;color:#92400e">{{ $uji }}</div>
          <div style="font-size:14px;font-weight:600">Data Uji</div>
        </div>
      </div>
    </div>
  </div>
  <div>
    <a href="{{ route('admin.train.index') }}" class="btn btn-primary">Latih Model</a>
    <a href="{{ route('home') }}" class="btn btn-outline">Ke Beranda</a>
  </div>
@elseif($totalKasus > 0)
  <div class="card">
    <h2>Pisah Data Latih & Uji</h2>
    <p class="sub">Membagi dataset menjadi 80% data latih dan 20% data uji secara acak per jenis penyakit (stratified).</p>
    <div class="alert alert-info">Total <b>{{ $totalKasus }}</b> kasus akan dibagi.</div>
    <form method="post">
      @csrf
      <input type="hidden" name="konfirmasi" value="1">
      <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin ingin memisah data?')">Pisah Data Sekarang</button>
      <a href="{{ route('home') }}" class="btn btn-outline">Kembali</a>
    </form>
  </div>
@else
  <div class="alert alert-error">Belum ada data. Silakan <a href="{{ route('admin.import.index') }}">Import Data CSV</a> terlebih dahulu.</div>
@endif
@endsection
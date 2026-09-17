@extends('layouts.app')
@section('title', 'Latih Model — Sispak Kulit')
@section('content')
<h2 class="section-title">Panel Admin \u2014 Latih Model</h2>

@if($sukses)
  <div class="alert alert-success">{{ $pesan }}</div>
  <div>
    <a href="{{ route('admin.evaluation.index') }}" class="btn btn-primary">Evaluasi Model</a>
    <a href="{{ route('home') }}" class="btn btn-outline">Ke Beranda</a>
  </div>
@else
  @if($statKasus === 0)
    <div class="alert alert-error">Belum ada data latih. Silakan <a href="{{ route('admin.import.index') }}">Import Data CSV</a> dan <a href="{{ route('admin.split.index') }}">Pisah Data</a> terlebih dahulu.</div>
  @elseif($statModel > 0)
    <div class="alert alert-warn">Model sudah ada ({{ $statModel }} parameter). Pelatihan ulang akan <b>menghapus model lama</b>.</div>
  @endif

  <div class="card">
    <h2>Pelatihan Model Naïve Bayes</h2>
    <p class="sub">Menghitung prior P(K) dan likelihood P(G|K) dari data latih.</p>
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card text-center"><div class="card-body py-3"><div style="font-size:24px;font-weight:800;color:var(--primary)">{{ $statKasus }}</div><div style="font-size:12px;color:var(--muted)">Data Latih</div></div></div>
      </div>
      <div class="col-md-4">
        <div class="card text-center"><div class="card-body py-3"><div style="font-size:24px;font-weight:800;color:var(--primary)">{{ \App\Models\Penyakit::count() }}</div><div style="font-size:12px;color:var(--muted)">Jenis Penyakit</div></div></div>
      </div>
      <div class="col-md-4">
        <div class="card text-center"><div class="card-body py-3"><div style="font-size:24px;font-weight:800;color:var(--primary)">{{ \App\Models\Gejala::count() }}</div><div style="font-size:12px;color:var(--muted)">Jumlah Gejala</div></div></div>
      </div>
    </div>
    <div class="mb-3"><b>1.</b> Hitung Prior \u2014 P(K) = jumlah kasus penyakit K / total data latih</div>
    <div class="mb-3"><b>2.</b> Hitung Likelihood \u2014 P(G|K) = (frekuensi + 1) / (jumlah kasus K + 2) <i>(Laplace smoothing)</i></div>
    <div class="mb-3"><b>3.</b> Simpan \u2014 hasil disimpan ke tabel <code>model_prior</code> dan <code>model_likelihood</code></div>
    <form method="post" onsubmit="return confirm('Yakin ingin melatih ulang model?')">
      @csrf
      <input type="hidden" name="konfirmasi" value="1">
      <button type="submit" class="btn btn-primary">Latih Model Sekarang</button>
      <a href="{{ route('home') }}" class="btn btn-outline">Kembali</a>
    </form>
  </div>
@endif
@endsection
@extends('layouts.app')
@section('title', 'Hapus Dataset — Sispak Kulit')
@section('content')
<h2 class="section-title">Panel Admin \u2014 Hapus Dataset</h2>

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

<div class="card">
  <h2>Hapus Dataset</h2>
  <p class="sub">Tindakan ini <b>tidak dapat dibatalkan</b>.</p>
  <div class="alert alert-info">
    Data kasus saat ini: <b>{{ $stat['kasus'] }}</b> \u00b7
    Parameter model: <b>{{ $stat['model'] }}</b> \u00b7
    Log konsultasi: <b>{{ $stat['log'] }}</b>
  </div>
  <div class="alert alert-warn">Master penyakit &amp; gejala <b>tidak ikut dihapus</b>, jadi import ulang CSV akan langsung cocok dengan master yang ada.</div>
  <form method="post">
    @csrf
    <div class="form-check mb-2">
      <input type="checkbox" name="hapus_model" id="hapus_model" class="form-check-input" checked>
      <label class="form-check-label" for="hapus_model">Hapus juga model terlatih (disarankan)</label>
    </div>
    <div class="form-check mb-2">
      <input type="checkbox" name="hapus_tak_terpakai" id="hapus_tak_terpakai" class="form-check-input" checked>
      <label class="form-check-label" for="hapus_tak_terpakai">Hapus penyakit master yang tidak memiliki kasus</label>
    </div>
    <div class="form-check mb-3">
      <input type="checkbox" name="hapus_log" id="hapus_log" class="form-check-input">
      <label class="form-check-label" for="hapus_log">Bersihkan juga log konsultasi</label>
    </div>
    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin menghapus seluruh dataset? Tindakan ini permanen!')">Hapus Semua Data Kasus</button>
    <a href="{{ route('home') }}" class="btn btn-outline">Kembali</a>
  </form>
</div>
@endsection
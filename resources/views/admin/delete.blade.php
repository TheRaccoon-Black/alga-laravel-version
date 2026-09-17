@extends('layouts.app')
@section('title', 'Hapus Dataset — Sispak Kulit')
@section('content')
<div class="page-header">
  <div class="page-title">Hapus Dataset</div>
  <div class="page-sub">Tindakan ini bersifat permanen dan tidak dapat dibatalkan.</div>
</div>

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

<div class="card">
  <h2>Konfirmasi Penghapusan</h2>
  <p class="sub">Pilih data yang ingin dihapus.</p>

  <div class="alert alert-info mb-3">
    Data saat ini: <b>{{ $stat['kasus'] }}</b> kasus &middot;
    <b>{{ $stat['model'] }}</b> parameter model &middot;
    <b>{{ $stat['log'] }}</b> log konsultasi
  </div>

  <div class="alert alert-warn mb-3">
    Master penyakit &amp; gejala <b>tidak ikut dihapus</b>, sehingga import ulang CSV akan langsung cocok.
  </div>

  <form method="post">
    @csrf
    <div class="form-check mb-2">
      <input type="checkbox" name="hapus_model" id="hapus_model" class="form-check-input" checked>
      <label class="form-check-label" for="hapus_model">Hapus model terlatih <i>(disarankan)</i></label>
    </div>
    <div class="form-check mb-2">
      <input type="checkbox" name="hapus_tak_terpakai" id="hapus_tak_terpakai" class="form-check-input" checked>
      <label class="form-check-label" for="hapus_tak_terpakai">Hapus penyakit master tanpa kasus</label>
    </div>
    <div class="form-check mb-3">
      <input type="checkbox" name="hapus_log" id="hapus_log" class="form-check-input">
      <label class="form-check-label" for="hapus_log">Bersihkan log konsultasi</label>
    </div>

    <div style="display:flex;gap:10px">
      <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin menghapus seluruh dataset? Tindakan ini permanen!')">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
        Hapus Semua Data
      </button>
      <a href="{{ route('home') }}" class="btn btn-outline">Kembali</a>
    </div>
  </form>
</div>
@endsection

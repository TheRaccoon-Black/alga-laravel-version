@extends('layouts.app')
@section('title', 'Dashboard — Sispak Kulit')
@section('content')
<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
  <div>
    <div class="page-title">Dashboard</div>
    <div class="page-sub">Selamat datang, {{ Auth::user()->name }}</div>
  </div>
</div>
<div class="alert alert-info">
  <b>Selamat datang!</b> Gunakan menu sidebar di sebelah kiri untuk mengakses fitur admin.
</div>
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-top:20px">
  <div class="card" style="padding:20px;text-align:center">
    <div style="font-size:28px;font-weight:800;color:var(--accent)">{{ \App\Models\Penyakit::count() }}</div>
    <div style="font-size:12px;color:var(--text-sec)">Penyakit</div>
  </div>
  <div class="card" style="padding:20px;text-align:center">
    <div style="font-size:28px;font-weight:800;color:var(--success)">{{ \App\Models\Gejala::count() }}</div>
    <div style="font-size:12px;color:var(--text-sec)">Gejala</div>
  </div>
  <div class="card" style="padding:20px;text-align:center">
    <div style="font-size:28px;font-weight:800;color:var(--warn)">{{ \Illuminate\Support\Facades\DB::table('data_kasus')->count() }}</div>
    <div style="font-size:12px;color:var(--text-sec)">Total Kasus</div>
  </div>
  <div class="card" style="padding:20px;text-align:center">
    <div style="font-size:28px;font-weight:800;color:#7c3aed">{{ \Illuminate\Support\Facades\DB::table('konsultasi')->count() }}</div>
    <div style="font-size:12px;color:var(--text-sec)">Konsultasi</div>
  </div>
</div>
@endsection

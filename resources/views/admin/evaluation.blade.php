@extends('layouts.app')
@section('title', 'Evaluasi Model — Sispak Kulit')
@section('content')
<div class="page-header">
  <div class="page-title">Evaluasi Model Na&iuml;ve Bayes</div>
  <div class="page-sub">Akurasi, precision, recall, dan F1-score pada data latih dan uji.</div>
</div>

<!-- Steps -->
<div class="steps">
  <div class="step done"><div class="step-circle"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><div class="step-label">Import</div></div>
  <div class="step-line"></div>
  <div class="step done"><div class="step-circle"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><div class="step-label">Pisah</div></div>
  <div class="step-line"></div>
  <div class="step done"><div class="step-circle"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><div class="step-label">Latih</div></div>
  <div class="step-line"></div>
  <div class="step active"><div class="step-circle">4</div><div class="step-label">Evaluasi</div></div>
</div>

@if(isset($errorMessage))
  <div class="alert alert-error">{{ $errorMessage }}</div>
@else
  <div class="stats mb-4">
    <div class="stat-card">
      <div class="angka">{{ $akurasiUji }}%</div>
      <div class="label">Akurasi Uji</div>
      <div style="font-size:10px;color:var(--text-sec);margin-top:4px">{{ $benar }} benar dari {{ $total }} kasus</div>
    </div>
    <div class="stat-card">
      <div class="angka">{{ $akurasiLatih }}%</div>
      <div class="label">Akurasi Latih</div>
      <div style="font-size:10px;color:var(--text-sec);margin-top:4px">{{ $benarL }} benar dari {{ count($latih) }} kasus</div>
    </div>
  </div>

  <div class="card mb-4">
    <h2>Metrik Per Kelas</h2>
    <p class="sub">Precision, Recall, dan F1-Score untuk setiap penyakit.</p>
    <div class="table-wrap">
      <table>
        <thead><tr><th>Penyakit</th><th>Precision</th><th>Recall</th><th>F1-Score</th></tr></thead>
        <tbody>
          @foreach($M as $k => $v)
          <tr>
            <td style="font-weight:600">{{ $nama[$k] ?? $k }}</td>
            <td>{{ round($v['P']*100, 1) }}%</td>
            <td>{{ round($v['R']*100, 1) }}%</td>
            <td><strong>{{ round($v['F1']*100, 1) }}%</strong></td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr style="background:#f8fafc">
            <td style="font-weight:700">Macro Average</td>
            <td>{{ round($macro('P')*100, 1) }}%</td>
            <td>{{ round($macro('R')*100, 1) }}%</td>
            <td><strong>{{ round($macro('F1')*100, 1) }}%</strong></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  <div class="card">
    <h2>Confusion Matrix</h2>
    <p class="sub">Baris = aktual, Kolom = prediksi. Sel hijau = benar, merah = salah.</p>
    <div class="table-wrap">
      <table>
        <thead><tr><th>Aktual \ Prediksi</th>@foreach($kelas as $p)<th>{{ $nama[$p] ?? $p }}</th>@endforeach<th>Total</th></tr></thead>
        <tbody>
          @foreach($kelas as $a)
          <tr>
            <th style="text-align:left">{{ $nama[$a] ?? $a }}</th>
            @foreach($kelas as $p)
              @php $v=$C[$a][$p]; $cls=$a===$p?'cm-diag':($v>0?'cm-salah':'cm-kosong'); @endphp
              <td class="cm-cell {{ $cls }}">{{ $v }}</td>
            @endforeach
            <td style="font-weight:700">{{ array_sum($C[$a]) }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endif

<div class="mt-3"><a href="{{ route('home') }}" class="btn btn-outline">&#8592; Ke Beranda</a></div>
@endsection

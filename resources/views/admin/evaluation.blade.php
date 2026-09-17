@extends('layouts.app')
@section('title', 'Evaluasi Model — Sispak Kulit')
@section('content')
<h2 class="section-title">Evaluasi Model Naïve Bayes</h2>

@if(isset($errorMessage))
  <div class="alert alert-error">{{ $errorMessage }}</div>
@else
  <div class="row mb-4">
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-body py-4">
          <div style="font-size:32px;font-weight:800;color:var(--primary)">{{ $akurasiUji }}%</div>
          <div style="font-size:13px;color:var(--muted)">Akurasi Data Uji</div>
          <div style="font-size:12px;color:var(--muted)">{{ $benar }} benar dari {{ $total }} kasus</div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-body py-4">
          <div style="font-size:32px;font-weight:800;color:var(--primary)">{{ $akurasiLatih }}%</div>
          <div style="font-size:13px;color:var(--muted)">Akurasi Data Latih</div>
          <div style="font-size:12px;color:var(--muted)">{{ $benarL }} benar dari {{ count($latih) }} kasus</div>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-4">
    <h3>Metrik per Kelas</h3>
    <p class="sub">Precision, Recall, dan F1-Score untuk setiap penyakit</p>
    <div class="table-wrap">
      <table>
        <thead><tr><th>Penyakit</th><th>Precision</th><th>Recall</th><th>F1-Score</th></tr></thead>
        <tbody>
          @foreach($M as $k => $v)
          <tr>
            <td style="text-align:left;font-weight:600">{{ $nama[$k] ?? $k }}</td>
            <td>{{ round($v['P']*100, 1) }}%</td>
            <td>{{ round($v['R']*100, 1) }}%</td>
            <td><strong>{{ round($v['F1']*100, 1) }}%</strong></td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td style="text-align:left;font-weight:700">Macro Average</td>
            <td>{{ round($macro('P')*100, 1) }}%</td>
            <td>{{ round($macro('R')*100, 1) }}%</td>
            <td>{{ round($macro('F1')*100, 1) }}%</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  <div class="card">
    <h3>Confusion Matrix</h3>
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

<div class="mt-3"><a href="{{ route('home') }}" class="btn btn-outline">Ke Beranda</a></div>
@endsection
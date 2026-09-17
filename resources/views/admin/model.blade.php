@extends('layouts.app')
@section('title', 'Parameter Model — Sispak Kulit')
@section('content')
<div class="page-header">
  <div class="page-title">Parameter Model Na&iuml;ve Bayes</div>
  <div class="page-sub">Prior probability dan conditional likelihood hasil pelatihan.</div>
</div>

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert alert-error">{{ session('error') }}</div>@endif

{{-- Prior --}}
<div class="card" style="padding:18px;margin-bottom:20px">
  <div style="font-size:13px;font-weight:700;color:var(--text);margin-bottom:12px;display:flex;align-items:center;gap:8px">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
    Prior Probability P(K)
  </div>
  <div class="table-wrap" style="padding:0">
    <table>
      <thead>
        <tr>
          <th style="width:80px">Kode</th>
          <th>Nama Penyakit</th>
          <th style="width:80px">Jumlah Kasus</th>
          <th style="width:120px;text-align:center">Prior</th>
        </tr>
      </thead>
      <tbody>
        @foreach($priors as $p)
        <tr>
          <td><code>{{ $p->id_penyakit }}</code></td>
          <td style="font-weight:600">{{ $penyakitMap[$p->id_penyakit] ?? $p->id_penyakit }}</td>
          <td>{{ $p->jumlah_kasus }}</td>
          <td style="text-align:center">
            <span style="display:inline-block;padding:2px 10px;border-radius:20px;font-size:12px;font-weight:700;background:#eff6ff;color:#1e40af">
              {{ number_format($p->prior * 100, 1) }}%
            </span>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- Likelihood --}}
<div class="card" style="padding:18px">
  <div style="font-size:13px;font-weight:700;color:var(--text);margin-bottom:4px;display:flex;align-items:center;gap:8px">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
    Likelihood P(G|K) — Conditional Probability
  </div>
  <div style="font-size:11px;color:var(--text-sec);margin-bottom:14px">
    Nilai P(G|K) menunjukkan seberapa sering gejala tertentu muncul pada penyakit terkait.
  </div>
  <div class="table-wrap" style="padding:0">
    <table>
      <thead>
        <tr>
          <th style="width:70px">Penyakit</th>
          <th>Gejala</th>
          <th style="width:60px">f</th>
          <th style="width:60px">x</th>
          <th style="width:120px;text-align:center">P(G|K)</th>
        </tr>
      </thead>
      <tbody>
        @php $lastPenyakit = ''; @endphp
        @foreach($likelihoods as $l)
        <tr style="{{ $l->id_penyakit !== $lastPenyakit ? 'border-top:2px solid var(--accent)' : '' }}">
          @if($l->id_penyakit !== $lastPenyakit)
            @php $lastPenyakit = $l->id_penyakit; @endphp
            <td rowspan="{{ $likelihoods->where('id_penyakit', $l->id_penyakit)->count() }}"
                style="vertical-align:middle;font-weight:700;background:#f8fafc;white-space:nowrap">
              <div>{{ $penyakitMap[$l->id_penyakit] ?? $l->id_penyakit }}</div>
              <div style="font-size:11px;font-weight:400;color:var(--text-sec)">{{ $l->id_penyakit }}</div>
            </td>
          @endif
          <td style="font-size:12px;color:var(--text-sec)">{{ $gejalaMap[$l->id_gejala] ?? $l->id_gejala }}</td>
          <td style="font-size:12px;text-align:center">{{ $l->f }}</td>
          <td style="font-size:12px;text-align:center">{{ $l->x }}</td>
          <td style="text-align:center">
            <span style="display:inline-block;padding:2px 10px;border-radius:20px;font-size:12px;font-weight:700;
              background:{{ $l->p_ada >= 0.6 ? '#dcfce7' : ($l->p_ada >= 0.3 ? '#fef9c3' : '#fee2e2') }};
              color:{{ $l->p_ada >= 0.6 ? '#166534' : ($l->p_ada >= 0.3 ? '#854d0e' : '#991b1b') }}">
              {{ number_format($l->p_ada * 100, 1) }}%
            </span>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3"><a href="{{ route('home') }}" class="btn btn-outline">
  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
  Kembali
</a></div>
@endsection

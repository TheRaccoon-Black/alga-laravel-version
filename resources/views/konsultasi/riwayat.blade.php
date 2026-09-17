@extends('layouts.app')
@section('title', 'Riwayat Konsultasi — Sispak Kulit')
@section('content')
<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
  <div>
    <div class="page-title">Riwayat Konsultasi</div>
    <div class="page-sub">{{ $riwayat->total() }} konsultasi tercatat</div>
  </div>
  @if($riwayat->count() > 0)
  <form method="post" action="{{ route('konsultasi.hapus_riwayat') }}" onsubmit="return confirm('Hapus semua riwayat?')" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
      Hapus Semua
    </button>
  </form>
  @endif
</div>

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert alert-error">{{ session('error') }}</div>@endif

@if($riwayat->count() === 0)
<div class="card" style="text-align:center;padding:48px;color:var(--text-sec)">
  <div style="margin-bottom:12px"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--text-sec)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
  <div style="font-size:14px;font-weight:600;color:var(--text);margin-bottom:4px">Belum ada riwayat</div>
  <div style="font-size:12px">Lakukan konsultasi terlebih dahulu di halaman Konsultasi</div>
  <div class="mt-3"><a href="{{ route('konsultasi.index') }}" class="btn btn-primary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
    Mulai Konsultasi
  </a></div>
</div>
@else
<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th style="width:50px">#</th>
        <th>Waktu</th>
        <th>Gejala</th>
        <th>Hasil</th>
        <th style="width:60px">Gambar</th>
        <th style="width:90px;text-align:center">Probabilitas</th>
        <th style="width:80px;text-align:center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($riwayat as $i => $r)
      <tr>
        <td style="color:var(--text-sec);font-size:12px">{{ $i + 1 }}</td>
        <td style="font-size:12px;color:var(--text-sec);white-space:nowrap">{{ $r->waktu_str }}</td>
        <td style="max-width:280px;font-size:12px;color:var(--text-sec)">
          {{ implode(', ', array_slice($r->gejala_nama, 0, 4)) }}
          @if(count($r->gejala_nama) > 4)<span style="color:var(--border)">, +{{ count($r->gejala_nama) - 4 }} lainnya</span>@endif
        </td>
        <td>
          <div style="font-weight:600;font-size:13px">{{ $r->penyakit_nama }}</div>
          <div style="font-size:11px;color:var(--text-sec)">{{ $r->hasil_utama }}</div>
        </td>
        <td style="text-align:center">
          @if($r->gambar)
            <img src="{{ Storage::url($r->gambar) }}" alt="{{ $r->penyakit_nama }}" style="width:40px;height:40px;object-fit:cover;border-radius:6px" title="{{ $r->penyakit_nama }}">
          @else
            <span style="color:var(--border)">—</span>
          @endif
        </td>
        <td style="text-align:center">
          <span style="display:inline-block;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:700;
            background:{{ $r->prob_persen >= 50 ? '#dcfce7' : '#fef9c3' }};
            color:{{ $r->prob_persen >= 50 ? '#166534' : '#854d0e' }}">
            {{ $r->prob_persen }}%
          </span>
        </td>
        <td>
          <form method="post" action="{{ route('konsultasi.hapus_satuan', $r->id_konsultasi) }}"
                onsubmit="return confirm('Hapus konsultasi ini?')" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div style="margin-top:16px">{{ $riwayat->links() }}</div>
@endif

<div class="mt-3"><a href="{{ route('home') }}" class="btn btn-outline">
  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
  Kembali
</a></div>
@endsection

@extends('layouts.app')
@section('title', 'Tambah Kasus Manual — Sispak Kulit')
@section('content')
<div class="page-header">
  <div class="page-title">Tambah Kasus Manual</div>
  <div class="page-sub">Input satu data pasien secara langsung ke dalam dataset.</div>
</div>

@if(session('error'))<div class="alert alert-error">{{ session('error') }}</div>@endif
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

<div class="card mb-4">
  <h2>Tambah Kasus Baru</h2>
  <p class="sub">Isi data pasien dan centang gejala yang_dimiliki.</p>
  <form method="post">
    @csrf
    <input type="hidden" name="tambah" value="1">
    <div class="row mb-3">
      <div class="col-md-6">
        <label class="form-label">Kode Pasien</label>
        <input type="text" name="kode_pasien" class="form-control" value="{{ $nextKode }}" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Diagnosis (dari pakar)</label>
        <select name="id_penyakit" class="form-select" required>
          <option value="">&mdash; pilih penyakit &mdash;</option>
          @foreach($penyakitList as $p)
          <option value="{{ $p['id_penyakit'] }}">{{ $p['nama_penyakit'] }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <label class="form-label">Gejala yang dialami:</label>
    <div class="checkbox-grid">
      @foreach($gejalaList as $g)
      <label><input type="checkbox" name="gejala[]" value="{{ $g['id_gejala'] }}"> {{ $g['nama_gejala'] }}</label>
      @endforeach
    </div>
    <div class="mt-3">
      <button type="submit" class="btn btn-primary">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Simpan Kasus
      </button>
    </div>
    <p style="font-size:11px;color:var(--text-sec);margin-top:10px">
      Kasus baru masuk <b>data latih</b>. Jalankan <b>Pisah Data</b> &rarr; <b>Latih Model</b> &rarr; <b>Evaluasi</b> untuk menggunakannya.
    </p>
  </form>
</div>

<div class="card">
  <h2>20 Kasus Terakhir</h2>
  <p class="sub">Riwayat kasus yang baru ditambahkan.</p>
  <div class="table-wrap mt-3">
    <table>
      <thead><tr><th>Kode</th><th>Diagnosis</th><th>Gejala</th><th>Set</th><th></th></tr></thead>
      <tbody>
        @foreach($riwayat as $r)
        <tr>
          <td><b>{{ $r->kode_pasien }}</b></td>
          <td>{{ $r->nama_penyakit }}</td>
          <td>{{ $r->jml }} gejala</td>
          <td>{{ $r->is_uji ? '<span style="background:#eff6ff;color:var(--accent);padding:2px 8px;border-radius:4px;font-size:11px;font-weight:600">uji</span>' : '<span style="background:#f0fdf4;color:var(--success);padding:2px 8px;border-radius:4px;font-size:11px;font-weight:600">latih</span>' }}</td>
          <td>
            <a href="{{ route('admin.dashboard.destroy', $r->id_kasus) }}"
               class="text-danger text-decoration-none" style="font-size:12px"
               onclick="return confirm('Hapus kasus {{ $r->kode_pasien }}?')">hapus</a>
          </td>
        </tr>
        @endforeach
        @if(!$riwayat->count())
        <tr><td colspan="5" style="text-align:center;color:var(--text-sec);padding:20px">Belum ada data kasus.</td></tr>
        @endif
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3"><a href="{{ route('home') }}" class="btn btn-outline">&#8592; Kembali ke Beranda</a></div>
@endsection

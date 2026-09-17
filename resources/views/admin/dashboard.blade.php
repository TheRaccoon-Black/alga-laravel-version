@extends('layouts.app')
@section('title', 'Tambah Kasus Manual — Sispak Kulit')
@section('content')
<h2 class="section-title">Panel Admin \u2014 Tambah Kasus Manual</h2>

@if(session('error'))<div class="alert alert-error">{{ session('error') }}</div>@endif
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

<div class="card mb-4">
  <h2>Tambah Kasus Baru</h2>
  <p class="sub">Input satu data pasien secara langsung.</p>
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
          <option value="">\u2014 pilih penyakit \u2014</option>
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
      <button type="submit" class="btn btn-primary">Simpan Kasus</button>
    </div>
    <p style="font-size:12px;color:var(--muted);margin-top:12px">
      Kasus baru otomatis masuk <b>data latih</b>. Untuk memasukkannya ke data uji, jalankan ulang <b>Pisah Data</b>, lalu <b>Latih Model</b> &amp; <b>Evaluasi</b>.
    </p>
  </form>
</div>

<div class="card">
  <h3>20 Kasus Terakhir</h3>
  <div class="table-wrap mt-3">
    <table>
      <thead><tr><th>Kode</th><th>Diagnosis</th><th>Gejala aktif</th><th>Set</th><th></th></tr></thead>
      <tbody>
        @foreach($riwayat as $r)
        <tr>
          <td><b>{{ $r->kode_pasien }}</b></td>
          <td>{{ $r->nama_penyakit }}</td>
          <td>{{ $r->jml }} gejala</td>
          <td>{{ $r->is_uji ? '<span class="badge bg-info">uji</span>' : 'latih' }}</td>
          <td>
            <a href="{{ route('admin.dashboard.destroy', $r->id_kasus) }}" class="text-danger text-decoration-none" style="font-size:12px" onclick="return confirm('Hapus kasus {{ $r->kode_pasien }}?')">hapus</a>
          </td>
        </tr>
        @endforeach
        @if(!$riwayat->count())
        <tr><td colspan="5" style="text-align:center;color:var(--muted)">Belum ada data kasus.</td></tr>
        @endif
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3"><a href="{{ route('home') }}" class="btn btn-outline">Kembali ke dashboard</a></div>
@endsection
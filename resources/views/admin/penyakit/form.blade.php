@extends('layouts.app')
@section('title', ($action ?? 'Form') . ' Penyakit — Sispak Kulit')
@section('content')
<div class="page-header">
  <div class="page-title">{{ $action ?? 'Form' }} Penyakit</div>
  <div class="page-sub">{{ $action === 'Tambah' ? 'Tambah penyakit baru ke master.' : 'Ubah data penyakit.' }}</div>
</div>

<div class="card" style="max-width:720px">
  <form method="post" action="{{ route($routeName, $editId ?? '') }}">
    @csrf
    @if($action === 'Edit')@method('PUT')@endif

    {{-- ID + Nama --}}
    <div class="row mb-3">
      <div class="col-md-5">
        <label class="form-label">Kode Penyakit <span style="color:var(--danger)">*</span></label>
        <input type="text" name="id_penyakit" class="form-control"
               value="{{ old('id_penyakit', $penyakit->id_penyakit ?? '') }}"
               {{ $action === 'Edit' ? 'disabled' : '' }}
               required placeholder="Contoh: PK14">
        @error('id_penyakit')<div style="font-size:11px;color:var(--danger);margin-top:4px">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-7">
        <label class="form-label">Nama Penyakit <span style="color:var(--danger)">*</span></label>
        <input type="text" name="nama_penyakit" class="form-control"
               value="{{ old('nama_penyakit', $penyakit->nama_penyakit ?? '') }}"
               required placeholder="Nama penyakit">
        @error('nama_penyakit')<div style="font-size:11px;color:var(--danger);margin-top:4px">{{ $message }}</div>@enderror
      </div>
    </div>

    {{-- Detail fields --}}
    <div class="form-group">
      <label class="form-label">Penyebab</label>
      <textarea name="penyebab" class="form-control" rows="3"
                placeholder="Sebutkan penyebab atau faktor pemicu penyakit ini">{{ old('penyebab', $penyakit->penyebab ?? '') }}</textarea>
    </div>

    <div class="form-group">
      <label class="form-label">Ciri-Ciri / Gejala</label>
      <textarea name="ciri_ciri" class="form-control" rows="3"
                placeholder="Tanda dan gejala yang muncul">{{ old('ciri_ciri', $penyakit->ciri_ciri ?? '') }}</textarea>
    </div>

    <div class="form-group">
      <label class="form-label">Pengobatan / Treatment</label>
      <textarea name="treatment" class="form-control" rows="3"
                placeholder="Langkah pengobatan non-obat">{{ old('treatment', $penyakit->treatment ?? '') }}</textarea>
    </div>

    <div class="form-group">
      <label class="form-label">Obat</label>
      <textarea name="obat" class="form-control" rows="3"
                placeholder="Jenis obat yang biasa digunakan">{{ old('obat', $penyakit->obat ?? '') }}</textarea>
    </div>

    <div style="display:flex;gap:10px;margin-top:20px">
      <button type="submit" class="btn btn-primary">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><polyline points="20 6 9 17 4 12"/></svg>
        {{ $action === 'Tambah' ? 'Simpan' : 'Perbarui' }}
      </button>
      <a href="{{ route('admin.penyakit.index') }}" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>

<div class="mt-3"><a href="{{ route('home') }}" class="btn btn-outline">&#8592; Kembali</a></div>
@endsection

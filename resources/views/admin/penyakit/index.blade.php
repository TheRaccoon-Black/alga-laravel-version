@extends('layouts.app')
@section('title', 'Master Penyakit — Sispak Kulit')
@section('content')
<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
  <div>
    <div class="page-title">Master Penyakit</div>
    <div class="page-sub">Kelola data penyakit, penyebab, ciri-ciri, treatment, dan obat.</div>
  </div>
</div>

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert alert-error">{{ session('error') }}</div>@endif

<div class="card" style="padding:0;overflow:hidden">
  <div class="table-wrap" style="border:none;border-radius:0">
    <table>
      <thead>
        <tr>
          <th style="width:70px">Kode</th>
          <th>Nama Penyakit</th>
          <th>Penyebab</th>
          <th>Ciri-Ciri</th>
          <th style="width:70px">Gambar</th>
          <th style="width:120px;text-align:center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($penyakit as $p)
        <tr>
          <td><code>{{ $p->id_penyakit }}</code></td>
          <td style="font-weight:600">{{ $p->nama_penyakit }}</td>
          <td style="max-width:220px;color:var(--text-sec);font-size:12px">
            {{ $p->penyebab ? mb_strimwidth(strip_tags($p->penyebab), 0, 70, '...') : '<span style="color:var(--border)">—</span>' }}
          </td>
          <td style="max-width:220px;color:var(--text-sec);font-size:12px">
            {{ $p->ciri_ciri ? mb_strimwidth(strip_tags($p->ciri_ciri), 0, 70, '...') : '<span style="color:var(--border)">—</span>' }}
          </td>
          <td style="text-align:center">
            @if($p->gambar)
              <img src="{{ Storage::url($p->gambar) }}" alt="{{ $p->nama_penyakit }}" style="width:50px;height:50px;object-fit:cover;border-radius:6px;cursor:pointer" onclick="window.open('{{ Storage::url($p->gambar) }}','_blank')">
            @else
              <span style="color:var(--border)">—</span>
            @endif
          </td>
          <td>
            <div style="display:flex;gap:6px;justify-content:center">
              <button type="button" class="btn btn-outline btn-sm" title="Edit" onclick="openModal('edit',{!! $loop->index !!})">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              </button>
              <form method="post" action="{{ route('admin.penyakit.destroy', $p->id_penyakit) }}"
                    onsubmit="return confirm('Hapus {{ $p->nama_penyakit }}?')" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:32px;color:var(--text-sec)">Belum ada data penyakit.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3"><a href="{{ route('home') }}" class="btn btn-outline">&#8592; Kembali</a></div>

{{-- ── Modal Add ── --}}
<div id="modalAdd" class="modal" style="display:none">
  <div class="modal-backdrop" onclick="closeModal('add')"></div>
  <div class="modal-box">
    <div class="modal-head">
      <div class="modal-title">Tambah Penyakit</div>
      <button class="modal-close" onclick="closeModal('add')">&times;</button>
    </div>
    <form method="post" action="{{ route('admin.penyakit.store') }}" enctype="multipart/form-data" onsubmit="return submitForm(this,'add')">
      @csrf
      <div style="padding:0 24px 20px;overflow-y:auto;max-height:calc(100vh - 200px)">
        @include('admin.penyakit._form', ['isEdit' => false])
      </div>
      <div class="modal-foot">
        <button type="button" class="btn btn-outline" onclick="closeModal('add')">Batal</button>
        <button type="submit" class="btn btn-primary"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><polyline points="20 6 9 17 4 12"/></svg> Simpan</button>
      </div>
    </form>
  </div>
</div>

{{-- ── Modal Edit ── --}}
<div id="modalEdit" class="modal" style="display:none">
  <div class="modal-backdrop" onclick="closeModal('edit')"></div>
  <div class="modal-box">
    <div class="modal-head">
      <div class="modal-title">Edit Penyakit</div>
      <button class="modal-close" onclick="closeModal('edit')">&times;</button>
    </div>
    <form method="post" id="editForm" enctype="multipart/form-data" onsubmit="return submitForm(this,'edit')">
      @csrf
      @method('PUT')
      <div style="padding:0 24px 20px;overflow-y:auto;max-height:calc(100vh - 200px)">
        @include('admin.penyakit._form', ['isEdit' => true])
      </div>
      <div class="modal-foot">
        <button type="button" class="btn btn-outline" onclick="closeModal('edit')">Batal</button>
        <button type="submit" class="btn btn-primary"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px"><polyline points="20 6 9 17 4 12"/></svg> Perbarui</button>
      </div>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
var _penyakitData = {!! json_encode($penyakit->toArray(), JSON_UNESCAPED_UNICODE) !!};
var _editIdx = null;

function openModal(type, data) {
  var modalId = type === 'add' ? 'modalAdd' : 'modalEdit';
  var modal = document.getElementById(modalId);
  modal.style.display = 'flex';
  document.body.style.overflow = 'hidden';
  if (type === 'edit') {
    if (typeof data === 'number') {
      _editIdx = data;
      data = _penyakitData[data];
    }
    var f = modal.querySelector.bind(modal);
    modal.querySelector('#editForm').action = '/admin/penyakit/' + data.id_penyakit;
    f('#f_id').value = data.id_penyakit;
    f('#f_nama').value = data.nama_penyakit;
    f('#f_penyebab').value = data.penyebab || '';
    f('#f_ciri').value = data.ciri_ciri || '';
    f('#f_treatment').value = data.treatment || '';
    f('#f_obat').value = data.obat || '';
    const imgPreview = f('#f_gambar_preview');
    if (imgPreview && data.gambar) {
      imgPreview.src = '{{ Storage::url("") }}' + data.gambar;
      imgPreview.style.display = 'block';
    }
  }
}
function closeModal(type) {
  document.getElementById(type === 'add' ? 'modalAdd' : 'modalEdit').style.display = 'none';
  document.body.style.overflow = '';
}
function submitForm(form, type) {
  var errors = form.querySelectorAll('.err');
  errors.forEach(function(e){e.remove()});
  var fields = form.querySelectorAll('.form-control');
  var valid = true;
  fields.forEach(function(f){
    if (f.required && !f.value.trim()) {
      f.style.borderColor = 'var(--danger)';
      var err = document.createElement('div');
      err.className = 'err';
      err.style.cssText = 'font-size:11px;color:var(--danger);margin-top:4px';
      err.textContent = 'Wajib diisi';
      f.parentNode.appendChild(err);
      valid = false;
    } else {
      f.style.borderColor = '';
    }
  });
  return valid;
}
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') { closeModal('add'); closeModal('edit'); }
});
</script>
@endpush

<style>
.modal{position:fixed;inset:0;z-index:999;display:flex;align-items:center;justify-content:center}
.modal-backdrop{position:absolute;inset:0;background:rgba(0,0,0,.45)}
.modal-box{position:relative;background:var(--surface);border-radius:var(--radius);width:520px;max-width:92vw;max-height:90vh;box-shadow:0 20px 60px rgba(0,0,0,.25);display:flex;flex-direction:column;animation:modalIn .18s ease}
@keyframes modalIn{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:none}}
.modal-head{display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border);flex-shrink:0}
.modal-title{font-size:15px;font-weight:700}
.modal-close{background:none;border:none;font-size:20px;cursor:pointer;color:var(--text-sec);line-height:1;padding:2px 6px;border-radius:4px}
.modal-close:hover{background:var(--bg);color:var(--text)}
.modal-foot{display:flex;justify-content:flex-end;gap:10px;padding:14px 24px;border-top:1px solid var(--border);flex-shrink:0}
.form-control:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(37,99,235,.08)}
.err{font-size:11px;color:var(--danger);margin-top:4px}
</style>

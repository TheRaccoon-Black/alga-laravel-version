@extends('layouts.app')
@section('title', 'Konsultasi — Sispak Kulit')
@section('content')
<div class="card">
  <h2>Mulai Konsultasi</h2>
  <p class="sub">Centang gejala-gejala yang Anda rasakan, lalu klik tombol Diagnosa untuk mendapatkan prediksi penyakit kulit.</p>
  <form method="post" action="{{ route('konsultasi.store') }}" onsubmit="return checkGejala()">
    @csrf
    <div class="checkbox-grid">
      @foreach($gejalas as $g)
      <label>
        <input type="checkbox" name="gejala[]" value="{{ $g['id_gejala'] }}">
        {{ $g['nama_gejala'] }}
      </label>
      @endforeach
    </div>
    <div style="display:flex;gap:10px;margin-top:20px;flex-wrap:wrap">
      <button type="button" id="btnPilihSemua" class="btn btn-outline btn-sm">Pilih Semua</button>
      <button type="button" id="btnHapusSemua"  class="btn btn-outline btn-sm">Hapus Semua</button>
      <button type="submit" class="btn btn-primary">Diagnosa</button>
    </div>
    <p style="font-size:12px;color:var(--muted);margin-top:12px">
      Hasil ini hanya bersifat praduga. Konsultasikan dengan dokter untuk diagnosis yang pasti.
    </p>
  </form>
</div>
@push('scripts')
<script>
function checkGejala(){const c=document.querySelectorAll('input[name="gejala[]"]:checked');if(!c.length){alert('Pilih minimal satu gejala!');return false}}
document.getElementById('btnPilihSemua')?.addEventListener('click',()=>document.querySelectorAll('input[name="gejala[]"]').forEach(cb=>cb.checked=true));
document.getElementById('btnHapusSemua')?.addEventListener('click',()=>document.querySelectorAll('input[name="gejala[]"]').forEach(cb=>cb.checked=false));
</script>
@endpush
@endsection
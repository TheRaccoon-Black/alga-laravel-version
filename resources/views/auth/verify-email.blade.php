@extends('layouts.auth')
@section('title', 'Verifikasi Email — Sispak Kulit')
@section('form-title', 'Verifikasi Email')
@section('form-subtitle', 'Terima kasih sudah mendaftar!')

@section('form-content')
<div style="margin-bottom:20px;font-size:14px;color:var(--text-sec)">
  Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan? Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan ulang.
</div>
@if(session('status') == 'verification-link-sent')
<div class="alert alert-success">Tautan verifikasi baru telah dikirim ke email Anda.</div>
@endif
<div style="display:flex;gap:10px">
  <form method="POST" action="{{ route('verification.send') }}">@csrf<button type="submit" class="btn btn-primary">Kirim Ulang Email Verifikasi</button></form>
  <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="btn btn-outline">Keluar</button></form>
</div>
@endsection

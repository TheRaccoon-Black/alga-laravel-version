@extends('layouts.auth')
@section('title', 'Daftar — Sispak Kulit')
@section('form-title', 'Buat Akun Baru')
@section('form-subtitle', 'Daftar untuk mengakses panel admin')

@section('form-content')
<form method="POST" action="{{ route('register') }}">
  @csrf

  <div class="form-group">
    <label class="form-label">Nama Lengkap</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama lengkap">
    @error('name')<div class="err">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label class="form-label">Email</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autocomplete="username" placeholder="email@contoh.com">
    @error('email')<div class="err">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label class="form-label">Password</label>
    <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password" placeholder="Min. 8 karakter">
    @error('password')<div class="err">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label class="form-label">Konfirmasi Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required autocomplete="new-password" placeholder="Ulangi password">
    @error('password_confirmation')<div class="err">{{ $message }}</div>@enderror
  </div>

  <button type="submit" class="btn btn-primary" style="width:100%;padding:12px;margin-top:8px">
    Daftar
  </button>
</form>

<div style="margin-top:24px;text-align:center;font-size:13px;color:var(--text-sec)">
  Sudah punya akun? <a href="{{ route('login') }}" style="color:var(--accent);font-weight:600">Masuk di sini</a>
</div>
@endsection

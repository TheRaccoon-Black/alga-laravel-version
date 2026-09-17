@extends('layouts.auth')
@section('title', 'Masuk — Sispak Kulit')
@section('form-title', 'Selamat Datang')
@section('form-subtitle', 'Masuk untuk mengakses panel admin')

@section('form-content')
@if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
@if(session('error'))<div class="alert alert-error">{{ session('error') }}</div>@endif

<form method="POST" action="{{ route('login') }}">
  @csrf

  <div class="form-group">
    <label class="form-label">Email</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="admin@gmail.com">
    @error('email')<div class="err">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label class="form-label">Password</label>
    <input type="password" name="password" id="password" class="form-control" required autocomplete="current-password" placeholder="••••••••">
    @error('password')<div class="err">{{ $message }}</div>@enderror
  </div>

  <div style="margin-bottom:24px">
    <label style="display:flex;align-items:center;gap:8px;font-size:13px;color:var(--text-sec);cursor:pointer">
      <input type="checkbox" name="remember" id="remember" style="accent-color:var(--accent)">
      Ingat saya
    </label>
  </div>

  <button type="submit" class="btn btn-primary" style="width:100%;padding:12px">
    Masuk
  </button>
</form>
@endsection

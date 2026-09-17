@extends('layouts.auth')
@section('title', 'Reset Password — Sispak Kulit')
@section('form-title', 'Reset Password')
@section('form-subtitle', 'Masukkan password baru Anda')

@section('form-content')
<form method="POST" action="{{ route('password.store') }}">
  @csrf
  <input type="hidden" name="token" value="{{ $request->route('token') }}">

  <div class="form-group">
    <label class="form-label">Email</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
    @error('email')<div class="err">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label class="form-label">Password Baru</label>
    <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
    @error('password')<div class="err">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label class="form-label">Konfirmasi Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required autocomplete="new-password">
  </div>

  <button type="submit" class="btn btn-primary" style="width:100%;padding:12px">Reset Password</button>
</form>
@endsection

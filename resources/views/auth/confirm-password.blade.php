@extends('layouts.auth')
@section('title', 'Konfirmasi Password — Sispak Kulit')
@section('form-title', 'Konfirmasi Password')
@section('form-subtitle', 'Area ini aman. Konfirmasi password Anda untuk melanjutkan.')

@section('form-content')
<form method="POST" action="{{ route('password.confirm') }}">
  @csrf
  <div class="form-group">
    <label class="form-label">Password</label>
    <input type="password" name="password" id="password" class="form-control" required autocomplete="current-password">
    @error('password')<div class="err">{{ $message }}</div>@enderror
  </div>
  <button type="submit" class="btn btn-primary" style="width:100%;padding:12px">Konfirmasi</button>
</form>
@endsection

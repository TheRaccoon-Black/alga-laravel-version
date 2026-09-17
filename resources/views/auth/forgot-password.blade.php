@extends('layouts.auth')
@section('title', 'Lupa Password — Sispak Kulit')
@section('form-title', 'Lupa Password')
@section('form-subtitle', 'Masukkan email Anda dan kami akan mengirimkan tautan reset password.')

@section('form-content')
@if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif

<form method="POST" action="{{ route('password.email') }}">
  @csrf
  <div class="form-group">
    <label class="form-label">Email</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
    @error('email')<div class="err">{{ $message }}</div>@enderror
  </div>
  <button type="submit" class="btn btn-primary" style="width:100%;padding:12px">Kirim Tautan Reset</button>
</form>
<div style="margin-top:20px;text-align:center">
  <a href="{{ route('login') }}" style="font-size:13px;color:var(--accent)">← Kembali ke masuk</a>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Profil — Sispak Kulit')
@section('content')
<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
  <div>
    <div class="page-title">Profil Saya</div>
    <div class="page-sub">Kelola informasi akun Anda.</div>
  </div>
</div>

@if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(400px,1fr));gap:20px">
  {{-- Update Info --}}
  <div class="card" style="padding:24px">
    <h3 style="font-size:16px;font-weight:700;margin-bottom:20px">Informasi Profil</h3>
    <form method="post" action="{{ route('profile.update') }}">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        @error('name')<div class="err">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        @error('email')<div class="err">{{ $message }}</div>@enderror
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>

  {{-- Update Password --}}
  <div class="card" style="padding:24px">
    <h3 style="font-size:16px;font-weight:700;margin-bottom:20px">Ubah Password</h3>
    <form method="post" action="{{ route('password.update') }}">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label class="form-label">Password Saat Ini</label>
        <input type="password" name="current_password" class="form-control" required autocomplete="current-password">
        @error('current_password')<div class="err">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Password Baru</label>
        <input type="password" name="password" class="form-control" required autocomplete="new-password">
        @error('password')<div class="err">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
      </div>
      <button type="submit" class="btn btn-primary">Perbarui Password</button>
    </form>
  </div>
</div>

{{-- Delete Account --}}
<div class="card" style="padding:24px;margin-top:20px;border-color:#fecaca">
  <h3 style="font-size:16px;font-weight:700;color:#dc2626;margin-bottom:8px">Hapus Akun</h3>
  <p style="font-size:13px;color:var(--text-sec);margin-bottom:16px">Setelah akun dihapus, semua data dan sesi akan hilang permanen. Operasi ini tidak dapat dibatalkan.</p>
  <button type="button" class="btn btn-danger btn-sm" onclick="document.getElementById('deleteForm').style.display='block'">Hapus Akun</button>
  <form id="deleteForm" method="post" action="{{ route('profile.destroy') }}" style="display:none;margin-top:16px;padding-top:16px;border-top:1px solid var(--border)">
    @csrf
    @method('DELETE')
    <div class="form-group">
      <label class="form-label">Konfirmasi Password</label>
      <input type="password" name="password" class="form-control" placeholder="Masukkan password untuk konfirmasi" required>
      @error('password')<div class="err">{{ $message }}</div>@enderror
    </div>
    <div style="display:flex;gap:10px">
      <button type="submit" class="btn btn-danger">Ya, Hapus Akun</button>
      <button type="button" class="btn btn-outline" onclick="document.getElementById('deleteForm').style.display='none'">Batal</button>
    </div>
  </form>
</div>

<div class="mt-3"><a href="{{ route('home') }}" class="btn btn-outline">&#8592; Kembali</a></div>
@endsection

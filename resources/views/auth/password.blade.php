@extends('layouts.app')
@section('title','Ganti Password - TMTB KIK')
@section('breadcrumb','Ganti Password')
@section('content')
<div class="card-form" style="max-width:560px;margin:0 auto">
  <div class="card-form-header"><i class="bi bi-key-fill" style="color:var(--gold)"></i> Ganti Password Login</div>
  <form method="POST" action="{{ route('password.update') }}" class="p-4">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Password Saat Ini <span style="color:#dc3545">*</span></label>
      <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Masukkan password lama" required autocomplete="current-password">
      @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Password Baru <span style="color:#dc3545">*</span></label>
      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="min 6 karakter, beda dari yang lama" required autocomplete="new-password">
      @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Konfirmasi Password Baru <span style="color:#dc3545">*</span></label>
      <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru" required autocomplete="new-password">
    </div>
    <div class="d-flex gap-2 flex-wrap">
      <button class="btn-green flex-fill" style="justify-content:center"><i class="bi bi-check-circle"></i> Simpan Password</button>
      <a href="{{ route('dashboard') }}" class="btn-yellow flex-fill" style="justify-content:center">Batal</a>
    </div>
    <div class="small mt-3 p-2 rounded-3" style="background:var(--cream);border:1.5px dashed var(--gold);color:var(--brown)">Login memakai username/email + password ini. Setelah diganti, gunakan password baru saat masuk berikutnya.</div>
  </form>
</div>
@endsection

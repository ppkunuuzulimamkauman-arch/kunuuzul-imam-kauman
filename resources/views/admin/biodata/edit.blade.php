@extends('layouts.app')
@section('title','Edit Biodata')
@section('breadcrumb','Data Biodata')
@section('content')
<div class="mb-3 d-flex gap-2 flex-wrap">
  <a href="{{ route('biodata.show', $user) }}" class="btn btn-sm" style="background:#fff;border:1.5px solid var(--gold);color:var(--green);border-radius:20px;font-weight:700">← Kembali ke Detail</a>
  <span class="badge align-self-center" style="background:var(--cream2);border:1px solid var(--gold);color:var(--green)">Edit sebagai Admin • {{ strtoupper($user->role) }} • {{ $user->username }}</span>
</div>

<div class="card-form" style="max-width:860px;margin:0 auto">
  <div class="card-form-header">Edit Biodata — {{ $user->name }}</div>
  <form method="POST" action="{{ route('biodata.update', $user) }}" enctype="multipart/form-data" class="p-4">
    @csrf @method('PUT')
    <div class="row g-3">
      <div class="col-12">
        <label class="form-label">Foto (opsional — kosongkan jika tidak ganti)</label>
        <input type="file" name="foto" accept="image/*" class="form-control">
      </div>
      @foreach($defs as $f)
      <div class="col-12 col-md-6">
        <label class="form-label">{{ $f['label'] }}@if(!empty($f['req'])) <span style="color:#dc3545">*</span>@endif</label>
        @if(($f['type'] ?? 'text') === 'textarea')
        <textarea name="{{ $f['name'] }}" rows="2" class="form-control">{{ old($f['name'], $f['value']) }}</textarea>
        @else
        <input type="{{ $f['type'] ?? 'text' }}" name="{{ $f['name'] }}" value="{{ old($f['name'], $f['value']) }}" class="form-control" @if(!empty($f['req'])) required @endif>
        @endif
      </div>
      @endforeach
      <div class="col-12"><hr style="border-color:var(--gold)"><h6 class="fw-bold" style="color:var(--green)"><i class="bi bi-key-fill" style="color:var(--gold)"></i> Reset Password (Admin)</h6><div class="small text-muted mb-2">Kosongkan jika tidak ingin mengganti password {{ $user->username }}.</div></div>
      <div class="col-12 col-md-6">
        <label class="form-label">Password Baru (min 6)</label>
        <input type="password" name="password" class="form-control" placeholder="Kosongkan = tidak ganti" autocomplete="new-password">
      </div>
      <div class="col-12 col-md-6">
        <label class="form-label">Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru" autocomplete="new-password">
      </div>
    </div>
    <div class="d-flex gap-2 mt-4">
      <button class="btn-green flex-fill" style="justify-content:center"><i class="bi bi-check-circle"></i> Simpan Perubahan</button>
      <a href="{{ route('biodata.show', $user) }}" class="btn-yellow flex-fill" style="justify-content:center">Batal</a>
    </div>
  </form>
</div>
@endsection

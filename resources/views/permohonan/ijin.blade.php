@extends('layouts.app')
@section('title','Form Ijin GT • TMTB & DAI KIK')
@section('breadcrumb','Form Ijin GT')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37">
  <div>
    <h4 class="fw-bold mb-0" style="color:#fff"><i class="bi bi-file-earmark-check-fill" style="color:#d4af37"></i> Form Ijin GT</h4>
    <div class="small" style="color:#fdf6e3;opacity:.8">Formulir Permohonan Izin Resmi Guru Tugas • Tahun Ajaran 1448/1449 H</div>
  </div>
  <span class="username-badge" style="background:#fdf6e3;color:#0a3d1f;border-color:#d4af37">{{ auth()->user()->username ?? '' }}</span>
</div>

@if(!empty($isApprover))
<div class="alert d-flex gap-2 mb-3 mx-auto" style="max-width:640px;background:#e8f5e9;border:2px solid #22c55e;color:#0a3d1f;border-radius:12px">
  <i class="bi bi-shield-check mt-1" style="color:#198754;font-size:18px"></i>
  <div class="small" style="line-height:1.5"><strong>Mode Admin</strong> — Form ini <strong>diajukan GT ke Admin</strong>. Hanya <strong>Admin</strong> yang menyetujui/menolak. Tombol Kirim di bawah khusus GT.</div>
</div>
@endif
@if(!empty($sudahAjukan) && !empty($existing))
<div class="alert d-flex gap-2 mb-3 mx-auto" style="max-width:640px;background:#ffe9e9;border:2px solid #ffb3b3;color:#7a0a0a;border-radius:12px">
  <i class="bi bi-exclamation-triangle-fill mt-1" style="font-size:18px"></i>
  <div class="small" style="line-height:1.5"><strong>Sudah mengajukan untuk tahun {{ $existing->tahun }}</strong> ({{ $existing->pjgt_id }} • {{ $existing->status }}). Form Ijin tidak bisa membuat pengajuan baru tahun ini. Silakan perbarui lewat <a href="{{ route('permohonan.step1') }}" style="color:#7a0a0a;font-weight:800;text-decoration:underline">Form Permohonan</a> (form tetap tampil untuk edit) atau <a href="{{ route('permohonan.show',$existing) }}" style="color:#7a0a0a;font-weight:800">lihat detail</a>.</div>
</div>
@endif
<div class="card-form" style="max-width:640px;margin:0 auto">
  <div class="card-form-header"><i class="bi bi-pencil-square" style="color:var(--gold)"></i> Formulir Permohonan Izin Guru Tugas <span class="small fw-normal" style="color:#8a7a3a">— harap diisi dengan sebenar-benarnya</span></div>
  <form method="POST" action="{{ route('form.ijin.store') }}" class="p-4">
    @csrf
    <div class="row g-3">
      <div class="col-12">
        <label class="form-label fw-bold" style="color:var(--green)">Nama Lengkap Guru Tugas <span class="text-danger">*</span></label>
        <input type="text" name="pjgt_nama" value="{{ old('pjgt_nama', auth()->user()->name) }}" class="form-control @error('pjgt_nama') is-invalid @enderror" placeholder="Tuliskan nama lengkap sesuai identitas" required>
        @error('pjgt_nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-12">
        <label class="form-label fw-bold" style="color:var(--green)">Nomor HP / WhatsApp Aktif <span class="text-danger">*</span></label>
        <input type="text" name="telepon" value="{{ old('telepon') }}" class="form-control @error('telepon') is-invalid @enderror" placeholder="Contoh: 081249811242" required>
        @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold" style="color:var(--green)">Tanggal Mulai Izin <span class="text-danger">*</span></label>
        <input type="date" name="tanggal_ijin" value="{{ old('tanggal_ijin') }}" class="form-control @error('tanggal_ijin') is-invalid @enderror" required>
        @error('tanggal_ijin')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold" style="color:var(--green)">Sampai Dengan <span class="text-danger">*</span></label>
        <input type="date" name="tanggal_sampai" value="{{ old('tanggal_sampai') }}" class="form-control @error('tanggal_sampai') is-invalid @enderror" required>
        @error('tanggal_sampai')<div class="invalid-feedback">{{ $message }}</div>@enderror
        <small class="text-muted">Tanggal kembali bertugas</small>
      </div>
      <div class="col-12">
        <label class="form-label fw-bold" style="color:var(--green)">Alasan / Keterangan Izin</label>
        <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Jelaskan alasan izin dengan jelas dan sopan, contoh: keperluan keluarga, sakit, dll.">{{ old('keterangan') }}</textarea>
        @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
    </div>
    @include('permohonan._custom_fields')
    <div class="alert small mt-3 mb-0" style="background:#fdf6e3;border:1px solid var(--gold);color:var(--green)"><i class="bi bi-info-circle-fill" style="color:var(--gold)"></i> Permohonan izin akan disimpan dengan status <strong>Menunggu Persetujuan</strong> dan diverifikasi oleh <strong>Admin</strong>.</div>
    <div class="d-flex gap-2 mt-3">
      <button class="btn-green flex-fill" style="justify-content:center"><i class="bi bi-send-check"></i> Kirim Permohonan Izin</button>
      <a href="{{ route('permohonan.lama') }}" class="btn-yellow flex-fill" style="justify-content:center">Batal</a>
    </div>
  </form>
</div>
@endsection

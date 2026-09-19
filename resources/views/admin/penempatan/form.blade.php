@extends('layouts.app')
@section('title','Tempatkan GT')
@section('breadcrumb','Penempatan GT')
@section('content')
<div class="mb-3">
  <a href="{{ route('penempatan.index') }}" class="btn btn-sm" style="background:#fff;border:1.5px solid var(--gold);color:var(--green);border-radius:20px;font-weight:700">← Kembali ke Daftar</a>
</div>

<div class="card-form" style="max-width:720px;margin:0 auto">
  <div class="card-form-header">Tempatkan GT ke Lembaga</div>
  <form method="POST" action="{{ route('penempatan.store') }}" class="p-4">
    @csrf
    <input type="hidden" name="gt_user_id" value="{{ $gt->id }}">
    <div class="mb-3 p-3 rounded-3" style="background:#fffdf4;border:1.5px solid #e8d9a0">
      <div class="fw-bold" style="color:var(--green)">{{ $gt->name }}</div>
      <div class="small" style="color:#8a7a3a">{{ $gt->username }} • {{ $gt->email }}</div>
      @if($gt->penempatan && $gt->penempatan->permohonan)
      <div class="small mt-1" style="color:#b8941f">Saat ini: {{ $gt->penempatan->permohonan->nama_madrasah }} — memilih baru akan memindahkan.</div>
      @endif
    </div>
    <div class="mb-3">
      <label class="form-label">Lembaga Tujuan (status Diterima) <span class="text-danger">*</span></label>
      <select name="permohonan_id" class="form-select required" required>
        <option value="">-- Pilih lembaga --</option>
        @foreach($lembagas as $l)
        <option value="{{ $l->id }}" @selected(optional($gt->penempatan)->permohonan_id == $l->id)>{{ $l->nama_madrasah }} • {{ $l->desa ?? '' }} {{ $l->kecamatan ?? '' }} {{ $l->kabupaten ?? '' }} • {{ $l->wil }} • Butuh {{ $l->butuh_gt }} GT</option>
        @endforeach
      </select>
      @if($lembagas->isEmpty())
      <div class="small mt-1" style="color:#dc3545">Belum ada permohonan Diterima. Setujui dulu di Antrian Persetujuan.</div>
      @endif
    </div>
    <div class="mb-3">
      <label class="form-label">Catatan (opsional)</label>
      <input type="text" name="catatan" value="{{ old('catatan', optional($gt->penempatan)->catatan) }}" class="form-control" placeholder="cth: penempatan semester ganjil">
    </div>
    <div class="d-flex gap-2">
      <button class="btn-green flex-fill" style="justify-content:center"><i class="bi bi-check-circle"></i> Simpan Penempatan</button>
      <a href="{{ route('penempatan.index') }}" class="btn-yellow flex-fill" style="justify-content:center">Batal</a>
    </div>
  </form>
</div>
@endsection

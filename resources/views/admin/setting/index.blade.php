@extends('layouts.app')
@section('title','Pengaturan')
@section('breadcrumb','Pengaturan')
@section('content')
<div class="p-3 p-md-4 rounded-4 mb-3 position-relative overflow-hidden" style="background:linear-gradient(135deg,#0a3d1f 0%,#0f5a2e 60%,#083d1e 100%);color:#fdf6e3;border:1px solid rgba(212,175,55,.4);box-shadow:0 12px 32px rgba(6,43,21,.3)">
  <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#d4af37,#f4e2a0,#d4af37)"></div>
  <div class="position-relative">
    <h4 class="fw-bold mb-1" style="color:#fff;font-size:clamp(18px,5vw,22px)"><i class="bi bi-gear-fill" style="color:#d4af37"></i> Pengaturan</h4>
    <div class="small" style="opacity:.8">Tahun ajaran aktif: <strong style="color:#f4e2a0">{{ $tahun }} H</strong></div>
  </div>
</div>

<div class="card-form" style="max-width:640px;margin:0 auto">
  <div class="card-form-header"><i class="bi bi-calendar3" style="color:var(--gold)"></i> Tahun Ajaran Aktif</div>
  <form method="POST" action="{{ route('setting.update') }}" class="p-4">
    @csrf @method('PUT')
    <div class="d-grid gap-2 mb-3">
      <label class="d-flex align-items-start gap-2 p-3 rounded-3" style="border:2px solid var(--gold);cursor:pointer;background:#fff">
        <input type="radio" name="mode" value="auto" @checked($mode === 'auto') class="form-check-input mt-1" style="accent-color:#0a3d1f;width:18px;height:18px">
        <span>
          <strong style="color:var(--green)">Otomatis — ikut tahun Hijriah</strong>
          <span class="d-block small" style="color:#5d4037">Ganti sendiri tiap 1 Muharram, tidak perlu repot. Saat ini: <strong>{{ $hijri }} H</strong></span>
        </span>
      </label>
      <label class="d-flex align-items-start gap-2 p-3 rounded-3" style="border:1.5px solid #e8d9a0;cursor:pointer;background:#fff">
        <input type="radio" name="mode" value="manual" @checked($mode !== 'auto') class="form-check-input mt-1" style="accent-color:#0a3d1f;width:18px;height:18px">
        <span class="flex-fill">
          <strong style="color:var(--green)">Manual — tentukan sendiri</strong>
          <span class="d-block small mb-2" style="color:#5d4037">Format 4 digit / 4 digit, contoh: 1449/1450</span>
          <input name="tahun_ajaran" value="{{ old('tahun_ajaran', $manual) }}" class="form-control" placeholder="1449/1450">
        </span>
      </label>
    </div>
    <div class="small p-2 rounded-3" style="background:var(--cream);border:1.5px dashed var(--gold);color:var(--brown);line-height:1.7">
      <i class="bi bi-info-circle-fill" style="color:var(--gold2)"></i>
      Tahun baru akan <strong>membuka pendaftaran PJGT tahun baru</strong> — yang sudah daftar tahun lalu bisa daftar lagi.
      Data tahun lama tetap tersimpan dan tetap bisa difilter di Arsip/Laporan.
    </div>
    <button class="btn-green w-100 mt-3" style="justify-content:center"><i class="bi bi-check-circle"></i> Simpan Pengaturan</button>
  </form>
</div>
@endsection

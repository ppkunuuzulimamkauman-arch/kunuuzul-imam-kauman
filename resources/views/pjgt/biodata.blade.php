@extends('layouts.app')
@section('title','Biodata PJGT - TMTB KIK')
@section('breadcrumb','Biodata PJGT')
@push('styles')
<style>
  .pjgt-head{background:linear-gradient(135deg,#d4af37 0%, #b8941f 100%);color:#0a3d1f;border-radius:12px;padding:14px 18px;display:flex;align-items:center;gap:12px;box-shadow:0 4px 16px rgba(212,175,55,.25)}
  .pjgt-head i{width:44px;height:44px;background:#0a3d1f;color:#d4af37;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
  .bio-label{font-size:12px;color:#5d4037;font-weight:700;margin-bottom:4px}
  .bio-label .req{color:#dc3545}
  .bio-input{background:#f9f6ea !important;border:1.5px solid transparent !important;font-size:13px;color:#5d4037;border-radius:10px}
  .bio-input:not(:disabled){background:#fff !important;border-color:#e8d9a0 !important;color:#1a1a1a}
  .bio-input:not(:disabled):focus{border-color:#d4af37 !important;box-shadow:0 0 0 3px rgba(212,175,55,.18)}
  .pjgt-tabs .nav-link{font-size:13px;color:#5d4037;background:#fdf6e3;border-radius:10px 10px 0 0;font-weight:600;border:1px solid transparent}
  .pjgt-tabs .nav-link.active{background:#0a3d1f;color:#d4af37 !important;font-weight:800;border-color:#d4af37 #d4af37 #0a3d1f}
  .pjgt-card{border:2px solid #d4af37;border-radius:16px;overflow:hidden;box-shadow:0 8px 28px rgba(10,61,31,.08);background:#fff}
</style>
@endpush
@section('content')
@php
  $fotoUrl = ($biodata->foto_path ?? null)
    ? asset('storage/'.$biodata->foto_path)
    : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=d4af37&color=0a3d1f&size=200';
@endphp

<div class="pjgt-head mb-3">
  <i class="bi bi-person-vcard-fill"></i>
  <div>
    <div class="fw-bold" style="font-size:16px;letter-spacing:.3px">Biodata PJGT</div>
    <div class="small" style="opacity:.8">Penanggung Jawab Guru Tugas • Data diri & kontak — dibedakan dari GT</div>
  </div>
  <span class="ms-auto badge" style="background:#0a3d1f;color:#d4af37;border:1px solid #0a3d1f">PJGT • {{ $user->username }}</span>
</div>

<div class="pjgt-card">
  <div class="p-3 d-flex justify-content-between align-items-center flex-wrap gap-2" style="background:linear-gradient(135deg,#fffdf0,#fdf6e3);border-bottom:2px solid #d4af37">
    <div class="d-flex gap-3 align-items-center">
      <img id="fotoPreview" src="{{ $fotoUrl }}" alt="Foto" style="width:84px;height:84px;border-radius:16px;object-fit:cover;border:2.5px solid #d4af37;box-shadow:0 4px 14px rgba(0,0,0,.12)">
      <div>
        <div class="fw-bold" style="color:#0a3d1f">{{ $user->name }}</div>
        <div class="small" style="color:#8a7a3a">{{ $user->username }} • PJGT</div>
        <div class="small" style="color:#999">{{ $user->email }}</div>
      </div>
    </div>
    <button type="button" id="btnEdit" class="btn btn-sm fw-bold" style="background:#0a3d1f;color:#d4af37;border-radius:50px;padding:8px 16px;border:1.5px solid #d4af37"><i class="bi bi-pencil-square"></i> Edit Biodata PJGT</button>
  </div>

  <div class="p-3">
    <form method="POST" action="{{ route('pjgt.biodata.update') }}" enctype="multipart/form-data" id="bioForm">
      @csrf @method('PUT')

      <div class="row g-3 mb-2">
        <div class="col-12 col-md-6">
          <label class="bio-label">Nama Lengkap <span class="req">*</span></label>
          <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control form-control-sm bio-input" disabled required>
        </div>
        <div class="col-12 col-md-6">
          <label class="bio-label">Email <span class="req">*</span></label>
          <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control form-control-sm bio-input" disabled required>
        </div>
      </div>

      <div class="mb-2 d-none" id="fotoRow">
        <label class="bio-label">Foto Profil (JPG/PNG max 2MB)</label>
        <input type="file" name="foto" id="fotoInput" accept="image/*" class="form-control form-control-sm">
      </div>

      <ul class="nav nav-tabs pjgt-tabs mt-3">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-pjgt-diri" type="button">Data Diri & Kontak</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-pjgt-madrasah" type="button">Info Madrasah</button></li>
      </ul>

      <div class="tab-content py-3">
        <div class="tab-pane fade show active" id="tab-pjgt-diri">
          <div class="row g-3">
            <div class="col-12 col-md-6"><label class="bio-label">Tempat Lahir</label><input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $biodata->tempat_lahir) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Tanggal Lahir</label><input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', optional($biodata->tanggal_lahir)->format('Y-m-d')) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">NIK</label><input type="text" name="nik" value="{{ old('nik', $biodata->nik) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">HP / WA</label><input type="text" name="hp" value="{{ old('hp', $biodata->hp) }}" class="form-control form-control-sm bio-input" disabled placeholder="08xxxx"></div>
            <div class="col-12 col-md-6"><label class="bio-label">Telepon</label><input type="text" name="telepon" value="{{ old('telepon', $biodata->telepon) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Kode Pos</label><input type="text" name="kode_pos" value="{{ old('kode_pos', $biodata->kode_pos) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12"><label class="bio-label">Alamat Lengkap</label><input type="text" name="alamat" value="{{ old('alamat', $biodata->alamat) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Kelurahan</label><input type="text" name="kelurahan" value="{{ old('kelurahan', $biodata->kelurahan) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Kecamatan</label><input type="text" name="kecamatan" value="{{ old('kecamatan', $biodata->kecamatan) }}" class="form-control form-control-sm bio-input" disabled></div>
          </div>
        </div>
        <div class="tab-pane fade" id="tab-pjgt-madrasah">
          @if($permohonan)
          <div class="p-3 rounded-3" style="background:#fffdf0;border:1.5px solid #e8d9a0">
            <div class="fw-bold" style="color:#0a3d1f"><i class="bi bi-bank" style="color:#b8941f"></i> {{ $permohonan->nama_madrasah }}</div>
            <div class="small" style="color:#5d4037">{{ $permohonan->alamat_lengkap }} • {{ $permohonan->wil }} • {{ $permohonan->tahun }}</div>
            <div class="small mt-1"><span class="badge" style="background:var(--green);color:var(--gold)">{{ $permohonan->status }}</span> <span class="badge" style="background:#fdf0c7;color:#0a3d1f;border:1px solid #d4af37">{{ $permohonan->butuh_gt }} GT</span></div>
            <div class="small mt-2" style="color:#8a7a3a">PJGT: {{ $permohonan->pjgt_nama }} • {{ $permohonan->telepon ?? '-' }}</div>
          </div>
          <div class="small mt-2" style="color:#999">Info madrasah diambil dari permohonan terbaru milik Anda. Ubah via Data Permohonan.</div>
          @else
          <div class="text-center py-4 small" style="color:#8a7a3a"><i class="bi bi-inbox"></i><br>Belum ada permohonan. Buat permohonan dulu untuk menampilkan info madrasah.</div>
          @endif
        </div>
      </div>

      <div class="d-none gap-2 mt-3" id="saveBar">
        <button type="submit" class="btn fw-bold" style="background:#0a3d1f;color:#d4af37;border-radius:10px;min-height:46px;flex:1"><i class="bi bi-check-circle-fill"></i> Simpan Biodata PJGT</button>
        <button type="button" id="btnCancel" class="btn fw-bold" style="background:#fff;border:1.5px solid #e8d9a0;color:#5d4037;border-radius:10px;min-height:46px">Batal</button>
      </div>
      <div class="small mt-2" style="color:#999;font-size:11px">Ubah nama/email di sini → nama di dashboard & sidebar ikut terganti otomatis.</div>
    </form>
  </div>
</div>

<script>
(function(){
  const btn=document.getElementById('btnEdit'), bar=document.getElementById('saveBar'),
        cancel=document.getElementById('btnCancel'), fotoRow=document.getElementById('fotoRow'),
        fotoInput=document.getElementById('fotoInput'), prev=document.getElementById('fotoPreview');
  let editing=false;
  function setEdit(on){
    editing=on;
    document.querySelectorAll('.bio-input').forEach(function(el){ el.disabled=!on; });
    bar.classList.toggle('d-none',!on); bar.classList.toggle('d-flex',on);
    fotoRow.classList.toggle('d-none',!on);
    btn.innerHTML=on?'<i class="bi bi-x-lg"></i> Batal':'<i class="bi bi-pencil-square"></i> Edit Biodata PJGT';
  }
  btn.onclick=function(){ setEdit(!editing); };
  cancel.onclick=function(){ setEdit(false); document.getElementById('bioForm').reset(); };
  if(fotoInput){ fotoInput.onchange=function(){ const f=fotoInput.files[0]; if(f){ prev.src=URL.createObjectURL(f); } }; }
  @if($errors->any()) setEdit(true); @endif
})();
</script>
@endsection

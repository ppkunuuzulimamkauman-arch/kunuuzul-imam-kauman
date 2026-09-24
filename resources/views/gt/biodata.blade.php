@extends('layouts.app')
@section('title','Biodata - Guru Tugas')
@section('breadcrumb','Biodata')
@push('styles')
<style>
  .bio-label{font-size:12px;color:#333;margin-bottom:4px}
  .bio-label .req{color:#dc3545}
  .bio-input{background:#f1f1f1 !important;border:1px solid transparent !important;font-size:12px;color:#555}
  .bio-input:not(:disabled){background:#fff !important;border-color:#e8d9a0 !important;color:#1a1a1a}
  .bio-input:not(:disabled):focus{border-color:var(--gold) !important;box-shadow:0 0 0 3px rgba(212,175,55,.18)}
  .bio-tabs .nav-link{font-size:12px;color:#333;background:#f1f1f1;border-radius:6px 6px 0 0;transition:background-color .25s,color .25s}
  .bio-tabs .nav-link:hover{background:#e6f4ea;color:#0a4d26}
  .bio-tabs .nav-link.active{background:#fff;color:#0a3d1f !important;font-weight:700;border-color:#dee2e6 #dee2e6 #fff}
</style>
@endpush
@section('content')
@php
  $fotoUrl = ($biodata->foto_path ?? null)
    ? asset('storage/'.$biodata->foto_path)
    : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=d4af37&color=0a3d1f&size=200';
@endphp
<div class="card" style="border:none;border-radius:8px;box-shadow:0 2px 12px rgba(0,0,0,.08)">
  <div class="p-3 d-flex justify-content-between align-items-center flex-wrap gap-2" style="border-bottom:1px solid #eee">
    <span style="color:#2b3a67;font-size:15px">Biodata Guru Tugas</span>
    <button type="button" id="btnEdit" class="btn btn-sm fw-bold" style="background:#f5a623;color:#fff;border-radius:5px;font-size:11px"><i class="bi bi-pencil-square"></i> Edit Biodata</button>
  </div>

  <div class="p-3">
    {{-- Foto profil --}}
    <div class="d-flex gap-3 align-items-center flex-wrap mb-3 p-3 rounded-3" style="background:#faf8f0;border:1px solid #eee">
      <img id="fotoPreview" src="{{ $fotoUrl }}" alt="Foto profil" style="width:96px;height:96px;border-radius:50%;object-fit:cover;border:3px solid var(--gold);box-shadow:0 4px 14px rgba(0,0,0,.15)">
      <div class="flex-fill" style="min-width:200px">
        <div class="fw-bold" style="color:#0a3d1f;font-size:17px">{{ $user->name }}</div>
        <div class="small" style="color:#777">{{ $user->username }} • GURU TUGAS</div>
        <div class="small mt-1" style="color:#999;font-size:11px">Foto tampil di biodata. Ganti lewat mode edit (JPG/PNG, maks 2MB).</div>
      </div>
    </div>

    <form method="POST" action="{{ route('gt.biodata.update') }}" enctype="multipart/form-data" id="bioForm">
      @csrf @method('PUT')

      {{-- Ringkasan atas ala referensi --}}
      <div class="row g-3 mb-1">
        <div class="col-12 col-md-6">
          <label class="bio-label">Nama Guru Tugas <span class="req">*</span></label>
          <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control form-control-sm bio-input" disabled required>
        </div>
        <div class="col-12 col-md-6">
          <label class="bio-label">Tempat Lahir <span class="req">*</span></label>
          <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $biodata->tempat_lahir) }}" class="form-control form-control-sm bio-input" disabled>
        </div>
        <div class="col-12 col-md-6">
          <label class="bio-label">Tanggal Lahir <span class="req">*</span></label>
          <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', optional($biodata->tanggal_lahir)->format('Y-m-d')) }}" class="form-control form-control-sm bio-input" disabled>
        </div>
        <div class="col-12 col-md-6">
          <label class="bio-label">NIK <span class="req">*</span></label>
          <input type="text" name="nik" value="{{ old('nik', $biodata->nik) }}" class="form-control form-control-sm bio-input" disabled>
        </div>
      </div>

      {{-- Upload foto (hanya mode edit) --}}
      <div class="mb-2 d-none" id="fotoRow">
        <label class="bio-label">Foto Profil</label>
        <input type="file" name="foto" id="fotoInput" accept="image/*" class="form-control form-control-sm">
      </div>

      <ul class="nav nav-tabs bio-tabs mt-3" style="border-bottom:1px solid #dee2e6">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-diri" type="button" role="tab">Data Diri &amp; Alamat</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-ortu" type="button" role="tab">Orang Tua</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-khusus" type="button" role="tab">Kebutuhan Khusus</button></li>
      </ul>

      <div class="tab-content py-3">
        {{-- TAB 1 --}}
        <div class="tab-pane fade show active" id="tab-diri" role="tabpanel">
          <div class="row g-3">
            <div class="col-12 col-md-6"><label class="bio-label">NISN</label><input type="text" name="nisn" value="{{ old('nisn', $biodata->nisn) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">NPWP</label><input type="text" name="npwp" value="{{ old('npwp', $biodata->npwp) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Kewarganegaraan <span class="req">*</span></label><input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', $biodata->kewarganegaraan ?? 'Indonesia') }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Penerima KPS <span class="req">*</span></label>
              <select name="penerima_kps" class="form-select form-select-sm bio-input" disabled>
                @foreach(['Tidak','Ya'] as $o)<option value="{{ $o }}" {{ old('penerima_kps', $biodata->penerima_kps ?? 'Tidak')==$o?'selected':'' }}>{{ $o }}</option>@endforeach
              </select>
            </div>
            <div class="col-12 col-md-6"><label class="bio-label">Jenis Kelamin <span class="req">*</span></label>
              <select name="jenis_kelamin" class="form-select form-select-sm bio-input" disabled>
                @foreach(['Laki-laki','Perempuan'] as $o)<option value="{{ $o }}" {{ old('jenis_kelamin', $biodata->jenis_kelamin)==$o?'selected':'' }}>{{ $o }}</option>@endforeach
              </select>
            </div>
            <div class="col-12 col-md-6"><label class="bio-label">Agama <span class="req">*</span></label>
              <select name="agama" class="form-select form-select-sm bio-input" disabled>
                @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $o)<option value="{{ $o }}" {{ old('agama', $biodata->agama ?? 'Islam')==$o?'selected':'' }}>{{ $o }}</option>@endforeach
              </select>
            </div>
            <div class="col-12 col-md-6"><label class="bio-label">Alamat <span class="req">*</span></label><input type="text" name="alamat" value="{{ old('alamat', $biodata->alamat) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Kode Pos</label><input type="text" name="kode_pos" value="{{ old('kode_pos', $biodata->kode_pos) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-6 col-md-3"><label class="bio-label">RT</label><input type="text" name="rt" value="{{ old('rt', $biodata->rt) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-6 col-md-3"><label class="bio-label">RW</label><input type="text" name="rw" value="{{ old('rw', $biodata->rw) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Dusun</label><input type="text" name="dusun" value="{{ old('dusun', $biodata->dusun) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Kelurahan <span class="req">*</span></label><input type="text" name="kelurahan" value="{{ old('kelurahan', $biodata->kelurahan) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Kecamatan <span class="req">*</span></label><input type="text" name="kecamatan" value="{{ old('kecamatan', $biodata->kecamatan) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Tempat Tinggal</label><input type="text" name="tempat_tinggal" value="{{ old('tempat_tinggal', $biodata->tempat_tinggal) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Transport</label><input type="text" name="transport" value="{{ old('transport', $biodata->transport) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Telephone</label><input type="text" name="telepon" value="{{ old('telepon', $biodata->telepon) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">HP</label><input type="text" name="hp" value="{{ old('hp', $biodata->hp) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12"><label class="bio-label">Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control form-control-sm bio-input" disabled></div>
          </div>
        </div>

        {{-- TAB 2 --}}
        <div class="tab-pane fade" id="tab-ortu" role="tabpanel">
          <div class="row g-3">
            <div class="col-12 col-md-6"><label class="bio-label">NIK Ayah</label><input type="text" name="nik_ayah" value="{{ old('nik_ayah', $biodata->nik_ayah) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Nama Ayah</label><input type="text" name="nama_ayah" value="{{ old('nama_ayah', $biodata->nama_ayah) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Tanggal Lahir Ayah</label><input type="date" name="tgl_lahir_ayah" value="{{ old('tgl_lahir_ayah', optional($biodata->tgl_lahir_ayah)->format('Y-m-d')) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Pendidikan Ayah</label><input type="text" name="pendidikan_ayah" value="{{ old('pendidikan_ayah', $biodata->pendidikan_ayah) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Pekerjaan Ayah</label><input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $biodata->pekerjaan_ayah) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Penghasilan Ayah</label><input type="text" name="penghasilan_ayah" value="{{ old('penghasilan_ayah', $biodata->penghasilan_ayah) }}" class="form-control form-control-sm bio-input" disabled></div>
          </div>
          <hr>
          <div class="row g-3">
            <div class="col-12 col-md-6"><label class="bio-label">NIK Ibu</label><input type="text" name="nik_ibu" value="{{ old('nik_ibu', $biodata->nik_ibu) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Nama Ibu Kandung <span class="req">*</span></label><input type="text" name="nama_ibu" value="{{ old('nama_ibu', $biodata->nama_ibu) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Tanggal Lahir Ibu</label><input type="date" name="tgl_lahir_ibu" value="{{ old('tgl_lahir_ibu', optional($biodata->tgl_lahir_ibu)->format('Y-m-d')) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Pendidikan Ibu</label><input type="text" name="pendidikan_ibu" value="{{ old('pendidikan_ibu', $biodata->pendidikan_ibu) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Pekerjaan Ibu</label><input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $biodata->pekerjaan_ibu) }}" class="form-control form-control-sm bio-input" disabled></div>
            <div class="col-12 col-md-6"><label class="bio-label">Penghasilan Ibu</label><input type="text" name="penghasilan_ibu" value="{{ old('penghasilan_ibu', $biodata->penghasilan_ibu) }}" class="form-control form-control-sm bio-input" disabled></div>
          </div>
        </div>

        {{-- TAB 3 --}}
        <div class="tab-pane fade" id="tab-khusus" role="tabpanel">
          @php $opts=['Tidak Ada Kebutuhan Khusus','Tuna Netra','Tuna Rungu','Tuna Wicara','Tuna Daksa','Lainnya']; @endphp
          <div class="mb-3 pb-2" style="border-bottom:1px solid #ddd">
            <label class="bio-label">Guru Tugas</label>
            <select name="kebutuhan_gt" class="form-select form-select-sm bio-input" disabled>
              @foreach($opts as $o)<option value="{{ $o }}" {{ old('kebutuhan_gt', $biodata->kebutuhan_gt ?? 'Tidak Ada Kebutuhan Khusus')==$o?'selected':'' }}>{{ $o }}</option>@endforeach
            </select>
          </div>
          <div class="mb-3 pb-2" style="border-bottom:1px solid #ddd">
            <label class="bio-label">Ayah</label>
            <select name="kebutuhan_ayah" class="form-select form-select-sm bio-input" disabled>
              @foreach($opts as $o)<option value="{{ $o }}" {{ old('kebutuhan_ayah', $biodata->kebutuhan_ayah ?? 'Tidak Ada Kebutuhan Khusus')==$o?'selected':'' }}>{{ $o }}</option>@endforeach
            </select>
          </div>
          <div>
            <label class="bio-label">Ibu</label>
            <select name="kebutuhan_ibu" class="form-select form-select-sm bio-input" disabled>
              @foreach($opts as $o)<option value="{{ $o }}" {{ old('kebutuhan_ibu', $biodata->kebutuhan_ibu ?? 'Tidak Ada Kebutuhan Khusus')==$o?'selected':'' }}>{{ $o }}</option>@endforeach
            </select>
          </div>
        </div>
      </div>

      {{-- Akun login: username + password --}}
      <div class="card mt-2 mb-2" style="border:1.5px solid #e8d9a0;border-radius:12px;overflow:hidden">
        <div class="px-3 py-2 fw-bold" style="background:linear-gradient(135deg,#0a3d1f,#1d7a3d);color:#f4e2a0;font-size:13px"><i class="bi bi-key-fill"></i> Akun Login</div>
        <div class="p-3 row g-3">
          <div class="col-12 col-md-6"><label class="bio-label">Username <span class="req">*</span></label><input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control form-control-sm bio-input" disabled required></div>
          <div class="col-12 col-md-6"><label class="bio-label">Password Saat Ini <small style="color:#999">(wajib bila ganti password)</small></label><input type="password" name="current_password" class="form-control form-control-sm bio-input" disabled autocomplete="current-password"></div>
          <div class="col-12 col-md-6"><label class="bio-label">Password Baru <small style="color:#999">(kosongkan bila tidak ganti)</small></label><input type="password" name="password" class="form-control form-control-sm bio-input" disabled autocomplete="new-password" placeholder="min 6 karakter"></div>
          <div class="col-12 col-md-6"><label class="bio-label">Konfirmasi Password Baru</label><input type="password" name="password_confirmation" class="form-control form-control-sm bio-input" disabled autocomplete="new-password"></div>
        </div>
      </div>

      <div class="d-none gap-2 mt-3" id="saveBar">
        <button type="submit" class="btn fw-bold" style="background:#0a3d1f;color:#d4af37;border-radius:8px;min-height:46px;flex:1"><i class="bi bi-check-circle-fill"></i> Simpan Biodata</button>
        <button type="button" id="btnCancel" class="btn fw-bold" style="background:#fff;border:1.5px solid #e8d9a0;color:#5d4037;border-radius:8px;min-height:46px">Batal</button>
      </div>
      <div class="small mt-2" style="color:#999;font-size:11px">Ubah nama di sini → nama di dashboard, sidebar &amp; profil ikut terganti otomatis (tersimpan di akun).</div>
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
    btn.innerHTML=on?'<i class="bi bi-x-lg"></i> Batal':'<i class="bi bi-pencil-square"></i> Edit Biodata';
  }
  btn.onclick=function(){ setEdit(!editing); };
  cancel.onclick=function(){ setEdit(false); document.getElementById('bioForm').reset(); };
  if(fotoInput){ fotoInput.onchange=function(){ const f=fotoInput.files[0]; if(f){ prev.src=URL.createObjectURL(f); } }; }
  @if($errors->any()) setEdit(true); @endif
})();
</script>
@endsection

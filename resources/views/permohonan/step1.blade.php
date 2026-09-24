@extends('layouts.app')
@section('title','Tahap 1 - Identitas | TMTB KIK')
@section('breadcrumb','Tahap 1 • Identitas')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37">
    <div>
 <div class="arab small" style="color:#d4af37">Tahap 1</div>
        <h5 class="mb-0 fw-bold" style="color:#d4af37"><i class="bi bi-journal-bookmark-fill"></i> Formulir Pendaftaran</h5>
        <h4 class="fw-bold mb-0" style="color:#fff">Identitas Madrasah — 1448/1449 H</h4>
        <div class="small" style="color:#fdf6e3;opacity:0.8">PP KUNUUZUL IMAM KAUMAN • TMTB</div>
    </div>
    <div class="text-end">
        <div class="small" style="color:var(--gold)">Username Anda</div>
        <span class="username-badge" style="background:#fdf6e3;color:#0a3d1f;border-color:#d4af37">{{ auth()->user()->username ?? '00007' }} • {{ strtoupper(auth()->user()->role ?? 'PJGT') }}</span>
        @if((auth()->user()->role ?? '')==='admin')
        <a href="{{ route('form-questions.index') }}" class="btn btn-sm mt-2" style="background:rgba(212,175,55,.15);border:1.5px solid #d4af37;color:#d4af37;border-radius:20px;font-size:11px;font-weight:700"><i class="bi bi-gear-fill"></i> Kelola Pertanyaan</a>
        @endif
    </div>
</div>

@include('components.stepper', ['current'=>1])

<div class="card-form mt-0">
    <form method="POST" action="{{ route('permohonan.store1') }}">
        @csrf
        <div class="p-4">
            <h6 class="fw-bold mb-3">Identitas Madrasah</h6>
            <div class="mb-3">
                <label class="form-label small">Nama Madrasah</label>
                <input type="text" name="nama_madrasah" value="{{ old('nama_madrasah', $defaults['nama_madrasah']) }}" class="form-control @error('nama_madrasah') is-invalid @enderror">
                @error('nama_madrasah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label small">Nama Pondok Pesantren <span class="text-danger">*</span></label>
                <input type="text" name="nama_pesantren" value="{{ old('nama_pesantren', $defaults['nama_pesantren']) }}" placeholder="nama pondok pesantren" class="form-control required @error('nama_pesantren') is-invalid @enderror">
                @error('nama_pesantren')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <small class="text-muted">Wajib diisi. Jika tidak ada dikasih 0</small>
            </div>

            <h6 class="fw-bold mt-4 mb-3">Alamat Madrasah</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label small">Negara</label>
                    <input type="text" name="negara" value="{{ old('negara', $defaults['negara']) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Pilih Provinsi</label>
                    <input type="text" name="provinsi" value="{{ old('provinsi', $defaults['provinsi']) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Kabupaten</label>
                    <input type="text" name="kabupaten" value="{{ old('kabupaten', $defaults['kabupaten']) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Kecamatan</label>
                    <input type="text" name="kecamatan" value="{{ old('kecamatan', $defaults['kecamatan']) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Desa</label>
                    <input type="text" name="desa" value="{{ old('desa', $defaults['desa']) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Jalan/Dusun</label>
                    <input type="text" name="jalan_dusun" value="{{ old('jalan_dusun', $defaults['jalan_dusun']) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Kode Pos</label>
                    <input type="text" name="kode_pos" value="{{ old('kode_pos', $defaults['kode_pos']) }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label small">RT</label>
                    <input type="text" name="rt" value="{{ old('rt', $defaults['rt']) }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label small">RW</label>
                    <input type="text" name="rw" value="{{ old('rw', $defaults['rw']) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $defaults['telepon']) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Email</label>
                    <input type="email" name="email" value="{{ old('email', $defaults['email']) }}" class="form-control">
                </div>
            </div>
        </div>
            @include('permohonan._custom_fields')
        </div>
        <div class="p-3 border-top d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#fdf6e3 0%, #fdf0c7 100%);border-top:2px solid #d4af37">
 <span class="arab small" style="color:#0a3d1f">langkah 1 dari 4</span>
            <button type="submit" class="btn-green">Selanjutnya <i class="bi bi-arrow-right"></i> • Tahap 2</button>
        </div>
    </form>
</div>
@endsection

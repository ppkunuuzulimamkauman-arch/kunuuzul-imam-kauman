@extends('layouts.app')
@section('title','Tahap 3 - Madrasah | TMTB & DAI KIK')
@section('breadcrumb','Tahap 3 • Madrasah')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37">
    <div>
        <div class="arab small" style="color:#d4af37">بِسْمِ اللهِ — Tahap ٣</div>
        <h5 class="mb-0 fw-bold" style="color:#d4af37"><i class="bi bi-book-fill"></i> Situasi & Kondisi Madrasah</h5>
        <h4 class="fw-bold mb-0" style="color:#fff">Kurikulum & Bahasa</h4>
    </div>
    <div class="text-end"><span class="username-badge" style="background:#fdf6e3;color:#0a3d1f;border-color:#d4af37">{{ auth()->user()->username ?? '00007' }}</span><div class="arab small mt-1" style="color:#d4af37">٣/٤</div></div>
</div>
@include('components.stepper', ['current'=>3])
@if(!empty($sudahAjukan) && !empty($existing))
<div class="alert d-flex gap-2 align-items-start mb-3" style="background:#fff8d6;border:2px solid #d4af37;color:#0a3d1f;border-radius:12px">
  <i class="bi bi-info-circle-fill mt-1" style="color:#b8941f;font-size:18px"></i>
  <div class="small" style="line-height:1.5"><strong>Mode Edit</strong> — sudah ada pengajuan {{ $existing->tahun }} ({{ $existing->pjgt_id }}). Menyimpan akan memperbarui, bukan duplikat. <a href="{{ route('permohonan.show',$existing) }}" style="color:var(--green);font-weight:700">Lihat</a></div>
</div>
@endif
<div class="card-form mt-0">
    <form method="POST" action="{{ route('permohonan.store3') }}">
        @csrf
        <div class="p-4">
            <h6 class="fw-bold mb-3">Situasi dan Kondisi Madrasah</h6>
            <div class="mb-3">
                <label class="form-label small">Situasi Madrasah</label>
                <input type="text" name="situasi_madrasah" value="{{ old('situasi_madrasah', $defaults['situasi_madrasah']) }}" class="form-control" style="max-width:520px;">
                <small class="text-muted">Contoh: PESANTREN</small>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small">Komunikasi Masyarakat Sekitar Berbahasa</label>
                    <input type="text" name="komunikasi_bahasa" value="{{ old('komunikasi_bahasa', $defaults['komunikasi_bahasa']) }}" class="form-control required" placeholder="INDONESIA">
                    <small class="text-muted">Madura, Inggris, Arab (Contoh)</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Lainnya</label>
                    <input type="text" name="komunikasi_lainnya" value="{{ old('komunikasi_lainnya', $data['komunikasi_lainnya'] ?? '') }}" class="form-control required" placeholder="lainnya">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small">Materi Pelajaran AQIDAH</label>
                    <input type="text" name="mapel_aqidah" value="{{ old('mapel_aqidah', $data['mapel_aqidah'] ?? '') }}" class="form-control required" placeholder="mapel AQIDAH">
                    <small class="text-muted">Contoh: Ihya Ulumuddin</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Materi Pelajaran FIQH</label>
                    <input type="text" name="mapel_fiqh" value="{{ old('mapel_fiqh', $data['mapel_fiqh'] ?? '') }}" class="form-control required" placeholder="mapel FIQH">
                    <small class="text-muted">Contoh: Fathul Wahhab</small>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small">Materi Pelajaran ILMU ALAT</label>
                    <input type="text" name="mapel_ilmu_alat" value="{{ old('mapel_ilmu_alat', $data['mapel_ilmu_alat'] ?? '') }}" class="form-control required" placeholder="mapel ILMU ALAT">
                    <small class="text-muted">Contoh: Alfiyah Ibn Malik</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Materi Pelajaran AL-QUR'AN</label>
                    <input type="text" name="mapel_quran" value="{{ old('mapel_quran', $data['mapel_quran'] ?? '') }}" class="form-control required" placeholder="mapel AL-QUR'AN">
                    <small class="text-muted">Contoh: Qur'ani / Tajwid</small>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label small">Materi Pelajaran AKHLAQ</label>
                <input type="text" name="mapel_akhlaq" value="{{ old('mapel_akhlaq', $data['mapel_akhlaq'] ?? '') }}" class="form-control required" placeholder="mapel AKHLAQ" style="max-width:520px;">
                <small class="text-muted">Contoh: Taklim Mutaallim</small>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small">Kegiatan Belajar Mengajar Berbahasa</label>
                    <input type="text" name="kbm_bahasa" value="{{ old('kbm_bahasa', $defaults['kbm_bahasa']) }}" class="form-control required" placeholder="INDONESIA">
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Lainnya</label>
                    <input type="text" name="kbm_lainnya" value="{{ old('kbm_lainnya', $data['kbm_lainnya'] ?? '') }}" class="form-control required" placeholder="lainnya">
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small">Guru Laki-laki</label>
                    <input type="text" name="guru_laki" value="{{ old('guru_laki', $data['guru_laki'] ?? '') }}" class="form-control required" placeholder="pria">
                    <small class="text-muted">Contoh: 19</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label small">Guru Perempuan</label>
                    <input type="text" name="guru_perempuan" value="{{ old('guru_perempuan', $data['guru_perempuan'] ?? '') }}" class="form-control required" placeholder="wanita">
                    <small class="text-muted">Contoh: 5</small>
                </div>
            </div>
        </div>
            @include('permohonan._custom_fields')
        </div>
        <div class="p-3 border-top d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#fdf6e3 0%, #fdf0c7 100%);border-top:2px solid #d4af37">
            <a href="{{ route('permohonan.step2') }}" class="btn-yellow"><i class="bi bi-arrow-left"></i> Tahap ٢</a>
            <span class="arab small" style="color:#0a3d1f">اقرأ باسم ربك — ٣/٤</span>
            <button type="submit" class="btn-green">Selanjutnya <i class="bi bi-arrow-right"></i> • Tahap ٤</button>
        </div>
    </form>
</div>
@endsection

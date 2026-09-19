@extends('layouts.app')
@section('title','Isi Laporan GT • TMTB & DAI')
@section('breadcrumb','Isi Laporan')
@section('content')
@php
  $madInd = \App\Models\PjgtLaporanGt::MADRASIYAH_INDIKATOR;
  $kesInd = \App\Models\PjgtLaporanGt::KEMASYARAKATAN_INDIKATOR;
  $pilihan = \App\Models\PjgtLaporanGt::PILIHAN;
@endphp
<div class="p-3 rounded-3 mb-3" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37">
  <div class="d-flex justify-content-between flex-wrap gap-2">
    <div>
 <div class="arab small" style="color:#d4af37">Isi Laporan</div>
      <h4 class="fw-bold mb-0" style="color:#fff"><i class="bi bi-pencil-square" style="color:#d4af37"></i> Checklist Laporan Kegiatan GT</h4>
      <div class="small" style="color:#fdf6e3;opacity:.8">Hanya GT yang ditugaskan di lembaga Anda (biasanya 1 GT) • Pilihan: Sangat Baik / Baik / Kurang • Bisa diisi kapan saja — apa aja (opsional)</div>
    </div>
    <div class="text-end">
      <span class="badge-pendaftaran" style="background:#fdf6e3;color:#0a3d1f">{{ $tahunAjaran }} • {{ $bulan }}</span>
      <div class="small mt-1" style="color:#d4af37">{{ $namaMadrasah }}</div>
    </div>
  </div>
</div>

<form method="POST" action="{{ route('pjgt.laporan.store') }}" class="card-form" style="border:2px solid #d4af37">
  @csrf
  <div class="p-4">
    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <label class="form-label fw-bold" style="color:var(--green)">Pilih GT di Lembaga Anda <span class="text-danger">*</span></label>
        <select name="gt_user_id" class="form-select @error('gt_user_id') is-invalid @enderror" required>
          <option value="">-- pilih GT --</option>
          @foreach($gtList as $gt)
            <option value="{{ $gt->id }}" {{ old('gt_user_id')==$gt->id?'selected':'' }}>{{ $gt->name }} — {{ $gt->username }}</option>
          @endforeach
        </select>
        @error('gt_user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        <small class="text-muted">Biasanya hanya 1 GT. Pilih GT yang ditugaskan.</small>
      </div>
      <div class="col-md-3">
        <label class="form-label fw-bold" style="color:var(--green)">Periode <span class="text-danger">*</span></label>
        <input type="month" name="periode" value="{{ old('periode',$periode) }}" class="form-control @error('periode') is-invalid @enderror" required>
        @error('periode')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-3">
        <label class="form-label fw-bold" style="color:var(--green)">Madrasah</label>
        <input type="text" value="{{ $namaMadrasah }}" class="form-control" disabled>
        <input type="hidden" name="nama_madrasah" value="{{ $namaMadrasah }}">
      </div>
    </div>

    {{-- Madrasiyah --}}
    <div class="mb-4 p-3 rounded-3" style="background:#fffdf0;border:2px solid #d4af37">
      <h6 class="fw-bold d-flex align-items-center gap-2" style="color:#0a3d1f"><span class="badge" style="background:#0a3d1f;color:#d4af37">A</span> Madrasiyah</h6>
      <div class="table-responsive">
        <table class="table table-bordered small mb-0 align-middle" style="border-color:#e8d9a0">
          <thead style="background:#fdf0c7;color:#0a3d1f"><tr><th style="width:30px">No</th><th>Indikator</th><th style="width:300px" class="text-center">Sangat Baik / Baik / Kurang</th><th>Catatan</th></tr></thead>
          <tbody>
            @foreach($madInd as $no=>$ind)
            <tr>
              <td class="text-center fw-bold" style="color:#0a3d1f">{{ $no }}</td>
              <td style="color:#0a3d1f">{{ $ind }}</td>
              <td>
                <div class="d-flex gap-2 justify-content-center">
                  @foreach($pilihan as $p)
                  <label class="d-flex align-items-center gap-1 small" style="cursor:pointer;white-space:nowrap">
                    <input type="radio" name="madrasiyah[{{ $no }}][nilai]" value="{{ $p }}" {{ old("madrasiyah.$no.nilai")===$p?'checked':'' }}> {{ $p }}
                  </label>
                  @endforeach
                </div>
                @error("madrasiyah.$no.nilai")<div class="text-danger small">{{ $message }}</div>@enderror
              </td>
              <td><input type="text" name="madrasiyah[{{ $no }}][catatan]" value="{{ old("madrasiyah.$no.catatan") }}" class="form-control form-control-sm" placeholder="opsional — bisa diisi apa aja"></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- Kemasyarakatan --}}
    <div class="mb-4 p-3 rounded-3" style="background:#fdf6e3;border:2px solid #d4af37">
      <h6 class="fw-bold d-flex align-items-center gap-2" style="color:#0a3d1f"><span class="badge" style="background:#d4af37;color:#0a3d1f">B</span> Kemasyarakatan</h6>
      <div class="table-responsive">
        <table class="table table-bordered small mb-0 align-middle" style="border-color:#e8d9a0">
          <thead style="background:#0a3d1f;color:#d4af37"><tr><th style="width:30px">No</th><th>Indikator</th><th style="width:300px" class="text-center">Sangat Baik / Baik / Kurang</th><th>Catatan</th></tr></thead>
          <tbody>
            @foreach($kesInd as $no=>$ind)
            <tr>
              <td class="text-center fw-bold" style="color:#0a3d1f">{{ $no }}</td>
              <td style="color:#0a3d1f">{{ $ind }}</td>
              <td>
                <div class="d-flex gap-2 justify-content-center">
                  @foreach($pilihan as $p)
                  <label class="d-flex align-items-center gap-1 small" style="cursor:pointer;white-space:nowrap">
                    <input type="radio" name="kemasyarakatan[{{ $no }}][nilai]" value="{{ $p }}" {{ old("kemasyarakatan.$no.nilai")===$p?'checked':'' }}> {{ $p }}
                  </label>
                  @endforeach
                </div>
                @error("kemasyarakatan.$no.nilai")<div class="text-danger small">{{ $message }}</div>@enderror
              </td>
              <td><input type="text" name="kemasyarakatan[{{ $no }}][catatan]" value="{{ old("kemasyarakatan.$no.catatan") }}" class="form-control form-control-sm" placeholder="opsional — bisa diisi apa aja"></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold" style="color:var(--green)">Catatan Umum</label>
      <textarea name="catatan_umum" rows="3" class="form-control" placeholder="Catatan tambahan PJGT untuk GT periode ini (opsional)">{{ old('catatan_umum') }}</textarea>
    </div>
  </div>
  <div class="p-3 border-top d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#fdf6e3 0%, #fdf0c7 100%);border-top:2px solid #d4af37">
    <a href="{{ route('pjgt.laporan.index') }}" class="btn-yellow"><i class="bi bi-arrow-left"></i> Kembali</a>
    <button type="submit" class="btn-green"><i class="bi bi-send-check"></i> Kirim Laporan</button>
  </div>
</form>
@endsection

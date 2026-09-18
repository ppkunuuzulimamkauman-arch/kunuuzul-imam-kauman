@extends('layouts.app')
@section('title','Buat Pengaduan GT • TMTB & DAI')
@section('breadcrumb','Buat Pengaduan')
@section('content')
<div class="p-3 rounded-3 mb-3" style="background:linear-gradient(135deg,#7a0a0a 0%, #a81414 100%);color:#fff;border:2px solid #d4af37">
  <div>
    <div class="arab small" style="color:#d4af37">تقديم شكوى — Buat Pengaduan</div>
    <h4 class="fw-bold mb-0" style="color:#fff"><i class="bi bi-flag-fill" style="color:#d4af37"></i> @if((auth()->user()->role ?? '')==='gt') Pengaduan GT ke Admin @else Pengaduan GT di Lembaga @endif</h4>
    <div class="small" style="color:#fff;opacity:.85">@if((auth()->user()->role ?? '')==='gt') Ceritakan apa yang Anda alami selama di tempat tugas — hal tak terduga untuk diadukan ke Admin @else Lengkapi seperti form: A. Data Pelapor — B. Data Terlapor — C. Uraian Pelanggaran — D. Bukti — E. Tindak Lanjut @endif</div>
  </div>
</div>

<form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data" class="card-form" style="border:2px solid #d4af37;max-width:800px;margin:0 auto">
  @csrf
  <div class="p-4">
    {{-- A. Data Pelapor --}}
    <h6 class="fw-bold p-2 rounded-2 mb-3" style="background:#7a0a0a;color:#fff"><span class="badge" style="background:#d4af37;color:#7a0a0a">A</span> Data Pelapor</h6>
    <div class="row g-3 mb-4">
      <div class="col-12">
        <label class="form-label fw-bold" style="color:#7a0a0a">Nama <span class="text-danger">*</span></label>
        <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor', auth()->user()->name) }}" class="form-control @error('nama_pelapor') is-invalid @enderror" placeholder="Nama pelapor" required>
        @error('nama_pelapor')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold" style="color:#7a0a0a">Status <span class="text-danger">*</span></label>
        <select name="status_pelapor" class="form-select @error('status_pelapor') is-invalid @enderror" required>
          <option value="">-- pilih --</option>
          @foreach(\App\Models\Pengaduan::STATUS_PELAPOR as $s)
            <option value="{{ $s }}" {{ old('status_pelapor')===$s?'selected':'' }}>{{ $s }}</option>
          @endforeach
        </select>
        <small class="text-muted">(Masyarakat / Lembaga / SPGT / Lainnya)</small>
        @error('status_pelapor')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold" style="color:#7a0a0a">Kontak <span class="text-danger">*</span></label>
        <input type="text" name="kontak_pelapor" value="{{ old('kontak_pelapor') }}" class="form-control @error('kontak_pelapor') is-invalid @enderror" placeholder="No HP / WA / Email" required>
        @error('kontak_pelapor')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
    </div>

    @if((auth()->user()->role ?? '')==='gt')
    {{-- GT — SIMPLE --}}
    <div class="alert d-flex gap-2 mb-4" style="background:#e8f5e9;border:1.5px solid #22c55e;color:#0a3d1f;border-radius:10px">
      <i class="bi bi-person-badge mt-1" style="color:#198754"></i>
      <div class="small" style="line-height:1.5"><strong>Mode GT — Sederhana</strong> — tuliskan aduan Anda selama di tempat tugas untuk diadukan ke Admin. Cukup isi form simpel di bawah.</div>
    </div>
    <div class="mb-3">
      <label class="form-label fw-bold" style="color:#0a3d1f">Tempat Tugas</label>
      <input type="text" name="tempat_tugas" value="{{ old('tempat_tugas', $namaMadrasah) }}" class="form-control" placeholder="Madrasah / lembaga tempat Anda ditugaskan">
    </div>
    <div class="mb-3">
      <label class="form-label fw-bold" style="color:#0a3d1f">Judul Aduan <span class="text-danger">*</span></label>
      <input type="text" name="judul" value="{{ old('judul') }}" class="form-control @error('judul') is-invalid @enderror" placeholder="Contoh: Kesulitan air bersih di asrama" required>
      @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label fw-bold" style="color:#0a3d1f">Apa yang Dialami <span class="text-danger">*</span></label>
      <textarea name="kronologi" rows="4" class="form-control @error('kronologi') is-invalid @enderror" placeholder="Ceritakan hal tak terduga yang ingin Anda adukan ke Admin..." required>{{ old('kronologi') }}</textarea>
      @error('kronologi')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <label class="form-label fw-bold">Tanggal Kejadian</label>
        <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}" class="form-control">
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold">Foto (opsional)</label>
        <input type="file" name="bukti_foto" accept="image/jpeg,image/png,image/jpg" class="form-control @error('bukti_foto') is-invalid @enderror">
        @error('bukti_foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
    </div>
    @else
    {{-- B. Data Terlapor --}}
    <h6 class="fw-bold p-2 rounded-2 mb-3" style="background:#0a3d1f;color:#d4af37"><span class="badge" style="background:#d4af37;color:#0a3d1f">B</span> Data Terlapor</h6>
    <div class="row g-3 mb-4">
      <div class="col-12">
        <label class="form-label fw-bold" style="color:#0a3d1f">Pilih GT Terlapor <span class="text-danger">*</span></label>
        <select name="gt_user_id" class="form-select @error('gt_user_id') is-invalid @enderror" required>
          <option value="">-- pilih GT di lembaga (biasanya 1 GT) --</option>
          @foreach($gtList as $gt)
            <option value="{{ $gt->id }}" {{ old('gt_user_id')==$gt->id?'selected':'' }}>{{ $gt->name }} — {{ $gt->username }}</option>
          @endforeach
        </select>
        @error('gt_user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-12">
        <label class="form-label fw-bold" style="color:#0a3d1f">Tempat Tugas</label>
        <input type="text" name="tempat_tugas" value="{{ old('tempat_tugas', $namaMadrasah) }}" class="form-control" placeholder="Madrasah / lembaga tempat GT ditugaskan">
      </div>
    </div>

    {{-- C. Uraian Pelanggaran --}}
    <h6 class="fw-bold p-2 rounded-2 mb-3" style="background:#d4af37;color:#0a3d1f"><span class="badge" style="background:#0a3d1f;color:#d4af37">C</span> Uraian Pelanggaran</h6>
    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <label class="form-label fw-bold">Tanggal Kejadian</label>
        <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}" class="form-control @error('tanggal_kejadian') is-invalid @enderror">
        @error('tanggal_kejadian')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold">Lokasi</label>
        <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="form-control" placeholder="Lokasi kejadian">
      </div>
      <div class="col-12">
        <label class="form-label fw-bold">Jenis Pelanggaran</label>
        <div class="d-flex gap-3">
          @foreach(\App\Models\Pengaduan::JENIS_PELANGGARAN as $j)
          <label class="d-flex align-items-center gap-1" style="cursor:pointer"><input type="radio" name="jenis_pelanggaran" value="{{ $j }}" {{ old('jenis_pelanggaran')===$j?'checked':'' }}> {{ $j }}</label>
          @endforeach
        </div>
        <small class="text-muted">(Ringan / Sedang / Berat)</small>
      </div>
      <div class="col-12">
        <label class="form-label fw-bold">Kronologi <span class="text-danger">*</span></label>
        <textarea name="kronologi" rows="4" class="form-control @error('kronologi') is-invalid @enderror" placeholder="Ceritakan kronologi kejadian..." required>{{ old('kronologi') }}</textarea>
        @error('kronologi')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
    </div>

    {{-- D. Bukti Pendukung --}}
    <h6 class="fw-bold p-2 rounded-2 mb-3" style="background:#fdf6e3;color:#0a3d1f;border:1.5px solid #d4af37">D. Bukti Pendukung <span class="small fw-normal">(opsional)</span></h6>
    <div class="mb-4">
      <input type="file" name="bukti_foto" accept="image/jpeg,image/png,image/jpg" class="form-control @error('bukti_foto') is-invalid @enderror">
      @error('bukti_foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
      <small class="text-muted">Opsional — foto JPG/PNG maks 2MB jika ada bukti</small>
    </div>

    {{-- E. Tindak Lanjut --}}
    <h6 class="fw-bold p-2 rounded-2 mb-3" style="background:#fdf6e3;color:#0a3d1f;border:1.5px solid #d4af37">E. Tindak Lanjut yang Diharapkan:</h6>
    <div class="mb-4">
      <textarea name="tindak_lanjut" rows="2" class="form-control" placeholder="Harapan tindak lanjut...">{{ old('tindak_lanjut') }}</textarea>
    </div>
    @endif

    <div class="p-3 rounded-3 mb-3" style="background:#fdf6e3;border:1.5px dashed #d4af37;color:#5d4037">
      <div class="small">Demikian laporan ini saya buat dengan sebenar-benarnya.</div>
      <div class="row g-2 mt-2">
        <div class="col-md-6">
          <label class="form-label small fw-bold">Tempat, Tanggal</label>
          <input type="text" name="tempat_tanggal" value="{{ old('tempat_tanggal', now()->locale('id')->isoFormat('D MMMM YYYY')) }}" class="form-control form-control-sm" placeholder="Bondowoso, 18 September 2026">
        </div>
      </div>
    </div>
  </div>
  <div class="p-3 border-top d-flex justify-content-between" style="background:#fdf6e3;border-top:2px solid #d4af37">
    <a href="{{ route('pengaduan.index') }}" class="btn-yellow"><i class="bi bi-arrow-left"></i> Kembali</a>
    <button class="btn-green" style="background:#7a0a0a;color:#fff;border-color:#d4af37"><i class="bi bi-send-fill"></i> Kirim Pengaduan</button>
  </div>
</form>

@endsection

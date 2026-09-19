@extends('layouts.app')
@section('title','Detail • '.$permohonan->pjgt_id)
@section('breadcrumb','Detail Permohonan')
@section('content')
<div class="p-3 rounded-3 mb-3" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37">
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
 <div class="arab small" style="color:#d4af37">{{ $permohonan->pjgt_id }}</div>
      <h4 class="fw-bold mb-0" style="color:#fff">{{ $permohonan->nama_madrasah }} • {{ $permohonan->pjgt_nama }}</h4>
      <div class="small" style="color:#fdf6e3;opacity:0.8">{{ $permohonan->alamat_lengkap }} • {{ $permohonan->tahun }}</div>
    </div>
    <div class="d-flex gap-2">
      <a href="{{ route('permohonan.lama') }}" class="btn btn-sm" style="background:var(--cream2);border:1px solid #d4af37;color:#0a3d1f">Kembali</a>
      <a href="{{ route('permohonan.edit', $permohonan) }}" class="btn btn-sm" style="background:#d4af37;color:#0a3d1f;border:1px solid #0a3d1f;font-weight:700"><i class="bi bi-pencil"></i> Edit</a>
    </div>
  </div>
</div>

<div class="row g-3">
  <div class="col-lg-8">
    <div class="card-form p-0">
      <div class="card-form-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-book"></i> Data Lengkap</span>
        <span class="badge-pendaftaran">{{ $permohonan->pjgt_id }} • {{ $permohonan->status }}</span>
      </div>
      <div class="p-3">
        @php $fields=['nama_madrasah'=>'Madrasah','nama_pesantren'=>'Pesantren','provinsi'=>'Provinsi','kabupaten'=>'Kabupaten','kecamatan'=>'Kecamatan','desa'=>'Desa','jalan_dusun'=>'Jalan','telepon'=>'Telepon','email'=>'Email','pengasuh'=>'Pengasuh','pjgt'=>'PJGT','situasi_madrasah'=>'Situasi','guru_laki'=>'Guru L','guru_perempuan'=>'Guru P','wil'=>'Wil','rapot'=>'Rapot','butuh_gt'=>'Butuh GT']; @endphp
        <div class="row g-2 small">
          @foreach($fields as $k=>$l)
          <div class="col-md-6 d-flex justify-content-between border-bottom py-1" style="border-color:#e8d9a0"><span style="color:#8a7a3a">{{ $l }}</span><strong style="color:#0a3d1f">{{ $permohonan->$k ?? '-' }}</strong></div>
          @endforeach
        </div>
        <div class="mt-3 p-3 rounded" style="background:#fdf6e3;border:1px solid #d4af37">
          <div class="small fw-bold" style="color:#0a3d1f">Jumlah Santri</div>
          <div class="small" style="color:#5d4037">Sifir {{ $permohonan->sifir_putra }}/{{ $permohonan->sifir_putri }} • Ibtidaiyah 1 {{ $permohonan->ibtidaiyah_1_putra }}/{{ $permohonan->ibtidaiyah_1_putri }} • Tsanawiyah 3 {{ $permohonan->tsanawiyah_3_putra }}/{{ $permohonan->tsanawiyah_3_putri }} • Mukim {{ $permohonan->mukim_putra }}/{{ $permohonan->mukim_putri }}</div>
        </div>
        @if($permohonan->extra_answers)
        <div class="mt-3 p-3 rounded" style="background:#fffdf0;border:2px dashed #d4af37">
          <div class="small fw-bold mb-2" style="color:#0a3d1f"><i class="bi bi-patch-question-fill" style="color:#d4af37"></i> Jawaban Tambahan</div>
          @foreach($permohonan->extra_answers as $k=>$v)
          <div class="d-flex justify-content-between border-bottom py-1 small" style="border-color:#e8d9a0"><span style="color:#8a7a3a">{{ str_replace('custom_','',str_replace('_',' ',$k)) }}</span><strong style="color:#0a3d1f">{{ $v }}</strong></div>
          @endforeach
        </div>
        @endif
        @if($permohonan->dokumen_path)
        <div class="mt-3"><a href="{{ Storage::url($permohonan->dokumen_path) }}" target="_blank" class="btn btn-sm" style="background:#0a3d1f;color:#d4af37;border:1px solid #d4af37"><i class="bi bi-file-earmark-pdf"></i> Lihat Dokumen</a></div>
        @endif
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card-form p-3" style="background:#fffdf0">
      <h6 class="fw-bold" style="color:#0a3d1f"><i class="bi bi-shield-check" style="color:#d4af37"></i> Status Approval</h6>
      <div class="mt-2">
        <div class="p-2 rounded text-center mb-2" style="background:{{$permohonan->status=='Diterima'?'#198754':($permohonan->status=='Proses'?'#fdf0c7':'#dc3545')}};color:{{$permohonan->status=='Proses'?'#0a3d1f':'#fff'}};border:2px solid #0a3d1f;font-weight:800">{{ $permohonan->status }}</div>
        @if($permohonan->catatan_admin)<div class="small p-2 rounded" style="background:#fdf6e3;border:1px solid #d4af37;color:#0a3d1f"><strong>Catatan:</strong> {{ $permohonan->catatan_admin }}</div>@endif
        @if($permohonan->approved_by)<div class="small mt-2" style="color:#8a7a3a">Oleh {{ $permohonan->approved_by }} • {{ $permohonan->approved_at }}</div>@endif
      </div>
      @if(auth()->user()->role=='admin')
      <form method="POST" action="{{ route('permohonan.approve', $permohonan) }}" class="mt-3">
        @csrf
        <label class="small fw-bold" style="color:#0a3d1f">Ubah Status</label>
        <select name="status" class="form-select form-select-sm mb-2" style="border:1px solid #d4af37">
          <option value="Proses" {{ $permohonan->status=='Proses'?'selected':'' }}>Proses</option>
          <option value="Diterima" {{ $permohonan->status=='Diterima'?'selected':'' }}>Diterima</option>
          <option value="Ditolak" {{ $permohonan->status=='Ditolak'?'selected':'' }}>Ditolak</option>
        </select>
        <textarea name="catatan_admin" class="form-control form-control-sm mb-2" placeholder="catatan..." style="border:1px solid #d4af37">{{ $permohonan->catatan_admin }}</textarea>
        <button class="btn btn-sm w-100" style="background:#0a3d1f;color:#d4af37;border:1px solid #d4af37;font-weight:700">Simpan Status</button>
      </form>
      @endif
      <hr style="border-color:#d4af37">
      <form method="POST" action="{{ route('permohonan.dokumen', $permohonan) }}" enctype="multipart/form-data">
        @csrf
        <label class="small fw-bold" style="color:#0a3d1f">Upload Dokumen (PDF/JPG max 2MB)</label>
        <input type="file" name="dokumen" class="form-control form-control-sm mb-2" style="border:1px solid #d4af37" required>
        <button class="btn btn-sm w-100" style="background:#d4af37;color:#0a3d1f;border:1px solid #0a3d1f;font-weight:700"><i class="bi bi-cloud-upload"></i> Upload</button>
      </form>
    </div>
  </div>
</div>
@endsection

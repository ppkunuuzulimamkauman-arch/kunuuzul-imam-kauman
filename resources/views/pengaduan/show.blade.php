@extends('layouts.app')
@section('title','Detail Pengaduan • TMTB & DAI')
@section('breadcrumb','Detail Pengaduan')
@section('content')
<div class="p-3 rounded-3 mb-3" style="background:linear-gradient(135deg,#7a0a0a 0%, #a81414 100%);color:#fff;border:2px solid #d4af37">
  <div class="d-flex justify-content-between flex-wrap gap-2">
    <div>
 <div class="arab small" style="color:#d4af37">Pengaduan</div>
      <h4 class="fw-bold mb-0" style="color:#fff">{{ $pengaduan->judul ?? $pengaduan->kronologi ? substr($pengaduan->kronologi,0,40).'...' : 'Pengaduan GT' }}</h4>
      <div class="small" style="color:#fff;opacity:.85">{{ $pengaduan->nama_madrasah }} • {{ $pengaduan->tempat_tugas ?? '' }}</div>
    </div>
    <div class="text-end">
      <span class="badge" style="background:{{$pengaduan->status==='Menunggu'?'#d4af37':($pengaduan->status==='Selesai'?'#198754':($pengaduan->status==='Ditolak'?'#dc3545':'#0a3d1f'))}};color:#fff;border:1px solid #fff">{{ $pengaduan->status }}</span>
      <div class="small mt-1" style="color:#d4af37">{{ $pengaduan->tanggal_kejadian?->locale('id')->isoFormat('D MMMM YYYY') ?? $pengaduan->created_at->locale('id')->isoFormat('D MMMM YYYY') }}</div>
      <div class="small" style="color:#fff">{{ $pengaduan->jenis_pelanggaran ?? $pengaduan->kategori }} • {{ $pengaduan->lokasi ?? '-' }}</div>
    </div>
  </div>
</div>

<div class="card-form" style="border:2px solid #d4af37">
  <div class="p-4">
    {{-- A --}}
    <h6 class="fw-bold p-2 rounded-2" style="background:#7a0a0a;color:#fff"><span class="badge" style="background:#d4af37;color:#7a0a0a">A</span> Data Pelapor</h6>
    <div class="row g-2 mb-3 small" style="color:#5d4037">
      <div class="col-md-4"><strong style="color:#7a0a0a">Nama:</strong> {{ $pengaduan->nama_pelapor ?? $pengaduan->pjgt->name ?? '-' }}</div>
      <div class="col-md-4"><strong style="color:#7a0a0a">Status:</strong> {{ $pengaduan->status_pelapor ?? '-' }} <span class="text-muted">(Masyarakat/Lembaga/SPGT/Lainnya)</span></div>
      <div class="col-md-4"><strong style="color:#7a0a0a">Kontak:</strong> {{ $pengaduan->kontak_pelapor ?? '-' }}</div>
    </div>
    {{-- B --}}
    <h6 class="fw-bold p-2 rounded-2" style="background:#0a3d1f;color:#d4af37"><span class="badge" style="background:#d4af37;color:#0a3d1f">B</span> Data Terlapor</h6>
    <div class="row g-2 mb-3 small" style="color:#5d4037">
      <div class="col-md-6"><strong style="color:#0a3d1f">Nama:</strong> {{ $pengaduan->nama_terlapor ?? $pengaduan->gt->name ?? '-' }}</div>
      <div class="col-md-6"><strong style="color:#0a3d1f">Tempat Tugas:</strong> {{ $pengaduan->tempat_tugas ?? $pengaduan->nama_madrasah ?? '-' }}</div>
    </div>
    {{-- C --}}
    <h6 class="fw-bold p-2 rounded-2" style="background:#d4af37;color:#0a3d1f"><span class="badge" style="background:#0a3d1f;color:#d4af37">C</span> Uraian Pelanggaran</h6>
    <div class="row g-2 mb-3 small" style="color:#5d4037">
      <div class="col-md-4"><strong>Tanggal Kejadian:</strong> {{ $pengaduan->tanggal_kejadian?->locale('id')->isoFormat('D MMMM YYYY') ?? '-' }}</div>
      <div class="col-md-4"><strong>Lokasi:</strong> {{ $pengaduan->lokasi ?? '-' }}</div>
      <div class="col-md-4"><strong>Jenis:</strong> <span class="badge" style="background:{{$pengaduan->jenis_pelanggaran==='Berat'?'#dc3545':($pengaduan->jenis_pelanggaran==='Sedang'?'#d4af37':'#0a3d1f')}};color:#fff">{{ $pengaduan->jenis_pelanggaran ?? '-' }}</span> <span class="text-muted">(Ringan/Sedang/Berat)</span></div>
      <div class="col-12"><strong>Kronologi:</strong><div class="p-2 rounded-2 mt-1" style="background:#fff8f8;border:1.5px solid #e8d9a0;white-space:pre-wrap">{{ $pengaduan->kronologi ?? $pengaduan->deskripsi ?? '-' }}</div></div>
    </div>
    {{-- D --}}
    <h6 class="fw-bold p-2 rounded-2" style="background:#fdf6e3;color:#0a3d1f;border:1.5px solid #d4af37">D. Bukti Pendukung <span class="small fw-normal">(opsional)</span></h6>
    <div class="p-2 rounded-2 mb-3" style="background:#fff;border:1.5px solid #e8d9a0;color:#5d4037">
      @php $foto = $pengaduan->bukti_foto_path ?? $pengaduan->bukti_pendukung; @endphp
      @if($foto && preg_match('/\.(jpg|jpeg|png|webp)$/i', $foto))
        <img src="{{ asset('storage/'.$foto) }}" alt="Bukti Foto" style="max-width:100%;max-height:420px;border-radius:12px;border:2px solid #d4af37;object-fit:contain">
        <div class="small mt-2"><a href="{{ asset('storage/'.$foto) }}" target="_blank" style="color:#7a0a0a;font-weight:700"><i class="bi bi-box-arrow-up-right"></i> Buka foto penuh</a></div>
      @elseif($foto)
        <div style="white-space:pre-wrap">{{ $foto }}</div>
      @else
        -
      @endif
    </div>
    {{-- E --}}
    <h6 class="fw-bold p-2 rounded-2" style="background:#fdf6e3;color:#0a3d1f;border:1.5px solid #d4af37">E. Tindak Lanjut yang Diharapkan:</h6>
    <div class="p-2 rounded-2 mb-3" style="background:#fff;border:1.5px solid #e8d9a0;white-space:pre-wrap;color:#5d4037">{{ $pengaduan->tindak_lanjut ?? '-' }}</div>

    <div class="p-2 rounded-2 mb-3 small" style="background:#fdf6e3;border:1.5px dashed #d4af37;color:#5d4037">
      Demikian laporan ini saya buat dengan sebenar-benarnya.<br>
      <strong>Tempat, Tanggal:</strong> {{ $pengaduan->tempat_tanggal ?? $pengaduan->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
    </div>

    @if($pengaduan->tanggapan_admin)
    <div class="p-3 rounded-3 mb-3" style="background:#e8f5e9;border:1.5px solid #22c55e">
      <strong style="color:#0a3d1f">Tanggapan Admin:</strong><br>
      <div style="color:#0a3d1f">{{ $pengaduan->tanggapan_admin }}</div>
    </div>
    @endif
  </div>
  @if((auth()->user()->role ?? '') === 'admin')
  <form method="POST" action="{{ route('pengaduan.status',$pengaduan) }}" class="p-3" style="background:#fdf6e3;border-top:2px solid #d4af37">
    @csrf
    <div class="row g-2 align-items-end">
      <div class="col-md-4">
        <label class="form-label small fw-bold" style="color:#7a0a0a">Ubah Status</label>
        <select name="status" class="form-select form-select-sm">
          @foreach(\App\Models\Pengaduan::STATUS as $s)
            <option value="{{ $s }}" {{ $pengaduan->status===$s?'selected':'' }}>{{ $s }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label small fw-bold" style="color:#7a0a0a">Tanggapan</label>
        <input type="text" name="tanggapan_admin" value="{{ old('tanggapan_admin',$pengaduan->tanggapan_admin) }}" class="form-control form-control-sm" placeholder="Tanggapan admin">
      </div>
      <div class="col-md-2">
        <button class="btn btn-sm w-100" style="background:#0a3d1f;color:#d4af37;border:1px solid #d4af37;font-weight:700"><i class="bi bi-check-lg"></i> Update</button>
      </div>
    </div>
  </form>
  @endif
  <div class="p-3 border-top d-flex gap-2" style="background:#fdf6e3">
    <a href="{{ route('pengaduan.index') }}" class="btn-yellow"><i class="bi bi-arrow-left"></i> Kembali</a>
    <button onclick="window.print()" class="btn-green"><i class="bi bi-printer"></i> Cetak</button>
  </div>
</div>
@endsection

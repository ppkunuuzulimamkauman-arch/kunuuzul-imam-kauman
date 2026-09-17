@extends('layouts.app')
@section('title','Kegiatan - Guru Tugas')
@section('breadcrumb','Kegiatan')
@section('content')
<div class="p-3 mb-3 rounded-3" style="background:linear-gradient(135deg,#0a3d1f,#0f5a2e);color:#fff;border:2px solid var(--gold)">
  <div class="small" style="color:#d4af37">Kegiatan penempatan Diterima</div>
  <h4 class="fw-bold mb-0">Kegiatan Guru Tugas</h4>
  <div class="small" style="opacity:.8">Daftar madrasah tempat tugas aktif</div>
</div>

<div class="card-form">
  <div class="card-form-header d-flex justify-content-between align-items-center">
    <span><i class="bi bi-activity" style="color:var(--gold)"></i> Daftar Kegiatan ({{ $tugas->total() }})</span>
    <a href="{{ route('dashboard') }}" class="btn btn-sm" style="background:var(--gold);color:var(--green);border-radius:20px;font-weight:700">Dashboard</a>
  </div>
  <div class="table-responsive d-none d-md-block">
    <table class="table table-hover mb-0 small align-middle">
      <thead style="background:var(--cream2);color:var(--green)"><tr><th>ID</th><th>Madrasah / Lokasi</th><th>PJGT</th><th>Butuh</th><th>Aksi</th></tr></thead>
      <tbody>
        @forelse($tugas as $p)
        <tr>
          <td><span class="badge-pendaftaran">{{ $p->pjgt_id }}</span></td>
          <td><div class="fw-bold" style="color:var(--green)">{{ $p->nama_madrasah }}</div><div style="font-size:11px;color:#5d4037">{{ $p->desa ?? '' }} • {{ $p->kecamatan ?? '' }} • {{ $p->kabupaten ?? '' }} • {{ $p->wil }}</div></td>
          <td class="small">{{ $p->pjgt_nama }}<br><span style="color:#8a7a3a">{{ $p->telepon ?? '-' }}</span></td>
          <td><span class="badge" style="background:var(--gold);color:var(--green)">{{ $p->butuh_gt }} GT</span></td>
          <td><a href="{{ route('permohonan.show',$p) }}" class="btn btn-sm" style="background:var(--green);color:var(--gold);border-radius:20px">Detail</a></td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center py-3">Belum ada kegiatan.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="d-md-none p-2">
    @forelse($tugas as $p)
    <div class="p-3 mb-2 rounded-3" style="background:#fff;border:1.5px solid #e8d9a0;border-left:4px solid #198754">
      <div class="d-flex justify-content-between"><span class="badge-pendaftaran">{{ $p->pjgt_id }}</span><span class="badge" style="background:var(--gold);color:var(--green)">{{ $p->butuh_gt }} GT</span></div>
      <div class="fw-bold mt-1" style="color:var(--green)">{{ $p->nama_madrasah }}</div>
      <div class="small" style="color:#5d4037">{{ $p->desa ?? '' }} • {{ $p->kecamatan ?? '' }} • {{ $p->kabupaten ?? '' }}</div>
      <a href="{{ route('permohonan.show',$p) }}" class="btn btn-sm w-100 mt-2" style="background:var(--green);color:var(--gold);border-radius:10px">Detail</a>
    </div>
    @empty
    <div class="text-center small py-3">Belum ada kegiatan.</div>
    @endforelse
  </div>
  <div class="p-3" style="background:#fdf6e3;border-top:2px solid #d4af37">{{ $tugas->links() }}</div>
</div>
@endsection

@extends('layouts.app')
@section('title','Laporan - TMTB KIK')
@section('breadcrumb','Laporan')
@section('content')
<div class="p-3 p-md-4 rounded-4 mb-3 position-relative overflow-hidden" style="background:linear-gradient(135deg,#0a3d1f 0%,#0f5a2e 60%,#083d1e 100%);color:#fdf6e3;border:1px solid rgba(212,175,55,.4);box-shadow:0 12px 32px rgba(6,43,21,.3)">
  <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#d4af37,#f4e2a0,#d4af37)"></div>
  <div style="position:absolute;right:-30px;top:-30px;width:140px;height:140px;background:radial-gradient(circle,rgba(212,175,55,.25),transparent 70%);border-radius:50%"></div>
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 position-relative">
    <div>
 <div class="arab small" style="color:#d4af37">Laporan</div>
      <h4 class="fw-bold mb-1" style="color:#fff;font-size:clamp(18px,5vw,22px)"><i class="bi bi-megaphone-fill" style="color:#d4af37"></i> Laporan Permohonan</h4>
      <div class="small" style="opacity:.8">PP KUNUUZUL IMAM KAUMAN • 1448/1449 H • {{ $total }} data sesuai filter</div>
    </div>
    <div class="d-flex gap-2 flex-wrap">
      <a href="{{ route('permohonan.export', request()->query()) }}" class="btn btn-sm" style="background:#d4af37;color:#0a3d1f;border-radius:50px;font-weight:800"><i class="bi bi-file-excel"></i> Export Excel</a>
      <button onclick="window.print()" class="btn btn-sm d-none d-md-inline" style="background:#fff;color:#0a3d1f;border-radius:50px"><i class="bi bi-printer"></i> Cetak</button>
    </div>
  </div>
</div>

<form method="GET" class="card-form p-3 mb-3">
  <div class="row g-2">
    <div class="col-6 col-md-2">
      <label class="form-label">Tahun</label>
      <select name="tahun" class="form-select">
        <option value="">Semua</option>
        @foreach($tahunList as $t)
        <option value="{{ $t }}" @selected($tahun == $t)>{{ $t }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-6 col-md-2">
      <label class="form-label">Status</label>
      <select name="status" class="form-select">
        <option value="">Semua</option>
        @foreach(['Proses','Diterima','Ditolak'] as $s)
        <option value="{{ $s }}" @selected($status == $s)>{{ $s }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-6 col-md-2">
      <label class="form-label">Wil</label>
      <select name="wil" class="form-select">
        <option value="">Semua</option>
        @foreach($wilList as $w)
        <option value="{{ $w }}" @selected($wil == $w)>{{ $w }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-12 col-md-4">
      <label class="form-label">Cari</label>
      <input type="text" name="search" value="{{ $search }}" placeholder="PJGT / Madrasah / ID" class="form-control">
    </div>
    <div class="col-12 col-md-2 d-flex align-items-end gap-1">
      <button class="btn-green flex-fill" style="min-height:44px"><i class="bi bi-search"></i> Filter</button>
      <a href="{{ route('laporan') }}" class="btn btn-sm" style="background:#fff;border:1.5px solid var(--gold);color:var(--green);border-radius:10px;min-height:44px;display:flex;align-items:center">Reset</a>
    </div>
  </div>
</form>

<div class="row g-2 g-md-3 mb-3">
  <div class="col-12 col-md-3">
    <div class="card h-100 overflow-hidden" style="border:none;border-radius:16px;background:linear-gradient(135deg,#0a3d1f,#14924a);color:#fff;box-shadow:0 8px 24px rgba(10,61,31,.25)">
      <div class="card-body p-3 d-flex align-items-center gap-3">
        <div style="width:52px;height:52px;border-radius:14px;background:rgba(212,175,55,.2);border:1.5px solid #d4af37;display:flex;align-items:center;justify-content:center;font-size:22px;color:#f4e2a0;flex-shrink:0"><i class="bi bi-journals"></i></div>
        <div>
          <div class="small fw-bold" style="color:#f4e2a0;letter-spacing:1px;font-size:11px">TOTAL</div>
          <div class="fw-bold" style="font-size:28px;line-height:1">{{ $total }}</div>
          <div class="small" style="opacity:.75">permohonan</div>
        </div>
      </div>
    </div>
  </div>
  @foreach($byStatus as $st => $jml)
  @php
    $pct = $total > 0 ? round($jml / $total * 100) : 0;
    $bar = $st == 'Diterima' ? 'linear-gradient(90deg,#198754,#22c55e)' : ($st == 'Ditolak' ? 'linear-gradient(90deg,#dc3545,#ff6b6b)' : 'linear-gradient(90deg,#d4af37,#f4e2a0)');
    $icon = $st == 'Diterima' ? 'bi-check-circle-fill' : ($st == 'Ditolak' ? 'bi-x-circle-fill' : 'bi-hourglass-split');
    $color = $st == 'Diterima' ? '#198754' : ($st == 'Ditolak' ? '#dc3545' : '#b8941f');
  @endphp
  <div class="col-6 col-md-3">
    <div class="card h-100" style="border:1.5px solid #e8d9a0;border-radius:16px;background:#fff;box-shadow:0 4px 16px rgba(0,0,0,.05)">
      <div class="card-body p-3">
        <div class="d-flex align-items-center gap-2 mb-1">
          <i class="bi {{ $icon }}" style="color:{{ $color }};font-size:18px"></i>
          <span class="small fw-bold" style="color:#5d4037">{{ $st }}</span>
          <span class="ms-auto small fw-bold" style="color:{{ $color }}">{{ $pct }}%</span>
        </div>
        <div class="fw-bold" style="font-size:24px;color:{{ $color }};line-height:1">{{ $jml }}</div>
        <div class="mt-2" style="height:6px;border-radius:10px;background:#f1ecd8;overflow:hidden"><div style="height:100%;width:{{ $pct }}%;background:{{ $bar }};border-radius:10px"></div></div>
      </div>
    </div>
  </div>
  @endforeach
  @php
    $rapotA = $byRapot['A'] ?? 0;
    $rapotAPct = $total > 0 ? round($rapotA / $total * 100) : 0;
  @endphp
  <div class="col-6 col-md-3">
    <div class="card h-100" style="border:1.5px solid #0a3d1f;border-radius:16px;background:linear-gradient(135deg,#fffdf0,#fdf0c7);box-shadow:0 4px 16px rgba(10,61,31,.08)">
      <div class="card-body p-3">
        <div class="d-flex align-items-center gap-2 mb-1">
          <i class="bi bi-award-fill" style="color:#b8941f;font-size:18px"></i>
          <span class="small fw-bold" style="color:#5d4037">Rapot A</span>
          <span class="ms-auto small fw-bold" style="color:#b8941f">{{ $rapotAPct }}%</span>
        </div>
        <div class="fw-bold" style="font-size:24px;color:#0a3d1f;line-height:1">{{ $rapotA }}</div>
        <div class="mt-2" style="height:6px;border-radius:10px;background:#f1ecd8;overflow:hidden"><div style="height:100%;width:{{ $rapotAPct }}%;background:linear-gradient(90deg,#0a3d1f,#d4af37);border-radius:10px"></div></div>
      </div>
    </div>
  </div>
</div>

<div class="card-form">
  <div class="card-form-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-table" style="color:var(--gold)"></i> Detail Laporan ({{ $list->total() }})</span>
    <span class="small" style="color:#8a7a3a">Hal {{ $list->currentPage() }} / {{ $list->lastPage() }}</span>
  </div>
  <div class="table-responsive d-none d-md-block">
    <table class="table table-hover mb-0 small align-middle">
      <thead style="background:var(--cream2);color:var(--green);position:sticky;top:0"><tr><th>ID</th><th>PJGT / Madrasah</th><th>Wil</th><th>Tahun</th><th>Status</th><th>Rapot</th><th>Aksi</th></tr></thead>
      <tbody>
        @forelse($list as $p)
        <tr>
          <td><span class="badge-pendaftaran">{{ $p->pjgt_id }}</span></td>
          <td>
            <div style="color:var(--green);font-weight:700">{{ $p->pjgt_nama }}</div>
            <div style="color:#5d4037;font-size:11px">{{ $p->nama_madrasah }} • {{ $p->kabupaten ?? '' }}</div>
          </td>
          <td><span class="badge" style="background:var(--cream2);color:var(--green);border:1px solid var(--gold)">{{ $p->wil }}</span></td>
          <td>{{ $p->tahun }}</td>
          <td>
            @if($p->status == 'Diterima')
            <span class="badge" style="background:#198754;color:#fff">Diterima</span>
            @elseif($p->status == 'Ditolak')
            <span class="badge" style="background:#dc3545;color:#fff">Ditolak</span>
            @else
            <span class="badge" style="background:#d4af37;color:#0a3d1f">Proses</span>
            @endif
          </td>
          <td><span class="badge" style="background:#fff;border:1px solid var(--gold);color:var(--green)">{{ $p->rapot }}</span></td>
          <td><a href="{{ route('permohonan.show', $p) }}" class="btn btn-sm" style="background:var(--green);color:var(--gold);border-radius:20px;font-size:11px;font-weight:700">Detail →</a></td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center py-4" style="color:var(--brown)">Tidak ada data sesuai filter</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="d-md-none p-2">
    @forelse($list as $p)
    <div class="p-3 mb-2 rounded-3" style="background:#fff;border:1.5px solid #e8d9a0;border-left:4px solid var(--gold)">
      <div class="d-flex justify-content-between align-items-center gap-2">
        <span class="badge-pendaftaran">{{ $p->pjgt_id }}</span>
        @if($p->status == 'Diterima')
        <span class="badge" style="background:#198754;color:#fff;font-size:10px">Diterima</span>
        @elseif($p->status == 'Ditolak')
        <span class="badge" style="background:#dc3545;color:#fff;font-size:10px">Ditolak</span>
        @else
        <span class="badge" style="background:#d4af37;color:#0a3d1f;font-size:10px">Proses</span>
        @endif
      </div>
      <div class="fw-bold mt-1" style="color:var(--green)">{{ $p->pjgt_nama }}</div>
      <div class="small" style="color:#5d4037">{{ $p->nama_madrasah }} • {{ $p->wil }} • {{ $p->tahun }} • Rapot {{ $p->rapot }}</div>
      <a href="{{ route('permohonan.show', $p) }}" class="btn btn-sm w-100 mt-2" style="background:var(--green);color:var(--gold);border-radius:10px">Lihat Detail</a>
    </div>
    @empty
    <div class="text-center py-4 small" style="color:var(--brown)">Tidak ada data sesuai filter</div>
    @endforelse
  </div>
  <div class="p-3">{{ $list->links() }}</div>
</div>
@endsection

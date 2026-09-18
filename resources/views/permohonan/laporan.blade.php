@extends('layouts.app')
@section('title','Laporan - TMTB & DAI KIK')
@section('breadcrumb','Laporan')
@section('content')
<div class="p-3 rounded-3 mb-3" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <div class="arab small" style="color:#d4af37">تقرير الطلبات — Laporan</div>
            <h4 class="fw-bold mb-0" style="color:#fff"><i class="bi bi-megaphone-fill" style="color:#d4af37"></i> Laporan Permohonan</h4>
            <div class="small" style="color:#fdf6e3;opacity:.8">PP KUNUUZUL IMAM KAUMAN • 1448/1449 H • heritage</div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('permohonan.export', request()->query()) }}" class="btn btn-sm" style="background:#d4af37;color:#0a3d1f;border:2px solid #0a3d1f;border-radius:50px;font-weight:700"><i class="bi bi-download"></i> Export</a>
            <button onclick="window.print()" class="btn btn-sm d-none d-md-inline" style="background:#fff;color:#0a3d1f;border:1px solid #d4af37;border-radius:50px"><i class="bi bi-printer"></i> Cetak</button>
        </div>
    </div>
</div>

@if(empty($canIsi) || !$canIsi)
<div class="alert d-flex gap-3 align-items-start mb-3" style="background:#fff3cd;border:2px solid #d4af37;color:#664d03;border-radius:12px">
  <i class="bi bi-calendar-x mt-1" style="color:#b8941f;font-size:22px"></i>
  <div class="small" style="line-height:1.5">
    <strong><i class="bi bi-clock-history"></i> Laporan hanya diisi setiap akhir bulan</strong> — saat ini <strong>{{ now()->locale('id')->isoFormat('D MMMM YYYY') }}</strong> belum masuk jendela pengisian.<br>
    Jendela pengisian: <span class="badge" style="background:#0a3d1f;color:#d4af37;border:1px solid #d4af37">Tanggal 25 s/d akhir bulan</span> &nbsp; Next window: <strong>{{ $nextWindow ?? now()->copy()->day(25)->locale('id')->isoFormat('D MMMM YYYY') }}</strong><br>
    <span class="small" style="color:#8a7a3a">Data di bawah tetap tampil untuk dilihat, tapi <strong>filter & export</strong> akan aktif penuh saat akhir bulan. Admin tetap bisa akses penuh.</span>
  </div>
</div>
@endif
<form method="GET" class="card p-3 mb-3" style="border:2px solid #d4af37;border-radius:14px;background:#fff;@if(empty($canIsi) || !$canIsi) opacity:.85 @endif">
    <div class="row g-2">
        <div class="col-6 col-md-2">
            <label class="small fw-bold" style="color:#0a3d1f">Tahun</label>
            <select name="tahun" class="form-select form-select-sm">
                <option value="">Semua</option>
                @foreach($tahunList as $t)<option value="{{ $t }}" {{ $tahun==$t?'selected':'' }}>{{ $t }}</option>@endforeach
            </select>
        </div>
        <div class="col-6 col-md-2">
            <label class="small fw-bold" style="color:#0a3d1f">Status</label>
            <select name="status" class="form-select form-select-sm">
                <option value="">Semua</option>
                @foreach(['Proses','Diterima','Ditolak'] as $s)<option value="{{ $s }}" {{ $status==$s?'selected':'' }}>{{ $s }}</option>@endforeach
            </select>
        </div>
        <div class="col-6 col-md-2">
            <label class="small fw-bold" style="color:#0a3d1f">Wil</label>
            <select name="wil" class="form-select form-select-sm">
                <option value="">Semua</option>
                @foreach($wilList as $w)<option value="{{ $w }}" {{ $wil==$w?'selected':'' }}>{{ $w }}</option>@endforeach
            </select>
        </div>
        <div class="col-12 col-md-4">
            <label class="small fw-bold" style="color:#0a3d1f">Cari</label>
            <input type="text" name="search" value="{{ $search }}" placeholder="PJGT / Madrasah / ID" class="form-control form-control-sm">
        </div>
        <div class="col-12 col-md-2 d-flex align-items-end gap-1">
            <button class="btn btn-sm w-100" style="background:#0a3d1f;color:#d4af37;border:1px solid #d4af37;border-radius:8px"><i class="bi bi-search"></i> Filter</button>
            <a href="{{ route('laporan') }}" class="btn btn-sm" style="background:#fff;border:1px solid #d4af37;color:#0a3d1f;border-radius:8px">Reset</a>
        </div>
    </div>
</form>

<div class="row g-2 g-md-3 mb-3">
    <div class="col-6 col-md-3">
        <div class="card text-center" style="border:2px solid #0a3d1f;border-radius:14px;background:linear-gradient(135deg,#0a3d1f,#0f5a2e);color:#d4af37">
            <div class="card-body p-3">
                <div class="small fw-bold">TOTAL</div>
                <div class="fs-2 fw-bold">{{ $total }}</div>
                <div class="small" style="opacity:.8">permohonan</div>
            </div>
        </div>
    </div>
    @foreach($byStatus as $st=>$jml)
    <div class="col-6 col-md-3">
        <div class="card text-center" style="border:1.5px solid #d4af37;border-radius:14px;background:#fff">
            <div class="card-body p-3">
                <div class="small fw-bold" style="color:#5d4037">{{ $st }}</div>
                <div class="fs-3 fw-bold" style="color:{{$st=='Diterima'?'#0a3d1f':($st=='Ditolak'?'#dc3545':'#b8941f')}}">{{ $jml }}</div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row g-2 g-md-3 mb-3">
    <div class="col-md-6">
        <div class="card" style="border:1.5px solid #d4af37;border-radius:14px;background:#fff">
            <div class="card-body p-3"><h6 class="fw-bold" style="color:#0a3d1f"><i class="bi bi-pie-chart-fill" style="color:#d4af37"></i> Status</h6><canvas id="lapStatus" height="160"></canvas></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card" style="border:1.5px solid #d4af37;border-radius:14px;background:#fff">
            <div class="card-body p-3"><h6 class="fw-bold" style="color:#0a3d1f"><i class="bi bi-geo-alt-fill" style="color:#d4af37"></i> Wilayah</h6><canvas id="lapWil" height="160"></canvas></div>
        </div>
    </div>
</div>

<div class="card" style="border:2px solid #d4af37;border-radius:14px;overflow:hidden">
    <div class="card-form-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-table" style="color:#d4af37"></i> Detail Laporan ({{ $list->total() }})</span>
        <span class="small" style="color:#8a7a3a">Hal {{ $list->currentPage() }} / {{ $list->lastPage() }}</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0 small">
            <thead style="background:#fdf0c7;color:#0a3d1f"><tr><th>ID</th><th>PJGT / Madrasah</th><th>Wil</th><th>Tahun</th><th>Status</th><th>Rapot</th></tr></thead>
            <tbody>
                @forelse($list as $p)
                <tr>
                    <td><span class="badge-pendaftaran">{{ $p->pjgt_id }}</span></td>
                    <td><div style="color:#0a3d1f;font-weight:700">{{ $p->pjgt_nama }}</div><div style="color:#5d4037;font-size:11px">{{ $p->nama_madrasah }} • {{ $p->kabupaten ?? '' }}</div></td>
                    <td><span class="badge" style="background:#fdf0c7;color:#0a3d1f;border:1px solid #d4af37">{{ $p->wil }}</span></td>
                    <td>{{ $p->tahun }}</td>
                    <td><span class="badge" style="background:{{$p->status=='Diterima'?'#0a3d1f':($p->status=='Ditolak'?'#dc3545':'#d4af37')}};color:#fff">{{ $p->status }}</span></td>
                    <td><span class="badge" style="background:#fff;border:1px solid #d4af37;color:#0a3d1f">{{ $p->rapot }}</span></td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4" style="color:#8a7a3a">Tidak ada data sesuai filter</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3">{{ $list->links() }}</div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const sLabels=@json(array_keys($byStatus->toArray()));
const sData=@json(array_values($byStatus->toArray()));
const wLabels=@json(array_keys($byWil->toArray()));
const wData=@json(array_values($byWil->toArray()));
if(sLabels.length) new Chart(document.getElementById('lapStatus'),{type:'doughnut',data:{labels:sLabels,datasets:[{data:sData,backgroundColor:['#0a3d1f','#dc3545','#d4af37'],borderWidth:2}]},options:{plugins:{legend:{position:'bottom'}}}});
if(wLabels.length) new Chart(document.getElementById('lapWil'),{type:'doughnut',data:{labels:wLabels,datasets:[{data:wData,backgroundColor:['#0a3d1f','#d4af37','#198754','#dc3545'],borderWidth:2}]},options:{plugins:{legend:{position:'bottom'}}}});
</script>
@endpush
@endsection

@extends('layouts.app')
@section('title','Laporan Kegiatan GT • TMTB & DAI')
@section('breadcrumb','Laporan GT')
@section('content')
<div class="p-3 rounded-3 mb-3" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37">
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
 <div class="arab small" style="color:#d4af37">Laporan Kegiatan GT</div>
      <h4 class="fw-bold mb-0" style="color:#fff"><i class="bi bi-clipboard2-check-fill" style="color:#d4af37"></i> Laporan Kegiatan GT</h4>
      <div class="small" style="color:#fdf6e3;opacity:.8">PJGT mengisi checklist GT di lembaga (biasanya 1 GT) • Bisa diisi kapan saja — apa aja</div>
    </div>
    <div class="d-flex gap-2">
      @if((auth()->user()->role ?? '')==='pjgt')
        <a href="{{ route('pjgt.laporan.create') }}" class="btn btn-sm" style="background:#d4af37;color:#0a3d1f;border:2px solid #0a3d1f;border-radius:50px;font-weight:800"><i class="bi bi-plus-lg"></i> Isi Laporan</a>
      @else
        <span class="badge" style="background:#fff;color:#0a3d1f;border:1.5px solid #d4af37;padding:8px 12px;border-radius:20px;font-size:11px"><i class="bi bi-eye"></i> Mode Admin — Hanya Menerima</span>
      @endif
    </div>
  </div>
</div>



<div class="card-form" style="border:2px solid #d4af37">
  <div class="card-form-header d-flex justify-content-between align-items-center">
    <span><i class="bi bi-table" style="color:#d4af37"></i> Arsip Laporan ({{ $laporans->total() }})</span>
    <span class="small" style="color:#8a7a3a">Hal {{ $laporans->currentPage() }} / {{ $laporans->lastPage() }}</span>
  </div>
  <div class="table-responsive d-none d-md-block">
    <table class="table table-hover small mb-0 align-middle">
      <thead style="background:#fdf0c7;color:#0a3d1f"><tr style="border-bottom:2px solid #d4af37"><th>Aksi</th><th>Periode</th><th>GT</th><th>Madrasah</th><th>Rata</th><th>Status</th></tr></thead>
      <tbody>
        @forelse($laporans as $l)
        @php
          $avg = collect($l->madrasiyah)->pluck('nilai')->merge(collect($l->kemasyarakatan)->pluck('nilai'))->map(fn($v)=> $v==='Sangat Baik'?3:($v==='Baik'?2:1))->avg();
          $label = $avg>=2.6?'Sangat Baik':($avg>=1.8?'Baik':'Kurang');
        @endphp
        <tr>
          <td><a href="{{ route(auth()->user()->role==='gt'?'gt.laporan.show':'pjgt.laporan.show',$l) }}" class="btn btn-sm" style="background:var(--cream2);border:1px solid #d4af37;color:#0a3d1f"><i class="bi bi-eye"></i></a>
            @if(auth()->user()->role!=='gt')
            <form method="POST" action="{{ route('pjgt.laporan.destroy',$l) }}" onsubmit="return confirm('Hapus laporan {{ $l->periode }}?')" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm" style="background:#dc3545;color:#fff;border:1px solid #0a3d1f"><i class="bi bi-trash"></i></button></form>
            @endif
          </td>
          <td><span class="badge-pendaftaran">{{ $l->periode }}</span><div class="small" style="color:#8a7a3a">{{ $l->tahun_ajaran }}</div></td>
          <td style="color:#0a3d1f;font-weight:700">{{ $l->gt->name ?? '-' }}<div class="small" style="color:#8a7a3a">{{ $l->gt->username ?? '' }}</div></td>
          <td><span class="badge" style="background:#fdf6e3;color:#0a3d1f;border:1px solid #d4af37">{{ $l->nama_madrasah }}</span></td>
          <td><span class="badge" style="background:{{$label==='Sangat Baik'?'#0a3d1f':($label==='Baik'?'#d4af37':'#dc3545')}};color:#fff">{{ $label }}</span></td>
          <td><span class="badge" style="background:#e8f5e9;color:#0a3d1f;border:1px solid #22c55e">{{ $l->status }}</span></td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-4" style="color:#8a7a3a">Belum ada laporan — klik <strong>Isi Laporan</strong> di akhir bulan (hanya GT di lembaga Anda, biasanya 1 GT).</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="d-md-none p-2">
    @forelse($laporans as $l)
    @php $avg = collect($l->madrasiyah)->pluck('nilai')->merge(collect($l->kemasyarakatan)->pluck('nilai'))->map(fn($v)=> $v==='Sangat Baik'?3:($v==='Baik'?2:1))->avg(); $label = $avg>=2.6?'Sangat Baik':($avg>=1.8?'Baik':'Kurang'); @endphp
    <div class="p-3 mb-2 rounded-3" style="background:#fff;border:1.5px solid #e8d9a0;border-left:4px solid var(--gold)">
      <div class="d-flex justify-content-between"><span class="badge-pendaftaran">{{ $l->periode }}</span><span class="badge" style="background:{{$label==='Sangat Baik'?'#0a3d1f':($label==='Baik'?'#d4af37':'#dc3545')}};color:#fff">{{ $label }}</span></div>
      <div class="fw-bold mt-2" style="color:var(--green)">{{ $l->gt->name ?? '-' }}</div>
      <div class="small" style="color:#5d4037">{{ $l->nama_madrasah }}</div>
      <a href="{{ route(auth()->user()->role==='gt'?'gt.laporan.show':'pjgt.laporan.show',$l) }}" class="btn btn-sm w-100 mt-2" style="background:var(--green);color:var(--gold);border-radius:10px">Detail</a>
    </div>
    @empty
    <div class="text-center py-4 small" style="color:#8a7a3a">Belum ada laporan</div>
    @endforelse
  </div>
  <div class="p-3">{{ $laporans->links() }}</div>
</div>
@push('scripts')
<script>
// optional
</script>
@endpush
@endsection

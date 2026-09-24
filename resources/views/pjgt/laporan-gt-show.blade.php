@extends('layouts.app')
@section('title','Detail Laporan GT • TMTB')
@section('breadcrumb','Detail Laporan')
@section('content')
<div class="p-3 rounded-3 mb-3" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37">
  <div class="d-flex justify-content-between flex-wrap gap-2">
    <div>
 <div class="arab small" style="color:#d4af37">{{ $laporan->periode }}</div>
      <h4 class="fw-bold mb-0" style="color:#fff">{{ $laporan->gt->name ?? '-' }} • {{ $laporan->nama_madrasah }}</h4>
      <div class="small" style="color:#fdf6e3;opacity:.8">PJGT: {{ $laporan->pjgt->name ?? '-' }} ({{ $laporan->pjgt->username ?? '' }}) • {{ $laporan->tahun_ajaran }}</div>
    </div>
    <div class="text-end">
      <span class="badge-pendaftaran" style="background:#fdf6e3;color:#0a3d1f">{{ $laporan->periode }} • {{ $laporan->status }}</span>
      <div class="small mt-1" style="color:#d4af37">{{ $laporan->created_at->locale('id')->isoFormat('D MMMM YYYY') }}</div>
    </div>
  </div>
</div>

@php
  $mad = $laporan->madrasiyah ?? [];
  $kes = $laporan->kemasyarakatan ?? [];
  $avg = collect($mad)->pluck('nilai')->merge(collect($kes)->pluck('nilai'))->map(fn($v)=> $v==='Sangat Baik'?3:($v==='Baik'?2:1))->avg();
  $label = $avg>=2.6?'Sangat Baik':($avg>=1.8?'Baik':'Kurang');
  $color = $label==='Sangat Baik'?'#0a3d1f':($label==='Baik'?'#b8941f':'#dc3545');
@endphp
<div class="alert d-flex gap-2 mb-3" style="background:#fff;border:2px solid #d4af37;border-radius:12px">
  <i class="bi bi-star-fill mt-1" style="color:var(--gold)"></i>
  <div><strong style="color:{{$color}}">Rata-rata: {{ $label }} ({{ number_format($avg,2) }})</strong><br><span class="small" style="color:#5d4037">Sangat Baik=3, Baik=2, Kurang=1 • 11 indikator</span></div>
</div>

<div class="card-form" style="border:2px solid #d4af37">
  <div class="p-3">
    <h6 class="fw-bold" style="color:#0a3d1f"><span class="badge" style="background:#0a3d1f;color:#d4af37">A</span> Madrasiyah</h6>
    <div class="table-responsive">
      <table class="table table-bordered small mb-0">
        <thead style="background:#fdf0c7;color:#0a3d1f"><tr><th>No</th><th>Indikator</th><th>Nilai</th><th>Catatan</th></tr></thead>
        <tbody>
          @foreach($mad as $no=>$r)
          <tr><td>{{ $no }}</td><td style="color:#0a3d1f">{{ $r['indikator'] }}</td><td><span class="badge" style="background:{{$r['nilai']=='Sangat Baik'?'#0a3d1f':($r['nilai']=='Baik'?'#d4af37':'#dc3545')}};color:#fff">{{ $r['nilai'] }}</span></td><td style="color:#5d4037">{{ $r['catatan'] ?? '-' }}</td></tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="p-3" style="border-top:2px solid #e8d9a0">
    <h6 class="fw-bold" style="color:#0a3d1f"><span class="badge" style="background:#d4af37;color:#0a3d1f">B</span> Kemasyarakatan</h6>
    <div class="table-responsive">
      <table class="table table-bordered small mb-0">
        <thead style="background:#0a3d1f;color:#d4af37"><tr><th>No</th><th>Indikator</th><th>Nilai</th><th>Catatan</th></tr></thead>
        <tbody>
          @foreach($kes as $no=>$r)
          <tr><td>{{ $no }}</td><td style="color:#0a3d1f">{{ $r['indikator'] }}</td><td><span class="badge" style="background:{{$r['nilai']=='Sangat Baik'?'#0a3d1f':($r['nilai']=='Baik'?'#d4af37':'#dc3545')}};color:#fff">{{ $r['nilai'] }}</span></td><td style="color:#5d4037">{{ $r['catatan'] ?? '-' }}</td></tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @if($laporan->catatan_umum)
  <div class="p-3" style="background:#fdf6e3;border-top:2px solid #d4af37"><strong style="color:#0a3d1f">Catatan Umum:</strong><br><span style="color:#5d4037">{{ $laporan->catatan_umum }}</span></div>
  @endif
  <div class="p-3 border-top d-flex gap-2" style="background:#fdf6e3">
    <a href="{{ route(auth()->user()->role==='gt'?'gt.laporan.index':'pjgt.laporan.index') }}" class="btn-yellow"><i class="bi bi-arrow-left"></i> Kembali</a>
    <button onclick="window.print()" class="btn-green"><i class="bi bi-printer"></i> Cetak</button>
  </div>
</div>
@endsection

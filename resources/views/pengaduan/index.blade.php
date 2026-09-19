@extends('layouts.app')
@section('title','Pengaduan GT • TMTB & DAI')
@section('breadcrumb','Pengaduan')
@section('content')
<div class="p-3 rounded-3 mb-3" style="background:linear-gradient(135deg,#7a0a0a 0%, #a81414 100%);color:#fff;border:2px solid #d4af37">
  <div class="d-flex justify-content-between flex-wrap gap-2">
    <div>
 <div class="arab small" style="color:#d4af37">@if((auth()->user()->role ?? '')==='gt') — Aduan Saya @else — Pengaduan GT di Lembaga @endif</div>
      <h4 class="fw-bold mb-0" style="color:#fff"><i class="bi bi-flag-fill" style="color:#d4af37"></i> @if((auth()->user()->role ?? '')==='gt') Aduan Saya @else Pengaduan @endif</h4>
      <div class="small" style="color:#fff;opacity:.85">@if((auth()->user()->role ?? '')==='gt') Apa yang Anda alami selama di tempat tugas — adukan ke Admin @else PJGT mengadukan apa yang dilakukan GT termasuk kesalahan dll di lembaga @endif</div>
    </div>
    @if(in_array(auth()->user()->role ?? '', ['pjgt','gt']))
    <a href="{{ route('pengaduan.create') }}" class="btn btn-sm align-self-center" style="background:#d4af37;color:#7a0a0a;border:2px solid #fff;border-radius:50px;font-weight:800"><i class="bi bi-plus-lg"></i> Buat Pengaduan</a>
    @endif
  </div>
</div>

<div class="row g-2 g-md-3 mb-3">
  <div class="col-12 col-md-3">
    <div class="card h-100 overflow-hidden" style="border:none;border-radius:16px;background:linear-gradient(135deg,#7a0a0a,#c11f1f);color:#fff;box-shadow:0 8px 24px rgba(122,10,10,.25)">
      <div class="card-body p-3 d-flex align-items-center gap-3">
        <div style="width:52px;height:52px;border-radius:14px;background:rgba(212,175,55,.2);border:1.5px solid #d4af37;display:flex;align-items:center;justify-content:center;font-size:22px;color:#f4e2a0;flex-shrink:0"><i class="bi bi-flag-fill"></i></div>
        <div>
          <div class="small fw-bold" style="color:#f4e2a0;letter-spacing:1px;font-size:11px">TOTAL</div>
          <div class="fw-bold" style="font-size:28px;line-height:1">{{ $total }}</div>
        </div>
      </div>
    </div>
  </div>
  @foreach($byStatus as $st => $jml)
  @php
    $pct = $total > 0 ? round($jml / $total * 100) : 0;
    $bar = $st == 'Selesai' ? 'linear-gradient(90deg,#198754,#22c55e)' : ($st == 'Ditolak' ? 'linear-gradient(90deg,#dc3545,#ff6b6b)' : ($st == 'Ditindaklanjuti' ? 'linear-gradient(90deg,#0a3d1f,#14924a)' : 'linear-gradient(90deg,#d4af37,#f4e2a0)'));
    $color = $st == 'Selesai' ? '#198754' : ($st == 'Ditolak' ? '#dc3545' : ($st == 'Ditindaklanjuti' ? '#0a3d1f' : '#b8941f'));
  @endphp
  <div class="col-6 col-md-3">
    <div class="card h-100" style="border:1.5px solid #e8d9a0;border-radius:16px;background:#fff;box-shadow:0 4px 16px rgba(0,0,0,.05)">
      <div class="card-body p-3">
        <div class="d-flex align-items-center gap-2 mb-1">
          <span class="small fw-bold" style="color:#5d4037">{{ $st }}</span>
          <span class="ms-auto small fw-bold" style="color:{{ $color }}">{{ $pct }}%</span>
        </div>
        <div class="fw-bold" style="font-size:24px;color:{{ $color }};line-height:1">{{ $jml }}</div>
        <div class="mt-2" style="height:6px;border-radius:10px;background:#f1ecd8;overflow:hidden"><div style="height:100%;width:{{ $pct }}%;background:{{ $bar }};border-radius:10px"></div></div>
      </div>
    </div>
  </div>
  @endforeach
</div>

<div class="card-form mb-3">
  <form method="GET" action="{{ route('pengaduan.index') }}" class="p-3">
    <div class="row g-2">
      <div class="col-6 col-md-2">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
          <option value="">Semua</option>
          @foreach(\App\Models\Pengaduan::STATUS as $s)
          <option value="{{ $s }}" @selected($status == $s)>{{ $s }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-6 col-md-2">
        <label class="form-label">Sumber</label>
        <select name="sumber" class="form-select">
          <option value="">Semua</option>
          <option value="gt" @selected(($sumber ?? '') == 'gt')>Dari GT</option>
          <option value="pjgt" @selected(($sumber ?? '') == 'pjgt')>Dari PJGT</option>
        </select>
      </div>
      <div class="col-12 col-md-5">
        <label class="form-label">Cari</label>
        <input name="search" value="{{ $search }}" class="form-control" placeholder="Judul / madrasah / terlapor / kategori...">
      </div>
      <div class="col-12 col-md-3 d-flex align-items-end gap-1">
        <button class="btn-green flex-fill" style="min-height:44px"><i class="bi bi-search"></i> Filter</button>
        <a href="{{ route('pengaduan.index') }}" class="btn btn-sm" style="background:#fff;border:1.5px solid var(--gold);color:var(--green);border-radius:10px;min-height:44px;display:flex;align-items:center">Reset</a>
      </div>
    </div>
  </form>
</div>

<div class="card-form" style="border:2px solid #d4af37">
  <div class="card-form-header d-flex justify-content-between"><span><i class="bi bi-table" style="color:#d4af37"></i> Daftar Pengaduan ({{ $pengaduans->total() }})</span><span class="small" style="color:#8a7a3a">Hal {{ $pengaduans->currentPage() }}/{{ $pengaduans->lastPage() }}</span></div>
  <div class="table-responsive d-none d-md-block">
    <table class="table table-hover small mb-0 align-middle">
      <thead style="background:#fdf0c7;color:#0a3d1f"><tr><th>Aksi</th><th>Judul</th><th>GT</th><th>Madrasah</th><th>Kategori</th><th>Tgl Kejadian</th><th>Status</th></tr></thead>
      <tbody>
        @forelse($pengaduans as $p)
        <tr>
          <td><a href="{{ route('pengaduan.show',$p) }}" class="btn btn-sm" style="background:var(--cream2);border:1px solid #d4af37;color:#0a3d1f"><i class="bi bi-eye"></i></a>
            @if(auth()->user()->role==='admin' || $p->pjgt_user_id===auth()->id())
            <form method="POST" action="{{ route('pengaduan.destroy',$p) }}" onsubmit="return confirm('Hapus pengaduan?')" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm" style="background:#dc3545;color:#fff"><i class="bi bi-trash"></i></button></form>
            @endif
          </td>
          <td>
            <div style="color:#7a0a0a;font-weight:700">{{ $p->judul }}</div>
            @if($p->pjgt_user_id === $p->gt_user_id)
            <span class="badge mt-1" style="background:#198754;color:#fff;font-size:10px">Dari GT</span>
            @else
            <span class="badge mt-1" style="background:var(--gold);color:var(--green);font-size:10px">Dari PJGT</span>
            @endif
          </td>
          <td style="color:#0a3d1f">{{ $p->gt->name ?? '-' }}<div class="small" style="color:#8a7a3a">{{ $p->gt->username ?? '' }}</div></td>
          <td><span class="badge" style="background:#fdf6e3;color:#0a3d1f;border:1px solid #d4af37">{{ $p->nama_madrasah }}</span></td>
          <td><span class="badge" style="background:#7a0a0a;color:#fff">{{ $p->kategori }}</span></td>
          <td class="small" style="color:#5d4037">{{ $p->tanggal_kejadian?->locale('id')->isoFormat('D MMM YYYY') ?? '-' }}</td>
          <td><span class="badge" style="background:{{$p->status==='Menunggu'?'#d4af37':($p->status==='Selesai'?'#198754':($p->status==='Ditolak'?'#dc3545':'#0a3d1f'))}};color:#fff">{{ $p->status }}</span></td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center py-4" style="color:#8a7a3a">Belum ada pengaduan — PJGT belum mengadukan GT di lembaga.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="d-md-none p-2">
    @forelse($pengaduans as $p)
    <div class="p-3 mb-2 rounded-3" style="background:#fff;border:1.5px solid #e8d9a0;border-left:4px solid #dc3545">
      <div class="d-flex justify-content-between"><span class="badge" style="background:#7a0a0a;color:#fff">{{ $p->kategori }}</span><span class="badge" style="background:{{$p->status==='Menunggu'?'#d4af37':($p->status==='Selesai'?'#198754':'#dc3545')}};color:#fff">{{ $p->status }}</span></div>
      <div class="mt-1">
        @if($p->pjgt_user_id === $p->gt_user_id)
        <span class="badge" style="background:#198754;color:#fff;font-size:10px">Dari GT</span>
        @else
        <span class="badge" style="background:var(--gold);color:var(--green);font-size:10px">Dari PJGT</span>
        @endif
      </div>
      <div class="fw-bold mt-2" style="color:#7a0a0a">{{ $p->judul }}</div>
      <div class="small" style="color:#5d4037">{{ $p->gt->name ?? '-' }} • {{ $p->nama_madrasah }}</div>
      <div class="small" style="color:#8a7a3a">{{ $p->tanggal_kejadian?->locale('id')->isoFormat('D MMM YYYY') ?? '-' }}</div>
      <a href="{{ route('pengaduan.show',$p) }}" class="btn btn-sm w-100 mt-2" style="background:#7a0a0a;color:#fff;border-radius:10px">Detail</a>
    </div>
    @empty
    <div class="text-center py-4 small" style="color:#8a7a3a">Belum ada pengaduan</div>
    @endforelse
  </div>
  <div class="p-3">{{ $pengaduans->links() }}</div>
</div>
@endsection

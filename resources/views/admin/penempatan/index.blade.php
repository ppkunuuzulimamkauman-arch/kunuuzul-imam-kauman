@extends('layouts.app')
@section('title','Penempatan GT')
@section('breadcrumb','Penempatan GT')
@section('content')
<div class="p-3 p-md-4 rounded-4 mb-3 position-relative overflow-hidden" style="background:linear-gradient(135deg,#0a3d1f 0%,#0f5a2e 60%,#083d1e 100%);color:#fdf6e3;border:1px solid rgba(212,175,55,.4);box-shadow:0 12px 32px rgba(6,43,21,.3)">
  <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#d4af37,#f4e2a0,#d4af37)"></div>
  <div class="position-relative">
    <h4 class="fw-bold mb-1" style="color:#fff;font-size:clamp(18px,5vw,22px)"><i class="bi bi-geo-alt-fill" style="color:#d4af37"></i> Penempatan GT</h4>
    <div class="small" style="opacity:.8">Admin menempatkan tiap GT ke 1 lembaga (Diterima) • {{ $sudah }} GT sudah ditempatkan</div>
  </div>
</div>

<div class="card-form mb-3">
  <form method="GET" action="{{ route('penempatan.index') }}" class="p-3">
    <div class="row g-2">
      <div class="col-12 col-md-9">
        <label class="form-label">Cari GT</label>
        <input name="search" value="{{ $search }}" class="form-control" placeholder="Nama / username...">
      </div>
      <div class="col-12 col-md-3 d-flex align-items-end gap-1">
        <button class="btn-green flex-fill" style="min-height:44px"><i class="bi bi-search"></i> Cari</button>
        <a href="{{ route('penempatan.index') }}" class="btn btn-sm" style="background:#fff;border:1.5px solid var(--gold);color:var(--green);border-radius:10px;min-height:44px;display:flex;align-items:center">Reset</a>
      </div>
    </div>
  </form>
</div>

<div class="card-form">
  <div class="card-form-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-table" style="color:var(--gold)"></i> Daftar GT ({{ $gts->total() }})</span>
    <span class="small" style="color:#8a7a3a">Hal {{ $gts->currentPage() }} / {{ $gts->lastPage() }}</span>
  </div>
  <div class="table-responsive d-none d-md-block">
    <table class="table table-hover mb-0 small align-middle">
      <thead style="background:var(--cream2);color:var(--green)"><tr><th>GT</th><th>Lembaga Penempatan</th><th>Aksi</th></tr></thead>
      <tbody>
        @forelse($gts as $g)
        <tr>
          <td>
            <div style="color:var(--green);font-weight:700">{{ $g->name }}</div>
            <div style="color:#8a7a3a;font-size:11px">{{ $g->username }}</div>
          </td>
          <td>
            @if($g->penempatan && $g->penempatan->permohonan)
            <div style="color:var(--green);font-weight:700"><i class="bi bi-bank" style="color:var(--gold2)"></i> {{ $g->penempatan->permohonan->nama_madrasah }}</div>
            <div style="color:#8a7a3a;font-size:11px">{{ $g->penempatan->permohonan->desa ?? '' }} • {{ $g->penempatan->permohonan->kecamatan ?? '' }} • {{ $g->penempatan->permohonan->kabupaten ?? '' }} • {{ $g->penempatan->permohonan->wil }}</div>
            @else
            <span class="badge" style="background:#eee;color:#999">Belum ditempatkan</span>
            @endif
          </td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('penempatan.create', ['gt' => $g->id]) }}" class="btn btn-sm" style="background:var(--green);color:var(--gold);border-radius:20px;font-size:11px;font-weight:700">
                @if($g->penempatan)
                Pindahkan
                @else
                Tempatkan
                @endif
              </a>
              @if($g->penempatan)
              <form method="POST" action="{{ route('penempatan.destroy', $g->penempatan) }}" onsubmit="return confirm('Lepas penempatan {{ $g->name }}?')">@csrf @method('DELETE')<button class="btn btn-sm" style="background:#ffe9e9;border:1px solid #ffb3b3;color:#7a0a0a;border-radius:20px;font-size:11px">Lepas</button></form>
              @endif
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="3" class="text-center py-4" style="color:var(--brown)">Belum ada user GT.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="d-md-none p-2">
    @forelse($gts as $g)
    <div class="p-3 mb-2 rounded-3" style="background:#fff;border:1.5px solid #e8d9a0;border-left:4px solid var(--gold)">
      <div class="fw-bold" style="color:var(--green)">{{ $g->name }}</div>
      <div class="small" style="color:#8a7a3a">{{ $g->username }}</div>
      @if($g->penempatan && $g->penempatan->permohonan)
      <div class="small mt-1" style="color:var(--green)"><i class="bi bi-bank" style="color:var(--gold2)"></i> {{ $g->penempatan->permohonan->nama_madrasah }}</div>
      @else
      <div class="small mt-1" style="color:#999">Belum ditempatkan</div>
      @endif
      <div class="d-flex gap-1 mt-2">
        <a href="{{ route('penempatan.create', ['gt' => $g->id]) }}" class="btn btn-sm flex-fill" style="background:var(--green);color:var(--gold);border-radius:10px">
          @if($g->penempatan)
          Pindahkan
          @else
          Tempatkan
          @endif
        </a>
        @if($g->penempatan)
        <form method="POST" action="{{ route('penempatan.destroy', $g->penempatan) }}" onsubmit="return confirm('Lepas penempatan {{ $g->name }}?')">@csrf @method('DELETE')<button class="btn btn-sm" style="background:#ffe9e9;border:1px solid #ffb3b3;color:#7a0a0a;border-radius:10px">Lepas</button></form>
        @endif
      </div>
    </div>
    @empty
    <div class="text-center py-4 small" style="color:var(--brown)">Belum ada user GT.</div>
    @endforelse
  </div>
  <div class="p-3">{{ $gts->links() }}</div>
</div>
@endsection

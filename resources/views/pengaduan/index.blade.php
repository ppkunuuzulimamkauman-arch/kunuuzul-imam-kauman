@extends('layouts.app')
@section('title','Pengaduan GT • TMTB & DAI')
@section('breadcrumb','Pengaduan')
@section('content')
<div class="p-3 rounded-3 mb-3" style="background:linear-gradient(135deg,#7a0a0a 0%, #a81414 100%);color:#fff;border:2px solid #d4af37">
  <div class="d-flex justify-content-between flex-wrap gap-2">
    <div>
      <div class="arab small" style="color:#d4af37">@if((auth()->user()->role ?? '')==='gt') شكوى — Aduan Saya @else شكوى — Pengaduan GT di Lembaga @endif</div>
      <h4 class="fw-bold mb-0" style="color:#fff"><i class="bi bi-flag-fill" style="color:#d4af37"></i> @if((auth()->user()->role ?? '')==='gt') Aduan Saya @else Pengaduan @endif</h4>
      <div class="small" style="color:#fff;opacity:.85">@if((auth()->user()->role ?? '')==='gt') Apa yang Anda alami selama di tempat tugas — adukan ke Admin @else PJGT mengadukan apa yang dilakukan GT termasuk kesalahan dll di lembaga @endif</div>
    </div>
    @if(in_array(auth()->user()->role ?? '', ['pjgt','gt']))
    <a href="{{ route('pengaduan.create') }}" class="btn btn-sm align-self-center" style="background:#d4af37;color:#7a0a0a;border:2px solid #fff;border-radius:50px;font-weight:800"><i class="bi bi-plus-lg"></i> Buat Pengaduan</a>
    @endif
  </div>
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
          <td style="color:#7a0a0a;font-weight:700">{{ $p->judul }}</td>
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

@extends('layouts.app')
@section('title','Kelola Konten Informasi')
@section('breadcrumb','Kelola Konten')
@section('content')
@php
  $landingList = $contents->whereIn('section', ['hero','informasi','pengumuman','panduan','alur']);
  $umumList = $contents->where('section', 'info_umum');
  $pjgtList = $contents->where('section', 'info_pjgt');
  $gtList = $contents->where('section', 'info_gt');
@endphp
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
  <div>
 <h4 class="fw-bold mb-1" style="color:var(--green)">Kelola Konten </h4>
    <p class="small mb-0" style="color:#5d4037">Pisahkan konten: Landing Publik vs Dashboard GT/PJGT. <a href="{{ route('landing') }}" target="_blank" style="color:var(--gold);font-weight:700">Lihat Landing <i class="bi bi-box-arrow-up-right"></i></a></p>
  </div>
  <a href="{{ route('landing-contents.create') }}" class="btn-green"><i class="bi bi-plus-circle"></i> Tambah Konten</a>
</div>

{{-- 4 CARD GRUP --}}
<div class="row g-2 g-md-3 mb-3">
  <div class="col-6 col-lg-3">
    <div class="card h-100" style="border:2px solid var(--green);border-radius:16px;background:linear-gradient(135deg,#0a3d1f,#0f5a2e);color:#fff">
      <div class="card-body p-3">
        <div class="d-flex align-items-center gap-2 mb-2">
          <div style="width:42px;height:42px;border-radius:12px;background:var(--gold);color:var(--green);display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0"><i class="bi bi-globe2"></i></div>
          <div><div class="small fw-bold" style="color:var(--gold);font-size:11px;letter-spacing:1px">LANDING PAGE</div><div class="fs-4 fw-bold" style="line-height:1">{{ $landingList->count() }} <span class="small fw-normal" style="opacity:.7;font-size:11px">konten</span></div></div>
        </div>
        <div class="small mb-2" style="opacity:.8">Hero • Informasi • Pengumuman • Panduan • Alur → tampil di `/`</div>
        <div class="d-flex gap-1">
          <a href="#grup-landing" class="btn btn-sm flex-fill" style="background:#fff;color:var(--green);border-radius:20px;font-weight:700;font-size:11px">Lihat</a>
          <a href="{{ route('landing-contents.create', ['section'=>'informasi']) }}" class="btn btn-sm flex-fill" style="background:var(--gold);color:var(--green);border-radius:20px;font-weight:700;font-size:11px">+ Tambah</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card h-100" style="border:2px solid #d4af37;border-radius:16px;background:#fffbe6">
      <div class="card-body p-3">
        <div class="d-flex align-items-center gap-2 mb-2">
          <div style="width:42px;height:42px;border-radius:12px;background:#d4af37;color:#fff;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0"><i class="bi bi-megaphone-fill"></i></div>
          <div><div class="small fw-bold" style="color:#8a7a3a;font-size:11px;letter-spacing:1px">INFO UMUM</div><div class="fs-4 fw-bold" style="color:var(--green);line-height:1">{{ $umumList->count() }} <span class="small fw-normal" style="color:#8a7a3a;font-size:11px">konten</span></div></div>
        </div>
        <div class="small mb-2" style="color:#5d4037">Tab Informasi Umum → Dashboard GT & PJGT</div>
        <div class="d-flex gap-1">
          <a href="#grup-umum" class="btn btn-sm flex-fill" style="background:var(--green);color:var(--gold);border-radius:20px;font-weight:700;font-size:11px">Lihat</a>
          <a href="{{ route('landing-contents.create', ['section'=>'info_umum']) }}" class="btn btn-sm flex-fill" style="background:#fff;border:1.5px solid var(--green);color:var(--green);border-radius:20px;font-weight:700;font-size:11px">+ Tambah</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card h-100" style="border:2px solid #198754;border-radius:16px;background:#eef7f0">
      <div class="card-body p-3">
        <div class="d-flex align-items-center gap-2 mb-2">
          <div style="width:42px;height:42px;border-radius:12px;background:#198754;color:#fff;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0"><i class="bi bi-person-video3"></i></div>
          <div><div class="small fw-bold" style="color:#198754;font-size:11px;letter-spacing:1px">INFO PJGT</div><div class="fs-4 fw-bold" style="color:#0a3d1f;line-height:1">{{ $pjgtList->count() }} <span class="small fw-normal" style="color:#5d4037;font-size:11px">konten</span></div></div>
        </div>
        <div class="small mb-2" style="color:#5d4037">Tab Informasi PJGT → khusus Dashboard PJGT</div>
        <div class="d-flex gap-1">
          <a href="#grup-pjgt" class="btn btn-sm flex-fill" style="background:#198754;color:#fff;border-radius:20px;font-weight:700;font-size:11px">Lihat</a>
          <a href="{{ route('landing-contents.create', ['section'=>'info_pjgt']) }}" class="btn btn-sm flex-fill" style="background:#fff;border:1.5px solid #198754;color:#198754;border-radius:20px;font-weight:700;font-size:11px">+ Tambah</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card h-100" style="border:2px solid #0a3d1f;border-radius:16px;background:#fff">
      <div class="card-body p-3">
        <div class="d-flex align-items-center gap-2 mb-2">
          <div style="width:42px;height:42px;border-radius:12px;background:#0a3d1f;color:#d4af37;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0"><i class="bi bi-mortarboard-fill"></i></div>
          <div><div class="small fw-bold" style="color:#0a3d1f;font-size:11px;letter-spacing:1px">INFO GT</div><div class="fs-4 fw-bold" style="color:#0a3d1f;line-height:1">{{ $gtList->count() }} <span class="small fw-normal" style="color:#8a7a3a;font-size:11px">konten</span></div></div>
        </div>
        <div class="small mb-2" style="color:#5d4037">Tab Informasi GT → khusus Dashboard GT</div>
        <div class="d-flex gap-1">
          <a href="#grup-gt" class="btn btn-sm flex-fill" style="background:#0a3d1f;color:#d4af37;border-radius:20px;font-weight:700;font-size:11px">Lihat</a>
          <a href="{{ route('landing-contents.create', ['section'=>'info_gt']) }}" class="btn btn-sm flex-fill" style="background:#fff;border:1.5px solid #0a3d1f;color:#0a3d1f;border-radius:20px;font-weight:700;font-size:11px">+ Tambah</a>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- GRUP 1: LANDING --}}
<div class="card-form mb-3" id="grup-landing">
  <div class="card-form-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-globe2" style="color:var(--green)"></i> Landing Page <span class="badge" style="background:var(--green);color:var(--gold)">{{ $landingList->count() }}</span> <span class="small fw-normal d-none d-md-inline" style="color:#8a7a3a">hero • informasi • pengumuman • panduan • alur</span></span>
    <a href="{{ route('landing-contents.create', ['section'=>'informasi']) }}" class="btn btn-sm" style="background:var(--green);color:var(--gold);border-radius:20px;font-weight:700;font-size:11px">+ Tambah Landing</a>
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0 small">
      <thead style="background:var(--cream2);color:var(--green)"><tr><th>#</th><th>Section</th><th>Judul</th><th>Kategori</th><th>Tanggal</th><th>Aktif</th><th>Aksi</th></tr></thead>
      <tbody>
        @forelse($landingList as $c)
        <tr>
          <td>{{ $c->sort_order }}</td>
          <td><span class="badge" style="background:var(--green);color:var(--gold)">{{ $c->section }}</span></td>
          <td>
            <strong style="color:var(--green)">{{ $c->title }}</strong>
            <div style="color:#5d4037;font-size:11px">{{ \Illuminate\Support\Str::limit($c->content, 60) }}</div>
          </td>
          <td>{{ $c->category }}</td>
          <td>{{ $c->date_label }}</td>
          <td>
            @if($c->is_active)
            <span class="badge" style="background:#198754;color:#fff">Aktif</span>
            @else
            <span class="badge" style="background:#6c757d;color:#fff">Nonaktif</span>
            @endif
          </td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('landing-contents.edit', $c) }}" class="btn btn-sm" style="background:var(--cream);border:1px solid var(--gold);color:var(--green);border-radius:20px">Edit</a>
              <form method="POST" action="{{ route('landing-contents.destroy', $c) }}" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="btn btn-sm" style="background:#ffe9e9;border:1px solid #ffb3b3;color:#7a0a0a;border-radius:20px">Hapus</button></form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center py-3" style="color:var(--brown)">Belum ada konten landing. <a href="{{ route('landing-contents.create', ['section'=>'informasi']) }}" style="color:var(--green);font-weight:700">Tambah pertama</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- GRUP 2: INFO UMUM --}}
<div class="card-form mb-3" id="grup-umum">
  <div class="card-form-header d-flex justify-content-between align-items-center flex-wrap gap-2" style="background:linear-gradient(135deg,#fffbe6,#fdf0c7)">
    <span><i class="bi bi-megaphone-fill" style="color:#b8941f"></i> Informasi Umum <span class="badge" style="background:#d4af37;color:#fff">{{ $umumList->count() }}</span> <span class="small fw-normal d-none d-md-inline" style="color:#8a7a3a">tab Umum di GT & PJGT</span></span>
    <a href="{{ route('landing-contents.create', ['section'=>'info_umum']) }}" class="btn btn-sm" style="background:#d4af37;color:#0a3d1f;border-radius:20px;font-weight:700;font-size:11px">+ Tambah Umum</a>
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0 small">
      <thead style="background:var(--cream2);color:var(--green)"><tr><th>#</th><th>Judul</th><th>Tanggal</th><th>Aktif</th><th>Aksi</th></tr></thead>
      <tbody>
        @forelse($umumList as $c)
        <tr>
          <td>{{ $c->sort_order }}</td>
          <td>
            <strong style="color:var(--green)">{{ $c->title }}</strong>
            <div style="color:#5d4037;font-size:11px">{{ \Illuminate\Support\Str::limit($c->content, 60) }}</div>
          </td>
          <td>{{ $c->date_label }}</td>
          <td>
            @if($c->is_active)
            <span class="badge" style="background:#198754;color:#fff">Aktif</span>
            @else
            <span class="badge" style="background:#6c757d;color:#fff">Nonaktif</span>
            @endif
          </td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('landing-contents.edit', $c) }}" class="btn btn-sm" style="background:var(--cream);border:1px solid var(--gold);color:var(--green);border-radius:20px">Edit</a>
              <form method="POST" action="{{ route('landing-contents.destroy', $c) }}" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="btn btn-sm" style="background:#ffe9e9;border:1px solid #ffb3b3;color:#7a0a0a;border-radius:20px">Hapus</button></form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center py-3" style="color:var(--brown)">Belum ada info umum. <a href="{{ route('landing-contents.create', ['section'=>'info_umum']) }}" style="color:var(--green);font-weight:700">Tambah pertama</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- GRUP 3: INFO PJGT --}}
<div class="card-form mb-3" id="grup-pjgt">
  <div class="card-form-header d-flex justify-content-between align-items-center flex-wrap gap-2" style="background:linear-gradient(135deg,#eef7f0,#dff0e2)">
    <span><i class="bi bi-person-video3" style="color:#198754"></i> Informasi PJGT <span class="badge" style="background:#198754;color:#fff">{{ $pjgtList->count() }}</span> <span class="small fw-normal d-none d-md-inline" style="color:#5d4037">khusus dashboard PJGT</span></span>
    <a href="{{ route('landing-contents.create', ['section'=>'info_pjgt']) }}" class="btn btn-sm" style="background:#198754;color:#fff;border-radius:20px;font-weight:700;font-size:11px">+ Tambah PJGT</a>
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0 small">
      <thead style="background:#dff0e2;color:#0a3d1f"><tr><th>#</th><th>Judul</th><th>Tanggal</th><th>Aktif</th><th>Aksi</th></tr></thead>
      <tbody>
        @forelse($pjgtList as $c)
        <tr>
          <td>{{ $c->sort_order }}</td>
          <td>
            <strong style="color:var(--green)">{{ $c->title }}</strong>
            <div style="color:#5d4037;font-size:11px">{{ \Illuminate\Support\Str::limit($c->content, 60) }}</div>
          </td>
          <td>{{ $c->date_label }}</td>
          <td>
            @if($c->is_active)
            <span class="badge" style="background:#198754;color:#fff">Aktif</span>
            @else
            <span class="badge" style="background:#6c757d;color:#fff">Nonaktif</span>
            @endif
          </td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('landing-contents.edit', $c) }}" class="btn btn-sm" style="background:var(--cream);border:1px solid var(--gold);color:var(--green);border-radius:20px">Edit</a>
              <form method="POST" action="{{ route('landing-contents.destroy', $c) }}" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="btn btn-sm" style="background:#ffe9e9;border:1px solid #ffb3b3;color:#7a0a0a;border-radius:20px">Hapus</button></form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center py-3" style="color:var(--brown)">Belum ada info PJGT. <a href="{{ route('landing-contents.create', ['section'=>'info_pjgt']) }}" style="color:#198754;font-weight:700">Tambah pertama</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- GRUP 4: INFO GT --}}
<div class="card-form mb-3" id="grup-gt">
  <div class="card-form-header d-flex justify-content-between align-items-center flex-wrap gap-2" style="background:linear-gradient(135deg,#fff,#f0ead6)">
    <span><i class="bi bi-mortarboard-fill" style="color:var(--green)"></i> Informasi GT <span class="badge" style="background:var(--green);color:var(--gold)">{{ $gtList->count() }}</span> <span class="small fw-normal d-none d-md-inline" style="color:#8a7a3a">khusus dashboard GT</span></span>
    <a href="{{ route('landing-contents.create', ['section'=>'info_gt']) }}" class="btn btn-sm" style="background:var(--green);color:var(--gold);border-radius:20px;font-weight:700;font-size:11px">+ Tambah GT</a>
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0 small">
      <thead style="background:var(--cream2);color:var(--green)"><tr><th>#</th><th>Judul</th><th>Tanggal</th><th>Aktif</th><th>Aksi</th></tr></thead>
      <tbody>
        @forelse($gtList as $c)
        <tr>
          <td>{{ $c->sort_order }}</td>
          <td>
            <strong style="color:var(--green)">{{ $c->title }}</strong>
            <div style="color:#5d4037;font-size:11px">{{ \Illuminate\Support\Str::limit($c->content, 60) }}</div>
          </td>
          <td>{{ $c->date_label }}</td>
          <td>
            @if($c->is_active)
            <span class="badge" style="background:#198754;color:#fff">Aktif</span>
            @else
            <span class="badge" style="background:#6c757d;color:#fff">Nonaktif</span>
            @endif
          </td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('landing-contents.edit', $c) }}" class="btn btn-sm" style="background:var(--cream);border:1px solid var(--gold);color:var(--green);border-radius:20px">Edit</a>
              <form method="POST" action="{{ route('landing-contents.destroy', $c) }}" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="btn btn-sm" style="background:#ffe9e9;border:1px solid #ffb3b3;color:#7a0a0a;border-radius:20px">Hapus</button></form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center py-3" style="color:var(--brown)">Belum ada info GT. <a href="{{ route('landing-contents.create', ['section'=>'info_gt']) }}" style="color:var(--green);font-weight:700">Tambah pertama</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3 p-3 rounded-3" style="background:var(--cream);border:1.5px dashed var(--gold);">
  <h6 class="fw-bold" style="color:var(--green)"><i class="bi bi-lightbulb" style="color:var(--gold)"></i> Cara pakai</h6>
  <ul class="small mb-0" style="color:#5d4037;line-height:1.8">
    <li><strong>Landing publik (/):</strong> grup Landing Page → tampil sebagai kartu Informasi & Pengumuman.</li>
    <li><strong>Dashboard:</strong> grup Umum → tab Informasi Umum (GT+PJGT), grup PJGT → tab PJGT, grup GT → tab GT.</li>
    <li><strong>Sort Order:</strong> angka kecil tampil di atas (0 = paling atas). Nonaktif = disembunyikan.</li>
  </ul>
</div>
@endsection

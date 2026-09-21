@extends('layouts.app')
@section('title','Dashboard - TMTB & DAI KIK')
@section('breadcrumb','Dashboard')
@push('styles')
<style>
  @keyframes tabActiveGlow{0%,100%{box-shadow:0 4px 14px rgba(29,122,61,.35)}50%{box-shadow:0 4px 20px rgba(212,175,55,.5)}}
  .gt-tabs{border-bottom:1px solid #e5e5e5;gap:4px}
  .gt-tabs .nav-link{position:relative;font-size:13px;color:#555;background:#f1f1f1;border:1px solid #e5e5e5;border-bottom:none;border-radius:8px 8px 0 0;padding:9px 16px;transition:background-color .25s ease,color .25s ease,transform .18s ease,box-shadow .25s ease;overflow:hidden}
  .gt-tabs .nav-link:hover{background:#e6f4ea;color:#0a4d26;transform:translateY(-1px)}
  .gt-tabs .nav-link::after{content:'';position:absolute;left:10px;right:10px;bottom:0;height:3px;border-radius:10px;background:linear-gradient(90deg,#d4af37,#1d7a3d);transform:scaleX(0);transform-origin:left;transition:transform .28s ease}
  .gt-tabs .nav-link.active{background:linear-gradient(135deg,#1d7a3d,#0a4d26);color:#fff !important;border-color:#0a4d26;animation:tabActiveGlow 2.4s ease-in-out infinite}
  .gt-tabs .nav-link.active::after{transform:scaleX(1)}
  .gt-tabs .nav-link:active{transform:scale(.97)}
</style>
@endpush
@section('content')
{{-- ============ DASHBOARD GT ALA SIAKAD (informasi + profil) ============ --}}
@if(($isGt ?? false) || ($isPjgt ?? false))
@php $u = auth()->user(); @endphp
<div style="background:linear-gradient(135deg,#0a7a3d 0%,#0a4d26 60%,#083d1e 100%);margin:-22px -22px 0;padding:26px 26px 56px;">
  <div class="d-flex justify-content-between align-items-start gap-2">
    <div>
      <h4 class="fw-bold mb-1 text-white" style="font-size:22px">Dashboard</h4>
      <div class="small text-white" style="opacity:.85">Selamat Datang {{ $u->name }}</div>
    </div>
    <span class="px-3 py-1 fw-bold" style="border:1.5px solid #fff;color:#fff;border-radius:50px;font-size:11px;letter-spacing:1px">{{ ($isPjgt ?? false) ? 'PJGT' : 'GURU TUGAS' }}</span>
  </div>
</div>

<div class="p-3 p-md-4 mb-3 rounded-4 position-relative overflow-hidden" style="background:linear-gradient(120deg,#0c5a2e 0%,#083d1e 55%,#062b15 100%);color:#fff;margin-top:-38px;box-shadow:0 12px 32px rgba(6,43,21,.35);border:1px solid rgba(212,175,55,.35)">
  <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#d4af37,#f4e2a0,#d4af37)"></div>
  <div style="position:absolute;right:-40px;top:-40px;width:170px;height:170px;background:radial-gradient(circle,rgba(212,175,55,.22),transparent 70%);border-radius:50%"></div>
  <div style="position:absolute;right:60px;bottom:-60px;width:150px;height:150px;background:radial-gradient(circle,rgba(255,255,255,.08),transparent 70%);border-radius:50%"></div>
  <div class="d-flex align-items-center gap-3 position-relative">
    <div style="width:72px;height:72px;border-radius:20px;background:rgba(255,255,255,.95);display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 6px 18px rgba(0,0,0,.25)"><img src="{{ asset('images/madin.png?v=2') }}" alt="" style="width:58px;height:58px;object-fit:contain"></div>
    <div class="flex-fill" style="min-width:0">
      <span class="fw-bold" style="font-size:10px;letter-spacing:1.5px;color:#0a3d1f;background:linear-gradient(90deg,#d4af37,#f4e2a0);border-radius:20px;padding:3px 10px">1448/1449 GANJIL</span>
      <div class="fw-bold mt-1" style="font-size:clamp(18px,5vw,24px);letter-spacing:.3px">TMTB &amp; DAI KIK</div>
      <div class="small" style="opacity:.7">PP KUNUUZUL IMAM KAUMAN • KAUMAN BONDOWOSO</div>
    </div>
  </div>
</div>

<div class="row g-2 g-md-3">
  <div class="col-12 col-lg-8">
    <div class="card" style="border:1px solid #e9e2cb;border-radius:16px;box-shadow:0 8px 28px rgba(20,40,25,.10);overflow:hidden">
      <div class="p-3 d-flex align-items-center gap-3" style="border-bottom:1px solid #f0ead6;background:linear-gradient(135deg,#fffdf4,#faf5e2)">
        <div style="width:44px;height:44px;border-radius:14px;background:linear-gradient(135deg,#0a3d1f,#1d7a3d);color:#f4e2a0;display:flex;align-items:center;justify-content:center;font-size:19px;flex-shrink:0"><i class="bi bi-megaphone-fill"></i></div>
        <div class="flex-fill" style="min-width:0">
          <div style="color:#22335e;font-size:17px;font-weight:700">Informasi</div>
          <div class="small" style="color:#8a8570">Pengumuman &amp; penempatan terbaru</div>
        </div>
      </div>
      <div class="px-3 pt-3">
        <ul class="nav nav-tabs gt-tabs">
          <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pane-umum" type="button" role="tab">Informasi Umum</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pane-gt" type="button" role="tab">Informasi {{ ($isPjgt ?? false) ? 'PJGT' : 'Guru Tugas' }}</button></li>
        </ul>
        <div class="tab-content py-3">
          <div class="tab-pane fade show active" id="pane-umum" role="tabpanel">
            {{-- Sapaan statis selalu tampil --}}
            <div class="small p-3 mb-2 rounded-3 d-flex gap-2" style="background:linear-gradient(135deg,#fdf6e3,#faf0c8);border:1px solid #e8d9a0;color:#5d4037"><i class="bi bi-patch-check-fill mt-1" style="color:#1d7a3d;font-size:16px"></i><span><strong style="color:#0a3d1f">Assalamualaikum {{ explode(' ', $u->name)[0] }},</strong><br>Anda terdaftar sebagai {{ ($isPjgt ?? false) ? 'PJGT' : 'Guru Tugas' }} TMTB &amp; DAI KIK tahun 1448/1449 H. Absensi mengajar &amp; shalat 5 waktu diisi lewat menu Absensi Kehadiran.</span></div>
            {{-- Dinamis dari Kelola Landing → info_umum --}}
            @if(isset($infoUmum) && $infoUmum->count())
              @foreach($infoUmum as $inf)
              <div class="small p-3 mb-2 rounded-3 d-flex gap-2" style="background:#fff;border:1px solid #e8d9a0;color:#5d4037;border-left:4px solid #d4af37">
                <i class="bi bi-megaphone-fill mt-1" style="color:#b8941f;font-size:16px"></i>
                <span style="flex:1;min-width:0">
                  <strong style="color:#0a3d1f">{{ $inf->title }}</strong>
                  @if(!empty($inf->subtitle))<br><span style="color:#b8941f;font-weight:700">{{ $inf->subtitle }}</span>@endif
                  @if(!empty($inf->content))<br>{{ $inf->content }}@endif
                  @if(!empty($inf->date_label))<br><span class="small" style="color:#8a7a3a"><i class="bi bi-calendar3"></i> {{ $inf->date_label }}</span>@endif
                  @if(!empty($inf->link_text))<br><a href="{{ $inf->link_url ? $inf->link_url : '#' }}" style="color:#0a3d1f;font-weight:700">{{ $inf->link_text }} <i class="bi bi-arrow-right"></i></a>@endif
                </span>
              </div>
              @endforeach
            @else
            <div class="small p-3 mb-2 rounded-3 d-flex gap-2" style="background:#fff;border:1px solid #eee;color:#5d4037"><i class="bi bi-calendar-event mt-1" style="color:#d4af37;font-size:16px"></i><span><strong>Apel &amp; Pembekalan:</strong> koordinasi dengan koordinator / PJGT sebelum berangkat ke lokasi tugas.</span></div>
            <div class="small p-3 rounded-3 d-flex gap-2" style="background:#fff;border:1px solid #eee;color:#5d4037"><i class="bi bi-book-half mt-1" style="color:#0a3d1f;font-size:16px"></i><span><strong>Kurikulum:</strong> Aqidah • Fiqh • Ilmu Alat • Qur'an • Akhlaq.</span></div>
            @endif
          </div>
          <div class="tab-pane fade" id="pane-gt" role="tabpanel">
            {{-- Dinamis role: info_pjgt untuk PJGT, info_gt untuk GT --}}
            @php $infoRole = ($isPjgt ?? false) ? ($infoPjgt ?? collect()) : ($infoGt ?? collect()); @endphp
            @if($infoRole->count())
              @foreach($infoRole as $inf)
              <div class="small p-3 mb-2 rounded-3 d-flex gap-2" style="background:linear-gradient(135deg,#eef7f0,#fff);border:1px solid #bfe0c9;color:#5d4037;border-left:4px solid #198754">
                <i class="bi bi-person-check-fill mt-1" style="color:#198754;font-size:16px"></i>
                <span style="flex:1;min-width:0">
                  <strong style="color:#0a3d1f">{{ $inf->title }}</strong>
                  @if(!empty($inf->subtitle))<br><span style="color:#198754;font-weight:700">{{ $inf->subtitle }}</span>@endif
                  @if(!empty($inf->content))<br>{{ $inf->content }}@endif
                  @if(!empty($inf->date_label))<br><span class="small" style="color:#8a7a3a"><i class="bi bi-calendar3"></i> {{ $inf->date_label }}</span>@endif
                  @if(!empty($inf->link_text))<br><a href="{{ $inf->link_url ? $inf->link_url : '#' }}" style="color:#0a3d1f;font-weight:700">{{ $inf->link_text }} <i class="bi bi-arrow-right"></i></a>@endif
                </span>
              </div>
              @endforeach
              <div class="small fw-bold mt-3 mb-2" style="color:#0a3d1f;letter-spacing:.5px"><i class="bi bi-bank" style="color:#b8941f"></i> PENEMPATAN TERBARU</div>
            @endif
            @forelse($recent as $p)
            <div class="p-3 mb-2 rounded-3" style="background:#fff;border:1px solid #e9e2cb;border-left:4px solid #198754;box-shadow:0 2px 10px rgba(0,0,0,.04)">
              <div class="d-flex justify-content-between align-items-center gap-2"><span class="badge-pendaftaran">{{ $p->pjgt_id }}</span><span class="badge" style="background:#fdf0c7;color:#0a3d1f;border:1px solid #d4af37">{{ $p->butuh_gt }} GT • {{ $p->wil }}</span></div>
              <div class="fw-bold mt-1" style="color:var(--green)"><i class="bi bi-bank" style="color:#b8941f"></i> {{ $p->nama_madrasah }}</div>
              <div class="small" style="color:#5d4037"><i class="bi bi-geo-alt"></i> {{ $p->desa ?? '' }} • {{ $p->kecamatan ?? '' }} • {{ $p->kabupaten ?? '' }}</div>
              <div class="small" style="color:#8a7a3a"><i class="bi bi-person-check"></i> PJGT: {{ $p->pjgt_nama }} • {{ $p->telepon ?? '-' }}</div>
            </div>
            @empty
            <div class="text-center small py-4" style="color:#8a7a3a"><i class="bi bi-inbox" style="font-size:22px;color:#d4af37"></i><br>Belum ada penempatan Diterima.</div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-lg-4">
    <div class="p-3 mb-3 rounded-4 position-relative overflow-hidden" style="background:linear-gradient(135deg,#0e5a30,#062b15);color:#fff;box-shadow:0 8px 24px rgba(6,43,21,.3);border:1px solid rgba(212,175,55,.3)">
      <div style="position:absolute;right:-24px;top:-24px;width:110px;height:110px;border:1.5px solid rgba(212,175,55,.35);border-radius:50%"></div>
      <div style="position:absolute;right:-8px;top:-8px;width:78px;height:78px;border:1px dashed rgba(212,175,55,.4);border-radius:50%"></div>
      <div class="d-flex align-items-center gap-2 position-relative">
        <div style="width:42px;height:42px;border-radius:13px;background:rgba(212,175,55,.16);border:1px solid rgba(212,175,55,.5);display:flex;align-items:center;justify-content:center;color:#f4e2a0;font-size:18px"><i class="bi bi-person-video3"></i></div>
        <div>
          <div class="small" style="opacity:.7;letter-spacing:1px;font-size:10px">KOORDINATOR</div>
          <div class="fw-bold" style="font-size:16px">{{ strtoupper(($tugasUtama->pjgt_nama ?? 'TMTB & DAI KIK')) }}</div>
        </div>
      </div>
    </div>

    <div class="card overflow-hidden" style="border:1px solid #e9e2cb;border-radius:16px;box-shadow:0 8px 28px rgba(20,40,25,.12)">
      <div style="height:96px;background:url('{{ asset('images/login-bg.jpg') }}') center/cover #1c3a26;position:relative">
        <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(8,45,23,.15),rgba(8,45,23,.65))"></div>
      </div>
      <div class="text-center px-3" style="margin-top:-32px;position:relative;z-index:1">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($u->name) }}&background=d4af37&color=0a3d1f&size=160" alt="" style="width:64px;height:64px;border-radius:50%;border:3px solid #fff;outline:2px solid #d4af37;object-fit:cover;box-shadow:0 6px 18px rgba(0,0,0,.2)">
        <div class="mt-2 fw-bold" style="color:#22335e;font-size:17px;letter-spacing:1.5px">{{ strtoupper($u->name) }}</div>
        <div><span class="badge mt-1" style="background:#eef7f0;color:#1d7a3d;border:1px solid #bfe0c9;font-size:11px">{{ ($isPjgt ?? false) ? 'PJGT' : 'Guru Tugas' }} • TMTB &amp; DAI KIK</span></div>
        <div class="small mt-1" style="color:#aaa">{{ $u->username }}</div>
      </div>
      <div class="p-3">
        <a href="{{ ($isPjgt ?? false) ? route('pjgt.biodata') : route('gt.biodata') }}" class="btn w-100 fw-bold" style="background:linear-gradient(135deg,#1d7a3d,#0a4d26);color:#fff;border-radius:10px;min-height:46px;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:8px;box-shadow:0 6px 16px rgba(29,122,61,.35)">Lebih Lengkap <i class="bi bi-arrow-right"></i></a>
      </div>
      <div class="d-flex text-center" style="border-top:1px solid #f0ead6;background:#fffdf4">
        <div class="flex-fill py-3"><div class="fw-bold" style="color:#0a3d1f;font-size:19px"><i class="bi bi-briefcase-fill" style="font-size:14px;color:#b8941f"></i> {{ $total }}</div><div class="small" style="color:#8a8570">tugas</div></div>
        <div class="flex-fill py-3" style="border-left:1px solid #f0ead6"><div class="fw-bold" style="color:#0a3d1f;font-size:19px"><i class="bi bi-bank" style="font-size:14px;color:#b8941f"></i> {{ $madrasahDistinct }}</div><div class="small" style="color:#8a8570">madrasah</div></div>
      </div>
    </div>
  </div>
</div>

{{-- Pengaduan GT — di dashboard GT --}}
@if($isGt ?? false)
<div class="card mb-3" style="border:2px solid #dc3545;border-radius:16px;overflow:hidden;box-shadow:0 8px 28px rgba(122,10,10,.10)">
  <div class="p-3 d-flex align-items-center justify-content-between" style="background:linear-gradient(135deg,#7a0a0a 0%, #a81414 100%);color:#fff">
    <div class="d-flex align-items-center gap-2">
      <div style="width:38px;height:38px;border-radius:10px;background:#fff;color:#7a0a0a;display:flex;align-items:center;justify-content:center"><i class="bi bi-flag-fill"></i></div>
      <div>
        <div class="fw-bold" style="font-size:14px">Pengaduan Saya ke Admin</div>
        <div class="small" style="opacity:.85">Apa yang Anda alami selama di tempat tugas — hal tak terduga untuk diadukan • {{ $pengaduanGtCount }} pengaduan</div>
      </div>
    </div>
    <a href="{{ route('pengaduan.index') }}" class="btn btn-sm" style="background:#fff;color:#7a0a0a;border-radius:20px;font-weight:700;font-size:11px">Lihat Semua <i class="bi bi-arrow-right"></i></a>
  </div>
  <div class="p-3">
    @forelse($pengaduanGt as $ad)
    <div class="d-flex gap-3 p-2 rounded-3 mb-2" style="background:#fff8f8;border:1px solid #e8d9a0">
      <div style="width:36px;height:36px;background:#7a0a0a;color:#fff;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="bi bi-exclamation-triangle-fill"></i></div>
      <div style="min-width:0;flex:1">
        <div class="small fw-bold" style="color:#7a0a0a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $ad->judul ?? $ad->kategori }} • {{ $ad->jenis_pelanggaran ?? '' }}</div>
        <div class="small" style="color:#5d4037;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $ad->nama_madrasah ?? '' }} • {{ $ad->tanggal_kejadian?->locale('id')->isoFormat('D MMM YYYY') ?? $ad->created_at->locale('id')->isoFormat('D MMM YYYY') }}</div>
        <div class="small"><span class="badge" style="background:{{$ad->status==='Menunggu'?'#d4af37':($ad->status==='Selesai'?'#198754':'#dc3545')}};color:#fff">{{ $ad->status }}</span> <span style="color:#8a7a3a;font-size:11px">{{ $ad->pjgt->name ?? '' }}</span></div>
      </div>
      <a href="{{ route('pengaduan.show',$ad) }}" class="btn btn-sm align-self-center" style="background:var(--cream);border:1px solid var(--gold);color:var(--green);border-radius:20px;font-size:11px">Detail</a>
    </div>
    @empty
 <div class="text-center small py-3" style="color:#8a7a3a"><i class="bi bi-inbox" style="font-size:20px;color:#d4af37"></i><br>Belum ada pengaduan selama di tempat tugas. </div>
    @endforelse
  </div>
</div>
@endif

@else
{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-3 gap-2 p-3 rounded-3" style="background:linear-gradient(135deg,#fff 0%, var(--cream) 100%);border:2px solid var(--gold);box-shadow:0 4px 16px rgba(10,61,31,.06);position:relative;overflow:hidden">
  <div style="position:absolute;right:12px;top:50%;transform:translateY(-50%);opacity:.06;pointer-events:none"><img src="{{ asset('images/madin.png?v=2') }}" alt="" style="width:92px;height:92px;object-fit:contain"></div>
  <div style="min-width:0;position:relative;z-index:1" class="d-flex align-items-center gap-3">
    <img src="{{ asset('images/madin.png?v=2') }}" alt="Madin" style="width:48px;height:48px;object-fit:contain;filter:drop-shadow(0 3px 8px rgba(10,61,31,.12));flex-shrink:0" class="d-none d-sm-block">
    <div>
 <h4 class="mb-1 fw-bold" style="color:var(--green);font-size:clamp(18px,5vw,22px)">Dashboard <span style="color:var(--gold)">KIK</span> </h4>
      <p class="small mb-0" style="color:#5d4037;line-height:1.4">
        @if($isAdmin) Admin • Kelola {{ $allTotal }} permohonan • <span style="color:#dc3545;font-weight:700">{{ $allProses }} pending</span>
        @elseif($isPjgt) PJGT • {{ $total }} permohonan milik Anda
        @else GT • {{ $total }} tugas penempatan (Diterima)
        @endif
      </p>
    </div>
  </div>
  <span class="badge-pendaftaran d-none d-md-inline flex-shrink-0" style="position:relative;z-index:1">1448/1449 H • TMTB & DAI</span>
  <span class="badge-pendaftaran d-md-none flex-shrink-0" style="font-size:11px;position:relative;z-index:1">1448 H</span>
</div>

{{-- 1. KPI 6 cards --}}
<div class="row g-2 g-md-3 mb-3">
  <div class="col-6 col-lg-2 col-md-4">
    <div class="card h-100" style="border:2px solid var(--gold);border-radius:16px;background:#fff;box-shadow:0 4px 16px rgba(10,61,31,.06)">
      <div class="card-body p-3 d-flex align-items-center gap-2">
        <div style="width:46px;height:46px;background:var(--green);color:var(--gold);border:2px solid var(--gold);border-radius:12px;display:flex;align-items:center;justify-content:center"><i class="bi bi-journal-bookmark-fill"></i></div>
 <div><div class="small" style="color:#8a7a3a;font-weight:600;font-size:11px">@if(($isGt ?? false) || ($isPjgt ?? false)) Tugas Saya @else Total @endif</div><div class="fw-bold" style="color:var(--green);font-size:20px;line-height:1">{{ $total }}</div></div>
      </div>
    </div>
  </div>
  @unless($isGt ?? false)
  <div class="col-6 col-lg-2 col-md-4">
    <div class="card h-100" style="border:2px solid #d4af37;border-radius:16px;background:linear-gradient(135deg,#fffbe6 0%, #fff 100%);box-shadow:0 4px 16px rgba(212,175,55,.18);position:relative;overflow:hidden">
      <div style="position:absolute;top:6px;right:8px;width:8px;height:8px;background:#d4af37;border-radius:50%;animation:pulse 1.5s infinite"></div>
      <div class="card-body p-3 d-flex align-items-center gap-2">
        <div style="width:46px;height:46px;background:#d4af37;color:#fff;border:2px solid var(--green);border-radius:12px;display:flex;align-items:center;justify-content:center"><i class="bi bi-hourglass-split"></i></div>
        <div><div class="small" style="color:#8a7a3a;font-weight:700;font-size:11px">Proses</div><div class="fw-bold" style="color:#b8941f;font-size:20px;line-height:1">{{ $proses }}</div><div class="small" style="color:#dc3545;font-size:10px;font-weight:600">{{ $isAdmin ? $allProses.' pending' : 'menunggu' }}</div></div>
      </div>
    </div>
  </div>
  @endunless
  <div class="col-6 col-lg-2 col-md-4">
    <div class="card h-100" style="border:2px solid #198754;border-radius:16px;background:#fff;">
      <div class="card-body p-3 d-flex align-items-center gap-2">
        <div style="width:46px;height:46px;background:#198754;color:#fff;border-radius:12px;display:flex;align-items:center;justify-content:center"><i class="bi bi-check-circle-fill"></i></div>
 <div><div class="small" style="color:#8a7a3a;font-weight:600;font-size:11px">@if(($isGt ?? false) || ($isPjgt ?? false)) Tugas Aktif @else Diterima @endif</div><div class="fw-bold" style="color:#198754;font-size:20px;line-height:1">{{ $diterima }}</div></div>
      </div>
    </div>
  </div>
  @unless($isGt ?? false)
  <div class="col-6 col-lg-2 col-md-4">
    <div class="card h-100" style="border:2px solid #dc3545;border-radius:16px;background:#fff;">
      <div class="card-body p-3 d-flex align-items-center gap-2">
        <div style="width:46px;height:46px;background:#dc3545;color:#fff;border-radius:12px;display:flex;align-items:center;justify-content:center"><i class="bi bi-x-circle-fill"></i></div>
 <div><div class="small" style="color:#8a7a3a;font-weight:600;font-size:11px">Ditolak</div><div class="fw-bold" style="color:#dc3545;font-size:20px;line-height:1">{{ $ditolak }}</div></div>
      </div>
    </div>
  </div>
  @endunless
  <div class="col-6 col-lg-2 col-md-4">
    <div class="card h-100" style="border:2px solid var(--green);border-radius:16px;background:linear-gradient(135deg,var(--green) 0%, #0f5a2e 100%);color:var(--cream)">
      <div class="card-body p-3 d-flex align-items-center gap-2">
        <div style="width:46px;height:46px;background:var(--cream);color:var(--green);border:2px solid var(--gold);border-radius:12px;display:flex;align-items:center;justify-content:center"><i class="bi bi-people-fill"></i></div>
        <div><div class="small" style="color:var(--gold);font-size:11px">Butuh GT</div><div class="fw-bold" style="color:var(--gold);font-size:20px;line-height:1">{{ $butuhGt }}</div><div class="small" style="color:var(--cream);opacity:.7;font-size:10px">orang</div></div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-2 col-md-4">
    <div class="card h-100" style="border:2px solid var(--gold);border-radius:16px;background:#fff;">
      <div class="card-body p-3 d-flex align-items-center gap-2">
        <div style="width:46px;height:46px;background:var(--gold);color:var(--green);border:2px solid var(--green);border-radius:12px;display:flex;align-items:center;justify-content:center"><i class="bi bi-mortarboard-fill"></i></div>
 <div><div class="small" style="color:#8a7a3a;font-weight:600;font-size:11px">Madrasah</div><div class="fw-bold" style="color:var(--green);font-size:20px;line-height:1">{{ $madrasahDistinct }}</div></div>
      </div>
    </div>
  </div>
</div>
<style>@keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}</style>

<div class="row g-2 g-md-3 mb-3">
  {{-- 2. Antrian Approve (admin) / Recent --}}
  <div class="col-12 col-lg-8">
    @if($isAdmin)
    <div class="card-form h-100">
      <div class="card-form-header d-flex justify-content-between align-items-center gap-2 flex-wrap">
 <span><i class="bi bi-hourglass-top" style="color:#dc3545"></i> Antrian Persetujuan <span class="badge" style="background:#dc3545;color:#fff">{{ $pending->count() }}</span> </span>
        <a href="{{ route('permohonan.lama',['status'=>'Proses']) }}" class="btn btn-sm" style="background:var(--green);color:var(--gold);border:1.5px solid var(--gold);border-radius:50px;font-size:11px;font-weight:700">Lihat Semua Proses <i class="bi bi-arrow-right"></i></a>
      </div>
      <div class="table-responsive d-none d-md-block">
        <table class="table table-hover mb-0 small" style="border-color:#e8d9a0">
          <thead style="background:var(--cream2);color:var(--green)"><tr><th>ID</th><th>PJGT / Madrasah</th><th>Wil</th><th>Rapot</th><th>Aksi</th></tr></thead>
          <tbody>
            @forelse($pending as $p)
            <tr>
              <td><span class="badge-pendaftaran">{{ $p->pjgt_id }}</span></td>
              <td><div style="color:var(--green);font-weight:700">{{ $p->pjgt_nama }}</div><div style="color:#5d4037;font-size:11px">{{ $p->nama_madrasah }} • {{ $p->tahun }}</div></td>
              <td><span class="badge" style="background:var(--cream2);color:var(--green);border:1px solid var(--gold)">{{ $p->wil }}</span></td>
              <td><span class="badge" style="background:{{$p->rapot=='A'?'#0a3d1f':($p->rapot=='B'?'#d4af37':'#8a7a3a')}};color:#fff">{{ $p->rapot }}</span></td>
              <td class="d-flex gap-1">
                <a href="{{ route('permohonan.show',$p) }}" class="btn btn-sm" style="background:var(--cream);border:1px solid var(--gold);color:var(--green);border-radius:20px;font-size:11px">Detail</a>
                <form method="POST" action="{{ route('permohonan.approve',$p) }}" class="d-inline">@csrf<button name="status" value="Diterima" class="btn btn-sm" style="background:#198754;color:#fff;border-radius:20px;font-size:11px" onclick="return confirm('Setujui {{ $p->pjgt_id }}?')">✓</button></form>
                <form method="POST" action="{{ route('permohonan.approve',$p) }}" class="d-inline">@csrf<button name="status" value="Ditolak" class="btn btn-sm" style="background:#dc3545;color:#fff;border-radius:20px;font-size:11px" onclick="return confirm('Tolak {{ $p->pjgt_id }}?')">✕</button></form>
              </td>
            </tr>
            @empty
 <tr><td colspan="5" class="text-center py-4" style="color:var(--brown)">Tidak ada antrian. Semua sudah diproses </td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="d-md-none p-2">
        @forelse($pending as $p)
        <div class="p-3 mb-2 rounded-3" style="background:#fff;border:1.5px solid #e8d9a0;border-left:4px solid #dc3545">
          <div class="d-flex justify-content-between"><span class="badge-pendaftaran">{{ $p->pjgt_id }}</span><span class="badge" style="background:#d4af37;color:#000">{{ $p->rapot }}</span></div>
          <div class="fw-bold mt-1" style="color:var(--green)">{{ $p->pjgt_nama }}</div>
          <div class="small" style="color:#5d4037">{{ $p->nama_madrasah }} • {{ $p->wil }}</div>
          <div class="d-flex gap-1 mt-2"><a href="{{ route('permohonan.show',$p) }}" class="btn btn-sm flex-fill" style="background:var(--green);color:var(--gold);border-radius:20px">Detail</a><form method="POST" action="{{ route('permohonan.approve',$p) }}" class="flex-fill">@csrf<button name="status" value="Diterima" class="btn btn-sm w-100" style="background:#198754;color:#fff;border-radius:20px">Setujui</button></form></div>
        </div>
        @empty
        <div class="text-center py-3 small" style="color:var(--brown)">Tidak ada antrian</div>
        @endforelse
      </div>
    </div>
    @elseif($isPjgt)
    <div class="card-form h-100">
      <div class="card-form-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-collection-fill" style="color:var(--gold)"></i> Permohonan Terbaru</span>
        <a href="{{ route('permohonan.lama') }}" class="btn btn-sm" style="background:var(--gold);color:var(--green);border:1.5px solid var(--green);border-radius:50px;font-size:11px;font-weight:700">Lihat Semua</a>
      </div>
      <div class="table-responsive d-none d-md-block">
        <table class="table table-hover mb-0 small"><thead style="background:var(--cream2);color:var(--green)"><tr><th>ID</th><th>Nama</th><th>Madrasah</th><th>Tahun</th><th>Status</th></tr></thead>
        <tbody>@forelse($recent as $p)<tr><td><span class="badge-pendaftaran">{{ $p->pjgt_id }}</span></td><td style="color:var(--green);font-weight:600">{{ $p->pjgt_nama }}</td><td>{{ $p->nama_madrasah }}</td><td>{{ $p->tahun }}</td><td><span class="badge" style="background:var(--green);color:var(--gold)">{{ $p->status }}</span></td></tr>@empty<tr><td colspan="5" class="text-center py-3">Belum ada data</td></tr>@endforelse</tbody></table>
      </div>
      <div class="d-md-none p-2">@forelse($recent as $p)<div class="p-3 mb-2 rounded-3" style="background:#fff;border:1.5px solid #e8d9a0;border-left:4px solid var(--gold)"><div class="d-flex justify-content-between"><span class="badge-pendaftaran">{{ $p->pjgt_id }}</span><span class="badge" style="background:var(--green);color:var(--gold)">{{ $p->status }}</span></div><div class="fw-bold mt-1" style="color:var(--green)">{{ $p->pjgt_nama }}</div><div class="small" style="color:#5d4037">{{ $p->nama_madrasah }}</div></div>@empty<div class="text-center py-3 small">Belum ada</div>@endforelse</div>
    </div>
    @else
    {{-- GT: Daftar tugas penempatan (Diterima) --}}
    <div class="card-form h-100">
      <div class="card-form-header d-flex justify-content-between align-items-center gap-2 flex-wrap">
        <span><i class="bi bi-briefcase-fill" style="color:var(--green)"></i> Tugas Penempatan <span class="badge" style="background:#198754;color:#fff">{{ $total }}</span></span>
        <a href="{{ route('permohonan.lama') }}" class="btn btn-sm" style="background:var(--green);color:var(--gold);border:1.5px solid var(--gold);border-radius:50px;font-size:11px;font-weight:700">Semua Tugas <i class="bi bi-arrow-right"></i></a>
      </div>
      <div class="table-responsive d-none d-md-block">
        <table class="table table-hover mb-0 small"><thead style="background:var(--cream2);color:var(--green)"><tr><th>ID</th><th>Madrasah / Lokasi</th><th>Butuh</th><th>Aksi</th></tr></thead>
        <tbody>@forelse($recent as $p)<tr><td><span class="badge-pendaftaran">{{ $p->pjgt_id }}</span></td><td><div style="color:var(--green);font-weight:700">{{ $p->nama_madrasah }}</div><div style="color:#5d4037;font-size:11px">{{ $p->desa ?? '' }}{{ isset($p->kecamatan) ? ' • '.$p->kecamatan : '' }} • {{ $p->kabupaten ?? '' }} • {{ $p->wil }}</div><div style="font-size:11px;color:#8a7a3a">PJGT: {{ $p->pjgt_nama }} • {{ $p->telepon ?? '-' }}</div></td><td><span class="badge" style="background:var(--gold);color:var(--green)">{{ $p->butuh_gt }} GT</span></td><td><a href="{{ route('permohonan.show',$p) }}" class="btn btn-sm" style="background:var(--green);color:var(--gold);border-radius:20px;font-size:11px">Detail</a></td></tr>@empty<tr><td colspan="4" class="text-center py-3">Belum ada tugas penempatan</td></tr>@endforelse</tbody></table>
      </div>
      <div class="d-md-none p-2">@forelse($recent as $p)<div class="p-3 mb-2 rounded-3" style="background:#fff;border:1.5px solid #e8d9a0;border-left:4px solid #198754"><div class="d-flex justify-content-between"><span class="badge-pendaftaran">{{ $p->pjgt_id }}</span><span class="badge" style="background:var(--gold);color:var(--green)">{{ $p->butuh_gt }} GT</span></div><div class="fw-bold mt-1" style="color:var(--green)">{{ $p->nama_madrasah }}</div><div class="small" style="color:#5d4037">{{ $p->desa ?? '' }} • {{ $p->kecamatan ?? '' }} • {{ $p->kabupaten ?? '' }}</div><div class="small" style="color:#8a7a3a">PJGT: {{ $p->pjgt_nama }}</div><a href="{{ route('permohonan.show',$p) }}" class="btn btn-sm w-100 mt-2" style="background:var(--green);color:var(--gold);border-radius:10px">Lihat Detail Tugas</a></div>@empty<div class="text-center py-3 small">Belum ada tugas</div>@endforelse</div>
    </div>
    @endif
  </div>
  {{-- Quick actions + Export --}}
  <div class="col-12 col-lg-4">
    <div class="card h-100" style="border:2px solid var(--gold);border-radius:16px;background:#fff;">
      <div class="card-body p-3">
        <h6 class="fw-bold mb-3" style="color:var(--green)"><i class="bi bi-lightning-fill" style="color:var(--gold)"></i> Aksi Cepat</h6>
        @if($isAdmin)
        <div class="d-grid gap-2">
          <a href="{{ route('permohonan.lama',['status'=>'Proses']) }}" class="btn-green" style="justify-content:center"><i class="bi bi-check2-square"></i> Proses Persetujuan ({{ $allProses }})</a>
          <a href="{{ route('permohonan.rekap') }}" class="btn-yellow" style="justify-content:center"><i class="bi bi-bar-chart-fill"></i> Lihat Rekap</a>
          <a href="{{ route('permohonan.export') }}" class="btn btn-sm" style="background:var(--cream);border:1.5px solid var(--gold);color:var(--green);border-radius:50px;font-weight:700"><i class="bi bi-download"></i> Export Excel</a>
          <a href="{{ route('landing-contents.index') }}" class="btn btn-sm" style="background:#fff;border:1.5px solid #e8d9a0;color:var(--brown);border-radius:50px"><i class="bi bi-pencil-square"></i> Kelola Landing Page</a>
          <a href="{{ route('landing') }}" target="_blank" class="btn btn-sm" style="background:#fff;border:1.5px solid #e8d9a0;color:var(--brown);border-radius:50px"><i class="bi bi-eye"></i> Lihat Landing</a>
        </div>
        <hr style="border-color:var(--gold);opacity:.3">
        <div class="small" style="color:#5d4037;line-height:1.6">
          <div class="d-flex justify-content-between"><span><i class="bi bi-people" style="color:var(--gold)"></i> PJGT Terdaftar</span><strong style="color:var(--green)">{{ $pjgtUserCount }}</strong></div>
          <div class="d-flex justify-content-between"><span><i class="bi bi-mortarboard" style="color:var(--gold)"></i> GT Tersedia</span><strong style="color:var(--green)">{{ $gtCount }}</strong></div>
          <div class="d-flex justify-content-between"><span><i class="bi bi-journals" style="color:var(--gold)"></i> Total PJGT Unik</span><strong style="color:var(--green)">{{ $pjgtDistinct }}</strong></div>
        </div>
        @elseif($isPjgt)
        <div class="d-grid gap-2">
          <a href="{{ route('permohonan.step1') }}" class="btn-green" style="justify-content:center"><i class="bi bi-feather"></i> Buat Pendaftaran Baru</a>
          <a href="{{ route('permohonan.lama') }}" class="btn-yellow" style="justify-content:center"><i class="bi bi-collection"></i> Lihat Arsip Saya</a>
          <a href="{{ route('landing') }}" class="btn btn-sm" style="background:var(--cream);border:1.5px solid var(--gold);color:var(--green);border-radius:50px"><i class="bi bi-house"></i> Beranda</a>
        </div>
        @else
        {{-- GT: tidak boleh buat permohonan, fokus ke tugas penempatan --}}
        <div class="d-grid gap-2">
          <a href="{{ route('permohonan.lama') }}" class="btn-green" style="justify-content:center"><i class="bi bi-briefcase-fill"></i> Tugas Penempatan Saya ({{ $total }})</a>
          <a href="{{ route('permohonan.rekap') }}" class="btn-yellow" style="justify-content:center"><i class="bi bi-bar-chart-fill"></i> Rekap Penempatan</a>
          <a href="{{ route('permohonan.export') }}" class="btn btn-sm" style="background:var(--cream);border:1.5px solid var(--gold);color:var(--green);border-radius:50px;font-weight:700"><i class="bi bi-download"></i> Export Tugas Saya</a>
          <a href="{{ route('landing') }}" class="btn btn-sm" style="background:#fff;border:1.5px solid #e8d9a0;color:var(--brown);border-radius:50px"><i class="bi bi-house"></i> Beranda</a>
        </div>
        <div class="small mt-2 p-2 rounded-3" style="background:var(--cream);border:1.5px dashed var(--gold);color:var(--brown);line-height:1.5">
          <i class="bi bi-info-circle-fill" style="color:var(--gold2)"></i> Daftar di bawah adalah madrasah <strong style="color:var(--green)">status Diterima</strong> yang butuh GT. Buka Detail untuk alamat & kontak.
        </div>
        @endif
      </div>
    </div>
  </div>
</div>

@if($isAdmin)
<div class="card mb-3" style="border:2px solid var(--gold);border-radius:16px;overflow:hidden;box-shadow:0 8px 28px rgba(10,61,31,.08)">
  <div class="p-3" style="background:linear-gradient(135deg,#0a3d1f,#0f5a2e);color:#fff">
    <h6 class="fw-bold mb-1" style="color:#d4af37"><i class="bi bi-shield-lock-fill"></i> Pusat Kendali Admin — Menampung Semua Pembaruan</h6>
    <div class="small" style="opacity:.85">Aduan, Absensi, Laporan GT, Pengaduan & Layanan — input dari GT/PJGT semua masuk ke Admin</div>
  </div>
  <div class="p-3">
    <div class="row g-2">
      <div class="col-6 col-md-3">
        <div class="p-3 rounded-3 text-center" style="background:#fff8f8;border:1.5px solid #dc3545">
          <div class="small fw-bold" style="color:#7a0a0a">Pengaduan GT</div>
          <div class="fs-3 fw-bold" style="color:#7a0a0a">{{ $pengaduanTotal }}</div>
          <div class="small" style="color:#8a7a3a">{{ $pengaduanMenunggu }} menunggu</div>
          <a href="{{ route('pengaduan.index') }}" class="btn btn-sm w-100 mt-2" style="background:#7a0a0a;color:#fff;border-radius:20px;font-size:11px">Kelola Pengaduan</a>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="p-3 rounded-3 text-center" style="background:#fffdf0;border:1.5px solid #d4af37">
          <div class="small fw-bold" style="color:#0a3d1f">Laporan GT</div>
          <div class="fs-3 fw-bold" style="color:#b8941f">{{ $laporanGtTotal }}</div>
          <div class="small" style="color:#8a7a3a">checklist PJGT</div>
          <a href="{{ route('pjgt.laporan.index') }}" class="btn btn-sm w-100 mt-2" style="background:#d4af37;color:#0a3d1f;border-radius:20px;font-size:11px">Kelola Laporan GT</a>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="p-3 rounded-3 text-center" style="background:#e8f5e9;border:1.5px solid #22c55e">
          <div class="small fw-bold" style="color:#0a3d1f">Layanan Saran</div>
          <div class="fs-3 fw-bold" style="color:#198754">{{ $layananTotal }}</div>
          <div class="small" style="color:#8a7a3a">masukan</div>
          <a href="{{ route('layanan.index') }}" class="btn btn-sm w-100 mt-2" style="background:#198754;color:#fff;border-radius:20px;font-size:11px">Kelola Layanan</a>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="p-3 rounded-3 text-center" style="background:#fdf6e3;border:1.5px solid #d4af37">
          <div class="small fw-bold" style="color:#0a3d1f">Absensi GT</div>
          <div class="small" style="color:#8a7a3a">Kehadiran masuk DB</div>
          <div class="d-grid gap-1 mt-2">
            <a href="{{ route('absensi.rekap') }}" class="btn btn-sm" style="background:#0a3d1f;color:#d4af37;border-radius:20px;font-size:11px"><i class="bi bi-bar-chart-fill"></i> Rekap Absensi</a>
            <a href="{{ route('gt.absensi.mengajar') }}" class="btn btn-sm" style="background:#fff;border:1px solid #0a3d1f;color:#0a3d1f;border-radius:20px;font-size:11px"><i class="bi bi-journal-check"></i> Mengajar</a>
            <a href="{{ route('gt.absensi.shalat') }}" class="btn btn-sm" style="background:#d4af37;color:#0a3d1f;border-radius:20px;font-size:11px"><i class="bi bi-moon-stars-fill"></i> Shalat</a>
          </div>
        </div>
      </div>
    </div>
    <div class="small mt-3 p-2 rounded-2" style="background:#fff;border:1.5px dashed #d4af37;color:#5d4037"><i class="bi bi-info-circle-fill" style="color:#d4af37"></i> Semua input GT/PJGT (aduan, absen, laporan kegiatan, pengaduan, saran) <strong>masuk ke Admin</strong> — kelola terpusat di menu ADMIN. PJGT & GT input, Admin verifikasi (Disetujui/Ditolak/ Ditindaklanjuti).</div>
  </div>
</div>
@endif

{{-- 3. Charts --}}
<div class="row g-2 g-md-3 mb-3">
  @unless($isGt ?? false)
  <div class="col-12 col-md-6 col-lg-3">
    <div class="card" style="border:2px solid var(--gold);border-radius:16px"><div class="card-body p-3"><h6 class="fw-bold mb-2" style="color:var(--green);font-size:13px"><i class="bi bi-pie-chart-fill" style="color:var(--gold)"></i> Status</h6><div style="height:180px;position:relative"><canvas id="dashStatus"></canvas></div></div></div>
  </div>
  @endunless
  <div class="col-12 col-md-6 {{ ($isGt ?? false) ? 'col-lg-4' : 'col-lg-3' }}">
    <div class="card" style="border:2px solid var(--gold);border-radius:16px"><div class="card-body p-3"><h6 class="fw-bold mb-2" style="color:var(--green);font-size:13px"><i class="bi bi-award-fill" style="color:var(--gold)"></i> Rapot</h6><div style="height:180px;position:relative"><canvas id="dashRapot"></canvas></div></div></div>
  </div>
  <div class="col-12 col-md-6 {{ ($isGt ?? false) ? 'col-lg-4' : 'col-lg-3' }}">
    <div class="card" style="border:2px solid var(--gold);border-radius:16px"><div class="card-body p-3"><h6 class="fw-bold mb-2" style="color:var(--green);font-size:13px"><i class="bi bi-geo-alt-fill" style="color:var(--gold)"></i> Wilayah</h6><div style="height:180px;position:relative"><canvas id="dashWil"></canvas></div></div></div>
  </div>
  <div class="col-12 col-md-6 {{ ($isGt ?? false) ? 'col-lg-4' : 'col-lg-3' }}">
    <div class="card" style="border:2px solid var(--gold);border-radius:16px"><div class="card-body p-3"><h6 class="fw-bold mb-2" style="color:var(--green);font-size:13px"><i class="bi bi-map-fill" style="color:var(--gold)"></i> Top Provinsi</h6><div style="height:180px;position:relative"><canvas id="dashProv"></canvas></div></div></div>
  </div>
</div>

{{-- 4. Madrasah & PJGT + Aktivitas --}}
<div class="row g-2 g-md-3 mb-3">
  <div class="col-12 col-lg-6">
    <div class="card" style="border:2px solid var(--gold);border-radius:16px">
      <div class="card-body p-3">
        <h6 class="fw-bold" style="color:var(--green);font-size:13px"><i class="bi bi-trophy-fill" style="color:var(--gold)"></i> Top PJGT Teraktif</h6>
        <div class="table-responsive"><table class="table table-sm small mb-0"><thead style="background:var(--cream2);color:var(--green)"><tr><th>#</th><th>PJGT</th><th>Username</th><th>Jml</th></tr></thead><tbody>@forelse($topPjgt as $i=>$t)<tr><td>{{ $i+1 }}</td><td style="color:var(--green);font-weight:600">{{ $t->pjgt_nama }}</td><td><span class="badge-pendaftaran">{{ $t->username }}</span></td><td><span class="badge" style="background:var(--gold);color:var(--green)">{{ $t->c }}</span></td></tr>@empty<tr><td colspan="4" class="text-center py-2" style="color:var(--brown)">Belum ada data</td></tr>@endforelse</tbody></table></div>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-6">
    <div class="card-form">
 <div class="card-form-header"><i class="bi bi-clock-history" style="color:var(--gold)"></i> Aktivitas Terbaru </div>
      <div class="p-2">
        @forelse($recent as $p)
        <div class="d-flex gap-3 p-2 rounded-3 mb-2" style="background:linear-gradient(135deg,#fff 0%, #fdfdf7 100%);border:1px solid #e8d9a0">
          <div style="width:36px;height:36px;background:var(--green);color:var(--gold);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="bi bi-journal-text"></i></div>
          <div style="min-width:0;flex:1">
            <div class="small fw-bold" style="color:var(--green);white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $p->pjgt_nama }} • {{ $p->nama_madrasah }}</div>
            <div class="small" style="color:#8a7a3a;font-size:11px">{{ $p->pjgt_id }} • {{ $p->status }} • {{ $p->created_at->diffForHumans() }}</div>
          </div>
          <a href="{{ route('permohonan.show',$p) }}" class="btn btn-sm align-self-center" style="background:var(--cream);border:1px solid var(--gold);color:var(--green);border-radius:20px;font-size:11px">Detail</a>
        </div>
        @empty
        <div class="text-center py-3 small" style="color:var(--brown)">Belum ada aktivitas</div>
        @endforelse
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const dStatus = @json($byStatus);
const dRapot = @json($byRapot);
const dWil = @json($byWil);
const dProv = @json($byProv);
function chartColors(n, palette){ const p = palette; return Array.from({length:n},(_,i)=> p[i%p.length]); }
if(document.getElementById('dashStatus')){ new Chart(document.getElementById('dashStatus'), {type:'doughnut', data:{labels:Object.keys(dStatus), datasets:[{data:Object.values(dStatus), backgroundColor: chartColors(Object.keys(dStatus).length, ['#0a3d1f','#d4af37','#dc3545','#8a7a3a','#0f5a2e']), borderWidth:2}]}, options:{responsive:true,maintainAspectRatio:false, plugins:{legend:{position:'bottom', labels:{color:'#0a3d1f', usePointStyle:true, font:{weight:'700'}}}}}}); }
new Chart(document.getElementById('dashRapot'), {type:'bar', data:{labels:Object.keys(dRapot), datasets:[{label:'Rapot', data:Object.values(dRapot), backgroundColor:['#0a3d1f','#d4af37','#8a7a3a'], borderRadius:8}]}, options:{responsive:true,maintainAspectRatio:false, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true, grid:{color:'#f0e6b8'}}, x:{grid:{display:false}}}}});
new Chart(document.getElementById('dashWil'), {type:'doughnut', data:{labels:Object.keys(dWil), datasets:[{data:Object.values(dWil), backgroundColor: chartColors(Object.keys(dWil).length, ['#0a3d1f','#d4af37','#198754','#dc3545']), borderWidth:2}]}, options:{responsive:true,maintainAspectRatio:false, plugins:{legend:{position:'bottom', labels:{color:'#0a3d1f', usePointStyle:true, font:{weight:'700'}}}}}});
new Chart(document.getElementById('dashProv'), {type:'bar', data:{labels:Object.keys(dProv), datasets:[{label:'Provinsi', data:Object.values(dProv), backgroundColor:'#0a3d1f', borderRadius:8}]}, options:{responsive:true,maintainAspectRatio:false, indexAxis:'y', plugins:{legend:{display:false}}, scales:{x:{beginAtZero:true, grid:{color:'#f0e6b8'}}, y:{grid:{display:false}}}}});
</script>
@endpush
@endif
@endsection

@extends('layouts.app')
@section('title','GT di Lembaga Saya | TMTB KIK')
@section('breadcrumb','GT di Lembaga Saya')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37">
    <div>
        <div class="small" style="color:#d4af37">Pemberitahuan Penempatan</div>
        <h5 class="mb-0 fw-bold" style="color:#fff"><i class="bi bi-people-fill" style="color:#d4af37"></i> Guru Tugas di Lembaga Saya</h5>
        <div class="small" style="color:#fdf6e3;opacity:.8">GT yang ditugaskan admin ke lembaga Anda</div>
    </div>
    <span class="badge" style="background:#d4af37;color:#0a3d1f;font-size:14px;border-radius:20px;padding:6px 14px">{{ $items->total() }} GT</span>
</div>

@if($items->isEmpty())
<div class="card-form mt-0">
    <div class="p-3">
        <div class="alert small py-2 mb-0" style="background:#fdf6e3;border:1px solid #d4af37;color:#0a3d1f"><i class="bi bi-info-circle-fill" style="color:#d4af37"></i> Belum ada Guru Tugas yang ditempatkan di lembaga Anda. Jika admin menugaskan GT baru, biodatanya akan langsung tampil di sini.</div>
    </div>
</div>
@else
<div class="d-flex flex-column gap-2">
@foreach($items as $p)
@php
  $gt = $p->gt;
  $b = $gt->biodata ?? null;
  $foto = ($b->foto_path ?? null) ? asset('storage/' . $b->foto_path) : 'https://ui-avatars.com/api/?name=' . urlencode($gt->name ?? 'GT') . '&background=d4af37&color=0a3d1f&size=160';
  $cid = 'bio-' . $p->id;
@endphp
<div class="rounded-3 overflow-hidden" style="border:2px solid var(--gold);background:#fff">
    <div class="d-flex align-items-center gap-3 p-3">
        <img src="{{ $foto }}" alt="" style="width:52px;height:52px;border-radius:50%;object-fit:cover;border:2px solid var(--gold);flex-shrink:0">
        <div class="flex-fill" style="min-width:0">
            <div class="fw-bold text-truncate" style="color:#0a3d1f">{{ $gt->name ?? '-' }}</div>
            <div class="small text-muted text-truncate">{{ $p->permohonan->nama_madrasah ?? '-' }} • {{ $p->updated_at?->format('d/m/Y') }}</div>
        </div>
        <button class="btn btn-sm fw-bold flex-shrink-0" data-bs-toggle="collapse" data-bs-target="#{{ $cid }}" aria-expanded="false" aria-controls="{{ $cid }}" style="background:var(--green);color:var(--gold);border-radius:20px;padding:6px 14px"><i class="bi bi-eye-fill"></i> Lihat</button>
    </div>
    <div class="collapse" id="{{ $cid }}">
        <div class="mx-3 mb-3 p-3 rounded-3 small" style="background:#fdf6e3;border:1px solid #e8d9a0;color:#5d4037;line-height:2">
            <div class="d-flex justify-content-between"><span>Tempat / Tgl Lahir</span><strong style="color:var(--green)">{{ $b->tempat_lahir ?? '-' }} / {{ $b?->tanggal_lahir ? $b->tanggal_lahir->locale('id')->isoFormat('D MMM YYYY') : '-' }}</strong></div>
            <div class="d-flex justify-content-between"><span>NIK / NISN</span><strong style="color:var(--green)">{{ $b->nik ?? '-' }} / {{ $b->nisn ?? '-' }}</strong></div>
            <div class="d-flex justify-content-between"><span>Jenis Kelamin / Agama</span><strong style="color:var(--green)">{{ $b->jenis_kelamin ?? '-' }} / {{ $b->agama ?? '-' }}</strong></div>
            <div class="d-flex justify-content-between"><span>Telepon / HP</span><strong style="color:var(--green)">{{ $b->telepon ?? '-' }} / {{ $b->hp ?? '-' }}</strong></div>
            <div><span>Alamat</span><br><strong style="color:var(--green)">{{ $b->alamat ?? '-' }}</strong></div>
            @if($p->catatan)<div class="mt-1"><span>Catatan Admin:</span><br><strong style="color:var(--green)">{{ $p->catatan }}</strong></div>@endif
        </div>
    </div>
</div>
@endforeach
</div>
<div class="mt-3">{{ $items->links() }}</div>
@endif
@endsection

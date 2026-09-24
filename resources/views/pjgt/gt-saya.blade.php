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
@foreach($items as $p)
@php
  $gt = $p->gt;
  $b = $gt->biodata ?? null;
  $foto = ($b->foto_path ?? null) ? asset('storage/' . $b->foto_path) : 'https://ui-avatars.com/api/?name=' . urlencode($gt->name ?? 'GT') . '&background=d4af37&color=0a3d1f&size=160';
@endphp
<div class="card overflow-hidden mb-3" style="border:2px solid var(--gold);border-radius:16px">
    <div style="height:70px;background:linear-gradient(135deg,#0a3d1f,#0f5a2e)"></div>
    <div class="px-3 pb-3" style="margin-top:-30px">
        <div class="d-flex gap-3 align-items-center flex-wrap">
            <img src="{{ $foto }}" alt="" style="width:60px;height:60px;border-radius:50%;object-fit:cover;border:3px solid #fff;outline:2px solid var(--gold)">
            <div class="flex-fill" style="min-width:200px">
                <div class="fw-bold" style="color:var(--green);font-size:17px">{{ $gt->name ?? '-' }}</div>
                <div class="small" style="color:#8a7a3a">{{ $gt->username ?? '' }} • {{ $p->permohonan->nama_madrasah ?? '-' }}</div>
            </div>
            <span class="badge" style="background:#eef7f0;color:#1d7a3d;border:1px solid #bfe0c9;border-radius:20px;font-size:10px">Ditempatkan {{ $p->updated_at?->format('d/m/Y') }}</span>
        </div>
    </div>
    <div class="px-3 pb-3">
        <div class="card-form h-100 mt-0">
            <div class="card-form-header">Biodata</div>
            <div class="p-3 small" style="color:#5d4037;line-height:2">
                <div class="d-flex justify-content-between"><span>Tempat / Tgl Lahir</span><strong style="color:var(--green)">{{ $b->tempat_lahir ?? '-' }} / {{ $b?->tanggal_lahir ? $b->tanggal_lahir->locale('id')->isoFormat('D MMM YYYY') : '-' }}</strong></div>
                <div class="d-flex justify-content-between"><span>NIK / NISN</span><strong style="color:var(--green)">{{ $b->nik ?? '-' }} / {{ $b->nisn ?? '-' }}</strong></div>
                <div class="d-flex justify-content-between"><span>Jenis Kelamin / Agama</span><strong style="color:var(--green)">{{ $b->jenis_kelamin ?? '-' }} / {{ $b->agama ?? '-' }}</strong></div>
                <div class="d-flex justify-content-between"><span>Telepon / HP</span><strong style="color:var(--green)">{{ $b->telepon ?? '-' }} / {{ $b->hp ?? '-' }}</strong></div>
                <div><span>Alamat</span><br><strong style="color:var(--green)">{{ $b->alamat ?? '-' }}</strong></div>
                @if($p->catatan)<div class="mt-2 p-2 rounded-3" style="background:#fdf6e3;border:1px solid #e8d9a0"><span>Catatan Admin:</span><br><strong style="color:var(--green)">{{ $p->catatan }}</strong></div>@endif
            </div>
        </div>
    </div>
</div>
@endforeach
<div>{{ $items->links() }}</div>
@endif
@endsection

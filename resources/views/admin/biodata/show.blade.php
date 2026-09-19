@extends('layouts.app')
@section('title','Detail Biodata')
@section('breadcrumb','Data Biodata')
@section('content')
@php
  $foto = ($biodata->foto_path ?? null) ? asset('storage/' . $biodata->foto_path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=d4af37&color=0a3d1f&size=160';
@endphp
<div class="mb-3 d-flex gap-2 flex-wrap">
  <a href="{{ route('biodata.rekap') }}" class="btn btn-sm" style="background:#fff;border:1.5px solid var(--gold);color:var(--green);border-radius:20px;font-weight:700">← Kembali ke Daftar</a>
  <a href="{{ route('biodata.edit', $user) }}" class="btn btn-sm" style="background:var(--gold);color:var(--green);border-radius:20px;font-weight:700"><i class="bi bi-pencil-square"></i> Edit Biodata</a>
  <form method="POST" action="{{ route('biodata.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Hapus akun {{ $user->name }} beserta biodata & absensinya? Tindakan ini tidak bisa dibatalkan.')">@csrf @method('DELETE')<button class="btn btn-sm" style="background:#ffe9e9;border:1.5px solid #ffb3b3;color:#7a0a0a;border-radius:20px;font-weight:700"><i class="bi bi-trash"></i> Hapus Akun</button></form>
</div>

<div class="card overflow-hidden mb-3" style="border:2px solid var(--gold);border-radius:16px">
  <div style="height:90px;background:linear-gradient(135deg,#0a3d1f,#0f5a2e)"></div>
  <div class="px-3 pb-3" style="margin-top:-36px">
    <div class="d-flex gap-3 align-items-center flex-wrap">
      <img src="{{ $foto }}" alt="" style="width:72px;height:72px;border-radius:50%;object-fit:cover;border:3px solid #fff;outline:2px solid var(--gold)">
      <div class="flex-fill" style="min-width:200px">
        <div class="fw-bold" style="color:var(--green);font-size:18px">{{ $user->name }}</div>
        <div class="small" style="color:#8a7a3a">{{ $user->username }} • {{ strtoupper($user->role) }} • {{ $user->email }}</div>
      </div>
    </div>
  </div>
</div>

<div class="row g-2 g-md-3 mb-3">
  <div class="col-12 col-lg-6">
    <div class="card-form h-100">
      <div class="card-form-header">Data Diri</div>
      <div class="p-3 small" style="color:#5d4037;line-height:2">
        <div class="d-flex justify-content-between"><span>Tempat / Tgl Lahir</span><strong style="color:var(--green)">{{ $biodata->tempat_lahir ?? '-' }} / {{ $biodata->tanggal_lahir ? $biodata->tanggal_lahir->locale('id')->isoFormat('D MMM YYYY') : '-' }}</strong></div>
        <div class="d-flex justify-content-between"><span>NIK / NISN</span><strong style="color:var(--green)">{{ $biodata->nik ?? '-' }} / {{ $biodata->nisn ?? '-' }}</strong></div>
        <div class="d-flex justify-content-between"><span>Jenis Kelamin / Agama</span><strong style="color:var(--green)">{{ $biodata->jenis_kelamin ?? '-' }} / {{ $biodata->agama ?? '-' }}</strong></div>
        <div class="d-flex justify-content-between"><span>Telepon / HP</span><strong style="color:var(--green)">{{ $biodata->telepon ?? '-' }} / {{ $biodata->hp ?? '-' }}</strong></div>
        <div><span>Alamat</span><br><strong style="color:var(--green)">{{ $biodata->alamat ?? '-' }}</strong></div>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-6">
    <div class="card-form h-100">
      <div class="card-form-header">Absensi Terakhir (5)</div>
      <div class="p-2">
        @forelse($absensiTerakhir as $a)
        <div class="d-flex justify-content-between align-items-center p-2 mb-1 rounded-3 small" style="background:#f8faf8;border:1px solid #e0e8e0">
          <span>{{ $a->tanggal->locale('id')->isoFormat('D MMM') }} • <strong style="color:var(--green)">{{ $a->jenis }}{{ $a->shalat ? ' ' . $a->shalat : '' }}</strong> • {{ $a->status }}</span>
          <span style="color:#8a7a3a">{{ $a->jam }}</span>
        </div>
        @empty
        <div class="text-center small py-3" style="color:#999">Belum ada absensi.</div>
        @endforelse
        <a href="{{ route('absensi.rekap', ['gt_user_id' => $user->id]) }}" class="btn btn-sm w-100 mt-2" style="background:var(--green);color:var(--gold);border-radius:20px;font-size:11px">Lihat Matriks Absensi User Ini</a>
      </div>
    </div>
  </div>
</div>
@endsection

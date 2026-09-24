@extends('layouts.app')
@section('title','Layanan • TMTB')
@section('breadcrumb','Layanan')
@section('content')
<div class="p-3 rounded-3 mb-3" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37">
  <div class="d-flex justify-content-between flex-wrap gap-2">
    <div>
 <div class="arab small" style="color:#d4af37">Layanan</div>
      <h4 class="fw-bold mb-0" style="color:#fff"><i class="bi bi-headset" style="color:#d4af37"></i> Layanan</h4>
      <div class="small" style="color:#fdf6e3;opacity:.85">Saran / masukan & kontak yang bisa dihubungi — TMTB KIK</div>
    </div>
    <span class="badge-pendaftaran align-self-center" style="background:#fdf6e3;color:#0a3d1f">PP KUNUUZUL IMAM KAUMAN</span>
  </div>
</div>

<div class="row g-3">
  <div class="col-lg-5">
    @if(in_array(auth()->user()->role ?? '', ['pjgt','gt']))
    <div class="card-form" style="border:2px solid #d4af37">
      <div class="card-form-header"><i class="bi bi-chat-left-text-fill" style="color:var(--gold)"></i> Kirim Saran / Masukan</div>
      <form method="POST" action="{{ route('layanan.store') }}" class="p-3">
        @csrf
        <div class="mb-3">
          <label class="form-label fw-bold" style="color:var(--green)">Saran / Masukan <span class="text-danger">*</span></label>
          <textarea name="saran" rows="4" class="form-control @error('saran') is-invalid @enderror" placeholder="Tuliskan saran, masukan, atau keluhan untuk layanan TMTB..." required>{{ old('saran') }}</textarea>
          @error('saran')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold" style="color:var(--green)">Kontak (opsional)</label>
          <input type="text" name="kontak" value="{{ old('kontak', auth()->user()->email) }}" class="form-control" placeholder="No HP / Email yang bisa dihubungi">
          <small class="text-muted">Default: {{ auth()->user()->email }}</small>
        </div>
        <button class="btn-green w-100" style="justify-content:center"><i class="bi bi-send-fill"></i> Kirim Saran</button>
      </form>
    </div>
    @else
    <div class="card p-3 text-center" style="border:2px solid #d4af37;border-radius:14px;background:#f8f9fa">
      <i class="bi bi-inbox" style="font-size:28px;color:#d4af37"></i>
      <div class="small mt-2" style="color:#5d4037"><strong>Mode Admin — Hanya Menerima</strong><br>Admin hanya menerima hasil saran/masukan dari PJGT/GT, tidak membuat saran.</div>
    </div>
    @endif

    <div class="card mt-3" style="border:2px solid #d4af37;border-radius:14px;background:linear-gradient(135deg,#fdf6e3,#fff)">
      <div class="card-body p-3">
        <h6 class="fw-bold" style="color:#0a3d1f"><i class="bi bi-telephone-fill" style="color:#d4af37"></i> Kontak yang Bisa Dihubungi</h6>
        <div class="small" style="color:#5d4037;line-height:1.8">
          <div class="d-flex gap-2"><i class="bi bi-geo-alt-fill mt-1" style="color:var(--gold)"></i><span>{{ $kontak['alamat'] }}</span></div>
          <div class="d-flex gap-2"><i class="bi bi-telephone-fill mt-1" style="color:var(--gold)"></i><a href="tel:{{ $kontak['telepon'] }}" style="color:#0a3d1f;font-weight:700">{{ $kontak['telepon'] }}</a> <a href="{{ $kontak['wa'] }}" target="_blank" class="badge ms-2" style="background:#25D366;color:#fff"><i class="bi bi-whatsapp"></i> WA</a></div>
          <div class="d-flex gap-2"><i class="bi bi-envelope-fill mt-1" style="color:var(--gold)"></i><a href="mailto:{{ $kontak['email'] }}" style="color:#0a3d1f;font-weight:700">{{ $kontak['email'] }}</a></div>
          <div class="d-flex gap-2"><i class="bi bi-clock-fill mt-1" style="color:var(--gold)"></i><span>Jam layanan: 08.00 - 16.00 WIB (Senin-Sabtu)</span></div>
        </div>
        <div class="d-flex gap-2 mt-3">
          <a href="{{ $kontak['wa'] }}" target="_blank" class="btn btn-sm flex-fill" style="background:#25D366;color:#fff;border-radius:10px;font-weight:700"><i class="bi bi-whatsapp"></i> Chat WA</a>
          <a href="mailto:{{ $kontak['email'] }}" class="btn btn-sm flex-fill" style="background:#0a3d1f;color:#d4af37;border:1px solid #d4af37;border-radius:10px;font-weight:700"><i class="bi bi-envelope"></i> Email</a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-7">
    <div class="card-form" style="border:2px solid #d4af37">
      <div class="card-form-header d-flex justify-content-between align-items-center flex-wrap gap-2"><span><i class="bi bi-chat-dots-fill" style="color:var(--gold)"></i> Arsip Saran ({{ $sarans->total() }})</span><span class="d-flex gap-1 align-items-center"><span class="small" style="color:#8a7a3a">{{ $sarans->currentPage() }}/{{ $sarans->lastPage() }}</span>@if((auth()->user()->role ?? '')==='admin')<a href="{{ route('layanan.export') }}" class="btn btn-sm" style="background:var(--green);color:var(--gold);border-radius:20px;font-size:11px;font-weight:700"><i class="bi bi-file-excel"></i> Export Excel</a>@endif</span></div>
      <div class="p-2">
        @forelse($sarans as $s)
        <div class="p-3 mb-2 rounded-3" style="background:#fff;border:1.5px solid #e8d9a0;border-left:4px solid var(--gold)">
          <div class="d-flex justify-content-between gap-2">
            <strong style="color:#0a3d1f">{{ $s->nama }}</strong>
            <span class="badge" style="background:{{$s->status==='Baru'?'#d4af37':'#198754'}};color:#fff">{{ $s->status }}</span>
          </div>
          <div class="small" style="color:#8a7a3a">{{ $s->kontak ?? '-' }} • {{ $s->created_at->locale('id')->diffForHumans() }}</div>
          <div class="mt-2 small" style="color:#5d4037;white-space:pre-wrap">{{ $s->saran }}</div>
          @if(auth()->user()->role==='admin' || $s->user_id===auth()->id())
          <form method="POST" action="{{ route('layanan.destroy',$s) }}" onsubmit="return confirm('Hapus saran ini?')" class="mt-2">@csrf @method('DELETE')<button class="btn btn-sm" style="background:#fff;border:1px solid #dc3545;color:#dc3545;border-radius:8px;font-size:11px"><i class="bi bi-trash"></i> Hapus</button></form>
          @endif
        </div>
        @empty
        <div class="text-center py-4 small" style="color:#8a7a3a">Belum ada saran / masukan — jadilah yang pertama mengirim.</div>
        @endforelse
      </div>
      <div class="p-3">{{ $sarans->links() }}</div>
    </div>
  </div>
</div>
@endsection

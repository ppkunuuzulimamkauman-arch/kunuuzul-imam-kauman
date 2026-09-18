@extends('layouts.app')
@section('title', (($via ?? '')==='ijin' ? 'Persetujuan Ijin GT • TMTB & DAI' : 'Arsip Permohonan • TMTB & DAI'))
@section('breadcrumb', (($via ?? '')==='ijin' ? 'Persetujuan Ijin GT' : 'Arsip Permohonan'))
@section('content')
@if(($via ?? '')==='ijin')
<div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3 gap-2" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37;flex-wrap:wrap">
    <div style="min-width:0">
        <div class="arab small" style="color:#d4af37">موافقة الإذن — Persetujuan Ijin GT</div>
        <h4 class="fw-bold mb-0" style="color:#fff;font-size:clamp(16px,4.5vw,22px)"><i class="bi bi-check2-square" style="color:#d4af37"></i> Persetujuan Ijin GT</h4>
        <div class="small" style="color:#fdf6e3;opacity:0.8">Hanya GT yang ditugaskan di lembaga Anda (biasanya 1 GT) — tanpa filter cari/rapot/status</div>
    </div>
    <div class="text-end d-none d-md-block">
        <div class="badge-pendaftaran" style="background:#fdf6e3;color:#0a3d1f">Khusus GT Lembaga</div>
        <div class="arab small mt-1" style="color:#d4af37">إذن المعلم</div>
    </div>
</div>
@else
<div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3 gap-2" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37;flex-wrap:wrap">
    <div style="min-width:0">
        <div class="arab small" style="color:#d4af37">سجل الطلبات — Arsip Permohonan</div>
        <h4 class="fw-bold mb-0" style="color:#fff;font-size:clamp(16px,4.5vw,22px)"><i class="bi bi-collection-fill" style="color:#d4af37"></i> Arsip Permohonan</h4>
        <div class="small" style="color:#fdf6e3;opacity:0.8">Daftar permohonan TMTB & DAI yang telah tercatat</div>
    </div>
    <div class="text-end d-none d-md-block">
        <div class="badge-pendaftaran" style="background:#fdf6e3;color:#0a3d1f">Filter Data</div>
        <div class="arab small mt-1" style="color:#d4af37">تصفية</div>
    </div>
</div>
@endif

@if(($via ?? '')!=='ijin')
<form method="GET" class="card-form mb-3" style="border:2px solid #d4af37;overflow:hidden">
    <div class="p-3 d-flex gap-2 align-items-end flex-wrap" style="background:linear-gradient(135deg,#fdf6e3 0%, #fdf0c7 100%);">
        <div style="flex:1;min-width:160px">
            <label class="small fw-bold" style="color:#0a3d1f"><i class="bi bi-search" style="color:#d4af37"></i> Cari</label>
            <input type="text" name="search" value="{{ $search }}" placeholder="ID / Nama PJGT / Madrasah..." class="form-control form-control-sm" style="border:1.5px solid #d4af37;background:#fff;min-height:40px;font-size:14px">
        </div>
        <div style="min-width:110px;flex:1">
            <label class="small fw-bold" style="color:#0a3d1f">Rapot</label>
            <select name="rapot" class="form-select form-select-sm" style="border:1.5px solid #d4af37;min-height:40px">
                <option value="">-- semua --</option>
                <option value="A" {{ $rapot=='A'?'selected':'' }}>A</option>
                <option value="B" {{ $rapot=='B'?'selected':'' }}>B</option>
                <option value="C" {{ $rapot=='C'?'selected':'' }}>C</option>
            </select>
        </div>
        <div style="min-width:130px;flex:1">
            <label class="small fw-bold" style="color:#0a3d1f">Status</label>
            <select name="status" class="form-select form-select-sm" style="border:1.5px solid #d4af37;min-height:40px">
                <option value="">-- semua --</option>
                <option value="Diterima" {{ $status=='Diterima'?'selected':'' }}>Diterima</option>
                <option value="Ditolak" {{ $status=='Ditolak'?'selected':'' }}>Ditolak</option>
                <option value="Proses" {{ $status=='Proses'?'selected':'' }}>Proses</option>
            </select>
        </div>
        <div class="d-flex gap-2 w-100 w-md-auto" style="flex-wrap:wrap">
            <button class="btn btn-sm flex-fill" style="background:#0a3d1f;color:#d4af37;border:1.5px solid #d4af37;font-weight:700;min-height:40px;border-radius:10px"><i class="bi bi-funnel"></i> Filter</button>
            <a href="{{ route('permohonan.lama') }}" class="btn btn-sm" style="background:#fff;border:1.5px solid #d4af37;color:#0a3d1f;min-height:40px;border-radius:10px">Reset</a>
            <a href="{{ route('permohonan.export', ['search'=>$search,'rapot'=>$rapot,'status'=>$status]) }}" class="btn btn-sm flex-fill" style="background:#0a3d1f;color:#d4af37;border:1.5px solid #d4af37;font-weight:700;min-height:40px;border-radius:10px"><i class="bi bi-file-excel"></i> Export</a>
        </div>
    </div>
    @if($search || $rapot || $status)
    <div class="px-3 py-2 small d-flex gap-2 flex-wrap align-items-center" style="background:#fff;border-top:1.5px solid #e8d9a0;color:#5d4037">
        <span class="fw-bold" style="color:#0a3d1f">Filter aktif:</span>
        @if($search)<span class="badge" style="background:#fdf6e3;color:#0a3d1f;border:1px solid #d4af37">cari: {{ $search }}</span>@endif
        @if($rapot)<span class="badge" style="background:#0a3d1f;color:#d4af37">rapot: {{ $rapot }}</span>@endif
        @if($status)<span class="badge" style="background:{{$status=='Diterima'?'#198754':($status=='Proses'?'#d4af37':'#dc3545')}};color:#fff">{{ $status }}</span>@endif
        <span class="ms-auto small" style="color:#b8941f">• {{ $permohonans->total() }} data</span>
    </div>
    @endif
</form>
@endif

<div class="card-form" style="border:2px solid #d4af37">
    <!-- Desktop table -->
    <div class="table-responsive d-none d-md-block">
        <table class="table table-hover small mb-0 align-middle" style="border-color:#e8d9a0">
            @if(($via ?? '')==='ijin')
            <thead style="background:var(--cream2, #fdf0c7);color:#0a3d1f">
                <tr style="border-bottom:2px solid #d4af37">
                    <th style="width:200px;color:#0a3d1f"><i class="bi bi-check2-square" style="color:#198754"></i> Persetujuan</th>
                    <th style="color:#0a3d1f">Nama GT</th>
                    <th style="color:#0a3d1f">Madrasah</th>
                    <th style="color:#0a3d1f">Periode Izin</th>
                    <th style="color:#0a3d1f">Alasan</th>
                    <th style="color:#0a3d1f">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permohonans as $p)
                @php $extra = is_array($p->extra_answers) ? $p->extra_answers : (json_decode($p->extra_answers, true) ?? []); @endphp
                <tr style="border-color:#e8d9a0">
                    <td>
                        <div class="d-flex gap-1">
                            @if($p->status==='Proses' && (auth()->user()->role ?? '')==='admin')
                                <form method="POST" action="{{ route('permohonan.approve',$p) }}" class="d-inline">@csrf<button name="status" value="Diterima" class="btn btn-sm" style="background:#198754;color:#fff;border:1px solid #0a3d1f;font-weight:700" onclick="return confirm('Setujui ijin GT {{ $p->pjgt_nama }}?')"><i class="bi bi-check-lg"></i> Setujui</button></form>
                                <form method="POST" action="{{ route('permohonan.approve',$p) }}" class="d-inline">@csrf<button name="status" value="Ditolak" class="btn btn-sm" style="background:#dc3545;color:#fff;border:1px solid #0a3d1f;font-weight:700" onclick="return confirm('Tolak ijin GT {{ $p->pjgt_nama }}?')"><i class="bi bi-x-lg"></i> Tolak</button></form>
                            @else
                                <a href="{{ route('permohonan.show',$p) }}" class="btn btn-sm" style="background:var(--cream2);border:1px solid #d4af37;color:#0a3d1f" title="detail"><i class="bi bi-eye"></i> Detail</a>
                                <span class="badge" style="background:{{$p->status=='Diterima'?'#198754':($p->status=='Proses'?'#d4af37':'#dc3545')}};color:#fff;border:1px solid #0a3d1f">{{ $p->status }}</span>
                            @endif
                        </div>
                    </td>
                    <td style="color:#0a3d1f;font-weight:600">{{ $p->pjgt_nama }}<div class="small" style="color:#8a7a3a">{{ $p->pjgt_id }} • {{ $p->telepon ?? '-' }}</div></td>
                    <td><span class="badge" style="background:#fdf6e3;color:#0a3d1f;border:1px solid #d4af37">{{ $p->nama_madrasah }}</span></td>
                    <td class="small" style="color:#5d4037">{{ $extra['tanggal_ijin'] ?? '-' }}<br><span class="small" style="color:#8a7a3a">s/d {{ $extra['tanggal_sampai'] ?? '-' }}</span></td>
                    <td class="small" style="color:#5d4037">{{ $extra['keterangan'] ?? '-' }}</td>
                    <td><span class="badge" style="background:{{$p->status=='Diterima'?'#198754':($p->status=='Proses'?'#d4af37':'#dc3545')}};color:#fff;border:1px solid #0a3d1f">{{ $p->status }}</span></td>
                </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-4" style="color:#8a7a3a">Belum ada ijin GT di lembaga Anda — GT belum mengajukan. <span class="arab" style="color:#d4af37">لا يوجد</span></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
            @else
            <thead style="background:var(--cream2, #fdf0c7);color:#0a3d1f">
                <tr style="border-bottom:2px solid #d4af37">
                    <th style="width:90px;color:#0a3d1f"><i class="bi bi-gear-fill" style="color:#d4af37"></i> Aksi</th>
                    <th style="color:#0a3d1f">ID PJGT</th>
                    <th style="color:#0a3d1f">Nama PJGT</th>
                    <th style="color:#0a3d1f">Madrasah</th>
                    <th style="color:#0a3d1f">Alamat</th>
                    <th style="color:#0a3d1f">Wil</th>
                    <th style="color:#0a3d1f">Tahun</th>
                    <th style="color:#0a3d1f">Status</th>
                    <th style="color:#0a3d1f">Butuh</th>
                    <th style="color:#0a3d1f">Rapot</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permohonans as $p)
                <tr style="border-color:#e8d9a0">
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('permohonan.show',$p) }}" class="btn btn-sm" style="background:var(--cream2);border:1px solid #d4af37;color:#0a3d1f" title="detail"><i class="bi bi-eye"></i></a>
                            @if(auth()->user()->role=='admin' || $p->username==auth()->user()->username)
                            <a href="{{ route('permohonan.edit',$p) }}" class="btn btn-sm" style="background:#d4af37;color:#0a3d1f;border:1px solid #0a3d1f" title="edit"><i class="bi bi-pencil"></i></a>
                            @endif
                            @if(auth()->user()->role=='admin')
                            <form method="POST" action="{{ route('permohonan.destroy', $p) }}" onsubmit="return confirm('Hapus {{ $p->pjgt_id }}?')" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm" style="background:#dc3545;color:#fff;border:1px solid #0a3d1f"><i class="bi bi-trash"></i></button></form>
                            @endif
                        </div>
                    </td>
                    <td><span class="badge-pendaftaran">{{ $p->pjgt_id }}</span></td>
                    <td style="color:#0a3d1f;font-weight:600">{{ $p->pjgt_nama }}</td>
                    <td><span class="badge" style="background:#fdf6e3;color:#0a3d1f;border:1px solid #d4af37">{{ $p->nama_madrasah }}</span></td>
                    <td class="small" style="color:#5d4037">{{ $p->alamat_lengkap ?? ($p->jalan_dusun.' - '.$p->desa.' - '.$p->kabupaten.' - '.$p->provinsi) }}</td>
                    <td><span class="badge" style="background:#0a3d1f;color:#d4af37;border:1px solid #d4af37">{{ $p->wil }}</span></td>
                    <td style="color:#0a3d1f">{{ $p->tahun }}</td>
                    <td><span class="badge" style="background:{{$p->status=='Diterima'?'#198754':($p->status=='Proses'?'#d4af37':'#dc3545')}};color:#fff;border:1px solid #0a3d1f">{{ $p->status }}</span></td>
                    <td style="color:#0a3d1f;font-weight:700">{{ $p->butuh_gt }}</td>
                    <td><span class="badge" style="background:{{$p->rapot=='A'?'#0a3d1f':($p->rapot=='B'?'#d4af37':'#8a7a3a')}};color:{{$p->rapot=='A'?'#d4af37':'#fff'}};border:1px solid #0a3d1f">{{ $p->rapot }}</span></td>
                </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center py-4" style="color:#8a7a3a">
                            Tidak ada data untuk filter ini — <span class="arab" style="color:#d4af37">لا يوجد</span><br>
                            <a href="{{ route('permohonan.lama') }}" class="btn btn-sm mt-2" style="background:var(--cream2);border:1px solid #d4af37;color:#0a3d1f;border-radius:20px">Reset filter</a>
                            @if(in_array(auth()->user()->role ?? '', ['admin','pjgt']))
                            <a href="{{ route('permohonan.step1') }}" class="btn btn-sm mt-2" style="background:#0a3d1f;color:#d4af37;border:1px solid #d4af37;border-radius:20px;font-weight:700">Buat Permohonan Baru</a>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif
    <!-- Mobile cards — premium -->
    @if(($via ?? '')==='ijin')
    <div class="d-md-none p-2">
        @forelse($permohonans as $p)
        @php $extra = is_array($p->extra_answers) ? $p->extra_answers : (json_decode($p->extra_answers, true) ?? []); @endphp
        <div class="p-3 mb-2 rounded-3" style="background:#fff;border:1.5px solid #e8d9a0;border-left:4px solid {{ $p->status=='Diterima'?'#198754':($p->status=='Proses'?'#d4af37':'#dc3545') }};box-shadow:0 2px 10px rgba(0,0,0,0.05)">
            <div class="d-flex justify-content-between align-items-start gap-2">
                <span class="badge-pendaftaran" style="font-size:11px">{{ $p->pjgt_id }}</span>
                <span class="badge" style="background:{{$p->status=='Diterima'?'#198754':($p->status=='Proses'?'#d4af37':'#dc3545')}};color:#fff;border:1px solid #0a3d1f;font-size:10px">{{ $p->status }}</span>
            </div>
            <div class="fw-bold mt-2" style="color:var(--green);font-size:14px">{{ $p->pjgt_nama }}</div>
            <div class="small d-flex align-items-center gap-1" style="color:#5d4037"><i class="bi bi-mortarboard" style="color:var(--gold2)"></i> {{ $p->nama_madrasah }}</div>
            <div class="small mt-1" style="color:#5d4037"><i class="bi bi-calendar-event"></i> Izin: <strong>{{ $extra['tanggal_ijin'] ?? '-' }}</strong> <span style="color:#8a7a3a">s/d {{ $extra['tanggal_sampai'] ?? '-' }}</span></div>
            <div class="small mt-1" style="color:#5d4037"><i class="bi bi-chat-left-text"></i> {{ $extra['keterangan'] ?? '-' }}</div>
            <div class="d-flex gap-2 mt-3">
                @if($p->status==='Proses' && (auth()->user()->role ?? '')==='admin')
                    <form method="POST" action="{{ route('permohonan.approve',$p) }}" class="flex-fill d-inline">@csrf<button name="status" value="Diterima" class="btn btn-sm w-100" style="background:#198754;color:#fff;border:1.5px solid #0a3d1f;border-radius:10px;font-weight:700;min-height:38px" onclick="return confirm('Setujui ijin {{ $p->pjgt_nama }}?')"><i class="bi bi-check-lg"></i> Setujui</button></form>
                    <form method="POST" action="{{ route('permohonan.approve',$p) }}" class="flex-fill d-inline">@csrf<button name="status" value="Ditolak" class="btn btn-sm w-100" style="background:#dc3545;color:#fff;border:1.5px solid #0a3d1f;border-radius:10px;font-weight:700;min-height:38px" onclick="return confirm('Tolak ijin {{ $p->pjgt_nama }}?')"><i class="bi bi-x-lg"></i> Tolak</button></form>
                @else
                    <a href="{{ route('permohonan.show',$p) }}" class="btn btn-sm flex-fill" style="background:var(--green);color:var(--gold);border:1.5px solid var(--gold);border-radius:10px;font-weight:700;min-height:38px;display:flex;align-items:center;justify-content:center;gap:4px"><i class="bi bi-eye"></i> Detail</a>
                @endif
            </div>
        </div>
        @empty
            <div class="text-center py-4 rounded-3" style="background:#fdf6e3;border:1.5px dashed #d4af37;color:#8a7a3a">
                <div style="width:48px;height:48px;background:#fff;border:2px solid var(--gold);border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;color:var(--gold2)"><i class="bi bi-inbox"></i></div>
                Belum ada ijin GT di lembaga Anda<br><span class="small">GT belum mengajukan — hanya GT yang ditugaskan di sini (biasanya 1 GT) yang muncul.</span>
            </div>
        @endforelse
    </div>
    @else
    <div class="d-md-none p-2">
        @forelse($permohonans as $p)
        <div class="p-3 mb-2 rounded-3" style="background:#fff;border:1.5px solid #e8d9a0;border-left:4px solid {{ $p->status=='Diterima'?'#198754':($p->status=='Proses'?'#d4af37':'#dc3545') }};box-shadow:0 2px 10px rgba(0,0,0,0.05)">
            <div class="d-flex justify-content-between align-items-start gap-2">
                <span class="badge-pendaftaran" style="font-size:11px">{{ $p->pjgt_id }}</span>
                <div class="d-flex gap-1">
                    <span class="badge" style="background:{{$p->status=='Diterima'?'#198754':($p->status=='Proses'?'#d4af37':'#dc3545')}};color:#fff;border:1px solid #0a3d1f;font-size:10px">{{ $p->status }}</span>
                    <span class="badge" style="background:{{$p->rapot=='A'?'#0a3d1f':($p->rapot=='B'?'#d4af37':'#8a7a3a')}};color:{{$p->rapot=='A'?'#d4af37':'#fff'}};border:1px solid #0a3d1f;font-size:10px">{{ $p->rapot }}</span>
                </div>
            </div>
            <div class="fw-bold mt-2" style="color:var(--green);font-size:14px">{{ $p->pjgt_nama }}</div>
            <div class="small d-flex align-items-center gap-1" style="color:#5d4037"><i class="bi bi-mortarboard" style="color:var(--gold2)"></i> {{ $p->nama_madrasah }} <span class="badge ms-1" style="background:#0a3d1f;color:#d4af37;font-size:9px">{{ $p->wil }}</span></div>
            <div class="small mt-1" style="color:#8a7a3a"><i class="bi bi-geo-alt"></i> {{ $p->alamat_lengkap ?? ($p->jalan_dusun.' - '.$p->desa.' - '.$p->kabupaten) }}</div>
            <div class="d-flex justify-content-between align-items-center mt-2 pt-2" style="border-top:1px dashed #e8d9a0">
                <span class="small" style="color:#5d4037"><i class="bi bi-people"></i> Butuh: <strong style="color:var(--green)">{{ $p->butuh_gt }}</strong> GT • {{ $p->tahun }}</span>
            </div>
            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('permohonan.show',$p) }}" class="btn btn-sm flex-fill" style="background:var(--green);color:var(--gold);border:1.5px solid var(--gold);border-radius:10px;font-weight:700;min-height:38px;display:flex;align-items:center;justify-content:center;gap:4px"><i class="bi bi-eye"></i> Detail</a>
                @if(auth()->user()->role=='admin' || $p->username==auth()->user()->username)
                <a href="{{ route('permohonan.edit',$p) }}" class="btn btn-sm" style="background:var(--gold);color:var(--green);border:1.5px solid var(--green);border-radius:10px;min-width:44px;min-height:38px;display:flex;align-items:center;justify-content:center"><i class="bi bi-pencil"></i></a>
                @endif
                @if(auth()->user()->role=='admin')
                <form method="POST" action="{{ route('permohonan.destroy', $p) }}" onsubmit="return confirm('Hapus {{ $p->pjgt_id }}?')" class="d-inline"><button class="btn btn-sm" style="background:#dc3545;color:#fff;border:1.5px solid #0a3d1f;border-radius:10px;min-width:44px;min-height:38px"><i class="bi bi-trash"></i></button></form>
                @endif
            </div>
        </div>
        @empty
            <div class="text-center py-4 rounded-3" style="background:#fdf6e3;border:1.5px dashed #d4af37;color:#8a7a3a">
                <div style="width:48px;height:48px;background:#fff;border:2px solid var(--gold);border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;color:var(--gold2)"><i class="bi bi-inbox"></i></div>
                Tidak ada data untuk filter ini<br>
                <a href="{{ route('permohonan.lama') }}" class="btn btn-sm mt-2" style="background:var(--green);color:var(--gold);border:1px solid var(--gold);border-radius:20px">Reset filter</a>
                @if(in_array(auth()->user()->role ?? '', ['admin','pjgt']))
                <a href="{{ route('permohonan.step1') }}" class="btn btn-sm mt-2" style="background:var(--gold);color:var(--green);border:1px solid var(--green);border-radius:20px;font-weight:700">Buat Baru</a>
                @endif
            </div>
        @endforelse
    </div>
    @endif
    @if($permohonans instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="p-3" style="background:#fdf6e3;border-top:2px solid #d4af37">{{ $permohonans->links() }}</div>
    @endif
</div>
<div class="text-center mt-3 arab small" style="color:#b8941f">العلم نور • Heritage KIK — PP KUNUUZUL IMAM KAUMAN</div>
@endsection

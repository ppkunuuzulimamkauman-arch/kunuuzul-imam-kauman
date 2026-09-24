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
<div class="card-form mt-0">
    <div class="p-3">
        @if($items->isEmpty())
        <div class="alert small py-2 mb-0" style="background:#fdf6e3;border:1px solid #d4af37;color:#0a3d1f"><i class="bi bi-info-circle-fill" style="color:#d4af37"></i> Belum ada Guru Tugas yang ditempatkan di lembaga Anda. Jika admin menugaskan GT baru, namanya akan muncul di sini.</div>
        @else
        <div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead>
                    <tr class="small text-muted">
                        <th>No</th>
                        <th>Nama GT</th>
                        <th>Lembaga</th>
                        <th>Catatan Admin</th>
                        <th>Ditempatkan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $i => $p)
                    <tr>
                        <td>{{ $items->firstItem() + $i }}</td>
                        <td class="fw-bold" style="color:#0a3d1f">{{ $p->gt->name ?? '-' }}<div class="small text-muted fw-normal">{{ $p->gt->username ?? '' }}</div></td>
                        <td>{{ $p->permohonan->nama_madrasah ?? '-' }}<div class="small text-muted">{{ trim(($p->permohonan->desa ?? '').' • '.($p->permohonan->kecamatan ?? ''), ' •') }}</div></td>
                        <td class="small">{{ $p->catatan ?? '-' }}</td>
                        <td class="small text-muted">{{ $p->updated_at?->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $items->links() }}</div>
        @endif
    </div>
</div>
@endsection

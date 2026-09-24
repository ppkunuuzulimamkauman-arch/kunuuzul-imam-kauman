@extends('layouts.app')
@section('title','Tahap 4 - Santri | TMTB KIK')
@section('breadcrumb','Tahap 4 • Santri')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37">
    <div>
 <div class="arab small" style="color:#d4af37">Tahap 4 • Final</div>
        <h5 class="mb-0 fw-bold" style="color:#d4af37"><i class="bi bi-people-fill"></i> Jumlah Santri</h5>
        <h4 class="fw-bold mb-0" style="color:#fff">Sifir - Ibtidaiyah - Tsanawiyah - Mukim</h4>
    </div>
 <div class="text-end"><span class="username-badge" style="background:#fdf6e3;color:#0a3d1f;border-color:#d4af37">Khatam 4/4</span></div>
</div>
@include('components.stepper', ['current'=>4])
@if(!empty($sudahAjukan) && !empty($existing))
<div class="alert d-flex gap-2 align-items-start mb-3" style="background:#fff8d6;border:2px solid #d4af37;color:#0a3d1f;border-radius:12px">
  <i class="bi bi-info-circle-fill mt-1" style="color:#b8941f;font-size:18px"></i>
  <div class="small" style="line-height:1.5"><strong>Mode Perbarui</strong> — Anda sudah mengajukan {{ $existing->tahun }} ({{ $existing->pjgt_id }} • {{ $existing->status }}). Tombol di bawah akan <strong>memperbarui</strong> data tersebut, bukan membuat pengajuan baru tahun ini. Untuk tahun ajaran baru silakan tunggu ganti tahun. <a href="{{ route('permohonan.show',$existing) }}" style="color:var(--green);font-weight:700">Lihat detail</a></div>
</div>
@endif
<div class="card-form mt-0">
    <form method="POST" action="{{ route('permohonan.store4') }}">
        @csrf
        <div class="p-4">
            <h6 class="fw-bold mb-2">Jumlah Murid Madrasah Pada Saat Ini</h6>

 <div class="arab small mb-1" style="color:#b8941f">Sifir / TPQ</div>
            <div class="p-3 mb-3" style="background:#fffdf0;border:2px solid #d4af37;border-radius:10px">
                <div class="row fw-bold small mb-2"><div class="col-2">Kelas</div><div class="col-5">Putra</div><div class="col-5">Putri</div></div>
                <div class="row g-2 align-items-center">
                    <div class="col-2 small">Sifir/TPQ</div>
                    <div class="col-5"><input type="number" name="sifir_putra" value="{{ old('sifir_putra', $data['sifir_putra'] ?? '') }}" class="form-control" placeholder="sifir putra"></div>
                    <div class="col-5"><input type="number" name="sifir_putri" value="{{ old('sifir_putri', $data['sifir_putri'] ?? '') }}" class="form-control" placeholder="sifir putri"></div>
                </div>
            </div>

 <div class="arab small mb-1" style="color:#b8941f">Ibtidaiyah / Ula</div>
            <div class="p-3 mb-3" style="background:#fffdf0;border:2px solid #d4af37;border-radius:10px">
                <div class="row fw-bold small mb-2"><div class="col-2">Kelas</div><div class="col-5">Putra</div><div class="col-5">Putri</div></div>
                @for($i=1;$i<=6;$i++)
                <div class="row g-2 align-items-center mb-2">
                    <div class="col-2 small">{{ $i }}</div>
                    <div class="col-5"><input type="number" name="ibtidaiyah_{{ $i }}_putra" value="{{ old('ibtidaiyah_'.$i.'_putra', $data['ibtidaiyah_'.$i.'_putra'] ?? ($i==6?'3':'')) }}" class="form-control" placeholder="{{ $i }} putra"></div>
                    <div class="col-5"><input type="number" name="ibtidaiyah_{{ $i }}_putri" value="{{ old('ibtidaiyah_'.$i.'_putri', $data['ibtidaiyah_'.$i.'_putri'] ?? '') }}" class="form-control" placeholder="{{ $i }} putri"></div>
                </div>
                @endfor
            </div>

 <div class="arab small mb-1" style="color:#b8941f">Tsanawiyah / Wustha</div>
            <div class="p-3 mb-3" style="background:#fffdf0;border:2px solid #d4af37;border-radius:10px">
                <div class="row fw-bold small mb-2"><div class="col-2">Kelas</div><div class="col-5">Putra</div><div class="col-5">Putri</div></div>
                @for($i=1;$i<=3;$i++)
                <div class="row g-2 align-items-center mb-2">
                    <div class="col-2 small">{{ $i }}</div>
                    <div class="col-5"><input type="number" name="tsanawiyah_{{ $i }}_putra" value="{{ old('tsanawiyah_'.$i.'_putra', $data['tsanawiyah_'.$i.'_putra'] ?? ($i==3?'6':'')) }}" class="form-control" placeholder="{{ $i }} putra"></div>
                    <div class="col-5"><input type="number" name="tsanawiyah_{{ $i }}_putri" value="{{ old('tsanawiyah_'.$i.'_putri', $data['tsanawiyah_'.$i.'_putri'] ?? ($i==3?'4':'')) }}" class="form-control" placeholder="{{ $i }} putri"></div>
                </div>
                @endfor
            </div>

 <div class="arab small mb-1" style="color:#b8941f">Mukim / Tidak Mukim</div>
            <div class="p-3 mb-3" style="background:var(--cream2, #fdf0c7);border:2px solid #d4af37;border-radius:10px">
                <div class="row fw-bold small mb-2"><div class="col-4"></div><div class="col-4">Putra</div><div class="col-4">Putri</div></div>
                <div class="row g-2 align-items-center mb-2">
                    <div class="col-4 small">Mukim</div>
                    <div class="col-4"><input type="number" name="mukim_putra" value="{{ old('mukim_putra', $data['mukim_putra'] ?? '4') }}" class="form-control"></div>
                    <div class="col-4"><input type="number" name="mukim_putri" value="{{ old('mukim_putri', $data['mukim_putri'] ?? '7') }}" class="form-control"></div>
                </div>
                <div class="row g-2 align-items-center mb-2">
                    <div class="col-4 small">Tidak Mukim</div>
                    <div class="col-4"><input type="number" name="tidak_mukim_putra" value="{{ old('tidak_mukim_putra', $data['tidak_mukim_putra'] ?? '3') }}" class="form-control"></div>
                    <div class="col-4"><input type="number" name="tidak_mukim_putri" value="{{ old('tidak_mukim_putri', $data['tidak_mukim_putri'] ?? '') }}" class="form-control" placeholder="putri Tidak Mukim"></div>
                </div>
            </div>
        </div>
            @include('permohonan._custom_fields')
        </div>
        <div class="p-3 border-top d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#fdf6e3 0%, #fdf0c7 100%);border-top:2px solid #d4af37">
            <a href="{{ route('permohonan.step3') }}" class="btn-yellow"><i class="bi bi-arrow-left"></i> Tahap 3</a>
 <span class="arab small text-center" style="color:#0a3d1f">Khatam & Simpan <i class="bi bi-check-circle-fill" style="color:#d4af37"></i></span>
            <button type="submit" class="btn-green"><i class="bi {{ !empty($sudahAjukan) ? 'bi-arrow-repeat' : 'bi-send-check' }}"></i> {{ !empty($sudahAjukan) ? 'Perbarui Pengajuan '.$existing->tahun : 'Simpan Permohonan' }}</button>
        </div>
    </form>
</div>
@endsection

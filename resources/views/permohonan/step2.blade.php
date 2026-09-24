@extends('layouts.app')
@section('title','Tahap 2 - Pengelola | TMTB KIK')
@section('breadcrumb','Tahap 2 • Pengelola')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37">
    <div>
 <div class="arab small" style="color:#d4af37">Tahap 2</div>
        <h5 class="mb-0 fw-bold" style="color:#d4af37"><i class="bi bi-people-fill"></i> Data Pengelola Lembaga</h5>
        <h4 class="fw-bold mb-0" style="color:#fff">Amanah Pengasuh & Pengurus</h4>
    </div>
 <div class="text-end"><span class="username-badge" style="background:#fdf6e3;color:#0a3d1f;border-color:#d4af37">{{ auth()->user()->username ?? '00007' }}</span></div>
</div>
@include('components.stepper', ['current'=>2])
@if(!empty($sudahAjukan) && !empty($existing))
<div class="alert d-flex gap-2 align-items-start mb-3" style="background:#fff8d6;border:2px solid #d4af37;color:#0a3d1f;border-radius:12px">
  <i class="bi bi-info-circle-fill mt-1" style="color:#b8941f;font-size:18px"></i>
  <div class="small" style="line-height:1.5"><strong>Mode Edit</strong> — sudah ada pengajuan {{ $existing->tahun }} ({{ $existing->pjgt_id }}). Menyimpan akan memperbarui, bukan duplikat. <a href="{{ route('permohonan.show',$existing) }}" style="color:var(--green);font-weight:700">Lihat</a></div>
</div>
@endif
<div class="card-form mt-0">
    <form method="POST" action="{{ route('permohonan.store2') }}">
        @csrf
        <div class="p-4">
            <h6 class="fw-bold mb-3">Data Pengelola Lembaga</h6>
            <div class="alert small py-2" style="background:#fdf6e3;border:1px solid #d4af37;color:#0a3d1f"><i class="bi bi-info-circle-fill" style="color:#d4af37"></i> <strong>Adab:</strong> Nama wajib diisi lengkap sesuai KTP (termasuk Sekretaris Yayasan). Jika tidak ada isi <code>0</code>. No HP/WA hanya untuk PJGT. Contoh: KH Zaid, Lora Amr, Fulan.</div>
            @php $fields = [
                ['label'=>'Pengasuh','field'=>'pengasuh'],
                ['label'=>'Ketua Yayasan','field'=>'ketua_yayasan'],
                ['label'=>'Sekretaris Yayasan','field'=>'sekretaris_yayasan'],
                ['label'=>'Kepala Madrasah','field'=>'kepala_madrasah'],
                ['label'=>'PJGT','field'=>'pjgt','hp'=>'pjgt_hp'],
            ]; @endphp
            @foreach($fields as $f)
            <div class="row g-3 mb-3">
                <div class="{{ isset($f['hp']) ? 'col-md-8' : 'col-12' }}">
                    <label class="form-label small">{{ $f['label'] }} <span class="text-danger">*</span></label>
                    <input type="text" name="{{ $f['field'] }}" value="{{ old($f['field'], $data[$f['field']] ?? '') }}" class="form-control required" placeholder="{{ $f['label'] }} (contoh: KH Zaid)" required>
                </div>
                @if(isset($f['hp']))
                <div class="col-md-4">
                    <label class="form-label small">No HP/WA <span class="text-danger">*</span></label>
                    <input type="text" name="{{ $f['hp'] }}" value="{{ old($f['hp'], $data[$f['hp']] ?? '') }}" class="form-control required" placeholder="08xxxxxxxxxx" required>
                </div>
                @endif
            </div>
            @endforeach
            @include('permohonan._custom_fields')
        </div>
        <div class="p-3 border-top d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#fdf6e3 0%, #fdf0c7 100%);border-top:2px solid #d4af37">
            <a href="{{ route('permohonan.step1') }}" class="btn-yellow"><i class="bi bi-arrow-left"></i> Tahap 1</a>
 <span class="arab small" style="color:#0a3d1f">2/4</span>
            <button type="submit" class="btn-green">Selanjutnya <i class="bi bi-arrow-right"></i> • Tahap 3</button>
        </div>
    </form>
</div>
@endsection

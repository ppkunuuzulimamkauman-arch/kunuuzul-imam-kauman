@extends('layouts.app')
@section('title','Kelola Pertanyaan Form')
@section('breadcrumb','Form Questions')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
  <div>
 <h4 class="fw-bold mb-1" style="color:var(--green)">Kelola Pertanyaan Form </h4>
    <p class="small mb-0" style="color:#5d4037">Tambah pertanyaan sendiri per step (1-4). Otomatis muncul di wizard Form Permohonan.</p>
  </div>
  <a href="{{ route('form-questions.create') }}" class="btn-green"><i class="bi bi-plus-circle"></i> Tambah Pertanyaan</a>
</div>

@for($s=1;$s<=5;$s++)
<div class="card-form mb-3">
  <div class="card-form-header"><i class="bi bi-list-ol" style="color:var(--gold)"></i> {{ $s<=4 ? 'Step '.$s.' — '.['','Identitas','Pengelola','Madrasah','Murid'][$s] : 'Form Ijin GT' }} ({{ $questions->where('step',$s)->count() }})</div>
  <div class="table-responsive">
    <table class="table table-hover mb-0 small">
      <thead style="background:var(--cream2);color:var(--green)"><tr><th>Urut</th><th>Pertanyaan</th><th>Tipe</th><th>Wajib</th><th>Aktif</th><th>Aksi</th></tr></thead>
      <tbody>
        @forelse($questions->where('step',$s) as $q)
        <tr>
          <td>{{ $q->sort_order }}</td>
          <td><strong style="color:var(--green)">{{ $q->label }}</strong><div style="font-size:11px;color:#8a7a3a"><code>{{ $q->field_name }}</code>@if($q->field_type=='select') • opsi: {{ $q->options }}@endif</div></td>
          <td><span class="badge" style="background:var(--cream2);color:var(--green);border:1px solid var(--gold)">{{ $q->field_type }}</span></td>
          <td>@if($q->is_required)<span class="badge" style="background:#dc3545;color:#fff">wajib</span>@else<span class="badge" style="background:#6c757d;color:#fff">opsional</span>@endif</td>
          <td>@if($q->is_active)<span class="badge" style="background:#198754;color:#fff">aktif</span>@else<span class="badge" style="background:#6c757d;color:#fff">mati</span>@endif</td>
          <td class="d-flex gap-1">
            <a href="{{ route('form-questions.edit',$q) }}" class="btn btn-sm" style="background:var(--cream);border:1px solid var(--gold);color:var(--green);border-radius:20px">Edit</a>
            <form method="POST" action="{{ route('form-questions.destroy',$q) }}" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="btn btn-sm" style="background:#ffe9e9;border:1px solid #ffb3b3;color:#7a0a0a;border-radius:20px">Hapus</button></form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-3" style="color:var(--brown)">Belum ada pertanyaan custom di step ini</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endfor
@endsection

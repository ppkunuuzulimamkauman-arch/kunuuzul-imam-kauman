@extends('layouts.app')
@section('title','Rekap Absensi GT')
@section('breadcrumb','Rekap Absensi')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
  <div>
 <h4 class="fw-bold mb-1" style="color:var(--green)">Rekap Absensi GT </h4>
    <p class="small mb-0" style="color:#5d4037">Matriks bulanan per GT — GT absen lewat HP, otomatis masuk ke sini.</p>
  </div>
  <button onclick="window.print()" class="btn btn-sm d-none d-md-inline" style="background:#fff;color:var(--green);border:1.5px solid var(--gold);border-radius:50px"><i class="bi bi-printer"></i> Cetak</button>
</div>

<div class="card-form mb-3">
  <form method="GET" action="{{ route('absensi.rekap') }}" class="p-3">
    <div class="row g-2">
      <div class="col-6 col-md-4">
        <label class="form-label">Tanggal</label>
        <input type="month" name="bulan" value="{{ $bulan }}" class="form-control">
      </div>
      <div class="col-12 col-md-5">
        <label class="form-label">Guru Tugas</label>
        <select name="gt_user_id" class="form-select">
          @forelse($gtUsers as $g)
          <option value="{{ $g->id }}" @selected($g->id == $gtId)>{{ $g->name }} • {{ $g->username }}</option>
          @empty
          <option value="">— Belum ada GT —</option>
          @endforelse
        </select>
      </div>
      <div class="col-12 col-md-3 d-flex align-items-end">
        <button class="btn-green w-100" style="justify-content:center;min-height:44px"><i class="bi bi-search"></i> Tampilkan</button>
      </div>
    </div>
  </form>
</div>

@if($gt)
<div class="card-form mb-3">
  <div class="card-form-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-calendar3" style="color:var(--gold)"></i> {{ $monthLabel }} • {{ $gt->name }}</span>
    <span class="small" style="color:#8a7a3a">{{ $totMengajar }} mengajar • {{ array_sum($totShalat) }} shalat</span>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered mb-0 small text-center align-middle" style="min-width:760px">
      <thead>
        <tr style="background:var(--green);color:var(--gold)">
          <th rowspan="2" style="vertical-align:middle;min-width:70px">Tanggal</th>
          <th colspan="8">KEGIATAN</th>
        </tr>
        <tr style="background:var(--cream2);color:var(--green)">
          @foreach($shalatCols as $s)
          <th>{{ strtoupper($s) }}</th>
          @endforeach
          <th>MUNFARID</th>
          <th>IMAM/MAKMUM</th>
          <th>MENGAJAR</th>
        </tr>
      </thead>
      <tbody>
        @for($d = 1; $d <= $daysInMonth; $d++)
        @php
          $row = $byDay[$d] ?? [];
          $sh = $row['shalat'] ?? [];
          $mCount = 0;
          $bCount = 0;
          $iCount = 0;
          $mmCount = 0;
          foreach ($sh as $rec) {
            if ($rec->cara === 'Munfarid') $mCount++;
            if ($rec->cara === 'Berjamaah') $bCount++;
            if ($rec->peran === 'Imam') $iCount++;
            if ($rec->peran === 'Makmum') $mmCount++;
          }
        @endphp
        <tr>
          <td class="fw-bold" style="color:var(--green)">{{ $d }}</td>
          @foreach($shalatCols as $s)
          <td style="{{ isset($sh[$s]) ? 'background:#e8f5e9' : 'background:#f7f7f7' }}">
            @if(isset($sh[$s]))
            <span style="color:#198754;font-size:16px">✓</span>
            <div style="font-size:10px;color:#5d4037">{{ $sh[$s]->jam }}</div>
            @endif
          </td>
          @endforeach
          <td>
            @if($mCount > 0 || $bCount > 0)
            <span class="small">M:{{ $mCount }} B:{{ $bCount }}</span>
            @endif
          </td>
          <td>
            @if($iCount > 0 || $mmCount > 0)
            <span class="small">I:{{ $iCount }} M:{{ $mmCount }}</span>
            @endif
          </td>
          <td style="{{ isset($row['mengajar']) ? 'background:#e8f5e9' : 'background:#f7f7f7' }}">
            @if(isset($row['mengajar']))
            <span style="color:#198754;font-size:16px">✓</span>
            <div style="font-size:10px;color:#5d4037">{{ $row['mengajar']->status }}</div>
            @endif
          </td>
        </tr>
        @endfor
      </tbody>
      <tfoot>
        <tr style="background:var(--cream2);color:var(--green)" class="fw-bold">
          <td>TOTAL</td>
          @foreach($shalatCols as $s)
          <td>{{ $totShalat[$s] }}</td>
          @endforeach
          <td>M:{{ $totMunfarid }} B:{{ $totBerjamaah }}</td>
          <td>I:{{ $totImam }} M:{{ $totMakmum }}</td>
          <td>{{ $totMengajar }}</td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

<div class="small p-2 rounded-3" style="background:#fff;border:1.5px dashed var(--gold);color:#5d4037">
  <strong style="color:var(--green)">Keterangan:</strong>
  ✓ = tercatat (jam tampil di bawahnya) •
  M = Munfarid, B = Berjamaah •
  I = Imam, M = Makmum •
  Baris TOTAL = jumlah kehadiran sebulan.
</div>
@else
<div class="card-form">
  <div class="text-center py-4 small" style="color:var(--brown)">Belum ada user Guru Tugas terdaftar.</div>
</div>
@endif
@endsection

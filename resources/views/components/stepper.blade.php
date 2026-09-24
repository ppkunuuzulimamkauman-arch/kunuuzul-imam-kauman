@props(['current' => 1])
@php
$steps = [
  1 => ['label'=>'Identitas', 'icon'=>'bi-house-door','arab'=>'1','route'=>'permohonan.step1'],
  2 => ['label'=>'Pengelola', 'icon'=>'bi-people','arab'=>'2','route'=>'permohonan.step2'],
  3 => ['label'=>'Madrasah', 'icon'=>'bi-book','arab'=>'3','route'=>'permohonan.step3'],
  4 => ['label'=>'Murid', 'icon'=>'bi-person-badge','arab'=>'4','route'=>'permohonan.step4'],
  5 => ['label'=>'Selesai', 'icon'=>'bi-patch-check-fill','arab'=>'5','route'=>null],
];
$progress = min(100, max(0, ($current-1)/4*100));
@endphp
<div class="stepper" style="background:linear-gradient(135deg,#fdf6e3 0%, #fdf0c7 100%);border-bottom:2px solid #d4af37;position:relative">
    <div style="position:absolute;bottom:0;left:0;height:3px;background:linear-gradient(90deg,var(--gold),var(--green));width:{{ $progress }}%;transition:width .6s cubic-bezier(.22,1,.36,1);border-radius:0 10px 10px 0"></div>
    @foreach($steps as $i => $s)
        @php $isDone=$current>$i; $isActive=$current==$i; @endphp
        @if($isDone && $s['route'])
        <a href="{{ route($s['route']) }}" class="step done" style="text-decoration:none;cursor:pointer" title="Kembali ke {{ $s['label'] }} — klik">
            <div class="circle" style="background:#0a3d1f;color:#d4af37;border-color:#d4af37;position:relative"><i class="bi {{ $s['icon'] }}"></i><span style="position:absolute;top:-6px;right:-6px;width:16px;height:16px;background:#22c55e;border:1.5px solid #fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:8px;color:#fff"><i class="bi bi-check-lg"></i></span></div>
            <label style="font-weight:700;color:#0a3d1f;cursor:pointer">{{ $s['label'] }} <span class="arab" style="color:#d4af37;font-size:10px">{{ $s['arab'] }}</span></label>
            <div class="line" style="background:#d4af37"></div>
        </a>
        @else
        <div class="step {{ $isActive ? 'active' : '' }}">
            <div class="circle" style="{{ $isActive ? 'background:#0a3d1f;color:#d4af37;border-color:#d4af37;box-shadow:0 0 0 4px rgba(212,175,55,0.18)' : 'background:#f5f0d0;color:#5d4037;border-color:#e8d9a0' }}"><i class="bi {{ $s['icon'] }}"></i></div>
            <label style="font-weight:{{ $isActive?'800':'600' }};color:{{ $isActive?'#0a3d1f':'#8a7a3a' }}">{{ $s['label'] }} <span class="arab" style="color:#d4af37;font-size:10px">{{ $s['arab'] }}</span></label>
            <div class="line" style="background:{{ $isDone||$isActive?'#d4af37':'#e8d9a0' }}"></div>
        </div>
        @endif
    @endforeach
</div>
<div class="text-center py-1 arab small d-flex justify-content-center align-items-center gap-2" style="background:#0a3d1f;color:#d4af37;font-size:11px;letter-spacing:1px">
 <span>Formulir Pendaftaran • TMTB KIK</span>
  <span class="badge" style="background:var(--gold);color:var(--green);font-size:9px">{{ $current }}/5</span>
  <span class="d-none d-sm-inline" style="opacity:.7">— klik langkah hijau untuk kembali</span>
</div>
<style>
.step{transition:transform .15s}
.step:active{transform:scale(0.96)}
a.step:hover .circle{transform:scale(1.06);box-shadow:0 4px 14px rgba(10,61,31,0.18)}
.form-control.shake{animation:shake .32s ease;border-color:#dc3545 !important}
@keyframes shake{0%,100%{transform:translateX(0)} 25%{transform:translateX(-4px)} 75%{transform:translateX(4px)}}
.auto-save-hint{font-size:10px;color:#8a7a3a;background:#fdf6e3;border:1px dashed #d4af37;padding:4px 8px;border-radius:20px;display:inline-flex;align-items:center;gap:4px}
</style>

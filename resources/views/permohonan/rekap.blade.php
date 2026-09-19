@extends('layouts.app')
@section('title','Rekap Pendaftaran • TMTB & DAI KIK')
@section('breadcrumb','Rekap Permohonan')
@section('content')
<div class="p-3 rounded-3 mb-3" style="background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;border:2px solid #d4af37">
    <div class="d-flex justify-content-between align-items-center">
        <div>
 <div class="arab small" style="color:#d4af37">Rekap Pendaftaran</div>
            <h4 class="fw-bold mb-0" style="color:#fff"><i class="bi bi-bar-chart-fill" style="color:#d4af37"></i> Rekap Permohonan</h4>
            <div class="small" style="color:#fdf6e3;opacity:0.8">PP KUNUUZUL IMAM KAUMAN • 1448/1449 H • TMTB & DAI</div>
        </div>
        <div class="text-end d-none d-md-block">
            <div class="badge-pendaftaran" style="background:#fdf6e3;color:#0a3d1f">Tahun 1448/1449</div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card text-center" style="border:2px solid #d4af37;border-radius:14px;background:linear-gradient(135deg,#0a3d1f 0%, #0f5a2e 100%);color:#fdf6e3;box-shadow:0 6px 20px rgba(10,61,31,0.15)">
            <div class="card-body">
                <div style="width:48px;height:48px;background:var(--gold,#d4af37);color:#0a3d1f;border:2px solid #fdf6e3;border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px"><i class="bi bi-journals fs-5"></i></div>
 <div class="small" style="color:#d4af37;font-weight:700;letter-spacing:1px">TOTAL</div>
                <div class="fs-1 fw-bold" style="color:#d4af37">{{ $total }}</div>
                <div class="small" style="opacity:0.8">permohonan tercatat</div>
            </div>
        </div>
    </div>
    @foreach($byStatus as $status=>$jml)
    <div class="col-md-4">
        <div class="card text-center" style="border:2px solid #d4af37;border-radius:14px;background:#fff;box-shadow:0 4px 16px rgba(0,0,0,0.06)">
            <div class="card-body">
                <div class="small fw-bold" style="color:#5d4037;letter-spacing:0.5px">{{ strtoupper($status) }}</div>
 <div class="arab small" style="color:#d4af37">{{ $status=='Diterima' ? '' : ($status=='Ditolak' ? '' : ' ') }}</div>
                <div class="fs-1 fw-bold mt-1" style="color:{{$status=='Diterima'?'#0a3d1f':($status=='Ditolak'?'#dc3545':'#b8941f')}}">{{ $jml }}</div>
                <span class="badge mt-1" style="background:{{$status=='Diterima'?'#0a3d1f':($status=='Ditolak'?'#dc3545':'#d4af37')}};color:{{$status=='Diterima'?'#d4af37':'#fff'}};border:1px solid #0a3d1f">{{ $status }}</span>
            </div>
        </div>
    </div>
    @endforeach
    @if($byStatus->isEmpty())
    <div class="col-md-8">
        <div class="card text-center" style="border:2px dashed #d4af37;border-radius:14px;background:#fffdf0">
 <div class="card-body py-4" style="color:#8a7a3a">Belum ada rekap — lengkapi formulir pendaftaran terlebih dahulu<br></div>
        </div>
    </div>
    @endif
</div>

<div class="row g-3 mt-1">
    <div class="col-md-6">
        <div class="card" style="border:2px solid #d4af37;border-radius:14px;background:#fff">
            <div class="card-body">
 <h6 class="fw-bold" style="color:#0a3d1f"><i class="bi bi-pie-chart-fill" style="color:#d4af37"></i> Grafik Status </h6>
                <canvas id="chartStatus" height="180"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card" style="border:2px solid #d4af37;border-radius:14px;background:#fff">
            <div class="card-body">
 <h6 class="fw-bold" style="color:#0a3d1f"><i class="bi bi-award-fill" style="color:#d4af37"></i> Grafik Rapot </h6>
                <canvas id="chartRapot" height="180"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="mt-4 p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-2" style="background:#fff;border:2px solid #d4af37">
    <span class="small" style="color:#0a3d1f"><i class="bi bi-info-circle-fill" style="color:#d4af37"></i> Rekap pendaftaran — data real-time dari formulir pendaftaran</span>
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('permohonan.export') }}" class="btn btn-sm" style="background:#d4af37;color:#0a3d1f;border:2px solid #0a3d1f;border-radius:50px;font-weight:700"><i class="bi bi-file-excel"></i> Export Excel</a>
        <a href="{{ route('permohonan.export') }}" onclick="window.print();return false;" class="btn btn-sm" style="background:#0a3d1f;color:#d4af37;border:1px solid #d4af37;border-radius:50px"><i class="bi bi-file-pdf"></i> Cetak PDF</a>
        <a href="{{ route('permohonan.lama') }}" class="btn btn-sm" style="background:#fff;border:1px solid #d4af37;color:#0a3d1f;border-radius:50px">Lihat Detail →</a>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const statusLabels = @json(array_keys($byStatus->toArray()));
const statusData = @json(array_values($byStatus->toArray()));
const rapotLabels = @json(array_keys($byRapot->toArray()));
const rapotData = @json(array_values($byRapot->toArray()));
new Chart(document.getElementById('chartStatus'), {type:'doughnut', data:{labels:statusLabels, datasets:[{data:statusData, backgroundColor:['#0a3d1f','#dc3545','#d4af37'], borderWidth:2, borderColor:'#fff'}]}, options:{plugins:{legend:{position:'bottom', labels:{color:'#0a3d1f', font:{weight:'700'}}}}}});
new Chart(document.getElementById('chartRapot'), {type:'bar', data:{labels:rapotLabels, datasets:[{label:'Rapot', data:rapotData, backgroundColor:['#0a3d1f','#d4af37','#8a7a3a'], borderColor:'#0a3d1f', borderWidth:1}]}, options:{plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true, ticks:{color:'#0a3d1f'}}, x:{ticks:{color:'#0a3d1f'}}}}});
</script>
@endpush
<div class="text-center mt-3 arab small" style="color:#b8941f">TMTB & DAI KIK — Heritage</div>
@endsection

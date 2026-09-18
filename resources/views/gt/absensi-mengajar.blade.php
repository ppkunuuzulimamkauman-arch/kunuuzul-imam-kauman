@extends('layouts.app')
@section('title','Kehadiran Mengajar - Guru Tugas')
@section('breadcrumb','Kehadiran Mengajar')
@section('content')
<div class="p-3 mb-3 rounded-3" style="background:linear-gradient(135deg,#0a3d1f,#0f5a2e);color:#fff;border:2px solid var(--gold)">
  <div class="small" style="color:#d4af37">Absensi Kehadiran • Mengajar</div>
  <h4 class="fw-bold mb-0">Kehadiran Mengajar</h4>
  <div class="small" style="opacity:.8">{{ $user->name }} • {{ $user->username }}</div>
</div>

<div class="row g-2 g-md-3">
  <div class="col-12 col-lg-5">
    <div class="card-form h-100">
      <div class="card-form-header"><i class="bi bi-fingerprint" style="color:var(--gold)"></i> Absen Mengajar Hari Ini <span class="small" style="color:#8a7a3a">• madrasah / kegiatan</span></div>
      <div class="p-3">
        <div class="d-flex justify-content-between small mb-2" style="color:#5d4037"><span id="mgTanggal">-</span><span id="mgJam">-</span></div>
        <div class="mb-2">
          <label class="form-label">Status</label>
          <select id="mgStatus" class="form-select">
            <option value="Hadir">Hadir Mengajar</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
            <option value="Libur">Libur</option>
          </select>
        </div>
        <div class="mb-2">
          <label class="form-label">Keterangan (mapel / kelas)</label>
          <input id="mgKet" class="form-control" placeholder="cth: Fiqh kelas 3 • 07.00-09.00">
        </div>
        <div id="mgInfo" class="small text-center p-2 mb-2 rounded-3" style="background:#fdf6e3;border:1px dashed #d4af37;color:#5d4037">Belum absen hari ini</div>
        <button id="mgBtn" class="btn-green w-100" style="justify-content:center"><i class="bi bi-check-circle-fill"></i> Simpan Absensi</button>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-7">
    <div class="card-form h-100">
      <div class="card-form-header">
        <span><i class="bi bi-clock-history" style="color:var(--gold)"></i> Riwayat 14 hari</span>
      </div>
      <div class="p-2" id="mgRiwayat"></div>
    </div>
  </div>
</div>

<script>
(function(){
  const KEY='gt_absen_mengajar_v1';
  function all(){ try{ return JSON.parse(localStorage.getItem(KEY)||'{}'); }catch(e){ return {}; } }
  function save(d){ localStorage.setItem(KEY,JSON.stringify(d)); }
  function today(){ const d=new Date(); return d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0'); }
  function tick(){ const n=new Date(); const t=document.getElementById('mgTanggal'), j=document.getElementById('mgJam'); if(t) t.textContent=n.toLocaleDateString('id-ID',{weekday:'long',day:'numeric',month:'long',year:'numeric'}); if(j) j.textContent=n.toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit',second:'2-digit'}); }
  tick(); setInterval(tick,1000);
  function render(){
    const data=all(), k=today(), info=document.getElementById('mgInfo'), btn=document.getElementById('mgBtn'), rw=document.getElementById('mgRiwayat');
    const sudah = !!data[k];
    const stEl=document.getElementById('mgStatus'), ketEl=document.getElementById('mgKet');
    if(data[k]){
      info.style.background='#e8f5e9'; info.style.border='1px solid #22c55e';
      info.innerHTML='✅ <strong>'+data[k].status+'</strong> pukul '+data[k].jam+(data[k].ket?' • '+data[k].ket:'')+'<br><span class="small" style="color:#198754">Sudah absen hari ini — tidak bisa absen lagi</span>';
      btn.disabled=true; btn.style.opacity='.55'; btn.style.pointerEvents='none'; btn.innerHTML='<i class="bi bi-lock-fill"></i> Sudah Absen';
      if(stEl) stEl.disabled=true; if(ketEl) ketEl.disabled=true;
    } else {
      info.style.background='#fdf6e3'; info.style.border='1px dashed #d4af37'; info.textContent='Belum absen hari ini';
      btn.disabled=false; btn.style.opacity='1'; btn.style.pointerEvents=''; btn.innerHTML='<i class="bi bi-check-circle-fill"></i> Simpan Absensi';
      if(stEl) stEl.disabled=false; if(ketEl) ketEl.disabled=false;
    }
    const rows=[];
    for(let i=0;i<14;i++){ const d=new Date(); d.setDate(d.getDate()-i); const key=d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0'); const v=data[key]; rows.push('<div class="d-flex justify-content-between align-items-center p-2 mb-1 rounded-3 small" style="background:'+(v?'#e8f5e9':'#f7f7f7')+';border:1px solid '+(v?'#22c55e':'#eee')+'"><span>'+d.toLocaleDateString('id-ID',{weekday:'short',day:'numeric',month:'short'})+'</span><span><strong style="color:'+(v?'#198754':'#999')+'">'+(v?v.status+' • '+v.jam:'—')+'</strong>'+(v&&v.ket?'<br><span style="color:#5d4037">'+v.ket+'</span>':'')+'</span></div>'); }
    rw.innerHTML=rows.join('');
    btn.onclick=function(){
      if(all()[today()]){ if(window.showToast) showToast('Sudah absen hari ini — tidak bisa absen lagi', 'error'); return; }
      const st=document.getElementById('mgStatus').value, ket=document.getElementById('mgKet').value.trim(); const jam=new Date().toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'}); const d=all(); d[k]={status:st,jam:jam,ket:ket}; save(d); render(); if(window.showToast) showToast('Absensi mengajar tersimpan');
    };
  }
  document.addEventListener('DOMContentLoaded',render); render();
})();
</script>
@endsection

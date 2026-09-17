@extends('layouts.app')
@section('title','Shalat 5 Waktu - Guru Tugas')
@section('breadcrumb','Shalat 5 Waktu')
@section('content')
<div class="p-3 mb-3 rounded-3 text-center" style="background:linear-gradient(135deg,#0a3d1f,#0f5a2e);color:#fff;border:2px solid var(--gold)">
  <div class="arab" style="color:var(--gold);font-size:18px">الصَّلَوَاتُ الْخَمْسُ</div>
  <h4 class="fw-bold mb-0">Shalat 5 Waktu</h4>
  <div class="small" style="opacity:.8">{{ $user->name }} • catat shalat yang sudah dikerjakan hari ini</div>
</div>

<div class="p-3 mb-3 rounded-3 d-none d-md-block" style="background:#fffdf4;border:1.5px solid #e8d9a0">
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
    <span class="fw-bold" style="color:#0a3d1f;font-size:13px"><i class="bi bi-clock" style="color:#b8941f"></i> Jadwal Shalat Hari Ini <span class="small fw-normal" style="color:#999">• perkiraan WIB Bondowoso</span></span>
    <span class="small" style="color:#5d4037"><span id="shNow">--:--</span> WIB</span>
  </div>
  <div id="shBanner" class="small text-center p-2 mb-2 rounded-3 fw-bold" style="background:#e8f5e9;border:1px solid #22c55e;color:#0a3d1f">-</div>
  <div id="shJadwal" class="d-flex flex-column gap-1"></div>
</div>

<div class="p-3 mb-3 rounded-3 d-md-none" style="background:#fffdf4;border:1.5px solid #e8d9a0">
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
    <span class="fw-bold" style="color:#0a3d1f;font-size:13px"><i class="bi bi-clock" style="color:#b8941f"></i> Jadwal</span>
    <span class="small" style="color:#5d4037"><span id="shNow">--:--</span> WIB</span>
  </div>
  <div id="shBanner" class="small text-center p-2 mb-2 rounded-3 fw-bold" style="background:#e8f5e9;border:1px solid #22c55e;color:#0a3d1f">-</div>
  <div id="shJadwalMobile" class="d-flex flex-column gap-1"></div>
</div>

<div class="row g-2 g-md-3">
  <div class="col-12 col-lg-5">
    <div class="card-form h-100">
      <div class="card-form-header"><i class="bi bi-moon-stars-fill" style="color:var(--gold)"></i> Absen Shalat Hari Ini</div>
      <div class="p-3">
        <div class="d-flex justify-content-between small mb-2" style="color:#5d4037"><span id="shTanggal">-</span><span id="shJam">-</span></div>
        <div class="mb-2">
          <label class="form-label">Shalat</label>
          <select id="shPilih" class="form-select"></select>
        </div>
        <div class="mb-2">
          <label class="form-label">Status</label>
          <select id="shPeran" class="form-select">
            <option value="Imam">Menjadi Imam</option>
            <option value="Makmum">Menjadi Makmum</option>
          </select>
        </div>
        <div class="mb-2">
          <label class="form-label">Pelaksanaan</label>
          <select id="shCara" class="form-select">
            <option value="Munfarid">Munfarid</option>
            <option value="Berjamaah">Berjamaah</option>
          </select>
        </div>
        <div class="mb-2">
          <label class="form-label">Keterangan (tempat)</label>
          <input id="shKet" class="form-control" placeholder="cth: masjid madrasah • mushalla">
        </div>
        <div id="shInfo2" class="small text-center p-2 mb-2 rounded-3" style="background:#fdf6e3;border:1px dashed #d4af37;color:#5d4037">Belum ada yang dicatat hari ini</div>
        <button id="shBtn" class="btn-green w-100" style="justify-content:center"><i class="bi bi-check-circle-fill"></i> Simpan Absensi</button>
        <div class="small fw-bold mt-3 mb-2" style="color:#0a3d1f">Sudah dicatat hari ini</div>
        <div id="shToday" class="d-flex flex-column gap-1 small" style="color:#5d4037"></div>
        <div class="mt-3">
          <div class="progress" style="height:10px;border-radius:20px;background:#eee"><div id="shBar" class="progress-bar" style="width:0%;background:linear-gradient(90deg,var(--gold),var(--green))"></div></div>
          <div id="shInfo" class="small text-center mt-2" style="color:#5d4037">0/5 selesai</div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-7">
    <div class="card-form h-100">
      <div class="card-form-header">
        <span><i class="bi bi-clock-history" style="color:var(--gold)"></i> Riwayat 14 hari</span>
      </div>
      <div class="p-2" id="shRiwayat"></div>
    </div>
  </div>
</div>

<script>
(function(){
  const WAKTU=['Subuh','Dzuhur','Ashar','Maghrib','Isya'];
  // Perkiraan WIB Bondowoso (menit sejak 00:00). Sesuaikan bila perlu.
  const JADWAL={Subuh:4*60+12, Dzuhur:11*60+32, Ashar:14*60+50, Maghrib:17*60+32, Isya:18*60+46};
  function fmt(m){ return String(Math.floor(m/60)).padStart(2,'0')+':'+String(m%60).padStart(2,'0'); }
  function nowMin(){ const n=new Date(); return n.getHours()*60+n.getMinutes(); }
  function tickJadwal(){
    const nm=nowMin();
    const nowEl=document.getElementById('shNow'), ban=document.getElementById('shBanner'), box=document.getElementById('shJadwal'), boxMob=document.getElementById('shJadwalMobile');
    if(!nowEl||!ban) return;
    const n=new Date();
    nowEl.textContent=n.toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'}).replaceAll('.',':');
    let lastIdx=-1, nextIdx=-1;
    WAKTU.forEach(function(w,i){ if(nm>=JADWAL[w]) lastIdx=i; });
    for(let i=0;i<WAKTU.length;i++){ if(nm<JADWAL[WAKTU[i]]){ nextIdx=i; break; } }
    if(lastIdx>=0){ ban.style.background='#e8f5e9'; ban.style.border='1px solid #22c55e'; ban.style.color='#0a3d1f'; ban.innerHTML='🕌 Sekarang masuk waktu <u>'+WAKTU[lastIdx]+'</u> ('+fmt(JADWAL[WAKTU[lastIdx]])+') • batas absen s/d '+fmt(JADWAL[WAKTU[lastIdx]]+20)+(nextIdx>=0?' • berikutnya '+WAKTU[nextIdx]+' '+fmt(JADWAL[WAKTU[nextIdx]]):''); }
    else { ban.style.background='#fdf6e3'; ban.style.border='1px dashed #d4af37'; ban.style.color='#5d4037'; ban.innerHTML='⏳ Menunggu <u>Subuh</u> '+fmt(JADWAL.Subuh)+' • berikutnya '+WAKTU[nextIdx]+' '+fmt(JADWAL[WAKTU[nextIdx]]); }
    const html=WAKTU.map(function(w,i){
      const entered=nm>=JADWAL[w], expired=nm>JADWAL[w]+20, isNext=(i===nextIdx);
      const bg=!entered?'#f7f7f7':(expired?'#f3f3f3':'#e8f5e9');
      const bd=!entered?(isNext?'#d4af37':'#eee'):(expired?'#ccc':'#22c55e');
      const badge=!entered
        ? (isNext ? '<span class="badge" style="background:#d4af37;color:#0a3d1f;font-size:10px">berikutnya</span>' : '<span class="badge" style="background:#eee;color:#999;font-size:10px">menunggu</span>')
        : (expired ? '<span class="badge" style="background:#dc3545;color:#fff;font-size:10px">terlewat</span>' : '<span class="badge" style="background:#198754;color:#fff;font-size:10px">sudah masuk</span>');
      return '<div class="d-flex justify-content-between align-items-center p-2 rounded-3 small" style="background:'+bg+';border:1px solid '+bd+'"><span class="fw-bold" style="color:#0a3d1f">'+w+'</span><span class="d-flex align-items-center gap-2"><span style="color:#5d4037">'+fmt(JADWAL[w])+'</span>'+badge+'</span></div>';
    }).join('');
    if(box) box.innerHTML=html;
    if(boxMob) boxMob.innerHTML=html.replace(/p-2 rounded-3 small/g,'p-1 rounded-3 small').replace(/gap-2/g,'gap-1').replace(/fw-bold/g,'fw-bold').replace(/min-height:48px/g,'min-height:40px');
  }
  setInterval(tickJadwal,30000);
  const KEY='gt_absen_shalat_v1';
  function all(){ try{ return JSON.parse(localStorage.getItem(KEY)||'{}'); }catch(e){ return {}; } }
  function save(d){ localStorage.setItem(KEY,JSON.stringify(d)); }
  function today(){ const d=new Date(); return d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0'); }
  function render(){
    const data=all(), k=today(), cur=data[k]||{};
    const n=new Date(), nm=n.getHours()*60+n.getMinutes();
    const tEl=document.getElementById('shTanggal'), jEl=document.getElementById('shJam');
    if(tEl) tEl.textContent=n.toLocaleDateString('id-ID',{weekday:'long',day:'numeric',month:'long',year:'numeric'});
    if(jEl) jEl.textContent=n.toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit',second:'2-digit'}).replaceAll('.',':');
    // Dropdown shalat — hanya boleh absen saat [masuk, masuk+20 mnt]
    const sel=document.getElementById('shPilih');
    const prevSel=sel.value;
    function winState(w){
      if(cur[w]) return 'done';
      if(nm<JADWAL[w]) return 'early';
      if(nm>JADWAL[w]+20) return 'expired';
      return 'open';
    }
    sel.innerHTML=WAKTU.map(function(w){
      const st=winState(w);
      const tag=st==='done'?' (sudah)':st==='early'?' (belum masuk)':st==='expired'?' (terlewat)':' (waktunya)';
      return '<option value="'+w+'"'+(st==='open'?'':' disabled')+'>'+w+' • '+fmt(JADWAL[w])+tag+'</option>';
    }).join('');
    let pick=(prevSel && winState(prevSel)==='open') ? prevSel : null;
    if(!pick){ const o=WAKTU.find(function(w){ return winState(w)==='open'; }); if(o) pick=o; }
    if(pick) sel.value=pick; else sel.selectedIndex=-1;
    const btn=document.getElementById('shBtn');
    let noPickReason='';
    if(!pick){
      btn.disabled=true; btn.style.opacity='.55';
      const firstUndone=WAKTU.find(function(w){ return !cur[w]; });
      noPickReason='Semua shalat hari ini sudah tercatat.';
      if(firstUndone){
        const st=winState(firstUndone);
        noPickReason=st==='early'
          ? 'Belum masuk waktu '+firstUndone+' ('+fmt(JADWAL[firstUndone])+' • batas s/d '+fmt(JADWAL[firstUndone]+20)+').'
          : 'Waktu '+firstUndone+' sudah terlewat (>20 menit dari '+fmt(JADWAL[firstUndone])+').';
      }
    } else { btn.disabled=false; btn.style.opacity='1'; }
    const done=WAKTU.filter(function(w){ return cur[w]; }).length;
    const info2=document.getElementById('shInfo2');
    if(noPickReason && !done){ info2.style.background='#fdf6e3'; info2.style.border='1px dashed #d4af37'; info2.textContent=noPickReason; }
    else if(done){ info2.style.background='#e8f5e9'; info2.style.border='1px solid #22c55e'; info2.innerHTML='✅ <strong>'+done+'/5</strong> shalat tercatat hari ini'; }
    else { info2.style.background='#fdf6e3'; info2.style.border='1px dashed #d4af37'; info2.textContent='Belum ada yang dicatat hari ini'; }
    document.getElementById('shBar').style.width=(done/5*100)+'%';
    document.getElementById('shInfo').textContent=done+'/5 selesai'+(done===5?' — ماشاء الله':'');
    const todayBox=document.getElementById('shToday');
    const keys=Object.keys(cur);
    todayBox.innerHTML=keys.length ? keys.map(function(w){
      return '<div class="d-flex justify-content-between align-items-center p-2 rounded-3" style="background:#e8f5e9;border:1px solid #22c55e"><span><strong style="color:#0a3d1f">'+w+'</strong> <span style="color:#5d4037">'+cur[w]+'</span></span><button class="btn btn-sm" data-del="'+w+'" style="background:#fff;border:1px solid #dc3545;color:#dc3545;border-radius:8px;font-size:11px">Hapus</button></div>';
    }).join('') : '<div class="text-center small py-2" style="color:#999">—</div>';
    todayBox.querySelectorAll('[data-del]').forEach(function(b){
      b.onclick=function(){ const d=all(); const c=d[k]||{}; delete c[b.dataset.del]; d[k]=c; save(d); render(); };
    });
    document.getElementById('shBtn').onclick=function(){
      const w=sel.value, ket=document.getElementById('shKet').value.trim();
      if(!w || winState(w)!=='open'){
        if(window.showToast) showToast('Di luar jendela absen (masuk s/d +20 menit)', 'error');
        render();
        return;
      }
      const peran=document.getElementById('shPeran').value, cara=document.getElementById('shCara').value;
      const jam=new Date().toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'}).replaceAll('.',':');
      const d=all(); const c=d[k]||{}; c[w]=jam+' • '+peran+' • '+cara+(ket?' • '+ket:''); d[k]=c; save(d);
      document.getElementById('shKet').value='';
      render(); tickJadwal();
      if(window.showToast) showToast('Shalat '+w+' tersimpan');
    };
    const rows=[];
    for(let i=0;i<14;i++){ const d=new Date(); d.setDate(d.getDate()-i); const key=d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0'); const v=data[key]||{}; const c=WAKTU.filter(function(w){return v[w];}).length; rows.push('<div class="d-flex justify-content-between align-items-center p-2 mb-1 rounded-3 small" style="background:'+(c?'#e8f5e9':'#f7f7f7')+';border:1px solid '+(c?'#22c55e':'#eee')+'"><span>'+d.toLocaleDateString('id-ID',{weekday:'short',day:'numeric',month:'short'})+'</span><strong style="color:'+(c===5?'#198754':c?'#b8941f':'#999')+'">'+c+'/5</strong></div>'); }
    document.getElementById('shRiwayat').innerHTML=rows.join('');
  }
  setInterval(render,30000);
  document.addEventListener('DOMContentLoaded',function(){ render(); tickJadwal(); }); render(); tickJadwal();
})();
</script>
@endsection

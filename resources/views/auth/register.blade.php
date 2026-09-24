<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<meta name="theme-color" content="#0a3d1f">
<title>Daftar - TMTB KIK</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
<style>
:root{ --green:#0a3d1f; --gold:#d4af37; --gold2:#b8941f; --cream:#fdf6e3; }
*{ -webkit-tap-highlight-color:transparent }
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--cream);min-height:100vh;min-height:100dvh;display:flex;align-items:center;justify-content:center;padding:20px;padding-top:calc(20px + env(safe-area-inset-top));padding-bottom:calc(20px + env(safe-area-inset-bottom));position:relative;overflow-x:hidden}
/* ===== BACKGROUND FOTO — sama seperti halaman login ===== */
.bg-wrap{position:fixed;inset:0;z-index:0;overflow:hidden;background:linear-gradient(135deg,#0a3d1f,#14532d)}
.bg-wrap img.bg-photo{position:absolute;inset:-3%;width:106%;height:106%;object-fit:cover;object-position:center 38%;animation:kenburns 32s ease-in-out infinite alternate;will-change:transform;filter:saturate(1.08) contrast(1.06) brightness(1.04)}
@keyframes kenburns{ from{transform:scale(1)} to{transform:scale(1.08) translate(-1%,1%)} }
.bg-overlay{position:absolute;inset:0;background:
  radial-gradient(900px 520px at 50% 38%, rgba(10,61,31,.06), rgba(10,61,31,.18) 72%),
  linear-gradient(180deg, rgba(10,61,31,.04) 0%, rgba(10,61,31,.02) 45%, rgba(6,22,13,.14) 100%)}
.bg-vignette{position:absolute;inset:0;box-shadow:inset 0 0 130px rgba(0,0,0,.24);pointer-events:none}
#stars{position:absolute;inset:0;z-index:1;pointer-events:none;opacity:.35}
.card-reg{position:relative;z-index:5;max-width:560px;width:100%;border:2px solid #d4af37;border-radius:22px;box-shadow:0 20px 60px rgba(0,0,0,0.28);overflow:hidden;background:#fff;animation:pop .45s cubic-bezier(.34,1.56,.64,1)}
@keyframes pop{from{opacity:0;transform:translateY(14px) scale(0.98)} to{opacity:1;transform:translateY(0) scale(1)}}
.header-reg{background:linear-gradient(135deg,#fdf6e3 0%, #fff 60%, #fdf0c7 100%);padding:24px;text-align:center;border-bottom:2px solid #d4af37;position:relative}
.header-reg::after{content:'◆';position:absolute;bottom:-10px;left:50%;transform:translateX(-50%);background:#fff;color:#d4af37;padding:0 8px;font-size:12px}
.logo-madin{width:74px;height:74px;margin:0 auto 10px;background:transparent;border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:transform .35s cubic-bezier(.34,1.56,.64,1)}
.logo-madin img{width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 6px 14px rgba(10,61,31,.15));transition:transform .4s}
.logo-madin:hover{transform:translateY(-2px) scale(1.05)}
.logo-madin:hover img{transform:scale(1.06) rotate(1deg)}
.logo-madin:active{transform:scale(.96)}
.btn-green{background:#0a3d1f;color:#d4af37;font-weight:800;padding:13px;border-radius:50px;border:2px solid #d4af37;width:100%;min-height:52px;display:flex;align-items:center;justify-content:center;gap:8px;transition:.18s;box-shadow:0 6px 18px rgba(10,61,31,0.2)}
.btn-green:hover{background:#082f18;color:#d4af37;transform:translateY(-1px)}
.btn-green:active{transform:scale(0.97)}
.role-card{border:2px solid #e9ecef;border-radius:14px;padding:12px;cursor:pointer;transition:.2s;background:#fff;min-height:72px}
.role-card.active{border-color:#0a3d1f;background:linear-gradient(135deg,#e8f5e9,#fdf6e3);box-shadow:0 4px 16px rgba(10,61,31,0.1)}
.role-card:active{transform:scale(0.98)}
.role-card input{accent-color:#0a3d1f;width:18px;height:18px}
.form-control{border-radius:12px;min-height:48px;font-size:16px;border:1.5px solid #e8d9a0}
.form-control:focus{border-color:#d4af37;box-shadow:0 0 0 3px rgba(212,175,55,0.2)}
.input-group-text{background:linear-gradient(135deg,#fdf6e3,#fdf0c7);border:1.5px solid #e8d9a0;color:#0a3d1f}
@media(max-width:576px){
  body{padding:14px;padding-top:calc(14px + env(safe-area-inset-top));align-items:flex-start}
  .card-reg{margin-top:8px;border-radius:18px;max-width:100%}
  .header-reg{padding:20px 16px}
  .p-4{padding:18px !important}
  .role-card{padding:10px}
  .d-flex.gap-2{flex-direction:column}
  .btn-green{min-height:52px}
}
</style>
</head>
<body>

<!-- BACKGROUND: sama seperti halaman login (public/images/login-bg.jpg) -->
<div class="bg-wrap">
  <img class="bg-photo" src="{{ asset('images/login-bg.jpg') }}" alt="" onerror="this.style.display='none'">
  <div class="bg-overlay"></div>
  <div class="bg-vignette"></div>
</div>
<canvas id="stars"></canvas>

<div class="card-reg">
  <div class="header-reg">
    <div class="logo-madin" onclick="this.animate([{transform:'scale(1)'},{transform:'scale(1.08)'},{transform:'scale(1)'}],{duration:500,easing:'cubic-bezier(.34,1.56,.64,1)'}); if(navigator.vibrate) try{navigator.vibrate(15)}catch(e){}" title="MADRASAH DINIYAH TAKMILIYAH TASHWIRUL AFKAR AL-HASANI"><img src="{{ asset('images/madin.png?v=2') }}" alt="Logo Madin"></div>
    <h5 class="fw-bold mb-0" style="color:#0a3d1f">TMTB KIK</h5>
    <div class="small text-muted">PP KUNUUZUL IMAM KAUMAN • Kauman Bondowoso 68213</div>
    <div class="small fw-bold" style="color:#b8941f">Daftar akun baru — Heritage Pesantren</div>
  </div>
  <div class="p-4">
    @if($errors->any())
      <div class="alert alert-danger small py-2" style="border-radius:12px"><ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <form method="POST" action="{{ route('register.attempt') }}">
      @csrf
      <div class="row g-3">
        <div class="col-12">
          <label class="form-label small fw-semibold" style="color:#0a3d1f">Nama Lengkap (sesuai KTP)</label>
          <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Contoh: Ahmad Zainul" required autocomplete="name">
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label small fw-semibold" style="color:#0a3d1f">Username</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="kunuzul01" required autocomplete="username">
          </div>
          <div class="small text-muted" style="font-size:11px">huruf/angka/_/- tanpa spasi</div>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label small fw-semibold" style="color:#0a3d1f">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="nama@email.com" required autocomplete="email" inputmode="email">
        </div>
        <div class="col-12">
          <label class="form-label small fw-semibold" style="color:#0a3d1f">Daftar sebagai</label>
          <div class="d-flex gap-2">
            <label class="role-card flex-fill d-flex gap-2 align-items-center {{ old('role','pjgt')=='pjgt'?'active':'' }}" onclick="selectRole('pjgt')">
              <input type="radio" name="role" value="pjgt" {{ old('role','pjgt')=='pjgt'?'checked':'' }} onchange="selectRole('pjgt')">
              <div><div class="fw-bold small" style="color:#0a3d1f"><i class="bi bi-building text-success"></i> PJGT</div><div class="text-muted" style="font-size:11px;line-height:1.3">Penanggung Jawab Guru Tugas — pengelola pondok/madrasah</div></div>
            </label>
            <label class="role-card flex-fill d-flex gap-2 align-items-center {{ old('role')=='gt'?'active':'' }}" onclick="selectRole('gt')">
              <input type="radio" name="role" value="gt" {{ old('role')=='gt'?'checked':'' }} onchange="selectRole('gt')">
              <div><div class="fw-bold small" style="color:#0a3d1f"><i class="bi bi-mortarboard text-primary"></i> GT</div><div class="text-muted" style="font-size:11px;line-height:1.3">Guru Tugas — ustadz yang ditugaskan</div></div>
            </label>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label small fw-semibold" style="color:#0a3d1f">Password</label>
          <input type="password" name="password" class="form-control" placeholder="min 6 karakter" required autocomplete="new-password">
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label small fw-semibold" style="color:#0a3d1f">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" class="form-control" placeholder="ulangi password" required autocomplete="new-password">
        </div>
        <div class="col-12">
  <label for="agree" class="d-flex align-items-start gap-2 p-3 rounded-3 small" style="background:linear-gradient(135deg,#fffdf4,#fdf6e3);border:1.5px solid var(--gold);cursor:pointer;margin:0">
    <input class="form-check-input flex-shrink-0 mt-0" type="checkbox" required id="agree" style="accent-color:#0a3d1f;width:20px;height:20px;cursor:pointer">
    <span style="color:#0a3d1f;line-height:1.5"><i class="bi bi-shield-check" style="color:#b8941f"></i> Saya menyetujui data akan <strong>diverifikasi TMTB KIK</strong></span>
  </label>
        </div>
      </div>
      <button class="btn-green mt-3">Daftar Sekarang <i class="bi bi-arrow-right ms-1"></i></button>
    </form>
    <div class="text-center mt-3 small d-none d-sm-block">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-decoration-none" style="color:#0a3d1f">Masuk di sini</a></div>
    <div class="text-center mt-3 d-none d-sm-block"><a href="{{ route('landing') }}" class="btn btn-sm rounded-pill px-4" style="background:#fdf6e3;border:1.5px solid #d4af37;color:#0a3d1f;font-weight:700"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a></div>
  </div>
 <div class="text-center small py-3" style="background:linear-gradient(135deg,#fdf6e3,#fdf0c7);border-top:2px solid #d4af37;color:#5d4037">© 1448 TMTB KIK • PP KUNUUZUL IMAM KAUMAN<br></div>
</div>
<script>
function selectRole(v){
  document.querySelectorAll('.role-card').forEach(c=>c.classList.remove('active'));
  document.querySelector(`input[value="${v}"]`).closest('.role-card').classList.add('active');
  if(navigator.vibrate) try{navigator.vibrate(8)}catch(e){}
}
// partikel lembut — sama seperti halaman login
(function(){
  const cv=document.getElementById('stars');
  if(!cv) return;
  const ctx=cv.getContext('2d');
  let W,H; const pts=[]; let mx=-9999,my=-9999;
  function resize(){ W=cv.width=innerWidth; H=cv.height=innerHeight; }
  resize(); addEventListener('resize',resize);
  const N = innerWidth<700 ? 25 : 45;
  for(let i=0;i<N;i++) pts.push({x:Math.random()*innerWidth,y:Math.random()*innerHeight,r:Math.random()*1.8+.5,vx:(Math.random()-.5)*.25,vy:(Math.random()-.5)*.25,o:Math.random()*.5+.15});
  addEventListener('pointermove', function(e){mx=e.clientX;my=e.clientY;},{passive:true});
  (function loop(){
    ctx.clearRect(0,0,W,H);
    pts.forEach(function(p){
      p.x+=p.vx; p.y+=p.vy;
      const dx=p.x-mx, dy=p.y-my, d=Math.hypot(dx,dy);
      if(d<110 && d>0){ p.x+=dx/d*.8; p.y+=dy/d*.8; }
      if(p.x<0)p.x=W; if(p.x>W)p.x=0; if(p.y<0)p.y=H; if(p.y>H)p.y=0;
      ctx.beginPath(); ctx.arc(p.x,p.y,p.r,0,7);
      ctx.fillStyle='rgba(240,214,120,'+p.o+')';
      ctx.fill();
    });
    requestAnimationFrame(loop);
  })();
})();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

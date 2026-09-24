<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<meta name="theme-color" content="#0a3d1f">
<meta name="apple-mobile-web-app-capable" content="yes">
<title>Masuk - TMTB KIK</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{ --green:#0a3d1f; --green2:#0f5a2e; --gold:#d4af37; --gold2:#b8941f; --cream:#fdf6e3; --cream2:#fdf0c7; --brown:#5d4037; }
*{ -webkit-tap-highlight-color:transparent; box-sizing:border-box }
html{height:100%}
body{font-family:'Plus Jakarta Sans',sans-serif;margin:0;min-height:100vh;min-height:100dvh;display:flex;align-items:flex-start;justify-content:center;padding:24px;position:relative;overflow-x:hidden;overflow-y:auto;color:#1a1a1a;background:var(--cream)}
@media(min-height:760px){ body{align-items:center} }

/* ===== BACKGROUND FOTO — heritage transparan ===== */
.bg-wrap{position:fixed;inset:0;z-index:0;overflow:hidden;background:linear-gradient(135deg,#0a3d1f,#14532d)}
.bg-wrap img.bg-photo{position:absolute;inset:-3%;width:106%;height:106%;object-fit:cover;object-position:center 38%;animation:kenburns 32s ease-in-out infinite alternate;will-change:transform;filter:saturate(1.08) contrast(1.06) brightness(1.04)}
@keyframes kenburns{ from{transform:scale(1)} to{transform:scale(1.08) translate(-1%,1%)} }
/* overlay — foto super jernih, hanya vignette tipis */
.bg-overlay{position:absolute;inset:0;background:
  radial-gradient(900px 520px at 50% 38%, rgba(10,61,31,.06), rgba(10,61,31,.18) 72%),
  linear-gradient(180deg, rgba(10,61,31,.04) 0%, rgba(10,61,31,.02) 45%, rgba(6,22,13,.14) 100%)}
.bg-vignette{position:absolute;inset:0;box-shadow:inset 0 0 130px rgba(0,0,0,.24);pointer-events:none}
#stars{position:absolute;inset:0;z-index:1;pointer-events:none;opacity:.35}

/* ===== CARD & SLOP ULTRA BLUR JERNIH ===== */
.login-card{position:relative;z-index:5;width:100%;max-width:420px;border-radius:24px;overflow:hidden;flex-shrink:0;
  background:linear-gradient(180deg, rgba(255,255,255,.28) 0%, rgba(253,246,227,.18) 100%);
  border:1px solid rgba(212,175,55,.20);
  backdrop-filter:blur(32px) saturate(180%);-webkit-backdrop-filter:blur(32px) saturate(180%);
  box-shadow:0 18px 50px rgba(10,61,31,.12), 0 4px 16px rgba(0,0,0,.04), inset 0 1px 0 rgba(255,255,255,.5);
  margin:12px auto;
  animation:rise .6s cubic-bezier(.22,1,.36,1) both}
@keyframes rise{from{opacity:0;transform:translateY(18px) scale(.98)}to{opacity:1;transform:none}}
.login-card::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--gold),var(--green),var(--gold));z-index:4;border-radius:24px 24px 0 0}
#glare{display:none}

.card-head{padding:20px 28px 12px;text-align:center;position:relative;z-index:2;background:rgba(255,255,255,.14);backdrop-filter:blur(20px);border-bottom:1px solid rgba(240,224,160,.22)}
.card-head::after{content:'◆';position:absolute;bottom:-10px;left:50%;transform:translateX(-50%);background:rgba(255,255,255,.9);color:var(--gold);padding:0 8px;font-size:12px;z-index:3;line-height:1;border-radius:10px}
.logo-ring{width:76px;height:76px;margin:0 auto 8px;display:flex;align-items:center;justify-content:center;background:transparent;border:none;position:relative;cursor:pointer;transition:transform .35s cubic-bezier(.34,1.56,.64,1)}
.logo-ring::after{display:none}
.logo-ring img{width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 6px 14px rgba(10,61,31,.18));transition:transform .4s cubic-bezier(.34,1.56,.64,1), filter .3s}
.logo-ring:hover{transform:translateY(-2px) scale(1.05)}
.logo-ring:hover img{transform:scale(1.06) rotate(1deg);filter:drop-shadow(0 10px 22px rgba(10,61,31,.22))}
.logo-ring:active{transform:scale(.96)}
.logo-ring.pulse{animation:logoPulse .6s ease}
@keyframes logoPulse{0%{transform:scale(1)}50%{transform:scale(1.1)}100%{transform:scale(1)}}
.card-head h4{font-weight:800;letter-spacing:-.3px;margin:0;color:var(--green)}
.card-head .sub{font-size:12px;color:var(--brown);line-height:1.5;margin-top:4px}
.pill-row{display:flex;justify-content:center;gap:8px;flex-wrap:wrap;margin-top:10px}
.pill{font-size:11px;font-weight:700;padding:5px 12px;border-radius:50px;border:1px solid var(--gold);background:var(--green);color:var(--gold)}
.arab{font-family:'Amiri',serif;color:var(--gold2)}
/* slop ultra blur — kaca bening maksimal */
.divider{display:flex;align-items:center;gap:10px;margin:12px 28px 0;color:var(--gold2);font-size:11px;opacity:.8}
.divider::before,.divider::after{content:'';flex:1;height:1px;background:linear-gradient(90deg,transparent,rgba(212,175,55,.35),transparent)}
.slope-bar{height:12px;margin:8px 0 0;position:relative;overflow:hidden;background:rgba(255,255,255,.02);backdrop-filter:blur(22px) saturate(150%);-webkit-backdrop-filter:blur(22px) saturate(150%);border-top:1px solid rgba(212,175,55,.08);border-bottom:1px solid rgba(212,175,55,.06)}
.slope-bar::before{content:'';position:absolute;inset:0;background:linear-gradient(90deg, rgba(212,175,55,.07), transparent 80%);clip-path:polygon(0 0, 100% 0, 82% 100%, 0 100%);opacity:.5}

.card-form{padding:18px 24px 18px;position:relative;z-index:2;background:rgba(255,255,255,.08);backdrop-filter:blur(16px)}
.form-label{font-size:12.5px;font-weight:700;color:var(--green)}
.input-glass{display:flex;align-items:stretch;border-radius:12px;overflow:hidden;background:#fff;
  border:1.5px solid #e8d9a0;transition:border .2s, box-shadow .2s}
.input-glass:focus-within{border-color:var(--gold);box-shadow:0 0 0 3px rgba(212,175,55,.22)}
.input-glass .addon{display:flex;align-items:center;justify-content:center;min-width:46px;color:var(--green);font-size:15px;background:linear-gradient(135deg,var(--cream),var(--cream2));border-right:1.5px solid #e8d9a0}
.input-glass input{flex:1;background:#fff;border:none;outline:none;color:var(--green);font-size:15px;padding:12px;min-height:48px;min-width:0;font-weight:500}
.input-glass input::placeholder{color:#b0a07a}
.input-glass input:-webkit-autofill{-webkit-text-fill-color:var(--green);-webkit-box-shadow:0 0 0 60px #fff inset}
.eye-btn{border:none;background:#fff;color:var(--brown);min-width:46px;transition:.2s;font-size:16px;border-left:1px solid #f0e0a0}
.eye-btn:hover{color:var(--gold2)}
.caps-warn{display:none;font-size:11.5px;color:#a67c00;margin-top:6px;font-weight:600}
.caps-warn.show{display:block}

.links-row{display:flex;justify-content:space-between;align-items:center;margin:12px 2px 16px;font-size:13px}
.links-row a{color:var(--gold2);font-weight:700;text-decoration:none}
.links-row a:hover{color:var(--green);text-decoration:underline}
.remember{display:flex;align-items:center;gap:7px;cursor:pointer;color:var(--brown);font-weight:600}
.remember input{width:16px;height:16px;accent-color:var(--green)}

.btn-masuk{position:relative;overflow:hidden;width:100%;border:2px solid var(--gold);cursor:pointer;
  background:var(--green);color:var(--gold);font-weight:800;padding:13px;border-radius:50px;min-height:52px;font-size:15.5px;letter-spacing:.2px;
  transition:transform .18s, box-shadow .18s, background .18s;box-shadow:0 6px 18px rgba(10,61,31,.18)}
.btn-masuk:hover{background:#082f18;transform:translateY(-1px);box-shadow:0 10px 28px rgba(10,61,31,.22)}
.btn-masuk:active{transform:scale(.98)}
.btn-masuk .shine{position:absolute;top:0;bottom:0;width:80px;left:-110px;background:linear-gradient(100deg,transparent,rgba(255,255,255,.45),transparent);transform:skewX(-18deg);animation:btnShine 4s ease-in-out infinite}
@keyframes btnShine{0%,65%{left:-110px}100%{left:120%}}
.btn-masuk.loading{pointer-events:none;filter:brightness(.95)}
.spin{width:18px;height:18px;border-radius:50%;border:2.5px solid rgba(212,175,55,.35);border-top-color:var(--gold);display:inline-block;animation:sp .7s linear infinite;vertical-align:-4px}
@keyframes sp{to{transform:rotate(360deg)}}

.glass-alert{border-radius:12px;font-size:13px;padding:10px 13px;margin-bottom:14px}
.glass-alert.success{background:#e8f5e9;border:1.5px solid #22c55e;color:var(--green)}
.glass-alert.danger{background:#ffe9e9;border:1.5px solid #ffb3b3;color:#7a0a0a}
.shake{animation:shakeX .45s}
@keyframes shakeX{0%,100%{transform:translateX(0)}20%{transform:translateX(-9px)}40%{transform:translateX(8px)}60%{transform:translateX(-5px)}80%{transform:translateX(4px)}}

.role{font-size:10px;font-weight:800;padding:2px 8px;border-radius:20px;color:#fff}

.foot-links{text-align:center;margin-top:16px;font-size:13px;color:var(--brown)}
.foot-links a{color:var(--green);font-weight:800;text-decoration:none;border-bottom:1.5px solid var(--gold)}
.foot-links a:hover{color:var(--gold2)}
.back-home{display:inline-flex;align-items:center;gap:7px;margin-top:12px;font-size:12.5px;font-weight:700;color:var(--green);text-decoration:none;border:1.5px solid var(--gold);background:var(--cream);padding:8px 18px;border-radius:50px;transition:.2s}
.back-home:hover{background:var(--gold);color:var(--green);border-color:var(--green)}
.card-foot{text-align:center;font-size:10.5px;color:var(--brown);padding:10px 20px;border-top:1.5px solid rgba(212,175,55,.4);background:linear-gradient(135deg, rgba(253,246,227,.45), rgba(253,240,199,.4));backdrop-filter:blur(6px);line-height:1.5}

#toastWrap{position:fixed;right:16px;bottom:18px;z-index:60;display:flex;flex-direction:column;gap:8px}
.toast-glass{background:var(--green);border:1.5px solid var(--gold);color:var(--cream);padding:11px 15px;border-radius:13px;font-size:13px;font-weight:600;box-shadow:0 10px 30px rgba(0,0,0,.18);animation:tin .35s cubic-bezier(.22,1,.36,1);display:flex;gap:9px;align-items:center;max-width:330px}
@keyframes tin{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}

@media(max-width:520px){
  body{padding:14px;overflow-y:auto;align-items:flex-start;padding-top:calc(14px + env(safe-area-inset-top))}
  .login-card{margin:6px 0 20px;border-radius:20px;max-width:100%}
  .card-head{padding:18px 16px 10px}
  .card-form{padding:16px 16px 18px}
  .divider{margin:12px 16px 0}
  .input-glass input{font-size:16px}
}
/* world-class: cegah melebihi viewport tinggi */
@media(max-height:820px){
  body{padding:18px}
  .login-card{margin:10px auto;transform:scale(.98);transform-origin:top center}
}
@media(max-height:740px){
  .login-card{transform:scale(.94)}
  .logo-ring{width:68px;height:68px;margin-bottom:6px}
  .card-head{padding:14px 20px 10px}
  .card-head h4{font-size:18px}
}
@media (prefers-reduced-motion: reduce){ *{animation-duration:.01ms !important;transition-duration:.01ms !important} }
</style>
</head>
<body>

<!-- BACKGROUND: foto santri TMTB (public/images/login-bg.jpg) -->
<div class="bg-wrap">
  <img class="bg-photo" src="{{ asset('images/login-bg.jpg') }}" alt="" onerror="this.style.display='none'">
  <div class="bg-overlay"></div>
  <div class="bg-vignette"></div>
</div>
<canvas id="stars"></canvas>

<!-- SATU PANEL LOGIN -->
<div class="login-card" id="tiltCard">
  <div id="glare"></div>

  <div class="card-head">
    <div class="logo-ring" onclick="this.classList.remove('pulse');void this.offsetWidth;this.classList.add('pulse'); if(navigator.vibrate) try{navigator.vibrate(20)}catch(e){}" title="Madrasah Diniyah Takmiliyah Tashwirul Afkar Al-Hasani"><img src="{{ asset('images/madin.png?v=2') }}" alt="Logo Madin Tashwirul Afkar"></div>
    <h4>TMTB KIK</h4>
    <div class="sub">PP KUNUUZUL IMAM KAUMAN<br>Jln KH Zainul Arifin 165, Bondowoso</div>
    <div class="pill-row">
      <span class="pill"><i class="bi bi-calendar-heart"></i> 1448/1449 H</span>
    </div>
 <div class="arab small mt-2">Masuk</div>
  </div>

  <div class="divider"><i class="bi bi-stars"></i></div>
  <div class="slope-bar" aria-hidden="true"></div>

  <div class="card-form">
    @if(session('success'))<div class="glass-alert success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>@endif
    @if($errors->any())<div class="glass-alert danger" id="errBox"><i class="bi bi-exclamation-triangle-fill"></i> {{ $errors->first() }}</div>@endif

    <form method="POST" action="{{ route('login.attempt') }}" id="loginForm" novalidate>
      @csrf
      <div class="mb-3">
        <label class="form-label">Username atau Email</label>
        <div class="input-glass">
          <span class="addon"><i class="bi bi-person-fill"></i></span>
          <input type="text" name="login" value="{{ old('login') }}" placeholder="Username atau email" required autofocus autocomplete="username" inputmode="text">
        </div>
      </div>
      <div class="mb-2">
        <label class="form-label">Password</label>
        <div class="input-glass">
          <span class="addon"><i class="bi bi-lock-fill"></i></span>
          <input type="password" name="password" id="pwd" placeholder="••••••••" required autocomplete="current-password">
          <button type="button" class="eye-btn" onclick="togglePwd()" aria-label="Lihat password"><i class="bi bi-eye" id="eye"></i></button>
        </div>
        <div class="caps-warn" id="capsWarn"><i class="bi bi-capslock-fill"></i> Caps Lock aktif!</div>
      </div>

      <div class="links-row">
        <label class="remember"><input type="checkbox" name="remember"> Ingat saya</label>
        <a href="#">Lupa password?</a>
      </div>

      <button class="btn-masuk" id="btnMasuk" type="submit"><span class="shine"></span><span id="btnLabel">Masuk <i class="bi bi-box-arrow-in-right ms-1"></i></span></button>
    </form>

    <div class="foot-links">
      Belum punya akun? <a href="{{ route('register') }}">Daftar sebagai PJGT/GT</a><br>
      <a href="{{ route('landing') }}" class="back-home"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
    </div>
  </div>

 <div class="card-foot">Copyright © 1448 TMTB KIK • PP KUNUUZUL IMAM KAUMAN<br></div>
</div>

<div id="toastWrap"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function togglePwd(){
  const i=document.getElementById('pwd'), e=document.getElementById('eye');
  if(i.type==='password'){ i.type='text'; e.className='bi bi-eye-slash'; } else { i.type='password'; e.className='bi bi-eye'; }
  i.focus();
}
document.getElementById('pwd').addEventListener('keyup', function(e){
  const on = e.getModifierState && e.getModifierState('CapsLock');
  document.getElementById('capsWarn').classList.toggle('show', !!on);
});
window.addEventListener('DOMContentLoaded', function(){
  const err=document.getElementById('errBox');
  if(err){ const c=document.getElementById('tiltCard'); c.classList.add('shake'); setTimeout(function(){c.classList.remove('shake')},600); }
});
document.getElementById('loginForm').addEventListener('submit', function(){
  document.getElementById('btnMasuk').classList.add('loading');
  document.getElementById('btnLabel').innerHTML='<span class="spin"></span> Memeriksa...';
});

// glare + tilt sangat halus (desktop saja)
(function(){
  const card=document.getElementById('tiltCard');
  if(!window.matchMedia('(pointer:fine)').matches) return;
  document.addEventListener('mousemove', function(e){
    const r=card.getBoundingClientRect();
    const px=(e.clientX-r.left)/r.width, py=(e.clientY-r.top)/r.height;
    card.style.setProperty('--gx',(px*100)+'%');
    card.style.setProperty('--gy',(py*100)+'%');
    const rx=(py-.5)*-5, ry=(px-.5)*6;
    const inside = e.clientX>r.left-80 && e.clientX<r.right+80 && e.clientY>r.top-80 && e.clientY<r.bottom+80;
    card.style.transform = inside ? 'rotateX('+rx+'deg) rotateY('+ry+'deg)' : '';
  });
})();

// partikel lembut, sedikit
(function(){
  const cv=document.getElementById('stars'), ctx=cv.getContext('2d');
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

function toast(msg){
  const w=document.getElementById('toastWrap');
  const el=document.createElement('div'); el.className='toast-glass';
  el.innerHTML='<i class="bi bi-stars" style="color:#f0d678"></i><span></span>';
  el.querySelector('span').textContent=msg;
  w.appendChild(el);
  setTimeout(function(){el.style.opacity='0';setTimeout(function(){el.remove()},300)},2600);
}
</script>
</body>
</html>

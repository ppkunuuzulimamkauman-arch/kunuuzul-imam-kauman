<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<meta name="theme-color" content="#0a3d1f">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<title>TMTB & DAI KIK - PP KUNUUZUL IMAM KAUMAN | Heritage Pesantren</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Scheherazade+New:wght@700&family=Plus+Jakarta+Sans:wght@500;700;800&display=swap" rel="stylesheet">
<style>
:root{--green:#0a3d1f;--green2:#0f5a2e;--gold:#d4af37;--gold2:#b8941f;--cream:#fdf6e3;--cream2:#fdf0c7;--brown:#5d4037}
*{ -webkit-tap-highlight-color: transparent }
html{scroll-behavior:smooth;scroll-padding-top:72px}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--cream);color:#1a1a1a;overflow-x:hidden;text-rendering:optimizeLegibility;-webkit-font-smoothing:antialiased}
.arab{font-family:'Amiri',serif}
.scheherazade{font-family:'Scheherazade New',serif}
.pattern{position:absolute;inset:0;opacity:0.06;background-image:url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0 L60 40 L100 50 L60 60 L50 100 L40 60 L0 50 L40 40 Z' fill='%23d4af37' fill-opacity='0.3'/%3E%3Ccircle cx='50' cy='50' r='8' fill='%23d4af37'/%3E%3C/svg%3E");background-size:120px;pointer-events:none}
.navbar-heritage{background:rgba(253,246,227,0.92);backdrop-filter:blur(12px) saturate(160%);-webkit-backdrop-filter:blur(12px) saturate(160%);border-bottom:3px solid var(--gold);box-shadow:0 2px 20px rgba(10,61,31,0.08);padding-top:env(safe-area-inset-top)}
.brand-ornamen{width:46px;height:46px;background:transparent;border:none;display:flex;align-items:center;justify-content:center;position:relative;cursor:pointer;transition:transform .3s cubic-bezier(.34,1.56,.64,1)}
.brand-ornamen::after{display:none}
.brand-ornamen img{width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 3px 8px rgba(10,61,31,.14));transition:transform .4s}
.brand-ornamen:hover{transform:scale(1.08) rotate(-1deg)}
.brand-ornamen:hover img{transform:scale(1.06)}
.hero-heritage{background:linear-gradient(180deg,var(--cream) 0%,#f7e8b5 100%);position:relative;overflow:hidden;border-bottom:4px solid var(--gold)}
.hero-pattern{position:absolute;right:-5%;top:8%;width:520px;height:520px;opacity:0.07;background:radial-gradient(circle, var(--green) 1px, transparent 1.5px);background-size:24px 24px;border-radius:50%;border:2px dashed var(--gold);pointer-events:none}
.badge-utama{background:var(--green);color:var(--gold);border:1px solid var(--gold);padding:7px 16px;border-radius:50px;font-weight:700;font-size:12px;letter-spacing:0.5px;display:inline-flex;align-items:center;gap:6px}
.btn-heritage{background:linear-gradient(135deg,#0d4d27 0%,var(--green) 60%,#082f18 100%);color:var(--gold);border:2px solid var(--gold);padding:12px 28px;border-radius:50px;font-weight:800;box-shadow:0 8px 22px rgba(10,61,31,0.28),inset 0 1px 0 rgba(244,226,160,.25);transition:all .2s cubic-bezier(.4,0,.2,1);text-decoration:none;display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:44px}
.btn-heritage:hover{background:linear-gradient(135deg,#082f18,#0a3d1f);color:#f4e2a0;border-color:var(--gold2);transform:translateY(-2px);box-shadow:0 14px 32px rgba(10,61,31,0.32),inset 0 1px 0 rgba(244,226,160,.3)}
.btn-heritage:active{transform:scale(0.97)}
.btn-gold-heritage{background:linear-gradient(135deg,#f4e2a0 0%,var(--gold) 55%,#c9a52e 100%);color:var(--green);border:2px solid var(--green);padding:12px 28px;border-radius:50px;font-weight:800;transition:all .2s;display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:44px;text-decoration:none;box-shadow:0 8px 22px rgba(184,148,31,.35),inset 0 1px 0 rgba(255,255,255,.5)}
.btn-gold-heritage:hover{background:linear-gradient(135deg,#ffe9a8,var(--gold2));color:var(--green);transform:translateY(-2px);box-shadow:0 14px 32px rgba(184,148,31,.45)}
.btn-gold-heritage:active{transform:scale(0.97)}
.card-pendaftaran{background:#fff;border:2px solid var(--gold);border-radius:18px;box-shadow:0 12px 40px rgba(10,61,31,0.12);position:relative;overflow:hidden}
.card-pendaftaran::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--gold),var(--green),var(--gold))}
.ornamen-border{border:2px solid var(--gold);border-radius:16px;position:relative;background:#fff}
.ornamen-border::before{content:'◆';position:absolute;top:-10px;left:50%;transform:translateX(-50%);background:var(--cream);color:var(--gold);padding:0 8px;font-size:14px}
.stat-heritage{background:#fff;border:1px solid #e8d9a0;border-radius:14px;padding:18px;text-align:center;position:relative;box-shadow:0 4px 16px rgba(0,0,0,0.05);transition:transform .2s}
.stat-heritage:hover{transform:translateY(-3px);box-shadow:0 12px 28px rgba(0,0,0,0.08)}
.stat-heritage::after{content:'';position:absolute;bottom:0;left:20%;right:20%;height:3px;background:var(--gold);border-radius:10px}
.feature-heritage{background:#fff;border:1px solid #e8d9a0;border-radius:16px;padding:22px;height:100%;position:relative;transition:.25s;overflow:hidden}
.feature-heritage::before{content:'';position:absolute;top:0;left:12%;right:12%;height:3px;border-radius:0 0 10px 10px;background:linear-gradient(90deg,transparent,var(--gold),transparent);opacity:0;transition:.25s}
.feature-heritage:hover{box-shadow:0 14px 34px rgba(10,61,31,0.14);border-color:var(--gold);transform:translateY(-3px)}
.feature-heritage:hover::before{opacity:1}
.sect-eyebrow{display:inline-flex;align-items:center;gap:10px;color:var(--gold2);font-weight:800;font-size:11.5px;letter-spacing:2.5px;text-transform:uppercase}
.sect-eyebrow::before,.sect-eyebrow::after{content:'';width:32px;height:2px;background:linear-gradient(90deg,transparent,var(--gold));border-radius:10px}
.sect-eyebrow::after{background:linear-gradient(90deg,var(--gold),transparent)}
.grad-gold-text{background:linear-gradient(120deg,#b8941f 10%,#e9cf7e 45%,#d4af37 65%,#b8941f 95%);-webkit-background-clip:text;background-clip:text;color:transparent}
.hero-glow{position:absolute;left:-120px;top:-120px;width:380px;height:380px;background:radial-gradient(circle,rgba(212,175,55,.22),transparent 65%);border-radius:50%;pointer-events:none}
.footer-link{color:var(--cream);opacity:.8;text-decoration:none;font-size:13px;display:inline-flex;align-items:center;gap:6px;padding:6px 10px;margin:-2px -4px;border-radius:10px;transition:.15s}
.footer-link:hover{color:var(--gold);opacity:1;transform:translateX(3px)}
.footer-link:active{transform:scale(.9);color:var(--gold);background:rgba(212,175,55,.15)}
/* Seksi tujuan berkedip emas saat dibuka dari link */
section[id]:target{animation:sectFlash 1.4s ease}
@keyframes sectFlash{0%{box-shadow:inset 0 0 0 3px rgba(212,175,55,.6)}100%{box-shadow:inset 0 0 0 3px rgba(212,175,55,0)}}
/* Tombol kembali ke atas */
.totop{position:fixed;right:16px;bottom:18px;z-index:1045;width:48px;height:48px;border-radius:14px;background:var(--green);color:var(--gold);border:2px solid var(--gold);display:none;align-items:center;justify-content:center;font-size:19px;box-shadow:0 10px 26px rgba(10,61,31,.35);transition:.2s;cursor:pointer}
.totop.show{display:flex;animation:totopIn .3s cubic-bezier(.34,1.56,.64,1)}
@keyframes totopIn{from{opacity:0;transform:translateY(14px) scale(.85)}to{opacity:1;transform:none}}
.totop:hover{background:#082f18;transform:translateY(-2px)}
.totop:active{transform:scale(.9)}
.step-heritage{background:#fff;border:1px solid #e8d9a0;border-radius:12px;padding:14px;display:flex;gap:12px;align-items:center;transition:.15s}
.step-heritage:hover{border-color:var(--gold);background:#fffdf0}
.step-num{width:42px;height:42px;background:var(--green);color:var(--gold);border:2px solid var(--gold);border-radius:10px;display:flex;align-items:center;justify-content:center;font-weight:800;flex-shrink:0}
.footer-heritage{background:var(--green);color:var(--cream);border-top:4px solid var(--gold);position:relative;padding-bottom:env(safe-area-inset-bottom)}

.navbar-toggler{border:2px solid var(--gold) !important;border-radius:10px;padding:8px 10px;background:var(--cream2)}
.navbar-toggler:focus{box-shadow:0 0 0 3px rgba(212,175,55,0.25)}
.navbar-toggler-icon{width:22px;height:22px}
.mobile-sticky-cta{position:fixed;bottom:0;left:0;right:0;z-index:1040;background:rgba(253,246,227,0.97);backdrop-filter:blur(16px) saturate(180%);-webkit-backdrop-filter:blur(16px) saturate(180%);border-top:2px solid var(--gold);padding:10px 16px calc(10px + env(safe-area-inset-bottom));box-shadow:0 -8px 30px rgba(10,61,31,0.15);display:none}
.mobile-sticky-cta .btn{flex:1;min-height:48px;font-weight:800;border-radius:50px;display:flex;align-items:center;justify-content:center;gap:6px;transition:.2s}
.mobile-sticky-cta .btn:active{transform:scale(0.96)}
.step-preview-btn:active div:first-child{transform:scale(0.92)}
.progress-preview{height:3px;background:linear-gradient(90deg,var(--gold),var(--green));width:0%;border-radius:10px;transition:width .45s linear}
.reveal{opacity:0;transform:translateY(16px) scale(0.98);transition:all .6s cubic-bezier(.22,1,.36,1)}
.reveal.in{opacity:1;transform:none}
.reveal.delay-1{transition-delay:.08s}.reveal.delay-2{transition-delay:.16s}.reveal.delay-3{transition-delay:.24s}
.ripple{position:absolute;border-radius:50%;transform:scale(0);animation:ripple .55s ease-out;background:rgba(212,175,55,0.38);pointer-events:none}
@keyframes ripple{to{transform:scale(4);opacity:0}}
.count{font-variant-numeric:tabular-nums}
.navbar-heritage .nav-link{transition:color .2s ease,background .2s ease,transform .15s ease,box-shadow .2s ease;border-radius:12px;padding:7px 14px !important}
.navbar-heritage .nav-link:hover{color:var(--gold2) !important;background:rgba(212,175,55,.14);transform:translateY(-1px)}
.navbar-heritage .nav-link:active{transform:scale(.88);background:rgba(212,175,55,.28);color:var(--gold2) !important}
.navbar-heritage .nav-link.active{color:#fff !important;background:linear-gradient(135deg,var(--green),#0f5a2e);box-shadow:0 4px 12px rgba(10,61,31,.3);font-weight:800;animation:navPop .35s cubic-bezier(.34,1.56,.64,1)}
@keyframes navPop{0%{transform:scale(.88)}60%{transform:scale(1.07)}100%{transform:scale(1)}}
/* Animasi halus */
@media (prefers-reduced-motion: no-preference){
  .hero-heritage, .stat-heritage, .feature-heritage {animation: fadeUp .6s ease both}
  @keyframes fadeUp{from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)}}
}
/* ─── MOBILE MASTERPIECE ─── */
@media (max-width:991px){
  .hero-heritage{padding-top:32px !important;padding-bottom:32px !important;min-height:auto !important}
  .hero-pattern{width:360px;height:360px;right:-20%;top:12%;opacity:0.05}
  .display-hero{font-size:clamp(28px,7vw,42px) !important;line-height:0.95 !important}
  .card-pendaftaran{margin-top:8px}
}
@media (max-width:576px){
  .navbar-heritage .container{padding-left:14px;padding-right:14px}
  .brand-ornamen{width:38px;height:38px}
  .navbar-brand{font-size:15px}
  .hero-heritage .container{padding-left:16px;padding-right:16px}
  .hero-heritage{padding-top:24px !important;padding-bottom:28px !important}
  .badge-utama{font-size:11px;padding:6px 12px}
  .display-hero{font-size:clamp(26px,8.5vw,34px) !important}
  .card-pendaftaran{border-radius:16px;margin-left:-2px;margin-right:-2px}
  .card-pendaftaran .p-4{padding:16px !important}
  .ornamen-border{border-radius:14px}
  .ornamen-border.p-3{padding:14px !important}
  .btn-heritage,.btn-gold-heritage{padding:13px 20px;font-size:15px;width:100%}
  .hero-actions{flex-direction:column;gap:10px}
  .hero-actions a{width:100%}
  .stat-heritage{padding:14px 10px}
  .stat-heritage .h4{font-size:20px}
  .feature-heritage{padding:16px}
  #statistik{padding-top:16px !important;margin-top:0 !important}
  #informasi{padding-top:28px !important;padding-bottom:28px !important}
  #alur{padding-top:28px !important;padding-bottom:calc(28px + 76px) !important}
  .mobile-sticky-cta{display:flex;gap:10px}
  .footer-heritage{padding-bottom:calc(18px + env(safe-area-inset-bottom)) !important;margin-bottom:0 !important}
  
  .footer-heritage .container{padding-left:16px;padding-right:16px}
  .totop{bottom:calc(84px + env(safe-area-inset-bottom));width:46px;height:46px;right:14px}
  /* step preview di HP: bisa di-swipe horizontal */
  #previewSteps{overflow-x:auto;scroll-snap-type:x mandatory;-webkit-overflow-scrolling:touch;gap:8px !important;padding-bottom:6px}
  #previewSteps::-webkit-scrollbar{display:none}
  .step-preview-btn{scroll-snap-align:start;flex:0 0 78px !important;max-width:78px !important}
}
@media (max-width:375px){
  .display-hero{font-size:24px !important}
  .card-pendaftaran .p-4{padding:14px !important}
}
</style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-heritage sticky-top py-2">
<div class="container">
  <a class="navbar-brand d-flex align-items-center gap-3 fw-bold" href="{{ route('landing') }}" style="color:var(--green)">
    <span class="brand-ornamen" title="Madrasah Diniyah Takmiliyah Tashwirul Afkar"><img src="{{ asset('images/madin.png?v=2') }}" alt="Logo Madin"></span>
    <span style="line-height:1.1"><span style="font-weight:800;letter-spacing:0.5px">TMTB & DAI <span style="color:var(--gold2)">KIK</span></span><br><span class="arab" style="font-size:12px;color:var(--brown);font-weight:700">PP KUNUUZUL IMAM KAUMAN</span></span>
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
  <div class="collapse navbar-collapse" id="nav">
    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1 pt-3 pt-lg-0">
      <li class="nav-item"><a class="nav-link fw-semibold" href="#statistik" style="color:var(--green)"><i class="bi bi-bar-chart d-lg-none me-2" style="color:var(--gold2)"></i>Statistik</a></li>
      <li class="nav-item"><a class="nav-link fw-semibold" href="#informasi" style="color:var(--green)"><i class="bi bi-info-circle d-lg-none me-2" style="color:var(--gold2)"></i>Informasi</a></li>
      <li class="nav-item"><a class="nav-link fw-semibold" href="#alur" style="color:var(--green)"><i class="bi bi-signpost-2 d-lg-none me-2" style="color:var(--gold2)"></i>Alur</a></li>
      @auth
        <li class="nav-item ms-lg-2 mt-2 mt-lg-0"><a href="{{ route('dashboard') }}" class="btn-heritage w-100 w-lg-auto justify-content-center"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
      @endauth
    </ul>
  </div>
</div>
</nav>

<section class="hero-heritage py-5" style="min-height:580px;display:flex;align-items:center">
<div class="pattern"></div>
<div class="hero-pattern"></div>
<div class="hero-glow"></div>
<div class="container position-relative" style="z-index:1">
<div class="row align-items-center g-4">
  <div class="col-lg-6">
    <div class="badge-utama mb-3"><i class="bi bi-moon-stars-fill"></i> TAHUN AJARAN 1448/1449 H • PENDAFTARAN TMTB & DAI</div>
    <div class="arab mb-1" style="color:var(--gold2);font-size:clamp(20px,4.5vw,26px);font-weight:700;line-height:1.8">معهد كنوز الإمام كاومان</div>
    <h1 class="lh-1 mb-3 display-hero" style="font-weight:800;color:var(--green);font-size:2.6rem;letter-spacing:-.5px">TMTB & DAI <span class="grad-gold-text">KIK</span><br><span class="arab" style="font-size:1.4em;color:var(--green2)">PP KUNUUZUL IMAM</span><br><span style="font-size:0.9em;color:var(--brown)">KAUMAN — Bondowoso</span></h1>
    <p class="mb-4" style="color:var(--brown);font-size:clamp(14px,3.5vw,1.05rem);line-height:1.6">Sistem Pendaftaran Resmi TMTB & Dai untuk Madrasah dan Lembaga Mitra PP Kunuuzul Imam Kauman — proses terstruktur, transparan & terverifikasi.</p>
    <div class="d-flex flex-wrap gap-2 mb-4 hero-actions">
      @auth
        <a href="{{ route('permohonan.step1') }}" class="btn-heritage"><i class="bi bi-feather"></i> Buat Permohonan Baru</a>
        <a href="{{ route('permohonan.lama') }}" class="btn-gold-heritage">Lihat Permohonan</a>
      @else
        <a href="{{ route('register') }}" class="btn-heritage"><i class="bi bi-person-plus"></i> Daftar PJGT/GT</a>
        <a href="{{ route('login') }}" class="btn-gold-heritage">Masuk</a>
      @endauth
    </div>
    <div class="d-flex flex-wrap gap-3 small" style="color:var(--green)">
      <span><i class="bi bi-patch-check-fill" style="color:var(--gold2)"></i> Sanad Muttasil</span>
      <span><i class="bi bi-person-badge" style="color:var(--gold2)"></i> TMTB & DAI</span>
      <span><i class="bi bi-geo-alt-fill" style="color:var(--gold2)"></i> Kauman 68213</span>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card-pendaftaran p-4">
      <div class="text-center mb-3">
        <span class="badge mb-2" style="background:var(--green);color:var(--gold);border:1px solid var(--gold);font-size:10px;letter-spacing:1.5px"><i class="bi bi-eye-fill"></i> LIVE PREVIEW</span>
 <div class="arab" style="color:var(--gold2);font-size:18px;font-weight:700">Guru Tugas</div>
        <strong style="color:var(--green)">Form Permohonan Heritage</strong>
        <div class="small" style="color:var(--brown)">PP KUNUUZUL IMAM KAUMAN • TMTB & DAI KIK</div>
      </div>
      <div class="progress-preview mb-2" id="previewProgress"></div>
      <div class="d-flex gap-2 mb-3 justify-content-center" id="previewSteps">
        @php $steps=['Identitas','Pengelola','Madrasah','Murid']; @endphp
        @foreach($steps as $i=>$s)
        <div class="text-center step-preview-btn" data-step="{{$i+1}}" onclick="showPreview({{$i+1}})" style="flex:1;max-width:90px;cursor:pointer">
          <div id="step-circle-{{$i+1}}" style="width:38px;height:38px;background:{{$i==0?'var(--green)':'#f5f0d0'}};color:{{$i==0?'var(--gold)':'var(--brown)'}};border:2px solid {{$i==0?'var(--gold)':'#e8d9a0'}};border-radius:10px;display:flex;align-items:center;justify-content:center;margin:0 auto 6px;font-weight:800;transition:.2s">{{$i+1}}</div>
          <div id="step-label-{{$i+1}}" style="font-size:10px;color:{{$i==0?'var(--green)':'var(--brown)'}};font-weight:700">{{$s}}</div>
        </div>
        @endforeach
      </div>
      <div class="ornamen-border p-3" style="background:#fffdf0;min-height:130px">
        <div class="small fw-bold mb-2" style="color:var(--green)"><i class="bi bi-journal-bookmark-fill" style="color:var(--gold2)"></i> Contoh Isian Formulir — <span id="previewTitle" style="color:var(--gold2)">Tahap 1: Identitas</span></div>
        <!-- Preview 1: Identitas -->
        <div id="preview-1" class="preview-panel d-flex flex-column gap-2 small">
          <div class="d-flex justify-content-between border-bottom pb-1" style="border-color:#e8d9a0"><span style="color:var(--brown)">Madrasah</span><strong style="color:var(--green)">PP KUNUUZUL IMAM KAUMAN</strong></div>
          <div class="d-flex justify-content-between border-bottom pb-1" style="border-color:#e8d9a0"><span style="color:var(--brown)">Alamat</span><strong style="color:var(--green)">Jl KH Zainul Arifin 165, Kauman</strong></div>
          <div class="d-flex justify-content-between"><span style="color:var(--brown)">Wilayah</span><span class="badge" style="background:var(--green);color:var(--gold);border:1px solid var(--gold)">T-4 • Bondowoso</span></div>
        </div>
        <!-- Preview 2: Pengelola -->
        <div id="preview-2" class="preview-panel d-none flex-column gap-2 small">
          <div class="d-flex justify-content-between border-bottom pb-1" style="border-color:#e8d9a0"><span style="color:var(--brown)">Pengasuh</span><strong style="color:var(--green)">KH Ahmad Zainul</strong></div>
          <div class="d-flex justify-content-between border-bottom pb-1" style="border-color:#e8d9a0"><span style="color:var(--brown)">Ketua Yayasan</span><strong style="color:var(--green)">Ust. Hasan Basri</strong></div>
          <div class="d-flex justify-content-between"><span style="color:var(--brown)">PJGT</span><strong style="color:var(--green)">Fulan — 08xxxx (WA)</strong></div>
        </div>
        <!-- Preview 3: Madrasah -->
        <div id="preview-3" class="preview-panel d-none flex-column gap-2 small">
          <div class="d-flex justify-content-between border-bottom pb-1" style="border-color:#e8d9a0"><span style="color:var(--brown)">Bahasa KBM</span><strong style="color:var(--green)">Arab • Indonesia</strong></div>
          <div class="d-flex justify-content-between border-bottom pb-1" style="border-color:#e8d9a0"><span style="color:var(--brown)">Kitab Fiqh</span><strong style="color:var(--green)">Fathul Wahhab</strong></div>
          <div class="d-flex justify-content-between"><span style="color:var(--brown)">Guru</span><span class="badge" style="background:var(--gold);color:var(--green)">L: 19 • P: 5</span></div>
        </div>
        <!-- Preview 4: Murid -->
        <div id="preview-4" class="preview-panel d-none flex-column gap-2 small">
          <div class="d-flex justify-content-between border-bottom pb-1" style="border-color:#e8d9a0"><span style="color:var(--brown)">Sifir / TPQ</span><strong style="color:var(--green)">12 Putra • 10 Putri</strong></div>
          <div class="d-flex justify-content-between border-bottom pb-1" style="border-color:#e8d9a0"><span style="color:var(--brown)">Ibtidaiyah 1-6</span><strong style="color:var(--green)">45 • 38</strong></div>
          <div class="d-flex justify-content-between"><span style="color:var(--brown)">Tsanawiyah</span><strong style="color:var(--green)">30 • 27</strong></div>
        </div>
      </div>
      <a href="{{ route('login') }}" class="btn-heritage w-100 mt-3 text-center d-block text-decoration-none"><span>Mulai Pengajuan</span> <i class="bi bi-arrow-right"></i></a>
 <div class="text-center small mt-2 arab" style="color:var(--gold2)">Semoga Barokah</div>
    </div>
  </div>
</div>
</div>
</section>

<div class="d-flex align-items-center justify-content-center gap-3 py-3" aria-hidden="true" style="background:var(--cream)"><span style="height:2px;width:min(120px,28vw);background:linear-gradient(90deg,transparent,var(--gold));border-radius:10px"></span><span style="color:var(--gold);font-size:13px">◆</span><span style="height:2px;width:min(120px,28vw);background:linear-gradient(90deg,var(--gold),transparent);border-radius:10px"></span></div>

<section id="statistik" class="py-4" style="background:var(--cream);position:relative;z-index:2">
<div class="container">
<div class="text-center mb-3"><span class="sect-eyebrow">Dalam Angka</span></div>
<div class="row g-2 g-md-3">
 <div class="col-6 col-lg-3"><div class="stat-heritage reveal"><div style="width:48px;height:48px;background:var(--green);color:var(--gold);border:2px solid var(--gold);border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px"><i class="bi bi-send-fill"></i></div><div class="h4 fw-bold mb-0 count" data-count="{{ $total ?? 12 }}" style="color:var(--green)">0</div><div class="small" style="color:var(--brown)">Permohonan</div></div></div>
 <div class="col-6 col-lg-3"><div class="stat-heritage reveal delay-1"><div style="width:48px;height:48px;background:var(--gold);color:var(--green);border:2px solid var(--green);border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px"><i class="bi bi-file-earmark-check-fill"></i></div><div class="h4 fw-bold mb-0 count" data-count="1200" style="color:var(--green)">0</div><div class="small" style="color:var(--brown)">Formulir Masuk</div></div></div>
 <div class="col-6 col-lg-3"><div class="stat-heritage reveal delay-2"><div style="width:48px;height:48px;background:#fff;border:2px solid var(--gold);color:var(--green);border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px"><i class="bi bi-people-fill"></i></div><div class="h4 fw-bold mb-0 count" data-count="3500" style="color:var(--green)">0</div><div class="small" style="color:var(--brown)">Santri Mukim</div></div></div>
 <div class="col-6 col-lg-3"><div class="stat-heritage reveal delay-3"><div style="width:48px;height:48px;background:var(--cream2);border:2px solid var(--gold);color:var(--brown);border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px"><i class="bi bi-globe2"></i></div><div class="h4 fw-bold mb-0 count" data-count="34" style="color:var(--green)">0</div><div class="small" style="color:var(--brown)">Provinsi</div></div></div>
</div>
</div>
</section>

<section id="informasi" class="py-5" style="background:#fff;border-top:2px solid var(--gold);border-bottom:2px solid var(--gold)">
<div class="container">
<div class="text-center mb-4 px-2">
  <span class="sect-eyebrow">Kabar Terkini</span>
  <h2 class="fw-bold mt-2" style="color:var(--green);font-size:clamp(22px,6vw,32px)">Informasi & Pengumuman</h2>
  <p style="color:var(--brown);max-width:640px;margin:0 auto;font-size:clamp(13px,3.5vw,15px)">Update resmi seputar pendaftaran TMTB & DAI, jadwal verifikasi, dan pengumuman dari PP Kunuuzul Imam Kauman.</p>
</div>
<div class="row g-3">
  {{-- Dinamis dari Kelola Landing (admin) — fallback ke 3 kartu bawaan jika kosong --}}
  @if(isset($landingInfos) && $landingInfos->count())
    @foreach($landingInfos as $i => $info)
    @php
      $sec = strtolower($info->section);
      $badgeStyle = $sec==='pengumuman' ? 'background:var(--gold);color:var(--green);border:1px solid var(--green)' : ($sec==='panduan' ? 'background:#fff;border:1px solid var(--gold);color:var(--green)' : 'background:var(--green);color:var(--gold);border:1px solid var(--gold)');
      $borderColor = $sec==='pengumuman' ? 'var(--green)' : ($sec==='panduan' ? '#b8941f' : 'var(--gold)');
      $icon = $sec==='pengumuman' ? 'bi-clipboard2-check-fill' : ($sec==='panduan' ? 'bi-journals' : 'bi-megaphone-fill');
      $delay = $i===1 ? 'delay-1' : ($i>=2 ? 'delay-2' : '');
    @endphp
    <div class="col-md-4">
      <div class="feature-heritage h-100 d-flex flex-column reveal {{ $delay }}" style="border-left:4px solid {{ $borderColor }}">
        <div class="d-flex align-items-center gap-2 mb-2">
          <span class="badge" style="{{ $badgeStyle }};font-size:10px">{{ strtoupper($info->category ?: $info->section) }}</span>
          @if($info->date_label)<span class="small" style="color:#8a7a3a"><i class="bi bi-calendar3"></i> {{ $info->date_label }}</span>@endif
        </div>
        <div style="width:54px;height:54px;background:var(--cream2);border:2px solid var(--gold);color:var(--green);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px"><i class="bi {{ $icon }}"></i></div>
        <h5 class="fw-bold mt-3" style="color:var(--green)">{{ $info->title }}</h5>
        @if($info->subtitle)<div class="small fw-bold" style="color:var(--gold2)">{{ $info->subtitle }}</div>@endif
        @if($info->content)<p class="small flex-grow-1" style="color:var(--brown)">{{ $info->content }}</p>@endif
        @if($info->link_text)<a href="{{ $info->link_url ?: '#' }}" class="small fw-bold mt-2" style="color:var(--gold2);text-decoration:none">{{ $info->link_text }} <i class="bi bi-arrow-right"></i></a>@endif
      </div>
    </div>
    @endforeach
  @else
  <!-- Info 1 -->
  <div class="col-md-4">
    <div class="feature-heritage h-100 d-flex flex-column reveal" style="border-left:4px solid var(--gold)">
      <div class="d-flex align-items-center gap-2 mb-2">
        <span class="badge" style="background:var(--green);color:var(--gold);border:1px solid var(--gold);font-size:10px">INFORMASI</span>
        <span class="small" style="color:#8a7a3a"><i class="bi bi-calendar3"></i> 10 Sep 2026</span>
      </div>
      <div style="width:54px;height:54px;background:var(--cream2);border:2px solid var(--gold);color:var(--green);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px"><i class="bi bi-megaphone-fill"></i></div>
      <h5 class="fw-bold mt-3" style="color:var(--green)">Pendaftaran TMTB & DAI 1448/1449 H Dibuka</h5>
      <p class="small flex-grow-1" style="color:var(--brown)">Gelombang 1 dibuka <strong>10 Sep – 30 Nov 2026</strong> untuk seluruh lembaga mitra. Lengkapi Formulir 4 Tahap dan upload berkas sebelum batas akhir.</p>
      <a href="{{ route('register') }}" class="small fw-bold mt-2" style="color:var(--gold2);text-decoration:none">Daftar Sekarang <i class="bi bi-arrow-right"></i></a>
    </div>
  </div>
  <!-- Info 2 -->
  <div class="col-md-4">
    <div class="feature-heritage h-100 d-flex flex-column reveal delay-1" style="border-left:4px solid var(--green)">
      <div class="d-flex align-items-center gap-2 mb-2">
        <span class="badge" style="background:var(--gold);color:var(--green);border:1px solid var(--green);font-size:10px">PENGUMUMAN</span>
        <span class="small" style="color:#8a7a3a"><i class="bi bi-calendar3"></i> 05 Sep 2026</span>
      </div>
      <div style="width:54px;height:54px;background:var(--green);color:var(--gold);border:2px solid var(--gold);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px"><i class="bi bi-clipboard2-check-fill"></i></div>
      <h5 class="fw-bold mt-3" style="color:var(--green)">Jadwal Verifikasi & Distribusi GT</h5>
      <p class="small flex-grow-1" style="color:var(--brown)">Verifikasi berkas oleh Majelis KIK <strong>1–15 Des 2026</strong>. Pengumuman hasil dan distribusi Guru Tugas mulai Januari 2027.</p>
      <a href="#alur" class="small fw-bold mt-2" style="color:var(--gold2);text-decoration:none">Lihat Alur <i class="bi bi-arrow-right"></i></a>
    </div>
  </div>
  <!-- Info 3 -->
  <div class="col-md-4">
    <div class="feature-heritage h-100 d-flex flex-column reveal delay-2" style="border-left:4px solid #b8941f">
      <div class="d-flex align-items-center gap-2 mb-2">
        <span class="badge" style="background:#fff;border:1px solid var(--gold);color:var(--green);font-size:10px">PANDUAN</span>
        <span class="small" style="color:#8a7a3a"><i class="bi bi-calendar3"></i> 01 Sep 2026</span>
      </div>
      <div style="width:54px;height:54px;background:#fff;border:2px solid var(--gold);color:var(--gold2);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px"><i class="bi bi-journals"></i></div>
      <h5 class="fw-bold mt-3" style="color:var(--green)">Panduan Pengisian Formulir 4 Tahap</h5>
      <p class="small flex-grow-1" style="color:var(--brown)">Identitas → Pengelola → Kondisi → Santri. Wajib isi nama pesantren (isi 0 jika tidak ada) dan WA aktif untuk tabayyun.</p>
      <a href="#alur" class="small fw-bold mt-2" style="color:var(--gold2);text-decoration:none">Buka Panduan <i class="bi bi-arrow-right"></i></a>
    </div>
  </div>
  @endif
</div>
<div class="text-center mt-4">
  <a href="#" class="btn-heritage px-4 py-2 d-inline-flex" style="font-size:13px;width:auto"><i class="bi bi-newspaper"></i> Lihat Semua Informasi</a>
  <div class="small mt-2" style="color:#8a7a3a">Kategori: <span class="badge" style="background:var(--cream2);border:1px solid var(--gold);color:var(--green)">Informasi</span> <span class="badge" style="background:var(--cream2);border:1px solid var(--gold);color:var(--green)">Pengumuman</span> <span class="badge" style="background:var(--cream2);border:1px solid var(--gold);color:var(--green)">Panduan</span></div>
</div>
</div>
</section>

<section id="alur" class="py-5" style="background:var(--cream)">
<div class="container">
<div class="row g-4 align-items-start">
  <div class="col-lg-6">
    <span class="sect-eyebrow">Tartib Pesantren</span>
    <h3 class="fw-bold mt-2" style="color:var(--green)">Alur Permohonan 1448/1449 H</h3>
    <p class="small" style="color:var(--brown)">Isilah kolom-kolom di bawah ini dengan lengkap dan jujur, berurutan step by step — tidak tergesa, penuh kehati-hatian.</p>
    <div class="d-flex flex-column gap-3 mt-4">
      @php $alur=[['1','Identitas Madrasah','Nama, alamat Kauman 68213','bi-house-door'],['2','Data Pengelola','Pengasuh - Ketua - PJGT + WA','bi-people'],['3','Kondisi Madrasah','Bahasa, mapel kuning, guru','bi-book'],['4','Jumlah Santri','Sifir, Ibtidaiyah, Tsanawiyah','bi-person-badge'],['5','Verifikasi KIK','Majelis KIK verifikasi & distribusi','bi-patch-check-fill']]; @endphp
      @foreach($alur as $a)
      <div class="step-heritage">
        <div class="step-num arab">{{$a[0]}}</div>
        <div style="flex:1"><div class="fw-bold" style="color:var(--green)">{{$a[1]}}</div><div class="small" style="color:var(--brown)">{{$a[2]}}</div></div>
        <i class="bi {{$a[3]}}" style="color:var(--gold2)"></i>
      </div>
      @endforeach
    </div>
  </div>
  <div class="col-lg-6">
    <div class="ornamen-border p-4" style="background:#fff;">
      <h5 class="fw-bold arab text-center" style="color:var(--green)"><i class="bi bi-lightbulb-fill" style="color:var(--gold2)"></i> Panduan Pengisian Formulir</h5>
      <ul class="small mt-3 mb-0" style="color:var(--brown);line-height:1.9">
        <li><strong style="color:var(--green)">Niat khidmat:</strong> Isi dengan jujur, karena ini amanah umat</li>
        <li><strong style="color:var(--green)">Nama pesantren wajib</strong> — jika tidak ada isi <code style="background:var(--cream2)">0</code></li>
        <li><strong style="color:var(--green)">Data pengelola</strong> nama lengkap KTP + WA aktif (untuk tabayyun)</li>
        <li><strong style="color:var(--green)">Jumlah santri</strong> per kelas Putra/Putri — jangan dilebih-lebihkan</li>
        <li>Status: <span class="badge" style="background:var(--gold);color:var(--green)">Proses</span> <span class="badge bg-success">Diterima</span> <span class="badge bg-danger">Ditolak</span></li>
      </ul>
 <div class="alert small mt-3 mb-0 arab text-center" style="background:var(--cream2);border:1px solid var(--gold);color:var(--green)">Semoga menjadi amal jariyah</div>
      <div class="text-center small mt-2" style="color:var(--brown)">Kendala? <a href="https://wa.me/628124981242?text=Assalamualaikum%20Admin%20KIK%2C%20saya%20butuh%20bantuan%20pengisian%20formulir" target="_blank" rel="noopener" style="color:var(--green);font-weight:700">Hubungi Admin KIK via WA <i class="bi bi-whatsapp"></i></a></div>
    </div>
 <div class="text-center mt-3 arab" style="color:var(--gold2);font-size:16px">Ilmu adalah Cahaya</div>
  </div>
</div>
</div>
</section>

<footer class="footer-heritage py-4 pt-5">
<div class="container">
<div class="row g-3">
  <div class="col-md-7">
    <div class="d-flex gap-3 align-items-center mb-2">
      <span style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;flex-shrink:0"><img src="{{ asset('images/madin.png?v=2') }}" alt="Logo" style="width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 3px 8px rgba(0,0,0,.2))"></span>
      <div><strong style="color:var(--gold)">TMTB & DAI KIK</strong><br><span class="arab small" style="color:var(--cream)">PP KUNUUZUL IMAM KAUMAN</span></div>
    </div>
    <div class="small" style="color:var(--cream);opacity:0.9">Jln KH Zainul Arifin No.165, Kauman, Bondowoso - Jawa Timur 68213<br>Pendaftaran TMTB & DAI • Resmi • Terverifikasi • © 1448 H</div>
  </div>
  <div class="col-md-5 text-md-end small" style="color:var(--cream);opacity:0.8">
    <a class="footer-link" href="#informasi"><i class="bi bi-chevron-right"></i> Informasi</a>
    <a class="footer-link ms-3" href="#alur"><i class="bi bi-chevron-right"></i> Alur</a>
    <a class="footer-link ms-3" href="#statistik"><i class="bi bi-chevron-right"></i> Statistik</a><br>
    <span class="d-none d-md-inline">Pondok Pesantren • Madrasah Diniyah • Majelis Taklim</span>
  </div>
</div>
</div>
</footer>

@auth
<!-- MOBILE STICKY CTA — hanya untuk user login -->
<div class="mobile-sticky-cta d-lg-none">
    <a href="{{ route('permohonan.step1') }}" class="btn" style="background:var(--green);color:var(--gold);border:2px solid var(--gold)"><i class="bi bi-feather"></i> Buat Permohonan</a>
    <a href="{{ route('dashboard') }}" class="btn" style="background:var(--gold);color:var(--green);border:2px solid var(--green)"><i class="bi bi-speedometer2"></i> Dashboard</a>
</div>
@endauth

<button class="totop" id="toTop" title="Kembali ke atas" aria-label="Kembali ke atas"><i class="bi bi-arrow-up"></i></button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const previewTitles = {
  1: 'Tahap 1: Identitas',
  2: 'Tahap 2: Pengelola',
  3: 'Tahap 3: Kondisi Madrasah',
  4: 'Tahap 4: Jumlah Santri'
};
let currentPreview = 1;
function showPreview(n){
  currentPreview = n;
  document.querySelectorAll('.preview-panel').forEach(el=>{
    el.classList.add('d-none'); el.classList.remove('d-flex');
  });
  const target = document.getElementById('preview-'+n);
  if(target){ target.classList.remove('d-none'); target.classList.add('d-flex'); }
  document.getElementById('previewTitle').textContent = previewTitles[n];
  for(let i=1;i<=4;i++){
    const circle = document.getElementById('step-circle-'+i);
    const label = document.getElementById('step-label-'+i);
    if(!circle) continue;
    if(i===n){ circle.style.background='var(--green)'; circle.style.color='var(--gold)'; circle.style.borderColor='var(--gold)'; label.style.color='var(--green)'; }
    else { circle.style.background='#f5f0d0'; circle.style.color='var(--brown)'; circle.style.borderColor='#e8d9a0'; label.style.color='var(--brown)'; }
  }
  // progress bar reset
  const prog=document.getElementById('previewProgress');
  if(prog){ prog.style.transition='none'; prog.style.width='0%'; void prog.offsetWidth; prog.style.transition='width 4.5s linear'; prog.style.width='100%'; }
  if(navigator.vibrate) try{navigator.vibrate(10)}catch(e){}
}
// auto-rotate
let previewInterval = setInterval(()=>{ showPreview(currentPreview%4+1); }, 4500);
['touchstart','click','mouseenter'].forEach(ev=>{
  document.getElementById('previewSteps')?.addEventListener(ev, ()=>{ clearInterval(previewInterval); const prog=document.getElementById('previewProgress'); if(prog) prog.style.width='0%'; }, {once:true});
});
// swipe support untuk preview
let sx=0;
const ps=document.getElementById('previewSteps');
if(ps){
  ps.addEventListener('touchstart', e=> sx=e.touches[0].clientX, {passive:true});
  ps.addEventListener('touchend', e=>{
    const dx=e.changedTouches[0].clientX - sx;
    if(Math.abs(dx)>40){ clearInterval(previewInterval); if(dx<0) showPreview(currentPreview%4+1); else showPreview(currentPreview===1?4:currentPreview-1); }
  }, {passive:true});
  // desktop drag
  let isDown=false, startX=0;
  ps.addEventListener('mousedown', e=>{ isDown=true; startX=e.clientX; ps.style.cursor='grabbing'; });
  window.addEventListener('mouseup', e=>{ if(!isDown) return; isDown=false; ps.style.cursor=''; const dx=e.clientX - startX; if(Math.abs(dx)>40){ clearInterval(previewInterval); if(dx<0) showPreview(currentPreview%4+1); else showPreview(currentPreview===1?4:currentPreview-1); } });
}
// init progress
showPreview(1);
// smooth hide mobile sticky saat scroll ke footer
window.addEventListener('scroll', ()=>{
  const cta=document.querySelector('.mobile-sticky-cta');
  if(!cta || window.innerWidth>576) return;
  const footer=document.querySelector('.footer-heritage');
  if(!footer) return;
  const nearFooter = window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - footer.offsetHeight - 40;
  cta.style.transform = nearFooter ? 'translateY(100%)' : 'translateY(0)';
  cta.style.transition='transform .3s ease';
}, {passive:true});
// ── COUNT-UP ──
const countEls=document.querySelectorAll('.count');
const countObs=new IntersectionObserver(entries=>{
  entries.forEach(entry=>{
    if(!entry.isIntersecting) return;
    const el=entry.target; const target=parseInt(el.dataset.count||0); let cur=0; const isK=target>=1000; const displayTarget=isK?target:target; const step=Math.ceil(target/60);
    const timer=setInterval(()=>{
      cur+=step; if(cur>=target){ cur=target; clearInterval(timer); }
      if(isK && target>=1000){ el.textContent=(cur>=1000?(cur/1000).toFixed(cur%1000===0?0:1)+'k':cur); } else { el.textContent=cur + (el.dataset.count==12?'+':''); }
    }, 22);
    countObs.unobserve(el);
  });
},{threshold:.6});
countEls.forEach(el=> countObs.observe(el));
// ── REVEAL ON SCROLL ──
const revealEls=document.querySelectorAll('.reveal');
const revealObs=new IntersectionObserver(entries=>{
  entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('in'); revealObs.unobserve(e.target); } });
},{threshold:.15, rootMargin:'0px 0px -40px 0px'});
revealEls.forEach(el=> revealObs.observe(el));
// ── NAVBAR SCROLL SPY ──
const sections=['statistik','informasi','alur']; const navLinks=document.querySelectorAll('.navbar-nav .nav-link[href^="#"]');
window.addEventListener('scroll', ()=>{
  // pilih seksi yang posisi atasnya paling dekat DI BAWAH posisi scroll (urutan DOM bebas)
  let current='', bestTop=-Infinity;
  sections.forEach(id=>{
    const sec=document.getElementById(id);
    if(!sec) return;
    const top=sec.offsetTop - 140;
    if(window.scrollY >= top && top >= bestTop){ bestTop=top; current=id; }
  });
  navLinks.forEach(a=>{ a.classList.toggle('active', a.getAttribute('href')==='#'+current); });
}, {passive:true});
// ── PARALLAX HERO ──
const heroPattern=document.querySelector('.hero-pattern');
const hero=document.querySelector('.hero-heritage');
if(hero && heroPattern && window.matchMedia('(pointer:fine)').matches){
  hero.addEventListener('mousemove', e=>{
    const rect=hero.getBoundingClientRect(); const x=(e.clientX - rect.left)/rect.width - .5; const y=(e.clientY - rect.top)/rect.height - .5;
    heroPattern.style.transform=`translate(${x*18}px, ${y*18}px)`;
  });
  hero.addEventListener('mouseleave', ()=> heroPattern.style.transform='translate(0,0)');
}
window.addEventListener('scroll', ()=>{
  if(!heroPattern || window.innerWidth<768) return;
  const y=window.scrollY * 0.12; heroPattern.style.transform=`translateY(${y}px)`;
}, {passive:true});
// ── RIPPLE untuk semua btn-heritage / btn-gold ──
document.querySelectorAll('.btn-heritage,.btn-gold-heritage,.mobile-sticky-cta .btn').forEach(btn=>{
  btn.style.position='relative'; btn.style.overflow='hidden';
  btn.addEventListener('click', function(e){
    const rect=this.getBoundingClientRect(); const size=Math.max(rect.width, rect.height)*1.2; const x=e.clientX - rect.left - size/2; const y=e.clientY - rect.top - size/2;
    const span=document.createElement('span'); span.className='ripple'; span.style.width=span.style.height=size+'px'; span.style.left=x+'px'; span.style.top=y+'px';
    this.appendChild(span); setTimeout(()=> span.remove(), 600);
    if(navigator.vibrate) try{navigator.vibrate(8)}catch(_){}
  });
});
// ── KEMBALI KE ATAS ──
(function(){
  const btn=document.getElementById('toTop');
  if(!btn) return;
  window.addEventListener('scroll', ()=>{
    btn.classList.toggle('show', window.scrollY > 600);
  }, {passive:true});
  btn.addEventListener('click', ()=>{
    window.scrollTo({top:0, behavior:'smooth'});
    if(navigator.vibrate) try{navigator.vibrate(10)}catch(_){}
  });
})();
</script>
</body>
</html>

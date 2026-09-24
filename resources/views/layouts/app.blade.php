<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <script>
    (function(){try{var t=localStorage.getItem('tmtb-theme')||'light';window.__tmtbTheme=t;var h=document.documentElement;if(t==='auto'){h.setAttribute('data-theme',window.matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light');}else{h.setAttribute('data-theme',t);}}catch(e){document.documentElement.setAttribute('data-theme','light');}})();
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#0a3d1f">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico?v=2') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-madrasah.png') }}">
    <title>@yield('title', 'TMTB KIK - PP KUNUUZUL IMAM KAUMAN')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@700&family=Plus+Jakarta+Sans:wght@500;700;800&display=swap" rel="stylesheet">
    <style>
        :root{--green:#0a3d1f;--gold:#d4af37;--gold2:#b8941f;--cream:#fdf6e3;--cream2:#fdf0c7;--brown:#5d4037}
        *{ -webkit-tap-highlight-color:transparent }
        html{scroll-behavior:smooth}
        body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--cream);color:#1a1a1a;overflow-x:hidden;-webkit-font-smoothing:antialiased;position:relative}
        body::before{content:'';position:fixed;inset:0;background-image:url("{{ asset('images/madin.png?v=2') }}");background-size:180px;background-repeat:repeat;opacity:.025;pointer-events:none;z-index:0}
        .arab{font-family:'Amiri',serif}
        /* Sidebar world-class */
        .sidebar{width:260px;min-height:100vh;min-height:100dvh;background:linear-gradient(180deg,#0a3d1f 0%, #0e4d26 40%, #0a3d1f 100%);position:fixed;left:0;top:0;bottom:0;display:flex;flex-direction:column;overflow:hidden;border-right:3px solid var(--gold);box-shadow:4px 0 28px rgba(0,0,0,0.18);z-index:1050;transition:transform .32s cubic-bezier(.4,0,.2,1);overscroll-behavior:contain}
        .sidebar .menu{flex:1;overflow-y:auto;overscroll-behavior:contain;padding-bottom:8px}
        .sidebar .menu::-webkit-scrollbar{width:6px}
        .sidebar .menu::-webkit-scrollbar-thumb{background:rgba(212,175,55,0.35);border-radius:10px}
        .sidebar-user{margin-top:auto;position:sticky;bottom:0;z-index:3;background:linear-gradient(180deg,rgba(10,61,31,0) 0%, #0a3d1f 30%);padding:10px 12px calc(10px + env(safe-area-inset-bottom));}
        .sidebar-user-card{display:flex;align-items:center;gap:10px;background:rgba(255,255,255,.07);border:1px solid rgba(212,175,55,.45);border-radius:14px;padding:9px 10px;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);}
        .sidebar-user-card img.avatar{width:40px;height:40px;border-radius:50%;object-fit:cover;border:2px solid var(--gold);flex-shrink:0;background:#0a3d1f}
        .sidebar-user-card .uinfo{min-width:0;flex:1;line-height:1.25}
        .sidebar-user-card .uname{color:#fff;font-weight:700;font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .sidebar-user-card .usub{color:rgba(253,246,227,.65);font-size:11px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .sidebar-user-card .urole{display:inline-block;font-size:9px;font-weight:800;letter-spacing:.6px;color:var(--gold);border:1px solid rgba(212,175,55,.6);border-radius:20px;padding:1px 7px;margin-top:3px}
        .sidebar-user-card .logout-btn{width:38px;height:38px;border-radius:11px;border:1px solid rgba(255,120,120,.5);background:rgba(220,53,69,.14);color:#ffb3b3;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:.18s}
        .sidebar-user-card .logout-btn:hover{background:#dc3545;color:#fff;border-color:#dc3545}
        .sidebar .brand{background:linear-gradient(135deg,var(--cream) 0%, #fff 60%, var(--cream2) 100%);padding:12px 14px;border-bottom:3px solid var(--gold);display:flex;align-items:center;gap:10px;position:sticky;top:0;z-index:2;cursor:pointer;transition:background .3s}
        .sidebar .brand:hover{background:linear-gradient(135deg,#fff 0%, var(--cream) 100%)}
        .sidebar .brand::after{content:'◆';position:absolute;bottom:-10px;left:50%;transform:translateX(-50%);background:var(--cream);color:var(--gold);padding:0 6px;font-size:12px}
        .sidebar .menu a{display:flex;align-items:center;gap:10px;padding:11px 16px;color:var(--cream);text-decoration:none;font-size:13.5px;margin:3px 10px;border-radius:10px;border:1px solid transparent;transition:.15s;min-height:44px}
        .sidebar .menu a.active{background:var(--gold);color:var(--green);font-weight:700;border-color:var(--cream);box-shadow:0 2px 8px rgba(212,175,55,0.3)}
        .sidebar .menu a:hover{background:rgba(212,175,55,0.15);color:var(--gold);border-color:var(--gold)}
        .sidebar .menu a:active{transform:scale(0.97)}
        .sidebar .menu .submenu{margin-left:18px;font-size:12.5px;border-left:1px dashed rgba(212,175,55,0.4);padding-left:8px}
        .sidebar .menu .submenu a{margin:2px 6px;padding:8px 10px;min-height:40px}
        .sidebar-close{display:none;width:36px;height:36px;border:2px solid var(--gold);background:rgba(255,255,255,0.08);color:var(--gold);border-radius:10px;align-items:center;justify-content:center;flex-shrink:0}
        .main{margin-left:260px;min-height:100vh;min-height:100dvh;display:flex;flex-direction:column;transition:margin .32s}
        .topbar{background:rgba(255,255,255,0.88);backdrop-filter:blur(16px) saturate(160%);-webkit-backdrop-filter:blur(16px) saturate(160%);border-bottom:2px solid var(--gold);padding:10px 20px;display:flex;justify-content:space-between;align-items:center;position:sticky;top:0;z-index:1020;box-shadow:0 4px 20px rgba(10,61,31,0.08);padding-top:calc(10px + env(safe-area-inset-top));gap:10px}
        .topbar .breadcrumb{margin:0;background:transparent;padding:0;font-size:13px}
        .content{padding:22px;flex:1;position:relative;z-index:1}
        .card-form{background:#fff;border:2px solid var(--gold);border-radius:16px;overflow:hidden;box-shadow:0 6px 24px rgba(10,61,31,0.08);transition:transform .2s, box-shadow .2s}
        .card-form:hover{box-shadow:0 10px 36px rgba(10,61,31,0.12)}
        .card-form-header{padding:14px 20px;border-bottom:2px solid var(--gold);background:linear-gradient(135deg,var(--cream) 0%, #f7e8b5 100%);color:var(--green);font-weight:700}
        .stepper{display:flex;align-items:center;justify-content:space-between;padding:14px 16px 10px;background:#fff;border-bottom:1px solid #e8d9a0;gap:4px;overflow-x:auto;scroll-snap-type:x mandatory;-webkit-overflow-scrolling:touch}
        .stepper::-webkit-scrollbar{display:none}
        .step{text-align:center;flex:1;min-width:68px;position:relative;scroll-snap-align:start}
        .step .circle{width:42px;height:42px;border-radius:10px;background:#f5f0d0;color:var(--green);display:flex;align-items:center;justify-content:center;margin:0 auto 6px;font-size:18px;border:2px solid #e8d9a0;font-weight:700;transition:.2s}
        .step.active .circle{background:var(--green);color:var(--gold);border-color:var(--gold);box-shadow:0 3px 10px rgba(10,61,31,0.2);transform:scale(1.06)}
        .step.done .circle{background:var(--green);color:var(--gold);border-color:var(--gold)}
        .step label{font-size:11px;color:#8a7a3a;font-weight:600;white-space:nowrap}
        .step.active label,.step.done label{color:var(--green);font-weight:800}
        .step .line{position:absolute;top:21px;left:62%;right:-38%;height:2.5px;background:#e8d9a0;border-radius:10px}
        .step.done .line,.step.active .line{background:var(--gold)}
        .step:last-child .line{display:none}
        .form-control,.form-select{border-radius:10px;font-size:15px;padding:10px 12px;border:1.5px solid #e8d9a0;min-height:44px}
        .form-control:focus,.form-select:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(212,175,55,0.18)}
        .form-control.required{border-color:var(--gold);background:#fffdf0}
        .form-label{font-weight:600;color:var(--green);margin-bottom:4px;font-size:13px}
        .btn-green{background:var(--green);color:var(--gold);border:2px solid var(--gold);padding:10px 20px;border-radius:50px;font-weight:700;min-height:44px;display:inline-flex;align-items:center;justify-content:center;gap:6px;transition:.18s}
        .btn-green:hover{background:#082f18;color:var(--gold);transform:translateY(-1px)}
        .btn-green:active{transform:scale(0.96)}
        .btn-yellow{background:var(--gold);color:var(--green);border:2px solid var(--green);padding:10px 20px;border-radius:50px;font-weight:700;min-height:44px;display:inline-flex;align-items:center;justify-content:center;gap:6px;transition:.18s}
        .btn-yellow:hover{background:#b8941f;color:var(--green)}
        .btn-yellow:active{transform:scale(0.96)}
        .username-badge{border:2px solid var(--gold);color:var(--green);background:var(--cream);padding:4px 10px;border-radius:50px;font-size:12px;font-weight:700;white-space:nowrap}
        .footer{background:var(--green);color:var(--cream);border-top:3px solid var(--gold);padding:12px 20px;font-size:11px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;padding-bottom:calc(12px + env(safe-area-inset-bottom))}
        .footer a{color:var(--gold);text-decoration:none}
        .badge-pendaftaran{background:var(--green);color:var(--gold);border:1px solid var(--gold);padding:3px 8px;border-radius:50px;font-size:10px;font-weight:700}
        .kitab-badge{background:var(--green);color:var(--gold);border:1px solid var(--gold);padding:3px 8px;border-radius:50px;font-size:10px;font-weight:700}
        /* Mobile overlay */
        .sidebar-overlay{position:fixed;inset:0;background:rgba(10,61,31,0.45);backdrop-filter:blur(3px);-webkit-backdrop-filter:blur(3px);z-index:1045;opacity:0;pointer-events:none;transition:opacity .32s}
        .sidebar-overlay.show{opacity:1;pointer-events:auto}
        /* Bottom Nav — mobile only */
        .bottom-nav{position:fixed;bottom:0;left:0;right:0;z-index:1046;background:rgba(255,255,255,0.97);backdrop-filter:blur(16px) saturate(180%);-webkit-backdrop-filter:blur(16px) saturate(180%);border-top:2.5px solid var(--gold);display:none;grid-template-columns:repeat(5,1fr);padding:6px 6px calc(6px + env(safe-area-inset-bottom));box-shadow:0 -8px 30px rgba(10,61,31,0.14)}
        .bottom-nav a{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:2px;padding:6px 2px;border-radius:12px;text-decoration:none;color:var(--brown);font-size:10px;font-weight:700;transition:.16s;min-height:48px;position:relative}
        .bottom-nav a i{font-size:20px;line-height:1;transition:.16s}
        .bottom-nav a.active{background:var(--green);color:var(--gold);border:1.5px solid var(--gold);box-shadow:0 4px 14px rgba(10,61,31,0.18)}
        .bottom-nav a.active i{color:var(--gold)}
        .bottom-nav a:active{transform:scale(0.93)}
        /* Mobile masterpiece breakpoints */
        @media(max-width:991px){
            .sidebar{transform:translateX(-100%);width:300px;max-width:84vw;box-shadow:8px 0 40px rgba(0,0,0,0.22)}
            .sidebar.mobile-open{transform:translateX(0)}
            .sidebar-close{display:flex}
            .main{margin-left:0}
            .content{padding:14px 14px 84px}
            .topbar{padding-left:14px;padding-right:14px}
            .bottom-nav{display:grid}
            .footer{margin-bottom:0;font-size:10.5px}
            .card-form{border-radius:14px}
        }
        @media(max-width:576px){
            .content{padding:12px 12px 86px}
            .topbar .breadcrumb{font-size:12px}
            .card-form-header{padding:12px 14px;font-size:14px}
            .stepper{padding:12px 8px 10px;gap:2px}
            .step{min-width:62px}
            .step .circle{width:38px;height:38px;font-size:16px}
            .step label{font-size:9.5px}
            .form-control,.form-select{font-size:16px} /* prevent iOS zoom */
            .btn-green,.btn-yellow{padding:11px 16px;font-size:14px;width:100%}
            .p-3.border-top.d-flex{flex-wrap:wrap;gap:10px}
            .p-3.border-top.d-flex .btn-green,.p-3.border-top.d-flex .btn-yellow{flex:1;min-width:120px}
            /* tables -> allow horizontal swipe hint */
            .table-responsive{position:relative}
            .table-responsive::after{content:'‹ geser ›';position:absolute;right:8px;top:6px;background:var(--cream2);border:1px solid var(--gold);color:var(--brown);font-size:9px;padding:2px 6px;border-radius:20px;opacity:0.85;pointer-events:none}
        }
        @media(max-width:375px){
            .sidebar{width:86vw}
            .content{padding:10px 10px 18px}
        }
        /* interactive extras */
        .ripple{position:absolute;border-radius:50%;transform:scale(0);animation:ripple .55s ease-out;background:rgba(212,175,55,0.38);pointer-events:none}
        @keyframes ripple{to{transform:scale(4);opacity:0}}
        .toast-wrap{position:fixed;right:16px;bottom:84px;z-index:1080;display:flex;flex-direction:column;gap:8px;pointer-events:none}
        .toast-item{background:var(--green);color:var(--cream);border:1.5px solid var(--gold);padding:12px 16px;border-radius:12px;box-shadow:0 8px 28px rgba(0,0,0,0.18);font-size:13px;font-weight:600;display:flex;align-items:center;gap:10px;min-width:260px;max-width:360px;animation:slideIn .35s cubic-bezier(.22,1,.36,1);pointer-events:auto}
        .toast-item.success{border-color:#22c55e}
        .toast-item.error{background:#7a0a0a;border-color:#ffb3b3;color:#fff}
        @keyframes slideIn{from{opacity:0;transform:translateX(20px) translateY(8px)} to{opacity:1;transform:none}}
        .sidebar-search{margin:0 10px 8px;background:rgba(255,255,255,0.08);border:1.5px solid rgba(212,175,55,0.35);border-radius:10px;overflow:hidden;display:flex;align-items:center}
        .sidebar-search input{background:transparent;border:none;color:var(--cream);padding:8px 10px;font-size:12.5px;flex:1;outline:none;min-height:36px}
        .sidebar-search input::placeholder{color:rgba(253,246,227,0.6)}
        .sidebar-search i{color:var(--gold);padding:0 8px;font-size:13px}
        .menu a.hidden-search{display:none !important}
        /* bottom nav sits flush above footer — no extra cream gap */
        @media(max-width:991px){ .main{padding-bottom:0} }
        /* ── Animasi pergantian menu ── */
        @keyframes pageIn{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:none}}
        @keyframes tabIn{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:none}}
        .content{animation:pageIn .35s cubic-bezier(.22,1,.36,1) both}
        .content.page-leave{opacity:0;transform:translateY(8px);transition:opacity .16s ease,transform .16s ease}
        .card,.card-form{animation:pageIn .4s cubic-bezier(.22,1,.36,1) both}
        .tab-pane.show.active{animation:tabIn .28s ease both}
        .sidebar .menu a{transition:background .18s,color .18s,transform .12s,box-shadow .18s}
        .sidebar .menu a.active{animation:pageIn .3s ease both}
        .bottom-nav a{transition:background .18s,color .18s,transform .12s}
        .bottom-nav a.active{animation:pageIn .3s ease both}
        @media (prefers-reduced-motion: reduce){ .content,.card,.card-form,.tab-pane.show.active{animation:none !important} }
        /* ── MODE GELAP ── */
        html[data-theme="dark"]{color-scheme:dark}
        html[data-theme="dark"] body{background:#101510;color:#e9e7de}
        html[data-theme="dark"] body::before{opacity:.05}
        html[data-theme="dark"] .topbar{background:rgba(16,21,16,.92)}
        html[data-theme="dark"] .topbar .breadcrumb a{color:#f4e2a0 !important}
        html[data-theme="dark"] .topbar .breadcrumb .active{color:var(--gold) !important}
        html[data-theme="dark"] .card,html[data-theme="dark"] .card-form{background:#182018;border-color:var(--gold);color:#e9e7de}
        html[data-theme="dark"] .card-form-header{background:linear-gradient(135deg,#1c2b1c,#243024) !important;color:#f4e2a0 !important}
        html[data-theme="dark"] .table{color:#e9e7de}
        html[data-theme="dark"] .form-control,html[data-theme="dark"] .form-select{background:#10160f;border-color:#3a4a3a;color:#e9e7de}
        html[data-theme="dark"] .form-label{color:#f4e2a0}
        html[data-theme="dark"] .dropdown-menu{background:#182018}
        html[data-theme="dark"] .dropdown-item{color:#e9e7de}
        html[data-theme="dark"] .dropdown-item:hover{background:rgba(212,175,55,.15)}
        html[data-theme="dark"] .bottom-nav{background:rgba(16,21,16,.97)}
        html[data-theme="dark"] .bottom-nav a{color:#b9b5a6}
        html[data-theme="dark"] .pagination .page-link{background:#182018;border-color:#3a4a3a;color:#e9e7de}
        html[data-theme="dark"] .alert{filter:brightness(.92)}
        html[data-theme="dark"] .stepper{background:#182018 !important;border-bottom-color:var(--gold)}
        /* ── Animasi tema ── */
        body,.topbar,.card,.card-form,.card-form-header,.table,.form-control,.form-select,.dropdown-menu,.bottom-nav,.stepper{transition:background-color .35s ease,color .35s ease,border-color .35s ease}
        #themeToggle{transition:transform .18s ease,box-shadow .25s ease}
        #themeToggle:hover{transform:translateY(-1px);box-shadow:0 4px 14px rgba(212,175,55,.4)}
        #themeToggle:active{transform:scale(.92)}
        #themeIcon{display:inline-block}
        #themeIcon.swap{animation:themePop .45s cubic-bezier(.34,1.56,.64,1)}
        @keyframes themePop{0%{transform:scale(.3) rotate(-120deg);opacity:0}60%{transform:scale(1.15) rotate(10deg)}100%{transform:scale(1) rotate(0);opacity:1}}
        #themeMenu{transform-origin:top right}
        #themeMenu.show{animation:menuPop .22s cubic-bezier(.22,1,.36,1)}
        @keyframes menuPop{from{opacity:0;transform:scale(.92) translateY(-6px)}to{opacity:1;transform:none}}
        .theme-opt{transition:background .18s,transform .12s}
        .theme-opt:hover{background:var(--cream2) !important}
        .theme-opt:active{transform:scale(.97)}
        .theme-opt .theme-check{opacity:0;transform:scale(.5);transition:.2s}
        .theme-opt.on .theme-check{opacity:1;transform:scale(1)}
        .theme-opt.on{background:var(--cream2) !important}
    </style>
    @stack('styles')
</head>
<body>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<div class="sidebar" id="sidebar">
    <div class="brand">
        <div style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0"><img src="{{ asset('images/madin.png?v=2') }}" alt="Logo" style="width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 2px 6px rgba(0,0,0,.2))"></div>
        <div style="line-height:1.1;flex:1"><strong style="font-size:13px;color:var(--green)">TMTB <span style="color:#b8941f">KIK</span></strong><br><span class="arab" style="font-size:10px;color:#5d4037">PP KUNUUZUL IMAM KAUMAN</span></div>
        <button class="sidebar-close" onclick="closeSidebar()" aria-label="Tutup menu"><i class="bi bi-x-lg"></i></button>
    </div>
    <div class="sidebar-search"><i class="bi bi-search"></i><input id="sidebarSearch" type="text" placeholder="Cari menu... ( / )" autocomplete="off"><span class="small" style="color:rgba(253,246,227,0.5);padding-right:8px;font-size:10px">⌘K</span></div>
    <div class="menu mt-2">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard*') ? 'active':'' }}"><i class="bi bi-house-door-fill"></i> Dashboard</a>
        @if((auth()->user()->role ?? '')==='pjgt')
        <a href="{{ route('pjgt.biodata') }}" class="{{ request()->routeIs('pjgt.biodata*') ? 'active':'' }}"><i class="bi bi-person-vcard-fill"></i> Biodata PJGT</a>
        @endif
        @if((auth()->user()->role ?? '')==='pjgt')
        <div class="px-4 mt-3 mb-1 small fw-bold" style="color:rgba(212,175,55,.7);font-size:10px;letter-spacing:1.5px">PERMOHONAN</div>
        <a href="{{ route('permohonan.step1') }}" class="{{ request()->routeIs('permohonan.step*') ? 'active':'' }}"><i class="bi bi-feather"></i> Formulir Pengajuan</a>
        <a href="{{ route('permohonan.lama') }}" class="{{ request()->routeIs('permohonan.lama','permohonan.show','permohonan.edit') ? 'active':'' }}"><i class="bi bi-collection-fill"></i> Pengajuan Saya</a>
        @php $gtSayaCount = \App\Models\Penempatan::unreadUntukPjgt(auth()->user()); @endphp
        <a href="{{ route('pjgt.gt-saya') }}" class="{{ request()->routeIs('pjgt.gt-saya') ? 'active':'' }}"><i class="bi bi-people-fill"></i> Guru Tugas @if($gtSayaCount>0)<span class="badge ms-auto" style="background:#dc3545;color:#fff;font-size:10px;border-radius:20px;padding:2px 8px">{{ $gtSayaCount }}</span>@endif</a>
        <a href="{{ route('pjgt.laporan.index') }}" class="{{ request()->routeIs('pjgt.laporan*') ? 'active':'' }}"><i class="bi bi-clipboard2-check-fill"></i> Laporan GT</a>
        <a href="{{ route('pengaduan.index') }}" class="{{ request()->routeIs('pengaduan*') ? 'active':'' }}"><i class="bi bi-flag-fill"></i> Pengaduan</a>
        <a href="{{ route('layanan.index') }}" class="{{ request()->routeIs('layanan*') ? 'active':'' }}"><i class="bi bi-headset"></i> Layanan</a>
        @endif
        @if((auth()->user()->role ?? '')==='admin')
        <div class="px-4 mt-3 mb-1 small fw-bold" style="color:rgba(212,175,55,.7);font-size:10px;letter-spacing:1.5px">ADMIN</div>
        <a href="{{ route('landing-contents.index') }}" class="{{ request()->routeIs('landing-contents*') ? 'active':'' }}"><i class="bi bi-pencil-square"></i> Kelola Landing</a>
        <a href="{{ route('form-questions.index') }}" class="{{ request()->routeIs('form-questions*') ? 'active':'' }}"><i class="bi bi-list-check"></i> Kelola Pertanyaan Form</a>
        <a href="{{ route('permohonan.lama') }}" class="{{ request()->routeIs('permohonan.lama','permohonan.show','permohonan.edit') ? 'active':'' }}"><i class="bi bi-collection-fill"></i> Arsip Permohonan</a>
        <a href="{{ route('laporan') }}" class="{{ request()->routeIs('laporan') ? 'active':'' }}"><i class="bi bi-megaphone-fill"></i> Laporan Permohonan</a>
        <a href="{{ route('pjgt.laporan.index') }}" class="{{ request()->routeIs('pjgt.laporan*') ? 'active':'' }}"><i class="bi bi-clipboard2-check-fill"></i> Laporan GT</a>
        <a href="{{ route('absensi.rekap') }}" class="{{ request()->routeIs('absensi.rekap') ? 'active':'' }}"><i class="bi bi-bar-chart-fill"></i> Rekap Absensi</a>
        <a href="{{ route('penempatan.index') }}" class="{{ request()->routeIs('penempatan*') ? 'active':'' }}"><i class="bi bi-geo-alt-fill"></i> Penempatan GT</a>
        <a href="{{ route('biodata.rekap') }}" class="{{ request()->routeIs('biodata.rekap', 'biodata.show') ? 'active':'' }}"><i class="bi bi-people-fill"></i> Data Bio</a>
        <a href="{{ route('setting.index') }}" class="{{ request()->routeIs('setting*') ? 'active':'' }}"><i class="bi bi-gear-fill"></i> Pengaturan</a>
        <a href="{{ route('pengaduan.index') }}" class="{{ request()->routeIs('pengaduan*') ? 'active':'' }}"><i class="bi bi-flag-fill"></i> Pengaduan</a>
        <a href="{{ route('layanan.index') }}" class="{{ request()->routeIs('layanan*') ? 'active':'' }}"><i class="bi bi-headset"></i> Layanan — Saran</a>
        <div class="px-4 mt-3 mb-1 small fw-bold" style="color:rgba(253,246,227,.4);font-size:10px;letter-spacing:1.5px">SEGERA HADIR</div>
        <a href="#" style="opacity:.55"><i class="bi bi-calendar-event"></i> Rapat <span class="badge bg-warning text-dark ms-auto" style="font-size:8px">soon</span></a>
        <a href="#" style="opacity:.55"><i class="bi bi-eye-fill"></i> Supervisi <span class="badge bg-warning text-dark ms-auto" style="font-size:8px">soon</span></a>
        @elseif((auth()->user()->role ?? '')==='gt')
        <a href="{{ route('gt.biodata') }}" class="{{ request()->routeIs('gt.biodata') ? 'active':'' }}"><i class="bi bi-person-badge-fill"></i> Biodata</a>
        <a href="{{ route('form.ijin') }}" class="{{ request()->routeIs('form.ijin*') ? 'active':'' }}"><i class="bi bi-file-earmark-check-fill"></i> Form Ijin GT</a>
        <a href="{{ route('pengaduan.index') }}" class="{{ request()->routeIs('pengaduan*') ? 'active':'' }}"><i class="bi bi-flag-fill"></i> Aduan Saya</a>
        <div class="px-4 mt-3 mb-1 small fw-bold" style="color:rgba(212,175,55,.7);font-size:10px;letter-spacing:1.5px">KEGIATAN</div>
        <a href="#absensiMenu" data-bs-toggle="collapse" aria-expanded="true" aria-controls="absensiMenu" class="collapse-toggle" style="justify-content:space-between;">
            <span><i class="bi bi-fingerprint"></i> Absensi Kehadiran</span> <i class="bi bi-chevron-down" style="font-size:10px;transition:transform .25s" id="absensiChevron"></i>
        </a>
        <div id="absensiMenu" class="collapse show">
            <a href="{{ route('gt.absensi.mengajar') }}" class="{{ request()->routeIs('gt.absensi.mengajar') ? 'active':'' }} submenu"><i class="bi bi-journal-check"></i> Kehadiran Mengajar</a>
            <a href="{{ route('gt.absensi.shalat') }}" class="{{ request()->routeIs('gt.absensi.shalat') ? 'active':'' }} submenu"><i class="bi bi-moon-stars-fill"></i> Shalat 5 Waktu</a>
        </div>
        @endif
    </div>
    {{-- Kartu user paling bawah — model minimal modern --}}
    <div class="sidebar-user">
        <div class="sidebar-user-card">
            <img class="avatar" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'U') }}&background=d4af37&color=0a3d1f&size=80" alt="">
            <div class="uinfo">
                <div class="uname">{{ auth()->user()->name }}</div>
                <div class="usub">{{ auth()->user()->username }}</div>
                <span class="urole">{{ strtoupper(auth()->user()->role ?? '-') }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="m-0">@csrf<button class="logout-btn" title="Keluar"><i class="bi bi-box-arrow-right"></i></button></form>
        </div>
    </div>
</div>

<div class="main">
    <div class="topbar">
        <div class="d-flex align-items-center gap-2 flex-shrink-0">
            <button class="btn btn-sm" style="border:2px solid var(--gold);background:var(--cream2);color:var(--green);width:40px;height:40px;display:flex;align-items:center;justify-content:center;border-radius:10px;flex-shrink:0" onclick="toggleSidebar()" aria-label="Menu">
                <i class="bi bi-list" style="font-size:18px"></i>
            </button>
            <nav aria-label="breadcrumb" class="d-none d-sm-block">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none" style="color:var(--green)"><i class="bi bi-house"></i> Home</a></li>
                    <li class="breadcrumb-item active" style="color:var(--gold);font-weight:700;max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">@yield('breadcrumb', 'Form Permohonan')</li>
                </ol>
            </nav>
            <span class="d-sm-none small fw-bold" style="color:var(--green);max-width:110px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">@yield('breadcrumb', 'Form')</span>
        </div>
        <div class="d-flex align-items-center gap-2 flex-shrink-0">
            <div class="dropdown flex-shrink-0">
                <button id="themeToggle" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-sm" style="border:2px solid var(--gold);background:var(--cream2);color:var(--green);width:40px;height:40px;display:flex;align-items:center;justify-content:center;border-radius:10px" title="Pilih mode tampilan">
                    <i id="themeIcon" class="bi bi-sun-fill" style="font-size:17px"></i>
                </button>
                <ul class="dropdown-menu" id="themeMenu" style="border:2px solid var(--gold);border-radius:14px;overflow:hidden;min-width:210px;padding:6px">
                    <li><button type="button" class="dropdown-item theme-opt d-flex align-items-center gap-2" data-mode="light" style="border-radius:10px;padding:9px 10px"><i class="bi bi-sun-fill" style="color:#b8941f;font-size:17px"></i><span><span class="fw-bold small d-block" style="color:var(--green)">Terang</span><span class="d-block" style="font-size:10px;color:#8a7a3a">Selalu terang</span></span><i class="bi bi-check-lg ms-auto theme-check" style="color:#198754"></i></button></li>
                    <li><button type="button" class="dropdown-item theme-opt d-flex align-items-center gap-2" data-mode="dark" style="border-radius:10px;padding:9px 10px"><i class="bi bi-moon-stars-fill" style="color:#0a3d1f;font-size:17px"></i><span><span class="fw-bold small d-block" style="color:var(--green)">Gelap</span><span class="d-block" style="font-size:10px;color:#8a7a3a">Nyaman di malam hari</span></span><i class="bi bi-check-lg ms-auto theme-check" style="color:#198754"></i></button></li>
                    <li><button type="button" class="dropdown-item theme-opt d-flex align-items-center gap-2" data-mode="auto" style="border-radius:10px;padding:9px 10px"><i class="bi bi-circle-half" style="color:#0a3d1f;font-size:17px"></i><span><span class="fw-bold small d-block" style="color:var(--green)">Otomatis</span><span class="d-block" style="font-size:10px;color:#8a7a3a">Ikut pengaturan HP</span></span><i class="bi bi-check-lg ms-auto theme-check" style="color:#198754"></i></button></li>
                </ul>
            </div>
            @if((auth()->user()->role ?? '') === 'admin')
            <a href="{{ route('setting.index') }}" class="badge-pendaftaran d-none d-md-inline text-decoration-none" title="Ubah tahun ajaran">{{ \App\Models\Setting::tahunAjaran() }} H</a>
            @else
            <span class="badge-pendaftaran d-none d-md-inline">{{ \App\Models\Setting::tahunAjaran() }} H</span>
            @endif
            <a href="{{ route('landing') }}" class="small text-decoration-none d-none d-md-inline" style="color:var(--green);font-weight:700"><i class="bi bi-house"></i> Beranda</a>
            <div class="dropdown d-flex align-items-center gap-2">
                <a href="#" data-bs-toggle="dropdown" class="d-flex align-items-center gap-2 text-decoration-none" style="min-height:40px">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=0a3d1f&color=d4af37&size=80" class="rounded-circle" width="34" height="34" style="border:2px solid var(--gold);object-fit:cover">
                    <span class="small d-none d-lg-inline" style="color:var(--green);font-weight:700;max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ auth()->user()->name ?? 'Guest' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" style="border:2px solid var(--gold);border-radius:14px;overflow:hidden;min-width:220px">
                    <li><span class="dropdown-item small" style="color:var(--green);white-space:normal;word-break:break-all">{{ auth()->user()->email ?? '' }}<br><span class="text-muted" style="font-size:11px">{{ auth()->user()->username ?? '' }} • {{ strtoupper(auth()->user()->role ?? '') }}</span></span></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item small" href="{{ route('landing') }}" style="color:var(--green)"><i class="bi bi-house"></i> Beranda Landing</a></li>
                    <li><a class="dropdown-item small" href="{{ route('password.edit') }}" style="color:var(--green)"><i class="bi bi-key"></i> Ganti Password</a></li>
                    <li><form method="POST" action="{{ route('logout') }}">@csrf<button class="dropdown-item small" style="color:#dc3545"><i class="bi bi-box-arrow-right"></i> Keluar</button></form></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="content">
        @if(session('success'))
            <div class="alert alert-dismissible fade show" style="background:var(--cream2);border:2px solid var(--gold);color:var(--green);border-radius:12px"><i class="bi bi-check-circle-fill" style="color:var(--gold)"></i> {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if($errors->any())
            <div class="alert" style="background:#ffe9e9;border:2px solid #ffb3b3;color:#7a0a0a;border-radius:12px"><i class="bi bi-exclamation-triangle-fill"></i> {{ $errors->first() }}</div>
        @endif
        @yield('content')
    </div>

    <div class="footer">
        <span class="arab">© 1448 TMTB KIK • PP KUNUUZUL IMAM KAUMAN • Kauman 68213</span>
 <span class="d-none d-md-inline small" style="color:var(--gold)">Heritage Kuning</span>
        <span class="d-md-none small" style="color:var(--gold);opacity:0.85">Heritage • 1448H</span>
    </div>
</div>

<div id="toastWrap" class="toast-wrap"></div>
<!-- Bottom Nav — Mobile Masterpiece -->
<nav class="bottom-nav" aria-label="Navigasi bawah" style="@if((auth()->user()->role ?? '')==='pjgt')grid-template-columns:repeat(4,1fr);@else grid-template-columns:repeat(3,1fr);@endif">
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard*') ? 'active':'' }}">
        <i class="bi {{ request()->routeIs('dashboard*') ? 'bi-house-door-fill' : 'bi-house-door' }}"></i>
        <span>Home</span>
    </a>
    @if(in_array(auth()->user()->role ?? '', ['admin','pjgt']))
    @if((auth()->user()->role ?? '')==='pjgt')
    <a href="{{ route('permohonan.step1') }}" class="{{ request()->routeIs('permohonan.step*') ? 'active':'' }}">
        <i class="bi {{ request()->routeIs('permohonan.step*') ? 'bi-feather' : 'bi-pencil-square' }}"></i>
        <span>Form</span>
    </a>
    @endif
    <a href="{{ route('permohonan.lama') }}" class="{{ request()->routeIs('permohonan.lama','permohonan.show','permohonan.edit') ? 'active':'' }}">
        <i class="bi {{ request()->routeIs('permohonan.lama','permohonan.show','permohonan.edit') ? 'bi-collection-fill' : 'bi-collection' }}"></i>
        <span>{{ (auth()->user()->role ?? '')==='pjgt' ? 'Pengajuan' : 'Arsip' }}</span>
    </a>
    <a href="{{ route('landing') }}">
        <i class="bi bi-globe2"></i>
        <span>Beranda</span>
    </a>
    @else
    <a href="{{ route('gt.biodata') }}" class="{{ request()->routeIs('gt.biodata') ? 'active':'' }}">
        <i class="bi {{ request()->routeIs('gt.biodata') ? 'bi-person-badge-fill' : 'bi-person-badge' }}"></i>
        <span>Biodata</span>
    </a>
    <a href="{{ route('gt.absensi.mengajar') }}" class="{{ request()->routeIs('gt.absensi.*') ? 'active':'' }}">
        <i class="bi {{ request()->routeIs('gt.absensi.*') ? 'bi-fingerprint' : 'bi-fingerprint' }}"></i>
        <span>Absensi</span>
    </a>
    @endif
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleSidebar(){
  const sb=document.getElementById('sidebar');
  const ov=document.getElementById('sidebarOverlay');
  const isOpen=sb.classList.contains('mobile-open');
  if(isOpen) closeSidebar(); else openSidebar();
  if(navigator.vibrate) try{navigator.vibrate(8)}catch(e){}
}
function openSidebar(){
  document.getElementById('sidebar').classList.add('mobile-open');
  document.getElementById('sidebarOverlay').classList.add('show');
  document.body.style.overflow='hidden';
  document.documentElement.style.overflow='hidden';
}
function closeSidebar(){
  document.getElementById('sidebar').classList.remove('mobile-open');
  document.getElementById('sidebarOverlay').classList.remove('show');
  document.body.style.overflow='';
  document.documentElement.style.overflow='';
}
document.addEventListener('keydown', e=>{ if(e.key==='Escape') closeSidebar(); });
// Animasi keluar saat pindah menu (sidebar / bottom-nav / topbar)
(function(){
  if(window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  const content=document.querySelector('.content');
  if(!content) return;
  document.querySelectorAll('.sidebar .menu a:not(.collapse-toggle), .bottom-nav a, .topbar a').forEach(function(a){
    a.addEventListener('click', function(e){
      const href=a.getAttribute('href')||'';
      if(!href || href.startsWith('#') || a.target==='_blank' || e.ctrlKey || e.metaKey) return;
      if(a.dataset.bsToggle) return;
      e.preventDefault();
      content.classList.add('page-leave');
      let done=false;
      const go=function(){ if(done) return; done=true; window.location.href=a.href; };
      setTimeout(go, 140);
      setTimeout(go, 800);
    }, {capture:false});
  });
})();
// Tutup saat klik link di sidebar (mobile) — kecuali toggle collapse
document.querySelectorAll('.sidebar .menu a:not(.collapse-toggle)').forEach(a=>{
  a.addEventListener('click', ()=>{ if(window.innerWidth<=991) setTimeout(closeSidebar, 180); });
});
// Swipe to close
let touchStartX=0;
const sbEl=document.getElementById('sidebar');
sbEl.addEventListener('touchstart', e=>{ touchStartX=e.touches[0].clientX; }, {passive:true});
sbEl.addEventListener('touchmove', e=>{
  if(!sbEl.classList.contains('mobile-open')) return;
  const dx=e.touches[0].clientX - touchStartX;
  if(dx < -60) closeSidebar();
}, {passive:true});
// Chevron rotasi via event Bootstrap collapse (anti-glitch)
function bindChevron(menuId, chevId){
  const menu=document.getElementById(menuId), ch=document.getElementById(chevId);
  if(!menu||!ch) return;
  const sync=function(){ const open=menu.classList.contains('show'); ch.style.transform=open?'rotate(0deg)':'rotate(-90deg)'; };
  sync();
  menu.addEventListener('shown.bs.collapse', function(){ ch.style.transform='rotate(0deg)'; });
  menu.addEventListener('hidden.bs.collapse', function(){ ch.style.transform='rotate(-90deg)'; });
}
bindChevron('permohonanMenu','permohonanChevron');
bindChevron('absensiMenu','absensiChevron');
// ── RIPPLE untuk btn & sidebar ──
document.querySelectorAll('.btn-green,.btn-yellow,.sidebar .menu a,.topbar .btn').forEach(btn=>{
  btn.style.position='relative'; btn.style.overflow='hidden';
  btn.addEventListener('click', function(e){
    const rect=this.getBoundingClientRect(); const size=Math.max(rect.width, rect.height)*1.15;
    const x=e.clientX - rect.left - size/2; const y=e.clientY - rect.top - size/2;
    const span=document.createElement('span'); span.className='ripple'; span.style.width=span.style.height=size+'px'; span.style.left=x+'px'; span.style.top=y+'px';
    this.appendChild(span); setTimeout(()=> span.remove(), 550);
  });
});
// ── MODE GELAP / TERANG / OTOMATIS (dropdown pilihan) ──
(function(){
  const btn=document.getElementById('themeToggle'), icon=document.getElementById('themeIcon');
  if(!btn||!icon) return;
  const META={light:{icon:'bi bi-sun-fill',title:'Terang — klik untuk pilihan',label:'Terang'},dark:{icon:'bi bi-moon-stars-fill',title:'Gelap — klik untuk pilihan',label:'Gelap'},auto:{icon:'bi bi-circle-half',title:'Otomatis — klik untuk pilihan',label:'Otomatis'}};
  function effective(m){ return m==='auto' ? (window.matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light') : m; }
  function current(){ try{ return localStorage.getItem('tmtb-theme')||'light'; }catch(e){ return 'light'; } }
  function paint(m, animate){
    document.documentElement.setAttribute('data-theme', effective(m));
    icon.className=META[m].icon; icon.style.fontSize='17px';
    btn.title=META[m].title;
    document.querySelectorAll('.theme-opt').forEach(function(o){ o.classList.toggle('on', o.dataset.mode===m); });
    if(animate){ icon.classList.remove('swap'); void icon.offsetWidth; icon.classList.add('swap'); }
  }
  function choose(m){
    try{ localStorage.setItem('tmtb-theme', m); }catch(e){}
    paint(m, true);
    if(window.showToast) showToast('Tema: '+META[m].label);
    if(navigator.vibrate) try{navigator.vibrate(8)}catch(e){}
  }
  paint(current(), false);
  document.querySelectorAll('.theme-opt').forEach(function(o){
    o.addEventListener('click', function(){ choose(o.dataset.mode); });
  });
  try{
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(){
      if(current()==='auto') paint('auto', true);
    });
  }catch(e){}
})();
// ── TOAST helper ──
function showToast(msg, type='success'){
  const wrap=document.getElementById('toastWrap'); if(!wrap) return;
  const el=document.createElement('div'); el.className='toast-item '+(type==='error'?'error':'success');
  el.innerHTML=(type==='error'?'<i class="bi bi-x-circle-fill"></i>':'<i class="bi bi-check-circle-fill" style="color:#d4af37"></i>')+'<span>'+msg+'</span>';
  wrap.appendChild(el); setTimeout(()=>{ el.style.opacity='0'; el.style.transform='translateX(20px)'; setTimeout(()=> el.remove(), 300); }, 3200);
  if(navigator.vibrate) try{navigator.vibrate(type==='error'?[20,30,20]:10)}catch(_){}
}
window.showToast=showToast;
// auto toast dari session success (jika ada)
document.addEventListener('DOMContentLoaded', ()=>{
  const alertEl=document.querySelector('.alert'); if(alertEl && alertEl.textContent.trim()){ showToast(alertEl.textContent.trim().slice(0,120)); }
});
// ── SIDEBAR LIVE SEARCH ( / atau CmdK ) ──
const sInput=document.getElementById('sidebarSearch');
if(sInput){
  sInput.addEventListener('input', ()=>{
    const q=sInput.value.toLowerCase().trim();
    document.querySelectorAll('.sidebar .menu a').forEach(a=>{
      const txt=a.textContent.toLowerCase();
      a.classList.toggle('hidden-search', q && !txt.includes(q));
    });
    if(q) showToast('Filter: "'+q+'"','success');
  });
  document.addEventListener('keydown', e=>{
    if((e.key==='/' && !e.ctrlKey && document.activeElement.tagName!=='INPUT' && document.activeElement.tagName!=='TEXTAREA') || (e.key==='k' && (e.ctrlKey||e.metaKey))){
      e.preventDefault(); sInput.focus(); if(window.innerWidth<=991) openSidebar();
    }
  });
}
// ── LIVE TABLE SEARCH (permohonan) ──
const liveSearch=document.querySelector('input[name="search"]');
if(liveSearch){
  let t;
  liveSearch.addEventListener('input', ()=>{
    clearTimeout(t); t=setTimeout(()=>{
      const q=liveSearch.value.toLowerCase();
      document.querySelectorAll('.table tbody tr, .d-md-none .rounded-3').forEach(row=>{
        if(!q) row.style.display=''; else row.style.display=row.textContent.toLowerCase().includes(q)?'':'none';
      });
      if(q) showToast('Cari: '+q);
    }, 280);
  });
}
// ── WIZARD AUTO-SAVE & LIVE VALIDATION ──
const wizardForm=document.querySelector('.card-form form');
if(wizardForm){
  const stepMatch=location.pathname.match(/step-(\d)/); const stepKey=stepMatch? 'wizard_step_'+stepMatch[1] : 'wizard_form';
  // restore
  try{
    const saved=JSON.parse(localStorage.getItem(stepKey)||'{}');
    if(Object.keys(saved).length){
      Object.entries(saved).forEach(([k,v])=>{ const el=wizardForm.querySelector('[name="'+k+'"]'); if(el && !el.value) el.value=v; });
      const hint=document.createElement('div'); hint.className='auto-save-hint mt-2'; hint.innerHTML='<i class="bi bi-cloud-arrow-down" style="color:var(--green)"></i> Data tersimpan dipulihkan — <a href="#" onclick="localStorage.removeItem(\''+stepKey+'\');this.parentElement.remove();return false" style="color:var(--gold2);font-weight:700">Hapus</a>';
      wizardForm.querySelector('.p-4')?.prepend(hint);
      showToast('Data sebelumnya dipulihkan');
    }
  }catch(_){}
  // save on input
  let saveT;
  wizardForm.addEventListener('input', ()=>{
    clearTimeout(saveT); saveT=setTimeout(()=>{
      const data={}; new FormData(wizardForm).forEach((v,k)=>{ if(k!=='_token' && k!=='_method') data[k]=v; });
      localStorage.setItem(stepKey, JSON.stringify(data));
      const h=wizardForm.querySelector('.auto-save-hint'); if(h) h.innerHTML='<i class="bi bi-cloud-check" style="color:#22c55e"></i> Tersimpan otomatis '+new Date().toLocaleTimeString('id-ID');
    }, 500);
  });
  // clear on submit
  wizardForm.addEventListener('submit', ()=> localStorage.removeItem(stepKey));
  // live validation
  wizardForm.querySelectorAll('.form-control, .form-select').forEach(el=>{
    el.addEventListener('blur', ()=>{
      if(el.hasAttribute('required') || el.classList.contains('required')){
        if(!el.value.trim()){ el.classList.add('shake'); setTimeout(()=> el.classList.remove('shake'), 350); el.style.borderColor='#dc3545'; showToast('Isi dulu: '+ (el.previousElementSibling?.textContent||el.name), 'error'); }
        else { el.style.borderColor='#d4af37'; }
      }
    });
    el.addEventListener('input', ()=>{ if(el.value.trim()) el.style.borderColor='#d4af37'; });
  });
  // progress hint
  const totalFields=wizardForm.querySelectorAll('.form-control, .form-select').length;
  const updateProgress=()=>{
    const filled=[...wizardForm.querySelectorAll('.form-control, .form-select')].filter(e=> e.value.trim()).length;
    const pct=Math.round(filled/totalFields*100);
    let bar=document.getElementById('wizardProgress');
    if(!bar){ bar=document.createElement('div'); bar.id='wizardProgress'; bar.style.cssText='height:3px;background:linear-gradient(90deg,var(--gold),var(--green));border-radius:10px;transition:width .4s;margin-bottom:12px'; wizardForm.querySelector('.p-4')?.prepend(bar); }
    bar.style.width=pct+'%';
  };
  wizardForm.addEventListener('input', updateProgress); updateProgress();
}
</script>
@stack('scripts')
</body>
</html>

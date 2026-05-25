<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Jurusan - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    <style>
        :root { --dark-oak:#3D2B1F; --muted-sage:#8E9680; --dusty-mauve:#A37C76; --warm-amber:#D9B382; --vintage-cream:#E6D8C1; --sidebar-width:260px; }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; }
        body { background:#F7F4F0; color:var(--dark-oak); overflow-x:hidden; display:flex; height:100vh; }
        .blob-1 { position:fixed; top:-10%; right:10%; width:500px; height:500px; background:rgba(142,150,128,.15); border-radius:50%; filter:blur(80px); z-index:0; pointer-events:none; }
        .blob-2 { position:fixed; bottom:-10%; left:20%; width:400px; height:400px; background:rgba(217,179,130,.15); border-radius:50%; filter:blur(60px); z-index:0; pointer-events:none; }
        .sidebar { width:var(--sidebar-width); background:rgba(230,216,193,.85); backdrop-filter:blur(20px); border-right:1px solid rgba(255,255,255,.6); height:100vh; padding:32px 24px; display:flex; flex-direction:column; position:fixed; left:0; top:0; z-index:50; }
        .logo-container { display:flex; align-items:center; gap:12px; text-decoration:none; margin-bottom:60px; }
        .logo-text { font-size:26px; font-weight:800; color:var(--dark-oak); letter-spacing:-.5px; }
        .sidebar-menu { flex:1; display:flex; flex-direction:column; gap:8px; }
        .sidebar-item { display:flex; align-items:center; gap:14px; padding:14px 18px; border-radius:16px; text-decoration:none; color:rgba(61,43,31,.7); font-weight:600; font-size:15px; transition:all .3s ease; }
        .sidebar-item:hover, .sidebar-item.active { background:rgba(255,255,255,.5); color:var(--dark-oak); box-shadow:0 4px 12px rgba(61,43,31,.03); }
        .sidebar-item-icon { font-size:20px; }
        .logout-container { margin-top:auto; }
        .btn-logout { width:100%; padding:14px; border-radius:99px; font-size:15px; font-weight:600; color:var(--dusty-mauve); background:rgba(163,124,118,0.08); border:none; cursor:pointer; transition:all .3s ease; display:flex; align-items:center; justify-content:center; gap:10px; }
        .btn-logout:hover { background:rgba(163,124,118,0.15); color:#8a655f; }
        .main-wrapper { flex:1; margin-left:var(--sidebar-width); height:100vh; overflow-y:auto; position:relative; z-index:5; }
        .topbar { padding:24px 48px; display:flex; justify-content:flex-end; align-items:center; position:sticky; top:0; z-index:40; }
        .user-profile { display:flex; align-items:center; gap:16px; background:rgba(255,255,255,.6); backdrop-filter:blur(12px); padding:8px 10px 8px 24px; border-radius:99px; border:1px solid rgba(255,255,255,.8); box-shadow:0 4px 14px rgba(61,43,31,.04); cursor:pointer; transition:transform .3s ease; text-decoration:none; }
        .user-profile:hover { transform:translateY(-2px); }
        .user-greeting { font-size:15px; font-weight:500; color:rgba(61,43,31,.7); }
        .user-greeting span { font-weight:800; color:var(--dark-oak); }
        .user-avatar { width:42px; height:42px; border-radius:50%; background:var(--warm-amber); display:flex; align-items:center; justify-content:center; font-weight:800; color:#fff; font-size:18px; overflow:hidden; }
        .content-body { padding:0 48px 80px; max-width:1200px; margin:0 auto; }
        .breadcrumb { display:flex; align-items:center; gap:8px; margin-bottom:28px; font-size:14px; font-weight:600; color:rgba(61,43,31,.5); }
        .breadcrumb a { color:var(--muted-sage); text-decoration:none; }
        .breadcrumb a:hover { color:var(--dark-oak); }
        .jurusan-hero { background:linear-gradient(135deg,#4A6741 0%,#6B8F5E 100%); border-radius:32px; padding:44px 52px; display:flex; align-items:center; justify-content:space-between; margin-bottom:40px; box-shadow:0 16px 40px rgba(74,103,65,.25); position:relative; overflow:hidden; }
        .jurusan-hero::before { content:''; position:absolute; right:-60px; top:-60px; width:320px; height:320px; background:radial-gradient(circle,rgba(255,255,255,.15) 0%,transparent 70%); border-radius:50%; }
        .hero-left h1 { font-size:32px; font-weight:800; color:#fff; line-height:1.15; letter-spacing:-1px; margin-bottom:12px; }
        .hero-left p { font-size:15px; color:rgba(255,255,255,.75); max-width:440px; line-height:1.6; }
        .hero-icon { font-size:100px; filter:drop-shadow(0 10px 24px rgba(0,0,0,.2)); animation:float 6s ease-in-out infinite; }
        @keyframes float { 0%,100%{transform:translateY(0) rotate(0deg);}50%{transform:translateY(-14px) rotate(4deg);} }
        .info-row { display:flex; gap:16px; margin-bottom:40px; flex-wrap:wrap; }
        .info-card { flex:1; min-width:150px; background:rgba(255,255,255,.5); backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,.8); border-radius:24px; padding:24px; text-align:center; box-shadow:0 8px 24px rgba(61,43,31,.04); }
        .info-card-num { font-size:24px; font-weight:800; color:var(--dark-oak); }
        .info-card-lbl { font-size:12px; font-weight:700; color:rgba(61,43,31,.5); text-transform:uppercase; letter-spacing:.5px; margin-top:4px; }
        .section-title { font-size:22px; font-weight:800; color:var(--dark-oak); margin-bottom:20px; }
        .glass-card { background:rgba(255,255,255,.45); backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,.8); border-radius:32px; padding:36px; box-shadow:0 10px 30px rgba(61,43,31,.04); margin-bottom:40px; }
        .glass-card p { font-size:15px; line-height:1.8; color:rgba(61,43,31,.7); }
        .prodi-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:20px; margin-bottom:48px; }
        .prodi-card { background:rgba(255,255,255,.55); backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,.85); border-radius:24px; padding:24px; box-shadow:0 8px 24px rgba(61,43,31,.04); transition:all .3s ease; }
        .prodi-card:hover { transform:translateY(-4px); box-shadow:0 16px 40px rgba(61,43,31,.08); background:rgba(255,255,255,.8); }
        .prodi-icon { width:52px; height:52px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:26px; flex-shrink:0; margin-bottom:14px; }
        .prodi-name { font-size:16px; font-weight:800; color:var(--dark-oak); margin-bottom:4px; }
        .prodi-desc { font-size:12px; color:rgba(61,43,31,.55); font-weight:600; margin-bottom:10px; line-height:1.4; }
        .prodi-utbk { display:inline-flex; align-items:center; gap:6px; background:rgba(217,179,130,.2); color:#9a7240; font-size:12px; font-weight:700; padding:5px 12px; border-radius:99px; }
        .prospek-list { display:flex; flex-wrap:wrap; gap:10px; margin-bottom:48px; }
        .prospek-pill { padding:10px 22px; border-radius:99px; font-size:14px; font-weight:700; background:rgba(61,43,31,.06); color:var(--dark-oak); transition:all .2s; }
        .prospek-pill:hover { background:var(--dark-oak); color:#fff; }
        .bg-sage  { background:rgba(142,150,128,.2); color:#6A725D; }
        .bg-mauve { background:rgba(163,124,118,.2); color:#8a655f; }
        .bg-amber { background:rgba(217,179,130,.2); color:#B38F60; }
        .bg-blue  { background:rgba(112,161,255,.2); color:#5B8BEB; }
        .bg-green { background:rgba(74,103,65,.2); color:#4A6741; }
        .bg-pink  { background:rgba(200,130,150,.2); color:#c08296; }
        .no-result { text-align:center; padding:80px 20px; color:rgba(61,43,31,.4); }
        .no-result .emoji { font-size:64px; margin-bottom:16px; }
        .no-result p { font-size:16px; font-weight:600; }
        @media(max-width:992px){ .sidebar{transform:translateX(-100%);} .main-wrapper{margin-left:0;} .jurusan-hero{flex-direction:column;text-align:center;gap:24px;padding:32px;} .content-body{padding:0 24px 60px;} .topbar{padding:24px;} }
    </style>
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <aside class="sidebar">
        <a href="/" class="logo-container">
            <svg width="36" height="36" viewBox="0 0 24 24"><path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z" fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/><circle cx="12" cy="13" r="4" fill="var(--vintage-cream)"/></svg>
            <div class="logo-text">Pintar.id</div>
        </a>
        <div class="sidebar-menu">
            <a href="{{ route('siswa.home') }}" class="sidebar-item {{ request()->routeIs('siswa.home') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                </span> Dashboard
            </a>
            @if(auth()->user() && !in_array((int)auth()->user()->id_jenjang, [1, 2]))
            <a href="{{ route('siswa.ptn') }}" class="sidebar-item {{ request()->routeIs('siswa.ptn') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
                </span> Info Univ & PTN
            </a>
            <a href="{{ route('siswa.jurusan') }}" class="sidebar-item {{ request()->routeIs('siswa.jurusan') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                </span> Rekomendasi Jurusan
            </a>
            @endif
            <a href="{{ route('siswa.paket-belajar') }}" class="sidebar-item {{ request()->routeIs('siswa.paket-belajar') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                </span> Paket Belajar
            </a>
                        <a href="{{ route('siswa.ujian') }}" class="sidebar-item {{ request()->routeIs('siswa.ujian') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </span> Ujian
            </a>
            <a href="{{ route('siswa.chat') }}" class="sidebar-item {{ request()->routeIs('siswa.chat') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                </span> Chat 
            </a>
            <a href="{{ route('siswa.notifikasi') }}" class="sidebar-item {{ request()->routeIs('siswa.notifikasi') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                </span> Notifikasi
            </a>
        </div>
        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="main-wrapper">
        <header class="topbar">
            <div></div>
            <a href="{{ route('siswa.profile') }}" class="user-profile">
                <div class="user-greeting">Hi, <span>{{ explode(' ', $userName)[0] }}</span></div>
                <div class="user-avatar">
                    @if(isset($photoProfile) && $photoProfile)
                        <img src="{{ asset('uploads/profiles/' . $photoProfile) }}" alt="Profile" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                    @else
                        {{ strtoupper(substr($userName, 0, 1)) }}
                    @endif
                </div>
            </a>
        </header>

        <div class="content-body">
            <div class="breadcrumb">
                <a href="{{ route('siswa.ptn') }}">Info PTN</a>
                <span style="color:rgba(61,43,31,.3);">&#x203A;</span>
                <span id="breadcrumb-title">Info Jurusan</span>
            </div>

            <div class="jurusan-hero" id="jurusan-hero">
                <div class="hero-left">
                    <h1 id="hero-title">Info Jurusan</h1>
                    <p id="hero-desc">Temukan informasi lengkap tentang jurusan impianmu.</p>
                </div>
                <div class="hero-icon" id="hero-icon">&#x1F393;</div>
            </div>

            <div class="info-row" id="info-row"></div>

            <h2 class="section-title">Tentang Jurusan</h2>
            <div class="glass-card"><p id="deskripsi-text">Memuat informasi...</p></div>

            <h2 class="section-title">Program Studi &amp; Target Skor UTBK</h2>
            <div class="prodi-grid" id="prodi-grid"></div>

            <h2 class="section-title">Prospek Karir</h2>
            <div class="prospek-list" id="prospek-list"></div>
        </div>
    </main>

<script>
const jurusanData = @json($fakultasData);

const queryNama = {!! json_encode($nama) !!};
const data = jurusanData[queryNama];

if (data) {
    document.getElementById('breadcrumb-title').textContent = queryNama;
    document.getElementById('hero-title').textContent = queryNama;
    document.getElementById('hero-desc').textContent = data.desc.substring(0, 120) + '...';
    document.getElementById('hero-icon').textContent = data.icon;
    document.getElementById('deskripsi-text').textContent = data.desc;

    document.getElementById('info-row').innerHTML =
        `<div class="info-card"><div class="info-card-num">${data.gelar}</div><div class="info-card-lbl">Gelar</div></div>` +
        `<div class="info-card"><div class="info-card-num">${data.durasi}</div><div class="info-card-lbl">Masa Studi</div></div>` +
        `<div class="info-card"><div class="info-card-num">${data.akreditasi}</div><div class="info-card-lbl">Akreditasi</div></div>` +
        `<div class="info-card"><div class="info-card-num">${data.prodi.length} Prodi</div><div class="info-card-lbl">Program Studi</div></div>`;

    document.getElementById('prodi-grid').innerHTML = data.prodi.map(p => `
        <a href="/siswa/jurusan/detail?nama=${encodeURIComponent(p.n)}" class="prodi-card" style="text-decoration:none; display:block;">
            <div class="prodi-icon ${p.c}">${p.i}</div>
            <div class="prodi-name">${p.n}</div>
            <div class="prodi-desc">${p.d}</div>
            <div class="prodi-utbk">&#x1F4CA; Target UTBK: <strong>${p.utbk}</strong></div>
        </a>`).join('');

    document.getElementById('prospek-list').innerHTML = data.prospek.map(k =>
        `<span class="prospek-pill">${k}</span>`).join('');
} else {
    document.querySelector('.content-body').innerHTML =
        `<div class="breadcrumb"><a href="{{ route('siswa.ptn') }}">Info PTN</a><span style="color:rgba(61,43,31,.3);">&#x203A;</span><span>Jurusan</span></div>` +
        `<div class="no-result"><div class="emoji">&#x1F50D;</div><p>Jurusan "<strong>${queryNama}</strong>" belum tersedia.<br><a href="{{ route('siswa.ptn') }}" style="color:var(--muted-sage);text-decoration:none;font-weight:700;">&#x2190; Kembali ke Info PTN</a></p></div>`;
}
</script>
</body>
</html>

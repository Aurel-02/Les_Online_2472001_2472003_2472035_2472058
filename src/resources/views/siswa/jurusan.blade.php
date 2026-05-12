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
        .btn-logout { width:100%; padding:14px; border-radius:16px; font-size:15px; font-weight:600; color:var(--dusty-mauve); background:rgba(163,124,118,.1); border:none; cursor:pointer; transition:all .3s ease; display:flex; align-items:center; justify-content:center; gap:10px; }
        .btn-logout:hover { background:rgba(163,124,118,.2); }
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
            <a href="{{ route('siswa.home') }}" class="sidebar-item">
                <span class="sidebar-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></span>
                Dashboard
            </a>
            <a href="{{ route('siswa.ptn') }}" class="sidebar-item">
                <span class="sidebar-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg></span>
                Info PTN
            </a>
            <a href="#" class="sidebar-item active">
                <span class="sidebar-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg></span>
                Info Jurusan
            </a>
            <a href="#" class="sidebar-item">
                <span class="sidebar-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg></span>
                Paket Belajar
            </a>
            <a href="#" class="sidebar-item">
                <span class="sidebar-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg></span>
                Chat
            </span>
        </div>
        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout"><span>&#x1F6AA;</span> Keluar Akun</button>
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
const jurusanData = {
    "Kedokteran": { icon:"\u2695\uFE0F", gelar:"S.Ked / dr.", durasi:"5.5 - 6 Tahun", akreditasi:"Unggul",
        desc:"Jurusan Kedokteran mempelajari ilmu tentang kesehatan manusia, diagnosis penyakit, dan penanganan medis. Mahasiswa menjalani pendidikan preklinik dan klinik intensif.",
        prodi:[{n:"Pendidikan Dokter",d:"Menjadi dokter umum profesional",utbk:"780-820",i:"\uD83E\uDEFA",c:"bg-mauve"},{n:"Kedokteran Gigi",d:"Spesialisasi kesehatan gigi dan mulut",utbk:"720-760",i:"\uD83E\uDDB7",c:"bg-blue"},{n:"Ilmu Keperawatan",d:"Tenaga perawat profesional",utbk:"640-680",i:"\uD83D\uDC89",c:"bg-sage"},{n:"Ilmu Gizi",d:"Ahli nutrisi dan dietetika",utbk:"620-660",i:"\uD83C\uDF4E",c:"bg-green"}],
        prospek:["Dokter Umum","Dokter Spesialis","Peneliti Medis","Dosen Kedokteran","Konsultan Kesehatan","Tenaga Medis RS"] },
    "Teknik": { icon:"\u2699\uFE0F", gelar:"S.T.", durasi:"4 Tahun", akreditasi:"Unggul",
        desc:"Fakultas Teknik mempelajari penerapan ilmu sains dan matematika untuk merancang, membangun, dan mengoptimalkan sistem, struktur, dan proses industri.",
        prodi:[{n:"Teknik Informatika",d:"Pengembangan software, AI, dan data",utbk:"720-790",i:"\uD83D\uDCBB",c:"bg-blue"},{n:"Teknik Sipil",d:"Konstruksi dan infrastruktur",utbk:"640-710",i:"\uD83C\uDFD7\uFE0F",c:"bg-amber"},{n:"Teknik Mesin",d:"Desain mesin dan manufaktur",utbk:"640-700",i:"\u2699\uFE0F",c:"bg-sage"},{n:"Teknik Elektro",d:"Sistem kelistrikan dan elektronika",utbk:"650-720",i:"\u26A1",c:"bg-mauve"},{n:"Teknik Kimia",d:"Proses kimia industri",utbk:"640-700",i:"\uD83E\uDDEA",c:"bg-green"}],
        prospek:["Software Engineer","Data Scientist","Insinyur Sipil","Insinyur Mesin","Project Manager","Konsultan IT"] },
    "Hukum": { icon:"\u2696\uFE0F", gelar:"S.H.", durasi:"4 Tahun", akreditasi:"Unggul",
        desc:"Jurusan Hukum mempelajari sistem hukum, peraturan perundang-undangan, dan keadilan. Mencakup hukum pidana, perdata, tata negara, dan hukum internasional.",
        prodi:[{n:"Ilmu Hukum",d:"Hukum pidana, perdata, dan tata negara",utbk:"620-720",i:"\u2696\uFE0F",c:"bg-amber"},{n:"Hukum Bisnis",d:"Regulasi dan kontrak bisnis",utbk:"630-700",i:"\uD83D\uDCBC",c:"bg-blue"},{n:"Hukum Internasional",d:"Hukum antar negara dan diplomasi",utbk:"640-700",i:"\uD83C\uDF0D",c:"bg-sage"}],
        prospek:["Advokat","Jaksa","Hakim","Notaris","Legal Counsel","Diplomat"] },
    "Ekonomi & Bisnis": { icon:"\uD83D\uDCB0", gelar:"S.E.", durasi:"4 Tahun", akreditasi:"Unggul",
        desc:"Fakultas Ekonomi dan Bisnis mempelajari teori ekonomi, manajemen bisnis, akuntansi, dan keuangan. Mempersiapkan mahasiswa untuk berkarir di dunia bisnis global.",
        prodi:[{n:"Manajemen",d:"Pengelolaan organisasi dan strategi bisnis",utbk:"640-730",i:"\uD83D\uDCCA",c:"bg-amber"},{n:"Akuntansi",d:"Pencatatan dan audit keuangan",utbk:"640-720",i:"\uD83D\uDCD2",c:"bg-sage"},{n:"Ilmu Ekonomi",d:"Analisis ekonomi makro dan mikro",utbk:"630-710",i:"\uD83D\uDCB9",c:"bg-blue"},{n:"Bisnis Digital",d:"E-commerce dan manajemen startup",utbk:"620-680",i:"\uD83D\uDCF1",c:"bg-mauve"}],
        prospek:["Akuntan","Financial Analyst","Manajer","Entrepreneur","Konsultan Bisnis","Banker"] },
    "MIPA": { icon:"\uD83D\uDD2C", gelar:"S.Si.", durasi:"4 Tahun", akreditasi:"Unggul",
        desc:"Fakultas MIPA mempelajari ilmu dasar: Matematika, Fisika, Kimia, dan Biologi. Menjadi fondasi perkembangan teknologi dan riset ilmiah masa depan.",
        prodi:[{n:"Matematika",d:"Aljabar, analisis, dan matematika terapan",utbk:"640-720",i:"\uD83D\uDCD0",c:"bg-blue"},{n:"Fisika",d:"Hukum alam dan fenomena fisik",utbk:"640-710",i:"\uD83C\uDF0C",c:"bg-mauve"},{n:"Kimia",d:"Reaksi kimia dan material",utbk:"630-700",i:"\uD83E\uDDEA",c:"bg-amber"},{n:"Biologi",d:"Makhluk hidup dan ekosistem",utbk:"620-690",i:"\uD83E\uDDEC",c:"bg-green"}],
        prospek:["Peneliti","Data Analyst","Dosen","Ahli Forensik","Quality Control","Lab Analyst"] },
    "FISIP": { icon:"\uD83C\uDFDB\uFE0F", gelar:"S.Sos. / S.IP.", durasi:"4 Tahun", akreditasi:"Unggul",
        desc:"Fakultas Ilmu Sosial dan Ilmu Politik mempelajari dinamika masyarakat, kebijakan publik, komunikasi, dan hubungan internasional.",
        prodi:[{n:"Ilmu Komunikasi",d:"Media, jurnalistik, dan PR",utbk:"600-680",i:"\uD83D\uDCE2",c:"bg-amber"},{n:"Hubungan Internasional",d:"Diplomasi dan politik global",utbk:"620-700",i:"\uD83C\uDF0D",c:"bg-blue"},{n:"Ilmu Politik",d:"Sistem politik dan pemerintahan",utbk:"600-670",i:"\uD83C\uDFDB\uFE0F",c:"bg-mauve"},{n:"Sosiologi",d:"Struktur dan dinamika masyarakat",utbk:"580-650",i:"\uD83D\uDC65",c:"bg-sage"}],
        prospek:["Jurnalis","Diplomat","PNS","Public Relations","Analis Politik","Peneliti Sosial"] },
    "Ilmu Komputer": { icon:"\uD83D\uDCBB", gelar:"S.Kom.", durasi:"4 Tahun", akreditasi:"Unggul",
        desc:"Jurusan Ilmu Komputer fokus pada teori komputasi, pemrograman, kecerdasan buatan, dan sistem informasi. Salah satu jurusan paling diminati di era digital.",
        prodi:[{n:"Ilmu Komputer",d:"Algoritma, AI, dan machine learning",utbk:"680-760",i:"\uD83E\uDD16",c:"bg-blue"},{n:"Sistem Informasi",d:"Manajemen data dan sistem enterprise",utbk:"640-720",i:"\uD83D\uDDA5\uFE0F",c:"bg-amber"},{n:"Teknik Komputer",d:"Hardware dan embedded systems",utbk:"650-720",i:"\uD83D\uDCDF",c:"bg-sage"}],
        prospek:["Software Engineer","Data Scientist","UI/UX Designer","DevOps Engineer","AI Researcher","CTO Startup"] },
    "Pertanian": { icon:"\uD83C\uDF3E", gelar:"S.P.", durasi:"4 Tahun", akreditasi:"Unggul",
        desc:"Fakultas Pertanian mempelajari budidaya tanaman, ilmu tanah, agribisnis, dan teknologi pertanian modern untuk ketahanan pangan nasional.",
        prodi:[{n:"Agroteknologi",d:"Budidaya dan teknologi tanaman",utbk:"560-630",i:"\uD83C\uDF31",c:"bg-green"},{n:"Agribisnis",d:"Bisnis dan manajemen pertanian",utbk:"560-630",i:"\uD83D\uDCC8",c:"bg-amber"},{n:"Ilmu Tanah",d:"Kesuburan dan konservasi tanah",utbk:"540-610",i:"\uD83C\uDF0D",c:"bg-sage"}],
        prospek:["Agronomis","Konsultan Pertanian","Peneliti","Manajer Perkebunan","Wirausaha Agritech"] },
    "Farmasi": { icon:"\uD83D\uDC8A", gelar:"S.Farm.", durasi:"4 Tahun", akreditasi:"Unggul",
        desc:"Jurusan Farmasi mempelajari ilmu obat-obatan, formulasi sediaan farmasi, farmakologi, dan pelayanan kefarmasian kepada masyarakat.",
        prodi:[{n:"Farmasi",d:"Formulasi obat dan farmakologi",utbk:"660-740",i:"\uD83D\uDC8A",c:"bg-pink"},{n:"Farmasi Klinis",d:"Pelayanan farmasi di rumah sakit",utbk:"650-720",i:"\uD83C\uDFE5",c:"bg-mauve"}],
        prospek:["Apoteker","Peneliti Farmasi","Quality Assurance","Medical Representative","Industri Kosmetik"] },
    "Ekonomika & Bisnis": { icon:"\uD83D\uDCB0", gelar:"S.E.", durasi:"4 Tahun", akreditasi:"Unggul",
        desc:"Mempelajari teori ekonomi, manajemen bisnis, dan akuntansi dengan pendekatan riset yang kuat.",
        prodi:[{n:"Manajemen",d:"Pengelolaan organisasi dan strategi",utbk:"640-730",i:"\uD83D\uDCCA",c:"bg-amber"},{n:"Akuntansi",d:"Pencatatan dan audit keuangan",utbk:"640-720",i:"\uD83D\uDCD2",c:"bg-sage"},{n:"Ilmu Ekonomi",d:"Analisis ekonomi makro dan mikro",utbk:"630-710",i:"\uD83D\uDCB9",c:"bg-blue"}],
        prospek:["Akuntan","Financial Analyst","Manajer","Konsultan Bisnis"] },
    "Perikanan & Ilmu Kelautan": { icon:"\uD83D\uDC1F", gelar:"S.Pi.", durasi:"4 Tahun", akreditasi:"A",
        desc:"Mempelajari sumber daya laut, budidaya perikanan, dan teknologi kelautan untuk mendukung sektor maritim Indonesia.",
        prodi:[{n:"Ilmu Kelautan",d:"Ekosistem laut dan oseanografi",utbk:"560-620",i:"\uD83C\uDF0A",c:"bg-blue"},{n:"Budidaya Perairan",d:"Akuakultur dan perikanan darat",utbk:"540-600",i:"\uD83D\uDC20",c:"bg-green"},{n:"Pemanfaatan SD Perikanan",d:"Teknologi penangkapan ikan",utbk:"530-590",i:"\uD83E\uDEAD",c:"bg-amber"}],
        prospek:["Ahli Kelautan","Peneliti Perikanan","Budidaya Tambak","Konsultan Maritim"] },
    "Ilmu Kelautan & Perikanan": { icon:"\uD83C\uDF0A", gelar:"S.Pi.", durasi:"4 Tahun", akreditasi:"A",
        desc:"Mempelajari ekologi laut, perikanan berkelanjutan, dan teknologi kelautan modern.",
        prodi:[{n:"Ilmu Kelautan",d:"Ekosistem laut dan oseanografi",utbk:"560-620",i:"\uD83C\uDF0A",c:"bg-blue"},{n:"Budidaya Perairan",d:"Akuakultur dan perikanan",utbk:"540-600",i:"\uD83D\uDC20",c:"bg-green"},{n:"Pemanfaatan SD Perikanan",d:"Teknologi penangkapan ikan",utbk:"530-590",i:"\uD83E\uDEAD",c:"bg-amber"}],
        prospek:["Ahli Kelautan","Peneliti Perikanan","Konsultan Maritim"] },
    "Teknologi Kelautan": { icon:"\uD83D\uDEA2", gelar:"S.T.", durasi:"4 Tahun", akreditasi:"Unggul",
        desc:"Mempelajari rekayasa kapal laut, sistem transportasi laut, dan teknologi kelautan. Unggulan ITS yang terkenal di tingkat internasional.",
        prodi:[{n:"Teknik Perkapalan",d:"Desain dan konstruksi kapal",utbk:"630-680",i:"\uD83D\uDEA2",c:"bg-blue"},{n:"Teknik Kelautan",d:"Struktur offshore dan pelabuhan",utbk:"620-670",i:"\uD83C\uDF0A",c:"bg-sage"},{n:"Transportasi Laut",d:"Sistem logistik maritim",utbk:"600-650",i:"\uD83D\uDDFA\uFE0F",c:"bg-amber"}],
        prospek:["Naval Architect","Marine Engineer","Manajer Pelabuhan","Konsultan Maritim"] },
    "Sekolah Teknik Elektro & Informatika": { icon:"\uD83D\uDCBB", gelar:"S.T.", durasi:"4 Tahun", akreditasi:"Unggul",
        desc:"Program teknik paling kompetitif di ITB, menggabungkan ilmu informatika, elektronika, dan sistem informasi kelas dunia.",
        prodi:[{n:"Teknik Informatika",d:"Algoritma, AI, dan software engineering",utbk:"750-790",i:"\uD83D\uDCBB",c:"bg-blue"},{n:"Sistem & Teknologi Informasi",d:"Enterprise systems dan manajemen data",utbk:"720-760",i:"\uD83D\uDDA5\uFE0F",c:"bg-sage"},{n:"Teknik Elektro",d:"Sistem tenaga dan elektronika",utbk:"700-750",i:"\u26A1",c:"bg-amber"}],
        prospek:["Software Engineer","AI Researcher","System Analyst","CTO","IoT Engineer"] },
    "ISIP": { icon:"\uD83C\uDFDB\uFE0F", gelar:"S.Sos.", durasi:"4 Tahun", akreditasi:"A",
        desc:"Ilmu Sosial dan Ilmu Politik yang fokus pada komunikasi, administrasi, dan dinamika masyarakat.",
        prodi:[{n:"Ilmu Komunikasi",d:"Media dan jurnalistik",utbk:"540-600",i:"\uD83D\uDCE2",c:"bg-amber"},{n:"Sosiologi",d:"Dinamika masyarakat",utbk:"520-580",i:"\uD83D\uDC65",c:"bg-sage"},{n:"Administrasi Negara",d:"Kebijakan publik dan pemerintahan",utbk:"530-590",i:"\uD83C\uDFDB\uFE0F",c:"bg-blue"}],
        prospek:["Jurnalis","PNS","Peneliti Sosial","Public Relations"] },
    "Ilmu Komunikasi": { icon:"\uD83D\uDCE2", gelar:"S.I.Kom.", durasi:"4 Tahun", akreditasi:"Unggul",
        desc:"Mempelajari teori dan praktik komunikasi massa, jurnalistik, PR, dan media digital.",
        prodi:[{n:"Ilmu Komunikasi",d:"Komunikasi massa dan media",utbk:"600-680",i:"\uD83D\uDCE2",c:"bg-amber"},{n:"Hubungan Masyarakat",d:"Strategi PR dan branding",utbk:"590-660",i:"\uD83E\uDD1D",c:"bg-blue"},{n:"Jurnalistik",d:"Peliputan dan penulisan berita",utbk:"580-650",i:"\uD83D\uDCF0",c:"bg-sage"}],
        prospek:["Jurnalis","PR Specialist","Content Creator","Brand Manager"] },
    "Ilmu Sosial & Ilmu Politik": { icon:"\uD83C\uDFDB\uFE0F", gelar:"S.Sos. / S.IP.", durasi:"4 Tahun", akreditasi:"Unggul",
        desc:"Mempelajari dinamika sosial, sistem politik, dan kebijakan publik.",
        prodi:[{n:"Ilmu Politik",d:"Sistem politik dan pemerintahan",utbk:"590-660",i:"\uD83C\uDFDB\uFE0F",c:"bg-mauve"},{n:"Sosiologi",d:"Struktur dan dinamika masyarakat",utbk:"570-640",i:"\uD83D\uDC65",c:"bg-sage"},{n:"Kesejahteraan Sosial",d:"Pemberdayaan masyarakat",utbk:"560-630",i:"\uD83E\uDD1D",c:"bg-green"}],
        prospek:["Analis Politik","PNS","Peneliti Sosial","Aktivis LSM"] },
    "Teknologi Pertanian": { icon:"\uD83C\uDF3E", gelar:"S.TP.", durasi:"4 Tahun", akreditasi:"A",
        desc:"Mempelajari teknologi pengolahan pangan, keteknikan pertanian, dan bioteknologi untuk industri pangan.",
        prodi:[{n:"Teknologi Pangan",d:"Pengolahan dan keamanan pangan",utbk:"580-640",i:"\uD83C\uDF55",c:"bg-amber"},{n:"Keteknikan Pertanian",d:"Mesin dan sistem pertanian modern",utbk:"560-620",i:"\uD83D\uDE9C",c:"bg-green"},{n:"Bioteknologi",d:"Rekayasa biologis dan fermentasi",utbk:"580-640",i:"\uD83E\uDDEC",c:"bg-blue"}],
        prospek:["Food Technologist","Quality Control Pangan","Peneliti Bioteknologi","Manajer Produksi"] },
    "Desain Kreatif & Digital": { icon:"\uD83C\uDFA8", gelar:"S.Ds.", durasi:"4 Tahun", akreditasi:"A",
        desc:"Menggabungkan kreativitas dan teknologi digital untuk menghasilkan desainer kelas dunia.",
        prodi:[{n:"Desain Produk",d:"Desain industri dan inovasi produk",utbk:"600-660",i:"\uD83D\uDCF1",c:"bg-amber"},{n:"Desain Interior",d:"Perancangan ruang dan estetika",utbk:"580-640",i:"\uD83C\uDFE0",c:"bg-sage"},{n:"Desain Komunikasi Visual",d:"Branding, ilustrasi, dan tipografi",utbk:"590-650",i:"\uD83C\uDFA8",c:"bg-blue"}],
        prospek:["UI/UX Designer","Product Designer","Creative Director","Brand Consultant"] },
    "Seni Rupa & Desain": { icon:"\uD83C\uDFA8", gelar:"S.Ds.", durasi:"4 Tahun", akreditasi:"Unggul",
        desc:"Program seni dan desain bergengsi di ITB yang menghasilkan seniman dan desainer kelas dunia.",
        prodi:[{n:"Desain Produk",d:"Desain industri dan inovasi",utbk:"630-680",i:"\uD83D\uDCF1",c:"bg-amber"},{n:"Desain Komunikasi Visual",d:"Branding dan ilustrasi",utbk:"620-670",i:"\uD83C\uDFA8",c:"bg-blue"},{n:"Kriya",d:"Seni tradisi dan kontemporer",utbk:"590-640",i:"\uD83E\uDDF5",c:"bg-sage"}],
        prospek:["UI/UX Designer","Creative Director","Brand Consultant","Seniman"] }
};

const queryNama = "{{ $nama }}";
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
        <div class="prodi-card">
            <div class="prodi-icon ${p.c}">${p.i}</div>
            <div class="prodi-name">${p.n}</div>
            <div class="prodi-desc">${p.d}</div>
            <div class="prodi-utbk">&#x1F4CA; Target UTBK: <strong>${p.utbk}</strong></div>
        </div>`).join('');

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

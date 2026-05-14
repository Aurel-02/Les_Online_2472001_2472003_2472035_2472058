<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info PTN - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-oak:      #3D2B1F;
            --muted-sage:    #8E9680;
            --dusty-mauve:   #A37C76;
            --warm-amber:    #D9B382;
            --vintage-cream: #E6D8C1;
            --sidebar-width: 260px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background: #F7F4F0; color: var(--dark-oak); overflow-x: hidden; display: flex; height: 100vh; }

        /* Blobs */
        .blob-1 { position: fixed; top: -10%; right: 10%; width: 500px; height: 500px; background: rgba(142,150,128,.15); border-radius: 50%; filter: blur(80px); z-index: 0; pointer-events: none; }
        .blob-2 { position: fixed; bottom: -10%; left: 20%; width: 400px; height: 400px; background: rgba(217,179,130,.15); border-radius: 50%; filter: blur(60px); z-index: 0; pointer-events: none; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width); background: rgba(230,216,193,.85);
            backdrop-filter: blur(20px); border-right: 1px solid rgba(255,255,255,.6);
            height: 100vh; padding: 32px 24px; display: flex; flex-direction: column;
            position: fixed; left: 0; top: 0; z-index: 50;
        }
        .logo-container { display: flex; align-items: center; gap: 12px; text-decoration: none; margin-bottom: 60px; }
        .logo-text { font-size: 26px; font-weight: 800; color: var(--dark-oak); letter-spacing: -.5px; }
        .sidebar-menu { flex: 1; display: flex; flex-direction: column; gap: 8px; }
        .sidebar-item {
            display: flex; align-items: center; gap: 14px; padding: 14px 18px;
            border-radius: 16px; text-decoration: none; color: rgba(61,43,31,.7);
            font-weight: 600; font-size: 15px; transition: all .3s ease;
        }
        .sidebar-item:hover, .sidebar-item.active {
            background: rgba(255,255,255,.5); color: var(--dark-oak);
            box-shadow: 0 4px 12px rgba(61,43,31,.03);
        }
        .sidebar-item-icon { font-size: 20px; }
        .logout-container { margin-top: auto; }
        .btn-logout {
            width: 100%; padding: 14px; border-radius: 16px; font-size: 15px; font-weight: 600;
            color: var(--dusty-mauve); background: rgba(163,124,118,.1); border: none;
            cursor: pointer; transition: all .3s ease;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .btn-logout:hover { background: rgba(163,124,118,.2); }

        /* Main */
        .main-wrapper { flex: 1; margin-left: var(--sidebar-width); height: 100vh; overflow-y: auto; position: relative; z-index: 5; }
        .topbar { padding: 24px 48px; display: flex; justify-content: flex-end; align-items: center; position: sticky; top: 0; z-index: 40; }
        .user-profile {
            display: flex; align-items: center; gap: 16px; background: rgba(255,255,255,.6);
            backdrop-filter: blur(12px); padding: 8px 10px 8px 24px; border-radius: 99px;
            border: 1px solid rgba(255,255,255,.8); box-shadow: 0 4px 14px rgba(61,43,31,.04);
            cursor: pointer; transition: transform .3s ease; text-decoration: none;
        }
        .user-profile:hover { transform: translateY(-2px); }
        .user-greeting { font-size: 15px; font-weight: 500; color: rgba(61,43,31,.7); }
        .user-greeting span { font-weight: 800; color: var(--dark-oak); }
        .user-avatar {
            width: 42px; height: 42px; border-radius: 50%; background: var(--warm-amber);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: #fff; font-size: 18px; overflow: hidden;
        }
        .content-body { padding: 0 48px 80px; max-width: 1200px; margin: 0 auto; }

        /* Hero */
        .ptn-hero {
            background: linear-gradient(135deg, #3D2B1F 0%, #6B4C3B 100%);
            border-radius: 32px; padding: 44px 52px; display: flex; align-items: center;
            justify-content: space-between; margin-bottom: 40px;
            box-shadow: 0 16px 40px rgba(61,43,31,.25); position: relative; overflow: hidden;
        }
        .ptn-hero::before {
            content: ''; position: absolute; right: -60px; top: -60px; width: 320px; height: 320px;
            background: radial-gradient(circle, rgba(217,179,130,.25) 0%, transparent 70%); border-radius: 50%;
        }
        .hero-left h1 { font-size: 34px; font-weight: 800; color: #fff; line-height: 1.15; letter-spacing: -1px; margin-bottom: 12px; }
        .hero-left p { font-size: 15px; color: rgba(255,255,255,.75); max-width: 440px; line-height: 1.6; }
        .hero-badge { background: rgba(217,179,130,.2); border: 1px solid rgba(217,179,130,.4); color: var(--warm-amber); font-size: 13px; font-weight: 700; padding: 6px 16px; border-radius: 99px; display: inline-block; margin-bottom: 16px; }
        .hero-icon { font-size: 100px; filter: drop-shadow(0 10px 24px rgba(0,0,0,.2)); animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%,100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-14px) rotate(4deg); } }

        /* Filter */
        .filter-bar { display: flex; gap: 14px; margin-bottom: 32px; flex-wrap: wrap; }
        .search-wrap { flex: 1; min-width: 220px; position: relative; }
        .search-wrap input {
            width: 100%; padding: 14px 20px 14px 50px; border-radius: 16px;
            border: 1px solid rgba(255,255,255,.8); background: rgba(255,255,255,.7);
            backdrop-filter: blur(12px); font-family: 'Outfit', sans-serif; font-size: 15px;
            color: var(--dark-oak); outline: none; transition: all .25s;
            box-shadow: 0 4px 16px rgba(61,43,31,.05);
        }
        .search-wrap input:focus { border-color: var(--warm-amber); box-shadow: 0 4px 20px rgba(217,179,130,.2); }
        .search-icon { position: absolute; left: 18px; top: 50%; transform: translateY(-50%); font-size: 18px; color: rgba(61,43,31,.4); }
        .filter-pill {
            padding: 12px 20px; border-radius: 99px; border: 1px solid rgba(61,43,31,.15);
            background: rgba(255,255,255,.6); backdrop-filter: blur(8px);
            font-family: 'Outfit', sans-serif; font-size: 14px; font-weight: 600;
            color: var(--dark-oak); cursor: pointer; transition: all .25s;
        }
        .filter-pill:hover, .filter-pill.active { background: var(--dark-oak); color: #fff; border-color: var(--dark-oak); }

        /* Grid */
        .ptn-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px; }
        .ptn-card {
            background: rgba(255,255,255,.55); backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,.85); border-radius: 28px; padding: 28px;
            box-shadow: 0 8px 28px rgba(61,43,31,.05); transition: all .3s ease;
            cursor: pointer; text-decoration: none; color: inherit; display: block;
        }
        .ptn-card:hover { transform: translateY(-6px); box-shadow: 0 20px 48px rgba(61,43,31,.1); background: rgba(255,255,255,.8); }
        .card-img-wrap { width: 100%; height: 160px; border-radius: 18px; overflow: hidden; margin-bottom: 18px; background: rgba(255,255,255,.4); }
        .card-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s ease; }
        .ptn-card:hover .card-img-wrap img { transform: scale(1.05); }
        .card-top { display: flex; align-items: center; gap: 16px; margin-bottom: 12px; }
        .card-title { font-size: 17px; font-weight: 800; color: var(--dark-oak); line-height: 1.2; }
        .card-abbr { font-size: 13px; font-weight: 600; color: rgba(61,43,31,.5); margin-top: 3px; }
        .card-location { display: flex; align-items: center; gap: 6px; font-size: 13px; color: rgba(61,43,31,.55); font-weight: 600; margin-bottom: 16px; }
        .card-tags { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 18px; }
        .tag { padding: 4px 12px; border-radius: 99px; font-size: 12px; font-weight: 700; }
        .tag-green { background: rgba(142,150,128,.2); color: #5a6354; }
        .tag-amber { background: rgba(217,179,130,.2); color: #9a7240; }
        .tag-blue  { background: rgba(112,161,255,.2); color: #4a74d4; }
        .tag-mauve { background: rgba(163,124,118,.2); color: #8a5f59; }
        .card-stats { display: flex; gap: 16px; }
        .stat-item { text-align: center; }
        .stat-num { font-size: 18px; font-weight: 800; color: var(--dark-oak); }
        .stat-lbl { font-size: 11px; color: rgba(61,43,31,.5); font-weight: 600; text-transform: uppercase; letter-spacing: .4px; }
        .card-divider { width: 1px; background: rgba(61,43,31,.08); }
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .section-title { font-size: 22px; font-weight: 800; color: var(--dark-oak); }
        .result-count { font-size: 14px; color: rgba(61,43,31,.5); font-weight: 600; }
        .no-result { text-align: center; padding: 60px 20px; color: rgba(61,43,31,.4); }
        .no-result .emoji { font-size: 56px; margin-bottom: 12px; }
        .no-result p { font-size: 16px; font-weight: 600; }

        /* Modal */
        .modal-overlay {
            position: fixed; inset: 0; background: rgba(30,20,12,.55); backdrop-filter: blur(8px);
            z-index: 200; display: flex; align-items: center; justify-content: center;
            opacity: 0; pointer-events: none; transition: opacity .3s ease;
        }
        .modal-overlay.open { opacity: 1; pointer-events: all; }
        .modal-box {
            background: #F7F4F0; border-radius: 32px; width: min(860px, 95vw);
            max-height: 90vh; overflow-y: auto; padding: 0;
            box-shadow: 0 32px 80px rgba(30,20,12,.25);
            transform: translateY(30px) scale(.97); transition: transform .35s ease;
        }
        .modal-overlay.open .modal-box { transform: translateY(0) scale(1); }
        .modal-hero { width: 100%; height: 260px; object-fit: cover; border-radius: 32px 32px 0 0; }
        .modal-body { padding: 36px 40px 44px; }
        .modal-badge { display: inline-block; background: rgba(142,150,128,.2); color: #5a6354; font-size: 12px; font-weight: 700; padding: 5px 14px; border-radius: 99px; margin-bottom: 14px; }
        .modal-title { font-size: 28px; font-weight: 800; color: var(--dark-oak); margin-bottom: 4px; letter-spacing: -.5px; }
        .modal-abbr { font-size: 15px; color: rgba(61,43,31,.5); font-weight: 600; margin-bottom: 16px; }
        .modal-desc { font-size: 15px; line-height: 1.7; color: rgba(61,43,31,.75); margin-bottom: 28px; }
        .modal-stats { display: flex; gap: 20px; margin-bottom: 32px; flex-wrap: wrap; }
        .mstat { background: rgba(255,255,255,.7); border: 1px solid rgba(255,255,255,.9); border-radius: 18px; padding: 16px 24px; text-align: center; flex: 1; min-width: 110px; }
        .mstat-num { font-size: 22px; font-weight: 800; color: var(--dark-oak); }
        .mstat-lbl { font-size: 11px; font-weight: 700; color: rgba(61,43,31,.5); text-transform: uppercase; letter-spacing: .5px; margin-top: 4px; }
        .modal-section-title { font-size: 17px; font-weight: 800; color: var(--dark-oak); margin-bottom: 14px; }
        .fakultas-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap: 12px; margin-bottom: 28px; }
        .fakultas-item { background: rgba(255,255,255,.6); border: 1px solid rgba(255,255,255,.9); border-radius: 16px; padding: 14px 18px; transition: all .2s; }
        .fak-name { font-size: 14px; font-weight: 800; color: var(--dark-oak); margin-bottom: 6px; }
        .fak-prodi { font-size: 12px; color: rgba(61,43,31,.55); font-weight: 600; line-height: 1.5; }
        .jalur-list { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 32px; }
        .jalur-pill { padding: 8px 20px; border-radius: 99px; font-size: 13px; font-weight: 700; background: rgba(61,43,31,.08); color: var(--dark-oak); }
        .modal-wrap-rel { position: relative; }
        .modal-close {
            position: absolute; top: 20px; right: 24px; width: 40px; height: 40px;
            border-radius: 50%; border: none; background: rgba(255,255,255,.7);
            backdrop-filter: blur(8px); font-size: 20px; cursor: pointer;
            display: flex; align-items: center; justify-content: center; transition: all .2s;
        }
        .modal-close:hover { background: #fff; transform: scale(1.1); }
        .fak-utbk { font-size: 11px; color: var(--muted-sage); font-weight: 700; margin-top: 6px; }
    </style>
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <a href="/" class="logo-container">
            <svg width="36" height="36" viewBox="0 0 24 24">
                <path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z" fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/>
                <circle cx="12" cy="13" r="4" fill="var(--vintage-cream)"/>
            </svg>
            <div class="logo-text">Pintar.id</div>
        </a>
        <div class="sidebar-menu">
            <a href="{{ route('siswa.home') }}" class="sidebar-item {{ request()->routeIs('siswa.home') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                </span> Dashboard
            </a>
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
            <a href="{{ route('siswa.paket-belajar') }}" class="sidebar-item {{ request()->routeIs('siswa.paket-belajar') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                </span> Paket Belajar
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
                <button type="submit" class="btn-logout"><span>&#x1F6AA;</span> Keluar Akun</button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
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
            <!-- HERO -->
            <div class="ptn-hero">
                <div class="hero-left">
                    <div class="hero-badge">&#x1F3DB;&#xFE0F; Perguruan Tinggi Negeri</div>
                    <h1>Temukan PTN<br>Impianmu!</h1>
                    <p>Jelajahi informasi lengkap lebih dari 10 PTN terbaik Indonesia &mdash; akreditasi, jurusan, daya tampung, dan jalur masuk SNBP / SNBT / Mandiri.</p>
                </div>
                <div class="hero-icon">&#x1F393;</div>
            </div>

            <!-- FILTER -->
            <div class="filter-bar">
                <div class="search-wrap">
                    <span class="search-icon">&#x1F50D;</span>
                    <input type="text" id="search-input" placeholder="Cari nama PTN atau kota..." value="{{ $search }}">
                </div>
                <button class="filter-pill active" data-filter="semua">Semua</button>
                <button class="filter-pill" data-filter="jawa">Pulau Jawa</button>
                <button class="filter-pill" data-filter="luar">Luar Jawa</button>
                <button class="filter-pill" data-filter="teknik">Fokus Teknik</button>
            </div>

            <!-- GRID -->
            <div class="section-header">
                <h2 class="section-title">Daftar Perguruan Tinggi Negeri</h2>
                <span class="result-count" id="result-count">Menampilkan 10 PTN</span>
            </div>
            <div class="ptn-grid" id="ptn-grid"></div>
        </div>
    </main>

    <!-- MODAL -->
    <div class="modal-overlay" id="modal-overlay" onclick="closeModal(event)">
        <div class="modal-box">
            <div class="modal-wrap-rel">
                <button class="modal-close" onclick="document.getElementById('modal-overlay').classList.remove('open');document.body.style.overflow='';">&#x2715;</button>
                <img class="modal-hero" id="modal-img" src="" alt="">
            </div>
            <div class="modal-body">
                <div class="modal-badge" id="modal-badge"></div>
                <div class="modal-title" id="modal-title"></div>
                <div class="modal-abbr" id="modal-abbr"></div>
                <div class="modal-desc" id="modal-desc"></div>
                <div class="modal-stats" id="modal-stats"></div>
                <div class="modal-section-title">Jalur Penerimaan</div>
                <div class="jalur-list" id="modal-jalur"></div>
                <div class="modal-section-title">Fakultas &amp; Program Studi Unggulan</div>
                <div class="fakultas-grid" id="modal-fakultas"></div>
            </div>
        </div>
    </div>


<script>
const ptnData = [
    { name:"Universitas Indonesia", abbr:"UI", kota:"Depok, Jawa Barat", img:"/images/ptn/ui.png", wilayah:"jawa", fokus:"umum", akreditasi:"Unggul", mahasiswa:"48.000+", prodi:"300+", tags:["Unggul","SNBP","SNBT","Mandiri"], jalur:["SNBP","SNBT","SIMAK UI","S1 Kelas Internasional"],
      info:"Universitas tertua dan paling bergengsi di Indonesia dengan berbagai program studi kelas dunia. Berdiri sejak 1849, UI terus mencetak pemimpin bangsa di berbagai bidang.",
      fakultas:[{n:"Kedokteran",p:"Pendidikan Dokter, Ilmu Gizi, Kesehatan Masyarakat",utbk:"780-820"},{n:"Teknik",p:"Teknik Sipil, Teknik Mesin, Teknik Kimia, Teknik Elektro",utbk:"700-750"},{n:"Hukum",p:"Ilmu Hukum",utbk:"680-720"},{n:"Ekonomi & Bisnis",p:"Ekonomi, Manajemen, Akuntansi",utbk:"690-730"},{n:"Ilmu Komputer",p:"Ilmu Komputer, Sistem Informasi",utbk:"720-760"},{n:"FISIP",p:"Ilmu Politik, Sosiologi, Hubungan Internasional",utbk:"660-700"}]},
    { name:"Universitas Gadjah Mada", abbr:"UGM", kota:"Yogyakarta", img:"/images/ptn/ugm.png", wilayah:"jawa", fokus:"umum", akreditasi:"Unggul", mahasiswa:"55.000+", prodi:"280+", tags:["Unggul","SNBP","SNBT","Mandiri"], jalur:["SNBP","SNBT","UM UGM","PBUB"],
      info:"Universitas nasional kerakyatan yang berdiri sejak 1949. UGM terkenal dengan riset pertanian, hukum, dan sosial humaniora yang berdampak nyata bagi masyarakat.",
      fakultas:[{n:"Teknik",p:"Teknik Sipil, Arsitektur, Teknik Elektro, Teknik Kimia",utbk:"700-750"},{n:"Kedokteran",p:"Pendidikan Dokter, Keperawatan, Gizi Kesehatan",utbk:"770-810"},{n:"MIPA",p:"Matematika, Fisika, Kimia, Biologi",utbk:"680-720"},{n:"Pertanian",p:"Agroteknologi, Agribisnis, Ilmu Tanah",utbk:"640-680"},{n:"Hukum",p:"Ilmu Hukum",utbk:"680-720"},{n:"Ekonomika & Bisnis",p:"Ilmu Ekonomi, Manajemen, Akuntansi",utbk:"690-730"}]},
    { name:"Institut Teknologi Bandung", abbr:"ITB", kota:"Bandung, Jawa Barat", img:"/images/ptn/itb.png", wilayah:"jawa", fokus:"teknik", akreditasi:"Unggul", mahasiswa:"22.000+", prodi:"180+", tags:["Unggul","SNBP","SNBT","Mandiri"], jalur:["SNBP","SNBT","USMI ITB"],
      info:"Institut teknologi paling bergengsi di Indonesia. ITB adalah pusat inovasi sains, rekayasa, dan seni yang menghasilkan insinyur dan ilmuwan kelas dunia sejak 1920.",
      fakultas:[{n:"Sekolah Teknik Elektro & Informatika",p:"Teknik Informatika, Sistem & Teknologi Informasi, Teknik Elektro",utbk:"750-790"},{n:"Teknik Sipil & Lingkungan",p:"Teknik Sipil, Teknik Lingkungan, Perencanaan Wilayah",utbk:"710-750"},{n:"Teknik Mesin & Dirgantara",p:"Teknik Mesin, Teknik Penerbangan",utbk:"700-740"},{n:"MIPA",p:"Matematika, Fisika, Kimia, Astronomi",utbk:"700-740"},{n:"Teknologi Industri",p:"Teknik Industri, Teknik Kimia, Teknik Fisika",utbk:"690-730"},{n:"Seni Rupa & Desain",p:"Desain Produk, Desain Komunikasi Visual, Kriya",utbk:"650-690"}]},
    { name:"Institut Teknologi Sepuluh Nopember", abbr:"ITS", kota:"Surabaya, Jawa Timur", img:"/images/ptn/its.png", wilayah:"jawa", fokus:"teknik", akreditasi:"Unggul", mahasiswa:"21.000+", prodi:"120+", tags:["Unggul","SNBP","SNBT","Mandiri"], jalur:["SNBP","SNBT","Mandiri ITS"],
      info:"Kampus teknik unggulan di Jawa Timur. ITS terkenal dengan riset robotika, kapal laut, dan teknologi informasi yang kompetitif di tingkat internasional.",
      fakultas:[{n:"Teknologi Informasi & Komunikasi",p:"Teknik Informatika, Sistem Informasi, Teknik Komputer",utbk:"720-760"},{n:"Teknologi Kelautan",p:"Teknik Perkapalan, Teknik Kelautan, Transportasi Laut",utbk:"640-680"},{n:"Teknik Sipil, Lingkungan & Kebumian",p:"Teknik Sipil, Teknik Lingkungan, Teknik Geomatika",utbk:"670-710"},{n:"Teknik Mesin & Industri",p:"Teknik Mesin, Teknik Industri",utbk:"660-700"},{n:"Desain Kreatif & Digital",p:"Desain Produk, Desain Interior, Desain Komunikasi Visual",utbk:"620-660"}]},
    { name:"Universitas Airlangga", abbr:"UNAIR", kota:"Surabaya, Jawa Timur", img:"/images/ptn/unair.png", wilayah:"jawa", fokus:"umum", akreditasi:"Unggul", mahasiswa:"35.000+", prodi:"220+", tags:["Unggul","SNBP","SNBT","Mandiri"], jalur:["SNBP","SNBT","SMMU UNAIR"],
      info:"Universitas riset terkemuka dengan keunggulan di bidang kedokteran, farmasi, dan ilmu kesehatan. UNAIR masuk dalam jajaran 500 universitas terbaik dunia versi QS.",
      fakultas:[{n:"Kedokteran",p:"Pendidikan Dokter, Fisioterapi",utbk:"750-790"},{n:"Farmasi",p:"Farmasi, Farmasi Klinis & Komunitas",utbk:"700-740"},{n:"Kesehatan Masyarakat",p:"Kesehatan Masyarakat, Gizi, K3",utbk:"660-700"},{n:"Ekonomi & Bisnis",p:"Ilmu Ekonomi, Manajemen, Akuntansi",utbk:"660-700"},{n:"Hukum",p:"Ilmu Hukum",utbk:"640-680"},{n:"Sains & Teknologi",p:"Matematika, Fisika, Kimia, Biologi, Teknik Lingkungan",utbk:"640-680"}]},
    { name:"Universitas Diponegoro", abbr:"UNDIP", kota:"Semarang, Jawa Tengah", img:"/images/ptn/undip.png", wilayah:"jawa", fokus:"umum", akreditasi:"Unggul", mahasiswa:"48.000+", prodi:"260+", tags:["Unggul","SNBP","SNBT","Mandiri"], jalur:["SNBP","SNBT","UM UNDIP"],
      info:"Universitas riset di pesisir utara Jawa dengan program kelautan, hukum, dan teknik yang terkemuka. UNDIP terus berkembang sebagai kampus kelas dunia.",
      fakultas:[{n:"Teknik",p:"Teknik Sipil, Teknik Mesin, Teknik Elektro, Teknik Kimia",utbk:"670-710"},{n:"Hukum",p:"Ilmu Hukum",utbk:"650-690"},{n:"Ekonomika & Bisnis",p:"Manajemen, Akuntansi, Ilmu Ekonomi",utbk:"660-700"},{n:"Perikanan & Ilmu Kelautan",p:"Ilmu Kelautan, Perikanan, Oseanografi",utbk:"600-640"},{n:"Kedokteran",p:"Pendidikan Dokter, Keperawatan",utbk:"720-760"},{n:"FISIP",p:"Administrasi Bisnis, Ilmu Komunikasi, Hubungan Internasional",utbk:"620-660"}]},
    { name:"Universitas Hasanuddin", abbr:"UNHAS", kota:"Makassar, Sulawesi Selatan", img:"/images/ptn/unhas.png", wilayah:"luar", fokus:"umum", akreditasi:"Unggul", mahasiswa:"40.000+", prodi:"230+", tags:["Unggul","SNBP","SNBT","Mandiri"], jalur:["SNBP","SNBT","Seleksi Mandiri UNHAS"],
      info:"PTN terbesar di Kawasan Timur Indonesia. UNHAS menjadi pusat pengembangan SDM unggulan dengan program studi yang relevan dengan potensi daerah KTI.",
      fakultas:[{n:"Teknik",p:"Teknik Sipil, Teknik Mesin, Teknik Elektro, Teknik Informatika",utbk:"640-680"},{n:"Kedokteran",p:"Pendidikan Dokter, Ilmu Keperawatan",utbk:"710-750"},{n:"Hukum",p:"Ilmu Hukum",utbk:"620-660"},{n:"Ekonomi & Bisnis",p:"Manajemen, Akuntansi, Ilmu Ekonomi",utbk:"620-660"},{n:"Pertanian",p:"Agribisnis, Agroteknologi, Kehutanan",utbk:"580-620"},{n:"Ilmu Kelautan & Perikanan",p:"Ilmu Kelautan, Budidaya Perairan, Pemanfaatan SD Perikanan",utbk:"580-620"}]},
    { name:"Universitas Sumatera Utara", abbr:"USU", kota:"Medan, Sumatera Utara", img:"/images/ptn/usu.png", wilayah:"luar", fokus:"umum", akreditasi:"Unggul", mahasiswa:"45.000+", prodi:"220+", tags:["Unggul","SNBP","SNBT","Mandiri"], jalur:["SNBP","SNBT","SM-USU"],
      info:"Universitas terdepan di Sumatera dengan tradisi riset pertanian, teknik, dan kedokteran yang kuat. USU berperan penting dalam pembangunan wilayah Sumatera.",
      fakultas:[{n:"Teknik",p:"Teknik Sipil, Teknik Mesin, Teknik Elektro, Teknik Industri",utbk:"620-660"},{n:"Kedokteran",p:"Pendidikan Dokter, Ilmu Keperawatan",utbk:"680-720"},{n:"Pertanian",p:"Agribisnis, Agroteknologi, Kehutanan",utbk:"560-600"},{n:"Ekonomi & Bisnis",p:"Manajemen, Akuntansi, Ekonomi Pembangunan",utbk:"600-640"},{n:"Hukum",p:"Ilmu Hukum",utbk:"600-640"},{n:"ISIP",p:"Ilmu Komunikasi, Sosiologi, Administrasi Negara",utbk:"560-600"}]},
    { name:"Universitas Padjadjaran", abbr:"UNPAD", kota:"Bandung, Jawa Barat", img:"/images/ptn/unpad.png", wilayah:"jawa", fokus:"umum", akreditasi:"Unggul", mahasiswa:"50.000+", prodi:"240+", tags:["Unggul","SNBP","SNBT","Mandiri"], jalur:["SNBP","SNBT","SMUP UNPAD"],
      info:"Kampus riset modern di Jatinangor dengan keunggulan di bidang sosial, hukum, dan kesehatan. UNPAD dikenal sebagai universitas dengan atmosfer akademik yang dinamis.",
      fakultas:[{n:"Kedokteran",p:"Pendidikan Dokter, Kedokteran Gigi, Keperawatan",utbk:"730-770"},{n:"Hukum",p:"Ilmu Hukum",utbk:"650-690"},{n:"Ekonomi & Bisnis",p:"Manajemen, Akuntansi, Bisnis Digital",utbk:"650-690"},{n:"Ilmu Komunikasi",p:"Ilmu Komunikasi, Hubungan Masyarakat, Jurnalistik",utbk:"640-680"},{n:"MIPA",p:"Matematika, Statistika, Kimia, Fisika, Biologi",utbk:"640-680"},{n:"Ilmu Sosial & Ilmu Politik",p:"Ilmu Politik, Sosiologi, Kesejahteraan Sosial",utbk:"620-660"}]},
    { name:"Universitas Brawijaya", abbr:"UB", kota:"Malang, Jawa Timur", img:"/images/ptn/ub.png", wilayah:"jawa", fokus:"umum", akreditasi:"Unggul", mahasiswa:"60.000+", prodi:"290+", tags:["Unggul","SNBP","SNBT","Mandiri"], jalur:["SNBP","SNBT","Selma UB"],
      info:"Salah satu universitas dengan mahasiswa terbanyak di Indonesia. UB unggul dalam riset pertanian, teknologi pangan, dan hukum dengan kampus yang asri di kaki Gunung Arjuno.",
      fakultas:[{n:"Teknik",p:"Teknik Sipil, Teknik Mesin, Teknik Elektro, Teknik Informatika",utbk:"640-680"},{n:"Pertanian",p:"Agribisnis, Agroteknologi, Agroekoteknologi",utbk:"590-630"},{n:"Hukum",p:"Ilmu Hukum",utbk:"630-670"},{n:"Ekonomi & Bisnis",p:"Manajemen, Akuntansi, Ilmu Ekonomi",utbk:"640-680"},{n:"Kedokteran",p:"Pendidikan Dokter, Ilmu Keperawatan",utbk:"700-740"},{n:"Teknologi Pertanian",p:"Teknologi Pangan, Keteknikan Pertanian, Bioteknologi",utbk:"600-640"}]},
];

function renderCards(data) {
    const grid = document.getElementById('ptn-grid');
    document.getElementById('result-count').textContent = `Menampilkan ${data.length} PTN`;
    if (data.length === 0) {
        grid.innerHTML = `<div class="no-result" style="grid-column:1/-1"><div class="emoji">&#x1F50D;</div><p>PTN tidak ditemukan.</p></div>`;
        return;
    }
    const tagClass = { Unggul:'tag-green', SNBP:'tag-amber', SNBT:'tag-blue', Mandiri:'tag-mauve' };
    grid.innerHTML = data.map(p => `
        <div class="ptn-card" onclick="openModal(${ptnData.indexOf(p)})">
            <div class="card-img-wrap"><img src="${p.img}" alt="${p.name}" loading="lazy"></div>
            <div class="card-top">
                <div>
                    <div class="card-title">${p.name}</div>
                    <div class="card-abbr">${p.abbr}</div>
                </div>
            </div>
            <div class="card-location">&#x1F4CD; ${p.kota}</div>
            <div class="card-tags">${p.tags.map(t => `<span class="tag ${tagClass[t]||'tag-green'}">${t}</span>`).join('')}</div>
            <div class="card-stats">
                <div class="stat-item"><div class="stat-num">${p.mahasiswa}</div><div class="stat-lbl">Mahasiswa</div></div>
                <div class="card-divider"></div>
                <div class="stat-item"><div class="stat-num">${p.prodi}</div><div class="stat-lbl">Prodi</div></div>
                <div class="card-divider"></div>
                <div class="stat-item"><div class="stat-num">${p.akreditasi}</div><div class="stat-lbl">Akreditasi</div></div>
            </div>
        </div>`).join('');
}

let activeFilter = 'semua', searchVal = '';

function applyFilter() {
    let res = ptnData;
    if (searchVal) res = res.filter(p => p.name.toLowerCase().includes(searchVal) || p.kota.toLowerCase().includes(searchVal) || p.abbr.toLowerCase().includes(searchVal));
    if (activeFilter !== 'semua') res = res.filter(p => activeFilter === 'teknik' ? p.fokus === 'teknik' : p.wilayah === activeFilter);
    renderCards(res);
}

document.getElementById('search-input').addEventListener('input', e => { searchVal = e.target.value.toLowerCase(); applyFilter(); });

document.querySelectorAll('.filter-pill').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-pill').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        activeFilter = btn.dataset.filter;
        applyFilter();
    });
});

document.addEventListener('DOMContentLoaded', () => renderCards(ptnData));

function openModal(idx) {
    const p = ptnData[idx];
    document.getElementById('modal-img').src = p.img;
    document.getElementById('modal-img').alt = p.name;
    document.getElementById('modal-badge').textContent = '\u{1F3DB}\uFE0F Perguruan Tinggi Negeri';
    document.getElementById('modal-title').textContent = p.name;
    document.getElementById('modal-abbr').textContent = p.abbr + ' \u2014 ' + p.kota;
    document.getElementById('modal-desc').textContent = p.info;
    document.getElementById('modal-stats').innerHTML =
        `<div class="mstat"><div class="mstat-num">${p.mahasiswa}</div><div class="mstat-lbl">Mahasiswa</div></div>` +
        `<div class="mstat"><div class="mstat-num">${p.prodi}</div><div class="mstat-lbl">Program Studi</div></div>` +
        `<div class="mstat"><div class="mstat-num">${p.akreditasi}</div><div class="mstat-lbl">Akreditasi BAN-PT</div></div>` +
        `<div class="mstat"><div class="mstat-num">${p.jalur.length}</div><div class="mstat-lbl">Jalur Masuk</div></div>`;
    document.getElementById('modal-jalur').innerHTML = p.jalur.map(j => `<span class="jalur-pill">${j}</span>`).join('');
    document.getElementById('modal-fakultas').innerHTML = p.fakultas.map(f => `
        <div class="fakultas-item">
            <div class="fak-name">${f.n}</div>
            <div class="fak-prodi">${f.p}</div>
            <div class="fak-utbk">&#x1F4CA; Target UTBK: <strong>${f.utbk}</strong></div>
        </div>`).join('');
    document.getElementById('modal-overlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeModal(e) {
    if (e.target === document.getElementById('modal-overlay')) {
        document.getElementById('modal-overlay').classList.remove('open');
        document.body.style.overflow = '';
    }
}
</script>
</body>
</html>

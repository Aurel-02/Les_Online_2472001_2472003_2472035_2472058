<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian - Pintar.id</title>
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
        .sidebar-menu { flex: 1; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; } .sidebar-menu::-webkit-scrollbar { display: none; }
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
            width: 100%; padding: 14px; border-radius: 99px; font-size: 15px; font-weight: 600;
            color: var(--dusty-mauve); background: rgba(163,124,118,0.08); border: none;
            cursor: pointer; transition: all .3s ease;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .btn-logout:hover { background: rgba(163,124,118,0.15); color: #8a655f; }

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
        .content-body { padding: 0 48px 80px; max-width: 1000px; margin: 0 auto; }

        /* Hero */
        .ujian-hero {
            background: linear-gradient(135deg, #4A6741 0%, #6B8F5E 100%);
            border-radius: 32px; padding: 44px 52px; display: flex; align-items: center;
            justify-content: space-between; margin-bottom: 40px;
            box-shadow: 0 16px 40px rgba(74,103,65,.25); position: relative; overflow: hidden;
        }
        .ujian-hero::before {
            content: ''; position: absolute; right: -60px; top: -60px; width: 320px; height: 320px;
            background: radial-gradient(circle, rgba(255,255,255,.15) 0%, transparent 70%); border-radius: 50%;
        }
        .hero-left h1 { font-size: 34px; font-weight: 800; color: #fff; line-height: 1.15; letter-spacing: -1px; margin-bottom: 12px; }
        .hero-left p { font-size: 15px; color: rgba(255,255,255,.75); max-width: 440px; line-height: 1.6; }
        .hero-badge { background: rgba(255,255,255,.2); border: 1px solid rgba(255,255,255,.4); color: #fff; font-size: 13px; font-weight: 700; padding: 6px 16px; border-radius: 99px; display: inline-block; margin-bottom: 16px; }
        .hero-icon { font-size: 100px; filter: drop-shadow(0 10px 24px rgba(0,0,0,.2)); animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%,100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-14px) rotate(4deg); } }

        /* Kelas Selector */
        .section-header { margin-bottom: 24px; text-align: center; }
        .section-title { font-size: 22px; font-weight: 800; color: var(--dark-oak); margin-bottom: 8px; }
        .section-subtitle { font-size: 15px; color: rgba(61,43,31,.6); }
        
        .kelas-selector { display: flex; justify-content: center; gap: 16px; margin-bottom: 48px; flex-wrap: wrap; }
        .kelas-pill {
            padding: 14px 32px; border-radius: 99px; border: 1px solid rgba(61,43,31,.15);
            background: rgba(255,255,255,.6); backdrop-filter: blur(8px);
            font-family: 'Outfit', sans-serif; font-size: 16px; font-weight: 700;
            color: var(--dark-oak); cursor: pointer; transition: all .3s ease;
            box-shadow: 0 4px 12px rgba(61,43,31,.03);
        }
        .kelas-pill:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(61,43,31,.08); }
        .kelas-pill.active { background: var(--dark-oak); color: #fff; border-color: var(--dark-oak); transform: translateY(-3px); box-shadow: 0 12px 30px rgba(61,43,31,.15); }

        /* Exam Cards Grid */
        .exam-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px; }
        
        .exam-card {
            background: rgba(255,255,255,.6); backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,.9); border-radius: 32px; padding: 32px;
            box-shadow: 0 12px 32px rgba(61,43,31,.05); transition: all .4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer; position: relative; overflow: hidden; display: flex; flex-direction: column;
            text-align: center;
        }
        .exam-card::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 6px;
            background: var(--muted-sage); transition: all .3s ease;
        }
        .exam-card:hover { transform: translateY(-10px); box-shadow: 0 24px 48px rgba(61,43,31,.1); background: rgba(255,255,255,.85); }
        .exam-card:hover::before { height: 10px; }
        
        .exam-card.uts::before { background: #4A6741; }
        .exam-card.uas::before { background: #5B8BEB; }
        .exam-card.tryout::before { background: #A37C76; }
        
        .exam-icon-wrap {
            width: 80px; height: 80px; border-radius: 24px; margin: 0 auto 24px;
            display: flex; align-items: center; justify-content: center; font-size: 36px;
            background: rgba(255,255,255,.8); box-shadow: 0 8px 24px rgba(61,43,31,.04);
        }
        .exam-card.uts .exam-icon-wrap { color: #4A6741; }
        .exam-card.uas .exam-icon-wrap { color: #5B8BEB; }
        .exam-card.tryout .exam-icon-wrap { color: #A37C76; }

        .exam-title { font-size: 24px; font-weight: 800; color: var(--dark-oak); margin-bottom: 12px; }
        .exam-desc { font-size: 14px; color: rgba(61,43,31,.6); line-height: 1.6; margin-bottom: 32px; flex: 1; }
        
        .exam-btn {
            padding: 14px; border-radius: 16px; background: rgba(61,43,31,.06);
            color: var(--dark-oak); font-weight: 700; font-size: 15px; border: none;
            transition: all .3s ease;
        }
        .exam-card:hover .exam-btn { background: var(--dark-oak); color: #fff; }

        /* Animation class for dynamic cards */
        .fade-in-up { animation: fadeInUp 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; opacity: 0; transform: translateY(20px); }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }

        /* tryout card hidden by default, toggled by JS */
        #tryout-card { display: none; }

        @media(max-width:992px){
            .sidebar{transform:translateX(-100%);}
            .main-wrapper{margin-left:0;}
            .ujian-hero{flex-direction:column;text-align:center;gap:24px;padding:32px;}
            .content-body{padding:0 24px 60px;}
            .topbar{padding:24px;}
        }

        /* Flash Result Card */
        .result-flash {
            background: linear-gradient(135deg, #4A6741, #6B8F5E); border-radius: 24px;
            padding: 28px 36px; margin-bottom: 32px; display: flex; align-items: center;
            justify-content: space-between; color: #fff;
            box-shadow: 0 12px 32px rgba(74,103,65,.25); animation: slideDown .4s ease;
        }
        @keyframes slideDown { from { opacity:0; transform:translateY(-16px); } to { opacity:1; transform:translateY(0); } }
        .result-flash .label { font-size: 13px; font-weight: 700; opacity: .8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
        .result-flash .value { font-size: 28px; font-weight: 800; }
        .result-flash .score-circle {
            width: 72px; height: 72px; border-radius: 50%; border: 4px solid rgba(255,255,255,.5);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; font-weight: 800; background: rgba(255,255,255,.15);
        }

        /* History */
        .history-section { margin-top: 48px; }
        .history-title { font-size: 22px; font-weight: 800; color: var(--dark-oak); margin-bottom: 20px; }
        .history-table {
            width: 100%; border-collapse: separate; border-spacing: 0 10px;
        }
        .history-table th {
            font-size: 12px; font-weight: 700; color: rgba(61,43,31,.5); text-transform: uppercase; letter-spacing: 1px;
            padding: 0 20px 8px; text-align: left;
        }
        .history-table td {
            padding: 16px 20px; background: rgba(255,255,255,.7); font-size: 15px; font-weight: 600;
        }
        .history-table tr td:first-child { border-radius: 16px 0 0 16px; }
        .history-table tr td:last-child  { border-radius: 0 16px 16px 0; }
        .badge-jenis {
            display: inline-block; padding: 4px 12px; border-radius: 99px; font-size: 12px; font-weight: 700;
        }
        .badge-uts    { background: rgba(74,103,65,.15);  color: #4A6741; }
        .badge-uas    { background: rgba(91,139,235,.15); color: #5B8BEB; }
        .badge-tryout { background: rgba(163,124,118,.15); color: #A37C76; }
        .score-bar {
            display: flex; align-items: center; gap: 10px;
        }
        .score-track {
            flex: 1; height: 8px; background: rgba(61,43,31,.1); border-radius: 99px; overflow: hidden;
        }
        .score-fill {
            height: 100%; border-radius: 99px; transition: width 1s ease;
        }
        .score-fill.high   { background: #4A6741; }
        .score-fill.medium { background: var(--warm-amber); }
        .score-fill.low    { background: var(--danger-red, #E76F51); }
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
            <a href="{{ route('siswa.ptn') }}" class="sidebar-item {{ request()->routeIs('siswa.ptn') || request()->routeIs('siswa.fakultas') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
                </span> Info Univ & PTN
            </a>
            <a href="{{ route('siswa.jurusan') }}" class="sidebar-item {{ request()->routeIs('siswa.jurusan') || request()->routeIs('siswa.jurusan.detail') ? 'active' : '' }}">
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
            <a href="{{ route('siswa.ujian') }}" class="sidebar-item {{ request()->routeIs('siswa.ujian') || request()->routeIs('siswa.ujian.*') ? 'active' : '' }}">
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

    <div class="main-wrapper">
        <header class="topbar">
            <a href="{{ route('siswa.notifikasi') }}" class="notification-bell" style="text-decoration:none; margin-right: 16px; position: relative; color: var(--dark-oak); display: flex; align-items: center; justify-content: center; width: 42px; height: 42px; border-radius: 50%; background: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.8); backdrop-filter: blur(12px); box-shadow: 0 4px 14px rgba(61,43,31,0.04); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </a>
            <a href="{{ route('siswa.profile') }}" class="user-profile">
                <div class="user-greeting">Halo, <span>{{ explode(' ', $userName ?? 'Siswa')[0] }}</span></div>
                <div class="user-avatar">
                    @if($photoProfile)
                        <img src="{{ asset('storage/' . $photoProfile) }}" alt="Profile" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        {{ strtoupper(substr($userName ?? 'S', 0, 1)) }}
                    @endif
                </div>
            </a>
        </header>

        <div class="content-body">
            <div class="ujian-hero">
                <div class="hero-left">
                    <div class="hero-badge">Jenjang {{ $jenjangName }}</div>
                    <h1>Platform Ujian Pintar.id</h1>
                    <p>Pilih kelas dan tipe ujianmu. Uji kemampuan dan dapatkan evaluasi komprehensif.</p>
                </div>
                <div class="hero-icon">📝</div>
            </div>

            {{-- Ujian Grid --}}
            <div class="section-header">
                <div class="section-title">Pilih Tipe Ujian</div>
                <div class="section-subtitle">Tipe ujian disesuaikan dengan kelas {{ $kelas }} yang kamu pilih di Home</div>
            </div>

            <div class="exam-grid" id="examGrid">
                <a href="{{ route('siswa.ujian.mapel', ['jenis' => 'uts']) }}" style="text-decoration:none;" class="exam-card uts fade-in-up">
                    <div class="exam-icon-wrap">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    </div>
                    <h3 class="exam-title">Ujian Tengah Semester</h3>
                    <p class="exam-desc">Evaluasi kemampuan tengah semester dengan soal-soal latihan berstandar kurikulum terbaru.</p>
                    <button class="exam-btn">Mulai Ujian</button>
                </a>

                <a href="{{ route('siswa.ujian.mapel', ['jenis' => 'uas']) }}" style="text-decoration:none;" class="exam-card uas fade-in-up">
                    <div class="exam-icon-wrap">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <h3 class="exam-title">Ujian Akhir Semester</h3>
                    <p class="exam-desc">Simulasi ujian akhir semester untuk memantapkan pemahaman seluruh materi selama satu semester.</p>
                    <button class="exam-btn">Mulai Ujian</button>
                </a>

                {{-- Tryout card: always in DOM, shown/hidden by JS based on selected kelas --}}
                <a href="{{ route('siswa.ujian.mapel', ['jenis' => 'tryout']) }}" style="text-decoration:none;" class="exam-card tryout fade-in-up" id="tryout-card">
                    <div class="exam-icon-wrap">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <h3 class="exam-title">Try Out UTBK/SNBT</h3>
                    <p class="exam-desc">Simulasi soal UTBK berstandar SNBT dengan penilaian asli: +4 benar, −1 salah, 0 kosong.</p>
                    <button class="exam-btn">Mulai Try Out</button>
                </a>
            </div>

            <div class="history-section">
                <h2 class="history-title">📋 Riwayat Ujian</h2>

                @if($histories->isEmpty())
                <div style="padding: 40px; text-align: center; background: rgba(255,255,255,.6); border-radius: 20px; color: rgba(61,43,31,.5); font-size: 15px; font-weight: 600;">
                    Belum ada riwayat ujian. Mulai ujianmu sekarang! 🎯
                </div>
                @else
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Mata Pelajaran</th>
                            <th>Benar / Total</th>
                            <th>Nilai</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($histories as $h)
                        @php
                            $scoreClass = $h->score >= 75 ? 'high' : ($h->score >= 50 ? 'medium' : 'low');
                            $jenisLabel = match($h->jenis) { 'uts' => 'UTS', 'uas' => 'UAS', 'tryout' => 'Try Out', default => strtoupper($h->jenis) };
                        @endphp
                        <tr>
                            <td>{{ $h->created_at->locale('id')->isoFormat('D MMM YYYY, HH:mm') }}</td>
                            <td>
                                <span class="badge-jenis badge-{{ $h->jenis }}">{{ $jenisLabel }}</span>
                            </td>
                            <td>{{ $h->mapel }}</td>
                            <td>{{ $h->correct }} / {{ $h->total }}</td>
                            <td>
                                <div class="score-bar">
                                    <strong style="min-width:36px;">{{ $h->score }}</strong>
                                    <div class="score-track">
                                        <div class="score-fill {{ $scoreClass }}" style="width:{{ $h->score }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('siswa.ujian.review', ['id' => $h->id]) }}"
                                   style="display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border-radius:10px; background:rgba(61,43,31,.07); color:var(--dark-oak); text-decoration:none; font-size:13px; font-weight:700; transition:all .2s;"
                                   onmouseover="this.style.background='rgba(61,43,31,.14)'" onmouseout="this.style.background='rgba(61,43,31,.07)'">
                                    🔍 Review
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>

    <script>
        const userJenjang = {{ $jenjangId }};
        const STORAGE_KEY_KELAS = `pintar_kelas_j${userJenjang}`;

        // Baca kelas dari localStorage (sinkron dengan dropdown di home)
        let selectedKelas = parseInt(localStorage.getItem(STORAGE_KEY_KELAS)) || {{ $kelas }};

        document.addEventListener('DOMContentLoaded', () => {
            // Tampilkan/sembunyikan Try Out sesuai kelas
            const tryoutCard = document.getElementById('tryout-card');
            if (tryoutCard) {
                tryoutCard.style.display = (selectedKelas === 12 && userJenjang === 3) ? 'flex' : 'none';
            }
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Pintar.id</title>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: #F7F4F0;
            color: var(--dark-oak);
            overflow-x: hidden;
            display: flex;
            height: 100vh;
        }

        /* ── Blobs Background ── */
        .blob-1 { position: fixed; top: -10%; right: 10%; width: 500px; height: 500px; background: rgba(142, 150, 128, 0.15); border-radius: 50%; filter: blur(80px); z-index: 0; pointer-events: none; }
        .blob-2 { position: fixed; bottom: -10%; left: 20%; width: 400px; height: 400px; background: rgba(217, 179, 130, 0.15); border-radius: 50%; filter: blur(60px); z-index: 0; pointer-events: none; }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-width);
            background: rgba(230, 216, 193, 0.85);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255,255,255,0.6);
            height: 100vh;
            padding: 32px 24px;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 50;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            margin-bottom: 60px;
        }

        .logo-text { font-size: 26px; font-weight: 800; color: var(--dark-oak); letter-spacing: -0.5px; }

        .sidebar-menu { 
            flex: 1; 
            display: flex; 
            flex-direction: column; 
            gap: 8px; 
            overflow-y: auto; 
        }
        .sidebar-menu::-webkit-scrollbar { display: none; }

        .sidebar-item {
            display: flex; align-items: center; gap: 14px;
            padding: 14px 18px; border-radius: 16px;
            text-decoration: none; color: rgba(61,43,31,0.7);
            font-weight: 600; font-size: 15px;
            transition: all 0.3s ease;
        }

        .sidebar-item:hover, .sidebar-item.active {
            background: rgba(255,255,255,0.5);
            color: var(--dark-oak);
            box-shadow: 0 4px 12px rgba(61,43,31,0.03);
        }

        .sidebar-item-icon { font-size: 20px; }

        .logout-container { margin-top: auto; }

        .btn-logout {
            width: 100%; padding: 14px; border-radius: 99px;
            font-size: 15px; font-weight: 600; color: var(--dusty-mauve);
            background: rgba(163, 124, 118, 0.08); border: none;
            cursor: pointer; transition: all 0.3s ease;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }

        .btn-logout:hover { background: rgba(163, 124, 118, 0.15); color: #8a655f; }

        /* ── Main Content Area ── */
        .main-wrapper {
            flex: 1;
            margin-left: var(--sidebar-width);
            height: 100vh;
            overflow-y: auto;
            position: relative;
            z-index: 5;
        }

        /* ── Topbar (Header) ── */
        .topbar {
            padding: 24px 48px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 16px;
            background: rgba(255,255,255,0.6);
            backdrop-filter: blur(12px);
            padding: 8px 10px 8px 24px;
            border-radius: 99px;
            border: 1px solid rgba(255,255,255,0.8);
            box-shadow: 0 4px 14px rgba(61,43,31,0.04);
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .user-profile:hover {
            transform: translateY(-2px);
        }

        .user-greeting {
            font-size: 15px; font-weight: 500; color: rgba(61,43,31,0.7);
        }

        .user-greeting span {
            font-weight: 800; color: var(--dark-oak);
        }

        .user-avatar {
            width: 42px; height: 42px; border-radius: 50%;
            background: var(--warm-amber);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: white; font-size: 18px;
        }

        /* ── Content Body ── */
        .content-body {
            padding: 0 48px 80px;
            max-width: 1100px;
            margin: 0 auto;
        }

        /* ── Banner Paket Belajar ── */
        .package-banner {
            background: linear-gradient(135deg, var(--warm-amber) 0%, #E8CDA9 100%);
            border-radius: 32px;
            padding: 40px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 48px;
            box-shadow: 0 16px 40px rgba(217, 179, 130, 0.3);
            position: relative;
            overflow: hidden;
        }

        .package-banner::after {
            content: ''; position: absolute; right: -50px; top: -50px;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%; pointer-events: none;
        }

        .package-left h2 {
            font-size: 36px; font-weight: 800; color: var(--dark-oak); margin-bottom: 12px; line-height: 1.1; letter-spacing: -1px;
        }
        .package-left p {
            font-size: 16px; color: rgba(61,43,31,0.8); max-width: 440px; margin-bottom: 28px; line-height: 1.5;
        }

        .btn-upgrade {
            background: var(--dark-oak); color: white;
            padding: 16px 32px; border-radius: 99px;
            font-weight: 700; font-size: 15px; text-decoration: none;
            display: inline-block; transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(61,43,31,0.2);
        }

        .btn-upgrade:hover {
            transform: translateY(-4px); box-shadow: 0 14px 28px rgba(61,43,31,0.3);
        }

        .package-illustration {
            font-size: 110px; filter: drop-shadow(0 10px 20px rgba(61,43,31,0.1));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }

        /* ── Welcome Stats (Modified) ── */
        .status-container {
            margin-bottom: 40px;
        }

        .stat-card {
            background: rgba(255,255,255,0.5); backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.8); border-radius: 24px;
            padding: 20px 24px; display: inline-flex; align-items: center; gap: 16px;
            box-shadow: 0 10px 30px rgba(61,43,31,0.03);
            transition: transform 0.3s ease;
            min-width: 280px;
        }

        .stat-card:hover { transform: translateY(-4px); }

        .stat-icon { width: 52px; height: 52px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0; }
        .bg-sage { background: rgba(142, 150, 128, 0.2); color: #6A725D; }
        .bg-mauve { background: rgba(163, 124, 118, 0.2); color: #8a655f; }
        .bg-amber { background: rgba(217, 179, 130, 0.2); color: #B38F60; }
        .bg-blue { background: rgba(112, 161, 255, 0.2); color: #5B8BEB; }

        .stat-info h3 { font-size: 24px; font-weight: 800; color: var(--dark-oak); line-height: 1; margin-bottom: 6px; }
        .stat-info p { font-size: 12px; font-weight: 700; color: rgba(61,43,31,0.55); text-transform: uppercase; letter-spacing: 0.5px; }

        /* ── Daftar Nilai (Progress Bar) ── */
        .score-list-card {
            background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 32px;
            padding: 36px; box-shadow: 0 10px 30px rgba(61, 43, 31, 0.04);
            margin-bottom: 56px;
        }

        .score-list {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 28px;
        }

        .score-item { width: 100%; }

        .score-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
        .score-subject { font-size: 15px; font-weight: 700; color: var(--dark-oak); }
        .score-value { font-size: 16px; font-weight: 800; color: var(--dark-oak); }
        
        .progress-track {
            width: 100%; height: 12px; background: rgba(61,43,31,0.06);
            border-radius: 99px; overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        }
        
        .progress-fill {
            height: 100%; border-radius: 99px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            animation: fillBar 1.5s ease-out forwards;
        }

        @keyframes fillBar {
            from { width: 0; }
        }


        /* ── Aktivitas Terbaru ── */
        .glass-card {
            background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 32px;
            padding: 36px; box-shadow: 0 10px 30px rgba(61, 43, 31, 0.04);
        }

        .activity-item {
            display: flex; align-items: flex-start; gap: 18px; padding: 20px 0; border-bottom: 1px solid rgba(61,43,31,0.06);
        }
        .activity-item:last-child { border-bottom: none; padding-bottom: 0; }

        .activity-icon { width: 48px; height: 48px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
        .activity-text { flex: 1; }
        .activity-desc { font-size: 15px; font-weight: 600; color: var(--dark-oak); line-height: 1.4; }
        .activity-time { font-size: 13px; color: rgba(61, 43, 31, 0.45); margin-top: 6px; font-weight: 600; }

        /* ── Dropdown & Mapel Cards ── */
        .filter-select {
            padding: 8px 16px; border-radius: 99px;
            border: 1px solid rgba(61,43,31,0.2);
            background: rgba(255,255,255,0.7); backdrop-filter: blur(8px);
            font-family: 'Outfit', sans-serif; font-size: 14px; font-weight: 600;
            color: var(--dark-oak); outline: none; cursor: pointer;
            transition: all 0.2s;
        }
        .filter-select:focus { border-color: var(--muted-sage); }
        .mapel-card {
            background: rgba(255,255,255,0.6);
            border: 1px solid rgba(255,255,255,0.8);
            border-radius: 20px; padding: 20px;
            display: flex; align-items: center; gap: 16px;
            transition: all 0.3s ease; text-decoration: none; color: inherit;
        }
        .mapel-card:hover { transform: translateY(-4px); background: #fff; box-shadow: 0 8px 24px rgba(61,43,31,0.06); }
        .mapel-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; flex-shrink: 0;
        }
        .mapel-title { font-size: 16px; font-weight: 800; color: var(--dark-oak); line-height: 1.2; }
        .mapel-subtitle { font-size: 12px; color: rgba(61,43,31,0.5); margin-top: 4px; font-weight: 600; }

        /* ── Voucher Ticket ── */
        .voucher-grid {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            overflow-y: hidden;
            width: 100%;
            gap: 20px;
            margin-bottom: 40px;
            padding-bottom: 12px;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .voucher-grid::-webkit-scrollbar {
            height: 6px;
        }
        .voucher-grid::-webkit-scrollbar-track {
            background: rgba(230, 216, 193, 0.2);
            border-radius: 99px;
        }
        .voucher-grid::-webkit-scrollbar-thumb {
            background: var(--muted-sage);
            border-radius: 99px;
        }

        .voucher-ticket {
            flex: 0 0 320px;
            flex-shrink: 0;
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(20px);
            border: 2px dashed var(--warm-amber);
            border-radius: 24px;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 10px 30px rgba(61, 43, 31, 0.03);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .voucher-ticket:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 36px rgba(217, 179, 130, 0.15);
            border-color: var(--dusty-mauve);
        }

        .voucher-ticket::before, .voucher-ticket::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: #F7F4F0;
            border-radius: 50%;
            z-index: 2;
        }

        .voucher-ticket::before {
            left: -10px;
            top: 50%;
            transform: translateY(-50%);
            border-right: 2px dashed var(--warm-amber);
        }

        .voucher-ticket::after {
            right: -10px;
            top: 50%;
            transform: translateY(-50%);
            border-left: 2px dashed var(--warm-amber);
        }

        .voucher-ticket:hover::before {
            border-right-color: var(--dusty-mauve);
        }

        .voucher-ticket:hover::after {
            border-left-color: var(--dusty-mauve);
        }

        .btn-use-voucher {
            background: var(--dark-oak);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 6px 14px rgba(61, 43, 31, 0.1);
        }

        .btn-use-voucher:hover {
            background: var(--dusty-mauve);
            box-shadow: 0 8px 18px rgba(163, 124, 118, 0.25);
            transform: translateY(-2px);
        }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); transition: 0.3s; }
            .main-wrapper { margin-left: 0; }
            .package-banner { flex-direction: column; text-align: center; gap: 32px; padding: 32px; }
            .package-left p { margin: 0 auto 24px; }
            .content-body { padding: 0 24px 60px; }
            .topbar { padding: 24px; justify-content: space-between; }
        }
    </style>
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <!-- ══ SIDEBAR ══ -->
    <aside class="sidebar">
        <a href="/" class="logo-container">
            <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z"
                      fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/>
                <circle cx="12" cy="13" r="4" fill="var(--vintage-cream)" />
            </svg>
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
<<<<<<< HEAD
            <a href="{{ route('siswa.notifikasi') }}" class="sidebar-item {{ request()->routeIs('siswa.notifikasi') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                </span> Notifikasi
            </a>
=======
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
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

    <!-- ══ MAIN CONTENT ══ -->
    <main class="main-wrapper">
        <!-- ── HEADER ── -->
        <header class="topbar">
            <!-- Elemen kosong untuk mendorong user-profile ke kanan jika flex -->
            <div></div>
<<<<<<< HEAD
=======
            <a href="{{ route('siswa.notifikasi') }}" class="notification-bell" style="text-decoration:none; margin-right: 16px; position: relative; color: var(--dark-oak); display: flex; align-items: center; justify-content: center; width: 42px; height: 42px; border-radius: 50%; background: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.8); backdrop-filter: blur(12px); box-shadow: 0 4px 14px rgba(61,43,31,0.04); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </a>
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
            <a href="{{ route('siswa.profile') }}" class="user-profile" style="text-decoration:none;">
                <div class="user-greeting">Hi, <span>{{ explode(' ', $userName)[0] }}</span></div>
                    <div class="user-avatar">
                        @if(isset($photoProfile) && $photoProfile)
                            <img src="{{ asset('uploads/profiles/' . $photoProfile) }}" alt="Profile" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                        @else
                            {{ strtoupper(substr($userName, 0, 1)) }}
                        @endif
                    </div>
                </a>
        </header>

        <!-- ── DASHBOARD BODY ── -->
        <div class="content-body">

            @if(!$activePackageName)
            <!-- BANNER PAKET BELAJAR -->
            <div class="package-banner">
                <div class="package-left">
                    <h2>Upgrade Belajarmu<br>Sekarang!</h2>
                    <p>Dapatkan akses penuh ke seluruh video pembelajaran, tryout premium, dan prioritas chat dengan guru ahlinya.</p>
                    <a href="{{ route('siswa.paket-belajar') }}" class="btn-upgrade">Lihat Paket Belajar ✨</a>
                </div>
                <div class="package-illustration">🚀</div>
            </div>
            @endif

            <!-- STATUS MASA AKTIF PAKET & VOUCHER -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 28px; margin-bottom: 48px;">
                <div class="stat-card">
                    <div class="stat-icon bg-amber">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </div>
                    <div class="stat-info">
                        @if($activePackageName)
                            <h3>{{ $sisaHari }} Hari</h3>
                            <p>Paket Aktif: {{ $activePackageName }}</p>
                        @else
                            <h3>Belum Aktif</h3>
                            <p>Masa Aktif Paket Belajar</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- VOUCHER DISKON SPESIAL -->
            <h2 class="section-title" style="margin-bottom: 20px;">Voucher Diskon Spesial Untukmu 🎟️</h2>
            <div class="voucher-grid">
                @if(isset($vouchers) && count($vouchers) > 0)
                    @foreach($vouchers as $v)
                        <div class="voucher-ticket">
                            <div style="padding-left: 10px; z-index: 5;">
                                <div style="font-size: 12px; font-weight: 700; color: var(--muted-sage); text-transform: uppercase; letter-spacing: 1px;">Voucher Diskon</div>
                                <div style="font-size: 24px; font-weight: 800; color: var(--dark-oak); margin: 6px 0;">Rp {{ number_format($v->potongan, 0, ',', '.') }}</div>
                                <div style="font-size: 14px; font-weight: 600; color: rgba(61,43,31,0.65);">Kode: <strong style="color: var(--dusty-mauve); font-size: 16px;">{{ $v->kode_voucher }}</strong></div>
                                <div style="font-size: 11px; color: rgba(61,43,31,0.5); margin-top: 8px; font-weight: 600;">Berlaku s/d: {{ date('d M Y', strtotime($v->tanggal_berakhir)) }}</div>
                            </div>
                            <div style="text-align: right; padding-right: 10px; z-index: 5;">
                                <a href="{{ route('siswa.paket-belajar') }}" class="btn-use-voucher">Gunakan</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="grid-column: 1 / -1; text-align: center; padding: 32px; color: rgba(61,43,31,0.55); font-weight: 600; background: rgba(230, 216, 193, 0.2); border-radius: 24px; border: 1px solid rgba(230, 216, 193, 0.4);">
                        Belum ada voucher tersedia saat ini.
                    </div>
                @endif
            </div>
            <!-- MATA PELAJARAN DINAMIS -->
            <div class="section-header-flex" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                <h2 class="section-title" style="margin-bottom:0;">Mata Pelajaran</h2>
                <div class="filter-group" id="mapel-filters" style="display:flex; gap:12px;">
                    <!-- Dropdowns rendered by JS -->
                </div>
            </div>
            <div class="score-list-card" style="margin-bottom:48px;">
                <div class="score-list" id="mapel-list">
                    <!-- Cards rendered by JS -->
                </div>
            </div>
            <!-- NILAI MATA PELAJARAN (PROGRESS BARS) -->
            <h2 class="section-title">Perkembangan Nilai</h2>
            <div class="score-list-card">
                <div class="score-list">
                    <div class="score-item">
                        <div class="score-header">
                            <span class="score-subject">Matematika</span>
                            <span class="score-value">92</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width: 92%; background: linear-gradient(90deg, #5B8BEB, #85a9f2);"></div>
                        </div>
                    </div>
                    
                    <div class="score-item">
                        <div class="score-header">
                            <span class="score-subject">Bahasa Inggris</span>
                            <span class="score-value">88</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width: 88%; background: linear-gradient(90deg, #6A725D, #8E9680);"></div>
                        </div>
                    </div>

                    <div class="score-item">
                        <div class="score-header">
                            <span class="score-subject">Ilmu Pengetahuan Alam</span>
                            <span class="score-value">85</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width: 85%; background: linear-gradient(90deg, #8a655f, #A37C76);"></div>
                        </div>
                    </div>

                    <div class="score-item">
                        <div class="score-header">
                            <span class="score-subject">Ilmu Pengetahuan Sosial</span>
                            <span class="score-value">90</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width: 90%; background: linear-gradient(90deg, #B38F60, #D9B382);"></div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- AKTIVITAS TERBARU -->
            <h2 class="section-title">Aktivitas Terbaru</h2>
            <div class="glass-card">
                @if(isset($activities) && count($activities) > 0)
                    @foreach($activities as $act)
                        @php
                            $icon  = '✅';
                            $color = 'bg-sage';
                            if ($act->type === 'materi') {
                                $icon  = '📺';
                                $color = 'bg-blue';
                            } elseif ($act->type === 'catatan') {
                                $icon  = '📝';
                                $color = 'bg-amber';
                            } elseif ($act->type === 'ujian') {
                                $icon  = '🏆';
                                $color = 'bg-mauve';
                            } elseif ($act->type === 'transaksi') {
                                $icon  = '🛒';
                                $color = 'bg-green';
                            }
                        @endphp
                        <div class="activity-item">
                            <div class="activity-icon {{ $color }}">{{ $icon }}</div>
                            <div class="activity-text">
                                <div class="activity-desc">{{ $act->description }}</div>
                                <div class="activity-time">{{ $act->created_at->locale('id')->diffForHumans() }}</div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="text-align:center; padding: 20px; color:rgba(61,43,31,0.5); font-weight:600;">
                        Belum ada aktivitas. Mulai belajarmu sekarang! 🚀
                    </div>
                @endif
            </div>

        </div>
    </main>
    <script>
        const userJenjang = {{ $userJenjang ?? 3 }}; // 1: SD, 2: SMP, 3: SMA
        const mapelFilters = document.getElementById('mapel-filters');
        const mapelList = document.getElementById('mapel-list');

        const subjectsData = {
            sd: [
                { title: 'Matematika', subtitle: 'Dasar Berhitung', icon: '📐', color: 'bg-amber' },
                { title: 'Bahasa Indonesia', subtitle: 'Membaca & Menulis', icon: '📖', color: 'bg-sage' },
                { title: 'IPA Dasar', subtitle: 'Alam Sekitar', icon: '🌿', color: 'bg-mauve' }
            ],
            smp: [
                { title: 'Matematika', subtitle: 'Aljabar & Geometri', icon: '📐', color: 'bg-amber' },
                { title: 'Bahasa Inggris', subtitle: 'Grammar & Vocabulary', icon: '🔤', color: 'bg-blue' },
                { title: 'IPA Terpadu', subtitle: 'Fisika & Biologi Dasar', icon: '🔬', color: 'bg-sage' },
                { title: 'IPS Terpadu', subtitle: 'Sejarah & Geografi', icon: '🌍', color: 'bg-mauve' }
            ],
            sma_ipa: [
                { title: 'Matematika Peminatan', subtitle: 'Kalkulus & Trigonometri', icon: '📐', color: 'bg-amber' },
                { title: 'Fisika', subtitle: 'Mekanika & Termodinamika', icon: '⚡', color: 'bg-blue' },
                { title: 'Kimia', subtitle: 'Reaksi & Unsur', icon: '🧪', color: 'bg-sage' },
                { title: 'Biologi', subtitle: 'Genetika & Ekosistem', icon: '🧬', color: 'bg-mauve' }
            ],
            sma_ips: [
                { title: 'Matematika Wajib', subtitle: 'Aljabar Lanjut', icon: '📐', color: 'bg-amber' },
                { title: 'Ekonomi', subtitle: 'Akuntansi & Makro', icon: '💰', color: 'bg-sage' },
                { title: 'Geografi', subtitle: 'Pemetaan & Bumi', icon: '🗺️', color: 'bg-blue' },
                { title: 'Sosiologi', subtitle: 'Masyarakat & Interaksi', icon: '👥', color: 'bg-mauve' }
            ]
        };

        function renderMapelCards(subjects) {
            mapelList.innerHTML = '';
            subjects.forEach(sub => {
                const a = document.createElement('a');
                a.href = "{{ route('siswa.materi') }}?mapel=" + encodeURIComponent(sub.title);
                a.className = 'mapel-card';
                a.innerHTML = `
                    <div class="mapel-icon ${sub.color}">${sub.icon}</div>
                    <div>
                        <div class="mapel-title">${sub.title}</div>
                        <div class="mapel-subtitle">${sub.subtitle}</div>
                    </div>
                `;
                mapelList.appendChild(a);
            });
        }

        function initDropdowns() {
            mapelFilters.innerHTML = '';

            // Storage keys per jenjang agar tidak bentrok
            const STORAGE_KEY_KELAS   = `pintar_kelas_j${userJenjang}`;
            const STORAGE_KEY_JURUSAN = `pintar_jurusan_j${userJenjang}`;

            // Kelas Dropdown
            const kelasSelect = document.createElement('select');
            kelasSelect.className = 'filter-select';

            let minKelas, maxKelas;
            if (userJenjang == 1) { minKelas = 1; maxKelas = 6; }
            else if (userJenjang == 2) { minKelas = 7; maxKelas = 9; }
            else { minKelas = 10; maxKelas = 12; }

            const savedKelas = localStorage.getItem(STORAGE_KEY_KELAS);

            for (let i = minKelas; i <= maxKelas; i++) {
                const opt = document.createElement('option');
                opt.value = i;
                opt.textContent = `Kelas ${i}`;
                // Restore pilihan terakhir, default ke kelas terkecil
                if (savedKelas ? String(i) === savedKelas : i === minKelas) opt.selected = true;
                kelasSelect.appendChild(opt);
            }
            mapelFilters.appendChild(kelasSelect);

            // Jurusan Dropdown (hanya untuk SMA)
            let jurusanSelect = null;
            if (userJenjang == 3) {
                jurusanSelect = document.createElement('select');
                jurusanSelect.className = 'filter-select';

                const savedJurusan = localStorage.getItem(STORAGE_KEY_JURUSAN) || 'ipa';

                ['IPA', 'IPS'].forEach(jur => {
                    const opt = document.createElement('option');
                    opt.value = jur.toLowerCase();
                    opt.textContent = `Jurusan ${jur}`;
                    if (jur.toLowerCase() === savedJurusan) opt.selected = true;
                    jurusanSelect.appendChild(opt);
                });
                mapelFilters.appendChild(jurusanSelect);
            }

            // Event Listeners
            const updateCards = () => {
                // Simpan pilihan saat ini ke localStorage
                localStorage.setItem(STORAGE_KEY_KELAS, kelasSelect.value);
                if (jurusanSelect) localStorage.setItem(STORAGE_KEY_JURUSAN, jurusanSelect.value);

                let currentSubjects = [];
                if (userJenjang == 1) currentSubjects = subjectsData.sd;
                else if (userJenjang == 2) currentSubjects = subjectsData.smp;
                else if (userJenjang == 3) {
                    const jur = jurusanSelect.value; // ipa atau ips
                    currentSubjects = subjectsData[`sma_${jur}`];
                }
                renderMapelCards(currentSubjects);

                // Update session via AJAX
                fetch('{{ route("siswa.set-kelas") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        kelas: kelasSelect.value,
                        jurusan: jurusanSelect ? jurusanSelect.value : null
                    })
                }).catch(err => console.error('Failed to update kelas in session', err));
            };

            kelasSelect.addEventListener('change', updateCards);
            if (jurusanSelect) jurusanSelect.addEventListener('change', updateCards);

            // Initial render (pakai nilai yang sudah di-restore)
            updateCards();
        }

        document.addEventListener('DOMContentLoaded', initDropdowns);
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - Pintar.id</title>
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

        .sidebar-menu { flex: 1; display: flex; flex-direction: column; gap: 8px; }

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
            width: 100%; padding: 14px; border-radius: 16px;
            font-size: 15px; font-weight: 600; color: var(--dusty-mauve);
            background: rgba(163, 124, 118, 0.1); border: none;
            cursor: pointer; transition: all 0.3s ease;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }

        .btn-logout:hover { background: rgba(163, 124, 118, 0.2); color: #8a655f; }

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
            background: var(--muted-sage);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: white; font-size: 18px;
        }

        /* ── Content Body ── */
        .content-body {
            padding: 0 48px 80px;
            max-width: 1100px;
            margin: 0 auto;
        }

        /* ── Banner ── */
        .package-banner {
            background: linear-gradient(135deg, var(--muted-sage) 0%, #A3AC94 100%);
            border-radius: 32px;
            padding: 40px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 48px;
            box-shadow: 0 16px 40px rgba(142, 150, 128, 0.3);
            position: relative;
            overflow: hidden;
            color: white;
        }

        .package-banner::after {
            content: ''; position: absolute; right: -50px; top: -50px;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%; pointer-events: none;
        }

        .package-left h2 {
            font-size: 36px; font-weight: 800; color: white; margin-bottom: 12px; line-height: 1.1; letter-spacing: -1px;
        }
        .package-left p {
            font-size: 16px; color: rgba(255,255,255,0.9); max-width: 440px; margin-bottom: 28px; line-height: 1.5;
        }

        .btn-upgrade {
            background: white; color: var(--muted-sage);
            padding: 16px 32px; border-radius: 99px;
            font-weight: 700; font-size: 15px; text-decoration: none;
            display: inline-block; transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .btn-upgrade:hover {
            transform: translateY(-4px); box-shadow: 0 14px 28px rgba(0,0,0,0.15);
        }

        .package-illustration {
            font-size: 110px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }

        /* ── Welcome Stats ── */
        .status-container {
            margin-bottom: 40px;
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }

        .stat-card {
            background: rgba(255,255,255,0.5); backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.8); border-radius: 24px;
            padding: 20px 24px; display: inline-flex; align-items: center; gap: 16px;
            box-shadow: 0 10px 30px rgba(61,43,31,0.03);
            transition: transform 0.3s ease;
            flex: 1;
            min-width: 200px;
        }

        .stat-card:hover { transform: translateY(-4px); }

        .stat-icon { width: 52px; height: 52px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0; }
        .bg-sage { background: rgba(142, 150, 128, 0.2); color: #6A725D; }
        .bg-mauve { background: rgba(163, 124, 118, 0.2); color: #8a655f; }
        .bg-amber { background: rgba(217, 179, 130, 0.2); color: #B38F60; }
        .bg-blue { background: rgba(112, 161, 255, 0.2); color: #5B8BEB; }

        .stat-info h3 { font-size: 24px; font-weight: 800; color: var(--dark-oak); line-height: 1; margin-bottom: 6px; }
        .stat-info p { font-size: 12px; font-weight: 700; color: rgba(61,43,31,0.55); text-transform: uppercase; letter-spacing: 0.5px; }

        /* ── Sections ── */
        .section-title { font-size: 24px; font-weight: 800; color: var(--dark-oak); margin-bottom: 20px; }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 32px;
            padding: 36px; box-shadow: 0 10px 30px rgba(61, 43, 31, 0.04);
            margin-bottom: 48px;
        }

        /* ── Schedule List ── */
        .schedule-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px; border-radius: 20px;
            background: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.8);
            margin-bottom: 16px; transition: all 0.3s ease;
        }
        .schedule-item:last-child { margin-bottom: 0; }
        .schedule-item:hover { transform: translateY(-2px); background: #fff; box-shadow: 0 8px 24px rgba(61,43,31,0.06); }
        
        .schedule-info { display: flex; align-items: center; gap: 16px; }
        .schedule-time { 
            background: var(--dark-oak); color: white; 
            padding: 8px 16px; border-radius: 12px; 
            font-weight: 700; font-size: 14px; text-align: center;
        }
        .schedule-details h4 { font-size: 18px; font-weight: 700; color: var(--dark-oak); margin-bottom: 4px; }
        .schedule-details p { font-size: 14px; color: rgba(61,43,31,0.6); font-weight: 500; }
        
        .btn-action {
            padding: 10px 20px; border-radius: 99px;
            font-size: 14px; font-weight: 600; text-decoration: none;
            transition: all 0.3s ease; border: 1px solid transparent;
        }
        .btn-primary { background: var(--dark-oak); color: white; }
        .btn-primary:hover { background: #2A1D14; }
        .btn-outline { border-color: var(--dark-oak); color: var(--dark-oak); }
        .btn-outline:hover { background: rgba(61,43,31,0.05); }

        /* ── Aktivitas Terbaru ── */
        .activity-item {
            display: flex; align-items: flex-start; gap: 18px; padding: 20px 0; border-bottom: 1px solid rgba(61,43,31,0.06);
        }
        .activity-item:last-child { border-bottom: none; padding-bottom: 0; }

        .activity-icon { width: 48px; height: 48px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
        .activity-text { flex: 1; }
        .activity-desc { font-size: 15px; font-weight: 600; color: var(--dark-oak); line-height: 1.4; }
        .activity-time { font-size: 13px; color: rgba(61, 43, 31, 0.45); margin-top: 6px; font-weight: 600; }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); transition: 0.3s; }
            .main-wrapper { margin-left: 0; }
            .package-banner { flex-direction: column; text-align: center; gap: 32px; padding: 32px; }
            .package-left p { margin: 0 auto 24px; }
            .content-body { padding: 0 24px 60px; }
            .topbar { padding: 24px; justify-content: space-between; }
            .schedule-item { flex-direction: column; align-items: flex-start; gap: 16px; }
            .btn-action { width: 100%; text-align: center; }
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
            <a href="#" class="sidebar-item active">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                </span> Dashboard
            </a>
            <a href="#" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </span> Jadwal Mengajar
            </a>
            <a href="{{ route('guru.siswa.index') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </span> Kelas & Siswa
            </a>
            <a href="{{ route('guru.materi.index') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </span> Materi & Tugas
            </a>
            <a href="#" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 15l8.38-8.38a2 2 0 0 0-2.83-2.83L12 9.17l-5.55-5.55a2 2 0 0 0-2.83 2.83L12 15z"></path><path d="M5.636 18.364a9 9 0 0 1 0-12.728"></path><path d="M18.364 18.364a9 9 0 0 0 0-12.728"></path></svg>
                </span> Evaluasi Nilai
            </a>
            <a href="#" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                </span> Chat 
            </a>
            <a href="#" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                </span> Notifikasi
            </a>
        </div>

        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <span>🚪</span> Keluar Akun
                </button>
            </form>
        </div>
    </aside>

    <!-- ══ MAIN CONTENT ══ -->
    <main class="main-wrapper">
        <!-- ── HEADER ── -->
        <header class="topbar">
            <div></div>
            <a href="{{ route('guru.profile') }}" class="user-profile" style="text-decoration:none;">
                <div class="user-greeting">Hi, <span>{{ explode(' ', $userName ?? 'Guru')[0] }}</span></div>
                    <div class="user-avatar">
                        @if(isset($photoProfile) && $photoProfile)
                            <img src="{{ asset('uploads/profiles/' . $photoProfile) }}" alt="Profile" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                        @else
                            {{ strtoupper(substr($userName ?? 'G', 0, 1)) }}
                        @endif
                    </div>
                </a>
        </header>

        <!-- ── DASHBOARD BODY ── -->
        <div class="content-body">

            <!-- BANNER GURU -->
            <div class="package-banner">
                <div class="package-left">
                    <h2>Siap Menginspirasi<br>Hari Ini?</h2>
                    <p>Pantau jadwal kelas, kelola materi pembelajaran, dan evaluasi perkembangan siswa dengan mudah.</p>
                    <a href="#" class="btn-upgrade">Lihat Jadwal Mengajar ✨</a>
                </div>
                <div class="package-illustration">👨‍🏫</div>
            </div>

            <!-- STATUS STATS -->
            <div class="status-container">
                <div class="stat-card">
                    <div class="stat-icon bg-amber">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <div class="stat-info">
                        <h3>120</h3>
                        <p>Total Siswa</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-sage">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </div>
                    <div class="stat-info">
                        <h3>4</h3>
                        <p>Kelas Aktif</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-mauve">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    </div>
                    <div class="stat-info">
                        <h3>15</h3>
                        <p>Tugas Perlu Dikoreksi</p>
                    </div>
                </div>
            </div>

            <!-- JADWAL MENGAJAR HARI INI -->
            <h2 class="section-title">Jadwal Mengajar Hari Ini</h2>
            <div class="glass-card">
                <div class="schedule-item">
                    <div class="schedule-info">
                        <div class="schedule-time">08:00<br>09:30</div>
                        <div class="schedule-details">
                            <h4>Matematika - Kelas X IPA 1</h4>
                            <p>Materi: Fungsi Kuadrat & Grafiknya</p>
                        </div>
                    </div>
                    <a href="#" class="btn-action btn-primary">Mulai Kelas</a>
                </div>
                <div class="schedule-item">
                    <div class="schedule-info">
                        <div class="schedule-time">10:00<br>11:30</div>
                        <div class="schedule-details">
                            <h4>Matematika - Kelas X IPA 2</h4>
                            <p>Materi: Fungsi Kuadrat & Grafiknya</p>
                        </div>
                    </div>
                    <a href="#" class="btn-action btn-outline">Persiapkan Materi</a>
                </div>
                <div class="schedule-item">
                    <div class="schedule-info">
                        <div class="schedule-time">13:00<br>14:30</div>
                        <div class="schedule-details">
                            <h4>Matematika Peminatan - Kelas XI IPA 1</h4>
                            <p>Materi: Polinomial & Suku Banyak</p>
                        </div>
                    </div>
                    <a href="#" class="btn-action btn-outline">Persiapkan Materi</a>
                </div>
            </div>

            <!-- AKTIVITAS TERBARU -->
            <h2 class="section-title">Aktivitas & Notifikasi</h2>
            <div class="glass-card">
                <div class="activity-item">
                    <div class="activity-icon bg-sage">📥</div>
                    <div class="activity-text">
                        <div class="activity-desc"><strong>Budi Santoso</strong> (X IPA 1) telah mengumpulkan tugas <strong>"Latihan Fungsi Kuadrat"</strong></div>
                        <div class="activity-time">30 menit yang lalu</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon bg-amber">💬</div>
                    <div class="activity-text">
                        <div class="activity-desc">Pesan baru dari <strong>Siti Aminah</strong> mengenai materi Polinomial.</div>
                        <div class="activity-time">1 jam yang lalu</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon bg-mauve">📊</div>
                    <div class="activity-text">
                        <div class="activity-desc">Hasil Tryout Nasional kelas XII IPS 2 telah selesai dikalkulasi.</div>
                        <div class="activity-time">Kemarin, 15:45</div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>
</html>
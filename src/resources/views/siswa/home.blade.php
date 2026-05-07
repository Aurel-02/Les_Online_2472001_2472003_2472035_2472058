<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-oak:      #3D2B1F;
            --muted-sage:    #8E9680;
            --dusty-mauve:   #A37C76;
            --warm-amber:    #D9B382;
            --vintage-cream: #E6D8C1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--vintage-cream);
            color: var(--dark-oak);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── Background blobs (sama persis dengan landing) ── */
        .blob-1 {
            position: fixed;
            top: -10%;
            right: -5%;
            width: 600px;
            height: 600px;
            background-color: rgba(142, 150, 128, 0.2);
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
        }

        .blob-2 {
            position: fixed;
            bottom: -10%;
            left: -5%;
            width: 400px;
            height: 400px;
            background-color: rgba(217, 179, 130, 0.2);
            border-radius: 50%;
            filter: blur(60px);
            z-index: 0;
            pointer-events: none;
        }

        /* ── Navbar ── */
        nav {
            padding: 20px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(230, 216, 193, 0.75);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.5);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 800;
            color: var(--dark-oak);
            letter-spacing: -0.5px;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-greeting {
            font-size: 15px;
            font-weight: 600;
            color: var(--dark-oak);
            opacity: 0.7;
        }

        .user-greeting span {
            color: var(--muted-sage);
            font-weight: 800;
            opacity: 1;
        }

        .btn-logout {
            padding: 10px 22px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            color: var(--dark-oak);
            background: transparent;
            border: 2px solid var(--dark-oak);
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-logout:hover {
            background: var(--dark-oak);
            color: var(--vintage-cream);
        }

        /* ── Main Layout ── */
        .main-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 48px 24px 80px;
            position: relative;
            z-index: 5;
        }

        /* ── Hero Welcome Section ── */
        .welcome-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 32px;
            margin-bottom: 56px;
        }

        .welcome-left {
            flex: 1;
        }

        .badge {
            display: inline-block;
            background-color: var(--warm-amber);
            color: var(--dark-oak);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 18px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .welcome-title {
            font-size: 52px;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -2px;
            margin-bottom: 14px;
        }

        .welcome-title span {
            color: var(--muted-sage);
        }

        .welcome-subtitle {
            font-size: 18px;
            line-height: 1.6;
            color: rgba(61, 43, 31, 0.7);
            max-width: 480px;
        }

        .welcome-right {
            display: flex;
            gap: 20px;
            flex-shrink: 0;
        }

        /* ── Quick Stat Cards (kanan welcome) ── */
        .mini-stat {
            background: rgba(230, 216, 193, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 20px;
            padding: 24px 28px;
            text-align: center;
            min-width: 130px;
            box-shadow: 0 4px 20px rgba(61,43,31,0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .mini-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 32px rgba(61,43,31,0.12);
        }

        .mini-stat-icon {
            font-size: 32px;
            margin-bottom: 8px;
            display: block;
        }

        .mini-stat-number {
            font-size: 28px;
            font-weight: 800;
            color: var(--dark-oak);
            display: block;
        }

        .mini-stat-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--muted-sage);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ── Section Title ── */
        .section-title {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.8px;
            margin-bottom: 6px;
        }

        .section-subtitle {
            font-size: 15px;
            color: rgba(61, 43, 31, 0.6);
            margin-bottom: 28px;
        }

        /* ── Menu Grid ── */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 56px;
        }

        .menu-card {
            background: rgba(230, 216, 193, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 22px;
            padding: 28px 22px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 18px rgba(61,43,31,0.06);
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .menu-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 36px rgba(61,43,31,0.13);
        }

        .menu-emoji {
            font-size: 40px;
            margin-bottom: 14px;
            display: block;
        }

        .menu-name {
            font-size: 17px;
            font-weight: 800;
            color: var(--dark-oak);
            margin-bottom: 6px;
        }

        .menu-desc {
            font-size: 13px;
            color: rgba(61, 43, 31, 0.55);
            font-weight: 600;
        }

        /* ── Jadwal & Aktivitas (2 kolom) ── */
        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
        }

        .glass-card {
            background: rgba(230, 216, 193, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(61,43,31,0.07);
        }

        .glass-card-title {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ── Jadwal Kelas ── */
        .schedule-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 0;
            border-bottom: 1px solid rgba(61,43,31,0.08);
        }

        .schedule-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .schedule-time {
            font-size: 13px;
            font-weight: 700;
            color: var(--muted-sage);
            min-width: 64px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .schedule-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .schedule-info {
            flex: 1;
        }

        .schedule-subject {
            font-size: 15px;
            font-weight: 700;
            color: var(--dark-oak);
        }

        .schedule-teacher {
            font-size: 13px;
            color: rgba(61, 43, 31, 0.55);
            margin-top: 2px;
        }

        .schedule-badge {
            font-size: 12px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 99px;
        }

        .badge-live {
            background: rgba(142, 150, 128, 0.2);
            color: var(--muted-sage);
        }

        .badge-soon {
            background: rgba(217, 179, 130, 0.2);
            color: #a88740;
        }

        /* ── Aktivitas Terbaru ── */
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid rgba(61,43,31,0.08);
        }

        .activity-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .activity-icon-sage   { background: rgba(142, 150, 128, 0.18); }
        .activity-icon-amber  { background: rgba(217, 179, 130, 0.25); }
        .activity-icon-mauve  { background: rgba(163, 124, 118, 0.18); }

        .activity-text {
            flex: 1;
        }

        .activity-desc {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark-oak);
            line-height: 1.4;
        }

        .activity-time {
            font-size: 12px;
            color: rgba(61, 43, 31, 0.45);
            margin-top: 3px;
        }

        /* ── Floating animation (sama dengan landing) ── */
        @keyframes float {
            0%   { transform: translateY(0px); }
            50%  { transform: translateY(-12px); }
            100% { transform: translateY(0px); }
        }

        .floating {
            animation: float 5s ease-in-out infinite;
        }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .welcome-section {
                flex-direction: column;
                text-align: center;
            }
            .welcome-subtitle { max-width: 100%; }
            .welcome-right { justify-content: center; }
            .bottom-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 576px) {
            nav { padding: 16px 20px; }
            .main-wrapper { padding: 32px 16px 60px; }
            .welcome-title { font-size: 36px; }
            .menu-grid { grid-template-columns: 1fr 1fr; }
            .user-greeting { display: none; }
        }
    </style>
</head>
<body>
    <!-- Background blobs — konsisten dengan landing page -->
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <!-- ══ NAVBAR ══ -->
    <nav>
        <a href="/" class="logo-container">
            <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z"
                      fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/>
                <circle cx="12" cy="13" r="4" fill="var(--vintage-cream)" />
            </svg>
            <div class="logo-text">Pintar.id</div>
        </a>

        <div class="nav-right">
            <span class="user-greeting">Hai, <span>{{ $userName }}</span> 👋</span>

            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Keluar</button>
            </form>
        </div>
    </nav>

    <!-- ══ MAIN CONTENT ══ -->
    <div class="main-wrapper">

        <!-- ── Welcome Hero Section ── -->
        <section class="welcome-section">
            <div class="welcome-left">
                <div class="badge">Dashboard Siswa</div>
                <h1 class="welcome-title">
                    Selamat <span>Belajar</span>,<br>{{ $userName }}!
                </h1>
                <p class="welcome-subtitle">
                    Terus semangat! Setiap pelajaran yang kamu selesaikan adalah satu langkah menuju masa depan cerah.
                </p>
            </div>

            <div class="welcome-right">
                <div class="mini-stat floating" style="animation-delay: 0s;">
                    <span class="mini-stat-icon">📚</span>
                    <span class="mini-stat-number">6</span>
                    <span class="mini-stat-label">Mata Pelajaran</span>
                </div>
                <div class="mini-stat floating" style="animation-delay: 0.8s;">
                    <span class="mini-stat-icon">✅</span>
                    <span class="mini-stat-number">24</span>
                    <span class="mini-stat-label">Tugas Selesai</span>
                </div>
                <div class="mini-stat floating" style="animation-delay: 1.6s;">
                    <span class="mini-stat-icon">⭐</span>
                    <span class="mini-stat-number">4.8</span>
                    <span class="mini-stat-label">Rata-rata Nilai</span>
                </div>
            </div>
        </section>

        <!-- ── Menu Utama ── -->
        <div class="section-title">Menu Utama</div>
        <div class="section-subtitle">Akses cepat ke berbagai fitur Pintar.id</div>

        <div class="menu-grid">
            <a href="#" class="menu-card">
                <span class="menu-emoji">🏛️</span>
                <div class="menu-name">Info Univ & PTN</div>
                <div class="menu-desc">Eksplorasi kampus impianmu</div>
            </a>

            <a href="#" class="menu-card">
                <span class="menu-emoji">👤</span>
                <div class="menu-name">Profile</div>
                <div class="menu-desc">Kelola akun & data diri</div>
            </a>

            <a href="#" class="menu-card">
                <span class="menu-emoji">🎯</span>
                <div class="menu-name">Rekomendasi Jurusan</div>
                <div class="menu-desc">Berdasarkan nilai tryout</div>
            </a>

            <a href="#" class="menu-card">
                <span class="menu-emoji">🔔</span>
                <div class="menu-name">Notifikasi</div>
                <div class="menu-desc">Pemberitahuan terbaru</div>
            </a>

            <a href="#" class="menu-card">
                <span class="menu-emoji">🛍️</span>
                <div class="menu-name">Beli Paket Belajar</div>
                <div class="menu-desc">Upgrade materi pelajaran</div>
            </a>

            <a href="#" class="menu-card">
                <span class="menu-emoji">💬</span>
                <div class="menu-name">Chat Sama Guru</div>
                <div class="menu-desc">Diskusi & tanya tugas</div>
            </a>
        </div>

        <!-- ── Jadwal Kelas & Aktivitas Terbaru ── -->
        <div class="bottom-grid">

            <!-- Jadwal Kelas -->
            <div class="glass-card">
                <div class="glass-card-title">
                    🗓️ Jadwal Kelas Hari Ini
                </div>

                <div class="schedule-item">
                    <span class="schedule-time">08.00</span>
                    <div class="schedule-dot" style="background: var(--muted-sage);"></div>
                    <div class="schedule-info">
                        <div class="schedule-subject">Matematika</div>
                        <div class="schedule-teacher">Bu Dewi Sartika</div>
                    </div>
                    <span class="schedule-badge badge-live">🔴 LIVE</span>
                </div>

                <div class="schedule-item">
                    <span class="schedule-time">10.00</span>
                    <div class="schedule-dot" style="background: var(--warm-amber);"></div>
                    <div class="schedule-info">
                        <div class="schedule-subject">Bahasa Indonesia</div>
                        <div class="schedule-teacher">Pak Budi Santoso</div>
                    </div>
                    <span class="schedule-badge badge-soon">⏰ Segera</span>
                </div>

                <div class="schedule-item">
                    <span class="schedule-time">13.00</span>
                    <div class="schedule-dot" style="background: var(--dusty-mauve);"></div>
                    <div class="schedule-info">
                        <div class="schedule-subject">IPA</div>
                        <div class="schedule-teacher">Bu Siti Rahayu</div>
                    </div>
                    <span class="schedule-badge badge-soon">⏰ Segera</span>
                </div>

                <div class="schedule-item">
                    <span class="schedule-time">15.00</span>
                    <div class="schedule-dot" style="background: var(--muted-sage);"></div>
                    <div class="schedule-info">
                        <div class="schedule-subject">Bahasa Inggris</div>
                        <div class="schedule-teacher">Pak Agus Wijaya</div>
                    </div>
                    <span class="schedule-badge badge-soon">⏰ Segera</span>
                </div>
            </div>

            <!-- Aktivitas Terbaru -->
            <div class="glass-card">
                <div class="glass-card-title">
                    ⚡ Aktivitas Terbaru
                </div>

                <div class="activity-item">
                    <div class="activity-icon activity-icon-sage">✅</div>
                    <div class="activity-text">
                        <div class="activity-desc">Kuis Matematika Bab 5 selesai dengan nilai <strong>92</strong></div>
                        <div class="activity-time">2 jam yang lalu</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon activity-icon-amber">📝</div>
                    <div class="activity-text">
                        <div class="activity-desc">Tugas IPA "Sistem Tata Surya" dikumpulkan</div>
                        <div class="activity-time">Kemarin, 14.30</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon activity-icon-mauve">🏆</div>
                    <div class="activity-text">
                        <div class="activity-desc">Lencana <strong>"Bintang Minggu Ini"</strong> berhasil diraih!</div>
                        <div class="activity-time">2 hari yang lalu</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon activity-icon-sage">💬</div>
                    <div class="activity-text">
                        <div class="activity-desc">Pesan baru dari Bu Dewi Sartika</div>
                        <div class="activity-time">3 hari yang lalu</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon activity-icon-amber">🎯</div>
                    <div class="activity-text">
                        <div class="activity-desc">Rekomendasi jurusan baru telah tersedia!</div>
                        <div class="activity-time">4 hari yang lalu</div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</body>
</html>

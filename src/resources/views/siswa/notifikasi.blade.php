<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - Pintar.id</title>
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
            background: var(--warm-amber);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: white; font-size: 18px;
        }

        /* ── Content Body ── */
        .content-body {
            padding: 0 48px 80px;
            max-width: 100%;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 800;
            color: var(--dark-oak);
            letter-spacing: -1px;
        }

        .mark-read {
            font-size: 14px;
            font-weight: 600;
            color: var(--muted-sage);
            cursor: pointer;
            text-decoration: none;
            transition: color 0.3s;
        }

        .mark-read:hover {
            color: var(--dark-oak);
        }

        .notification-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .notif-card {
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.85);
            border-radius: 24px;
            padding: 24px;
            display: flex;
            align-items: flex-start;
            gap: 20px;
            box-shadow: 0 8px 24px rgba(61, 43, 31, 0.04);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .notif-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(61, 43, 31, 0.08);
            background: rgba(255, 255, 255, 0.8);
        }

        .notif-card.unread::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--warm-amber);
            border-radius: 4px 0 0 4px;
        }

        .notif-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .bg-blue { background: rgba(112, 161, 255, 0.2); color: #5B8BEB; }
        .bg-amber { background: rgba(217, 179, 130, 0.2); color: #B38F60; }
        .bg-red { background: rgba(231, 76, 60, 0.2); color: #E74C3C; }
        .bg-green { background: rgba(46, 204, 113, 0.2); color: #2ECC71; }

        .notif-content {
            flex: 1;
        }

        .notif-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .notif-title {
            font-size: 16px;
            font-weight: 800;
            color: var(--dark-oak);
        }

        .notif-time {
            font-size: 12px;
            color: rgba(61, 43, 31, 0.5);
            font-weight: 600;
        }

        .notif-desc {
            font-size: 14px;
            color: rgba(61, 43, 31, 0.7);
            line-height: 1.5;
        }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); transition: 0.3s; }
            .main-wrapper { margin-left: 0; }
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
            <!-- Elemen kosong untuk mendorong user-profile ke kanan jika flex -->
            <div></div>
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
            
            <div class="page-header">
                <h1 class="page-title">Notifikasi</h1>
                <a href="#" class="mark-read">Tandai semua dibaca</a>
            </div>

            <div class="notification-list">
                @if(isset($activities) && count($activities) > 0)
                    @foreach($activities as $act)
                        @php
                            $isPurchase = (strpos(strtolower($act->description), 'membeli paket') !== false);
                        @endphp
                        @if($isPurchase)
                            <div class="notif-card unread">
                                <div class="notif-icon bg-green">🛒</div>
                                <div class="notif-content">
                                    <div class="notif-header">
                                        <div class="notif-title">Pembelian Paket Berhasil! 🎉</div>
                                        <div class="notif-time">{{ $act->created_at->diffForHumans() }}</div>
                                    </div>
                                    <div class="notif-desc">{{ $act->description }}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
                
                <!-- Pembelian Paket Belajar -->
                <div class="notif-card unread">
                    <div class="notif-icon bg-green">🛒</div>
                    <div class="notif-content">
                        <div class="notif-header">
                            <div class="notif-title">Pembelian Paket Pro Berhasil!</div>
                            <div class="notif-time">Baru saja</div>
                        </div>
                        <div class="notif-desc">Selamat! Pembayaran kamu untuk Paket Pro (1 Bulan) telah dikonfirmasi. Semua fitur premium sekarang sudah dapat kamu akses. Selamat belajar!</div>
                    </div>
                </div>

                <!-- Hasil Ujian -->
                <div class="notif-card unread">
                    <div class="notif-icon bg-blue">📝</div>
                    <div class="notif-content">
                        <div class="notif-header">
                            <div class="notif-title">Nilai Tryout UTBK #4 Keluar</div>
                            <div class="notif-time">2 jam yang lalu</div>
                        </div>
                        <div class="notif-desc">Hasil tryout UTBK terbarumu sudah bisa dilihat. Skor rata-rata kamu adalah 680. Yuk, cek detail pembahasannya untuk perbaikan di materi Matematika!</div>
                    </div>
                </div>

                <!-- Paket Belajar Habis -->
                <div class="notif-card">
                    <div class="notif-icon bg-red">⚠️</div>
                    <div class="notif-content">
                        <div class="notif-header">
                            <div class="notif-title">Paket Belajar Kamu Akan Habis!</div>
                            <div class="notif-time">Kemarin</div>
                        </div>
                        <div class="notif-desc">Paket Elite kamu akan kedaluwarsa dalam 3 hari (17 Mei 2026). Segera perpanjang paketmu agar tidak kehilangan akses konseling dengan guru!</div>
                    </div>
                </div>

                <!-- Pengumuman Umum -->
                <div class="notif-card">
                    <div class="notif-icon bg-amber">📢</div>
                    <div class="notif-content">
                        <div class="notif-header">
                            <div class="notif-title">Pendaftaran UTBK SNBT 2026 Dibuka</div>
                            <div class="notif-time">3 hari yang lalu</div>
                        </div>
                        <div class="notif-desc">Halo pejuang PTN! Pendaftaran UTBK SNBT tahun 2026 telah resmi dibuka. Pastikan kamu sudah menyiapkan seluruh berkas dan dokumen yang diperlukan ya.</div>
                    </div>
                </div>

            </div>

        </div>
    </main>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Admin - Pintar.id</title>
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
        .blob-1 { position: fixed; top: -10%; right: 10%; width: 500px; height: 500px; background: rgba(163, 124, 118, 0.15); border-radius: 50%; filter: blur(80px); z-index: 0; pointer-events: none; }
        .blob-2 { position: fixed; bottom: -10%; left: 20%; width: 400px; height: 400px; background: rgba(142, 150, 128, 0.15); border-radius: 50%; filter: blur(60px); z-index: 0; pointer-events: none; }

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
            display: flex; align-items: center; gap: 12px;
            text-decoration: none; margin-bottom: 60px;
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
            flex: 1; margin-left: var(--sidebar-width);
            height: 100vh; overflow-y: auto;
            position: relative; z-index: 5;
        }

        /* ── Topbar (Header) ── */
        .topbar {
            padding: 24px 48px; display: flex;
            justify-content: flex-end; align-items: center;
            position: sticky; top: 0; z-index: 40;
        }

        .user-profile {
            display: flex; align-items: center; gap: 16px;
            background: rgba(255,255,255,0.6); backdrop-filter: blur(12px);
            padding: 8px 10px 8px 24px; border-radius: 99px;
            border: 1px solid rgba(255,255,255,0.8);
            box-shadow: 0 4px 14px rgba(61,43,31,0.04);
            cursor: pointer; transition: transform 0.3s ease;
        }

        .user-profile:hover { transform: translateY(-2px); }

        .user-greeting { font-size: 15px; font-weight: 500; color: rgba(61,43,31,0.7); }
        .user-greeting span { font-weight: 800; color: var(--dark-oak); }

        .user-avatar {
            width: 42px; height: 42px; border-radius: 50%;
            background: var(--dusty-mauve);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: white; font-size: 18px;
        }

        /* ── Content Body ── */
        .content-body {
            padding: 0 48px 80px; max-width: 900px; margin: 0 auto; width: 100%;
        }

        .page-title {
            font-size: 32px; font-weight: 800;
            margin-bottom: 32px; color: var(--dark-oak);
        }

        /* ── Notifications ── */
        .glass-card {
            background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 32px;
            padding: 36px; box-shadow: 0 10px 30px rgba(61, 43, 31, 0.04);
        }

        .notification-item {
            display: flex; align-items: flex-start; justify-content: space-between;
            padding: 20px; border-radius: 20px;
            background: rgba(255,255,255,0.7); border: 1px solid rgba(255,255,255,0.9);
            margin-bottom: 16px; transition: all 0.3s ease;
            text-decoration: none; color: var(--dark-oak);
        }

        .notification-item:last-child { margin-bottom: 0; }
        .notification-item:hover {
            transform: translateY(-2px);
            background: #fff;
            box-shadow: 0 12px 30px rgba(61,43,31,0.06);
        }

        .notif-info { display: flex; gap: 20px; align-items: center; }

        .notif-icon {
            background: #fff3cd; color: #856404;
            width: 52px; height: 52px; border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; flex-shrink: 0;
            border: 1px solid #ffeeba;
        }

        .notif-details h4 {
            font-size: 17px; font-weight: 700; color: var(--dark-oak); margin-bottom: 6px;
        }

        .notif-details p {
            font-size: 14px; color: rgba(61,43,31,0.7); font-weight: 500; margin-bottom: 6px; line-height: 1.4;
        }

        .notif-time {
            font-size: 12px; color: rgba(61,43,31,0.5); font-weight: 600;
        }

        .notif-action {
            padding: 8px 16px; border-radius: 99px;
            background: var(--dark-oak); color: white;
            font-size: 13px; font-weight: 600; text-decoration: none;
            display: flex; align-items: center; gap: 6px;
            white-space: nowrap; transition: 0.3s;
            margin-top: 10px;
        }
        
        .notification-item:hover .notif-action {
            background: #2A1D14;
        }

        .empty-state {
            text-align: center; padding: 48px 24px;
        }
        .empty-icon { font-size: 64px; margin-bottom: 16px; opacity: 0.5; }
        .empty-text { font-size: 18px; color: rgba(61,43,31,0.5); font-weight: 600; }
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
                      fill="var(--dusty-mauve)" stroke="var(--dusty-mauve)" stroke-width="1.5" stroke-linejoin="round"/>
                <circle cx="12" cy="13" r="4" fill="var(--vintage-cream)" />
            </svg>
            <div class="logo-text">Pintar.id</div>
        </a>

        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                </span> Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </span> Kelola Pengguna
            </a>
            <a href="#" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </span> Transaksi & Income
            </a>
            <a href="#" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </span> Kelola Promo
            </a>
            <a href="#" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                </span> Paket Belajar
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
            <div style="display: flex; align-items: center;">
                <a href="{{ route('admin.notifications') }}" class="notification-icon" style="margin-right: 20px; color: var(--dark-oak); position: relative; display: flex; align-items: center; text-decoration: none;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    @if(isset($reactivationRequestsCount) && $reactivationRequestsCount > 0)
                        <span style="position: absolute; top: -5px; right: -5px; background: #ff6b6b; color: white; font-size: 10px; font-weight: 800; width: 16px; height: 16px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid #F7F4F0;">{{ $reactivationRequestsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.profile') }}" class="user-profile" style="text-decoration:none;">
                    <div class="user-greeting">Hi, <span>{{ explode(' ', $userName ?? 'Admin')[0] }}</span></div>
                    <div class="user-avatar">
                        @if(isset($photoProfile) && $photoProfile)
                            <img src="{{ asset('uploads/profiles/' . $photoProfile) }}" alt="Profile" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                        @else
                            {{ strtoupper(substr($userName ?? 'A', 0, 1)) }}
                        @endif
                    </div>
                </a>
            </div>
        </header>

        <!-- ── DASHBOARD BODY ── -->
        <div class="content-body">
            <h1 class="page-title">Notifikasi</h1>

            <div class="glass-card">
                @if($reactivationRequests->count() > 0)
                    @foreach($reactivationRequests as $request)
                        <a href="{{ route('admin.users') }}" class="notification-item">
                            <div class="notif-info">
                                <div class="notif-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                </div>
                                <div class="notif-details">
                                    <h4>Permintaan Reaktivasi Akun</h4>
                                    <p>Pengguna <strong>{{ $request->nama }}</strong> mengajukan permohonan untuk mengaktifkan kembali akunnya yang sedang dinonaktifkan.</p>
                                    <div class="notif-time">{{ $request->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            <div class="notif-action">
                                Tinjau <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div class="empty-icon">🔔</div>
                        <div class="empty-text">Belum ada notifikasi baru saat ini.</div>
                    </div>
                @endif
            </div>

        </div>
    </main>
</body>
</html>

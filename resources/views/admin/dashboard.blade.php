<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pintar.id</title>
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

        /* ── Main Wrapper ── */
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
            padding: 0 48px 80px;
            max-width: 1100px;
            margin: 0 auto;
        }

        /* ── Banner ── */
        .package-banner {
            background: linear-gradient(135deg, var(--dusty-mauve) 0%, #C4A29D 100%);
            border-radius: 32px;
            padding: 40px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 48px;
            box-shadow: 0 16px 40px rgba(163, 124, 118, 0.3);
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
            font-size: 16px; color: rgba(255,255,255,0.9); max-width: 460px; margin-bottom: 28px; line-height: 1.5;
        }

        .btn-upgrade {
            background: white; color: var(--dusty-mauve);
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

        /* ── Status Stats ── */
        .status-container {
            margin-bottom: 48px;
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }

        .stat-card {
            background: rgba(255,255,255,0.5); backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.8); border-radius: 24px;
            padding: 20px 24px; display: flex; align-items: center; gap: 16px;
            box-shadow: 0 10px 30px rgba(61,43,31,0.03);
            transition: transform 0.3s ease;
            flex: 1;
            min-width: 220px;
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
            overflow: hidden;
        }

        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .card-header-flex h2 {
            font-size: 20px;
            font-weight: 800;
            color: var(--dark-oak);
        }

        .btn-view-all {
            font-size: 14px;
            font-weight: 700;
            color: var(--muted-sage);
            text-decoration: none;
            transition: color 0.3s;
        }
        .btn-view-all:hover {
            color: var(--dark-oak);
        }

        /* ── Table Styling ── */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .custom-table th {
            padding: 16px 20px;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            color: rgba(61,43,31,0.5);
            border-bottom: 2px solid rgba(61,43,31,0.06);
            letter-spacing: 0.5px;
        }

        .custom-table td {
            padding: 20px;
            font-size: 15px;
            font-weight: 600;
            color: var(--dark-oak);
            border-bottom: 1px solid rgba(61,43,31,0.06);
            vertical-align: middle;
        }

        .custom-table tr:last-child td {
            border-bottom: none;
        }

        .custom-table tr {
            transition: background-color 0.3s;
        }

        .custom-table tr:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        /* Status Pills */
        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 99px;
            font-size: 13px;
            font-weight: 700;
        }

        .status-pill.status-aktif {
            background-color: rgba(142, 150, 128, 0.2);
            color: #555E49;
        }

        .status-pill.status-pending {
            background-color: rgba(217, 179, 130, 0.2);
            color: #967243;
        }

        /* Action Buttons */
        .action-group {
            display: flex;
            gap: 8px;
        }

        .btn-table-action {
            padding: 8px 16px;
            border-radius: 99px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-table-action.btn-action-primary {
            background: var(--dark-oak);
            color: white;
        }
        .btn-table-action.btn-action-primary:hover {
            background: #2A1D14;
            transform: translateY(-1px);
        }

        .btn-table-action.btn-action-outline {
            border-color: rgba(61,43,31,0.2);
            background: transparent;
            color: var(--dark-oak);
        }
        .btn-table-action.btn-action-outline:hover {
            background: rgba(61,43,31,0.05);
            border-color: var(--dark-oak);
            transform: translateY(-1px);
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
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                </span> Dashboard
            </a>
            <a href="{{ route('admin.pengguna.index') }}" class="sidebar-item {{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </span> Manajemen Pengguna
            </a>
            <a href="{{ route('admin.voucher.index') }}" class="sidebar-item {{ request()->routeIs('admin.voucher.*') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                </span> Manajemen Voucher
            </a>
            <a href="{{ route('admin.paket.index') }}" class="sidebar-item {{ request()->routeIs('admin.paket.*') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                </span> Manajemen Paket
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
            <div class="user-profile">
                <div class="user-greeting">Hi, <span>{{ explode(' ', $userName ?? 'Admin')[0] }}</span></div>
                <div class="user-avatar">
                    @if(isset($photoProfile) && $photoProfile)
                        <img src="{{ asset('uploads/profiles/' . $photoProfile) }}" alt="Profile" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                    @else
                        {{ strtoupper(substr($userName ?? 'A', 0, 1)) }}
                    @endif
                </div>
            </div>
        </header>

        <!-- ── DASHBOARD BODY ── -->
        <div class="content-body">

            <!-- BANNER ADMIN -->
            <div class="package-banner">
                <div class="package-left">
                    <h2>Kelola Lembaga<br>Dengan Mudah</h2>
                    <p>Pantau pendaftaran baru, awasi tutor dan siswa aktif, serta tinjau performa bimbingan belajar harian dalam satu dasbor terpadu.</p>
                    <a href="#" class="btn-upgrade">Manajemen Pengguna ⚙️</a>
                </div>
                <div class="package-illustration">💼</div>
            </div>

            <!-- STATUS STATS -->
            <div class="status-container">
                <div class="stat-card">
                    <div class="stat-icon bg-amber">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $stats['total_siswa'] }}</h3>
                        <p>Siswa Aktif</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-sage">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $stats['total_tutor'] }}</h3>
                        <p>Total Tutor</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-blue">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $stats['kelas_hari_ini'] }}</h3>
                        <p>Total Kelas</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-mauve">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                    </div>
                    <div class="stat-info">
                        <h3 style="font-size: 20px;">Rp {{ $stats['pendapatan'] }}</h3>
                        <p>Pendapatan</p>
                    </div>
                </div>
            </div>

            <!-- PENDAFTARAN SISWA TERBARU -->
            <h2 class="section-title">Pendaftaran Siswa Terbaru</h2>
            <div class="glass-card">
                <div class="card-header-flex">
                    <h2>Daftar Pendaftar Terkini</h2>
                    <a href="#" class="btn-view-all">Lihat Semua Siswa →</a>
                </div>

                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Kelas Pilihan</th>
                                <th>Status Akun</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa_terbaru as $siswa)
                            <tr>
                                <td>{{ $siswa['nama'] }}</td>
                                <td>{{ $siswa['kelas'] }}</td>
                                <td>
                                    @if($siswa['status'] == 'Aktif')
                                        <span class="status-pill status-aktif">● Aktif</span>
                                    @else
                                        <span class="status-pill status-pending">● Pending</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <div class="action-group" style="justify-content: center;">
                                        <button class="btn-table-action btn-action-primary">Detail</button>
                                        <button class="btn-table-action btn-action-outline">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</body>
</html>


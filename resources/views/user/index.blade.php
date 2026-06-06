<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-oak:      #3D2B1F;
            --muted-sage:    #8E9680;
            --dusty-mauve:   #A37C76;
            --warm-amber:    #D9B382;
            --vintage-cream: #E6D8C1;
            --sidebar-width: 260px;
            --danger-red:     #C94A4A;
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
            text-decoration: none;
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

        .section-header {
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 20px;
        }

        .section-title { font-size: 28px; font-weight: 800; color: var(--dark-oak); }
        .section-subtitle { font-size: 15px; color: rgba(61,43,31,0.6); margin-top: 6px; }

        /* Search Form */
        .search-form {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .search-input {
            padding: 12px 20px;
            border-radius: 16px;
            border: 1px solid rgba(61,43,31,0.15);
            background: rgba(255, 255, 255, 0.6);
            color: var(--dark-oak);
            font-size: 14px;
            font-weight: 600;
            outline: none;
            width: 260px;
            transition: all 0.3s;
        }

        .search-input:focus {
            border-color: var(--dark-oak);
            background: white;
            box-shadow: 0 4px 12px rgba(61,43,31,0.05);
        }

        .btn-search {
            background: var(--dark-oak);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-search:hover {
            background: #2A1D14;
            transform: translateY(-2px);
        }

        /* Tab Filter */
        .tab-container {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .tab-item {
            padding: 10px 20px;
            border-radius: 99px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            color: rgba(61,43,31,0.6);
            background: rgba(255, 255, 255, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.6);
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tab-item:hover, .tab-item.active {
            background: var(--dark-oak);
            color: white;
            border-color: var(--dark-oak);
            box-shadow: 0 4px 12px rgba(61,43,31,0.1);
        }

        .tab-badge {
            background: rgba(61,43,31,0.1);
            color: var(--dark-oak);
            padding: 2px 8px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 800;
            transition: all 0.3s;
        }

        .tab-item.active .tab-badge, .tab-item:hover .tab-badge {
            background: rgba(255,255,255,0.2);
            color: white;
        }

        /* ── Alert Messages ── */
        .alert {
            padding: 16px 24px;
            border-radius: 20px;
            margin-bottom: 24px;
            font-size: 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
        }

        .alert-success {
            background-color: rgba(142, 150, 128, 0.2);
            color: #4A513F;
            border: 1px solid rgba(142, 150, 128, 0.4);
        }

        .alert-error {
            background-color: rgba(201, 74, 74, 0.15);
            color: #8C3030;
            border: 1px solid rgba(201, 74, 74, 0.3);
        }

        @keyframes slideIn {
            from { transform: translateY(-10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* ── Glass Card ── */
        .glass-card {
            background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 32px;
            padding: 36px; box-shadow: 0 10px 30px rgba(61, 43, 31, 0.04);
            margin-bottom: 48px;
            overflow: hidden;
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

        /* User Identity */
        .user-info-cell {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-avatar-sm {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--muted-sage);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: white;
            font-size: 16px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .user-name-text {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark-oak);
        }

        .user-role-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }
        
        .role-admin { background-color: rgba(163, 124, 118, 0.2); color: #8a655f; }
        .role-guru { background-color: rgba(142, 150, 128, 0.2); color: #6A725D; }
        .role-siswa { background-color: rgba(217, 179, 130, 0.2); color: #B38F60; }
        .role-ortu { background-color: rgba(112, 161, 255, 0.2); color: #5B8BEB; }

        /* Status Pills */
        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 99px;
            font-size: 13px;
            font-weight: 700;
            gap: 6px;
        }

        .status-pill.status-aktif {
            background-color: rgba(142, 150, 128, 0.2);
            color: #555E49;
        }

        .status-pill.status-nonaktif {
            background-color: rgba(201, 74, 74, 0.15);
            color: #8C3030;
        }

        /* Action Buttons */
        .action-group {
            display: flex;
            gap: 8px;
        }

        .btn-table-action {
            padding: 8px 18px;
            border-radius: 99px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.3s;
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

        .btn-table-action.btn-action-danger-outline {
            border-color: rgba(201, 74, 74, 0.3);
            background: transparent;
            color: var(--danger-red);
        }

        .btn-table-action.btn-action-danger-outline:hover {
            background: rgba(201, 74, 74, 0.1);
            border-color: var(--danger-red);
            transform: translateY(-1px);
        }

        .empty-state {
            text-align: center;
            padding: 48px 0;
            font-weight: 600;
            color: rgba(61,43,31,0.5);
            font-size: 16px;
        }

        /* Pagination style */
        .pagination-container {
            margin-top: 24px;
        }

        .pagination-container nav {
            display: flex;
            justify-content: center;
        }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); transition: 0.3s; }
            .main-wrapper { margin-left: 0; }
            .content-body { padding: 0 24px 60px; }
            .topbar { padding: 24px; justify-content: space-between; }
            .section-header { flex-direction: column; align-items: flex-start; }
            .search-form { width: 100%; }
            .search-input { width: 100%; }
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

        <!-- ── USER MANAGEMENT BODY ── -->
        <div class="content-body">

            <!-- FLASH ALERTS -->
            @if(session('success'))
                <div class="alert alert-success">
                    <span>✅</span>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <span>⚠️</span>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            <div class="section-header">
                <div>
                    <h2 class="section-title">Manajemen Pengguna</h2>
                    <p class="section-subtitle">Kelola status aktif/nonaktif dan hapus akun pengguna Pintar.id.</p>
                </div>
                <!-- Search bar -->
                <form action="{{ route('admin.pengguna.index') }}" method="GET" class="search-form">
                    @if($role)
                        <input type="hidden" name="role" value="{{ $role }}">
                    @endif
                    <input type="text" name="search" placeholder="Cari nama atau email..." class="search-input" value="{{ $search }}">
                    <button type="submit" class="btn-search">Cari</button>
                </form>
            </div>

            <!-- Role tabs filter -->
            <div class="tab-container">
                <a href="{{ route('admin.pengguna.index', ['search' => $search]) }}" class="tab-item {{ !$role ? 'active' : '' }}">
                    Semua <span class="tab-badge">{{ $roleCounts['semua'] }}</span>
                </a>
                <a href="{{ route('admin.pengguna.index', ['role' => 'siswa', 'search' => $search]) }}" class="tab-item {{ $role === 'siswa' ? 'active' : '' }}">
                    Siswa <span class="tab-badge">{{ $roleCounts['siswa'] }}</span>
                </a>
                <a href="{{ route('admin.pengguna.index', ['role' => 'guru', 'search' => $search]) }}" class="tab-item {{ $role === 'guru' ? 'active' : '' }}">
                    Guru <span class="tab-badge">{{ $roleCounts['guru'] }}</span>
                </a>
                <a href="{{ route('admin.pengguna.index', ['role' => 'admin', 'search' => $search]) }}" class="tab-item {{ $role === 'admin' ? 'active' : '' }}">
                    Admin <span class="tab-badge">{{ $roleCounts['admin'] }}</span>
                </a>
                <a href="{{ route('admin.pengguna.index', ['role' => 'orang tua', 'search' => $search]) }}" class="tab-item {{ $role === 'orang tua' ? 'active' : '' }}">
                    Orang Tua <span class="tab-badge">{{ $roleCounts['orang tua'] }}</span>
                </a>
            </div>

            <!-- USERS CARD -->
            <div class="glass-card">
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Nama Pengguna</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>Status</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="user-info-cell">
                                        <div class="user-avatar-sm">
                                            @if($user->photo_profile)
                                                <img src="{{ asset('uploads/profiles/' . $user->photo_profile) }}" alt="Profile" style="width:100%; height:100%; object-fit:cover;">
                                            @else
                                                {{ strtoupper(substr($user->nama, 0, 1)) }}
                                            @endif
                                        </div>
                                        <span class="user-name-text">{{ $user->nama }}</span>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role === 'admin')
                                        <span class="user-role-badge role-admin">Admin</span>
                                    @elseif($user->role === 'guru')
                                        <span class="user-role-badge role-guru">Guru</span>
                                    @elseif($user->role === 'siswa')
                                        <span class="user-role-badge role-siswa">Siswa</span>
                                    @else
                                        <span class="user-role-badge role-ortu">Orang Tua</span>
                                    @endif
                                </td>
                                <td>
                                    @if(($user->status ?? 'aktif') === 'aktif')
                                        <span class="status-pill status-aktif">● Aktif</span>
                                    @else
                                        <span class="status-pill status-nonaktif">● Nonaktif</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <div class="action-group" style="justify-content: center;">
                                        <!-- Active / Deactive Toggle -->
                                        <form action="{{ route('admin.pengguna.toggle-status', $user->id_user) }}" method="POST" 
                                              onsubmit="return confirm('{{ ($user->status ?? 'aktif') === 'nonaktif' ? 'Apakah Anda yakin ingin mengaktifkan kembali akun ini?' : 'Apakah Anda yakin ingin menonaktifkan akun ini? Pengguna tidak akan bisa login kembali.' }}')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn-table-action btn-action-outline">
                                                {{ ($user->status ?? 'aktif') === 'nonaktif' ? 'Aktifkan' : 'Nonaktifkan' }}
                                            </button>
                                        </form>

                                        <!-- Delete Account -->
                                        <form action="{{ route('admin.pengguna.destroy', $user->id_user) }}" method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini secara permanen?\nTindakan ini tidak bisa dibatalkan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-table-action btn-action-danger-outline">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">Tidak ada data pengguna ditemukan.</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination links -->
                @if($users->hasPages())
                    <div class="pagination-container">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>

        </div>
    </main>
</body>
</html>


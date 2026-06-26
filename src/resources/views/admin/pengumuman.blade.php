<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengumuman - Pintar.id</title>
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

        .page-title {
            font-size: 32px; font-weight: 800; color: var(--dark-oak);
            margin-bottom: 32px; letter-spacing: -0.5px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 32px;
            padding: 36px; box-shadow: 0 10px 30px rgba(61, 43, 31, 0.04);
            margin-bottom: 32px;
        }

        .card-subtitle {
            font-size: 20px; font-weight: 800; color: var(--dark-oak);
            margin-bottom: 24px;
        }

        /* ── Form Styles ── */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group-full {
            margin-bottom: 20px;
            grid-column: 1 / -1;
        }

        .info-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: rgba(61, 43, 31, 0.6);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .info-value, .info-select, .info-textarea {
            width: 100%;
            padding: 14px 18px;
            border-radius: 16px;
            border: 1px solid rgba(61, 43, 31, 0.1);
            background: rgba(255, 255, 255, 0.7);
            font-size: 15px;
            font-weight: 500;
            color: var(--dark-oak);
            transition: all 0.3s ease;
            outline: none;
            font-family: 'Outfit', sans-serif;
        }

        .info-value:focus, .info-select:focus, .info-textarea:focus {
            border-color: var(--dusty-mauve);
            box-shadow: 0 0 0 3px rgba(163, 124, 118, 0.15);
        }

        .info-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .info-select {
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='%233D2B1F' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
        }

        .btn-submit {
            background: var(--dark-oak);
            color: white;
            padding: 14px 32px;
            border-radius: 99px;
            font-size: 15px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(61, 43, 31, 0.15);
        }

        .btn-submit:hover {
            background: #2A1D14;
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(61, 43, 31, 0.2);
        }

        /* ── Pengumuman List ── */
        .pengumuman-item {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            padding: 20px 24px;
            border-radius: 20px;
            background: rgba(255,255,255,0.6);
            border: 1px solid rgba(255,255,255,0.8);
            margin-bottom: 16px;
            transition: all 0.3s ease;
        }

        .pengumuman-item:last-child { margin-bottom: 0; }

        .pengumuman-item:hover {
            transform: translateY(-2px);
            background: #fff;
            box-shadow: 0 8px 24px rgba(61,43,31,0.06);
        }

        .pengumuman-item.inactive {
            opacity: 0.5;
        }

        .pengumuman-left {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            flex: 1;
        }

        .pengumuman-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; flex-shrink: 0;
        }

        .tipe-info { background: rgba(91, 139, 235, 0.15); }
        .tipe-maintenance { background: rgba(217, 179, 130, 0.25); }
        .tipe-warning { background: rgba(255, 107, 107, 0.15); }

        .pengumuman-content { flex: 1; }
        .pengumuman-content h4 {
            font-size: 16px; font-weight: 800; color: var(--dark-oak);
            margin-bottom: 4px;
        }
        .pengumuman-content p {
            font-size: 14px; color: rgba(61,43,31,0.65); font-weight: 500;
            line-height: 1.5; margin-bottom: 8px;
        }

        .pengumuman-meta {
            display: flex; gap: 10px; flex-wrap: wrap; align-items: center;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-info { background: rgba(91, 139, 235, 0.15); color: #5B8BEB; }
        .badge-maintenance { background: rgba(217, 179, 130, 0.25); color: #B38F60; }
        .badge-warning { background: rgba(255, 107, 107, 0.15); color: #ff6b6b; }
        .badge-target { background: rgba(142, 150, 128, 0.2); color: #6A725D; }
        .badge-active { background: rgba(74, 103, 65, 0.15); color: #4A6741; }
        .badge-inactive { background: rgba(163, 124, 118, 0.15); color: #A37C76; }

        .pengumuman-date {
            font-size: 12px; color: rgba(61,43,31,0.45); font-weight: 600;
        }

        .pengumuman-actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex-shrink: 0;
        }

        .btn-toggle {
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-activate {
            background: rgba(74, 103, 65, 0.15);
            color: #4A6741;
        }
        .btn-activate:hover { background: rgba(74, 103, 65, 0.25); }

        .btn-deactivate {
            background: rgba(217, 179, 130, 0.25);
            color: #B38F60;
        }
        .btn-deactivate:hover { background: rgba(217, 179, 130, 0.4); }

        .btn-delete {
            padding: 8px 16px;
            border-radius: 10px;
            background-color: #ff6b6b;
            color: white;
            border: none;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-delete:hover { background-color: #ff5252; }

        .empty-state {
            text-align: center;
            padding: 48px 24px;
            color: rgba(61,43,31,0.5);
            font-weight: 600;
            font-size: 15px;
        }

        .empty-emoji {
            font-size: 48px;
            margin-bottom: 12px;
        }

        /* ── Modal ── */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(61, 43, 31, 0.4);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .modal-card {
            background: #fff;
            border-radius: 24px;
            padding: 32px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .modal-overlay.active .modal-card { transform: translateY(0); }
        .modal-icon { font-size: 48px; margin-bottom: 16px; }
        .modal-title { font-size: 20px; font-weight: 800; color: var(--dark-oak); margin-bottom: 12px; }
        .modal-desc { font-size: 15px; color: rgba(61,43,31,0.7); margin-bottom: 24px; line-height: 1.5; }
        .modal-actions { display: flex; gap: 12px; }

        .btn-cancel {
            flex: 1; padding: 12px; border-radius: 12px;
            background: #f0f0f0; color: var(--dark-oak); border: none;
            font-weight: 600; cursor: pointer; transition: background 0.2s;
        }
        .btn-cancel:hover { background: #e4e4e4; }

        .btn-confirm {
            flex: 1; padding: 12px; border-radius: 12px;
            background: #ff6b6b; color: white; border: none;
            font-weight: 600; cursor: pointer; transition: background 0.2s;
        }
        .btn-confirm:hover { background: #ff5252; }

        /* ── Alerts ── */
        .alert {
            padding: 16px 20px;
            border-radius: 16px;
            margin-bottom: 24px;
            font-weight: 600;
            display: block;
        }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .error-message { color: #ff6b6b; font-size: 12px; font-weight: 600; margin-top: 4px; display: block; }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); transition: 0.3s; }
            .main-wrapper { margin-left: 0; }
            .content-body { padding: 0 24px 60px; }
            .topbar { padding: 24px; justify-content: space-between; }
            .form-row { grid-template-columns: 1fr; }
            .pengumuman-item { flex-direction: column; }
            .pengumuman-actions { flex-direction: row; }
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
            <a href="{{ route('admin.transactions') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </span> Transaksi & Income
            </a>
            <a href="{{ route('admin.promo.index') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </span> Kelola Promo
            </a>
            <a href="{{ route('admin.paket.index') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                </span> Paket Belajar
            </a>
            <a href="{{ route('admin.pengumuman.index') }}" class="sidebar-item active">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg>
                </span> Pengumuman
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

        <!-- ── CONTENT BODY ── -->
        <div class="content-body">

            <h1 class="page-title">Kelola Pengumuman 📢</h1>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <!-- FORM BUAT PENGUMUMAN -->
            <div class="glass-card">
                <h3 class="card-subtitle">Buat Pengumuman Baru</h3>

                <form action="{{ route('admin.pengumuman.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="info-label" for="judul">Judul Pengumuman</label>
                        <input class="info-value" type="text" name="judul" id="judul" placeholder="Contoh: Jadwal Maintenance Sistem" value="{{ old('judul') }}" required>
                        @error('judul')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="info-label" for="isi">Isi Pengumuman</label>
                        <textarea class="info-textarea" name="isi" id="isi" placeholder="Tuliskan detail pengumuman di sini..." required>{{ old('isi') }}</textarea>
                        @error('isi')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="info-label" for="tipe">Tipe Pengumuman</label>
                            <select class="info-select" name="tipe" id="tipe" required>
                                <option value="info" {{ old('tipe') == 'info' ? 'selected' : '' }}>ℹ️ Informasi</option>
                                <option value="maintenance" {{ old('tipe') == 'maintenance' ? 'selected' : '' }}>🔧 Maintenance</option>
                                <option value="warning" {{ old('tipe') == 'warning' ? 'selected' : '' }}>⚠️ Peringatan</option>
                            </select>
                            @error('tipe')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-label" for="target">Target Penerima</label>
                            <select class="info-select" name="target" id="target" required>
                                <option value="semua" {{ old('target') == 'semua' ? 'selected' : '' }}>🌐 Semua Role</option>
                                <option value="guru" {{ old('target') == 'guru' ? 'selected' : '' }}>👨‍🏫 Guru</option>
                                <option value="siswa" {{ old('target') == 'siswa' ? 'selected' : '' }}>🎓 Siswa</option>
                                <option value="orang_tua" {{ old('target') == 'orang_tua' ? 'selected' : '' }}>👨‍👩‍👧 Orang Tua</option>
                            </select>
                            @error('target')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Kirim Pengumuman 🚀</button>
                </form>
            </div>

            <!-- DAFTAR PENGUMUMAN -->
            <div class="glass-card">
                <h3 class="card-subtitle">Daftar Pengumuman</h3>

                @forelse($pengumumanList as $item)
                    <div class="pengumuman-item {{ !$item->aktif ? 'inactive' : '' }}">
                        <div class="pengumuman-left">
                            <div class="pengumuman-icon tipe-{{ $item->tipe }}">
                                @if($item->tipe === 'info') ℹ️
                                @elseif($item->tipe === 'maintenance') 🔧
                                @else ⚠️
                                @endif
                            </div>
                            <div class="pengumuman-content">
                                <h4>{{ $item->judul }}</h4>
                                <p>{{ Str::limit($item->isi, 120) }}</p>
                                <div class="pengumuman-meta">
                                    <span class="badge badge-{{ $item->tipe }}">{{ ucfirst($item->tipe) }}</span>
                                    <span class="badge badge-target">
                                        @if($item->target === 'semua') 🌐 Semua
                                        @elseif($item->target === 'guru') 👨‍🏫 Guru
                                        @elseif($item->target === 'siswa') 🎓 Siswa
                                        @else 👨‍👩‍👧 Orang Tua
                                        @endif
                                    </span>
                                    <span class="badge {{ $item->aktif ? 'badge-active' : 'badge-inactive' }}">
                                        {{ $item->aktif ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                    <span class="pengumuman-date">{{ $item->created_at->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="pengumuman-actions">
                            <form action="{{ route('admin.pengumuman.toggle', $item->id_pengumuman) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn-toggle {{ $item->aktif ? 'btn-deactivate' : 'btn-activate' }}">
                                    {{ $item->aktif ? 'Non-aktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                            <button type="button" class="btn-delete" onclick="confirmDelete({{ $item->id_pengumuman }}, '{{ addslashes($item->judul) }}')">
                                Hapus
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-emoji">📭</div>
                        Belum ada pengumuman yang dibuat.
                    </div>
                @endforelse
            </div>

        </div>
    </main>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-card">
            <div class="modal-icon">⚠️</div>
            <h3 class="modal-title">Hapus Pengumuman?</h3>
            <p class="modal-desc">Anda yakin ingin menghapus pengumuman <strong id="deletePengumumanTitle"></strong>? Pengumuman ini akan dihapus permanen.</p>

            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal('deleteModal')">Batal</button>
                    <button type="submit" class="btn-confirm">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function confirmDelete(id, title) {
            document.getElementById('deletePengumumanTitle').innerText = title;
            document.getElementById('deleteForm').action = '/admin/pengumuman/' + id;
            document.getElementById('deleteModal').classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }
    </script>
</body>
</html>

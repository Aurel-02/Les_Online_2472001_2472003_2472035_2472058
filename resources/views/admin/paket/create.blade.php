<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket - Pintar.id</title>
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
            max-width: 900px;
            margin: 0 auto;
        }

        .section-header { margin-bottom: 24px; }
        .section-title { font-size: 28px; font-weight: 800; color: var(--dark-oak); }
        .section-subtitle { font-size: 15px; color: rgba(61,43,31,0.6); margin-top: 6px; }

        .glass-card {
            background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 32px;
            padding: 36px; box-shadow: 0 10px 30px rgba(61, 43, 31, 0.04);
        }

        /* ── Form Styles ── */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: var(--dark-oak);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid rgba(61,43,31,0.1);
            background: rgba(255,255,255,0.7);
            font-size: 15px;
            color: var(--dark-oak);
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--muted-sage);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(142, 150, 128, 0.1);
        }

        .btn-primary {
            background: var(--dark-oak); color: white;
            padding: 14px 28px; border-radius: 99px;
            font-weight: 700; font-size: 15px; text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.3s ease; border: none; cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .btn-primary:hover {
            background: #2A1D14; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .btn-outline {
            background: transparent; color: var(--dark-oak);
            padding: 14px 28px; border-radius: 99px;
            font-weight: 700; font-size: 15px; text-decoration: none;
            display: inline-flex; align-items: center; justify-content: center;
            border: 1px solid rgba(61,43,31,0.2); transition: all 0.3s ease;
        }
        .btn-outline:hover {
            background: rgba(61,43,31,0.05); border-color: var(--dark-oak);
        }

        .form-actions {
            display: flex; gap: 16px; margin-top: 32px;
        }

        .error-text {
            color: #d63333; font-size: 13px; font-weight: 500; margin-top: 6px;
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

        <!-- ── CONTENT BODY ── -->
        <div class="content-body">
            <div class="section-header">
                <h2 class="section-title">Tambah Paket Belajar Baru</h2>
                <p class="section-subtitle">Isi formulir di bawah ini untuk menambahkan paket belajar baru.</p>
            </div>

            <div class="glass-card">
                <form action="{{ route('admin.paket.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nama_paket" class="form-label">Nama Paket</label>
                        <input type="text" id="nama_paket" name="nama_paket" class="form-control" value="{{ old('nama_paket') }}" placeholder="Contoh: Paket Intensif UTBK" required>
                        @error('nama_paket') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenjang" class="form-label">Jenjang</label>
                        <input type="text" id="jenjang" name="jenjang" class="form-control" value="{{ old('jenjang') }}" placeholder="Contoh: SMA" required>
                        @error('jenjang') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="harga" class="form-label">Harga (Rp)</label>
                        <input type="number" id="harga" name="harga" class="form-control" value="{{ old('harga') }}" placeholder="Contoh: 150000" min="0" required>
                        @error('harga') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="masa_aktif" class="form-label">Masa Aktif (Hari)</label>
                        <input type="number" id="masa_aktif" name="masa_aktif" class="form-control" value="{{ old('masa_aktif') }}" placeholder="Contoh: 30" min="1" required>
                        @error('masa_aktif') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Simpan Paket</button>
                        <a href="{{ route('admin.paket.index') }}" class="btn-outline">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </main>
</body>
</html>


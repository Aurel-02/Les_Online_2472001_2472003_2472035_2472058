<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Belajar - Pintar.id</title>
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
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .page-title {
            font-size: 36px;
            font-weight: 800;
            color: var(--dark-oak);
            margin-bottom: 12px;
            letter-spacing: -1px;
        }

        .page-subtitle {
            font-size: 16px;
            color: rgba(61,43,31,0.7);
            max-width: 600px;
            margin: 0 auto;
        }

        .paket-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 32px;
            margin-top: 40px;
        }

        .paket-card {
            border: 3px solid;
            border-radius: 32px;
            padding: 32px 24px;
            text-align: center;
            position: relative;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
            box-shadow: 0 10px 0 rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .paket-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 16px 0 rgba(0,0,0,0.08);
        }

        .paket-badge {
            position: absolute;
            top: 20px;
            right: -30px;
            color: white;
            font-size: 13px;
            font-weight: 800;
            padding: 6px 30px;
            transform: rotate(45deg);
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .paket-icon {
            font-size: 60px;
            margin-bottom: 16px;
            filter: drop-shadow(0 10px 10px rgba(0,0,0,0.1));
        }

        .paket-name {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .paket-jenjang {
            font-size: 14px;
            font-weight: 600;
            color: rgba(61,43,31,0.6);
            margin-bottom: 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .paket-price {
            font-size: 36px;
            font-weight: 800;
            color: var(--dark-oak);
            margin-bottom: 24px;
            padding: 16px;
            background: rgba(255,255,255,0.6);
            border-radius: 20px;
            display: inline-block;
            margin-left: auto;
            margin-right: auto;
        }

        .paket-features {
            list-style: none;
            text-align: left;
            margin-bottom: 32px;
            flex: 1;
            background: rgba(255,255,255,0.4);
            padding: 20px;
            border-radius: 20px;
        }

        .paket-features li {
            margin-bottom: 12px;
            font-size: 15px;
            font-weight: 600;
            color: var(--dark-oak);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .paket-features li:last-child {
            margin-bottom: 0;
        }

        .btn-beli {
            width: 100%;
            padding: 18px;
            border-radius: 20px;
            font-size: 18px;
            font-weight: 800;
            color: white;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 6px 0 rgba(0,0,0,0.15);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-beli:hover {
            transform: translateY(2px);
            box-shadow: 0 4px 0 rgba(0,0,0,0.15);
        }

        .btn-beli:active {
            transform: translateY(6px);
            box-shadow: 0 0 0 rgba(0,0,0,0.15);
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
                <h1 class="page-title">Pilih Paket Belajar Kamu! ✨</h1>
                <p class="page-subtitle">Pilihan paket <strong>{{ $jenjangName ?? 'Semua Jenjang' }}</strong> yang bikin belajar makin asik dan anti-bosan!</p>
            </div>

            <div class="paket-cards">
                @php
                    $colors = [
                        ['bg' => '#FFDDEE', 'border' => '#FFB6D9', 'text' => '#D84B8E'], // Pink
                        ['bg' => '#DDF4FF', 'border' => '#A3E1FF', 'text' => '#3E92CC'], // Blue
                        ['bg' => '#E8DDFF', 'border' => '#C4A9FF', 'text' => '#7B52D9'], // Purple
                        ['bg' => '#FFF3DD', 'border' => '#FFDC99', 'text' => '#D99100'], // Yellow
                    ];
                @endphp

                @if(isset($paketList) && count($paketList) > 0)
                    @foreach($paketList as $index => $paket)
                        @php
                            $color = $colors[$index % count($colors)];
                            $harga = $paket->harga == 0 ? 'Gratis!' : 'Rp ' . number_format($paket->harga, 0, ',', '.');
                        @endphp
                        <div class="paket-card" style="background-color: {{ $color['bg'] }}; border-color: {{ $color['border'] }};">
                            <div class="paket-badge" style="background-color: {{ $color['text'] }};">{{ $paket->masa_aktif }} Hari</div>
                            <div class="paket-icon">🚀</div>
                            <div class="paket-name" style="color: {{ $color['text'] }};">{{ $paket->nama }}</div>
                            <div class="paket-jenjang">Khusus Anak {{ $paket->jenjang }}</div>
                            
                            <div class="paket-price">{{ $harga }}</div>
                            
                            <ul class="paket-features">
                                <li>✨ Materi belajar lengkap</li>
                                <li>✨ Latihan soal interaktif</li>
                                <li>✨ Akses kapan saja!</li>
                            </ul>
                            
                            <button class="btn-beli" style="background-color: {{ $color['text'] }};" onclick="alert('Kamu memilih {{ $paket->nama }}!')">Beli Paket</button>
                        </div>
                    @endforeach
                @else
                    <div style="text-align: center; width: 100%; padding: 50px;">
                        <h2 style="color: var(--dark-oak);">Yah, belum ada paket untuk jenjang kamu 😢</h2>
                    </div>
                @endif
            </div>

        </div>
    </main>

</body>
</html>

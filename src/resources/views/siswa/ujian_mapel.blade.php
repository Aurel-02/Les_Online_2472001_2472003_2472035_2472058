<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Mata Pelajaran Ujian - Pintar.id</title>
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
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background: #F7F4F0; color: var(--dark-oak); overflow-x: hidden; display: flex; height: 100vh; }

        /* Blobs */
        .blob-1 { position: fixed; top: -10%; right: 10%; width: 500px; height: 500px; background: rgba(142,150,128,.15); border-radius: 50%; filter: blur(80px); z-index: 0; pointer-events: none; }
        .blob-2 { position: fixed; bottom: -10%; left: 20%; width: 400px; height: 400px; background: rgba(217,179,130,.15); border-radius: 50%; filter: blur(60px); z-index: 0; pointer-events: none; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width); background: rgba(230,216,193,.85);
            backdrop-filter: blur(20px); border-right: 1px solid rgba(255,255,255,.6);
            height: 100vh; padding: 32px 24px; display: flex; flex-direction: column;
            position: fixed; left: 0; top: 0; z-index: 50;
        }
        .logo-container { display: flex; align-items: center; gap: 12px; text-decoration: none; margin-bottom: 60px; }
        .logo-text { font-size: 26px; font-weight: 800; color: var(--dark-oak); letter-spacing: -.5px; }
        .sidebar-menu { flex: 1; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; } .sidebar-menu::-webkit-scrollbar { display: none; }
        .sidebar-item {
            display: flex; align-items: center; gap: 14px; padding: 14px 18px;
            border-radius: 16px; text-decoration: none; color: rgba(61,43,31,.7);
            font-weight: 600; font-size: 15px; transition: all .3s ease;
        }
        .sidebar-item:hover, .sidebar-item.active {
            background: rgba(255,255,255,.5); color: var(--dark-oak);
            box-shadow: 0 4px 12px rgba(61,43,31,.03);
        }
        .sidebar-item-icon { font-size: 20px; }
        .logout-container { margin-top: auto; }
        .btn-logout {
            width: 100%; padding: 14px; border-radius: 99px; font-size: 15px; font-weight: 600;
            color: var(--dusty-mauve); background: rgba(163,124,118,0.08); border: none;
            cursor: pointer; transition: all .3s ease;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .btn-logout:hover { background: rgba(163,124,118,0.15); color: #8a655f; }

        /* Main */
        .main-wrapper { flex: 1; margin-left: var(--sidebar-width); height: 100vh; overflow-y: auto; position: relative; z-index: 5; }
        .topbar { padding: 24px 48px; display: flex; justify-content: flex-end; align-items: center; position: sticky; top: 0; z-index: 40; }
        .user-profile {
            display: flex; align-items: center; gap: 16px; background: rgba(255,255,255,.6);
            backdrop-filter: blur(12px); padding: 8px 10px 8px 24px; border-radius: 99px;
            border: 1px solid rgba(255,255,255,.8); box-shadow: 0 4px 14px rgba(61,43,31,.04);
            cursor: pointer; transition: transform .3s ease; text-decoration: none;
        }
        .user-profile:hover { transform: translateY(-2px); }
        .user-greeting { font-size: 15px; font-weight: 500; color: rgba(61,43,31,.7); }
        .user-greeting span { font-weight: 800; color: var(--dark-oak); }
        .user-avatar {
            width: 42px; height: 42px; border-radius: 50%; background: var(--warm-amber);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: #fff; font-size: 18px; overflow: hidden;
        }
        .content-body { padding: 0 48px 80px; max-width: 1000px; margin: 0 auto; }

        .btn-back {
            display: inline-flex; align-items: center; gap: 8px; color: rgba(61,43,31,.7); text-decoration: none; font-weight: 600; font-size: 15px; margin-bottom: 24px; transition: color .3s ease;
        }
        .btn-back:hover { color: var(--dark-oak); }

        .section-header { margin-bottom: 32px; }
        .section-title { font-size: 28px; font-weight: 800; color: var(--dark-oak); margin-bottom: 8px; }
        .section-subtitle { font-size: 16px; color: rgba(61,43,31,.6); }

        .mapel-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px; }
        
        .mapel-card {
            background: rgba(255,255,255,.6); backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,.9); border-radius: 24px; padding: 24px;
            box-shadow: 0 8px 24px rgba(61,43,31,.04); transition: all .3s ease;
            cursor: pointer; text-decoration: none; color: inherit;
            display: flex; align-items: center; gap: 16px;
        }
        .mapel-card:hover { transform: translateY(-5px); box-shadow: 0 16px 32px rgba(61,43,31,.08); background: rgba(255,255,255,.9); }
        
        .mapel-icon {
            width: 56px; height: 56px; border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; flex-shrink: 0;
        }
        
        .bg-amber { background: rgba(217, 179, 130, 0.2); color: #B38F60; }
        .bg-sage { background: rgba(142, 150, 128, 0.2); color: #6A725D; }
        .bg-mauve { background: rgba(163, 124, 118, 0.2); color: #8a655f; }
        .bg-blue { background: rgba(112, 161, 255, 0.2); color: #5B8BEB; }

        .mapel-info h3 { font-size: 18px; font-weight: 800; color: var(--dark-oak); margin-bottom: 4px; }
        .mapel-info p { font-size: 13px; color: rgba(61,43,31,.6); font-weight: 600; }

    </style>
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <aside class="sidebar">
        <a href="/" class="logo-container">
            <svg width="36" height="36" viewBox="0 0 24 24"><path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z" fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/><circle cx="12" cy="13" r="4" fill="var(--vintage-cream)"/></svg>
            <div class="logo-text">Pintar.id</div>
        </a>
        <div class="sidebar-menu">
            <a href="{{ route('siswa.home') }}" class="sidebar-item {{ request()->routeIs('siswa.home') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                </span> Dashboard
            </a>
            @if(auth()->user() && !in_array((int)auth()->user()->id_jenjang, [1, 2]))
            <a href="{{ route('siswa.ptn') }}" class="sidebar-item {{ request()->routeIs('siswa.ptn') || request()->routeIs('siswa.fakultas') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
                </span> Info Univ & PTN
            </a>
            <a href="{{ route('siswa.jurusan') }}" class="sidebar-item {{ request()->routeIs('siswa.jurusan') || request()->routeIs('siswa.jurusan.detail') ? 'active' : '' }}">
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
            <a href="{{ route('siswa.ujian') }}" class="sidebar-item {{ request()->routeIs('siswa.ujian') || request()->routeIs('siswa.ujian.*') ? 'active' : '' }}">
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

    <div class="main-wrapper">
        <header class="topbar">
            <a href="{{ route('siswa.notifikasi') }}" class="notification-bell" style="text-decoration:none; margin-right: 16px; position: relative; color: var(--dark-oak); display: flex; align-items: center; justify-content: center; width: 42px; height: 42px; border-radius: 50%; background: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.8); backdrop-filter: blur(12px); box-shadow: 0 4px 14px rgba(61,43,31,0.04); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </a>
            <a href="{{ route('siswa.profile') }}" class="user-profile">
                <div class="user-greeting">Halo, <span>{{ explode(' ', $userName ?? 'Siswa')[0] }}</span></div>
                <div class="user-avatar">
                    @if(isset($photoProfile) && $photoProfile)
                        <img src="{{ asset('storage/' . $photoProfile) }}" alt="Profile" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        {{ strtoupper(substr($userName ?? 'S', 0, 1)) }}
                    @endif
                </div>
            </a>
        </header>

        <div class="content-body">
            <a href="{{ route('siswa.ujian') }}" class="btn-back">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Kembali ke Menu Ujian
            </a>

            <div class="section-header">
                <h2 class="section-title">Pilih Mata Pelajaran ({{ strtoupper($jenis) }})</h2>
                <p class="section-subtitle">Silakan pilih mata pelajaran yang akan diujikan untuk jenjang {{ $jenjangName }}</p>
            </div>

            <div class="mapel-grid">
                @foreach($mapelList as $mapel)
                <a href="{{ route('siswa.ujian.persiapan', ['jenis' => $jenis, 'mapel' => $mapel['title']]) }}" class="mapel-card">
                    <div class="mapel-icon {{ $mapel['color'] }}">{{ $mapel['icon'] }}</div>
                    <div class="mapel-info">
                        <h3>{{ $mapel['title'] }}</h3>
                        <p>{{ $mapel['subtitle'] }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>

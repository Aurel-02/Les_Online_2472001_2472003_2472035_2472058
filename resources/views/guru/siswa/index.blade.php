<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa - Pintar.id</title>
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
        body { background-color: #F7F4F0; color: var(--dark-oak); overflow-x: hidden; display: flex; height: 100vh; }

        .blob-1 { position: fixed; top: -10%; right: 10%; width: 500px; height: 500px; background: rgba(142, 150, 128, 0.15); border-radius: 50%; filter: blur(80px); z-index: 0; pointer-events: none; }
        .blob-2 { position: fixed; bottom: -10%; left: 20%; width: 400px; height: 400px; background: rgba(217, 179, 130, 0.15); border-radius: 50%; filter: blur(60px); z-index: 0; pointer-events: none; }

        .sidebar { width: var(--sidebar-width); background: rgba(230, 216, 193, 0.85); backdrop-filter: blur(20px); border-right: 1px solid rgba(255,255,255,0.6); height: 100vh; padding: 32px 24px; display: flex; flex-direction: column; position: fixed; left: 0; top: 0; z-index: 50; }
        .logo-container { display: flex; align-items: center; gap: 12px; text-decoration: none; margin-bottom: 60px; }
        .logo-text { font-size: 26px; font-weight: 800; color: var(--dark-oak); letter-spacing: -0.5px; }
        .sidebar-menu { flex: 1; display: flex; flex-direction: column; gap: 8px; }
        .sidebar-item { display: flex; align-items: center; gap: 14px; padding: 14px 18px; border-radius: 16px; text-decoration: none; color: rgba(61,43,31,0.7); font-weight: 600; font-size: 15px; transition: all 0.3s ease; }
        .sidebar-item:hover, .sidebar-item.active { background: rgba(255,255,255,0.5); color: var(--dark-oak); box-shadow: 0 4px 12px rgba(61,43,31,0.03); }
        .sidebar-item-icon { font-size: 20px; }
        .logout-container { margin-top: auto; }
        .btn-logout { width: 100%; padding: 14px; border-radius: 16px; font-size: 15px; font-weight: 600; color: var(--dusty-mauve); background: rgba(163, 124, 118, 0.1); border: none; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .btn-logout:hover { background: rgba(163, 124, 118, 0.2); color: #8a655f; }

        .main-wrapper { flex: 1; margin-left: var(--sidebar-width); height: 100vh; overflow-y: auto; position: relative; z-index: 5; }
        .topbar { padding: 24px 48px; display: flex; justify-content: flex-end; align-items: center; position: sticky; top: 0; z-index: 40; }
        .user-profile { display: flex; align-items: center; gap: 16px; background: rgba(255,255,255,0.6); backdrop-filter: blur(12px); padding: 8px 10px 8px 24px; border-radius: 99px; border: 1px solid rgba(255,255,255,0.8); box-shadow: 0 4px 14px rgba(61,43,31,0.04); cursor: pointer; text-decoration: none; transition: transform 0.3s ease; }
        .user-profile:hover { transform: translateY(-2px); }
        .user-greeting { font-size: 15px; font-weight: 500; color: rgba(61,43,31,0.7); }
        .user-greeting span { font-weight: 800; color: var(--dark-oak); }
        .user-avatar { width: 42px; height: 42px; border-radius: 50%; background: var(--muted-sage); display: flex; align-items: center; justify-content: center; font-weight: 800; color: white; font-size: 18px; }

        .content-body { padding: 0 48px 80px; max-width: 1100px; margin: 0 auto; }
        
        .section-header { margin-bottom: 24px; }
        .section-title { font-size: 28px; font-weight: 800; color: var(--dark-oak); }
        .section-subtitle { font-size: 15px; color: rgba(61,43,31,0.6); margin-top: 6px; }

        .glass-card { background: rgba(255, 255, 255, 0.5); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 24px; padding: 32px; box-shadow: 0 10px 30px rgba(61, 43, 31, 0.04); margin-bottom: 32px; }

        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 16px; text-align: left; border-bottom: 1px solid rgba(61,43,31,0.06); }
        th { font-weight: 700; color: var(--dark-oak); font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; }
        td { font-size: 15px; color: rgba(61,43,31,0.8); font-weight: 500; }
        tr:last-child td { border-bottom: none; }
        
        .user-cell { display: flex; align-items: center; gap: 12px; }
        .user-avatar-sm { width: 36px; height: 36px; border-radius: 50%; background: rgba(142, 150, 128, 0.2); color: #6A725D; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; flex-shrink: 0; overflow: hidden; }
        .user-name { font-weight: 700; color: var(--dark-oak); }

        .badge { padding: 6px 12px; border-radius: 99px; font-size: 12px; font-weight: 700; display: inline-block; }
        .badge-role { background: rgba(217, 179, 130, 0.2); color: #B38F60; }

        .empty-state { text-align: center; padding: 40px 0; color: rgba(61,43,31,0.5); font-weight: 500; }
    </style>
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <aside class="sidebar">
        <!-- Sidebar content same as index -->
        <a href="/" class="logo-container">
            <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z" fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/>
                <circle cx="12" cy="13" r="4" fill="var(--vintage-cream)" />
            </svg>
            <div class="logo-text">Pintar.id</div>
        </a>

        <div class="sidebar-menu">
            <a href="{{ route('guru.dashboard') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                </span> Dashboard
            </a>
            <a href="{{ route('guru.siswa.index') }}" class="sidebar-item active">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </span> Kelas & Siswa
            </a>
            <a href="{{ route('guru.materi.index') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </span> Materi & Tugas
            </a>
        </div>

        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout"><span>🚪</span> Keluar Akun</button>
            </form>
        </div>
    </aside>

    <main class="main-wrapper">
        <header class="topbar">
            <div></div>
            <a href="{{ route('guru.profile') }}" class="user-profile">
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

        <div class="content-body">
            <div class="section-header">
                <h2 class="section-title">Daftar Siswa Terdaftar</h2>
                <p class="section-subtitle">Menampilkan seluruh siswa yang terdaftar di sistem Pintar.id.</p>
            </div>

            <div class="glass-card">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>Bergabung Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($siswaList as $siswa)
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-sm">
                                            @if($siswa->photo_profile)
                                                <img src="{{ asset('uploads/profiles/' . $siswa->photo_profile) }}" alt="Profile" style="width:100%; height:100%; object-fit:cover;">
                                            @else
                                                {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                                            @endif
                                        </div>
                                        <span class="user-name">{{ $siswa->nama }}</span>
                                    </div>
                                </td>
                                <td>{{ $siswa->email }}</td>
                                <td><span class="badge badge-role">{{ ucfirst($siswa->role) }}</span></td>
                                <td>{{ $siswa->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">Belum ada data siswa di sistem.</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

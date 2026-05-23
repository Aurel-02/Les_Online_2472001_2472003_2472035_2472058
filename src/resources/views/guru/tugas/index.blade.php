<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tugas - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    <style>
        :root { --dark-oak:#3D2B1F; --muted-sage:#8E9680; --dusty-mauve:#A37C76; --warm-amber:#D9B382; --vintage-cream:#E6D8C1; --sidebar-width:260px; }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; }
        body { background-color:#F7F4F0; color:var(--dark-oak); overflow-x:hidden; display:flex; height:100vh; }
        .blob-1 { position:fixed; top:-10%; right:10%; width:500px; height:500px; background:rgba(142,150,128,0.15); border-radius:50%; filter:blur(80px); z-index:0; pointer-events:none; }
        .blob-2 { position:fixed; bottom:-10%; left:20%; width:400px; height:400px; background:rgba(217,179,130,0.15); border-radius:50%; filter:blur(60px); z-index:0; pointer-events:none; }
        .sidebar { width:var(--sidebar-width); background:rgba(230,216,193,0.85); backdrop-filter:blur(20px); border-right:1px solid rgba(255,255,255,0.6); height:100vh; padding:32px 24px; display:flex; flex-direction:column; position:fixed; left:0; top:0; z-index:50; }
        .logo-container { display:flex; align-items:center; gap:12px; text-decoration:none; margin-bottom:60px; }
        .logo-text { font-size:26px; font-weight:800; color:var(--dark-oak); letter-spacing:-0.5px; }
        .sidebar-menu { flex:1; display:flex; flex-direction:column; gap:8px; }
        .sidebar-item { display:flex; align-items:center; gap:14px; padding:14px 18px; border-radius:16px; text-decoration:none; color:rgba(61,43,31,0.7); font-weight:600; font-size:15px; transition:all 0.3s ease; }
        .sidebar-item:hover, .sidebar-item.active { background:rgba(255,255,255,0.5); color:var(--dark-oak); box-shadow:0 4px 12px rgba(61,43,31,0.03); }
        .sidebar-item-icon { font-size:20px; flex-shrink:0; }
        .logout-container { margin-top:auto; }
        .btn-logout { width:100%; padding:14px; border-radius:16px; font-size:15px; font-weight:600; color:var(--dusty-mauve); background:rgba(163,124,118,0.1); border:none; cursor:pointer; transition:all 0.3s ease; display:flex; align-items:center; justify-content:center; gap:10px; }
        .btn-logout:hover { background:rgba(163,124,118,0.2); }
        .main-wrapper { flex:1; margin-left:var(--sidebar-width); height:100vh; overflow-y:auto; position:relative; z-index:5; }
        .topbar { padding:24px 48px; display:flex; justify-content:flex-end; align-items:center; position:sticky; top:0; z-index:40; }
        .user-profile { display:flex; align-items:center; gap:16px; background:rgba(255,255,255,0.6); backdrop-filter:blur(12px); padding:8px 10px 8px 24px; border-radius:99px; border:1px solid rgba(255,255,255,0.8); box-shadow:0 4px 14px rgba(61,43,31,0.04); text-decoration:none; transition:transform 0.3s ease; }
        .user-profile:hover { transform:translateY(-2px); }
        .user-greeting { font-size:15px; font-weight:500; color:rgba(61,43,31,0.7); }
        .user-greeting span { font-weight:800; color:var(--dark-oak); }
        .user-avatar { width:42px; height:42px; border-radius:50%; background:var(--muted-sage); display:flex; align-items:center; justify-content:center; font-weight:800; color:white; font-size:18px; overflow:hidden; }
        .content-body { padding:0 48px 80px; max-width:1100px; margin:0 auto; }
        .section-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; flex-wrap:wrap; gap:12px; }
        .section-title { font-size:28px; font-weight:800; color:var(--dark-oak); }
        .btn-primary { background:var(--dusty-mauve); color:white; padding:12px 24px; border-radius:99px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all 0.3s ease; border:none; cursor:pointer; font-size:15px; }
        .btn-primary:hover { background:#8a655f; transform:translateY(-2px); box-shadow:0 4px 12px rgba(163,124,118,0.3); }
        .glass-card { background:rgba(255,255,255,0.5); backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,0.8); border-radius:24px; padding:32px; box-shadow:0 10px 30px rgba(61,43,31,0.04); margin-bottom:32px; }
        .table-responsive { overflow-x:auto; }
        table { width:100%; border-collapse:collapse; }
        th, td { padding:16px; text-align:left; border-bottom:1px solid rgba(61,43,31,0.06); }
        th { font-weight:700; color:var(--dark-oak); font-size:13px; text-transform:uppercase; letter-spacing:0.5px; }
        td { font-size:15px; color:rgba(61,43,31,0.8); font-weight:500; }
        tr:last-child td { border-bottom:none; }
        tr:hover td { background:rgba(255,255,255,0.4); }
        .badge { padding:5px 12px; border-radius:99px; font-size:12px; font-weight:700; display:inline-block; }
        .badge-soon { background:rgba(217,83,79,0.15); color:#c0392b; }
        .badge-ok   { background:rgba(92,184,92,0.15); color:#27ae60; }
        .badge-past { background:rgba(61,43,31,0.1); color:rgba(61,43,31,0.5); }
        .action-btns { display:flex; gap:8px; flex-wrap:wrap; }
        .btn-sm { padding:6px 14px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:4px; }
        .btn-edit { background:rgba(217,179,130,0.2); color:#B38F60; }
        .btn-edit:hover { background:rgba(217,179,130,0.4); }
        .btn-delete { background:rgba(163,124,118,0.2); color:#8a655f; border:none; cursor:pointer; font-family:'Outfit'; }
        .btn-delete:hover { background:rgba(163,124,118,0.4); }
        .btn-file { background:rgba(142,150,128,0.2); color:#6A725D; }
        .btn-file:hover { background:rgba(142,150,128,0.4); }
        .alert-success { background:rgba(142,150,128,0.2); color:#6A725D; padding:16px; border-radius:12px; margin-bottom:24px; font-weight:600; border:1px solid rgba(142,150,128,0.3); }
        .empty-state { text-align:center; padding:48px 0; color:rgba(61,43,31,0.4); font-weight:500; font-size:16px; }
        .empty-state .empty-icon { font-size:48px; display:block; margin-bottom:12px; }
        @media(max-width:992px) { .sidebar{transform:translateX(-100%);} .main-wrapper{margin-left:0;} .content-body{padding:0 24px 60px;} .topbar{padding:24px;} }
    </style>
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <aside class="sidebar">
        <a href="/" class="logo-container">
            <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z" fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/>
                <circle cx="12" cy="13" r="4" fill="var(--vintage-cream)" />
            </svg>
            <div class="logo-text">Pintar.id</div>
        </a>
        <div class="sidebar-menu">
            <a href="{{ route('guru.dashboard') }}" class="sidebar-item">
                <span class="sidebar-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg></span>
                Dashboard
            </a>
            <a href="{{ route('guru.jadwal.index') }}" class="sidebar-item">
                <span class="sidebar-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
                Jadwal Mengajar
            </a>
            <a href="{{ route('guru.siswa.index') }}" class="sidebar-item">
                <span class="sidebar-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></span>
                Kelas &amp; Siswa
            </a>
            <a href="{{ route('guru.materi.index') }}" class="sidebar-item">
                <span class="sidebar-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg></span>
                Materi Belajar
            </a>
            <a href="{{ route('guru.tugas.index') }}" class="sidebar-item active">
                <span class="sidebar-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></span>
                Tugas
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
                        <img src="{{ asset('uploads/profiles/' . $photoProfile) }}" alt="Profile" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        {{ strtoupper(substr($userName ?? 'G', 0, 1)) }}
                    @endif
                </div>
            </a>
        </header>

        <div class="content-body">
            @if(session('success'))
                <div class="alert-success">✅ {{ session('success') }}</div>
            @endif

            <div class="section-header">
                <h2 class="section-title">Kelola Tugas</h2>
                <a href="{{ route('guru.tugas.create') }}" class="btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Buat Tugas
                </a>
            </div>

            <div class="glass-card">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Judul Tugas</th>
                                <th>Mapel</th>
                                <th>Kelas</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>File</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tugasList as $t)
                            @php
                                $now = now();
                                $dl  = $t->deadline;
                                if ($dl < $now) {
                                    $statusLabel = 'Lewat';
                                    $statusClass = 'badge-past';
                                } elseif ($dl->diffInDays($now) <= 3) {
                                    $statusLabel = 'Segera';
                                    $statusClass = 'badge-soon';
                                } else {
                                    $statusLabel = 'Aktif';
                                    $statusClass = 'badge-ok';
                                }
                            @endphp
                            <tr>
                                <td>
                                    <strong>{{ $t->judul }}</strong>
                                    @if($t->deskripsi)
                                        <br><small style="color:rgba(61,43,31,0.5);font-weight:400;">{{ Str::limit($t->deskripsi, 50) }}</small>
                                    @endif
                                </td>
                                <td>{{ $t->mapel }}</td>
                                <td>{{ $t->kelas }}</td>
                                <td>
                                    <strong>{{ $t->deadline->format('d M Y') }}</strong>
                                    <br><small style="color:rgba(61,43,31,0.5);">{{ $t->deadline->format('H:i') }} WIB</small>
                                </td>
                                <td><span class="badge {{ $statusClass }}">{{ $statusLabel }}</span></td>
                                <td>
                                    @if($t->file_tugas)
                                        <a href="{{ asset('storage/' . $t->file_tugas) }}" target="_blank" class="btn-sm btn-file">📎 Unduh</a>
                                    @else
                                        <span style="color:rgba(61,43,31,0.4);">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <a href="{{ route('guru.tugas.edit', $t->id_tugas) }}" class="btn-sm btn-edit">✏️ Edit</a>
                                        <form action="{{ route('guru.tugas.destroy', $t->id_tugas) }}" method="POST" onsubmit="return confirm('Hapus tugas ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-delete">🗑 Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <span class="empty-icon">📝</span>
                                        Belum ada tugas. Klik <strong>"Buat Tugas"</strong> untuk mulai.
                                    </div>
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

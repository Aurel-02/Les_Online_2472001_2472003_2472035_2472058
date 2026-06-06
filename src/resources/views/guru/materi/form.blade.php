<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($materi) ? 'Edit' : 'Tambah' }} Materi - Pintar.id</title>
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
        .btn-logout:hover { background:rgba(163,124,118,0.2); color:#8a655f; }
        .main-wrapper { flex:1; margin-left:var(--sidebar-width); height:100vh; overflow-y:auto; position:relative; z-index:5; }
        .topbar { padding:24px 48px; display:flex; justify-content:flex-end; align-items:center; position:sticky; top:0; z-index:40; }
        .user-profile { display:flex; align-items:center; gap:16px; background:rgba(255,255,255,0.6); backdrop-filter:blur(12px); padding:8px 10px 8px 24px; border-radius:99px; border:1px solid rgba(255,255,255,0.8); box-shadow:0 4px 14px rgba(61,43,31,0.04); cursor:pointer; text-decoration:none; transition:transform 0.3s ease; }
        .user-profile:hover { transform:translateY(-2px); }
        .user-greeting { font-size:15px; font-weight:500; color:rgba(61,43,31,0.7); }
        .user-greeting span { font-weight:800; color:var(--dark-oak); }
        .user-avatar { width:42px; height:42px; border-radius:50%; background:var(--muted-sage); display:flex; align-items:center; justify-content:center; font-weight:800; color:white; font-size:18px; overflow:hidden; }
        .content-body { padding:0 48px 80px; max-width:800px; margin:0 auto; }
        .section-title { font-size:28px; font-weight:800; color:var(--dark-oak); margin-bottom:24px; }
        .glass-card { background:rgba(255,255,255,0.6); backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,0.8); border-radius:24px; padding:40px; box-shadow:0 10px 30px rgba(61,43,31,0.04); }
        .form-group { margin-bottom:20px; }
        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px; }
        .form-label { display:block; font-weight:600; margin-bottom:8px; color:var(--dark-oak); font-size:14px; }
        .form-label span { color:var(--dusty-mauve); }
        .form-control { width:100%; padding:14px 18px; border-radius:12px; border:1px solid rgba(61,43,31,0.2); background:rgba(255,255,255,0.8); font-family:'Outfit'; font-size:15px; transition:all 0.3s ease; outline:none; color:var(--dark-oak); }
        .form-control:focus { border-color:var(--muted-sage); box-shadow:0 0 0 3px rgba(142,150,128,0.2); }
        textarea.form-control { resize:vertical; min-height:120px; }
        .file-hint { font-size:12px; color:rgba(61,43,31,0.5); margin-top:6px; font-weight:500; }
        .current-file { display:inline-flex; align-items:center; gap:6px; background:rgba(142,150,128,0.15); padding:6px 12px; border-radius:8px; font-size:13px; font-weight:600; color:#6A725D; margin-top:8px; text-decoration:none; }
        .btn-submit { background:var(--muted-sage); color:white; padding:14px 28px; border-radius:12px; font-weight:600; font-size:16px; border:none; cursor:pointer; transition:all 0.3s ease; width:100%; margin-top:10px; }
        .btn-submit:hover { background:#7b846e; transform:translateY(-2px); box-shadow:0 4px 14px rgba(142,150,128,0.3); }
        .btn-back { display:inline-flex; align-items:center; gap:8px; text-decoration:none; color:rgba(61,43,31,0.6); font-weight:600; margin-bottom:24px; transition:color 0.3s ease; }
        .btn-back:hover { color:var(--dark-oak); }
        .error-message { color:var(--dusty-mauve); font-size:13px; font-weight:600; margin-top:6px; }
        @media(max-width:768px) { .form-row { grid-template-columns:1fr; } }
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
<<<<<<< HEAD
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
            <a href="{{ route('guru.materi.index') }}" class="sidebar-item active">
                <span class="sidebar-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg></span>
                Materi Belajar
            </a>
            <a href="{{ route('guru.tugas.index') }}" class="sidebar-item">
                <span class="sidebar-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></span>
                Tugas
=======
            <a href="{{ route('guru.dashboard') }}" class="sidebar-item {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                </span> Dashboard
            </a>
            <a href="{{ route('guru.siswa.index') }}" class="sidebar-item {{ request()->routeIs('guru.siswa.*') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </span> Siswa
            </a>
            <a href="{{ route('guru.materi.index') }}" class="sidebar-item {{ request()->routeIs('guru.materi.*') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                </span> Materi Belajar
            </a>
            <a href="{{ route('guru.chat') }}" class="sidebar-item {{ request()->routeIs('guru.chat') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                </span> Chat
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
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
            <a href="{{ route('guru.materi.index') }}" class="btn-back">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Kembali ke Daftar Materi
            </a>

            <h2 class="section-title">{{ isset($materi) ? 'Edit Materi' : 'Tambah Materi Baru' }}</h2>

            <div class="glass-card">
                <form action="{{ isset($materi) ? route('guru.materi.update', $materi->id_materi) : route('guru.materi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($materi)) @method('PUT') @endif

                    <div class="form-group">
                        <label class="form-label" for="judul">Judul Materi <span>*</span></label>
                        <input type="text" id="judul" name="judul" class="form-control" value="{{ old('judul', $materi->judul ?? '') }}" required placeholder="Contoh: Pengantar Aljabar">
                        @error('judul') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-row">
                        <div>
                            <label class="form-label" for="jenjang">Jenjang <span>*</span></label>
                            <select id="jenjang" name="jenjang" class="form-control" required>
                                <option value="" disabled {{ !isset($materi) ? 'selected' : '' }}>Pilih Jenjang...</option>
                                <option value="SD"  {{ old('jenjang', $materi->jenjang ?? '') == 'SD'  ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('jenjang', $materi->jenjang ?? '') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ old('jenjang', $materi->jenjang ?? '') == 'SMA' ? 'selected' : '' }}>SMA</option>
                            </select>
                            @error('jenjang') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="form-label" for="mapel">Mata Pelajaran</label>
                            <input type="text" id="mapel" name="mapel" class="form-control" value="{{ old('mapel', $materi->mapel ?? '') }}" placeholder="Contoh: Matematika">
                            @error('mapel') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="kelas">Kelas</label>
                        <input type="text" id="kelas" name="kelas" class="form-control" value="{{ old('kelas', $materi->kelas ?? '') }}" placeholder="Contoh: X IPA 1, VII A">
                        @error('kelas') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="deskripsi">Deskripsi Singkat</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control" placeholder="Jelaskan secara singkat tentang materi ini...">{{ old('deskripsi', $materi->deskripsi ?? '') }}</textarea>
                        @error('deskripsi') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="link_video">Link Video (Opsional)</label>
                        <input type="url" id="link_video" name="link_video" class="form-control" value="{{ old('link_video', $materi->link_video ?? '') }}" placeholder="https://youtube.com/...">
                        @error('link_video') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="file_materi">Upload File Materi (Opsional)</label>
                        <input type="file" id="file_materi" name="file_materi" class="form-control" accept=".pdf,.doc,.docx,.ppt,.pptx">
                        <div class="file-hint">Format: PDF, DOC, DOCX, PPT, PPTX. Maks 10MB.</div>
                        @if(isset($materi) && $materi->file_materi)
                            <a href="{{ asset('storage/' . $materi->file_materi) }}" target="_blank" class="current-file">📎 File saat ini (klik untuk lihat)</a>
                        @endif
                        @error('file_materi') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn-submit">{{ isset($materi) ? '💾 Simpan Perubahan' : '➕ Tambahkan Materi' }}</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>

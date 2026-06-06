<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --dark-oak:      #3D2B1F;
            --muted-sage:    #8E9680;
            --dusty-mauve:   #A37C76;
            --warm-amber:    #D9B382;
            --vintage-cream: #E6D8C1;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; }
        body { background-color:var(--vintage-cream); color:var(--dark-oak); min-height:100vh; display:flex; flex-direction:column; overflow-x:hidden; }

        .blur-blob-1 { position:fixed; top:-10%; right:-5%; width:500px; height:500px; background:radial-gradient(circle, rgba(142,150,128,0.2) 0%, rgba(255,255,255,0) 70%); z-index:-1; }
        .blur-blob-2 { position:fixed; bottom:-10%; left:-5%; width:600px; height:600px; background:radial-gradient(circle, rgba(217,179,130,0.2) 0%, rgba(255,255,255,0) 70%); z-index:-1; }

        .app-container {
            flex:1;
            max-width:800px;
            margin:0 auto;
            width:100%;
            padding:24px 40px;
            display:flex;
            flex-direction:column;
            gap:30px;
        }

        .top-header {
            display:flex; justify-content:space-between; align-items:center;
            background:rgba(255,255,255,0.4); backdrop-filter:blur(16px);
            border:1px solid rgba(255,255,255,0.6); border-radius:100px;
            padding:12px 24px; box-shadow:0 8px 32px rgba(61,43,31,0.05);
        }
        .brand { font-size:24px; font-weight:800; color:var(--dark-oak); text-decoration:none; letter-spacing:-0.5px; }
        .center-nav { display:flex; gap:8px; }
        .nav-pill { padding:8px 20px; border-radius:30px; text-decoration:none; color:rgba(61,43,31,0.6); font-size:14px; font-weight:600; transition:all 0.25s; }
        .nav-pill:hover { background:rgba(61,43,31,0.05); color:var(--dark-oak); }
        .nav-pill.active { background:var(--dark-oak); color:var(--vintage-cream); }

        .right-nav { display:flex; gap:12px; align-items:center; }
        .user-profile { display:flex; align-items:center; gap:12px; background:rgba(255,255,255,0.5); padding:6px 6px 6px 16px; border-radius:30px; border:1px solid rgba(255,255,255,0.5); cursor:pointer; text-decoration:none; color:inherit; }
        .user-profile:hover { background:rgba(255,255,255,0.8); }
        .user-greeting { font-size:14px; font-weight:600; color:rgba(61,43,31,0.6); }
        .user-greeting span { color:var(--dark-oak); font-weight:800; }
        .user-avatar { width:36px; height:36px; border-radius:50%; background:var(--muted-sage); color:#fff; display:flex; align-items:center; justify-content:center; font-size:16px; font-weight:800; overflow:hidden;}
        .user-avatar img { width:100%; height:100%; object-fit:cover; }

        .profile-card {
            background:rgba(255,255,255,0.4);
            backdrop-filter:blur(24px);
            border:1px solid rgba(255,255,255,0.6);
            border-radius:32px;
            padding:40px;
            display:flex;
            flex-direction:column;
            align-items:center;
            box-shadow:0 12px 40px rgba(61,43,31,0.08);
            width: 100%;
        }

        .page-title { font-size: 28px; font-weight: 800; color: var(--dark-oak); margin-bottom: 24px; text-align: center; }

        .info-grid {
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 100%;
            margin-bottom: 32px;
        }

        .info-item {
            background: rgba(255,255,255,0.5);
            padding: 16px 24px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.6);
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .info-label { font-size: 12px; font-weight: 700; color: rgba(61,43,31,0.5); text-transform: uppercase; margin-bottom: 4px; display:block; }
        .info-value { width: 100%; padding: 10px 14px; border-radius: 12px; border: 1px solid rgba(61,43,31,0.1); background: rgba(255,255,255,0.6); font-family: 'Outfit', sans-serif; font-size: 15px; color: var(--dark-oak); outline: none; transition: border 0.2s; }
        .info-value:focus { border-color: var(--muted-sage); background: rgba(255,255,255,0.9); }

        .form-actions { display: flex; gap: 12px; width: 100%; margin-top: 10px; }
        .btn-save { flex: 1; background: var(--dark-oak); color: #fff; border: none; padding: 12px; border-radius: 30px; font-size: 14px; font-weight: 700; cursor: pointer; transition: all 0.3s; font-family: 'Outfit', sans-serif; }
        .btn-save:hover { background: #2c1e15; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(61,43,31,0.2); }
        .btn-cancel { flex: 1; background: transparent; color: var(--dusty-mauve); border: 1.5px solid var(--dusty-mauve); padding: 12px; border-radius: 30px; font-size: 14px; font-weight: 700; cursor: pointer; transition: all 0.3s; font-family: 'Outfit', sans-serif; text-align: center; text-decoration: none; }
        .btn-cancel:hover { background: var(--dusty-mauve); color: #fff; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(163,124,118,0.2); }

        .alert-error { background: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 12px; margin-bottom: 20px; width: 100%; font-size: 14px; font-weight: 600; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="blur-blob-1"></div>
    <div class="blur-blob-2"></div>

    <div class="app-container">
        <header class="top-header">
            <a href="{{ route('siswa.home') }}" class="brand">Pintar.id</a>
            <div class="center-nav">
                <a href="{{ route('siswa.home') }}" class="nav-pill">Beranda</a>
                <a href="{{ route('siswa.profile') }}" class="nav-pill active">Profil</a>
            </div>
            <div class="right-nav">
<<<<<<< HEAD
=======
            <a href="{{ route('siswa.notifikasi') }}" class="notification-bell" style="text-decoration:none; margin-right: 16px; position: relative; color: var(--dark-oak); display: flex; align-items: center; justify-content: center; width: 42px; height: 42px; border-radius: 50%; background: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.8); backdrop-filter: blur(12px); box-shadow: 0 4px 14px rgba(61,43,31,0.04); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </a>
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
                <a href="{{ route('siswa.profile') }}" class="user-profile">
                    <div class="user-greeting">Hi, <span>{{ explode(' ', $userName)[0] }}</span></div>
                    <div class="user-avatar">
                        @if($photoProfile)
                            <img src="{{ asset('uploads/profiles/' . $photoProfile) }}" alt="Profile">
                        @else
                            {{ strtoupper(substr($userName, 0, 1)) }}
                        @endif
                    </div>
                </a>
            </div>
        </header>

        <div class="profile-card">
            <h1 class="page-title">Ubah Password</h1>

            @if($errors->any())
                <div class="alert-error">
                    <ul style="margin-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('siswa.profile.password.update') }}" method="POST" style="width: 100%;">
                @csrf
                <div class="info-grid">
                    <div class="info-item">
                        <label class="info-label">Password Lama</label>
                        <input type="password" name="old_password" class="info-value" required>
                    </div>
                    
                    <div class="info-item">
                        <label class="info-label">Password Baru</label>
                        <input type="password" name="new_password" class="info-value" required minlength="6">
                    </div>

                    <div class="info-item">
                        <label class="info-label">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" class="info-value" required minlength="6">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">Ubah Password</button>
                    <a href="{{ route('siswa.profile') }}" class="btn-cancel">Batal</a>
                </div>
            </form>

        </div>

    </div>
</body>
</html>

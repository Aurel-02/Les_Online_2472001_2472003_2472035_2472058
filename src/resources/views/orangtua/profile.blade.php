<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Pintar.id</title>
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
            max-width:1200px;
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
            max-width: 600px;
            margin: 40px auto;
            width: 100%;
        }

        .avatar-large {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--muted-sage);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
            overflow: hidden;
            border: 4px solid rgba(255,255,255,0.8);
            box-shadow: 0 8px 24px rgba(61,43,31,0.1);
        }
        .avatar-large img { width:100%; height:100%; object-fit:cover; }

        .profile-name { font-size: 28px; font-weight: 800; color: var(--dark-oak); margin-bottom: 4px; }
        .profile-role { font-size: 16px; font-weight: 600; color: var(--muted-sage); margin-bottom: 24px; text-transform: uppercase; letter-spacing: 1px; }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            width: 100%;
            margin-bottom: 32px;
        }

        .info-label { font-size: 12px; font-weight: 700; color: rgba(61,43,31,0.5); text-transform: uppercase; margin-bottom: 4px; display:block; }
        .info-value { width: 100%; padding: 10px 14px; border-radius: 12px; border: 1px solid rgba(61,43,31,0.1); background: rgba(255,255,255,0.6); font-family: 'Outfit', sans-serif; font-size: 15px; color: var(--dark-oak); outline: none; transition: border 0.2s; }
        .info-value:focus { border-color: var(--muted-sage); background: rgba(255,255,255,0.9); }
        .info-value:disabled, .info-value[readonly] { background: rgba(255,255,255,0.4); color: rgba(61,43,31,0.6); cursor: not-allowed; }

        .password-row { display: flex; gap: 12px; align-items: center; }
        .password-row .info-value { flex: 1; }

        .form-actions { display: flex; width: 100%; margin-top: 24px; }
        .btn-save { flex: 1; background: var(--muted-sage); color: #fff; border: none; padding: 14px; border-radius: 30px; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.3s; font-family: 'Outfit', sans-serif; }
        .btn-save:hover { background: #7b846e; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(142,150,128,0.3); }
        .btn-password { flex: 0 0 auto; background: transparent; color: var(--dark-oak); border: 1.5px solid var(--dark-oak); padding: 10px 20px; border-radius: 30px; font-size: 14px; font-weight: 700; cursor: pointer; transition: all 0.3s; font-family: 'Outfit', sans-serif; }
        .btn-password:hover { background: var(--dark-oak); color: #fff; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(61,43,31,0.2); }

        .upload-form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 16px;
            background: rgba(217, 179, 130, 0.15);
            padding: 24px;
            border-radius: 16px;
            border: 1px dashed var(--warm-amber);
        }

        .upload-label { font-size: 14px; font-weight: 700; color: var(--dark-oak); margin-bottom: 8px; display: block; }
        .file-input { width: 100%; font-family: 'Outfit', sans-serif; font-size: 14px; }
        .btn-upload {
            background: var(--dark-oak);
            color: var(--vintage-cream);
            border: none;
            padding: 12px 24px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Outfit', sans-serif;
            text-align: center;
        }
        .btn-upload:hover { background: #2c1e15; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(61,43,31,0.2); }

        .alert-success { background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 12px; margin-bottom: 20px; width: 100%; font-size: 14px; font-weight: 600; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 12px; margin-bottom: 20px; width: 100%; font-size: 14px; font-weight: 600; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="blur-blob-1"></div>
    <div class="blur-blob-2"></div>

    <div class="app-container">
        <header class="top-header">
            <a href="{{ route('orangtua.home') }}" class="brand">Pintar.id</a>
            <div class="center-nav">
                <a href="{{ route('orangtua.home') }}" class="nav-pill">Beranda</a>
                <a href="{{ route('orangtua.paket-belajar') }}" class="nav-pill">Paket Belajar</a>
                <a href="#" class="nav-pill active">Profil</a>
            </div>
            <div class="right-nav">
                <a href="{{ route('orangtua.profile') }}" class="user-profile">
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
            @if(session('success_password'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success_password') }}',
                        confirmButtonColor: '#8E9680',
                    });
                </script>
            @endif
            @if(session('success_profile'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Tersimpan!',
                        text: '{{ session('success_profile') }}',
                        confirmButtonColor: '#8E9680',
                    });
                </script>
            @endif
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <div style="display:flex; flex-direction:column; align-items:center; margin-bottom: 20px;">
                <div class="avatar-large" style="margin-bottom: 12px;">
                    @if($photoProfile)
                        <img src="{{ asset('uploads/profiles/' . $photoProfile) }}" alt="Profile">
                    @else
                        {{ strtoupper(substr($userName, 0, 1)) }}
                    @endif
                </div>
                <form action="{{ route('orangtua.profile.photo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="photo-upload" style="cursor:pointer; color:var(--dark-oak); font-size:14px; font-weight:700; text-decoration:underline; display:inline-block;">ubah photo profil</label>
                    <input id="photo-upload" type="file" name="photo" accept="image/png, image/jpeg, image/jpg, image/gif" required style="display:none;" onchange="this.form.submit()">
                </form>
            </div>
            
            <div class="profile-name">{{ $userName }}</div>
            <div class="profile-role">{{ $userRole }}</div>

            <form action="{{ route('orangtua.profile.update') }}" method="POST" id="profileForm" style="width: 100%;">
                @csrf
                <div class="info-grid">
                    <div class="info-item">
                        <label class="info-label">Alamat Email</label>
                        <input type="email" name="email" class="info-value" value="{{ old('email', $userEmail) }}" required>
                    </div>
                    
                    <div class="info-item">
                        <label class="info-label">Password</label>
                        <div class="password-row">
                            <input type="password" class="info-value" value="********" readonly>
                            <button type="button" class="btn-password" onclick="confirmChangePassword()">Ubah Password</button>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save" id="btnSave">Simpan Perubahan</button>
                </div>
            </form>
        </div>

    </div>

    <script>
        let isDirty = false;
        const profileForm = document.getElementById('profileForm');
        const inputs = profileForm.querySelectorAll('input, select');
        
        inputs.forEach(input => {
            input.addEventListener('change', () => { isDirty = true; });
            input.addEventListener('input', () => { isDirty = true; });
        });

        profileForm.addEventListener('submit', () => {
            isDirty = false;
        });

        window.addEventListener('beforeunload', (e) => {
            if (isDirty) {
                e.preventDefault();
                e.returnValue = '';
            }
        });

        function confirmChangePassword() {
            Swal.fire({
                title: 'Yakin ingin mengubah password?',
                text: "Anda akan dialihkan ke halaman ubah password.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3D2B1F',
                cancelButtonColor: '#A37C76',
                confirmButtonText: 'Ya, Ubah Password',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('orangtua.profile.password') }}";
                }
            });
        }
    </script>
</body>
</html>

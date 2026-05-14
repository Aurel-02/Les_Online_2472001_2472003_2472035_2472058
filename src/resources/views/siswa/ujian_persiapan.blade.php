<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persiapan Ujian - Pintar.id</title>
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

        .sidebar {
            width: var(--sidebar-width); background: rgba(230,216,193,.85);
            backdrop-filter: blur(20px); border-right: 1px solid rgba(255,255,255,.6);
            height: 100vh; padding: 32px 24px; display: flex; flex-direction: column;
            position: fixed; left: 0; top: 0; z-index: 50;
        }
        .logo-container { display: flex; align-items: center; gap: 12px; text-decoration: none; margin-bottom: 60px; }
        .logo-text { font-size: 26px; font-weight: 800; color: var(--dark-oak); letter-spacing: -.5px; }
        .sidebar-menu { flex: 1; display: flex; flex-direction: column; gap: 8px; }
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

        .main-wrapper { flex: 1; margin-left: var(--sidebar-width); height: 100vh; overflow-y: auto; position: relative; z-index: 5; }
        .content-body { padding: 48px; max-width: 800px; margin: 0 auto; }

        .btn-back {
            display: inline-flex; align-items: center; gap: 8px; color: rgba(61,43,31,.7); text-decoration: none; font-weight: 600; font-size: 15px; margin-bottom: 24px; transition: color .3s ease;
        }
        .btn-back:hover { color: var(--dark-oak); }

        .prep-card {
            background: #fff; border-radius: 32px; padding: 48px;
            box-shadow: 0 16px 48px rgba(61,43,31,.05); border: 1px solid rgba(61,43,31,.05);
            text-align: center;
        }

        .prep-icon {
            width: 80px; height: 80px; background: rgba(217, 179, 130, 0.2); color: #B38F60;
            border-radius: 24px; display: flex; align-items: center; justify-content: center;
            font-size: 36px; margin: 0 auto 24px;
        }

        .prep-title { font-size: 32px; font-weight: 800; color: var(--dark-oak); margin-bottom: 8px; }
        .prep-subtitle { font-size: 18px; color: rgba(61,43,31,.6); font-weight: 500; margin-bottom: 40px; }

        .prep-details {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 48px;
        }
        .detail-item {
            background: #F7F4F0; padding: 24px; border-radius: 20px;
        }
        .detail-value { font-size: 24px; font-weight: 800; color: var(--dark-oak); margin-bottom: 4px; }
        .detail-label { font-size: 13px; font-weight: 600; color: rgba(61,43,31,.5); text-transform: uppercase; letter-spacing: 1px; }

        .prep-rules {
            text-align: left; background: rgba(142,150,128,.1); padding: 32px; border-radius: 24px;
            margin-bottom: 48px;
        }
        .prep-rules h4 { font-size: 18px; font-weight: 800; color: var(--dark-oak); margin-bottom: 16px; }
        .prep-rules ul { list-style: none; padding: 0; margin: 0; }
        .prep-rules li {
            position: relative; padding-left: 28px; margin-bottom: 12px; font-size: 15px; color: rgba(61,43,31,.8); line-height: 1.5;
        }
        .prep-rules li::before {
            content: '✓'; position: absolute; left: 0; top: 0; color: var(--muted-sage); font-weight: bold;
        }

        .btn-start {
            display: inline-flex; justify-content: center; align-items: center; width: 100%;
            background: var(--dark-oak); color: #fff; padding: 20px; border-radius: 20px;
            font-size: 18px; font-weight: 700; text-decoration: none; border: none; cursor: pointer;
            transition: all .3s ease; box-shadow: 0 8px 24px rgba(61,43,31,.15);
        }
        .btn-start:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(61,43,31,.25); }

    </style>
</head>
<body>
    <aside class="sidebar">
        <a href="/" class="logo-container">
            <svg width="36" height="36" viewBox="0 0 24 24"><path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z" fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/><circle cx="12" cy="13" r="4" fill="var(--vintage-cream)"/></svg>
            <div class="logo-text">Pintar.id</div>
        </a>
        <div class="sidebar-menu">
            <!-- Sidebar items ... -->
            <a href="{{ route('siswa.home') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                </span> Dashboard
            </a>
            <a href="{{ route('siswa.ujian') }}" class="sidebar-item active">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </span> Ujian
            </a>
        </div>
    </aside>

    <div class="main-wrapper">
        <div class="content-body">
            <a href="{{ route('siswa.ujian.mapel', ['jenis' => $jenis]) }}" class="btn-back">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Kembali ke Pemilihan Mata Pelajaran
            </a>

            <div class="prep-card">
                <div class="prep-icon">📝</div>
                <h1 class="prep-title">{{ strtoupper($jenis) }} - {{ $mapel }}</h1>
                <p class="prep-subtitle">Persiapkan dirimu sebelum memulai ujian.</p>

                <div class="prep-details">
                    <div class="detail-item">
                        <div class="detail-value">30</div>
                        <div class="detail-label">Menit Waktu Ujian</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-value">10</div>
                        <div class="detail-label">Jumlah Soal</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-value">PG</div>
                        <div class="detail-label">Tipe Soal</div>
                    </div>
                </div>

                <div class="prep-rules">
                    <h4>Peraturan Ujian</h4>
                    <ul>
                        <li>Pastikan koneksi internet Anda stabil selama ujian berlangsung.</li>
                        <li>Waktu ujian akan otomatis berjalan mundur begitu Anda menekan tombol "Kerjakan".</li>
                        <li>Dilarang keluar dari halaman browser selama ujian berlangsung.</li>
                        <li>Soal yang sudah dijawab akan tersimpan otomatis.</li>
                    </ul>
                </div>

                <a href="{{ route('siswa.ujian.soal', ['jenis' => $jenis, 'mapel' => $mapel]) }}" class="btn-start">
                    Kerjakan Sekarang
                </a>
            </div>
        </div>
    </div>
</body>
</html>

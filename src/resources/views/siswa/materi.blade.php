<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Materi - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-oak:      #3D2B1F;
            --muted-sage:    #8E9680;
            --dusty-mauve:   #A37C76;
            --warm-amber:    #D9B382;
            --vintage-cream: #E6D8C1;
            
            --glass-bg: rgba(255, 255, 255, 0.4);
            --glass-border: rgba(255, 255, 255, 0.8);
            --text-dark: #3D2B1F;
            --text-muted: rgba(61, 43, 31, 0.6);
            --accent: #FF9F43;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: #F7F4F0;
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .blur-blob-1 { position: fixed; top: -10%; left: -10%; width: 50vw; height: 50vw; background: radial-gradient(circle, rgba(142, 150, 128, 0.15) 0%, rgba(255,255,255,0) 70%); z-index: -1; pointer-events: none; }
        .blur-blob-2 { position: fixed; bottom: -20%; right: -10%; width: 60vw; height: 60vw; background: radial-gradient(circle, rgba(217, 179, 130, 0.15) 0%, rgba(255,255,255,0) 70%); z-index: -1; pointer-events: none; }

        .app-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px 40px;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .brand {
            font-size: 28px;
            font-weight: 800;
            text-decoration: none;
            color: var(--text-dark);
            letter-spacing: -0.5px;
        }

        .center-nav {
            display: flex;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 99px;
            padding: 6px;
            gap: 4px;
            box-shadow: 0 4px 12px rgba(61,43,31,0.03);
            border: 1px solid rgba(255,255,255,0.8);
        }

        .nav-pill {
            padding: 8px 20px;
            border-radius: 99px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .nav-pill.active {
            background: var(--dark-oak);
            color: white;
        }

        .right-nav {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .search-btn {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.6);
            border: 1px solid rgba(255,255,255,0.8);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 16px;
            color: var(--text-dark);
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

        .featured-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 40px;
        }

        .featured-card {
            height: 280px;
            border-radius: 24px;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 32px;
            box-shadow: 0 16px 32px rgba(0,0,0,0.1);
        }

        .banner-1 { background: linear-gradient(135deg, var(--warm-amber) 0%, #E8CDA9 100%); }
        .banner-2 { background: linear-gradient(135deg, var(--muted-sage) 0%, #A9B39B 100%); }

        .banner-content {
            position: relative;
            z-index: 2;
        }

        .banner-content h2 {
            font-size: 36px;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
            max-width: 80%;
            color: var(--text-dark);
        }

        .play-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--text-dark);
            backdrop-filter: blur(10px);
            color: white;
            padding: 10px 20px;
            border-radius: 99px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s;
        }

        .play-btn:hover { background: #2c1e15; }

        .category-row {
            display: flex;
            gap: 12px;
            margin-bottom: 40px;
            overflow-x: auto;
            padding-bottom: 10px;
        }
        .category-row::-webkit-scrollbar { display: none; }

        .cat-pill {
            background: rgba(255,255,255,0.6);
            border: 1px solid rgba(255,255,255,0.8);
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            white-space: nowrap;
            cursor: pointer;
            transition: 0.3s;
            color: var(--text-dark);
        }

        .cat-pill:hover, .cat-pill.active {
            background: var(--dark-oak);
            color: white;
            transform: translateY(-2px);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
        }

        .filter-icons {
            display: flex;
            gap: 8px;
            background: rgba(255,255,255,0.6);
            border: 1px solid rgba(255,255,255,0.8);
            padding: 4px;
            border-radius: 12px;
        }

        .filter-icons div {
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; border-radius: 8px;
            color: var(--text-dark);
        }
        .filter-icons div.active { background: rgba(61,43,31,0.1); }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            padding-bottom: 60px;
        }

        .video-card {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: 0.3s;
        }

        .video-card:hover { transform: scale(1.05); }

        .video-poster {
            width: 100%;
            aspect-ratio: 2 / 3;
            border-radius: 16px;
            background-size: cover;
            background-position: center;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        .poster-1 { background: linear-gradient(180deg, #e74c3c, #c0392b); }
        .poster-2 { background: linear-gradient(180deg, #f1c40f, #f39c12); }
        .poster-3 { background: linear-gradient(180deg, #2ecc71, #27ae60); }
        .poster-4 { background: linear-gradient(180deg, #9b59b6, #8e44ad); }
        .poster-5 { background: linear-gradient(180deg, #1abc9c, #16a085); }

        .video-title {
            font-size: 16px;
            font-weight: 700;
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .video-meta {
            font-size: 13px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .video-meta span { color: var(--text-muted); }

        @media (max-width: 992px) {
            .featured-grid { grid-template-columns: 1fr; }
            .video-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 768px) {
            .video-grid { grid-template-columns: repeat(2, 1fr); }
            .center-nav { display: none; }
        }
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
                <div class="nav-pill active">Video Materi</div>
                <a href="{{ route('siswa.catatan') }}?mapel={{ urlencode($mapel ?? '') }}" class="nav-pill">Catatan</a>
            </div>
            
            <div class="right-nav">
                <div class="search-btn">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
            <a href="{{ route('siswa.notifikasi') }}" class="notification-bell" style="text-decoration:none; margin-right: 16px; position: relative; color: var(--dark-oak); display: flex; align-items: center; justify-content: center; width: 42px; height: 42px; border-radius: 50%; background: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.8); backdrop-filter: blur(12px); box-shadow: 0 4px 14px rgba(61,43,31,0.04); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </a>
            <a href="{{ route('siswa.profile') }}" class="user-profile" style="text-decoration:none; color:inherit;">
                <div class="user-greeting">Hi, <span>{{ explode(' ', $userName)[0] }}</span></div>
                <div class="user-avatar" style="overflow:hidden;">
                    @if(isset($photoProfile) && $photoProfile)
                        <img src="{{ asset('uploads/profiles/' . $photoProfile) }}" alt="Profile" style="width:100%; height:100%; object-fit:cover;">
                    @else
                        {{ substr($userName, 0, 1) }}
                    @endif
                </div>
            </a>
            </div>
        </header>

        <main class="main-content">
            @php
                $banner1 = "Jelajahi<br>" . $mapel;
                $banner2 = "Serunya<br>" . $mapel;
                $tags = ["🔥 Trending", "⚡ Cepat Paham", "❤️ Materi Disukai", "🤯 Soal Sulit", "🎓 Spesial UN"];
                
                if (stripos($mapel, 'Matematika') !== false) {
                    $banner1 = "Petualangan<br>Aljabar Linear";
                    $banner2 = "Misteri<br>Persamaan Kuadrat";
                    $tags = ["🔥 Trending", "⚡ Cepat Paham", "❤️ Materi Disukai", "📐 Geometri", "🤯 Soal Sulit", "🎓 Spesial UN"];
                } elseif (stripos($mapel, 'Fisika') !== false) {
                    $banner1 = "Mekanika<br>Kuantum Dasar";
                    $banner2 = "Rahasia<br>Hukum Newton";
                    $tags = ["🔥 Trending", "⚡ Cepat Paham", "❤️ Materi Disukai", "⚛️ Kinematika", "🤯 Soal Sulit", "🎓 Spesial UN"];
                } elseif (stripos($mapel, 'Ekonomi') !== false) {
                    $banner1 = "Dinamika<br>Pasar Global";
                    $banner2 = "Pengantar<br>Akuntansi Dasar";
                    $tags = ["🔥 Trending", "⚡ Cepat Paham", "❤️ Materi Disukai", "📉 Akuntansi", "🤯 Soal Sulit", "🎓 Spesial UN"];
                } elseif (stripos($mapel, 'Kimia') !== false) {
                    $banner1 = "Keajaiban<br>Reaksi Kimia";
                    $banner2 = "Misteri<br>Tabel Periodik";
                    $tags = ["🔥 Trending", "⚡ Cepat Paham", "❤️ Materi Disukai", "🧪 Senyawa", "🤯 Soal Sulit", "🎓 Spesial UN"];
                } elseif (stripos($mapel, 'Biologi') !== false) {
                    $banner1 = "Eksplorasi<br>Dunia Sel";
                    $banner2 = "Rahasia<br>Genetika Manusia";
                    $tags = ["🔥 Trending", "⚡ Cepat Paham", "❤️ Materi Disukai", "🧬 Evolusi", "🤯 Soal Sulit", "🎓 Spesial UN"];
                }
            @endphp

            <div class="featured-grid">
                <div class="featured-card banner-1">
                    <div class="banner-content">
                        <h2>{!! $banner1 !!}</h2>
                        <a href="{{ route('siswa.video') }}?mapel={{ urlencode($mapel) }}" class="play-btn">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            Mulai Belajar
                        </a>
                    </div>
                </div>
                <div class="featured-card banner-2">
                    <div class="banner-content">
                        <h2>{!! $banner2 !!}</h2>
                        <a href="{{ route('siswa.video') }}?mapel={{ urlencode($mapel) }}" class="play-btn">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            Mulai Belajar
                        </a>
                    </div>
                </div>
            </div>

            <div class="section-header" style="margin-top: 30px;">
                <h3 class="section-title">Daftar Video {{ $mapel }}</h3>
                <div class="filter-icons">
                    <div class="active">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </div>
                    <div>
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    </div>
                </div>
            </div>

            <div class="video-grid">
                @forelse($materis as $materi)
                @php
                    $youtubeId = '';
                    if($materi->link_video && preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $materi->link_video, $matches)) {
                        $youtubeId = $matches[1];
                    }
                @endphp
                <a href="{{ route('siswa.video') }}?id={{ $materi->id_materi }}&mapel={{ urlencode($mapel) }}" class="video-card" style="text-decoration: none;">
                    @if($youtubeId)
                        <div class="video-poster" style="aspect-ratio: 16/9; background-image: url('https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg'); background-size: cover; background-position: center; position:relative;">
                            <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; background:rgba(0,0,0,0.3); border-radius:16px;">
                                <div style="width:48px; height:48px; background:rgba(255,255,255,0.8); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--dark-oak); font-size:20px; padding-left:4px;">▶</div>
                            </div>
                        </div>
                    @else
                        <div class="video-poster poster-{{ ($loop->index % 5) + 1 }}" style="aspect-ratio: 16/9; position:relative;">
                            <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; border-radius:16px;">
                                <div style="width:48px; height:48px; background:rgba(255,255,255,0.8); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--dark-oak); font-size:20px; padding-left:4px;">▶</div>
                            </div>
                        </div>
                    @endif
                    <div class="video-info">
                        <h4 class="video-title">{{ $materi->judul }}</h4>
                        <div class="video-meta">
                            <span style="color:var(--accent);">👤</span> {{ $materi->nama_guru }}
                        </div>
                    </div>
                </a>
                @empty
                <div style="grid-column: 1 / -1; text-align: center; color: var(--text-muted); padding: 40px;">
                    Belum ada video materi untuk saat ini.
                </div>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>

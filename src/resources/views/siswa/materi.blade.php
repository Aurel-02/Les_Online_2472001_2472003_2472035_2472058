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
                <div class="nav-pill">Latihan Soal</div>
                <div class="nav-pill">Tryout</div>
            </div>
            
            <div class="right-nav">
                <div class="search-btn">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
            <div class="user-profile">
                <div class="user-greeting">Hi, <span>{{ explode(' ', $userName)[0] }}</span></div>
                <div class="user-avatar">{{ substr($userName, 0, 1) }}</div>
            </div>
            </div>
        </header>

        <main class="main-content">
            <div class="featured-grid">
                <div class="featured-card banner-1">
                    <div class="banner-content">
                        <h2>Petualangan<br>Aljabar Linear</h2>
                        <a href="{{ route('siswa.video') }}" class="play-btn">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            Mulai Belajar
                        </a>
                    </div>
                </div>
                <div class="featured-card banner-2">
                    <div class="banner-content">
                        <h2>Misteri<br>Persamaan Kuadrat</h2>
                        <a href="{{ route('siswa.video') }}" class="play-btn">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            Mulai Belajar
                        </a>
                    </div>
                </div>
            </div>

            <div class="category-row">
                <div class="cat-pill active">🔥 Trending</div>
                <div class="cat-pill">⚡ Cepat Paham</div>
                <div class="cat-pill">❤️ Materi Disukai</div>
                <div class="cat-pill">📐 Geometri</div>
                <div class="cat-pill">🤯 Soal Sulit</div>
                <div class="cat-pill">🎓 Spesial UN</div>
            </div>

            <div class="section-header">
                <h3 class="section-title">Trending in {{ $mapel }}</h3>
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
                <a href="{{ route('siswa.video') }}?mapel={{ urlencode($mapel) }}" class="video-card">
                    <div class="video-poster poster-1"></div>
                    <div class="video-info">
                        <h4 class="video-title">Fungsi Kuadrat</h4>
                        <div class="video-meta"><span style="color:var(--accent);">★</span> 9.8 <span>|</span> 2024</div>
                    </div>
                </a>
                
                <a href="{{ route('siswa.video') }}?mapel={{ urlencode($mapel) }}" class="video-card">
                    <div class="video-poster poster-2"></div>
                    <div class="video-info">
                        <h4 class="video-title">Trigonometri Dasar</h4>
                        <div class="video-meta"><span style="color:var(--accent);">★</span> 8.5 <span>|</span> 2024</div>
                    </div>
                </a>
                
                <a href="{{ route('siswa.video') }}?mapel={{ urlencode($mapel) }}" class="video-card">
                    <div class="video-poster poster-3"></div>
                    <div class="video-info">
                        <h4 class="video-title">Limit Fungsi</h4>
                        <div class="video-meta"><span style="color:var(--accent);">★</span> 9.1 <span>|</span> 2024</div>
                    </div>
                </a>

                <a href="{{ route('siswa.video') }}?mapel={{ urlencode($mapel) }}" class="video-card">
                    <div class="video-poster poster-4"></div>
                    <div class="video-info">
                        <h4 class="video-title">Matriks & Vektor</h4>
                        <div class="video-meta"><span style="color:var(--accent);">★</span> 8.7 <span>|</span> 2023</div>
                    </div>
                </a>

                <a href="{{ route('siswa.video') }}?mapel={{ urlencode($mapel) }}" class="video-card">
                    <div class="video-poster poster-5"></div>
                    <div class="video-info">
                        <h4 class="video-title">Integral Lanjut</h4>
                        <div class="video-meta"><span style="color:var(--accent);">★</span> 9.9 <span>|</span> 2023</div>
                    </div>
                </a>
            </div>
        </main>
    </div>
</body>
</html>

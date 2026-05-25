<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Jurusan - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    <style>
        :root { --dark-oak:#3D2B1F; --muted-sage:#8E9680; --dusty-mauve:#A37C76; --warm-amber:#D9B382; --vintage-cream:#E6D8C1; --sidebar-width:260px; }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; }
        body { background:#F7F4F0; color:var(--dark-oak); overflow-x:hidden; display:flex; height:100vh; }
        .blob-1 { position:fixed; top:-10%; right:10%; width:500px; height:500px; background:rgba(142,150,128,.15); border-radius:50%; filter:blur(80px); z-index:0; pointer-events:none; }
        .blob-2 { position:fixed; bottom:-10%; left:20%; width:400px; height:400px; background:rgba(217,179,130,.15); border-radius:50%; filter:blur(60px); z-index:0; pointer-events:none; }
        .sidebar { width:var(--sidebar-width); background:rgba(230,216,193,.85); backdrop-filter:blur(20px); border-right:1px solid rgba(255,255,255,.6); height:100vh; padding:32px 24px; display:flex; flex-direction:column; position:fixed; left:0; top:0; z-index:50; }
        .logo-container { display:flex; align-items:center; gap:12px; text-decoration:none; margin-bottom:60px; }
        .logo-text { font-size:26px; font-weight:800; color:var(--dark-oak); letter-spacing:-.5px; }
        .sidebar-menu { flex:1; display:flex; flex-direction:column; gap:8px; }
        .sidebar-item { display:flex; align-items:center; gap:14px; padding:14px 18px; border-radius:16px; text-decoration:none; color:rgba(61,43,31,.7); font-weight:600; font-size:15px; transition:all .3s ease; }
        .sidebar-item:hover, .sidebar-item.active { background:rgba(255,255,255,.5); color:var(--dark-oak); box-shadow:0 4px 12px rgba(61,43,31,.03); }
        .sidebar-item-icon { font-size:20px; }
        .logout-container { margin-top:auto; }
        .btn-logout { width:100%; padding:14px; border-radius:99px; font-size:15px; font-weight:600; color:var(--dusty-mauve); background:rgba(163,124,118,0.08); border:none; cursor:pointer; transition:all .3s ease; display:flex; align-items:center; justify-content:center; gap:10px; }
        .btn-logout:hover { background:rgba(163,124,118,0.15); color:#8a655f; }
        .main-wrapper { flex:1; margin-left:var(--sidebar-width); height:100vh; overflow-y:auto; position:relative; z-index:5; }
        .topbar { padding:24px 48px; display:flex; justify-content:flex-end; align-items:center; position:sticky; top:0; z-index:40; }
        .user-profile { display:flex; align-items:center; gap:16px; background:rgba(255,255,255,.6); backdrop-filter:blur(12px); padding:8px 10px 8px 24px; border-radius:99px; border:1px solid rgba(255,255,255,.8); box-shadow:0 4px 14px rgba(61,43,31,.04); cursor:pointer; transition:transform .3s ease; text-decoration:none; }
        .user-profile:hover { transform:translateY(-2px); }
        .user-greeting { font-size:15px; font-weight:500; color:rgba(61,43,31,.7); }
        .user-greeting span { font-weight:800; color:var(--dark-oak); }
        .user-avatar { width:42px; height:42px; border-radius:50%; background:var(--warm-amber); display:flex; align-items:center; justify-content:center; font-weight:800; color:#fff; font-size:18px; overflow:hidden; }
        .content-body { padding:0 48px 80px; max-width:1200px; margin:0 auto; }
        
        .rekomendasi-hero { background:linear-gradient(135deg, #A37C76 0%, #D9B382 100%); border-radius:32px; padding:44px 52px; display:flex; align-items:center; justify-content:space-between; margin-bottom:40px; box-shadow:0 16px 40px rgba(163,124,118,.25); position:relative; overflow:hidden; }
        .rekomendasi-hero::before { content:''; position:absolute; right:-60px; top:-60px; width:320px; height:320px; background:radial-gradient(circle,rgba(255,255,255,.15) 0%,transparent 70%); border-radius:50%; }
        .hero-left h1 { font-size:32px; font-weight:800; color:#fff; line-height:1.15; letter-spacing:-1px; margin-bottom:12px; }
        .hero-left p { font-size:15px; color:rgba(255,255,255,.85); max-width:480px; line-height:1.6; }
        .hero-icon { font-size:80px; filter:drop-shadow(0 10px 24px rgba(0,0,0,.2)); animation:float 6s ease-in-out infinite; }
        
        @keyframes float { 0%,100%{transform:translateY(0) rotate(0deg);}50%{transform:translateY(-14px) rotate(4deg);} }
        
        .score-panel { display:flex; gap:24px; margin-bottom:48px; }
        .score-card { flex:1; background:rgba(255,255,255,.6); backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,.8); border-radius:24px; padding:24px; text-align:center; box-shadow:0 8px 24px rgba(61,43,31,.04); }
        .score-card h3 { font-size:14px; font-weight:700; color:rgba(61,43,31,.5); text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; }
        .score-val { font-size:36px; font-weight:800; color:var(--dark-oak); }
        
        .section-title { font-size:22px; font-weight:800; color:var(--dark-oak); margin-bottom:20px; }
        
        .rekomendasi-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:20px; }
        .rekomendasi-card { background:rgba(255,255,255,.55); backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,.85); border-radius:24px; padding:24px; box-shadow:0 8px 24px rgba(61,43,31,.04); transition:all .3s ease; position:relative; overflow:hidden; display:block; text-decoration:none; color:var(--dark-oak); }
        .rekomendasi-card:hover { transform:translateY(-4px); box-shadow:0 16px 40px rgba(61,43,31,.08); background:rgba(255,255,255,.8); }
        .rekomendasi-card::before { content:''; position:absolute; left:0; top:0; bottom:0; width:6px; background:var(--dusty-mauve); }
        
        .rek-ptn { font-size:13px; font-weight:700; color:var(--muted-sage); margin-bottom:4px; text-transform:uppercase; letter-spacing:1px; }
        .rek-prodi { font-size:18px; font-weight:800; color:var(--dark-oak); margin-bottom:6px; }
        .rek-fakultas { font-size:14px; color:rgba(61,43,31,.6); font-weight:500; margin-bottom:16px; }
        .rek-stats { display:flex; align-items:center; justify-content:space-between; background:rgba(217,179,130,.15); padding:10px 14px; border-radius:12px; }
        .rek-target { font-size:13px; font-weight:700; color:#9a7240; }
        .rek-badge { font-size:12px; font-weight:800; padding:4px 10px; border-radius:99px; background:rgba(74,103,65,.15); color:#4A6741; }
        .ptn-group { background:rgba(255,255,255,.5); border:1px solid rgba(255,255,255,.8); border-radius:24px; margin-bottom:20px; overflow:hidden; transition:all .3s ease; }
        .ptn-header { padding:20px 28px; display:flex; align-items:center; cursor:pointer; background:rgba(255,255,255,.4); transition:background .3s; }
        .ptn-header:hover { background:rgba(255,255,255,.7); }
        .ptn-name { font-size:18px; font-weight:800; color:var(--dark-oak); flex:1; }
        .ptn-count { font-size:14px; font-weight:700; color:var(--muted-sage); background:rgba(142,150,128,.15); padding:6px 14px; border-radius:99px; margin-right:16px; }
        .ptn-chevron { font-size:12px; color:rgba(61,43,31,.5); transition:transform .3s; }
        .ptn-group.active .ptn-chevron { transform:rotate(180deg); }
        .ptn-body { max-height:0; overflow:hidden; transition:max-height .4s cubic-bezier(0,1,0,1); }
        .ptn-group.active .ptn-body { max-height:2000px; transition:max-height .5s ease-in-out; }
        .ptn-body-content { padding:24px 28px; border-top:1px solid rgba(61,43,31,.05); }
        
        .no-data { text-align:center; padding:80px 20px; background:rgba(255,255,255,.5); border-radius:24px; border:1px dashed rgba(61,43,31,.2); margin-bottom:40px; }
        .no-data .emoji { font-size:64px; margin-bottom:16px; }
        .no-data h3 { font-size:20px; font-weight:800; margin-bottom:8px; }
        .no-data p { font-size:15px; color:rgba(61,43,31,.6); max-width:400px; margin:0 auto 24px; line-height:1.6; }
        .btn-primary { display:inline-flex; background:var(--dark-oak); color:#fff; padding:14px 24px; border-radius:14px; font-weight:700; text-decoration:none; transition:all .3s ease; }
        .btn-primary:hover { transform:translateY(-2px); box-shadow:0 8px 20px rgba(61,43,31,.2); }
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
            <a href="{{ route('siswa.home') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                </span> Dashboard
            </a>
            @if(auth()->user() && !in_array((int)auth()->user()->id_jenjang, [1, 2]))
            <a href="{{ route('siswa.ptn') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
                </span> Info Univ & PTN
            </a>
            <a href="{{ route('siswa.jurusan') }}" class="sidebar-item active">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                </span> Rekomendasi Jurusan
            </a>
            @endif
            <a href="{{ route('siswa.paket-belajar') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                </span> Paket Belajar
            </a>
            <a href="{{ route('siswa.ujian') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </span> Ujian
            </a>
            <a href="{{ route('siswa.chat') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                </span> Chat 
            </a>
        </div>
        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="main-wrapper">
        <header class="topbar">
            <div></div>
            <a href="{{ route('siswa.profile') }}" class="user-profile">
                <div class="user-greeting">Hi, <span>{{ explode(' ', $userName ?? 'Siswa')[0] }}</span></div>
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
            <div class="rekomendasi-hero">
                <div class="hero-left">
                    <h1>Rekomendasi Jurusan</h1>
                    <p>Prediksi dan rekomendasi program studi terbaik berdasarkan performa nilai rata-rata Try Out UTBK/SNBT kamu.</p>
                </div>
                <div class="hero-icon">🎯</div>
            </div>

            @if(!$has_tryout)
                <div class="no-data">
                    <div class="emoji">📝</div>
                    <h3>Belum Ada Data Try Out</h3>
                    <p>Sistem membutuhkan nilai rata-rata dari Ujian Try Out UTBK/SNBT kamu untuk memberikan rekomendasi jurusan yang akurat.</p>
                    <a href="{{ route('siswa.ujian') }}" class="btn-primary">Kerjakan Try Out Sekarang</a>
                </div>
            @else
                <div class="score-panel">
                    <div class="score-card">
                        <h3>Rata-rata Skor Mentah</h3>
                        <div class="score-val">{{ $avg_raw }} <span style="font-size:16px;color:rgba(61,43,31,.5);">/ 60</span></div>
                    </div>
                    <div class="score-card">
                        <h3>Estimasi Skor UTBK</h3>
                        <div class="score-val" style="color:var(--dusty-mauve);">{{ $utbk_score }}</div>
                    </div>
                </div>

                <h2 class="section-title">Jurusan Terbuka Untukmu</h2>
                <div class="ptn-accordion-list">
                    @forelse($rekomendasi as $namaPtn => $prodis)
                        <div class="ptn-group">
                            <div class="ptn-header" onclick="this.parentElement.classList.toggle('active')">
                                <div class="ptn-name">{{ $namaPtn }}</div>
                                <div class="ptn-count">{{ count($prodis) }} Jurusan</div>
                                <div class="ptn-chevron">&#x25BC;</div>
                            </div>
                            <div class="ptn-body">
                                <div class="ptn-body-content">
                                    <div class="rekomendasi-grid">
                                        @foreach($prodis as $rek)
                                            <a href="{{ route('siswa.jurusan.detail') }}?nama={{ urlencode($rek['prodi']) }}" class="rekomendasi-card">
                                                <div class="rek-prodi">{{ $rek['prodi'] }}</div>
                                                <div class="rek-fakultas">Fakultas {{ $rek['fakultas'] }}</div>
                                                <div class="rek-stats">
                                                    <div class="rek-target">Target: {{ $rek['target'] }}</div>
                                                    @if($rek['selisih'] > 50)
                                                        <div class="rek-badge" style="background:rgba(74,103,65,.15);color:#4A6741;">Sangat Aman</div>
                                                    @elseif($rek['selisih'] >= 0)
                                                        <div class="rek-badge" style="background:rgba(217,179,130,.2);color:#B38F60;">Aman</div>
                                                    @else
                                                        <div class="rek-badge" style="background:rgba(163,124,118,.15);color:#A37C76;">Ketat</div>
                                                    @endif
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="text-align:center;padding:40px;color:rgba(61,43,31,.5);font-weight:600;background:rgba(255,255,255,.5);border-radius:24px;">
                            Belum ada jurusan yang sesuai dengan estimasi skormu. Terus tingkatkan nilaimu!
                        </div>
                    @endforelse
                </div>
            @endif
        </div>
    </main>
</body>
</html>

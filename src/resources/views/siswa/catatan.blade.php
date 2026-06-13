<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rak Catatan - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-oak:      #3D2B1F;
            --muted-sage:    #8E9680;
            --dusty-mauve:   #A37C76;
            --warm-amber:    #D9B382;
            --vintage-cream: #E6D8C1;
            
            --book-sage:     #9CA88D;
            --book-amber:    #E2BE8D;
            --book-mauve:    #B48A84;
            --book-blue:     #849CB4;
            --shelf-color:   #EAE0CF;
            --shelf-shadow:  rgba(61,43,31,0.1);
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; }
        body { background-color:var(--vintage-cream); color:var(--dark-oak); min-height:100vh; display:flex; flex-direction:column; overflow-x:hidden; }

        .blob-1 { position:fixed; top:-10%; right:-5%; width:600px; height:600px; background:rgba(142,150,128,0.25); border-radius:50%; filter:blur(80px); z-index:0; pointer-events:none; }
        .blob-2 { position:fixed; bottom:-10%; left:-5%; width:400px; height:400px; background:rgba(217,179,130,0.25); border-radius:50%; filter:blur(60px); z-index:0; pointer-events:none; }

        header {
            padding:24px 40px; display:flex; align-items:center; justify-content:space-between;
            position:relative; z-index:10; background:transparent;
        }
        .logo { font-size:28px; font-weight:800; color:var(--dark-oak); letter-spacing:-0.5px; text-decoration:none; }
        
        .center-nav {
            display:flex; background:rgba(255,255,255,0.6); backdrop-filter:blur(10px);
            border-radius:40px; padding:6px; gap:8px; border:1px solid rgba(255,255,255,0.5);
        }
        .nav-pill {
            padding:8px 24px; border-radius:30px; font-size:14px; font-weight:700; color:var(--dark-oak);
            text-decoration:none; transition:all 0.2s; cursor:pointer;
        }
        .nav-pill:hover { background:rgba(255,255,255,0.5); }
        .nav-pill.active { background:var(--dark-oak); color:#fff; }

        .right-nav { display:flex; align-items:center; gap:16px; }
        .btn-search {
            width:42px; height:42px; border-radius:50%; background:#fff; border:none;
            display:flex; align-items:center; justify-content:center; cursor:pointer;
            box-shadow:0 4px 12px rgba(61,43,31,0.05); transition:transform 0.2s;
        }
        .btn-search:hover { transform:translateY(-2px); }
        
        .user-menu {
            display:flex; align-items:center; gap:12px; background:#fff;
            padding:6px 6px 6px 16px; border-radius:30px; cursor:pointer;
            box-shadow:0 4px 12px rgba(61,43,31,0.05); transition:transform 0.2s;
        }
        .user-menu:hover { transform:translateY(-2px); }
        .user-name { font-size:14px; font-weight:700; }
        .user-avatar {
            width:32px; height:32px; border-radius:50%; background:var(--warm-amber);
            display:flex; align-items:center; justify-content:center;
            font-size:13px; font-weight:800; color:var(--dark-oak);
        }

        .main-content {
            flex:1; padding:40px 60px; position:relative; z-index:10;
            max-width:1400px; margin:0 auto; width:100%;
        }

        .page-header { display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:40px; }
        .page-title h1 { font-size:36px; font-weight:800; letter-spacing:-1px; margin-bottom:8px; }
        .page-title p { color:rgba(61,43,31,0.6); font-size:16px; font-weight:600; }
        
        .btn-add {
            background:var(--dark-oak); color:var(--vintage-cream); padding:12px 24px;
            border-radius:30px; font-weight:700; text-decoration:none; font-size:15px;
            display:inline-flex; align-items:center; gap:8px; transition:transform 0.2s;
            box-shadow:0 8px 24px rgba(61,43,31,0.15);
        }
        .btn-add:hover { transform:translateY(-2px); }

        .bookshelf-container {
            background:rgba(255,255,255,0.4);
            backdrop-filter:blur(20px); -webkit-backdrop-filter:blur(20px);
            border:1px solid rgba(255,255,255,0.5);
            border-radius:32px; padding:50px;
            box-shadow:inset 0 4px 16px rgba(255,255,255,0.5), 0 12px 40px rgba(61,43,31,0.06);
            display:flex; flex-direction:column; gap:60px;
        }

        .shelf {
            position:relative; width:100%; padding-bottom:15px;
            border-bottom:16px solid var(--shelf-color);
            border-radius:2px;
            box-shadow:0 8px 16px var(--shelf-shadow);
            display:flex; gap:24px; align-items:flex-end;
            padding-left:20px; padding-right:20px;
        }
        .shelf::after {
            content:''; position:absolute; bottom:-16px; left:0; width:100%; height:16px;
            background:linear-gradient(to bottom, rgba(0,0,0,0.02), rgba(0,0,0,0.05));
            border-radius:2px; pointer-events:none;
        }

        .book {
            width:140px; height:200px;
            border-radius:4px 12px 12px 4px;
            position:relative; cursor:pointer;
            box-shadow:inset 4px 0 10px rgba(255,255,255,0.3), -4px 0 8px rgba(0,0,0,0.1);
            transition:all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            transform-origin:bottom left; text-decoration:none;
            display:flex; flex-direction:column; padding:20px 16px;
            z-index:2;
        }
        .book:hover {
            transform:translateY(-10px) rotate(-2deg);
            box-shadow:inset 4px 0 10px rgba(255,255,255,0.3), -8px 12px 20px rgba(0,0,0,0.15);
            z-index:10;
        }
        .book::before {
            content:''; position:absolute; left:0; top:0; height:100%; width:10px;
            background:linear-gradient(to right, rgba(255,255,255,0.4), rgba(255,255,255,0));
            border-radius:4px 0 0 4px;
        }

        .book-sage { background:var(--book-sage); }
        .book-amber { background:var(--book-amber); }
        .book-mauve { background:var(--book-mauve); }
        .book-blue { background:var(--book-blue); }

        .book-title {
            font-size:16px; font-weight:800; color:#fff; line-height:1.2;
            text-shadow:0 2px 4px rgba(0,0,0,0.15); margin-bottom:auto;
            display:-webkit-box; -webkit-line-clamp:4; -webkit-box-orient:vertical; overflow:hidden;
        }
        .book-author {
            font-size:11px; font-weight:600; color:rgba(255,255,255,0.8);
            text-shadow:0 1px 2px rgba(0,0,0,0.1); text-transform:uppercase; letter-spacing:0.5px;
            margin-top:12px;
        }
        
        .empty-state { text-align:center; padding:60px 20px; color:rgba(61,43,31,0.5); }
        .empty-icon { font-size:48px; margin-bottom:16px; opacity:0.6; }
        .empty-text { font-size:18px; font-weight:600; }

    </style>
</head>
<body>
<div class="blob-1"></div>
<div class="blob-2"></div>

<header>
    <a href="{{ route('siswa.home') }}" class="logo">Pintar.id</a>
    <div class="center-nav">
        <a href="{{ route('siswa.home') }}" class="nav-pill">Beranda</a>
        <a href="{{ route('siswa.materi') }}?mapel={{ urlencode($mapel ?? '') }}" class="nav-pill">Video Materi</a>
        <div class="nav-pill active">Catatan</div>
    </div>
    <div class="right-nav">
        <button class="btn-search">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><path d="M21 21l-4.35-4.35"></path></svg>
        </button>
        <a href="{{ route('siswa.notifikasi') }}" class="notification-bell" style="text-decoration:none; margin-right: 16px; position: relative; color: var(--dark-oak); display: flex; align-items: center; justify-content: center; width: 42px; height: 42px; border-radius: 50%; background: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.8); backdrop-filter: blur(12px); box-shadow: 0 4px 14px rgba(61,43,31,0.04); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
        </a>
        <div class="user-menu">
            <span class="user-name">Hi, {{ explode(' ', $userName)[0] }}</span>
            <div class="user-avatar">
                @if(isset($photoProfile) && $photoProfile)
                    <img src="{{ asset('uploads/profiles/' . $photoProfile) }}" alt="Profile" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                @else
                    {{ strtoupper(substr($userName, 0, 1)) }}
                @endif
            </div>
        </div>
    </div>
</header>

<div class="main-content">
    <div class="page-header">
        <div class="page-title">
            <h1>Rak Catatan Saya</h1>
            <p>Koleksi ringkasan dan catatan pembelajaranmu.</p>
        </div>
    </div>

    <div class="bookshelf-container">
        @if(isset($catatans) && count($catatans) > 0)
            @php 
                $chunks = array_chunk($catatans->toArray(), 6); 
            @endphp
            @foreach($chunks as $shelf)
                <div class="shelf">
                    @foreach($shelf as $note)
                        <a href="{{ route('siswa.catatan.edit', ['id' => $note['id_catatan']]) }}?mapel={{ urlencode($note['mapel']) }}" class="book book-{{ $note['cover_color'] ?? 'sage' }}">
                            <div class="book-title">{{ $note['judul'] }}</div>
                            <div class="book-author">{{ $note['mapel'] }}</div>
                        </a>
                    @endforeach
                </div>
            @endforeach
            
            {{-- Add empty shelves to make it look like a full bookshelf if there are few notes --}}
            @if(count($chunks) < 3)
                @for($i=0; $i<(3-count($chunks)); $i++)
                    <div class="shelf"></div>
                @endfor
            @endif
        @else
            <div class="empty-state">
                <div class="empty-icon">📚</div>
                <div class="empty-text">Rak catatanmu masih kosong. Mulai buat catatan pertamamu!</div>
            </div>
            <div class="shelf"></div>
            <div class="shelf"></div>
            <div class="shelf"></div>
        @endif
    </div>
</div>

</body>
</html>

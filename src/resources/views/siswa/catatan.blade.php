<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Catatan - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-oak:      #3D2B1F;
            --muted-sage:    #8E9680;
            --dusty-mauve:   #A37C76;
            --warm-amber:    #D9B382;
            --vintage-cream: #E6D8C1;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; }
        html, body { height:100%; }
        body { background-color:var(--vintage-cream); color:var(--dark-oak); overflow:hidden; display:flex; flex-direction:column; }

        .blob-1 { position:fixed; top:-10%; right:-5%; width:600px; height:600px; background:rgba(142,150,128,0.3); border-radius:50%; filter:blur(80px); z-index:0; pointer-events:none; }
        .blob-2 { position:fixed; bottom:-10%; left:-5%; width:400px; height:400px; background:rgba(217,179,130,0.3); border-radius:50%; filter:blur(60px); z-index:0; pointer-events:none; }
        .blob-3 { position:fixed; top:30%; left:10%; width:500px; height:500px; background:rgba(163,124,118,0.25); border-radius:50%; filter:blur(90px); z-index:0; pointer-events:none; }

        nav {
            padding:12px 32px;
            display:flex;
            align-items:center;
            justify-content: space-between;
            position:relative; z-index:100;
            background:rgba(230,216,193,0.80);
            backdrop-filter:blur(18px);
            border-bottom:1px solid rgba(255,255,255,0.55);
            flex-shrink:0;
        }

        .nav-left { display:flex; align-items:center; gap:20px; }
        .btn-back {
            display:flex; align-items:center; justify-content:center;
            width:36px; height:36px; border-radius:50%;
            background:rgba(61,43,31,0.08); color:var(--dark-oak);
            text-decoration:none; font-weight:700; transition:all 0.25s;
        }
        .btn-back:hover { background:var(--dark-oak); color:var(--vintage-cream); }
        
        .nav-title { font-size:18px; font-weight:800; color:var(--dark-oak); }

        .nav-right { display:flex; align-items:center; gap:12px; flex-shrink:0; }
        .btn-save {
            background:var(--muted-sage); color:#fff;
            padding:8px 20px; border-radius:30px; border:none;
            font-size:13px; font-weight:700; cursor:pointer;
            box-shadow:0 4px 14px rgba(142,150,128,0.3);
            transition:all 0.25s; font-family:'Outfit',sans-serif;
        }
        .btn-save:hover { background:#7b846e; transform:translateY(-2px); box-shadow:0 6px 18px rgba(142,150,128,0.4); }

        .page-body {
            flex:1; display:flex; padding:20px 24px; gap:24px;
            max-width:1600px; margin:0 auto; width:100%;
            position:relative; z-index:5; overflow:hidden;
        }

        .glass-card {
            background:rgba(255,255,255,0.25);
            backdrop-filter:blur(24px);
            -webkit-backdrop-filter:blur(24px);
            border:1px solid rgba(255,255,255,0.5);
            border-radius:24px;
            box-shadow:0 8px 32px rgba(61,43,31,0.08);
        }

        .left-split {
            flex:1; display:flex; flex-direction:column; overflow:hidden;
        }
        
        .notes-header {
            padding:20px 24px 16px; border-bottom:1px solid rgba(61,43,31,0.08);
            flex-shrink:0;
        }
        .notes-header input {
            width:100%; background:transparent; border:none; outline:none;
            font-family:'Outfit',sans-serif; font-size:24px; font-weight:800;
            color:var(--dark-oak);
        }
        .notes-header input::placeholder { color:rgba(61,43,31,0.3); }
        .notes-meta {
            font-size:12px; color:rgba(61,43,31,0.5); margin-top:4px; font-weight:600;
        }

        .notes-toolbar {
            padding:10px 24px; border-bottom:1px solid rgba(61,43,31,0.08);
            display:flex; gap:8px; flex-shrink:0; background:rgba(255,255,255,0.2);
        }
        .tool-btn {
            width:32px; height:32px; border-radius:8px; border:none;
            background:transparent; color:var(--dark-oak); cursor:pointer;
            font-family:'Outfit',sans-serif; font-size:14px; font-weight:700;
            transition:background 0.2s;
        }
        .tool-btn:hover { background:rgba(61,43,31,0.1); }

        .notes-body {
            flex:1; padding:24px; overflow-y:auto;
        }
        .notes-body::-webkit-scrollbar { width:4px; }
        .notes-body::-webkit-scrollbar-thumb { background:rgba(142,150,128,0.35); border-radius:99px; }
        .notes-body textarea {
            width:100%; height:100%; 
            background:rgba(255,255,255,0.4); 
            backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px);
            border:1px solid rgba(255,255,255,0.6);
            border-radius:16px; padding:20px;
            outline:none;
            font-family:'Outfit',sans-serif; font-size:15px; color:var(--dark-oak);
            line-height:1.6; resize:none;
            box-shadow:inset 0 2px 10px rgba(61,43,31,0.03);
        }
        .notes-body textarea::placeholder { color:rgba(61,43,31,0.3); }

        .right-split {
            flex:1; display:flex; flex-direction:column; gap:20px; overflow:hidden;
        }
        .video-card { flex-shrink:0; overflow:hidden; }
        .video-wrapper {
            position:relative; width:100%; aspect-ratio:16/9; max-height:35vh;
            background:linear-gradient(135deg, rgba(61,43,31,0.08), rgba(142,150,128,0.12));
            border-radius:18px 18px 0 0; overflow:hidden;
            display:flex; align-items:center; justify-content:center;
        }
        .video-placeholder {
            display:flex; flex-direction:column; align-items:center; gap:12px;
            color:rgba(61,43,31,0.3);
        }
        .video-placeholder-icon {
            width:64px; height:64px; border-radius:50%;
            background:rgba(61,43,31,0.07);
            display:flex; align-items:center; justify-content:center; font-size:24px;
        }
        .video-overlay-badge {
            position:absolute; top:12px; left:12px;
            background:rgba(217,179,130,0.88); backdrop-filter:blur(8px);
            color:var(--dark-oak); font-size:11px; font-weight:700;
            padding:5px 12px; border-radius:99px; z-index:10;
        }
        .video-info { padding:14px 20px; }
        .video-title { font-size:16px; font-weight:800; letter-spacing:-0.4px; margin-bottom:4px; }
        .video-meta { display:flex; gap:12px; font-size:12px; color:rgba(61,43,31,0.5); }

        .comment-card {
            flex:1; display:flex; flex-direction:column; overflow:hidden;
        }
        .comment-header {
            padding:16px 20px; border-bottom:1px solid rgba(61,43,31,0.08);
            font-size:15px; font-weight:800; flex-shrink:0;
            display:flex; align-items:center; gap:8px;
        }
        .comment-count { background:var(--muted-sage); color:#fff; font-size:10px; font-weight:700; padding:2px 8px; border-radius:99px; }
        
        .comment-list {
            flex:1; overflow-y:auto; padding:14px 18px;
            display:flex; flex-direction:column; gap:14px;
        }
        .comment-list::-webkit-scrollbar { width:4px; }
        .comment-list::-webkit-scrollbar-thumb { background:rgba(142,150,128,0.35); border-radius:99px; }
        
        .comment-item { display:flex; gap:10px; }
        .comment-avatar {
            width:32px; height:32px; border-radius:50%; flex-shrink:0;
            display:flex; align-items:center; justify-content:center;
            font-size:13px; font-weight:800; color:#fff;
        }
        .av-sage  { background:var(--muted-sage); }
        .av-amber { background:var(--warm-amber); color:var(--dark-oak); }
        .av-mauve { background:var(--dusty-mauve); }
        .comment-body { flex:1; }
        .comment-name { font-size:12px; font-weight:700; }
        .comment-time { font-size:11px; color:rgba(61,43,31,0.4); margin-left:6px; }
        .comment-text { font-size:12px; color:rgba(61,43,31,0.72); line-height:1.4; margin-top:2px; }

        .comment-input-area {
            padding:12px 16px; border-top:1px solid rgba(61,43,31,0.08); flex-shrink:0;
            display:flex; gap:10px;
        }
        .comment-input-area input {
            flex:1; border:1px solid rgba(61,43,31,0.1); border-radius:20px;
            padding:8px 14px; font-family:'Outfit',sans-serif; font-size:12px;
            background:rgba(255,255,255,0.5); outline:none; transition:border 0.2s;
        }
        .comment-input-area input:focus { border-color:var(--muted-sage); background:rgba(255,255,255,0.75); }
        .btn-send {
            background:var(--muted-sage); color:#fff; border:none; border-radius:50%;
            width:34px; height:34px; display:flex; align-items:center; justify-content:center;
            cursor:pointer; font-size:12px; transition:transform 0.2s;
        }
        .btn-send:hover { transform:scale(1.05); }

    </style>
</head>
<body>
<div class="blob-1"></div>
<div class="blob-2"></div>
<div class="blob-3"></div>

<nav>
    <div class="nav-left">
        <a href="{{ route('siswa.video') }}" class="btn-back">←</a>
        <div class="nav-title">Catatan Saya</div>
    </div>
    <div class="nav-right">
        <button class="btn-save" onclick="alert('Catatan berhasil disimpan!')">Simpan Catatan</button>
    </div>
</nav>

<div class="page-body">

    <div class="left-split glass-card">
        <div class="notes-header">
            <input type="text" placeholder="Judul Catatan..." value="Catatan: Persamaan Linear Bab 5">
            <div class="notes-meta">Terakhir diedit: Baru saja</div>
        </div>
        <div class="notes-toolbar">
            <button class="tool-btn">B</button>
            <button class="tool-btn">I</button>
            <button class="tool-btn">U</button>
            <div style="width:1px; background:rgba(61,43,31,0.1); margin:4px 8px;"></div>
            <button class="tool-btn">≣</button>
            <button class="tool-btn">⁝</button>
        </div>
        <div class="notes-body">
            <textarea placeholder="Mulai mengetik catatanmu di sini...
            
Tips: Catat poin-poin penting, rumus, atau bagian yang belum kamu mengerti dari video di sebelah kanan."></textarea>
        </div>
    </div>

    <div class="right-split">
        
        <div class="glass-card video-card">
            <div class="video-wrapper">
                <div class="video-placeholder">
                    <div class="video-placeholder-icon">▶</div>
                    <p>Video Pembelajaran</p>
                </div>
                <div class="video-overlay-badge">📐 Matematika · Bab 5</div>
            </div>
            <div class="video-info">
                <div class="video-title">Persamaan Linear Dua Variabel</div>
                <div class="video-meta">
                    <span>⏱️ 18:42</span>
                    <span>👩‍🏫 Bu Dewi Sartika</span>
                </div>
            </div>
        </div>

        <div class="glass-card comment-card">
            <div class="comment-header">
                💬 Komentar <span class="comment-count">24</span>
            </div>
            <div class="comment-list" id="commentList">
                <div class="comment-item">
                    <div class="comment-avatar av-sage">D</div>
                    <div class="comment-body">
                        <div class="comment-name">Dewi S <span class="comment-time">2 jam lalu</span></div>
                        <div class="comment-text">Penjelasannya sangat jelas! Akhirnya paham cara menyelesaikan persamaan linear 🎉</div>
                    </div>
                </div>
                <div class="comment-item">
                    <div class="comment-avatar av-amber">R</div>
                    <div class="comment-body">
                        <div class="comment-name">Rizky A <span class="comment-time">4 jam lalu</span></div>
                        <div class="comment-text">Bu, boleh minta contoh soal tambahannya?</div>
                    </div>
                </div>
                <div class="comment-item">
                    <div class="comment-avatar av-mauve">S</div>
                    <div class="comment-body">
                        <div class="comment-name">Sari P <span class="comment-time">kemarin</span></div>
                        <div class="comment-text">Di menit 8:30 cara substitusinya bisa dijelaskan lagi?</div>
                    </div>
                </div>
            </div>
            <div class="comment-input-area">
                <input type="text" id="commentBox" placeholder="Tulis komentar...">
                <button class="btn-send" onclick="submitComment()">➤</button>
            </div>
        </div>

    </div>
</div>

<script>
    function submitComment() {
        const box = document.getElementById('commentBox');
        const text = box.value.trim();
        if (!text) return;
        const list = document.getElementById('commentList');
        const colors = ['av-sage','av-amber','av-mauve'];
        const color = colors[Math.floor(Math.random()*3)];
        const initial = '{{ strtoupper(substr($userName, 0, 1)) }}';
        const name = '{{ $userName }}';
        const el = document.createElement('div');
        el.className = 'comment-item';
        el.innerHTML = `<div class="comment-avatar ${color}">${initial}</div><div class="comment-body"><div class="comment-name">${name} <span class="comment-time">Baru saja</span></div><div class="comment-text">${text}</div></div>`;
        list.appendChild(el);
        box.value = '';
        list.scrollTop = list.scrollHeight;
    }
</script>
</body>
</html>

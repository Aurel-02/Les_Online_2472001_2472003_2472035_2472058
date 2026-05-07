<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Pembelajaran - Pintar.id</title>
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
        body { background-color:var(--vintage-cream); color:var(--dark-oak); overflow-x:hidden; display:flex; flex-direction:column; }

        .blob-1 { position:fixed; top:-10%; right:-5%; width:600px; height:600px; background:rgba(142,150,128,0.2); border-radius:50%; filter:blur(80px); z-index:0; pointer-events:none; }
        .blob-2 { position:fixed; bottom:-10%; left:-5%; width:400px; height:400px; background:rgba(217,179,130,0.2); border-radius:50%; filter:blur(60px); z-index:0; pointer-events:none; }

        /* ══ NAVBAR (sesuai gambar referensi) ══ */
        nav {
            padding:12px 32px;
            display:flex;
            align-items:center;
            gap:20px;
            position:sticky; top:0; z-index:100;
            background:rgba(230,216,193,0.80);
            backdrop-filter:blur(18px);
            border-bottom:1px solid rgba(255,255,255,0.55);
            flex-shrink:0;
        }

        /* Search bar */
        .nav-search {
            display:flex; align-items:center; gap:8px;
            background:rgba(255,255,255,0.55);
            border:1.5px solid rgba(61,43,31,0.1);
            border-radius:30px; padding:8px 18px;
            flex:0 0 220px;
            transition:border 0.25s;
        }
        .nav-search:focus-within { border-color:var(--muted-sage); background:rgba(255,255,255,0.8); }
        .nav-search svg { opacity:0.45; flex-shrink:0; }
        .nav-search input { border:none; background:transparent; outline:none; font-family:'Outfit',sans-serif; font-size:14px; color:var(--dark-oak); width:100%; }
        .nav-search input::placeholder { color:rgba(61,43,31,0.38); }

        /* Nav tabs */
        .nav-tabs { display:flex; gap:4px; flex:1; justify-content:center; }
        .nav-tab {
            padding:8px 20px; border-radius:30px; font-size:14px; font-weight:600;
            text-decoration:none; color:rgba(61,43,31,0.6);
            transition:all 0.25s ease; cursor:pointer; border:none; background:transparent;
        }
        .nav-tab:hover { color:var(--dark-oak); background:rgba(61,43,31,0.06); }
        .nav-tab.active {
            background:var(--dark-oak); color:var(--vintage-cream);
            box-shadow:0 4px 14px rgba(61,43,31,0.25);
        }

        /* Nav right */
        .nav-right { display:flex; align-items:center; gap:12px; flex-shrink:0; }
        .nav-bell {
            width:38px; height:38px; border-radius:50%;
            background:rgba(255,255,255,0.5); border:1.5px solid rgba(61,43,31,0.1);
            display:flex; align-items:center; justify-content:center; cursor:pointer;
            position:relative; transition:background 0.2s;
        }
        .nav-bell:hover { background:rgba(255,255,255,0.85); }
        .nav-bell .dot { position:absolute; top:7px; right:7px; width:8px; height:8px; background:var(--dusty-mauve); border-radius:50%; border:2px solid var(--vintage-cream); }
        .nav-user {
            display:flex; align-items:center; gap:10px; cursor:pointer;
            background:rgba(255,255,255,0.5); border:1.5px solid rgba(61,43,31,0.1);
            border-radius:30px; padding:5px 14px 5px 5px;
            transition:background 0.2s;
        }
        .nav-user:hover { background:rgba(255,255,255,0.85); }
        .nav-avatar {
            width:30px; height:30px; border-radius:50%;
            background:var(--muted-sage); color:#fff;
            display:flex; align-items:center; justify-content:center;
            font-size:13px; font-weight:800;
        }
        .nav-username { font-size:13px; font-weight:700; color:var(--dark-oak); }
        .nav-role { font-size:11px; color:rgba(61,43,31,0.45); }

        /* ══ PAGE BODY ══ */
        .page-body {
            flex:1; display:flex; overflow:hidden;
            position:relative; z-index:5;
            padding:20px 24px;
            gap:20px;
            max-width:1400px; margin:0 auto; width:100%;
        }

        .glass-card {
            background:rgba(230,216,193,0.65);
            backdrop-filter:blur(14px);
            border:1px solid rgba(255,255,255,0.65);
            border-radius:22px;
            box-shadow:0 4px 24px rgba(61,43,31,0.08);
        }

        /* ══ LEFT: COMMENT (full height) ══ */
        .comment-col {
            width:320px; flex-shrink:0;
            display:flex; flex-direction:column;
            overflow:hidden;
        }
        .comment-header {
            padding:18px 20px 14px;
            border-bottom:1px solid rgba(61,43,31,0.08);
            font-size:16px; font-weight:800;
            display:flex; align-items:center; gap:8px;
            flex-shrink:0;
        }
        .comment-count { background:var(--muted-sage); color:#fff; font-size:11px; font-weight:700; padding:2px 9px; border-radius:99px; }
        .comment-list {
            flex:1; overflow-y:auto;
            padding:14px 18px;
            display:flex; flex-direction:column; gap:14px;
        }
        .comment-list::-webkit-scrollbar { width:4px; }
        .comment-list::-webkit-scrollbar-thumb { background:rgba(142,150,128,0.35); border-radius:99px; }
        .comment-item { display:flex; gap:10px; }
        .comment-avatar {
            width:36px; height:36px; border-radius:50%; flex-shrink:0;
            display:flex; align-items:center; justify-content:center;
            font-size:14px; font-weight:800; color:#fff;
        }
        .av-sage  { background:var(--muted-sage); }
        .av-amber { background:var(--warm-amber); color:var(--dark-oak); }
        .av-mauve { background:var(--dusty-mauve); }
        .comment-body { flex:1; }
        .comment-name { font-size:12px; font-weight:700; }
        .comment-time { font-size:11px; color:rgba(61,43,31,0.4); margin-left:6px; }
        .comment-text { font-size:12px; color:rgba(61,43,31,0.72); line-height:1.5; margin-top:3px; }
        .comment-like { display:inline-flex; align-items:center; gap:3px; font-size:11px; color:rgba(61,43,31,0.4); margin-top:5px; cursor:pointer; transition:color 0.2s; }
        .comment-like:hover { color:var(--dusty-mauve); }
        .comment-input-area {
            padding:14px 18px;
            border-top:1px solid rgba(61,43,31,0.08);
            flex-shrink:0;
        }
        .comment-input-area textarea {
            width:100%; resize:none; border:1.5px solid rgba(61,43,31,0.1);
            border-radius:12px; padding:10px 12px; font-family:'Outfit',sans-serif;
            font-size:13px; background:rgba(255,255,255,0.5); color:var(--dark-oak);
            outline:none; transition:border 0.25s;
        }
        .comment-input-area textarea:focus { border-color:var(--muted-sage); background:rgba(255,255,255,0.75); }
        .comment-input-area textarea::placeholder { color:rgba(61,43,31,0.32); }
        .btn-send {
            margin-top:8px; width:100%; padding:10px; border-radius:12px; border:none;
            background:var(--muted-sage); color:#fff; font-family:'Outfit',sans-serif;
            font-size:13px; font-weight:700; cursor:pointer; transition:all 0.3s;
        }
        .btn-send:hover { background:#7b846e; transform:translateY(-1px); }

        /* ══ RIGHT ══ */
        .right-col { flex:1; display:flex; flex-direction:column; gap:16px; overflow-y:auto; min-width:0; padding-right: 4px; }
        .right-col::-webkit-scrollbar { width:4px; }
        .right-col::-webkit-scrollbar-thumb { background:rgba(142,150,128,0.35); border-radius:99px; }

        /* Video player */
        .video-card { flex-shrink:0; overflow:hidden; }
        .video-wrapper {
            position:relative; width:100%; height: 380px;
            background:linear-gradient(135deg, rgba(61,43,31,0.08), rgba(142,150,128,0.12));
            border-radius:18px 18px 0 0; overflow:hidden;
            display:flex; align-items:center; justify-content:center;
        }
        .video-placeholder {
            display:flex; flex-direction:column; align-items:center; gap:12px;
            color:rgba(61,43,31,0.3);
        }
        .video-placeholder-icon {
            width:72px; height:72px; border-radius:50%;
            background:rgba(61,43,31,0.07);
            display:flex; align-items:center; justify-content:center; font-size:28px;
        }
        .video-placeholder p { font-size:14px; font-weight:600; }
        .video-top-overlay {
            position:absolute; top:12px; left:12px;
            display:flex; gap:10px; align-items:center;
            z-index:10;
        }
        .video-overlay-badge {
            background:rgba(217,179,130,0.88); backdrop-filter:blur(8px);
            color:var(--dark-oak); font-size:11px; font-weight:700;
            padding:5px 12px; border-radius:99px;
        }
        .video-info { padding:16px 20px; }
        .video-subject-tag { font-size:12px; font-weight:800; color:var(--muted-sage); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px; }
        .btn-note {
            background:var(--muted-sage); border:none;
            color:#fff; padding:5px 14px; border-radius:99px;
            font-size:11px; font-weight:700; cursor:pointer; transition:all 0.25s;
            display:flex; align-items:center; gap:6px; font-family:'Outfit',sans-serif;
            box-shadow:0 2px 8px rgba(142,150,128,0.3);
        }
        .btn-note:hover { background:#7b846e; transform:translateY(-2px); box-shadow:0 4px 12px rgba(142,150,128,0.4); }
        .video-title { font-size:18px; font-weight:800; letter-spacing:-0.4px; margin-bottom:7px; }
        .video-meta { display:flex; flex-wrap:wrap; gap:12px; font-size:12px; color:rgba(61,43,31,0.5); }
        .video-meta span { display:flex; align-items:center; gap:4px; }

        /* ══ NEXT VIDEO — horizontal scroll ══ */
        .next-card { flex-shrink:0; }
        .next-header {
            padding:14px 20px 10px;
            font-size:15px; font-weight:800;
            border-bottom:1px solid rgba(61,43,31,0.08);
            display:flex; align-items:center; gap:8px;
        }
        .next-scroll-wrap {
            padding:14px 16px;
            display:flex; gap:12px;
            overflow-x:auto; scroll-snap-type:x mandatory;
            -webkit-overflow-scrolling:touch;
        }
        .next-scroll-wrap::-webkit-scrollbar { height:4px; }
        .next-scroll-wrap::-webkit-scrollbar-track { background:transparent; }
        .next-scroll-wrap::-webkit-scrollbar-thumb { background:rgba(142,150,128,0.35); border-radius:99px; }
        .next-item {
            flex-shrink:0; width:180px; scroll-snap-align:start;
            border-radius:16px; text-decoration:none; color:inherit;
            padding:10px; transition:background 0.25s, transform 0.2s; cursor:pointer;
        }
        .next-item:hover { background:rgba(142,150,128,0.13); transform:translateY(-3px); }
        .next-item.active { background:rgba(142,150,128,0.18); border:1.5px solid rgba(142,150,128,0.35); }
        .next-thumb {
            width:100%; aspect-ratio:16/9; border-radius:10px;
            display:flex; align-items:center; justify-content:center;
            position:relative; overflow:hidden; margin-bottom:8px;
        }
        .next-thumb .play-icon {
            width:32px; height:32px; background:rgba(255,255,255,0.88);
            border-radius:50%; display:flex; align-items:center; justify-content:center;
            font-size:12px; color:var(--dark-oak); z-index:1;
        }
        .next-thumb .num-badge {
            position:absolute; top:5px; right:5px; background:rgba(0,0,0,0.38);
            color:#fff; font-size:10px; font-weight:700; padding:1px 6px; border-radius:6px;
        }
        .thumb-1 { background:linear-gradient(135deg,#8E9680,#6b7260); }
        .thumb-2 { background:linear-gradient(135deg,#D9B382,#c49a50); }
        .thumb-3 { background:linear-gradient(135deg,#A37C76,#7d5a55); }
        .thumb-4 { background:linear-gradient(135deg,#8E9680,#A37C76); }
        .thumb-5 { background:linear-gradient(135deg,#D9B382,#A37C76); }
        .next-item-title { font-size:13px; font-weight:700; line-height:1.35; color:var(--dark-oak); margin-bottom:3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 160px; }
        .next-item-sub { font-size:12px; color:rgba(61,43,31,0.48); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 160px; }
        .next-item-dur { font-size:12px; font-weight:700; color:var(--muted-sage); margin-top:4px; }

        @media(max-width:1024px) {
            .page-body { flex-direction:column; overflow:auto; height:auto; }
            .comment-col { width:100%; height:480px; order:2; }
            .right-col { order:1; }
        }
        @media(max-width:640px) {
            nav { padding:10px 14px; gap:10px; }
            .nav-tabs { display:none; }
            .nav-search { flex:1; }
            .page-body { padding:12px; }
        }
    </style>
</head>
<body>
<div class="blob-1"></div>
<div class="blob-2"></div>

<!-- ══ NAVBAR ══ -->
<nav>
    <!-- Search -->
    <div class="nav-search">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--dark-oak)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" placeholder="Cari materi...">
    </div>

    <!-- Tabs -->
    <div class="nav-tabs">
        <a href="{{ route('siswa.home') }}" class="nav-tab">Beranda</a>
        <span class="nav-tab active">Matematika</span>
        <span class="nav-tab">Bahasa</span>
        <span class="nav-tab">IPA</span>
        <span class="nav-tab">IPS</span>
    </div>

    <!-- Right -->
    <div class="nav-right">
        <div class="nav-bell">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="var(--dark-oak)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
            <span class="dot"></span>
        </div>
        <div class="nav-user">
            <div class="nav-avatar">{{ strtoupper(substr($userName, 0, 1)) }}</div>
            <div>
                <div class="nav-username">{{ $userName }}</div>
                <div class="nav-role">siswa</div>
            </div>
        </div>
    </div>
</nav>

<!-- ══ PAGE BODY ══ -->
<div class="page-body">

    <!-- KIRI: KOMENTAR -->
    <div class="comment-col glass-card">
        <div class="comment-header">
            💬 Komentar <span class="comment-count">24</span>
        </div>
        <div class="comment-list" id="commentList">
            <div class="comment-item">
                <div class="comment-avatar av-sage">D</div>
                <div class="comment-body">
                    <div class="comment-name">Dewi S <span class="comment-time">2 jam lalu</span></div>
                    <div class="comment-text">Penjelasannya sangat jelas! Akhirnya paham cara menyelesaikan persamaan linear 🎉</div>
                    <div class="comment-like">❤️ 12 Suka</div>
                </div>
            </div>
            <div class="comment-item">
                <div class="comment-avatar av-amber">R</div>
                <div class="comment-body">
                    <div class="comment-name">Rizky A <span class="comment-time">4 jam lalu</span></div>
                    <div class="comment-text">Bu, boleh minta contoh soal tambahannya? Yang di video sudah mengerti tapi mau latihan lebih.</div>
                    <div class="comment-like">❤️ 7 Suka</div>
                </div>
            </div>
            <div class="comment-item">
                <div class="comment-avatar av-mauve">S</div>
                <div class="comment-body">
                    <div class="comment-name">Sari P <span class="comment-time">kemarin</span></div>
                    <div class="comment-text">Di menit 8:30 cara substitusinya bisa dijelaskan lagi? Sedikit bingung di bagian itu.</div>
                    <div class="comment-like">❤️ 3 Suka</div>
                </div>
            </div>
            <div class="comment-item">
                <div class="comment-avatar av-sage">F</div>
                <div class="comment-body">
                    <div class="comment-name">Fajar N <span class="comment-time">kemarin</span></div>
                    <div class="comment-text">Video ini sangat membantu persiapan ulangan tengah semester. Makasih Bu Dewi! 🙏</div>
                    <div class="comment-like">❤️ 18 Suka</div>
                </div>
            </div>
            <div class="comment-item">
                <div class="comment-avatar av-amber">A</div>
                <div class="comment-body">
                    <div class="comment-name">Anisa K <span class="comment-time">2 hari lalu</span></div>
                    <div class="comment-text">Animasinya keren banget! Jadi lebih mudah dipahami dibanding baca buku sendiri.</div>
                    <div class="comment-like">❤️ 9 Suka</div>
                </div>
            </div>
            <div class="comment-item">
                <div class="comment-avatar av-mauve">B</div>
                <div class="comment-body">
                    <div class="comment-name">Budi R <span class="comment-time">2 hari lalu</span></div>
                    <div class="comment-text">Metode eliminasi di 12:45 itu keren. Lebih cepat dari cara yang biasa diajarkan di sekolah.</div>
                    <div class="comment-like">❤️ 5 Suka</div>
                </div>
            </div>
            <div class="comment-item">
                <div class="comment-avatar av-sage">L</div>
                <div class="comment-body">
                    <div class="comment-name">Laila M <span class="comment-time">3 hari lalu</span></div>
                    <div class="comment-text">Penjelasan grafik linearnya mudah dipahami. Terima kasih banyak!</div>
                    <div class="comment-like">❤️ 6 Suka</div>
                </div>
            </div>
        </div>
        <div class="comment-input-area">
            <textarea id="commentBox" rows="3" placeholder="Tulis komentar atau pertanyaan..."></textarea>
            <button class="btn-send" onclick="submitComment()">✉️ Kirim Komentar</button>
        </div>
    </div>

    <!-- KANAN -->
    <div class="right-col">

        <!-- VIDEO PLAYER -->
        <div class="glass-card video-card">
            <div class="video-wrapper">
                <div class="video-placeholder">
                    <div class="video-placeholder-icon">▶</div>
                    <p>Video akan ditampilkan di sini</p>
                </div>
                <div class="video-top-overlay">
                    <div class="video-overlay-badge">📐 Matematika · Bab 5</div>
                    <button class="btn-note">📝 Buat Catatan</button>
                </div>
            </div>
            <div class="video-info">
                <div class="video-subject-tag">📐 Matematika · Bab 5</div>
                <div class="video-title">Persamaan Linear Dua Variabel — Metode Substitusi &amp; Eliminasi</div>
                <div class="video-meta">
                    <span>👁️ 1.2k ditonton</span>
                    <span>⏱️ 18:42</span>
                    <span>👩‍🏫 Bu Dewi Sartika</span>
                    <span>📅 2 Mei 2025</span>
                </div>
            </div>
        </div>

        <!-- NEXT VIDEO — horizontal scroll -->
        <div class="glass-card next-card">
            <div class="next-header">▶️ Video Selanjutnya</div>
            <div class="next-scroll-wrap">

                <a href="#" class="next-item active">
                    <div class="next-thumb thumb-1">
                        <div class="play-icon">▶</div>
                        <span class="num-badge">6</span>
                    </div>
                    <div class="next-item-title">Pertidaksamaan Linear Satu Variabel</div>
                    <div class="next-item-sub">Matematika · Bab 6</div>
                    <div class="next-item-dur">⏱ 14:20</div>
                </a>

                <a href="#" class="next-item">
                    <div class="next-thumb thumb-2">
                        <div class="play-icon">▶</div>
                        <span class="num-badge">7</span>
                    </div>
                    <div class="next-item-title">Sistem Persamaan Linear Tiga Variabel</div>
                    <div class="next-item-sub">Matematika · Bab 7</div>
                    <div class="next-item-dur">⏱ 22:05</div>
                </a>

                <a href="#" class="next-item">
                    <div class="next-thumb thumb-3">
                        <div class="play-icon">▶</div>
                        <span class="num-badge">8</span>
                    </div>
                    <div class="next-item-title">Latihan Soal: Persamaan &amp; Pertidaksamaan</div>
                    <div class="next-item-sub">Matematika · Bab 7</div>
                    <div class="next-item-dur">⏱ 09:30</div>
                </a>

                <a href="#" class="next-item">
                    <div class="next-thumb thumb-4">
                        <div class="play-icon">▶</div>
                        <span class="num-badge">9</span>
                    </div>
                    <div class="next-item-title">Grafik Fungsi Linear di Koordinat Kartesius</div>
                    <div class="next-item-sub">Matematika · Bab 8</div>
                    <div class="next-item-dur">⏱ 17:48</div>
                </a>

                <a href="#" class="next-item">
                    <div class="next-thumb thumb-5">
                        <div class="play-icon">▶</div>
                        <span class="num-badge">10</span>
                    </div>
                    <div class="next-item-title">Fungsi Kuadrat dan Grafiknya</div>
                    <div class="next-item-sub">Matematika · Bab 9</div>
                    <div class="next-item-dur">⏱ 20:15</div>
                </a>

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
        el.innerHTML = `<div class="comment-avatar ${color}">${initial}</div><div class="comment-body"><div class="comment-name">${name} <span class="comment-time">Baru saja</span></div><div class="comment-text">${text}</div><div class="comment-like">❤️ 0 Suka</div></div>`;
        list.insertBefore(el, list.firstChild);
        box.value = '';
        list.scrollTop = 0;
    }
    document.getElementById('commentList').addEventListener('click', e => {
        if (e.target.classList.contains('comment-like')) {
            const n = parseInt(e.target.textContent.match(/\d+/)[0]);
            e.target.textContent = `❤️ ${n+1} Suka`;
            e.target.style.color = 'var(--dusty-mauve)';
        }
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
=======
    <meta name="csrf-token" content="{{ csrf_token() }}">
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
    <title>Chat Guru - Pintar.id</title>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: #F7F4F0;
            color: var(--dark-oak);
            overflow-x: hidden;
            display: flex;
            height: 100vh;
        }

        /* ── Blobs Background ── */
        .blob-1 { position: fixed; top: -10%; right: 10%; width: 500px; height: 500px; background: rgba(142, 150, 128, 0.15); border-radius: 50%; filter: blur(80px); z-index: 0; pointer-events: none; }
        .blob-2 { position: fixed; bottom: -10%; left: 20%; width: 400px; height: 400px; background: rgba(217, 179, 130, 0.15); border-radius: 50%; filter: blur(60px); z-index: 0; pointer-events: none; }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-width);
            background: rgba(230, 216, 193, 0.85);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255,255,255,0.6);
            height: 100vh;
            padding: 32px 24px;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 50;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            margin-bottom: 60px;
        }

        .logo-text { font-size: 26px; font-weight: 800; color: var(--dark-oak); letter-spacing: -0.5px; }

        .sidebar-menu { flex: 1; display: flex; flex-direction: column; gap: 8px; overflow-y: auto; } .sidebar-menu::-webkit-scrollbar { display: none; }

        .sidebar-item {
            display: flex; align-items: center; gap: 14px;
            padding: 14px 18px; border-radius: 16px;
            text-decoration: none; color: rgba(61,43,31,0.7);
            font-weight: 600; font-size: 15px;
            transition: all 0.3s ease;
        }

        .sidebar-item:hover, .sidebar-item.active {
            background: rgba(255,255,255,0.5);
            color: var(--dark-oak);
            box-shadow: 0 4px 12px rgba(61,43,31,0.03);
        }

        .sidebar-item-icon { font-size: 20px; }

        .logout-container { margin-top: auto; }

        .btn-logout {
            width: 100%; padding: 14px; border-radius: 99px;
            font-size: 15px; font-weight: 600; color: var(--dusty-mauve);
            background: rgba(163, 124, 118, 0.08); border: none;
            cursor: pointer; transition: all 0.3s ease;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }

        .btn-logout:hover { background: rgba(163, 124, 118, 0.15); color: #8a655f; }

        /* ── Main Content Area ── */
        .main-wrapper {
            flex: 1;
            margin-left: var(--sidebar-width);
            height: 100vh;
            overflow: hidden; /* Prevent scrolling for the main body */
            position: relative;
            z-index: 5;
            display: flex;
            flex-direction: column;
        }

        /* ── Topbar (Header) ── */
        .topbar {
            padding: 24px 48px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            background: transparent;
            z-index: 40;
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
            text-decoration: none;
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
            overflow: hidden;
        }

        /* ── Content Body (Chat) ── */
        .content-body {
            flex: 1;
            padding: 0;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .chat-container {
            flex: 1;
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(20px);
            border: none;
            border-radius: 0;
            display: flex;
            overflow: hidden;
        }

        /* ── Chat Sidebar (Guru List) ── */
        .chat-sidebar {
            width: 320px;
            border-right: 1px solid rgba(61,43,31,0.1);
            display: flex;
            flex-direction: column;
            background: rgba(255,255,255,0.3);
        }

        .chat-sidebar-header {
            padding: 24px;
            border-bottom: 1px solid rgba(61,43,31,0.1);
        }

        .chat-sidebar-header h3 {
            font-size: 20px;
            font-weight: 800;
            color: var(--dark-oak);
        }

        .search-container {
            margin-top: 16px;
            position: relative;
        }

        .search-container input {
            width: 100%;
            padding: 12px 16px 12px 40px;
            border-radius: 99px;
            border: 1px solid rgba(61,43,31,0.2);
            background: rgba(255,255,255,0.7);
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            outline: none;
            transition: all 0.3s;
        }

        .search-container input:focus {
            border-color: var(--muted-sage);
            background: #fff;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(61,43,31,0.5);
        }

        .contact-list {
            flex: 1;
            overflow-y: auto;
            padding: 12px;
        }

        .contact-list::-webkit-scrollbar {
            width: 6px;
        }
        .contact-list::-webkit-scrollbar-thumb {
            background: rgba(61,43,31,0.2);
            border-radius: 10px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 4px;
        }

        .contact-item:hover, .contact-item.active {
            background: rgba(255,255,255,0.6);
            box-shadow: 0 4px 12px rgba(61,43,31,0.03);
        }

        .contact-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--muted-sage);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
            position: relative;
        }

        .status-dot {
            width: 12px;
            height: 12px;
            background: #4cd137;
            border: 2px solid #fff;
            border-radius: 50%;
            position: absolute;
            bottom: 0;
            right: 0;
        }
        .status-dot.offline {
            background: #dcdde1;
        }

        .contact-info {
            flex: 1;
            overflow: hidden;
        }

        .contact-name {
            font-weight: 700;
            color: var(--dark-oak);
            font-size: 15px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .contact-subject {
            font-size: 13px;
            color: rgba(61,43,31,0.6);
            margin-top: 2px;
        }

        .contact-meta {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 6px;
        }

        .contact-time {
            font-size: 11px;
            color: rgba(61,43,31,0.5);
            font-weight: 600;
        }

        .unread-badge {
            background: var(--dusty-mauve);
            color: white;
            font-size: 11px;
            font-weight: 800;
            padding: 2px 6px;
            border-radius: 10px;
        }

        /* ── Chat Main Area ── */
        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: rgba(255,255,255,0.2);
        }

        .chat-header {
            padding: 20px 32px;
            border-bottom: 1px solid rgba(61,43,31,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255,255,255,0.4);
            backdrop-filter: blur(10px);
        }

        .active-chat-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .active-chat-name {
            font-size: 18px;
            font-weight: 800;
            color: var(--dark-oak);
        }

        .active-chat-status {
            font-size: 13px;
            color: #4cd137;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .active-chat-status::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #4cd137;
            border-radius: 50%;
            display: inline-block;
        }

        .chat-messages {
            flex: 1;
            padding: 32px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .message-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .message-date {
            text-align: center;
            margin: 16px 0;
            position: relative;
        }

        .message-date span {
            background: rgba(255,255,255,0.6);
            padding: 6px 16px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 600;
            color: rgba(61,43,31,0.6);
        }

        .message-row {
            display: flex;
            gap: 12px;
            max-width: 80%;
        }

        .message-row.sent {
            align-self: flex-end;
            flex-direction: row-reverse;
        }

        .message-row.received {
            align-self: flex-start;
        }

        .message-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--muted-sage);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .message-bubble {
            padding: 14px 18px;
            border-radius: 20px;
            font-size: 15px;
            line-height: 1.5;
            position: relative;
        }

        .sent .message-bubble {
            background: var(--dark-oak);
            color: white;
            border-bottom-right-radius: 4px;
        }

        .received .message-bubble {
            background: white;
            color: var(--dark-oak);
            border-bottom-left-radius: 4px;
            box-shadow: 0 4px 12px rgba(61,43,31,0.04);
        }

        .message-time {
            font-size: 11px;
            margin-top: 6px;
            opacity: 0.7;
            display: block;
        }

        .sent .message-time {
            text-align: right;
            color: rgba(255,255,255,0.8);
        }

        .received .message-time {
            color: rgba(61,43,31,0.6);
        }

        .chat-input-area {
            padding: 20px 32px;
            background: rgba(255,255,255,0.4);
            border-top: 1px solid rgba(61,43,31,0.1);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-attachment {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(255,255,255,0.6);
            border: 1px solid rgba(61,43,31,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--dark-oak);
        }

        .btn-attachment:hover {
            background: white;
            transform: scale(1.05);
        }

        .input-wrapper {
            flex: 1;
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            padding: 16px 24px;
            border-radius: 99px;
            border: 1px solid rgba(61,43,31,0.2);
            background: white;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            outline: none;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(61,43,31,0.02);
        }

        .input-wrapper input:focus {
            border-color: var(--dusty-mauve);
            box-shadow: 0 4px 16px rgba(163, 124, 118, 0.1);
        }

        .btn-send {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--dark-oak);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            color: white;
            box-shadow: 0 4px 12px rgba(61,43,31,0.2);
        }

        .btn-send:hover {
            transform: scale(1.05);
            background: #2a1e15;
        }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); transition: 0.3s; }
            .main-wrapper { margin-left: 0; }
            .chat-sidebar { width: 100px; }
            .contact-info, .contact-meta { display: none; }
            .chat-sidebar-header h3, .search-container { display: none; }
            .contact-item { justify-content: center; padding: 12px 0; }
            .content-body { padding: 0 24px 24px; }
            .topbar { padding: 24px; justify-content: space-between; }
        }
    </style>
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <!-- ══ SIDEBAR ══ -->
    <aside class="sidebar">
        <a href="{{ route('siswa.home') }}" class="logo-container">
            <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z"
                      fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/>
                <circle cx="12" cy="13" r="4" fill="var(--vintage-cream)" />
            </svg>
            <div class="logo-text">Pintar.id</div>
        </a>

        <div class="sidebar-menu">
            <a href="{{ route('siswa.home') }}" class="sidebar-item {{ request()->routeIs('siswa.home') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                </span> Dashboard
            </a>
            @if(auth()->user() && !in_array((int)auth()->user()->id_jenjang, [1, 2]))
            <a href="{{ route('siswa.ptn') }}" class="sidebar-item {{ request()->routeIs('siswa.ptn') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
                </span> Info Univ & PTN
            </a>
            <a href="{{ route('siswa.jurusan') }}" class="sidebar-item {{ request()->routeIs('siswa.jurusan') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                </span> Rekomendasi Jurusan
            </a>
            @endif
            <a href="{{ route('siswa.paket-belajar') }}" class="sidebar-item {{ request()->routeIs('siswa.paket-belajar') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                </span> Paket Belajar
            </a>
            <a href="{{ route('siswa.chat') }}" class="sidebar-item {{ request()->routeIs('siswa.chat') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                </span> Chat 
            </a>
<<<<<<< HEAD
            <a href="{{ route('siswa.notifikasi') }}" class="sidebar-item {{ request()->routeIs('siswa.notifikasi') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                </span> Notifikasi
            </a>
=======
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
        </div>

        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- ══ MAIN CONTENT ══ -->
    <main class="main-wrapper">

        <!-- ── CHAT BODY ── -->
        <div class="content-body">
            <div class="chat-container">
                <!-- ── CHAT SIDEBAR ── -->
                <div class="chat-sidebar">
                    <div class="chat-sidebar-header">
                        <h3>Pesan</h3>
                        <div class="search-container">
<<<<<<< HEAD
                            <svg class="search-icon" width="1" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            <input type="text" placeholder="Cari guru...">
                        </div>
                    </div>
                    
                    <div class="contact-list">
                        <!-- Contact 1 (Active) -->
                        <div class="contact-item active">
                            <div class="contact-avatar" style="background: var(--dusty-mauve);">
                                BD
                                <div class="status-dot"></div>
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">Budi Darmawan</div>
                                <div class="contact-subject">Guru Matematika</div>
                            </div>
                            <div class="contact-meta">
                                <span class="contact-time">10:45</span>
                                <span class="unread-badge">2</span>
                            </div>
                        </div>

                        <!-- Contact 2 -->
                        <div class="contact-item">
                            <div class="contact-avatar" style="background: var(--muted-sage);">
                                SN
                                <div class="status-dot offline"></div>
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">Siti Nurbaya</div>
                                <div class="contact-subject">Guru Bahasa Inggris</div>
                            </div>
                            <div class="contact-meta">
                                <span class="contact-time">Kemarin</span>
                            </div>
                        </div>

                        <!-- Contact 3 -->
                        <div class="contact-item">
                            <div class="contact-avatar" style="background: var(--warm-amber);">
                                AS
                                <div class="status-dot"></div>
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">Agus Salim</div>
                                <div class="contact-subject">Guru IPA</div>
                            </div>
                            <div class="contact-meta">
                                <span class="contact-time">Senin</span>
                            </div>
=======
                            <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            <input type="text" id="search-contact" placeholder="Cari guru...">
                        </div>
                    </div>
                    
                    <div class="contact-list" id="contacts-container">
                        <!-- Contacts loaded dynamically -->
                        <div style="padding: 24px; text-align: center; color: rgba(61,43,31,0.5);">
                            Memuat kontak...
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
                        </div>
                    </div>
                </div>

                <!-- ── CHAT MAIN AREA ── -->
<<<<<<< HEAD
                <div class="chat-main">
                    <div class="chat-header">
                        <div class="active-chat-info">
                            <div class="contact-avatar" style="background: var(--dusty-mauve);">
                                BD
                            </div>
                            <div>
                                <div class="active-chat-name">Budi Darmawan</div>
=======
                <div class="chat-main" id="chat-main-area" style="display: none;">
                    <div class="chat-header">
                        <div class="active-chat-info">
                            <div class="contact-avatar" id="active-avatar" style="background: var(--dusty-mauve);">
                                BD
                            </div>
                            <div>
                                <div class="active-chat-name" id="active-name">Budi Darmawan</div>
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
                                <div class="active-chat-status">Online</div>
                            </div>
                        </div>
                        <div class="chat-actions">
                            <button class="btn-attachment" style="border: none; background: transparent;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                            </button>
                        </div>
                    </div>

                    <div class="chat-messages" id="chat-messages">
<<<<<<< HEAD
                        <div class="message-date">
                            <span>Hari ini</span>
                        </div>

                        <div class="message-row received">
                            <div class="message-avatar" style="background: var(--dusty-mauve);">BD</div>
                            <div class="message-group">
                                <div class="message-bubble">
                                    Halo! Ada yang bisa Bapak bantu terkait materi Aljabar kemarin?
                                    <span class="message-time">10:30</span>
                                </div>
                            </div>
                        </div>

                        <div class="message-row sent">
                            <div class="message-avatar" style="background: var(--warm-amber);">ME</div>
                            <div class="message-group">
                                <div class="message-bubble">
                                    Halo Pak Budi, iya saya masih bingung di bagian persamaan linear dua variabel.
                                    <span class="message-time">10:35</span>
                                </div>
                            </div>
                        </div>

                        <div class="message-row received">
                            <div class="message-avatar" style="background: var(--dusty-mauve);">BD</div>
                            <div class="message-group">
                                <div class="message-bubble">
                                    Oh bagian itu. Coba kamu buka halaman 45 di modul, di sana ada contoh soalnya.
                                    <span class="message-time">10:40</span>
                                </div>
                                <div class="message-bubble">
                                    Kalau masih kurang jelas, nanti Bapak kasih video penjelasan tambahannya ya.
                                    <span class="message-time">10:45</span>
                                </div>
                            </div>
                        </div>
=======
                        <!-- Messages loaded dynamically -->
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
                    </div>

                    <div class="chat-input-area">
                        <button class="btn-attachment">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                        </button>
                        <div class="input-wrapper">
<<<<<<< HEAD
                            <input type="text" id="message-input" placeholder="Ketik pesan di sini...">
=======
                            <input type="text" id="message-input" placeholder="Ketik pesan di sini..." autocomplete="off">
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
                        </div>
                        <button class="btn-send" id="btn-send">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        </button>
                    </div>
                </div>
<<<<<<< HEAD
=======

                <!-- Fallback empty state -->
                <div class="chat-main" id="chat-empty-state" style="display: flex; align-items: center; justify-content: center; flex-direction: column; text-align: center; padding: 48px; color: rgba(61,43,31,0.5);">
                    <div style="font-size: 64px; margin-bottom: 16px;">💬</div>
                    <h3>Mulai Obrolan</h3>
                    <p style="margin-top: 8px; font-size: 14px;">Pilih guru dari daftar di samping untuk memulai percakapan.</p>
                </div>
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
            </div>
        </div>
    </main>

    <script>
<<<<<<< HEAD
        // Simple chat interaction simulation
        const messageInput = document.getElementById('message-input');
        const btnSend = document.getElementById('btn-send');
        const chatMessages = document.getElementById('chat-messages');

        function sendMessage() {
            const text = messageInput.value.trim();
            if (text === '') return;

            const time = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            
            const messageHtml = `
                <div class="message-row sent">
                    <div class="message-avatar" style="background: var(--warm-amber);">ME</div>
                    <div class="message-group">
                        <div class="message-bubble">
                            ${text}
                            <span class="message-time">${time}</span>
                        </div>
                    </div>
                </div>
            `;
            
            chatMessages.insertAdjacentHTML('beforeend', messageHtml);
            messageInput.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        btnSend.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendMessage();
=======
        document.addEventListener('DOMContentLoaded', function() {
            const contactsContainer = document.getElementById('contacts-container');
            const chatMainArea = document.getElementById('chat-main-area');
            const chatEmptyState = document.getElementById('chat-empty-state');
            const activeName = document.getElementById('active-name');
            const activeAvatar = document.getElementById('active-avatar');
            const chatMessages = document.getElementById('chat-messages');
            const messageInput = document.getElementById('message-input');
            const btnSend = document.getElementById('btn-send');
            const searchContact = document.getElementById('search-contact');

            let activeContactId = null;
            let pollingInterval = null;
            let allContacts = [];

            // Get CSRF Token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Load Contacts
            function loadContacts(selectedId = null) {
                fetch('{{ route("chat.contacts") }}')
                    .then(response => response.json())
                    .then(data => {
                        allContacts = data;
                        renderContacts(allContacts, selectedId);
                    })
                    .catch(err => {
                        console.error('Error fetching contacts:', err);
                        contactsContainer.innerHTML = '<div style="padding:24px;text-align:center;color:red;">Gagal memuat kontak.</div>';
                    });
            }

            // Render Contacts List
            function renderContacts(contacts, selectedId = null) {
                if (contacts.length === 0) {
                    contactsContainer.innerHTML = '<div style="padding:24px;text-align:center;color:rgba(61,43,31,0.5);">Tidak ada kontak.</div>';
                    return;
                }

                contactsContainer.innerHTML = '';
                contacts.forEach(contact => {
                    const initials = contact.nama.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
                    const activeClass = (selectedId == contact.id_user || activeContactId == contact.id_user) ? 'active' : '';
                    
                    const avatarContent = contact.photo_profile 
                        ? `<img src="/uploads/profiles/${contact.photo_profile}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;" />`
                        : initials;

                    const unreadBadge = contact.unread_count > 0 
                        ? `<span class="unread-badge">${contact.unread_count}</span>` 
                        : '';

                    const lastMessageText = contact.last_message ? contact.last_message : 'Belum ada pesan';
                    const lastMessageTime = contact.last_time ? contact.last_time : '';

                    const itemHtml = `
                        <div class="contact-item ${activeClass}" data-id="${contact.id_user}" data-name="${contact.nama}">
                            <div class="contact-avatar" style="background: var(--dusty-mauve);">
                                ${avatarContent}
                                <div class="status-dot"></div>
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">${contact.nama}</div>
                                <div class="contact-subject" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${lastMessageText}</div>
                            </div>
                            <div class="contact-meta">
                                <span class="contact-time">${lastMessageTime}</span>
                                ${unreadBadge}
                            </div>
                        </div>
                    `;
                    contactsContainer.insertAdjacentHTML('beforeend', itemHtml);
                });

                // Attach Event Listeners to contact items
                document.querySelectorAll('.contact-item').forEach(item => {
                    item.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        const name = this.getAttribute('data-name');
                        selectContact(id, name);
                    });
                });
            }

            // Filter Contacts locally
            searchContact.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                const filtered = allContacts.filter(c => c.nama.toLowerCase().includes(query));
                renderContacts(filtered);
            });

            // Select Contact to Chat
            function selectContact(id, name) {
                activeContactId = id;
                
                // Update UI active states
                document.querySelectorAll('.contact-item').forEach(item => {
                    item.classList.remove('active');
                    if (item.getAttribute('data-id') == id) {
                        item.classList.add('active');
                    }
                });

                // Set header details
                activeName.textContent = name;
                const initials = name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
                
                const matchedContact = allContacts.find(c => c.id_user == id);
                if (matchedContact && matchedContact.photo_profile) {
                    activeAvatar.innerHTML = `<img src="/uploads/profiles/${matchedContact.photo_profile}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;" />`;
                } else {
                    activeAvatar.textContent = initials;
                    activeAvatar.style.background = 'var(--dusty-mauve)';
                }

                // Show chat window, hide empty state
                chatEmptyState.style.display = 'none';
                chatMainArea.style.display = 'flex';

                // Load Message History
                chatMessages.innerHTML = '<div style="padding:24px;text-align:center;color:rgba(61,43,31,0.5);">Memuat pesan...</div>';
                
                fetch(`/chat/messages/${id}`)
                    .then(response => response.json())
                    .then(messages => {
                        renderMessages(messages);
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                        
                        // Clear previous polling
                        if (pollingInterval) clearInterval(pollingInterval);
                        
                        // Start polling for new messages every 3 seconds
                        pollingInterval = setInterval(pollMessages, 3000);
                        
                        // Reload contacts to update read status badges
                        loadContacts(id);
                    })
                    .catch(err => {
                        console.error('Error fetching messages:', err);
                        chatMessages.innerHTML = '<div style="padding:24px;text-align:center;color:red;">Gagal memuat pesan.</div>';
                    });
            }

            // Render Messages List
            function renderMessages(messages) {
                if (messages.length === 0) {
                    chatMessages.innerHTML = '<div style="padding:24px;text-align:center;color:rgba(61,43,31,0.4);font-size:14px;">Belum ada percakapan. Kirim pesan pertama untuk memulai!</div>';
                    return;
                }

                chatMessages.innerHTML = '';
                messages.forEach(msg => {
                    const rowClass = msg.is_sent ? 'sent' : 'received';
                    const avatarInitials = msg.is_sent ? 'ME' : activeName.textContent.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
                    const avatarBg = msg.is_sent ? 'var(--warm-amber)' : 'var(--dusty-mauve)';

                    const matchedContact = allContacts.find(c => c.id_user == activeContactId);
                    const avatarContent = (!msg.is_sent && matchedContact && matchedContact.photo_profile)
                        ? `<img src="/uploads/profiles/${matchedContact.photo_profile}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;" />`
                        : avatarInitials;

                    const msgHtml = `
                        <div class="message-row ${rowClass}">
                            <div class="message-avatar" style="background: ${avatarBg};">${avatarContent}</div>
                            <div class="message-group">
                                <div class="message-bubble">
                                    ${escapeHtml(msg.message)}
                                    <span class="message-time">${msg.time}</span>
                                </div>
                            </div>
                        </div>
                    `;
                    chatMessages.insertAdjacentHTML('beforeend', msgHtml);
                });
            }

            // Poll for new messages
            function pollMessages() {
                if (!activeContactId) return;
                
                fetch(`/chat/poll/${activeContactId}`)
                    .then(response => response.json())
                    .then(newMsgs => {
                        if (newMsgs.length > 0) {
                            // If it had the empty chat fallback message, clear it
                            if (chatMessages.querySelector('.message-row') === null) {
                                chatMessages.innerHTML = '';
                            }
                            
                            newMsgs.forEach(msg => {
                                const matchedContact = allContacts.find(c => c.id_user == activeContactId);
                                const avatarInitials = activeName.textContent.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
                                const avatarContent = (matchedContact && matchedContact.photo_profile)
                                    ? `<img src="/uploads/profiles/${matchedContact.photo_profile}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;" />`
                                    : avatarInitials;

                                const msgHtml = `
                                    <div class="message-row received">
                                        <div class="message-avatar" style="background: var(--dusty-mauve);">${avatarContent}</div>
                                        <div class="message-group">
                                            <div class="message-bubble">
                                                ${escapeHtml(msg.message)}
                                                <span class="message-time">${msg.time}</span>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                chatMessages.insertAdjacentHTML('beforeend', msgHtml);
                            });
                            chatMessages.scrollTop = chatMessages.scrollHeight;
                        }
                    })
                    .catch(err => console.error('Polling error:', err));
            }

            // Send Message
            function sendMessage() {
                const text = messageInput.value.trim();
                if (text === '' || !activeContactId) return;

                btnSend.disabled = true;

                fetch('{{ route("chat.send") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        receiver_id: activeContactId,
                        message: text
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Clear fallback empty message if any
                        if (chatMessages.querySelector('.message-row') === null) {
                            chatMessages.innerHTML = '';
                        }

                        const msg = data.message;
                        const msgHtml = `
                            <div class="message-row sent">
                                <div class="message-avatar" style="background: var(--warm-amber);">ME</div>
                                <div class="message-group">
                                    <div class="message-bubble">
                                        ${escapeHtml(msg.message)}
                                        <span class="message-time">${msg.time}</span>
                                    </div>
                                </div>
                            </div>
                        `;
                        chatMessages.insertAdjacentHTML('beforeend', msgHtml);
                        messageInput.value = '';
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                        
                        // Refresh contacts sidebar to show updated last message
                        loadContacts(activeContactId);
                    }
                    btnSend.disabled = false;
                })
                .catch(err => {
                    console.error('Send error:', err);
                    alert('Gagal mengirim pesan.');
                    btnSend.disabled = false;
                });
            }

            // Event Listeners for sending
            btnSend.addEventListener('click', sendMessage);
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });

            // Initial load
            loadContacts();

            // Helpers
            function escapeHtml(text) {
                return text
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
            }
        });
    </script>
</body>
</html>
<<<<<<< HEAD
=======

>>>>>>> f1477981be828601e79080bb40992bd330fffc3a

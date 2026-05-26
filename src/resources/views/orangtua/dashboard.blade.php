<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Orang Tua - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-oak:      #3D2B1F;
            --muted-sage:    #8E9680;
            --dusty-mauve:   #A37C76;
            --warm-amber:    #D9B382;
            --vintage-cream: #E6D8C1;
            --sidebar-width: 280px;
            --white-glass:   rgba(255, 255, 255, 0.45);
            --border-glass:  rgba(255, 255, 255, 0.7);
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
        .blob-1 { position: fixed; top: -10%; right: 10%; width: 500px; height: 500px; background: rgba(142, 150, 128, 0.18); border-radius: 50%; filter: blur(90px); z-index: 0; pointer-events: none; }
        .blob-2 { position: fixed; bottom: -10%; left: 20%; width: 400px; height: 400px; background: rgba(217, 179, 130, 0.18); border-radius: 50%; filter: blur(70px); z-index: 0; pointer-events: none; }
        .blob-3 { position: fixed; top: 30%; left: 40%; width: 350px; height: 350px; background: rgba(163, 124, 118, 0.12); border-radius: 50%; filter: blur(80px); z-index: 0; pointer-events: none; }

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

        .sidebar-menu { flex: 1; display: flex; flex-direction: column; gap: 8px; }

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

        .sidebar-item-icon { font-size: 20px; display: flex; align-items: center; }

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
            overflow-y: auto;
            position: relative;
            z-index: 5;
        }

        /* ── Topbar (Header) ── */
        .topbar {
            padding: 24px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .page-badge {
            background: rgba(142, 150, 128, 0.15);
            color: #5D6652;
            padding: 6px 16px;
            border-radius: 99px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
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
            background: var(--muted-sage);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: white; font-size: 18px;
            overflow: hidden;
        }

        /* ── Content Body ── */
        .content-body {
            padding: 0 48px 80px;
            max-width: 1300px;
            margin: 0 auto;
        }

        /* ── Welcome Banner ── */
        .welcome-banner {
            background: linear-gradient(135deg, var(--dark-oak) 0%, #5C4033 100%);
            border-radius: 32px;
            padding: 44px 48px;
            color: #FFF;
            margin-bottom: 40px;
            box-shadow: 0 16px 40px rgba(61, 43, 31, 0.2);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .welcome-banner::after {
            content: ''; position: absolute; right: -50px; top: -50px;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%; pointer-events: none;
        }

        .welcome-left h2 {
            font-size: 36px; font-weight: 800; margin-bottom: 10px; line-height: 1.15; letter-spacing: -1px;
        }
        .welcome-left p {
            font-size: 16px; color: rgba(255, 255, 255, 0.8); max-width: 520px; line-height: 1.6;
        }
        .welcome-illustration {
            font-size: 90px;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(4deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }

        /* ── Grid Layout ── */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 32px;
            margin-bottom: 48px;
        }

        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ── Cards Styling ── */
        .glass-card {
            background: var(--white-glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-glass);
            border-radius: 32px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(61, 43, 31, 0.04);
            margin-bottom: 32px;
        }

        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--dark-oak);
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ── Child Selector Dropdown Card ── */
        .selector-card {
            background: linear-gradient(135deg, rgba(230, 216, 193, 0.5) 0%, rgba(217, 179, 130, 0.2) 100%);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            padding: 24px 32px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 40px;
            box-shadow: 0 8px 24px rgba(61,43,31,0.03);
        }

        .selector-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .selector-label {
            font-weight: 700;
            font-size: 16px;
            color: var(--dark-oak);
        }

        .select-child {
            padding: 10px 24px;
            border-radius: 99px;
            border: 2px solid rgba(61, 43, 31, 0.15);
            background: white;
            color: var(--dark-oak);
            font-size: 15px;
            font-weight: 700;
            outline: none;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
            transition: all 0.25s;
            min-width: 220px;
        }
        .select-child:focus {
            border-color: var(--muted-sage);
            box-shadow: 0 4px 12px rgba(142, 150, 128, 0.25);
        }

        .child-profile-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.6);
            padding: 8px 18px;
            border-radius: 99px;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }
        .child-badge {
            background: var(--muted-sage);
            color: white;
            font-size: 11px;
            font-weight: 800;
            padding: 3px 10px;
            border-radius: 99px;
            text-transform: uppercase;
        }
        .child-name {
            font-weight: 800;
            font-size: 15px;
        }

        /* ── Child Package Status Card ── */
        .package-status-bar {
            display: flex;
            align-items: center;
            gap: 16px;
            background: rgba(255,255,255,0.7);
            border-radius: 20px;
            padding: 18px 24px;
            border: 1px solid var(--border-glass);
            margin-bottom: 28px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.02);
        }
        .pkg-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
        }
        .pkg-bg-active { background: rgba(74, 103, 65, 0.15); color: #4A6741; }
        .pkg-bg-inactive { background: rgba(163, 124, 118, 0.15); color: #A37C76; }
        .pkg-info h4 { font-size: 16px; font-weight: 800; }
        .pkg-info p { font-size: 13px; color: rgba(61,43,31,0.6); font-weight: 600; }

        /* ── Scores & Progress bars ── */
        .scores-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .score-item {
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .score-item:hover {
            transform: translateY(-2px);
            background: #FFF;
            box-shadow: 0 6px 18px rgba(61, 43, 31, 0.03);
        }

        .score-meta-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        .score-subject {
            font-size: 16px;
            font-weight: 800;
        }
        .score-exam-type {
            font-size: 12px;
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 99px;
        }
        .type-uts { background: rgba(74, 103, 65, 0.12); color: #4A6741; }
        .type-uas { background: rgba(91, 139, 235, 0.12); color: #5B8BEB; }
        .type-tryout { background: rgba(163, 124, 118, 0.12); color: #A37C76; }

        .score-details-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: rgba(61, 43, 31, 0.7);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .progress-track {
            width: 100%; height: 10px; background: rgba(61, 43, 31, 0.06);
            border-radius: 99px; overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        }
        
        .progress-fill {
            height: 100%; border-radius: 99px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .fill-high { background: linear-gradient(90deg, #4A6741, #6B8F5E); }
        .fill-medium { background: linear-gradient(90deg, var(--warm-amber), #e9c495); }
        .fill-low { background: linear-gradient(90deg, #e74c3c, #f19085); }

        .score-bottom-info {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: rgba(61, 43, 31, 0.5);
            font-weight: 600;
            margin-top: 8px;
        }

        /* ── Promo Tickets (Vouchers) ── */
        .voucher-grid {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .voucher-ticket {
            background: white;
            border: 2px dashed var(--warm-amber);
            border-radius: 20px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 6px 18px rgba(61, 43, 31, 0.02);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .voucher-ticket:hover {
            transform: translateY(-2px);
            border-color: var(--dusty-mauve);
            box-shadow: 0 10px 24px rgba(217, 179, 130, 0.15);
        }

        .voucher-ticket::before, .voucher-ticket::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            background-color: #F7F4F0;
            border-radius: 50%;
            z-index: 2;
        }
        .voucher-ticket::before { left: -8px; top: 50%; transform: translateY(-50%); border-right: 2px dashed var(--warm-amber); }
        .voucher-ticket::after { right: -8px; top: 50%; transform: translateY(-50%); border-left: 2px dashed var(--warm-amber); }

        .voucher-ticket:hover::before { border-right-color: var(--dusty-mauve); }
        .voucher-ticket:hover::after { border-left-color: var(--dusty-mauve); }

        .vc-discount {
            font-size: 20px;
            font-weight: 800;
            color: var(--dark-oak);
        }
        .vc-code {
            font-size: 13px;
            font-weight: 700;
            color: var(--dusty-mauve);
            background: rgba(163, 124, 118, 0.1);
            padding: 2px 8px;
            border-radius: 6px;
            margin-top: 4px;
            display: inline-block;
        }

        /* ── Poster Penawaran (Offer Poster Banner) ── */
        .offer-poster {
            background: linear-gradient(135deg, #A37C76 0%, #D9B382 100%);
            border-radius: 32px;
            padding: 36px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 16px 36px rgba(163, 124, 118, 0.2);
            margin-top: 10px;
        }

        .offer-poster::after {
            content: '✨';
            position: absolute;
            right: 24px;
            top: 24px;
            font-size: 48px;
            opacity: 0.3;
        }

        .offer-title {
            font-size: 26px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .offer-desc {
            font-size: 14px;
            line-height: 1.5;
            color: rgba(255,255,255,0.9);
            margin-bottom: 24px;
        }

        .offer-benefits {
            margin-bottom: 28px;
            list-style: none;
        }

        .offer-benefits li {
            margin-bottom: 10px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .benefit-bullet {
            background: rgba(255,255,255,0.25);
            width: 20px; height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
        }

        .btn-offer {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--dark-oak);
            color: white;
            padding: 14px 28px;
            border-radius: 99px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(61,43,31,0.2);
            transition: all 0.3s;
            cursor: pointer;
            border: none;
        }

        .btn-offer:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(61,43,31,0.3);
            background: #2c1e15;
        }

        /* ── Empty State ── */
        .empty-scores {
            text-align: center;
            padding: 48px 24px;
            color: rgba(61,43,31,0.5);
            font-weight: 600;
        }
        .empty-emoji {
            font-size: 48px;
            margin-bottom: 16px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: 0.3s; }
            .main-wrapper { margin-left: 0; }
            .topbar { padding: 24px; }
            .content-body { padding: 0 24px 60px; }
            .welcome-banner { flex-direction: column; text-align: center; gap: 20px; padding: 32px; }
            .welcome-left p { margin: 0 auto; }
            .selector-card { flex-direction: column; align-items: stretch; text-align: center; }
            .selector-left { flex-direction: column; }
            .child-profile-info { justify-content: center; }
        }
    </style>
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>
    <div class="blob-3"></div>

    <!-- ══ SIDEBAR ══ -->
    <aside class="sidebar">
        <a href="#" class="logo-container">
            <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z"
                      fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/>
                <circle cx="12" cy="13" r="4" fill="var(--vintage-cream)" />
            </svg>
            <div class="logo-text">Pintar.id</div>
        </a>

        <div class="sidebar-menu">
            <a href="#" class="sidebar-item active">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                </span> Dashboard
            </a>
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
        <!-- ── HEADER ── -->
        <header class="topbar">
            <div class="page-badge">Monitoring Orang Tua</div>
            <div class="user-profile">
                <div class="user-greeting">Hi, Orang Tua <span>{{ explode(' ', $parentName)[0] }}</span></div>
                <div class="user-avatar">
                    @if(isset($parentPhoto) && $parentPhoto)
                        <img src="{{ asset('uploads/profiles/' . $parentPhoto) }}" alt="Profile" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                    @else
                        {{ strtoupper(substr($parentName, 0, 1)) }}
                    @endif
                </div>
            </div>
        </header>

        <!-- ── DASHBOARD BODY ── -->
        <div class="content-body">
            
            <!-- WELCOME BANNER -->
            <div class="welcome-banner">
                <div class="welcome-left">
                    <h2>Pantau Belajar Anak Anda 🌟</h2>
                    <p>Selamat datang di dashboard Pintar.id untuk orang tua. Di sini Anda dapat memantau hasil ujian, perkembangan nilai pelajaran, serta melihat promo-promo menarik.</p>
                </div>
                <div class="welcome-illustration">👨‍👩‍👧</div>
            </div>

            <!-- CHILD SELECTOR DROPDOWN -->
            <div class="selector-card">
                <div class="selector-left">
                    <label class="selector-label" for="child-select">Pilih Anak:</label>
                    <select id="child-select" class="select-child" onchange="changeChild(this.value)">
                        @foreach($students as $std)
                            <option value="{{ $std->id_user }}" {{ $selectedStudent && $selectedStudent->id_user == $std->id_user ? 'selected' : '' }}>
                                {{ $std->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if($selectedStudent)
                <div class="child-profile-info">
                    <span class="child-badge">{{ $jenjangName }}</span>
                    <span class="child-name">{{ $selectedStudent->nama }}</span>
                    <span style="font-size:12px;color:rgba(61,43,31,0.5);">({{ $selectedStudent->email }})</span>
                </div>
                @endif
            </div>

            <!-- DASHBOARD GRID -->
            <div class="dashboard-grid">
                
                <!-- LEFT COLUMN: CHILD PERFORMANCE & SCORES -->
                <div class="left-column">
                    
                    <!-- Child Active Package Status -->
                    <div class="glass-card" style="padding: 24px; margin-bottom: 24px;">
                        <h3 style="font-size: 15px; font-weight: 700; color: rgba(61,43,31,0.5); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 16px;">Paket Belajar Anak Saat Ini</h3>
                        <div class="package-status-bar" style="margin-bottom: 0;">
                            @if($activePackageName)
                                <div class="pkg-icon pkg-bg-active">✨</div>
                                <div class="pkg-info">
                                    <h4>Paket Premium: {{ $activePackageName }}</h4>
                                    <p>Paket Aktif &middot; Sisa Masa Aktif: <strong>{{ $sisaHari }} Hari</strong></p>
                                </div>
                            @else
                                <div class="pkg-icon pkg-bg-inactive">🔒</div>
                                <div class="pkg-info">
                                    <h4>Belum Berlangganan Paket</h4>
                                    <p>Anak Anda menggunakan paket gratis &middot; Tingkatkan ke Premium</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Exam Scores List -->
                    <div class="glass-card">
                        <div class="card-header-flex">
                            <h2 class="section-title">📊 Hasil Nilai Ujian Anak</h2>
                            <span style="font-size: 13px; font-weight: 700; color: var(--muted-sage);">Terakhir Diperbarui</span>
                        </div>

                        @if($histories->count() > 0)
                            <div class="scores-list">
                                @foreach($histories as $score)
                                    @php
                                        $barColorClass = $score->score >= 75 ? 'fill-high' : ($score->score >= 50 ? 'fill-medium' : 'fill-low');
                                        $badgeClass = match($score->jenis) {
                                            'uts' => 'type-uts',
                                            'uas' => 'type-uas',
                                            'tryout' => 'type-tryout',
                                            default => 'type-uts'
                                        };
                                        $isUtbk = $score->jenis === 'tryout';
                                        $wrongCount = $isUtbk ? (($score->total - $score->correct) >= 0 ? ($score->total - $score->correct) : 0) : 0;
                                    @endphp
                                    <div class="score-item">
                                        <div class="score-meta-row">
                                            <div class="score-subject">{{ $score->mapel }}</div>
                                            <span class="score-exam-type {{ $badgeClass }}">{{ $score->jenis_label }}</span>
                                        </div>
                                        
                                        <div class="score-details-row">
                                            @if($isUtbk)
                                                <span>Skor Raw UTBK: {{ $score->utbk_raw_score ?? 0 }} <span style="font-size:11px;opacity:0.7;">/ {{ $score->total * 4 }}</span></span>
                                                <strong style="font-size: 16px; color: var(--dark-oak);">Nilai Konversi: {{ $score->score }}</strong>
                                            @else
                                                <span>Jawaban Benar: {{ $score->correct }} / {{ $score->total }} Soal</span>
                                                <strong style="font-size: 16px; color: var(--dark-oak);">Nilai Ujian: {{ $score->score }}</strong>
                                            @endif
                                        </div>

                                        <div class="progress-track">
                                            <div class="progress-fill {{ $barColorClass }}" style="width: {{ $score->score }}%"></div>
                                        </div>

                                        <div class="score-bottom-info">
                                            <span>Tanggal: {{ $score->created_at->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}</span>
                                            @if($isUtbk)
                                                <span>Benar: {{ $score->correct }} &middot; Salah/Kosong: {{ $score->total - $score->correct }}</span>
                                            @else
                                                <span>{{ $score->score >= 75 ? '👍 Sangat Bagus!' : ($score->score >= 50 ? '✏️ Cukup Baik' : '⚠️ Perlu Ditingkatkan') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-scores">
                                <div class="empty-emoji">📝</div>
                                <p>Anak Anda belum memiliki riwayat pengerjaan ujian UTS, UAS, atau Try Out UTBK.</p>
                            </div>
                        @endif
                    </div>

                </div>

                <!-- RIGHT COLUMN: PROMOS & MARKETING OFFER POSTER -->
                <div class="right-column">
                    
                    <!-- Promo Vouchers -->
                    <div class="glass-card">
                        <div class="card-header-flex">
                            <h2 class="section-title">🎟️ Promo Spesial</h2>
                        </div>
                        
                        <div class="voucher-grid">
                            @forelse($vouchers as $vc)
                                <div class="voucher-ticket">
                                    <div>
                                        <div class="vc-discount">Potongan {{ number_format($vc->potongan / 1000, 0) }}K</div>
                                        <div style="font-size:12px; color:rgba(61,43,31,0.6); font-weight:600; margin-top:2px;">Diskon Paket Belajar Anak</div>
                                        <span class="vc-code">{{ $vc->kode_voucher }}</span>
                                    </div>
                                    <div style="text-align: right; font-size: 11px; color: rgba(61,43,31,0.5); font-weight:700;">
                                        Berlaku s/d<br>
                                        {{ date('d M Y', strtotime($vc->tanggal_berakhir)) }}
                                    </div>
                                </div>
                            @empty
                                <div style="text-align:center; padding:20px; color:rgba(61,43,31,0.5); font-weight:600;">
                                    Belum ada promo voucher tersedia saat ini.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Offer Poster (Poster Penawaran Premium) -->
                    <div class="offer-poster">
                        <h3 class="offer-title">Kunci Sukses<br>Belajar Anak! 🚀</h3>
                        <p class="offer-desc">Dukung anak Anda meraih nilai impian dan menembus universitas idaman dengan meningkatkan akun ke <strong>Premium Access</strong>.</p>
                        
                        <ul class="offer-benefits">
                            <li>
                                <span class="benefit-bullet">✓</span>
                                <span>Akses ke semua Video Pembelajaran</span>
                            </li>
                            <li>
                                <span class="benefit-bullet">✓</span>
                                <span>Latihan Soal &amp; Try Out UTBK Tanpa Batas</span>
                            </li>
                            <li>
                                <span class="benefit-bullet">✓</span>
                                <span>Prioritas Chat Diskusi dengan Guru Ahli</span>
                            </li>
                            <li>
                                <span class="benefit-bullet">✓</span>
                                <span>Rekomendasi Jurusan Berbasis AI Akurat</span>
                            </li>
                        </ul>

                        <button class="btn-offer" onclick="alert('Halaman Pembelian Paket Belajar Anak akan segera hadir di modul berikutnya! Terima kasih atas dukungannya.')">
                            Tingkatkan Sekarang ✨
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </main>

    <script>
        function changeChild(siswaId) {
            window.location.href = "{{ route('orangtua.home') }}?siswa_id=" + siswaId;
        }
    </script>
</body>
</html>

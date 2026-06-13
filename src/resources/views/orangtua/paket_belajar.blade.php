<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Belajar - Pintar.id</title>
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
            overflow-y: auto;
            position: relative;
            z-index: 5;
        }

        /* ── Topbar (Header) ── */
        .topbar {
            padding: 24px 48px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: sticky;
            top: 0;
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

        /* ── Content Body ── */
        .content-body {
            padding: 0 48px 80px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .page-title {
            font-size: 36px;
            font-weight: 800;
            color: var(--dark-oak);
            margin-bottom: 12px;
            letter-spacing: -1px;
        }

        .page-subtitle {
            font-size: 16px;
            color: rgba(61,43,31,0.7);
            max-width: 600px;
            margin: 0 auto;
        }

        .paket-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 32px;
            margin-top: 40px;
        }

        /* ── Redesigned Premium Cards ── */
        .paket-card {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(230, 216, 193, 0.7);
            border-radius: 28px;
            padding: 36px 28px;
            text-align: center;
            position: relative;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 10px 30px rgba(61, 43, 31, 0.03);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .paket-card:hover {
            transform: translateY(-8px);
            border-color: var(--accent-color, var(--warm-amber));
            box-shadow: 0 20px 40px rgba(61, 43, 31, 0.08), 0 0 0 1px var(--accent-color, var(--warm-amber));
        }

        .paket-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            color: white;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 99px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .paket-icon {
            font-size: 54px;
            margin-bottom: 20px;
            filter: drop-shadow(0 8px 12px rgba(61, 43, 31, 0.08));
            transition: transform 0.3s ease;
        }

        .paket-card:hover .paket-icon {
            transform: scale(1.15) rotate(5deg);
        }

        .paket-name {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 6px;
            line-height: 1.25;
            color: var(--dark-oak);
        }

        .paket-jenjang {
            font-size: 12px;
            font-weight: 700;
            color: rgba(61, 43, 31, 0.5);
            margin-bottom: 24px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .paket-price {
            font-size: 32px;
            font-weight: 800;
            color: var(--dark-oak);
            margin-bottom: 28px;
            padding: 12px 20px;
            background: rgba(230, 216, 193, 0.35);
            border: 1px solid rgba(230, 216, 193, 0.6);
            border-radius: 16px;
            display: inline-block;
            margin-left: auto;
            margin-right: auto;
            transition: all 0.3s;
        }

        .paket-card:hover .paket-price {
            background: var(--bg-hover-light, rgba(230, 216, 193, 0.5));
            border-color: var(--accent-color, var(--warm-amber));
        }

        .paket-features {
            list-style: none;
            text-align: left;
            margin-bottom: 28px;
            flex: 1;
            background: rgba(255, 255, 255, 0.4);
            border: 1px solid rgba(230, 216, 193, 0.3);
            padding: 20px;
            border-radius: 20px;
        }

        .paket-features li {
            margin-bottom: 12px;
            font-size: 14px;
            font-weight: 600;
            color: var(--dark-oak);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .paket-features li:last-child {
            margin-bottom: 0;
        }

        .btn-card-detail {
            width: 100%;
            padding: 16px;
            border-radius: 16px;
            font-size: 15px;
            font-weight: 700;
            color: var(--dark-oak);
            background: rgba(230, 216, 193, 0.5);
            border: 1px solid rgba(230, 216, 193, 0.8);
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .paket-card:hover .btn-card-detail {
            background: var(--accent-color, var(--warm-amber));
            color: white;
            border-color: var(--accent-color, var(--warm-amber));
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
        }

        /* ── Premium Modal (Glassmorphic) ── */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(61, 43, 31, 0.45);
            backdrop-filter: blur(12px);
            display: flex;
            align-items: flex-start;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s ease;
            padding: 40px 20px;
            overflow-y: auto;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .detail-modal {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 30px 70px rgba(61, 43, 31, 0.2);
            border-radius: 28px;
            width: 100%;
            max-width: 580px;
            transform: scale(0.9) translateY(20px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            position: relative;
            margin: auto;
        }

        .modal-overlay.active .detail-modal {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        .btn-close-modal {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(61, 43, 31, 0.05);
            border: none;
            color: var(--dark-oak);
            font-size: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            z-index: 10;
        }

        .btn-close-modal:hover {
            background: rgba(61, 43, 31, 0.1);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 40px;
        }

        .modal-badge-row {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
        }

        .modal-badge {
            font-size: 11px;
            font-weight: 800;
            padding: 6px 12px;
            border-radius: 99px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: white;
        }

        .modal-badge-jenjang {
            background: var(--muted-sage);
        }

        .modal-badge-aktif {
            background: var(--warm-amber);
        }

        .modal-icon-container {
            width: 80px;
            height: 80px;
            border-radius: 24px;
            background: var(--vintage-cream);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            margin-bottom: 24px;
            box-shadow: 0 10px 20px rgba(61, 43, 31, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        .modal-title {
            font-size: 30px;
            font-weight: 800;
            color: var(--dark-oak);
            line-height: 1.2;
            margin-bottom: 12px;
        }

        .modal-meta-info {
            display: flex;
            gap: 16px;
            color: rgba(61, 43, 31, 0.6);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 24px;
            align-items: center;
        }

        .modal-meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .modal-description {
            font-size: 15px;
            line-height: 1.6;
            color: rgba(61, 43, 31, 0.85);
            margin-bottom: 30px;
        }

        .modal-features-section {
            margin-bottom: 30px;
        }

        .modal-features-title {
            font-size: 14px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--dark-oak);
            margin-bottom: 14px;
        }

        .modal-features-list {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 12px;
        }

        .modal-features-list li {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark-oak);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-features-list li svg {
            color: var(--muted-sage);
            flex-shrink: 0;
        }

        .modal-price-card {
            background: rgba(230, 216, 193, 0.35);
            border: 1px solid rgba(230, 216, 193, 0.6);
            border-radius: 20px;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .modal-price-card .modal-price-label {
            font-size: 14px;
            font-weight: 700;
            color: rgba(61, 43, 31, 0.6);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .modal-price-value {
            font-size: 32px;
            font-weight: 800;
            color: var(--dark-oak);
        }

        .btn-modal-checkout {
            width: 100%;
            padding: 20px;
            border-radius: 20px;
            font-size: 18px;
            font-weight: 800;
            color: white;
            background: var(--dark-oak);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(61, 43, 31, 0.15);
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-modal-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(61, 43, 31, 0.25);
            background: #4F3827;
        }

        .btn-modal-checkout:active {
            transform: translateY(1px);
        }

        /* ── Success Animation Screen ── */
        .success-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(255, 255, 255, 0.98);
            z-index: 20;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            text-align: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .success-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .success-checkmark {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: rgba(142, 150, 128, 0.15);
            color: var(--muted-sage);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            margin-bottom: 24px;
            animation: popCheckmark 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        @keyframes popCheckmark {
            0% { transform: scale(0.5); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .success-title {
            font-size: 26px;
            font-weight: 800;
            color: var(--dark-oak);
            margin-bottom: 12px;
        }

        .success-text {
            font-size: 15px;
            color: rgba(61, 43, 31, 0.7);
            line-height: 1.6;
            margin-bottom: 32px;
            max-width: 380px;
        }

        .btn-success-close {
            padding: 16px 36px;
            border-radius: 99px;
            background: var(--muted-sage);
            color: white;
            font-size: 15px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 6px 16px rgba(142, 150, 128, 0.3);
        }

        .btn-success-close:hover {
            background: #7D8570;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(142, 150, 128, 0.4);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* ── Payment Options ── */
        .payment-tile {
            transition: all 0.2s ease;
        }
        .payment-tile:hover {
            transform: translateY(-2px);
            border-color: var(--dusty-mauve) !important;
            box-shadow: 0 4px 10px rgba(163, 124, 118, 0.1);
        }

        /* ── Promo Tickets (Vouchers) ── */
        .voucher-grid { display: flex; flex-direction: column; gap: 16px; }
        .voucher-ticket { background: white; border: 2px dashed var(--warm-amber); border-radius: 20px; padding: 20px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 6px 18px rgba(61, 43, 31, 0.02); position: relative; overflow: hidden; transition: all 0.3s ease; }
        .voucher-ticket:hover { transform: translateY(-2px); border-color: var(--dusty-mauve); box-shadow: 0 10px 24px rgba(217, 179, 130, 0.15); }
        .voucher-ticket::before, .voucher-ticket::after { content: ''; position: absolute; width: 16px; height: 16px; background-color: #F7F4F0; border-radius: 50%; z-index: 2; }
        .voucher-ticket::before { left: -8px; top: 50%; transform: translateY(-50%); border-right: 2px dashed var(--warm-amber); }
        .voucher-ticket::after { right: -8px; top: 50%; transform: translateY(-50%); border-left: 2px dashed var(--warm-amber); }
        .voucher-ticket:hover::before { border-right-color: var(--dusty-mauve); }
        .voucher-ticket:hover::after { border-left-color: var(--dusty-mauve); }
        .vc-discount { font-size: 20px; font-weight: 800; color: var(--dark-oak); }
        .vc-code { font-size: 13px; font-weight: 700; color: var(--dusty-mauve); background: rgba(163, 124, 118, 0.1); padding: 2px 8px; border-radius: 6px; margin-top: 4px; display: inline-block; }

        /* ── Poster Penawaran (Offer Banner) ── */
        .offer-banner { background: linear-gradient(135deg, #A37C76 0%, #D9B382 100%); border-radius: 32px; padding: 36px 48px; color: white; position: relative; overflow: hidden; box-shadow: 0 16px 36px rgba(163, 124, 118, 0.2); margin-bottom: 40px; display: flex; align-items: center; justify-content: space-between; gap: 40px; }
        .offer-banner::after { content: '✨'; position: absolute; right: 24px; top: 50%; transform: translateY(-50%); font-size: 120px; opacity: 0.15; pointer-events: none; }
        .offer-banner-content { flex: 1; }
        .offer-title { font-size: 28px; font-weight: 800; line-height: 1.2; margin-bottom: 12px; letter-spacing: -0.5px; }
        .offer-desc { font-size: 15px; line-height: 1.5; color: rgba(255,255,255,0.95); margin-bottom: 0; max-width: 600px; }
        .offer-benefits { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; list-style: none; flex: 1; position: relative; z-index: 2; }
        .offer-benefits li { font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px; }
        .benefit-bullet { background: rgba(255,255,255,0.25); width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; flex-shrink: 0; }
        
        @media (max-width: 992px) {
            .offer-banner { flex-direction: column; align-items: flex-start; padding: 24px; gap: 24px; }
            .offer-benefits { grid-template-columns: 1fr; }
        }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); transition: 0.3s; }
            .main-wrapper { margin-left: 0; }
            .content-body { padding: 0 24px 60px; }
            .topbar { padding: 24px; justify-content: space-between; }
        }
    </style>
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <!-- ══ SIDEBAR ══ -->
    <aside class="sidebar">
        <a href="/" class="logo-container">
            <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z"
                      fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/>
                <circle cx="12" cy="13" r="4" fill="var(--vintage-cream)" />
            </svg>
            <div class="logo-text">Pintar.id</div>
        </a>

        <div class="sidebar-menu">
            <a href="{{ route('orangtua.home') }}" class="sidebar-item {{ request()->routeIs('orangtua.home') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                </span> Dashboard
            </a>
            <a href="{{ route('orangtua.paket-belajar') }}" class="sidebar-item {{ request()->routeIs('orangtua.paket-belajar') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                </span> Paket Belajar
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
            <div class="page-badge" style="background: rgba(142, 150, 128, 0.15); color: #5D6652; padding: 6px 16px; border-radius: 99px; font-size: 13px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;">Pembelian Paket Belajar</div>
            <a href="{{ route('orangtua.profile') }}" class="user-profile" style="text-decoration:none;">
                <div class="user-greeting">Hi, Orang Tua <span>{{ explode(' ', $parentName)[0] }}</span></div>
                <div class="user-avatar">
                    @if(isset($parentPhoto) && $parentPhoto)
                        <img src="{{ asset('uploads/profiles/' . $parentPhoto) }}" alt="Profile" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                    @else
                        {{ strtoupper(substr($parentName, 0, 1)) }}
                    @endif
                </div>
            </a>
        </header>

        <!-- ── DASHBOARD BODY ── -->
        <div class="content-body">

            <!-- CHILD SELECTOR DROPDOWN -->
            <div class="selector-card" style="background: linear-gradient(135deg, rgba(230, 216, 193, 0.5) 0%, rgba(217, 179, 130, 0.2) 100%); border-radius: 30px; border: 1px solid rgba(255, 255, 255, 0.8); padding: 24px 32px; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 24px; box-shadow: 0 8px 24px rgba(61,43,31,0.03);">
                <div class="selector-left" style="display: flex; align-items: center; gap: 16px;">
                    <label class="selector-label" for="child-select" style="font-weight: 700; font-size: 16px; color: var(--dark-oak);">Pilih Anak yang Ingin Dibelikan Paket:</label>
                    <select id="child-select" class="select-child" onchange="changeChild(this.value)" style="padding: 10px 24px; border-radius: 99px; border: 2px solid rgba(61, 43, 31, 0.15); background: white; color: var(--dark-oak); font-size: 15px; font-weight: 700; outline: none; cursor: pointer; min-width: 220px;">
                        @foreach($students as $std)
                            <option value="{{ $std->id_user }}" {{ $selectedStudent && $selectedStudent->id_user == $std->id_user ? 'selected' : '' }}>
                                {{ $std->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if($selectedStudent)
                <div class="child-profile-info" style="display: flex; align-items: center; gap: 12px; background: rgba(255, 255, 255, 0.6); padding: 8px 18px; border-radius: 99px; border: 1px solid rgba(255, 255, 255, 0.8);">
                    <span class="child-badge" style="background: var(--muted-sage); color: white; font-size: 11px; font-weight: 800; padding: 3px 10px; border-radius: 99px; text-transform: uppercase;">{{ $jenjangName ?? 'SMA' }}</span>
                    <span class="child-name" style="font-weight: 800; font-size: 15px;">{{ $selectedStudent->nama }}</span>
                </div>
                @endif
            </div>

            <script>
                function changeChild(siswaId) {
                    window.location.href = "{{ route('orangtua.paket-belajar') }}?siswa_id=" + siswaId;
                }
            </script>

            <!-- OFFER BANNER -->
            <div class="offer-banner">
                <div class="offer-banner-content">
                    <h3 class="offer-title">Kunci Sukses Belajar Anak! 🚀</h3>
                    <p class="offer-desc">Dukung anak Anda meraih nilai impian dan menembus universitas idaman dengan meningkatkan akun ke <strong>Premium Access</strong>.</p>
                </div>
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
            </div>
            
            <div class="page-header">
                <h1 class="page-title">Pilih Paket Belajar Anak! ✨</h1>
                <p class="page-subtitle">Pilihan paket <strong>{{ $jenjangName ?? 'Semua Jenjang' }}</strong> yang bikin belajar makin asik dan anti-bosan!</p>
            </div>

            @if(isset($vouchers) && $vouchers->count() > 0)
                <div class="glass-card" style="margin-bottom: 40px; background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(10px); border: 2px solid rgba(230, 216, 193, 0.7); border-radius: 28px; padding: 28px;">
                    <h2 class="section-title" style="font-size: 22px; font-weight: 800; color: var(--dark-oak); display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">🎟️ Promo Spesial</h2>
                    <div class="voucher-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 16px;">
                        @foreach($vouchers as $vc)
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
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="paket-cards">
                @php
                    $colors = [
                        [
                            'bg' => 'rgba(142, 150, 128, 0.08)',
                            'border' => 'rgba(142, 150, 128, 0.35)',
                            'text' => '#6B735F', // Dark Sage
                            'accent' => '#8E9680', // Sage
                            'bg_hover' => 'rgba(142, 150, 128, 0.15)'
                        ], // Sage Theme
                        [
                            'bg' => 'rgba(217, 179, 130, 0.08)',
                            'border' => 'rgba(217, 179, 130, 0.35)',
                            'text' => '#B28956', // Dark Amber
                            'accent' => '#D9B382', // Amber
                            'bg_hover' => 'rgba(217, 179, 130, 0.15)'
                        ], // Amber Theme
                        [
                            'bg' => 'rgba(163, 124, 118, 0.08)',
                            'border' => 'rgba(163, 124, 118, 0.35)',
                            'text' => '#8A5C56', // Dark Mauve
                            'accent' => '#A37C76', // Mauve
                            'bg_hover' => 'rgba(163, 124, 118, 0.15)'
                        ], // Mauve Theme
                        [
                            'bg' => 'rgba(230, 216, 193, 0.15)',
                            'border' => 'rgba(230, 216, 193, 0.5)',
                            'text' => '#3D2B1F', // Dark Oak
                            'accent' => '#E6D8C1', // Vintage Cream / Dark Oak
                            'bg_hover' => 'rgba(230, 216, 193, 0.3)'
                        ], // Cream/Oak Theme
                    ];

                    if (!function_exists('getPaketEmoji')) {
                        function getPaketEmoji($nama) {
                            $namaLower = strtolower($nama);
                            if (str_contains($namaLower, 'matematika')) return '📐';
                            if (str_contains($namaLower, 'fisika')) return '⚛️';
                            if (str_contains($namaLower, 'kimia')) return '🧪';
                            if (str_contains($namaLower, 'biologi')) return '🧬';
                            if (str_contains($namaLower, 'inggris') || str_contains($namaLower, 'bahasa')) return '✍️';
                            if (str_contains($namaLower, 'ipa')) return '🔬';
                            if (str_contains($namaLower, 'ips') || str_contains($namaLower, 'sejarah') || str_contains($namaLower, 'ekonomi') || str_contains($namaLower, 'geografi')) return '🌍';
                            if (str_contains($namaLower, 'utbk') || str_contains($namaLower, 'sbmptn') || str_contains($namaLower, 'un')) return '🎓';
                            return '🚀';
                        }
                    }
                @endphp

                @if(isset($paketList) && count($paketList) > 0)
                    @foreach($paketList as $index => $paket)
                        @php
                            $color = $colors[$index % count($colors)];
                            $harga = $paket->harga == 0 ? 'Gratis!' : 'Rp ' . number_format($paket->harga, 0, ',', '.');
                            $emoji = getPaketEmoji($paket->nama);
                        @endphp
                        <div class="paket-card" 
                             style="--accent-color: {{ $color['text'] }}; --bg-hover-light: {{ $color['bg_hover'] }}; background-color: {{ $color['bg'] }}; border-color: {{ $color['border'] }};"
                             onclick="openDetailModal({{ json_encode($paket) }}, '{{ $emoji }}', '{{ $harga }}', '{{ $color['text'] }}')">
                            
                            <div class="paket-badge" style="background-color: {{ $color['text'] }};">{{ $paket->masa_aktif }} Hari</div>
                            <div class="paket-icon">{{ $emoji }}</div>
                            <div class="paket-name">{{ $paket->nama }}</div>
                            <div class="paket-jenjang">Khusus Anak {{ $paket->jenjang }}</div>
                            
                            <div class="paket-price">{{ $harga }}</div>
                            
                            <ul class="paket-features">
                                <li>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: {{ $color['text'] }};"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>Materi belajar lengkap</span>
                                </li>
                                <li>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: {{ $color['text'] }};"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>Latihan soal interaktif</span>
                                </li>
                                <li>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: {{ $color['text'] }};"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>Akses kapan saja!</span>
                                </li>
                            </ul>
                            
                            <button class="btn-card-detail">
                                <span>Lihat Detail</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </button>
                        </div>
                    @endforeach
                @else
                    <div style="text-align: center; width: 100%; padding: 50px;">
                        <h2 style="color: var(--dark-oak);">Yah, belum ada paket untuk jenjang kamu 😢</h2>
                    </div>
                @endif
            </div>

        </div>
    </main>

    <!-- ══ DETAIL MODAL ══ -->
    <div class="modal-overlay" id="detailModalOverlay" onclick="closeDetailModal(event)">
        <div class="detail-modal" id="detailModal" onclick="event.stopPropagation()">
            <button class="btn-close-modal" onclick="closeDetailModal(event)">&times;</button>
            
            <!-- Success Purchase State Screen -->
            <div class="success-overlay" id="successOverlay">
                <div class="success-checkmark">✓</div>
                <h3 class="success-title">Pembelian Berhasil! 🎉</h3>
                <p class="success-text" id="successOverlayText">Selamat, paket belajar kamu telah aktif. Mari mulai belajar sekarang!</p>
                <button class="btn-success-close" onclick="finishPurchase()">Mulai Belajar 🚀</button>
            </div>

            <div class="modal-body">
                <!-- STEP 1: DETAIL PAKET -->
                <div id="step-detail">
                    <div class="modal-badge-row">
                        <span class="modal-badge modal-badge-jenjang" id="modalJenjang">Khusus SMA</span>
                        <span class="modal-badge modal-badge-aktif" id="modalMasaAktif">30 Hari</span>
                    </div>
                    
                    <div class="modal-icon-container" id="modalIcon">🚀</div>
                    
                    <h2 class="modal-title" id="modalTitle">Persiapan UTBK SBMPTN</h2>
                    
                    <div class="modal-meta-info">
                        <div class="modal-meta-item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <span id="modalMasaAktifText">Masa Aktif: 30 Hari</span>
                        </div>
                        <div class="modal-meta-item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            <span id="modalJenjangText">Jenjang: SMA</span>
                        </div>
                    </div>
                    
                    <div class="modal-description" id="modalDescription">
                        Ini adalah deskripsi paket pembelajaran untuk mempersiapkan diri menghadapi ujian sekolah.
                    </div>
                    
                    <div class="modal-features-section">
                        <h4 class="modal-features-title">Apa Saja yang Didapat?</h4>
                        <ul class="modal-features-list">
                            <li>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Akses Video & Materi Lengkap</span>
                            </li>
                            <li>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Latihan Soal Interaktif</span>
                            </li>
                            <li>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Prioritas Tanya Guru via Chat</span>
                            </li>
                            <li>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span>Rangkuman Materi & E-Book</span>
                            </li>
                        </ul>
                    </div>

                    <div class="modal-price-card" style="flex-direction: row; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                        <span class="modal-price-label" style="font-size: 14px; font-weight: 700; color: rgba(61, 43, 31, 0.6); text-transform: uppercase; letter-spacing: 0.5px;">Harga Paket</span>
                        <span class="modal-price-value" style="font-size: 28px;" id="modalPriceStep1">Rp 450.000</span>
                    </div>

                    <button class="btn-modal-checkout" id="btnNextToPayment" onclick="showStepPayment()">
                        <span>Beli Paket</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                </div>

                <!-- STEP 2: PEMBAYARAN -->
                <div id="step-payment" style="display: none;">
                    <button onclick="showStepDetail()" style="background: none; border: none; color: var(--dusty-mauve); font-weight: 700; display: flex; align-items: center; gap: 8px; margin-bottom: 24px; cursor: pointer; font-size: 15px; outline: none; padding: 0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        <span>Kembali</span>
                    </button>

                    <h3 class="modal-title" style="font-size: 24px; margin-bottom: 20px; font-weight: 800;">Pembayaran Paket</h3>
                    
                    <div class="voucher-select-section" style="margin-bottom: 24px;">
                        <label for="voucherSelect" style="font-size: 14px; font-weight: 800; color: var(--dark-oak); display: block; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Gunakan Voucher Diskon</label>
                        <select id="voucherSelect" onchange="applyVoucher()" style="width: 100%; padding: 14px 20px; border-radius: 16px; border: 2px solid rgba(230, 216, 193, 0.7); background: rgba(255,255,255,0.7); font-family: 'Outfit', sans-serif; font-size: 15px; font-weight: 600; color: var(--dark-oak); outline: none; cursor: pointer; transition: all 0.2s;">
                            <option value="">-- Tanpa Voucher --</option>
                            @foreach($vouchers as $v)
                                <option value="{{ $v->id_voucher }}" data-potongan="{{ $v->potongan }}">
                                    {{ $v->kode_voucher }} - Potongan Rp {{ number_format($v->potongan, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="payment-method-section" style="margin-bottom: 28px;">
                        <label style="font-size: 14px; font-weight: 800; color: var(--dark-oak); display: block; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Metode Pembayaran</label>
                        <div class="payment-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                            <div class="payment-tile" onclick="selectPaymentMethod('DANA')" id="pay-DANA" style="border: 2px solid rgba(230, 216, 193, 0.7); padding: 14px; border-radius: 16px; display: flex; align-items: center; gap: 10px; cursor: pointer; background: rgba(255, 255, 255, 0.45); transition: all 0.2s;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                                    <rect width="24" height="24" rx="6" fill="#118EEA"/>
                                    <path d="M2 9h2.5c1 0 1.8.8 1.8 1.8s-.8 1.8-1.8 1.8H2V9Zm1 2.6h1.5c.4 0 .8-.3.8-.8s-.4-.8-.8-.8H3v1.6Z" fill="white"/>
                                    <path d="M9 9L7 13.5h1.1l.4-.9h1.5l.4.9h1.1L9.5 9Zm-.1 2.8l.4-1 .4 1h-.8Z" fill="white"/>
                                    <path d="M13 9v4.5h1l1.5-2.9v2.9h1V9h-1l-1.5 2.9V9h-1Z" fill="white"/>
                                    <path d="M20 9L18 13.5h1.1l.4-.9h1.5l.4.9h1.1L20.5 9Zm-.1 2.8l.4-1 .4 1h-.8Z" fill="white"/>
                                </svg>
                                <span style="font-weight: 700; font-size: 14px; color: var(--dark-oak);">DANA</span>
                            </div>
                            <div class="payment-tile" onclick="selectPaymentMethod('GoPay')" id="pay-GoPay" style="border: 2px solid rgba(230, 216, 193, 0.7); padding: 14px; border-radius: 16px; display: flex; align-items: center; gap: 10px; cursor: pointer; background: rgba(255, 255, 255, 0.45); transition: all 0.2s;">
                                <svg width="24" height="24" viewBox="-2 -2 18 18" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                                    <ellipse cx="6.811" cy="6.857" fill="#00AED6" rx="6.811" ry="6.857"/>
                                    <path fill="#FFF" d="M10.778 6.644a1.587 1.587 0 0 0-1.652-1.5H4.824a.285.285 0 0 1-.284-.286c0-.158.127-.286.284-.286h4.359a1.362 1.362 0 0 0-.993-1.26 10.97 10.97 0 0 0-3.84 0 1.82 1.82 0 0 0-1.362 1.526 13.711 13.711 0 0 0 0 4.06 1.92 1.92 0 0 0 1.552 1.526 19.13 19.13 0 0 0 4.748 0 1.669 1.669 0 0 0 1.317-1.44c.14-.772.199-1.556.173-2.34zm-1.413.96v.254a.285.285 0 0 1-.284.286.285.285 0 0 1-.284-.286v-.254a.427.427 0 0 1 .284-.746.427.427 0 0 1 .284.746z"/>
                                </svg>
                                <span style="font-weight: 700; font-size: 14px; color: var(--dark-oak);">GoPay</span>
                            </div>
                            <div class="payment-tile" onclick="selectPaymentMethod('OVO')" id="pay-OVO" style="border: 2px solid rgba(230, 216, 193, 0.7); padding: 14px; border-radius: 16px; display: flex; align-items: center; gap: 10px; cursor: pointer; background: rgba(255, 255, 255, 0.45); transition: all 0.2s;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                                    <rect width="24" height="24" rx="6" fill="#4C2A86"/>
                                    <circle cx="6.5" cy="12" r="2.5" stroke="white" stroke-width="1.8"/>
                                    <path d="M10.5 9.5L12.5 14L14.5 9.5" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="18.5" cy="12" r="2.5" stroke="white" stroke-width="1.8"/>
                                </svg>
                                <span style="font-weight: 700; font-size: 14px; color: var(--dark-oak);">OVO</span>
                            </div>
                            <div class="payment-tile" onclick="selectPaymentMethod('ShopeePay')" id="pay-ShopeePay" style="border: 2px solid rgba(230, 216, 193, 0.7); padding: 14px; border-radius: 16px; display: flex; align-items: center; gap: 10px; cursor: pointer; background: rgba(255, 255, 255, 0.45); transition: all 0.2s;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                                    <rect width="24" height="24" rx="6" fill="#EE4D2D"/>
                                    <path d="M5 7H17C18.1 7 19 7.9 19 9V10H20C20.55 10 21 10.45 21 11V13C21 13.55 20.55 14 20 14H19V15C19 16.1 18.1 17 17 17H5C3.9 17 3 16.1 3 15V9C3 7.9 3.9 7.72 5 7ZM17 10.5C16.17 10.5 15.5 11.17 15.5 12C15.5 12.83 16.17 13.5 17 13.5C17.83 13.5 18.5 12.83 18.5 12C18.5 11.17 17.83 10.5 17 10.5Z" fill="white"/>
                                </svg>
                                <span style="font-weight: 700; font-size: 14px; color: var(--dark-oak);">ShopeePay</span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-price-card" style="flex-direction: column; align-items: stretch; gap: 8px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="modal-price-label" style="font-size: 13px;">Harga Paket</span>
                            <span style="font-size: 16px; font-weight: 700; color: var(--dark-oak);" id="modalOriginalPrice">Rp 450.000</span>
                        </div>
                        <div style="display: none; justify-content: space-between; align-items: center;" id="modalDiscountRow">
                            <span class="modal-price-label" style="font-size: 13px; color: var(--dusty-mauve);">Diskon Voucher</span>
                            <span style="font-size: 16px; font-weight: 700; color: var(--dusty-mauve);" id="modalDiscountValue">- Rp 0</span>
                        </div>
                        <div style="border-top: 1px solid rgba(230, 216, 193, 0.8); margin-top: 6px; padding-top: 8px; display: flex; justify-content: space-between; align-items: center;">
                            <span class="modal-price-label" style="font-size: 14px; font-weight: 800; color: var(--dark-oak);">Total Bayar</span>
                            <span class="modal-price-value" style="font-size: 28px;" id="modalPrice">Rp 450.000</span>
                        </div>
                    </div>
                    
                    <button class="btn-modal-checkout" id="btnCheckout" onclick="processCheckout()">
                        <span>Beli Paket Sekarang</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedPaket = null;
        let selectedPaymentMethod = null;
        let originalPriceVal = 0;
        let finalPriceVal = 0;

        function showStepDetail() {
            document.getElementById('step-detail').style.display = 'block';
            document.getElementById('step-payment').style.display = 'none';
            document.getElementById('detailModalOverlay').scrollTop = 0;
        }

        function showStepPayment() {
            document.getElementById('step-detail').style.display = 'none';
            document.getElementById('step-payment').style.display = 'block';
            document.getElementById('detailModalOverlay').scrollTop = 0;
        }

        function openDetailModal(paket, emoji, harga, accentColor) {
            selectedPaket = paket;
            originalPriceVal = parseFloat(paket.harga);
            finalPriceVal = originalPriceVal;
            selectedPaymentMethod = null;

            // Reset UI selections
            document.getElementById('voucherSelect').value = '';
            document.getElementById('modalDiscountRow').style.display = 'none';
            
            // Reset Payment Tiles styling
            document.querySelectorAll('.payment-tile').forEach(tile => {
                tile.style.borderColor = 'rgba(230, 216, 193, 0.7)';
                tile.style.backgroundColor = 'rgba(255, 255, 255, 0.45)';
                tile.style.boxShadow = 'none';
            });
            
            // Populate Modal Content
            document.getElementById('modalTitle').textContent = paket.nama;
            document.getElementById('modalDescription').textContent = paket.deskripsi || 'Tidak ada deskripsi tersedia untuk paket ini.';
            
            // Prices format
            const formattedPrice = formatRupiah(originalPriceVal);
            document.getElementById('modalOriginalPrice').textContent = formattedPrice;
            document.getElementById('modalPrice').textContent = formattedPrice;
            document.getElementById('modalPriceStep1').textContent = formattedPrice;
            
            document.getElementById('modalIcon').textContent = emoji;
            document.getElementById('modalJenjang').textContent = `Khusus ${paket.jenjang}`;
            document.getElementById('modalJenjangText').textContent = `Jenjang: ${paket.jenjang}`;
            document.getElementById('modalMasaAktif').textContent = `${paket.masa_aktif} Hari`;
            document.getElementById('modalMasaAktifText').textContent = `Masa Aktif: ${paket.masa_aktif} Hari`;
            
            // Apply accents
            const checkoutBtn = document.getElementById('btnCheckout');
            checkoutBtn.style.backgroundColor = accentColor;
            
            const nextBtn = document.getElementById('btnNextToPayment');
            nextBtn.style.backgroundColor = accentColor;
            
            const activeBadge = document.getElementById('modalMasaAktif');
            activeBadge.style.backgroundColor = accentColor;
            
            const jenjangBadge = document.getElementById('modalJenjang');
            jenjangBadge.style.backgroundColor = 'var(--dark-oak)';
            
            // Reset state to step 1
            showStepDetail();
            document.getElementById('successOverlay').classList.remove('active');
            
            // Show Overlay
            const overlay = document.getElementById('detailModalOverlay');
            overlay.classList.add('active');
            
            // Disable body scroll when modal is open
            document.body.style.overflow = 'hidden';
        }

        function formatRupiah(amount) {
            if (amount === 0) return 'Gratis!';
            return 'Rp ' + amount.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
        }

        function applyVoucher() {
            const selectEl = document.getElementById('voucherSelect');
            const selectedOpt = selectEl.options[selectEl.selectedIndex];
            
            if (selectedOpt && selectedOpt.value) {
                const potongan = parseFloat(selectedOpt.getAttribute('data-potongan'));
                const discountValueStr = formatRupiah(potongan);
                
                finalPriceVal = Math.max(0, originalPriceVal - potongan);
                
                document.getElementById('modalDiscountValue').textContent = '- ' + discountValueStr;
                document.getElementById('modalDiscountRow').style.display = 'flex';
                document.getElementById('modalPrice').textContent = formatRupiah(finalPriceVal);
            } else {
                finalPriceVal = originalPriceVal;
                document.getElementById('modalDiscountRow').style.display = 'none';
                document.getElementById('modalPrice').textContent = formatRupiah(finalPriceVal);
            }
        }

        function selectPaymentMethod(method) {
            selectedPaymentMethod = method;
            
            // Reset all tiles
            document.querySelectorAll('.payment-tile').forEach(tile => {
                tile.style.borderColor = 'rgba(230, 216, 193, 0.7)';
                tile.style.backgroundColor = 'rgba(255, 255, 255, 0.45)';
                tile.style.boxShadow = 'none';
            });
            
            // Activate selected tile
            const activeTile = document.getElementById('pay-' + method);
            if (activeTile) {
                activeTile.style.borderColor = 'var(--muted-sage)';
                activeTile.style.backgroundColor = 'rgba(142, 150, 128, 0.1)';
                activeTile.style.boxShadow = '0 4px 12px rgba(142, 150, 128, 0.15)';
            }
        }

        function closeDetailModal(event) {
            const overlay = document.getElementById('detailModalOverlay');
            overlay.classList.remove('active');
            
            // Enable body scroll
            document.body.style.overflow = '';
        }

        function processCheckout() {
            if (!selectedPaket) return;
            
            if (!selectedPaymentMethod) {
                alert('Silakan pilih metode pembayaran terlebih dahulu!');
                return;
            }
            
            // Get voucher value
            const idVoucher = document.getElementById('voucherSelect').value;
            
            // Animate button loading state
            const checkoutBtn = document.getElementById('btnCheckout');
            const originalContent = checkoutBtn.innerHTML;
            checkoutBtn.disabled = true;
            checkoutBtn.innerHTML = `
                <svg class="spinner" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="animation: spin 1s linear infinite; margin-right: 8px;"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
                <span>Memproses Pembayaran...</span>
            `;
            
            // Send AJAX POST Request
            fetch('{{ route("orangtua.transaksi.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id_paket: selectedPaket.id_paket,
                    id_voucher: idVoucher || null,
                    metode_pembayaran: selectedPaymentMethod,
                    siswa_id: {{ $selectedStudent ? $selectedStudent->id_user : 'null' }}
                })
            })
            .then(response => response.json())
            .then(data => {
                // Restore button
                checkoutBtn.disabled = false;
                checkoutBtn.innerHTML = originalContent;
                
                if (data.success) {
                    // Redirect immediately to home page
                    window.location.href = '{{ route("orangtua.home") }}';
                } else {
                    alert(data.message || 'Gagal memproses transaksi. Coba lagi.');
                }
            })
            .catch(err => {
                console.error(err);
                checkoutBtn.disabled = false;
                checkoutBtn.innerHTML = originalContent;
                alert('Terjadi kesalahan koneksi atau server.');
            });
        }

        function finishPurchase() {
            closeDetailModal();
            window.location.href = '{{ route("orangtua.home") }}';
        }
    </script>

</body>
</html>

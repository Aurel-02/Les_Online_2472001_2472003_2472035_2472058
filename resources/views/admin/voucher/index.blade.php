<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Voucher - Pintar.id</title>
    <meta name="description" content="Kelola voucher diskon untuk platform Pintar.id — tambah, ubah, dan hapus voucher dengan mudah.">
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

        body {
            background-color: #F7F4F0;
            color: var(--dark-oak);
            overflow-x: hidden;
            display: flex;
            height: 100vh;
        }

        /* ── Blobs ── */
        .blob-1 { position: fixed; top: -10%; right: 10%; width: 500px; height: 500px; background: rgba(142,150,128,0.15); border-radius: 50%; filter: blur(80px); z-index: 0; pointer-events: none; }
        .blob-2 { position: fixed; bottom: -10%; left: 20%; width: 400px; height: 400px; background: rgba(217,179,130,0.15); border-radius: 50%; filter: blur(60px); z-index: 0; pointer-events: none; }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-width);
            background: rgba(230,216,193,0.85);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255,255,255,0.6);
            height: 100vh;
            padding: 32px 24px;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0; top: 0;
            z-index: 50;
        }

        .logo-container { display: flex; align-items: center; gap: 12px; text-decoration: none; margin-bottom: 60px; }
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
        .sidebar-item-icon { font-size: 20px; }
        .logout-container { margin-top: auto; }
        .btn-logout {
            width: 100%; padding: 14px; border-radius: 16px;
            font-size: 15px; font-weight: 600; color: var(--dusty-mauve);
            background: rgba(163,124,118,0.1); border: none;
            cursor: pointer; transition: all 0.3s ease;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .btn-logout:hover { background: rgba(163,124,118,0.2); color: #8a655f; }

        /* ── Main ── */
        .main-wrapper { flex: 1; margin-left: var(--sidebar-width); height: 100vh; overflow-y: auto; position: relative; z-index: 5; }

        .topbar {
            padding: 24px 48px;
            display: flex; justify-content: flex-end; align-items: center;
            position: sticky; top: 0; z-index: 40;
        }
        .user-profile {
            display: flex; align-items: center; gap: 16px;
            background: rgba(255,255,255,0.6); backdrop-filter: blur(12px);
            padding: 8px 10px 8px 24px; border-radius: 99px;
            border: 1px solid rgba(255,255,255,0.8);
            box-shadow: 0 4px 14px rgba(61,43,31,0.04);
        }
        .user-greeting { font-size: 15px; font-weight: 500; color: rgba(61,43,31,0.7); }
        .user-greeting span { font-weight: 800; color: var(--dark-oak); }
        .user-avatar { width: 42px; height: 42px; border-radius: 50%; background: var(--dusty-mauve); display: flex; align-items: center; justify-content: center; font-weight: 800; color: white; font-size: 18px; }

        /* ── Content ── */
        .content-body { padding: 0 48px 80px; max-width: 1100px; margin: 0 auto; }

        /* ── Page Header ── */
        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 36px;
        }
        .page-header-left h1 { font-size: 32px; font-weight: 800; color: var(--dark-oak); letter-spacing: -0.5px; }
        .page-header-left p { font-size: 15px; color: rgba(61,43,31,0.55); margin-top: 6px; }

        .btn-primary {
            display: inline-flex; align-items: center; gap: 10px;
            background: var(--dark-oak); color: white;
            padding: 14px 28px; border-radius: 16px;
            font-weight: 700; font-size: 15px; text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(61,43,31,0.2);
        }
        .btn-primary:hover { background: #2A1D14; transform: translateY(-2px); box-shadow: 0 10px 28px rgba(61,43,31,0.25); }

        /* ── Alert ── */
        .alert {
            display: flex; align-items: center; gap: 14px;
            padding: 18px 24px; border-radius: 16px;
            font-size: 15px; font-weight: 600;
            margin-bottom: 28px;
            animation: slideDown 0.4s ease;
        }
        @keyframes slideDown { from { opacity:0; transform: translateY(-10px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(142,150,128,0.15); color: #555E49; border: 1px solid rgba(142,150,128,0.3); }
        .alert-error   { background: rgba(163,124,118,0.15); color: #8a655f; border: 1px solid rgba(163,124,118,0.3); }

        /* ── Filter Bar ── */
        .filter-bar {
            display: flex; gap: 16px; align-items: center;
            margin-bottom: 28px; flex-wrap: wrap;
        }
        .filter-tabs { display: flex; gap: 8px; }
        .filter-tab {
            padding: 10px 20px; border-radius: 99px;
            font-size: 14px; font-weight: 700;
            text-decoration: none; color: rgba(61,43,31,0.6);
            background: rgba(255,255,255,0.5);
            border: 1px solid rgba(255,255,255,0.8);
            transition: all 0.3s ease;
        }
        .filter-tab:hover, .filter-tab.active {
            background: var(--dark-oak); color: white;
            box-shadow: 0 4px 14px rgba(61,43,31,0.2);
        }
        .badge-count {
            display: inline-flex; align-items: center; justify-content: center;
            width: 20px; height: 20px; border-radius: 50%;
            font-size: 11px; font-weight: 800;
            background: rgba(61,43,31,0.12); color: var(--dark-oak);
            margin-left: 6px;
        }
        .filter-tab.active .badge-count { background: rgba(255,255,255,0.25); color: white; }

        .search-box {
            display: flex; align-items: center; gap: 10px;
            background: rgba(255,255,255,0.6); backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.8); border-radius: 14px;
            padding: 10px 18px; margin-left: auto;
        }
        .search-box input {
            border: none; background: transparent; outline: none;
            font-size: 14px; font-weight: 500; color: var(--dark-oak);
            width: 220px;
        }
        .search-box input::placeholder { color: rgba(61,43,31,0.4); }

        /* ── Glass Card & Table ── */
        .glass-card {
            background: rgba(255,255,255,0.45); backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.8); border-radius: 32px;
            padding: 36px; box-shadow: 0 10px 30px rgba(61,43,31,0.04);
            overflow: hidden;
        }

        .table-responsive { width: 100%; overflow-x: auto; }
        .custom-table { width: 100%; border-collapse: collapse; text-align: left; }
        .custom-table th {
            padding: 16px 20px; font-size: 12px; font-weight: 800;
            text-transform: uppercase; color: rgba(61,43,31,0.5);
            border-bottom: 2px solid rgba(61,43,31,0.06); letter-spacing: 0.5px;
        }
        .custom-table td {
            padding: 20px; font-size: 15px; font-weight: 600;
            color: var(--dark-oak); border-bottom: 1px solid rgba(61,43,31,0.06);
            vertical-align: middle;
        }
        .custom-table tr:last-child td { border-bottom: none; }
        .custom-table tr { transition: background-color 0.3s; }
        .custom-table tr:hover { background-color: rgba(255,255,255,0.3); }

        /* ── Voucher code badge ── */
        .voucher-code {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(61,43,31,0.06); padding: 8px 14px;
            border-radius: 10px; font-size: 13px; font-weight: 800;
            letter-spacing: 1px; color: var(--dark-oak);
            font-family: 'Courier New', monospace;
        }

        /* ── Tipe badge ── */
        .tipe-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 12px; border-radius: 99px;
            font-size: 12px; font-weight: 700;
        }
        .tipe-persen { background: rgba(112,161,255,0.15); color: #4B72D9; }
        .tipe-nominal { background: rgba(217,179,130,0.2); color: #967243; }

        /* ── Status pills ── */
        .status-pill {
            display: inline-flex; align-items: center;
            padding: 6px 14px; border-radius: 99px;
            font-size: 13px; font-weight: 700;
        }
        .status-aktif    { background: rgba(142,150,128,0.2); color: #555E49; }
        .status-expired  { background: rgba(163,124,118,0.15); color: #8a655f; }

        /* ── Action buttons ── */
        .action-group { display: flex; gap: 8px; }
        .btn-table-action {
            padding: 8px 16px; border-radius: 99px;
            font-size: 13px; font-weight: 700; text-decoration: none;
            border: 1px solid transparent; cursor: pointer; transition: all 0.3s;
        }
        .btn-action-primary { background: var(--dark-oak); color: white; border: none; }
        .btn-action-primary:hover { background: #2A1D14; transform: translateY(-1px); }
        .btn-action-outline { border-color: rgba(61,43,31,0.2); background: transparent; color: var(--dark-oak); }
        .btn-action-outline:hover { background: rgba(61,43,31,0.05); border-color: var(--dark-oak); transform: translateY(-1px); }
        .btn-action-danger { border-color: rgba(163,124,118,0.3); background: transparent; color: #8a655f; }
        .btn-action-danger:hover { background: rgba(163,124,118,0.1); border-color: #8a655f; transform: translateY(-1px); }

        /* ── Empty state ── */
        .empty-state { text-align: center; padding: 60px 20px; }
        .empty-state .empty-icon { font-size: 64px; margin-bottom: 20px; opacity: 0.5; }
        .empty-state h3 { font-size: 20px; font-weight: 800; color: var(--dark-oak); margin-bottom: 8px; }
        .empty-state p { font-size: 15px; color: rgba(61,43,31,0.5); }

        /* ── Pagination ── */
        .pagination-wrapper { display: flex; justify-content: center; margin-top: 36px; gap: 8px; }
        .pagination-wrapper .page-link {
            display: inline-flex; align-items: center; justify-content: center;
            width: 40px; height: 40px; border-radius: 12px;
            font-size: 14px; font-weight: 700; text-decoration: none;
            color: var(--dark-oak); background: rgba(255,255,255,0.6);
            border: 1px solid rgba(255,255,255,0.8); transition: all 0.3s;
        }
        .pagination-wrapper .page-link:hover,
        .pagination-wrapper .page-link.active { background: var(--dark-oak); color: white; }
        .pagination-wrapper .page-link.disabled { opacity: 0.4; pointer-events: none; }

        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrapper { margin-left: 0; }
            .content-body { padding: 0 24px 60px; }
            .topbar { padding: 24px; }
            .filter-bar { flex-direction: column; align-items: stretch; }
            .search-box { margin-left: 0; }
        }
    </style>
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    {{-- ══ SIDEBAR ══ --}}
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
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                </span> Dashboard
            </a>
            <a href="{{ route('admin.pengguna.index') }}" class="sidebar-item {{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </span> Manajemen Pengguna
            </a>
            <a href="{{ route('admin.voucher.index') }}" class="sidebar-item {{ request()->routeIs('admin.voucher.*') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                </span> Manajemen Voucher
            </a>
            <a href="{{ route('admin.paket.index') }}" class="sidebar-item {{ request()->routeIs('admin.paket.*') ? 'active' : '' }}">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                </span> Manajemen Paket
            </a>
        </div>

        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <span>🚪</span> Keluar Akun
                </button>
            </form>
        </div>
    </aside>

    {{-- ══ MAIN CONTENT ══ --}}
    <main class="main-wrapper">
        <header class="topbar">
            <div class="user-profile">
                <div class="user-greeting">Hi, <span>{{ explode(' ', $userName ?? 'Admin')[0] }}</span></div>
                <div class="user-avatar">
                    @if(isset($photoProfile) && $photoProfile)
                        <img src="{{ asset('uploads/profiles/' . $photoProfile) }}" alt="Profile" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                    @else
                        {{ strtoupper(substr($userName ?? 'A', 0, 1)) }}
                    @endif
                </div>
            </div>
        </header>

        <div class="content-body">

            {{-- Page Header --}}
            <div class="page-header">
                <div class="page-header-left">
                    <h1>Manajemen Voucher 🎟️</h1>
                    <p>Buat dan kelola kode voucher diskon untuk pengguna platform.</p>
                </div>
                <a href="{{ route('admin.voucher.create') }}" class="btn-primary" id="btn-tambah-voucher">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Tambah Voucher
                </a>
            </div>

            {{-- Alerts --}}
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error" role="alert">
                    <span>❌</span> {{ session('error') }}
                </div>
            @endif

            {{-- Filter & Search --}}
            <div class="filter-bar">
                <div class="filter-tabs">
                    <a href="{{ route('admin.voucher.index', array_merge(request()->except('status','page'), ['status'=>''])) }}"
                       class="filter-tab {{ $status === '' ? 'active' : '' }}">
                        Semua <span class="badge-count">{{ $counts['semua'] }}</span>
                    </a>
                    <a href="{{ route('admin.voucher.index', array_merge(request()->except('status','page'), ['status'=>'aktif'])) }}"
                       class="filter-tab {{ $status === 'aktif' ? 'active' : '' }}">
                        Aktif <span class="badge-count">{{ $counts['aktif'] }}</span>
                    </a>
                    <a href="{{ route('admin.voucher.index', array_merge(request()->except('status','page'), ['status'=>'kedaluwarsa'])) }}"
                       class="filter-tab {{ $status === 'kedaluwarsa' ? 'active' : '' }}">
                        Kedaluwarsa <span class="badge-count">{{ $counts['kedaluwarsa'] }}</span>
                    </a>
                </div>

                <form method="GET" action="{{ route('admin.voucher.index') }}" class="search-box">
                    @if($status)<input type="hidden" name="status" value="{{ $status }}">@endif
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="rgba(61,43,31,0.4)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" id="search-input" name="search" placeholder="Cari kode voucher..." value="{{ $search }}">
                </form>
            </div>

            {{-- Table Card --}}
            <div class="glass-card">
                @if($vouchers->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon">🎟️</div>
                        <h3>Belum ada voucher</h3>
                        <p>Klik "Tambah Voucher" untuk membuat voucher baru.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Voucher</th>
                                    <th>Tipe</th>
                                    <th>Nilai Potongan</th>
                                    <th>Tanggal Kedaluwarsa</th>
                                    <th>Status</th>
                                    <th style="text-align:center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vouchers as $i => $voucher)
                                <tr>
                                    <td style="color:rgba(61,43,31,0.4); font-size:13px;">
                                        {{ ($vouchers->currentPage() - 1) * $vouchers->perPage() + $i + 1 }}
                                    </td>
                                    <td>
                                        <span class="voucher-code">🏷 {{ $voucher->kode_voucher }}</span>
                                    </td>
                                    <td>
                                        @if(($voucher->tipe_potongan ?? 'nominal') === 'persentase')
                                            <span class="tipe-badge tipe-persen">% Persentase</span>
                                        @else
                                            <span class="tipe-badge tipe-nominal">Rp Nominal</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(($voucher->tipe_potongan ?? 'nominal') === 'persentase')
                                            <strong>{{ number_format($voucher->potongan, 0) }}%</strong>
                                        @else
                                            <strong>Rp {{ number_format($voucher->potongan, 0, ',', '.') }}</strong>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($voucher->tanggal_berakhir)->translatedFormat('d M Y') }}</td>
                                    <td>
                                        @if($voucher->isAktif())
                                            <span class="status-pill status-aktif">● Aktif</span>
                                        @else
                                            <span class="status-pill status-expired">● Kedaluwarsa</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-group" style="justify-content:center;">
                                            <a href="{{ route('admin.voucher.edit', $voucher->id_voucher) }}"
                                               class="btn-table-action btn-action-outline"
                                               id="btn-edit-voucher-{{ $voucher->id_voucher }}">Edit</a>
                                            <form method="POST" action="{{ route('admin.voucher.destroy', $voucher->id_voucher) }}"
                                                  onsubmit="return confirm('Hapus voucher {{ $voucher->kode_voucher }}? Tindakan ini tidak dapat dibatalkan.')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        class="btn-table-action btn-action-danger"
                                                        id="btn-hapus-voucher-{{ $voucher->id_voucher }}">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($vouchers->hasPages())
                        <div class="pagination-wrapper">
                            @if($vouchers->onFirstPage())
                                <span class="page-link disabled">‹</span>
                            @else
                                <a class="page-link" href="{{ $vouchers->previousPageUrl() }}">‹</a>
                            @endif

                            @foreach($vouchers->getUrlRange(max(1, $vouchers->currentPage()-2), min($vouchers->lastPage(), $vouchers->currentPage()+2)) as $page => $url)
                                <a class="page-link {{ $page == $vouchers->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
                            @endforeach

                            @if($vouchers->hasMorePages())
                                <a class="page-link" href="{{ $vouchers->nextPageUrl() }}">›</a>
                            @else
                                <span class="page-link disabled">›</span>
                            @endif
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </main>

    <script>
        // Auto-submit search on Enter (already native), dismiss alerts after 4s
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                el.style.transition = 'opacity 0.5s ease';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            });
        }, 4000);
    </script>
</body>
</html>


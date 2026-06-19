<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi & Income - Pintar.id</title>
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
        .blob-1 { position: fixed; top: -10%; right: 10%; width: 500px; height: 500px; background: rgba(163, 124, 118, 0.15); border-radius: 50%; filter: blur(80px); z-index: 0; pointer-events: none; }
        .blob-2 { position: fixed; bottom: -10%; left: 20%; width: 400px; height: 400px; background: rgba(142, 150, 128, 0.15); border-radius: 50%; filter: blur(60px); z-index: 0; pointer-events: none; }

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
            display: flex; align-items: center; gap: 12px;
            text-decoration: none; margin-bottom: 60px;
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

        .sidebar-item-icon { font-size: 20px; }

        .logout-container { margin-top: auto; }

        .btn-logout {
            width: 100%; padding: 14px; border-radius: 16px;
            font-size: 15px; font-weight: 600; color: var(--dusty-mauve);
            background: rgba(163, 124, 118, 0.1); border: none;
            cursor: pointer; transition: all 0.3s ease;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }

        .btn-logout:hover { background: rgba(163, 124, 118, 0.2); color: #8a655f; }

        /* ── Main Content Area ── */
        .main-wrapper {
            flex: 1; margin-left: var(--sidebar-width);
            height: 100vh; overflow-y: auto;
            position: relative; z-index: 5;
        }

        /* ── Topbar (Header) ── */
        .topbar {
            padding: 24px 48px; display: flex;
            justify-content: flex-end; align-items: center;
            position: sticky; top: 0; z-index: 40;
        }

        .user-profile {
            display: flex; align-items: center; gap: 16px;
            background: rgba(255,255,255,0.6); backdrop-filter: blur(12px);
            padding: 8px 10px 8px 24px; border-radius: 99px;
            border: 1px solid rgba(255,255,255,0.8);
            box-shadow: 0 4px 14px rgba(61,43,31,0.04);
            cursor: pointer; transition: transform 0.3s ease;
        }

        .user-profile:hover { transform: translateY(-2px); }

        .user-greeting { font-size: 15px; font-weight: 500; color: rgba(61,43,31,0.7); }
        .user-greeting span { font-weight: 800; color: var(--dark-oak); }

        .user-avatar {
            width: 42px; height: 42px; border-radius: 50%;
            background: var(--dusty-mauve);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: white; font-size: 18px;
        }

        /* ── Content Body ── */
        .content-body {
            padding: 0 48px 80px; max-width: 1200px; margin: 0 auto; width: 100%;
        }

        .page-title {
            font-size: 32px; font-weight: 800;
            margin-bottom: 32px; color: var(--dark-oak);
        }

        /* ── Stats Container ── */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 24px;
            padding: 32px; display: flex; align-items: center; gap: 24px;
            box-shadow: 0 10px 30px rgba(61, 43, 31, 0.04);
            transition: transform 0.3s ease;
        }

        .stat-card:hover { transform: translateY(-4px); }

        .stat-icon {
            width: 72px; height: 72px; border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 32px; flex-shrink: 0;
        }

        .bg-income { background: rgba(142, 150, 128, 0.2); color: #6A725D; }
        .bg-trans { background: rgba(163, 124, 118, 0.2); color: #8a655f; }

        .stat-info h3 { font-size: 36px; font-weight: 800; color: var(--dark-oak); line-height: 1; margin-bottom: 8px; }
        .stat-info p { font-size: 14px; font-weight: 700; color: rgba(61,43,31,0.55); text-transform: uppercase; letter-spacing: 0.5px; }

        /* ── Table Container ── */
        .glass-card {
            background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 32px;
            padding: 36px; box-shadow: 0 10px 30px rgba(61, 43, 31, 0.04);
            overflow: hidden;
        }

        .table-responsive { width: 100%; overflow-x: auto; }

        .styled-table { width: 100%; border-collapse: collapse; min-width: 800px; }
        .styled-table th {
            text-align: left; padding: 16px 20px; font-size: 13px; font-weight: 700;
            color: rgba(61,43,31,0.5); text-transform: uppercase; letter-spacing: 1px;
            border-bottom: 2px solid rgba(61,43,31,0.1);
        }
        .styled-table td {
            padding: 20px; border-bottom: 1px solid rgba(61,43,31,0.05);
            font-size: 15px; font-weight: 500; color: var(--dark-oak);
        }
        .styled-table tr:hover td { background: rgba(255,255,255,0.4); }
        .styled-table tr:last-child td { border-bottom: none; }

        .badge {
            padding: 6px 12px; border-radius: 99px; font-size: 12px; font-weight: 700;
            display: inline-block; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .badge-sukses { background: #d4edda; color: #155724; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-batal { background: #f8d7da; color: #721c24; }
        
        .empty-state { text-align: center; padding: 48px 24px; }
        .empty-icon { font-size: 64px; margin-bottom: 16px; opacity: 0.5; }
        .empty-text { font-size: 18px; color: rgba(61,43,31,0.5); font-weight: 600; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <!-- ══ SIDEBAR ══ -->
    <aside class="sidebar">
        <a href="/" class="logo-container">
            <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z"
                      fill="var(--dusty-mauve)" stroke="var(--dusty-mauve)" stroke-width="1.5" stroke-linejoin="round"/>
                <circle cx="12" cy="13" r="4" fill="var(--vintage-cream)" />
            </svg>
            <div class="logo-text">Pintar.id</div>
        </a>

        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                </span> Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </span> Kelola Pengguna
            </a>
            <a href="{{ route('admin.transactions') }}" class="sidebar-item active">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </span> Transaksi & Income
            </a>
            <a href="{{ route('admin.promo.index') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </span> Kelola Promo
            </a>
            <a href="{{ route('admin.paket.index') }}" class="sidebar-item">
                <span class="sidebar-item-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                </span> Paket Belajar
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

    <!-- ══ MAIN CONTENT ══ -->
    <main class="main-wrapper">
        <!-- ── HEADER ── -->
        <header class="topbar">
            <div></div>
            <div style="display: flex; align-items: center;">
                <a href="{{ route('admin.notifications') }}" class="notification-icon" style="margin-right: 20px; color: var(--dark-oak); position: relative; display: flex; align-items: center; text-decoration: none;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    @if(isset($reactivationRequestsCount) && $reactivationRequestsCount > 0)
                        <span style="position: absolute; top: -5px; right: -5px; background: #ff6b6b; color: white; font-size: 10px; font-weight: 800; width: 16px; height: 16px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid #F7F4F0;">{{ $reactivationRequestsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.profile') }}" class="user-profile" style="text-decoration:none;">
                    <div class="user-greeting">Hi, <span>{{ explode(' ', $userName ?? 'Admin')[0] }}</span></div>
                    <div class="user-avatar">
                        @if(isset($photoProfile) && $photoProfile)
                            <img src="{{ asset('uploads/profiles/' . $photoProfile) }}" alt="Profile" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                        @else
                            {{ strtoupper(substr($userName ?? 'A', 0, 1)) }}
                        @endif
                    </div>
                </a>
            </div>
        </header>

        <!-- ── DASHBOARD BODY ── -->
        <div class="content-body">
            <h1 class="page-title">Transaksi & Income</h1>

            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon bg-income">💰</div>
                    <div class="stat-info">
                        <h3>Rp {{ number_format($totalIncome ?? 0, 0, ',', '.') }}</h3>
                        <p>Total Pendapatan</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-trans">🧾</div>
                    <div class="stat-info">
                        <h3>{{ $totalTransactions ?? 0 }}</h3>
                        <p>Total Transaksi</p>
                    </div>
                </div>
            </div>

            <div class="glass-card">
                <h3 style="font-size: 20px; font-weight: 800; color: var(--dark-oak); margin-bottom: 24px;">Riwayat Transaksi (7 Hari Terakhir)</h3>
                
                <div style="position: relative; height:400px; width:100%;">
                    <canvas id="transactionsChart"></canvas>
                </div>
            </div>

            <div class="glass-card" style="margin-top: 32px;">
                <h3 style="font-size: 20px; font-weight: 800; color: var(--dark-oak); margin-bottom: 24px;">Rincian Riwayat Pembelian Paket</h3>
                
                <div class="table-responsive">
                    @if(isset($transactions) && count($transactions) > 0)
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Siswa</th>
                                    <th>Paket Belajar</th>
                                    <th>Voucher</th>
                                    <th>Metode</th>
                                    <th>Total Bayar</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $t)
                                    @php
                                        $badgeClass = match($t->status) {
                                            'berhasil', 'sukses' => 'badge-sukses',
                                            'pending' => 'badge-pending',
                                            default => 'badge-batal'
                                        };
                                        $statusText = match($t->status) {
                                            'berhasil', 'sukses' => 'Sukses',
                                            'pending' => 'Pending',
                                            default => 'Batal'
                                        };
                                    @endphp
                                    <tr>
                                        <td>#{{ $t->id_transaksi }}</td>
                                        <td>
                                            <div style="font-weight: 700;">{{ $t->user->nama ?? 'N/A' }}</div>
                                            <div style="font-size: 12px; color: rgba(61,43,31,0.5);">{{ $t->user->email ?? '' }}</div>
                                        </td>
                                        <td>
                                            <div style="font-weight: 700;">{{ $t->paket->nama ?? 'N/A' }}</div>
                                            <div style="font-size: 12px; color: rgba(61,43,31,0.5);">{{ $t->paket->jenjang ?? '' }}</div>
                                        </td>
                                        <td>
                                            @if($t->voucher)
                                                <strong style="color: var(--dusty-mauve);">{{ $t->voucher->kode_voucher }}</strong>
                                                <div style="font-size: 11px; color: var(--dusty-mauve);">-Rp {{ number_format($t->voucher->potongan, 0, ',', '.') }}</div>
                                            @else
                                                <span style="color: rgba(61,43,31,0.4);">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $t->metode_pembayaran ?? 'N/A' }}</td>
                                        <td><strong>Rp {{ number_format($t->subtotal, 0, ',', '.') }}</strong></td>
                                        <td>
                                            <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($t->created_at)->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">💸</div>
                            <div class="empty-text">Belum ada riwayat transaksi paket pembelajaran.</div>
                        </div>
                    @endif
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const ctx = document.getElementById('transactionsChart').getContext('2d');
                    
                    const labels = @json($chartLabels);
                    const data = @json($chartData);
                    
                    const chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Pendapatan Harian (Rp)',
                                data: data,
                                borderColor: '#A37C76', // var(--dusty-mauve)
                                backgroundColor: 'rgba(163, 124, 118, 0.2)',
                                borderWidth: 3,
                                pointBackgroundColor: '#8E9680', // var(--muted-sage)
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointRadius: 5,
                                pointHoverRadius: 7,
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(61,43,31,0.9)',
                                    titleFont: { size: 14, family: "'Outfit', sans-serif" },
                                    bodyFont: { size: 14, family: "'Outfit', sans-serif" },
                                    padding: 12,
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.dataset.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            if (context.parsed.y !== null) {
                                                label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(context.parsed.y);
                                            }
                                            return label;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(61,43,31,0.05)',
                                        drawBorder: false,
                                    },
                                    ticks: {
                                        font: { family: "'Outfit', sans-serif" },
                                        color: 'rgba(61,43,31,0.6)',
                                        callback: function(value, index, values) {
                                            if (value >= 1000000) return (value / 1000000) + ' Juta';
                                            if (value >= 1000) return (value / 1000) + ' Ribu';
                                            return value;
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false,
                                        drawBorder: false,
                                    },
                                    ticks: {
                                        font: { family: "'Outfit', sans-serif" },
                                        color: 'rgba(61,43,31,0.6)'
                                    }
                                }
                            }
                        }
                    });
                });
            </script>

        </div>
    </main>
</body>
</html>

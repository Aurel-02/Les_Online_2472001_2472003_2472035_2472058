<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $voucher ? 'Edit Voucher' : 'Tambah Voucher' }} - Pintar.id</title>
    <meta name="description" content="Formulir pembuatan dan pengeditan voucher diskon Pintar.id.">
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
            display: flex; flex-direction: column;
            position: fixed; left: 0; top: 0; z-index: 50;
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
            background: rgba(255,255,255,0.5); color: var(--dark-oak);
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
        .content-body { padding: 0 48px 80px; max-width: 800px; margin: 0 auto; }

        /* ── Breadcrumb ── */
        .breadcrumb {
            display: flex; align-items: center; gap: 10px;
            font-size: 14px; font-weight: 600; color: rgba(61,43,31,0.5);
            margin-bottom: 28px;
        }
        .breadcrumb a { text-decoration: none; color: rgba(61,43,31,0.5); transition: color 0.2s; }
        .breadcrumb a:hover { color: var(--dark-oak); }
        .breadcrumb span { color: var(--dark-oak); }

        /* ── Page Header ── */
        .page-header { margin-bottom: 36px; }
        .page-header h1 { font-size: 32px; font-weight: 800; color: var(--dark-oak); letter-spacing: -0.5px; }
        .page-header p { font-size: 15px; color: rgba(61,43,31,0.55); margin-top: 6px; }

        /* ── Form Card ── */
        .form-card {
            background: rgba(255,255,255,0.55); backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.85); border-radius: 32px;
            padding: 48px; box-shadow: 0 16px 40px rgba(61,43,31,0.06);
        }

        /* ── Validation Errors ── */
        .validation-errors {
            background: rgba(163,124,118,0.1);
            border: 1px solid rgba(163,124,118,0.3);
            border-radius: 16px; padding: 20px 24px;
            margin-bottom: 32px;
        }
        .validation-errors p { font-size: 14px; font-weight: 700; color: #8a655f; margin-bottom: 10px; }
        .validation-errors ul { padding-left: 20px; }
        .validation-errors ul li { font-size: 14px; color: #8a655f; font-weight: 600; margin-bottom: 4px; }

        /* ── Form Elements ── */
        .form-section-title {
            font-size: 13px; font-weight: 800; text-transform: uppercase;
            letter-spacing: 1px; color: rgba(61,43,31,0.4);
            margin-bottom: 20px; margin-top: 36px;
            padding-bottom: 10px; border-bottom: 1px solid rgba(61,43,31,0.08);
        }
        .form-section-title:first-child { margin-top: 0; }

        .form-group { margin-bottom: 24px; }
        .form-label {
            display: block; font-size: 14px; font-weight: 700;
            color: var(--dark-oak); margin-bottom: 10px;
        }
        .form-label .required { color: var(--dusty-mauve); margin-left: 4px; }
        .form-hint { font-size: 12px; font-weight: 500; color: rgba(61,43,31,0.45); margin-top: 6px; }

        .form-control {
            width: 100%; padding: 14px 18px;
            background: rgba(255,255,255,0.7); backdrop-filter: blur(8px);
            border: 1.5px solid rgba(61,43,31,0.12); border-radius: 14px;
            font-size: 15px; font-weight: 500; color: var(--dark-oak);
            outline: none; transition: all 0.3s ease;
            font-family: 'Outfit', sans-serif;
        }
        .form-control:focus {
            border-color: var(--dusty-mauve);
            background: rgba(255,255,255,0.9);
            box-shadow: 0 0 0 4px rgba(163,124,118,0.1);
        }
        .form-control.is-invalid {
            border-color: rgba(163,124,118,0.7);
            box-shadow: 0 0 0 4px rgba(163,124,118,0.08);
        }
        .invalid-feedback { font-size: 13px; font-weight: 600; color: #8a655f; margin-top: 6px; display: block; }

        /* ── Tipe Potongan Toggle ── */
        .tipe-toggle {
            display: flex; gap: 12px;
        }
        .tipe-option {
            flex: 1; position: relative;
        }
        .tipe-option input[type="radio"] { display: none; }
        .tipe-option label {
            display: flex; flex-direction: column; align-items: center; gap: 8px;
            padding: 20px 16px; border-radius: 16px; cursor: pointer;
            background: rgba(255,255,255,0.5);
            border: 2px solid rgba(61,43,31,0.1);
            transition: all 0.3s ease; text-align: center;
        }
        .tipe-option label .tipe-icon { font-size: 28px; }
        .tipe-option label .tipe-name { font-size: 14px; font-weight: 800; color: var(--dark-oak); }
        .tipe-option label .tipe-desc { font-size: 12px; font-weight: 500; color: rgba(61,43,31,0.5); }
        .tipe-option input[type="radio"]:checked + label {
            border-color: var(--dusty-mauve);
            background: rgba(163,124,118,0.1);
            box-shadow: 0 4px 16px rgba(163,124,118,0.15);
        }
        .tipe-option input[type="radio"]:checked + label .tipe-name { color: #8a655f; }

        /* ── Potongan field with prefix/suffix ── */
        .input-group {
            display: flex; align-items: center;
            background: rgba(255,255,255,0.7); backdrop-filter: blur(8px);
            border: 1.5px solid rgba(61,43,31,0.12); border-radius: 14px;
            transition: all 0.3s ease; overflow: hidden;
        }
        .input-group:focus-within {
            border-color: var(--dusty-mauve);
            background: rgba(255,255,255,0.9);
            box-shadow: 0 0 0 4px rgba(163,124,118,0.1);
        }
        .input-group.is-invalid { border-color: rgba(163,124,118,0.7); }
        .input-addon {
            padding: 14px 16px; font-size: 14px; font-weight: 800;
            color: rgba(61,43,31,0.5); background: rgba(61,43,31,0.04);
            border-right: 1.5px solid rgba(61,43,31,0.08); white-space: nowrap;
            min-width: 52px; text-align: center;
        }
        .input-addon.suffix { border-right: none; border-left: 1.5px solid rgba(61,43,31,0.08); }
        .input-group .form-control {
            border: none; border-radius: 0; background: transparent;
            box-shadow: none !important;
        }
        .input-group .form-control:focus { border: none; box-shadow: none !important; }

        /* ── Kode preview ── */
        .kode-preview {
            margin-top: 10px; padding: 12px 18px; border-radius: 12px;
            background: rgba(61,43,31,0.04);
            font-size: 18px; font-weight: 800; letter-spacing: 2px;
            color: var(--dark-oak); font-family: 'Courier New', monospace;
            display: none; align-items: center; gap: 10px;
        }
        .kode-preview.visible { display: flex; }

        /* ── Action buttons ── */
        .form-actions {
            display: flex; gap: 16px; margin-top: 40px; padding-top: 32px;
            border-top: 1px solid rgba(61,43,31,0.08);
        }
        .btn-submit {
            flex: 1; padding: 16px 32px; border-radius: 16px;
            font-size: 16px; font-weight: 700; cursor: pointer;
            border: none; transition: all 0.3s ease;
            background: var(--dark-oak); color: white;
            box-shadow: 0 8px 24px rgba(61,43,31,0.2);
        }
        .btn-submit:hover { background: #2A1D14; transform: translateY(-2px); box-shadow: 0 12px 32px rgba(61,43,31,0.25); }
        .btn-cancel {
            padding: 16px 28px; border-radius: 16px;
            font-size: 16px; font-weight: 700; cursor: pointer;
            border: 1.5px solid rgba(61,43,31,0.15); background: transparent;
            color: rgba(61,43,31,0.6); text-decoration: none;
            display: inline-flex; align-items: center; transition: all 0.3s ease;
        }
        .btn-cancel:hover { background: rgba(61,43,31,0.05); color: var(--dark-oak); border-color: rgba(61,43,31,0.3); }

        /* ── Expiry warning ── */
        .expiry-warning {
            display: none; margin-top: 8px; padding: 10px 14px;
            border-radius: 10px; background: rgba(217,179,130,0.2);
            border: 1px solid rgba(217,179,130,0.4);
            font-size: 13px; font-weight: 600; color: #967243;
        }

        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrapper { margin-left: 0; }
            .content-body { padding: 0 24px 60px; max-width: 100%; }
            .topbar { padding: 24px; }
            .form-card { padding: 28px 24px; }
            .tipe-toggle { flex-direction: column; }
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

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>›</span>
                <a href="{{ route('admin.voucher.index') }}">Manajemen Voucher</a>
                <span>›</span>
                <span>{{ $voucher ? 'Edit Voucher' : 'Tambah Voucher' }}</span>
            </div>

            {{-- Page Header --}}
            <div class="page-header">
                <h1>{{ $voucher ? '✏️ Edit Voucher' : '🎟️ Tambah Voucher Baru' }}</h1>
                <p>{{ $voucher ? 'Perbarui detail voucher yang sudah ada.' : 'Isi formulir berikut untuk membuat voucher diskon baru.' }}</p>
            </div>

            {{-- Form Card --}}
            <div class="form-card">

                {{-- Validation Errors --}}
                @if($errors->any())
                    <div class="validation-errors">
                        <p>⚠️ Terdapat beberapa kesalahan pada formulir:</p>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    id="voucher-form"
                    method="POST"
                    action="{{ $voucher ? route('admin.voucher.update', $voucher->id_voucher) : route('admin.voucher.store') }}">
                    @csrf
                    @if($voucher) @method('PUT') @endif

                    {{-- ── SECTION: Identitas Voucher ── --}}
                    <p class="form-section-title">Identitas Voucher</p>

                    <div class="form-group">
                        <label for="kode_voucher" class="form-label">
                            Kode Voucher <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            id="kode_voucher"
                            name="kode_voucher"
                            class="form-control {{ $errors->has('kode_voucher') ? 'is-invalid' : '' }}"
                            placeholder="Contoh: DISKON50, BELAJARHEMAT"
                            value="{{ old('kode_voucher', $voucher?->kode_voucher) }}"
                            maxlength="50"
                            autocomplete="off"
                            style="text-transform: uppercase; letter-spacing: 1px;"
                            required>
                        @error('kode_voucher')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="kode-preview" id="kode-preview">
                            🏷 <span id="kode-preview-text"></span>
                        </div>
                        <p class="form-hint">Kode akan otomatis diubah menjadi huruf kapital. Maksimal 50 karakter, tanpa spasi.</p>
                    </div>

                    {{-- ── SECTION: Nilai Potongan ── --}}
                    <p class="form-section-title">Nilai Potongan</p>

                    <div class="form-group">
                        <label class="form-label">
                            Tipe Potongan <span class="required">*</span>
                        </label>
                        <div class="tipe-toggle">
                            <div class="tipe-option">
                                <input
                                    type="radio" id="tipe-nominal" name="tipe_potongan"
                                    value="nominal"
                                    {{ old('tipe_potongan', $voucher?->tipe_potongan ?? 'nominal') === 'nominal' ? 'checked' : '' }}>
                                <label for="tipe-nominal">
                                    <span class="tipe-icon">💰</span>
                                    <span class="tipe-name">Nominal Tetap</span>
                                    <span class="tipe-desc">Potongan harga dalam Rupiah</span>
                                </label>
                            </div>
                            <div class="tipe-option">
                                <input
                                    type="radio" id="tipe-persentase" name="tipe_potongan"
                                    value="persentase"
                                    {{ old('tipe_potongan', $voucher?->tipe_potongan ?? 'nominal') === 'persentase' ? 'checked' : '' }}>
                                <label for="tipe-persentase">
                                    <span class="tipe-icon">📊</span>
                                    <span class="tipe-name">Persentase</span>
                                    <span class="tipe-desc">Potongan dalam persen (%)</span>
                                </label>
                            </div>
                        </div>
                        @error('tipe_potongan')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="potongan" class="form-label">
                            Nilai Potongan <span class="required">*</span>
                        </label>
                        <div class="input-group {{ $errors->has('potongan') ? 'is-invalid' : '' }}" id="potongan-wrapper">
                            <span class="input-addon" id="potongan-prefix">Rp</span>
                            <input
                                type="number"
                                id="potongan"
                                name="potongan"
                                class="form-control"
                                placeholder="0"
                                value="{{ old('potongan', $voucher?->potongan) }}"
                                min="0"
                                step="any"
                                required>
                            <span class="input-addon suffix" id="potongan-suffix" style="display:none;">%</span>
                        </div>
                        @error('potongan')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <p class="form-hint" id="potongan-hint">Masukkan jumlah potongan dalam Rupiah.</p>
                    </div>

                    {{-- ── SECTION: Masa Berlaku ── --}}
                    <p class="form-section-title">Masa Berlaku</p>

                    <div class="form-group">
                        <label for="tanggal_berakhir" class="form-label">
                            Tanggal Kedaluwarsa <span class="required">*</span>
                        </label>
                        <input
                            type="date"
                            id="tanggal_berakhir"
                            name="tanggal_berakhir"
                            class="form-control {{ $errors->has('tanggal_berakhir') ? 'is-invalid' : '' }}"
                            value="{{ old('tanggal_berakhir', $voucher?->tanggal_berakhir?->format('Y-m-d')) }}"
                            min="{{ date('Y-m-d') }}"
                            required>
                        @error('tanggal_berakhir')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="expiry-warning" id="expiry-warning">
                            ⚠️ Tanggal yang dipilih sudah lewat. Voucher akan langsung berstatus kedaluwarsa.
                        </div>
                        <p class="form-hint">Voucher tidak dapat digunakan setelah tanggal ini.</p>
                    </div>

                    {{-- ── ACTIONS ── --}}
                    <div class="form-actions">
                        <a href="{{ route('admin.voucher.index') }}" class="btn-cancel" id="btn-batal">
                            Batal
                        </a>
                        <button type="submit" class="btn-submit" id="btn-simpan-voucher">
                            {{ $voucher ? '💾 Simpan Perubahan' : '✨ Buat Voucher' }}
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </main>

    <script>
        // ── Uppercase kode voucher live ──
        const kodeInput    = document.getElementById('kode_voucher');
        const kodePreview  = document.getElementById('kode-preview');
        const kodePreviewText = document.getElementById('kode-preview-text');

        function updateKodePreview() {
            const val = kodeInput.value.trim().toUpperCase().replace(/\s+/g, '');
            kodeInput.value = val;
            if (val.length > 0) {
                kodePreviewText.textContent = val;
                kodePreview.classList.add('visible');
            } else {
                kodePreview.classList.remove('visible');
            }
        }
        kodeInput.addEventListener('input', updateKodePreview);
        updateKodePreview(); // run on load for edit mode

        // ── Tipe potongan toggle ──
        const radios         = document.querySelectorAll('input[name="tipe_potongan"]');
        const prefix         = document.getElementById('potongan-prefix');
        const suffix         = document.getElementById('potongan-suffix');
        const hint           = document.getElementById('potongan-hint');
        const potonganInput  = document.getElementById('potongan');

        function applyTipeUI(tipe) {
            if (tipe === 'persentase') {
                prefix.style.display = 'none';
                suffix.style.display = '';
                hint.textContent = 'Masukkan nilai persentase antara 0–100.';
                potonganInput.setAttribute('max', '100');
                potonganInput.setAttribute('placeholder', '0');
            } else {
                prefix.style.display = '';
                suffix.style.display = 'none';
                hint.textContent = 'Masukkan jumlah potongan dalam Rupiah.';
                potonganInput.removeAttribute('max');
                potonganInput.setAttribute('placeholder', '0');
            }
        }

        radios.forEach(r => {
            r.addEventListener('change', () => applyTipeUI(r.value));
            if (r.checked) applyTipeUI(r.value);
        });

        // ── Tanggal expiry warning ──
        const tanggalInput   = document.getElementById('tanggal_berakhir');
        const expiryWarning  = document.getElementById('expiry-warning');

        function checkExpiry() {
            const today    = new Date(); today.setHours(0,0,0,0);
            const selected = new Date(tanggalInput.value);
            if (tanggalInput.value && selected < today) {
                expiryWarning.style.display = 'block';
            } else {
                expiryWarning.style.display = 'none';
            }
        }
        tanggalInput.addEventListener('change', checkExpiry);
        checkExpiry();
    </script>
</body>
</html>


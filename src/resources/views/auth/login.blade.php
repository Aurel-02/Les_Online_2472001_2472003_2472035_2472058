<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-oak: #3D2B1F;
            --muted-sage: #8E9680;
            --dusty-mauve: #A37C76;
            --warm-amber: #D9B382;
            --vintage-cream: #E6D8C1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--vintage-cream);
            color: var(--dark-oak);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .blob-1 {
            position: fixed;
            top: -10%;
            right: -5%;
            width: 600px;
            height: 600px;
            background-color: rgba(142, 150, 128, 0.2);
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
        }

        .blob-2 {
            position: fixed;
            bottom: -10%;
            left: -5%;
            width: 400px;
            height: 400px;
            background-color: rgba(217, 179, 130, 0.2);
            border-radius: 50%;
            filter: blur(60px);
            z-index: 0;
            pointer-events: none;
        }

        nav {
            padding: 24px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 10;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 800;
            color: var(--dark-oak);
            letter-spacing: -0.5px;
        }

        .back-link {
            font-size: 15px;
            font-weight: 600;
            color: var(--dark-oak);
            text-decoration: none;
            padding: 10px 22px;
            border-radius: 30px;
            border: 2px solid var(--dark-oak);
            transition: all 0.3s ease;
        }

        .back-link:hover {
            background-color: var(--dark-oak);
            color: var(--vintage-cream);
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            position: relative;
            z-index: 5;
        }

        .auth-card {
            background: rgba(230, 216, 193, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 28px;
            padding: 48px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 8px 32px rgba(61, 43, 31, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .auth-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(61, 43, 31, 0.12);
        }

        .badge {
            display: inline-block;
            background-color: var(--warm-amber);
            color: var(--dark-oak);
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 16px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .card-title {
            font-size: 32px;
            font-weight: 800;
            color: var(--dark-oak);
            letter-spacing: -1px;
            margin-bottom: 6px;
        }

        .card-subtitle {
            font-size: 15px;
            color: rgba(61, 43, 31, 0.6);
            margin-bottom: 32px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            color: var(--dark-oak);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid rgba(61, 43, 31, 0.15);
            border-radius: 14px;
            font-size: 15px;
            font-family: 'Outfit', sans-serif;
            background: rgba(255, 255, 255, 0.6);
            color: var(--dark-oak);
            outline: none;
            transition: all 0.25s ease;
        }

        .form-control::placeholder {
            color: rgba(61, 43, 31, 0.4);
        }

        .form-control:focus {
            border-color: var(--muted-sage);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 0 4px rgba(142, 150, 128, 0.15);
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background-color: var(--muted-sage);
            color: white;
            border: none;
            border-radius: 40px;
            font-size: 17px;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
            box-shadow: 0 4px 14px rgba(142, 150, 128, 0.35);
        }

        .btn-submit:hover {
            background-color: #7b846e;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(142, 150, 128, 0.45);
        }

        .alert-error {
            background-color: rgba(163, 124, 118, 0.15);
            color: var(--dusty-mauve);
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid rgba(163, 124, 118, 0.3);
        }

        .error-message {
            color: var(--dusty-mauve);
            font-size: 13px;
            margin-top: 6px;
            font-weight: 500;
        }

        .footer-link {
            text-align: center;
            margin-top: 24px;
            font-size: 15px;
            color: rgba(61, 43, 31, 0.6);
        }

        .footer-link a {
            color: var(--muted-sage);
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-link a:hover {
            color: #7b846e;
        }
    </style>
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <nav>
        <a href="/" class="logo-container">
            <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z" fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/>
                <circle cx="12" cy="13" r="4" fill="var(--vintage-cream)" />
            </svg>
            <div class="logo-text">Pintar.id</div>
        </a>
        <a href="/" class="back-link">← Kembali</a>
    </nav>

    <div class="main-content">
        <div class="auth-card">
            <div class="badge">Selamat Datang</div>
            <h1 class="card-title">Masuk ke Akun</h1>
            <p class="card-subtitle">Lanjutkan perjalanan belajarmu hari ini.</p>

            @if($errors->any())
                <div class="alert-error">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                        value="{{ old('email') }}" required autofocus placeholder="email@contoh.com">
                    @error('email') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control"
                        required placeholder="Masukkan password">
                    @error('password') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn-submit">Masuk Sekarang</button>
            </form>

            <div class="footer-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </div>
        </div>
    </div>
</body>
</html>

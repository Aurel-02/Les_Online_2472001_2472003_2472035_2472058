<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pintar.id - Les Online SD & SMP</title>
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
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        header {
            padding: 24px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            background-color: var(--muted-sage);
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-icon svg {
            width: 24px;
            height: 24px;
            fill: white; 
        }

        .logo-text {
            font-size: 24px;
            font-weight: 800;
            color: var(--dark-oak);
            letter-spacing: -0.5px;
        }

        .nav-buttons {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            display: inline-block;
        }

        .btn-login {
            background-color: transparent;
            color: var(--dark-oak);
        }
        
        .btn-login:hover {
            color: var(--muted-sage);
        }

        .btn-register {
            background-color: var(--muted-sage);
            color: white;
            box-shadow: 0 4px 14px rgba(142, 150, 128, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(142, 150, 128, 0.4);
            background-color: #7b846e;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: calc(100vh - 100px);
            padding: 40px 0;
            position: relative;
        }

        .hero-content {
            flex: 1;
            max-width: 600px;
            z-index: 2;
        }

        .badge {
            display: inline-block;
            background-color: var(--warm-amber);
            color: var(--dark-oak);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 24px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .hero h1 {
            font-size: 72px;
            line-height: 1.1;
            font-weight: 800;
            margin-bottom: 24px;
            letter-spacing: -2px;
        }

        .hero h1 span {
            color: var(--muted-sage);
        }

        .hero p {
            font-size: 20px;
            line-height: 1.6;
            color: rgba(61, 43, 31, 0.8);
            margin-bottom: 40px;
            max-width: 500px;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
        }

        .btn-primary {
            background-color: var(--dusty-mauve);
            color: white;
            padding: 16px 32px;
            font-size: 18px;
            border-radius: 40px;
            box-shadow: 0 4px 14px rgba(163, 124, 118, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(163, 124, 118, 0.4);
            background-color: #926b65;
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--dark-oak);
            border: 2px solid var(--dark-oak);
            padding: 14px 32px;
            font-size: 18px;
            border-radius: 40px;
        }

        .btn-secondary:hover {
            background-color: var(--dark-oak);
            color: var(--vintage-cream);
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            position: relative;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            border-radius: 30px;
            z-index: 2;
            position: relative;
        }

        .blob-1 {
            position: absolute;
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
            position: absolute;
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

        .stats-container {
            display: flex;
            gap: 40px;
            margin-top: 60px;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 800;
            color: var(--dark-oak);
        }

        .stat-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--muted-sage);
            text-transform: uppercase;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @media (max-width: 992px) {
            .hero {
                flex-direction: column;
                text-align: center;
                gap: 40px;
                margin-top: 40px;
            }
            .hero-content {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .hero h1 {
                font-size: 56px;
            }
            .hero-buttons {
                justify-content: center;
            }
            .stats-container {
                justify-content: center;
            }
        }
        
        @media (max-width: 576px) {
            .hero h1 {
                font-size: 42px;
            }
            .nav-buttons {
                gap: 8px;
            }
            .btn {
                padding: 10px 16px;
            }
            .hero-buttons {
                flex-direction: column;
                width: 100%;
            }
            .hero-buttons .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <div class="container">
        <header>
            <a href="/" class="logo-container">
                <svg width="42" height="42" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z" fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/>
                    <circle cx="12" cy="13" r="4" fill="var(--vintage-cream)" />
                </svg>
                <div class="logo-text">Pintar.id</div>
            </a>
            <div class="nav-buttons">
                <a href="{{ route('login') }}" class="btn btn-login">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-register">Daftar</a>
            </div>
        </header>

        <main class="hero">
            <div class="hero-content">
                <div class="badge">#1 Platform Les Online</div>
                <h1>Belajar <span>Pintar</span><br>Masa Depan<br>Cerah.</h1>
                <p>Platform les online terpercaya untuk siswa SD sampai SMP. Kami hadir untuk membimbing anak Anda berprestasi dan mengeksplorasi ilmu pengetahuan dengan cara yang menyenangkan.</p>
                
                <div class="stats-container">
                    <div class="stat-item">
                        <span class="stat-number">10k+</span>
                        <span class="stat-label">Siswa Aktif</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Tutor Ahli</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">4.9/5</span>
                        <span class="stat-label">Rating Ulasan</span>
                    </div>
                </div>
            </div>
            
            <div class="hero-image floating">
                <img src="{{ asset('images/character.png') }}" alt="Ilustrasi Belajar Pintar" style="mix-blend-mode: multiply;">
            </div>
        </main>
    </div>
</body>
</html>

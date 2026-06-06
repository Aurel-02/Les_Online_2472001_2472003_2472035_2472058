<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Dinonaktifkan - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-oak: #3D2B1F;
            --dusty-mauve: #A37C76;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: #F7F4F0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: var(--dark-oak);
        }

        .blob-1 { position: absolute; top: -10%; left: -10%; width: 500px; height: 500px; background: rgba(163, 124, 118, 0.2); border-radius: 50%; filter: blur(80px); z-index: 0; }
        .blob-2 { position: absolute; bottom: -10%; right: -10%; width: 400px; height: 400px; background: rgba(217, 179, 130, 0.2); border-radius: 50%; filter: blur(60px); z-index: 0; }

        .card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: 32px;
            padding: 48px;
            text-align: center;
            max-width: 480px;
            width: 90%;
            box-shadow: 0 20px 40px rgba(61, 43, 31, 0.05);
            z-index: 10;
        }

        .icon {
            font-size: 64px;
            margin-bottom: 24px;
            display: block;
        }

        h1 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 16px;
            color: var(--dark-oak);
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            color: rgba(61, 43, 31, 0.7);
            margin-bottom: 32px;
        }

        .btn-request {
            display: inline-block;
            width: 100%;
            padding: 16px;
            background: var(--dark-oak);
            color: white;
            text-decoration: none;
            border-radius: 16px;
            font-weight: 600;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 16px;
        }

        .btn-request:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(61, 43, 31, 0.15);
        }

        .btn-disabled {
            background: #ccc;
            color: #666;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        .btn-back {
            display: inline-block;
            color: var(--dusty-mauve);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .btn-back:hover {
            color: var(--dark-oak);
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: 600;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <div class="card">
        <span class="icon">🔒</span>
        <h1>Akun Dinonaktifkan</h1>
        
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <p>Halo <strong>{{ $user->nama }}</strong>, saat ini akun Anda sedang dinonaktifkan oleh administrator. Anda tidak dapat menggunakan layanan Pintar.id untuk sementara waktu.</p>

        <form action="{{ route('account.reactivate.request', $user->id_user) }}" method="POST">
            @csrf
            @if($user->reactivation_requested)
                <button type="button" class="btn-request btn-disabled" disabled>Pengajuan Sedang Diproses</button>
                <p style="font-size: 13px; margin-bottom:16px;">Anda sudah mengajukan permohonan. Mohon tunggu admin untuk memprosesnya.</p>
            @else
                <button type="submit" class="btn-request">Ajukan Pengaktifan Kembali</button>
            @endif
        </form>

        <a href="{{ route('login') }}" class="btn-back">Kembali ke Halaman Login</a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otentikasi E-Voting - PAC IPNU IPPNU Kemiri</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #15803d;
            --primary-light: #22c55e;
            --primary-dark: #14532d;
            --accent: #facc15;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg: #f0fdf4;
            --border: #e2e8f0;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text-dark); min-height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        
        .mesh-bg {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;
            background: #f0fdf4;
            background-image:
                radial-gradient(at 0% 0%, rgba(21,128,61,0.18) 0px, transparent 55%),
                radial-gradient(at 100% 0%, rgba(250,204,21,0.12) 0px, transparent 55%),
                radial-gradient(at 50% 100%, rgba(21,128,61,0.1) 0px, transparent 55%);
        }

        .auth-container {
            width: 100%; max-width: 440px; padding: 20px;
            z-index: 10;
        }

        .auth-card {
            background: white; border-radius: 28px;
            padding: 40px 32px; text-align: center;
            box-shadow: 0 12px 40px rgba(0,0,0,0.08);
            border: 1px solid var(--border);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .lock-icon {
            width: 72px; height: 72px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            color: white; border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem; margin: 0 auto 24px;
            box-shadow: 0 8px 24px rgba(21,128,61,0.25);
            transform: rotate(-10deg);
        }

        h1 { font-family: 'Outfit', sans-serif; font-size: 1.8rem; font-weight: 900; margin-bottom: 12px; color: var(--primary-dark); }
        p { color: var(--text-light); font-size: 0.95rem; margin-bottom: 30px; line-height: 1.6; }

        .input-group { position: relative; margin-bottom: 24px; }
        .input-group i {
            position: absolute; left: 18px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 1.2rem;
        }
        input {
            width: 100%; padding: 16px 16px 16px 50px;
            border: 2px solid var(--border); border-radius: 16px;
            font-size: 1.1rem; font-family: 'Outfit'; font-weight: 700;
            text-align: center; letter-spacing: 2px;
            transition: all 0.3s;
            outline: none; background: #f8fafc;
        }
        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(21,128,61,0.1);
            background: white;
        }

        .btn-submit {
            width: 100%; background: var(--text-dark); color: white;
            padding: 16px; border: none; border-radius: 16px;
            font-weight: 900; font-size: 1rem; text-transform: uppercase; letter-spacing: 1px;
            cursor: pointer; transition: all 0.3s;
            box-shadow: 0 4px 0 #0f172a;
        }
        .btn-submit:hover {
            background: var(--primary);
            box-shadow: 0 6px 0 var(--primary-dark), 0 12px 24px rgba(21,128,61,0.25);
            transform: translateY(-2px);
        }
        .btn-submit:active { transform: translateY(2px); box-shadow: 0 2px 0 var(--primary-dark); }

        .alert-error {
            background: #fef2f2; border: 1px solid #fecaca; color: #ef4444;
            padding: 12px; border-radius: 12px; font-weight: 600; font-size: 0.85rem;
            margin-bottom: 24px; display: flex; align-items: center; gap: 8px; justify-content: center;
        }

        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            margin-top: 24px; color: var(--text-light); text-decoration: none;
            font-size: 0.85rem; font-weight: 600; transition: color 0.2s;
        }
        .back-link:hover { color: var(--primary); }
    </style>
</head>
<body>
    <div class="mesh-bg"></div>

    <div class="auth-container">
        <div class="auth-card">
            <div class="lock-icon">
                <i class="fa-solid fa-lock"></i>
            </div>
            
            <h1>Keamanan E-Voting</h1>
            <p>Masukkan kode keamanan yang diberikan oleh panitia untuk mengakses ruang bilik suara.</p>

            @if(session('error'))
                <div class="alert-error">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('voting.auth') }}" method="POST">
                @csrf
                <div class="input-group">
                    <i class="fa-solid fa-key"></i>
                    <input type="password" name="passcode" placeholder="KODE RAHASIA" required autocomplete="off" autofocus>
                </div>
                <button type="submit" class="btn-submit">Buka Akses Voting</button>
            </form>

            <a href="{{ url('/') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>

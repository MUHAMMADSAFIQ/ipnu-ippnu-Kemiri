<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PAC IPNU IPPNU Kemiri</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LOGO RESMI IPNUIPPNU by diqies 2.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary: #15803d;
            --primary-dark: #14532d;
            --accent: #fbc02d;
            --bg: #f8fafc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--bg); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            min-height: 100vh; 
            padding: 40px 20px;
        }

        .login-card {
            background: white;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .logo-box { text-align: center; margin-bottom: 25px; }
        .logo-box img { width: 70px; height: 70px; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.1)); }
        .logo-box h2 { font-family: 'Outfit', sans-serif; font-weight: 800; color: var(--primary); margin-top: 10px; font-size: 1.4rem; }
        .logo-box p { color: #64748b; font-size: 0.85rem; }

        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 0.75rem; font-weight: 800; color: #1e293b; margin-bottom: 6px; text-transform: uppercase; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
        .input-wrap input { width: 100%; padding: 10px 14px 10px 40px; border-radius: 10px; border: 2px solid #e2e8f0; outline: none; font-size: 0.9rem; transition: all 0.3s; background: #fcfdfe; }
        .input-wrap input:focus { border-color: var(--primary); background: white; box-shadow: 0 0 0 4px rgba(21, 128, 61, 0.1); }

        .btn-login { width: 100%; padding: 14px; background: var(--primary); color: white; border: none; border-radius: 12px; font-weight: 800; font-size: 1rem; cursor: pointer; transition: all 0.3s; margin-top: 10px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.3); }
        .btn-login:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(21, 128, 61, 0.4); }

        .footer-link { text-align: center; margin-top: 20px; font-size: 0.85rem; color: #64748b; }
        .footer-link a { color: var(--primary); text-decoration: none; font-weight: 700; }

        .bg-shapes { position: fixed; inset: 0; z-index: 1; overflow: hidden; pointer-events: none; }
        .shape { position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.3; }
        .shape-1 { width: 400px; height: 400px; background: var(--primary); top: -100px; right: -100px; }
        .shape-2 { width: 300px; height: 300px; background: var(--accent); bottom: -50px; left: -50px; }

        .alert { padding: 10px; border-radius: 8px; margin-bottom: 20px; font-size: 0.8rem; font-weight: 700; text-align: center; }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-danger { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    </style>
</head>
<body>
    <div class="bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
    </div>

    <div class="login-card">
        <div class="logo-box">
            <img src="{{ asset('images/logo_ipnu.png') }}" alt="Logo">
            <h2>LOGIN ADMIN</h2>
            <p>Akses Dashboard Pengelola</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="admin@example.com" required value="{{ old('email') }}">
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-login">MASUK SEKARANG</button>
        </form>

        <div class="footer-link">
            Belum punya akun? <a href="{{ route('admin.register') }}">Daftar di sini</a>
            <br><br>
            <a href="{{ url('/') }}" style="color: #94a3b8; font-weight: 500;"><i class="fa-solid fa-arrow-left"></i> Kembali ke Portal</a>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin - PAC IPNU IPPNU Kemiri</title>
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
            max-width: 600px; /* Increased to allow 2 columns */
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
            animation: slideUp 0.8s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo-box { text-align: center; margin-bottom: 25px; }
        .logo-box img { width: 70px; height: 70px; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.1)); }
        .logo-box h2 { font-family: 'Outfit', sans-serif; font-weight: 800; color: var(--primary); margin-top: 10px; font-size: 1.4rem; }
        .logo-box p { color: #64748b; font-size: 0.85rem; }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px 20px;
        }

        .form-group { margin-bottom: 0; }
        .form-group.full { grid-column: span 2; margin-top: 5px; }
        
        .form-group label { display: block; font-size: 0.75rem; font-weight: 800; color: #1e293b; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 0.9rem; }
        .input-wrap input { width: 100%; padding: 10px 14px 10px 40px; border-radius: 10px; border: 2px solid #e2e8f0; outline: none; font-size: 0.9rem; transition: all 0.3s; background: #fcfdfe; }
        .input-wrap input:focus { border-color: var(--primary); background: white; box-shadow: 0 0 0 4px rgba(21, 128, 61, 0.1); }
        .input-wrap input:focus + i { color: var(--primary); }

        .btn-register { width: 100%; padding: 14px; background: var(--primary); color: white; border: none; border-radius: 12px; font-weight: 800; font-size: 1rem; cursor: pointer; transition: all 0.3s; margin-top: 20px; box-shadow: 0 4px 15px rgba(21, 128, 61, 0.3); }
        .btn-register:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(21, 128, 61, 0.4); }

        .footer-link { text-align: center; margin-top: 20px; font-size: 0.85rem; color: #64748b; }
        .footer-link a { color: var(--primary); text-decoration: none; font-weight: 700; }

        .bg-shapes { position: fixed; inset: 0; z-index: 1; overflow: hidden; pointer-events: none; }
        .shape { position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.3; }
        .shape-1 { width: 400px; height: 400px; background: var(--primary); top: -100px; left: -100px; }
        .shape-2 { width: 300px; height: 300px; background: var(--accent); bottom: -50px; right: -50px; }

        .error-msg { color: #ef4444; font-size: 0.7rem; margin-top: 3px; font-weight: 600; }

        @media (max-width: 550px) {
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full { grid-column: span 1; }
            .login-card { padding: 30px 20px; }
        }
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
            <h2>BUAT AKUN ADMIN</h2>
            <p>Silakan lengkapi formulir pendaftaran</p>
        </div>

        <form action="{{ route('admin.register') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="name" placeholder="Masukkan nama" required value="{{ old('name') }}">
                    </div>
                    @error('name') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Email Admin</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" placeholder="admin@example.com" required value="{{ old('email') }}">
                    </div>
                    @error('email') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>
                    @error('password') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-shield-check"></i>
                        <input type="password" name="password_confirmation" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="form-group full">
                    <label>Kode Khusus Admin</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-key"></i>
                        <input type="text" name="secret_code" placeholder="Masukkan kode khusus" required>
                    </div>
                    @error('secret_code') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
            </div>

            <button type="submit" class="btn-register">DAFTAR SEKARANG</button>
        </form>

        <div class="footer-link">
            Sudah punya akun? <a href="{{ route('admin.login') }}">Masuk di sini</a>
        </div>
    </div>
</body>
</html>

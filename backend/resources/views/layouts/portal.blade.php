<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Resmi IPNU-IPPNU Kemiri')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #15803d;
            --primary-light: #22c55e;
            --primary-dark: #14532d;
            --accent: #facc15;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg-light: #f1f5f9;
            --bg-white: #ffffff;
            --border: #e2e8f0;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            background-color: var(--bg-light);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* --- LAYOUT STRUCTURE --- */
        .app-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-wrapper {
            display: grid;
            grid-template-columns: 1fr;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            gap: 20px;
            padding: 20px;
        }

        @media (min-width: 1024px) {
            .main-wrapper {
                grid-template-columns: 280px 1fr;
            }

            .with-right-sidebar {
                grid-template-columns: 280px 1fr 320px;
            }
        }

        /* --- NAVIGATION --- */
        .top-navbar {
            background: white;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid var(--border);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--primary-dark);
        }

        .brand img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .brand-text h1 {
            font-family: 'Outfit';
            font-weight: 800;
            font-size: 1.1rem;
            line-height: 1.1;
        }

        .brand-text p {
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nav-links {
            display: none;
        }

        @media (min-width: 1024px) {
            .nav-links {
                display: flex;
                gap: 24px;
            }

            .nav-link {
                text-decoration: none;
                color: var(--text-dark);
                font-weight: 700;
                font-size: 0.85rem;
                transition: var(--transition);
                text-transform: uppercase;
            }

            .nav-link:hover {
                color: var(--primary);
            }

            .nav-link.active {
                color: var(--primary);
            }
        }

        /* --- MOBILE DRAWER --- */
        .mobile-toggle {
            background: var(--bg-light);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-dark);
            font-size: 1.2rem;
        }

        @media (min-width: 1024px) {
            .mobile-toggle {
                display: none;
            }
        }

        .drawer-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 2000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .drawer {
            position: fixed;
            top: 0;
            left: -300px;
            width: 300px;
            height: 100vh;
            background: white;
            z-index: 2001;
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.1);
        }

        .drawer.open {
            left: 0;
        }

        .drawer-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }

        .drawer-header {
            padding: 24px;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .drawer-content {
            flex: 1;
            overflow-y: auto;
            padding: 20px 0;
        }

        .drawer-menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 24px;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 700;
            font-size: 0.95rem;
            border-left: 4px solid transparent;
            transition: var(--transition);
        }

        .drawer-menu-item:hover {
            background: var(--bg-light);
            color: var(--primary);
        }

        .drawer-menu-item.active {
            background: #f0fdf4;
            color: var(--primary);
            border-left-color: var(--primary);
        }

        /* --- BOTTOM NAV (MOBILE) --- */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 64px;
            background: white;
            border-top: 1px solid var(--border);
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            z-index: 1000;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.05);
        }

        @media (min-width: 768px) {
            .bottom-nav {
                display: none;
            }
        }

        .bnav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: var(--text-light);
            font-size: 0.65rem;
            font-weight: 700;
            gap: 4px;
            transition: var(--transition);
        }

        .bnav-item i {
            font-size: 1.2rem;
        }

        .bnav-item.active {
            color: var(--primary);
        }

        .bnav-item.center {
            margin-top: -30px;
        }

        .bnav-item.center div {
            width: 56px;
            height: 56px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(21, 128, 61, 0.4);
            font-size: 1.5rem;
            border: 4px solid white;
        }

        /* --- SIDEBARS --- */
        .sidebar {
            display: none;
        }

        @media (min-width: 1024px) {
            .sidebar {
                display: block;
                position: sticky;
                top: 84px;
                height: calc(100vh - 104px);
                overflow-y: auto;
                scrollbar-width: none;
            }

            .sidebar::-webkit-scrollbar {
                display: none;
            }
        }

        .sidebar-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        }

        /* --- UTILS --- */
        .btn-premium {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 800;
            font-size: 0.85rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-premium:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(21, 128, 61, 0.2);
        }

        @stack('styles')
    </style>
</head>

<body>
    <div class="app-container">
        <!-- TOP NAVBAR -->
        <nav class="top-navbar">
            <a href="{{ url('/') }}" class="brand">
                <img src="{{ asset('images/logo_ipnu.png') }}" alt="Logo IPNU">
                <div class="brand-text">
                    <h1>IPNU-IPPNU KEMIRI</h1>
                    <p>Pesta Demokrasi Pelajar</p>
                </div>
            </a>

            <div class="nav-links">
                <a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Beranda</a>
                <a href="{{ url('/profil/sejarah') }}"
                    class="nav-link {{ Request::is('profil/*') ? 'active' : '' }}">Profil</a>
                <a href="{{ url('/struktur/bph') }}"
                    class="nav-link {{ Request::is('struktur/*') ? 'active' : '' }}">Struktur</a>
                <a href="{{ route('voting') }}" class="nav-link">E-Voting</a>
                <a href="{{ url('/kontak') }}" class="nav-link">Kontak</a>
            </div>

            <div style="display: flex; gap: 10px; align-items: center;">
                <a href="{{ route('admin.login') }}" class="btn-premium">
                    <i class="fa-solid fa-user-shield"></i>
                    <span class="hidden sm:inline">ADMIN</span>
                </a>
                <button class="mobile-toggle" id="openDrawer">
                    <i class="fa-solid fa-bars-staggered"></i>
                </button>
            </div>
        </nav>

        <!-- MAIN WRAPPER -->
        <div class="main-wrapper @yield('wrapper_class')">
            @section('sidebar_left')
            <aside class="sidebar">
                <div class="sidebar-card">
                    <h3
                        style="font-family: 'Outfit'; font-weight: 800; color: var(--primary-dark); margin-bottom: 15px;">
                        Navigasi</h3>
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <a href="{{ url('/profil/sejarah') }}" class="drawer-menu-item">📜 Sejarah</a>
                        <a href="{{ url('/profil/visi-misi-pac') }}" class="drawer-menu-item">🎯 Visi & Misi</a>
                        <a href="{{ url('/struktur/bph') }}" class="drawer-menu-item">👥 Pengurus</a>
                        <a href="{{ url('/info/statistik') }}" class="drawer-menu-item">📊 Statistik</a>
                        <a href="{{ url('/info/usaha') }}" class="drawer-menu-item">🛍️ Lapak Pelajar</a>
                    </div>
                </div>
                @stack('sidebar_left_extra')
            </aside>
            @show

            <main class="content-area">
                @yield('content')
            </main>

            @yield('sidebar_right')
        </div>

        <!-- FOOTER -->
        <footer
            style="background: #0f172a; color: white; padding: 60px 20px 100px; text-align: center; margin-top: auto;">
            <img src="{{ asset('images/logo_ipnu.png') }}" style="width: 60px; margin-bottom: 20px;">
            <h2 style="font-family: 'Outfit'; font-weight: 900; margin-bottom: 10px;">PAC IPNU IPPNU KEMIRI</h2>
            <p style="color: #94a3b8; font-size: 0.9rem; max-width: 600px; margin: 0 auto 30px;">Berjuang, Belajar, dan
                Bertaqwa untuk masa depan pelajar Nahdlatul Ulama yang lebih cerah.</p>
            <div style="display: flex; justify-content: center; gap: 15px; font-size: 1.5rem;">
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-youtube"></i>
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <p style="margin-top: 40px; color: #475569; font-size: 0.8rem;">&copy; {{ date('Y') }} PAC IPNU IPPNU
                Kemiri. All Rights Reserved.</p>
        </footer>
    </div>

    <!-- MOBILE DRAWER -->
    <div class="drawer-overlay" id="drawerOverlay"></div>
    <div class="drawer" id="mobileDrawer">
        <div class="drawer-header">
            <div class="brand" style="color: white;">
                <img src="{{ asset('images/logo_ipnu.png') }}" style="filter: brightness(0) invert(1);">
                <div class="brand-text">
                    <h1>IPNU KEMIRI</h1>
                    <p style="color: rgba(255,255,255,0.7);">Portal Resmi</p>
                </div>
            </div>
            <button id="closeDrawer"
                style="background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer;">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="drawer-content">
            <a href="{{ url('/') }}" class="drawer-menu-item {{ Request::is('/') ? 'active' : '' }}"><i
                    class="fa-solid fa-house"></i> Beranda</a>
            <a href="{{ url('/profil/sejarah') }}" class="drawer-menu-item"><i class="fa-solid fa-book"></i> Sejarah</a>
            <a href="{{ url('/profil/visi-misi-pac') }}" class="drawer-menu-item"><i class="fa-solid fa-bullseye"></i>
                Visi & Misi</a>
            <a href="{{ url('/struktur/bph') }}" class="drawer-menu-item"><i class="fa-solid fa-users"></i> Struktur
                Organisasi</a>
            <a href="{{ url('/info/statistik') }}" class="drawer-menu-item"><i class="fa-solid fa-chart-pie"></i>
                Statistik Anggota</a>
            <a href="{{ url('/info/usaha') }}" class="drawer-menu-item"><i class="fa-solid fa-shop"></i> Lapak
                Pelajar</a>
            <a href="{{ route('voting') }}" class="drawer-menu-item"><i class="fa-solid fa-check-to-slot"></i>
                E-Voting</a>
            <a href="{{ url('/kontak') }}" class="drawer-menu-item"><i class="fa-solid fa-message"></i> Kritik &
                Saran</a>
        </div>
    </div>

    <!-- BOTTOM NAV -->
    <div class="bottom-nav">
        <a href="{{ url('/') }}" class="bnav-item {{ Request::is('/') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            <span>Beranda</span>
        </a>
        <a href="{{ url('/info/statistik') }}" class="bnav-item">
            <i class="fa-solid fa-chart-line"></i>
            <span>Statistik</span>
        </a>
        <a href="{{ route('voting') }}" class="bnav-item center">
            <div><i class="fa-solid fa-check-to-slot"></i></div>
            <span>VOTE</span>
        </a>
        <a href="{{ url('/kontak') }}" class="bnav-item">
            <i class="fa-solid fa-phone"></i>
            <span>Kontak</span>
        </a>
    </div>

    <script>
        const openBtn = document.getElementById('openDrawer');
        const closeBtn = document.getElementById('closeDrawer');
        const drawer = document.getElementById('mobileDrawer');
        const overlay = document.getElementById('drawerOverlay');

        function toggleDrawer() {
            drawer.classList.toggle('open');
            overlay.classList.toggle('open');
            document.body.style.overflow = drawer.classList.contains('open') ? 'hidden' : '';
        }

        if (openBtn) openBtn.addEventListener('click', toggleDrawer);
        if (closeBtn) closeBtn.addEventListener('click', toggleDrawer);
        if (overlay) overlay.addEventListener('click', toggleDrawer);
    </script>
    @stack('scripts')
</body>

</html>
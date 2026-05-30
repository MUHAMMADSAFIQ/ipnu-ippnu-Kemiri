<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — PAC IPNU IPPNU Kemiri</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=2">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}" />

    <style>
        /* ═══════════════════════════════════════════
           DESIGN TOKENS — identik dengan welcome.blade.php
        ═══════════════════════════════════════════ */
        :root {
            --primary: #15803d;
            --primary-light: #22c55e;
            --primary-dark: #14532d;
            --accent: #facc15;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg-light: #f8fafc;
            --bg-white: #ffffff;
            --border: #e2e8f0;
            --radius-md: 0.5rem;
            --radius-lg: 1rem;
            --shadow-sm: 0 1px 2px 0 rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 30px rgba(0,0,0,0.08);
            --transition: all 0.3s ease;
            --sidebar-w: 260px;
        }

        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior:smooth; }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            background-color: var(--bg-light);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1,h2,h3,h4,h5,h6 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            line-height: 1.2;
        }

        a { text-decoration:none; color:inherit; }

        /* ═══════════════════════════════════════════
           TOP UTILITY BAR — sama persis welcome.blade
        ═══════════════════════════════════════════ */
        .top-utility-bar {
            background: linear-gradient(90deg, var(--primary-dark) 0%, var(--primary) 50%, var(--primary-dark) 100%);
            color: white;
            position: sticky;
            top: 0;
            z-index: 200;
            box-shadow: 0 2px 4px rgba(0,0,0,0.15);
        }

        .tub-container {
            width: 100%;
            padding: 7px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .tub-left {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .tub-logo-box {
            width: 28px; height: 28px;
            background: white;
            border-radius: 6px;
            padding: 3px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .tub-logo-box img { width:100%; height:100%; object-fit:contain; }

        .tub-live-dot {
            display: inline-block;
            width: 7px; height: 7px;
            background: var(--accent);
            border-radius: 50%;
            animation: blink 1.5s ease-in-out infinite;
        }
        @keyframes blink { 0%,100%{opacity:1;} 50%{opacity:0.3;} }

        .tub-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tub-btn {
            background: var(--accent);
            color: #000;
            padding: 4px 14px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 0.8rem;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            display: flex; align-items: center; gap: 6px;
        }
        .tub-btn:hover { background:#fff; transform:translateY(-1px); }

        .tub-icon {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 4px;
            color: white;
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.9rem;
        }
        .tub-icon:hover { background:rgba(255,255,255,0.25); border-color:rgba(255,255,255,0.5); }

        /* ═══════════════════════════════════════════
           SHELL LAYOUT
           Desktop: sidebar permanent + main
           Mobile:  sidebar overlay via hamburger
        ═══════════════════════════════════════════ */
        .shell {
            display: flex;
            min-height: calc(100vh - 42px); /* minus utility bar */
        }

        /* ═══════════════════════════════════════════
           SIDEBAR — permanent on ≥ 900px
        ═══════════════════════════════════════════ */
        .sidebar {
            width: var(--sidebar-w);
            flex-shrink: 0;
            background: linear-gradient(180deg, var(--primary-dark) 0%, #155d38 60%, var(--primary) 100%);
            color: white;
            display: flex;
            flex-direction: column;
            /* On desktop: always visible, no fixed positioning */
            position: sticky;
            top: 42px; /* height of utility bar */
            height: calc(100vh - 42px);
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.15) transparent;
            transition: transform 0.35s cubic-bezier(0.4,0,0.2,1);
            z-index: 150;
        }
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }

        /* On mobile: hidden off-screen, shown via .open */
        @media (max-width: 900px) {
            .sidebar {
                position: fixed;
                top: 0; bottom: 0; left: 0;
                height: 100vh;
                transform: translateX(-100%);
                z-index: 500;
                border-radius: 0;
            }
            .sidebar.open {
                transform: translateX(0);
                box-shadow: 8px 0 40px rgba(0,0,0,0.2);
            }
        }

        .sidebar-header {
            padding: 18px 16px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-logo-box {
            width: 42px; height: 42px;
            background: white;
            border-radius: 10px;
            padding: 5px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .sidebar-logo-box img { width:100%; height:100%; object-fit:contain; }

        .sidebar-brand-name {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 0.92rem;
            color: white;
            line-height: 1.2;
        }
        .sidebar-brand-sub {
            font-size: 0.62rem;
            color: rgba(255,255,255,0.5);
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-top: 2px;
        }

        /* Sidebar Nav */
        .sidebar-nav { padding: 10px 10px; flex: 1; }

        .nav-group-label {
            padding: 12px 8px 5px;
            font-size: 0.6rem;
            font-weight: 700;
            color: rgba(255,255,255,0.35);
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: var(--radius-md);
            color: rgba(255,255,255,0.65);
            font-weight: 500;
            font-size: 0.84rem;
            transition: var(--transition);
            cursor: pointer;
            margin-bottom: 1px;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            position: relative;
        }
        .nav-item i { width: 17px; text-align: center; font-size: 0.85rem; flex-shrink: 0; }
        .nav-item:hover { background: rgba(255,255,255,0.1); color: white; transform: translateX(2px); }
        .nav-item.active {
            background: rgba(250,204,21,0.15);
            color: var(--accent);
            border: 1px solid rgba(250,204,21,0.2);
        }
        .nav-item.active i { color: var(--accent); }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%);
            width: 3px; height: 60%;
            background: var(--accent);
            border-radius: 0 2px 2px 0;
        }

        .nav-badge {
            margin-left: auto;
            background: #ef4444;
            color: white;
            font-size: 0.6rem;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 50px;
            min-width: 18px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 12px 10px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 10px;
            background: rgba(239,68,68,0.12);
            color: rgba(252,165,165,0.9);
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.84rem;
            cursor: pointer;
            transition: var(--transition);
        }
        .logout-btn:hover { background: #ef4444; color: white; border-color: #ef4444; }

        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(3px);
            z-index: 499;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .sidebar-overlay.active { display: block; opacity: 1; }

        /* ═══════════════════════════════════════════
           MAIN AREA
        ═══════════════════════════════════════════ */
        .main-area {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        /* Sub-navbar (page title + hamburger) — like welcome.blade navbar */
        .sub-nav {
            background: rgba(255,255,255,0.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            position: sticky;
            top: 42px;
            z-index: 100;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 58px;
            box-shadow: var(--shadow-sm);
        }

        .sub-nav-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Hamburger — ONLY on mobile/portrait */
        .hamburger-btn {
            display: none; /* hidden on desktop */
            background: none;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            color: var(--text-dark);
            width: 36px; height: 36px;
            align-items: center; justify-content: center;
            cursor: pointer;
            font-size: 0.95rem;
            transition: var(--transition);
        }
        .hamburger-btn:hover { border-color: var(--primary); color: var(--primary); background: #f0fdf4; }

        @media (max-width: 900px) {
            .hamburger-btn { display: flex; }
        }

        .sub-nav-page-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--primary-dark);
        }
        .sub-nav-breadcrumb {
            font-size: 0.72rem;
            color: var(--text-light);
            margin-top: 1px;
        }

        .sub-nav-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .votes-pill {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--primary-dark);
        }
        .votes-pill i { color: var(--primary); }

        .reset-btn-top {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #fef2f2;
            color: #ef4444;
            border: 1px solid #fecaca;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
        }
        .reset-btn-top:hover { background: #ef4444; color: white; border-color: #ef4444; }

        /* ═══════════════════════════════════════════
           CONTENT AREA
        ═══════════════════════════════════════════ */
        .content-area {
            padding: 28px 28px;
            flex: 1;
        }

        @media (max-width: 768px) { .content-area { padding: 16px; } }

        /* Sections */
        .admin-section { display: none; animation: fadeInSection 0.25s ease; }
        .admin-section.active { display: block; }
        @keyframes fadeInSection { from{opacity:0;transform:translateY(8px);} to{opacity:1;transform:translateY(0);} }

        /* ═══════════════════════════════════════════
           ALERTS
        ═══════════════════════════════════════════ */
        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-lg);
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 0.88rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            border-left: 4px solid transparent;
        }
        .alert-success { background: #f0fdf4; color: #166534; border-left-color: var(--primary); }
        .alert-error   { background: #fef2f2; color: #991b1b; border-left-color: #ef4444; }
        .alert-warning { background: #fff7ed; color: #9a3412; border-left-color: #f97316; }
        .alert ul { margin: 6px 0 0 16px; }

        /* ═══════════════════════════════════════════
           CARD — identik card style welcome.blade
        ═══════════════════════════════════════════ */
        .card {
            background: var(--bg-white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }
        .card + .card { margin-top: 20px; }

        .card-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        .card-header-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .card-header-title i { color: var(--primary); }
        .card-body { padding: 22px; }

        /* Section title decoration — like .section-title::after */
        .section-title-styled {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary-dark);
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }
        .section-title-styled::after {
            content: '';
            position: absolute;
            bottom: -6px; left: 0;
            width: 40px; height: 3px;
            background: var(--accent);
            border-radius: 2px;
        }

        /* ═══════════════════════════════════════════
           STAT CARDS — voting dashboard top row
        ═══════════════════════════════════════════ */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        @media (max-width: 1200px) { .stat-grid { grid-template-columns: repeat(2,1fr); } }
        @media (max-width: 600px)  { .stat-grid { grid-template-columns: 1fr 1fr; gap:12px; } }
        @media (max-width: 420px)  { .stat-grid { grid-template-columns: 1fr; } } /* 1 column on very small portrait */

        .stat-card {
            background: var(--bg-white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            padding: 20px 18px;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }
        .stat-card::after {
            content: '';
            position: absolute;
            top: -24px; right: -24px;
            width: 70px; height: 70px;
            border-radius: 50%;
            opacity: 0.06;
        }
        .stat-card-green::after  { background: var(--primary); }
        .stat-card-amber::after  { background: #d97706; }
        .stat-card-indigo::after { background: #4f46e5; }
        .stat-card-rose::after   { background: #e11d48; }

        .stat-label { font-size: 0.68rem; font-weight: 700; color: var(--text-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
        .stat-value { font-family: 'Outfit', sans-serif; font-size: 2.4rem; font-weight: 800; line-height: 1; color: var(--primary-dark); }
        .stat-sub   { font-size: 0.72rem; color: var(--text-light); margin-top: 6px; }

        /* ═══════════════════════════════════════════
           PODIUM CHART LAYOUT
        ═══════════════════════════════════════════ */
        .podium-layout {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 20px;
            margin-bottom: 24px;
        }
        @media (max-width: 1100px) { .podium-layout { grid-template-columns: 1fr; } }

        .podium-wrap {
            background: var(--bg-white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            padding: 28px;
            text-align: center;
            overflow-x: auto; /* Prevent overflow on small screens */
        }

        .podium-grid {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            gap: 18px;
            min-height: 260px;
            padding-bottom: 16px;
            min-width: min-content; /* Ensure items don't squish too much */
        }

        .podium-item { display: flex; flex-direction: column; align-items: center; width: 140px; flex-shrink: 0; }

        @media (max-width: 640px) {
            .podium-item { width: 100px; }
            .podium-avatar { width: 60px; height: 60px; font-size: 1.5rem; }
            .podium-bar-votes { font-size: 0.9rem; }
        }

        .podium-avatar {
            width: 78px; height: 78px;
            background: var(--bg-light);
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: var(--shadow-md);
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem;
            margin-bottom: 10px;
            position: relative;
            overflow: hidden;
        }
        .podium-avatar img { width:100%; height:100%; object-fit:cover; border-radius:50%; }

        .podium-rank-badge {
            position: absolute;
            bottom: -2px; right: -2px;
            width: 24px; height: 24px;
            background: var(--accent);
            border-radius: 50%;
            border: 2px solid white;
            font-size: 0.62rem;
            font-weight: 800;
            color: #111;
            display: flex; align-items: center; justify-content: center;
        }

        .podium-bar {
            width: 100%;
            border-radius: 8px 8px 0 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px;
            padding: 10px 4px;
            color: white;
            font-weight: 700;
            transition: height 1s cubic-bezier(0.175,0.885,0.32,1.275);
        }
        .podium-bar-votes { font-size: 1.1rem; font-weight: 800; }
        .podium-bar-pct   { font-size: 0.58rem; opacity: 0.85; }
        .podium-name {
            margin-top: 8px;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-dark);
            text-align: center;
            line-height: 1.3;
        }

        /* Distribution panel */
        .dist-panel {
            background: var(--bg-white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            padding: 22px;
        }
        .dist-bar-label { display:flex; justify-content:space-between; align-items:center; margin-bottom:5px; }
        .dist-bar-track { background: var(--bg-light); border-radius: 50px; height: 7px; overflow: hidden; margin-bottom:14px; }
        .dist-bar-fill  { height:100%; border-radius:50px; transition: width 1s ease; }

        /* ═══════════════════════════════════════════
           FORMS — same style as welcome
        ═══════════════════════════════════════════ */
        .form-grid { display: grid; grid-template-columns: repeat(2,1fr); gap: 14px; }
        .form-grid .full { grid-column: 1 / -1; }
        @media (max-width:640px) { .form-grid { grid-template-columns: 1fr; } }

        .form-group { display: flex; flex-direction: column; gap: 5px; }
        .form-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="email"],
        input[type="file"],
        input[type="url"],
        textarea,
        select {
            padding: 10px 13px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            width: 100%;
            background: var(--bg-white);
            color: var(--text-dark);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        input:focus, textarea:focus, select:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(21,128,61,0.1);
        }
        textarea { resize: vertical; }

        /* ═══════════════════════════════════════════
           BUTTONS — same as welcome.blade .btn
        ═══════════════════════════════════════════ */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 10px 22px;
            font-weight: 600;
            font-size: 0.88rem;
            border-radius: 50px;
            transition: var(--transition);
            cursor: pointer;
            border: none;
            font-family: 'Inter', sans-serif;
        }
        .btn-primary { background: var(--primary); color: white; box-shadow: 0 4px 14px rgba(21,128,61,0.25); }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(21,128,61,0.35); }
        .btn-outline { background: transparent; color: var(--primary); border: 2px solid var(--primary); }
        .btn-outline:hover { background: var(--primary); color: white; }
        .btn-accent { background: var(--accent); color: #111; }
        .btn-accent:hover { background: #e9b800; transform: translateY(-1px); }
        .btn-danger { background: #fef2f2; color: #ef4444; border: 1px solid #fecaca; }
        .btn-danger:hover { background: #ef4444; color: white; }
        .btn-blue { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
        .btn-blue:hover { background: #2563eb; color: white; }
        .btn-sm { padding: 6px 14px; font-size: 0.78rem; border-radius: 50px; }
        .btn-icon { width: 32px; height: 32px; padding: 0; border-radius: 50px; display:inline-flex; align-items:center; justify-content:center; }

        /* Full-width submit */
        .btn-submit {
            width: 100%;
            padding: 12px;
            font-size: 0.95rem;
            font-weight: 700;
            border-radius: 50px;
            margin-top: 16px;
        }

        /* ═══════════════════════════════════════════
           BADGES
        ═══════════════════════════════════════════ */
        .badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 50px; font-size: 0.67rem; font-weight: 700; }
        .badge-green  { background: #dcfce7; color: #15803d; }
        .badge-red    { background: #fee2e2; color: #ef4444; }
        .badge-amber  { background: #fef3c7; color: #92400e; }
        .badge-blue   { background: #eff6ff; color: #1d4ed8; }
        .badge-gray   { background: var(--bg-light); color: #475569; }

        /* ═══════════════════════════════════════════
           TABLE
        ═══════════════════════════════════════════ */
        .table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        table { width: 100%; border-collapse: collapse; min-width: 480px; }
        thead th {
            background: var(--bg-light);
            text-align: left;
            padding: 11px 16px;
            font-size: 0.67rem;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.7px;
            border-bottom: 1px solid var(--border);
        }
        tbody td { padding: 12px 16px; border-bottom: 1px solid #f1f5f9; font-size: 0.875rem; vertical-align: middle; }
        tbody tr:hover td { background: #f8fafc; }
        tbody tr:last-child td { border-bottom: none; }

        /* ═══════════════════════════════════════════
           GALLERY GRID
        ═══════════════════════════════════════════ */
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill,minmax(170px,1fr)); gap: 12px; }
        .gal-item { border-radius: var(--radius-lg); overflow: hidden; background: var(--bg-light); aspect-ratio: 1; position: relative; }
        .gal-item img { width:100%; height:100%; object-fit:cover; display:block; transition:transform 0.3s; }
        .gal-item:hover img { transform: scale(1.06); }
        .gal-item-overlay { position:absolute; inset:0; background:rgba(0,0,0,0); transition:background 0.3s; display:flex; align-items:center; justify-content:center; gap:8px; opacity:0; }
        .gal-item:hover .gal-item-overlay { background:rgba(0,0,0,0.48); opacity:1; }
        .gal-cat-badge { position:absolute; top:7px; left:7px; background:rgba(15,23,42,0.72); color:white; font-size:0.6rem; font-weight:700; padding:2px 8px; border-radius:50px; text-transform:uppercase; backdrop-filter:blur(4px); }

        /* Category filter tabs — like the pill nav in welcome */
        .cat-tabs { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:18px; }
        .cat-tab { padding:5px 16px; border-radius:50px; border:1px solid var(--border); background:white; font-size:0.78rem; font-weight:600; color:var(--text-light); cursor:pointer; transition:var(--transition); }
        .cat-tab:hover { border-color:var(--primary); color:var(--primary); }
        .cat-tab.active { background:var(--primary); color:white; border-color:var(--primary); }

        /* ═══════════════════════════════════════════
           FEEDBACK CARDS
        ═══════════════════════════════════════════ */
        .feedback-card { background:var(--bg-white); border-radius:var(--radius-lg); padding:16px 18px; border:1px solid var(--border); margin-bottom:10px; box-shadow:var(--shadow-sm); transition:var(--transition); }
        .feedback-card:hover { border-color:var(--primary); box-shadow:var(--shadow-md); }
        .feedback-card.unread { border-left: 3px solid var(--accent); background:#fffef0; }
        .fb-meta { display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:8px; margin-bottom:6px; }
        .fb-sender { font-weight:700; font-size:0.9rem; }
        .fb-time   { font-size:0.7rem; color:var(--text-light); }
        .fb-subject { font-size:0.74rem; font-weight:700; color:var(--primary); background:#f0fdf4; padding:2px 10px; border-radius:50px; display:inline-block; margin-bottom:6px; }
        .fb-msg    { font-size:0.85rem; color:var(--text-light); line-height:1.6; }

        /* ═══════════════════════════════════════════
           MODAL
        ═══════════════════════════════════════════ */
        .modal-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.55);
            backdrop-filter: blur(5px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 16px;
            overflow-y: auto;
        }
        .modal-overlay.open { display: flex; }

        .modal-box {
            background: var(--bg-white);
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 600px;
            box-shadow: 0 25px 70px rgba(0,0,0,0.18);
            animation: modalPop 0.3s cubic-bezier(0.34,1.56,0.64,1);
            margin: auto;
            max-height: 95vh;
            display: flex;
            flex-direction: column;
        }
        .modal-box-lg { max-width: 780px; }

        @keyframes modalPop { from{opacity:0;transform:scale(0.92) translateY(16px);} to{opacity:1;transform:scale(1) translateY(0);} }

        .modal-header {
            padding: 22px 24px;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }
        .mh-green  { background: linear-gradient(135deg, var(--primary-dark), var(--primary)); }
        .mh-blue   { background: linear-gradient(135deg, #1d4ed8, #3b82f6); }
        .mh-amber  { background: linear-gradient(135deg, #b45309, #d97706); }

        .modal-title { font-family:'Outfit',sans-serif; font-weight:800; color:white; font-size:1.2rem; }
        .modal-subtitle { color:rgba(255,255,255,0.65); font-size:0.68rem; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; margin-bottom:3px; }
        .modal-close { background:rgba(255,255,255,0.15); border:none; width:34px; height:34px; border-radius:50%; color:white; font-size:1rem; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:var(--transition); }
        .modal-close:hover { background:rgba(255,255,255,0.3); }
        .modal-body { padding: 24px; overflow-y: auto; flex: 1; }
        .modal-footer { padding: 16px 24px 22px; display:flex; gap:10px; flex-shrink: 0; border-top: 1px solid var(--border); }

        /* ═══════════════════════════════════════════
           EMPTY STATE
        ═══════════════════════════════════════════ */
        .empty-state { text-align:center; padding:40px 20px; color:var(--text-light); }
        .empty-state i { font-size:2.4rem; display:block; margin-bottom:10px; opacity:0.25; }
        .empty-state p { font-weight:600; font-size:0.88rem; margin-bottom:3px; color:var(--text-dark); }
        .empty-state span { font-size:0.78rem; }

        /* ═══════════════════════════════════════════
           COUNTDOWN REFRESH BOX
        ═══════════════════════════════════════════ */
        .refresh-box { text-align:center; padding-top:16px; border-top:1px solid var(--border); margin-top:16px; }
        .refresh-num { font-family:'Outfit'; font-size:2rem; font-weight:800; color:var(--primary); line-height:1; }

        /* ═══════════════════════════════════════════
           PHOTO UPLOAD ZONE
        ═══════════════════════════════════════════ */
        .photo-zone {
            width:100%; min-height:130px;
            border: 2px dashed var(--border);
            border-radius: var(--radius-lg);
            display:flex; flex-direction:column; align-items:center; justify-content:center; gap:6px;
            cursor:pointer; transition:var(--transition); overflow:hidden; background:var(--bg-light);
        }
        .photo-zone:hover { border-color:var(--primary); background:#f0fdf4; }
        .photo-zone.has-photo { border-style:solid; border-color:var(--primary); }
    </style>
</head>
<body>

<!-- SIDEBAR OVERLAY (mobile only) -->
<div id="sidebar-overlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

<!-- ═══════════════════════════════════════════
     TOP UTILITY BAR — identik welcome.blade
═══════════════════════════════════════════ -->
<div class="top-utility-bar">
    <div class="tub-container">
        <div class="tub-left">
            <div class="tub-logo-box">
                <img src="{{ asset('images/logo_ipnu.png') }}" alt="Logo">
            </div>
            <span class="tub-live-dot"></span>
            <span>PAC IPNU IPPNU Kemiri &mdash; Admin Panel</span>
        </div>
        <div class="tub-right">
            <a href="{{ url('/') }}" class="tub-icon" title="Lihat Website">
                <i class="fa-solid fa-globe"></i>
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="tub-btn"><i class="fa-solid fa-right-from-bracket"></i> Keluar</button>
            </form>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════
     SHELL (sidebar + main)
═══════════════════════════════════════════ -->
<div class="shell">

    <!-- ─────────── SIDEBAR ─────────── -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo-box" style="background: transparent;">
                <img src="{{ asset('images/LOGO RESMI IPNUIPPNU by diqies 2.png') }}" alt="Logo IPNU IPPNU">
            </div>
            <div>
                <div class="sidebar-brand-name">PAC IPNU IPPNU</div>
                <div class="sidebar-brand-sub">Kemiri &bull; Admin Panel</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <!-- Voting -->
            <div class="nav-group-label">Pemilihan Ketua</div>
            <button onclick="switchSection('voting')"    id="nav-voting"     class="nav-item active"><i class="fa-solid fa-chart-line"></i> Dashboard Voting</button>
            <button onclick="switchSection('candidates')" id="nav-candidates" class="nav-item"><i class="fa-solid fa-users"></i> Kelola Kandidat</button>

            <!-- Profil -->
            <div class="nav-group-label">Profil & Pengurus</div>
            <button onclick="switchSection('history')"  id="nav-history"  class="nav-item"><i class="fa-solid fa-scroll"></i> Profil Organisasi</button>
            <button onclick="switchSection('officials')" id="nav-officials" class="nav-item"><i class="fa-solid fa-anchor"></i> Nahkoda Pimpinan</button>
            <button onclick="switchSection('structures')" id="nav-structures" class="nav-item"><i class="fa-solid fa-sitemap"></i> Struktur Kepengurusan</button>

            <!-- Konten -->
            <div class="nav-group-label">Konten Publik</div>
            <button onclick="switchSection('news')" id="nav-news" class="nav-item">
                <i class="fa-solid fa-newspaper"></i> Berita &amp; Artikel
                @if($pendingArticles->count() > 0)
                    <span class="nav-badge" style="background:var(--accent); color:var(--text-dark);">{{ $pendingArticles->count() }}</span>
                @endif
            </button>
            <button onclick="switchSection('stats')"   id="nav-stats"   class="nav-item"><i class="fa-solid fa-chart-simple"></i> Statistik Anggota</button>
            <button onclick="switchSection('agendas')" id="nav-agendas" class="nav-item"><i class="fa-solid fa-calendar-check"></i> Agenda Kegiatan</button>
            <button onclick="switchSection('programs')" id="nav-programs" class="nav-item"><i class="fa-solid fa-handshake"></i> Sinergi Program</button>
            <button onclick="switchSection('gallery')" id="nav-gallery" class="nav-item"><i class="fa-solid fa-images"></i> Galeri Dokumentasi</button>

            <!-- Layanan -->
            <div class="nav-group-label">Layanan Pelajar</div>
            <button onclick="switchSection('lapak')"    id="nav-lapak"    class="nav-item"><i class="fa-solid fa-store"></i> Lapak Usaha</button>
            <button onclick="switchSection('feedback')" id="nav-feedback" class="nav-item">
                <i class="fa-solid fa-inbox"></i> Ruang Lapor
                @if(isset($unreadFeedbacks) && $unreadFeedbacks > 0)
                    <span class="nav-badge">{{ $unreadFeedbacks }}</span>
                @endif
            </button>
            <button onclick="switchSection('chat')" id="nav-chat" class="nav-item"><i class="fa-solid fa-message"></i> AI Chatbot</button>

            <!-- Pendaftar -->
            <div class="nav-group-label">Pendaftaran</div>
            <button onclick="switchSection('registrations')" id="nav-registrations" class="nav-item">
                <i class="fa-solid fa-user-plus"></i> Pendaftar Baru
                @if($registrations->count() > 0)
                    <span class="nav-badge" style="background:#10b981;color:white;">{{ $registrations->count() }}</span>
                @endif
            </button>

            <!-- Settings -->
            <div class="nav-group-label">Pengaturan</div>
            <button onclick="switchSection('settings')" id="nav-settings" class="nav-item"><i class="fa-solid fa-gear"></i> Pengaturan Portal</button>
            <button onclick="switchSection('ads')" id="nav-ads" class="nav-item"><i class="fa-solid fa-bullhorn"></i> Manajemen Iklan</button>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
            </form>
        </div>
    </aside>

    <!-- ─────────── MAIN AREA ─────────── -->
    <div class="main-area">

        <!-- Sub-nav / page bar -->
        <nav class="sub-nav">
            <div class="sub-nav-left">
                <!-- Hamburger — only visible on mobile -->
                <button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div>
                    <div class="sub-nav-page-title" id="page-title-text">Dashboard Voting</div>
                    <div class="sub-nav-breadcrumb">Admin &rsaquo; <span id="page-breadcrumb">Pemilihan</span></div>
                </div>
            </div>
            <div class="sub-nav-right">
                <div class="votes-pill">
                    <i class="fa-solid fa-ballot-check"></i>
                    Total: <strong id="total-votes-nav">{{ $totalVotes }}</strong>
                </div>
                <form action="{{ route('admin.candidates.reset-all') }}" method="POST" onsubmit="return confirm('Reset semua suara ke nol?')">
                    @csrf
                    <button type="submit" class="reset-btn-top"><i class="fa-solid fa-rotate"></i> <span class="hide-sm">Reset Suara</span></button>
                </form>
            </div>
        </nav>

        <!-- Content -->
        <div class="content-area">

            <!-- Alerts -->
            @if(session('success'))
            <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-error"><i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}</div>
            @endif
            @if($errors->any())
            <div class="alert alert-warning">
                <div><i class="fa-solid fa-triangle-exclamation"></i> Periksa isian form:
                    <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            </div>
            @endif

            {{-- ══════════════════════════════════════════════
                 SECTION: VOTING DASHBOARD
            ══════════════════════════════════════════════ --}}
            <div id="section-voting" class="admin-section active">
                <h2 class="section-title-styled" style="margin-bottom:20px;">Dashboard Voting</h2>

                <!-- Stat row -->
                <div class="stat-grid">
                    <div class="stat-card stat-card-green">
                        <div class="stat-label">Total Suara</div>
                        <div class="stat-value" id="sv-total">{{ $totalVotes }}</div>
                        <div class="stat-sub">dari seluruh kandidat</div>
                    </div>
                    <div class="stat-card stat-card-amber">
                        <div class="stat-label">Kandidat Aktif</div>
                        <div class="stat-value">{{ $candidates->where('is_active',true)->count() }}</div>
                        <div class="stat-sub">dari {{ $candidates->count() }} kandidat</div>
                    </div>
                    <div class="stat-card stat-card-indigo">
                        <div class="stat-label">Kandidat Terdepan</div>
                        <div class="stat-value" style="font-size:1rem;margin-top:6px;color:#4f46e5;">{{ $candidates->sortByDesc('votes_count')->first()?->name ?? '—' }}</div>
                        <div class="stat-sub">perolehan tertinggi</div>
                    </div>
                    <div class="stat-card stat-card-rose">
                        <div class="stat-label">Status Pemilihan</div>
                        <div style="margin-top:10px;"><span class="badge badge-green" style="font-size:0.72rem;">● SEDANG BERJALAN</span></div>
                        <div class="stat-sub" style="margin-top:8px;">update tiap 5 detik</div>
                    </div>
                </div>

                <!-- Podium + Distribution -->
                <div class="podium-layout">
                    <!-- Podium chart -->
                    <div class="podium-wrap">
                        <h3 style="margin-bottom:28px;font-size:0.95rem;font-weight:700;color:var(--text-light);text-transform:uppercase;letter-spacing:1px;">🏆 Papan Perolehan Suara</h3>
                        <div class="podium-grid" id="podium-grid">
                            @php $colors=['#15803d','#1d4ed8','#9f1239','#d97706','#7c3aed','#0891b2']; @endphp
                            @foreach($candidates as $idx => $cand)
                            @php $pct = $totalVotes>0 ? round(($cand->votes_count/$totalVotes)*100,1) : 0; $h = $totalVotes>0 ? max(65,($cand->votes_count/$totalVotes)*240) : 65; @endphp
                            <div class="podium-item" id="podium-{{ $cand->id }}">
                                <div class="podium-avatar">
                                    @if($cand->photo)<img src="{{ asset('storage/'.$cand->photo) }}" alt="{{ $cand->name }}">@else <span>👤</span> @endif
                                    <span class="podium-rank-badge">#{{ $idx+1 }}</span>
                                </div>
                                <div class="podium-bar" style="height:{{ $h }}px;background:{{ $colors[$idx%count($colors)] }};">
                                    <span class="podium-bar-votes" id="pv-{{ $cand->id }}">{{ $cand->votes_count }}</span>
                                    <span class="podium-bar-pct" id="pp-{{ $cand->id }}">{{ $pct }}%</span>
                                </div>
                                <div class="podium-name">{{ $cand->name }}</div>
                            </div>
                            @endforeach
                            @if($candidates->isEmpty())
                            <div style="width:100%;display:flex;align-items:center;justify-content:center;color:var(--text-light);font-size:0.88rem;padding:40px;">Belum ada kandidat</div>
                            @endif
                        </div>
                    </div>

                    <!-- Distribution -->
                    <div class="dist-panel">
                        <h3 style="font-size:0.88rem;font-weight:700;color:var(--text-light);text-transform:uppercase;letter-spacing:1px;margin-bottom:18px;">📊 Distribusi Suara</h3>
                        @foreach($candidates as $idx => $cand)
                        @php $pct = $totalVotes>0 ? round(($cand->votes_count/$totalVotes)*100,1) : 0; @endphp
                        <div>
                            <div class="dist-bar-label">
                                <div style="display:flex;align-items:center;gap:7px;">
                                    <span style="width:8px;height:8px;border-radius:50%;background:{{ $colors[$idx%count($colors)] }};display:inline-block;flex-shrink:0;"></span>
                                    <span style="font-size:0.82rem;font-weight:600;color:var(--text-dark);">{{ $cand->name }}</span>
                                </div>
                                <div style="display:flex;gap:8px;align-items:center;">
                                    <span style="font-size:0.72rem;color:var(--text-light);">{{ $cand->votes_count }}</span>
                                    <span id="dp-{{ $cand->id }}" style="font-size:0.82rem;font-weight:800;color:{{ $colors[$idx%count($colors)] }};">{{ $pct }}%</span>
                                </div>
                            </div>
                            <div class="dist-bar-track">
                                <div id="df-{{ $cand->id }}" class="dist-bar-fill" style="width:{{ $pct }}%;background:{{ $colors[$idx%count($colors)] }};"></div>
                            </div>
                        </div>
                        @endforeach

                        <div class="refresh-box">
                            <div style="font-size:0.68rem;color:var(--text-light);font-weight:600;text-transform:uppercase;letter-spacing:1px;">AUTO REFRESH</div>
                            <div class="refresh-num" id="countdown-num">5</div>
                            <div style="font-size:0.65rem;color:var(--text-light);">detik</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
                 SECTION: KELOLA KANDIDAT
            ══════════════════════════════════════════════ --}}
            <div id="section-candidates" class="admin-section">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title"><i class="fa-solid fa-users"></i> Kelola Kandidat <span class="badge badge-gray">{{ $candidates->count() }}</span></div>
                        <div style="display:flex;gap:8px;flex-wrap:wrap;">
                            <form action="{{ route('admin.candidates.reset-all') }}" method="POST" onsubmit="return confirm('Reset semua suara?')">@csrf<button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-rotate"></i> Reset Suara</button></form>
                            <button onclick="openModal('modal-add-candidate')" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Tambah Kandidat</button>
                        </div>
                    </div>
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>#</th><th>Foto</th><th>Kandidat</th><th>Suara</th><th>%</th><th>Status</th><th>Aksi</th></tr></thead>
                            <tbody>
                                @foreach($candidates->sortByDesc('votes_count') as $rank => $cand)
                                @php $pct = $totalVotes>0 ? round(($cand->votes_count/$totalVotes)*100,1) : 0; @endphp
                                <tr>
                                    <td><span class="badge {{ $rank===0?'badge-amber':'badge-gray' }}">#{{ $rank+1 }}</span></td>
                                    <td>
                                        <div style="width:36px;height:36px;border-radius:50%;overflow:hidden;background:var(--bg-light);border:2px solid var(--border);">
                                            @if($cand->photo)<img src="{{ asset('storage/'.$cand->photo) }}" style="width:100%;height:100%;object-fit:cover;">@else<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">👤</div>@endif
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight:700;font-size:0.88rem;">{{ $cand->name }}</div>
                                        <div style="font-size:0.7rem;color:var(--text-light);">{{ Str::limit($cand->vision,35) }}</div>
                                    </td>
                                    <td><strong style="font-size:1.1rem;color:var(--primary);">{{ $cand->votes_count }}</strong></td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:5px;">
                                            <div style="flex:1;background:var(--bg-light);border-radius:50px;height:5px;overflow:hidden;min-width:50px;">
                                                <div style="height:100%;width:{{ $pct }}%;background:var(--primary);border-radius:50px;"></div>
                                            </div>
                                            <span style="font-size:0.75rem;font-weight:700;min-width:34px;">{{ $pct }}%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.candidates.toggle',$cand->id) }}" method="POST">@csrf @method('PATCH')
                                            <button type="submit" class="badge {{ $cand->is_active?'badge-green':'badge-red' }}" style="border:none;cursor:pointer;">{{ $cand->is_active?'✓ Aktif':'✗ Non-aktif' }}</button>
                                        </form>
                                    </td>
                                    <td>
                                        <div style="display:flex;gap:4px;">
                                            <button onclick="editCandidate({{ json_encode($cand) }})" class="btn btn-blue btn-icon btn-sm" title="Edit"><i class="fa-solid fa-pen"></i></button>
                                            <form action="{{ route('admin.candidates.reset',$cand->id) }}" method="POST" style="display:inline;">@csrf<button type="submit" class="btn btn-icon btn-sm" style="background:#fffbeb;color:#d97706;border:1px solid #fde68a;" onclick="return confirm('Reset suara?')" title="Reset suara"><i class="fa-solid fa-rotate-left"></i></button></form>
                                            <form action="{{ route('admin.candidates.delete',$cand->id) }}" method="POST" style="display:inline;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Hapus kandidat?')" title="Hapus"><i class="fa-solid fa-trash"></i></button></form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if($candidates->isEmpty())<tr><td colspan="7"><div class="empty-state"><i class="fa-solid fa-users-slash"></i><p>Belum ada kandidat</p></div></td></tr>@endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
                 SECTION: BERITA & ARTIKEL
            ══════════════════════════════════════════════ --}}
            <div id="section-news" class="admin-section">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title"><i class="fa-solid fa-newspaper"></i> Terbitkan Berita</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-grid">
                                <div class="form-group"><label class="form-label">Judul Berita *</label><input type="text" name="title" placeholder="Judul berita yang menarik..." required></div>
                                <div class="form-group"><label class="form-label">Penulis</label><input type="text" name="author" value="{{ Auth::user()->name }}"></div>
                                <div class="form-group full"><label class="form-label">Isi Konten *</label><textarea name="content" rows="7" placeholder="Tuliskan isi berita..." required></textarea></div>
                                <div class="form-group full"><label class="form-label">Gambar (Opsional)</label><input type="file" name="image" accept="image/*"><span style="font-size:0.7rem;color:var(--text-light);margin-top:3px;">JPG, PNG, WebP · maks 4MB</span></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-submit"><i class="fa-solid fa-paper-plane"></i> Terbitkan Berita</button>
                        </form>
                    </div>
                </div>

                <!-- Verifikasi Artikel Pending -->
                <div class="card" style="border-top: 4px solid var(--accent);">
                    <div class="card-header">
                        <div class="card-header-title" style="color:var(--text-dark);"><i class="fa-solid fa-clipboard-check" style="color:var(--accent);"></i> Verifikasi Artikel Publik <span class="badge" style="background:var(--accent); color:var(--text-dark);">{{ $pendingArticles->count() }}</span></div>
                    </div>
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>Info Pengirim</th><th>Judul & Thumbnail</th><th>Tanggal</th><th>Aksi</th></tr></thead>
                            <tbody>
                                @foreach($pendingArticles as $art)
                                <tr>
                                    <td>
                                        <div style="font-weight:700;font-size:0.88rem;">{{ explode('(', $art->author)[0] ?? $art->author }}</div>
                                        <div style="font-size:0.7rem;color:var(--text-light);"><i class="fa-solid fa-address-book"></i> {{ str_replace(')', '', explode('(', $art->author)[1] ?? 'Tidak ada kontak') }}</div>
                                    </td>
                                    <td>
                                        <div style="display:flex; gap:10px; align-items:center;">
                                            <img src="{{ $art->image ? Storage::url($art->image) : asset('images/hero_bg.png') }}" style="width:50px;height:35px;border-radius:var(--radius-md);object-fit:cover;border:1px solid var(--border);">
                                            <div style="font-weight:700;font-size:0.85rem;">{{ Str::limit($art->title, 40) }}</div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-gray">{{ \Carbon\Carbon::parse($art->created_at)->diffForHumans() }}</span></td>
                                    <td>
                                        <div style="display:flex;gap:5px;">
                                            <form action="{{ route('admin.articles.approve',$art->id) }}" method="POST" style="display:inline;">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-green btn-sm" onclick="return confirm('Setujui dan tayangkan artikel ini?')" style="padding: 6px 12px; font-weight: 600;"><i class="fa-solid fa-check"></i> Setujui</button>
                                            </form>
                                            <form action="{{ route('admin.articles.delete',$art->id) }}" method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Tolak dan hapus artikel ini?')"><i class="fa-solid fa-xmark"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if($pendingArticles->isEmpty())<tr><td colspan="4"><div class="empty-state"><i class="fa-solid fa-check-double"></i><p>Tidak ada artikel yang menunggu verifikasi</p></div></td></tr>@endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title"><i class="fa-solid fa-list-ul"></i> Daftar Artikel <span class="badge badge-green">{{ $articles->count() }}</span></div>
                    </div>
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>Thumbnail</th><th>Judul</th><th>Tanggal</th><th>Views</th><th>Aksi</th></tr></thead>
                            <tbody>
                                @foreach($articles as $art)
                                <tr>
                                    <td><img src="{{ $art->image ? Storage::url($art->image) : asset('images/hero_bg.png') }}" style="width:58px;height:40px;border-radius:var(--radius-md);object-fit:cover;border:1px solid var(--border);"></td>
                                    <td>
                                        <div style="font-weight:700;font-size:0.88rem;">{{ $art->title }}</div>
                                        <div style="font-size:0.7rem;color:var(--text-light);">{{ $art->author }}</div>
                                    </td>
                                    <td><span class="badge badge-gray">{{ \Carbon\Carbon::parse($art->published_at)->format('d M Y') }}</span></td>
                                    <td><span class="badge badge-blue">{{ $art->views_count }} views</span></td>
                                    <td>
                                        <div style="display:flex;gap:5px;">
                                            <button onclick="editArticle({{ json_encode($art) }})" class="btn btn-blue btn-icon btn-sm"><i class="fa-solid fa-pen"></i></button>
                                            <form action="{{ route('admin.articles.delete',$art->id) }}" method="POST" style="display:inline;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Hapus artikel?')"><i class="fa-solid fa-trash"></i></button></form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if($articles->isEmpty())<tr><td colspan="5"><div class="empty-state"><i class="fa-solid fa-newspaper"></i><p>Belum ada artikel</p></div></td></tr>@endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
                 SECTION: PROFIL ORGANISASI
            ══════════════════════════════════════════════ --}}
            <div id="section-history" class="admin-section">
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-scroll"></i> Kelola Profil &amp; Sejarah Organisasi</div></div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            {{-- SEJARAH IPNU --}}
                            <h3 style="border-bottom:2px solid var(--primary); padding-bottom:6px; margin-bottom:14px; color:var(--primary-dark); font-family:'Outfit'; font-weight:800; font-size:1.15rem; font-style:italic;">📖 SEJARAH IPNU</h3>
                            <div class="form-grid">
                                <div class="form-group full">
                                    <label class="form-label">Sejarah IPNU (Paragraf)</label>
                                    <textarea name="sejarah_ipnu" rows="6" placeholder="Ikatan Pelajar Nahdlatul Ulama (IPNU) didirikan pada tanggal...">{{ $settings['sejarah_ipnu'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nama Pendiri IPNU</label>
                                    <input type="text" name="sejarah_ipnu_title" value="{{ $settings['sejarah_ipnu_title'] ?? '' }}" placeholder="Prof. Dr. KH. Tolchah Mansoer">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Foto Portrait Pendiri</label>
                                    <input type="file" name="sejarah_ipnu_photo_portrait" accept="image/*">
                                    @if(!empty($settings['sejarah_ipnu_photo_portrait']))
                                        <div style="margin-top:8px;"><img src="{{ Storage::url($settings['sejarah_ipnu_photo_portrait']) }}" style="height:60px; border-radius:4px; border:1px solid #cbd5e1;"></div>
                                    @endif
                                </div>
                                <div class="form-group full">
                                    <label class="form-label">Foto Spanduk/Banner Sejarah IPNU</label>
                                    <input type="file" name="sejarah_ipnu_photo_banner" accept="image/*">
                                    @if(!empty($settings['sejarah_ipnu_photo_banner']))
                                        <div style="margin-top:8px;"><img src="{{ Storage::url($settings['sejarah_ipnu_photo_banner']) }}" style="max-height:100px; border-radius:6px; border:1px solid #cbd5e1;"></div>
                                    @endif
                                </div>
                            </div>

                            {{-- SEJARAH IPPNU --}}
                            <h3 style="border-bottom:2px solid #c2410c; padding-bottom:6px; margin-top:28px; margin-bottom:14px; color:#c2410c; font-family:'Outfit'; font-weight:800; font-size:1.15rem; font-style:italic;">📖 SEJARAH IPPNU</h3>
                            <div class="form-grid">
                                <div class="form-group full">
                                    <label class="form-label">Sejarah IPPNU (Paragraf)</label>
                                    <textarea name="sejarah_ippnu" rows="6" placeholder="Sedangkan Ikatan Pelajar Putri Nahdlatul Ulama (IPPNU) didirikan pada tanggal...">{{ $settings['sejarah_ippnu'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nama Pendiri IPPNU</label>
                                    <input type="text" name="sejarah_ippnu_title" value="{{ $settings['sejarah_ippnu_title'] ?? '' }}" placeholder="Ny. Hj. Umroh Mahfudzah">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Foto Portrait Pendiri</label>
                                    <input type="file" name="sejarah_ippnu_photo_portrait" accept="image/*">
                                    @if(!empty($settings['sejarah_ippnu_photo_portrait']))
                                        <div style="margin-top:8px;"><img src="{{ Storage::url($settings['sejarah_ippnu_photo_portrait']) }}" style="height:60px; border-radius:4px; border:1px solid #cbd5e1;"></div>
                                    @endif
                                </div>
                                <div class="form-group full">
                                    <label class="form-label">Foto Spanduk/Banner Sejarah IPPNU</label>
                                    <input type="file" name="sejarah_ippnu_photo_banner" accept="image/*">
                                    @if(!empty($settings['sejarah_ippnu_photo_banner']))
                                        <div style="margin-top:8px;"><img src="{{ Storage::url($settings['sejarah_ippnu_photo_banner']) }}" style="max-height:100px; border-radius:6px; border:1px solid #cbd5e1;"></div>
                                    @endif
                                </div>
                            </div>

                            {{-- VISI MISI IPNU --}}
                            <h3 style="border-bottom:2px solid var(--primary); padding-bottom:6px; margin-top:28px; margin-bottom:14px; color:var(--primary-dark); font-family:'Outfit'; font-weight:800; font-size:1.15rem; font-style:italic;">🎯 VISI &amp; MISI IPNU</h3>
                            <div class="form-grid">
                                <div class="form-group full">
                                    <label class="form-label">Visi IPNU</label>
                                    <textarea name="visi_ipnu" rows="3" placeholder="Terwujudnya pelajar-pelajar bangsa yang bertaqwa...">{{ $settings['visi_ipnu'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group full">
                                    <label class="form-label">Misi IPNU <span style="font-weight:normal;color:#64748b;font-size:0.75rem;">(Pisahkan setiap poin misi dengan baris baru / Enter)</span></label>
                                    <textarea name="misi_ipnu" rows="6" placeholder="Mendorong para pelajar bangsa untuk taat...&#10;Membentuk karakter para pelajar bangsa...">{{ $settings['misi_ipnu'] ?? '' }}</textarea>
                                </div>
                            </div>

                            {{-- VISI MISI IPPNU --}}
                            <h3 style="border-bottom:2px solid #c2410c; padding-bottom:6px; margin-top:28px; margin-bottom:14px; color:#c2410c; font-family:'Outfit'; font-weight:800; font-size:1.15rem; font-style:italic;">🎯 VISI &amp; MISI IPPNU</h3>
                            <div class="form-grid">
                                <div class="form-group full">
                                    <label class="form-label">Visi IPPNU</label>
                                    <textarea name="visi_ippnu" rows="3" placeholder="Terbentuknya kesempurnaan Pelajar Putri Indonesia...">{{ $settings['visi_ippnu'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group full">
                                    <label class="form-label">Misi IPPNU <span style="font-weight:normal;color:#64748b;font-size:0.75rem;">(Pisahkan setiap poin misi dengan baris baru / Enter)</span></label>
                                    <textarea name="misi_ippnu" rows="5" placeholder="Membangun kader NU yang berkualitas...&#10;Mengembangkan wacana dan kualitas...">{{ $settings['misi_ippnu'] ?? '' }}</textarea>
                                </div>
                            </div>

                            {{-- VISI MISI PAC KEMIRI --}}
                            <h3 style="border-bottom:2px solid var(--accent); padding-bottom:6px; margin-top:28px; margin-bottom:14px; color:var(--text-dark); font-family:'Outfit'; font-weight:800; font-size:1.15rem; font-style:italic;">🌟 VISI &amp; MISI PAC KEMIRI</h3>
                            <div class="form-grid">
                                <div class="form-group full">
                                    <label class="form-label">Visi PAC Kemiri</label>
                                    <textarea name="visi_pac" rows="3" placeholder="Terwujudnya organisasi IPNU-IPPNU yang solid...">{{ $settings['visi_pac'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group full">
                                    <label class="form-label">Misi PAC Kemiri <span style="font-weight:normal;color:#64748b;font-size:0.75rem;">(Pisahkan setiap poin misi dengan baris baru / Enter)</span></label>
                                    <textarea name="misi_pac" rows="6" placeholder="Meningkatkan solidaritas dan sinergi...&#10;Mengembangkan kualitas pelajar NU...">{{ $settings['misi_pac'] ?? '' }}</textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-submit" style="margin-top:24px; max-width:300px;"><i class="fa-solid fa-floppy-disk"></i> Simpan Profil Lengkap</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
                 SECTION: NAHKODA PIMPINAN
            ══════════════════════════════════════════════ --}}
            <div id="section-officials" class="admin-section">
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-anchor"></i> Tambah Data Nahkoda / Pengurus</div></div>
                    <div class="card-body">
                        <form action="{{ route('admin.officials.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-grid">
                                <div class="form-group"><label class="form-label">Nama Lengkap *</label><input type="text" name="name" placeholder="Nama pengurus..." required></div>
                                <div class="form-group"><label class="form-label">Jabatan *</label><input type="text" name="position" placeholder="cth: Ketua, Wakil Ketua I" required></div>
                                <div class="form-group"><label class="form-label">Kategori *</label>
                                    <select name="type">
                                        <option value="pimpinan">⚓ Nahkoda (ID Card)</option>
                                        <option value="bph">🏛️ Susunan Pengurus (Daftar)</option>
                                    </select>
                                </div>
                                <div class="form-group"><label class="form-label">Organisasi *</label>
                                    <select name="organization">
                                        <option value="IPNU">IPNU</option>
                                        <option value="IPPNU">IPPNU</option>
                                    </select>
                                </div>
                                <div class="form-group"><label class="form-label">Seksi / Bagian</label><input type="text" name="section" placeholder="cth: Pengurus Harian, Departemen Kaderisasi"></div>
                                <div class="form-group"><label class="form-label">Foto Profil</label><input type="file" name="photo" accept="image/*"></div>
                                <div class="form-group"><label class="form-label">Tempat, Tanggal Lahir</label><input type="text" name="birth_place_date" placeholder="cth: Purworejo, 17 Agustus 2000"></div>
                                <div class="form-group"><label class="form-label">Fokus Gerakan</label><input type="text" name="movement_focus" placeholder="cth: Digitalisasi & Kaderisasi"></div>
                                <div class="form-group"><label class="form-label">Masa Khidmat <span style="font-size:0.75rem;font-weight:normal;color:#64748b;margin-left:5px;">(Digunakan untuk tab kategori)</span></label><input type="text" name="service_period" placeholder="cth: 2025-2027"></div>
                                <div class="form-group"><label class="form-label">Motto Hidup</label><input type="text" name="motto" placeholder="Motto..."></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-submit" style="max-width:280px;"><i class="fa-solid fa-user-plus"></i> Simpan Pengurus</button>
                        </form>
                    </div>
                </div>

                {{-- Tabel Nahkoda --}}
                {{-- Tabel Nahkoda IPNU --}}
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-anchor"></i> Nahkoda IPNU (ID Card) <span class="badge badge-green">{{ $officials->where('type','pimpinan')->where('organization','IPNU')->count() }}</span></div></div>
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>Foto</th><th>Nama</th><th>Jabatan</th><th>Org</th><th>Aksi</th></tr></thead>
                            <tbody>
                                @foreach($officials->where('type','pimpinan')->where('organization','IPNU') as $off)
                                <tr>
                                    <td><img src="{{ $off->photo ? Storage::url($off->photo) : asset('images/logo_ipnu.png') }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;border:2px solid var(--border);"></td>
                                    <td style="font-weight:700;">{{ $off->name }}</td>
                                    <td>{{ $off->position }}</td>
                                    <td><span class="badge badge-green">{{ $off->organization ?? '-' }}</span></td>
                                    <td>
                                        <div style="display:flex;gap:5px;">
                                            <button onclick="openEditOfficial({{ json_encode($off) }})" class="btn btn-blue btn-icon btn-sm"><i class="fa-solid fa-pen"></i></button>
                                            <form action="{{ route('admin.officials.delete',$off->id) }}" method="POST" style="display:inline;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Hapus?')"><i class="fa-solid fa-trash"></i></button></form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if($officials->where('type','pimpinan')->where('organization','IPNU')->isEmpty())<tr><td colspan="5"><div class="empty-state"><i class="fa-solid fa-users-slash"></i><p>Belum ada data Nahkoda IPNU</p></div></td></tr>@endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Tabel Nahkoda IPPNU --}}
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-anchor"></i> Nahkoda IPPNU (ID Card) <span class="badge badge-green">{{ $officials->where('type','pimpinan')->where('organization','IPPNU')->count() }}</span></div></div>
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>Foto</th><th>Nama</th><th>Jabatan</th><th>Org</th><th>Aksi</th></tr></thead>
                            <tbody>
                                @foreach($officials->where('type','pimpinan')->where('organization','IPPNU') as $off)
                                <tr>
                                    <td><img src="{{ $off->photo ? Storage::url($off->photo) : asset('images/logo_ipnu.png') }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;border:2px solid var(--border);"></td>
                                    <td style="font-weight:700;">{{ $off->name }}</td>
                                    <td>{{ $off->position }}</td>
                                    <td><span class="badge badge-green">{{ $off->organization ?? '-' }}</span></td>
                                    <td>
                                        <div style="display:flex;gap:5px;">
                                            <button onclick="openEditOfficial({{ json_encode($off) }})" class="btn btn-blue btn-icon btn-sm"><i class="fa-solid fa-pen"></i></button>
                                            <form action="{{ route('admin.officials.delete',$off->id) }}" method="POST" style="display:inline;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Hapus?')"><i class="fa-solid fa-trash"></i></button></form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if($officials->where('type','pimpinan')->where('organization','IPPNU')->isEmpty())<tr><td colspan="5"><div class="empty-state"><i class="fa-solid fa-users-slash"></i><p>Belum ada data Nahkoda IPPNU</p></div></td></tr>@endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Tabel BPH / Susunan Pengurus --}}
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-sitemap"></i> Susunan Pengurus (Daftar) <span class="badge badge-blue">{{ $officials->where('type','bph')->count() }}</span></div></div>
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>Nama</th><th>Jabatan</th><th>Organisasi</th><th>Seksi</th><th>Aksi</th></tr></thead>
                            <tbody>
                                @foreach($officials->where('type','bph')->sortBy(['organization','section','position']) as $off)
                                <tr>
                                    <td style="font-weight:700;">{{ $off->name }}</td>
                                    <td>{{ $off->position }}</td>
                                    <td><span class="badge {{ $off->organization==='IPNU'?'badge-green':'badge-blue' }}">{{ $off->organization ?? '-' }}</span></td>
                                    <td>{{ $off->section ?? '-' }}</td>
                                    <td>
                                        <div style="display:flex;gap:5px;">
                                            <button onclick="openEditOfficial({{ json_encode($off) }})" class="btn btn-blue btn-icon btn-sm"><i class="fa-solid fa-pen"></i></button>
                                            <form action="{{ route('admin.officials.delete',$off->id) }}" method="POST" style="display:inline;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Hapus?')"><i class="fa-solid fa-trash"></i></button></form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if($officials->where('type','bph')->isEmpty())<tr><td colspan="5"><div class="empty-state"><i class="fa-solid fa-users-slash"></i><p>Belum ada data Susunan Pengurus</p></div></td></tr>@endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
                 SECTION: FOTO STRUKTUR KEPENGURUSAN
            ══════════════════════════════════════════════ --}}
            <div id="section-structures" class="admin-section">
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-image"></i> Foto Bersama IPNU & IPPNU</div></div>
                    <div class="card-body">
                        <p style="color:var(--text-light);font-size:0.82rem;margin-bottom:16px;">Upload foto bersama untuk ditampilkan di halaman Susunan Pengurus (di atas daftar nama).</p>
                        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-grid">
                                <div class="form-group full">
                                    <label class="form-label">Teks Masa Khidmat Struktur</label>
                                    <input type="text" name="structure_service_period" value="{{ $settings['structure_service_period'] ?? 'Masa Khidmat 2025-2027' }}" placeholder="cth: Masa Khidmat 2025-2027">
                                </div>
                                <div class="form-group full">
                                    <label class="form-label">Foto Struktur IPNU</label>
                                    <input type="file" name="structure_ipnu_photo" accept="image/*">
                                    @if(!empty($settings['structure_ipnu_photo'])) 
                                        <div style="margin-top:10px;"><img src="{{ Storage::url($settings['structure_ipnu_photo']) }}" style="height:100px; border-radius:8px; object-fit:cover;"></div>
                                    @endif
                                </div>
                                <div class="form-group full">
                                    <label class="form-label">Foto Struktur IPPNU</label>
                                    <input type="file" name="structure_ippnu_photo" accept="image/*">
                                    @if(!empty($settings['structure_ippnu_photo'])) 
                                        <div style="margin-top:10px;"><img src="{{ Storage::url($settings['structure_ippnu_photo']) }}" style="height:100px; border-radius:8px; object-fit:cover;"></div>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-top:14px;"><i class="fa-solid fa-upload"></i> Simpan Foto</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- ══════════════════════════════════════════════
                 SECTION: STATISTIK ANGGOTA
            ══════════════════════════════════════════════ --}}
            <div id="section-stats" class="admin-section">
                <div class="card" style="margin-bottom: 24px;">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-chart-line"></i> Pengaturan Statistik Utama &amp; Grid</div></div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf
                            <div style="font-weight:700; color:var(--primary-dark); margin-bottom:12px; font-size:0.95rem; border-bottom:2px solid #e2e8f0; padding-bottom:6px;">Total Anggota (Terverifikasi)</div>
                            <div class="form-grid">
                                <div class="form-group"><label class="form-label">Total Anggota IPNU</label><input type="number" name="total_anggota_ipnu" value="{{ $settings['total_anggota_ipnu'] ?? 31340 }}" required></div>
                                <div class="form-group"><label class="form-label">Total Anggota IPPNU</label><input type="number" name="total_anggota_ippnu" value="{{ $settings['total_anggota_ippnu'] ?? 37197 }}" required></div>
                            </div>
                            <div style="font-weight:700; color:var(--primary-dark); margin:20px 0 12px; font-size:0.95rem; border-bottom:2px solid #e2e8f0; padding-bottom:6px;">Statistik Grid Anggota</div>
                            <div class="form-grid" style="grid-template-columns: repeat(4, 1fr);">
                                <div class="form-group" style="grid-column: span 2;"><label class="form-label">Anak Cabang IPNU</label><input type="text" name="stats_ipnu_ac" value="{{ $settings['stats_ipnu_ac'] ?? '482' }}" required></div>
                                <div class="form-group" style="grid-column: span 2;"><label class="form-label">Anak Cabang IPPNU</label><input type="text" name="stats_ippnu_ac" value="{{ $settings['stats_ippnu_ac'] ?? '510' }}" required></div>
                                <div class="form-group" style="grid-column: span 2;"><label class="form-label">Ranting (Desa) IPNU</label><input type="text" name="stats_ipnu_ranting" value="{{ $settings['stats_ipnu_ranting'] ?? '2,750' }}" required></div>
                                <div class="form-group" style="grid-column: span 2;"><label class="form-label">Ranting (Desa) IPPNU</label><input type="text" name="stats_ippnu_ranting" value="{{ $settings['stats_ippnu_ranting'] ?? '2,566' }}" required></div>
                                <div class="form-group" style="grid-column: span 2;"><label class="form-label">Komisariat Sekolah IPNU</label><input type="text" name="stats_ipnu_sekolah" value="{{ $settings['stats_ipnu_sekolah'] ?? '880' }}" required></div>
                                <div class="form-group" style="grid-column: span 2;"><label class="form-label">Komisariat Sekolah IPPNU</label><input type="text" name="stats_ippnu_sekolah" value="{{ $settings['stats_ippnu_sekolah'] ?? '804' }}" required></div>
                                <div class="form-group" style="grid-column: span 2;"><label class="form-label">Komisariat Pondok Pesantren IPNU</label><input type="text" name="stats_ipnu_pesantren" value="{{ $settings['stats_ipnu_pesantren'] ?? '450' }}" required></div>
                                <div class="form-group" style="grid-column: span 2;"><label class="form-label">Komisariat Pondok Pesantren IPPNU</label><input type="text" name="stats_ippnu_pesantren" value="{{ $settings['stats_ippnu_pesantren'] ?? '420' }}" required></div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-top:16px; max-width:250px;"><i class="fa-solid fa-floppy-disk"></i> Simpan Statistik Utama</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-chart-simple"></i> Tambah Statistik</div></div>
                    <div class="card-body">
                        <form action="{{ route('admin.stats.store') }}" method="POST">
                            @csrf
                            <div class="form-grid">
                                <div class="form-group"><label class="form-label">Label *</label><input type="text" name="label" placeholder="cth: Kader Aktif" required></div>
                                <div class="form-group"><label class="form-label">Nilai *</label><input type="number" name="value" placeholder="cth: 250" required></div>
                                <div class="form-group"><label class="form-label">Icon Emoji</label><input type="text" name="icon" placeholder="cth: 👤 🏫 📚" maxlength="10"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm" style="margin-top:14px;"><i class="fa-solid fa-plus"></i> Tambah</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-list"></i> Data Statistik</div></div>
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>Icon</th><th>Label</th><th>Nilai</th><th>Aksi</th></tr></thead>
                            <tbody>
                                @foreach($stats as $stat)
                                <tr>
                                    <td style="font-size:1.4rem;">{{ $stat->icon ?? '📊' }}</td>
                                    <td style="font-weight:600;">{{ $stat->label }}</td>
                                    <td><strong style="font-family:'Outfit';font-size:1.1rem;color:var(--primary);">{{ number_format($stat->value) }}</strong></td>
                                    <td>
                                        <div style="display:flex;gap:5px;">
                                            <button onclick="openEditStat({{ json_encode($stat) }})" class="btn btn-blue btn-icon btn-sm"><i class="fa-solid fa-pen"></i></button>
                                            <form action="{{ route('admin.stats.delete',$stat->id) }}" method="POST" style="display:inline;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Hapus statistik?')"><i class="fa-solid fa-trash"></i></button></form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if($stats->isEmpty())<tr><td colspan="4"><div class="empty-state"><i class="fa-solid fa-chart-bar"></i><p>Belum ada data statistik</p></div></td></tr>@endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
                 SECTION: AGENDA KEGIATAN
            ══════════════════════════════════════════════ --}}
            <div id="section-agendas" class="admin-section">
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-calendar-check"></i> Tambah Agenda</div></div>
                    <div class="card-body">
                        <form action="{{ route('admin.agendas.store') }}" method="POST">
                            @csrf
                            <div class="form-grid">
                                <div class="form-group"><label class="form-label">Nama Kegiatan *</label><input type="text" name="title" placeholder="Nama kegiatan..." required></div>
                                <div class="form-group"><label class="form-label">Tanggal *</label><input type="date" name="date" required></div>
                                <div class="form-group full"><label class="form-label">Lokasi *</label><input type="text" name="location" placeholder="Lokasi kegiatan..." required></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm" style="margin-top:14px;"><i class="fa-solid fa-calendar-plus"></i> Simpan Agenda</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-list"></i> Daftar Agenda</div></div>
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>Kegiatan</th><th>Tanggal</th><th>Lokasi</th><th>Aksi</th></tr></thead>
                            <tbody>
                                @foreach($agendas->sortBy('date') as $agenda)
                                <tr>
                                    <td style="font-weight:600;">{{ $agenda->title }}</td>
                                    <td><span class="badge badge-green">{{ \Carbon\Carbon::parse($agenda->date)->format('d M Y') }}</span></td>
                                    <td>{{ $agenda->location }}</td>
                                    <td><form action="{{ route('admin.agendas.delete',$agenda->id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Hapus?')"><i class="fa-solid fa-trash"></i></button></form></td>
                                </tr>
                                @endforeach
                                @if($agendas->isEmpty())<tr><td colspan="4"><div class="empty-state"><i class="fa-solid fa-calendar-xmark"></i><p>Belum ada agenda</p></div></td></tr>@endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
                 SECTION: SINERGI PROGRAM
            ══════════════════════════════════════════════ --}}
            <div id="section-programs" class="admin-section">
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-handshake"></i> Tambah Program</div></div>
                    <div class="card-body">
                        <form action="{{ route('admin.program.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-grid">
                                <div class="form-group"><label class="form-label">Nama Program *</label><input type="text" name="title" placeholder="Nama program..." required></div>
                                <div class="form-group"><label class="form-label">Ikon (Opsional)</label><input type="text" name="icon" placeholder="Contoh: fa-solid fa-users"></div>
                                <div class="form-group"><label class="form-label">Foto Proker (Opsional)</label><input type="file" name="photo" accept="image/*"></div>
                                <div class="form-group full"><label class="form-label">Deskripsi</label><textarea name="description" rows="2" placeholder="Deskripsi singkat..."></textarea></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm" style="margin-top:14px;"><i class="fa-solid fa-plus"></i> Simpan Program</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-list"></i> Daftar Program</div></div>
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>Nama Program</th><th>Ikon</th><th>Foto</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
                            <tbody>
                                @foreach($programs as $program)
                                <tr>
                                    <td style="font-weight:600;">{{ $program->title }}</td>
                                    <td><i class="{{ $program->icon ?? 'fa-solid fa-circle-check' }}"></i></td>
                                    <td>
                                        @if($program->photo)
                                            <img src="{{ asset('storage/' . $program->photo) }}" style="width:40px; height:40px; object-fit:cover; border-radius:4px;">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $program->description }}</td>
                                    <td><form action="{{ route('admin.program.delete',$program->id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Hapus?')"><i class="fa-solid fa-trash"></i></button></form></td>
                                </tr>
                                @endforeach
                                @if($programs->isEmpty())<tr><td colspan="5"><div class="empty-state"><i class="fa-solid fa-box-open"></i><p>Belum ada program</p></div></td></tr>@endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
                 SECTION: GALERI DOKUMENTASI
            ══════════════════════════════════════════════ --}}
            <div id="section-gallery" class="admin-section">
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-images"></i> Unggah Foto Dokumentasi</div></div>
                    <div class="card-body">
                        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-grid">
                                <div class="form-group"><label class="form-label">Judul Foto *</label><input type="text" name="title" placeholder="Judul foto..." required></div>
                                <div class="form-group">
                                    <label class="form-label">Kategori *</label>
                                    <select name="category" required>
                                        <option value="">— Pilih Kategori —</option>
                                        <option value="Umum">Umum</option>
                                        <option value="Kegiatan">Kegiatan</option>
                                        <option value="Rapat">Rapat</option>
                                        <option value="Lomba">Lomba &amp; Prestasi</option>
                                        <option value="Sosial">Sosial &amp; Pengabdian</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group full"><label class="form-label">File Foto *</label><input type="file" name="image" accept="image/*" required><span style="font-size:0.7rem;color:var(--text-light);">JPG, PNG, WebP, GIF · maks 8MB</span></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm" style="margin-top:14px;"><i class="fa-solid fa-cloud-arrow-up"></i> Unggah ke Galeri</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title"><i class="fa-solid fa-photo-film"></i> Koleksi Galeri <span class="badge badge-green">{{ $galleries->count() }}</span></div>
                    </div>
                    <div class="card-body">
                        <div class="cat-tabs">
                            <button class="cat-tab active" onclick="filterGallery('all',this)">Semua</button>
                            <button class="cat-tab" onclick="filterGallery('Umum',this)">Umum</button>
                            <button class="cat-tab" onclick="filterGallery('Kegiatan',this)">Kegiatan</button>
                            <button class="cat-tab" onclick="filterGallery('Rapat',this)">Rapat</button>
                            <button class="cat-tab" onclick="filterGallery('Lomba',this)">Lomba</button>
                            <button class="cat-tab" onclick="filterGallery('Sosial',this)">Sosial</button>
                            <button class="cat-tab" onclick="filterGallery('Lainnya',this)">Lainnya</button>
                        </div>
                        <div class="gallery-grid" id="gallery-grid">
                            @foreach($galleries as $photo)
                            <div class="gal-item" data-category="{{ $photo->category }}">
                                <img src="{{ Storage::url($photo->image) }}" alt="{{ $photo->title }}" loading="lazy">
                                <div class="gal-cat-badge">{{ $photo->category }}</div>
                                <div class="gal-item-overlay">
                                    <button onclick="openEditGallery({{ json_encode($photo) }})" class="btn btn-accent btn-sm" style="border-radius:50px;"><i class="fa-solid fa-pen"></i></button>
                                    <form action="{{ route('admin.gallery.delete',$photo->id) }}" method="POST" style="display:inline;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm" style="border-radius:50px;" onclick="return confirm('Hapus foto?')"><i class="fa-solid fa-trash"></i></button></form>
                                </div>
                            </div>
                            @endforeach
                            @if($galleries->isEmpty())<div style="grid-column:1/-1;"><div class="empty-state"><i class="fa-solid fa-images"></i><p>Belum ada foto</p></div></div>@endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
                 SECTION: LAPAK USAHA
            ══════════════════════════════════════════════ --}}
            <div id="section-lapak" class="admin-section">
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-store"></i> Tambah Produk Lapak</div></div>
                    <div class="card-body">
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-grid">
                                <div class="form-group"><label class="form-label">Nama Produk *</label><input type="text" name="name" placeholder="Nama produk..." required></div>
                                <div class="form-group"><label class="form-label">Kategori</label><select name="category"><option value="Fashion">Fashion</option><option value="Aksesoris">Aksesoris</option><option value="Buku">Buku</option><option value="Makanan">Makanan</option><option value="Minuman">Minuman</option><option value="Jasa">Jasa</option><option value="Lainnya" selected>Lainnya</option></select></div>
                                <div class="form-group"><label class="form-label">Harga (Rp) *</label><input type="number" name="price" placeholder="50000" required></div>
                                <div class="form-group"><label class="form-label">Diskon (%)</label><input type="number" name="discount" min="0" max="99" placeholder="0"></div>
                                <div class="form-group"><label class="form-label">Kondisi</label><select name="condition"><option value="Baru">Baru</option><option value="Bekas">Bekas</option><option value="Pre-order">Pre-order</option></select></div>
                                <div class="form-group"><label class="form-label">Stok</label><input type="number" name="stock" min="0" placeholder="10"></div>
                                <div class="form-group"><label class="form-label">Terjual</label><input type="number" name="sold_count" min="0" placeholder="0"></div>
                                <div class="form-group"><label class="form-label">Rating (1-5)</label><input type="number" step="0.1" name="rating" min="1" max="5" placeholder="5.0"></div>
                                <div class="form-group full"><label class="form-label">Deskripsi Produk</label><textarea name="description" rows="3" placeholder="Deskripsi lengkap produk..."></textarea></div>
                                <div class="form-group"><label class="form-label">Lokasi</label><input type="text" name="location" placeholder="Kemiri, Purworejo"></div>
                                <div class="form-group"><label class="form-label">Link WhatsApp</label><input type="text" name="wa_link" placeholder="https://wa.me/628..."></div>
                                <div class="form-group full"><label class="form-label">Foto Produk</label><input type="file" name="image" accept="image/*"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm" style="margin-top:14px;"><i class="fa-solid fa-plus"></i> Tambah Produk</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-bag-shopping"></i> Daftar Produk <span class="badge badge-green">{{ $products->count() }}</span></div></div>
                    <div class="table-wrap">
                        <table>
                            <thead><tr><th>Foto</th><th>Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Terjual</th><th>Aksi</th></tr></thead>
                            <tbody>
                                @foreach($products as $prod)
                                <tr>
                                    <td>
                                        @if($prod->image)<img src="{{ Storage::url($prod->image) }}" style="width:46px;height:46px;border-radius:var(--radius-md);object-fit:cover;border:1px solid var(--border);">@else<div style="width:46px;height:46px;border-radius:var(--radius-md);background:var(--bg-light);display:flex;align-items:center;justify-content:center;font-size:1.3rem;">🛒</div>@endif
                                    </td>
                                    <td>
                                        <div style="font-weight:700;">{{ $prod->name }}</div>
                                        <div style="font-size:0.72rem;color:var(--text-light);">{{ Str::limit($prod->description, 40) }}</div>
                                    </td>
                                    <td><span class="badge badge-blue">{{ $prod->category }}</span></td>
                                    <td>
                                        @if($prod->discount > 0)
                                            <div style="font-size:0.68rem;color:#ef4444;text-decoration:line-through;">Rp {{ number_format($prod->price,0,',','.') }}</div>
                                            <strong style="color:var(--primary);">Rp {{ number_format($prod->discounted_price,0,',','.') }}</strong>
                                            <span class="badge badge-red" style="font-size:0.6rem;">-{{ $prod->discount }}%</span>
                                        @else
                                            <strong style="color:var(--primary);">Rp {{ number_format($prod->price,0,',','.') }}</strong>
                                        @endif
                                    </td>
                                    <td><span class="badge {{ $prod->stock > 0 ? 'badge-green' : 'badge-red' }}">{{ $prod->stock }}</span></td>
                                    <td>{{ $prod->sold_count }}</td>
                                    <td>
                                        <div style="display:flex;gap:5px;">
                                            <button onclick="openEditProduct({{ json_encode($prod) }})" class="btn btn-blue btn-icon btn-sm"><i class="fa-solid fa-pen"></i></button>
                                            <form action="{{ route('admin.products.delete',$prod->id) }}" method="POST" style="display:inline;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Hapus produk?')"><i class="fa-solid fa-trash"></i></button></form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if($products->isEmpty())<tr><td colspan="7"><div class="empty-state"><i class="fa-solid fa-store-slash"></i><p>Belum ada produk</p></div></td></tr>@endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
                 SECTION: RUANG LAPOR
            ══════════════════════════════════════════════ --}}
            <div id="section-feedback" class="admin-section">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">
                            <i class="fa-solid fa-inbox"></i> Ruang Lapor &amp; Aspirasi
                            @if($feedbacks->where('is_read',false)->count()>0)
                                <span class="badge" style="background:#ef4444;color:white;">{{ $feedbacks->where('is_read',false)->count() }} baru</span>
                            @endif
                        </div>
                        <span style="font-size:0.8rem;color:var(--text-light);">{{ $feedbacks->count() }} laporan masuk</span>
                    </div>
                    <div class="card-body">
                        @if($feedbacks->isEmpty())
                            <div class="empty-state"><i class="fa-solid fa-inbox"></i><p>Belum ada laporan</p><span>Laporan dari publik akan muncul di sini</span></div>
                        @else
                            @foreach($feedbacks as $fb)
                            <div class="feedback-card {{ !$fb->is_read?'unread':'' }}">
                                <div class="fb-meta">
                                    <div>
                                        <div class="fb-sender">
                                            @if(!$fb->is_read)<span style="font-size:0.6rem;background:var(--accent);color:#111;padding:1px 7px;border-radius:50px;font-weight:800;margin-right:5px;">BARU</span>@endif
                                            {{ $fb->name }}
                                            @if($fb->contact ?? false)<span style="font-size:0.7rem;color:var(--text-light);font-weight:500;"> · {{ $fb->contact }}</span>@endif
                                        </div>
                                        @if($fb->subject ?? false)<div class="fb-subject">{{ $fb->subject }}</div>@endif
                                    </div>
                                    <div style="display:flex;gap:6px;align-items:center;flex-shrink:0;">
                                        <span class="fb-time">{{ \Carbon\Carbon::parse($fb->created_at)->diffForHumans() }}</span>
                                        @if(!$fb->is_read)
                                        <form action="{{ route('admin.feedbacks.read',$fb->id) }}" method="POST" style="display:inline;">@csrf @method('PATCH')<button type="submit" class="btn btn-sm" style="background:#fffbeb;color:#d97706;border:1px solid #fde68a;" title="Tandai dibaca"><i class="fa-solid fa-check"></i></button></form>
                                        @endif
                                        <form action="{{ route('admin.feedbacks.delete',$fb->id) }}" method="POST" style="display:inline;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Hapus laporan?')"><i class="fa-solid fa-trash"></i></button></form>
                                    </div>
                                </div>
                                <div class="fb-msg">{{ $fb->message }}</div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
                 SECTION: PENDAFTAR BARU
            ══════════════════════════════════════════════ --}}
            <div id="section-registrations" class="admin-section">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title"><i class="fa-solid fa-user-plus"></i> Data Pendaftar Baru <span class="badge badge-green">{{ $registrations->count() }}</span></div>
                    </div>
                    <div class="card-body" style="padding:0;">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <th>Kontak (Email / HP)</th>
                                        <th>Pendidikan & Makesta</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registrations as $reg)
                                    <tr>
                                        <td>
                                            <div style="font-weight:700;">{{ $reg->name }}</div>
                                            <div style="font-size:0.8rem;color:#64748b;">TTL: {{ $reg->birth_place }}, {{ $reg->birth_date ? \Carbon\Carbon::parse($reg->birth_date)->format('d M Y') : '-' }}</div>
                                        </td>
                                        <td>
                                            <div><a href="mailto:{{ $reg->email }}" style="color:var(--primary);text-decoration:none;">{{ $reg->email }}</a></div>
                                            <div style="font-size:0.85rem;"><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $reg->phone) }}" target="_blank" style="color:#16a34a;text-decoration:none;font-weight:600;"><i class="fa-brands fa-whatsapp"></i> {{ $reg->phone ?: '-' }}</a></div>
                                        </td>
                                        <td>
                                            <div>Pendidikan: <span style="font-weight:600;">{{ $reg->education ?: '-' }}</span></div>
                                            <div style="font-size:0.85rem;color:#64748b;">Makesta: {{ $reg->makesta_date ? \Carbon\Carbon::parse($reg->makesta_date)->format('d M Y') : '-' }}</div>
                                        </td>
                                        <td>
                                            <div style="font-size:0.85rem;white-space:pre-wrap;line-height:1.4;">{{ $reg->address }}</div>
                                        </td>
                                        <td style="width: 80px;">
                                            <form action="{{ route('admin.registrations.delete', $reg->id) }}" method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-icon btn-sm" onclick="return confirm('Hapus data pendaftar ini?')"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if($registrations->isEmpty())
                                    <tr><td colspan="5"><div class="empty-state"><i class="fa-solid fa-user-xmark"></i><p>Belum ada pendaftar baru</p></div></td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════
                 SECTION: PENGATURAN
            ══════════════════════════════════════════════ --}}
            <div id="section-settings" class="admin-section">
                <div class="card">
                    <div class="card-header"><div class="card-header-title"><i class="fa-solid fa-gear"></i> Pengaturan Portal</div></div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-grid">
                                <div class="form-group"><label class="form-label">Nama Organisasi</label><input type="text" name="org_name" value="{{ $settings['org_name'] ?? 'PAC IPNU IPPNU Kemiri' }}"></div>
                                <div class="form-group"><label class="form-label">Tahun Kepengurusan</label><input type="text" name="year" value="{{ $settings['year'] ?? '2024-2026' }}"></div>
                                <div class="form-group"><label class="form-label">Email Kontak</label><input type="email" name="email" value="{{ $settings['email'] ?? '' }}" placeholder="email@org.com"></div>
                                <div class="form-group"><label class="form-label">No. WhatsApp</label><input type="text" name="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}" placeholder="628xxx"></div>
                                <div class="form-group"><label class="form-label">Total Anggota IPNU (Statistik)</label><input type="number" name="total_anggota_ipnu" value="{{ $settings['total_anggota_ipnu'] ?? '31340' }}" placeholder="31340"></div>
                                <div class="form-group"><label class="form-label">Total Anggota IPPNU (Statistik)</label><input type="number" name="total_anggota_ippnu" value="{{ $settings['total_anggota_ippnu'] ?? '37197' }}" placeholder="37197"></div>
                                <div class="form-group full"><label class="form-label">Alamat Sekretariat</label><textarea name="address" rows="2" placeholder="Alamat lengkap...">{{ $settings['address'] ?? '' }}</textarea></div>
                                
                                <div class="form-group full"><label class="form-label" style="margin-top:16px; border-bottom:1px solid #e2e8f0; padding-bottom:8px;">Pelayanan Sekretariat (Hari &amp; Jam Buka)</label></div>
                                <div class="form-group"><label class="form-label">Hari Kerja (Weekday)</label><input type="text" name="sekre_weekday_days" value="{{ $settings['sekre_weekday_days'] ?? 'Senin - Jumat' }}"></div>
                                <div class="form-group"><label class="form-label">Jam Kerja (Weekday)</label><input type="text" name="sekre_weekday_hours" value="{{ $settings['sekre_weekday_hours'] ?? '09:00 - 16:00' }}"></div>
                                <div class="form-group"><label class="form-label">Hari Sabtu</label><input type="text" name="sekre_sat_days" value="{{ $settings['sekre_sat_days'] ?? 'Sabtu' }}"></div>
                                <div class="form-group"><label class="form-label">Jam Sabtu</label><input type="text" name="sekre_sat_hours" value="{{ $settings['sekre_sat_hours'] ?? '09:00 - 13:00' }}"></div>
                                <div class="form-group"><label class="form-label">Hari Libur</label><input type="text" name="sekre_sun_days" value="{{ $settings['sekre_sun_days'] ?? 'Minggu / Libur' }}"></div>
                                <div class="form-group"><label class="form-label">Jam Libur</label><input type="text" name="sekre_sun_hours" value="{{ $settings['sekre_sun_hours'] ?? 'Sesuai Janji' }}"></div>

                                <div class="form-group full"><label class="form-label" style="margin-top:16px; border-bottom:1px solid #e2e8f0; padding-bottom:8px;">Pengaturan Beranda Utama (Top Hero)</label></div>
                                <div class="form-group"><label class="form-label">Teks Beranda (Judul)</label><input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? '' }}" placeholder="Teks besar di atas..."></div>
                                <div class="form-group"><label class="form-label">Teks Beranda (Subjudul)</label><input type="text" name="hero_subtitle" value="{{ $settings['hero_subtitle'] ?? '' }}" placeholder="Deskripsi di bawah judul..."></div>
                                <div class="form-group"><label class="form-label">Foto Latar Beranda</label><input type="file" name="hero_image" accept="image/*"><small>Biarkan kosong jika tidak ingin mengubah</small></div>

                                <div class="form-group full"><label class="form-label" style="margin-top:16px; border-bottom:1px solid #e2e8f0; padding-bottom:8px;">Pengaturan Berita Utama (Headline Merah)</label></div>
                                <div class="form-group"><label class="form-label">Judul Headline</label><input type="text" name="hk_title" value="{{ $settings['hk_title'] ?? '' }}" placeholder="Hari Santri..."></div>
                                <div class="form-group"><label class="form-label">Deskripsi Headline</label><input type="text" name="hk_desc" value="{{ $settings['hk_desc'] ?? '' }}" placeholder="KEMIRI - ..."></div>
                                <div class="form-group"><label class="form-label">Foto Headline</label><input type="file" name="hk_image" accept="image/*"><small>Biarkan kosong jika tidak mengubah</small></div>
                                
                                <div class="form-group full"><label class="form-label" style="margin-top:16px; border-bottom:1px solid #e2e8f0; padding-bottom:8px;">Pengaturan Banner (Terima Kasih)</label></div>
                                <div class="form-group"><label class="form-label">Judul Banner</label><input type="text" name="banner_thanks_title" value="{{ $settings['banner_thanks_title'] ?? '' }}" placeholder="Terima Kasih..."></div>
                                <div class="form-group"><label class="form-label">Teks Banner</label><input type="text" name="banner_thanks" value="{{ $settings['banner_thanks'] ?? '' }}" placeholder="Deskripsi lengkap..."></div>
                                <div class="form-group"><label class="form-label">Logo Banner</label><input type="file" name="banner_logo" accept="image/*"></div>
                                <div class="form-group"><label class="form-label">Foto Banner 1</label><input type="file" name="banner_image_1" accept="image/*"></div>
                                <div class="form-group"><label class="form-label">Foto Banner 2</label><input type="file" name="banner_image_2" accept="image/*"></div>
                                <div class="form-group"><label class="form-label">Foto Banner 3</label><input type="file" name="banner_image_3" accept="image/*"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-submit" style="margin-top:16px;"><i class="fa-solid fa-floppy-disk"></i> Simpan Pengaturan</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ==========================================
                 SECTION: MANAJEMEN IKLAN
            =========================================== -->
            <div id="section-ads" class="admin-section">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                    <div></div>
                    <button class="btn btn-primary" onclick="openModal('modal-add-ad')">
                        <i class="fa-solid fa-plus"></i> Tambah Iklan
                    </button>
                </div>

                <div class="card">
                    <div class="card-header"><div class="card-header-title">Daftar Iklan & Banner</div></div>
                    <div class="card-body" style="padding:0;">
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Judul & Info Harga</th>
                                        <th>Posisi</th>
                                        <th>Link URL</th>
                                        <th>Status</th>
                                        <th style="text-align:right;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ads as $ad)
                                    <tr>
                                        <td>
                                            @if($ad->image)
                                                <img src="{{ asset('storage/' . $ad->image) }}" alt="Ad Image" style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px;">
                                            @else
                                                <div style="width:80px;height:50px;background:#f1f5f9;border-radius:4px;display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:0.7rem;">Tidak ada</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div style="font-weight:700;">{{ $ad->title }}</div>
                                            <div style="font-size:0.75rem; color:#64748b;">{{ $ad->price_info ?: '-' }}</div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $ad->position == 'top_banner' ? 'badge-amber' : 'badge-blue' }}">
                                                {{ $ad->position == 'top_banner' ? 'Top Banner' : 'Homepage' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($ad->link)
                                                <a href="{{ $ad->link }}" target="_blank" style="color:#2563eb;font-size:0.8rem;"><i class="fa-solid fa-link"></i> Buka Link</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.ads.toggle', $ad) }}" method="POST" style="display:inline;">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="badge {{ $ad->is_active ? 'badge-green' : 'badge-gray' }}" style="border:none; cursor:pointer;">
                                                    {{ $ad->is_active ? 'Aktif' : 'Non-aktif' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td style="text-align:right;">
                                            <button class="btn btn-outline btn-sm btn-icon" title="Edit" onclick="editAd({{ $ad }})"><i class="fa-solid fa-pen"></i></button>
                                            <form action="{{ route('admin.ads.delete', $ad) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus iklan ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="6" style="text-align:center;color:var(--text-light);padding:20px;">Belum ada data iklan.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: CHATBOT -->
            <div id="section-chat" class="admin-section">
                <div class="dash-header">
                    <div>
                        <div class="dash-subtitle">AI Assistant</div>
                        <h2 class="dash-title">AI Chatbot</h2>
                    </div>
                </div>

                <div class="card" style="display:flex;flex-direction:column;height:calc(100vh - 200px);padding:0;overflow:hidden;">
                    <div id="chat-window" class="chat-window" style="flex-grow:1;padding:20px;overflow-y:auto;display:flex;flex-direction:column;gap:15px;background:#f8fafc;">
                        @foreach($chatMessages as $msg)
                            <div class="chat-bubble {{ $msg->author === 'Bot' ? 'bot' : 'user' }}">
                                <strong>{{ $msg->author }}:</strong> {{ $msg->content }}
                            </div>
                        @endforeach
                    </div>
                    <div style="padding:15px;background:#fff;border-top:1px solid #e2e8f0;">
                        <form id="chat-form" class="chat-form" onsubmit="return sendMessage(event);" style="display:flex;gap:10px;">
                            <input type="text" id="message-input" name="message" placeholder="Ketik pesan untuk AI..." required autocomplete="off" style="flex-grow:1;padding:12px;border:1px solid #cbd5e1;border-radius:24px;outline:none;" />
                            <button type="submit" class="send-button" style="background:var(--primary);color:#fff;border:none;padding:10px 24px;border-radius:24px;cursor:pointer;font-weight:600;"><i class="fa-solid fa-paper-plane"></i> Kirim</button>
                        </form>
                    </div>
                </div>
            </div>



        </div>{{-- end content-area --}}
    </div>{{-- end main-area --}}
</div>{{-- end shell --}}

{{-- ════════════════════════════════════
     MODALS
════════════════════════════════════ --}}

<!-- Add Candidate -->
<div id="modal-add-candidate" class="modal-overlay">
    <div class="modal-box modal-box-lg">
        <div class="modal-header mh-green">
            <div><div class="modal-subtitle">Pemilihan Ketua</div><div class="modal-title">Daftarkan Kandidat</div></div>
            <button class="modal-close" onclick="closeModal('modal-add-candidate')">×</button>
        </div>
        <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div style="display:grid;grid-template-columns:140px 1fr;gap:18px;margin-bottom:18px;align-items:start;">
                    <div>
                        <div id="add-photo-preview" onclick="document.getElementById('add-photo-input').click()" class="photo-zone" style="width:130px;height:130px;">
                            <i class="fa-solid fa-camera" style="font-size:1.6rem;color:#94a3b8;"></i>
                            <span style="font-size:0.68rem;color:#94a3b8;font-weight:600;text-align:center;">Upload foto</span>
                        </div>
                        <input type="file" id="add-photo-input" name="photo" accept="image/*" style="display:none;" onchange="previewPhoto(this,'add-photo-preview')">
                    </div>
                    <div style="display:flex;flex-direction:column;gap:12px;">
                        <div class="form-group"><label class="form-label">Nama Lengkap *</label><input type="text" name="name" required placeholder="Nama kandidat..."></div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                            <div class="form-group"><label class="form-label">No. Urut</label><input type="number" name="nomor_urut" min="1"></div>
                            <div class="form-group"><label class="form-label">Jenis Kelamin</label><select name="jenis_kelamin"><option value="">— pilih —</option><option value="L">Laki-laki</option><option value="P">Perempuan</option></select></div>
                        </div>
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px;">
                    <div class="form-group"><label class="form-label">Asal Ranting</label><input type="text" name="asal_ranting" placeholder="PR Karangsari"></div>
                    <div class="form-group"><label class="form-label">Jabatan Sebelumnya</label><input type="text" name="jabatan_sebelumnya" placeholder="Ketua PR"></div>
                    <div class="form-group"><label class="form-label">Angkatan</label><input type="text" name="angkatan" placeholder="2022"></div>
                </div>
                <div class="form-group" style="margin-bottom:12px;"><label class="form-label">Visi *</label><input type="text" name="vision" required placeholder="Visi singkat yang kuat..."></div>
                <div class="form-group"><label class="form-label">Misi / Program Kerja</label><textarea name="mission" rows="3" placeholder="1. Program kerja..."></textarea></div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-add-candidate')" class="btn btn-outline" style="flex:1;">Batal</button>
                <button type="submit" class="btn btn-primary" style="flex:2;justify-content:center;"><i class="fa-solid fa-user-check"></i> Simpan &amp; Daftarkan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Candidate -->
<div id="modal-edit-candidate" class="modal-overlay">
    <div class="modal-box modal-box-lg">
        <div class="modal-header mh-blue">
            <div><div class="modal-subtitle">Edit Data</div><div class="modal-title">Perbarui Kandidat</div></div>
            <button class="modal-close" onclick="closeModal('modal-edit-candidate')">×</button>
        </div>
        <form id="edit-candidate-form" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-body">
                <div style="display:grid;grid-template-columns:140px 1fr;gap:18px;margin-bottom:18px;align-items:start;">
                    <div>
                        <div id="edit-photo-preview" onclick="document.getElementById('edit-photo-input').click()" class="photo-zone" style="width:130px;height:130px;">
                            <i class="fa-solid fa-camera" style="font-size:1.6rem;color:#94a3b8;"></i>
                        </div>
                        <input type="file" id="edit-photo-input" name="photo" accept="image/*" style="display:none;" onchange="previewPhoto(this,'edit-photo-preview')">
                    </div>
                    <div style="display:flex;flex-direction:column;gap:12px;">
                        <div class="form-group"><label class="form-label">Nama *</label><input type="text" name="name" id="ec-name" required></div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                            <div class="form-group"><label class="form-label">No. Urut</label><input type="number" name="nomor_urut" id="ec-nomor"></div>
                            <div class="form-group"><label class="form-label">Jenis Kelamin</label><select name="jenis_kelamin" id="ec-jk"><option value="">—</option><option value="L">Laki-laki</option><option value="P">Perempuan</option></select></div>
                        </div>
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px;">
                    <div class="form-group"><label class="form-label">Asal Ranting</label><input type="text" name="asal_ranting" id="ec-ranting"></div>
                    <div class="form-group"><label class="form-label">Jabatan Sebelumnya</label><input type="text" name="jabatan_sebelumnya" id="ec-jabatan"></div>
                    <div class="form-group"><label class="form-label">Angkatan</label><input type="text" name="angkatan" id="ec-angkatan"></div>
                </div>
                <div class="form-group" style="margin-bottom:12px;"><label class="form-label">Visi *</label><input type="text" name="vision" id="ec-vision" required></div>
                <div class="form-group"><label class="form-label">Misi</label><textarea name="mission" id="ec-mission" rows="3"></textarea></div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-edit-candidate')" class="btn btn-outline" style="flex:1;">Batal</button>
                <button type="submit" class="btn btn-blue" style="flex:2;justify-content:center;"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Article -->
<div id="modal-edit-article" class="modal-overlay">
    <div class="modal-box modal-box-lg">
        <div class="modal-header mh-green">
            <div><div class="modal-subtitle">Edit Artikel</div><div class="modal-title">Perbarui Konten Berita</div></div>
            <button class="modal-close" onclick="closeModal('modal-edit-article')">×</button>
        </div>
        <form id="edit-article-form" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Judul *</label><input type="text" name="title" id="ea-title" required></div>
                    <div class="form-group"><label class="form-label">Penulis</label><input type="text" name="author" id="ea-author"></div>
                    <div class="form-group full"><label class="form-label">Konten *</label><textarea name="content" id="ea-content" rows="8" required></textarea></div>
                    <div class="form-group full"><label class="form-label">Ganti Gambar (Opsional)</label><input type="file" name="image" accept="image/*"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-edit-article')" class="btn btn-outline" style="flex:1;">Batal</button>
                <button type="submit" class="btn btn-primary" style="flex:2;justify-content:center;"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Official -->
<div id="modal-edit-official" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header mh-green">
            <div><div class="modal-subtitle">Edit Pengurus</div><div class="modal-title">Perbarui Data</div></div>
            <button class="modal-close" onclick="closeModal('modal-edit-official')">×</button>
        </div>
        <form id="edit-official-form" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Nama *</label><input type="text" name="name" id="eo-name" required></div>
                    <div class="form-group"><label class="form-label">Jabatan *</label><input type="text" name="position" id="eo-position" required></div>
                    <div class="form-group"><label class="form-label">Kategori</label><select name="type" id="eo-type"><option value="pimpinan">Pimpinan</option><option value="bph">BPH</option></select></div>
                    <div class="form-group"><label class="form-label">Organisasi</label><select name="organization" id="eo-organization"><option value="IPNU">IPNU</option><option value="IPPNU">IPPNU</option></select></div>
                    <div class="form-group"><label class="form-label">Seksi / Bagian</label><input type="text" name="section" id="eo-section" placeholder="cth: Pengurus Harian"></div>
                    <div class="form-group"><label class="form-label">Ganti Foto</label><input type="file" name="photo" accept="image/*"></div>
                    <div class="form-group"><label class="form-label">Tempat, Tanggal Lahir</label><input type="text" name="birth_place_date" id="eo-birth_place_date"></div>
                    <div class="form-group"><label class="form-label">Fokus Gerakan</label><input type="text" name="movement_focus" id="eo-movement_focus"></div>
                    <div class="form-group"><label class="form-label">Masa Khidmat <span style="font-size:0.75rem;font-weight:normal;color:#64748b;margin-left:5px;">(Digunakan untuk tab kategori)</span></label><input type="text" name="service_period" id="eo-service_period" placeholder="cth: 2025-2027"></div>
                    <div class="form-group"><label class="form-label">Motto Hidup</label><input type="text" name="motto" id="eo-motto"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-edit-official')" class="btn btn-outline" style="flex:1;">Batal</button>
                <button type="submit" class="btn btn-primary" style="flex:2;justify-content:center;"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Structure -->
<div id="modal-edit-structure" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header mh-green">
            <div><div class="modal-subtitle">Edit Seksi</div><div class="modal-title">Perbarui Data Struktur</div></div>
            <button class="modal-close" onclick="closeModal('modal-edit-structure')">×</button>
        </div>
        <form id="edit-structure-form" method="POST">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Organisasi *</label><select name="organization" id="es-org"><option value="IPNU">IPNU</option><option value="IPPNU">IPPNU</option></select></div>
                    <div class="form-group"><label class="form-label">Nama Seksi / Jabatan *</label><input type="text" name="section_title" id="es-title" required></div>
                    <div class="form-group"><label class="form-label">Urutan Tampilan</label><input type="number" name="order_num" id="es-order"></div>
                    <div class="form-group full"><label class="form-label">Daftar Pengurus</label><textarea name="content" id="es-content" rows="6"></textarea></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-edit-structure')" class="btn btn-outline" style="flex:1;">Batal</button>
                <button type="submit" class="btn btn-primary" style="flex:2;justify-content:center;"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Statistic -->
<div id="modal-edit-stat" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header mh-amber">
            <div><div class="modal-subtitle">Edit Statistik</div><div class="modal-title">Perbarui Data</div></div>
            <button class="modal-close" onclick="closeModal('modal-edit-stat')">×</button>
        </div>
        <form id="edit-stat-form" method="POST">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Label *</label><input type="text" name="label" id="es-label" required></div>
                    <div class="form-group"><label class="form-label">Nilai *</label><input type="number" name="value" id="es-value" required></div>
                    <div class="form-group full"><label class="form-label">Icon Emoji</label><input type="text" name="icon" id="es-icon" maxlength="10" placeholder="👤 🏫 📚"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-edit-stat')" class="btn btn-outline" style="flex:1;">Batal</button>
                <button type="submit" class="btn btn-accent" style="flex:2;justify-content:center;color:#111;"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Product -->
<div id="modal-edit-product" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header mh-green">
            <div><div class="modal-subtitle">Edit Produk</div><div class="modal-title">Perbarui Data Lapak</div></div>
            <button class="modal-close" onclick="closeModal('modal-edit-product')">×</button>
        </div>
        <form id="edit-product-form" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Nama Produk *</label><input type="text" name="name" id="ep-name" required></div>
                    <div class="form-group"><label class="form-label">Kategori</label><select name="category" id="ep-cat"><option value="Fashion">Fashion</option><option value="Aksesoris">Aksesoris</option><option value="Buku">Buku</option><option value="Makanan">Makanan</option><option value="Minuman">Minuman</option><option value="Jasa">Jasa</option><option value="Lainnya">Lainnya</option></select></div>
                    <div class="form-group"><label class="form-label">Harga (Rp) *</label><input type="number" name="price" id="ep-price" required></div>
                    <div class="form-group"><label class="form-label">Diskon (%)</label><input type="number" name="discount" id="ep-disc" min="0" max="99"></div>
                    <div class="form-group"><label class="form-label">Kondisi</label><select name="condition" id="ep-cond"><option value="Baru">Baru</option><option value="Bekas">Bekas</option><option value="Pre-order">Pre-order</option></select></div>
                    <div class="form-group"><label class="form-label">Stok</label><input type="number" name="stock" id="ep-stock" min="0"></div>
                    <div class="form-group"><label class="form-label">Terjual</label><input type="number" name="sold_count" id="ep-sold" min="0"></div>
                    <div class="form-group"><label class="form-label">Rating (1-5)</label><input type="number" step="0.1" name="rating" id="ep-rating" min="1" max="5"></div>
                    <div class="form-group full"><label class="form-label">Deskripsi Produk</label><textarea name="description" id="ep-desc" rows="3"></textarea></div>
                    <div class="form-group"><label class="form-label">Lokasi</label><input type="text" name="location" id="ep-loc"></div>
                    <div class="form-group"><label class="form-label">Link WhatsApp</label><input type="text" name="wa_link" id="ep-wa"></div>
                    <div class="form-group full"><label class="form-label">Ganti Foto</label><input type="file" name="image" accept="image/*"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-edit-product')" class="btn btn-outline" style="flex:1;">Batal</button>
                <button type="submit" class="btn btn-primary" style="flex:2;justify-content:center;"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Gallery -->
<div id="modal-edit-gallery" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header mh-green">
            <div><div class="modal-subtitle">Edit Foto</div><div class="modal-title">Perbarui Info Galeri</div></div>
            <button class="modal-close" onclick="closeModal('modal-edit-gallery')">×</button>
        </div>
        <form id="edit-gallery-form" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Judul *</label><input type="text" name="title" id="eg-title" required></div>
                    <div class="form-group"><label class="form-label">Kategori</label><select name="category" id="eg-cat"><option value="Umum">Umum</option><option value="Kegiatan">Kegiatan</option><option value="Rapat">Rapat</option><option value="Lomba">Lomba</option><option value="Sosial">Sosial</option><option value="Lainnya">Lainnya</option></select></div>
                    <div class="form-group full"><label class="form-label">Ganti Foto (Opsional)</label><input type="file" name="image" accept="image/*"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-edit-gallery')" class="btn btn-outline" style="flex:1;">Batal</button>
                <button type="submit" class="btn btn-primary" style="flex:2;justify-content:center;"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Advertisement -->
<div id="modal-add-ad" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header mh-green">
            <div><div class="modal-subtitle">Manajemen Iklan</div><div class="modal-title">Tambah Iklan Baru</div></div>
            <button class="modal-close" onclick="closeModal('modal-add-ad')">×</button>
        </div>
        <form action="{{ route('admin.ads.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group full"><label class="form-label">Judul Iklan *</label><input type="text" name="title" required placeholder="Pasang Iklan di Web"></div>
                    <div class="form-group"><label class="form-label">Harga / Keterangan Tambahan</label><input type="text" name="price_info" placeholder="Rp500.000 / 3 Bulan"></div>
                    <div class="form-group"><label class="form-label">Posisi Iklan *</label><select name="position"><option value="homepage">Homepage (Bawah Berita)</option><option value="top_banner">Top Banner (Atas Layar)</option></select></div>
                    <div class="form-group full"><label class="form-label">Teks Tombol / Deskripsi</label><input type="text" name="description" placeholder="KLIK BANNER INI UNTUK INFORMASI LEBIH LANJUT"></div>
                    <div class="form-group full"><label class="form-label">Link Tujuan URL (Opsional)</label><input type="url" name="link" placeholder="https://wa.me/62..."></div>
                    <div class="form-group full"><label class="form-label">Gambar Banner (Khusus Homepage)</label><input type="file" name="image" accept="image/*"></div>
                    <div class="form-group full">
                        <label class="form-label" style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                            <input type="checkbox" name="is_active" checked style="width:18px; height:18px;"> Tampilkan Iklan Ini Sekarang
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-add-ad')" class="btn btn-outline" style="flex:1;">Batal</button>
                <button type="submit" class="btn btn-primary" style="flex:2;justify-content:center;"><i class="fa-solid fa-floppy-disk"></i> Simpan Iklan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Advertisement -->
<div id="modal-edit-ad" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header mh-amber">
            <div><div class="modal-subtitle">Manajemen Iklan</div><div class="modal-title">Edit Iklan</div></div>
            <button class="modal-close" onclick="closeModal('modal-edit-ad')">×</button>
        </div>
        <form id="edit-ad-form" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group full"><label class="form-label">Judul Iklan *</label><input type="text" name="title" id="ea-ad-title" required></div>
                    <div class="form-group"><label class="form-label">Harga / Keterangan Tambahan</label><input type="text" name="price_info" id="ea-price_info"></div>
                    <div class="form-group"><label class="form-label">Posisi Iklan *</label><select name="position" id="ea-position"><option value="homepage">Homepage (Bawah Berita)</option><option value="top_banner">Top Banner (Atas Layar)</option></select></div>
                    <div class="form-group full"><label class="form-label">Teks Tombol / Deskripsi</label><input type="text" name="description" id="ea-desc"></div>
                    <div class="form-group full"><label class="form-label">Link Tujuan URL (Opsional)</label><input type="url" name="link" id="ea-link"></div>
                    <div class="form-group full"><label class="form-label">Ganti Gambar (Opsional)</label><input type="file" name="image" accept="image/*"></div>
                    <div class="form-group full">
                        <label class="form-label" style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                            <input type="checkbox" name="is_active" id="ea-active" style="width:18px; height:18px;"> Tampilkan Iklan Ini Sekarang
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-edit-ad')" class="btn btn-outline" style="flex:1;">Batal</button>
                <button type="submit" class="btn btn-accent" style="flex:2;justify-content:center;color:#111;"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    /* ═══════ SECTION SWITCHING ═══════ */
    const pageTitles = {
        voting: { title:'Dashboard Voting', breadcrumb:'Pemilihan' },
        candidates: { title:'Kelola Kandidat', breadcrumb:'Pemilihan' },
        history: { title:'Profil Organisasi', breadcrumb:'Profil' },
        officials: { title:'Nahkoda Pimpinan', breadcrumb:'Profil' },
        structures: { title:'Struktur Kepengurusan', breadcrumb:'Profil' },
        news: { title:'Berita & Artikel', breadcrumb:'Konten' },
        stats: { title:'Statistik Anggota', breadcrumb:'Konten' },
        agendas: { title:'Agenda Kegiatan', breadcrumb:'Konten' },
        gallery: { title:'Galeri Dokumentasi', breadcrumb:'Konten' },
        lapak: { title:'Lapak Usaha', breadcrumb:'Layanan' },
        feedbacks: { title:'Laporan Masuk', breadcrumb:'Interaksi' },
        registrations: { title:'Pendaftar Baru', breadcrumb:'Interaksi' },
        settings: { title:'Pengaturan Portal', breadcrumb:'Admin' },
        ads: { title:'Manajemen Iklan', breadcrumb:'Admin' },
    };

    function switchSection(id) {
        document.querySelectorAll('.admin-section').forEach(s => s.classList.remove('active'));
        document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
        const sec = document.getElementById('section-' + id);
        const nav = document.getElementById('nav-' + id);
        if (sec) sec.classList.add('active');
        if (nav) nav.classList.add('active');
        if (pageTitles[id]) {
            document.getElementById('page-title-text').textContent = pageTitles[id].title;
            document.getElementById('page-breadcrumb').textContent = pageTitles[id].breadcrumb;
        }
        // on mobile: close sidebar after selection
        if (window.innerWidth <= 900) closeSidebar();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    /* ═══════ SIDEBAR (MOBILE ONLY) ═══════ */
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebar-overlay').classList.toggle('active');
        document.body.style.overflow = document.getElementById('sidebar').classList.contains('open') ? 'hidden' : '';
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebar-overlay').classList.remove('active');
        document.body.style.overflow = '';
    }

    /* ═══════ MODALS ═══════ */
    function openModal(id) { document.getElementById(id).classList.add('open'); document.body.style.overflow='hidden'; }
    function closeModal(id) { document.getElementById(id).classList.remove('open'); document.body.style.overflow=''; }
    document.querySelectorAll('.modal-overlay').forEach(m => m.addEventListener('click', e => { if(e.target===m) closeModal(m.id); }));

    /* ═══════ PHOTO PREVIEW ═══════ */
    function previewPhoto(input, previewId) {
        if (!input.files?.[0]) return;
        const reader = new FileReader();
        reader.onload = e => {
            const el = document.getElementById(previewId);
            el.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;border-radius:8px;">`;
            el.classList.add('has-photo');
        };
        reader.readAsDataURL(input.files[0]);
    }

    /* ═══════ CANDIDATE MODAL ═══════ */
    function editCandidate(c) {
        document.getElementById('ec-name').value = c.name||'';
        document.getElementById('ec-vision').value = c.vision||'';
        document.getElementById('ec-mission').value = c.mission||'';
        document.getElementById('ec-nomor').value = c.nomor_urut||'';
        document.getElementById('ec-ranting').value = c.asal_ranting||'';
        document.getElementById('ec-jabatan').value = c.jabatan_sebelumnya||'';
        document.getElementById('ec-angkatan').value = c.angkatan||'';
        document.getElementById('ec-jk').value = c.jenis_kelamin||'';
        const prev = document.getElementById('edit-photo-preview');
        if (c.photo) { prev.innerHTML=`<img src="/storage/${c.photo}" style="width:100%;height:100%;object-fit:cover;border-radius:8px;">`; prev.classList.add('has-photo'); }
        else { prev.innerHTML='<i class="fa-solid fa-camera" style="font-size:1.6rem;color:#94a3b8;"></i>'; prev.classList.remove('has-photo'); }
        document.getElementById('edit-candidate-form').action = `/admin/candidates/${c.id}`;
        openModal('modal-edit-candidate');
    }

    /* ═══════ ARTICLE MODAL ═══════ */
    function editArticle(a) {
        document.getElementById('ea-title').value = a.title||'';
        document.getElementById('ea-author').value = a.author||'';
        document.getElementById('ea-content').value = a.content||'';
        document.getElementById('edit-article-form').action = `/admin/articles/${a.id}`;
        openModal('modal-edit-article');
    }

    /* ═══════ OFFICIAL MODAL ═══════ */
    function openEditOfficial(o) {
        document.getElementById('eo-name').value = o.name||'';
        document.getElementById('eo-position').value = o.position||'';
        document.getElementById('eo-type').value = o.type||'bph';
        document.getElementById('eo-birth_place_date').value = o.birth_place_date||'';
        document.getElementById('eo-movement_focus').value = o.movement_focus||'';
        document.getElementById('eo-service_period').value = o.service_period||'';
        document.getElementById('eo-motto').value = o.motto||'';
        document.getElementById('eo-organization').value = o.organization||'IPNU';
        document.getElementById('eo-section').value = o.section||'';
        document.getElementById('edit-official-form').action = `/admin/officials/${o.id}`;
        openModal('modal-edit-official');
    }

    /* ═══════ STRUCTURE MODAL ═══════ */
    function openEditStructure(s) {
        document.getElementById('es-org').value = s.organization||'IPNU';
        document.getElementById('es-title').value = s.section_title||'';
        document.getElementById('es-order').value = s.order_num||0;
        document.getElementById('es-content').value = s.content||'';
        document.getElementById('edit-structure-form').action = `/admin/structures/${s.id}`;
        openModal('modal-edit-structure');
    }

    /* ═══════ STAT MODAL ═══════ */
    function openEditStat(s) {
        document.getElementById('es-label').value = s.label||'';
        document.getElementById('es-value').value = s.value||'';
        document.getElementById('es-icon').value = s.icon||'';
        document.getElementById('edit-stat-form').action = `/admin/stats/${s.id}`;
        openModal('modal-edit-stat');
    }

    /* ═══════ PRODUCT MODAL ═══════ */
    function openEditProduct(p) {
        document.getElementById('ep-name').value = p.name||'';
        document.getElementById('ep-cat').value = p.category||'Lainnya';
        document.getElementById('ep-price').value = p.price||'';
        document.getElementById('ep-disc').value = p.discount||0;
        document.getElementById('ep-cond').value = p.condition||'Baru';
        document.getElementById('ep-stock').value = p.stock||0;
        document.getElementById('ep-sold').value = p.sold_count||0;
        document.getElementById('ep-rating').value = p.rating||5.0;
        document.getElementById('ep-desc').value = p.description||'';
        document.getElementById('ep-loc').value = p.location||'';
        document.getElementById('ep-wa').value = p.wa_link||'';
        document.getElementById('edit-product-form').action = `/admin/products/${p.id}`;
        openModal('modal-edit-product');
    }

    /* ═══════ GALLERY MODAL ═══════ */
    function openEditGallery(g) {
        document.getElementById('eg-title').value = g.title||'';
        document.getElementById('eg-cat').value = g.category||'Umum';
        document.getElementById('edit-gallery-form').action = `/admin/gallery/${g.id}`;
        openModal('modal-edit-gallery');
    }

    /* ═══════ ADVERTISEMENT MODAL ═══════ */
    function editAd(ad) {
        document.getElementById('ea-ad-title').value = ad.title||'';
        document.getElementById('ea-price_info').value = ad.price_info||'';
        document.getElementById('ea-position').value = ad.position||'homepage';
        document.getElementById('ea-desc').value = ad.description||'';
        document.getElementById('ea-link').value = ad.link||'';
        document.getElementById('ea-active').checked = ad.is_active;
        document.getElementById('edit-ad-form').action = `/admin/ads/${ad.id}`;
        openModal('modal-edit-ad');
    }

    /* ═══════ GALLERY FILTER ═══════ */
    function filterGallery(cat, btn) {
        document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('#gallery-grid .gal-item').forEach(item => {
            item.style.display = (cat === 'all' || item.dataset.category === cat) ? '' : 'none';
        });
    }

    /* ═══════ REALTIME VOTING ═══════ */
    let rtCountdown = 5;
    function startRTCountdown() {
        const el = document.getElementById('countdown-num');
        rtCountdown = 5;
        const t = setInterval(() => {
            rtCountdown--;
            if (el) el.innerText = rtCountdown;
            if (rtCountdown <= 0) { clearInterval(t); fetchResults(); }
        }, 1000);
    }

    function fetchResults() {
        fetch("{{ route('admin.realtime-results') }}")
            .then(r => r.json())
            .then(data => {
                const total = data.totalVotes;
                ['sv-total','total-votes-nav'].forEach(id => { const el=document.getElementById(id); if(el) el.innerText=total; });
                data.candidates.forEach((c, idx) => {
                    const pct = total > 0 ? Math.round((c.votes_count/total)*1000)/10 : 0;
                    const h = total > 0 ? Math.max(65, (c.votes_count/total)*240) : 65;
                    const pv = document.getElementById('pv-'+c.id); if(pv) pv.innerText=c.votes_count;
                    const pp = document.getElementById('pp-'+c.id); if(pp) pp.innerText=pct+'%';
                    const podItem = document.getElementById('podium-'+c.id);
                    if(podItem) { const bar = podItem.querySelector('.podium-bar'); if(bar) bar.style.height=h+'px'; }
                    const df = document.getElementById('df-'+c.id); if(df) df.style.width=pct+'%';
                    const dp = document.getElementById('dp-'+c.id); if(dp) dp.innerText=pct+'%';
                });
                startRTCountdown();
            })
            .catch(() => startRTCountdown());
    }

    // Init
    startRTCountdown();
</script>
<script src="{{ asset('js/chat.js') }}"></script>
</body>
</html>

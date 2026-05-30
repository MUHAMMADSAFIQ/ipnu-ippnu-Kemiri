<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Resmi IPNU-IPPNU Kemiri</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">

    <style>
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
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --transition: all 0.3s ease;
        }

        /* Top Utility Bar */
        /* Top Utility Bar - Dynamic Theme */
        .top-utility-bar {
            background: linear-gradient(90deg, var(--primary-dark) 0%, var(--primary) 50%, var(--primary-dark) 100%);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.85rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .tub-container {
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 6px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .tub-left {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .tub-logo {
            width: 18px;
            height: 18px;
            color: rgba(255, 255, 255, 0.8);
        }

        .tub-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tub-btn {
            background: #facc15;
            color: #000;
            padding: 4px 14px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.2s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 0.8rem;
        }

        .tub-btn:hover {
            background: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .tub-icon {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            color: white;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .tub-icon:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-1px);
        }

        /* Circular Theme Picker Menu */
        .theme-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
            display: none;
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .theme-circle-container {
            position: relative;
            width: 300px;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .theme-center-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #00bcd4;
            color: white;
            border: 4px solid rgba(255, 255, 255, 0.3);
            font-size: 24px;
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease;
        }

        .theme-center-btn:hover {
            transform: scale(1.1) rotate(90deg);
        }

        .theme-option-btn {
            position: absolute;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid white;
            color: white;
            font-weight: 800;
            font-size: 0.85rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .theme-option-btn:hover {
            transform: scale(1.2);
            box-shadow: 0 0 15px white;
        }

        /* Positioning the 8 buttons in a circle */
        .theme-opt-1 {
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background: rgb(21, 128, 61);
        }

        .theme-opt-2 {
            top: 15%;
            right: 15%;
            background: rgb(234, 88, 12);
        }

        .theme-opt-3 {
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            background: rgb(225, 29, 72);
        }

        .theme-opt-4 {
            bottom: 15%;
            right: 15%;
            background: rgb(37, 99, 235);
        }

        .theme-opt-5 {
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background: rgb(13, 148, 136);
        }

        .theme-opt-6 {
            bottom: 15%;
            left: 15%;
            background: rgb(217, 119, 6);
        }

        .theme-opt-7 {
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            background: rgb(220, 38, 38);
        }

        .theme-opt-8 {
            top: 15%;
            left: 15%;
            background: rgb(124, 58, 237);
        }

        .theme-circle-svg {
            position: absolute;
            width: 220px;
            height: 220px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            pointer-events: none;
        }

        * {
            margin: 0;
            padding: 0;
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

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            line-height: 1.2;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 16px;
            width: 100%;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            z-index: 1000;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }

        .logo {
            font-family: 'Outfit', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 1001;
            position: relative;
        }

        .logo span {
            color: var(--accent);
        }

        .nav-links {
            display: flex;
            gap: 24px;
            list-style: none;
            align-items: center;
        }

        .nav-link {
            font-weight: 500;
            font-size: 0.95rem;
            color: var(--text-dark);
            transition: var(--transition);
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary);
            transition: var(--transition);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 28px;
            font-weight: 600;
            border-radius: 50px;
            transition: var(--transition);
            cursor: pointer;
            border: none;
            font-family: 'Inter', sans-serif;
            text-align: center;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 4px 14px rgba(0, 105, 92, 0.3);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 105, 92, 0.4);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }

        .btn-white {
            background-color: white;
            color: var(--primary-dark);
        }

        .btn-white:hover {
            background-color: var(--bg-light);
            transform: translateY(-2px);
        }

        /* Mobile Menu Toggle */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            z-index: 1001;
            position: relative;
        }

        .hamburger {
            display: block;
            width: 24px;
            height: 2px;
            background: var(--primary-dark);
            position: relative;
            transition: var(--transition);
        }

        .hamburger::before,
        .hamburger::after {
            content: '';
            position: absolute;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--primary-dark);
            transition: var(--transition);
        }

        .hamburger::before {
            top: -8px;
        }

        .hamburger::after {
            bottom: -8px;
        }

        .mobile-toggle.active .hamburger {
            background: transparent;
        }

        .mobile-toggle.active .hamburger::before {
            top: 0;
            transform: rotate(45deg);
        }

        .mobile-toggle.active .hamburger::after {
            bottom: 0;
            transform: rotate(-45deg);
        }

        /* Generic Section Styles */
        .section {
            padding: 100px 0;
        }

        .bg-white {
            background-color: var(--bg-white);
        }

        .bg-light {
            background-color: var(--bg-light);
        }

        .section-header {
            text-align: center;
            margin-bottom: 64px;
        }

        .section-title {
            font-size: 2.5rem;
            color: var(--primary-dark);
            margin-bottom: 16px;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background-color: var(--accent);
            border-radius: 2px;
        }

        .section-subtitle {
            font-size: 1.125rem;
            color: var(--text-light);
            max-width: 600px;
            margin: 16px auto 0;
        }

        /* Hero */
        /* Old Hero Reset */
        .hero-new {
            padding: 0;
            margin: 0;
        }

        .hero-bg-container {
            position: relative;
            overflow: hidden;
            height: 220px;
            /* Removed !important */
            min-height: 220px;
            background: var(--primary-dark);
        }

        .hero-bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .hero-overlay-dark {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary-dark);
            opacity: 0.7;
            z-index: 1;
        }

        .hero-content-center {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 5;
            text-align: center;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px 15px 20px 15px;
            /* Added more top padding to prevent clipping */
            background: rgba(0, 0, 0, 0.4);
        }

        .logo-3d {
            height: 90px !important;
            width: auto !important;
            object-fit: contain;
            animation: logoRotate3D 8s linear infinite;
            filter: drop-shadow(0 4px 15px rgba(0, 0, 0, 0.6));
            margin-bottom: 12px;
            display: block !important;
            flex-shrink: 0;
            transform-style: preserve-3d;
        }

        .hero-title-center {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1.8rem;
            letter-spacing: 1px;
            margin-bottom: 4px;
            text-transform: uppercase;
            color: #fff;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .hero-subtitle-center {
            font-size: 0.85rem;
            font-weight: 800;
            color: #facc15;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
        }

        /* Features Grid */
        .hero-features-grid-container {
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 3;
            padding: 10px;
        }

        .hero-features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(8px);
            padding: 10px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .h-feature-card {
            background: white;
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 16px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            text-decoration: none;
        }

        .h-feature-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .h-feature-icon {
            font-size: 1.8rem;
            margin-bottom: 8px;
            display: block;
        }

        /* Colorful Gradient Icons for Hero Features */
        /* Green Gradients for Hero Features */
        .h-feature-card:nth-child(1) .h-feature-icon {
            background: -webkit-linear-gradient(45deg, #15803d, #22c55e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .h-feature-card:nth-child(2) .h-feature-icon {
            background: -webkit-linear-gradient(45deg, #166534, #15803d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .h-feature-card:nth-child(3) .h-feature-icon {
            background: -webkit-linear-gradient(45deg, #14532d, #166534);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .h-feature-card:nth-child(4) .h-feature-icon {
            background: -webkit-linear-gradient(45deg, #15803d, #4ade80);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .h-feature-card:nth-child(5) .h-feature-icon {
            background: -webkit-linear-gradient(45deg, #16a34a, #15803d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .h-feature-card:nth-child(6) .h-feature-icon {
            background: -webkit-linear-gradient(45deg, #15803d, #facc15);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .h-feature-card:nth-child(7) .h-feature-icon {
            background: -webkit-linear-gradient(45deg, #14532d, #15803d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .h-feature-text {
            font-weight: 600;
            color: #374151;
            font-size: 0.9rem;
            line-height: 1.3;
        }

        @media (max-width: 768px) {
            .hero-bg-container {
                height: 350px;
            }

            .hero-title-center {
                font-size: 1.8rem;
            }

            .hero-features-grid {
                grid-template-columns: repeat(3, 1fr) !important;
            }

            .logo-3d {
                height: 80px !important;
                width: auto !important;
            }
        }

        @media (max-width: 480px) {
            .hero-features-grid {
                grid-template-columns: repeat(3, 1fr) !important;
            }
        }

        /* Jadwal Shalat Section */
        .prayer-section {
            padding: 40px 0;
            background: var(--bg-light);
            margin-top: 20px;
            position: relative;
            z-index: 10;
        }

        .prayer-container {
            background: white;
            border-radius: 16px;
            border: 1px solid rgba(229, 231, 235, 0.5);
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            max-width: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .prayer-container::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle at top right, rgba(21, 128, 61, 0.05), transparent);
            pointer-events: none;
        }

        .prayer-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
        }

        .prayer-icon {
            width: 90px;
            height: 90px;
            flex-shrink: 0;
        }

        .prayer-title-box h4 {
            font-size: 1.15rem;
            font-weight: 800;
            margin: 0 0 4px 0;
            color: #111;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: 'Inter', sans-serif;
        }

        .prayer-region {
            color: var(--primary);
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 12px;
        }

        .prayer-date-text {
            color: #4b5563;
            font-size: 0.95rem;
        }

        .prayer-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .prayer-card {
            background: white;
            border: 1px solid var(--primary-light);
            border-radius: 8px;
            padding: 16px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .prayer-card::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='50' viewBox='0 0 100 50' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10,50 L10,30 L15,30 L15,20 L25,20 L25,30 L30,30 L30,50 Z M70,50 L70,30 L75,30 L75,20 L85,20 L85,30 L90,30 L90,50 Z' fill='%23e5e7eb' opacity='0.7'/%3E%3C/svg%3E");
            background-size: contain;
            background-position: center bottom;
            background-repeat: no-repeat;
            z-index: 0;
            pointer-events: none;
        }

        .prayer-card-inner {
            position: relative;
            z-index: 1;
        }

        .p-name {
            color: var(--primary);
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 4px;
        }

        .p-time {
            color: #111;
            font-weight: 500;
            font-size: 1.05rem;
        }

        @media (max-width: 768px) {
            .prayer-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .prayer-header {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .prayer-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Profil Section */
        .profil-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: start;
        }

        .profil-card {
            background: white;
            padding: 40px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            border-top: 4px solid var(--primary);
            transition: var(--transition);
        }

        .profil-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .profil-card h3 {
            color: var(--primary);
            font-size: 1.8rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profil-card p {
            margin-bottom: 16px;
            color: var(--text-light);
            font-size: 1.05rem;
        }

        .profil-list {
            list-style: none;
        }

        .profil-list li {
            margin-bottom: 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            color: var(--text-dark);
            font-weight: 500;
        }

        .profil-list li::before {
            content: '✓';
            color: white;
            background: var(--accent);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Agenda Section */
        .agenda-list {
            display: flex;
            flex-direction: column;
            gap: 24px;
            max-width: 100%;
            margin: 0;
        }

        .agenda-item {
            display: flex;
            background: white;
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            border-left: 4px solid var(--accent);
        }

        .agenda-item:hover {
            transform: translateX(10px);
            box-shadow: var(--shadow-md);
            border-left-color: var(--primary);
        }

        /* ===== SIDEBAR KIRI (IPNU KEMIRI STYLE) ===== */
        .desktop-left {
            background: white;
            border-right: 1px solid #e2e8f0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            /* Let inner wrapper handle scroll */
        }

        .hero-new {
            position: relative;
            padding: 0 !important;
            margin: 0 !important;
            overflow: hidden;
            background: #000;
        }

        .hero-bg-container {
            height: 220px;
            position: relative;
            overflow: hidden;
        }

        .hero-bg-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.7);
        }

        .hero-overlay-dark {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.7));
        }

        .hero-content-center {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            text-align: center;
            z-index: 10;
            padding: 0 15px;
        }

        .desktop-left .logo-container {
            margin-bottom: 8px;
            display: flex;
            justify-content: center;
        }

        .desktop-left .logo-3d {
            height: 50px;
            width: auto;
            border: none;
            background: transparent;
            border-radius: 0;
            box-shadow: none;
        }

        .desktop-left .hero-title-center {
            font-size: 1.1rem;
            font-weight: 800;
            color: white;
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .desktop-left .hero-subtitle-center {
            font-size: 0.75rem;
            color: #facc15;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-new {
            background: #fff;
            border-radius: 0;
            border: none;
            border-bottom: 3px solid var(--primary);
            display: block;
            position: relative;
            margin-bottom: 0;
            flex-shrink: 0;
            /* Prevent from shrinking vertically in the flex sidebar */
        }

        .hero-bg-container {
            position: relative;
            height: 280px !important;
            /* Aligned with middle column dc-banner height */
            overflow: hidden;
            border-bottom: 3px solid var(--primary);
            transition: height 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .hero-bg-container.shrunk {
            height: 140px !important;
        }

        .hero-bg-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay-dark {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.6) !important;
            /* Full dark overlay */
        }

        .hero-content-center {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* Center vertically since height is reduced */
            color: white;
            z-index: 2;
            text-align: center;
            padding: 20px;
            background: transparent !important;
            /* Removed gradient so overlay is uniform */
            transform: none;
            /* Override leaked translateY(-50%) from older CSS block */
        }

        /* logo-3d styles moved up */

        .logo-3d.shrunk {
            height: 45px !important;
            width: auto !important;
            margin-bottom: 4px;
            border: none;
            padding: 0;
            background: transparent;
        }

        @keyframes logoRotate3D {
            0% {
                transform: rotateY(0deg);
            }

            100% {
                transform: rotateY(360deg);
            }
        }

        .hero-title-center {
            font-size: 1.1rem;
            /* Slightly larger title */
            font-weight: 900;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.6);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hero-title-center.shrunk {
            font-size: 0.9rem;
            margin-bottom: 2px;
        }

        .hero-subtitle-center {
            font-size: 0.8rem;
            /* Slightly larger subtitle */
            font-weight: 700;
            opacity: 1;
            color: var(--accent);
            /* Using accent color for better contrast */
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
            letter-spacing: 1px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hero-subtitle-center.shrunk {
            font-size: 0.65rem;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .hero-features-grid-container {
            background: #e5e7eb;
            padding: 6px;
            border-top: 1px solid #d1d5db;
        }

        .hero-features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 5px;
        }

        .h-feature-card {
            background: white;
            padding: 14px 4px 10px;
            text-align: center;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .h-feature-card:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }

        /* No bubble wrapper — icons are flat colored */
        .h-feature-icon-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .h-feature-icon {
            font-size: 1.6rem;
        }

        /* Per-card icon colors matching reference */
        .h-feature-card:nth-child(1) .h-feature-icon {
            color: #16a34a;
        }

        .h-feature-card:nth-child(2) .h-feature-icon {
            color: #ea580c;
        }

        .h-feature-card:nth-child(3) .h-feature-icon {
            color: #2563eb;
        }

        .h-feature-card:nth-child(4) .h-feature-icon {
            color: #dc2626;
        }

        .h-feature-card:nth-child(5) .h-feature-icon {
            color: #d97706;
        }

        .h-feature-card:nth-child(6) .h-feature-icon {
            color: #f59e0b;
        }

        .h-feature-card:nth-child(7) .h-feature-icon {
            color: #dc2626;
        }

        .h-feature-card:nth-child(8) .h-feature-icon {
            color: #ca8a04;
        }

        .h-feature-card:nth-child(9) .h-feature-icon {
            color: #dc2626;
        }

        .h-feature-text {
            font-size: 0.6rem;
            font-weight: 700;
            color: #374151;
            line-height: 1.3;
            text-align: center;
        }

        .dl-menu {
            background: #fff;
            border-top: 1px solid #e5e7eb;
            overflow: hidden;
            margin-top: 0;
            display: block;
            position: relative;
            z-index: 5;
        }

        .dl-menu a {
            display: flex;
            align-items: center;
            padding: 11px 16px;
            color: #1e293b;
            font-weight: 700;
            border-bottom: 1px solid #e5e7eb;
            text-decoration: none;
            font-size: 0.84rem;
            transition: all 0.2s;
            background: white;
        }

        .dl-menu a::before {
            content: '\f054';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-right: 12px;
            color: var(--primary);
            font-size: 0.8rem;
            transition: transform 0.2s;
        }

        .dl-menu a:hover {
            background: #f8fafc;
            color: var(--primary);
            padding-left: 20px;
        }

        .dl-menu a:hover::before {
            transform: translateX(3px);
        }

        .dl-menu a:last-child {
            border-bottom: none;
        }


        /* New Berita Section (Krandegan Style) */
        .krandegan-news-container {
            width: 100%;
            max-width: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif;
        }

        .headline-normal {
            display: flex;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .headline-left {
            flex: 1;
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .headline-label {
            background: var(--accent);
            color: #111;
            padding: 4px 12px;
            font-size: 0.75rem;
            font-weight: 800;
            display: inline-block;
            align-self: flex-start;
            margin-bottom: 12px;
            border-radius: 4px;
        }

        .headline-title {
            font-size: 1.4rem;
            font-weight: 800;
            color: #111;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .headline-desc {
            font-size: 0.9rem;
            color: #4b5563;
            line-height: 1.6;
            margin: 0;
        }

        .headline-right {
            width: 40%;
            min-height: 250px;
        }

        .headline-right img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .headline-normal {
                flex-direction: column-reverse;
            }

            .headline-right {
                width: 100%;
                min-height: 200px;
            }
        }

        .nh-wrapper {
            position: relative;
            margin-bottom: 8px;
            border-radius: 0;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            border: 1px solid #d1d5db;
            display: flex;
            flex-direction: column;
            background: white;
        }

        .nh-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }

        .nh-header {
            background: var(--primary);
            opacity: 0.95;
            padding: 16px 20px;
            color: white;
            z-index: 2;
            border-bottom: 3px solid var(--primary-dark);
        }

        .nh-label {
            color: var(--accent);
            font-weight: 900;
            font-size: 1.2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            display: block;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }

        .nh-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 0 6px 0;
            line-height: 1.3;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .nh-subtitle {
            font-size: 0.85rem;
            opacity: 0.9;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .na-wrapper {
            background: white;
            border: 1px solid #d1d5db;
            margin-bottom: 8px;
        }

        .na-header {
            background: var(--primary);
            padding: 8px 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .na-header span {
            font-weight: 800;
            font-size: 0.85rem;
            color: white;
            text-transform: uppercase;
        }

        .na-icons {
            display: flex;
            gap: 4px;
            color: white;
            opacity: 0.8;
            font-size: 0.8rem;
        }

        .na-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2px;
            background: #d1d5db;
        }

        .na-card {
            background: white;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
        }

        .na-card:hover {
            opacity: 0.95;
        }

        .na-img-wrapper {
            position: relative;
            width: 100%;
            height: 180px;
            overflow: hidden;
        }

        .na-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .na-date-badge {
            position: absolute;
            bottom: 0;
            left: 0;
            display: flex;
            align-items: center;
            background: #15803d;
            color: white;
            font-size: 0.72rem;
            font-weight: 700;
            z-index: 5;
        }

        .na-day {
            background: #ef4444;
            /* Orange/Red in Krandegan */
            padding: 4px 8px;
            color: white;
        }

        /* Article Image Shutter Effect */
        .na-img-wrapper::before,
        .na-img-wrapper::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 0;
            background: rgba(0, 0, 0, 0.5);
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1;
        }

        .na-img-wrapper::before {
            left: 0;
        }

        .na-img-wrapper::after {
            right: 0;
        }

        .na-card:hover .na-img-wrapper::before,
        .na-card:hover .na-img-wrapper::after {
            width: 50%;
        }

        .hover-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            color: white;
            font-size: 2rem;
            z-index: 2;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
        }

        .na-card:hover .hover-icon {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }

        .na-month {
            padding: 4px 10px;
            text-transform: capitalize;
        }

        .na-content {
            padding: 12px 14px;
            flex: 1;
        }

        .na-title {
            font-size: 0.88rem;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.4;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-decoration: none;
        }

        .na-title:hover {
            color: var(--primary);
        }

        .na-meta {
            font-size: 0.72rem;
            color: #64748b;
            font-weight: 600;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .na-meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .na-card-footer {
            border-top: 1px solid #e2e8f0;
            padding: 8px;
            text-align: center;
            background: #f8fafc;
        }

        .na-card-link {
            color: #1e293b;
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        /* Pagination Krandegan Style */
        .na-pagination {
            background: var(--primary);
            /* Matching Krandegan footer bar */
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .pg-buttons {
            display: flex;
            gap: 4px;
        }

        .pg-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 4px 10px;
            text-decoration: none;
            font-size: 0.75rem;
            transition: all 0.2s;
        }

        .pg-btn:hover {
            background: white;
            color: var(--primary);
        }

        .pg-btn.active {
            background: white;
            color: var(--primary);
        }

        .na-link-btn {
            border: 2px solid #e2e8f0;
            font-size: 0.75rem;
            text-transform: uppercase;
        }

        .na-link-btn:hover {
            background: var(--text-dark);
            color: var(--accent);
            border-color: var(--text-dark);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px var(--primary);
        }

        @media (min-width: 1024px) {
            .na-list {
                grid-template-columns: repeat(2, 1fr);
            }

            .na-img {
                height: 200px;
            }
        }

        /* Dashboard Layout Additions */
        .desktop-layout {
            display: flex;
            flex-direction: column;
        }

        .desktop-left {
            display: flex;
            flex-direction: column;
        }

        .desktop-center {
            display: flex;
            flex-direction: column;
            gap: 12px;
            /* Slightly reduced gap */
            margin-top: 0;
            /* Flush with utility bar */
            padding: 0;
            /* Remove side padding to eliminate gutters */
            min-width: 0;
        }

        .desktop-right {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 0;
            padding: 0;
            /* Remove side padding */
        }

        /* Widget Styling for Center Column */
        .widget-grid {
            display: grid;
            gap: 16px;
            grid-template-columns: 1fr;
        }

        .desktop-center .profil-card {
            padding: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-width: 2px;
        }

        .desktop-center .profil-card h3 {
            font-size: 1.3rem;
            margin-bottom: 12px;
        }

        .desktop-center .profil-card p,
        .desktop-center .profil-list li {
            font-size: 0.9rem;
        }

        .desktop-center .agenda-list {
            gap: 12px;
            max-width: 100%;
        }

        .desktop-center .agenda-date {
            padding: 16px;
            min-width: 100px;
        }

        .desktop-center .agenda-date .day {
            font-size: 2rem;
        }

        .desktop-center .agenda-details {
            padding: 16px;
        }

        .desktop-center .agenda-details h4 {
            font-size: 1.1rem;
        }

        .desktop-center .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .desktop-center .polling-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .desktop-center .prayer-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 24px;
            padding: 12px;
            box-shadow: none;
            /* No shadow for flush look */
            border: 1px solid #e5e7eb;
            margin: 0;
            /* Flush margin */
            border-radius: 0;
            /* Removed radius to match budget section */
            width: 100%;
            box-sizing: border-box;
            background: white;
        }

        .desktop-center .prayer-header {
            flex: 1;
            margin-bottom: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 12px;
        }

        .desktop-center .prayer-icon {
            width: 100px;
            height: 100px;
            margin-bottom: 4px;
        }

        .desktop-center .prayer-title-box h4 {
            font-size: 1.05rem;
            line-height: 1.3;
        }

        .desktop-center .prayer-grid {
            flex: 2;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .desktop-center .prayer-card {
            padding: 12px 8px;
            border-radius: 6px;
            border-color: #15803d;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .desktop-center .p-name {
            font-size: 0.85rem;
            margin-bottom: 6px;
        }

        .desktop-center .p-time {
            font-size: 1.1rem;
        }


        /* Krandegan Style Banner */
        .dc-banner {
            display: flex;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            min-height: 480px;
            /* Diperbesar lebih tinggi lagi */
            position: relative;
            background-image: radial-gradient(#d1d5db 1px, transparent 1px);
            background-size: 20px 20px;
            margin-bottom: 6px;
        }

        .dc-banner-left {
            width: 45%;
            background: var(--primary);
            padding: 40px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            position: relative;
            z-index: 10;
            border-radius: 0 150px 150px 0;
            /* Efek bulat lebih melengkung tajam memotong gambar */
            box-shadow: 15px 0 30px rgba(0, 0, 0, 0.2);
            margin-right: -40px;
        }



        .dc-banner-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--primary-dark);
            z-index: -1;
            transform: translateX(12px) translateY(12px);
            border-radius: 0 150px 150px 0;
            /* Sama dengan yang atas */
            opacity: 0.5;
        }

        .dc-banner-title-small {
            font-size: 0.85rem;
            /* Diperkecil */
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .dc-banner-title {
            font-size: 1.8rem;
            /* Headline diperkecil */
            font-weight: 900;
            color: #facc15;
            text-transform: uppercase;
            margin-bottom: 20px;
            line-height: 1.1;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .dc-banner-btn {
            background: #facc15;
            color: #000;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 800;
            text-decoration: none;
            display: inline-block;
            font-size: 0.85rem;
            transition: all 0.3s;
            box-shadow: 0 4px 0 #ca8a04;
            max-width: fit-content;
            margin: 0 auto;
        }

        .dc-banner-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 0 #ca8a04;
            background: #fff;
        }

        .dc-banner-right {
            flex: 1;
            position: relative;
            margin: 0;
            /* Removed margin to prevent gaps on large screens */
            border-radius: 0 20px 20px 0;
            /* Flush radius */
            overflow: hidden;
        }

        .dc-banner-right::before {
            content: '//';
            position: absolute;
            top: 20px;
            right: 20px;
            color: var(--primary);
            font-size: 3rem;
            display: none;
        }

        .dc-banner-slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 1.5s ease-in-out, transform 8s linear;
            transform: scale(1.05);
        }

        .dc-banner-slide.active {
            opacity: 1;
            transform: scale(1);
        }

        .dc-banner-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Decorative Elements - Hidden as requested by user */
        .dc-banner-decor {
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 60;
            width: 180px;
            height: 40px;
            background: #15803d;
            border-radius: 40px;
            transform: skewX(-20deg);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .dc-banner-bottom-tape {
            display: none;
        }

        /* Normal Headline Style */
        .headline-left {
            flex: 1.5;
            padding: 24px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
        }

        .headline-normal {
            background: var(--primary);
            border-radius: 0;
            /* Removed radius for flush look */
            overflow: hidden;
            display: flex;
            color: white;
            position: relative;
            min-height: 180px;
            margin: 0;
            /* Flush margin */
            width: 100%;
            box-sizing: border-box;
            box-shadow: none;
            /* Removed shadow */
        }

        .headline-label {
            color: #fde047;
            font-weight: 900;
            font-size: 0.9rem;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .headline-title {
            font-size: 1.3rem;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 12px;
        }

        .headline-desc {
            font-size: 0.85rem;
            opacity: 0.9;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .headline-right {
            flex: 1;
            position: relative;
        }

        .headline-right img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .headline-normal:hover .headline-right img {
            transform: scale(1.05);
        }

        /* Compact Headline for better space optimization */
        .headline-normal.compact {
            min-height: 130px !important;
        }

        .headline-normal.compact .headline-left {
            padding: 12px 16px !important;
            flex: 2;
        }

        .headline-normal.compact .headline-label {
            font-size: 0.75rem !important;
            margin-bottom: 4px !important;
        }

        .headline-normal.compact .headline-title {
            font-size: 1.05rem !important;
            margin-bottom: 4px !important;
            line-height: 1.2 !important;
        }

        .headline-normal.compact .headline-desc {
            font-size: 0.75rem !important;
            line-height: 1.4 !important;
            -webkit-line-clamp: 2 !important;
        }








        .dc-info {
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 0;
            /* Flush edges */
            display: flex;
            align-items: center;
            overflow: hidden;
            margin: 0;
            width: 100%;
            box-sizing: border-box;
            height: 42px;
            box-shadow: none;
        }

        .dc-info-label {
            background: var(--primary);
            color: white;
            padding: 0 16px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 8px;
            height: 100%;
            font-size: 0.85rem;
            text-transform: uppercase;
        }

        .dc-info-text {
            padding: 0 12px;
            color: #334155;
            font-size: 0.85rem;
            font-weight: 600;
            flex: 1;
            overflow: hidden;
            white-space: nowrap;
            display: flex;
            justify-content: center;
        }

        .dc-info-marquee {
            display: inline-block;
            animation: marquee 30s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .dc-info-text:hover .dc-info-marquee {
            animation-play-state: paused;
        }

        .dc-countdown {
            background: color-mix(in srgb, var(--primary) 10%, white);
            border-radius: 4px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid color-mix(in srgb, var(--primary) 30%, transparent);
            margin-bottom: 4px;
            gap: 16px;
        }

        .dc-cd-left {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            color: var(--primary-dark);
            font-size: 0.9rem;
        }

        .dc-cd-left i {
            color: var(--primary);
            font-size: 1.2rem;
        }

        .dc-cd-timer {
            display: flex;
            gap: 4px;
        }

        .dc-cd-item {
            width: 42px;
            height: 42px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            color: white;
        }

        .dc-cd-item .num {
            font-size: 0.95rem;
            font-weight: 900;
            line-height: 1;
        }

        .dc-cd-item .label {
            font-size: 0.5rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* Countdown items use theme shades for color sync */
        .dc-cd-item.blue {
            background: var(--primary);
        }

        .dc-cd-item.orange {
            background: var(--primary-dark);
        }

        .dc-cd-item.teal {
            background: color-mix(in srgb, var(--primary) 75%, black);
        }

        .dc-cd-item.red {
            background: color-mix(in srgb, var(--primary) 60%, black);
        }

        .dc-cd-item.green {
            background: var(--primary-light);
        }


        .dc-cd-val {
            font-size: 1.5rem;
            font-weight: 800;
            display: block;
            line-height: 1;
            color: white;
        }

        .dc-cd-lbl {
            font-size: 0.7rem;
            text-transform: uppercase;
            font-weight: 600;
            opacity: 0.8;
            margin-top: 4px;
            display: block;
        }

        .dr-greeting {
            background: var(--primary);
            color: white;
            padding: 10px 14px;
            border-radius: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4px;
            font-size: 0.82rem;
        }

        .dr-greeting p {
            margin: 0;
            font-weight: 700;
            line-height: 1.4;
            font-size: 0.82rem;
        }

        .dr-greeting span {
            font-size: 1.4rem;
        }

        .dr-arsip {
            background: white;
            border-radius: 0;
            border: 1px solid #d1d5db;
            overflow: hidden;
            display: block;
            margin-bottom: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .dr-arsip-header {
            background: var(--primary);
            color: white;
            padding: 12px 16px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dr-widget {
            background: white;
            border-radius: 0;
            border: 1px solid #d1d5db;
            overflow: hidden;
            display: block;
            margin-bottom: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .dr-widget-header {
            background: var(--primary);
            color: white;
            padding: 8px 12px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .dr-widget-header i {
            color: white;
        }

        .dr-sticky-container {
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: sticky;
            top: 100px;
        }

        .dr-arsip-tabs {
            display: flex;
            border-bottom: 1px solid #e5e7eb;
        }

        .dr-arsip-tab {
            flex: 1;
            text-align: center;
            padding: 10px;
            font-weight: 700;
            color: #4b5563;
            border-bottom: 2px solid transparent;
            cursor: pointer;
        }

        .dr-arsip-tab.active {
            color: #111;
            border-bottom-color: var(--primary);
        }

        .arsip-list {
            display: flex;
            flex-direction: column;
        }

        .arsip-item {
            display: flex;
            gap: 12px;
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
            text-decoration: none;
            color: inherit;
        }

        .arsip-item:hover {
            background: #f9fafb;
        }

        .arsip-thumb {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            flex-shrink: 0;
        }

        .arsip-text {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .arsip-views {
            font-size: 0.75rem;
            color: #4b5563;
            margin-bottom: 2px;
        }

        .arsip-title {
            font-size: 0.85rem;
            font-weight: 600;
            line-height: 1.3;
            color: #111;
        }

        /* Transparansi & Maps Identical Styles */
        .trans-title-center {
            grid-column: 1 / -1;
            background: #e5e7eb;
            padding: 12px;
            text-align: center;
            border: 1px solid #d1d5db;
            margin-bottom: 20px;
        }

        .trans-title-center h2 {
            font-family: 'Inter', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            color: #000;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin: 0;
        }

        .transparansi-block {
            background: #f9fafb;
            padding: 16px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            margin-top: 8px;
        }

        .t-card {
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            overflow: hidden;
            padding-bottom: 12px;
        }

        .t-card-header {
            font-weight: 700;
            text-align: center;
            padding: 8px;
            border-bottom: none;
            font-size: 0.85rem;
            color: white;
            background: var(--primary);
        }

        .t-card-body {
            padding: 0 12px;
        }

        .t-sub-title {
            font-weight: 800;
            font-size: 0.8rem;
            color: var(--primary-dark);
            margin: 8px 0 4px 0;
        }

        .t-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.8rem;
        }

        .t-table th,
        .t-table td {
            border: 1px solid #d1d5db;
            padding: 4px 2px;
            text-align: center;
            color: #111;
        }

        .t-table th {
            background: #ffffff;
            font-weight: 500;
        }

        .t-progress-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.75rem;
            margin-top: 6px;
            color: #111;
        }

        .t-progress {
            height: 8px;
            width: 40px;
            background: #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
        }

        .t-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--accent), var(--primary-light));
        }

        .maps-block {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
            margin-top: 16px;
            position: relative;
        }

        .map-card {
            background: white;
            border: 1px solid #e2e8f0;
            position: relative;
            height: 380px;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .map-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: var(--primary-light);
        }

        .map-label {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            color: var(--primary-dark);
            padding: 8px 16px;
            font-weight: 800;
            font-size: 0.75rem;
            z-index: 10;
            text-transform: uppercase;
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .map-label i {
            color: var(--primary);
            font-size: 1rem;
        }

        .map-content {
            flex: 1;
            height: 100%;
            width: 100%;
            position: relative;
        }

        .map-content iframe {
            width: 100%;
            height: 100%;
            border: none;
            filter: grayscale(0.2) contrast(1.1);
            transition: filter 0.3s;
        }

        .map-card:hover iframe {
            filter: grayscale(0);
        }

        .map-info-left {
            position: absolute;
            left: 16px;
            bottom: 16px;
            width: 280px;
            background: rgba(255, 255, 255, 0.95);
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 10;
            font-size: 0.85rem;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            gap: 12px;
            color: #475569;
        }

        .map-info-left strong {
            color: var(--text-dark);
            font-weight: 700;
        }

        .map-btn-float {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(21, 128, 61, 0.4);
            z-index: 10;
            transition: all 0.2s;
        }

        .map-btn-float:hover {
            background: var(--primary-dark);
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(21, 128, 61, 0.5);
        }

        .scroll-top-btn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 40px;
            height: 40px;
            background: var(--primary);
            color: white;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: transform 0.3s;
        }

        .scroll-top-btn:hover {
            transform: translateY(-5px);
        }

        /* ====================================================
           KRANDEGAN-STYLE 3-COLUMN LAYOUT (Stable & Clean)
           ==================================================== */

        /* Base: Mobile-first, stack vertically */
        .desktop-layout {
            display: block;
            width: 100%;
        }

        /* Desktop & Large Screen (1200px+): True 3-column grid */
        @media (min-width: 1200px) {
            body {
                background: #e8e8e8;
            }

            .desktop-layout {
                display: grid;
                /* Fluid Percentage-based grid */
                grid-template-columns: 20% 60% 20%;
                grid-template-rows: auto;
                gap: 0;
                align-items: start;
                width: 100%;
                max-width: 100%;
                margin: 0;
                background: white;
                /* Unified white background */
            }

            /* LEFT SIDEBAR — col 1, spans all rows */
            .desktop-left {
                grid-column: 1;
                grid-row: 1 / 10;
                position: sticky;
                top: 44px;
                height: calc(100vh - 44px);
                display: flex;
                flex-direction: column;
                background: white;
                border-right: 1px solid #ccc;
                box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1);
                z-index: 100;
                overflow: hidden;
            }

            .dl-menu-wrapper::-webkit-scrollbar {
                width: 6px;
            }

            .dl-menu-wrapper::-webkit-scrollbar-track {
                background: transparent;
            }

            .dl-menu-wrapper::-webkit-scrollbar-thumb {
                background-color: #cbd5e1;
                border-radius: 10px;
            }

            .desktop-left>div {
                gap: 0 !important;
                height: 100%;
            }

            /* BANNER — col 2+3, row 1 */
            .dc-banner-top {
                grid-column: 2 / 4;
                grid-row: 1;
            }

            /* CENTER COLUMN — col 2, row 2 */
            .desktop-center {
                grid-column: 2;
                grid-row: 2;
                min-width: 0;
                display: flex;
                flex-direction: column;
                gap: 0;
                padding: 0;
                background: #e8e8e8;
            }

            /* RIGHT SIDEBAR — col 3, row 2 */
            .desktop-right {
                grid-column: 3;
                grid-row: 2;
                background: #e8e8e8;
                border-left: 1px solid #ccc;
                padding: 0;
                align-self: stretch;
            }

            /* FULL-WIDTH SECTIONS — span Center and Right columns */
            #section-statistik {
                grid-column: 2 / 4;
                grid-row: 3;
                background: #e8e8e8;
                padding: 24px 20px;
                margin: 0 !important;
            }

            .maps-block {
                grid-column: 2 / 4;
                grid-row: 4;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                background: transparent;
                padding: 20px 0;
                margin: 0;
            }

            .footer {
                grid-column: 2 / 4;
                grid-row: 5;
            }
        }


        /* Tablet & Small Laptop (768px - 1199px) */
        @media (min-width: 768px) and (max-width: 1199px) {
            .desktop-layout {
                display: grid;
                grid-template-columns: 240px 1fr;
                gap: 20px;
            }

            .desktop-left {
                grid-column: 1;
                grid-row: 1 / 10;
                position: sticky;
                top: 70px;
            }

            .desktop-center {
                grid-column: 2;
                grid-row: 2;
            }

            .desktop-right {
                grid-column: 1 / 3;
                /* Move to bottom or span full width below */
                grid-row: 10;
                position: relative;
                top: 0;
                max-height: none;
                overflow: visible;
            }

            .dc-banner-top {
                grid-column: 2;
            }

            .dc-banner-left {
                margin-right: 0 !important;
                transform: none !important;
                width: 100% !important;
                border-radius: 20px !important;
            }

            .dc-banner-right {
                display: none;
            }

            #section-statistik {
                grid-column: 2;
                margin-top: 20px;
                margin-bottom: 20px;
            }

            .maps-block {
                grid-column: 2;
            }

        }

        /* Mobile Optimization */
        @media (max-width: 767px) {
            .tub-left {
                display: none;
            }

            .tub-right {
                width: 100%;
                justify-content: space-between;
            }

            .dc-banner {
                min-height: auto;
                padding: 10px;
            }

            .dc-banner-left {
                width: 100% !important;
                padding: 40px 20px !important;
                margin-right: 0 !important;
                transform: none !important;
                border-radius: 20px !important;
            }

            .dc-banner-title {
                font-size: 2.5rem !important;
            }

            .dc-banner-right {
                display: none;
            }

            .dc-info {
                flex-direction: column;
                align-items: flex-start;
            }

            .dc-info-label {
                width: 100%;
            }

            .dc-countdown {
                flex-direction: column;
                text-align: center;
            }

            .service-banner {
                flex-direction: column;
                text-align: center;
                gap: 24px;
            }

            .service-title,
            .service-subtitle {
                font-size: 1.8rem !important;
            }

            .service-info-box {
                margin: 0 auto 16px;
            }

            .maps-block {
                grid-template-columns: 1fr;
                padding: 0 16px 30px 16px;
                display: flex;
                flex-direction: column;
            }

            .map-card {
                flex-direction: column;
                height: auto;
                min-height: 320px;
            }

            .map-info-left {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #d1d5db;
                padding: 24px 16px;
            }

            .map-content {
                height: 250px;
                flex: none;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 40px;
                text-align: center;
            }

            .footer-logo,
            .footer-desc {
                margin-left: auto;
                margin-right: auto;
            }
        }

        /* Gallery Section */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: var(--radius-md);
            aspect-ratio: 4/3;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 20px;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-title {
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover .gallery-title {
            transform: translateY(0);
        }

        /* Notification Toast (Keep if needed for other things, but can remove if only for voting) */
        .toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: white;
            color: var(--primary-dark);
            padding: 16px 32px;
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            font-weight: 600;
            z-index: 2000;
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .toast.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }

        .toast-icon {
            background: var(--primary);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        /* Officials (Susunan Pengurus) Styles */
        .officials-wrapper {
            background: white;
            padding: 16px;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            margin-top: 16px;
        }

        .officials-header {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 800;
            font-size: 1.1rem;
            color: #111;
            margin-bottom: 16px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 8px;
        }

        .officials-header i {
            color: var(--primary);
        }

        .officials-scroll {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            padding-bottom: 8px;
            scrollbar-width: thin;
            scrollbar-color: var(--primary) #f3f4f6;
        }

        .official-card {
            flex: 0 0 160px;
            height: 240px;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            border-radius: 8px;
            padding: 12px;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px solid #e5e7eb;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .official-inner {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 100%;
            height: 100%;
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            position: relative;
        }

        .official-photo-wrap {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: white;
            border: 3px solid #fde047;
            padding: 4px;
            margin-top: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .official-photo {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .official-info {
            margin-top: auto;
            text-align: center;
            width: 100%;
            padding-bottom: 10px;
        }

        .official-pos {
            background: #fde047;
            color: #000;
            font-weight: 800;
            font-size: 0.65rem;
            padding: 2px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 4px;
            text-transform: uppercase;
        }

        .official-name {
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        /* Layanan Mandiri (Layanan Pelajar) Banner */
        .service-banner {
            background: #f3f4f6;
            border-radius: 8px;
            margin-top: 16px;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .service-banner-bg {
            position: absolute;
            inset: 0;
            opacity: 0.1;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 30 L60 60 M30 30 L0 60 M30 30 L60 0 M30 30 L0 0' stroke='%23000' stroke-width='2' fill='none'/%3E%3C/svg%3E");
        }

        .service-content {
            z-index: 2;
            position: relative;
            flex: 1;
        }

        .service-title {
            font-family: 'Outfit';
            font-weight: 900;
            font-size: 2.2rem;
            color: #14b8a6;
            line-height: 1;
            margin-bottom: 4px;
            letter-spacing: -1px;
            text-shadow: 1px 1px 0 white;
        }

        .service-subtitle {
            font-family: 'Outfit';
            font-weight: 900;
            font-size: 2.2rem;
            color: #14b8a6;
            line-height: 1;
            margin-bottom: 16px;
            letter-spacing: -1px;
            text-shadow: 1px 1px 0 white;
        }

        .service-info-box {
            background: #111;
            color: white;
            padding: 12px 16px;
            border-radius: 4px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            max-width: 280px;
            margin-bottom: 16px;
        }

        .service-info-icon {
            font-size: 1.5rem;
            color: white;
        }

        .service-info-text {
            font-size: 0.75rem;
            line-height: 1.4;
        }

        .service-action {
            z-index: 2;
        }

        .btn-login-service {
            background: #14b8a6;
            color: white;
            padding: 12px 32px;
            border-radius: 4px;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 10px rgba(20, 184, 166, 0.3);
            transition: transform 0.3s;
        }

        .btn-login-service:hover {
            transform: translateY(-3px);
        }

        /* Footer */
        .footer {
            background: #111827;
            color: #9ca3af;
            padding: 80px 0 40px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 60px;
        }

        .footer-logo {
            font-family: 'Outfit', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 24px;
            display: inline-block;
        }

        .footer-logo span {
            color: var(--accent);
        }

        .footer-desc {
            margin-bottom: 24px;
            max-width: 400px;
            line-height: 1.8;
        }

        .footer-heading {
            font-size: 1.25rem;
            color: white;
            margin-bottom: 24px;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            transition: var(--transition);
            color: #9ca3af;
        }

        .footer-links a:hover {
            color: var(--accent);
            padding-left: 5px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.875rem;
        }


        /* Animations */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeLeft {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Mobile Nav Styles */
        .tub-menu-btn {
            display: none;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 4px;
            font-size: 1.2rem;
            cursor: pointer;
            margin-right: 12px;
            align-items: center;
            justify-content: center;
        }

        .mobile-nav-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .mobile-nav-overlay.active {
            display: block;
            opacity: 1;
        }

        .mobile-nav-content {
            position: absolute;
            left: -280px;
            top: 0;
            bottom: 0;
            width: 280px;
            background: #f8fafc;
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            box-shadow: 5px 0 25px rgba(0, 0, 0, 0.3);
        }

        .mobile-nav-overlay.active .mobile-nav-content {
            left: 0;
        }

        .mobile-nav-header {
            padding: 24px 20px;
            background: var(--primary);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .mobile-nav-header button {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .mobile-nav-body {
            flex: 1;
            overflow-y: auto;
            padding: 15px 10px;
        }

        @media (max-width: 767px) {
            .tub-menu-btn {
                display: flex;
            }

            .desktop-left .dl-menu {
                display: none !important;
            }
        }

        .admin-hidden-li {
            display: none;
        }

        /* Global Responsive Helpers */
        .desktop-left,
        .desktop-right,
        .desktop-center {
            width: 100%;
        }

        @media (max-width: 1024px) {
            .nav-links {
                display: none;
            }

            .mobile-toggle {
                display: block;
            }
        }

        @media (max-width: 768px) {

            .dc-banner,
            .headline-normal,
            .desktop-center .prayer-container {
                flex-direction: column !important;
            }

            .dc-banner-left,
            .dc-banner-right {
                width: 100% !important;
                border-radius: 0 !important;
            }

            .dc-banner-left {
                margin-right: 0 !important;
                padding: 20px !important;
            }

            .desktop-center .prayer-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }

        /* Krandegan Sidebar Menu Style */
        .dl-menu-wrapper {
            background-color: #f3f4f6;
            /* Light gray wrapper */
            padding: 10px;
        }

        .k-sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .ks-item {
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 2px;
            overflow: hidden;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .ks-header {
            padding: 12px 16px;
            font-weight: 700;
            color: #111;
            cursor: pointer;
            font-size: 0.95rem;
            transition: background 0.3s, color 0.3s;
            user-select: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ks-header::after {
            content: '\f054';
            /* FontAwesome right arrow */
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 0.75rem;
            color: #9ca3af;
            transition: transform 0.3s;
        }

        .ks-item:hover .ks-header,
        .ks-item.active .ks-header {
            color: var(--primary);
        }

        .ks-item:hover .ks-header::after,
        .ks-item.active .ks-header::after {
            transform: rotate(90deg);
            color: var(--primary);
        }

        .ks-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-out;
            background: white;
            display: flex;
            flex-direction: column;
        }

        .ks-item:hover .ks-body,
        .ks-item.active .ks-body {
            max-height: 500px;
            /* Expands on hover/click */
        }

        .ks-body a {
            padding: 10px 16px 10px 24px;
            color: #4b5563;
            text-decoration: none;
            font-size: 0.85rem;
            border-top: 1px solid #f3f4f6;
            transition: background 0.2s, color 0.2s, padding-left 0.2s;
            display: block;
        }

        .ks-body a:first-child {
            border-top: none;
        }

        .ks-body a:hover {
            background: #f8fafc;
            color: var(--primary);
            padding-left: 28px;
            /* Slight indent on hover */
        }

        /* Page Loader Overlay */
        .page-loader {
            position: fixed;
            inset: 0;
            background: var(--primary);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .page-loader.active {
            opacity: 1;
            visibility: visible;
        }

        .loader-content {
            text-align: center;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .loader-logo-container {
            position: relative;
            display: inline-block;
            margin-bottom: 24px;
        }

        .loader-logo {
            height: 90px;
            width: auto;
            position: relative;
            z-index: 10;
            animation: pulseLogo 1.5s infinite;
            filter: drop-shadow(0 4px 15px rgba(0, 0, 0, 0.4));
        }

        .loader-title {
            font-size: 1.5rem;
            font-weight: 900;
            margin-bottom: 4px;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .loader-subtitle {
            font-size: 1rem;
            font-weight: 600;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        @keyframes pulseLogo {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Bubbles Effect */
        .loader-bubble {
            position: absolute;
            border-radius: 50%;
            opacity: 0.8;
            animation: floatBubble 2s infinite ease-in-out alternate;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .b1 {
            width: 15px;
            height: 15px;
            background: #fbbf24;
            top: -10px;
            left: -10px;
            animation-delay: 0s;
        }

        .b2 {
            width: 12px;
            height: 12px;
            background: #60a5fa;
            top: 30px;
            right: -20px;
            animation-delay: 0.2s;
        }

        .b3 {
            width: 20px;
            height: 20px;
            background: #f87171;
            bottom: -10px;
            left: 15px;
            animation-delay: 0.4s;
        }

        .b4 {
            width: 14px;
            height: 14px;
            background: #a78bfa;
            bottom: 20px;
            right: -10px;
            animation-delay: 0.6s;
        }

        .b5 {
            width: 18px;
            height: 18px;
            background: #34d399;
            top: -15px;
            right: 25px;
            animation-delay: 0.8s;
        }

        @keyframes floatBubble {
            0% {
                transform: translateY(0) scale(1);
            }

            100% {
                transform: translateY(-15px) scale(1.2);
            }
        }

        /* ============================================================
           RESPONSIVE OVERHAUL — Semua Ukuran Layar
           ============================================================ */

        /* === MOBILE BOTTOM NAV BAR (alternatif navigasi di bawah) === */
        .mobile-bottom-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 9000;
            background: white;
            border-top: 2px solid var(--primary);
            box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.12);
        }

        .mbn-inner {
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 6px 0 4px;
        }

        .mbn-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            text-decoration: none;
            color: #64748b;
            font-size: 0.6rem;
            font-weight: 700;
            cursor: pointer;
            border: none;
            background: none;
            padding: 4px 8px;
            border-radius: 8px;
            transition: all 0.2s;
            min-width: 50px;
        }

        .mbn-item i {
            font-size: 1.2rem;
            transition: all 0.2s;
        }

        .mbn-item.active,
        .mbn-item:hover {
            color: var(--primary);
            background: rgba(21, 128, 61, 0.08);
        }

        .mbn-item.mbn-menu-btn i {
            font-size: 1.3rem;
        }

        /* Mobile Menu Drawer (full menu inside overlay) */
        .mobile-nav-menu-items {
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding: 0;
        }

        .mobile-nav-section-title {
            font-size: 0.7rem;
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 16px 6px;
            border-bottom: 1px solid #e5e7eb;
        }

        .mobile-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #1e293b;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            border-bottom: 1px solid #f3f4f6;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            background: transparent;
            text-align: left;
        }

        .mobile-nav-item:hover {
            background: #f0fdf4;
            color: var(--primary);
            padding-left: 20px;
        }

        .mobile-nav-item i {
            width: 20px;
            color: var(--primary);
            font-size: 0.9rem;
        }

        /* Quick Features Horizontal Scroll (mobile) */
        .mobile-quick-features {
            display: none;
            overflow-x: auto;
            padding: 10px 12px;
            gap: 8px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            scrollbar-width: none;
        }

        .mobile-quick-features::-webkit-scrollbar {
            display: none;
        }

        .mobile-quick-features .h-feature-card {
            flex: 0 0 70px;
            min-width: 70px;
            padding: 10px 4px;
            border-radius: 8px;
        }

        .mobile-quick-features .h-feature-icon {
            font-size: 1.1rem;
        }

        .mobile-quick-features .h-feature-text {
            font-size: 0.6rem;
        }

        /* === TABLET (768px - 1199px) === */
        @media (min-width: 768px) and (max-width: 1199px) {
            body {
                background: #f1f5f9;
            }

            .top-utility-bar {
                position: sticky;
                top: 0;
                z-index: 1100;
            }

            .desktop-layout {
                display: grid;
                grid-template-columns: 240px 1fr;
                grid-template-rows: auto;
                gap: 0;
                align-items: start;
                width: 100%;
            }

            /* Left sidebar - sticky, tall */
            .desktop-left {
                grid-column: 1;
                grid-row: 1 / 99;
                position: sticky;
                top: 44px;
                height: calc(100vh - 44px);
                display: flex;
                flex-direction: column;
                background: white;
                border-right: 1px solid #d1d5db;
                box-shadow: 2px 0 6px rgba(0, 0, 0, 0.06);
                overflow: hidden;
                z-index: 100;
            }

            .dl-menu-wrapper {
                flex: 1;
                overflow-y: auto;
                min-height: 0;
            }

            /* Banner spans full right column */
            .dc-banner-top {
                grid-column: 2;
                grid-row: 1;
            }

            .dc-banner {
                min-height: 200px;
                border-radius: 0;
                margin-bottom: 0;
            }

            .dc-banner-left {
                width: 55% !important;
                padding: 24px !important;
                border-radius: 0 80px 80px 0 !important;
                margin-right: -30px !important;
            }

            .dc-banner-title {
                font-size: 1.8rem !important;
            }

            .dc-banner-right {
                display: block;
            }

            /* Center column */
            .desktop-center {
                grid-column: 2;
                grid-row: 2;
                min-width: 0;
                background: #f1f5f9;
                display: flex;
                flex-direction: column;
                gap: 0;
                padding: 0;
            }

            /* Right sidebar goes below center */
            .desktop-right {
                grid-column: 2;
                grid-row: 3;
                position: relative;
                top: 0;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
                padding: 12px;
                background: #f1f5f9;
            }

            .desktop-right>* {
                margin-bottom: 0 !important;
            }

            .dr-greeting {
                grid-column: 1 / 3;
                border-radius: 8px;
                margin-bottom: 0;
            }

            .dr-sticky-container {
                grid-column: 1 / 3;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 8px;
            }

            /* Transparansi and Maps */
            .transparansi-block {
                grid-column: 2;
                grid-row: 4;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
                background: #f1f5f9;
                padding: 12px;
                margin-top: 0;
            }

            .trans-title-center {
                grid-column: 1 / 3;
            }

            .maps-block {
                grid-column: 2;
                grid-row: 5;
                display: grid;
                grid-template-columns: 1fr;
                gap: 0;
                background: #f1f5f9;
                padding: 12px;
                margin-top: 0;
            }

            .map-card {
                height: 280px;
            }

            /* Prayer widget */
            .desktop-center .prayer-container {
                flex-direction: row;
            }

            .desktop-center .prayer-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            /* Hero features 3 columns */
            .hero-features-grid {
                grid-template-columns: repeat(3, 1fr) !important;
            }

            /* News grid 2 columns */
            .na-list {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }

        /* === MOBILE (max 767px) - Main Overhaul === */
        @media (max-width: 767px) {
            body {
                background: #f8fafc;
                padding-bottom: 0;
            }

            /* Utility bar — compact */
            .tub-container {
                padding: 4px 6px;
                gap: 8px;
                /* Pastikan selalu ada jarak antara WIB dan Voting */
            }

            .tub-left {
                display: flex;
                font-size: 0.7rem;
                gap: 4px;
            }

            /* Show only short time on mobile to prevent overlapping */
            #current-date {
                display: inline-block;
                white-space: nowrap;
                font-size: 0.7rem;
                letter-spacing: -0.2px;
            }

            .desktop-time {
                display: none;
            }

            .tub-btn {
                padding: 4px 8px;
                font-size: 0.7rem;
            }

            .tub-icon {
                width: 28px;
                height: 28px;
                font-size: 0.8rem;
            }

            /* Clean up top navbar on mobile: hide search and signal to save space */
            .tub-right button[title="Pencarian"],
            .tub-right button[title="Statistik Sinyal"] {
                display: none !important;
            }

            .tub-menu-btn {
                display: flex;
                width: 28px;
                height: 28px;
                font-size: 0.8rem;
            }

            /* Show desktop left sidebar (hero) on mobile but hide its menu */
            .desktop-left {
                display: flex !important;
                border-right: none;
                width: 100%;
            }

            .dl-menu-wrapper {
                display: none !important;
            }

            .hero-new {
                border-bottom: none;
            }

            /* Full-width single column layout */
            .desktop-layout {
                display: flex !important;
                flex-direction: column;
                width: 100%;
                gap: 0;
            }

            /* Banner - full width, simplified */
            .dc-banner-top {
                width: 100%;
            }

            .dc-banner {
                border-radius: 0;
                min-height: 160px;
                flex-direction: column !important;
                margin-bottom: 0;
                background-image: none;
            }

            .dc-banner-left {
                width: 100% !important;
                border-radius: 0 !important;
                margin-right: 0 !important;
                padding: 20px 16px !important;
                box-shadow: none !important;
            }

            .dc-banner-left::before {
                display: none;
            }

            .dc-banner-title {
                font-size: 1.8rem !important;
                margin-bottom: 12px;
            }

            .dc-banner-title-small {
                font-size: 0.8rem;
            }

            .dc-banner-right {
                display: block;
                height: 160px;
                border-radius: 0;
                position: relative;
            }

            /* Hide mobile quick features, we use the desktop grid instead */
            .mobile-quick-features {
                display: none !important;
            }

            /* Info ticker */
            .dc-info {
                height: auto;
            }

            .dc-info-label {
                padding: 0 10px;
                font-size: 0.78rem;
                white-space: nowrap;
            }

            .dc-info-text {
                font-size: 0.8rem;
            }

            /* Center column full width */
            .desktop-center {
                width: 100%;
                background: #f8fafc;
                gap: 8px;
                padding: 0;
            }

            /* Headline news */
            .headline-normal {
                flex-direction: column !important;
                min-height: auto;
            }

            .headline-left {
                flex: none;
                width: 100%;
                padding: 16px;
            }

            .headline-title {
                font-size: 1.1rem;
            }

            .headline-right {
                height: 180px;
                flex: none;
                width: 100%;
            }

            /* Prayer widget */
            .prayer-container {
                border-radius: 0;
                padding: 16px;
            }

            .desktop-center .prayer-container {
                flex-direction: column !important;
            }

            .prayer-header {
                flex-direction: row;
                align-items: center;
                gap: 12px;
                margin-bottom: 16px;
            }

            .prayer-icon {
                width: 60px;
                height: 60px;
            }

            .prayer-grid {
                grid-template-columns: repeat(3, 1fr) !important;
                gap: 8px;
            }

            .prayer-card {
                padding: 10px 6px;
            }

            .p-name {
                font-size: 0.78rem;
            }

            .p-time {
                font-size: 0.92rem;
            }

            /* News articles grid */
            .na-list {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .na-img-wrapper {
                height: 120px;
            }
            
            .na-content {
                padding: 10px;
            }
            
            .na-title {
                font-size: 0.9rem;
            }
            
            .na-meta-item {
                font-size: 0.65rem;
            }
            
            .na-card-link {
                padding: 10px;
                font-size: 0.75rem;
            }

            /* Right sidebar as stacked cards below */
            .desktop-right {
                width: 100%;
                padding: 8px;
                display: flex;
                flex-direction: column;
                gap: 8px;
                background: #f8fafc;
            }

            .dr-greeting {
                border-radius: 8px;
                margin-bottom: 0;
            }

            .dr-arsip,
            .dr-widget {
                border-radius: 8px;
                margin-bottom: 0;
            }

            /* Transparansi block */
            .transparansi-block {
                display: flex !important;
                flex-direction: column !important;
                padding: 8px;
                gap: 8px;
                margin-top: 0;
            }

            .trans-title-center {
                grid-column: auto !important;
            }

            .maps-block {
                display: flex !important;
                flex-direction: column !important;
                gap: 0;
                padding: 8px;
                margin-top: 0;
            }

            .map-card {
                height: 250px;
                border-radius: 8px;
                margin-bottom: 8px;
            }

            .map-info-left {
                display: none;
            }

            /* Officials scroll */
            .official-card {
                flex: 0 0 140px;
                height: 210px;
            }

            /* Service banner */
            .service-banner {
                flex-direction: column;
                text-align: center;
                gap: 16px;
                padding: 20px;
                border-radius: 8px;
                margin-top: 8px;
            }

            .service-title,
            .service-subtitle {
                font-size: 1.6rem !important;
            }

            .service-info-box {
                margin: 0 auto 12px;
                max-width: 100%;
            }

            /* Gallery grid */
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }

            /* Section header */
            .section-title {
                font-size: 1.8rem;
            }

            /* Countdown widget */
            .dc-countdown {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
                padding: 10px 12px;
            }

            .dc-cd-timer {
                width: 100%;
                justify-content: center;
            }

            /* Footer */
            .footer {
                padding: 40px 0 24px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 24px;
                text-align: center;
                margin-bottom: 24px;
            }

            .footer-logo,
            .footer-desc {
                margin-left: auto;
                margin-right: auto;
            }

            /* Dynamic sections - nahkoda always 2 columns */
            #section-nahkoda .nahkoda-main-grid {
                grid-template-columns: 1fr 1fr !important;
                gap: 8px !important;
            }

            #section-statistik>div[style*="grid"] {
                grid-template-columns: repeat(3, 1fr) !important;
                padding: 12px !important;
            }

            #section-usaha>div>div[style*="grid"] {
                grid-template-columns: 1fr !important;
            }

            /* Hide mobile bottom nav as requested */
            .mobile-bottom-nav {
                display: none !important;
            }

            /* Scroll to top button position */
            .scroll-top-btn {
                bottom: 76px;
                right: 16px;
            }
        }

        /* === VERY SMALL MOBILE (<480px) === */
        @media (max-width: 480px) {
            .hero-bg-container {
                height: 220px !important;
            }

            .prayer-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .na-img-wrapper {
                height: 170px;
            }

            .dc-banner-title {
                font-size: 1.5rem !important;
            }

            .footer-grid {
                gap: 20px;
            }

            .tub-right {
                gap: 4px;
            }
        }

        /* === EXTRA SMALL (<360px) === */
        @media (max-width: 360px) {
            .tub-btn {
                display: none;
            }

            .dc-banner-title {
                font-size: 1.3rem !important;
            }

            .mbn-item {
                min-width: 40px;
                padding: 4px 4px;
                font-size: 0.55rem;
            }

            .mbn-item i {
                font-size: 1.1rem;
            }
        }

        /* === Tablet sidebar hero features grid override === */
        @media (max-width: 1199px) {
            .hero-features-grid {
                grid-template-columns: repeat(3, 1fr) !important;
            }

            .h-feature-card {
                padding: 8px 2px !important;
            }
        }

        /* === Large screen specific tweaks === */
        @media (min-width: 1200px) {
            .dc-banner-top {
                grid-column: 2 / 4 !important;
            }
        }

        /* === GLOBAL GRAY SHADOW EFFECT (SADDOW ABU ABU) === */
        .dr-widget,
        .nh-wrapper,
        .na-wrapper,
        .headline-normal,
        .prayer-container,
        .desa-stat-container,
        .profil-card,
        .h-feature-card,
        .official-card,
        .map-card,
        .gallery-item {
            box-shadow: 0 4px 15px rgba(100, 116, 139, 0.25) !important;
            border: 1px solid rgba(209, 213, 219, 0.8) !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease !important;
        }

        .dr-widget:hover,
        .nh-wrapper:hover,
        .na-wrapper:hover,
        .headline-normal:hover,
        .prayer-container:hover,
        .desa-stat-container:hover,
        .profil-card:hover,
        .h-feature-card:hover,
        .official-card:hover,
        .map-card:hover,
        .gallery-item:hover {
            box-shadow: 0 8px 25px rgba(100, 116, 139, 0.4) !important;
            transform: translateY(-2px) !important;
        }
    </style>
</head>

<body>
    <!-- Promo Banner -->
    <style>
        .banner-mockup {
            display: none;
            align-items: center;
            background: white;
            border-radius: 8px;
            padding: 6px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            width: 140px;
            height: 80px;
            flex-direction: column;
            z-index: 1;
            transform: rotate(2deg);
        }
        @media(min-width: 600px) {
            .banner-mockup { display: flex; }
        }
        .promo-banner-container {
            position: fixed;
            top: -150px;
            left: 0;
            width: 100%;
            z-index: 1050;
            transition: top 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: flex;
            justify-content: center;
            padding: 10px;
            pointer-events: none; /* Let clicks pass through empty space */
        }
        .promo-banner-inner {
            position: relative;
            width: 100%;
            max-width: 800px;
            background: linear-gradient(135deg, #ea580c 0%, #dc2626 100%);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.4);
            padding: 16px 40px 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
            cursor: pointer;
            pointer-events: auto; /* Re-enable clicks for the banner */
        }
        .promo-banner-inner:hover .promo-banner-btn {
            background: rgba(255,255,255,0.3);
        }
        .promo-banner-btn {
            margin: 8px 0 0 0;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            background: rgba(255,255,255,0.2);
            display: inline-block;
            padding: 5px 12px;
            border-radius: 6px;
            text-transform: uppercase;
            transition: background 0.3s;
        }
    </style>
    @php $topBanner = $ads->where('position', 'top_banner')->first(); @endphp
    @if($topBanner)
    <div id="promo-banner" class="promo-banner-container">
        <div class="promo-banner-inner" onclick="window.open('{{ $topBanner->link ?: '#' }}', '_blank')">
            
            <!-- Sparkles/Decorative -->
            <div style="position: absolute; top: 5px; left: 5px; font-size: 2rem; color: #fef08a; opacity: 0.9;">✨</div>
            <div style="position: absolute; bottom: -5px; right: 25%; font-size: 1.8rem; color: #fef08a; opacity: 0.9;">✨</div>

            <div style="color: white; z-index: 1;">
                <h3 style="margin: 0; font-family: 'Outfit', sans-serif; font-weight: 800; font-size: clamp(1.2rem, 4vw, 1.6rem); line-height: 1.2; text-shadow: 1px 1px 2px rgba(0,0,0,0.2);">
                    {{ $topBanner->title }}<br>
                    @if($topBanner->price_info)
                        <span style="font-size: clamp(1.4rem, 5vw, 2.2rem);">{{ explode('/', $topBanner->price_info)[0] ?? '' }} <span style="font-size: clamp(0.9rem, 3vw, 1.2rem); font-weight: 600; opacity: 0.9;">/ {{ explode('/', $topBanner->price_info)[1] ?? '' }}</span></span>
                    @endif
                </h3>
                <p class="promo-banner-btn">
                    {{ $topBanner->description ?: 'KLIK BANNER INI UNTUK INFORMASI LEBIH LANJUT' }}
                </p>
            </div>
            
            <!-- Web Mockup Graphic (CSS generated) -->
            <div class="banner-mockup">
                <div style="width: 100%; height: 8px; background: #f1f5f9; border-radius: 4px; margin-bottom: 4px; display: flex; align-items: center; padding: 0 4px; gap: 2px;">
                    <div style="width: 4px; height: 4px; border-radius: 50%; background: #ef4444;"></div>
                    <div style="width: 4px; height: 4px; border-radius: 50%; background: #eab308;"></div>
                    <div style="width: 4px; height: 4px; border-radius: 50%; background: #22c55e;"></div>
                </div>
                <div style="width: 100%; height: 100%; background: #f8fafc; border-radius: 4px; overflow: hidden; position: relative;">
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 35%; background: #16a34a;"></div>
                    <div style="position: absolute; top: 12%; left: 10%; width: 50%; height: 6px; background: white; border-radius: 2px;"></div>
                    <div style="position: absolute; bottom: 12%; left: 10%; width: 25%; height: 35%; background: #cbd5e1; border-radius: 2px;"></div>
                    <div style="position: absolute; bottom: 12%; left: 40%; width: 25%; height: 35%; background: #cbd5e1; border-radius: 2px;"></div>
                    <div style="position: absolute; bottom: 12%; right: 5%; width: 25%; height: 35%; background: #cbd5e1; border-radius: 2px;"></div>
                </div>
            </div>

            <!-- Close Button -->
            <button onclick="event.stopPropagation(); let b = document.getElementById('promo-banner'); b.style.top = '-300px'; setTimeout(() => b.style.display='none', 400);" style="position: absolute; top: 12px; right: 12px; background: rgba(0,0,0,0.15); border: none; color: white; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 2; transition: background 0.2s;">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
    
    <script>
        // Show banner after loader finishes
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('promo-banner').style.top = '10px';
            }, 3000); // Assuming loader takes ~2-3s
        });
    </script>
    @endif

    <!-- Fullscreen Page Loader -->
    <div id="page-loader" class="page-loader">
        <div class="loader-content">
            <div class="loader-logo-container">
                <img src="{{ asset('images/LOGO RESMI IPNUIPPNU by diqies 2.png') }}"
                    alt="Logo IPNU IPPNU"
                    class="loader-logo">
                <div class="loader-bubbles">
                    <span class="loader-bubble b1"></span>
                    <span class="loader-bubble b2"></span>
                    <span class="loader-bubble b3"></span>
                    <span class="loader-bubble b4"></span>
                    <span class="loader-bubble b5"></span>
                </div>
            </div>
            <h2 class="loader-title">PAC IPNU IPPNU</h2>
            <p class="loader-subtitle">Kecamatan Kemiri</p>
        </div>
    </div>

    <!-- Top Utility Bar -->
    <div class="top-utility-bar">
        <div class="tub-container">
            <div class="tub-left">
                <button class="tub-menu-btn" onclick="toggleMobileMenu()"><i class="fa-solid fa-bars"></i></button>
                <svg class="tub-logo" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                </svg>
                <span id="current-date">Sabtu, 2 Mei 2026</span>
            </div>
            <div class="tub-right" style="position: relative;">
                <a href="{{ route('voting') }}" class="tub-btn"><i class="fa-solid fa-check-to-slot"></i> Voting</a>
                <button class="tub-icon" title="Pencarian" onclick="toggleSearch()"><i class="fa-solid fa-magnifying-glass"></i></button>
                <button class="tub-icon" id="theme-btn" title="Ubah Tema" onclick="toggleThemeMenu()"><i
                        class="fa-solid fa-palette"></i></button>

                <!-- Circular Theme Menu Overlay -->
                <div id="theme-overlay" class="theme-overlay">
                    <div class="theme-circle-container">
                        <div class="theme-circle-svg"></div>
                        <button class="theme-center-btn" onclick="toggleThemeMenu()">✕</button>
                        <button class="theme-option-btn theme-opt-1" onclick="setTheme('theme1')">01</button>
                        <button class="theme-option-btn theme-opt-2" onclick="setTheme('theme2')">02</button>
                        <button class="theme-option-btn theme-opt-3" onclick="setTheme('theme3')">03</button>
                        <button class="theme-option-btn theme-opt-4" onclick="setTheme('theme4')">04</button>
                        <button class="theme-option-btn theme-opt-5" onclick="setTheme('theme5')">05</button>
                        <button class="theme-option-btn theme-opt-6" onclick="setTheme('theme6')">06</button>
                        <button class="theme-option-btn theme-opt-7" onclick="setTheme('theme7')">07</button>
                        <button class="theme-option-btn theme-opt-8" onclick="setTheme('theme8')">08</button>
                    </div>
                </div>

                <button class="tub-icon" title="Statistik Sinyal"><i class="fa-solid fa-signal"></i></button>
                <a href="{{ route('admin.register') }}" class="tub-icon" title="Login Admin"
                    style="display: flex; text-decoration: none;"><i class="fa-solid fa-lock"></i></a>
            </div>
        </div>
    </div>
    
    <!-- Search Bar Overlay -->
    <div id="search-overlay" style="display:none; position:absolute; top:42px; left:0; width:100%; background:white; padding:10px 20px; box-shadow:0 4px 12px rgba(0,0,0,0.1); z-index:1000; border-bottom:1px solid #e2e8f0;">
        <form action="{{ url('/') }}" method="GET" style="display:flex; gap:10px; max-width:800px; margin:0 auto; align-items:center;">
            <input type="text" name="search" id="search-input" value="{{ request('search') }}" placeholder="Cari artikel (ketik lalu tekan enter)..." style="flex:1; padding:8px 16px; border:1px solid #cbd5e1; border-radius:50px; font-size:0.9rem; outline:none; color:#333;">
            <button type="submit" style="background:var(--primary); color:white; border:none; width:36px; height:36px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center;"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    
    <script>
        function toggleSearch() {
            const searchOverlay = document.getElementById('search-overlay');
            if (searchOverlay.style.display === 'none') {
                searchOverlay.style.display = 'block';
                setTimeout(() => document.getElementById('search-input').focus(), 100);
            } else {
                searchOverlay.style.display = 'none';
            }
        }
        
        // Ensure scroll to artikel if searched
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('search')) {
                const artikelSection = document.getElementById('artikel');
                if(artikelSection) {
                    artikelSection.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    </script>

    <!-- Dashboard Top Section -->
    <div class="desktop-layout">
        <!-- Left Column -->
        <aside class="desktop-left">
            <div style="display: flex; flex-direction: column; height: 100%; overflow: hidden;">

                <!-- LOGO SECTION: stays fixed, does not scroll -->
                <section class="hero-new" id="beranda" style="flex-shrink: 0;">
                    <div class="hero-bg-container">
                        @if(!empty($settings['hero_image']))
                        <div class="hero-slide active">
                            <img src="{{ asset('storage/' . $settings['hero_image']) }}" alt="Hero Background" class="hero-bg-img">
                        </div>
                        @else
                        <div class="hero-slide active">
                            <img src="{{ asset('images/alun_alun_kemiri.png') }}" alt="Alun Alun Kemiri" class="hero-bg-img">
                        </div>
                        <div class="hero-slide">
                            <img src="{{ asset('images/hero_bg.png') }}" alt="Kegiatan IPNU" class="hero-bg-img">
                        </div>
                        <div class="hero-slide">
                            <img src="{{ asset('images/students_study.png') }}" alt="Pelajar NU" class="hero-bg-img">
                        </div>
                        @endif
                        <div class="hero-overlay-dark"></div>
                        <div class="hero-content-center">
                            <img src="{{ asset('images/LOGO RESMI IPNUIPPNU by diqies 2.png') }}"
                                alt="Logo IPNU IPPNU" class="logo-3d">
                            <h1 class="hero-title-center">{{ $settings['hero_title'] ?? 'PAC IPNU IPPNU' }}</h1>
                            <p class="hero-subtitle-center">{{ $settings['hero_subtitle'] ?? 'Kecamatan Kemiri' }}</p>
                        </div>
                    </div>
                </section>

                <!-- SCROLLABLE AREA: icon grid + text menu scroll together -->
                <div
                    style="flex: 1; overflow-y: auto; min-height: 0; scrollbar-width: thin; scrollbar-color: var(--primary) #f1f5f9;">

                    <!-- Icon Grid -->
                    <div class="hero-features-grid-container">
                        <div class="hero-features-grid">
                            <a href="javascript:void(0)" onclick="toggleProfil()" class="h-feature-card">
                                <div class="h-feature-icon-wrap">
                                    <i class="fa-solid fa-id-card-clip h-feature-icon"></i>
                                </div>
                                <div class="h-feature-text">Profil<br>Organisasi</div>
                            </a>
                            <a href="#susunan-pengurus" class="h-feature-card">
                                <div class="h-feature-icon-wrap">
                                    <i class="fa-solid fa-people-group h-feature-icon"></i>
                                </div>
                                <div class="h-feature-text">Susunan<br>Pengurus</div>
                            </a>
                            <a href="#section-statistik" class="h-feature-card">
                                <div class="h-feature-icon-wrap">
                                    <i class="fa-solid fa-chart-pie h-feature-icon"></i>
                                </div>
                                <div class="h-feature-text">Data<br>Anggota</div>
                            </a>
                            <a href="#galeri" class="h-feature-card">
                                <div class="h-feature-icon-wrap">
                                    <i class="fa-solid fa-photo-film h-feature-icon"></i>
                                </div>
                                <div class="h-feature-text">Galeri<br>Foto</div>
                            </a>
                            <a href="#agenda" class="h-feature-card">
                                <div class="h-feature-icon-wrap">
                                    <i class="fa-solid fa-calendar-check h-feature-icon"></i>
                                </div>
                                <div class="h-feature-text">Program<br>Kerja</div>
                            </a>
                            <a href="javascript:void(0)" onclick="showSection('usaha')" class="h-feature-card">
                                <div class="h-feature-icon-wrap">
                                    <i class="fa-solid fa-shop h-feature-icon"></i>
                                </div>
                                <div class="h-feature-text">Lapak<br>Pelajar</div>
                            </a>
                            <a href="javascript:void(0)" onclick="showSection('peta')" class="h-feature-card">
                                <div class="h-feature-icon-wrap">
                                    <i class="fa-solid fa-map-pin h-feature-icon"></i>
                                </div>
                                <div class="h-feature-text">Peta<br>Ranting</div>
                            </a>
                            <a href="#berita" class="h-feature-card">
                                <div class="h-feature-icon-wrap">
                                    <i class="fa-solid fa-newspaper h-feature-icon"></i>
                                </div>
                                <div class="h-feature-text">Arsip<br>Artikel</div>
                            </a>
                            <a href="javascript:void(0)" onclick="showSection('kritik')" class="h-feature-card">
                                <div class="h-feature-icon-wrap">
                                    <i class="fa-solid fa-comment-dots h-feature-icon"></i>
                                </div>
                                <div class="h-feature-text">Ruang<br>Lapor</div>
                            </a>
                        </div>
                    </div>

                    <!-- Thin gray divider -->
                    <div style="height: 1px; background: #e2e8f0; margin: 0;"></div>

                    <!-- Text Menu -->
                    <div class="dl-menu-wrapper">

                        <div class="k-sidebar-menu">
                            <!-- Profil -->
                            <div class="ks-item" onclick="this.classList.toggle('active')">
                                <div class="ks-header">Profil</div>
                                <div class="ks-body">
                                    <a href="javascript:void(0)"
                                        onclick="showSection('sejarah'); event.stopPropagation();">Sejarah IPNU
                                        IPPNU</a>
                                    <a href="javascript:void(0)"
                                        onclick="showSection('visi-misi'); event.stopPropagation();">Visi Misi IPNU
                                        IPPNU</a>
                                    <a href="javascript:void(0)"
                                        onclick="showSection('visi-misi-pac'); event.stopPropagation();">Visi Misi PAC
                                        Kemiri</a>
                                    <a href="javascript:void(0)"
                                        onclick="showSection('nahkoda'); event.stopPropagation();">Nahkoda PAC
                                        Kemiri</a>
                                    <a href="javascript:void(0)"
                                        onclick="showSection('peta'); event.stopPropagation();">Peta Kemiri</a>
                                    <a href="javascript:void(0)"
                                        onclick="showSection('lokasi'); event.stopPropagation();">Lokasi Sekretariat</a>
                                </div>
                            </div>

                            <!-- Struktur / Lembaga -->
                            <div class="ks-item" onclick="this.classList.toggle('active')">
                                <div class="ks-header">Lembaga & Struktur</div>
                                <div class="ks-body">
                                    <a href="javascript:void(0)"
                                        onclick="showSection('susunan-pengurus'); event.stopPropagation();">Susunan Pengurus</a>
                                </div>
                            </div>

                            <!-- Informasi -->
                            <div class="ks-item" onclick="this.classList.toggle('active')">
                                <div class="ks-header">Informasi & Berita</div>
                                <div class="ks-body">
                                    <a href="#berita" onclick="event.stopPropagation();">Berita Terkini</a>
                                    <a href="#section-statistik" onclick="event.stopPropagation();">Statistik</a>
                                    <a href="#agenda" onclick="event.stopPropagation();">Agenda Kegiatan</a>
                                    <a href="#galeri" onclick="event.stopPropagation();">Galeri</a>
                                </div>
                            </div>

                            <!-- Ekonomi -->
                            <div class="ks-item" onclick="this.classList.toggle('active')">
                                <div class="ks-header">Ekonomi</div>
                                <div class="ks-body">
                                    <a href="javascript:void(0)"
                                        onclick="showSection('usaha'); event.stopPropagation();">Usaha IPNU-IPPNU</a>
                                </div>
                            </div>

                            <!-- Pemilihan -->
                            <div class="ks-item" onclick="this.classList.toggle('active')">
                                <div class="ks-header">Pemilihan</div>
                                <div class="ks-body">
                                    <a href="{{ route('voting') }}" onclick="event.stopPropagation();">Pemilihan
                                        Ketua</a>
                                </div>
                            </div>

                            <!-- Interaksi / Aduan -->
                            <div class="ks-item" onclick="this.classList.toggle('active')">
                                <div class="ks-header">Interaksi & Aduan</div>
                                <div class="ks-body">
                                    <a href="javascript:void(0)"
                                        onclick="showSection('kritik'); event.stopPropagation();">Kritik & Saran</a>
                                    <a href="javascript:void(0)"
                                        onclick="showSection('chatbot'); event.stopPropagation();">AI Chatbot</a>
                                </div>
                            </div>
                        </div><!-- /.k-sidebar-menu -->
                    </div><!-- /.dl-menu-wrapper -->
                </div><!-- /.scrollable-area -->
            </div><!-- /.flex-column -->
        </aside>


        <!-- Slanted Banner (Spans Center and Right Columns) -->
        <div class="dc-banner dc-banner-top" style="grid-column: 2 / 4;">
            <div class="dc-banner-left">
                <div class="dc-banner-dots"></div>
                <div class="dc-banner-title-small">PAC IPNU IPPNU Kemiri</div>
                <div class="dc-banner-title">PELAJAR HEBAT</div>
                <button onclick="openGabungModal()" class="dc-banner-btn" style="border:none;cursor:pointer;font-family:inherit;">Gabung Sekarang</button>
            </div>
            <div class="dc-banner-right">
                <div class="dc-banner-decor">
                    <div class="dc-decor-bar teal"></div>
                </div>
                <div class="dc-banner-bottom-tape"></div>
                <div class="dc-banner-slide active">
                    <img src="{{ asset('images/banner 1.jpeg') }}" alt="Banner 1">
                </div>
                <div class="dc-banner-slide">
                    <img src="{{ asset('images/banner 2.jpg') }}" alt="Banner 2">
                </div>
                <div class="dc-banner-slide">
                    <img src="{{ asset('images/banner 3.jpeg') }}" alt="Banner 3">
                </div>
            </div>
        </div>

        <!-- Mobile Quick Features (only visible on mobile) -->
        <div class="mobile-quick-features">
            <a href="javascript:void(0)" onclick="toggleProfil()" class="h-feature-card">
                <i class="fa-solid fa-address-card h-feature-icon"></i>
                <div class="h-feature-text">Profil</div>
            </a>
            <a href="#susunan-pengurus" class="h-feature-card">
                <i class="fa-solid fa-users h-feature-icon"></i>
                <div class="h-feature-text">Pengurus</div>
            </a>
            <a href="#section-statistik" class="h-feature-card">
                <i class="fa-solid fa-chart-pie h-feature-icon"></i>
                <div class="h-feature-text">Anggota</div>
            </a>
            <a href="#galeri" class="h-feature-card">
                <i class="fa-solid fa-images h-feature-icon"></i>
                <div class="h-feature-text">Galeri</div>
            </a>
            <a href="#agenda" class="h-feature-card">
                <i class="fa-solid fa-clipboard-list h-feature-icon"></i>
                <div class="h-feature-text">Agenda</div>
            </a>
            <a href="javascript:void(0)" onclick="showSection('usaha')" class="h-feature-card">
                <i class="fa-solid fa-store h-feature-icon"></i>
                <div class="h-feature-text">Lapak</div>
            </a>
            <a href="javascript:void(0)" onclick="showSection('peta')" class="h-feature-card">
                <i class="fa-solid fa-map-location-dot h-feature-icon"></i>
                <div class="h-feature-text">Peta</div>
            </a>
            <a href="#berita" class="h-feature-card">
                <i class="fa-solid fa-folder-open h-feature-icon"></i>
                <div class="h-feature-text">Arsip</div>
            </a>
            <a href="javascript:void(0)" onclick="showSection('kritik')" class="h-feature-card">
                <i class="fa-solid fa-bullhorn h-feature-icon"></i>
                <div class="h-feature-text">Lapor</div>
            </a>
        </div>

        <!-- Center Column -->
        <main class="desktop-center">


            <!-- Ticker & Countdown -->

            <div class="dc-info">
                <div class="dc-info-label">
                    <i class="fa-solid fa-circle-info"></i> Info
                </div>
                <div class="dc-info-text">
                    <div class="dc-info-marquee">Selamat Datang di Portal Resmi PAC IPNU IPPNU Kemiri - Pelajar NU
                        Hebat, Bermartabat, dan Terus Berkarya!</div>
                </div>
            </div>

            <!-- Countdown Widget ("Menuju Tahun 2027") -->
            <div class="dc-countdown" style="margin-top: 8px; margin-bottom: 12px;">
                <div class="dc-cd-left">
                    <i class="fa-regular fa-clock"></i>
                    <span>Menuju Tahun 2027</span>
                </div>
                <div class="dc-cd-timer" id="countdown-2027">
                    <div class="dc-cd-item blue">
                        <span class="num" id="cd-days">00</span>
                        <span class="label">Hari</span>
                    </div>
                    <div class="dc-cd-item orange">
                        <span class="num" id="cd-hours">00</span>
                        <span class="label">Jam</span>
                    </div>
                    <div class="dc-cd-item teal">
                        <span class="num" id="cd-mins">00</span>
                        <span class="label">Menit</span>
                    </div>
                    <div class="dc-cd-item red">
                        <span class="num" id="cd-secs">00</span>
                        <span class="label">Detik</span>
                    </div>
                </div>
            </div>

            <!-- Golden Announcement Banner (Krandegan Style) -->
            <div class="announce-banner" style="margin-bottom: 12px;">
                <!-- Decorative gold background pattern -->
                <div class="announce-bg"></div>
                <!-- Logo centered top -->
                <div class="announce-logo-wrap">
                    <img src="{{ asset('images/LOGO RESMI IPNUIPPNU by diqies 2.png') }}"
                        alt="Logo PAC IPNU IPPNU Kemiri" class="announce-logo">
                </div>
                <!-- Text content -->
                <div class="announce-body">
                    <div class="announce-subtitle">PAC IPNU IPPNU Kemiri mengucapkan,</div>
                    <div class="announce-title">{{ $settings['banner_thanks_title'] ?? 'Terima Kasih Atas Doa dan Dukungannya' }}</div>
                    <div class="announce-desc">{{ $settings['banner_thanks'] ?? 'PAC IPNU IPPNU Kemiri Terpilih Sebagai Organisasi Pelajar Digital Unggulan Tingkat Kabupaten Purworejo Tahun 2026' }}</div>
                </div>
            </div>

            <style>
                .announce-banner {
                    position: relative;
                    width: 100%;
                    border-radius: 10px;
                    overflow: hidden;
                    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 40%, color-mix(in srgb, var(--primary) 85%, white) 60%, var(--primary) 80%, var(--primary-dark) 100%);
                    padding: 28px 24px 22px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
                }

                .announce-bg {
                    position: absolute;
                    inset: 0;
                    background-image:
                        radial-gradient(ellipse at 20% 80%, rgba(0, 0, 0, 0.15) 0%, transparent 60%),
                        radial-gradient(ellipse at 80% 20%, rgba(255, 255, 255, 0.08) 0%, transparent 60%),
                        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23000000' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
                    pointer-events: none;
                }

                .announce-logo-wrap {
                    position: relative;
                    z-index: 2;
                    margin-bottom: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .announce-logo {
                    height: 75px;
                    width: auto;
                    object-fit: contain;
                    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.4));
                }

                .announce-body {
                    position: relative;
                    z-index: 2;
                }

                .announce-subtitle {
                    color: rgba(255, 255, 255, 0.85);
                    font-size: 0.8rem;
                    font-weight: 500;
                    letter-spacing: 0.5px;
                    margin-bottom: 6px;
                }

                .announce-title {
                    color: #ffffff;
                    font-size: 1.35rem;
                    font-weight: 900;
                    font-family: 'Outfit', sans-serif;
                    line-height: 1.2;
                    margin-bottom: 8px;
                    text-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
                }

                .announce-desc {
                    color: rgba(255, 255, 255, 0.9);
                    font-size: 0.8rem;
                    font-weight: 500;
                    line-height: 1.5;
                    max-width: 500px;
                }

                @media (max-width: 767px) {
                    .announce-title {
                        font-size: 1.1rem;
                    }

                    .announce-banner {
                        padding: 20px 16px;
                    }
                }
            </style>

            <!-- Jadwal Shalat Widget (Imsak & Shalat) -->
            <div class="prayer-container"
                style="margin-bottom: 12px; width: 100%; border-radius: 8px; box-shadow: 0 4px 15px rgba(100, 116, 139, 0.15);">
                <div class="prayer-header">
                    <svg class="prayer-icon" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="48" fill="white" stroke="#e5e7eb" stroke-width="2" />
                        <path d="M50 25 C30 25 15 50 15 75 L85 75 C85 50 70 25 50 25Z" fill="#0284c7" />
                        <path d="M40 75 L40 50 M60 75 L60 50" stroke="#f0f9ff" stroke-width="4" />
                        <circle cx="50" cy="40" r="5" fill="#fbc02d" />
                        <path d="M50 20 Q55 15 60 20 Q55 25 50 20" fill="#fbc02d" />
                        <path d="M10 75 L90 75 L90 80 L10 80 Z" fill="#9ca3af" />
                    </svg>
                    <div class="prayer-title-box">
                        <h4>JADWAL IMSAK, SHALAT & BERBUKA</h4>
                        <div class="prayer-region">Wilayah Kab. Purworejo</div>
                        <div class="prayer-date-text">Jum'at, 1 Mei 2026</div>
                    </div>
                </div>
                <div class="prayer-grid">
                    <div class="prayer-card">
                        <div class="prayer-card-inner">
                            <div class="p-name">Imsak</div>
                            <div class="p-time">04:15</div>
                        </div>
                    </div>
                    <div class="prayer-card">
                        <div class="prayer-card-inner">
                            <div class="p-name">Subuh</div>
                            <div class="p-time">04:25</div>
                        </div>
                    </div>
                    <div class="prayer-card">
                        <div class="prayer-card-inner">
                            <div class="p-name">Dzuhur</div>
                            <div class="p-time">11:41</div>
                        </div>
                    </div>
                    <div class="prayer-card">
                        <div class="prayer-card-inner">
                            <div class="p-name">Ashar</div>
                            <div class="p-time">15:01</div>
                        </div>
                    </div>
                    <div class="prayer-card">
                        <div class="prayer-card-inner">
                            <div class="p-name">Magrib & Berbuka</div>
                            <div class="p-time">17:35</div>
                        </div>
                    </div>
                    <div class="prayer-card">
                        <div class="prayer-card-inner">
                            <div class="p-name">Isya</div>
                            <div class="p-time">18:46</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Headline Krandegan Style -->
            <div class="hk-wrap" style="margin-bottom: 12px;">
                <div class="hk-left">
                    <span class="hk-wm">HEADLINE</span>
                    <span class="hk-badge">HEADLINE</span>
                    <h3 class="hk-title">Hari Santri, IPNU Kemiri Masuk Tiga Besar Terbaik Nasional</h3>
                    <p class="hk-desc">KEMIRI — PAC IPNU IPPNU Kecamatan Kemiri meraih penghargaan luar biasa sebagai
                        Pelajar Digital Nasional setelah sukses mengelola sistem administrasi berbasis cloud...</p>
                </div>
                <!-- Dark chevron separator -->
                <div class="hk-sep" aria-hidden="true"></div>
                <!-- Photo right -->
                <div class="hk-right">
                    <img src="{{ asset('images/HEADLINE.jpeg') }}" alt="Headline">
                </div>
            </div>

            <style>
                .hk-wrap {
                    display: flex;
                    height: 170px;
                    border-radius: 8px;
                    overflow: hidden;
                    box-shadow: 0 4px 15px rgba(100, 116, 139, 0.15);
                    position: relative;
                }

                .hk-left {
                    width: 58%;
                    background: var(--primary);
                    color: white;
                    padding: 16px 22px;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    position: relative;
                    overflow: hidden;
                    flex-shrink: 0;
                }

                /* Large watermark "HEADLINE" text in background */
                .hk-wm {
                    position: absolute;
                    top: 50%;
                    left: -8px;
                    transform: translateY(-50%);
                    font-size: 4.8rem;
                    font-weight: 900;
                    font-family: 'Outfit', sans-serif;
                    color: rgba(0, 0, 0, 0.12);
                    letter-spacing: -3px;
                    line-height: 1;
                    white-space: nowrap;
                    pointer-events: none;
                    user-select: none;
                }

                .hk-badge {
                    color: var(--accent);
                    font-size: 0.78rem;
                    font-weight: 900;
                    letter-spacing: 2px;
                    margin-bottom: 4px;
                    position: relative;
                    z-index: 1;
                    display: block;
                }

                .hk-title {
                    font-size: 1rem;
                    font-weight: 800;
                    line-height: 1.3;
                    margin: 0 0 5px 0;
                    position: relative;
                    z-index: 1;
                }

                .hk-desc {
                    font-size: 0.72rem;
                    opacity: 0.88;
                    line-height: 1.45;
                    margin: 0;
                    position: relative;
                    z-index: 1;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }

                /* Dark right-pointing chevron (►) separator */
                .hk-sep {
                    flex-shrink: 0;
                    align-self: stretch;
                    width: 0;
                    height: 0;
                    border-top: 85px solid transparent;
                    border-bottom: 85px solid transparent;
                    border-left: 28px solid var(--primary-dark);
                    position: relative;
                    z-index: 5;
                }

                /* Photo panel */
                .hk-right {
                    flex: 1;
                    position: relative;
                    overflow: hidden;
                    background: #1e293b;
                }

                .hk-right img {
                    position: absolute;
                    inset: 0;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: transform 0.5s ease;
                }

                .hk-wrap:hover .hk-right img {
                    transform: scale(1.05);
                }

                @media (max-width: 767px) {
                    .hk-wrap {
                        height: auto;
                        flex-direction: column;
                    }

                    .hk-left {
                        width: 100%;
                        padding: 20px 16px;
                    }

                    .hk-sep {
                        border: none;
                        height: 0;
                    }

                    .hk-right {
                        height: 140px;
                    }

                    .hk-right img {
                        position: relative;
                        inset: auto;
                        width: 100%;
                        height: 100%;
                    }
                }
            </style>

            <!-- DYNAMIC SECTIONS (A-K) -->
            <div id="dynamic-content-area">
                <!-- A. SEJARAH -->
                <div id="section-sejarah" class="dynamic-section na-wrapper" style="display:none; margin-bottom: 16px;">
                    <div class="na-header"><span>📜 SEJARAH IPNU IPPNU</span></div>
                    <div style="padding: 24px; background: white;">
                        <style>
                            .sejarah-tabs-container {
                                display: flex;
                                justify-content: center;
                                margin-bottom: 20px;
                            }
                            .sejarah-tabs {
                                display: flex;
                                border-radius: 8px;
                                overflow: hidden;
                                box-shadow: var(--shadow-md);
                                width: 100%;
                                max-width: 500px;
                            }
                            .sejarah-tab {
                                flex: 1;
                                text-align: center;
                                padding: 12px 16px;
                                font-weight: 700;
                                cursor: pointer;
                                background: white;
                                color: var(--text-dark);
                                transition: all 0.3s;
                                border: none;
                                outline: none;
                                font-family: 'Outfit', sans-serif;
                                font-size: 1.1rem;
                            }
                            .sejarah-tab:hover {
                                background: var(--bg-light);
                            }
                            .sejarah-tab.active {
                                background: var(--primary);
                                color: white;
                            }
                            .sejarah-content {
                                display: none;
                                background: #f0fdf4; /* Very light green */
                                padding: 24px;
                                border-radius: 12px;
                                border: 1px solid rgba(21, 128, 61, 0.1);
                                line-height: 1.8;
                                color: var(--text-dark);
                                text-align: justify;
                            }
                            .sejarah-content.active {
                                display: block;
                                animation: fadeIn 0.4s ease-in-out;
                            }
                            @keyframes fadeIn {
                                from { opacity: 0; transform: translateY(5px); }
                                to { opacity: 1; transform: translateY(0); }
                            }
                        </style>

                        <div class="sejarah-tabs-container">
                            <div class="sejarah-tabs">
                                <button class="sejarah-tab active" onclick="switchSejarahTab('ipnu')">IPNU</button>
                                <button class="sejarah-tab" onclick="switchSejarahTab('ippnu')">IPPNU</button>
                            </div>
                        </div>

                        <div id="sejarah-ipnu" class="sejarah-content active">
                            <h3 style="color: var(--primary); margin-bottom: 20px; text-align: center; font-family: 'Outfit', sans-serif; font-weight: 800;">Sejarah IPNU</h3>
                            
                            <div style="border-radius:12px; overflow:hidden; border: 1px solid #e2e8f0; margin-bottom: 20px; box-shadow:0 4px 15px rgba(0,0,0,0.05);">
                                <!-- Banner -->
                                <img src="{{ asset('images/KH Tolchah Mansoer Pendiri IPNU.jpg') }}" style="width:100%; height:auto; display:block;" alt="Banner Pendiri IPNU">
                                
                                <!-- Info with Portrait -->
                                <div style="display:flex; flex-wrap:wrap; align-items:center; gap:20px; padding:20px; background:white; border-left: 4px solid var(--primary);">
                                    <img src="{{ asset('images/PENDIRI IPNU.jpg') }}" style="width:100px; height:100px; border-radius:50%; object-fit:cover; border: 3px solid #bbf7d0; box-shadow:0 4px 10px rgba(0,0,0,0.1);" alt="KH. Tolchah Mansoer">
                                    <div style="flex:1; min-width:200px;">
                                        <h4 style="margin:0 0 5px 0; color:var(--primary-dark); font-weight:800; font-size:1.2rem;">Prof. Dr. KH. Tolchah Mansoer</h4>
                                        <p style="margin:0; color:#64748b; font-size:0.85rem; font-weight:700; text-transform:uppercase; letter-spacing:1px;">Pendiri IPNU</p>
                                    </div>
                                </div>
                            </div>

                            <p style="margin-bottom: 12px;">Ikatan Pelajar Nahdlatul Ulama (IPNU) didirikan pada tanggal 20 Jumadil Akhir 1373 H, bertepatan dengan 24 Februari 1954 M ketika diselenggarakan Kongres LP Ma’arif di Semarang. Sejak berdirinya, IPNU menjadi bagian dari LP Ma’arif. Namun pada tahun 1966 ketika diselenggarakan Kongres IPNU di Surabaya, IPNU resmi melepaskan diri dari LP Ma’arif dan menjadi badan otonom (banom) NU. Salah seorang pendiri IPNU adalah Prof. Dr. KH. Tolchah Mansyur.</p>
                            <p style="margin-bottom: 12px;">Sejak berdirinya, IPNu merupakan kepanjangan dari Ikatan Pelajar Nahdlatul Ulama. Namun sejak tahun 1988, melalui kongresnya yang ke-10 di Jombang yang dikenal dengan istilah Deklarasi Jombang, kepanjangan IPNU berganti menjadi Ikatan Putera nahdlatul Ulama. Hal ini dikarenakan harus menyesuaikan diri dengan Undang-undang Nomor 8 Tahun 1985 tentang keormasan yang melarang adanya organisasi pelajar di sekolah selain OSIS.</p>
                            <p>Namun setelah orde baru tumbang, di saat kebebasan berpendapat dan berekspresi dapat diperoleh dengan mudah, kepanjangan tersebut dikembalikan lagi seperti saat kelahirannya. Melalui kongresnya yang ke-14 di Surabaya (18-22 juni 2003), kepanjangan IPNU kembali seperti semula yaitu Ikatan Pelajar Nahdlatul Ulama.</p>
                        </div>

                        <div id="sejarah-ippnu" class="sejarah-content">
                            <h3 style="color: #c2410c; margin-bottom: 20px; text-align: center; font-family: 'Outfit', sans-serif; font-weight: 800;">Sejarah IPPNU</h3>
                            
                            <div style="border-radius:12px; overflow:hidden; border: 1px solid #e2e8f0; margin-bottom: 20px; box-shadow:0 4px 15px rgba(0,0,0,0.05);">
                                <!-- Banner -->
                                <img src="{{ asset('images/Pendiri IPPNU (1).jpg') }}" style="width:100%; height:auto; display:block;" alt="Banner Pendiri IPPNU">
                                
                                <!-- Info with Portrait -->
                                <div style="display:flex; flex-wrap:wrap; align-items:center; gap:20px; padding:20px; background:white; border-left: 4px solid #c2410c;">
                                    <img src="{{ asset('images/PENDIRI IPPNU.jpg') }}" style="width:100px; height:100px; border-radius:50%; object-fit:cover; border: 3px solid #fdba74; box-shadow:0 4px 10px rgba(0,0,0,0.1);" alt="Ny. Hj. Umroh Mahfudzah">
                                    <div style="flex:1; min-width:200px;">
                                        <h4 style="margin:0 0 5px 0; color:#c2410c; font-weight:800; font-size:1.2rem;">Ny. Hj. Umroh Mahfudzah</h4>
                                        <p style="margin:0; color:#64748b; font-size:0.85rem; font-weight:700; text-transform:uppercase; letter-spacing:1px;">Pendiri IPPNU</p>
                                    </div>
                                </div>
                            </div>

                            <p style="margin-bottom: 12px;">Sedangkan Ikatan Pelajar Putri Nahdlatul Ulama (IPPNU) didirikan pada tanggal 8 Rajab 1374 H bertepatan dengan tanggal 2 maret 1955 M di Solo Jawa Tengah. Salah seorang pendirinya adalah Ny. Umroh Mahfudzah. Sejak berdirinya, IPPNU bernaung di bawah LP Ma’arif. Namun sejak tahun 1966 melalui kongresnya di Surabaya, IPPNU berdiri sendiri sebagai salah satu badan otonom (banom) NU.</p>
                            <p style="margin-bottom: 12px;">Sejak berdirinya, IPPNU merupakan kepanjangan dari Ikatan pelajar Putri Nahdlatul Ulama. Namun sejak tahun 1988, melalui kongresnya yang ke-9 di Jombang (29-31 januari 1988), kepanjangan IPPNU berganti menjadi Ikatan Putri-putri Nahdlatul Ulama. Hal ini dikarenakan harus menyesuaikan diri dengan Undang-undang Nomor 8 Tahun 1985 tentang keormasan yang melarang adanya organisasi pelajar di sekolah selain OSIS.</p>
                            <p>Namun setelah Orde Baru tumbang, di saat kebebasan berpendapat dan berekspresi dapat diperoleh dengan mudah kepanjangan tersebut dikembalikan lagi seperti saat kelahirannya, melalui kongresnya yang ke-13 di Surabaya (18-22 Juni 2003), kepanjangan IPPNU kembali seperti semula yaitu Ikatan Pelajar Putri Nahdlatul Ulama.</p>
                        </div>

                        <script>
                            function switchSejarahTab(tab) {
                                document.querySelectorAll('.sejarah-tab').forEach(t => t.classList.remove('active'));
                                document.querySelectorAll('.sejarah-content').forEach(c => c.classList.remove('active'));
                                
                                if (tab === 'ipnu') {
                                    document.querySelectorAll('.sejarah-tab')[0].classList.add('active');
                                    document.getElementById('sejarah-ipnu').classList.add('active');
                                } else {
                                    document.querySelectorAll('.sejarah-tab')[1].classList.add('active');
                                    document.getElementById('sejarah-ippnu').classList.add('active');
                                }
                            }
                        </script>
                    </div>
                </div>

                <!-- A. VISI MISI -->
                <div id="section-visi-misi" class="dynamic-section na-wrapper" style="display:none; margin-bottom: 16px;">
                    <div class="na-header"><span>🎯 VISI MISI IPNU IPPNU</span></div>
                    <div style="padding: 24px; background: white;">
                        <style>
                            .vm-tabs-container {
                                display: flex;
                                justify-content: center;
                                margin-bottom: 20px;
                            }
                            .vm-tabs {
                                display: flex;
                                border-radius: 8px;
                                overflow: hidden;
                                box-shadow: var(--shadow-md);
                                width: 100%;
                                max-width: 500px;
                            }
                            .vm-tab {
                                flex: 1;
                                text-align: center;
                                padding: 12px 16px;
                                font-weight: 700;
                                cursor: pointer;
                                background: white;
                                color: var(--text-dark);
                                transition: all 0.3s;
                                border: none;
                                outline: none;
                                font-family: 'Outfit', sans-serif;
                                font-size: 1.1rem;
                            }
                            .vm-tab:hover {
                                background: var(--bg-light);
                            }
                            .vm-tab.active {
                                background: var(--primary);
                                color: white;
                            }
                            .vm-content {
                                display: none;
                                background: #f0fdf4;
                                padding: 24px;
                                border-radius: 12px;
                                border: 1px solid rgba(21, 128, 61, 0.1);
                                line-height: 1.8;
                                color: var(--text-dark);
                                text-align: justify;
                            }
                            .vm-content.active {
                                display: block;
                                animation: fadeIn 0.4s ease-in-out;
                            }
                        </style>

                        <div class="vm-tabs-container">
                            <div class="vm-tabs">
                                <button class="vm-tab active" onclick="switchVmTab('ipnu')">IPNU</button>
                                <button class="vm-tab" onclick="switchVmTab('ippnu')">IPPNU</button>
                            </div>
                        </div>

                        <!-- IPNU Visi Misi -->
                        <div id="vm-ipnu" class="vm-content active">
                            <h3 style="color: var(--primary); margin-bottom: 10px; font-family: 'Outfit', sans-serif; font-weight: 800; text-align: center;">Visi IPNU</h3>
                            <p style="margin-bottom: 20px; font-style: italic;">Terwujudnya pelajar-pelajar bangsa yang bertaqwa kepada Allah SWT, berahlakul karimah, menguasai ilmu pengetahuan dan teknologi, memiliki kesadaran dan tanggungjawab terhada tatanan masyarakat yang berkeadilan dan demokratis atas dasar ajaran Islam ahlusunnah wal jamaah.</p>
                            
                            <h3 style="color: var(--primary); margin-bottom: 10px; font-family: 'Outfit', sans-serif; font-weight: 800; text-align: center;">Misi IPNU</h3>
                            <ol style="padding-left: 20px;">
                                <li style="margin-bottom: 8px;">Mendorong para pelajar bangsa untuk taat (patuh) dalam menjalankan perintah dan menjauhi segala larangan yang termaktub dalam ajaran Islam.</li>
                                <li style="margin-bottom: 8px;">Membentuk karakter para pelajar bangsa yang santun dalam bertindak, jujur dalam berprilaku, jernih dan obyektif dalam berfikir, serta memiliki ide/gagasan yang inovatif.</li>
                                <li style="margin-bottom: 8px;">Mendorong pemamfaatan dan pengembangan ilmu pengetahuan dan teknologi sebagai media pengembangan potensi dan peningkatan SDM belajar.</li>
                                <li style="margin-bottom: 8px;">Mewujudkan kader pemimpin bangsa yang profesional, jujur dan bertanggung jawab yang dilandasi oleh spirit nilai ajaran Islam ahlusunnah wal jamaah.</li>
                            </ol>
                        </div>

                        <!-- IPPNU Visi Misi -->
                        <div id="vm-ippnu" class="vm-content">
                            <h3 style="color: var(--primary); margin-bottom: 10px; font-family: 'Outfit', sans-serif; font-weight: 800; text-align: center;">Visi IPPNU</h3>
                            <p style="margin-bottom: 20px; font-style: italic;">Terbentuknya kesempurnaan Pelajar Putri Indonesia yang bertakwa, berakhlaqul karimah, berilmu, dan berwawasan kebangsaan.</p>
                            
                            <h3 style="color: var(--primary); margin-bottom: 10px; font-family: 'Outfit', sans-serif; font-weight: 800; text-align: center;">Misi IPPNU</h3>
                            <ol style="padding-left: 20px;">
                                <li style="margin-bottom: 8px;">Membangun kader NU yang berkualitas, berakhlaqul karimah, bersikap demokratis dalam kehidupan bermasyarakat, berbangsa dan bernegara.</li>
                                <li style="margin-bottom: 8px;">Mengembangkan wacana dan kualitas sumber dya kader menuju terciptanya kesetaraan gender.</li>
                                <li style="margin-bottom: 8px;">Membentuk kader yang dinamis, kreatif, dan inovatif.</li>
                            </ol>
                        </div>

                        <script>
                            function switchVmTab(tab) {
                                document.querySelectorAll('.vm-tab').forEach(t => t.classList.remove('active'));
                                document.querySelectorAll('.vm-content').forEach(c => c.classList.remove('active'));
                                
                                if (tab === 'ipnu') {
                                    document.querySelectorAll('.vm-tab')[0].classList.add('active');
                                    document.getElementById('vm-ipnu').classList.add('active');
                                } else {
                                    document.querySelectorAll('.vm-tab')[1].classList.add('active');
                                    document.getElementById('vm-ippnu').classList.add('active');
                                }
                            }
                        </script>
                    </div>
                </div>

                <!-- A. VISI MISI PAC -->
                <div id="section-visi-misi-pac" class="dynamic-section na-wrapper" style="display:none; margin-bottom: 16px;">
                    <div class="na-header"><span>🌟 VISI MISI PAC KEMIRI</span></div>
                    <div style="padding: 24px; background: white;">
                        <h3 style="color: var(--primary); font-family: 'Outfit', sans-serif; font-weight: 800; margin-bottom: 10px; text-align: center;">Visi</h3>
                        <div style="background: #f0fdf4; padding: 20px; border-radius: 12px; border-left: 4px solid var(--primary); margin-bottom: 25px;">
                            <p style="font-style: italic; color: #166534; font-size: 1.05rem; text-align: center; margin: 0;">
                                “Terwujudnya organisasi IPNU-IPPNU yang solid, bersinergi, dan progresif dalam membangun pelajar Nahdlatul Ulama yang berkualitas, berakhlakul karimah, berwawasan luas, serta mampu berkontribusi bagi agama, bangsa, dan masyarakat.”
                            </p>
                        </div>

                        <h3 style="color: var(--primary); font-family: 'Outfit', sans-serif; font-weight: 800; margin-bottom: 15px;">Misi</h3>
                        <ol style="padding-left: 20px; line-height: 1.8; color: var(--text-dark);">
                            <li style="margin-bottom: 8px;">Meningkatkan solidaritas dan sinergi antar pengurus serta anggota IPNU-IPPNU dalam menjalankan organisasi.</li>
                            <li style="margin-bottom: 8px;">Mengembangkan kualitas pelajar NU melalui kegiatan pendidikan, keagamaan, dan pengembangan keterampilan.</li>
                            <li style="margin-bottom: 8px;">Menanamkan nilai-nilai Ahlussunnah wal Jama’ah An-Nahdliyah dalam kehidupan sehari-hari.</li>
                            <li style="margin-bottom: 8px;">Mendorong budaya organisasi yang aktif, inovatif, dan progresif sesuai perkembangan zaman.</li>
                            <li style="margin-bottom: 8px;">Membentuk generasi pelajar NU yang berkarakter, bertanggung jawab, dan mampu menjadi teladan di lingkungan masyarakat.</li>
                            <li style="margin-bottom: 8px;">Memperkuat kerja sama dengan berbagai pihak demi mendukung kemajuan organisasi dan pengembangan potensi pelajar NU.</li>
                        </ol>
                    </div>
                </div>

                <!-- A. NAHKODA -->
                <div id="section-nahkoda" class="dynamic-section na-wrapper" style="display:none; margin-bottom: 16px;">
                    <div class="na-header"><span>⚓ NAHKODA PAC KEMIRI DARI MASA KE MASA</span></div>
                    <div style="padding: 24px; background: white;">
                        @php
                            $groupedPimpinan = $officials->where('type', 'pimpinan')->groupBy(function($item) {
                                return $item->service_period ?: 'Periode Lainnya';
                            })->sortByDesc(function($item, $key) {
                                return $key; // simple sort by period string desc
                            });
                        @endphp

                        @if($groupedPimpinan->isEmpty())
                            <div style="text-align: center; padding: 30px; color: #94a3b8; background: #f8fafc; border-radius: 12px; border: 1px dashed #cbd5e1;">
                                <div style="font-size: 2.5rem; margin-bottom: 8px;">🛡️</div>
                                <div style="font-weight: 700;">Data Nahkoda Belum Tersedia</div>
                                <div style="font-size: 0.85rem;">Admin belum mendaftarkan data pimpinan.</div>
                            </div>
                        @else
                            <style>
                                .nahkoda-tabs-container {
                                    display: flex;
                                    flex-wrap: nowrap;
                                    overflow-x: auto;
                                    gap: 10px;
                                    margin-bottom: 24px;
                                    padding-bottom: 8px;
                                    -webkit-overflow-scrolling: touch;
                                    scrollbar-width: none;
                                }
                                .nahkoda-tabs-container::-webkit-scrollbar {
                                    display: none;
                                }
                                .nahkoda-tab {
                                    padding: 10px 20px;
                                    font-weight: 700;
                                    cursor: pointer;
                                    background: white;
                                    color: var(--text-dark);
                                    transition: all 0.3s;
                                    border: 1px solid #cbd5e1;
                                    border-radius: 8px;
                                    outline: none;
                                    font-family: 'Outfit', sans-serif;
                                    font-size: 0.95rem;
                                    white-space: nowrap;
                                    flex-shrink: 0;
                                }
                                .nahkoda-tab:hover {
                                    background: var(--bg-light);
                                }
                                .nahkoda-tab.active {
                                    background: var(--primary);
                                    color: white;
                                    border-color: var(--primary);
                                }
                                .nahkoda-content {
                                    display: none;
                                }
                                .nahkoda-content.active {
                                    display: block;
                                    animation: fadeIn 0.4s ease-in-out;
                                }

                                /* === NAHKODA GRID SYSTEM === */
                                .nahkoda-main-grid {
                                    display: grid;
                                    grid-template-columns: 1fr 1fr;
                                    gap: 16px;
                                    align-items: start;
                                }
                                .nahkoda-org-block {
                                    background: rgba(248,250,252,0.6);
                                    padding: 16px;
                                    border-radius: 16px;
                                    border: 1px solid #e2e8f0;
                                }
                                .nahkoda-org-title {
                                    text-align: center;
                                    margin-bottom: 16px;
                                }
                                .nahkoda-org-title h3 {
                                    font-family: 'Outfit', sans-serif;
                                    font-weight: 800;
                                    color: var(--primary-dark);
                                    margin: 0;
                                    font-size: 1.2rem;
                                }
                                .nahkoda-persons-grid {
                                    display: grid;
                                    grid-template-columns: 1fr;
                                    gap: 12px;
                                    justify-items: center;
                                }
                                .nahkoda-person-card {
                                    background: white;
                                    border: 1px solid #e2e8f0;
                                    border-radius: 12px;
                                    overflow: hidden;
                                    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
                                    display: flex;
                                    flex-direction: column;
                                    position: relative;
                                    width: 100%;
                                }
                                .nahkoda-person-card .nc-topbar {
                                    height: 6px;
                                    background: linear-gradient(90deg, var(--primary-dark), var(--primary));
                                }
                                .nahkoda-person-card .nc-photo-wrap {
                                    padding: 16px 12px 8px 12px;
                                    display: flex;
                                    justify-content: center;
                                }
                                .nahkoda-person-card .nc-photo {
                                    width: 100%;
                                    aspect-ratio: 1/1;
                                    max-width: 160px;
                                    border: 3px solid #f1f5f9;
                                    border-radius: 8px;
                                    overflow: hidden;
                                    box-shadow: 0 3px 12px rgba(0,0,0,0.07);
                                }
                                .nahkoda-person-card .nc-photo img {
                                    width: 100%;
                                    height: 100%;
                                    object-fit: cover;
                                }
                                .nahkoda-person-card .nc-info {
                                    padding: 0 12px 12px 12px;
                                    text-align: center;
                                    display: flex;
                                    flex-direction: column;
                                    flex-grow: 1;
                                }
                                .nahkoda-person-card .nc-name {
                                    margin: 0 0 4px 0;
                                    font-family: 'Outfit', sans-serif;
                                    font-weight: 800;
                                    font-size: 1rem;
                                    color: var(--text-dark);
                                    line-height: 1.2;
                                }
                                .nahkoda-person-card .nc-position {
                                    color: white;
                                    background: var(--primary);
                                    padding: 2px 8px;
                                    border-radius: 40px;
                                    font-weight: 800;
                                    font-size: 0.6rem;
                                    text-transform: uppercase;
                                    letter-spacing: 0.5px;
                                    display: inline-block;
                                    margin: 0 auto 8px auto;
                                }
                                .nahkoda-person-card .nc-details {
                                    text-align: left;
                                    background: #f8fafc;
                                    border-radius: 8px;
                                    padding: 8px;
                                    margin-bottom: 8px;
                                    border: 1px solid #e2e8f0;
                                }
                                .nahkoda-person-card .nc-detail-label {
                                    font-size: 0.6rem;
                                    color: #64748b;
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    margin-bottom: 1px;
                                }
                                .nahkoda-person-card .nc-detail-value {
                                    font-size: 0.78rem;
                                    color: var(--text-dark);
                                    font-weight: 600;
                                }
                                .nahkoda-person-card .nc-motto {
                                    margin-top: auto;
                                    padding: 8px;
                                    background: #f0fdf4;
                                    border-radius: 8px;
                                    border: 1px dashed #bbf7d0;
                                }
                                .nahkoda-person-card .nc-motto-label {
                                    font-size: 0.6rem;
                                    color: var(--primary);
                                    font-weight: 800;
                                    text-transform: uppercase;
                                    margin-bottom: 3px;
                                }
                                .nahkoda-person-card .nc-motto-text {
                                    margin: 0;
                                    font-size: 0.78rem;
                                    font-style: italic;
                                    color: #166534;
                                    line-height: 1.3;
                                    font-weight: 500;
                                }

                                /* === MOBILE (max-width: 768px) === */
                                @media (max-width: 768px) {
                                    .nahkoda-main-grid {
                                        grid-template-columns: 1fr 1fr;
                                        gap: 8px;
                                    }
                                    .nahkoda-org-block {
                                        padding: 8px;
                                        border-radius: 10px;
                                    }
                                    .nahkoda-org-title {
                                        margin-bottom: 10px;
                                    }
                                    .nahkoda-org-title h3 {
                                        font-size: 0.85rem;
                                    }
                                    .nahkoda-tab {
                                        padding: 8px 14px;
                                        font-size: 0.8rem;
                                    }
                                    .nahkoda-person-card .nc-photo-wrap {
                                        padding: 8px 6px 4px 6px;
                                    }
                                    .nahkoda-person-card .nc-photo {
                                        max-width: 120px;
                                        border-width: 2px;
                                    }
                                    .nahkoda-person-card .nc-info {
                                        padding: 0 6px 8px 6px;
                                    }
                                    .nahkoda-person-card .nc-name {
                                        font-size: 0.8rem;
                                    }
                                    .nahkoda-person-card .nc-position {
                                        font-size: 0.5rem;
                                        padding: 2px 6px;
                                        margin-bottom: 6px;
                                    }
                                    .nahkoda-person-card .nc-details {
                                        padding: 6px;
                                        margin-bottom: 6px;
                                    }
                                    .nahkoda-person-card .nc-detail-label {
                                        font-size: 0.5rem;
                                    }
                                    .nahkoda-person-card .nc-detail-value {
                                        font-size: 0.65rem;
                                    }
                                    .nahkoda-person-card .nc-motto {
                                        padding: 6px;
                                    }
                                    .nahkoda-person-card .nc-motto-label {
                                        font-size: 0.5rem;
                                    }
                                    .nahkoda-person-card .nc-motto-text {
                                        font-size: 0.65rem;
                                    }
                                }
                            </style>

                            <div class="nahkoda-tabs-container">
                                @foreach($groupedPimpinan as $period => $persons)
                                    <button class="nahkoda-tab {{ $loop->first ? 'active' : '' }}" onclick="switchNahkodaTab('{{ Str::slug($period) }}')">
                                        Masa Khidmat {{ $period }}
                                    </button>
                                @endforeach
                            </div>

                            @foreach($groupedPimpinan as $period => $persons)
                                <div id="nahkoda-{{ Str::slug($period) }}" class="nahkoda-content {{ $loop->first ? 'active' : '' }}">
                                    <div class="nahkoda-main-grid">
                                        <!-- IPNU Block -->
                                        <div class="nahkoda-org-block">
                                            <div class="nahkoda-org-title">
                                                <h3>NAHKODA IPNU</h3>
                                                <div style="width: 40px; height: 4px; background: var(--primary); margin: 6px auto 0; border-radius: 4px;"></div>
                                            </div>
                                            <div class="nahkoda-persons-grid">
                                                @php $ipnuPersons = $persons->where('organization', 'IPNU'); @endphp
                                                @foreach($ipnuPersons as $person)
                                                    <div class="nahkoda-person-card">
                                                        <div class="nc-topbar"></div>
                                                        <div class="nc-photo-wrap">
                                                            <div class="nc-photo">
                                                                @if($person->photo)
                                                                    <img src="{{ Storage::url($person->photo) }}" alt="{{ $person->name }}">
                                                                @else
                                                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:2rem;background:#e2e8f0;">👤</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="nc-info">
                                                            <h4 class="nc-name">{{ $person->name }}</h4>
                                                            <div class="nc-position">{{ $person->position }}</div>
                                                            <div class="nc-details">
                                                                <div style="margin-bottom: 6px;">
                                                                    <div class="nc-detail-label">Tempat, Tgl Lahir</div>
                                                                    <div class="nc-detail-value">{{ $person->birth_place_date ?: '-' }}</div>
                                                                </div>
                                                                <div style="height: 1px; background: #e2e8f0; margin-bottom: 6px;"></div>
                                                                <div>
                                                                    <div class="nc-detail-label">Fokus Gerakan</div>
                                                                    <div class="nc-detail-value">{{ $person->movement_focus ?: '-' }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="nc-motto">
                                                                <div class="nc-motto-label">Motto Hidup</div>
                                                                <p class="nc-motto-text">"{{ $person->motto ?: 'Berkhidmat untuk umat, bergerak untuk kemajuan pelajar.' }}"</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @if($ipnuPersons->isEmpty())
                                                    <div style="color: #94a3b8; font-size: 0.85rem; text-align: center; width: 100%; padding: 16px;">Data IPNU belum tersedia</div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- IPPNU Block -->
                                        <div class="nahkoda-org-block">
                                            <div class="nahkoda-org-title">
                                                <h3>NAHKODA IPPNU</h3>
                                                <div style="width: 40px; height: 4px; background: var(--primary); margin: 6px auto 0; border-radius: 4px;"></div>
                                            </div>
                                            <div class="nahkoda-persons-grid">
                                                @php $ippnuPersons = $persons->where('organization', 'IPPNU'); @endphp
                                                @foreach($ippnuPersons as $person)
                                                    <div class="nahkoda-person-card">
                                                        <div class="nc-topbar"></div>
                                                        <div class="nc-photo-wrap">
                                                            <div class="nc-photo">
                                                                @if($person->photo)
                                                                    <img src="{{ Storage::url($person->photo) }}" alt="{{ $person->name }}">
                                                                @else
                                                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:2rem;background:#e2e8f0;">👤</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="nc-info">
                                                            <h4 class="nc-name">{{ $person->name }}</h4>
                                                            <div class="nc-position">{{ $person->position }}</div>
                                                            <div class="nc-details">
                                                                <div style="margin-bottom: 6px;">
                                                                    <div class="nc-detail-label">Tempat, Tgl Lahir</div>
                                                                    <div class="nc-detail-value">{{ $person->birth_place_date ?: '-' }}</div>
                                                                </div>
                                                                <div style="height: 1px; background: #e2e8f0; margin-bottom: 6px;"></div>
                                                                <div>
                                                                    <div class="nc-detail-label">Fokus Gerakan</div>
                                                                    <div class="nc-detail-value">{{ $person->movement_focus ?: '-' }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="nc-motto">
                                                                <div class="nc-motto-label">Motto Hidup</div>
                                                                <p class="nc-motto-text">"{{ $person->motto ?: 'Berkhidmat untuk umat, bergerak untuk kemajuan pelajar.' }}"</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @if($ippnuPersons->isEmpty())
                                                    <div style="color: #94a3b8; font-size: 0.85rem; text-align: center; width: 100%; padding: 16px;">Data IPPNU belum tersedia</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <script>
                                function switchNahkodaTab(periodSlug) {
                                    document.querySelectorAll('.nahkoda-tab').forEach(t => t.classList.remove('active'));
                                    document.querySelectorAll('.nahkoda-content').forEach(c => c.classList.remove('active'));
                                    
                                    // Make clicked tab active
                                    event.currentTarget.classList.add('active');
                                    document.getElementById('nahkoda-' + periodSlug).classList.add('active');
                                }
                            </script>
                        @endif
                    </div>
                </div>

                <!-- SUSUNAN PENGURUS -->
                <div id="section-susunan-pengurus" class="dynamic-section na-wrapper" style="display:none; margin-bottom: 16px;">
                    <div class="na-header"><span>🏛️ SUSUNAN PENGURUS PAC KEMIRI</span></div>
                    <div style="padding: 24px; background: white;">
                        {{-- HEADLINE FOTO BERSAMA --}}
                        <div style="margin-bottom:24px;border-radius:12px;overflow:hidden;border:3px solid var(--primary);box-shadow:0 8px 24px rgba(0,0,0,0.1);">
                            @if(!empty($settings['structure_headline_photo']))
                                <img src="{{ Storage::url($settings['structure_headline_photo']) }}" alt="Foto Bersama PAC IPNU IPPNU Kemiri" style="width:100%;display:block;object-fit:cover;max-height:400px;">
                            @else
                                <img src="{{ asset('images/HEADLINE.jpeg') }}" alt="Foto Bersama PAC IPNU IPPNU Kemiri" style="width:100%;display:block;object-fit:cover;max-height:400px;" onerror="this.parentElement.innerHTML='<div style=\'background:#f1f5f9;height:200px;display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:0.85rem;\'><div style=\'text-align:center\'><i class=\'fa-solid fa-image\' style=\'font-size:2rem;display:block;margin-bottom:6px;\'></i>Foto Bersama IPNU IPPNU<br><small>(Upload via Admin)</small></div></div>'">
                            @endif
                        </div>
                        <p style="text-align:center;color:#64748b;font-size:0.88rem;margin-bottom:24px;">Pimpinan Anak Cabang IPNU & IPPNU Kecamatan Kemiri — Masa Khidmat 2025-2027</p>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
                            {{-- IPNU --}}
                            <div style="border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;">
                                <div style="background:linear-gradient(90deg,var(--primary),var(--primary-dark));color:white;padding:12px 16px;font-weight:800;font-size:0.95rem;font-style:italic;">Susunan Pengurus IPNU</div>
                                <img src="{{ asset('images/STRUKTUR IPNU.jpg') }}" alt="Foto Bersama IPNU" style="width:100%;display:block;object-fit:cover;max-height:280px;border-bottom:3px solid var(--primary);">
                                <div style="padding:16px;">
                                    @php $ipnu = $officials->where('type','bph')->where('organization','IPNU'); @endphp
                                    @foreach($ipnu->groupBy('section') as $section => $members)
                                        <div style="margin-bottom:16px;">
                                            <div style="background:linear-gradient(90deg,var(--primary),var(--primary-dark));color:white;padding:6px 14px;font-weight:700;font-size:0.88rem;border-radius:4px;margin-bottom:8px;">{{ $section }}</div>
                                            <ul style="list-style:disc;padding-left:22px;margin:0;">
                                                @foreach($members as $person)
                                                    <li style="padding:2px 0;font-size:0.85rem;color:#1e293b;line-height:1.5;">
                                                        @if($person->position !== $section && $person->position !== 'Anggota')
                                                            <strong style="color:var(--primary-dark);">{{ $person->position }}:</strong>
                                                        @endif
                                                        {{ $person->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                    @if($ipnu->isEmpty())
                                        <p style="text-align:center;color:#94a3b8;padding:20px;">Data belum tersedia</p>
                                    @endif
                                </div>
                            </div>

                            {{-- IPPNU --}}
                            <div style="border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;">
                                <div style="background:linear-gradient(90deg,var(--primary),var(--primary-dark));color:white;padding:12px 16px;font-weight:800;font-size:0.95rem;font-style:italic;">Susunan Pengurus IPPNU</div>
                                <img src="{{ asset('images/STRUKTUR IPPNU.jpeg') }}" alt="Foto Bersama IPPNU" style="width:100%;display:block;object-fit:cover;max-height:280px;border-bottom:3px solid var(--primary);">
                                <div style="padding:16px;">
                                    @php $ippnu = $officials->where('type','bph')->where('organization','IPPNU'); @endphp
                                    @foreach($ippnu->groupBy('section') as $section => $members)
                                        <div style="margin-bottom:16px;">
                                            <div style="background:linear-gradient(90deg,var(--primary),var(--primary-dark));color:white;padding:6px 14px;font-weight:700;font-size:0.88rem;border-radius:4px;margin-bottom:8px;">{{ $section }}</div>
                                            <ul style="list-style:disc;padding-left:22px;margin:0;">
                                                @foreach($members as $person)
                                                    <li style="padding:2px 0;font-size:0.85rem;color:#1e293b;line-height:1.5;">
                                                        @if($person->position !== $section && $person->position !== 'Anggota')
                                                            <strong style="color:var(--primary-dark);">{{ $person->position }}:</strong>
                                                        @endif
                                                        {{ $person->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                    @if($ippnu->isEmpty())
                                        <p style="text-align:center;color:#94a3b8;padding:20px;">Data belum tersedia</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- G. USAHA / LAPAK PELAJAR -->
                <div id="section-usaha" class="dynamic-section na-wrapper" style="display:none; margin-bottom: 16px;">
                    <div class="na-header"><span>🛒 LAPAK PELAJAR</span></div>
                    <div style="padding: 16px; background: #f5f5f5;">
                        <style>
                            .shopee-grid {
                                display: grid;
                                grid-template-columns: repeat(2, 1fr);
                                gap: 12px;
                            }
                            @media (min-width: 640px) { .shopee-grid { grid-template-columns: repeat(3, 1fr); } }
                            @media (min-width: 1024px) { .shopee-grid { grid-template-columns: repeat(4, 1fr); } }
                            @media (min-width: 1280px) { .shopee-grid { grid-template-columns: repeat(5, 1fr); } }

                            .shopee-card {
                                background: white;
                                border-radius: 4px;
                                overflow: hidden;
                                box-shadow: 0 1px 1px 0 rgba(0,0,0,.05);
                                transition: transform 0.1s, box-shadow 0.1s;
                                text-decoration: none;
                                display: flex;
                                flex-direction: column;
                                border: 1px solid transparent;
                            }
                            .shopee-card:hover {
                                transform: translateY(-2px);
                                box-shadow: 0 2px 8px rgba(0,0,0,.15);
                                border-color: var(--primary);
                            }
                            .shopee-img-wrapper {
                                width: 100%;
                                padding-top: 100%; /* 1:1 Aspect Ratio */
                                position: relative;
                                background: #f8f8f8;
                            }
                            .shopee-img {
                                position: absolute;
                                top: 0; left: 0; width: 100%; height: 100%;
                                object-fit: cover;
                            }
                            .shopee-discount-badge {
                                position: absolute;
                                top: 0; right: 0;
                                background: rgba(255,212,36,.9);
                                color: #ee4d2d;
                                font-size: 0.75rem;
                                font-weight: 700;
                                padding: 2px 4px;
                                text-align: center;
                                line-height: 1.1;
                                border-bottom-left-radius: 2px;
                            }
                            .shopee-info {
                                padding: 8px;
                                display: flex;
                                flex-direction: column;
                                flex-grow: 1;
                            }
                            .shopee-title {
                                font-size: 0.8rem;
                                line-height: 1.2;
                                font-weight: 500;
                                color: rgba(0,0,0,.87);
                                display: -webkit-box;
                                -webkit-line-clamp: 2;
                                -webkit-box-orient: vertical;
                                overflow: hidden;
                                text-overflow: ellipsis;
                                margin-bottom: 4px;
                                min-height: 28px;
                            }
                            .shopee-price-row {
                                margin-top: auto;
                                display: flex;
                                align-items: baseline;
                                flex-wrap: wrap;
                            }
                            .shopee-price {
                                color: #ee4d2d;
                                font-size: 1.1rem;
                                font-weight: 600;
                            }
                            .shopee-price-original {
                                color: #ccc;
                                text-decoration: line-through;
                                font-size: 0.7rem;
                                margin-left: 4px;
                            }
                            .shopee-meta {
                                display: flex;
                                align-items: center;
                                justify-content: space-between;
                                margin-top: 6px;
                                font-size: 0.7rem;
                                color: rgba(0,0,0,.54);
                            }
                            .shopee-rating i {
                                color: #ffce3d;
                                font-size: 0.65rem;
                            }
                            .shopee-location {
                                font-size: 0.65rem;
                                color: rgba(0,0,0,.54);
                                margin-top: 4px;
                                display: flex;
                                align-items: center;
                                gap: 3px;
                            }
                        </style>
                        <div class="shopee-grid">
                            @foreach($products as $prod)
                            @php
                                $prodData = [
                                    'name' => $prod->name,
                                    'description' => $prod->description,
                                    'price_formatted' => 'Rp ' . number_format($prod->price, 0, ',', '.'),
                                    'discounted_price_formatted' => 'Rp ' . number_format($prod->discounted_price, 0, ',', '.'),
                                    'discount' => $prod->discount,
                                    'rating' => number_format($prod->rating, 1),
                                    'sold_count' => $prod->sold_count,
                                    'condition' => $prod->condition,
                                    'stock' => $prod->stock,
                                    'category' => $prod->category,
                                    'location' => $prod->location ?? 'Indonesia',
                                    'wa_link' => $prod->wa_link ?? '#',
                                    'image_url' => $prod->image ? Storage::url($prod->image) : null
                                ];
                            @endphp
                            <a href="javascript:void(0)" onclick='openProductModal(@json($prodData))' class="shopee-card">
                                <div class="shopee-img-wrapper">
                                    @if($prod->image)
                                        <img src="{{ Storage::url($prod->image) }}" class="shopee-img" alt="{{ $prod->name }}">
                                    @else
                                        <div class="shopee-img" style="display:flex;align-items:center;justify-content:center;background:#eaeaea;font-size:2rem;color:#ccc;"><i class="fa-solid fa-box"></i></div>
                                    @endif
                                    @if($prod->discount > 0)
                                    <div class="shopee-discount-badge">
                                        <div>{{ $prod->discount }}%</div>
                                        <div>OFF</div>
                                    </div>
                                    @endif
                                </div>
                                <div class="shopee-info">
                                    <div class="shopee-title">{{ $prod->name }}</div>
                                    <div class="shopee-price-row">
                                        <span class="shopee-price">Rp{{ number_format($prod->discounted_price, 0, ',', '.') }}</span>
                                        @if($prod->discount > 0)
                                        <span class="shopee-price-original">Rp{{ number_format($prod->price, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <div class="shopee-meta">
                                        <div class="shopee-rating">
                                            <i class="fa-solid fa-star"></i> {{ number_format($prod->rating, 1) }}
                                        </div>
                                        <div class="shopee-sold">{{ $prod->sold_count }} Terjual</div>
                                    </div>
                                    <div class="shopee-location">
                                        <i class="fa-solid fa-location-dot"></i> {{ $prod->location ?? 'Indonesia' }}
                                    </div>
                                </div>
                            </a>
                            @endforeach
                            @if($products->isEmpty())
                                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #888;">
                                    <i class="fa-solid fa-store-slash" style="font-size: 3rem; margin-bottom: 15px; color: #ccc;"></i>
                                    <div>Belum ada produk di Lapak Pelajar.</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- A. PETA -->
                <div id="section-peta" class="dynamic-section na-wrapper" style="display:none; margin-bottom: 16px;">
                    <div class="na-header"><span>🗺️ PETA KECAMATAN KEMIRI</span></div>
                    <div class="map-card" style="height: 450px; border-radius: 0;">
                        <div class="map-label"><i class="fa-solid fa-map"></i> Interaktif</div>
                        <div class="map-content">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31630.0!2d109.91!3d-7.64!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a8ca16f5c862d%3A0x4027a765a3717a0!2sKemiri%2C%20Kec.%20Kemiri%2C%20Kabupaten%20Purworejo%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1714630000000!5m2!1sid!2sid"
                                allowfullscreen="" loading="lazy"></iframe>
                            <a href="https://maps.app.goo.gl/qJdrVL3cghZddma99" target="_blank"
                                class="map-btn-float">
                                <i class="fa-solid fa-up-right-from-square"></i> Buka Peta Besar
                            </a>
                        </div>
                    </div>
                </div>

                <!-- A. LOKASI -->
                <div id="section-lokasi" class="dynamic-section na-wrapper" style="display:none; margin-bottom: 16px;">
                    <div class="na-header"><span>📍 LOKASI SEKRETARIAT</span></div>
                    <div class="map-card"
                        style="height: auto; min-height: 400px; border-radius: 0; flex-direction: column;">
                        <div class="map-info-left"
                            style="width: 100%; border-right: none; border-bottom: 1px solid #e2e8f0; padding-top: 24px;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div>
                                    <h3 style="color: var(--primary); margin-bottom: 8px; font-family: 'Outfit';">
                                        Sekretariat Bersama PAC IPNU IPPNU Kemiri</h3>
                                    <p style="font-size: 0.95rem;"><i class="fa-solid fa-location-dot"
                                            style="color: #ef4444; margin-right: 8px;"></i> Kompleks Kantor MWC NU
                                        Kemiri, Jl. Raya Kemiri - Pituruh, Kemiri, Purworejo, Jawa Tengah 54262</p>
                                </div>
                                <div
                                    style="width: 60px; height: 60px; background: #f0fdf4; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary); border: 1px solid var(--primary-light);">
                                    <i class="fa-solid fa-building-flag"></i>
                                </div>
                            </div>
                        </div>
                        <div class="map-content" style="height: 250px;">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.734842542488!2d109.9042567890!3d-7.632156890123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a8ca16f5c862d%3A0x4027a765a3717a0!2sKemiri%2C%20Kec.%20Kemiri%2C%20Kabupaten%20Purworejo%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1714630000000!5m2!1sid!2sid"
                                allowfullscreen="" loading="lazy"></iframe>
                            <a href="https://maps.app.goo.gl/qJdrVL3cghZddma99" target="_blank" class="map-btn-float">
                                <i class="fa-solid fa-route"></i> Petunjuk Arah
                            </a>
                        </div>
                    </div>
                </div>

                <!-- K. RUANG LAPOR -->
                <div id="section-kritik" class="dynamic-section na-wrapper" style="display:none; margin-bottom: 16px;">
                    <div class="na-header">
                        <span><i class="fa-solid fa-comment-dots" style="margin-right:6px;"></i>RUANG LAPOR</span>
                        <div class="na-icons"><span></span><span></span><span></span><span></span></div>
                    </div>
                    <div style="padding: 20px 20px 24px; background: white;">
                        <p style="font-size: 0.85rem; color: #64748b; margin: 0 0 18px 0; line-height: 1.6;">
                            Sampaikan kritik, saran, atau laporan Anda kepada kami. Kami akan merespons secepatnya.
                        </p>
                        <form id="form-ruang-lapor2" onsubmit="submitLapor2(event)" novalidate>
                            <div class="rl-grid">
                                <div class="rl-field">
                                    <label class="rl-label"><i class="fa-solid fa-user"></i> Nama Lengkap <span
                                            class="rl-req">*</span></label>
                                    <input type="text" id="rl2-nama" class="rl-input" placeholder="Nama lengkap Anda"
                                        required>
                                </div>
                                <div class="rl-field">
                                    <label class="rl-label"><i class="fa-solid fa-envelope"></i> Email <span
                                            class="rl-req">*</span></label>
                                    <input type="email" id="rl2-email" class="rl-input" placeholder="contoh@email.com"
                                        required>
                                </div>
                                <div class="rl-field">
                                    <label class="rl-label"><i class="fa-solid fa-phone"></i> No. Telepon / WA <span
                                            class="rl-req">*</span></label>
                                    <input type="tel" id="rl2-telp" class="rl-input" placeholder="08xxxxxxxxxx"
                                        required>
                                </div>
                                <div class="rl-field">
                                    <label class="rl-label"><i class="fa-solid fa-tag"></i> Topik Laporan</label>
                                    <select id="rl2-topik" class="rl-input">
                                        <option value="">-- Pilih Topik --</option>
                                        <option value="kritik">Kritik</option>
                                        <option value="saran">Saran</option>
                                        <option value="pengaduan">Pengaduan</option>
                                        <option value="pertanyaan">Pertanyaan</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="rl-field" style="margin-top: 14px;">
                                <label class="rl-label"><i class="fa-solid fa-message"></i> Pesan Anda <span
                                        class="rl-req">*</span></label>
                                <textarea id="rl2-pesan" class="rl-input rl-textarea"
                                    placeholder="Tuliskan pesan, kritik, saran, atau laporan Anda..."
                                    required></textarea>
                            </div>
                            <!-- CAPTCHA -->
                            <div class="rl-captcha-wrap">
                                <div class="rl-captcha-label"><i class="fa-solid fa-shield-halved"></i> Verifikasi
                                    Keamanan</div>
                                <div class="rl-captcha-box">
                                    <div class="rl-captcha-question">
                                        <span id="rl2-cap-q" class="rl-cap-text"></span>
                                        <button type="button" onclick="generateCaptcha2()" class="rl-cap-refresh"
                                            title="Ganti soal">
                                            <i class="fa-solid fa-rotate"></i>
                                        </button>
                                    </div>
                                    <div class="rl-captcha-input-wrap">
                                        <span class="rl-cap-eq">=</span>
                                        <input type="number" id="rl2-cap-ans" class="rl-input rl-cap-input"
                                            placeholder="?" min="0">
                                    </div>
                                </div>
                                <div id="rl2-cap-msg" class="rl-cap-msg" style="display:none;"></div>
                            </div>
                            <button type="submit" class="rl-submit-btn">
                                <i class="fa-solid fa-paper-plane"></i> Kirim Laporan
                            </button>
                            <div id="rl2-success" class="rl-success-msg" style="display:none;">
                                <i class="fa-solid fa-circle-check"></i>
                                Laporan Anda berhasil dikirim! Terima kasih.
                            </div>
                        </form>
                    </div>
                </div>

                <style>
                    .rl-grid {
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 12px;
                    }

                    @media (max-width: 600px) {
                        .rl-grid {
                            grid-template-columns: 1fr;
                        }
                    }

                    .rl-field {
                        display: flex;
                        flex-direction: column;
                        gap: 5px;
                    }

                    .rl-label {
                        font-size: 0.78rem;
                        font-weight: 700;
                        color: #374151;
                        display: flex;
                        align-items: center;
                        gap: 5px;
                    }

                    .rl-label i {
                        color: var(--primary);
                    }

                    .rl-req {
                        color: #ef4444;
                    }

                    .rl-input {
                        border: 1.5px solid #e2e8f0;
                        border-radius: 7px;
                        padding: 9px 12px;
                        font-size: 0.83rem;
                        color: #1e293b;
                        font-family: 'Outfit', sans-serif;
                        background: #f9fafb;
                        outline: none;
                        transition: border-color 0.2s, box-shadow 0.2s;
                        width: 100%;
                        box-sizing: border-box;
                    }

                    .rl-input:focus {
                        border-color: var(--primary);
                        box-shadow: 0 0 0 3px color-mix(in srgb, var(--primary) 15%, transparent);
                        background: white;
                    }

                    .rl-textarea {
                        resize: vertical;
                        min-height: 110px;
                        line-height: 1.6;
                    }

                    .rl-captcha-wrap {
                        margin-top: 16px;
                        background: #f8fafc;
                        border: 1.5px solid #e2e8f0;
                        border-radius: 10px;
                        padding: 14px 16px;
                    }

                    .rl-captcha-label {
                        font-size: 0.78rem;
                        font-weight: 700;
                        color: #374151;
                        margin-bottom: 10px;
                        display: flex;
                        align-items: center;
                        gap: 6px;
                    }

                    .rl-captcha-label i {
                        color: var(--primary);
                    }

                    .rl-captcha-box {
                        display: flex;
                        align-items: center;
                        gap: 12px;
                        flex-wrap: wrap;
                    }

                    .rl-captcha-question {
                        display: flex;
                        align-items: center;
                        gap: 8px;
                        background: white;
                        border: 1.5px solid var(--primary);
                        border-radius: 8px;
                        padding: 8px 14px;
                    }

                    .rl-cap-text {
                        font-size: 1rem;
                        font-weight: 900;
                        color: var(--primary-dark);
                        font-family: 'Courier New', monospace;
                        letter-spacing: 2px;
                    }

                    .rl-cap-refresh {
                        background: none;
                        border: none;
                        color: var(--primary);
                        cursor: pointer;
                        font-size: 0.85rem;
                        padding: 2px 4px;
                        border-radius: 4px;
                        transition: transform 0.3s;
                    }

                    .rl-cap-refresh:hover {
                        transform: rotate(180deg);
                    }

                    .rl-captcha-input-wrap {
                        display: flex;
                        align-items: center;
                        gap: 8px;
                    }

                    .rl-cap-eq {
                        font-size: 1.2rem;
                        font-weight: 900;
                        color: #64748b;
                    }

                    .rl-cap-input {
                        width: 90px !important;
                        text-align: center;
                        font-size: 1rem;
                        font-weight: 700;
                    }

                    .rl-cap-msg {
                        margin-top: 8px;
                        font-size: 0.78rem;
                        font-weight: 600;
                        padding: 6px 10px;
                        border-radius: 6px;
                    }

                    .rl-cap-msg.error {
                        background: #fef2f2;
                        color: #dc2626;
                        border: 1px solid #fecaca;
                    }

                    .rl-cap-msg.ok {
                        background: #f0fdf4;
                        color: #16a34a;
                        border: 1px solid #bbf7d0;
                    }

                    .rl-submit-btn {
                        margin-top: 18px;
                        width: 100%;
                        background: var(--primary);
                        color: white;
                        border: none;
                        border-radius: 8px;
                        padding: 12px;
                        font-size: 0.9rem;
                        font-weight: 800;
                        font-family: 'Outfit', sans-serif;
                        letter-spacing: 0.5px;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 8px;
                        transition: all 0.2s ease;
                        box-shadow: 0 4px 12px color-mix(in srgb, var(--primary) 40%, transparent);
                    }

                    .rl-submit-btn:hover {
                        background: var(--primary-dark);
                        transform: translateY(-1px);
                    }

                    .rl-success-msg {
                        margin-top: 14px;
                        background: #f0fdf4;
                        border: 1.5px solid #bbf7d0;
                        color: #15803d;
                        border-radius: 8px;
                        padding: 14px 16px;
                        font-size: 0.88rem;
                        font-weight: 700;
                        display: flex;
                        align-items: center;
                        gap: 10px;
                        animation: rlFadeIn 0.4s ease;
                    }

                    .rl-success-msg i {
                        font-size: 1.3rem;
                    }

                    @keyframes rlFadeIn {
                        from {
                            opacity: 0;
                            transform: translateY(8px);
                        }

                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                </style>

                <script>
                    let rlCap2Answer = 0;
                    function generateCaptcha2() {
                        const a = Math.floor(Math.random() * 15) + 1;
                        const b = Math.floor(Math.random() * 10) + 1;
                        const ops = ['+', '-', '×'];
                        const op = ops[Math.floor(Math.random() * 3)];
                        let answer;
                        if (op === '+') answer = a + b;
                        else if (op === '-') { answer = Math.max(a, b) - Math.min(a, b); }
                        else answer = a * b;
                        const q = op === '-' ? `${Math.max(a, b)} − ${Math.min(a, b)}` : `${a} ${op} ${b}`;
                        const el = document.getElementById('rl2-cap-q');
                        if (el) { el.textContent = q; rlCap2Answer = answer; }
                        const ans = document.getElementById('rl2-cap-ans');
                        if (ans) ans.value = '';
                        const msg = document.getElementById('rl2-cap-msg');
                        if (msg) msg.style.display = 'none';
                    }
                    function submitLapor2(e) {
                        e.preventDefault();
                        const nama = document.getElementById('rl2-nama').value.trim();
                        const email = document.getElementById('rl2-email').value.trim();
                        const telp = document.getElementById('rl2-telp').value.trim();
                        const topik = document.getElementById('rl2-topik').value;
                        const pesan = document.getElementById('rl2-pesan').value.trim();
                        const ans = parseInt(document.getElementById('rl2-cap-ans').value);
                        const msg = document.getElementById('rl2-cap-msg');
                        if (!nama || !email || !telp || !pesan) {
                            msg.className = 'rl-cap-msg error';
                            msg.textContent = '⚠ Harap isi semua kolom yang wajib diisi.';
                            msg.style.display = 'block'; return;
                        }
                        if (isNaN(ans) || ans !== rlCap2Answer) {
                            msg.className = 'rl-cap-msg error';
                            msg.textContent = '✗ Jawaban captcha salah. Coba lagi.';
                            msg.style.display = 'block'; generateCaptcha2(); return;
                        }
                        
                        msg.className = 'rl-cap-msg ok';
                        msg.textContent = 'Sedang mengirim...';
                        msg.style.display = 'block';

                        const formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('name', nama);
                        formData.append('contact', email + ' / ' + telp);
                        formData.append('subject', topik);
                        formData.append('message', pesan);

                        fetch('{{ route("ruang-lapor.store") }}', {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        }).then(res => {
                            if (res.ok) {
                                msg.className = 'rl-cap-msg ok';
                                msg.textContent = '✓ Laporan berhasil dikirim!';
                                setTimeout(() => {
                                    document.getElementById('form-ruang-lapor2').reset();
                                    document.getElementById('rl2-success').style.display = 'flex';
                                    msg.style.display = 'none'; generateCaptcha2();
                                    setTimeout(() => { document.getElementById('rl2-success').style.display = 'none'; }, 5000);
                                }, 700);
                            } else {
                                throw new Error('Network error');
                            }
                        }).catch(err => {
                            msg.className = 'rl-cap-msg error';
                            msg.textContent = '⚠ Gagal mengirim laporan. Coba lagi.';
                            msg.style.display = 'block';
                        });
                    }
                    document.addEventListener('DOMContentLoaded', generateCaptcha2);
                </script>

            </div>

            <!-- SECTION CHATBOT (AI) -->
            <div id="section-chatbot" class="dynamic-section na-wrapper" style="display:none; margin-bottom: 16px;">
                <div class="na-header">
                    <div>
                        <div class="na-subtitle">Layanan Cerdas</div>
                        <h2 class="na-title">AI Chatbot</h2>
                    </div>
                </div>
                <div class="na-grid" style="grid-template-columns: 1fr;">
                    <div class="article-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column; height: 600px; max-height: 70vh;">
                        <div id="public-chat-window" class="chat-window" style="flex-grow: 1; padding: 20px; overflow-y: auto; background: #f8fafc; display: flex; flex-direction: column; gap: 15px;">
                            @foreach($chatMessages as $msg)
                                <div class="chat-bubble {{ $msg->author === 'Bot' ? 'bot' : 'user' }}">
                                    <strong>{{ $msg->author }}:</strong> {{ $msg->content }}
                                </div>
                            @endforeach
                        </div>
                        <div style="padding: 15px; background: #fff; border-top: 1px solid #e2e8f0;">
                            <form id="public-chat-form" onsubmit="return sendPublicMessage(event);" style="display: flex; gap: 10px;">
                                <input type="text" id="public-message-input" placeholder="Tanyakan sesuatu pada AI..." required autocomplete="off" style="flex-grow: 1; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 24px; outline: none; font-family: inherit;">
                                <button type="submit" style="background: var(--primary); color: white; border: none; padding: 10px 24px; border-radius: 24px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                                    <i class="fa-solid fa-paper-plane"></i> <span class="hide-mobile">Kirim</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Berita Section in Center Column -->
            <div id="berita" class="krandegan-news-container" style="margin-top: 8px;">
                <!-- Articles Wrapper (Krandegan Style Grid) -->
                <div class="na-wrapper" id="articles-list-wrapper">
                    <div class="na-header">
                        <span>ARTIKEL & BERITA</span>
                        <div class="na-icons">
                            <i class="fa-solid fa-table-cells-large"></i>
                            <i class="fa-solid fa-list"></i>
                        </div>
                    </div>

                    <div class="na-list">
                        @foreach($articles as $article)
                            <div class="na-card">
                                <div class="na-img-wrapper">
                                    <i class="fa-solid fa-eye hover-icon"></i>
                                    <img src="{{ $article->image ? (Str::startsWith($article->image, 'images/') ? asset($article->image) : Storage::url($article->image)) : asset('images/hero_bg.png') }}"
                                        class="na-img">
                                    <div class="na-date-badge">
                                        <span
                                            class="na-day">{{ \Carbon\Carbon::parse($article->published_at)->format('d') }}</span>
                                        <span
                                            class="na-month">{{ \Carbon\Carbon::parse($article->published_at)->format('M Y') }}</span>
                                    </div>
                                </div>
                                <div class="na-content">
                                    <a href="{{ route('artikel.show', $article->slug) }}"
                                        onclick="openPageWithLoader(event, this.href)"
                                        class="na-title">{{ $article->title }}</a>
                                    <div class="na-meta">
                                        <div class="na-meta-item"><i class="fa-solid fa-user"></i> Admin :
                                            {{ $article->author }}
                                        </div>
                                        <div class="na-meta-item"><i class="fa-solid fa-eye"></i>
                                            {{ number_format($article->views_count, 0, ',', '.') }} Kali dibuka</div>
                                        <div class="na-meta-item"><i class="fa-solid fa-comment"></i>
                                            {{ $article->comments_count }} Komentar</div>
                                    </div>
                                </div>
                                <div class="na-card-footer">
                                    <a href="{{ route('artikel.show', $article->slug) }}"
                                        onclick="openPageWithLoader(event, this.href)" class="na-card-link"><i
                                            class="fa-solid fa-square-pen"></i> Buka Halaman</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination (Krandegan Style) -->
                    {{ $articles->links('vendor.pagination.krandegan') }}

                    <!-- HOMEPAGE ADS -->
                    @php
                        $homepageAds = $ads->where('position', 'homepage');
                    @endphp
                    @if($homepageAds->count() > 0)
                    <div style="margin-top: 30px; margin-bottom: 20px;">
                        @foreach($homepageAds as $ad)
                        <a href="{{ $ad->link ?: '#' }}" target="{{ $ad->link ? '_blank' : '_self' }}" style="display:block; text-decoration:none; margin-bottom:15px; position:relative; border-radius:12px; overflow:hidden; box-shadow:0 4px 6px -1px rgba(0,0,0,0.1); background:linear-gradient(135deg, #f43f5e 0%, #f97316 100%); color:white;">
                            @if($ad->image)
                                <img src="{{ asset('storage/' . $ad->image) }}" alt="{{ $ad->title }}" style="width:100%; height:auto; display:block;">
                            @else
                                <div style="padding:24px; text-align:center;">
                                    <h3 style="font-family:'Outfit',sans-serif; font-weight:800; font-size:1.6rem; margin-bottom:4px; text-shadow: 1px 1px 2px rgba(0,0,0,0.2);">{{ $ad->title }}</h3>
                                    <p style="font-size:1.1rem; font-weight:600; margin-bottom:10px;">{{ $ad->price_info }}</p>
                                    <div style="display:inline-block; background:rgba(255,255,255,0.2); backdrop-filter:blur(4px); padding:8px 16px; border-radius:50px; font-weight:700; font-size:0.85rem; border:1px solid rgba(255,255,255,0.4);">
                                        {{ $ad->description ?: 'KLIK BANNER INI UNTUK INFORMASI LEBIH LANJUT' }}
                                    </div>
                                </div>
                            @endif
                        </a>
                        @endforeach
                    </div>
                    @endif

                    <!-- Profil Organisasi Widget (Hidden by default) -->
                    <div class="na-wrapper" id="profil" style="margin-top: 16px; display: none;">
                        <div class="na-header">
                            <span>PROFIL ORGANISASI</span>
                            <div class="na-icons"><span></span><span></span><span></span><span></span></div>
                        </div>
                        <div class="profil-grid widget-grid">
                            <div class="profil-card">
                                <h3>📜 Sejarah & Arah Gerak</h3>
                                <p>PAC IPNU-IPPNU Kemiri telah menjadi wadah bagi ratusan pelajar Nahdlatul Ulama untuk
                                    mengembangkan potensi diri, berorganisasi, dan memahami nilai-nilai Ahlussunnah wal
                                    Jama'ah an-Nahdliyah. Kami terus beradaptasi dengan perkembangan zaman tanpa
                                    melupakan
                                    akar tradisi kepesantrenan.</p>
                                <p>Melalui berbagai inovasi program, IPNU Kemiri berkomitmen untuk tidak hanya mencetak
                                    generasi yang religius, tetapi juga melek teknologi, memiliki jiwa sosial yang
                                    tinggi,
                                    dan siap menjadi pemimpin masa depan.</p>
                            </div>
                            <div class="profil-card">
                                <h3>🎯 Visi & Misi</h3>
                                <p><strong>Visi:</strong> Terwujudnya pelajar Nusantara yang bertakwa kepada Allah SWT,
                                    berilmu, berakhlak mulia dan berwawasan kebangsaan.</p>
                                <ul class="profil-list">
                                    <li>Menghimpun dan membina pelajar NU dalam satu wadah organisasi.</li>
                                    <li>Mempersiapkan kader-kader militan penerus perjuangan Nahdlatul Ulama.</li>
                                    <li>Meningkatkan SDM pelajar melalui pelatihan digital dan kepemimpinan.</li>
                                    <li>Mengembangkan literasi dan kepekaan sosial terhadap masyarakat sekitar.</li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <!-- Susunan Pengurus Section (2-column reference style) -->
                    <div id="susunan-pengurus" class="officials-wrapper"
                        style="margin-top: 16px; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                        <div class="officials-header">
                            <i class="fa-solid fa-users-gear"></i> SUSUNAN PENGURUS
                        </div>
                        <p style="text-align:center;color:#64748b;font-size:0.85rem;margin-bottom:20px;">Pimpinan Anak Cabang IPNU &amp; IPPNU Kecamatan Kemiri — Masa Khidmat 2025-2027</p>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                            {{-- IPNU --}}
                            <div style="border:1px solid #e2e8f0;border-radius:10px;overflow:hidden;">
                                <div style="background:linear-gradient(90deg,var(--primary),var(--primary-dark));color:white;padding:10px 14px;font-weight:800;font-size:0.92rem;font-style:italic;">Susunan Pengurus IPNU</div>
                                <img src="{{ asset('images/STRUKTUR IPNU.jpg') }}" alt="Foto Bersama IPNU" style="width:100%;display:block;object-fit:cover;max-height:240px;border-bottom:3px solid var(--primary);">
                                <div style="padding:14px;">
                                    @php $ipnuMain = $officials->where('type','bph')->where('organization','IPNU'); @endphp
                                    @foreach($ipnuMain->groupBy('section') as $sec => $members)
                                        <div style="margin-bottom:14px;">
                                            <div style="background:linear-gradient(90deg,var(--primary),var(--primary-dark));color:white;padding:5px 12px;font-weight:700;font-size:0.82rem;border-radius:4px;margin-bottom:6px;">{{ $sec }}</div>
                                            <ul style="list-style:disc;padding-left:20px;margin:0;">
                                                @foreach($members as $person)
                                                    <li style="padding:2px 0;font-size:0.82rem;color:#1e293b;line-height:1.45;">
                                                        @if($person->position !== $sec && $person->position !== 'Anggota')
                                                            <strong style="color:var(--primary-dark);">{{ $person->position }}:</strong>
                                                        @endif
                                                        {{ $person->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                    @if($ipnuMain->isEmpty())
                                        <p style="text-align:center;color:#94a3b8;padding:16px;">Data belum tersedia</p>
                                    @endif
                                </div>
                            </div>

                            {{-- IPPNU --}}
                            <div style="border:1px solid #e2e8f0;border-radius:10px;overflow:hidden;">
                                <div style="background:linear-gradient(90deg,var(--primary),var(--primary-dark));color:white;padding:10px 14px;font-weight:800;font-size:0.92rem;font-style:italic;">Susunan Pengurus IPPNU</div>
                                <img src="{{ asset('images/STRUKTUR IPPNU.jpeg') }}" alt="Foto Bersama IPPNU" style="width:100%;display:block;object-fit:cover;max-height:240px;border-bottom:3px solid var(--primary);">
                                <div style="padding:14px;">
                                    @php $ippnuMain = $officials->where('type','bph')->where('organization','IPPNU'); @endphp
                                    @foreach($ippnuMain->groupBy('section') as $sec => $members)
                                        <div style="margin-bottom:14px;">
                                            <div style="background:linear-gradient(90deg,var(--primary),var(--primary-dark));color:white;padding:5px 12px;font-weight:700;font-size:0.82rem;border-radius:4px;margin-bottom:6px;">{{ $sec }}</div>
                                            <ul style="list-style:disc;padding-left:20px;margin:0;">
                                                @foreach($members as $person)
                                                    <li style="padding:2px 0;font-size:0.82rem;color:#1e293b;line-height:1.45;">
                                                        @if($person->position !== $sec && $person->position !== 'Anggota')
                                                            <strong style="color:var(--primary-dark);">{{ $person->position }}:</strong>
                                                        @endif
                                                        {{ $person->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                    @if($ippnuMain->isEmpty())
                                        <p style="text-align:center;color:#94a3b8;padding:16px;">Data belum tersedia</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kirim Artikel Publik Section -->
                    <div class="na-wrapper" id="kirim-artikel" style="margin-top: 16px;">
                        <div class="na-header">
                            <span>✍️ UPLOAD ARTIKEL BERITA</span>
                        </div>
                        <div style="padding: 24px; background: white;">
                            @if(session('success_article'))
                                <div style="background: #dcfce7; color: #166534; padding: 16px; border-radius: 8px; margin-bottom: 20px; font-weight: 600; display: flex; align-items: center; gap: 10px;">
                                    <i class="fa-solid fa-circle-check" style="font-size:1.2rem;"></i> {{ session('success_article') }}
                                </div>
                            @endif

                            <div style="background: var(--bg-light); padding: 16px; border-radius: 8px; border: 1px solid var(--border); margin-bottom: 20px; font-size: 0.9rem; color: var(--text-dark); line-height: 1.5;">
                                <strong style="color:var(--primary);"><i class="fa-solid fa-circle-info"></i> Panduan Mengirim Artikel:</strong><br>
                                Anda dapat mengirimkan artikel atau berita untuk ditayangkan di website PAC IPNU IPPNU Kemiri. Semua artikel yang masuk akan diverifikasi terlebih dahulu oleh admin sebelum dipublikasikan. Pastikan artikel yang dikirim sesuai dengan nilai-nilai Ahlussunnah wal Jama'ah.
                            </div>

                            <form action="{{ route('artikel.submit.public') }}" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:16px;">
                                @csrf
                                <div>
                                    <label style="font-weight:600; font-size:0.9rem; margin-bottom:6px; display:block;">Judul Artikel <span style="color:red;">*</span></label>
                                    <input type="text" name="title" required placeholder="Masukkan judul artikel" style="width:100%; padding:12px 14px; border:1px solid #cbd5e1; border-radius:8px; font-family:inherit; box-sizing:border-box;">
                                </div>
                                
                                <div style="display:flex; gap:16px; flex-wrap:wrap;">
                                    <div style="flex:1; min-width:200px;">
                                        <label style="font-weight:600; font-size:0.9rem; margin-bottom:6px; display:block;">Nama Penulis <span style="color:red;">*</span></label>
                                        <input type="text" name="author" required placeholder="Nama lengkap Anda" style="width:100%; padding:12px 14px; border:1px solid #cbd5e1; border-radius:8px; font-family:inherit; box-sizing:border-box;">
                                    </div>
                                    <div style="flex:1; min-width:200px;">
                                        <label style="font-weight:600; font-size:0.9rem; margin-bottom:6px; display:block;">Kontak (No WA / Email) <span style="color:red;">*</span></label>
                                        <input type="text" name="contact" required placeholder="Untuk konfirmasi admin" style="width:100%; padding:12px 14px; border:1px solid #cbd5e1; border-radius:8px; font-family:inherit; box-sizing:border-box;">
                                    </div>
                                </div>

                                <div>
                                    <label style="font-weight:600; font-size:0.9rem; margin-bottom:6px; display:block;">Foto / Gambar Utama <span style="color:red;">*</span> (Maks 2MB)</label>
                                    <input type="file" name="image" accept="image/*" required style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:8px; background:#f8fafc; font-family:inherit; box-sizing:border-box;">
                                </div>

                                <div>
                                    <label style="font-weight:600; font-size:0.9rem; margin-bottom:6px; display:block;">Isi Artikel <span style="color:red;">*</span></label>
                                    <textarea name="content" required rows="8" placeholder="Tuliskan isi berita/artikel Anda di sini..." style="width:100%; padding:12px 14px; border:1px solid #cbd5e1; border-radius:8px; font-family:inherit; box-sizing:border-box; resize:vertical;"></textarea>
                                </div>

                                <button type="submit" style="background:var(--primary); color:white; border:none; padding:14px; border-radius:8px; font-weight:700; font-size:1rem; cursor:pointer; font-family:'Outfit', sans-serif; display:flex; align-items:center; justify-content:center; gap:8px;">
                                    <i class="fa-solid fa-paper-plane"></i> Kirim Artikel Sekarang
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Galeri Dokumentasi Widget -->
                    <div class="na-wrapper" id="galeri" style="margin-top: 16px;">
                        <div class="na-header">
                            <span>GALERI DOKUMENTASI</span>
                            <div class="na-icons"><span></span><span></span><span></span><span></span></div>
                        </div>
                        @php
                            $availableCategories = isset($allGalleries) && $allGalleries->count() > 0 ? $allGalleries->pluck('category')->unique()->filter()->values() : collect();
                            if ($availableCategories->isEmpty()) {
                                $availableCategories = collect(['Kegiatan', 'Prestasi', 'Konferensi', 'Lainnya']);
                            }

                            $displayGalleries = isset($allGalleries) && $allGalleries->count() > 0 ? $allGalleries : collect([
                                (object) ['id' => 1, 'title' => 'Pelatihan Jurnalistik', 'category' => 'Kegiatan', 'image' => 'images/hero_bg.png'],
                                (object) ['id' => 2, 'title' => 'Juara 1 Lomba Hadroh', 'category' => 'Prestasi', 'image' => 'images/students_study.png'],
                                (object) ['id' => 3, 'title' => 'Konferensi Anak Cabang', 'category' => 'Konferensi', 'image' => 'images/alun_alun_kemiri.png'],
                                (object) ['id' => 4, 'title' => 'Makesta Raya', 'category' => 'Kegiatan', 'image' => 'images/hero_bg.png'],
                                (object) ['id' => 5, 'title' => 'Rapat Kerja PAC', 'category' => 'Konferensi', 'image' => 'images/students_study.png'],
                                (object) ['id' => 6, 'title' => 'Kunjungan Tokoh', 'category' => 'Lainnya', 'image' => 'images/alun_alun_kemiri.png'],
                            ]);
                        @endphp

                        <div style="padding: 10px 16px 0 16px;">
                            <div class="gallery-category-tabs"
                                style="display: flex; gap: 8px; overflow-x: auto; padding-bottom: 8px; scrollbar-width: none;">
                                <button class="gallery-tab-btn active" onclick="filterGallery('Semua', this)"
                                    style="padding: 6px 16px; border-radius: 20px; border: none; background: var(--primary); color: white; font-weight: 600; cursor: pointer; white-space: nowrap; font-size: 0.85rem; transition: all 0.3s ease;">Semua</button>
                                @foreach($availableCategories as $cat)
                                    <button class="gallery-tab-btn" onclick="filterGallery('{{ $cat }}', this)"
                                        style="padding: 6px 16px; border-radius: 20px; border: none; background: #f3f4f6; color: #4b5563; font-weight: 600; cursor: pointer; white-space: nowrap; font-size: 0.85rem; transition: all 0.3s ease;">{{ $cat }}</button>
                                @endforeach
                            </div>
                        </div>

                        <div class="gallery-grid" id="main-gallery-grid" style="padding-top: 8px;">
                            @foreach($displayGalleries as $gallery)
                                @php
                                    $imagePath = isset($gallery->image) && Str::startsWith($gallery->image, 'images/')
                                        ? asset($gallery->image)
                                        : asset('storage/' . ($gallery->image ?? ''));
                                @endphp
                                <div class="gallery-item" data-category="{{ $gallery->category ?? 'Umum' }}"
                                    onclick="openGalleryViewer('{{ $imagePath }}', '{{ $gallery->title }}')">
                                    <img src="{{ $imagePath }}" alt="{{ $gallery->title }}"
                                        onerror="this.src='{{ asset('images/alun_alun_kemiri.png') }}'">
                                    <div class="gallery-overlay">
                                        <h4 class="gallery-title">{{ $gallery->title }}</h4>
                                        <span
                                            style="font-size: 0.7rem; color: #facc15; font-weight: 700; text-transform: uppercase;">{{ $gallery->category ?? 'Umum' }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <script>
                            function filterGallery(category, btn) {
                                document.querySelectorAll('.gallery-tab-btn').forEach(b => {
                                    b.style.background = '#f3f4f6';
                                    b.style.color = '#4b5563';
                                    b.classList.remove('active');
                                });
                                btn.style.background = 'var(--primary)';
                                btn.style.color = 'white';
                                btn.classList.add('active');

                                const items = document.querySelectorAll('#main-gallery-grid .gallery-item');
                                items.forEach(item => {
                                    if (category === 'Semua' || item.getAttribute('data-category') === category) {
                                        item.style.display = 'block';
                                        item.style.animation = 'galleryFadeIn 0.4s ease-out forwards';
                                    } else {
                                        item.style.display = 'none';
                                    }
                                });
                            }
                        </script>
                        <style>
                            @keyframes galleryFadeIn {
                                from {
                                    opacity: 0;
                                    transform: scale(0.95);
                                }

                                to {
                                    opacity: 1;
                                    transform: scale(1);
                                }
                            }

                            .gallery-category-tabs::-webkit-scrollbar {
                                display: none;
                            }
                        </style>
                    </div>

        </main>
        <!-- Right Column -->
        <aside class="desktop-right">
            <div class="dr-greeting">
                <div>
                    <p>Selamat malam dan<br>selamat beristirahat</p>
                    <a href="javascript:void(0)" onclick="toggleProfil()"
                        style="color: var(--accent); font-size: 0.8rem; font-weight: 700; text-decoration: underline; margin-top: 8px; display: inline-block;">Buka
                        Profil Organisasi</a>
                </div>
                <span>🌙</span>
            </div>

            <div class="dr-arsip">
                <div class="dr-arsip-header">
                    <i class="fa-solid fa-folder-open"></i> ARSIP ARTIKEL
                </div>
                <div class="dr-arsip-tabs">
                    <div class="dr-arsip-tab active" onclick="switchArsipTab('populer', this)">Populer</div>
                    <div class="dr-arsip-tab" onclick="switchArsipTab('terbaru', this)">Terbaru</div>
                </div>

                <!-- Tab Content: Populer -->
                <div id="arsip-populer" class="arsip-list">
                    @forelse($popularArticles as $article)
                        <a href="{{ route('artikel.show', $article->slug) }}" class="arsip-item">
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                                class="arsip-thumb" onerror="this.src='{{ asset('images/hero_bg.png') }}'">
                            <div class="arsip-text">
                                <span class="arsip-views">{{ number_format($article->views_count, 0, ',', '.') }} Kali
                                    dibuka</span>
                                <span class="arsip-title">{{ Str::limit($article->title, 60) }}</span>
                            </div>
                        </a>
                    @empty
                        <div style="padding: 20px; text-align: center; color: #6b7280; font-size: 0.9rem;">Belum ada
                            artikel.</div>
                    @endforelse
                </div>

                <!-- Tab Content: Terbaru -->
                <div id="arsip-terbaru" class="arsip-list" style="display: none;">
                    @forelse($latestArticles as $article)
                        <a href="{{ route('artikel.show', $article->slug) }}" class="arsip-item">
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                                class="arsip-thumb" onerror="this.src='{{ asset('images/hero_bg.png') }}'">
                            <div class="arsip-text">
                                <span
                                    class="arsip-views">{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->diffForHumans() : 'Baru saja' }}</span>
                                <span class="arsip-title">{{ Str::limit($article->title, 60) }}</span>
                            </div>
                        </a>
                    @empty
                        <div style="padding: 20px; text-align: center; color: #6b7280; font-size: 0.9rem;">Belum ada
                            artikel.</div>
                    @endforelse
                </div>

                <script>
                    function switchArsipTab(tabName, element) {
                        // Reset active class on tabs
                        const tabs = element.parentElement.querySelectorAll('.dr-arsip-tab');
                        tabs.forEach(tab => tab.classList.remove('active'));
                        element.classList.add('active');

                        // Hide all contents
                        document.getElementById('arsip-populer').style.display = 'none';
                        document.getElementById('arsip-terbaru').style.display = 'none';

                        // Show selected content
                        document.getElementById('arsip-' + tabName).style.display = 'block';
                    }
                </script>
            </div>

            <!-- Sticky Bottom Container -->
            <div class="dr-sticky-container">
                <!-- New Sidebar Widgets -->
                <div id="agenda" class="dr-widget">
                    <div class="dr-widget-header"><i class="fa-solid fa-calendar-days"></i> AGENDA TERDEKAT</div>
                    <div style="padding: 16px; display: flex; flex-direction: column; gap: 12px;">
                        @forelse($agendas as $agenda)
                        <div style="border-left: 3px solid var(--accent); padding-left: 12px;">
                            <div style="font-weight: 700; color: #111; font-size: 0.9rem;">{{ $agenda->title }}</div>
                            <div style="font-size: 0.8rem; color: #4b5563; margin-top: 4px;"><i
                                    class="fa-regular fa-calendar" style="margin-right:4px;"></i> {{ \Carbon\Carbon::parse($agenda->date)->format('d M Y') }} | <i
                                    class="fa-solid fa-location-dot" style="margin-right:4px;"></i> {{ $agenda->location }}</div>
                        </div>
                        @empty
                        <div style="font-size: 0.8rem; color: #4b5563; font-style: italic;">Belum ada agenda terdekat.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Jam Kerja / Pelayanan Widget -->
                <div class="dr-widget">
                    <div class="dr-widget-header"><i class="fa-solid fa-clock"></i> PELAYANAN SEKRETARIAT</div>
                    <div style="padding: 0;">
                        <table style="width: 100%; border-collapse: collapse; font-size: 0.85rem;">
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <td style="padding: 10px 16px; color: #4b5563; font-weight: 600;">Senin - Jumat</td>
                                <td style="padding: 10px 16px; text-align: right; font-weight: 700; color: #111;">09:00
                                    - 16:00</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <td style="padding: 10px 16px; color: #4b5563; font-weight: 600;">Sabtu</td>
                                <td style="padding: 10px 16px; text-align: right; font-weight: 700; color: #111;">09:00
                                    - 13:00</td>
                            </tr>
                            <tr style="background: rgba(255,0,0,0.05);">
                                <td style="padding: 10px 16px; color: #ef4444; font-weight: 600;">Minggu / Libur</td>
                                <td style="padding: 10px 16px; text-align: right; font-weight: 800; color: #ef4444;">
                                    Sesuai Janji</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="dr-widget">
                    <div class="dr-widget-header"><i class="fa-solid fa-handshake"></i> SINERGI PROGRAM</div>
                    <div style="padding: 16px; display: flex; flex-direction: column; gap: 12px;">
                        @forelse($programs as $program)
                        <div style="display:flex; align-items:flex-start; gap:10px;">
                            <div style="width:36px; height:36px; background:#f1f5f9; border-radius:8px; display:flex; align-items:center; justify-content:center; color:var(--primary); font-size:1.1rem; flex-shrink:0;">
                                <i class="{{ $program->icon ?? 'fa-solid fa-handshake' }}"></i>
                            </div>
                            <div>
                                <div style="font-weight: 700; color: #111; font-size: 0.85rem;">{{ $program->title }}</div>
                                @if($program->description)
                                <div style="font-size: 0.75rem; color: #64748b; margin-top: 2px;">{{ Str::limit($program->description, 60) }}</div>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div style="font-size: 0.8rem; color: #4b5563; font-style: italic;">Belum ada program.</div>
                        @endforelse
                    </div>
                </div>

                <div class="dr-widget">
                    <div class="dr-widget-header"><i class="fa-solid fa-comments"></i> KOMENTAR TERBARU</div>
                    <div style="padding: 16px; display: flex; flex-direction: column; gap: 12px;">
                        @forelse($recentComments as $comment)
                            <div style="display: flex; gap: 12px; align-items: flex-start;">
                                <div
                                    style="width: 32px; height: 32px; background: #e5e7eb; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #9ca3af; flex-shrink: 0; font-size: 0.8rem;">
                                    {{ strtoupper(substr($comment->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div style="font-weight: 700; font-size: 0.85rem; color: #111;">{{ $comment->name }}
                                    </div>
                                    <div style="font-size: 0.8rem; color: #4b5563; line-height: 1.4;">
                                        "{{ Str::limit($comment->message, 60) }}"</div>
                                    <div style="font-size: 0.7rem; color: #9ca3af; margin-top: 4px;">
                                        {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div style="font-size: 0.85rem; color: #6b7280; text-align: center;">Belum ada komentar terbaru.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="dr-widget">
                    <div class="dr-widget-header"><i class="fa-solid fa-mobile-screen"></i> MEDIA SOSIAL</div>
                    <div style="padding: 16px; display: flex; gap: 8px; justify-content: center;">
                        <a href="https://www.instagram.com/pac_ipnuippnukemiri?igsh=Zm44MGc3Z3p4NmEz" target="_blank"
                            style="background: #e1306c; color: white; width: 40px; height: 40px; border-radius: 4px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 1.2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><i
                                class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.tiktok.com/@pacipnuippnukemiri?_r=1&_t=ZS-96jKzJUfTsH" target="_blank"
                            style="background: #000000; color: white; width: 40px; height: 40px; border-radius: 4px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 1.2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><i
                                class="fa-brands fa-tiktok"></i></a>
                        <a href="https://youtube.com/@pacipnuippnukemiri?si=N8tbisjmz1PQtni-" target="_blank"
                            style="background: #ff0000; color: white; width: 40px; height: 40px; border-radius: 4px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 1.2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><i
                                class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>

                <div class="dr-widget">
                    <div class="dr-widget-header"><i class="fa-solid fa-chart-column"></i> STATISTIK PENGUNJUNG</div>
                    <div style="padding: 0;">
                        <table style="width: 100%; border-collapse: collapse; font-size: 0.85rem;">
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <td style="padding: 10px 16px; color: #4b5563;">Hari Ini</td>
                                <td style="padding: 10px 16px; text-align: right; font-weight: 700; color: #111;">{{ number_format($visitorStats['today']) }}</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <td style="padding: 10px 16px; color: #4b5563;">Kemarin</td>
                                <td style="padding: 10px 16px; text-align: right; font-weight: 700; color: #111;">{{ number_format($visitorStats['yesterday']) }}</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #f3f4f6; background: rgba(0,0,0,0.03);">
                                <td style="padding: 10px 16px; color: var(--primary); font-weight: 700;">Total Pengunjung</td>
                                <td style="padding: 10px 16px; text-align: right; font-weight: 800; color: var(--primary);">{{ number_format($visitorStats['total']) }}</td>
                            </tr>
                        </table>
                        <div style="background: #f9fafb; padding: 12px 16px; border-top: 1px solid #e5e7eb; font-size: 0.8rem; color: #4b5563; line-height: 1.6;">
                            <div style="display: flex; justify-content: space-between; border-bottom: 1px dashed #e5e7eb; padding-bottom: 4px; margin-bottom: 4px;">
                                <span>OS:</span> <strong style="color: #111;">{{ $visitorStats['os'] }}</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; border-bottom: 1px dashed #e5e7eb; padding-bottom: 4px; margin-bottom: 4px;">
                                <span>Browser:</span> <strong style="color: #111;">{{ $visitorStats['browser'] }}</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span>IP Address:</span> <strong style="color: #111;">{{ $visitorStats['ip'] }}</strong>
                            </div>
                        </div>
                    </div>
                </div><!-- /.dr-widget (statistik pengunjung) -->
            </div><!-- /.dr-sticky-container -->
        </aside>
        <!-- transparansi and maps blocks follow, still inside .desktop-layout -->

        <!-- Statistik Anggota Block -->
        <div id="section-statistik" style="margin-top: 40px; margin-bottom: 40px; width: 100%;">
            <style>
                .desa-stat-container {
                    background: #ffffff;
                    border-radius: 12px;
                    padding: 50px 30px 40px 30px;
                    position: relative;
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                    border: 1px solid #e2e8f0;
                }

                .stat-grid-top {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 20px;
                    margin-bottom: 24px;
                }

                .stat-grid-bottom {
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                    gap: 14px;
                }

                @media(max-width: 768px) {
                    .stat-grid-top,
                    .stat-grid-bottom {
                        grid-template-columns: 1fr;
                    }
                }

                .desa-stat-header-pill {
                    position: absolute;
                    top: -20px;
                    left: 50%;
                    transform: translateX(-50%);
                    background: var(--primary);
                    color: white;
                    font-weight: 800;
                    padding: 10px 40px;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                    font-size: 1.1rem;
                    letter-spacing: 2px;
                    z-index: 10;
                    white-space: nowrap;
                    font-family: 'Outfit', sans-serif;
                }

                .desa-stat-content {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    position: relative;
                    min-height: 240px;
                    gap: 16px;
                }

                .desa-stat-center-circle {
                    position: absolute;
                    left: 50%;
                    top: 50%;
                    transform: translate(-50%, -50%);
                    width: 160px;
                    height: 160px;
                    background: white;
                    border-radius: 50%;
                    border: 5px solid var(--primary);
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
                    z-index: 5;
                }

                .desa-stat-center-title {
                    font-weight: 800;
                    font-size: 0.8rem;
                    margin-top: 6px;
                    color: var(--primary);
                    letter-spacing: 1.5px;
                    text-transform: uppercase;
                }

                .desa-stat-center-number {
                    font-weight: 900;
                    font-size: 2rem;
                    color: #0f172a;
                    line-height: 1;
                }

                .desa-stat-left,
                .desa-stat-right {
                    display: flex;
                    flex-direction: column;
                    gap: 14px;
                    width: 45%;
                    z-index: 2;
                }

                .desa-stat-left {
                    padding-right: 100px;
                    align-items: flex-end;
                }

                .desa-stat-right {
                    padding-left: 100px;
                    align-items: flex-start;
                }

                .desa-stat-pill {
                    background: white;
                    border-radius: 50px;
                    display: flex;
                    align-items: center;
                    padding: 6px;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                    border: 1px solid #e9ecef;
                    width: 100%;
                    max-width: 300px;
                    transition: all 0.2s ease;
                    cursor: pointer;
                }

                .desa-stat-pill:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
                    border-color: var(--primary-light);
                }

                .desa-stat-pill-left {
                    justify-content: space-between;
                    padding-left: 18px;
                }

                .desa-stat-pill-right {
                    justify-content: flex-start;
                    padding-right: 18px;
                }

                .desa-stat-pill-text {
                    font-weight: 600;
                    font-size: 0.82rem;
                    color: #334155;
                    flex: 1;
                }

                .desa-stat-pill-left .desa-stat-pill-text {
                    text-align: left;
                }

                .desa-stat-pill-right .desa-stat-pill-text {
                    text-align: right;
                    padding-left: 12px;
                }

                .desa-stat-pill-icon {
                    width: 38px;
                    height: 38px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 1rem;
                    flex-shrink: 0;
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
                }

                /* Divider line between pills and gender stats */
                .desa-stat-divider {
                    height: 1px;
                    background: #e2e8f0;
                    margin: 24px 0 20px;
                }

                .desa-stat-bottom {
                    display: flex;
                    justify-content: center;
                    gap: 48px;
                }

                .desa-stat-gender {
                    display: flex;
                    align-items: center;
                    gap: 14px;
                }

                .desa-stat-gender-val {
                    font-weight: 900;
                    font-size: 1.3rem;
                    line-height: 1.2;
                    text-align: center;
                    color: #0f172a;
                }

                .desa-stat-gender-val small {
                    font-weight: 700;
                    font-size: 0.7rem;
                    color: #64748b;
                    letter-spacing: 1px;
                    display: block;
                }

                .desa-stat-gender-avatar {
                    width: 52px;
                    height: 52px;
                    border-radius: 50%;
                    background: white;
                    padding: 2px;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
                    object-fit: cover;
                }

                @media(max-width: 768px) {
                    .desa-stat-container {
                        padding: 44px 10px 20px 10px;
                    }

                    .desa-stat-content {
                        min-height: 200px;
                    }

                    .desa-stat-center-circle {
                        width: 90px;
                        height: 90px;
                        border-width: 3px;
                    }

                    .desa-stat-center-circle i {
                        font-size: 1.4rem !important;
                        margin-bottom: 2px !important;
                    }

                    .desa-stat-center-title {
                        font-size: 0.5rem;
                        margin-top: 2px;
                    }

                    .desa-stat-center-number {
                        font-size: 1rem;
                    }

                    .desa-stat-left {
                        padding-right: 55px;
                        gap: 8px;
                    }

                    .desa-stat-right {
                        padding-left: 55px;
                        gap: 8px;
                    }

                    .desa-stat-pill {
                        padding: 4px;
                    }

                    .desa-stat-pill-icon {
                        width: 26px;
                        height: 26px;
                        font-size: 0.7rem;
                    }

                    .desa-stat-pill-text {
                        font-size: 0.58rem;
                    }

                    .desa-stat-pill-left {
                        padding-left: 8px;
                    }

                    .desa-stat-pill-right {
                        padding-right: 8px;
                    }

                    .desa-stat-pill-right .desa-stat-pill-text {
                        padding-left: 6px;
                    }

                    .desa-stat-bottom {
                        gap: 20px;
                    }

                    .desa-stat-gender-avatar {
                        width: 38px;
                        height: 38px;
                    }

                    .desa-stat-gender-val {
                        font-size: 1rem;
                    }
                }
            </style>


            <div class="desa-stat-container">
                <div class="desa-stat-header-pill">STATISTIK ANGGOTA</div>

                <div class="stat-grid-top">
                    {{-- IPNU --}}
                    <div style="background:linear-gradient(135deg,#e8f0fe 0%,#f8faff 100%);border-radius:12px;padding:20px;border:1px solid #c7d9fb;display:flex;align-items:center;gap:16px;flex-wrap:wrap;justify-content:center;text-align:center;">
                        <div style="width:56px;height:56px;overflow:hidden;flex-shrink:0;display:flex;justify-content:center;">
                            <img src="{{ asset('images/LOGO RESMI IPNUIPPNU by diqies 2.png') }}" style="height:56px;width:auto;max-width:none;object-fit:contain;" alt="Logo IPNU">
                        </div>
                        <div>
                            <div style="font-size:0.72rem;font-weight:800;color:var(--primary);text-transform:uppercase;letter-spacing:1.5px;margin-bottom:4px;">⬤ TOTAL ANGGOTA IPNU</div>
                            <div style="font-size:2.2rem;font-weight:900;color:#0f172a;line-height:1;margin-bottom:4px;">31,340</div>
                            <div style="font-size:0.78rem;color:#64748b;font-weight:600;">Rekan IPNU Terverifikasi</div>
                            <div style="margin-top:8px;height:4px;background:linear-gradient(90deg,var(--primary),var(--accent));border-radius:4px;width:80%;margin-left:auto;margin-right:auto;"></div>
                        </div>
                    </div>
                    {{-- IPPNU --}}
                    <div style="background:linear-gradient(135deg,#fef3e8 0%,#fffaf5 100%);border-radius:12px;padding:20px;border:1px solid #fbd8a8;display:flex;align-items:center;gap:16px;flex-wrap:wrap;justify-content:center;text-align:center;">
                        <div style="width:56px;height:56px;overflow:hidden;flex-shrink:0;display:flex;justify-content:center;">
                            <img src="{{ asset('images/LOGO RESMI IPNUIPPNU by diqies 2.png') }}" style="height:56px;width:auto;max-width:none;object-fit:contain;" alt="Logo IPPNU">
                        </div>
                        <div>
                            <div style="font-size:0.72rem;font-weight:800;color:#c2410c;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:4px;">⬤ TOTAL ANGGOTA IPPNU</div>
                            <div style="font-size:2.2rem;font-weight:900;color:#0f172a;line-height:1;margin-bottom:4px;">37,197</div>
                            <div style="font-size:0.78rem;color:#64748b;font-weight:600;">Rekanita IPPNU Terverifikasi</div>
                            <div style="margin-top:8px;height:4px;background:linear-gradient(90deg,#c2410c,#f97316);border-radius:4px;width:80%;margin-left:auto;margin-right:auto;"></div>
                        </div>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="desa-stat-divider"></div>

                {{-- Grid Stats: Anak Cabang, Ranting, Komisariat --}}
                <div class="stat-grid-bottom">
                    {{-- Anak Cabang --}}
                    <div style="background:#f8faff;border-radius:12px;padding:16px;border:1px solid #e2e8f0;text-align:center;">
                        <div style="width:44px;height:44px;background:linear-gradient(135deg,#1e3a8a,#3b82f6);border-radius:10px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;box-shadow:0 4px 10px rgba(30,58,138,0.3);">
                            <i class="fa-solid fa-building" style="color:white;font-size:1.1rem;"></i>
                        </div>
                        <div style="font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:10px;">Anak Cabang</div>
                        <div style="display:flex;justify-content:center;gap:16px;">
                            <div>
                                <div style="font-size:1.5rem;font-weight:900;color:#1e3a8a;line-height:1;">482</div>
                                <div style="font-size:0.62rem;color:var(--primary);font-weight:700;margin-top:2px;">IPNU</div>
                            </div>
                            <div style="width:1px;background:#e2e8f0;"></div>
                            <div>
                                <div style="font-size:1.5rem;font-weight:900;color:#c2410c;line-height:1;">510</div>
                                <div style="font-size:0.62rem;color:#c2410c;font-weight:700;margin-top:2px;">IPPNU</div>
                            </div>
                        </div>
                    </div>
                    {{-- Ranting (Desa) --}}
                    <div style="background:#f8faff;border-radius:12px;padding:16px;border:1px solid #e2e8f0;text-align:center;">
                        <div style="width:44px;height:44px;background:linear-gradient(135deg,#065f46,#10b981);border-radius:10px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;box-shadow:0 4px 10px rgba(6,95,70,0.3);">
                            <i class="fa-solid fa-tree-city" style="color:white;font-size:1.1rem;"></i>
                        </div>
                        <div style="font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:10px;">Ranting (Desa)</div>
                        <div style="display:flex;justify-content:center;gap:16px;">
                            <div>
                                <div style="font-size:1.5rem;font-weight:900;color:#065f46;line-height:1;">2,750</div>
                                <div style="font-size:0.62rem;color:var(--primary);font-weight:700;margin-top:2px;">IPNU</div>
                            </div>
                            <div style="width:1px;background:#e2e8f0;"></div>
                            <div>
                                <div style="font-size:1.5rem;font-weight:900;color:#c2410c;line-height:1;">2,566</div>
                                <div style="font-size:0.62rem;color:#c2410c;font-weight:700;margin-top:2px;">IPPNU</div>
                            </div>
                        </div>
                    </div>
                    {{-- Komisariat Sekolah --}}
                    <div style="background:#f8faff;border-radius:12px;padding:16px;border:1px solid #e2e8f0;text-align:center;">
                        <div style="width:44px;height:44px;background:linear-gradient(135deg,#5b21b6,#8b5cf6);border-radius:10px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;box-shadow:0 4px 10px rgba(91,33,182,0.3);">
                            <i class="fa-solid fa-school" style="color:white;font-size:1.1rem;"></i>
                        </div>
                        <div style="font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:10px;">Komisariat Sekolah</div>
                        <div style="display:flex;justify-content:center;gap:16px;">
                            <div>
                                <div style="font-size:1.5rem;font-weight:900;color:#5b21b6;line-height:1;">880</div>
                                <div style="font-size:0.62rem;color:var(--primary);font-weight:700;margin-top:2px;">IPNU</div>
                            </div>
                            <div style="width:1px;background:#e2e8f0;"></div>
                            <div>
                                <div style="font-size:1.5rem;font-weight:900;color:#c2410c;line-height:1;">804</div>
                                <div style="font-size:0.62rem;color:#c2410c;font-weight:700;margin-top:2px;">IPPNU</div>
                            </div>
                        </div>
                    </div>
                    {{-- Komisariat Pondok Pesantren --}}
                    <div style="background:#f8faff;border-radius:12px;padding:16px;border:1px solid #e2e8f0;text-align:center;">
                        <div style="width:44px;height:44px;background:linear-gradient(135deg,#b45309,#d97706);border-radius:10px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;box-shadow:0 4px 10px rgba(180,83,9,0.3);">
                            <i class="fa-solid fa-mosque" style="color:white;font-size:1.1rem;"></i>
                        </div>
                        <div style="font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:10px;">Komisariat Pondok Pesantren</div>
                        <div style="display:flex;justify-content:center;gap:16px;">
                            <div>
                                <div style="font-size:1.5rem;font-weight:900;color:#b45309;line-height:1;">450</div>
                                <div style="font-size:0.62rem;color:var(--primary);font-weight:700;margin-top:2px;">IPNU</div>
                            </div>
                            <div style="width:1px;background:#e2e8f0;"></div>
                            <div>
                                <div style="font-size:1.5rem;font-weight:900;color:#c2410c;line-height:1;">420</div>
                                <div style="font-size:0.62rem;color:#c2410c;font-weight:700;margin-top:2px;">IPPNU</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sumber data --}}
                <div style="text-align:center;margin-top:16px;font-size:0.72rem;color:#94a3b8;">
                    <i class="fa-solid fa-circle-info"></i> Sumber: <a href="https://sipadu.or.id" target="_blank" style="color:var(--primary);font-weight:700;">sipadu.or.id</a> — Data Real-time PW IPNU &amp; IPPNU Jawa Tengah
                </div>
            </div>
        </div>
        <!-- Maps Block -->
        <div class="maps-block">
            <div class="map-card">
                <div class="map-label"><i class="fa-solid fa-building-circle-check"></i> LOKASI KANTOR PAC</div>
                <div class="map-content">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.734842542488!2d109.9042567890!3d-7.632156890123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a8ca16f5c862d%3A0x4027a765a3717a0!2sKemiri%2C%20Kec.%20Kemiri%2C%20Kabupaten%20Purworejo%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1714630000000!5m2!1sid!2sid"
                        allowfullscreen="" loading="lazy"></iframe>
                    <a href="https://maps.app.goo.gl/qJdrVL3cghZddma99" target="_blank" class="map-btn-float">
                        <i class="fa-solid fa-location-arrow"></i> Rute
                    </a>
                </div>
            </div>
            <div class="map-card">
                <div class="map-label"><i class="fa-solid fa-map-marked-alt"></i> WILAYAH KERJA PAC</div>
                <div class="map-info-left">
                    <div
                        style="background: #f1f5f9; padding: 12px; border-radius: 8px; border-left: 4px solid var(--primary);">
                        <div
                            style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">
                            Koordinat</div>
                        <strong>Lat:</strong> -7.7528<br>
                        <strong>Long:</strong> 109.9226
                    </div>
                    <div style="margin-top: 8px;">
                        <div
                            style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">
                            Alamat</div>
                        <p style="font-weight: 600; color: #334155; margin-bottom: 0;">PAC IPNU IPPNU Kemiri,<br>
                            Kecamatan Kemiri,<br>
                            Kabupaten Purworejo</p>
                    </div>
                </div>
                <div class="map-content">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31630.0!2d109.91!3d-7.64!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a8ca16f5c862d%3A0x4027a765a3717a0!2sKemiri%2C%20Kec.%20Kemiri%2C%20Kabupaten%20Purworejo%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1714630000000!5m2!1sid!2sid"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>

        <a href="#" class="scroll-top-btn"><i class="fa-solid fa-arrow-up"></i></a>






        <!-- Toast Notification -->
        <div class="toast" id="voteToast">
            <div class="toast-icon">✓</div>
            <span>Terima kasih! Suara Anda berhasil direkam.</span>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="footer-grid">
                    <div>
                        <a href="#" class="footer-logo">IPNU IPPNU <span>Kemiri</span></a>
                        <p class="footer-desc">Ikatan Pelajar Nahdlatul Ulama & Ikatan Pelajar Putri Nahdlatul Ulama
                            Kecamatan Kemiri. Berkhidmat tanpa batas, berinovasi tiada henti.</p>
                    </div>
                    <div>
                        <h4 class="footer-heading">Tautan Cepat</h4>
                        <ul class="footer-links">
                            <li><a href="#beranda">Beranda</a></li>
                            <li><a href="javascript:void(0)" onclick="toggleProfil()">Profil & Sejarah</a></li>
                            <li><a href="#agenda">Agenda Kegiatan</a></li>
                            <li><a href="#berita">Berita Terbaru</a></li>
                            <li><a href="{{ route('voting') }}">Polling Pemilu</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="footer-heading">Hubungi Kami</h4>
                        <ul class="footer-links">
                            <li>Sekretariat PAC IPNU IPPNU Kemiri</li>
                            <li>Kecamatan Kemiri, Purworejo, Jawa Tengah</li>
                            <li>Email: info@ipnukemiri.or.id</li>
                            <li>Telp: +62 812 3456 7890</li>
                        </ul>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>&copy; 2026 PAC IPNU IPPNU Kemiri. Dikembangkan dengan ❤️ untuk kemajuan Pelajar NU.</p>
                </div>
            </div>
        </footer>

    </div><!-- /.desktop-layout -->
    <div class="toast-icon">✓</div>
    <span></span>
    </div>

    <script>
        // --- REAL TIME CLOCK ---
        document.addEventListener('DOMContentLoaded', () => {
            function updateRealTimeClock() {
                const dateElement = document.getElementById('current-date');
                if (!dateElement) return;

                const now = new Date();

                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                const dayName = days[now.getDay()];
                const date = now.getDate();
                const monthName = months[now.getMonth()];
                const year = now.getFullYear();

                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');

                dateElement.innerHTML = `<span class="desktop-time">${dayName}, ${date} ${monthName} ${year} - </span><span class="mobile-time">${hours}:${minutes}:${seconds} WIB</span>`;
            }
            setInterval(updateRealTimeClock, 1000);
            updateRealTimeClock();
        });

        // --- GLOBAL THEME DATA ---
        const themes = {
            'theme1': { primary: 'rgb(21, 128, 61)', light: 'rgb(34, 197, 94)', dark: 'rgb(20, 83, 45)', accent: 'rgb(250, 204, 21)' }, // Green NU (Default: Dark Green, Light Green, Gold Accent)
            'theme2': { primary: 'rgb(234, 88, 12)', light: 'rgb(251, 146, 60)', dark: 'rgb(154, 52, 18)', accent: 'rgb(253, 224, 71)' }, // Sunset Orange (Deep Orange, Pastel Orange, Yellow Gold)
            'theme3': { primary: 'rgb(225, 29, 72)', light: 'rgb(251, 113, 133)', dark: 'rgb(159, 18, 57)', accent: 'rgb(253, 224, 71)' }, // Rose Crimson (Deep Rose Red, Vibrant Pink, Yellow Gold)
            'theme4': { primary: 'rgb(37, 99, 235)', light: 'rgb(96, 165, 250)', dark: 'rgb(30, 58, 138)', accent: 'rgb(253, 224, 71)' }, // Ocean Blue (Vibrant Royal Blue, Sky Blue, Golden Accent)
            'theme5': { primary: 'rgb(13, 148, 136)', light: 'rgb(45, 212, 191)', dark: 'rgb(17, 94, 89)', accent: 'rgb(253, 224, 71)' }, // Modern Teal (Deep Teal, Fresh Turquoise, Gold Accent)
            'theme6': { primary: 'rgb(217, 119, 6)', light: 'rgb(251, 191, 36)', dark: 'rgb(120, 53, 4)', accent: 'rgb(254, 240, 138)' }, // Amber Gold (Deep Amber, Rich Yellow, Cream Accent)
            'theme7': { primary: 'rgb(220, 38, 38)', light: 'rgb(248, 113, 113)', dark: 'rgb(127, 29, 29)', accent: 'rgb(254, 240, 138)' }, // Scarlet Red (Rich Ruby Red, Light Coral, Light Yellow)
            'theme8': { primary: 'rgb(124, 58, 237)', light: 'rgb(167, 139, 250)', dark: 'rgb(76, 29, 149)', accent: 'rgb(253, 224, 71)' }  // Royal Purple (Vibrant Purple, Lavender, Gold Accent)
        };

        function setTheme(themeName) {
            const theme = themes[themeName];
            if (!theme) return;

            // Apply CSS Variables
            document.documentElement.style.setProperty('--primary', theme.primary);
            document.documentElement.style.setProperty('--primary-light', theme.light);
            document.documentElement.style.setProperty('--primary-dark', theme.dark);
            document.documentElement.style.setProperty('--accent', theme.accent);

            // Save to LocalStorage
            localStorage.setItem('selectedTheme', themeName);

            // Visual feedback
            const overlay = document.getElementById('theme-overlay');
            if (overlay) {
                overlay.style.opacity = '0';
                setTimeout(() => { overlay.style.display = 'none'; }, 300);
            }

            if (typeof showToast === 'function') {
                showToast('Tema ' + themeName.replace('theme', '') + ' telah aktif!');
            }
        }

        function toggleThemeMenu() {
            const overlay = document.getElementById('theme-overlay');
            if (!overlay) return;

            if (overlay.style.display === 'flex') {
                overlay.style.opacity = '0';
                setTimeout(() => { overlay.style.display = 'none'; }, 300);
            } else {
                overlay.style.display = 'flex';
                setTimeout(() => { overlay.style.opacity = '1'; }, 10);
            }
        }

        // --- HERO SLIDER LOGIC ---
        let currentSlide = 0;
        const slides = document.querySelectorAll('.hero-slide');

        function nextSlide() {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }

        setInterval(nextSlide, 5000); // Ganti gambar setiap 5 detik

        // --- BANNER SLIDER LOGIC (2 Seconds)
        function openGabungModal() {
            document.getElementById('gabung-modal').style.display = 'flex';
        }
        function closeGabungModal() {
            document.getElementById('gabung-modal').style.display = 'none';
        }

        let currentBannerSlide = 0;
        const bannerSlides = document.querySelectorAll('.dc-banner-slide');

        function nextBannerSlide() {
            if (bannerSlides.length === 0) return;
            bannerSlides[currentBannerSlide].classList.remove('active');
            currentBannerSlide = (currentBannerSlide + 1) % bannerSlides.length;
            bannerSlides[currentBannerSlide].classList.add('active');
        }

        setInterval(nextBannerSlide, 2000); // Ganti gambar setiap 2 detik sesuai permintaan

        // Sidebar Hero Scroll Effect (Shrink on scroll)
        window.addEventListener('scroll', () => {
            const leftHero = document.querySelector('.hero-bg-container');
            const logo = document.querySelector('.logo-3d');
            const title = document.querySelector('.hero-title-center');
            const subtitle = document.querySelector('.hero-subtitle-center');

            if (window.scrollY > 50) {
                if (leftHero) leftHero.classList.add('shrunk');
                if (logo) logo.classList.add('shrunk');
                if (title) title.classList.add('shrunk');
                if (subtitle) subtitle.classList.add('shrunk');
            } else {
                if (leftHero) leftHero.classList.remove('shrunk');
                if (logo) logo.classList.remove('shrunk');
                if (title) title.classList.remove('shrunk');
                if (subtitle) subtitle.classList.remove('shrunk');
            }
        });

        // Mobile menu toggle
        const mobileToggle = document.getElementById('mobile-toggle');
        const navLinks = document.getElementById('nav-links');
        const body = document.body;

        if (mobileToggle && navLinks) {
            mobileToggle.addEventListener('click', () => {
                mobileToggle.classList.toggle('active');
                navLinks.classList.toggle('active');

                if (navLinks.classList.contains('active')) {
                    body.style.overflow = 'hidden';
                } else {
                    body.style.overflow = '';
                }
            });

            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    mobileToggle.classList.remove('active');
                    navLinks.classList.remove('active');
                    body.style.overflow = '';
                });
            });
        }

        const btnMobileWrapper = document.querySelector('.btn-mobile-wrapper');
        const desktopBtn = document.querySelector('.desktop-btn');

        function handleResize() {
            if (window.innerWidth <= 768) {
                if (btnMobileWrapper) btnMobileWrapper.style.display = 'block';
                if (desktopBtn) desktopBtn.style.display = 'none';
            } else {
                if (btnMobileWrapper) btnMobileWrapper.style.display = 'none';
                if (desktopBtn) desktopBtn.style.display = 'inline-flex';
                if (navLinks && mobileToggle && navLinks.classList.contains('active')) {
                    mobileToggle.classList.remove('active');
                    navLinks.classList.remove('active');
                    body.style.overflow = '';
                }
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize();

        // Voting logic moved to voting.blade.php

        function showToast(message, isError = false) {
            const toast = document.getElementById('voteToast');
            if (!toast) return;
            toast.querySelector('span').innerText = message;

            if (isError) {
                toast.querySelector('.toast-icon').innerText = '!';
                toast.querySelector('.toast-icon').style.background = '#ef4444';
            } else {
                toast.querySelector('.toast-icon').innerText = '✓';
                toast.querySelector('.toast-icon').style.background = 'var(--primary)';
            }

            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
            }, 4000);
        }

        function showSection(sectionId) {
            const loader = document.getElementById('page-loader');

            if (loader) {
                // Show loader
                loader.classList.add('active');

                // Wait for loader to appear, then switch section
                setTimeout(() => {
                    // Hide all dynamic sections first
                    const sections = document.querySelectorAll('.dynamic-section');
                    sections.forEach(s => s.style.display = 'none');

                    // Show the target section
                    const target = document.getElementById('section-' + sectionId);
                    if (target) {
                        target.style.display = 'block';
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }

                    // Hide loader after a short delay so the user sees the effect
                    setTimeout(() => {
                        loader.classList.remove('active');
                    }, 400);

                }, 500); // 500ms loading effect
            } else {
                // Fallback if no loader exists
                const sections = document.querySelectorAll('.dynamic-section');
                sections.forEach(s => s.style.display = 'none');

                const target = document.getElementById('section-' + sectionId);
                if (target) {
                    target.style.display = 'block';
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        }

        function openPageWithLoader(e, url, preserveScroll = false) {
            if (e) e.preventDefault();

            if (preserveScroll) {
                sessionStorage.setItem('preserveScroll', window.scrollY);
            }

            const loader = document.getElementById('page-loader');
            if (loader) {
                loader.classList.add('active');
                setTimeout(() => {
                    window.location.href = url;
                }, 500);
            } else {
                window.location.href = url;
            }
        }

        function toggleProfil() {
            showSection('sejarah');
        }
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            if (menu) {
                menu.classList.toggle('active');
            }
        }

        // --- INITIALIZE EVERYTHING ---
        document.addEventListener('DOMContentLoaded', () => {
            // Theme Initialization
            const savedTheme = localStorage.getItem('selectedTheme');
            if (savedTheme && themes[savedTheme]) {
                setTheme(savedTheme);
            }

            // Close overlay if clicking outside the circle
            const themeOverlay = document.getElementById('theme-overlay');
            if (themeOverlay) {
                themeOverlay.addEventListener('click', function (event) {
                    if (event.target === this) {
                        toggleThemeMenu();
                    }
                });
            }
        });

        // Countdown Menuju Tahun 2027
        document.addEventListener('DOMContentLoaded', () => {
            const countdownDate = new Date("Jan 1, 2027 00:00:00").getTime();

            const x = setInterval(function () {
                const now = new Date().getTime();
                const distance = countdownDate - now;

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                const daysEl = document.getElementById("cd-days");
                const hoursEl = document.getElementById("cd-hours");
                const minsEl = document.getElementById("cd-mins");
                const secsEl = document.getElementById("cd-secs");

                if (daysEl) daysEl.innerText = days < 10 ? "0" + days : days;
                if (hoursEl) hoursEl.innerText = hours < 10 ? "0" + hours : hours;
                if (minsEl) minsEl.innerText = minutes < 10 ? "0" + minutes : minutes;
                if (secsEl) secsEl.innerText = seconds < 10 ? "0" + seconds : seconds;

                if (distance < 0) {
                    clearInterval(x);
                    if (daysEl) daysEl.innerText = "00";
                    if (hoursEl) hoursEl.innerText = "00";
                    if (minsEl) minsEl.innerText = "00";
                    if (secsEl) secsEl.innerText = "00";
                }
            }, 1000);
        });

        // --- AJAX PAGINATION (FREEZE EFFECT) ---
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('.ajax-page');
            if (btn) {
                e.preventDefault();
                const url = btn.href;
                if (!url || url === '#' || url.includes('javascript')) return;

                const loader = document.getElementById('page-loader');
                if (loader) loader.classList.add('active');

                fetch(url)
                    .then(res => res.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        // Replace only the articles list wrapper content
                        const newWrapper = doc.getElementById('articles-list-wrapper');
                        const oldWrapper = document.getElementById('articles-list-wrapper');

                        if (newWrapper && oldWrapper) {
                            oldWrapper.innerHTML = newWrapper.innerHTML;
                        }

                        // Update URL without reloading
                        window.history.pushState({}, '', url);

                        setTimeout(() => {
                            if (loader) loader.classList.remove('active');
                        }, 400); // Wait a bit for images to start loading
                    })
                    .catch(() => {
                        window.location.href = url; // Fallback
                    });
            }
        });
    </script>

    <!-- Mobile Menu Overlay (Drawer) — Full Featured -->
    <div id="mobile-menu" class="mobile-nav-overlay">
        <div class="mobile-nav-content">
            <div class="mobile-nav-header">
                <span>
                    <img src="{{ asset('images/LOGO RESMI IPNUIPPNU by diqies 2.png') }}"
                        style="width:28px;height:28px;border-radius:50%;border:2px solid rgba(255,255,255,0.5);vertical-align:middle;margin-right:8px;">
                    PAC IPNU IPPNU Kemiri
                </span>
                <button onclick="toggleMobileMenu()">✕</button>
            </div>
            <div class="mobile-nav-body">
                <div class="mobile-nav-menu-items">
                    <!-- Beranda -->
                    <div class="mobile-nav-section-title"><i class="fa-solid fa-house" style="margin-right:6px;"></i>
                        Beranda</div>
                    <a href="#beranda" onclick="toggleMobileMenu()" class="mobile-nav-item">
                        <i class="fa-solid fa-home"></i> Halaman Utama
                    </a>

                    <!-- Profil -->
                    <div class="mobile-nav-section-title"><i class="fa-solid fa-id-card" style="margin-right:6px;"></i>
                        Profil Organisasi</div>
                    <button onclick="showSection('sejarah'); toggleMobileMenu();" class="mobile-nav-item"
                        style="width:100%;">
                        <i class="fa-solid fa-scroll"></i> Sejarah IPNU IPPNU
                    </button>
                    <button onclick="showSection('visi-misi'); toggleMobileMenu();" class="mobile-nav-item"
                        style="width:100%;">
                        <i class="fa-solid fa-bullseye"></i> Visi Misi Pusat
                    </button>
                    <button onclick="showSection('visi-misi-pac'); toggleMobileMenu();" class="mobile-nav-item"
                        style="width:100%;">
                        <i class="fa-solid fa-star"></i> Visi Misi PAC Kemiri
                    </button>
                    <button onclick="showSection('nahkoda'); toggleMobileMenu();" class="mobile-nav-item"
                        style="width:100%;">
                        <i class="fa-solid fa-anchor"></i> Nahkoda PAC Kemiri
                    </button>

                    <!-- Lembaga & Struktur -->
                    <div class="mobile-nav-section-title"><i class="fa-solid fa-sitemap" style="margin-right:6px;"></i>
                        Lembaga & Struktur</div>
                    <button onclick="showSection('susunan-pengurus'); toggleMobileMenu();" class="mobile-nav-item" style="width:100%;">
                        <i class="fa-solid fa-users"></i> Susunan Pengurus
                    </button>

                    <!-- Informasi & Berita -->
                    <div class="mobile-nav-section-title"><i class="fa-solid fa-newspaper"
                            style="margin-right:6px;"></i> Informasi & Berita</div>
                    <a href="#berita" onclick="toggleMobileMenu()" class="mobile-nav-item">
                        <i class="fa-solid fa-rss"></i> Berita Terkini
                    </a>
                    <a href="#section-statistik" onclick="toggleMobileMenu()" class="mobile-nav-item">
                        <i class="fa-solid fa-chart-bar"></i> Statistik Anggota
                    </a>
                    <a href="#agenda" onclick="toggleMobileMenu()" class="mobile-nav-item">
                        <i class="fa-solid fa-calendar-days"></i> Agenda Kegiatan
                    </a>
                    <a href="#galeri" onclick="toggleMobileMenu()" class="mobile-nav-item">
                        <i class="fa-solid fa-images"></i> Galeri Foto
                    </a>

                    <!-- Pemilihan -->
                    <div class="mobile-nav-section-title"><i class="fa-solid fa-check-to-slot"
                            style="margin-right:6px;"></i> Pemilihan</div>
                    <a href="{{ route('voting') }}" onclick="toggleMobileMenu()" class="mobile-nav-item">
                        <i class="fa-solid fa-vote-yea"></i> Pemilihan Ketua
                    </a>

                    <!-- Admin -->
                    <div class="mobile-nav-section-title"><i class="fa-solid fa-lock" style="margin-right:6px;"></i>
                        Admin</div>
                    <a href="{{ route('admin.register') }}" class="mobile-nav-item" style="color:#dc2626;">
                        <i class="fa-solid fa-user-shield" style="color:#dc2626;"></i> Login Admin
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Bottom Navigation Bar -->
    <nav class="mobile-bottom-nav" id="mobile-bottom-nav">
        <div class="mbn-inner">
            <a href="#beranda" class="mbn-item active" id="mbn-home">
                <i class="fa-solid fa-house"></i>
                <span>Beranda</span>
            </a>
            <a href="#berita" class="mbn-item" id="mbn-news">
                <i class="fa-solid fa-newspaper"></i>
                <span>Berita</span>
            </a>
            <a href="{{ route('voting') }}" class="mbn-item" id="mbn-vote">
                <i class="fa-solid fa-check-to-slot"></i>
                <span>Voting</span>
            </a>
            <a href="#agenda" class="mbn-item" id="mbn-agenda">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Agenda</span>
            </a>
            <button class="mbn-item mbn-menu-btn" onclick="toggleMobileMenu()" id="mbn-menu">
                <i class="fa-solid fa-bars"></i>
                <span>Menu</span>
            </button>
        </div>
    </nav>

    <!-- Gabung Sekarang Modal -->
    <div id="gabung-modal" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.7); z-index: 10000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
        <div style="background: white; border-radius: 16px; width: 90%; max-width: 600px; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
            <div style="background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; padding: 20px 24px; display: flex; justify-content: space-between; align-items: center; border-radius: 16px 16px 0 0; position: sticky; top: 0; z-index: 10;">
                <h3 style="margin: 0; font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.2rem;"><i class="fa-solid fa-user-plus"></i> Gabung Sekarang</h3>
                <button onclick="closeGabungModal()" style="background: rgba(255,255,255,0.2); border: none; color: white; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s;"><i class="fa-solid fa-times"></i></button>
            </div>
            <div style="padding: 24px;">
                <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 20px;">Silakan isi formulir di bawah ini untuk bergabung dengan PAC IPNU IPPNU Kemiri.</p>
                
                <form action="{{ route('gabung.store') }}" method="POST">
                    @csrf
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div style="grid-column: 1 / -1;">
                            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Nama Lengkap <span style="color:red;">*</span></label>
                            <input type="text" name="name" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.95rem;">
                        </div>
                        
                        <div>
                            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Email <span style="color:red;">*</span></label>
                            <input type="email" name="email" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.95rem;">
                        </div>
                        
                        <div>
                            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Nomor HP (WhatsApp)</label>
                            <input type="tel" name="phone" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.95rem;" placeholder="08xxxxxxxxxx">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Tempat Lahir</label>
                            <input type="text" name="birth_place" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.95rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Tanggal Lahir</label>
                            <input type="date" name="birth_date" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.95rem;">
                        </div>
                        
                        <div>
                            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Pendidikan Terakhir</label>
                            <input type="text" name="education" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.95rem;" placeholder="SMP / SMA / S1 dll">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Tanggal Makesta</label>
                            <input type="date" name="makesta_date" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.95rem;">
                            <small style="color:#94a3b8; font-size:0.75rem;">Kosongkan jika belum Makesta</small>
                        </div>
                        
                        <div style="grid-column: 1 / -1;">
                            <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Alamat Lengkap</label>
                            <textarea name="address" rows="3" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.95rem; resize: vertical;"></textarea>
                        </div>
                    </div>

                    <div style="margin-top: 24px; text-align: right;">
                        <button type="button" onclick="closeGabungModal()" style="padding: 12px 20px; background: #f1f5f9; color: #475569; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; margin-right: 8px;">Batal</button>
                        <button type="submit" style="padding: 12px 24px; background: var(--primary); color: white; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; font-family: 'Outfit';">Kirim Pendaftaran <i class="fa-solid fa-paper-plane" style="margin-left: 6px;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Gallery Viewer Modal -->
    <div id="gallery-viewer-modal"
        style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.9); z-index: 10000; align-items: center; justify-content: center; flex-direction: column;">
        <button onclick="closeGalleryViewer()"
            style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: white; font-size: 2.5rem; cursor: pointer; line-height: 1;">&times;</button>
        <img id="gallery-viewer-img" src=""
            style="max-width: 90%; max-height: 80vh; object-fit: contain; border-radius: 8px;">
        <h3 id="gallery-viewer-title"
            style="color: white; margin-top: 16px; font-family: 'Outfit'; text-align: center;">
        </h3>
    </div>

    <!-- All Galleries Modal -->
    <div id="all-galleries-modal"
        style="display: none; position: fixed; inset: 0; background: rgba(255,255,255,0.98); z-index: 9999; overflow-y: auto;">
        <div style="padding: 30px 20px; max-width: 1200px; margin: 0 auto;">
            <div
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 2px solid var(--primary); padding-bottom: 16px;">
                <h2 style="color: var(--primary-dark); margin: 0; font-family: 'Outfit';"><i
                        class="fa-solid fa-images"></i>
                    SEMUA GALERI FOTO</h2>
                <button onclick="closeAllGalleries()"
                    style="background: none; border: none; color: var(--text-dark); font-size: 2.5rem; cursor: pointer; line-height: 1;">&times;</button>
            </div>
            <div class="gallery-grid"
                style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px;">
                @foreach($allGalleries as $gallery)
                    <div class="gallery-item"
                        onclick="openGalleryViewer('{{ asset('storage/' . $gallery->image) }}', '{{ $gallery->title }}')">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                            onerror="this.src='{{ asset('images/alun_alun_kemiri.png') }}'">
                        <div class="gallery-overlay">
                            <h4 class="gallery-title">{{ $gallery->title }}</h4>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($allGalleries->count() == 0)
                <div style="text-align: center; padding: 40px; color: #6b7280;">Belum ada foto di galeri.</div>
            @endif
        </div>
    </div>

    <script>
        function openGalleryViewer(url, title) {
            document.getElementById('gallery-viewer-img').src = url;
            document.getElementById('gallery-viewer-title').innerText = title;
            document.getElementById('gallery-viewer-modal').style.display = 'flex';
        }
        function closeGalleryViewer() {
            document.getElementById('gallery-viewer-modal').style.display = 'none';
        }
        function showAllGalleries() {
            document.getElementById('all-galleries-modal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
        function closeAllGalleries() {
            document.getElementById('all-galleries-modal').style.display = 'none';
            document.body.style.overflow = '';
        }
        
        function openProductModal(prod) {
            document.getElementById('pm-img').src = prod.image_url || '{{ asset("images/alun_alun_kemiri.png") }}';
            document.getElementById('pm-name').innerText = prod.name;
            document.getElementById('pm-desc').innerText = prod.description || 'Tidak ada deskripsi.';
            
            if(prod.discount > 0) {
                document.getElementById('pm-price').innerHTML = `<span style="text-decoration:line-through;color:#999;font-size:0.9rem;margin-right:8px;">${prod.price_formatted}</span> <span style="color:#ee4d2d;font-size:1.4rem;font-weight:700;">${prod.discounted_price_formatted}</span> <span style="background:rgba(255,212,36,.9);color:#ee4d2d;font-size:0.75rem;padding:2px 4px;font-weight:bold;margin-left:8px;">${prod.discount}% OFF</span>`;
            } else {
                document.getElementById('pm-price').innerHTML = `<span style="color:#ee4d2d;font-size:1.4rem;font-weight:700;">${prod.price_formatted}</span>`;
            }

            document.getElementById('pm-rating').innerText = prod.rating;
            document.getElementById('pm-sold').innerText = prod.sold_count + ' Terjual';
            document.getElementById('pm-cond').innerText = prod.condition;
            document.getElementById('pm-cat').innerText = prod.category;
            document.getElementById('pm-stock').innerText = prod.stock;
            document.getElementById('pm-loc').innerText = prod.location;
            
            document.getElementById('pm-wa-btn').href = prod.wa_link || '#';
            
            document.getElementById('product-detail-modal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        function closeProductModal() {
            document.getElementById('product-detail-modal').style.display = 'none';
            document.body.style.overflow = '';
        }
    </script>

    <!-- Product Detail Modal -->
    <div id="product-detail-modal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 10000; align-items: center; justify-content: center; backdrop-filter: blur(4px); padding: 20px;">
        <div style="background: white; border-radius: 12px; width: 100%; max-width: 800px; max-height: 90vh; overflow-y: auto; position: relative; display: flex; flex-direction: column; md:flex-row;">
            <button onclick="closeProductModal()" style="position: absolute; top: 16px; right: 16px; background: rgba(0,0,0,0.1); border: none; width: 36px; height: 36px; border-radius: 50%; font-size: 1.2rem; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10;"><i class="fa-solid fa-times"></i></button>
            
            <div style="display: flex; flex-wrap: wrap;">
                <div style="flex: 1 1 300px; padding: 20px;">
                    <img id="pm-img" src="" style="width: 100%; border-radius: 8px; object-fit: cover; aspect-ratio: 1/1; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                </div>
                <div style="flex: 1 1 400px; padding: 20px; display: flex; flex-direction: column;">
                    <h2 id="pm-name" style="font-family: 'Outfit'; font-size: 1.5rem; margin-bottom: 8px; line-height: 1.3;">Nama Produk</h2>
                    
                    <div style="display: flex; align-items: center; gap: 12px; font-size: 0.9rem; color: #555; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid #eee;">
                        <span style="color: #ee4d2d;"><i class="fa-solid fa-star"></i> <span id="pm-rating">4.8</span></span>
                        <span>|</span>
                        <span id="pm-sold">0 Terjual</span>
                    </div>

                    <div id="pm-price" style="background: #fafafa; padding: 16px; margin-bottom: 20px; border-radius: 8px;">
                        Rp 0
                    </div>

                    <div style="display: grid; grid-template-columns: 100px 1fr; gap: 12px; font-size: 0.9rem; margin-bottom: 24px;">
                        <div style="color: #888;">Kategori</div>
                        <div id="pm-cat" style="font-weight: 500;">-</div>
                        
                        <div style="color: #888;">Kondisi</div>
                        <div id="pm-cond" style="font-weight: 500;">Baru</div>
                        
                        <div style="color: #888;">Stok Tersisa</div>
                        <div id="pm-stock" style="font-weight: 500;">0</div>

                        <div style="color: #888;">Dikirim Dari</div>
                        <div id="pm-loc" style="font-weight: 500;">Kemiri</div>
                    </div>

                    <div style="margin-bottom: 24px;">
                        <h4 style="font-family: 'Outfit'; font-size: 1.1rem; margin-bottom: 8px; border-bottom: 1px solid #eee; padding-bottom: 8px;">Deskripsi Produk</h4>
                        <div id="pm-desc" style="font-size: 0.95rem; color: #444; line-height: 1.6; white-space: pre-wrap;">
                        </div>
                    </div>

                    <div style="margin-top: auto; padding-top: 20px;">
                        <a id="pm-wa-btn" href="#" target="_blank" style="display: block; width: 100%; padding: 14px; background: #25D366; color: white; text-align: center; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 1.1rem; transition: background 0.2s;">
                            <i class="fa-brands fa-whatsapp" style="margin-right: 8px; font-size: 1.2rem;"></i> Beli di WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/chat.js') }}"></script>
</body>

</html>
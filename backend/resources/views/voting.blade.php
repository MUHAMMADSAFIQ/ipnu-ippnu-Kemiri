<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Voting PAC IPNU IPPNU Kemiri</title>
    <meta name="description" content="Sistem e-voting pemilihan ketua PAC IPNU IPPNU Kemiri. Pilih dengan bijak dan bertanggung jawab.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text-dark); overflow-x: hidden; }

        /* ===== MESH BACKGROUND ===== */
        .mesh-bg {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;
            background: #f0fdf4;
            background-image:
                radial-gradient(at 0% 0%, rgba(21,128,61,0.18) 0px, transparent 55%),
                radial-gradient(at 100% 0%, rgba(250,204,21,0.12) 0px, transparent 55%),
                radial-gradient(at 50% 100%, rgba(21,128,61,0.1) 0px, transparent 55%);
        }

        /* ===== TOP UTILITY BAR ===== */
        .top-utility-bar {
            background: linear-gradient(90deg, var(--primary-dark) 0%, var(--primary) 50%, var(--primary-dark) 100%);
            color: white; padding: 0;
            position: sticky; top: 0; z-index: 1000;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        .tub-container {
            max-width: 1400px; margin: 0 auto;
            padding: 8px 20px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .tub-left {
            display: flex; align-items: center; gap: 10px;
            font-weight: 700; font-size: 0.85rem;
        }
        .tub-logo-wrap {
            width: 32px; height: 32px; background: white;
            border-radius: 8px; padding: 4px; display: flex; align-items: center; justify-content: center;
        }
        .tub-logo-wrap img { width: 100%; height: 100%; object-fit: contain; }
        .tub-right { display: flex; align-items: center; gap: 8px; }
        .tub-btn {
            background: var(--accent); color: #111;
            padding: 5px 16px; border-radius: 6px;
            text-decoration: none; font-weight: 800; font-size: 0.78rem;
            transition: all 0.2s; display: flex; align-items: center; gap: 6px;
        }
        .tub-btn:hover { background: white; transform: translateY(-1px); }

        /* ===== MAIN LAYOUT ===== */
        .page-layout {
            max-width: 1200px; margin: 0 auto;
            display: grid;
            grid-template-columns: 260px 1fr 280px;
            gap: 24px; padding: 28px 20px;
        }

        /* ===== SIDEBARS ===== */
        .sidebar-panel {
            position: sticky; top: 80px;
            height: calc(100vh - 100px);
            overflow-y: auto; scrollbar-width: none;
        }
        .sidebar-panel::-webkit-scrollbar { display: none; }
        .panel-card {
            background: white; border-radius: 20px;
            padding: 22px; margin-bottom: 18px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid var(--border);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .panel-card:hover { transform: translateY(-3px); box-shadow: 0 8px 32px rgba(0,0,0,0.1); }

        /* ===== VOTING CENTER ===== */
        .voting-center { display: flex; flex-direction: column; gap: 24px; }

        .voting-hero {
            background: white;
            border-radius: 28px; padding: 48px 32px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0,0,0,0.06);
            border: 1px solid var(--border);
            position: relative; overflow: hidden;
            animation: heroSlideIn 0.8s cubic-bezier(0.16,1,0.3,1);
        }
        @keyframes heroSlideIn { from{opacity:0;transform:translateY(-20px);} to{opacity:1;transform:translateY(0);} }
        .voting-hero::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(circle at 30% 20%, rgba(21,128,61,0.05) 0%, transparent 60%),
                        radial-gradient(circle at 70% 80%, rgba(250,204,21,0.05) 0%, transparent 60%);
            pointer-events: none;
        }
        .voting-hero .hero-badge {
            display: inline-flex; align-items: center; gap: 7px;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: white; padding: 6px 18px; border-radius: 50px;
            font-size: 0.72rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;
            margin-bottom: 20px;
        }
        .voting-hero h1 {
            font-family: 'Outfit', sans-serif; font-weight: 900;
            font-size: 2.4rem; line-height: 1.1; margin-bottom: 12px;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            text-transform: uppercase; letter-spacing: 2px;
        }
        .voting-hero p { color: var(--text-light); font-size: 0.9rem; max-width: 500px; margin: 0 auto; line-height: 1.6; }

        /* ===== VOTE CARDS ===== */
        .candidates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 22px;
        }
        .vote-card-wrap {
            position: relative;
            animation: cardFadeUp 0.7s ease-out both;
        }
        @keyframes cardFadeUp { from{opacity:0;transform:translateY(30px);} to{opacity:1;transform:translateY(0);} }
        .vote-card-wrap:nth-child(1) { animation-delay: 0.1s; }
        .vote-card-wrap:nth-child(2) { animation-delay: 0.2s; }
        .vote-card-wrap:nth-child(3) { animation-delay: 0.3s; }
        .vote-card-wrap:nth-child(4) { animation-delay: 0.4s; }

        .card-glow {
            position: absolute; inset: 8px; border-radius: 22px;
            background: var(--primary-light); opacity: 0.08;
            filter: blur(12px); z-index: -1;
            transform: scale(0.9);
            transition: all 0.4s ease;
        }
        .vote-card-wrap:hover .card-glow { opacity: 0.2; transform: scale(1); }

        .vote-card {
            background: white; border-radius: 22px;
            overflow: hidden; border: 1.5px solid var(--border);
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: transform 0.4s cubic-bezier(0.175,0.885,0.32,1.275), box-shadow 0.4s ease, border-color 0.3s;
            position: relative;
        }
        .vote-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.12);
            border-color: var(--primary);
        }

        .card-top {
            height: 90px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            position: relative;
        }
        .card-num {
            position: absolute; top: 14px; left: 14px;
            width: 38px; height: 38px;
            background: var(--accent); color: #111;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; font-size: 1rem;
            box-shadow: 0 4px 12px rgba(250,204,21,0.4);
        }

        .avatar-wrap {
            width: 120px; height: 120px;
            margin: -60px auto 14px;
            background: white; border-radius: 50%;
            padding: 6px; position: relative; z-index: 5;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        .avatar-inner {
            width: 100%; height: 100%;
            background: #f1f5f9; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 3.5rem;
            border: 4px solid var(--primary-light);
            overflow: hidden;
        }
        .avatar-inner img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }

        /* Nyoblos effect */
        .paku-hole {
            position: absolute; top: 50%; left: 50%;
            width: 40px; height: 40px;
            background: #0f172a;
            border-radius: 50%;
            transform: translate(-50%,-50%) scale(0);
            z-index: 40;
            clip-path: polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);
            box-shadow: inset 0 0 12px rgba(0,0,0,1);
        }
        .paku-punch {
            position: absolute; top: 50%; left: 50%;
            width: 46px; height: 46px;
            transform: translate(-50%,-50%) scale(0);
            z-index: 50; pointer-events: none;
        }
        .paku-punch::before {
            content: '';
            position: absolute; width: 100%; height: 100%;
            background: radial-gradient(circle at 30% 30%, #94a3b8, #475569 40%, #1e293b 80%);
            border-radius: 50%;
            box-shadow: 0 8px 18px rgba(0,0,0,0.5), inset 0 -4px 8px rgba(0,0,0,0.8);
        }
        @keyframes nailImpact { 0%{transform:translate(-50%,-50%) scale(4);opacity:0;} 20%{transform:translate(-50%,-50%) scale(1);opacity:1;} 80%{transform:translate(-50%,-50%) scale(1);opacity:1;} 100%{transform:translate(-50%,-50%) scale(0.8);opacity:0;} }
        @keyframes holeTear { 0%{transform:translate(-50%,-50%) scale(0);} 20%{transform:translate(-50%,-50%) scale(1);} 100%{transform:translate(-50%,-50%) scale(1);} }
        @keyframes shredFly { 0%{transform:translate(0,0) rotate(0deg);opacity:1;} 100%{transform:translate(var(--tx),var(--ty)) rotate(var(--tr));opacity:0;} }
        .punched .paku-punch { animation: nailImpact 0.6s cubic-bezier(0.6,-0.28,0.735,0.045) forwards; }
        .punched .paku-hole { animation: holeTear 0.3s 0.1s forwards; }
        .shred { position:absolute; width:5px; height:5px; background:#e2e8f0; border-radius:2px; pointer-events:none; opacity:0; z-index:60; }

        .card-body { padding: 0 20px 20px; text-align: center; }
        .cand-name { font-family: 'Outfit'; font-size: 1.25rem; font-weight: 900; color: var(--text-dark); margin-bottom: 4px; line-height: 1.2; }
        .cand-vision { font-size: 0.78rem; color: var(--text-light); font-style: italic; line-height: 1.5; margin-bottom: 16px; min-height: 3em; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

        /* Progress bar */
        .vote-progress { margin-bottom: 16px; }
        .vp-info { display: flex; justify-content: space-between; font-size: 0.8rem; font-weight: 800; margin-bottom: 6px; color: var(--primary-dark); }
        .vp-track { background: #f1f5f9; height: 10px; border-radius: 50px; overflow: hidden; border: 1px solid var(--border); }
        .vp-fill { height: 100%; background: linear-gradient(90deg, var(--primary), var(--primary-light)); border-radius: 50px; transition: width 2s cubic-bezier(0.1,0,0.2,1); width: 0; }

        /* Vote button */
        .btn-coblos {
            width: 100%; background: var(--text-dark);
            color: white; border: none;
            padding: 14px; border-radius: 14px;
            font-weight: 900; font-size: 0.9rem; cursor: pointer;
            transition: all 0.35s ease; text-transform: uppercase; letter-spacing: 1px;
            position: relative; overflow: hidden;
            box-shadow: 0 4px 0 #0f172a;
        }
        .btn-coblos::after { content: ''; position: absolute; top: 50%; left: 50%; width: 0; height: 0; background: rgba(255,255,255,0.2); border-radius: 50%; transform: translate(-50%,-50%); transition: width 0.4s, height 0.4s; }
        .btn-coblos:hover::after { width: 300px; height: 300px; }
        .btn-coblos:hover { background: var(--primary); box-shadow: 0 8px 0 var(--primary-dark), 0 14px 28px rgba(21,128,61,0.3); transform: translateY(-3px); }
        .btn-coblos:active { transform: translateY(0); box-shadow: 0 2px 0 var(--primary-dark); }
        .btn-coblos:disabled { background: #cbd5e1; color: #64748b; cursor: not-allowed; box-shadow: none; transform: none; }

        /* ===== SIDEBAR WIDGETS ===== */
        .widget-title { font-family: 'Outfit'; font-weight: 900; font-size: 1rem; color: var(--primary-dark); margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
        .stat-row { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f1f5f9; }
        .stat-row:last-child { border-bottom: none; }
        .stat-label-txt { color: var(--text-light); font-size: 0.85rem; font-weight: 600; }
        .stat-val { font-family: 'Outfit'; font-weight: 900; color: var(--primary-dark); font-size: 1.15rem; }

        .timer-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 8px; margin-top: 12px; }
        .time-box { background: #f8fafc; border: 1px solid var(--border); border-radius: 12px; padding: 10px 6px; text-align: center; }
        .time-num { display: block; font-size: 1.4rem; font-weight: 900; color: #ef4444; font-family: 'Outfit'; }
        .time-lbl { font-size: 0.6rem; font-weight: 700; color: var(--text-light); text-transform: uppercase; }

        /* ===== TOAST ===== */
        .toast {
            position: fixed; bottom: 28px; left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: var(--text-dark); color: white;
            padding: 14px 28px; border-radius: 14px;
            font-weight: 700; font-size: 0.9rem;
            box-shadow: 0 12px 40px rgba(0,0,0,0.25);
            transition: 0.45s cubic-bezier(0.68,-0.55,0.265,1.55);
            opacity: 0; z-index: 10000;
            border: 1px solid rgba(255,255,255,0.1);
            white-space: nowrap;
        }
        .toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }

        /* ===== CONFETTI ===== */
        .confetti-canvas { position: fixed; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index:10000; }

        /* ===== RESPONSIVE ===== */
        @media (max-width:1100px) {
            .page-layout { 
                display: flex;
                flex-direction: column;
                gap: 24px;
            }
            .sidebar-panel { 
                position: relative; 
                top: 0; 
                height: auto; 
                display: block; 
            }
            
            /* Order: Center (Hero & Voting) -> Stats -> Panduan */
            .voting-center { order: 1; }
            .sidebar-panel:last-child { order: 2; margin-top: 8px; } /* Live Stats & Countdown */
            .sidebar-panel:first-child { order: 3; } /* Logo & Panduan */
        }
        @media (max-width:640px) {
            .voting-hero { padding: 32px 16px; border-radius: 20px; }
            .voting-hero h1 { font-size: 1.6rem; margin-bottom: 8px; }
            .voting-hero p { font-size: 0.8rem; }
            
            /* Paksa 2 kolom di HP */
            .candidates-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
            
            /* Sesuaikan ukuran elemen di dalam card agar muat 2 kolom di layar sempit */
            .card-top { height: 50px; }
            .avatar-wrap { width: 70px; height: 70px; margin: -35px auto 10px; padding: 4px; }
            .avatar-inner { font-size: 1.8rem; border-width: 3px; }
            .card-body { padding: 0 10px 14px; }
            .card-num { width: 28px; height: 28px; font-size: 0.8rem; top: 10px; left: 10px; border-radius: 6px; }
            .cand-name { font-size: 0.95rem; margin-bottom: 4px; line-height: 1.1; }
            .cand-vision { font-size: 0.72rem; min-height: 3.2em; margin-bottom: 12px; }
            .vp-info { font-size: 0.72rem; margin-bottom: 4px; }
            .vp-track { height: 6px; }
            .vote-progress { margin-bottom: 12px; }
            .btn-coblos { padding: 10px 4px; font-size: 0.75rem; border-radius: 10px; letter-spacing: 0; width: 100%; }
            
            .tub-left-text { font-size: 0.75rem; }
            .hide-mobile { display: none; }
            
            /* Sembunyikan Logo Besar di mobile karena sudah ada di top bar */
            .sidebar-panel:first-child .panel-card:first-child { display: none; }
        }
    </style>
</head>
<body>
    <div class="mesh-bg"></div>
    <canvas id="confetti" class="confetti-canvas"></canvas>

    {{-- TOP UTILITY BAR --}}
    <div class="top-utility-bar">
        <div class="tub-container">
            <div class="tub-left">
                <div class="tub-logo-wrap">
                    <img src="{{ asset('images/logo_ipnu.png') }}" alt="Logo IPNU">
                </div>
                <span class="tub-left-text">PAC IPNU IPPNU Kemiri <span class="hide-mobile">&bull; E-Voting Portal</span></span>
            </div>
            <div class="tub-right">
                <a href="{{ url('/') }}" class="tub-btn">
                    <i class="fa-solid fa-house"></i> Beranda
                </a>
            </div>
        </div>
    </div>

    <div class="page-layout">
        {{-- LEFT SIDEBAR --}}
        <aside class="sidebar-panel">
            <div class="panel-card" style="text-align:center;">
                <img src="{{ asset('images/logo_ipnu.png') }}" alt="Logo" style="width:90px;filter:drop-shadow(0 6px 16px rgba(0,0,0,0.12));margin-bottom:16px;">
                <h2 style="font-family:'Outfit';font-size:1.4rem;font-weight:900;color:var(--primary-dark);margin-bottom:4px;">IPNU KEMIRI</h2>
                <p style="font-size:0.72rem;font-weight:800;color:var(--text-light);text-transform:uppercase;letter-spacing:1px;margin-bottom:16px;">Pesta Demokrasi Pelajar</p>
                <div style="padding-top:16px;border-top:1px dashed var(--border);font-size:0.8rem;color:#475569;line-height:1.7;font-style:italic;">
                    "Gunakan hak suara Anda dengan penuh tanggung jawab demi masa depan organisasi yang lebih baik."
                </div>
            </div>

            <div class="panel-card">
                <div class="widget-title"><i class="fa-solid fa-circle-info" style="color:var(--primary);"></i> Panduan Voting</div>
                <div style="font-size:0.8rem;color:var(--text-light);line-height:1.8;">
                    <div style="display:flex;align-items:flex-start;gap:8px;margin-bottom:8px;">
                        <span style="background:var(--primary);color:white;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.65rem;font-weight:800;flex-shrink:0;margin-top:2px;">1</span>
                        <span>Perhatikan profil setiap kandidat dengan seksama</span>
                    </div>
                    <div style="display:flex;align-items:flex-start;gap:8px;margin-bottom:8px;">
                        <span style="background:var(--primary);color:white;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.65rem;font-weight:800;flex-shrink:0;margin-top:2px;">2</span>
                        <span>Klik tombol <strong>"Coblos Sekarang"</strong> pada kandidat pilihan</span>
                    </div>
                    <div style="display:flex;align-items:flex-start;gap:8px;">
                        <span style="background:var(--accent);color:#111;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.65rem;font-weight:800;flex-shrink:0;margin-top:2px;">!</span>
                        <span>Setiap perangkat hanya dapat memilih <strong>satu kali</strong></span>
                    </div>
                </div>
            </div>
        </aside>

        {{-- CENTER VOTING --}}
        <main class="voting-center">
            <div class="voting-hero">
                <div class="hero-badge">
                    <i class="fa-solid fa-square-poll-vertical"></i>
                    Pemilihan Ketua PAC IPNU IPPNU Kemiri
                </div>
                <h1>E-Voting<br>Online</h1>
                <p>Pilih kandidat terbaik untuk memimpin organisasi. Hasil voting ditampilkan secara <strong>real-time</strong> untuk menjamin transparansi dan kejujuran.</p>
            </div>

            <div class="candidates-grid">
                @foreach($candidates as $index => $candidate)
                <div class="vote-card-wrap">
                    <div class="card-glow"></div>
                    <div class="vote-card" id="card-{{ $candidate->id }}">
                        <div class="card-top">
                            <div class="card-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        </div>

                        <div class="avatar-wrap" style="position:relative;">
                            <div class="avatar-inner">
                                @if($candidate->photo)
                                    <img src="{{ asset('storage/'.$candidate->photo) }}" alt="{{ $candidate->name }}">
                                @else
                                    👤
                                @endif
                            </div>
                            <div class="paku-hole"></div>
                            <div class="paku-punch"></div>
                        </div>

                        <div class="card-body">
                            <h3 class="cand-name">{{ $candidate->name }}</h3>
                            <p class="cand-vision">"{{ $candidate->vision }}"</p>

                            <div class="vote-progress">
                                <div class="vp-info">
                                    <span class="votes-count">{{ $candidate->votes_count }} Suara</span>
                                    <span class="percent-text">{{ $totalVotes > 0 ? round(($candidate->votes_count/$totalVotes)*100,1) : 0 }}%</span>
                                </div>
                                <div class="vp-track">
                                    <div class="vp-fill" style="width:{{ $totalVotes > 0 ? ($candidate->votes_count/$totalVotes)*100 : 0 }}%;"></div>
                                </div>
                            </div>

                            <button class="btn-coblos" onclick="submitVote({{ $candidate->id }})">
                                <i class="fa-solid fa-check-to-slot"></i> Coblos Sekarang
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($candidates->isEmpty())
            <div style="text-align:center;padding:80px 24px;background:white;border-radius:24px;border:1px solid var(--border);">
                <div style="font-size:4rem;margin-bottom:16px;opacity:0.3;">🗳️</div>
                <h3 style="font-family:'Outfit';font-weight:900;font-size:1.4rem;color:var(--text-dark);margin-bottom:8px;">Belum Ada Kandidat</h3>
                <p style="color:var(--text-light);">Kandidat akan ditampilkan setelah didaftarkan oleh panitia.</p>
            </div>
            @endif
        </main>

        {{-- RIGHT SIDEBAR --}}
        <aside class="sidebar-panel">
            <div class="panel-card">
                <div class="widget-title"><i class="fa-solid fa-chart-line" style="color:var(--primary);"></i> LIVE STATS</div>
                <div class="stat-row">
                    <span class="stat-label-txt">Total Suara</span>
                    <span class="stat-val" id="total-votes">{{ number_format($totalVotes) }}</span>
                </div>
                <div class="stat-row">
                    <span class="stat-label-txt">Target Suara</span>
                    <span class="stat-val">{{ number_format($targetVotes) }}</span>
                </div>
                <div class="stat-row">
                    <span class="stat-label-txt">Kandidat</span>
                    <span class="stat-val">{{ $candidates->count() }}</span>
                </div>
                <div class="stat-row" style="border-bottom:none;">
                    <span class="stat-label-txt">Partisipasi</span>
                    <span class="stat-val" id="total-percent" style="color:var(--primary);">{{ $targetVotes > 0 ? round(($totalVotes/$targetVotes)*100,1) : 0 }}%</span>
                </div>

                <!-- Mini progress -->
                <div style="margin-top:12px;">
                    <div style="background:#f1f5f9;height:8px;border-radius:50px;overflow:hidden;">
                        <div style="height:100%;width:{{ $targetVotes > 0 ? min(100, ($totalVotes/$targetVotes)*100) : 0 }}%;background:linear-gradient(90deg,var(--primary),var(--primary-light));border-radius:50px;transition:width 1s;"></div>
                    </div>
                </div>
            </div>

            <div class="panel-card">
                <div class="widget-title" style="color:#ef4444;"><i class="fa-solid fa-clock"></i> COUNTDOWN</div>
                <p style="font-size:0.75rem;color:var(--text-light);margin-bottom:2px;">Sisa waktu pemilihan:</p>
                <div class="timer-grid">
                    <div class="time-box"><span class="time-num" id="t-h">00</span><span class="time-lbl">Jam</span></div>
                    <div class="time-box"><span class="time-num" id="t-m">00</span><span class="time-lbl">Mnt</span></div>
                    <div class="time-box"><span class="time-num" id="t-s">00</span><span class="time-lbl">Dtk</span></div>
                </div>
            </div>

            <div class="panel-card" style="background:linear-gradient(135deg,var(--primary-dark),var(--primary));color:white;border:none;">
                <div style="font-family:'Outfit';font-weight:900;font-size:1rem;margin-bottom:10px;">🔒 Keamanan Voting</div>
                <p style="font-size:0.78rem;opacity:0.85;line-height:1.6;">Sistem voting dilindungi dan setiap suara hanya dapat diberikan sekali per sesi. Hasil ditampilkan secara real-time.</p>
            </div>
        </aside>
    </div>

    <div class="toast" id="vote-toast"></div>

    <script>
        let hasVoted = false;
        const targetVotes = {{ $targetVotes }};

        function submitVote(candidateId) {
            if (hasVoted) { showToast('❌ Anda sudah memberikan suara.'); return; }

            const card = document.getElementById('card-' + candidateId);
            const avatarWrap = card.querySelector('.avatar-wrap');

            // Visual effect
            avatarWrap.classList.add('punched');
            card.style.transform = 'scale(1.03)';

            // Shred particles
            for (let i = 0; i < 10; i++) {
                const shred = document.createElement('div');
                shred.className = 'shred';
                const tx = (Math.random() - 0.5) * 180, ty = (Math.random() - 0.5) * 180;
                const tr = Math.random() * 720;
                shred.style.setProperty('--tx', tx + 'px');
                shred.style.setProperty('--ty', ty + 'px');
                shred.style.setProperty('--tr', tr + 'deg');
                shred.style.left = '50%'; shred.style.top = '50%';
                shred.style.animation = `shredFly ${0.4 + Math.random() * 0.4}s ease-out forwards`;
                avatarWrap.appendChild(shred);
                setTimeout(() => shred.remove(), 1000);
            }

            // AJAX
            fetch("{{ route('voting.submit') }}", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ candidate_id: candidateId })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    hasVoted = true;
                    setTimeout(() => {
                        // Update UI
                        document.getElementById('total-votes').innerText = data.new_total.toLocaleString();
                        document.getElementById('total-percent').innerText = ((data.new_total / targetVotes) * 100).toFixed(1) + '%';

                        data.candidates.forEach(cand => {
                            const cardEl = document.getElementById('card-' + cand.id);
                            if (!cardEl) return;
                            const pct = data.new_total > 0 ? ((cand.votes_count / data.new_total) * 100).toFixed(1) : 0;
                            const el = cardEl.querySelector('.votes-count');
                            const pe = cardEl.querySelector('.percent-text');
                            const fill = cardEl.querySelector('.vp-fill');
                            if (el) el.innerText = cand.votes_count + ' Suara';
                            if (pe) pe.innerText = pct + '%';
                            if (fill) fill.style.width = pct + '%';
                        });

                        // Disable all buttons
                        document.querySelectorAll('.btn-coblos').forEach(btn => {
                            btn.innerText = '✓ Sudah Memilih';
                            btn.disabled = true;
                        });
                        // Highlight selected
                        card.style.borderColor = 'var(--primary)';
                        card.style.boxShadow = '0 0 0 3px rgba(21,128,61,0.2), 0 20px 50px rgba(0,0,0,0.12)';
                        card.querySelector('.btn-coblos').style.background = 'var(--primary)';

                        showToast('🎉 ' + data.message);
                        triggerConfetti();
                    }, 600);
                } else {
                    card.style.transform = '';
                    showToast('❌ ' + data.message);
                }
            })
            .catch(() => { card.style.transform = ''; showToast('❌ Terjadi kesalahan server.'); });
        }

        function showToast(msg) {
            const t = document.getElementById('vote-toast');
            t.innerText = msg;
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 3500);
        }

        function triggerConfetti() {
            const canvas = document.getElementById('confetti');
            const ctx = canvas.getContext('2d');
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            const colors = ['#15803d','#facc15','#ffffff','#22c55e','#14532d','#bbf7d0'];
            let particles = Array.from({length:180}, () => ({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height - canvas.height,
                size: Math.random() * 7 + 2,
                color: colors[Math.floor(Math.random() * colors.length)],
                speed: Math.random() * 4 + 2,
                angle: Math.random() * Math.PI * 2,
                rot: Math.random() * 0.15
            }));
            function draw() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                particles.forEach(p => {
                    p.y += p.speed; p.x += Math.sin(p.angle); p.angle += p.rot;
                    ctx.fillStyle = p.color;
                    ctx.save(); ctx.translate(p.x, p.y); ctx.rotate(p.angle);
                    ctx.fillRect(-p.size/2, -p.size/2, p.size, p.size);
                    ctx.restore();
                });
                if (particles[0].y < canvas.height * 1.5) requestAnimationFrame(draw);
                else ctx.clearRect(0, 0, canvas.width, canvas.height);
            }
            draw();
        }

        // Live countdown timer (midnight target as demo)
        function updateClock() {
            const now = new Date();
            const midnight = new Date(); midnight.setHours(23,59,59,0);
            let diff = Math.max(0, (midnight - now) / 1000);
            const h = Math.floor(diff / 3600), m = Math.floor((diff % 3600) / 60), s = Math.floor(diff % 60);
            document.getElementById('t-h').innerText = String(h).padStart(2,'0');
            document.getElementById('t-m').innerText = String(m).padStart(2,'0');
            document.getElementById('t-s').innerText = String(s).padStart(2,'0');
        }
        updateClock();
        setInterval(updateClock, 1000);

        // Animate progress bars on load
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.querySelectorAll('.vp-fill').forEach(bar => {
                    const w = bar.style.width;
                    bar.style.width = '0';
                    setTimeout(() => bar.style.width = w, 100);
                });
            }, 500);
        });
    </script>
</body>
</html>
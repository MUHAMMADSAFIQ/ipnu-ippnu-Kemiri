<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $singleArticle->title }} - PAC IPNU IPPNU Kemiri</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=2">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    
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

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
        }

        /* ─────────── MODERN NAVBAR ─────────── */
        .glass-nav {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
            padding: 12px 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .nav-logo {
            height: 42px;
            width: auto;
            object-fit: contain;
        }

        .nav-text {
            display: flex;
            flex-direction: column;
        }

        .nav-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--primary-dark);
            line-height: 1.2;
            letter-spacing: -0.02em;
        }

        .nav-subtitle {
            font-size: 0.75rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .btn-back-nav {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(21, 128, 61, 0.1);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .btn-back-nav:hover {
            background: var(--primary);
            color: white;
        }

        /* ─────────── ARTICLE CONTAINER ─────────── */
        .article-container {
            max-width: 850px;
            margin: 40px auto 80px;
            padding: 0 20px;
        }

        .article-card {
            background: var(--bg-white);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px -15px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.02);
            margin-bottom: 40px;
        }

        .article-hero {
            position: relative;
            width: 100%;
            height: 400px;
        }

        .article-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-body {
            padding: 40px 48px;
        }

        .article-title {
            font-size: 2.5rem;
            color: var(--text-dark);
            margin: 0 0 20px 0;
            line-height: 1.25;
            letter-spacing: -0.02em;
        }

        .article-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding-bottom: 24px;
            margin-bottom: 30px;
            border-bottom: 1px solid var(--border);
            color: var(--text-light);
            font-size: 0.95rem;
            font-weight: 500;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .meta-item i {
            color: var(--primary);
        }

        .article-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #334155;
        }

        .article-content p {
            margin-bottom: 1.5em;
        }

        /* ─────────── COMMENTS SECTION ─────────── */
        .comments-section {
            background: var(--bg-white);
            border-radius: 24px;
            padding: 40px 48px;
            box-shadow: 0 20px 40px -15px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.02);
        }

        .comments-title {
            font-size: 1.5rem;
            margin: 0 0 24px 0;
            padding-bottom: 16px;
            border-bottom: 2px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .comment-form {
            background: var(--bg-light);
            padding: 24px;
            border-radius: 16px;
            margin-bottom: 40px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.95rem;
            box-sizing: border-box;
            margin-bottom: 16px;
            transition: var(--transition);
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.1);
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .comment-item {
            margin-bottom: 24px;
        }

        .comment-box {
            display: flex;
            gap: 16px;
        }

        .comment-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(21,128,61,0.2);
        }

        .comment-content {
            flex: 1;
            background: var(--bg-light);
            padding: 16px 20px;
            border-radius: 0 16px 16px 16px;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 8px;
        }

        .comment-author {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 1.05rem;
        }

        .comment-date {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .comment-text {
            margin: 0 0 12px 0;
            color: #475569;
            line-height: 1.6;
        }

        .comment-actions {
            display: flex;
            gap: 16px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .action-btn {
            background: none;
            border: none;
            padding: 0;
            color: var(--text-light);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition);
            font-family: inherit;
            font-weight: 600;
        }

        .action-btn:hover {
            color: var(--primary);
        }

        .replies-list {
            margin-top: 16px;
            margin-left: 20px;
            padding-left: 20px;
            border-left: 2px solid #e2e8f0;
        }

        .reply-box {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }

        .reply-avatar {
            width: 36px;
            height: 36px;
            font-size: 0.9rem;
        }

        .reply-content {
            flex: 1;
            background: white;
            padding: 12px 16px;
            border-radius: 0 12px 12px 12px;
            border: 1px solid var(--border);
        }

        @media (max-width: 768px) {
            .article-body, .comments-section { padding: 24px; }
            .article-title { font-size: 1.8rem; }
            .article-hero { height: 250px; }
            .nav-subtitle { display: none; }
            .nav-title { font-size: 1rem; }
            .hide-mobile { display: none; }
            .btn-back-nav { padding: 8px 12px; }
        }
    </style>
</head>
<body>

    <!-- Modern Glass Navbar -->
    <nav class="glass-nav">
        <a href="{{ url('/') }}" class="nav-brand">
            <img src="{{ asset('images/LOGO RESMI IPNUIPPNU by diqies 2.png') }}" class="nav-logo" alt="Logo IPNU IPPNU">
            <div class="nav-text">
                <span class="nav-title">PAC IPNU IPPNU</span>
                <span class="nav-subtitle">Kecamatan Kemiri</span>
            </div>
        </a>
        <a href="{{ url('/') }}" class="btn-back-nav"><i class="fa-solid fa-arrow-left"></i> <span class="hide-mobile">Kembali</span></a>
    </nav>

    <div class="article-container">
        
        <article class="article-card">
            <div class="article-hero">
                <img src="{{ $singleArticle->image ? (Str::startsWith($singleArticle->image, 'images/') ? asset($singleArticle->image) : Storage::url($singleArticle->image)) : asset('images/hero_bg.png') }}" alt="{{ $singleArticle->title }}">
            </div>
            
            <div class="article-body">
                <h1 class="article-title">{{ $singleArticle->title }}</h1>
                
                <div class="article-meta">
                    <div class="meta-item"><i class="fa-solid fa-user-circle"></i> {{ $singleArticle->author }}</div>
                    <div class="meta-item"><i class="fa-solid fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($singleArticle->published_at)->translatedFormat('d F Y') }}</div>
                    <div class="meta-item"><i class="fa-solid fa-eye"></i> {{ number_format($singleArticle->views_count, 0, ',', '.') }} Kali Dibaca</div>
                    <div class="meta-item"><i class="fa-solid fa-comments"></i> {{ $singleArticle->comments_count }} Komentar</div>
                </div>
                
                <div class="article-content">
                    {!! nl2br(e($singleArticle->content)) !!}
                </div>
            </div>
        </article>

        <!-- Comments Section -->
        <div class="comments-section" id="komentar">
            <h3 class="comments-title"><i class="fa-solid fa-comments"></i> Komentar ({{ $singleArticle->comments_count }})</h3>
            
            @if(session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 16px; border-radius: 12px; margin-bottom: 24px; font-weight: 500; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Comment Form -->
            <form action="{{ route('komentar.store', $singleArticle->slug) }}" method="POST" class="comment-form">
                @csrf
                <div style="margin-bottom: 4px; font-weight: 600; color: var(--text-dark);">Tinggalkan Komentar</div>
                <p style="font-size: 0.85rem; color: var(--text-light); margin-top: 0; margin-bottom: 16px;">Bagikan pendapat Anda mengenai artikel ini.</p>
                
                <input type="text" name="name" class="form-input" placeholder="Nama Lengkap Anda" required>
                <textarea name="message" rows="3" class="form-input" placeholder="Tuliskan komentar Anda di sini..." required style="resize: vertical;"></textarea>
                
                <button type="submit" class="btn-submit"><i class="fa-solid fa-paper-plane"></i> Kirim Komentar</button>
            </form>

            <!-- Comments List -->
            <div class="comments-list">
                @forelse($comments as $comment)
                    <div class="comment-item">
                        <div class="comment-box">
                            <div class="comment-avatar">
                                {{ strtoupper(substr($comment->name, 0, 1)) }}
                            </div>
                            <div class="comment-content">
                                <div class="comment-header">
                                    <span class="comment-author">{{ $comment->name }}</span>
                                    <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="comment-text">{{ $comment->content }}</p>
                                
                                <div class="comment-actions">
                                    <form action="{{ route('komentar.like', $comment->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="action-btn"><i class="fa-solid fa-thumbs-up"></i> {{ $comment->likes_count > 0 ? $comment->likes_count : '' }} Suka</button>
                                    </form>
                                    <button onclick="toggleReplyForm({{ $comment->id }})" type="button" class="action-btn"><i class="fa-solid fa-reply"></i> Balas</button>
                                </div>

                                <!-- Reply Form -->
                                <form id="reply-form-{{ $comment->id }}" action="{{ route('komentar.store', $singleArticle->slug) }}" method="POST" style="display: none; margin-top: 16px; background: white; padding: 16px; border-radius: 12px; border: 1px solid var(--border);">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <input type="text" name="name" class="form-input" placeholder="Nama Anda" required style="padding: 10px 14px; margin-bottom: 12px;">
                                    <textarea name="message" rows="2" class="form-input" placeholder="Tulis balasan..." required style="padding: 10px 14px; margin-bottom: 12px; resize: vertical;"></textarea>
                                    <button type="submit" class="btn-submit" style="padding: 8px 16px; font-size: 0.9rem;"><i class="fa-solid fa-reply"></i> Kirim Balasan</button>
                                </form>
                            </div>
                        </div>

                        <!-- Replies List -->
                        @if($comment->replies && $comment->replies->count() > 0)
                            <div class="replies-list">
                                @foreach($comment->replies as $reply)
                                    <div class="reply-box">
                                        <div class="comment-avatar reply-avatar" style="background: var(--text-light);">
                                            {{ strtoupper(substr($reply->name, 0, 1)) }}
                                        </div>
                                        <div class="reply-content">
                                            <div class="comment-header">
                                                <span class="comment-author" style="font-size: 0.95rem;">{{ $reply->name }}</span>
                                                <span class="comment-date">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="comment-text" style="font-size: 0.95rem;">{{ $reply->content }}</p>
                                            <div class="comment-actions">
                                                <form action="{{ route('komentar.like', $reply->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="action-btn" style="font-size: 0.8rem;"><i class="fa-solid fa-thumbs-up"></i> {{ $reply->likes_count > 0 ? $reply->likes_count : '' }} Suka</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <div style="text-align: center; padding: 40px; color: var(--text-light); background: var(--bg-light); border-radius: 16px; border: 1px dashed #cbd5e1;">
                        <i class="fa-solid fa-comments" style="font-size: 2rem; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                        Belum ada komentar. Jadilah yang pertama memberikan tanggapan!
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <div style="text-align: center; padding: 20px; color: var(--text-light); font-size: 0.9rem; margin-bottom: 20px;">
        &copy; 2026 PAC IPNU IPPNU Kemiri. All rights reserved.
    </div>

    <script>
        function toggleReplyForm(id) {
            const form = document.getElementById('reply-form-' + id);
            if (form.style.display === 'none') {
                form.style.display = 'block';
                form.querySelector('input[name="name"]').focus();
            } else {
                form.style.display = 'none';
            }
        }
    </script>
</body>
</html>

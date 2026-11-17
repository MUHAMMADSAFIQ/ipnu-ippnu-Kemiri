@extends('layouts.portal')

@section('title', 'Berita & Artikel Terkini — PAC IPNU IPPNU Kemiri')

@section('content')
<div class="na-wrapper">
    <div class="na-header" style="background: linear-gradient(135deg, var(--primary-dark), var(--primary)); color: white; padding: 24px 28px; border-radius: 16px 16px 0 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; color: var(--accent); font-weight: 800;">INFORMASI & BERITA</div>
            <h1 style="font-family: 'Outfit', sans-serif; font-size: 1.6rem; font-weight: 800; margin: 4px 0 0 0;"><i class="fa-solid fa-newspaper" style="margin-right: 8px;"></i> ARSIP BERITA & ARTIKEL</h1>
            <p style="margin: 4px 0 0 0; font-size: 0.85rem; color: rgba(255,255,255,0.85);">Kabar terkini seputar dinamika kader, geliat ranting, dan opini intelektual pelajar NU.</p>
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <a href="{{ route('artikel.kirim') }}" style="background: var(--accent); color: #000; padding: 10px 18px; border-radius: 8px; text-decoration: none; font-size: 0.85rem; font-weight: 800; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 10px rgba(0,0,0,0.15);">
                <i class="fa-solid fa-feather-pointed"></i> Kirim Tulisan
            </a>
            <a href="{{ url('/') }}" style="color: white; background: rgba(255,255,255,0.15); padding: 10px 16px; border-radius: 8px; text-decoration: none; font-size: 0.85rem; font-weight: 700;">
                <i class="fa-solid fa-arrow-left"></i> Beranda
            </a>
        </div>
    </div>

    <div style="padding: 28px; background: white; border-radius: 0 0 16px 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
        <!-- Search bar -->
        <form action="{{ route('artikel.index') }}" method="GET" style="margin-bottom: 28px; display: flex; gap: 12px;">
            <div style="flex: 1; position: relative;">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul berita atau artikel..." style="width: 100%; padding: 12px 14px 12px 42px; border: 1px solid #cbd5e1; border-radius: 10px; font-family: inherit; font-size: 0.95rem; outline: none;">
            </div>
            <button type="submit" style="background: var(--primary); color: white; border: none; padding: 0 24px; border-radius: 10px; font-weight: 700; cursor: pointer; font-family: 'Outfit';">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('artikel.index') }}" style="background: #f1f5f9; color: #475569; display: flex; align-items: center; padding: 0 18px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.85rem;">Reset</a>
            @endif
        </form>

        <!-- Articles Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
            @forelse($articles as $article)
                <div style="border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; background: #ffffff; display: flex; flex-direction: column; transition: transform 0.25s, box-shadow 0.25s; box-shadow: 0 4px 12px rgba(0,0,0,0.02);" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.02)';">
                    <div style="height: 180px; width: 100%; overflow: hidden; background: #f1f5f9; position: relative;">
                        <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('images/hero_bg.png') }}" alt="{{ $article->title }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='{{ asset('images/alun_alun_kemiri.png') }}'">
                        <span style="position: absolute; top: 12px; left: 12px; background: rgba(15,23,42,0.75); backdrop-filter: blur(4px); color: white; font-size: 0.72rem; font-weight: 700; padding: 3px 8px; border-radius: 6px;">
                            <i class="fa-regular fa-calendar"></i> {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d M Y') : 'Baru' }}
                        </span>
                    </div>

                    <div style="padding: 20px; flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <div style="display: flex; gap: 12px; font-size: 0.78rem; color: #94a3b8; margin-bottom: 8px;">
                                <span><i class="fa-regular fa-user"></i> {{ $article->author ?? 'Redaksi' }}</span>
                                <span><i class="fa-regular fa-eye"></i> {{ number_format($article->views_count, 0, ',', '.') }} x dibaca</span>
                            </div>
                            <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.15rem; font-weight: 800; color: #1e293b; margin-bottom: 10px; line-height: 1.4;">
                                <a href="{{ route('artikel.show', $article->slug) }}" style="color: inherit; text-decoration: none;">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin-bottom: 16px;">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>
                        </div>

                        <div>
                            <a href="{{ route('artikel.show', $article->slug) }}" style="color: var(--primary); font-weight: 800; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; background: #f8fafc; border-radius: 12px; color: #64748b;">
                    <i class="fa-regular fa-newspaper" style="font-size: 3rem; margin-bottom: 12px; color: #cbd5e1;"></i>
                    <h3 style="font-weight: 700; color: #334155;">Tidak Ada Berita Ditemukan</h3>
                    <p style="font-size: 0.9rem;">Belum ada artikel yang cocok dengan kata kunci pencarian Anda.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div style="margin-top: 32px; display: flex; justify-content: center;">
            {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection

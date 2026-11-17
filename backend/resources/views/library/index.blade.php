@extends('layouts.portal')

@section('title', 'IPNU-IPPNU Library — PAC IPNU IPPNU Kemiri')

@section('content')
<div class="na-wrapper">
    <div class="na-header" style="background: linear-gradient(135deg, #065f46, var(--primary-dark)); color: white; padding: 24px 28px; border-radius: 16px 16px 0 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; color: var(--accent); font-weight: 800;">INFORMASI &amp; BERITA</div>
            <h1 style="font-family: 'Outfit', sans-serif; font-size: 1.6rem; font-weight: 800; margin: 4px 0 0 0;"><i class="fa-solid fa-book-bookmark" style="margin-right: 8px;"></i> IPNU-IPPNU DIGITAL LIBRARY</h1>
            <p style="margin: 4px 0 0 0; font-size: 0.85rem; color: rgba(255,255,255,0.85);">Perpustakaan digital literasi Aswaja, modul keilmuan Islam, biografi ulama, dan kepemimpinan pemuda.</p>
        </div>
        <a href="{{ url('/') }}" style="color: white; background: rgba(255,255,255,0.15); padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 0.85rem; font-weight: 700;">
            <i class="fa-solid fa-arrow-left"></i> Beranda
        </a>
    </div>

    <div style="padding: 28px; background: white; border-radius: 0 0 16px 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">

        @if($books->isEmpty())
            <!-- Empty state -->
            <div style="text-align: center; padding: 60px 20px; color: #94a3b8;">
                <i class="fa-solid fa-book-open" style="font-size: 3rem; margin-bottom: 16px; display: block; color: #cbd5e1;"></i>
                <p style="font-size: 1rem; font-weight: 600; margin-bottom: 8px;">Perpustakaan digital sedang dalam pengembangan</p>
                <p style="font-size: 0.85rem;">E-Book akan segera tersedia. Pantau terus update kami!</p>
            </div>
        @else
            <!-- Search & Filter bar -->
            <div style="display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 250px; position: relative;">
                    <i class="fa-solid fa-book-open" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <input type="text" id="libSearch" onkeyup="filterLib()" placeholder="Cari judul buku, kitab, atau penulis..." style="width: 100%; padding: 12px 14px 12px 40px; border: 1px solid #cbd5e1; border-radius: 10px; font-family: inherit; font-size: 0.9rem; outline: none;">
                </div>
                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                    <button class="lib-filter-btn active" onclick="filterLibCategory('all', this)" style="padding: 8px 16px; border-radius: 8px; border: 1px solid var(--primary); background: var(--primary); color: white; font-weight: 700; font-size: 0.85rem; cursor: pointer;">Semua Koleksi</button>
                    <button class="lib-filter-btn" onclick="filterLibCategory('aswaja', this)" style="padding: 8px 16px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; font-weight: 600; font-size: 0.85rem; cursor: pointer;">Ke-NU-an &amp; Aswaja</button>
                    <button class="lib-filter-btn" onclick="filterLibCategory('sejarah', this)" style="padding: 8px 16px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; font-weight: 600; font-size: 0.85rem; cursor: pointer;">Sejarah &amp; Tokoh</button>
                    <button class="lib-filter-btn" onclick="filterLibCategory('remaja', this)" style="padding: 8px 16px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; font-weight: 600; font-size: 0.85rem; cursor: pointer;">Fiqih &amp; Doa</button>
                </div>
            </div>

            <div id="libGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
                @foreach($books as $book)
                    <div class="lib-card item-{{ $book->category }}" data-title="{{ strtolower($book->title) }}" data-author="{{ strtolower($book->author) }}" style="border: 1px solid #e2e8f0; border-radius: 14px; background: #ffffff; overflow: hidden; display: flex; flex-direction: column; transition: transform 0.25s, box-shadow 0.25s; box-shadow: 0 4px 12px rgba(0,0,0,0.03);" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.03)';">
                        <!-- Book Cover Top Banner -->
                        <div style="background: linear-gradient(135deg, {{ $book->color ?? '#15803d' }}, #0f172a); padding: 24px 20px; color: white; display: flex; align-items: center; gap: 16px;">
                            @if($book->cover_path)
                                <img src="{{ Storage::url($book->cover_path) }}" alt="{{ $book->title }}" style="width: 50px; height: 68px; object-fit: cover; border-radius: 4px; border-left: 4px solid var(--accent); box-shadow: 2px 4px 10px rgba(0,0,0,0.3); flex-shrink: 0;">
                            @else
                                <div style="width: 50px; height: 68px; background: rgba(255,255,255,0.18); border-radius: 4px; border-left: 4px solid var(--accent); box-shadow: 2px 4px 10px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0;">
                                    <i class="fa-solid fa-book"></i>
                                </div>
                            @endif
                            <div>
                                <span style="font-size: 0.68rem; font-weight: 800; background: rgba(255,255,255,0.2); padding: 2px 8px; border-radius: 20px; text-transform: uppercase;">{{ $book->cat_label ?? $book->category }}</span>
                                <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.05rem; font-weight: 800; margin: 4px 0 2px; line-height: 1.3;">{{ $book->title }}</h3>
                                <div style="font-size: 0.78rem; opacity: 0.9;"><i class="fa-solid fa-pen-nib"></i> {{ $book->author }}</div>
                            </div>
                        </div>

                        <!-- Book Details & Synopsis -->
                        <div style="padding: 20px; flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            <p style="font-size: 0.85rem; color: #64748b; line-height: 1.6; margin-bottom: 16px;">{{ $book->synopsis ?? 'Tidak ada sinopsis tersedia.' }}</p>

                            <div style="background: #f8fafc; border-radius: 8px; padding: 10px 14px; display: flex; justify-content: space-between; font-size: 0.78rem; color: #475569; margin-bottom: 16px;">
                                <span><i class="fa-regular fa-file-lines"></i> {{ $book->pages ?? '—' }}</span>
                                <span><i class="fa-solid fa-language"></i> {{ $book->language ?? 'Indonesia' }}</span>
                                @if($book->download_count > 0)
                                    <span><i class="fa-solid fa-download"></i> {{ $book->download_count }}×</span>
                                @endif
                            </div>

                            <div style="display: flex; gap: 8px;">
                                @if($book->file_path)
                                    <a href="{{ route('library.download', $book->id) }}" style="flex: 1; padding: 10px; border: none; background: var(--primary); color: white; font-weight: 700; border-radius: 8px; cursor: pointer; font-size: 0.82rem; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 6px;">
                                        <i class="fa-solid fa-download"></i> Unduh E-Book
                                    </a>
                                @else
                                    <button disabled style="flex: 1; padding: 10px; border: 1px solid #e2e8f0; background: #f1f5f9; color: #94a3b8; font-weight: 700; border-radius: 8px; cursor: not-allowed; font-size: 0.82rem;">
                                        <i class="fa-solid fa-clock"></i> Segera Hadir
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
function filterLibCategory(category, btn) {
    document.querySelectorAll('.lib-filter-btn').forEach(b => {
        b.style.background = '#f8fafc';
        b.style.color = '#475569';
        b.style.borderColor = '#cbd5e1';
    });
    btn.style.background = 'var(--primary)';
    btn.style.color = '#ffffff';
    btn.style.borderColor = 'var(--primary)';

    const cards = document.querySelectorAll('.lib-card');
    cards.forEach(card => {
        if (category === 'all' || card.classList.contains('item-' + category)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

function filterLib() {
    const q = document.getElementById('libSearch').value.toLowerCase();
    const cards = document.querySelectorAll('.lib-card');
    cards.forEach(card => {
        const title  = card.getAttribute('data-title')  || '';
        const author = card.getAttribute('data-author') || '';
        card.style.display = (title.includes(q) || author.includes(q)) ? 'flex' : 'none';
    });
}
</script>
@endsection

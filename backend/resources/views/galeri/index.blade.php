@extends('layouts.portal')

@section('title', 'Galeri Dokumentasi Foto — PAC IPNU IPPNU Kemiri')

@section('content')
<div class="na-wrapper">
    <div class="na-header" style="background: linear-gradient(135deg, var(--primary-dark), var(--primary)); color: white; padding: 24px 28px; border-radius: 16px 16px 0 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; color: var(--accent); font-weight: 800;">DOKUMENTASI DIGITAL</div>
            <h1 style="font-family: 'Outfit', sans-serif; font-size: 1.6rem; font-weight: 800; margin: 4px 0 0 0;"><i class="fa-solid fa-images" style="margin-right: 8px;"></i> GALERI FOTO KEGIATAN</h1>
            <p style="margin: 4px 0 0 0; font-size: 0.85rem; color: rgba(255,255,255,0.85);">Rekam jejak visual, potret kegiatan, dan kenangan perjuangan kader PAC IPNU-IPPNU Kemiri.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ url('/') }}" style="color: white; background: rgba(255,255,255,0.15); padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 0.85rem; font-weight: 700;">
                <i class="fa-solid fa-arrow-left"></i> Beranda
            </a>
        </div>
    </div>

    <div style="padding: 24px 28px; background: white; border-radius: 0 0 16px 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
        <!-- Category Filter Tabs -->
        @php
            $categories = isset($galleries) && $galleries->count() > 0 ? $galleries->pluck('category')->unique()->filter()->values() : collect();
        @endphp

        <div style="display: flex; gap: 10px; overflow-x: auto; padding-bottom: 12px; margin-bottom: 24px; scrollbar-width: thin;">
            <button class="gallery-tab-btn active" onclick="filterGallery('all', this)" style="padding: 8px 18px; border-radius: 20px; border: 1px solid var(--primary); background: var(--primary); color: white; font-weight: 700; font-size: 0.85rem; cursor: pointer; white-space: nowrap; transition: all 0.2s;">
                <i class="fa-solid fa-border-all"></i> Semua Foto ({{ $galleries->count() }})
            </button>
            @foreach($categories as $cat)
                <button class="gallery-tab-btn" onclick="filterGallery('{{ Str::slug($cat) }}', this)" style="padding: 8px 18px; border-radius: 20px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; font-weight: 600; font-size: 0.85rem; cursor: pointer; white-space: nowrap; transition: all 0.2s;">
                    {{ $cat }} ({{ $galleries->where('category', $cat)->count() }})
                </button>
            @endforeach
        </div>

        <!-- Unlimited Gallery Grid -->
        <div class="gallery-unlimited-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 18px;">
            @forelse($galleries as $gallery)
                @php
                    $catSlug = Str::slug($gallery->category ?? 'umum');
                    $imgUrl = Str::startsWith($gallery->image, 'images/') ? asset($gallery->image) : asset('storage/' . $gallery->image);
                @endphp
                <div class="gallery-card item-{{ $catSlug }}" 
                     data-src="{{ $imgUrl }}" 
                     data-title="{{ $gallery->title }}" 
                     data-category="{{ $gallery->category ?? 'Dokumentasi' }}"
                     style="border-radius: 12px; overflow: hidden; position: relative; background: #0f172a; aspect-ratio: 4/3; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.06); transition: transform 0.25s, box-shadow 0.25s;" 
                     onclick="openViewerCard(this)" 
                     onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.15)';" 
                     onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.06)';">
                    <img src="{{ $imgUrl }}" alt="{{ $gallery->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;" onerror="this.src='{{ asset('images/alun_alun_kemiri.png') }}'">
                    
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.2) 50%, transparent 100%); display: flex; flex-direction: column; justify-content: flex-end; padding: 16px; color: white;">
                        <span style="font-size: 0.7rem; background: var(--accent); color: #000; font-weight: 800; padding: 2px 8px; border-radius: 4px; align-self: flex-start; margin-bottom: 6px; text-transform: uppercase;">
                            {{ $gallery->category ?? 'Dokumentasi' }}
                        </span>
                        <h4 style="font-family: 'Outfit', sans-serif; font-size: 0.95rem; font-weight: 700; margin: 0; line-height: 1.3; color: white;">{{ $gallery->title }}</h4>
                    </div>

                    <div style="position: absolute; top: 10px; right: 10px; width: 32px; height: 32px; border-radius: 50%; background: rgba(0,0,0,0.5); color: white; display: flex; align-items: center; justify-content: center; font-size: 0.85rem;">
                        <i class="fa-solid fa-expand"></i>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; background: #f8fafc; border-radius: 12px; color: #64748b;">
                    <i class="fa-regular fa-image" style="font-size: 3rem; margin-bottom: 12px; color: #cbd5e1;"></i>
                    <h3 style="font-weight: 700; color: #334155;">Belum Ada Foto Dokumentasi</h3>
                    <p style="font-size: 0.9rem;">Foto galeri yang diunggah melalui dashboard admin akan tampil secara otomatis di sini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal Fullscreen Lightbox Slider Viewer -->
<div id="photoViewerModal" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.94); z-index: 999999; backdrop-filter: blur(10px); flex-direction: column; align-items: center; justify-content: center; padding: 15px; user-select: none;">
    
    <!-- Top Bar Controls -->
    <div style="position: absolute; top: 16px; left: 20px; right: 20px; display: flex; justify-content: space-between; align-items: center; z-index: 10;">
        <div style="display: flex; align-items: center; gap: 10px;">
            <span id="viewerCategory" style="background: var(--accent); color: #000; font-size: 0.72rem; font-weight: 800; padding: 4px 10px; border-radius: 6px; text-transform: uppercase;"></span>
            <span id="viewerCounter" style="background: rgba(255,255,255,0.18); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700;">1 / 1</span>
        </div>
        
        <button onclick="closeViewer()" style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25); color: white; width: 44px; height: 44px; border-radius: 50%; font-size: 1.4rem; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='rgba(239,68,68,0.85)';" onmouseout="this.style.background='rgba(255,255,255,0.15)';">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <!-- Left (Previous) Slide Button -->
    <button id="viewerPrevBtn" onclick="prevPhoto()" aria-label="Foto Sebelumnya" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25); color: white; width: 54px; height: 54px; border-radius: 50%; font-size: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; transition: all 0.2s; backdrop-filter: blur(4px);" onmouseover="this.style.background='var(--primary)'; this.style.transform='translateY(-50%) scale(1.1)';" onmouseout="this.style.background='rgba(255,255,255,0.15)'; this.style.transform='translateY(-50%) scale(1)';">
        <i class="fa-solid fa-chevron-left"></i>
    </button>

    <!-- Main Image Stage -->
    <div style="max-width: 90vw; max-height: 82vh; display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative;">
        <img id="viewerImage" src="" style="max-width: 100%; max-height: 72vh; object-fit: contain; border-radius: 12px; box-shadow: 0 15px 50px rgba(0,0,0,0.85); transition: opacity 0.2s ease, transform 0.2s ease;" alt="Dokumentasi Foto">
        
        <!-- Caption Title & Hint -->
        <div style="margin-top: 14px; text-align: center; color: white; max-width: 800px;">
            <h3 id="viewerTitle" style="font-family: 'Outfit', sans-serif; font-size: 1.15rem; font-weight: 700; margin: 0 0 6px 0; text-shadow: 0 2px 4px rgba(0,0,0,0.5);"></h3>
            <div style="font-size: 0.75rem; color: #94a3b8; display: flex; align-items: center; justify-content: center; gap: 8px;">
                <span><i class="fa-solid fa-arrows-left-right"></i> Geser layar / Gunakan tombol panah &larr; &rarr;</span>
            </div>
        </div>
    </div>

    <!-- Right (Next) Slide Button -->
    <button id="viewerNextBtn" onclick="nextPhoto()" aria-label="Foto Selanjutnya" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25); color: white; width: 54px; height: 54px; border-radius: 50%; font-size: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; transition: all 0.2s; backdrop-filter: blur(4px);" onmouseover="this.style.background='var(--primary)'; this.style.transform='translateY(-50%) scale(1.1)';" onmouseout="this.style.background='rgba(255,255,255,0.15)'; this.style.transform='translateY(-50%) scale(1)';">
        <i class="fa-solid fa-chevron-right"></i>
    </button>
</div>

<style>
@media (max-width: 768px) {
    #viewerPrevBtn {
        left: 8px !important;
        width: 44px !important;
        height: 44px !important;
        font-size: 1.2rem !important;
    }
    #viewerNextBtn {
        right: 8px !important;
        width: 44px !important;
        height: 44px !important;
        font-size: 1.2rem !important;
    }
    #viewerImage {
        max-height: 65vh !important;
    }
}
</style>

<script>
let activeItems = [];
let currentIndex = 0;

function filterGallery(categorySlug, btn) {
    document.querySelectorAll('.gallery-tab-btn').forEach(b => {
        b.style.background = '#f8fafc';
        b.style.color = '#475569';
        b.style.borderColor = '#cbd5e1';
    });
    btn.style.background = 'var(--primary)';
    btn.style.color = '#ffffff';
    btn.style.borderColor = 'var(--primary)';

    const cards = document.querySelectorAll('.gallery-card');
    cards.forEach(card => {
        if (categorySlug === 'all' || card.classList.contains('item-' + categorySlug)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function updateActiveGalleryItems() {
    activeItems = [];
    document.querySelectorAll('.gallery-card').forEach((card) => {
        if (card.style.display !== 'none') {
            activeItems.push({
                src: card.getAttribute('data-src'),
                title: card.getAttribute('data-title'),
                category: card.getAttribute('data-category')
            });
        }
    });
}

function openViewerCard(cardElement) {
    updateActiveGalleryItems();
    const clickedSrc = cardElement.getAttribute('data-src');
    currentIndex = activeItems.findIndex(item => item.src === clickedSrc);
    if (currentIndex === -1) currentIndex = 0;
    
    renderViewer();
    document.getElementById('photoViewerModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function renderViewer() {
    if (activeItems.length === 0) return;
    const item = activeItems[currentIndex];
    const img = document.getElementById('viewerImage');
    
    img.style.opacity = '0.3';
    img.style.transform = 'scale(0.97)';
    
    setTimeout(() => {
        img.src = item.src;
        img.onload = () => {
            img.style.opacity = '1';
            img.style.transform = 'scale(1)';
        };
        img.style.opacity = '1';
        img.style.transform = 'scale(1)';
    }, 100);

    document.getElementById('viewerTitle').textContent = item.title;
    document.getElementById('viewerCategory').textContent = item.category;
    document.getElementById('viewerCounter').textContent = (currentIndex + 1) + ' / ' + activeItems.length;

    const prevBtn = document.getElementById('viewerPrevBtn');
    const nextBtn = document.getElementById('viewerNextBtn');
    if (activeItems.length <= 1) {
        if (prevBtn) prevBtn.style.display = 'none';
        if (nextBtn) nextBtn.style.display = 'none';
    } else {
        if (prevBtn) prevBtn.style.display = 'flex';
        if (nextBtn) nextBtn.style.display = 'flex';
    }
}

function nextPhoto() {
    if (activeItems.length <= 1) return;
    currentIndex = (currentIndex + 1) % activeItems.length;
    renderViewer();
}

function prevPhoto() {
    if (activeItems.length <= 1) return;
    currentIndex = (currentIndex - 1 + activeItems.length) % activeItems.length;
    renderViewer();
}

function closeViewer() {
    document.getElementById('photoViewerModal').style.display = 'none';
    document.body.style.overflow = '';
}

// Keyboard controls
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('photoViewerModal');
    if (modal && modal.style.display === 'flex') {
        if (e.key === 'ArrowRight') nextPhoto();
        if (e.key === 'ArrowLeft')  prevPhoto();
        if (e.key === 'Escape')     closeViewer();
    }
});

// Mobile Swipe Gesture
let touchStartX = 0;
let touchEndX = 0;
const modal = document.getElementById('photoViewerModal');
if (modal) {
    modal.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    modal.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        const diff = touchEndX - touchStartX;
        if (Math.abs(diff) > 40) {
            if (diff < 0) {
                nextPhoto(); // geser ke kiri -> foto selanjutnya
            } else {
                prevPhoto(); // geser ke kanan -> foto sebelumnya
            }
        }
    }, { passive: true });
}
</script>
@endsection

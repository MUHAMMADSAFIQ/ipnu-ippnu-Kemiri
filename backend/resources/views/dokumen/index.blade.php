@extends('layouts.portal')

@section('title', 'Pusat Dokumen Resmi — PAC IPNU IPPNU Kemiri')

@section('content')
<div class="na-wrapper">
    <div class="na-header" style="background: linear-gradient(135deg, var(--primary-dark), var(--primary)); color: white; padding: 24px 28px; border-radius: 16px 16px 0 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; color: var(--accent); font-weight: 800;">INFORMASI & BERITA</div>
            <h1 style="font-family: 'Outfit', sans-serif; font-size: 1.6rem; font-weight: 800; margin: 4px 0 0 0;"><i class="fa-solid fa-folder-open" style="margin-right: 8px;"></i> PUSAT DOKUMEN RESMI</h1>
            <p style="margin: 4px 0 0 0; font-size: 0.85rem; color: rgba(255,255,255,0.85);">Unduh berkas administrasi, regulasi organisasi, modul kaderisasi, dan format surat resmi terverifikasi.</p>
        </div>
        <a href="{{ url('/') }}" style="color: white; background: rgba(255,255,255,0.15); padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 0.85rem; font-weight: 700;">
            <i class="fa-solid fa-arrow-left"></i> Beranda
        </a>
    </div>

    <div style="padding: 28px; background: white; border-radius: 0 0 16px 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
        @if(session('info'))
            <div style="background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; display: flex; align-items: center; gap: 10px;">
                <i class="fa-solid fa-circle-info" style="font-size: 1.2rem;"></i>
                <div>{{ session('info') }}</div>
            </div>
        @endif

        @if(session('success'))
            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; display: flex; align-items: center; gap: 10px;">
                <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <!-- Search & Filter bar -->
        <div style="display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 250px; position: relative;">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                <input type="text" id="docSearch" onkeyup="filterDocs()" placeholder="Cari dokumen, modul, atau format surat..." style="width: 100%; padding: 12px 14px 12px 40px; border: 1px solid #cbd5e1; border-radius: 10px; font-family: inherit; font-size: 0.9rem; outline: none;">
            </div>
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <button class="doc-filter-btn active" onclick="filterCategory('all', this)" style="padding: 8px 16px; border-radius: 8px; border: 1px solid var(--primary); background: var(--primary); color: white; font-weight: 700; font-size: 0.85rem; cursor: pointer;">Semua Dokumen</button>
                <button class="doc-filter-btn" onclick="filterCategory('kaderisasi', this)" style="padding: 8px 16px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; font-weight: 600; font-size: 0.85rem; cursor: pointer;">Kaderisasi</button>
                <button class="doc-filter-btn" onclick="filterCategory('administrasi', this)" style="padding: 8px 16px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; font-weight: 600; font-size: 0.85rem; cursor: pointer;">Administrasi</button>
                <button class="doc-filter-btn" onclick="filterCategory('regulasi', this)" style="padding: 8px 16px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; font-weight: 600; font-size: 0.85rem; cursor: pointer;">PD/PRT & PO</button>
            </div>
        </div>

        <!-- Document Grid -->
        <div id="docGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px;">
            @forelse($documents as $doc)
                <div class="doc-card item-{{ $doc->category }}" data-title="{{ strtolower($doc->title) }}" data-desc="{{ strtolower($doc->desc ?? '') }}" style="border: 1px solid #e2e8f0; border-radius: 14px; padding: 22px; background: #ffffff; display: flex; flex-direction: column; justify-content: space-between; transition: transform 0.2s, box-shadow 0.2s; box-shadow: 0 2px 6px rgba(0,0,0,0.02);" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.06)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 2px 6px rgba(0,0,0,0.02)';">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                            <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(0,0,0,0.04); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: {{ $doc->color ?: '#dc2626' }};">
                                <i class="fa-solid {{ $doc->icon ?: 'fa-file-pdf' }}"></i>
                            </div>
                            <span style="font-size: 0.72rem; font-weight: 800; background: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 20px; text-transform: uppercase;">
                                {{ $doc->cat_label ?: ucfirst($doc->category) }}
                            </span>
                        </div>
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.1rem; font-weight: 700; color: #1e293b; margin-bottom: 8px; line-height: 1.4;">{{ $doc->title }}</h3>
                        <p style="font-size: 0.85rem; color: #64748b; line-height: 1.5; margin-bottom: 16px;">{{ $doc->desc }}</p>
                    </div>

                    <div style="border-top: 1px solid #f1f5f9; padding-top: 14px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                        <span style="font-size: 0.78rem; font-weight: 600; color: #94a3b8;">
                            <i class="fa-solid fa-hard-drive"></i> {{ $doc->file_type }} &bull; {{ $doc->file_size ?: 'Tersedia' }}
                            @if($doc->download_count > 0)
                                &bull; <i class="fa-solid fa-download"></i> {{ $doc->download_count }}x
                            @endif
                        </span>
                        <a href="{{ route('dokumen.download', $doc->id) }}" style="background: var(--primary); color: white; padding: 7px 16px; border-radius: 8px; text-decoration: none; font-size: 0.82rem; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; transition: background 0.2s;">
                            <i class="fa-solid fa-cloud-arrow-down"></i> Unduh
                        </a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: #94a3b8;">
                    <i class="fa-solid fa-folder-open" style="font-size: 3rem; margin-bottom: 12px; opacity: 0.5;"></i>
                    <h3 style="font-size: 1.1rem; color: #475569; margin-bottom: 6px;">Belum Ada Dokumen Resmi</h3>
                    <p style="font-size: 0.85rem;">Dokumen resmi dan berkas administrasi akan diunggah oleh pengurus organisasi.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
function filterCategory(category, btn) {
    document.querySelectorAll('.doc-filter-btn').forEach(b => {
        b.style.background = '#f8fafc';
        b.style.color = '#475569';
        b.style.borderColor = '#cbd5e1';
    });
    btn.style.background = 'var(--primary)';
    btn.style.color = '#ffffff';
    btn.style.borderColor = 'var(--primary)';

    const cards = document.querySelectorAll('.doc-card');
    cards.forEach(card => {
        if (category === 'all' || card.classList.contains('item-' + category)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

function filterDocs() {
    const q = document.getElementById('docSearch').value.toLowerCase();
    const cards = document.querySelectorAll('.doc-card');
    cards.forEach(card => {
        const title = card.getAttribute('data-title') || '';
        const desc = card.getAttribute('data-desc') || '';
        if (title.includes(q) || desc.includes(q)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>
@endsection

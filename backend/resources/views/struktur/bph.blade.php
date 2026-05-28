@extends('layouts.portal')

@section('content')
<style>
    .sp-wrapper {
        background: var(--bg-light);
        min-height: 80vh;
        padding: 40px 0 60px;
        font-family: 'Outfit', sans-serif;
    }
    .sp-header {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        padding: 48px 24px;
        text-align: center;
        margin-bottom: 48px;
        position: relative;
        overflow: hidden;
    }
    .sp-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ asset("images/hero_bg.png") }}') center/cover;
        opacity: 0.08;
    }
    .sp-header-inner { position: relative; z-index: 1; }
    .sp-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(250,204,21,0.15);
        border: 1px solid rgba(250,204,21,0.3);
        padding: 6px 18px;
        border-radius: 50px;
        color: #facc15;
        font-size: 0.78rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 16px;
    }
    .sp-header h1 {
        font-weight: 900;
        font-size: 2.2rem;
        color: white;
        margin-bottom: 10px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }
    .sp-header p {
        color: rgba(255,255,255,0.75);
        font-size: 0.9rem;
        max-width: 600px;
        margin: 0 auto;
    }
    .sp-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 16px;
    }
    .sp-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 28px;
    }
    @media (max-width: 768px) {
        .sp-grid { grid-template-columns: 1fr; }
    }

    /* Column card */
    .sp-col {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }
    .sp-col-title {
        background: linear-gradient(90deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 14px 20px;
        font-weight: 800;
        font-size: 1.05rem;
        font-style: italic;
    }
    .sp-col-photo {
        width: 100%;
        border-bottom: 3px solid var(--primary);
    }
    .sp-col-photo img {
        width: 100%;
        display: block;
        object-fit: cover;
        max-height: 300px;
    }
    .sp-col-body {
        padding: 20px;
    }

    /* Section bars */
    .sp-section-bar {
        background: linear-gradient(90deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 8px 16px;
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 10px;
        border-radius: 4px;
    }
    .sp-section-bar.sub {
        font-style: italic;
        font-weight: 600;
    }
    .sp-section {
        margin-bottom: 20px;
    }
    .sp-list {
        list-style: disc;
        padding-left: 24px;
        margin: 0 0 6px 0;
    }
    .sp-list li {
        padding: 3px 0;
        font-size: 0.88rem;
        color: #1e293b;
        line-height: 1.5;
    }
    .sp-list li strong {
        color: var(--primary-dark);
    }

    /* Position label (bold before name) */
    .sp-pos {
        font-weight: 700;
        color: var(--primary-dark);
    }

    /* Bottom CTA */
    .sp-cta {
        text-align: center;
        margin-top: 48px;
        padding: 28px;
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        border-radius: 20px;
        border: 1px solid #bbf7d0;
    }
    .sp-cta p {
        color: var(--primary-dark);
        font-weight: 700;
        font-size: 0.88rem;
        margin-bottom: 12px;
    }
    .sp-cta a {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary);
        color: white;
        padding: 10px 22px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        transition: background 0.2s;
    }
    .sp-cta a:hover { background: var(--primary-dark); }

    /* Tabs CSS */
    .bph-tabs-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 30px;
    }
    .bph-tab {
        padding: 10px 20px;
        font-weight: 700;
        cursor: pointer;
        background: white;
        color: var(--text-dark);
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        transition: all 0.3s;
        font-family: 'Outfit', sans-serif;
        font-size: 0.95rem;
    }
    .bph-tab:hover { background: var(--bg-light); }
    .bph-tab.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }
    .bph-content { display: none; }
    .bph-content.active { display: block; animation: fadeIn 0.4s ease-in-out; }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="sp-wrapper">
    {{-- Page Header --}}
    <div class="sp-header">
        <div class="sp-header-inner">
            <div class="sp-badge">🏛️ Struktur Kepengurusan</div>
            <h1>SUSUNAN PENGURUS</h1>
            <p>Pimpinan Anak Cabang IPNU &amp; IPPNU Kecamatan Kemiri — Masa Khidmat 2025-2027</p>
        </div>
    </div>

    <div class="sp-container">
        @php
            $bphOfficials = $officials->where('type', 'bph')
                                      ->whereIn('organization', ['IPNU', 'IPPNU'])
                                      ->groupBy(function($item) {
                                          return $item->service_period ?: 'Periode Lainnya';
                                      })
                                      ->sortByDesc(function($item, $key) {
                                          return $key;
                                      });
        @endphp

        @if($bphOfficials->isEmpty())
            <div style="text-align: center; padding: 40px; color: #94a3b8; background: white; border-radius: 16px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                <div style="font-size: 2.5rem; margin-bottom: 8px;">🏛️</div>
                <div style="font-weight: 700; font-size: 1.2rem;">Data Pengurus Belum Tersedia</div>
                <div style="font-size: 0.9rem;">Admin belum mendaftarkan data pengurus BPH.</div>
            </div>
        @else
            <div class="bph-tabs-container">
                @foreach($bphOfficials as $period => $group)
                    <button class="bph-tab {{ $loop->first ? 'active' : '' }}" onclick="switchBphTab('{{ Str::slug($period) }}')">
                        Masa Khidmat {{ $period }}
                    </button>
                @endforeach
            </div>

            @foreach($bphOfficials as $period => $group)
                <div id="bph-{{ Str::slug($period) }}" class="bph-content {{ $loop->first ? 'active' : '' }}">
                    <div class="sp-grid">
                        {{-- ═══════════ IPNU COLUMN ═══════════ --}}
                        <div class="sp-col">
                            <div class="sp-col-title">Susunan Pengurus IPNU</div>

                            <div class="sp-col-photo">
                                <img src="{{ asset('images/STRUKTUR IPNU.jpg') }}" alt="Foto Bersama Pengurus IPNU">
                            </div>

                            <div class="sp-col-body">
                                @php $ipnu = $group->where('organization','IPNU'); @endphp
                                @foreach($ipnu->groupBy('section') as $section => $members)
                                    <div class="sp-section">
                                        <div class="sp-section-bar">{{ $section }}</div>
                                        <ul class="sp-list">
                                            @foreach($members as $person)
                                                <li>
                                                    @if($person->position !== $section && $person->position !== 'Anggota')
                                                        <span class="sp-pos">{{ $person->position }}:</span>
                                                    @endif
                                                    {{ $person->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                                @if($ipnu->isEmpty())
                                    <p style="text-align:center;color:#94a3b8;padding:20px;font-size:0.9rem;">Data belum tersedia</p>
                                @endif
                            </div>
                        </div>

                        {{-- ═══════════ IPPNU COLUMN ═══════════ --}}
                        <div class="sp-col">
                            <div class="sp-col-title">Susunan Pengurus IPPNU</div>

                            <div class="sp-col-photo">
                                <img src="{{ asset('images/STRUKTUR IPPNU.jpeg') }}" alt="Foto Bersama Pengurus IPPNU">
                            </div>

                            <div class="sp-col-body">
                                @php $ippnu = $group->where('organization','IPPNU'); @endphp
                                @foreach($ippnu->groupBy('section') as $section => $members)
                                    <div class="sp-section">
                                        <div class="sp-section-bar">{{ $section }}</div>
                                        <ul class="sp-list">
                                            @foreach($members as $person)
                                                <li>
                                                    @if($person->position !== $section && $person->position !== 'Anggota')
                                                        <span class="sp-pos">{{ $person->position }}:</span>
                                                    @endif
                                                    {{ $person->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                                @if($ippnu->isEmpty())
                                    <p style="text-align:center;color:#94a3b8;padding:20px;font-size:0.9rem;">Data belum tersedia</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        {{-- Bottom CTA --}}
        <div class="sp-cta">
            <p>Lihat juga Nahkoda / Pimpinan Inti organisasi</p>
            <a href="{{ url('/profil/nahkoda') }}">
                <i class="fa-solid fa-anchor"></i> Lihat Nahkoda
            </a>
        </div>
    </div>
</div>

<script>
    function switchBphTab(periodSlug) {
        document.querySelectorAll('.bph-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.bph-content').forEach(c => c.classList.remove('active'));
        
        event.currentTarget.classList.add('active');
        const target = document.getElementById('bph-' + periodSlug);
        if(target) {
            target.classList.add('active');
        }
    }
</script>
@endsection

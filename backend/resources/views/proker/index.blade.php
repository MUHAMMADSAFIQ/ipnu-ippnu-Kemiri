@extends('layouts.portal')

@section('title', 'Program Kerja — PAC IPNU IPPNU Kemiri')

@section('content')
<div class="na-wrapper">
    <div class="na-header" style="background: linear-gradient(135deg, var(--primary-dark), var(--primary)); color: white; padding: 24px 28px; border-radius: 16px 16px 0 0; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; color: var(--accent); font-weight: 800;">PAC IPNU IPPNU KEMIRI</div>
            <h1 style="font-family: 'Outfit', sans-serif; font-size: 1.6rem; font-weight: 800; margin: 4px 0 0 0;"><i class="fa-solid fa-list-check" style="margin-right: 8px;"></i> PROGRAM KERJA UNGGULAN</h1>
        </div>
        <a href="{{ url('/') }}" style="color: white; background: rgba(255,255,255,0.15); padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 0.85rem; font-weight: 700; transition: background 0.2s;">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div style="padding: 28px; background: white; border-radius: 0 0 16px 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
        <p style="color: #64748b; font-size: 1rem; line-height: 1.7; margin-bottom: 28px;">
            Berikut adalah deretan program kerja strategis Pimpinan Anak Cabang IPNU-IPPNU Kecamatan Kemiri untuk mengabdi, membina pelajar, menguatkan kaderisasi, dan memberdayakan potensi generasi muda Nahdlatul Ulama.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
            @forelse($programs as $program)
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; display: flex; flex-direction: column; transition: transform 0.2s, box-shadow 0.2s; box-shadow: 0 2px 8px rgba(0,0,0,0.03);" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.03)';">
                    @if($program->photo)
                        <div style="height: 180px; width: 100%; overflow: hidden; background: #e2e8f0;">
                            <img src="{{ asset('storage/' . $program->photo) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $program->title }}">
                        </div>
                    @else
                        <div style="height: 120px; width: 100%; background: linear-gradient(135deg, rgba(21,128,61,0.08), rgba(250,204,21,0.12)); display: flex; align-items: center; justify-content: center;">
                            <i class="{{ $program->icon ?? 'fa-solid fa-handshake' }}" style="font-size: 3rem; color: var(--primary);"></i>
                        </div>
                    @endif

                    <div style="padding: 20px; flex: 1; display: flex; flex-direction: column;">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                            <span style="background: rgba(21,128,61,0.1); color: var(--primary-dark); font-size: 0.75rem; font-weight: 800; padding: 4px 10px; border-radius: 20px;">
                                <i class="fa-solid fa-flag"></i> Prioritas
                            </span>
                        </div>
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.2rem; font-weight: 800; color: #1e293b; margin-bottom: 10px;">{{ $program->title }}</h3>
                        <p style="font-size: 0.9rem; color: #64748b; line-height: 1.6; margin-bottom: 16px; flex: 1;">
                            {{ $program->description ?? 'Program penguatan kapasitas dan khidmah pelajar Nahdlatul Ulama di wilayah Kecamatan Kemiri.' }}
                        </p>
                    </div>
                </div>
            @empty
                <!-- Default standard programs if database has none -->
                @php
                    $defaultProkers = [
                        ['title' => 'MAKESTA Raya Berkala', 'desc' => 'Masa Kesetiaan Anggota serentak untuk membina ratusan pelajar di tingkat ranting dan komisariat se-Kecamatan Kemiri.', 'icon' => 'fa-solid fa-graduation-cap'],
                        ['title' => 'Digitalisasi Organisasi & Media', 'desc' => 'Pengembangan portal resmi, sistem e-voting, arsip digital, dan literasi konten kreatif untuk pelajar NU.', 'icon' => 'fa-solid fa-laptop-code'],
                        ['title' => 'Lapak Pelajar & Kewirausahaan', 'desc' => 'Pemberdayaan kemandirian ekonomi kader melalui etalase produk lokal dan pelatihan wirausaha muda.', 'icon' => 'fa-solid fa-shop'],
                        ['title' => 'Kaderisasi CBP & KPP Tanggap', 'desc' => 'Pelatihan kedisiplinan, tanggap bencana alam, kepanduan, dan kepedulian sosial lingkungan hidup.', 'icon' => 'fa-solid fa-shield-halved'],
                        ['title' => 'Kajian Aswaja & Fiqih Remaja', 'desc' => 'Majelis ilmu mingguan membahas penguatan akidah Ahlussunnah wal Jamaah dan problematika kontemporer remaja.', 'icon' => 'fa-solid fa-book-open-reader'],
                        ['title' => 'Sapa Ranting & Sambung Rasa', 'desc' => 'Turba (turun ke bawah) dan monitoring perkembangan organisasi di 16 ranting dan komisariat se-Kecamatan Kemiri.', 'icon' => 'fa-solid fa-users']
                    ];
                @endphp

                @foreach($defaultProkers as $p)
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 24px; display: flex; flex-direction: column;">
                        <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(21,128,61,0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 16px;">
                            <i class="{{ $p['icon'] }}"></i>
                        </div>
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.15rem; font-weight: 800; color: #1e293b; margin-bottom: 8px;">{{ $p['title'] }}</h3>
                        <p style="font-size: 0.9rem; color: #64748b; line-height: 1.6;">{{ $p['desc'] }}</p>
                    </div>
                @endforeach
            @endforelse
        </div>
    </div>
</div>
@endsection

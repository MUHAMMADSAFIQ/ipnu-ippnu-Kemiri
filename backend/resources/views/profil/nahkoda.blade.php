@extends('layouts.portal')

@section('content')
<div style="background:var(--bg-light);min-height:80vh;padding:40px 0;">

    {{-- Header --}}
    <div style="background:linear-gradient(135deg,var(--primary-dark),var(--primary));padding:48px 24px;text-align:center;margin-bottom:48px;position:relative;overflow:hidden;">
        <div style="position:absolute;inset:0;background:url('{{ asset('images/hero_bg.png') }}') center/cover;opacity:0.08;"></div>
        <div style="position:relative;z-index:1;">
            <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(250,204,21,0.15);border:1px solid rgba(250,204,21,0.3);padding:6px 18px;border-radius:50px;color:#facc15;font-size:0.78rem;font-weight:800;text-transform:uppercase;letter-spacing:1px;margin-bottom:16px;">
                ⚓ PAC IPNU IPPNU KEMIRI
            </div>
            <h1 style="font-family:'Outfit',sans-serif;font-weight:900;font-size:2.4rem;color:white;margin-bottom:10px;text-shadow:0 2px 10px rgba(0,0,0,0.3);">
                NAHKODA ORGANISASI
            </h1>
            <p style="color:rgba(255,255,255,0.75);font-size:0.95rem;max-width:500px;margin:0 auto;">
                Pimpinan masa khidmat yang menggerakkan roda organisasi PAC IPNU IPPNU Kemiri
            </p>
        </div>
    </div>

    <div class="container" style="max-width:1100px;margin:0 auto;padding:0 16px;">

        {{-- Pimpinan Utama --}}
        @if($pimpinan->isNotEmpty())
        <div style="margin-bottom:60px;">
            <div style="text-align:center;margin-bottom:36px;">
                <h2 style="font-family:'Outfit',sans-serif;font-weight:900;font-size:1.8rem;color:var(--primary-dark);display:inline-flex;align-items:center;gap:10px;">
                    <span style="font-size:1.5rem;">⚓</span> Pimpinan Inti
                </h2>
                <div style="width:60px;height:4px;background:var(--accent);border-radius:2px;margin:12px auto 0;"></div>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(340px,1fr));gap:32px;justify-content:center;max-width:1000px;margin:0 auto;">
                @foreach($pimpinan as $index => $person)
                <div style="background:white;border-radius:24px;padding:40px 30px;text-align:left;box-shadow:0 12px 40px rgba(0,0,0,0.06);border:1px solid #e2e8f0;position:relative;overflow:hidden;display:flex;flex-direction:column;gap:24px;">
                    <div style="position:absolute;top:0;left:0;right:0;height:8px;background:linear-gradient(90deg,var(--primary-dark),var(--primary));"></div>

                    <!-- Header Profile -->
                    <div style="display:flex;align-items:center;gap:20px;">
                        <div style="width:120px;height:120px;border-radius:50%;border:4px solid var(--accent);overflow:hidden;background:#f1f5f9;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 8px 24px rgba(0,0,0,0.1);">
                            @if($person->photo)
                                <img src="{{ Storage::url($person->photo) }}" alt="{{ $person->name }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <span style="font-size:4rem;">👤</span>
                            @endif
                        </div>
                        <div>
                            <div style="background:var(--primary);color:white;padding:4px 14px;border-radius:50px;display:inline-block;font-size:0.75rem;font-weight:800;letter-spacing:0.5px;text-transform:uppercase;margin-bottom:8px;">
                                {{ $person->position }}
                            </div>
                            <h3 style="font-family:'Outfit',sans-serif;font-weight:900;font-size:1.4rem;color:var(--text-dark);line-height:1.2;margin:0;">
                                {{ $person->name }}
                            </h3>
                            @if($person->service_period)
                                <div style="font-size:0.85rem;color:var(--primary-dark);font-weight:700;margin-top:6px;">
                                    <i class="fa-regular fa-clock"></i> Masa Khidmat: {{ $person->service_period }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Detail Info -->
                    <div style="background:#f8fafc;border-radius:16px;padding:20px;border:1px solid #e2e8f0;display:flex;flex-direction:column;gap:14px;">
                        @if($person->birth_place_date)
                        <div style="display:flex;align-items:flex-start;gap:12px;">
                            <div style="width:28px;height:28px;border-radius:50%;background:#e0e7ff;color:#4338ca;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:0.8rem;">
                                <i class="fa-solid fa-cake-candles"></i>
                            </div>
                            <div>
                                <div style="font-size:0.75rem;color:#64748b;font-weight:700;text-transform:uppercase;margin-bottom:2px;">Tempat, Tgl Lahir</div>
                                <div style="font-size:0.95rem;color:var(--text-dark);font-weight:600;">{{ $person->birth_place_date }}</div>
                            </div>
                        </div>
                        @endif

                        @if($person->movement_focus)
                        <div style="display:flex;align-items:flex-start;gap:12px;">
                            <div style="width:28px;height:28px;border-radius:50%;background:#dcfce7;color:#15803d;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:0.8rem;">
                                <i class="fa-solid fa-bullseye"></i>
                            </div>
                            <div>
                                <div style="font-size:0.75rem;color:#64748b;font-weight:700;text-transform:uppercase;margin-bottom:2px;">Fokus Gerakan</div>
                                <div style="font-size:0.95rem;color:var(--text-dark);font-weight:600;">{{ $person->movement_focus }}</div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Motto -->
                    <div style="margin-top:auto;padding-top:16px;border-top:1px dashed #cbd5e1;">
                        <p style="font-size:0.95rem;color:#475569;font-style:italic;line-height:1.6;margin:0;position:relative;padding-left:24px;">
                            <span style="position:absolute;left:0;top:-4px;font-size:1.8rem;color:rgba(21,128,61,0.2);font-family:serif;">"</span>
                            {{ $person->motto ?? 'Berkhidmat untuk umat, bergerak untuk kemajuan pelajar.' }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- BPH / Struktur --}}
        @if($bph->isNotEmpty())
        <div style="margin-bottom:48px;">
            <div style="text-align:center;margin-bottom:36px;">
                <h2 style="font-family:'Outfit',sans-serif;font-weight:900;font-size:1.8rem;color:var(--primary-dark);display:inline-flex;align-items:center;gap:10px;">
                    <span style="font-size:1.5rem;">🏛️</span> Struktur BPH
                </h2>
                <div style="width:60px;height:4px;background:var(--accent);border-radius:2px;margin:12px auto 0;"></div>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:18px;">
                @foreach($bph as $person)
                <div style="background:white;border-radius:18px;padding:24px 16px;text-align:center;box-shadow:0 4px 16px rgba(0,0,0,0.06);border:1px solid #e2e8f0;transition:transform 0.2s,box-shadow 0.2s;"
                     onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'"
                     onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 16px rgba(0,0,0,0.06)'">
                    <div style="width:90px;height:90px;border-radius:50%;margin:0 auto 14px;border:3px solid var(--primary);overflow:hidden;background:#f1f5f9;display:flex;align-items:center;justify-content:center;">
                        @if($person->photo)
                            <img src="{{ Storage::url($person->photo) }}" alt="{{ $person->name }}" style="width:100%;height:100%;object-fit:cover;">
                        @else
                            <span style="font-size:2.2rem;">👤</span>
                        @endif
                    </div>
                    <h4 style="font-family:'Outfit',sans-serif;font-weight:800;font-size:0.92rem;color:var(--text-dark);margin-bottom:6px;line-height:1.3;">{{ $person->name }}</h4>
                    <span style="font-size:0.72rem;color:var(--primary);font-weight:700;background:#f0fdf4;padding:3px 10px;border-radius:20px;display:inline-block;">{{ $person->position }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($pimpinan->isEmpty() && $bph->isEmpty())
        <div style="text-align:center;padding:80px 24px;color:#94a3b8;">
            <div style="font-size:4rem;margin-bottom:16px;opacity:0.3;">👥</div>
            <h3 style="font-family:'Outfit';font-weight:800;font-size:1.3rem;margin-bottom:8px;color:#64748b;">Data pengurus belum tersedia</h3>
            <p style="font-size:0.9rem;">Data pimpinan akan ditampilkan setelah admin mengisikan data pengurus.</p>
        </div>
        @endif

        {{-- CTA Admin --}}
        <div style="text-align:center;margin-top:48px;padding:32px;background:linear-gradient(135deg,#f0fdf4,#dcfce7);border-radius:20px;border:1px solid #bbf7d0;">
            <p style="color:var(--primary-dark);font-weight:700;margin-bottom:12px;font-size:0.9rem;">
                <i class="fa-solid fa-info-circle"></i> Data pengurus dikelola oleh admin portal
            </p>
            <a href="{{ route('admin.dashboard') }}" style="display:inline-flex;align-items:center;gap:8px;background:var(--primary);color:white;padding:10px 22px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;transition:all 0.2s;"
               onmouseover="this.style.background='var(--primary-dark)'" onmouseout="this.style.background='var(--primary)'">
                <i class="fa-solid fa-lock"></i> Kelola Data Pengurus (Admin)
            </a>
        </div>
    </div>
</div>
@endsection

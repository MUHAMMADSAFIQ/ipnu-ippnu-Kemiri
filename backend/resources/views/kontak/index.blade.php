@extends('layouts.portal')

@section('title', 'Ruang Lapor & Kontak — PAC IPNU IPPNU Kemiri')

@section('content')
<div class="na-wrapper">
    <div class="na-header" style="background: linear-gradient(135deg, var(--primary-dark), var(--primary)); color: white; padding: 24px 28px; border-radius: 16px 16px 0 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; color: var(--accent); font-weight: 800;">LAYANAN ASPIRASI</div>
            <h1 style="font-family: 'Outfit', sans-serif; font-size: 1.6rem; font-weight: 800; margin: 4px 0 0 0;"><i class="fa-solid fa-comment-dots" style="margin-right: 8px;"></i> RUANG LAPOR, KRITIK & SARAN</h1>
            <p style="margin: 4px 0 0 0; font-size: 0.85rem; color: rgba(255,255,255,0.85);">Sampaikan aspirasi, saran, aduan, atau pesan Anda untuk kemajuan bersama PAC IPNU IPPNU Kemiri.</p>
        </div>
        <a href="{{ url('/') }}" style="color: white; background: rgba(255,255,255,0.15); padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 0.85rem; font-weight: 700;">
            <i class="fa-solid fa-arrow-left"></i> Beranda
        </a>
    </div>

    <div style="padding: 32px 28px; background: white; border-radius: 0 0 16px 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
        @if(session('success'))
            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 18px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 14px;">
                <i class="fa-solid fa-circle-check" style="font-size: 1.6rem; color: #16a34a;"></i>
                <div>
                    <h4 style="margin: 0; font-weight: 800;">Pesan Terkirim!</h4>
                    <p style="margin: 4px 0 0; font-size: 0.9rem;">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 40px;">
            <div>
                <h2 style="font-family: 'Outfit', sans-serif; font-weight: 800; color: var(--primary-dark); font-size: 1.4rem; margin-bottom: 12px;">Sampaikan Masukan Anda</h2>
                <p style="color: #64748b; line-height: 1.7; margin-bottom: 24px;">
                    Kami sangat menghargai setiap masukan, kritik konstruktif, maupun aspirasi demi mengawal jalannya organisasi yang transparan, progresif, dan berorientasi pada kemaslahatan pelajar Nahdlatul Ulama se-Kecamatan Kemiri.
                </p>

                <div style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 28px;">
                    <div style="display: flex; gap: 14px; align-items: center; background: #f8fafc; padding: 14px 18px; border-radius: 12px; border: 1px solid #e2e8f0;">
                        <div style="width: 42px; height: 42px; background: rgba(21,128,61,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.72rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Sekretariat Bersama</div>
                            <div style="font-weight: 700; color: #1e293b; font-size: 0.9rem;">Gedung MWC NU Kemiri, Jl. Raya Kemiri - Pituruh</div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 14px; align-items: center; background: #f8fafc; padding: 14px 18px; border-radius: 12px; border: 1px solid #e2e8f0;">
                        <div style="width: 42px; height: 42px; background: rgba(37,99,235,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #2563eb; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.72rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Hotline WhatsApp</div>
                            <div style="font-weight: 700; color: #1e293b; font-size: 0.9rem;">+62 812-3456-7890 (Layanan 24 Jam)</div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 14px; align-items: center; background: #f8fafc; padding: 14px 18px; border-radius: 12px; border: 1px solid #e2e8f0;">
                        <div style="width: 42px; height: 42px; background: rgba(217,119,6,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #d97706; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.72rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Email Resmi</div>
                            <div style="font-weight: 700; color: #1e293b; font-size: 0.9rem;">admin@ipnukemiri.or.id</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Ruang Lapor -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 28px;">
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.2rem; font-weight: 800; margin-bottom: 18px; color: #1e293b;">
                    <i class="fa-solid fa-pen-to-square" style="color: var(--primary);"></i> Form Masukan & Aduan
                </h3>

                <form action="{{ route('ruang-lapor.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
                    @csrf
                    <div>
                        <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Nama Lengkap / Inisial <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="name" required placeholder="Nama Anda atau Anonim" style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.9rem; outline: none; background: white;">
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Topik / Subjek</label>
                        <input type="text" name="subject" placeholder="Contoh: Saran Kegiatan Makesta / Pelatihan Digital" style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.9rem; outline: none; background: white;">
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 6px;">No. WhatsApp / Email (Opsional)</label>
                        <input type="text" name="contact" placeholder="Untuk dihubungi kembali oleh admin..." style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.9rem; outline: none; background: white;">
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Isi Kritik, Saran, atau Aduan <span style="color: #ef4444;">*</span></label>
                        <textarea name="message" rows="5" required placeholder="Tuliskan aspirasi Anda dengan santun dan membangun..." style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.9rem; line-height: 1.5; outline: none; background: white;"></textarea>
                    </div>

                    <button type="submit" style="background: var(--primary); color: white; border: none; padding: 14px; border-radius: 8px; font-weight: 800; font-family: 'Outfit', sans-serif; cursor: pointer; transition: background 0.2s; box-shadow: 0 4px 12px rgba(21,128,61,0.25);">
                        <i class="fa-solid fa-paper-plane" style="margin-right: 6px;"></i> Kirim Aspirasi Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

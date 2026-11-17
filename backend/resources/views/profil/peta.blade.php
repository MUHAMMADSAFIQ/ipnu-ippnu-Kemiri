@extends('layouts.portal')

@section('title', 'Peta Sekretariat — PAC IPNU IPPNU Kemiri')

@section('content')
<div class="na-wrapper">
    <div class="na-header" style="background: linear-gradient(135deg, var(--primary-dark), var(--primary)); color: white; padding: 24px 28px; border-radius: 16px 16px 0 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; color: var(--accent); font-weight: 800;">LOKASI RESMI</div>
            <h1 style="font-family: 'Outfit', sans-serif; font-size: 1.6rem; font-weight: 800; margin: 4px 0 0 0;"><i class="fa-solid fa-map-location-dot" style="margin-right: 8px;"></i> PETA SEKRETARIAT PAC IPNU IPPNU KEMIRI</h1>
            <p style="margin: 4px 0 0 0; font-size: 0.85rem; color: rgba(255,255,255,0.85);">Pusat koordinasi, administrasi, dan layanan pelajar NU se-Kecamatan Kemiri.</p>
        </div>
        <a href="{{ url('/') }}" style="color: white; background: rgba(255,255,255,0.15); padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 0.85rem; font-weight: 700;">
            <i class="fa-solid fa-arrow-left"></i> Beranda
        </a>
    </div>

    <div style="padding: 28px; background: white; border-radius: 0 0 16px 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
        <!-- Map Container -->
        <div style="height: 480px; border-radius: 14px; overflow: hidden; border: 1px solid #cbd5e1; box-shadow: 0 4px 15px rgba(0,0,0,0.05); position: relative;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.734842542488!2d109.9042567890!3d-7.632156890123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a8ca16f5c862d%3A0x4027a765a3717a0!2sKemiri%2C%20Kec.%20Kemiri%2C%20Kabupaten%20Purworejo%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1714630000000!5m2!1sid!2sid"
                style="width: 100%; height: 100%; border: none;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <div style="margin-top: 24px; display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
            <div style="padding: 20px; background: #f8fafc; border-radius: 12px; border-left: 4px solid var(--primary);">
                <div style="font-size: 0.75rem; text-transform: uppercase; font-weight: 800; color: #94a3b8; letter-spacing: 1px; margin-bottom: 6px;">Alamat Sekretariat:</div>
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.15rem; font-weight: 800; color: #1e293b; margin-bottom: 8px;">Sekretariat Bersama PAC IPNU IPPNU Kemiri</h3>
                <p style="font-size: 0.9rem; color: #475569; line-height: 1.6; margin: 0;">
                    Kompleks Gedung MWC NU Kemiri<br>
                    Jl. Raya Kemiri - Pituruh, Kemiri<br>
                    Kabupaten Purworejo, Jawa Tengah 54262
                </p>
            </div>

            <div style="padding: 20px; background: #f8fafc; border-radius: 12px; border-left: 4px solid var(--accent); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="font-size: 0.75rem; text-transform: uppercase; font-weight: 800; color: #94a3b8; letter-spacing: 1px; margin-bottom: 6px;">Jam Pelayanan:</div>
                    <p style="font-size: 0.9rem; color: #475569; line-height: 1.6; margin: 0 0 14px 0;">
                        <strong>Senin - Jumat:</strong> 09.00 - 16.00 WIB<br>
                        <strong>Sabtu:</strong> 09.00 - 13.00 WIB
                    </p>
                </div>
                <a href="https://maps.app.goo.gl/qJdrVL3cghZddma99" target="_blank" style="background: #db4437; color: white; padding: 10px 18px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0.85rem; text-align: center; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fa-solid fa-location-arrow"></i> Buka Petunjuk Arah di Google Maps
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

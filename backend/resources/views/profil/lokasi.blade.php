@extends('layouts.portal')

@section('content')
<div class="na-wrapper">
    <div class="na-header"><span>📍 LOKASI SEKRETARIAT</span></div>
    <div style="padding: 40px; background: white;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
            <div>
                <h2 style="font-family: 'Outfit'; font-weight: 800; color: var(--primary); margin-bottom: 20px;">Sekretariat Bersama PAC IPNU IPPNU Kemiri</h2>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #475569; margin-bottom: 30px;">
                    Kompleks Kantor MWC NU Kemiri<br>
                    Jl. Raya Kemiri - Pituruh, Kemiri<br>
                    Kabupaten Purworejo, Jawa Tengah 54262
                </p>
                
                <div style="background: #f1f5f9; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                    <h5 style="font-weight: 800; margin-bottom: 5px;">JAM LAYANAN:</h5>
                    <p style="font-size: 0.9rem;">Setiap Hari: 09.00 - 16.00 WIB<br>(Khusus Hari Besar/Kegiatan tutup)</p>
                </div>

                <a href="https://maps.google.com" target="_blank" style="display: block; text-align: center; background: #db4437; color: white; padding: 15px; border-radius: 10px; text-decoration: none; font-weight: 800; transition: transform 0.2s;">
                    <i class="fa-solid fa-map-location-dot"></i> PETUNJUK ARAH GOOGLE MAPS
                </a>
            </div>
            <div style="border-radius: 20px; overflow: hidden; border: 5px solid #f1f5f9; box-shadow: var(--shadow-md);">
                <div style="height: 350px; background: #eee; display: flex; align-items: center; justify-content: center; font-size: 5rem; color: #cbd5e1;">
                    <i class="fa-solid fa-building-ngo"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

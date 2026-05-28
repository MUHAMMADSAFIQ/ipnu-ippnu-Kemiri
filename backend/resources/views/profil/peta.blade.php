@extends('layouts.portal')

@section('content')
<div class="na-wrapper">
    <div class="na-header"><span>🗺️ PETA WILAYAH KERJA PAC KEMIRI</span></div>
    <div style="padding: 20px; background: white;">
        <div style="height: 500px; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31630.0!2d109.91!3d-7.64!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a8ca16f5c862d%3A0x4027a765a3717a0!2sKemiri%2C%20Kec.%20Kemiri%2C%20Kabupaten%20Purworejo%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1714630000000!5m2!1sid!2sid"
                style="width: 100%; height: 100%; border: none;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div style="margin-top: 20px; padding: 20px; background: #f8fafc; border-radius: 12px;">
            <h4 style="font-weight: 800; margin-bottom: 10px;">Cakupan Wilayah:</h4>
            <p style="font-size: 0.9rem;">PAC IPNU IPPNU Kemiri membawahi 12 Ranting (Desa) dan 5 Komisariat (Sekolah) di seluruh wilayah Kecamatan Kemiri, Kabupaten Purworejo.</p>
        </div>
    </div>
</div>
@endsection

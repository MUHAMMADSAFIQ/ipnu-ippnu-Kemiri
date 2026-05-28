@extends('layouts.portal')

@section('content')
<div class="na-wrapper">
    <div class="na-header"><span>🌟 VISI MISI PAC IPNU IPPNU KEMIRI</span></div>
    <div style="padding: 40px; background: white; text-align: center;">
        <div style="max-width: 800px; margin: 0 auto;">
            <img src="{{ asset('images/logo_ipnu.png') }}" style="width: 100px; margin-bottom: 20px;">
            <h2 style="font-family: 'Outfit'; font-weight: 800; color: var(--primary-dark); margin-bottom: 30px;">Visi Misi PAC IPNU IPPNU Kemiri</h2>
            
            <div style="text-align: left; margin-bottom: 40px;">
                <h3 style="color: var(--primary); font-family: 'Outfit', sans-serif; font-weight: 800; border-left: 5px solid var(--accent); padding-left: 15px; margin-bottom: 20px;">VISI</h3>
                <div style="background: #f0fdf4; padding: 25px; border-radius: 12px; border: 1px dashed var(--primary);">
                    <p style="font-size: 1.15rem; line-height: 1.8; color: #166534; font-style: italic; margin: 0; text-align: center;">
                        “Terwujudnya organisasi IPNU-IPPNU yang solid, bersinergi, dan progresif dalam membangun pelajar Nahdlatul Ulama yang berkualitas, berakhlakul karimah, berwawasan luas, serta mampu berkontribusi bagi agama, bangsa, dan masyarakat.”
                    </p>
                </div>
            </div>

            <div style="text-align: left;">
                <h3 style="color: var(--primary); font-family: 'Outfit', sans-serif; font-weight: 800; border-left: 5px solid var(--accent); padding-left: 15px; margin-bottom: 20px;">MISI</h3>
                <ol style="padding-left: 20px; font-size: 1.05rem; line-height: 1.8; color: #334155;">
                    <li style="margin-bottom: 15px;">Meningkatkan solidaritas dan sinergi antar pengurus serta anggota IPNU-IPPNU dalam menjalankan organisasi.</li>
                    <li style="margin-bottom: 15px;">Mengembangkan kualitas pelajar NU melalui kegiatan pendidikan, keagamaan, dan pengembangan keterampilan.</li>
                    <li style="margin-bottom: 15px;">Menanamkan nilai-nilai Ahlussunnah wal Jama’ah An-Nahdliyah dalam kehidupan sehari-hari.</li>
                    <li style="margin-bottom: 15px;">Mendorong budaya organisasi yang aktif, inovatif, dan progresif sesuai perkembangan zaman.</li>
                    <li style="margin-bottom: 15px;">Membentuk generasi pelajar NU yang berkarakter, bertanggung jawab, dan mampu menjadi teladan di lingkungan masyarakat.</li>
                    <li style="margin-bottom: 15px;">Memperkuat kerja sama dengan berbagai pihak demi mendukung kemajuan organisasi dan pengembangan potensi pelajar NU.</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

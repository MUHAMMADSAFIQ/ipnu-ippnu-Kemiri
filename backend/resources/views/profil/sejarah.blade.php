@extends('layouts.portal')

@section('content')
<div class="na-wrapper">
    <div class="na-header"><span>📜 SEJARAH IPNU IPPNU</span></div>
    <div style="padding: 24px; background: white;">
        <style>
            .sejarah-tabs-container {
                display: flex;
                justify-content: center;
                margin-bottom: 20px;
            }
            .sejarah-tabs {
                display: flex;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: var(--shadow-md);
                width: 100%;
                max-width: 500px;
            }
            .sejarah-tab {
                flex: 1;
                text-align: center;
                padding: 12px 16px;
                font-weight: 700;
                cursor: pointer;
                background: white;
                color: var(--text-dark);
                transition: all 0.3s;
                border: none;
                outline: none;
                font-family: 'Outfit', sans-serif;
                font-size: 1.1rem;
            }
            .sejarah-tab:hover {
                background: var(--bg-light);
            }
            .sejarah-tab.active {
                background: var(--primary);
                color: white;
            }
            .sejarah-content {
                display: none;
                background: #f0fdf4; /* Very light green */
                padding: 24px;
                border-radius: 12px;
                border: 1px solid rgba(21, 128, 61, 0.1);
                line-height: 1.8;
                color: var(--text-dark);
                text-align: justify;
            }
            .sejarah-content.active {
                display: block;
                animation: fadeIn 0.4s ease-in-out;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(5px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>

        <div class="sejarah-tabs-container">
            <div class="sejarah-tabs">
                <button class="sejarah-tab active" onclick="switchSejarahTab('ipnu')">IPNU</button>
                <button class="sejarah-tab" onclick="switchSejarahTab('ippnu')">IPPNU</button>
            </div>
        </div>

        <div id="sejarah-ipnu" class="sejarah-content active">
            <h3 style="color: var(--primary); margin-bottom: 20px; text-align: center; font-family: 'Outfit', sans-serif; font-weight: 800;">Sejarah IPNU</h3>
            
            <div style="border-radius:12px; overflow:hidden; border: 1px solid #e2e8f0; margin-bottom: 20px; box-shadow:0 4px 15px rgba(0,0,0,0.05);">
                <!-- Banner -->
                <img src="{{ asset('images/KH Tolchah Mansoer Pendiri IPNU.jpg') }}" style="width:100%; height:auto; display:block;" alt="Banner Pendiri IPNU">
                
                <!-- Info with Portrait -->
                <div style="display:flex; flex-wrap:wrap; align-items:center; gap:20px; padding:20px; background:white; border-left: 4px solid var(--primary);">
                    <img src="{{ asset('images/PENDIRI IPNU.jpg') }}" style="width:100px; height:100px; border-radius:50%; object-fit:cover; border: 3px solid #bbf7d0; box-shadow:0 4px 10px rgba(0,0,0,0.1);" alt="KH. Tolchah Mansoer">
                    <div style="flex:1; min-width:200px;">
                        <h4 style="margin:0 0 5px 0; color:var(--primary-dark); font-weight:800; font-size:1.2rem;">Prof. Dr. KH. Tolchah Mansoer</h4>
                        <p style="margin:0; color:#64748b; font-size:0.85rem; font-weight:700; text-transform:uppercase; letter-spacing:1px;">Pendiri IPNU</p>
                    </div>
                </div>
            </div>

            <p style="margin-bottom: 12px;">Ikatan Pelajar Nahdlatul Ulama (IPNU) didirikan pada tanggal 20 Jumadil Akhir 1373 H, bertepatan dengan 24 Februari 1954 M ketika diselenggarakan Kongres LP Ma’arif di Semarang. Sejak berdirinya, IPNU menjadi bagian dari LP Ma’arif. Namun pada tahun 1966 ketika diselenggarakan Kongres IPNU di Surabaya, IPNU resmi melepaskan diri dari LP Ma’arif dan menjadi badan otonom (banom) NU. Salah seorang pendiri IPNU adalah Prof. Dr. KH. Tolchah Mansyur.</p>
            <p style="margin-bottom: 12px;">Sejak berdirinya, IPNu merupakan kepanjangan dari Ikatan Pelajar Nahdlatul Ulama. Namun sejak tahun 1988, melalui kongresnya yang ke-10 di Jombang yang dikenal dengan istilah Deklarasi Jombang, kepanjangan IPNU berganti menjadi Ikatan Putera nahdlatul Ulama. Hal ini dikarenakan harus menyesuaikan diri dengan Undang-undang Nomor 8 Tahun 1985 tentang keormasan yang melarang adanya organisasi pelajar di sekolah selain OSIS.</p>
            <p>Namun setelah orde baru tumbang, di saat kebebasan berpendapat dan berekspresi dapat diperoleh dengan mudah, kepanjangan tersebut dikembalikan lagi seperti saat kelahirannya. Melalui kongresnya yang ke-14 di Surabaya (18-22 juni 2003), kepanjangan IPNU kembali seperti semula yaitu Ikatan Pelajar Nahdlatul Ulama.</p>
        </div>

        <div id="sejarah-ippnu" class="sejarah-content">
            <h3 style="color: #c2410c; margin-bottom: 20px; text-align: center; font-family: 'Outfit', sans-serif; font-weight: 800;">Sejarah IPPNU</h3>
            
            <div style="border-radius:12px; overflow:hidden; border: 1px solid #e2e8f0; margin-bottom: 20px; box-shadow:0 4px 15px rgba(0,0,0,0.05);">
                <!-- Banner -->
                <img src="{{ asset('images/Pendiri IPPNU (1).jpg') }}" style="width:100%; height:auto; display:block;" alt="Banner Pendiri IPPNU">
                
                <!-- Info with Portrait -->
                <div style="display:flex; flex-wrap:wrap; align-items:center; gap:20px; padding:20px; background:white; border-left: 4px solid #c2410c;">
                    <img src="{{ asset('images/PENDIRI IPPNU.jpg') }}" style="width:100px; height:100px; border-radius:50%; object-fit:cover; border: 3px solid #fdba74; box-shadow:0 4px 10px rgba(0,0,0,0.1);" alt="Ny. Hj. Umroh Mahfudzah">
                    <div style="flex:1; min-width:200px;">
                        <h4 style="margin:0 0 5px 0; color:#c2410c; font-weight:800; font-size:1.2rem;">Ny. Hj. Umroh Mahfudzah</h4>
                        <p style="margin:0; color:#64748b; font-size:0.85rem; font-weight:700; text-transform:uppercase; letter-spacing:1px;">Pendiri IPPNU</p>
                    </div>
                </div>
            </div>

            <p style="margin-bottom: 12px;">Sedangkan Ikatan Pelajar Putri Nahdlatul Ulama (IPPNU) didirikan pada tanggal 8 Rajab 1374 H bertepatan dengan tanggal 2 maret 1955 M di Solo Jawa Tengah. Salah seorang pendirinya adalah Ny. Umroh Mahfudzah. Sejak berdirinya, IPPNU bernaung di bawah LP Ma’arif. Namun sejak tahun 1966 melalui kongresnya di Surabaya, IPPNU berdiri sendiri sebagai salah satu badan otonom (banom) NU.</p>
            <p style="margin-bottom: 12px;">Sejak berdirinya, IPPNU merupakan kepanjangan dari Ikatan pelajar Putri Nahdlatul Ulama. Namun sejak tahun 1988, melalui kongresnya yang ke-9 di Jombang (29-31 januari 1988), kepanjangan IPPNU berganti menjadi Ikatan Putri-putri Nahdlatul Ulama. Hal ini dikarenakan harus menyesuaikan diri dengan Undang-undang Nomor 8 Tahun 1985 tentang keormasan yang melarang adanya organisasi pelajar di sekolah selain OSIS.</p>
            <p>Namun setelah Orde Baru tumbang, di saat kebebasan berpendapat dan berekspresi dapat diperoleh dengan mudah kepanjangan tersebut dikembalikan lagi seperti saat kelahirannya, melalui kongresnya yang ke-13 di Surabaya (18-22 Juni 2003), kepanjangan IPPNU kembali seperti semula yaitu Ikatan Pelajar Putri Nahdlatul Ulama.</p>
        </div>

        <script>
            function switchSejarahTab(tab) {
                document.querySelectorAll('.sejarah-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.sejarah-content').forEach(c => c.classList.remove('active'));
                
                if (tab === 'ipnu') {
                    document.querySelectorAll('.sejarah-tab')[0].classList.add('active');
                    document.getElementById('sejarah-ipnu').classList.add('active');
                } else {
                    document.querySelectorAll('.sejarah-tab')[1].classList.add('active');
                    document.getElementById('sejarah-ippnu').classList.add('active');
                }
            }
        </script>
    </div>
</div>
@endsection

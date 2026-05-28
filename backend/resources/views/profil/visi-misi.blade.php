@extends('layouts.portal')

@section('content')
<div class="na-wrapper">
    <div class="na-header"><span>🎯 VISI MISI IPNU IPPNU (PUSAT)</span></div>
    <div style="padding: 24px; background: white;">
        <style>
            .vm-tabs-container {
                display: flex;
                justify-content: center;
                margin-bottom: 20px;
            }
            .vm-tabs {
                display: flex;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: var(--shadow-md);
                width: 100%;
                max-width: 500px;
            }
            .vm-tab {
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
            .vm-tab:hover {
                background: var(--bg-light);
            }
            .vm-tab.active {
                background: var(--primary);
                color: white;
            }
            .vm-content {
                display: none;
                background: #f0fdf4;
                padding: 24px;
                border-radius: 12px;
                border: 1px solid rgba(21, 128, 61, 0.1);
                line-height: 1.8;
                color: var(--text-dark);
                text-align: justify;
            }
            .vm-content.active {
                display: block;
                animation: fadeIn 0.4s ease-in-out;
            }
        </style>

        <div class="vm-tabs-container">
            <div class="vm-tabs">
                <button class="vm-tab active" onclick="switchVmTab('ipnu')">IPNU</button>
                <button class="vm-tab" onclick="switchVmTab('ippnu')">IPPNU</button>
            </div>
        </div>

        <!-- IPNU Visi Misi -->
        <div id="vm-ipnu" class="vm-content active">
            <h3 style="color: var(--primary); margin-bottom: 10px; font-family: 'Outfit', sans-serif; font-weight: 800; text-align: center;">Visi IPNU</h3>
            <p style="margin-bottom: 20px; font-style: italic;">Terwujudnya pelajar-pelajar bangsa yang bertaqwa kepada Allah SWT, berahlakul karimah, menguasai ilmu pengetahuan dan teknologi, memiliki kesadaran dan tanggungjawab terhada tatanan masyarakat yang berkeadilan dan demokratis atas dasar ajaran Islam ahlusunnah wal jamaah.</p>
            
            <h3 style="color: var(--primary); margin-bottom: 10px; font-family: 'Outfit', sans-serif; font-weight: 800; text-align: center;">Misi IPNU</h3>
            <ol style="padding-left: 20px;">
                <li style="margin-bottom: 8px;">Mendorong para pelajar bangsa untuk taat (patuh) dalam menjalankan perintah dan menjauhi segala larangan yang termaktub dalam ajaran Islam.</li>
                <li style="margin-bottom: 8px;">Membentuk karakter para pelajar bangsa yang santun dalam bertindak, jujur dalam berprilaku, jernih dan obyektif dalam berfikir, serta memiliki ide/gagasan yang inovatif.</li>
                <li style="margin-bottom: 8px;">Mendorong pemamfaatan dan pengembangan ilmu pengetahuan dan teknologi sebagai media pengembangan potensi dan peningkatan SDM belajar.</li>
                <li style="margin-bottom: 8px;">Mewujudkan kader pemimpin bangsa yang profesional, jujur dan bertanggung jawab yang dilandasi oleh spirit nilai ajaran Islam ahlusunnah wal jamaah.</li>
            </ol>
        </div>

        <!-- IPPNU Visi Misi -->
        <div id="vm-ippnu" class="vm-content">
            <h3 style="color: var(--primary); margin-bottom: 10px; font-family: 'Outfit', sans-serif; font-weight: 800; text-align: center;">Visi IPPNU</h3>
            <p style="margin-bottom: 20px; font-style: italic;">Terbentuknya kesempurnaan Pelajar Putri Indonesia yang bertakwa, berakhlaqul karimah, berilmu, dan berwawasan kebangsaan.</p>
            
            <h3 style="color: var(--primary); margin-bottom: 10px; font-family: 'Outfit', sans-serif; font-weight: 800; text-align: center;">Misi IPPNU</h3>
            <ol style="padding-left: 20px;">
                <li style="margin-bottom: 8px;">Membangun kader NU yang berkualitas, berakhlaqul karimah, bersikap demokratis dalam kehidupan bermasyarakat, berbangsa dan bernegara.</li>
                <li style="margin-bottom: 8px;">Mengembangkan wacana dan kualitas sumber dya kader menuju terciptanya kesetaraan gender.</li>
                <li style="margin-bottom: 8px;">Membentuk kader yang dinamis, kreatif, dan inovatif.</li>
            </ol>
        </div>

        <script>
            function switchVmTab(tab) {
                document.querySelectorAll('.vm-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.vm-content').forEach(c => c.classList.remove('active'));
                
                if (tab === 'ipnu') {
                    document.querySelectorAll('.vm-tab')[0].classList.add('active');
                    document.getElementById('vm-ipnu').classList.add('active');
                } else {
                    document.querySelectorAll('.vm-tab')[1].classList.add('active');
                    document.getElementById('vm-ippnu').classList.add('active');
                }
            }
        </script>
    </div>
</div>
@endsection

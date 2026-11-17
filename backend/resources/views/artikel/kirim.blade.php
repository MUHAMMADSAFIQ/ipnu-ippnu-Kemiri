@extends('layouts.portal')

@section('title', 'Kirim Berita & Publikasi Ranting — PAC IPNU IPPNU Kemiri')

@push('styles')
<style>
    /* Kirim Berita Responsive & Modern Layout */
    .redaksi-container {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .redaksi-header {
        background: linear-gradient(135deg, #064e3b 0%, #15803d 50%, #166534 100%);
        border-radius: 18px;
        padding: 32px 36px;
        color: white;
        box-shadow: 0 10px 30px rgba(6, 78, 59, 0.18);
        position: relative;
        overflow: hidden;
    }

    .redaksi-header::after {
        content: '';
        position: absolute;
        right: -30px;
        bottom: -30px;
        width: 180px;
        height: 180px;
        background: radial-gradient(circle, rgba(250, 204, 21, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .header-top-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 14px;
    }

    .header-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #fef08a;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .header-nav-btns {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-header-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-header-white {
        background: white;
        color: #064e3b;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .btn-header-white:hover {
        background: #f8fafc;
        transform: translateY(-2px);
    }

    .btn-header-ghost {
        background: rgba(255, 255, 255, 0.14);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-header-ghost:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
    }

    .header-title-block h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        line-height: 1.25;
        margin: 0 0 8px 0;
        color: #ffffff;
    }

    .header-title-block p {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.88);
        margin: 0 0 20px 0;
        max-width: 820px;
        line-height: 1.6;
    }

    .header-features-strip {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
    }

    .feature-chip {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(0, 0, 0, 0.2);
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #e2e8f0;
    }

    .feature-chip i {
        color: #facc15;
    }

    /* 2-Column Responsive Layout */
    .redaksi-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
        align-items: start;
    }

    @media (min-width: 1080px) {
        .redaksi-grid {
            grid-template-columns: minmax(0, 1fr) 350px;
        }
    }

    @media (min-width: 1400px) {
        .redaksi-grid {
            grid-template-columns: minmax(0, 1fr) 380px;
        }
    }

    /* Form Container */
    .form-card {
        background: white;
        border-radius: 18px;
        padding: 32px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }

    .form-section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 22px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f1f5f9;
    }

    .form-section-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #dcfce7;
        color: #15803d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .form-section-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.15rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    .form-section-sub {
        font-size: 0.8rem;
        color: #64748b;
        margin: 2px 0 0 0;
    }

    .form-row-2 {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        margin-bottom: 22px;
    }

    @media (min-width: 720px) {
        .form-row-2 {
            grid-template-columns: 1fr 1fr;
        }
    }

    .form-field {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .field-label {
        font-size: 0.88rem;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .field-required {
        color: #ef4444;
    }

    .field-hint {
        font-size: 0.78rem;
        color: #64748b;
    }

    .form-input, .form-textarea, .form-select {
        width: 100%;
        padding: 13px 16px;
        border: 1.5px solid #cbd5e1;
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.95rem;
        color: #0f172a;
        background: #f8fafc;
        box-sizing: border-box;
        transition: all 0.2s ease;
        outline: none;
    }

    .form-input:focus, .form-textarea:focus, .form-select:focus {
        border-color: #15803d;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(21, 128, 61, 0.12);
    }

    /* Modern Dropzone */
    .dropzone-box {
        border: 2px dashed #94a3b8;
        border-radius: 14px;
        padding: 28px 20px;
        text-align: center;
        background: #f8fafc;
        cursor: pointer;
        transition: all 0.25s ease;
        position: relative;
    }

    .dropzone-box:hover, .dropzone-box.dragover {
        border-color: #15803d;
        background: #f0fdf4;
    }

    .dropzone-icon {
        font-size: 2.4rem;
        color: #15803d;
        margin-bottom: 10px;
    }

    .dropzone-text {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
    }

    .dropzone-sub {
        font-size: 0.8rem;
        color: #64748b;
    }

    .dropzone-preview-wrap {
        display: none;
        margin-top: 16px;
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        background: white;
        padding: 12px;
    }

    .preview-img {
        width: 100%;
        max-height: 260px;
        object-fit: cover;
        border-radius: 8px;
    }

    .preview-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
        font-size: 0.82rem;
        color: #475569;
    }

    .btn-remove-preview {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-remove-preview:hover {
        background: #fecaca;
    }

    /* Textarea counter */
    .textarea-meta-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.8rem;
        color: #64748b;
        margin-top: 6px;
        padding: 0 4px;
    }

    /* Submit Section */
    .submit-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: 28px;
        padding-top: 24px;
        border-top: 1px solid #f1f5f9;
    }

    .btn-submit-berita {
        background: linear-gradient(135deg, #15803d, #166534);
        color: white;
        border: none;
        padding: 16px 36px;
        border-radius: 12px;
        font-size: 1.05rem;
        font-weight: 800;
        font-family: 'Outfit', sans-serif;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 6px 18px rgba(21, 128, 61, 0.28);
        transition: all 0.25s ease;
    }

    .btn-submit-berita:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(21, 128, 61, 0.38);
        background: linear-gradient(135deg, #166534, #14532d);
    }

    /* Sidebar Panduan Cards */
    .guide-card {
        background: white;
        border-radius: 18px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        margin-bottom: 20px;
    }

    .guide-card-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
    }

    .guide-card-icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: #fef08a;
        color: #854d0e;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
    }

    .guide-card-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.05rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    .w-h-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .w-h-item {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        font-size: 0.85rem;
        line-height: 1.5;
        color: #334155;
    }

    .w-h-tag {
        background: #f1f5f9;
        color: #0f172a;
        font-weight: 800;
        font-size: 0.72rem;
        padding: 3px 8px;
        border-radius: 6px;
        white-space: nowrap;
        border: 1px solid #e2e8f0;
    }

    .step-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        position: relative;
    }

    .step-item {
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }

    .step-num {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: #15803d;
        color: white;
        font-weight: 800;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .step-text h5 {
        margin: 0 0 2px 0;
        font-size: 0.88rem;
        font-weight: 700;
        color: #0f172a;
    }

    .step-text p {
        margin: 0;
        font-size: 0.78rem;
        color: #64748b;
        line-height: 1.4;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .redaksi-header {
            padding: 24px 20px;
            border-radius: 14px;
        }

        .header-title-block h1 {
            font-size: 1.5rem;
        }

        .header-title-block p {
            font-size: 0.85rem;
            margin-bottom: 16px;
        }

        .form-card {
            padding: 20px 16px;
            border-radius: 14px;
        }

        .btn-submit-berita {
            width: 100%;
            justify-content: center;
        }

        .header-nav-btns {
            width: 100%;
        }

        .btn-header-link {
            flex: 1;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="redaksi-container">

    <!-- HEADER BANNER MODERN FULL-WIDTH -->
    <div class="redaksi-header">
        <div class="header-top-row">
            <div class="header-badge">
                <i class="fa-solid fa-feather-pointed"></i> RUANG REDAKSI PELAJAR
            </div>
            <div class="header-nav-btns">
                <a href="{{ url('/') }}" class="btn-header-link btn-header-white">
                    <i class="fa-solid fa-house"></i> Beranda
                </a>
                <a href="{{ route('artikel.index') }}" class="btn-header-link btn-header-ghost">
                    <i class="fa-solid fa-newspaper"></i> Baca Berita Lain
                </a>
            </div>
        </div>

        <div class="header-title-block">
            <h1>Kirim Berita & Publikasi Ranting</h1>
            <p>Salurkan rilis liputan kegiatan ranting atau komisariat, opini, cerpen, puisi, maupun gagasan pelajar Anda untuk dipublikasikan secara resmi di Portal Media PAC IPNU IPPNU Kemiri.</p>
        </div>

        <div class="header-features-strip">
            <div class="feature-chip">
                <i class="fa-solid fa-bolt"></i> Verifikasi Cepat Tim Redaksi
            </div>
            <div class="feature-chip">
                <i class="fa-solid fa-image"></i> Foto Dokumentasi Bebas Ukuran MB
            </div>
            <div class="feature-chip">
                <i class="fa-solid fa-globe"></i> Terindeks Otomatis di Portal Resmi
            </div>
            <div class="feature-chip">
                <i class="fa-solid fa-share-nodes"></i> Dipublikasikan ke Jejaring Ranting
            </div>
        </div>
    </div>

    <!-- FLASH MESSAGES -->
    @if(session('success_article'))
        <div style="background: #f0fdf4; border: 1.5px solid #86efac; color: #166534; padding: 20px 24px; border-radius: 14px; display: flex; align-items: center; gap: 16px; box-shadow: 0 4px 15px rgba(22,101,52,0.06);">
            <div style="width: 44px; height: 44px; border-radius: 50%; background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0;">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div style="flex: 1;">
                <h4 style="margin: 0; font-family: 'Outfit', sans-serif; font-size: 1.1rem; font-weight: 800;">Alhamdulillah! Berita Berhasil Dikirim</h4>
                <p style="margin: 4px 0 0; font-size: 0.92rem; color: #15803d; line-height: 1.5;">{{ session('success_article') }}</p>
            </div>
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div style="background: #fef2f2; border: 1.5px solid #fca5a5; color: #991b1b; padding: 20px 24px; border-radius: 14px; box-shadow: 0 4px 15px rgba(153,27,27,0.06);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.3rem; color: #dc2626;"></i>
                <h4 style="margin: 0; font-family: 'Outfit', sans-serif; font-size: 1.05rem; font-weight: 800;">Mohon Periksa Kembali Isian Anda:</h4>
            </div>
            <ul style="margin: 0; padding-left: 28px; font-size: 0.88rem; line-height: 1.6;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- MAIN GRID: FORM + SIDEBAR PANDUAN (RESPONSIVE 2-COLUMNS) -->
    <div class="redaksi-grid">

        <!-- FORM COLUMN -->
        <div class="form-card">
            <form action="{{ route('artikel.submit.public') }}" method="POST" enctype="multipart/form-data" id="kirimBeritaForm">
                @csrf

                <!-- SEKSI 1: IDENTITAS & INFORMASI -->
                <div class="form-section-header">
                    <div class="form-section-icon"><i class="fa-solid fa-heading"></i></div>
                    <div>
                        <h2 class="form-section-title">1. Judul & Identitas Pengirim</h2>
                        <p class="form-section-sub">Informasikan judul kegiatan dan ranting / komisariat asal tulisan.</p>
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-field">
                        <label class="field-label" for="articleTitle">
                            <i class="fa-solid fa-pen-nib" style="color: #15803d;"></i> Judul Berita / Tulisan <span class="field-required">*</span>
                        </label>
                        <input type="text" name="title" id="articleTitle" value="{{ old('title') }}" class="form-input" placeholder="Contoh: Meriahnya Makesta Ranting Kemiri Lor di Ponpes..." required autocomplete="off">
                        <span class="field-hint">Gunakan judul yang informatif, menarik, dan mencantumkan nama ranting/kegiatan.</span>
                    </div>

                    <div class="form-field">
                        <label class="field-label" for="articleAuthor">
                            <i class="fa-solid fa-user-pen" style="color: #15803d;"></i> Nama Penulis / Ranting <span class="field-required">*</span>
                        </label>
                        <input type="text" name="author" id="articleAuthor" value="{{ old('author') }}" class="form-input" placeholder="Contoh: Ahmad Zaini (PR IPNU Kroyo)" required autocomplete="off">
                        <span class="field-hint">Tulis nama lengkap dan ranting/komisariat atau lembaga Anda.</span>
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-field">
                        <label class="field-label" for="articleContact">
                            <i class="fa-brands fa-whatsapp" style="color: #16a34a;"></i> No. WhatsApp Penulis (Opsional)
                        </label>
                        <input type="text" name="contact" id="articleContact" value="{{ old('contact') }}" class="form-input" placeholder="08xxxxxxxxxx (untuk konfirmasi redaksi)">
                        <span class="field-hint">Hanya digunakan oleh tim redaksi jika diperlukan konfirmasi rilis naskah.</span>
                    </div>

                    <div class="form-field">
                        <label class="field-label" for="articleCategory">
                            <i class="fa-solid fa-tags" style="color: #15803d;"></i> Kategori Berita / Rilis
                        </label>
                        <select id="articleCategory" class="form-select" onchange="applyCategoryPrefix(this)">
                            <option value="Berita Ranting">Berita Ranting & PAC</option>
                            <option value="Kaderisasi">Kaderisasi & Makesta</option>
                            <option value="Opini Pelajar">Opini & Esai Pelajar</option>
                            <option value="Sastra & Budaya">Sastra (Puisi / Cerpen)</option>
                            <option value="Pengumuman">Pengumuman & Liputan Khusus</option>
                        </select>
                        <span class="field-hint">Pilih klasifikasi rubrik yang paling sesuai dengan tulisan.</span>
                    </div>
                </div>

                <!-- SEKSI 2: FOTO DOKUMENTASI KEGIATAN -->
                <div class="form-section-header" style="margin-top: 28px;">
                    <div class="form-section-icon"><i class="fa-solid fa-camera"></i></div>
                    <div>
                        <h2 class="form-section-title">2. Foto Dokumentasi Utama</h2>
                        <p class="form-section-sub">Unggah foto dokumentasi kegiatan asli yang jelas dan beresolusi baik.</p>
                    </div>
                </div>

                <div class="form-field" style="margin-bottom: 24px;">
                    <label class="field-label">
                        <i class="fa-solid fa-image" style="color: #15803d;"></i> Berkas Foto Kegiatan <span class="field-required">*</span>
                    </label>

                    <input type="file" name="image" id="publicArticleImage" accept="image/jpeg,image/png,image/jpg,image/webp" required style="display: none;" onchange="handleImageSelected(this)">

                    <div class="dropzone-box" id="dropzoneBox" onclick="document.getElementById('publicArticleImage').click()">
                        <div class="dropzone-icon">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </div>
                        <div class="dropzone-text">Pilih atau Tarik Foto ke Sini</div>
                        <div class="dropzone-sub">Mendukung format JPG, PNG, WEBP. <strong>Tanpa batas ukuran file MB!</strong></div>
                    </div>

                    <div class="dropzone-preview-wrap" id="dropzonePreviewWrap">
                        <img id="imagePreviewImg" class="preview-img" src="" alt="Pratinjau Foto Kegiatan">
                        <div class="preview-info">
                            <div>
                                <strong id="previewFileName">-</strong>
                                <span id="previewFileSize" style="color: #94a3b8; margin-left: 6px;"></span>
                            </div>
                            <button type="button" class="btn-remove-preview" onclick="resetSelectedImage()">
                                <i class="fa-solid fa-trash-can"></i> Ganti Foto
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SEKSI 3: ISI BERITA / NARASI LENGKAP -->
                <div class="form-section-header" style="margin-top: 28px;">
                    <div class="form-section-icon"><i class="fa-solid fa-newspaper"></i></div>
                    <div>
                        <h2 class="form-section-title">3. Isi Narasi Berita Lengkap</h2>
                        <p class="form-section-sub">Tuliskan narasi berita 5W+1H atau naskah tulisan secara lengkap dan runtut.</p>
                    </div>
                </div>

                <div class="form-field" style="margin-bottom: 20px;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 14px; margin-bottom: 8px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
                        <span style="font-size: 0.8rem; font-weight: 700; color: #475569;">
                            <i class="fa-solid fa-circle-info" style="color: #15803d; margin-right: 4px;"></i> Tips Penulisan:
                        </span>
                        <span style="font-size: 0.78rem; color: #64748b;">
                            Sertakan Hari, Tanggal, Tempat, Tokoh yang hadir, dan kutipan sambutan penting.
                        </span>
                    </div>

                    <textarea name="content" id="articleContent" rows="12" class="form-textarea" placeholder="Tuliskan narasi berita di sini...&#10;&#10;Contoh format pembuka:&#10;KEMIRI — Pimpinan Ranting IPNU IPPNU Kemiri Lor menggelar kegiatan Masa Kesetiaan Anggota (MAKESTA) yang bertempat di Pondok Pesantren... pada hari Ahad (12/11)..." required oninput="updateCounters(this)">{{ old('content') }}</textarea>

                    <div class="textarea-meta-bar">
                        <div style="display: flex; gap: 14px;">
                            <span><strong id="wordCount">0</strong> kata</span>
                            <span><strong id="charCount">0</strong> karakter</span>
                        </div>
                        <span style="color: #15803d; font-weight: 600;">Direkomendasikan minimal 150 kata</span>
                    </div>
                </div>

                <!-- SEKSI 4: KETENTUAN & SUBMIT -->
                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 16px 20px; display: flex; gap: 14px; align-items: flex-start;">
                    <i class="fa-solid fa-shield-halved" style="color: #16a34a; font-size: 1.25rem; margin-top: 2px;"></i>
                    <div style="font-size: 0.84rem; color: #166534; line-height: 1.55;">
                        <strong>Etika Redaksi & Kurasi Berita:</strong> Naskah yang dikirimkan wajib menjunjung tinggi nilai santun, orisinalitas, tidak mengandung hoaks/SARA, serta sejalan dengan prinsip Ahlussunnah wal Jama'ah An-Nahdliyyah. Tim Redaksi berhak menyunting judul/tata bahasa tanpa mengubah substansi.
                    </div>
                </div>

                <div class="submit-bar">
                    <div style="color: #64748b; font-size: 0.85rem; display: flex; align-items: center; gap: 6px;">
                        <i class="fa-solid fa-lock" style="color: #15803d;"></i> Pengiriman aman & langsung masuk ke antrean redaksi
                    </div>
                    <button type="submit" class="btn-submit-berita" id="btnSubmitBerita">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Berita Sekarang
                    </button>
                </div>
            </form>
        </div>

        <!-- SIDEBAR PANDUAN JURNALISTIK & REDAKSI (MENGISI RUANG KANAN AGAR TIDAK KOSONG) -->
        <div class="redaksi-sidebar">

            <!-- Card 1: Rumus 5W+1H -->
            <div class="guide-card">
                <div class="guide-card-header">
                    <div class="guide-card-icon"><i class="fa-solid fa-lightbulb"></i></div>
                    <h3 class="guide-card-title">Rumus Berita 5W + 1H</h3>
                </div>
                <div class="w-h-list">
                    <div class="w-h-item">
                        <span class="w-h-tag">WHAT</span>
                        <div><strong>Apa</strong> nama kegiatan atau inti peristiwa yang diselenggarakan?</div>
                    </div>
                    <div class="w-h-item">
                        <span class="w-h-tag">WHO</span>
                        <div><strong>Siapa</strong> penyelenggara, narasumber, dan peserta yang terlibat?</div>
                    </div>
                    <div class="w-h-item">
                        <span class="w-h-tag">WHERE</span>
                        <div><strong>Di mana</strong> lokasi tempat acara berlangsung secara spesifik?</div>
                    </div>
                    <div class="w-h-item">
                        <span class="w-h-tag">WHEN</span>
                        <div><strong>Kapan</strong> hari, tanggal, dan waktu pelaksanaan kegiatan?</div>
                    </div>
                    <div class="w-h-item">
                        <span class="w-h-tag">WHY</span>
                        <div><strong>Mengapa</strong> kegiatan ini penting atau apa tujuan diadakannya?</div>
                    </div>
                    <div class="w-h-item">
                        <span class="w-h-tag">HOW</span>
                        <div><strong>Bagaimana</strong> alur kemeriahan, antusiasme, serta respon peserta?</div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Tips Foto Lolos Kurasi -->
            <div class="guide-card">
                <div class="guide-card-header">
                    <div class="guide-card-icon" style="background: #e0f2fe; color: #0369a1;"><i class="fa-solid fa-camera-retro"></i></div>
                    <h3 class="guide-card-title">Tips Foto Dokumentasi</h3>
                </div>
                <ul style="margin: 0; padding-left: 20px; font-size: 0.85rem; color: #334155; line-height: 1.7;">
                    <li>Ambil foto posisi <strong>Landscape / Mendatar</strong> agar proporsional di website.</li>
                    <li>Pastikan gambar <strong>tidak buram / blur</strong> dan pencahayaan terang.</li>
                    <li>Sertakan momen yang memperlihatkan <strong>backdrop/spanduk</strong> serta antusiasme peserta.</li>
                    <li>Hindari foto selfie yang terlalu dekat tanpa konteks acara.</li>
                </ul>
            </div>

            <!-- Card 3: Alur Penerbitan Berita -->
            <div class="guide-card">
                <div class="guide-card-header">
                    <div class="guide-card-icon" style="background: #dcfce7; color: #15803d;"><i class="fa-solid fa-arrow-progress"></i></div>
                    <h3 class="guide-card-title">Alur Publikasi</h3>
                </div>
                <div class="step-list">
                    <div class="step-item">
                        <div class="step-num">1</div>
                        <div class="step-text">
                            <h5>Kirim Formulir</h5>
                            <p>Isi formulir lengkap dan unggah foto dokumentasi kegiatan.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num">2</div>
                        <div class="step-text">
                            <h5>Review & Penyuntingan</h5>
                            <p>Tim Redaksi Pers PAC memeriksa orisinalitas dan keselarasan materi.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num">3</div>
                        <div class="step-text">
                            <h5>Tayang di Portal</h5>
                            <p>Berita resmi dipublikasikan dan disebarluaskan ke media sosial resmi.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Narahubung Redaksi -->
            <div class="guide-card" style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); border: 1.5px dashed #cbd5e1;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                    <i class="fa-solid fa-headset" style="font-size: 1.2rem; color: #15803d;"></i>
                    <h4 style="margin: 0; font-family: 'Outfit', sans-serif; font-size: 0.98rem; font-weight: 800; color: #0f172a;">Butuh Bantuan Cepat?</h4>
                </div>
                <p style="margin: 0 0 12px 0; font-size: 0.8rem; color: #64748b; line-height: 1.5;">
                    Jika ada kendala pengunggahan atau rilis penting yang butuh segera terbit, hubungi Tim Redaksi PAC.
                </p>
                <a href="{{ url('/kontak') }}" style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.82rem; font-weight: 700; color: #15803d; text-decoration: none;">
                    Hubungi Redaksi via Kontak <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>

    </div>

</div>

@push('scripts')
<script>
    // Drag and Drop & Image Preview Handler
    const dropzone = document.getElementById('dropzoneBox');
    const fileInput = document.getElementById('publicArticleImage');
    const previewWrap = document.getElementById('dropzonePreviewWrap');
    const previewImg = document.getElementById('imagePreviewImg');
    const previewFileName = document.getElementById('previewFileName');
    const previewFileSize = document.getElementById('previewFileSize');

    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.add('dragover');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('dragover');
        }, false);
    });

    dropzone.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        if (files && files.length > 0) {
            fileInput.files = files;
            showImagePreview(files[0]);
        }
    });

    function handleImageSelected(input) {
        if (input.files && input.files[0]) {
            showImagePreview(input.files[0]);
        }
    }

    function showImagePreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewFileName.textContent = file.name;
            const sizeKB = Math.round(file.size / 1024);
            previewFileSize.textContent = sizeKB > 1024 ? `(${(sizeKB/1024).toFixed(1)} MB)` : `(${sizeKB} KB)`;
            previewWrap.style.display = 'block';
            dropzone.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }

    function resetSelectedImage() {
        fileInput.value = '';
        previewImg.src = '';
        previewWrap.style.display = 'none';
        dropzone.style.display = 'block';
    }

    // Word and Character Counter
    function updateCounters(textarea) {
        const val = textarea.value.trim();
        const chars = textarea.value.length;
        const words = val === '' ? 0 : val.split(/\s+/).filter(Boolean).length;
        document.getElementById('charCount').textContent = chars;
        document.getElementById('wordCount').textContent = words;
    }

    // Run on load in case of old input
    const initialTextarea = document.getElementById('articleContent');
    if (initialTextarea) {
        updateCounters(initialTextarea);
    }

    // Form submit state
    const form = document.getElementById('kirimBeritaForm');
    if (form) {
        form.addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmitBerita');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengunggah Berita & Foto...';
                btn.style.opacity = '0.8';
                btn.style.cursor = 'not-allowed';
            }
        });
    }
</script>
@endpush
@endsection

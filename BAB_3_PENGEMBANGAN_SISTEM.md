# BAB III: PENGEMBANGAN SISTEM

## 3.1 Waktu dan Tempat Pengembangan Sistem
### 3.1.1 Tempat Pengembangan
Pengembangan sistem dan studi kasus dilaksanakan pada organisasi kepemudaan:
- **Nama Organisasi:** Pimpinan Anak Cabang (PAC) Ikatan Pelajar Nahdlatul Ulama (IPNU) dan Ikatan Pelajar Putri Nahdlatul Ulama (IPPNU) Kecamatan Kemiri.
- **Lokasi Sekretariat:** Kecamatan Kemiri, Kabupaten Purworejo, Provinsi Jawa Tengah.
- **Alamat Daring (Domain Produksi):** `https://ipnuippnukemiri.com/`

### 3.1.2 Waktu dan Jadwal Pengembangan (Timeline Sprint)
Pengembangan sistem dilaksanakan selama rentang waktu 4 (empat) bulan, dimulai dari tahap inisiasi kebutuhan hingga tahap optimasi performa dan deployment penuh di server hosting produksi. Mengadopsi pendekatan **Agile Scrum**, jadwal pelaksanaan terbagi ke dalam beberapa siklus *Sprint* terukur:

| No | Tahapan Aktivitas / Sprint | Bulan 1 | Bulan 2 | Bulan 3 | Bulan 4 | Output Tahapan |
|---|---|:---:|:---:|:---:|:---:|---|
| **1** | **Sprint 0: Inisiasi & Pengumpulan Kebutuhan**<br/>- Observasi dan wawancara pengurus PAC<br/>- Penyusunan *Product Backlog* awal | ■ ■ | | | | Dokumen Spesifikasi Kebutuhan Sistem |
| **2** | **Sprint 1: Perancangan Arsitektur & Database**<br/>- Pemodelan data relasional (ERD)<br/>- Wireframing & perancangan antarmuka | | ■ ■ | | | Skema DB, Desain UI/UX & Routing |
| **3** | **Sprint 2: Pengembangan Fitur Inti Portal**<br/>- Setup Laravel 12 & arsitektur MVC<br/>- CRUD Berita, Kirim Berita Ranting, Dokumen Resmi PDF, dan Galeri Foto Lightbox | | ■ ■ | ■ | | Fitur Manajemen Konten & Informasi |
| **4** | **Sprint 3: Integrasi Asisten AI & E-Voting**<br/>- Integrasi REST API Google Gemini 1.5 Flash<br/>- Modul polling & e-voting pemilihan ketua | | | ■ ■ | | Modul Chatbot AI & Demokrasi Digital |
| **5** | **Sprint 4: Audit Kinerja & Deployment Live**<br/>- Audit Google PageSpeed Insights & Core Web Vitals<br/>- Kompresi aset gambar GD & konfigurasi `.htaccess`<br/>- Deployment ke domain `ipnuippnukemiri.com` | | | | ■ ■ | Sistem Live Ber-SSL & Skor PageSpeed Tinggi |
| **6** | **Sprint Review, Pengujian Akhir & Dokumentasi**<br/>- Black-box testing fungsional bersama admin PAC<br/>- Penyusunan laporan dokumentasi sistem | | | | ■ ■ | Laporan Pengujian & Serah Terima Sistem |

---

## 3.2 Model Pengembangan Sistem (*Agile Development*)
Pengembangan Website Resmi PAC IPNU IPPNU Kecamatan Kemiri menggunakan pendekatan **Agile Development** dengan kerangka kerja **Scrum** yang bersifat iteratif dan adaptif. Pendekatan Agile dipilih karena memungkinkan pengembangan sistem berjalan secara fleksibel, cepat merespons kebutuhan organisasi, serta merilis fitur secara bertahap langsung ke lingkungan produksi (*live production environment*).

Siklus pengembangan Agile pada website ini dilaksanakan melalui serangkaian iterasi (*Sprint*):
1. **Perencanaan (*Sprint Planning & Product Backlog*):** Menentukan daftar prioritas fitur berdasarkan kebutuhan publikasi dan kaderisasi PAC Kemiri.
2. **Perancangan (*Sprint Design*):** Merancang arsitektur MVC, struktur basis data relasional, dan tata letak responsif.
3. **Pengembangan & Integrasi (*Sprint Development*):** Penulisan kode program menggunakan framework Laravel 12 dan integrasi REST API Google Gemini 1.5 Flash.
4. **Pengujian Fungsional & Kinerja (*Testing & Review*):** Melakukan verifikasi *Black-Box* serta audit performa menggunakan Google PageSpeed Insights.
5. **Rilis Produksi (*Continuous Deployment to Production*):** Penerbitan aplikasi secara langsung ke server hosting web dengan domain publik berbayar berakhiran `.com` (**https://ipnuippnukemiri.com/**) melalui sinkronisasi repositori Git.

---

## 3.3 Analisis Kebutuhan Sistem (*System Requirements*)

Kebutuhan sistem dirumuskan dalam bentuk *User Stories* dan *Product Backlog Items* yang terbagi menjadi kebutuhan fungsional dan non-fungsional.

### 3.3.1 Kebutuhan Fungsional (*Functional Requirements*)
1. **Modul Informasi & Berita Terpadu:**
   - Menyajikan profil kepengurusan, visi-misi, sejarah berdirinya organisasi, dan susunan Badan Pengurus Harian (BPH).
   - Menyajikan warta kegiatan, artikel opini pelajar, dan berita utama (*headline*) dengan pembagian kategori serta pagination dinamis.
   - Menyediakan fitur **Kirim Berita Ranting** agar kader tingkat ranting/desa dan komisariat dapat mengirimkan warta kegiatan secara mandiri untuk dikurasi oleh tim redaksi.
   - Menyediakan menu **Pusat Dokumen Resmi** untuk pengunduhan berkas legalitas, SK kepengurusan, modul Makesta, dan peraturan organisasi dalam format PDF.
   - Menyajikan **Galeri Foto Kegiatan** interaktif berbasis slider *lightbox* dengan kontrol tombol panah, sentuhan layar gawai (*swipe*), dan penghitung foto.
2. **Modul Asisten Cerdas (AI Chatbot Pelajar NU):**
   - Mengintegrasikan kecerdasan buatan berbasis **Google Gemini 1.5 Flash API** yang diformulasikan untuk menjawab konsultasi seputar ke-NU-an, pedoman kaderisasi, dan program kerja PAC Kemiri secara interaktif 24/7.
   - Dilengkapi sistem *fallback* darurat lokal yang tetap memberikan respons relevan meskipun koneksi API pihak ketiga terhambat.
3. **Modul Demokrasi Digital (E-Voting):**
   - Memfasilitasi pemilihan ketua dan survei program kerja secara digital, transparan, dan *real-time* dengan pencegahan duplikasi suara pemilih.
4. **Modul Manajemen Administrator (Admin CMS):**
   - Autentikasi aman berbasis sesi untuk pengelola konten.
   - Manajemen CRUD penuh untuk Artikel, Dokumen Resmi, Agenda Kegiatan, Galeri, Kandidat Pemilu, Banner Ucapan/Pengumuman dinamis, dan Iklan/Sponsorship.
   - Fitur penetapan **Tanggal Publikasi Manual** (*custom publish date*) untuk fleksibilitas dokumentasi rilis arsip berita.
   - Manajemen footer dan informasi kontak dinamis (*Site Settings* & *Footer Links*).

### 3.3.2 Kebutuhan Non-Fungsional (*Non-Functional Requirements*)
1. **Kinerja & Kecepatan (*Performance*):** Website harus memiliki waktu render awal yang cepat (*First Contentful Paint* < 1.8 detik), total muatan jaringan di bawah 1 MB, dan skor hijau pada PageSpeed Insights.
2. **Aksesibilitas (*Accessibility*):** Mengikuti standar WCAG 2.1 AA dengan pelabelan elemen antarmuka (`aria-label`), penamaan `title` pada frame peta, serta rasio kontras warna yang nyaman dibaca.
3. **Keamanan (*Security*):** Dilengkapi proteksi *Cross-Site Request Forgery* (CSRF), sanitasi input terhadap XSS, proteksi SQL Injection melalui Eloquent ORM, serta penerapan *Security Headers* (nosniff, SAMEORIGIN).
4. **Ketersediaan & Domain (*Availability*):** Sistem beroperasi secara *live* di server produksi berbasis Cloud/cPanel hosting dengan domain tingkat atas komersial (**ipnuippnukemiri.com**) dan enkripsi SSL (HTTPS).

---

## 3.4 Perancangan Sistem (*System Design*)

### 3.4.1 Arsitektur Perangkat Lunak
Sistem dibangun mengadopsi pola arsitektur **Model-View-Controller (MVC)** dari framework Laravel 12:
- **Model:** Mengatur representasi entitas data, relasi tabel, dan aturan bisnis melalui Laravel Eloquent ORM.
- **View:** Menyusun antarmuka pengguna responsif menggunakan Blade Templating Engine dan CSS modern.
- **Controller:** Mengendalikan logika alur program (*business logic*), pemrosesan form, pemanggilan API eksternal (Google Gemini), dan pengembalian respons ke peramban.

### 3.4.2 Perancangan Basis Data (*Database Schema*)
Basis data relasional dirancang secara optimal untuk mendukung operasional website:
- **`users`**: Menyimpan kredensial dan hak akses administrator.
- **`articles`**: Menyimpan warta berita, artikel kader, slug URL SEO-friendly, ringkasan, gambar sampul, status terbit, dan tanggal publikasi kustom (`published_at`).
- **`official_documents`**: Menyimpan berkas SK, nomor pedoman, kategori, dan berkas fisik PDF.
- **`site_settings` & `footer_links`**: Menyimpan konfigurasi dinamis (banner ucapan, kontak sekretariat, link medsos, copyright, navigasi footer).
- **`galleries`**: Menyimpan koleksi dokumentasi foto kegiatan organisasi.
- **`candidates` & `votes`**: Menyimpan data peserta pemilu dan log suara pemilih.
- **`visitors`**: Menyimpan audit jejak statistik kunjungan unik harian (alamat IP, peramban, OS, tanggal).

---

## 3.5 Implementasi Sistem (*System Implementation*)

### 3.5.1 Spesifikasi Lingkungan Pengembangan & Produksi

| Komponen | Lingkungan Pengembangan (*Local*) | Lingkungan Produksi (*Live Hosting*) |
|---|---|---|
| **Domain & Protokol** | `http://127.0.0.1:8000` | **`https://ipnuippnukemiri.com`** (SSL Terenkripsi) |
| **Infrastruktur Server**| PHP Built-in Server (Windows) | Apache Web Server (Linux Cloud/cPanel Hosting) |
| **Bahasa Pemrograman** | PHP 8.2 & Vanilla JavaScript ES6+ | PHP 8.2 & Vanilla JavaScript ES6+ |
| **Framework Utama**    | Laravel 12 | Laravel 12 |
| **Database Engine**     | SQLite | MySQL Production Database |
| **Integrasi Eksternal** | Google Gemini REST API | Google Gemini REST API |
| **Manajemen Versi**    | Git (Local Branch `main`) | GitHub Repository (`MUHAMMADSAFIQ/ipnu-ippnu-Kemiri`) |

### 3.5.2 Implementasi Fitur dan Optimasi Khusus
1. **Penerbitan Berkelanjutan (*Git CI/CD Workflow*):** Seluruh perbaikan kode diuji secara lokal, dikomit ke GitHub, lalu ditarik secara langsung (*git pull*) ke direktori root hosting produksi.
2. **Integrasi Asisten AI Gemini:** Memanfaatkan endpoint REST Google Generative Language API dengan *context framing* kepengurusan PAC IPNU IPPNU Kemiri, disertai token CSRF agar komunikasi asynchronous (AJAX) berjalan aman.
3. **Kompresi Aset Gambar Ekstrem:** Memanfaatkan modul PHP GD untuk melakukan *downscaling* dan kompresi pada aset gambar (seperti logo resmi, banner, dan struktur kepengurusan), memangkas beban muatan gambar dari ~30 MB menjadi < 1 MB.

---

## 3.6 Pengujian Sistem (*System Testing*)

Pengujian dilakukan secara menyeluruh terhadap website yang telah aktif di domain `https://ipnuippnukemiri.com/`.

### 3.6.1 Pengujian Fungsional (*Black-Box Testing*)
Pengujian fungsional memvalidasi seluruh fungsionalitas antarmuka dan alur data dari sudut pandang pengguna akhir:
- Validasi autentikasi login administrator.
- Validasi pengiriman berita ranting mandiri dan pengecekan file unggahan.
- Validasi fitur e-voting dan perlindungan terhadap pemilihan ganda.
- Validasi pengunduhan berkas dokumen resmi PDF dan respon chatbot AI.

### 3.6.2 Pengujian Kinerja & Standar Web (*Google PageSpeed Insights*)
Pengujian performa dilakukan secara terukur menggunakan metrik **Core Web Vitals** dari Google PageSpeed Insights:
1. **Largest Contentful Paint (LCP):** Memberikan atribut `fetchpriority="high"`, `loading="eager"`, serta tag `<link rel="preload" as="image">` pada hero banner pertama agar langsung dimuat seketika.
2. **Pemuatan Aset Asinkron:** Mengatur pemuatan Google Fonts dan Font Awesome secara non-blocking menggunakan teknik `preload stylesheet` dan `font-display: swap`.
3. **Konfigurasi Cache Server (`.htaccess`):** Menetapkan aturan `mod_expires` (cache statis 1 tahun untuk gambar dan font, 6 bulan untuk CSS/JS) serta kompresi teks Gzip (`mod_deflate`).
4. **Audit Aksesibilitas & SEO:** Melengkapi seluruh atribut `aria-label` pada tombol navigasi gawai, tema warna, dan form pencarian, menambahkan atribut `title` pada iframe Google Maps, serta menyematkan meta description lengkap untuk mesin perayap.

# TABEL SKENARIO PENGUJIAN SISTEM (BLACK-BOX TESTING)
**Situs Web:** Portal Resmi PAC IPNU IPPNU Kecamatan Kemiri (`https://ipnuippnukemiri.com/`)

Tabel pengujian ini disusun menggunakan metode **Black-Box Testing (Equivalence Partitioning & Boundary Value Analysis)** untuk memverifikasi fungsionalitas, keamanan, dan kinerja antarmuka tanpa menguji kode internal program secara langsung.

---

### 1. Modul Autentikasi & Hak Akses Administrator

| ID Uji | Fitur / Skenario Pengujian | Data Uji / Masukan (Input) | Hasil yang Diharapkan (*Expected Result*) | Hasil Aktual (*Actual Result*) | Status |
|:---:|---|---|---|---|:---:|
| **TC-ADM-01** | Login Admin dengan kredensial valid | Username dan password terdaftar yang benar | Sistem mengotentikasi sesi dan mengarahkan (*redirect*) ke Dashboard Admin (`/admin/dashboard`) | Berhasil masuk ke dashboard admin | **Valid (Pass)** |
| **TC-ADM-02** | Login Admin dengan password salah | Username benar, password salah | Sistem menolak login, menampilkan pesan galat *"Kredensial tidak cocok"*, form dikosongkan | Menampilkan notifikasi error | **Valid (Pass)** |
| **TC-ADM-03** | Pembatasan hak akses (*Middleware Protection*) | Mengakses langsung URL `/admin/dashboard` tanpa login | Sistem memblokir akses dan mengarahkan otomatis ke halaman `/admin/login` | Dialihkan ke halaman login | **Valid (Pass)** |
| **TC-ADM-04** | Logout Akun Administrator | Mengklik tombol "Keluar / Logout" | Sesi admin dihapus, CSRF token diperbarui, diarahkan kembali ke beranda/halaman login | Sesi berakhir dan diarahkan ke login | **Valid (Pass)** |

---

### 2. Modul Informasi & Portal Publik Beranda

| ID Uji | Fitur / Skenario Pengujian | Data Uji / Masukan (Input) | Hasil yang Diharapkan (*Expected Result*) | Hasil Aktual (*Actual Result*) | Status |
|:---:|---|---|---|---|:---:|
| **TC-PUB-01** | Akses halaman utama portal | Membuka URL `https://ipnuippnukemiri.com/` | Halaman beranda termuat secara utuh, hero section, banner, dan widget tampil proporsional | Halaman tampil cepat & responsif | **Valid (Pass)** |
| **TC-PUB-02** | Pencarian Berita (*Live Search*) | Kata kunci: *"Makesta"* pada form search | Menampilkan daftar berita yang relevan dan halaman menggulir (*auto-scroll*) ke bagian berita | Menampilkan hasil pencarian artikel | **Valid (Pass)** |
| **TC-PUB-03** | Pencarian tanpa kata kunci / nihil | Kata kunci acak: *"xyz12345"* | Sistem menampilkan pesan ramah *"Belum ada artikel ditemukan"* | Pesan artikel kosong muncul | **Valid (Pass)** |
| **TC-PUB-04** | Penggantian tema warna (*Theme Switcher*) | Mengklik salah satu dari 8 ikon lingkaran tema | Variabel warna CSS (`--primary`, dll.) berubah seketika tanpa perlu memuat ulang (*reload*) halaman | Warna tema berubah seketika | **Valid (Pass)** |
| **TC-PUB-05** | Responsivitas Navigasi Mobile | Mengklik ikon *hamburger menu* pada layar gawai (< 768px) | Menu laci samping (*off-canvas*) terbuka mulus dan seluruh tautan menu dapat diklik | Menu mobile terbuka responsif | **Valid (Pass)** |

---

### 3. Modul Manajemen Artikel & Warta Berita

| ID Uji | Fitur / Skenario Pengujian | Data Uji / Masukan (Input) | Hasil yang Diharapkan (*Expected Result*) | Hasil Aktual (*Actual Result*) | Status |
|:---:|---|---|---|---|:---:|
| **TC-ART-01** | Pembuatan artikel baru oleh Admin | Judul, kategori, isi berita, upload gambar sampul, status *Published* | Artikel tersimpan ke database, gambar terunggah ke storage, muncul di beranda dan arsip berita | Artikel baru berhasil terbit | **Valid (Pass)** |
| **TC-ART-02** | Pengaturan **Tanggal Publikasi Manual** | Memilih tanggal lampau / kustom pada kolom `published_at` | Nilai `published_at` tersimpan sesuai tanggal yang dipilih, urutan artikel menyesuaikan tanggal tersebut | Tanggal terbit sesuai input admin | **Valid (Pass)** |
| **TC-ART-03** | Edit artikel melalui Modal Dashboard | Mengubah judul dan konten artikel yang sudah ada | Data terbarui di database dan tampilan portal langsung merefleksikan perubahan | Artikel terupdate tanpa error | **Valid (Pass)** |
| **TC-ART-04** | Penghapusan artikel | Mengklik tombol "Hapus" dengan konfirmasi dialog | Artikel terhapus dari basis data, berkas gambar terhapus dari storage, artikel hilang dari portal | Artikel terhapus permanen | **Valid (Pass)** |
| **TC-ART-05** | Penghitung jumlah pembaca (*Counter Views*) | Kader membuka halaman detail artikel (`/artikel/{slug}`) | Kolom `views_count` pada artikel bertambah +1 setiap kali halaman dibuka | Counter bertambah otomatis | **Valid (Pass)** |

---

### 4. Modul Kirim Berita Ranting Mandiri (*Citizen Journalism*)

| ID Uji | Fitur / Skenario Pengujian | Data Uji / Masukan (Input) | Hasil yang Diharapkan (*Expected Result*) | Hasil Aktual (*Actual Result*) | Status |
|:---:|---|---|---|---|:---:|
| **TC-KRM-01** | Pengiriman rilis berita oleh kader ranting | Mengisi nama penulis, asal ranting, nomor WA, judul, narasi 5W+1H, dan foto kegiatan | Formulir tervalidasi, data masuk ke database dengan status *"Pending / Menunggu Verifikasi"*, pesan sukses muncul | Berita tersimpan di antrean verifikasi | **Valid (Pass)** |
| **TC-KRM-02** | Validasi field wajib (*Validation Error*) | Mengirimkan formulir dengan judul atau isi kosong | Sistem menolak pengiriman dan menampilkan tanda peringatan *"Field ini wajib diisi"* | Form menolak dan menandai field | **Valid (Pass)** |
| **TC-KRM-03** | Validasi format dan ukuran file foto | Mengunggah file selain gambar (.exe / .pdf) atau foto > 5 MB | Sistem menolak unggahan dengan pesan validasi jenis/ukuran file tidak sesuai | Muncul peringatan batasan file | **Valid (Pass)** |
| **TC-KRM-04** | Moderasi & Penerbitan oleh Redaksi PAC | Admin menyetujui (*Approve*) berita ranting di dashboard | Status berubah menjadi *"Published"* dan berita otomatis tayang di halaman publik | Berita ranting resmi tayang | **Valid (Pass)** |

---

### 5. Modul Asisten Virtual AI Chatbot (Google Gemini 1.5 Flash)

| ID Uji | Fitur / Skenario Pengujian | Data Uji / Masukan (Input) | Hasil yang Diharapkan (*Expected Result*) | Hasil Aktual (*Actual Result*) | Status |
|:---:|---|---|---|---|:---:|
| **TC-AI-01** | Kirim pertanyaan ke AI via floating widget | Pertanyaan: *"Apa syarat mengikuti Makesta IPNU?"* | Pesan terkirim via AJAX asynchronous, bot memberikan jawaban relevan berbasis pengetahuan ke-NU-an | Bot membalas kontekstual & cepat | **Valid (Pass)** |
| **TC-AI-02** | Proteksi keamanan CSRF Chatbot | Pengiriman pesan melalui skrip `chat.js` | Request membawa header `X-CSRF-TOKEN` yang sah, tidak terjadi galat *419 Page Expired* | Respons HTTP 200 OK | **Valid (Pass)** |
| **TC-AI-03** | Penanganan limitasi API (*Fallback Engine*) | Menyimulasikan API Key Gemini offline / kuota habis | Sistem otomatis mengaktifkan *local fallback engine* dan memberikan respon penjelas tanpa error 500 | Pesan alternatif muncul ramah | **Valid (Pass)** |
| **TC-AI-04** | Pengaturan API Key dari Dashboard Admin | Mengubah Google Gemini API Key di panel pengaturan bot | Kunci API baru tersimpan di database `site_settings` dan langsung digunakan pada request berikutnya | Kunci API baru aktif digunakan | **Valid (Pass)** |

---

### 6. Modul Demokrasi Digital (E-Voting Pemilihan Ketua)

| ID Uji | Fitur / Skenario Pengujian | Data Uji / Masukan (Input) | Hasil yang Diharapkan (*Expected Result*) | Hasil Aktual (*Actual Result*) | Status |
|:---:|---|---|---|---|:---:|
| **TC-VOT-01** | Verifikasi Kode Akses E-Voting (*Passcode*) | Memasukkan kode benar: `KEMIRI2026` | Sistem mengesahkan sesi (`voting_authenticated = true`), kunci terbuka, diarahkan ke bilik coblos | Bilik pemilihan terbuka | **Valid (Pass)** |
| **TC-VOT-02** | Kode akses salah | Memasukkan kode salah: `123456` | Akses ditolak, notifikasi *"Kode Keamanan Salah!"* muncul, tetap berada di halaman auth | Akses ditolak | **Valid (Pass)** |
| **TC-VOT-03** | Eksekusi pemilihan calon (*Coblos Suara*) | Mengklik tombol "Coblos" pada kartu salah satu kandidat | Suara kandidat bertambah +1, persentase terhitung ulang secara real-time, animasi konfeti muncul | Suara bertambah dan tersimpan | **Valid (Pass)** |
| **TC-VOT-04** | Proteksi pemilihan ganda (*Double Voting*) | Mencoba mengklik coblos kedua kalinya di sesi yang sama | Tombol coblos dinonaktifkan (*disabled*) dengan label *"✓ Sudah Memilih"*, request kedua ditolak | Sistem menolak pemilihan ganda | **Valid (Pass)** |

---

### 7. Modul Pusat Dokumen Resmi (Repositori PDF)

| ID Uji | Fitur / Skenario Pengujian | Data Uji / Masukan (Input) | Hasil yang Diharapkan (*Expected Result*) | Hasil Aktual (*Actual Result*) | Status |
|:---:|---|---|---|---|:---:|
| **TC-DOC-01** | Akses direktori dokumen resmi | Membuka URL `/dokumen` | Daftar dokumen resmi (SK, Pedoman Organisasi) tampil terstruktur dengan filter kategori | Dokumen tertata rapi | **Valid (Pass)** |
| **TC-DOC-02** | Unduh berkas dokumen PDF | Mengklik tombol "Download / Unduh PDF" | Berkas PDF terunduh utuh ke perangkat pengguna dengan nama file yang sesuai | File PDF terunduh tanpa rusak | **Valid (Pass)** |
| **TC-DOC-03** | Upload dokumen baru via Admin | Judul SK, nomor surat, kategori, berkas PDF | Berkas tersimpan di storage `public/documents`, entri tercatat di tabel `official_documents` | Dokumen langsung muncul di publik | **Valid (Pass)** |

---

### 8. Modul Galeri Foto Interaktif (Lightbox Slider)

| ID Uji | Fitur / Skenario Pengujian | Data Uji / Masukan (Input) | Hasil yang Diharapkan (*Expected Result*) | Hasil Aktual (*Actual Result*) | Status |
|:---:|---|---|---|---|:---:|
| **TC-GAL-01** | Buka penampil foto (*Viewer*) | Mengklik salah satu thumbnail foto di beranda/galeri | Modal layar penuh terbuka menampilkan foto resolusi tajam, judul, dan nomor urut (contoh: *1 / 12*) | Lightbox viewer terbuka | **Valid (Pass)** |
| **TC-GAL-02** | Navigasi slider foto | Mengklik tombol panah kanan/kiri atau keyboard (&larr; / &rarr;) | Tampilan berganti ke foto berikutnya/sebelumnya dengan transisi halus tanpa flicker | Navigasi slider berjalan lancar | **Valid (Pass)** |
| **TC-GAL-03** | Gestur sentuh gawai (*Touch Swipe*) | Menggeser layar ke kiri atau kanan pada smartphone | Foto berpindah sesuai arah sapuan jari pengguna | Responsif terhadap touch swipe | **Valid (Pass)** |

---

### 9. Modul Banner Ucapan & Pengaturan Situs Dinamis

| ID Uji | Fitur / Skenario Pengujian | Data Uji / Masukan (Input) | Hasil yang Diharapkan (*Expected Result*) | Hasil Aktual (*Actual Result*) | Status |
|:---:|---|---|---|---|:---:|
| **TC-SET-01** | Ubah teks banner ucapan di Admin | Mengubah subjudul, judul utama, dan isi ucapan di panel Pengaturan Portal | Data tersimpan di tabel `site_settings`, teks ucapan di beranda publik berubah seketika | Teks ucapan langsung terupdate | **Valid (Pass)** |
| **TC-SET-02** | Ubah informasi kontak & link footer | Mengubah nomor WhatsApp, email sekretariat, atau tautan cepat | Bagian footer di seluruh halaman portal menampilkan informasi kontak baru | Footer terupdate secara dinamis | **Valid (Pass)** |

---

### 10. Pengujian Kinerja & Standar Web (Google PageSpeed Insights)

| ID Uji | Parameter Pengujian | Target Pengujian | Hasil Pengujian (Implementasi) | Status |
|:---:|---|---|---|:---:|
| **TC-PERF-01** | **Largest Contentful Paint (LCP)** | LCP < 2.5 detik pada jaringan seluler | Gambar Hero dimuat dengan `loading="eager"`, `fetchpriority="high"`, dan `<link rel="preload">` | **Optimal (Pass)** |
| **TC-PERF-02** | **Kompresi Payload Gambar** | Total muatan gambar halaman < 1 MB | Seluruh aset logo, banner, dan gambar struktur kepengurusan dikompresi dari ~30 MB menjadi < 1 MB | **Optimal (Pass)** |
| **TC-PERF-03** | **Eliminasi Render-Blocking** | Font Google dan Font Awesome non-blocking | Pemuatan via `<link rel="preload" as="style" onload="this.rel='stylesheet'">` dengan `font-display: swap` | **Optimal (Pass)** |
| **TC-PERF-04** | **Browser Caching & Kompresi** | Cache header aktif & transfer data terkompresi | File `.htaccess` memuat `mod_expires` (cache 1 tahun) dan `mod_deflate` (Gzip compression) | **Optimal (Pass)** |
| **TC-PERF-05** | **Standar Aksesibilitas (WCAG)** | Tidak ada elemen tombol/link tanpa nama | Seluruh tombol modal, menu gawai, search, dan medsos dilengkapi `aria-label` & iframe diberi `title` | **Optimal (Pass)** |

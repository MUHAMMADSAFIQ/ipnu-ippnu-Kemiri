# ALUR DATA FLOW DIAGRAM (DFD) LEVEL 1

Berdasarkan DFD Level 0 Sistem Informasi Portal Web dan E-Voting PAC IPNU IPPNU Kecamatan Kemiri, berikut adalah penjabaran detail Data Flow Diagram (DFD) Level 1 untuk masing-masing proses utama.

---

## 1. DFD Level 1 - Proses 1.0 (Kelola Profil & Konten Portal)

Proses ini menguraikan bagaimana Administrator mengelola konten web, seperti artikel berita, profil pengurus (Nahkoda/BPH), dan katalog produk UMKM, serta bagaimana Pengunjung melihat konten tersebut.

```mermaid
graph TD
    Admin["Admin"]
    Pengunjung["Pengunjung"]
    
    P11(["1.1 Tambah Konten (Artikel, Profil, Produk)"])
    P12(["1.2 Perbarui Konten"])
    P13(["1.3 Hapus Konten"])
    P14(["1.4 Tampilkan Konten"])
    
    DS_Articles[("db_articles")]
    
    Admin -->|"Kirim data input"| P11
    Admin -->|"Kirim data revisi"| P12
    Admin -->|"Kirim instruksi hapus"| P13
    
    P11 -->|"Simpan record"| DS_Articles
    P12 -->|"Update record"| DS_Articles
    P13 -->|"Delete record"| DS_Articles
    
    DS_Articles -->|"Ambil data konten"| P14
    P14 -->|"Render visual halaman"| Pengunjung
    
    style P11 fill:#f0fdf4,stroke:#16a34a,stroke-width:2px
    style P12 fill:#f0fdf4,stroke:#16a34a,stroke-width:2px
    style P13 fill:#f0fdf4,stroke:#16a34a,stroke-width:2px
    style P14 fill:#f0fdf4,stroke:#16a34a,stroke-width:2px
```

---

## 2. DFD Level 1 - Proses 2.0 (Pendaftaran Anggota MAKESTA)

Proses ini menjelaskan alur registrasi calon anggota baru secara online, termasuk sistem penyaringan (validasi) untuk memastikan tidak ada duplikasi email.

```mermaid
graph TD
    Voter["Calon Anggota"]
    Admin["Admin"]
    
    P21(["2.1 Input Data Diri Form MAKESTA"])
    P22(["2.2 Saring Keunikan Email"])
    P23(["2.3 Simpan Data Registrasi"])
    P24(["2.4 Kelola Data Pendaftar"])
    
    DS_Reg[("db_registrations")]
    
    Voter -->|"Input Nama, Email, WA, dll."| P21
    P21 -->|"Kirim parameter email"| P22
    P22 -->|"Cek duplikasi email"| DS_Reg
    P22 -->|"Email valid (Lolos saring)"| P23
    P23 -->|"Simpan record pendaftar"| DS_Reg
    
    DS_Reg -->|"Ambil database pendaftar"| P24
    P24 -->|"Tampilkan di dashboard"| Admin
    Admin -->|"Hapus/verifikasi data"| P24
    P24 -->|"Update/Hapus record"| DS_Reg
    
    style P21 fill:#fdf2f8,stroke:#db2777,stroke-width:2px
    style P22 fill:#fdf2f8,stroke:#db2777,stroke-width:2px
    style P23 fill:#fdf2f8,stroke:#db2777,stroke-width:2px
    style P24 fill:#fdf2f8,stroke:#db2777,stroke-width:2px
```

---

## 3. DFD Level 1 - Proses 3.0 (Pelaksanaan e-Voting Terproteksi IP)

Proses ini menerangkan alur bilik suara digital, di mana sistem memvalidasi hak pilih berdasarkan *IP Address* perangkat agar tidak terjadi kecurangan atau pemungutan suara ganda.

```mermaid
graph TD
    Voter["Pemilih / Voter"]
    Admin["Admin"]
    
    P31(["3.1 Ambil Daftar Kandidat Aktif"])
    P32(["3.2 Verifikasi Keunikan IP Address"])
    P33(["3.3 Rekam Suara (e-Voting)"])
    P34(["3.4 Update Akumulasi Hasil Suara"])
    P35(["3.5 Reset & Kelola Suara"])
    
    DS_Voting[("db_voting")]
    
    DS_Voting -->|"Daftar Kandidat"| P31
    P31 -->|"Render kartu bilik suara"| Voter
    Voter -->|"Kirim pilihan & IP Address"| P32
    
    P32 -->|"Periksa IP Address pemilih"| DS_Voting
    P32 -->|"IP belum terdaftar (Suara sah)"| P33
    P33 -->|"Simpan log IP ke tabel votes"| DS_Voting
    P33 -->|"Kirim instruksi akumulasi"| P34
    P34 -->|"Increment votes_count kandidat"| DS_Voting
    
    DS_Voting -->|"Ambil rekapitulasi suara"| P35
    P35 -->|"Tampilkan grafik hasil"| Admin
    Admin -->|"Instruksi reset total suara"| P35
    P35 -->|"Kosongkan tabel votes"| DS_Voting
    
    style P31 fill:#fff7ed,stroke:#ea580c,stroke-width:2px
    style P32 fill:#fff7ed,stroke:#ea580c,stroke-width:2px
    style P33 fill:#fff7ed,stroke:#ea580c,stroke-width:2px
    style P34 fill:#fff7ed,stroke:#ea580c,stroke-width:2px
    style P35 fill:#fff7ed,stroke:#ea580c,stroke-width:2px
```

---

## 4. DFD Level 1 - Proses 4.0 (Manajemen Chat & Ruang Lapor)

Proses ini menangani komunikasi interaktif dua arah antara pengunjung dengan sistem, baik melalui widget Live Chat (Chatbot) maupun form pengaduan (Ruang Lapor).

```mermaid
graph TD
    Pengunjung["Pengunjung"]
    Admin["Admin"]
    
    P41(["4.1 Terima Pesan Chat / Aduan"])
    P42(["4.2 Simpan Log Pesan"])
    P43(["4.3 Tampilkan Pesan di Dashboard"])
    P44(["4.4 Kirim Balasan (Live Chat)"])
    
    DS_Feedback[("db_feedback")]
    
    Pengunjung -->|"Input chat / form lapor"| P41
    P41 -->|"Validasi data pesan"| P42
    P42 -->|"Simpan record pesan"| DS_Feedback
    
    DS_Feedback -->|"Ambil pesan masuk"| P43
    P43 -->|"Tampilkan list chat & aduan"| Admin
    Admin -->|"Ketik balasan chat"| P44
    P44 -->|"Simpan balasan ke database"| DS_Feedback
    P44 -->|"Render balasan ke widget"| Pengunjung
    
    style P41 fill:#eef2ff,stroke:#4f46e5,stroke-width:2px
    style P42 fill:#eef2ff,stroke:#4f46e5,stroke-width:2px
    style P43 fill:#eef2ff,stroke:#4f46e5,stroke-width:2px
    style P44 fill:#eef2ff,stroke:#4f46e5,stroke-width:2px
```

---

## 5. DFD Level 1 - Proses 5.0 (Pelacakan Statistik Pengunjung)

Proses ini memantau rekam jejak otomatis setiap *visitor* yang membuka situs, mencatat sistem operasi, browser, dan melengkapi data analitik untuk Admin.

```mermaid
graph TD
    Pengunjung["Pengunjung"]
    Admin["Admin"]
    
    P51(["5.1 Deteksi Request Akses Web"])
    P52(["5.2 Ekstrak IP, OS & Browser"])
    P53(["5.3 Simpan Data Kunjungan"])
    P54(["5.4 Kalkulasi Statistik Analitik"])
    
    DS_Visitors[("db_visitors")]
    
    Pengunjung -->|"Akses halaman portal"| P51
    P51 -->|"Teruskan parameter User-Agent"| P52
    P52 -->|"Format IP, OS & Browser"| P53
    P53 -->|"Catat log kunjungan harian"| DS_Visitors
    
    DS_Visitors -->|"Ambil akumulasi log"| P54
    P54 -->|"Render grafik OS & Browser"| Admin
    
    style P51 fill:#fefce8,stroke:#ca8a04,stroke-width:2px
    style P52 fill:#fefce8,stroke:#ca8a04,stroke-width:2px
    style P53 fill:#fefce8,stroke:#ca8a04,stroke-width:2px
    style P54 fill:#fefce8,stroke:#ca8a04,stroke-width:2px
```

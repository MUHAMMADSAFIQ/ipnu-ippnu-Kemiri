# ALUR DATA FLOW DIAGRAM (DFD) LEVEL 0

DFD Level 0 ini menggambarkan aliran data secara umum (Top-Level) dari Sistem Informasi Portal Web dan E-Voting PAC IPNU IPPNU Kecamatan Kemiri. Diagram ini menguraikan sistem tunggal menjadi 5 sub-proses transaksional utama yang berinteraksi secara dinamis dengan 3 entitas luar (Pengunjung, Registran/Voter, Admin) serta penyimpanan basis data (*Data Store* SQLite).

```mermaid
graph TD
    %% Entitas Luar
    Aktor_Pengunjung["Pengunjung"]
    Aktor_Voter["Registran / Voter"]
    Aktor_Admin["Admin"]

    %% Proses-Proses
    P1(["1.0 Kelola Profil & Konten Portal"])
    P2(["2.0 Pendaftaran Anggota (MAKESTA)"])
    P3(["3.0 Pelaksanaan e-Voting"])
    P4(["4.0 Manajemen Chat & Ruang Lapor"])
    P5(["5.0 Pelacakan Statistik Pengunjung"])

    %% Data Store
    DS_Articles[("db_articles")]
    DS_Registrations[("db_registrations")]
    DS_Voting[("db_voting")]
    DS_Feedback[("db_feedback")]
    DS_Visitors[("db_visitors")]

    %% Aliran Proses 1.0
    Aktor_Admin -->|"Olah berita, Nahkoda, Lapak"| P1
    P1 -->|"Simpan data"| DS_Articles
    DS_Articles -->|"Ambil data"| P1
    P1 -->|"Tampilkan berita, Nahkoda, Lapak"| Aktor_Pengunjung

    %% Aliran Proses 2.0
    Aktor_Voter -->|"Input formulir MAKESTA"| P2
    P2 -->|"Validasi email unik & simpan"| DS_Registrations
    DS_Registrations -->|"Ambil data pendaftar"| P2
    P2 -->|"Lihat/verifikasi pendaftar"| Aktor_Admin

    %% Aliran Proses 3.0
    Aktor_Voter -->|"Kirim pilihan suara & IP"| P3
    P3 -->|"Verifikasi IP & catat suara"| DS_Voting
    DS_Voting -->|"Ambil perolehan suara"| P3
    P3 -->|"Visualisasi grafik & kendali reset"| Aktor_Admin

    %% Aliran Proses 4.0
    Aktor_Pengunjung -->|"Kirim aduan & chat AJAX"| P4
    P4 -->|"Simpan pesan & aduan"| DS_Feedback
    DS_Feedback -->|"Notifikasi aduan & log chat"| P4
    P4 -->|"Balas chat & review aduan"| Aktor_Admin

    %% Aliran Proses 5.0
    Aktor_Pengunjung -->|"Akses Web (User-Agent)"| P5
    P5 -->|"Catat IP, OS, Browser"| DS_Visitors
    DS_Visitors -->|"Statistik kunjungan"| P5
    P5 -->|"Grafik statistik OS & Browser"| Aktor_Admin

    style P1 fill:#e0f2fe,stroke:#0284c7,stroke-width:2px
    style P2 fill:#e0f2fe,stroke:#0284c7,stroke-width:2px
    style P3 fill:#e0f2fe,stroke:#0284c7,stroke-width:2px
    style P4 fill:#e0f2fe,stroke:#0284c7,stroke-width:2px
    style P5 fill:#e0f2fe,stroke:#0284c7,stroke-width:2px
```

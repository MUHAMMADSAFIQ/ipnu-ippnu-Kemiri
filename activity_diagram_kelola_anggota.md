# Activity Diagram - Pendaftaran & Kelola Anggota (MAKESTA)

Activity Diagram ini memvisualisasikan alur sistem dalam menangani proses registrasi anggota baru (MAKESTA) hingga proses pengelolaan data pendaftar oleh administrator. Alur kerja dibagi ke dalam tiga pihak (*swimlane*), yaitu **Calon Anggota** (pihak yang mendaftar), **Sistem** (yang bertugas memvalidasi email unik dan menyimpan data), dan **Administrator** (yang mengawasi dan mengelola data registrasi di *dashboard*).

## Diagram

```mermaid
flowchart TD
    %% Styling
    classDef startEnd fill:#10b981,stroke:#047857,stroke-width:2px,color:#fff;
    classDef process fill:#e0f2fe,stroke:#0284c7,stroke-width:2px;
    classDef condition fill:#fef08a,stroke:#ca8a04,stroke-width:2px;
    classDef database fill:#fce7f3,stroke:#db2777,stroke-width:2px;

    subgraph Calon_Anggota ["Calon Anggota"]
        direction TB
        Start1((Mulai)):::startEnd --> P1[Buka Halaman Gabung MAKESTA]:::process
        P1 --> P2[Isi Form: Nama, Email, WA, TTL, dll]:::process
        P2 --> P3[Klik Tombol Daftar]:::process
        
        S4 --> P4[Perbaiki Isian / Ganti Email]:::process
        P4 --> P3
        
        S6 --> P5[Terima Notifikasi Pendaftaran Sukses]:::process
        P5 --> End1((Selesai)):::startEnd
    end

    subgraph Sistem ["Sistem (Aplikasi Web)"]
        direction TB
        P3 --> S1[Terima Permintaan Registrasi]:::process
        S1 --> S2{Validasi Format Isian?}:::condition
        
        S2 -- Valid --> S3{Cek Duplikasi Email?}:::condition
        S2 -- Tidak Valid --> S4[Tampilkan Alert Form Error]:::process
        
        S3 -- Email Sudah Terdaftar --> S4
        S3 -- Email Belum Terdaftar --> S5[Simpan Record Anggota ke db_registrations]:::database
        
        S5 --> S6[Tampilkan Pesan Berhasil Daftar]:::process
        
        S5 -.-> A2
    end

    subgraph Admin ["Administrator"]
        direction TB
        Start2((Mulai)):::startEnd --> A1[Login ke Dashboard Admin]:::process
        A1 --> A2[Akses Menu Database MAKESTA]:::process
        
        A2 --> A3[Tampilkan List Data Pendaftar]:::process
        A3 --> A4{Pilih Aksi?}:::condition
        
        A4 -- Tinjau Data --> A5[Lihat Detail Calon Kader]:::process
        A4 -- Hapus Data --> A6[Klik Hapus Data Verifikasi Selesai]:::process
        
        A6 --> S7[Hapus Record dari db_registrations]:::database
        
        A5 --> End2((Selesai)):::startEnd
        S7 --> End2
    end
```

## Penjelasan Alur (Workflow):

1. **Calon Anggota**:
   - Proses dimulai saat pengguna (calon kader) membuka halaman **Gabung MAKESTA**.
   - Pengguna diwajibkan melengkapi kolom formulir (seperti Nama Lengkap, Email unik, No WA, Tempat/Tanggal Lahir, Pendidikan, Rencana Tanggal MAKESTA, dan Alamat Rumah).
   - Setelah formulir terisi, pengguna mengirim data dengan mengeklik tombol Daftar.

2. **Sistem (Aplikasi Web)**:
   - Sistem menerima kiriman formulir dan melakukan validasi bertahap:
     1. **Validasi Format**: Mengecek apakah ada field wajib yang kosong atau format yang salah.
     2. **Validasi Keunikan (Duplikasi Email)**: Mengecek tabel basis data `registrations` (`db_registrations`). Apabila *email* yang dimasukkan sudah pernah terdaftar, sistem menolak proses dan memberikan peringatan "*Email ini sudah terdaftar sebelumnya*".
   - Apabila kedua validasi di atas lolos, maka sistem menyetujui pendaftaran dan mengunci data pendaftar baru ke dalam database secara permanen.
   - Pendaftar menerima layar notifikasi registrasi berhasil.

3. **Administrator (Kelola Anggota)**:
   - Admin (*secretariat*) yang bertugas, login secara aman ke dashboard backend.
   - Admin membuka panel menu Database MAKESTA yang terintegrasi secara *real-time* menampilkan daftar lengkap pendaftar terbaru.
   - **Tinjau Data**: Admin dapat melihat detail isian formulir kader.
   - **Hapus Data (Opsional)**: Setelah data diverifikasi, direkapitulasi secara manual/fisik, atau diekspor, admin dapat melakukan aksi Hapus untuk membuang *record* dari database jika dirasa perlu untuk mengosongkan beban data server.

# Activity Diagram - Pelaporan (Ruang Lapor)

Activity Diagram ini menggambarkan alur kerja fungsional dari fitur **Ruang Lapor** pada sistem informasi portal web PAC IPNU IPPNU Kemiri. Diagram ini membagi proses ke dalam tiga *swimlane* yang merepresentasikan interaksi antara **Pengunjung** (pengguna umum yang mengirimkan kritik/saran), **Sistem** (proses validasi dan penyimpanan), serta **Admin** (pihak yang memantau dan merespon laporan).

## Diagram

```mermaid
flowchart TD
    %% Styling untuk memperjelas visualisasi
    classDef startEnd fill:#10b981,stroke:#047857,stroke-width:2px,color:#fff;
    classDef process fill:#e0f2fe,stroke:#0284c7,stroke-width:2px;
    classDef condition fill:#fef08a,stroke:#ca8a04,stroke-width:2px;
    classDef database fill:#fce7f3,stroke:#db2777,stroke-width:2px;

    subgraph Pengunjung ["Pengunjung Umum"]
        direction TB
        Start1((Mulai)):::startEnd --> P1[Buka Halaman Ruang Lapor]:::process
        P1 --> P2[Isi Form: Nama, Subjek, Kontak, Pesan]:::process
        P2 --> P3[Klik Tombol Kirim]:::process
        
        S3 --> P4[Perbaiki Isian Form]:::process
        P4 --> P3
        
        S5 --> P5[Terima Notifikasi Sukses]:::process
        P5 --> End1((Selesai)):::startEnd
    end

    subgraph Sistem ["Sistem (Aplikasi Web)"]
        direction TB
        P3 --> S1[Terima Data via AJAX]:::process
        S1 --> S2{Validasi Input?}:::condition
        
        S2 -- Tidak Valid --> S3[Tampilkan Pesan Error]:::process
        S2 -- Valid --> S4[Simpan ke db_feedback]:::database
        
        S4 --> S5[Tampilkan Notifikasi Berhasil]:::process
    end

    subgraph Admin ["Administrator"]
        direction TB
        Start2((Mulai)):::startEnd --> A1[Login Dashboard Admin]:::process
        A1 --> A2[Buka Menu Ruang Lapor]:::process
        
        S4 -.->|Update Data Laporan Baru| A2
        
        A2 --> A3[Lihat Daftar Laporan]:::process
        A3 --> A4[Buka Detail Laporan]:::process
        A4 --> A5[Tandai Laporan Selesai Dibaca <br/>is_read = true]:::process
        A5 --> End2((Selesai)):::startEnd
    end
```

## Penjelasan Alur (Workflow):

1. **Pengunjung Umum**:
   - Pengunjung mengakses menu Ruang Lapor di portal web.
   - Pengunjung mengisi formulir pengaduan (Nama, Subjek, Kontak, dan Pesan).
   - Pengunjung mengklik tombol Kirim (proses dilakukan secara asinkron menggunakan AJAX).

2. **Sistem (Aplikasi Web)**:
   - Sistem menerima kiriman data form dan melakukan **validasi** (memastikan field wajib telah diisi dengan format yang benar).
   - Jika **Tidak Valid**: Sistem menampilkan pesan peringatan/error. Pengunjung kemudian harus memperbaiki isiannya.
   - Jika **Valid**: Sistem menyimpan data laporan ke dalam tabel basis data `feedbacks` (`db_feedback`).
   - Setelah sukses menyimpan, sistem mengembalikan notifikasi keberhasilan kepada pengunjung.

3. **Administrator**:
   - Admin melakukan login dan masuk ke Dashboard.
   - Admin membuka menu pengaduan/laporan (Ruang Lapor) dan melihat daftar laporan terbaru yang baru saja diinput oleh pengunjung.
   - Admin memilih dan membaca rincian laporan tersebut.
   - Setelah selesai ditinjau, admin dapat menandai laporan sebagai sudah dibaca (`is_read = true`), menyelesaikan siklus pelaporan di sistem.

# Activity Diagram - Kelola Profil Kepengurusan (Nahkoda & BPH)

Activity Diagram ini menggambarkan alur kerja pengelolaan data profil kepengurusan organisasi (seperti Pimpinan Nahkoda dan Badan Pengurus Harian/BPH). Proses ini melibatkan **Administrator** yang mengelola pembaruan data secara dinamis (*Create, Read, Update, Delete*), **Sistem** yang memvalidasi dan menyimpan data ke *database*, serta **Pengunjung** umum yang mengakses dan melihat susunan pengurus tersebut di halaman depan (portal web).

## Diagram

```mermaid
flowchart TD
    %% Styling
    classDef startEnd fill:#10b981,stroke:#047857,stroke-width:2px,color:#fff;
    classDef process fill:#e0f2fe,stroke:#0284c7,stroke-width:2px;
    classDef condition fill:#fef08a,stroke:#ca8a04,stroke-width:2px;
    classDef database fill:#fce7f3,stroke:#db2777,stroke-width:2px;

    subgraph Admin ["Administrator (Backend)"]
        direction TB
        Start1((Mulai)):::startEnd --> A1[Login ke Dashboard Admin]:::process
        A1 --> A2[Buka Menu Pengurus Nahkoda & BPH]:::process
        A2 --> A3[Tampilkan List Data Pengurus]:::process
        A3 --> A4{Pilih Aksi?}:::condition
        
        A4 -- Tambah / Edit --> A5[Isi Form Profil Pengurus <br/>Nama, Jabatan, Foto, dll]:::process
        A5 --> A6[Klik Simpan]:::process
        
        A4 -- Hapus --> A7[Konfirmasi Hapus Data]:::process
        
        A6 --> S1
        A7 --> S4
        
        S5 --> A8[Terima Notifikasi Berhasil]:::process
        A8 --> End1((Selesai)):::startEnd
    end

    subgraph Sistem ["Sistem (Aplikasi Web)"]
        direction TB
        S1[Terima Input Data Form]:::process --> S2{Validasi Data & Upload Foto?}:::condition
        
        S2 -- Tidak Valid --> S3[Tampilkan Pesan Error Validasi]:::process
        S3 --> A5
        
        S2 -- Valid --> S3_A[Simpan / Update Record <br/>ke Database]:::database
        S4[Terima Instruksi Hapus]:::process --> S4_A[Hapus Record dari Database]:::database
        
        S3_A --> S5[Tampilkan Alert Sukses]:::process
        S4_A --> S5
        
        S6[Terima Request Halaman Pengurus]:::process --> S7[Tarik Data Kepengurusan <br/>Aktif dari Database]:::database
        S7 --> S8[Render UI Halaman Web]:::process
    end

    subgraph Pengunjung ["Pengunjung Umum (Frontend)"]
        direction TB
        Start2((Mulai)):::startEnd --> P1[Akses Menu Navigasi Portal]:::process
        P1 --> P2[Klik Menu 'Nahkoda' / 'Susunan BPH']:::process
        
        P2 --> S6
        
        S8 --> P3[Lihat Tampilan Profil & Susunan<br/> Pengurus Secara Lengkap]:::process
        P3 --> End2((Selesai)):::startEnd
    end
```

## Penjelasan Alur (Workflow):

1. **Administrator (Backend)**:
   - Admin bertugas memperbarui profil pengurus secara dinamis menyesuaikan periode masa khidmat.
   - Admin login dan masuk ke menu khusus manajemen pengurus (Nahkoda & BPH).
   - Di sini, admin dapat melakukan 3 jenis manipulasi data:
     1. **Tambah / Edit Profil**: Admin memasukkan atau merevisi informasi pengurus (seperti Nama, Jabatan fungsional, dan mengunggah Foto Resmi), lalu menyimpannya.
     2. **Hapus Data**: Apabila terdapat pergantian/reshuffle, admin bisa menghapus data pengurus yang lama.

2. **Sistem (Aplikasi Web)**:
   - **Manajemen Form**: Saat admin melakukan Tambah/Edit, sistem memvalidasi teks dan memastikan file foto yang diunggah sesuai ukuran dan format yang benar. Jika lolos, record disimpan/diperbarui ke dalam database.
   - **Manajemen Visual**: Jika pengunjung meminta akses halaman profil pengurus, sistem akan menarik keseluruhan struktur data pengurus dari database lalu memuatnya (render) ke dalam bentuk halaman berdesain visual modern (*glassmorphism*) yang bisa dibaca pengunjung.

3. **Pengunjung Umum (Frontend)**:
   - Pengunjung umum tidak memiliki hak akses mengubah profil. Mereka hanya masuk ke portal web dan memilih menu navigasi seperti "Nahkoda" atau "Susunan BPH".
   - Selanjutnya, mereka langsung dapat melihat profil pimpinan serta jajaran pengurus harian yang paling aktual dan ter-update berdasarkan input terbaru dari admin.

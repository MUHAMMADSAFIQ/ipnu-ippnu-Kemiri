# ACTIVITY DIAGRAM

Activity Diagram menggambarkan alur kerja (*workflow*) sistem dari awal hingga akhir, termasuk proses pengambilan keputusan (*decision*) yang dilakukan oleh sistem di latar belakang.

Berdasarkan fungsionalitas inti proyek Portal Web dan E-Voting IPNU IPPNU Kemiri (sejalan dengan proses DFD Level 1), berikut adalah 5 (lima) *Activity Diagram* yang mewakili seluruh proses krusial dalam sistem:

---

## 1. Activity Diagram: Pengelolaan Konten Portal Web oleh Admin

Alur ini menggambarkan perjalanan Administrator dari pintu masuk sistem (*Login*) hingga proses mengubah isi portal web (misal: Artikel, Lapak UMKM, atau Struktur BPH).

```mermaid
flowchart TD
    Start([Mulai]) --> A[Akses Halaman Login Admin]
    A --> B[Masukkan Kredensial KEMIRI-HEBAT-2026]
    B --> C[Klik Tombol Login]
    
    %% Cek Login
    C --> D{Kredensial Valid?}
    D -- "Tidak Valid" --> E[Sistem Menolak Masuk & Tampilkan Error]
    E --> B
    
    D -- "Valid" --> F[Sistem Mengarahkan ke Dashboard Panel]
    
    %% Manipulasi Konten
    F --> G[Buka Menu Konten Misal: Artikel / Lapak UMKM]
    G --> H{Pilih Aksi Pengelolaan}
    
    H -- "Tambah Data" --> I[Isi Formulir Konten Baru]
    H -- "Edit Data" --> J[Ubah Isi Data yang Sudah Ada]
    H -- "Hapus Data" --> K[Klik Konfirmasi Hapus Data]
    
    I --> L[Sistem Melakukan Query Simpan / Update / Hapus]
    J --> L
    K --> L
    
    L --> M[Halaman Diperbarui & Disajikan ke Pengunjung]
    M --> End([Selesai])

    style Start fill:#16a34a,color:#fff,stroke:#14532d,stroke-width:2px
    style End fill:#dc2626,color:#fff,stroke:#7f1d1d,stroke-width:2px
    style D fill:#f59e0b,color:#fff,stroke:#b45309,stroke-width:2px
    style H fill:#f59e0b,color:#fff,stroke:#b45309,stroke-width:2px
```

**Penjelasan Alur:**
1. Admin wajib mematuhi sistem *Middleware Auth*. Apabila mencoba meretas dan sandi salah, sistem akan mendepaknya kembali ke halaman *login*.
2. Jika berhasil *login*, Admin masuk ke *dashboard* dan memilih menu konten yang akan dimanipulasi (*Create, Read, Update, Delete* / CRUD).
3. Setelah admin mengeksekusi operasi data, *database* diperbarui dan perubahan langsung terlihat di web publik.

---

## 2. Activity Diagram: Pendaftaran MAKESTA Online

Alur ini menggambarkan proses saat seorang Calon Anggota mengisi formulir, di mana sistem akan melakukan pengecekan (*validasi*) untuk memastikan tidak ada duplikasi email.

```mermaid
flowchart TD
    Start([Mulai]) --> A[Akses Halaman Formulir Pendaftaran]
    A --> B[Mengisi Data Diri Lengkap]
    B --> C[Klik Tombol 'Kirim Formulir']
    
    %% Proses Sistem
    C --> D{Sistem Mengecek<br>Duplikasi Email}
    
    %% Alur Kondisi
    D -- "Email Sudah Terdaftar" --> E[Sistem Menampilkan Peringatan Validasi Merah]
    E --> B
    
    D -- "Email Belum Terdaftar" --> F[Sistem Menyimpan Data Pendaftar ke Database]
    F --> G[Sistem Menampilkan Notifikasi Berhasil]
    G --> End([Selesai])

    style Start fill:#16a34a,color:#fff,stroke:#14532d,stroke-width:2px
    style End fill:#dc2626,color:#fff,stroke:#7f1d1d,stroke-width:2px
    style D fill:#f59e0b,color:#fff,stroke:#b45309,stroke-width:2px
```

**Penjelasan Alur:**
1. Pengunjung masuk ke halaman formulir pendaftaran MAKESTA dan mengisi data.
2. Sistem mengecek tabel `registrations` di *database* SQLite.
3. Jika email sudah terdaftar, proses ditolak (*error message*). Jika email unik, sistem sukses menyimpan berkas pendaftaran calon kader baru.

---

## 3. Activity Diagram: Pelaksanaan Pemilihan E-Voting Terproteksi

Alur ini menggambarkan bagaimana bilik suara beroperasi dan bagaimana sistem memproteksi integritas suara menggunakan validasi alamat IP (*IP Address*).

```mermaid
flowchart TD
    Start([Mulai]) --> A[Akses Halaman Bilik Suara E-Voting]
    A --> B[Melihat Profil & Visi Misi Kandidat]
    B --> C[Pilih Salah Satu Kandidat]
    C --> D[Klik Tombol 'Salurkan Suara Saya']
    
    %% Proses Sistem
    D --> E{Sistem Memeriksa<br>IP Address Pemilih}
    
    %% Alur Kondisi
    E -- "IP Sudah Tercatat" --> F[Sistem Memblokir Suara & Menampilkan Peringatan Gagal]
    F --> End([Selesai])
    
    E -- "IP Belum Tercatat" --> G[Sistem Menyimpan Log IP Address ke Tabel Votes]
    G --> H[Sistem Menambahkan +1 Suara pada Kandidat]
    H --> I[Sistem Menampilkan Notifikasi Berhasil Memilih]
    I --> End

    style Start fill:#16a34a,color:#fff,stroke:#14532d,stroke-width:2px
    style End fill:#dc2626,color:#fff,stroke:#7f1d1d,stroke-width:2px
    style E fill:#f59e0b,color:#fff,stroke:#b45309,stroke-width:2px
```

**Penjelasan Alur:**
1. Pemilih (Voter) menyalurkan suaranya di bilik e-Voting digital.
2. *Backend* mendeteksi IP Address pemilih. Jika IP tersebut sudah ada di tabel `votes`, suara diblokir.
3. Jika IP belum ada, IP direkam dan jumlah suara kandidat bertambah secara otomatis.

---

## 4. Activity Diagram: Manajemen Chat & Ruang Lapor

Alur ini menggambarkan interaksi langsung antara pengunjung dan pengurus via fitur chatbot/live chat dan formulir laporan.

```mermaid
flowchart TD
    Start([Mulai]) --> A[Pengunjung Buka Widget Chat / Ruang Lapor]
    A --> B[Mengetikkan Pesan / Aduan]
    B --> C[Klik Tombol Kirim]
    
    C --> D[Sistem Menyimpan Pesan ke Database]
    D --> E[Sistem Menampilkan Pesan di Dashboard Admin]
    
    E --> F{Admin Merespons?}
    F -- "Tidak" --> G[Pesan Tetap Berstatus Unread/Menunggu]
    
    F -- "Ya" --> H[Admin Mengetik & Mengirim Balasan]
    H --> I[Sistem Menyimpan Balasan ke Database]
    I --> J[Pesan Balasan Muncul di Layar Pengunjung]
    
    G --> End([Selesai])
    J --> End

    style Start fill:#16a34a,color:#fff,stroke:#14532d,stroke-width:2px
    style End fill:#dc2626,color:#fff,stroke:#7f1d1d,stroke-width:2px
    style F fill:#f59e0b,color:#fff,stroke:#b45309,stroke-width:2px
```

**Penjelasan Alur:**
1. Pengunjung web mengirimkan laporan atau obrolan chat.
2. Sistem menampung pesan dan memunculkan notifikasi di *dashboard backend* administrator.
3. Saat admin membalas, sistem kembali meneruskan pesan balasan tersebut langsung ke *widget* obrolan pengunjung.

---

## 5. Activity Diagram: Pelacakan Statistik Pengunjung

Alur latar belakang ini menggambarkan otomatisasi pencatatan rekam jejak OS (Sistem Operasi) dan web browser pengunjung tanpa perlu ada interaksi manual.

```mermaid
flowchart TD
    Start([Mulai]) --> A[Pengunjung Mengakses URL Portal Web]
    
    A --> B[Sistem Mendeteksi Header User-Agent]
    B --> C[Sistem Mengekstrak IP, Jenis OS, dan Browser]
    
    C --> D{Apakah Data Valid?}
    D -- "Tidak Valid / Bot" --> E[Abaikan Permintaan]
    
    D -- "Valid" --> F[Simpan Log Kunjungan Harian ke Database]
    
    F --> G[Admin Buka Dashboard Statistik]
    G --> H[Sistem Merender Grafik Berdasarkan Rekam Jejak]
    
    E --> End([Selesai])
    H --> End

    style Start fill:#16a34a,color:#fff,stroke:#14532d,stroke-width:2px
    style End fill:#dc2626,color:#fff,stroke:#7f1d1d,stroke-width:2px
    style D fill:#f59e0b,color:#fff,stroke:#b45309,stroke-width:2px
```

**Penjelasan Alur:**
1. Saat halaman dimuat, sistem *backend* mengekstrak string *User-Agent* milik pengunjung.
2. Sistem menyaring apakah itu *request* dari pengunjung asli, jika iya maka data dicatat.
3. Kumpulan *log* tersebut dirender menjadi grafik interaktif yang bisa dipantau secara visual oleh Administrator di halaman muka panel admin.

---

## 6. Activity Diagram: Upload Artikel oleh Pengunjung

Alur ini menggambarkan proses pengunjung web (non-admin) saat mengirimkan tulisan/artikel karya mereka ke redaksi portal, mulai dari pengisian form hingga statusnya masuk antrean moderasi.

```mermaid
flowchart TD
    Start([Mulai]) --> A[Akses Halaman Form Upload Artikel]
    A --> B[Mengisi Data Artikel Judul, Penulis, Isi, Gambar]
    B --> C[Klik Tombol 'Kirim Artikel']
    
    %% Validasi Sistem
    C --> D{Sistem Memvalidasi<br>Input & Ekstensi File}
    
    %% Alur Kondisi
    D -- "Tidak Valid" --> E[Sistem Menampilkan Pesan Peringatan]
    E --> B
    
    D -- "Valid" --> F[Sistem Menyimpan Artikel ke Database]
    F --> G[Set Status Artikel 'Menunggu Moderasi']
    G --> H[Sistem Menampilkan Notifikasi Berhasil Mengirim]
    H --> End([Selesai])

    style Start fill:#16a34a,color:#fff,stroke:#14532d,stroke-width:2px
    style End fill:#dc2626,color:#fff,stroke:#7f1d1d,stroke-width:2px
    style D fill:#f59e0b,color:#fff,stroke:#b45309,stroke-width:2px
```

**Penjelasan Alur:**
1. Pengunjung (Penulis) mengakses form kontribusi artikel dan mengisi kelengkapan data seperti judul, nama penulis, isi konten, dan melampirkan gambar.
2. Sistem *backend* memvalidasi form (memastikan tidak ada yang kosong dan gambar sesuai format). Jika tidak valid, pengunjung diminta memperbaiki isian.
3. Jika valid, artikel disimpan di *database* dengan status *Pending* (Menunggu Moderasi). Artikel tidak langsung tayang di portal web.
4. Pengunjung menerima notifikasi sukses bahwa artikel telah dikirim dan sedang menunggu tinjauan dari Administrator/Redaksi.

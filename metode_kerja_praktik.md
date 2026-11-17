# METODE KERJA PRAKTIK

Berdasarkan analisis dan pengembangan Sistem Informasi Portal Web dan E-Voting pada PAC IPNU IPPNU Kecamatan Kemiri, berikut adalah penjabaran metode kerja praktik yang digunakan:

## 1. Metode Perancangan Sistem

Metode perancangan sistem yang digunakan dalam pengembangan proyek ini adalah **Metode Perancangan Sistem Terstruktur (Structured System Analysis and Design)** yang digabungkan dengan pendekatan arsitektur perangkat lunak **Model-View-Controller (MVC)**. Pendekatan MVC diimplementasikan secara langsung melalui penggunaan *framework* **Laravel**.

Untuk menjabarkan proses perancangan secara komprehensif, pemodelan sistem dilakukan menggunakan standar visualisasi sebagai berikut:

*   **Pemodelan Proses (Process Modeling):**
    *   **Diagram Konteks (Context Diagram):** Digunakan untuk menggambarkan batasan sistem secara global dan interaksi langsung antara sistem utama portal web dengan entitas eksternal atau aktor yang terlibat, yaitu: Pengunjung Umum, Calon Anggota (Registran)/Voter, dan Administrator.
    *   **Data Flow Diagram (DFD):** Digunakan untuk memetakan aliran data dan transformasi informasi secara rinci. Perancangan dibagi menjadi DFD Level 0 (memuat proses utama seperti Kelola Profil, Pendaftaran MAKESTA, Pelaksanaan e-Voting, Manajemen Chat, dan Statistik Pengunjung) dan dijabarkan lebih lanjut ke dalam DFD Level 1 untuk setiap sub-proses fungsional.
*   **Pemodelan Data (Data Modeling):**
    *   **Entity Relationship Diagram (ERD):** Digunakan untuk memodelkan struktur logis data dan relasi antar entitas bisnis, seperti relasi antara *users, articles, comments, registrations, candidates*, dan *votes*.
    *   **Diagram Relasi Antartabel Fisik:** Merupakan cetak biru (blueprint) skema *database* fisik yang diimplementasikan pada basis data **SQLite**, yang mencakup penentuan *Primary Key* (PK), *Foreign Key* (FK), dan tipe data pada kamus data (Data Dictionary).
*   **Pemodelan Antarmuka (User Interface / UI Design):** 
    Perancangan purwarupa (*mockup*) antarmuka sistem yang berfokus pada pendekatan *Glassmorphism* dan responsivitas desain menggunakan utilitas *framework* **Tailwind CSS**.

---

## 2. Alur Penelitian (Research Flow)

Alur penelitian dan pengembangan kerja praktik ini mengacu pada tahapan berurutan sistematis yang diadaptasi dari metode *Software Development Life Cycle* (SDLC) model **Waterfall**. Alur kerja diuraikan sebagai berikut:

### a. Tahap Pengumpulan Data
Merupakan tahap awal untuk mendapatkan informasi dan masalah riil di lapangan. Tahap ini dilakukan dengan dua cara:
1.  **Observasi:** Mengamati langsung ekosistem administrasi, publikasi informasi, dan pelaksanaan pemilihan ketua di kesekretariatan PAC IPNU IPPNU Kemiri yang masih manual dan konvensional.
2.  **Wawancara:** Melakukan sesi tanya jawab terstruktur dengan pengurus inti (Ketua dan Sekretaris) untuk menggali ekspektasi terhadap sistem baru, seperti kebutuhan sistem e-voting mandiri yang aman dari manipulasi dan sistem registrasi MAKESTA bebas duplikasi data.

### b. Tahap Analisis Kebutuhan Sistem
Data yang telah dikumpulkan kemudian dianalisis untuk mendefinisikan apa saja yang harus dapat dilakukan oleh sistem. Tahapan ini merumuskan:
*   **Kebutuhan Fungsional:** Menentukan fitur sistem seperti portal informasi satu pintu, formulir Ruang Lapor, e-Voting yang terproteksi, pendataan formulir pendaftaran daring, serta manajemen administrator.
*   **Kebutuhan Non-Fungsional:** Menentukan standar keamanan (seperti perlindungan IP Address dan *password hashing*), kompatibilitas peramban (*browser*), serta kehandalan *database* SQLite.

### c. Tahap Perancangan Sistem (Design)
Berdasarkan hasil analisis kebutuhan, tahap perancangan dieksekusi dengan membuat desain sistem secara utuh. Aktivitas perancangan meliputi: pembuatan rancangan alur sistem (Diagram Konteks & DFD), rancangan struktur *database* (ERD & skema tabel fisik), serta rancangan tampilan visual UI/UX web.

### d. Tahap Implementasi (Coding)
Menerjemahkan seluruh rancangan sistem yang telah disetujui ke dalam baris kode program (*coding*). Tahap ini melibatkan integrasi teknologi *Backend* menggunakan **PHP (Laravel Framework)** dan *Database* **SQLite 3**, serta teknologi *Frontend* menggunakan **HTML, JavaScript, Tailwind CSS**, dan **Vite** sebagai *asset bundler*.

### e. Tahap Pengujian Sistem (Testing)
Tahap validasi fungsionalitas sistem sebelum dirilis secara publik. Fokus utama pada pengujian:
*   Validasi keunikan IP Address pada bilik suara digital (e-Voting) untuk memastikan tidak ada kecurangan suara ganda.
*   Pengujian penyaringan dan pemblokiran otomatis pada *database* formulir *online* apabila terdapat pendaftar MAKESTA yang menggunakan email yang sama (redundansi data).
*   Pengujian responsivitas tata letak antarmuka web pada *device* gawai pintar (*smartphone*), tablet, maupun PC *desktop*.

### f. Tahap Peluncuran dan Evaluasi (Deployment)
Sistem informasi portal web disebarluaskan secara *online* menggunakan layanan *hosting* publik sehingga dapat diakses secara resmi pada domain **ipnukemiri.jaidiperform.my.id**. Dilanjutkan dengan proses evaluasi, monitoring (*visitor tracking*), serta pemeliharaan (*maintenance*) berdasarkan interaksi pengguna dan administrator di lapangan.

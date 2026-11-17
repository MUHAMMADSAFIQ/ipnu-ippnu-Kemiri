# BAB II: LANDASAN TEORI

## A. Konsep Dasar Sistem

**1. Sistem Informasi**
Sistem informasi adalah kombinasi terintegrasi dari teknologi informasi dan aktivitas manusia yang menggunakan teknologi tersebut untuk mendukung operasi dan manajemen operasional. Dalam konteks organisasi kemasyarakatan seperti IPNU IPPNU, sistem informasi berfungsi krusial untuk mendigitalisasi proses administrasi (seperti kaderisasi), sentralisasi pangkalan data, dan percepatan sirkulasi informasi.

**2. Portal Web**
Portal web adalah situs web yang menyediakan titik akses tunggal terpusat (satu pintu) bagi penggunanya. Portal ini menyajikan gabungan informasi dari berbagai sumber (seperti berita, agenda, profil kepengurusan, dan layanan anggota) secara terstruktur, terpadu, dan dinamis.

**3. Electronic Voting (e-Voting)**
*Electronic Voting* (e-Voting) merupakan suatu metode pemungutan suara yang memanfaatkan perangkat dan teknologi elektronik untuk memfasilitasi proses pemberian suara secara mandiri dan menghitung hasil rekapitulasi secara otomatis. Sistem e-Voting modern di lingkungan web biasanya diperkuat dengan sistem keamanan validasi token atau pemindaian *IP Address* secara *backend* untuk menjamin asas "Satu Pemilih Satu Suara" dan menekan celah manipulasi ganda (*double voting*).

---

## B. Metode Pengembangan Perangkat Lunak

**Model Pendekatan Prototyping**
Model *Prototype* adalah salah satu paradigma pengembangan perangkat lunak (SDLC) yang didasarkan pada konsep pembuatan model kerja (*working model*) secara cepat sebelum sistem final dibangun seutuhnya. Metode ini sangat ideal diterapkan untuk sistem di mana pengguna akhir (seperti pengurus ranting/kader) belum memiliki gambaran final yang kaku dan membutuhkan penyesuaian fungsionalitas di tengah jalan. 

Tahapan-tahapan dalam model *Prototyping* meliputi:
1. **Pengumpulan Kebutuhan (*Requirements Gathering*)**: Pengembang berinteraksi langsung dengan pemangku kepentingan (Ketua PAC, Sekretaris) untuk mengidentifikasi seluruh kebutuhan fitur (misalnya butuh form MAKESTA, bilik e-Voting, dll).
2. **Perancangan Cepat (*Quick Design*)**: Membuat desain antarmuka (*mockup*) awal yang berfokus pada alur presentasi sistem kepada pengguna.
3. **Membangun Prototipe (*Build Prototype*)**: Mengonversi desain sementara ke dalam program setengah jadi yang fungsionalitas utamanya dapat langsung diujicobakan.
4. **Evaluasi Pengguna (*User Evaluation*)**: Prototipe diserahkan kepada pengurus untuk dioperasikan. Pengurus akan mengevaluasi apakah sistem pendaftaran atau bilik *e-voting* sudah sesuai ekspektasi.
5. **Perbaikan Prototipe (*Refining Prototype*)**: Pengembang memperbaiki kode, menambah field database, atau mengubah desain UI berdasarkan *feedback* evaluasi. Siklus ini dapat berulang hingga prototipe dirasa sempurna.
6. **Implementasi Produk Final (*Engineer Product*)**: Prototipe yang telah disetujui diubah menjadi versi final yang lebih stabil (*production ready*) untuk dipublikasikan (*deployment*) ke domain utama.

---

## C. Pemodelan Sistem

**1. Unified Modeling Language (UML)**
UML (*Unified Modeling Language*) adalah bahasa standar pemodelan visual yang paling banyak digunakan di industri perangkat lunak untuk menspesifikasikan, merancang, memvisualisasikan, dan mendokumentasikan sistem berorientasi objek. Terdapat beberapa diagram UML utama yang umum digunakan dalam perancangan aplikasi:
*   **Use Case Diagram**: Menggambarkan secara visual *fungsionalitas* utama yang dapat dilakukan oleh sistem serta memetakan batas interaksi antara aktor (Pengunjung, Admin) dengan fungsi-fungsi (*use case*) di dalam sistem.
*   **Activity Diagram**: Menggambarkan aliran kerja operasional (*workflow*) dari sebuah aktivitas sistem secara prosedural, mulai dari titik awal (start) hingga titik akhir. Diagram ini memetakan kondisi keputusan (*decision*) dan pergerakan data dari satu entitas ke entitas lain, seperti alur pengajuan laporan pengunjung hingga divalidasi admin.
*   **Sequence Diagram**: Memvisualisasikan skenario interaksi sistem berupa pesan-pesan (*messages*) yang dipertukarkan antarentitas (objek/aktor) yang diurutkan berdasarkan urutan kejadian waktu.
*   **Class Diagram**: Menggambarkan struktur statis aplikasi dengan menjabarkan entitas kelas, atribut tipe datanya, serta fungsi (*methods*) yang menghubungkan kelas satu dengan kelas lainnya secara berelasi.

**2. Data Flow Diagram (DFD) & Entity Relationship Diagram (ERD)**
Sebagai pendamping UML untuk analisis berbasis terstruktur, sistem juga didokumentasikan menggunakan:
*   **DFD**: Memetakan aliran perpindahan data dari entitas eksternal masuk ke dalam modul proses, hingga berlabuh ke penyimpanan data (*data store*).
*   **ERD**: Memodelkan secara logis hubungan (kardinalitas) dan relasi kunci (*Primary Key - Foreign Key*) antartabel fisik dalam pangkalan data.

---

## D. Teknologi dan Perangkat Lunak

**1. Framework Laravel (Konsep MVC)**
Laravel adalah kerangka kerja (*framework*) pengembangan aplikasi web berbasis bahasa PHP yang elegan dan bertenaga. Laravel mengadopsi pola arsitektur **MVC** (*Model-View-Controller*):
*   **Model**: Menangani urusan pengolahan logika struktur *database* dan manipulasi kueri (menggunakan ORM Eloquent).
*   **View**: Menangani urusan lapisan presentasi dan antarmuka visual menggunakan *Blade Templating Engine*.
*   **Controller**: Menjembatani *request* yang masuk, menarik data dari *Model*, lalu meneruskannya ke *View*.

**2. SQLite**
SQLite adalah mesin *RDBMS (Relational Database Management System)* tanpa server (*serverless*). Berbeda dengan MySQL, SQLite menyimpan seluruh skema pangkalan data langsung dalam satu berkas (*file*) lokal tunggal di dalam folder proyek. Teknologi ini membuat arsitektur sistem berjalan lebih ringan dan hemat sumber daya untuk portal lalu lintas menengah.

**3. Tailwind CSS dan Bundler Vite**
Tailwind CSS adalah kerangka kerja CSS *utility-first* yang memungkinkan penyusunan antarmuka kustom secara amat cepat tanpa perlu menulis *file* CSS terpisah yang sangat panjang. Pemrosesan *Tailwind* dipacu menggunakan **Vite**, yaitu *build tool* (alat kompilasi web) generasi masa depan yang menghadirkan kecepatan muat ulang modul (*Hot Module Replacement*) secara kilat saat tahap pengembangan (HMR).

**4. Desain Antarmuka Glassmorphism**
*Glassmorphism* adalah tren estetika UI/UX kontemporer yang menonjolkan efek seperti kaca tembus pandang bertekstur buram (*frosted-glass*). Desain ini mengkombinasikan keburaman (*backdrop blur*), transparansi berlapis, batas (*border*) tipis putih, dan objek geometris berwarna cerah di latar belakang. Implementasi gaya ini menciptakan hierarki visual antarmuka portal informasi yang terasa lebih elegan, "hidup", modern, serta terlihat premium.

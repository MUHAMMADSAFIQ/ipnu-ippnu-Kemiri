# BAB V: KESIMPULAN DAN SARAN

## A. Kesimpulan
Berdasarkan hasil observasi, wawancara, perancangan, hingga implementasi Sistem Informasi Portal Web dan e-Voting pada PAC IPNU IPPNU Kecamatan Kemiri, dapat ditarik beberapa kesimpulan utama sebagai berikut:

1. **Digitalisasi Administrasi dan Kaderisasi (MAKESTA)**
   Sistem telah berhasil mengotomatisasi pendataan calon anggota baru melalui formulir registrasi daring terpusat. Dilengkapi dengan validasi keunikan alamat email (*unique validation*), sistem ini mampu memecahkan masalah redundansi (duplikasi) data anggota yang kerap terjadi pada pencatatan manual/konvensional, sehingga pangkalan data kader organisasi menjadi jauh lebih rapi dan valid.

2. **Efisiensi dan Keamanan Demokrasi Organisasi (e-Voting)**
   Fitur e-Voting terbukti menjadi solusi atas kendala lamanya proses rekapitulasi pada pemilihan ketua. Sistem bilik suara digital yang dirancang mampu memproses penghitungan suara secara *real-time*. Penerapan sistem keamanan validasi dan pencatatan *IP Address* pada *backend* secara efektif memblokir upaya kecurangan atau pemilihan ganda (*double voting*), menciptakan iklim pemilihan yang transparan, hemat biaya cetak, dan aman.

3. **Sentralisasi Informasi dan Pemberdayaan Ekonomi Kader**
   Portal web ini sukses menyajikan informasi resmi, berita kegiatan, dan profil kepengurusan secara dinamis, mengatasi masalah tenggelamnya informasi jika hanya bergantung pada *feed* media sosial. Selain itu, fitur "Lapak UMKM" mampu memfasilitasi kemandirian ekonomi organisasi dengan memberikan ruang promosi katalog produk-produk kader ke ranah publik secara luas, yang langsung terintegrasi dengan pemesanan via WhatsApp.

4. **Kinerja dan Modernisasi Antarmuka**
   Penggunaan teknologi *framework* modern yang dipadukan dengan desain *Glassmorphism* dan *Tailwind CSS* memberikan pengalaman pengguna (*User Experience*) yang sangat responsif, estetis, dan profesional saat diakses melalui *smartphone* maupun perangkat *desktop*. Basis data SQLite yang digunakan juga terbukti efisien dan ringan untuk mengelola beban sirkulasi data *website*.

---

## B. Saran
Meskipun sistem telah berjalan dengan baik dan menjawab permasalahan saat ini, terdapat beberapa ruang pengembangan untuk penyempurnaan sistem informasi di masa mendatang. Oleh karena itu, penulis mengajukan beberapa saran:

1. **Pengembangan Sistem Keamanan Otentikasi (Otorisasi Anggota)**
   Untuk fase berikutnya, khusus pada fitur e-Voting dan menu anggota, sistem keamanan dapat ditingkatkan dengan menerapkan metode *Multi-Factor Authentication* (MFA) atau integrasi *login* berbasis OTP (melalui WhatsApp/Email API). Hal ini akan memastikan hanya kader sah ber-NIA (Nomor Induk Anggota) yang bisa menyumbangkan hak pilihnya.

2. **Migrasi Skalabilitas Basis Data (*Database*)**
   Mengingat saat ini sistem masih menggunakan SQLite yang ditujukan untuk arsitektur ringan, disarankan agar di masa depan—ketika lalu lintas pengunjung meningkat pesat dan volume basis data *log voting*, pendaftaran MAKESTA, serta artikel membesar—sistem dimigrasikan ke sistem *RDBMS* berskala lebih masif, seperti MySQL atau PostgreSQL.

3. **Peningkatan Fitur Transaksi Lapak UMKM (E-Commerce Penuh)**
   Fitur katalog Lapak UMKM kader saat ini masih mengalihkan proses transaksi secara manual melalui WhatsApp. Ke depannya, sistem dapat diintegrasikan dengan *Payment Gateway* pihak ketiga (seperti Midtrans, Xendit, atau QRIS) sehingga alur pembayaran, konfirmasi pesanan, dan perhitungan ongkos kirim dapat diselesaikan secara otomatis langsung di dalam portal web.

4. **Regenerasi Operator dan Pemeliharaan (*Maintenance*) Rutin**
   Mengingat kepengurusan organisasi selalu berganti setiap periodenya, sangat disarankan untuk memberikan modul pelatihan atau *Standar Operasional Prosedur* (SOP) pengelolaan panel administrator kepada jajaran kesekretariatan. Hal ini penting untuk memastikan adanya pelestarian keahlian (*transfer of knowledge*), sehingga pencadangan (*backup*) basis data rutin dan pembaruan sistem dapat terus berlanjut di era kepengurusan selanjutnya.

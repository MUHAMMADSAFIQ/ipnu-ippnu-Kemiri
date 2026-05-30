<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default Admin User
        if (\App\Models\User::count() == 0) {
            \App\Models\User::create([
                'name' => 'Admin PAC Kemiri',
                'email' => 'admin@kemiri.org',
                'password' => \Illuminate\Support\Facades\Hash::make('kemiri2026'),
            ]);
        }

        // BPH / Susunan Pengurus Seed
        if (\App\Models\Official::where('type', 'bph')->count() == 0) {
            $this->call([
                OfficialSeeder::class,
            ]);
        }

        // Galleries / Dokumentasi Seed
        if (\App\Models\Gallery::count() == 0) {
            $galleries = [
                ['title' => 'Pelatihan Jurnalistik', 'category' => 'Kegiatan', 'image' => 'images/hero_bg.png'],
                ['title' => 'Juara 1 Lomba Hadroh', 'category' => 'Prestasi', 'image' => 'images/students_study.png'],
                ['title' => 'Konferensi Anak Cabang', 'category' => 'Konferensi', 'image' => 'images/alun_alun_kemiri.png'],
                ['title' => 'Makesta Raya', 'category' => 'Kegiatan', 'image' => 'images/hero_bg.png'],
                ['title' => 'Rapat Kerja PAC', 'category' => 'Konferensi', 'image' => 'images/students_study.png'],
                ['title' => 'Kunjungan Tokoh', 'category' => 'Lainnya', 'image' => 'images/alun_alun_kemiri.png'],
            ];
            foreach ($galleries as $g) {
                \App\Models\Gallery::create($g);
            }
        }

        // Site Settings / Profiles & Member Stats Seed
        $settings = [
            'total_anggota_ipnu'  => '31340',
            'total_anggota_ippnu' => '37197',

            // Susunan Pengurus - Masa Khidmat
            'structure_service_period' => 'Masa Khidmat 2025-2027',

            // Statistik Grid (Anak Cabang, Ranting, Komisariat)
            'stats_ipnu_ac'        => '482',
            'stats_ippnu_ac'       => '510',
            'stats_ipnu_ranting'   => '2,750',
            'stats_ippnu_ranting'  => '2,566',
            'stats_ipnu_sekolah'   => '880',
            'stats_ippnu_sekolah'  => '804',
            'stats_ipnu_pesantren' => '450',
            'stats_ippnu_pesantren'=> '420',

            // Pelayanan Sekretariat
            'sekre_weekday_days'  => 'Senin - Jumat',
            'sekre_weekday_hours' => '09:00 - 16:00',
            'sekre_sat_days'      => 'Sabtu',
            'sekre_sat_hours'     => '09:00 - 13:00',
            'sekre_sun_days'      => 'Minggu / Libur',
            'sekre_sun_hours'     => 'Sesuai Janji',

            // Profil sejarah, visi & misi
            'sejarah_ipnu_title' => 'Prof. Dr. KH. Tolchah Mansoer',
            'sejarah_ippnu_title' => 'Ny. Hj. Umroh Mahfudzah',
            
            'sejarah_ipnu' => "Ikatan Pelajar Nahdlatul Ulama (IPNU) didirikan pada tanggal 20 Jumadil Akhir 1373 H, bertepatan dengan 24 Februari 1954 M ketika diselenggarakan Kongres LP Ma'arif di Semarang. Sejak berdirinya, IPNU menjadi bagian dari LP Ma'arif. Namun pada tahun 1966 ketika diselenggarakan Kongres IPNU di Surabaya, IPNU resmi melepaskan diri dari LP Ma'arif dan menjadi badan otonom (banom) NU. Salah seorang pendiri IPNU adalah Prof. Dr. KH. Tolchah Mansyur.\n\nSejak berdirinya, IPNu merupakan kepanjangan dari Ikatan Pelajar Nahdlatul Ulama. Namun sejak tahun 1988, melalui kongresnya yang ke-10 di Jombang yang dikenal dengan istilah Deklarasi Jombang, kepanjangan IPNU berganti menjadi Ikatan Putera nahdlatul Ulama. Hal ini dikarenakan harus menyesuaikan diri dengan Undang-undang Nomor 8 Tahun 1985 tentang keormasan yang melarang adanya organisasi pelajar di sekolah selain OSIS.\n\nNamun setelah orde baru tumbang, di saat kebebasan berpendapat dan berekspresi dapat diperoleh dengan mudah, kepanjangan tersebut dikembalikan lagi seperti saat kelahirannya. Melalui kongresnya yang ke-14 di Surabaya (18-22 juni 2003), kepanjangan IPNU kembali seperti semula yaitu Ikatan Pelajar Nahdlatul Ulama.",
            
            'sejarah_ippnu' => "Sedangkan Ikatan Pelajar Putri Nahdlatul Ulama (IPPNU) didirikan pada tanggal 8 Rajab 1374 H bertepatan dengan tanggal 2 maret 1955 M di Solo Jawa Tengah. Salah seorang pendirinya adalah Ny. Umroh Mahfudzah. Sejak berdirinya, IPPNU bernaung di bawah LP Ma'arif. Namun sejak tahun 1966 melalui kongresnya di Surabaya, IPPNU berdiri sendiri sebagai salah satu badan otonom (banom) NU.\n\nSejak berdirinya, IPPNU merupakan kepanjangan dari Ikatan pelajar Putri Nahdlatul Ulama. Namun sejak tahun 1988, melalui kongresnya yang ke-9 di Jombang (29-31 januari 1988), kepanjangan IPPNU berganti menjadi Ikatan Putri-putri Nahdlatul Ulama. Hal ini dikarenakan harus menyesuaikan diri dengan Undang-undang Nomor 8 Tahun 1985 tentang keormasan yang melarang adanya organisasi pelajar di sekolah selain OSIS.\n\nNamun setelah Orde Baru tumbang, di saat kebebasan berpendapat dan berekspresi dapat diperoleh dengan mudah kepanjangan tersebut dikembalikan lagi seperti saat kelahirannya, melalui kongresnya yang ke-13 di Surabaya (18-22 Juni 2003), kepanjangan IPPNU kembali seperti semula yaitu Ikatan Pelajar Putri Nahdlatul Ulama.",
            
            'visi_ipnu' => "Terwujudnya pelajar-pelajar bangsa yang bertaqwa kepada Allah SWT, berahlakul karimah, menguasai ilmu pengetahuan dan teknologi, memiliki kesadaran dan tanggungjawab terhada tatanan masyarakat yang berkeadilan dan demokratis atas dasar ajaran Islam ahlusunnah wal jamaah.",
            
            'misi_ipnu' => "Mendorong para pelajar bangsa untuk taat (patuh) dalam menjalankan perintah dan menjauhi segala larangan yang termaktub dalam ajaran Islam.\nMembentuk karakter para pelajar bangsa yang santun dalam bertindak, jujur dalam berprilaku, jernih dan obyektif dalam berfikir, serta memiliki ide/gagasan yang inovatif.\nMendorong pemamfaatan dan pengembangan ilmu pengetahuan dan teknologi sebagai media pengembangan potensi dan peningkatan SDM belajar.\nMewujudkan kader pemimpin bangsa yang profesional, jujur dan bertanggung jawab yang dilandasi oleh spirit nilai ajaran Islam ahlusunnah wal jamaah.",
            
            'visi_ippnu' => "Terbentuknya kesempurnaan Pelajar Putri Indonesia yang bertakwa, berakhlaqul karimah, berilmu, dan berwawasan kebangsaan.",
            
            'misi_ippnu' => "Membangun kader NU yang berkualitas, berakhlaqul karimah, bersikap demokratis dalam kehidupan bermasyarakat, berbangsa dan bernegara.\nMengembangkan wacana dan kualitas sumber dya kader menuju terciptanya kesetaraan gender.\nMembentuk kader yang dinamis, kreatif, dan inovatif.",
            
            'visi_pac' => "Terwujudnya organisasi IPNU-IPPNU yang solid, bersinergi, dan progresif dalam membangun pelajar Nahdlatul Ulama yang berkualitas, berakhlakul karimah, berwawasan luas, serta mampu berkontribusi bagi agama, bangsa, dan masyarakat.",
            
            'misi_pac' => "Meningkatkan solidaritas dan sinergi antar pengurus serta anggota IPNU-IPPNU dalam menjalankan organisasi.\nMengembangkan kualitas pelajar NU melalui kegiatan pendidikan, keagamaan, dan pengembangan keterampilan.\nMenanamkan nilai-nilai Ahlussunnah wal Jama'ah An-Nahdliyah dalam kehidupan sehari-hari.\nMendorong budaya organisasi yang aktif, inovatif, dan progresif sesuai perkembangan zaman.\nMembentuk generasi pelajar NU yang berkarakter, bertanggung jawab, dan mampu menjadi teladan di lingkungan masyarakat.\nMemperkuat kerja sama dengan berbagai pihak demi mendukung kemajuan organisasi dan pengembangan potensi pelajar NU."
        ];

        foreach ($settings as $key => $val) {
            \App\Models\SiteSetting::firstOrCreate(['key' => $key], ['value' => $val]);
        }

        // Call any other default seeders
        if (\App\Models\Article::count() == 0) {
            $this->call([
                ArticleSeeder::class,
            ]);
        }
    }
}

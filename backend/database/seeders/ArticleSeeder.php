<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Tak Lagi Menunggu Daerah, Fasilitas Pelatihan Kader Ditransfer Langsung dari Pusat',
                'author' => 'DWINANTO',
                'views_count' => 924,
                'comments_count' => 11,
                'image' => 'images/students_study.png',
                'published_at' => Carbon::create(2026, 4, 16),
            ],
            [
                'title' => 'Pemerintah Buka 30 Ribu Kuota Beasiswa Merah Putih, Ini Syarat dan Link Pendaftarannya',
                'author' => 'DWINANTO',
                'views_count' => 51135,
                'comments_count' => 60,
                'image' => 'images/hero_bg.png',
                'published_at' => Carbon::create(2026, 4, 15),
            ],
            [
                'title' => 'Peluncuran Aplikasi Sipolgan untuk Pendataan Kader Digital se-Kecamatan Kemiri',
                'author' => 'MUSTANGIN',
                'views_count' => 1250,
                'comments_count' => 5,
                'image' => 'images/alun_alun_kemiri.png',
                'published_at' => Carbon::create(2026, 4, 14),
            ],
            [
                'title' => 'PAC IPNU IPPNU Kemiri Raih Penghargaan Organisasi Pelajar Terbaik Tingkat Kabupaten',
                'author' => 'ARIYANI',
                'views_count' => 3420,
                'comments_count' => 28,
                'image' => 'images/hero_bg.png',
                'published_at' => Carbon::create(2026, 4, 12),
            ],
            [
                'title' => 'Makrab dan Outbound: Mempererat Ukhuwah Kader antar Ranting di Wilayah Kemiri',
                'author' => 'DWINANTO',
                'views_count' => 850,
                'comments_count' => 12,
                'image' => 'images/students_study.png',
                'published_at' => Carbon::create(2026, 4, 10),
            ],
            [
                'title' => 'Seminar Literasi Digital: Melawan Hoaks dan Cyber Bullying di Kalangan Pelajar NU',
                'author' => 'MUSTANGIN',
                'views_count' => 2100,
                'comments_count' => 15,
                'image' => 'images/alun_alun_kemiri.png',
                'published_at' => Carbon::create(2026, 4, 8),
            ],
            [
                'title' => 'Pelatihan Desain Grafis Dasar untuk Pengurus Ranting',
                'author' => 'ADMIN',
                'views_count' => 450,
                'comments_count' => 3,
                'image' => 'images/students_study.png',
                'published_at' => Carbon::create(2026, 4, 5),
            ],
            [
                'title' => 'Rapat Kerja PAC IPNU IPPNU Kemiri Tahun 2026',
                'author' => 'DWINANTO',
                'views_count' => 670,
                'comments_count' => 8,
                'image' => 'images/hero_bg.png',
                'published_at' => Carbon::create(2026, 4, 2),
            ]
        ];

        foreach ($articles as $data) {
            Article::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']) . '-' . rand(100, 999),
                'content' => 'Konten artikel untuk ' . $data['title'] . '. Ini adalah konten dummy yang sementara mengisi bagian isi artikel.',
                'author' => $data['author'],
                'views_count' => $data['views_count'],
                'comments_count' => $data['comments_count'],
                'image' => $data['image'],
                'published_at' => $data['published_at'],
            ]);
        }
    }
}

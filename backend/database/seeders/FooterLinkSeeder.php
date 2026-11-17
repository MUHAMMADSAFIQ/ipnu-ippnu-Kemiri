<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FooterLink;

class FooterLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            ['title' => 'Beranda', 'url' => '/#beranda', 'order' => 1],
            ['title' => 'Profil & Sejarah', 'url' => '/profil/sejarah', 'order' => 2],
            ['title' => 'Agenda Kegiatan', 'url' => '/#agenda', 'order' => 3],
            ['title' => 'Berita Terbaru', 'url' => '/#berita', 'order' => 4],
            ['title' => 'Artikel Pelajar', 'url' => '/artikel', 'order' => 5],
            ['title' => 'Pusat Dokumen Resmi', 'url' => '/dokumen', 'order' => 6],
            ['title' => 'Galeri Foto', 'url' => '/galeri', 'order' => 7],
            ['title' => 'Digital Library', 'url' => '/library', 'order' => 8],
            ['title' => 'Polling Pemilu', 'url' => '/voting', 'order' => 9],
        ];

        foreach ($links as $link) {
            FooterLink::updateOrCreate(
                ['title' => $link['title']],
                [
                    'url' => $link['url'],
                    'target' => '_self',
                    'order' => $link['order'],
                    'is_active' => true,
                ]
            );
        }
    }
}


<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $docs = [
            [
                'title' => 'PD & PRT IPNU (Hasil Kongres Terbaru)',
                'desc' => 'Peraturan Dasar dan Peraturan Rumah Tangga Ikatan Pelajar Nahdlatul Ulama sebagai pedoman konstitusi organisasi tertinggi.',
                'category' => 'regulasi',
                'cat_label' => 'PD/PRT & PO',
                'file_type' => 'PDF',
                'file_size' => '2.4 MB',
                'icon' => 'fa-file-pdf',
                'color' => '#dc2626'
            ],
            [
                'title' => 'PD & PRT IPPNU (Hasil Kongres Terbaru)',
                'desc' => 'Peraturan Dasar dan Peraturan Rumah Tangga Ikatan Pelajar Putri Nahdlatul Ulama lengkap dengan aturan keanggotaan dan kepengurusan.',
                'category' => 'regulasi',
                'cat_label' => 'PD/PRT & PO',
                'file_type' => 'PDF',
                'file_size' => '2.1 MB',
                'icon' => 'fa-file-pdf',
                'color' => '#dc2626'
            ],
            [
                'title' => 'Modul Panduan MAKESTA (Masa Kesetiaan Anggota)',
                'desc' => 'Buku pedoman penyelenggaraan pengkaderan dasar MAKESTA tingkat Ranting & Komisariat, memuat materi Ke-NU-an, Aswaja, dan Ke-IPNU-an.',
                'category' => 'kaderisasi',
                'cat_label' => 'Kaderisasi',
                'file_type' => 'PDF',
                'file_size' => '4.8 MB',
                'icon' => 'fa-file-pdf',
                'color' => '#16a34a'
            ],
            [
                'title' => 'Pedoman Pelaksanaan CBP & KPP PAC Kemiri',
                'desc' => 'Petunjuk teknis dan operasional Corps Brigade Pembangunan dan Korp Pelajar Putri dalam kepanduan, kedisiplinan, dan tanggap kebencanaan.',
                'category' => 'kaderisasi',
                'cat_label' => 'Kaderisasi',
                'file_type' => 'PDF',
                'file_size' => '3.2 MB',
                'icon' => 'fa-file-pdf',
                'color' => '#16a34a'
            ],
            [
                'title' => 'Format Baku Surat Menyurat & Kop PAC IPNU Kemiri',
                'desc' => 'Template resmi Microsoft Word (.docx) nomor surat, kop surat, tata bahasa persuratan, dan penomoran berkas sesuai POA.',
                'category' => 'administrasi',
                'cat_label' => 'Administrasi',
                'file_type' => 'DOCX',
                'file_size' => '850 KB',
                'icon' => 'fa-file-word',
                'color' => '#2563eb'
            ],
            [
                'title' => 'Format Baku Surat Menyurat & Kop PAC IPPNU Kemiri',
                'desc' => 'Template resmi Microsoft Word (.docx) persuratan IPPNU untuk tingkat Ranting dan Komisariat se-Kecamatan Kemiri.',
                'category' => 'administrasi',
                'cat_label' => 'Administrasi',
                'file_type' => 'DOCX',
                'file_size' => '820 KB',
                'icon' => 'fa-file-word',
                'color' => '#2563eb'
            ],
            [
                'title' => 'Formulir Permohonan Pengesahan / Rekomendasi SK Ranting',
                'desc' => 'Berkas lampiran hasil Rapat Anggota, susunan pengurus terpilih, dan berita acara pemilihan untuk pengajuan SK PAC ke PC Purworejo.',
                'category' => 'administrasi',
                'cat_label' => 'Administrasi',
                'file_type' => 'DOCX',
                'file_size' => '640 KB',
                'icon' => 'fa-file-word',
                'color' => '#2563eb'
            ],
            [
                'title' => 'Proposal Baku Kegiatan Kaderisasi & Pelatihan',
                'desc' => 'Draft template proposal sponsorship, rincian anggaran biaya (RAB), jadwal acara, dan lembar pengesahan kegiatan.',
                'category' => 'administrasi',
                'cat_label' => 'Administrasi',
                'file_type' => 'DOCX',
                'file_size' => '1.1 MB',
                'icon' => 'fa-file-word',
                'color' => '#2563eb'
            ],
            [
                'title' => 'Lirik & Notasi Audio Mars IPNU & Mars IPPNU',
                'desc' => 'Partitur, teks resmi lirik lagu perjuangan Pelajar NU beserta panduan tempo dan audio instrumental berkualitas tinggi.',
                'category' => 'regulasi',
                'cat_label' => 'Lagu & Mars',
                'file_type' => 'ZIP',
                'file_size' => '8.6 MB',
                'icon' => 'fa-file-zipper',
                'color' => '#d97706'
            ]
        ];

        foreach ($docs as $d) {
            Document::updateOrCreate(['title' => $d['title']], $d);
        }
    }
}


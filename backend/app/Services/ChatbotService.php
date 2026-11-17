<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Agenda;
use App\Models\Program;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ChatbotService
{
    /**
     * Generate an intelligent AI reply based on user message.
     * Uses Google Gemini Free API when configured, otherwise falls back to local knowledge base.
     */
    public function reply(string $message): string
    {
        $cleanMsg = trim($message);
        if (empty($cleanMsg)) {
            return "Halo Rekan/Rekanita! Ada yang bisa saya bantu terkait informasi PAC IPNU IPPNU Kemiri? Silakan ketik pertanyaan Anda. 🙏";
        }

        $lower = strtolower($cleanMsg);

        // Check if external Gemini API key is configured (.env or database site_settings)
        $apiKey = config('services.gemini.api_key') 
            ?: env('GEMINI_API_KEY') 
            ?: SiteSetting::where('key', 'gemini_api_key')->value('value');

        $model = SiteSetting::where('key', 'gemini_model')->value('value') 
            ?: config('services.gemini.model') 
            ?: env('GEMINI_MODEL', 'gemini-1.5-flash');

        if (!empty($apiKey)) {
            try {
                $geminiReply = $this->queryGemini($cleanMsg, trim($apiKey), trim($model));
                if (!empty($geminiReply)) {
                    return $geminiReply;
                }
            } catch (\Exception $e) {
                Log::warning('Gemini API Query Failed: ' . $e->getMessage());
                // Fall back gracefully to local knowledge base
            }
        }

        return $this->localKnowledgeReply($lower);
    }

    /**
     * Query Google Gemini API with system instructions and real database context.
     */
    public function queryGemini(string $prompt, string $apiKey, string $model = 'gemini-1.5-flash'): ?string
    {
        $systemInstruction = $this->buildSystemInstruction();

        // Primary model URL
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key=" . $apiKey;

        $payload = [
            'system_instruction' => [
                'parts' => [
                    ['text' => $systemInstruction]
                ]
            ],
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature'     => 0.7,
                'topK'            => 40,
                'topP'            => 0.95,
                'maxOutputTokens' => 1024,
            ]
        ];

        try {
            $response = Http::timeout(12)->post($url, $payload);

            // If selected model is not supported (404/not found), try standard fallback model
            if (!$response->successful() && $model !== 'gemini-1.5-flash') {
                $fallbackUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;
                $response = Http::timeout(12)->post($fallbackUrl, $payload);
            }

            if ($response->successful()) {
                $data = $response->json();
                $rawText = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                if (!empty($rawText)) {
                    return $this->formatMarkdownReply($rawText);
                }
            } else {
                Log::warning('Gemini API responded with status ' . $response->status() . ': ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Gemini Request Exception: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Test Gemini API Connection and return diagnostic status.
     */
    public function testGeminiConnection(?string $apiKey = null, ?string $model = null): array
    {
        $key = $apiKey 
            ?: config('services.gemini.api_key') 
            ?: env('GEMINI_API_KEY') 
            ?: SiteSetting::where('key', 'gemini_api_key')->value('value');

        if (empty($key)) {
            return [
                'success' => false,
                'message' => 'API Key Gemini belum diisi. Masukkan API Key di bawah atau di file .env.'
            ];
        }

        $chosenModel = $model 
            ?: SiteSetting::where('key', 'gemini_model')->value('value') 
            ?: 'gemini-1.5-flash';

        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$chosenModel}:generateContent?key=" . trim($key);

        try {
            $response = Http::timeout(10)->post($url, [
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => 'Halo! Jawab hanya dengan: "Koneksi Gemini API Berhasil Aktif!"']
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Koneksi Berhasil';
                return [
                    'success' => true,
                    'model'   => $chosenModel,
                    'message' => trim($reply)
                ];
            }

            $error = $response->json()['error']['message'] ?? ('HTTP Error ' . $response->status());
            return [
                'success' => false,
                'message' => 'Gagal terhubung ke Gemini: ' . $error
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Koneksi timeout atau gagal: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Format Markdown returned by Gemini into safe, styled HTML for chat bubbles.
     */
    protected function formatMarkdownReply(string $markdown): string
    {
        $html = Str::markdown($markdown);
        // Clean up excessive paragraph margins
        $html = str_replace('<p>', '<p style="margin: 0 0 8px 0; line-height: 1.55;">', $html);
        $html = str_replace('<ul>', '<ul style="margin: 6px 0 10px 18px; padding: 0;">', $html);
        $html = str_replace('<ol>', '<ol style="margin: 6px 0 10px 18px; padding: 0;">', $html);
        $html = str_replace('<li>', '<li style="margin-bottom: 4px;">', $html);
        $html = str_replace('<a href=', '<a target="_blank" style="color: #15803d; font-weight: 700; text-decoration: underline;" href=', $html);
        return trim($html);
    }

    /**
     * Dynamically build system instructions with live database facts.
     */
    protected function buildSystemInstruction(): string
    {
        // 1. Fetch live settings
        $settings = SiteSetting::pluck('value', 'key')->toArray();
        $orgName = $settings['org_name'] ?? 'PAC IPNU IPPNU Kemiri';
        $email = $settings['email'] ?? 'admin@ipnukemiri.or.id';
        $wa = $settings['whatsapp'] ?? '+62 812-3456-7890';
        $address = $settings['address'] ?? 'Kompleks Gedung MWC NU Kemiri, Jl. Raya Kemiri - Pituruh, Kec. Kemiri, Kab. Purworejo, Jawa Tengah';

        // 2. Fetch upcoming agendas
        $agendas = Agenda::where('date', '>=', date('Y-m-d'))
            ->orderBy('date', 'asc')
            ->take(4)
            ->get();
        $agendaContext = "";
        if ($agendas->count() > 0) {
            foreach ($agendas as $ag) {
                $agendaContext .= "- {$ag->title} (Tanggal: " . date('d M Y', strtotime($ag->date)) . ", Lokasi: {$ag->location})\n";
            }
        } else {
            $agendaContext = "- Tidak ada agenda terdekat saat ini.\n";
        }

        // 3. Fetch latest articles
        $articles = Article::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();
        $articleContext = "";
        if ($articles->count() > 0) {
            foreach ($articles as $art) {
                $articleContext .= "- {$art->title} (URL: /artikel/{$art->slug})\n";
            }
        }

        return <<<INSTRUCTION
Kamu adalah "Asisten AI Resmi Pelajar NU Kemiri" yang terintegrasi di Portal Web {$orgName}.

INFORMASI DASAR ORGANISASI:
- Nama Organisasi: {$orgName} (Pimpinan Anak Cabang Ikatan Pelajar Nahdlatul Ulama & Ikatan Pelajar Putri Nahdlatul Ulama Kecamatan Kemiri, Kabupaten Purworejo, Jawa Tengah).
- Semboyan/Motto: "Belajar, Berjuang, Bertaqwa".
- Asas & Landasan: Berakidah Islam Ahlussunnah wal Jama'ah An-Nahdliyyah (Aswaja).
- Alamat Sekretariat: {$address}.
- Kontak Resmi: WhatsApp {$wa}, Email {$email}.
- Jam Buka Sekretariat: Senin - Jumat (09:00 - 16:00 WIB), Sabtu (09:00 - 13:00 WIB).

KADERISASI & KEANGGOTAAN:
- Jenjang kaderisasi awal adalah MAKESTA (Masa Kesetiaan Anggota).
- Syarat: Pelajar, santri, mahasiswa/pemuda usia 12-27 tahun yang berdomisili atau sekolah di Kecamatan Kemiri.
- Pendaftaran anggota dapat dilakukan secara online melalui tombol "Gabung Sekarang" di beranda website.

FITUR-FITUR PORTAL KEMIRI:
- Kirim Berita Ranting (/artikel/kirim): Fasilitas pengurus ranting/komisariat mengirim naskah berita kegiatan untuk dipublikasikan secara resmi.
- Pusat Dokumen (/dokumen): Mengunduh PD/PRT, pedoman administrasi persuratan, dan modul kaderisasi.
- Digital Library (/library): Membaca kitab Risalah Aswaja, modul kaderisasi, dan buku santri gratis.
- E-Voting (/voting): Sistem pemilihan ketua secara demokratis dan digital.
- Galeri Foto (/galeri): Dokumentasi ribuan foto kegiatan pelajar NU Kemiri.
- Lapak Pelajar (/info/usaha): Etalase produk karya kader dan merchandise NU.
- Kritik & Saran (/kontak): Ruang pengaduan dan aspirasi masyarakat.

AGENDA TERDEKAT DI DATABASE:
{$agendaContext}

BERITA TERBARU DI DATABASE:
{$articleContext}

PANDUAN GAYA BICARA & RESPON:
1. Sapa pengunjung dengan ramah, hangat, dan santun khas santri/pelajar Nahdlatul Ulama.
2. Gunakan sapaan "Rekan" (untuk putra) atau "Rekanita" (untuk putri), atau "Rekan-Rekanita".
3. Berikan jawaban yang cerdas, padat, jelas, ramah, dan solutif.
4. Jika ditanya tentang agama atau ke-NU-an, jawab sesuai ajaran Ahlussunnah wal Jama'ah (toleran, santun, moderat/tawasuth, tawazun, tasamuh).
5. Jika ditanya informasi umum di luar organisasi, tetap bantu jawab dengan sopan dan bermanfaat.
6. Berikan tautan/link halaman portal yang relevan jika sesuai (misal: /artikel/kirim, /dokumen, /voting, /proker, /kontak).
INSTRUCTION;
    }

    /**
     * Intelligent local knowledge base of PAC IPNU IPPNU Kemiri (Offline fallback).
     */
    protected function localKnowledgeReply(string $lower): string
    {
        // 1. Salam & Sapaan
        if (Str::contains($lower, ['assalamu', 'assalam', 'samlikum', 'halo', 'hai', 'hi', 'selamat pagi', 'selamat siang', 'selamat sore', 'selamat malam', 'ping', 'tes', 'test'])) {
            return "Wa'alaikumsalam Warahmatullahi Wabarakatuh! 🙏<br><br>Selamat datang di <strong>Portal Resmi PAC IPNU IPPNU Kemiri</strong>. Saya adalah Asisten AI yang siap membantu Rekan dan Rekanita. Anda dapat menanyakan tentang pendaftaran anggota (Makesta), agenda kegiatan, alamat kantor sekretariat, visi-misi, maupun berita terkini.";
        }

        // 2. Makesta / Pendaftaran / Gabung
        if (Str::contains($lower, ['gabung', 'daftar', 'makesta', 'masuk ipnu', 'anggota baru', 'syarat', 'cara ikut'])) {
            return "<strong>Tertarik bergabung dengan IPNU-IPPNU Kemiri?</strong> Sangat disambut hangat! 🌿<br><br>" .
                   "<strong>Syarat Pendaftaran:</strong><br>" .
                   "1. Pelajar, santri, atau mahasiswa/pemuda berusia 12 - 27 tahun.<br>" .
                   "2. Berdomisili atau menempuh pendidikan di wilayah Kecamatan Kemiri.<br>" .
                   "3. Berakidah Islam Ahlussunnah wal Jama'ah an-Nahdliyyah.<br>" .
                   "4. Mengikuti jenjang kaderisasi pertama yaitu <strong>MAKESTA (Masa Kesetiaan Anggota)</strong>.<br><br>" .
                   "👉 Anda dapat mendaftar langsung secara online melalui tombol <strong>'Gabung Sekarang'</strong> di halaman utama portal!";
        }

        // 3. Visi, Misi & Motto
        if (Str::contains($lower, ['visi', 'misi', 'tujuan', 'motto', 'semboyan', 'belajar berjuang'])) {
            return "<strong>Motto IPNU-IPPNU:</strong><br>" .
                   "<em>'Belajar, Berjuang, Bertaqwa'</em> ✊<br><br>" .
                   "<strong>Visi PAC IPNU IPPNU Kemiri:</strong><br>" .
                   "Mewujudkan generasi pelajar Nahdlatul Ulama yang berakhlakul karimah, berakar teguh pada amaliyah Ahlussunnah wal Jama'ah, unggul secara intelektual, melek digital, dan mandiri secara kepemimpinan di era modern.";
        }

        // 4. Struktur / Pimpinan / Ketua / Nahkoda
        if (Str::contains($lower, ['ketua', 'nahkoda', 'pimpinan', 'pengurus', 'struktur', 'bph', 'wakil'])) {
            return "<strong>Struktur Pimpinan PAC IPNU IPPNU Kemiri:</strong><br><br>" .
                   "Kepengurusan PAC Kemiri terdiri dari:<br>" .
                   "&bull; <strong>Pimpinan Anak Cabang IPNU</strong> (Pelajar Putra)<br>" .
                   "&bull; <strong>Pimpinan Anak Cabang IPPNU</strong> (Pelajar Putri)<br>" .
                   "Dibantu oleh Badan Pengurus Harian (BPH), Lembaga Pers & Media, CBP-KPP, Lembaga Dakwah, serta divisi pengkaderan.<br><br>" .
                   "Untuk melihat profil lengkap dan foto pimpinan, silakan kunjungi menu <strong>Profil &rarr; Nahkoda PAC</strong> atau <a href='/struktur/bph' style='color:#15803d;font-weight:700;'>Struktur Pengurus BPH</a>.";
        }

        // 5. Lokasi / Alamat Sekretariat / Peta
        if (Str::contains($lower, ['alamat', 'lokasi', 'kantor', 'sekretariat', 'tempat', 'dimana', 'peta', 'google maps'])) {
            return "📍 <strong>Lokasi Sekretariat Bersama PAC IPNU IPPNU Kemiri:</strong><br><br>" .
                   "<strong>Kompleks Gedung MWC NU Kemiri</strong><br>" .
                   "Jl. Raya Kemiri - Pituruh, Kemiri, Kec. Kemiri, Kabupaten Purworejo, Jawa Tengah 54262.<br><br>" .
                   "🕒 <strong>Jam Pelayanan:</strong><br>" .
                   "&bull; Senin - Jumat: 09:00 - 16:00 WIB<br>" .
                   "&bull; Sabtu: 09:00 - 13:00 WIB<br><br>" .
                   "Peta interaktif dan panduan rute dapat Anda lihat di bagian paling bawah halaman utama portal!";
        }

        // 6. Jadwal Sholat / Imsakiyah / Berbuka
        if (Str::contains($lower, ['sholat', 'shalat', 'imsak', 'subuh', 'maghrib', 'buka puasa', 'dzuhur', 'ashar', 'isya', 'waktu shalat'])) {
            return "🕌 <strong>Jadwal Imsak, Shalat & Berbuka:</strong><br><br>" .
                   "Jadwal sholat otomatis untuk wilayah <strong>Kecamatan Kemiri & Kabupaten Purworejo</strong> selalu diperbarui secara real-time pada widget <em>Jadwal Imsak, Shalat & Berbuka</em> di halaman utama portal resmi.<br><br>" .
                   "Silakan cek halaman depan untuk mengetahui sisa waktu countdown menuju waktu sholat berikutnya!";
        }

        // 7. Agenda & Program Kerja
        if (Str::contains($lower, ['agenda', 'kegiatan', 'acara', 'proker', 'program kerja', 'event'])) {
            $agendas = Agenda::where('date', '>=', date('Y-m-d'))->orderBy('date', 'asc')->take(3)->get();

            $res = "📅 <strong>Agenda Terdekat PAC IPNU IPPNU Kemiri:</strong><br><br>";
            if ($agendas->count() > 0) {
                foreach ($agendas as $a) {
                    $res .= "&bull; <strong>{$a->title}</strong> (" . date('d M Y', strtotime($a->date)) . ") - Lokasi: {$a->location}<br>";
                }
            } else {
                $res .= "Saat ini agenda resmi sedang dipersiapkan oleh sekretariat.<br>";
            }

            $res .= "<br>Anda juga dapat melihat daftar program kerja strategis lengkap di halaman <a href='/proker' style='color:#15803d;font-weight:700;'>Program Kerja Unggulan</a>.";
            return $res;
        }

        // 8. Berita / Artikel
        if (Str::contains($lower, ['berita', 'artikel', 'kabar', 'rilis', 'tulisan', 'update'])) {
            $latest = Article::where('status', 'published')->orderBy('published_at', 'desc')->take(3)->get();
            $res = "📰 <strong>Berita Terkini PAC IPNU IPPNU Kemiri:</strong><br><br>";
            if ($latest->count() > 0) {
                foreach ($latest as $art) {
                    $res .= "&bull; <a href='/artikel/{$art->slug}' style='color:#15803d;font-weight:700;'>{$art->title}</a><br>";
                }
            } else {
                $res .= "Belum ada berita yang diterbitkan.<br>";
            }
            $res .= "<br>Jelajahi seluruh arsip berita di menu <a href='/artikel' style='color:#15803d;font-weight:700;'>Arsip Berita & Artikel</a>.";
            return $res;
        }

        // 9. Galeri Dokumentasi Foto
        if (Str::contains($lower, ['galeri', 'foto', 'dokumentasi', 'gambar', 'potret'])) {
            return "📸 <strong>Galeri Foto Kegiatan:</strong><br><br>" .
                   "Seluruh dokumentasi kegiatan kaderisasi, bakti sosial, peringatan hari besar, dan konferensi PAC IPNU IPPNU Kemiri dapat Anda akses tanpa batas di halaman <a href='/galeri' style='color:#15803d;font-weight:700;'>Galeri Foto Unlimited</a>.";
        }

        // 10. Dokumen & Library
        if (Str::contains($lower, ['dokumen', 'download', 'buku', 'kitab', 'library', 'modul', 'proposal', 'surat', 'pd prt'])) {
            return "📚 <strong>Pusat Dokumen & Digital Library:</strong><br><br>" .
                   "Kami menyediakan akses berkas resmi untuk kemudahan kader:<br>" .
                   "&bull; <a href='/dokumen' style='color:#15803d;font-weight:700;'>Pusat Dokumen</a>: PD/PRT, pedoman administrasi surat, modul Makesta, dan proposal.<br>" .
                   "&bull; <a href='/library' style='color:#15803d;font-weight:700;'>IPNU-IPPNU Digital Library</a>: Kitab Risalah Aswaja, biografi KH. Tolchah Mansoer, fiqih remaja, dan e-book santri.";
        }

        // 11. Kirim Berita Ranting
        if (Str::contains($lower, ['kirim berita', 'tulis berita', 'redaksi', 'rilis', 'berita ranting', 'kirim tulisan'])) {
            return "✍️ <strong>Ruang Redaksi Pelajar (Kirim Berita):</strong><br><br>" .
                   "Pengurus Ranting atau Komisariat dapat mengirimkan rilis kegiatan dan tulisan melalui formulir resmi di halaman <a href='/artikel/kirim' style='color:#15803d;font-weight:700;'>Kirim Berita Ranting</a>. Sertakan foto dokumentasi asli tanpa batasan ukuran MB!";
        }

        // 12. Lapak Pelajar / Usaha
        if (Str::contains($lower, ['lapak', 'usaha', 'produk', 'jual', 'beli', 'kaos', 'merchandise', 'ekonomi'])) {
            return "🛍️ <strong>Lapak Pelajar IPNU-IPPNU Kemiri:</strong><br><br>" .
                   "Dukung kemandirian ekonomi kader! Kunjungi etalase resmi produk kaos santri, peci, pin organisasi, dan karya UMKM pelajar di menu <a href='/info/usaha' style='color:#15803d;font-weight:700;'>Lapak Pelajar</a>.";
        }

        // 13. Kontak & Ruang Lapor
        if (Str::contains($lower, ['kontak', 'whatsapp', 'nomor wa', 'hubungi', 'telepon', 'lapor', 'kritik', 'saran', 'aduan'])) {
            return "📞 <strong>Layanan Kontak & Aspirasi:</strong><br><br>" .
                   "&bull; WhatsApp Center: <strong>+62 812-3456-7890</strong><br>" .
                   "&bull; Email Resmi: <strong>admin@ipnukemiri.or.id</strong><br>" .
                   "&bull; Form Aduan Online: Sampaikan aspirasi Anda di <a href='/kontak' style='color:#15803d;font-weight:700;'>Ruang Lapor & Aspirasi</a>.";
        }

        // 14. E-Voting
        if (Str::contains($lower, ['voting', 'vote', 'pemilihan', 'ketua pac', 'suara', 'kandidat'])) {
            return "🗳️ <strong>Sistem E-Voting Demokrasi Pelajar:</strong><br><br>" .
                   "PAC IPNU IPPNU Kemiri menerapkan pemilihan ketua berbasis digital yang transparan dan akuntabel. Akses bilik suara digital di menu <a href='/voting' style='color:#15803d;font-weight:700;'>E-Voting Pemilihan</a>.";
        }

        // Default intelligent fallback
        return "Terima kasih atas pertanyaan Rekan/Rekanita. 🙏<br><br>" .
               "Sebagai Asisten AI PAC IPNU IPPNU Kemiri, saya siap membantu memberikan informasi seputar:<br>" .
               "&bull; <strong>Pendaftaran Anggota (Makesta)</strong> &bull; <strong>Alamat Kantor Sekretariat</strong><br>" .
               "&bull; <strong>Struktur Pengurus & Visi Misi</strong> &bull; <strong>Agenda Kegiatan & Berita</strong><br>" .
               "&bull; <strong>Kirim Berita Ranting</strong> &bull; <strong>Pusat Dokumen & Perpustakaan Digital</strong><br>" .
               "&bull; <strong>Jadwal Sholat & Imsakiyah</strong> &bull; <strong>Lapak Pelajar & Kontak Organisasi</strong><br><br>" .
               "Silakan ketik pertanyaan spesifik Anda di atas!";
    }
}

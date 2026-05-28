<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Official::where('type', 'bph')->delete();

        $ippnuData = [
            ['section' => 'Pelindung', 'positions' => [
                'Pelindung' => ['Yth. PC NU Purworejo', 'Yth. MWC NU Kemiri']
            ]],
            ['section' => 'Dewan Pembina', 'positions' => [
                'Dewan Pembina' => [
                    'Bp. Kyai M. Rosyidi (Rois Syuriyah MWC NU Kec. Kemiri)',
                    'Bp. Kyai Afif Jaelani (Tanfidziyah MWC NU Kec. Kemiri)',
                    'Ibu Ny. Hj Waqingah (Muslimat NU Kec.Kemiri)',
                    'Ibu Istiqomah (Fatayat NU Kec. Kemiri)'
                ]
            ]],
            ['section' => 'Pengurus Harian', 'positions' => [
                'Ketua' => ['Wiji Masruroh'],
                'Wakil Ketua I' => ['Dewi Alha'],
                'Wakil Ketua II' => ['Nurul Insani'],
                'Wakil Ketua III' => ['Ulumil Isti\'fa\''],
                'Wakil Ketua IV' => ['Masayu Setya Dini'],
                'Wakil Ketua V' => ['Debi Saktiyani'],
                'Wakil Ketua VI' => ['Kharisma Setya Wardani'],
                'Sekretaris' => ['Erliana Ayu Solichah'],
                'Wakil sekretaris' => ['Kenken Intan Sesilia'],
                'Bendahara' => ['Riyadlu \'Ilmi'],
                'Wakil Bendahara' => ['Dhahiru Laila Muthi\'ah']
            ]],
            ['section' => 'Departemen Kaderisasi', 'positions' => [
                'Koordinator' => ['Nuriyana Alkhumairo'],
                'Anggota' => ['Ulul Azmiah', 'Desna Deviana', 'Zunita Setyowati', 'Fitri Eka Wati', 'Elviana Nur Kholifah', 'Anggita Sari', 'Diah Fitriyani', 'Vica Uliya Rahmawati', 'Erna Wahyuningsih', 'Leli Dwi Jayanti']
            ]],
            ['section' => 'Departemen Jaringan Sekolah dan Pesantren', 'positions' => [
                'Koordinator' => ['Eka Ratnasari'],
                'Anggota' => ['Ifta Alfu Sa\'diyyah', 'Dewi Setyaningsih', 'Putri Alifah', 'Anifatul Qoriah', 'Eka Cahyati', 'Zelfa Septia Cahyani', 'Isna Nur Asyifa', 'Kholifatul Jannah', 'Naila Azka', 'Wafiatul Aida', 'Umi Masfufah']
            ]],
            ['section' => 'Lembaga Korp Pelajar Putri', 'positions' => [
                'Komandan' => ['Veti Fatimah'],
                'Anggota' => ['Fitriyani', 'Umu Ma\'rifah', 'Nasywa Alisia Azzahra', 'Ana Maulida', 'Dini Noviyani', 'Syaikhah Adawiyaturrosyidah']
            ]]
        ];

        foreach ($ippnuData as $group) {
            foreach ($group['positions'] as $position => $names) {
                foreach ($names as $name) {
                    \App\Models\Official::create([
                        'organization' => 'IPPNU',
                        'section' => $group['section'],
                        'type' => 'bph',
                        'position' => $position,
                        'name' => $name
                    ]);
                }
            }
        }
        
        $ipnuData = [
            ['section' => 'Pelindung', 'positions' => [
                'Pelindung' => ['Yth. PC NU Purworejo', 'Yth. MWC NU Kemiri']
            ]],
            ['section' => 'Dewan Pembina', 'positions' => [
                'Dewan Pembina' => [
                    'Bp. Kyai M. Rosyidi',
                    'Bp. Kyai Afif Jaelani'
                ]
            ]],
            ['section' => 'Pengurus Harian', 'positions' => [
                'Ketua' => ['Ahmad Fauzi'],
                'Wakil Ketua I' => ['Budi Santoso'],
                'Sekretaris' => ['Candra Hidayat'],
                'Bendahara' => ['Dedi Kurniawan']
            ]]
        ];

        foreach ($ipnuData as $group) {
            foreach ($group['positions'] as $position => $names) {
                foreach ($names as $name) {
                    \App\Models\Official::create([
                        'organization' => 'IPNU',
                        'section' => $group['section'],
                        'type' => 'bph',
                        'position' => $position,
                        'name' => $name
                    ]);
                }
            }
        }
    }
}

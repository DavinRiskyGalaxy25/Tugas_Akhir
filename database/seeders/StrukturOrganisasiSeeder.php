<?php

namespace Database\Seeders;

use App\Models\StrukturOrganisasi;
use Illuminate\Database\Seeder;

class StrukturOrganisasiSeeder extends Seeder
{
    public function run(): void
    {
        $pejabat = [
            [
                'nama' => 'KH. Drs. M. Sudi Khotib, MM.',
                'jabatan' => 'KEPALA SEKOLAH',
                'kategori' => 'kepala_sekolah',
                'keterangan' => 'Abah Sudi',
                'foto' => null,
                'urutan' => 1,
                'status_aktif' => true,
            ],
            [
                'nama' => 'Aat Choiruddin, S.Pd.I.',
                'jabatan' => 'WAKA KURIKULUM 1',
                'kategori' => 'waka',
                'keterangan' => 'Wakil Kepala Bidang Kurikulum',
                'foto' => null,
                'urutan' => 2,
                'status_aktif' => true,
            ],
            [
                'nama' => 'M. Fauzi, S.Pd.',
                'jabatan' => 'WAKA KESISWAAN',
                'kategori' => 'waka',
                'keterangan' => 'Wakil Kepala Bidang Kesiswaan',
                'foto' => null,
                'urutan' => 3,
                'status_aktif' => true,
            ],
            [
                'nama' => 'Siti Nurhaliza, S.E.',
                'jabatan' => 'KEPALA TATA USAHA',
                'kategori' => 'staf',
                'keterangan' => 'Administrasi & Tata Usaha',
                'foto' => null,
                'urutan' => 4,
                'status_aktif' => true,
            ],
        ];

        foreach ($pejabat as $item) {
            StrukturOrganisasi::firstOrCreate(['nama' => $item['nama'], 'jabatan' => $item['jabatan']], $item);
        }
    }
}


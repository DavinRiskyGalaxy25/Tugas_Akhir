<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Budi Santoso', 'jabatan' => 'Kepala Sekolah', 'mata_pelajaran' => null, 'foto' => null],
            ['nama' => 'Siti Aminah', 'jabatan' => 'Wakil Kepala Sekolah', 'mata_pelajaran' => 'Bahasa Indonesia', 'foto' => null],
            ['nama' => 'Ahmad Fauzi', 'jabatan' => 'Guru', 'mata_pelajaran' => 'Matematika', 'foto' => null],
            ['nama' => 'Dewi Lestari', 'jabatan' => 'Guru', 'mata_pelajaran' => 'IPA', 'foto' => null],
            ['nama' => 'Rudi Hartono', 'jabatan' => 'Guru', 'mata_pelajaran' => 'Pendidikan Jasmani', 'foto' => null],
        ];

        foreach ($data as $i => $row) {
            Guru::updateOrCreate(
                ['nama' => $row['nama']],
                $row + ['urutan' => $i, 'status_aktif' => true, 'deskripsi' => 'Tenaga pendidik SMP Al Ahmad Krian.']
            );
        }
    }
}

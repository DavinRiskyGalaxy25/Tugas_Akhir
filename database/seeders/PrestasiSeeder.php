<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use Illuminate\Database\Seeder;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_prestasi' => 'Prestasi Siswa 1', 'foto' => null],
            ['nama_prestasi' => 'Prestasi Siswa 2', 'foto' => null],
            ['nama_prestasi' => 'Prestasi Siswa 3', 'foto' => null],
        ];

        foreach ($data as $i => $row) {
            Prestasi::updateOrCreate(
                ['slug' => Prestasi::generateUniqueSlug($row['nama_prestasi'])],
                [
                    'nama_prestasi' => $row['nama_prestasi'],
                    'slug' => Prestasi::generateUniqueSlug($row['nama_prestasi']),
                    'nama_siswa' => 'Siswa SMP Al Ahmad',
                    'tingkat' => 'Kabupaten',
                    'pencapaian' => 'Juara '.($i + 1),
                    'tahun' => now()->year,
                    'deskripsi' => 'Informasi singkat mengenai prestasi yang diraih oleh siswa SMP Al Ahmad.',
                    'foto' => $row['foto'] ?? null,
                    'status' => 'published',
                ]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_kegiatan' => 'Kegiatan Siswa 1', 'deskripsi' => 'Informasi singkat mengenai kegiatan siswa SMP Al Ahmad.', 'tanggal' => now()->subDays(20), 'foto' => null],
            ['nama_kegiatan' => 'Kegiatan Siswa 2', 'deskripsi' => 'Kegiatan pengembangan bakat dan minat siswa di lingkungan sekolah.', 'tanggal' => now()->subDays(10), 'foto' => null],
            ['nama_kegiatan' => 'Kegiatan Siswa 3', 'deskripsi' => 'Kegiatan gotong royong dan kebersihan lingkungan sekolah.', 'tanggal' => now()->subDays(3), 'foto' => null],
        ];

        foreach ($data as $row) {
            Kegiatan::updateOrCreate(
                ['slug' => Kegiatan::generateUniqueSlug($row['nama_kegiatan'])],
                [
                    'nama_kegiatan' => $row['nama_kegiatan'],
                    'slug' => Kegiatan::generateUniqueSlug($row['nama_kegiatan']),
                    'deskripsi' => $row['deskripsi'],
                    'tanggal' => $row['tanggal'],
                    'lokasi' => 'SMP Al Ahmad Krian',
                    'foto' => $row['foto'] ?? null,
                    'status' => 'published',
                ]
            );
        }
    }
}

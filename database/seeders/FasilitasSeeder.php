<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Ruang Kelas', 'deskripsi' => 'Ruang belajar yang digunakan untuk mendukung proses pembelajaran siswa.', 'foto' => null],
            ['nama' => 'Laboratorium', 'deskripsi' => 'Fasilitas penunjang kegiatan praktik dan pembelajaran siswa.', 'foto' => null],
            ['nama' => 'Perpustakaan', 'deskripsi' => 'Menyediakan berbagai koleksi buku untuk menunjang literasi siswa.', 'foto' => null],
            ['nama' => 'Lapangan Olahraga', 'deskripsi' => 'Digunakan untuk kegiatan olahraga dan upacara sekolah.', 'foto' => null],
        ];

        foreach ($data as $i => $row) {
            Fasilitas::updateOrCreate(['nama' => $row['nama']], $row + ['urutan' => $i]);
        }
    }
}

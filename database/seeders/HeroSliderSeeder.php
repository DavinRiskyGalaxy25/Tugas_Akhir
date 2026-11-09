<?php

namespace Database\Seeders;

use App\Models\HeroSlider;
use Illuminate\Database\Seeder;

class HeroSliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'judul' => 'SMP AL AHMAD KRIAN',
                'subjudul' => 'Mencetak generasi yang berakhlakul karimah, berprestasi, mandiri, kreatif, dan peduli lingkungan.',
                'gambar' => 'assets/img/sekolah.jpg',
                'tombol_teks' => 'Profil Sekolah',
                'tombol_url' => '/profil#tentang',
                'urutan' => 1,
                'status_aktif' => true,
            ],
            [
                'judul' => 'SPMB Telah Dibuka',
                'subjudul' => 'Penerimaan Peserta Didik Baru SMP Al Ahmad Krian. Daftarkan putra-putri Anda segera!',
                'gambar' => 'assets/img/sekolah.jpg',
                'tombol_teks' => 'SPMB',
                'tombol_url' => '/ppdb',
                'urutan' => 2,
                'status_aktif' => true,
            ],
            [
                'judul' => 'Pendidikan Berkualitas Berbasis Pesantren',
                'subjudul' => 'Membangun karakter mulia dengan fasilitas lengkap dan pembimbing berdedikasi tinggi.',
                'gambar' => 'assets/img/sekolah.jpg',
                'tombol_teks' => 'Jelajahi Akademik',
                'tombol_url' => '/akademik#fasilitas',
                'urutan' => 3,
                'status_aktif' => true,
            ],
        ];

        foreach ($sliders as $slide) {
            HeroSlider::firstOrCreate(['judul' => $slide['judul']], $slide);
        }
    }
}


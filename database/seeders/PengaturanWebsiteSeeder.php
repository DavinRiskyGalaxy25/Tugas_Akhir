<?php

namespace Database\Seeders;

use App\Models\PengaturanWebsite;
use Illuminate\Database\Seeder;

class PengaturanWebsiteSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'nama_sekolah' => 'SMP AL AHMAD KRIAN',
            'logo' => 'logo.png',
            'alamat' => 'Jl Mojosantren Krian, Kec. Krian, Kab. Sidoarjo, Prov. Jawa Timur',
            'telepon' => '03199892622',
            'email' => 'smpalahmad1977@gmail.com',
            'website' => 'https://smpalahmad.sch.id',
            'deskripsi' => 'SMP Al Ahmad Krian adalah sekolah menengah pertama yang berkomitmen mencetak generasi berakhlak, berprestasi, dan berwawasan luas.',
            'instagram' => 'https://www.instagram.com/smpalahmad.id',
            'facebook' => '',
            'youtube' => 'https://www.youtube.com/@smpal-ahmadkrian7045',
            'tiktok' => 'https://www.tiktok.com/@smpalahmad.id',
            'whatsapp' => 'https://wa.me/6289531923481',

            // PROFIL SEKOLAH (Tentang, Sejarah, Visi Misi, Identitas, Sambutan)
            'tentang_sekolah' => "SMP Al Ahmad merupakan satuan pendidikan tingkat Sekolah Menengah Pertama swasta yang berlokasi di Jalan Mojosantren, Desa Kemasan, Kecamatan Krian, Kabupaten Sidoarjo, Provinsi Jawa Timur. Sekolah ini memiliki NPSN 20501673 dan berada di bawah naungan Yayasan Badan Pelaksana Pendidikan Ma'arif NU Al Ahmad. Sebagai lembaga pendidikan, SMP Al Ahmad menjadi bagian dari lingkungan pendidikan Al Ahmad yang berada di wilayah Mojosantren, Krian.",
            'tentang_sekolah_ringkas' => "SMP Al Ahmad merupakan satuan pendidikan tingkat Sekolah Menengah Pertama swasta di Krian, Sidoarjo yang berada di bawah naungan Yayasan BPP Ma'arif NU Al Ahmad.",
            'tentang_sekolah_gambar' => 'assets/img/sekolah.jpg',

            'sejarah' => "SMP Al Ahmad memiliki sejarah yang cukup panjang dalam penyelenggaraan pendidikan di Kecamatan Krian, Kabupaten Sidoarjo. Berdasarkan data pendidikan Kemendikdasmen, sekolah ini tercatat memiliki tanggal pendirian pada 17 Juli 1977. Sejak awal berdirinya, SMP Al Ahmad hadir sebagai lembaga pendidikan swasta yang melayani pendidikan pada jenjang Sekolah Menengah Pertama di wilayah Mojosantren dan sekitarnya.\n\nDalam perkembangannya, SMP Al Ahmad berada di bawah naungan Yayasan Badan Pelaksana Pendidikan Ma'arif NU Al Ahmad. Sekolah ini kemudian menjalankan kegiatan operasional berdasarkan izin operasional dengan nomor 421.3/2700/404.3.1/2010.\n\nHingga saat ini, SMP Al Ahmad tetap menjadi salah satu satuan pendidikan swasta di Kecamatan Krian, Kabupaten Sidoarjo. Perjalanan sekolah sejak tahun 1977 menunjukkan keberadaan SMP Al Ahmad dalam mendukung pendidikan generasi muda melalui pembelajaran, pengembangan karakter, kegiatan siswa, serta berbagai program pendidikan yang dijalankan sekolah.",
            'sejarah_tahun_pendirian' => '17 Juli 1977',
            'sejarah_izin_operasional' => '421.3/2700/404.3.1/2010',

            'visi' => 'Membangun insan yang berakhlakul karimah, berprestasi, mandiri, kreatif, dan peduli lingkungan.',
            'misi' => "Menyelenggarakan pendidikan berbasis pesantren untuk memperkuat karakter keagamaan dan akhlak mulia.\nMengembangkan potensi akademik dan non-akademik peserta didik agar meraih prestasi optimal.\nMembentuk jiwa kemandirian dan kreativitas melalui pembelajaran kewirausahaan (entrepreneurship).\nMenanamkan kepedulian terhadap lingkungan sekitar secara aktif dan berkelanjutan.",

            'identitas_npsn' => '20501673',
            'identitas_status' => 'Swasta',
            'identitas_bentuk' => 'Sekolah Menengah Pertama (SMP)',
            'identitas_akreditasi' => 'B',
            'identitas_kurikulum' => 'Kurikulum Merdeka',
            'identitas_naungan' => "Badan Pelaksana Pendidikan Ma'arif NU Al-Ahmad",

            'sambutan_nama_kepala' => 'KH. Drs. M. Sudi Khotib, MM.',
            'sambutan_jabatan_kepala' => 'Kepala Sekolah SMP Al Ahmad Krian',
            'sambutan_quote' => 'Pendidikan bukan hanya tentang mencapai prestasi akademik, tetapi juga tentang membentuk karakter, mengembangkan potensi, dan mempersiapkan peserta didik menjadi pribadi yang berakhlak dan bertanggung jawab.',
            'sambutan_kepala_sekolah' => "Pendidikan bukan hanya tentang mencapai prestasi akademik, tetapi juga tentang membentuk karakter, mengembangkan potensi, dan mempersiapkan peserta didik menjadi pribadi yang berakhlak dan bertanggung jawab. Di SMP Al Ahmad Krian, kami berikhtiar mendidik tunas-tunas bangsa dengan perpaduan nilai-nilai islami dan kecakapan masa kini.",
            'sambutan_foto' => '',

            'bagan_struktur_organisasi' => '',
        ];

        foreach ($defaults as $key => $value) {
            PengaturanWebsite::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}

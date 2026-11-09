<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PengaturanWebsiteSeeder::class,
            HeroSliderSeeder::class,
            StrukturOrganisasiSeeder::class,
            GuruSeeder::class,
            FasilitasSeeder::class,
            EkstrakurikulerSeeder::class,
            BeritaSeeder::class,
            KegiatanSeeder::class,
            PrestasiSeeder::class,
            AlumniSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun bawaan project repo
        User::updateOrCreate(
            ['email' => 'admin@sekolah.test'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
            ]
        );

        // Akun resmi sekolah (dari db_smp_alahmad)
        User::updateOrCreate(
            ['email' => 'admin@smpalahmad.sch.id'],
            [
                'name' => 'Admin SMP Al Ahmad',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
            ]
        );

        // Akun staf konten
        User::updateOrCreate(
            ['email' => 'staff@sekolah.test'],
            [
                'name' => 'Admin Konten',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
    }
}

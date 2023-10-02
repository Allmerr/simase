<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\EmailConfiguration;
use App\Models\KotaKabupaten;
use App\Models\Pangkat;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\PendidikanKepolisian;
use App\Models\Provinsi;
use App\Models\Satker;
use App\Models\Skema;
use App\Models\Tuk;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Tuk::factory(10)->create();
        Skema::factory(3)->create();
        Satker::factory(10)->create();
        Pangkat::factory(10)->create();
        Provinsi::factory(20)->create();
        KotaKabupaten::factory(40)->create();
        PendidikanKepolisian::factory(5)->create();
        Pendidikan::factory(7)->create();
        Pekerjaan::factory(30)->create();

        User::create([
            'nama_lengkap' => 'Admin',
            'email' => 'admin@example.com',
            'no_telpon' => '081234567890',
            'password' => '12345678',
            'role' => 'admin',
        ]);

        User::create([
            'nama_lengkap' => 'peserta',
            'email' => 'peserta@example.com',
            'no_telpon' => '080123456789',
            'id_satker' => '1',
            'password' => '12345678',
        ]);

        User::create([
            'nama_lengkap' => 'Muhammad Kevin Almer',
            'email' => 'kevinalmer4@gmail.com',
            'no_telpon' => '089611330331',
            'password' => '12345678',
        ]);

        EmailConfiguration::create([
            'protocol' => 'smtp', // 'smtp', 'sendmail', 'mail', 'qmail
            'host' => 'smtp.gmail.com',
            'port' => '465',
            'timeout' => '30',
            'username' => 'kevinalmer.bisnis@gmail.com',
            'email' => 'kevinalmer.bisnis@gmail.com',
            'password' => 'szjnbcpcbkpvggte',
        ]);

    }
}
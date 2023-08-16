<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Skema;
use App\Models\Satker;
use App\Models\Pangkat;
use App\Models\PendidikanKepolisian;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Skema::factory(20)->create();
        Satker::factory(10)->create();
        Pangkat::factory(10)->create();
        PendidikanKepolisian::factory(5)->create();

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

    }
}
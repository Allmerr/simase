<?php

namespace Database\Factories;

use App\Models\Provinsi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provinsi>
 */
class KotaKabupatenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $existingKodeFingers = Provinsi::pluck('kode_provinsi')->all();

        return [
            'kode_provinsi' => fake()->randomElement($existingKodeFingers),
            'kode_kota_kabupaten' => fake()->unique()->bothify('##'),
            'nama_kota_kabupaten' => fake()->city(),
        ];
    }
}

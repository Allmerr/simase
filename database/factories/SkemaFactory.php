<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skema>
 */
class SkemaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $possibleValues = [
            'file_syarat_ijazah_terakhir',
            'file_syarat_sertifikat_pelatihan',
            'file_syarat_sk_penempatan',
            'file_syarat_sk_bebas_narkoba',
            'file_syarat_sk_sehat',
            'file_syarat_surat_rekomendasi_satker',
            'file_syarat_nilai_e_rohani',
            'file_syarat_smk_skp_terakhir',
            'file_syarat_cv',
            'file_syarat_pas_photo',
            'file_syarat_sertifikat_keahlian_khusus',
            'file_syarat_nilai_smk',
            'file_syarat_keputusan_penyidik',
            'file_syarat_skhp',
            'file_syarat_dokumen_lainnya',
        ];

        $combinationLength = fake()->numberBetween(1, count($possibleValues));

        $randomCombination = fake()->randomElements($possibleValues, $combinationLength);
        $randomCombination = implode(',', $randomCombination);

        return [
            'kode' => strtoupper(Str::random(6)), // Generate a random scheme code
            'nama' => fake()->words(3, true), // Generate a random scheme name
            'persyaratan' => fake()->sentence(5),
            'file_syarat' => $randomCombination,
        ];
    }
}
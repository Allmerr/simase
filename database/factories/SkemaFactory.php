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
        $possibleValues = ['file_syarat_ktp', 'file_syarat_kk', 'file_syarat_npwp'];
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
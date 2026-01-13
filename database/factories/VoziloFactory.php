<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoziloFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'registracija' => fake()->regexify('[A-Za-z0-9]{20}'),
            'marka_model' => fake()->regexify('[A-Za-z0-9]{120}'),
            'godina' => fake()->numberBetween(1900, date('Y')),
            'slika' => fake()->word(),
        ];
    }
}

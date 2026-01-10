<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UslugaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'naziv' => fake()->regexify('[A-Za-z0-9]{120}'),
            'opis' => fake()->text(),
            'cena' => fake()->randomFloat(2, 0, 999999.99),
            'trajanje_min' => fake()->numberBetween(-10000, 10000),
            'featured' => fake()->boolean(),
        ];
    }
}

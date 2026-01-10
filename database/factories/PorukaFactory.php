<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PorukaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'ime' => fake()->regexify('[A-Za-z0-9]{80}'),
            'email' => fake()->safeEmail(),
            'telefon' => fake()->regexify('[A-Za-z0-9]{30}'),
            'poruka' => fake()->text(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Usluga;
use App\Models\Vozilo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TerminFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'usluga_id' => Usluga::factory(),
            'vozilo_id' => Vozilo::factory(),
            'datum' => fake()->date(),
            'vreme' => fake()->time(),
            'status' => fake()->randomElement(['pending', 'approved', 'cancelled', 'done']),
            'napomena' => fake()->text(),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Poruka;
use Illuminate\Database\Seeder;

class PorukaSeeder extends Seeder
{
    public function run(): void
    {
        Poruka::query()->delete();

        Poruka::insert([
            [
                'ime' => 'Petar',
                'email' => 'petar@test.com',
                'poruka' => 'Da li radite subotom?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ime' => 'Mika',
                'email' => 'mika@test.com',
                'poruka' => 'Koliko traje standard pregled?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

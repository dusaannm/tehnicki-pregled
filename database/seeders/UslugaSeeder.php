<?php

namespace Database\Seeders;

use App\Models\Usluga;
use Illuminate\Database\Seeder;

class UslugaSeeder extends Seeder
{
    public function run(): void
    {
        Usluga::query()->delete();

        Usluga::insert([
            [
                'naziv' => 'Osnovni',
                'opis' => 'Osnovni tehnički pregled vozila.',
                'cena' => 1500,
                'trajanje_min' => 30,
                'featured' => true,
            ],
            [
                'naziv' => 'Standard',
                'opis' => 'Tehnički pregled + provera kočnica i svetala.',
                'cena' => 2200,
                'trajanje_min' => 30,
                'featured' => false,
            ],
            [
                'naziv' => 'Premium',
                'opis' => 'Detaljna kontrola + savetnik (vizuelni izveštaj).',
                'cena' => 3500,
                'trajanje_min' => 30,
                'featured' => false,
            ],
            [
                'naziv' => 'EKO test',
                'opis' => 'Provera emisije izduvnih gasova (EKO).',
                'cena' => 1200,
                'trajanje_min' => 30,
                'featured' => false,
            ],
        ]);
    }
}

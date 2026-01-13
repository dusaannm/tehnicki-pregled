<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vozilo;
use Illuminate\Database\Seeder;

class VoziloSeeder extends Seeder
{
    public function run(): void
    {
        Vozilo::query()->delete();

        $user = User::where('email', 'marko@gmail.com')->first();

        if (! $user) {
            return;
        }

        Vozilo::insert([
            [
                'user_id' => $user->id,
                'registracija' => 'BG123AB',
                'marka_model' => 'Golf 7 1.6 TDI',
                'godina' => 2016,
                'slika' => null,
            ],
            [
                'user_id' => $user->id,
                'registracija' => 'NS456CD',
                'marka_model' => 'Audi A3',
                'godina' => 2018,
                'slika' => null,
            ],
        ]);
    }
}

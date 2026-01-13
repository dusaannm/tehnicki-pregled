<?php

namespace Database\Seeders;

use App\Models\Termin;
use App\Models\User;
use App\Models\Usluga;
use App\Models\Vozilo;
use Illuminate\Database\Seeder;

class TerminSeeder extends Seeder
{
    public function run(): void
    {
        Termin::query()->delete();

        $user = User::where('email', 'dusan@gmail.com')->first();
        $usluga = Usluga::first();
        $vozilo = Vozilo::first();

        if (!$user || !$usluga || !$vozilo) {
            return;
        }

        Termin::create([
            'user_id' => $user->id,
            'usluga_id' => $usluga->id,
            'vozilo_id' => $vozilo->id,
            'datum' => now()->addDays(1)->toDateString(),
            'vreme' => '08:00',
            'status' => 'approved',
            'napomena' => 'Seed termin',
        ]);

        Termin::create([
            'user_id' => $user->id,
            'usluga_id' => $usluga->id,
            'vozilo_id' => $vozilo->id,
            'datum' => now()->addDays(2)->toDateString(),
            'vreme' => '09:30',
            'status' => 'pending',
            'napomena' => null,
        ]);
    }
}

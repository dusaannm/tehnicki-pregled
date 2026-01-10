<?php

namespace Tests\Feature;

use App\Models\Termin;
use App\Models\User;
use App\Models\Usluga;
use App\Models\Vozilo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingPreventsDuplicateSlotTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_book_same_date_and_time_twice(): void
    {
        $user1 = User::factory()->create(['role' => 'user']);
        $user2 = User::factory()->create(['role' => 'user']);

        $usluga = Usluga::create([
            'naziv' => 'Test Usluga',
            'opis' => 'Opis',
            'cena' => 1000,
            'trajanje_min' => 30,
            'featured' => false,
        ]);

        $vozilo = Vozilo::create([
            'user_id' => $user1->id,
            'registracija' => 'BG-222-BB',
            'marka_model' => 'BMW 320d',
            'godina' => 2015,
            'slika' => null,
        ]);

        $date = now()->addDay()->toDateString();
        $time = '10:00';

        Termin::create([
            'user_id' => $user1->id,
            'usluga_id' => $usluga->id,
            'vozilo_id' => $vozilo->id,
            'datum' => $date,
            'vreme' => $time,
            'status' => 'pending',
            'napomena' => null,
        ]);

        $payload = [
            'usluga_id' => $usluga->id,
            'datum' => $date,
            'vreme' => $time, // isti slot
            'marka_model' => 'Opel Astra',
            'godina' => 2012,
            'registracija' => 'BG-333-CC',
            'napomena' => null,
        ];

        $res = $this->actingAs($user2)->post(route('booking.store'), $payload);

        $res->assertSessionHasErrors('vreme');

        // i dalje samo 1 termin za taj slot
        $this->assertEquals(1, Termin::where('datum', $date)->where('vreme', $time)->count());
    }
}

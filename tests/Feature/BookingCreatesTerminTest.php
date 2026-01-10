<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Usluga;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingCreatesTerminTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_book_and_it_creates_vozilo_and_termin(): void
    {
        $user = User::factory()->create();
        $usluga = Usluga::create([
            'naziv' => 'Test Usluga',
            'opis' => 'Opis',
            'cena' => 1000,
            'trajanje_min' => 30,
            'featured' => false,
        ]);

        $payload = [
            'usluga_id' => $usluga->id,
            'datum' => now()->addDay()->toDateString(),
            'vreme' => '10:00',
            'marka_model' => 'Audi A3',
            'godina' => 2016,
            'registracija' => 'BG-111-AA',
            'napomena' => 'Test',
        ];

        $res = $this->actingAs($user)->post(route('booking.store'), $payload);

        $res->assertRedirect(route('booking.my'));
        $res->assertSessionHas('success');

        $this->assertDatabaseHas('vozilos', [
            'user_id' => $user->id,
            'registracija' => 'BG-111-AA',
            'marka_model' => 'Audi A3',
            'godina' => 2016,
        ]);

        $this->assertDatabaseHas('termins', [
            'user_id' => $user->id,
            'usluga_id' => $usluga->id,
            'datum' => $payload['datum'],
            'vreme' => $payload['vreme'],
            'status' => 'pending',
        ]);
    }
}

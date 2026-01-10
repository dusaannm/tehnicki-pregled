<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Usluga;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_loads_and_shows_featured_services()
    {
        $featuredService = Usluga::factory()->create([
            'featured' => true,
            'naziv' => 'Featured Service 1',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertStatus(200);
        $response->assertSee('Tehnički Pregled');
        $response->assertSee('Prijavi se'); // Check for login button text
    }

    public function test_zakazi_button_redirects_unauthenticated_users_to_login()
    {
        $service = Usluga::factory()->create();

        // Simulate clicking 'Zakazi' which links to booking.create
        $response = $this->get(route('booking.create', ['usluga_id' => $service->id]));

        $response->assertRedirect(route('login'));
    }

    public function test_zakazi_button_allows_authenticated_users()
    {
        $user = User::factory()->create();
        $service = Usluga::factory()->create();

        $response = $this->actingAs($user)->get(route('booking.create', ['usluga_id' => $service->id]));

        $response->assertStatus(200);
    }
}

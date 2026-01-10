<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Models\Vozilo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VoziloController
 */
final class VoziloControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $vozilos = Vozilo::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('admin.vozila.index'));

        $response->assertOk();
        $response->assertViewIs('admin.vozila.index');
        $response->assertViewHas('vozila');
    }

    #[Test]
    public function create_displays_view(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($user)->get(route('admin.vozila.create'));

        $response->assertOk();
        $response->assertViewIs('admin.vozila.create');
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $marka_model = fake()->word();
        $registracija = 'BG-123-ZZ';
        $godina = 2020;

        $response = $this->actingAs($user)->post(route('admin.vozila.store'), [
            'user_id' => $user->id,
            'marka_model' => $marka_model,
            'registracija' => $registracija,
            'godina' => $godina,
        ]);

        $vozilos = Vozilo::query()
            ->where('marka_model', $marka_model)
            ->get();
        $this->assertCount(1, $vozilos);
        $vozilo = $vozilos->first();

        $response->assertRedirect(route('admin.vozila.index'));
    }

    #[Test]
    public function show_displays_view(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $vozilo = Vozilo::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.vozila.show', $vozilo));

        $response->assertOk();
        $response->assertViewIs('admin.vozila.show');
        $response->assertViewHas('vozilo', $vozilo);
    }

    #[Test]
    public function edit_displays_view(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $vozilo = Vozilo::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.vozila.edit', $vozilo));

        $response->assertOk();
        $response->assertViewIs('admin.vozila.edit');
        $response->assertViewHas('vozilo', $vozilo);
    }

    #[Test]
    public function update_redirects(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $vozilo = Vozilo::factory()->create();
        $marka_model = fake()->word();

        $response = $this->actingAs($user)->put(route('admin.vozila.update', $vozilo), [
            'user_id' => $user->id,
            'marka_model' => $marka_model,
            'registracija' => $vozilo->registracija,
            'godina' => $vozilo->godina,
        ]);

        $vozilo->refresh();

        $response->assertRedirect(route('admin.vozila.index'));

        $this->assertEquals($marka_model, $vozilo->marka_model);
    }

    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $vozilo = Vozilo::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.vozila.destroy', $vozilo));

        $response->assertRedirect(route('admin.vozila.index'));

        $this->assertModelMissing($vozilo);
    }
}

<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Models\Usluga;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UslugaController
 */
final class UslugaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $uslugas = Usluga::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('admin.usluge.index'));

        $response->assertOk();
        $response->assertViewIs('admin.usluge.index');
        $response->assertViewHas('usluge');
    }

    #[Test]
    public function create_displays_view(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($user)->get(route('admin.usluge.create'));

        $response->assertOk();
        $response->assertViewIs('admin.usluge.create');
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $naziv = fake()->word();
        $cena = fake()->randomFloat(2, 100, 1000);
        $trajanje_min = fake()->numberBetween(10, 60);
        $featured = fake()->boolean();

        $response = $this->actingAs($user)->post(route('admin.usluge.store'), [
            'naziv' => $naziv,
            'opis' => 'Description',
            'cena' => $cena,
            'trajanje_min' => $trajanje_min,
            'featured' => $featured,
        ]);

        $uslugas = Usluga::query()
            ->where('naziv', $naziv)
            ->where('cena', $cena)
            ->where('trajanje_min', $trajanje_min)
            ->where('featured', $featured)
            ->get();
        $this->assertCount(1, $uslugas);
        $usluga = $uslugas->first();

        $response->assertRedirect(route('admin.usluge.index'));
    }

    #[Test]
    public function show_displays_view(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $usluga = Usluga::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.usluge.show', $usluga));

        $response->assertOk();
        $response->assertViewIs('admin.usluge.show');
        $response->assertViewHas('usluga', $usluga);
    }

    #[Test]
    public function edit_displays_view(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $usluga = Usluga::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.usluge.edit', $usluga));

        $response->assertOk();
        $response->assertViewIs('admin.usluge.edit');
        $response->assertViewHas('usluga', $usluga);
    }

    #[Test]
    public function update_redirects(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $usluga = Usluga::factory()->create();
        $naziv = fake()->word();
        $cena = fake()->randomFloat(2, 100, 1000);
        $trajanje_min = fake()->numberBetween(10, 60);
        $featured = fake()->boolean();

        $response = $this->actingAs($user)->put(route('admin.usluge.update', $usluga), [
            'naziv' => $naziv,
            'opis' => 'Desc',
            'cena' => $cena,
            'trajanje_min' => $trajanje_min,
            'featured' => $featured,
        ]);

        $usluga->refresh();

        $response->assertRedirect(route('admin.usluge.index'));

        $this->assertEquals($naziv, $usluga->naziv);
        $this->assertEquals($cena, $usluga->cena);
        $this->assertEquals($trajanje_min, $usluga->trajanje_min);
        $this->assertEquals($featured, $usluga->featured);
    }

    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $usluga = Usluga::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.usluge.destroy', $usluga));

        $response->assertRedirect(route('admin.usluge.index'));

        $this->assertModelMissing($usluga);
    }
}

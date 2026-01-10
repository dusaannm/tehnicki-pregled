<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Termin;
use App\Models\User;
use App\Models\Usluga;
use App\Models\Vozilo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TerminController
 */
final class TerminControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $termins = Termin::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('admin.termini.index'));

        $response->assertOk();
        $response->assertViewIs('admin.termini.index');
        $response->assertViewHas('termini');
    }

    #[Test]
    public function create_displays_view(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($user)->get(route('admin.termini.create'));

        $response->assertOk();
        $response->assertViewIs('admin.termini.create');
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $usluga = Usluga::factory()->create();
        $vozilo = Vozilo::factory()->create();
        $datum = Carbon::parse(fake()->date());
        $vreme = '12:00';
        $status = 'na_cekanju';

        $response = $this->actingAs($user)->post(route('admin.termini.store'), [
            'user_id' => $user->id,
            'usluga_id' => $usluga->id,
            'vozilo_id' => $vozilo->id,
            'datum' => $datum->toDateString(),
            'vreme' => $vreme,
            'status' => $status,
            'napomena' => 'test',
        ]);

        $termins = Termin::query()
            ->where('user_id', $user->id)
            ->where('usluga_id', $usluga->id)
            ->where('vozilo_id', $vozilo->id)
            ->where('datum', $datum->toDateString())
            ->where('vreme', $vreme)
            ->get();
        $this->assertCount(1, $termins);
        $termin = $termins->first();

        $response->assertRedirect(route('admin.termini.index'));
    }

    #[Test]
    public function show_displays_view(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $termin = Termin::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.termini.show', $termin));

        $response->assertOk();
        $response->assertViewIs('admin.termini.show');
        $response->assertViewHas('termin', $termin);
    }

    #[Test]
    public function edit_displays_view(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $termin = Termin::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.termini.edit', $termin));

        $response->assertOk();
        $response->assertViewIs('admin.termini.edit');
        $response->assertViewHas('termin', $termin);
    }

    #[Test]
    public function update_redirects(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $termin = Termin::factory()->create();
        $usluga = Usluga::factory()->create();
        $vozilo = Vozilo::factory()->create();
        $datum = Carbon::parse(fake()->date());
        $vreme = '13:00';
        $status = 'potvrdjen';

        $response = $this->actingAs($user)->put(route('admin.termini.update', $termin), [
            'user_id' => $user->id,
            'usluga_id' => $usluga->id,
            'vozilo_id' => $vozilo->id,
            'datum' => $datum->toDateString(),
            'vreme' => $vreme,
            'status' => $status,
            'napomena' => 'updated',
            'marka_model' => 'Golf 5',
            'registracija' => 'BG-123-ZZ',
        ]);

        $termin->refresh();

        $response->assertRedirect(route('admin.termini.index'));

        $this->assertEquals($user->id, $termin->user_id);
        $this->assertEquals($usluga->id, $termin->usluga_id);
        $this->assertEquals($vozilo->id, $termin->vozilo_id);
        $this->assertEquals($datum->toDateString(), $termin->datum);
        $this->assertEquals($vreme, $termin->vreme);
        $this->assertEquals($status, $termin->status);
    }

    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $termin = Termin::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.termini.destroy', $termin));

        $response->assertRedirect(route('admin.termini.index'));

        $this->assertModelMissing($termin);
    }
}

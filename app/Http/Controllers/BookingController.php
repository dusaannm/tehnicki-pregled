<?php

namespace App\Http\Controllers;

use App\Models\Termin;
use App\Models\Usluga;
use App\Models\Vozilo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function usluge()
    {
        $usluge = Usluga::query()
            ->orderByDesc('featured')
            ->orderBy('cena')
            ->get();

        return view('booking.usluge', compact('usluge'));
    }

    public function create(Request $request)
    {
        $usluge = Usluga::query()
            ->orderByDesc('featured')
            ->orderBy('cena')
            ->get();

        $selectedDate = $request->query('datum') ?? now()->toDateString();
        $selectedUslugaId = $request->query('usluga_id');

        $allSlots = $this->generateSlots('08:00', '16:00', 30);

        $taken = Termin::query()
            ->where('datum', $selectedDate)
            ->pluck('vreme')
            ->all();

        $availableSlots = array_values(array_diff($allSlots, $taken));

        return view('booking.create', compact('usluge', 'selectedDate', 'availableSlots', 'selectedUslugaId'));
    }

    public function store(Request $request)
    {
        $allowedSlots = $this->generateSlots('08:00', '16:00', 30);

        $data = $request->validate([
            'usluga_id' => ['required', 'integer', Rule::exists('uslugas', 'id')],
            'datum' => ['required', 'date'],
            'vreme' => ['required', Rule::in($allowedSlots)],
            'marka_model' => ['required', 'string', 'max:255'],
            'godina' => ['required', 'integer', 'min:1950', 'max:'.(now()->year + 1)],
            'registracija' => ['required', 'string', 'max:30'],
            'napomena' => ['nullable', 'string', 'max:1000'],
        ]);

        // da ne može dupli termin u isto vreme
        $data['datum'] = Carbon::parse($data['datum'])->toDateString();

        $exists = Termin::query()
            ->where('datum', $data['datum'])
            ->where('vreme', $data['vreme'])
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['vreme' => 'Ovaj termin je već zauzet. Izaberi drugi.'])
                ->withInput();
        }

        $vozilo = Vozilo::create([
            'user_id' => Auth::id(),
            'registracija' => $data['registracija'],
            'marka_model' => $data['marka_model'],
            'godina' => $data['godina'],
            'slika' => null,
        ]);

        Termin::create([
            'user_id' => Auth::id(),
            'usluga_id' => $data['usluga_id'],
            'vozilo_id' => $vozilo->id,
            'datum' => $data['datum'],
            'vreme' => $data['vreme'],
            'status' => 'pending',
            'napomena' => $data['napomena'] ?? null,
        ]);

        return redirect()
            ->route('booking.my')
            ->with('success', 'Termin je uspešno zakazan.');
    }

    public function my()
    {
        $termini = Termin::query()
            ->with(['usluga', 'vozilo'])
            ->where('user_id', Auth::id())
            ->orderByDesc('datum')
            ->orderByDesc('vreme')
            ->get();

        return view('booking.my', compact('termini'));
    }

    private function generateSlots(string $start, string $end, int $minutes): array
    {
        $slots = [];
        $t = Carbon::createFromFormat('H:i', $start);
        $endT = Carbon::createFromFormat('H:i', $end);

        while ($t->lt($endT)) {
            $slots[] = $t->format('H:i');
            $t->addMinutes($minutes);
        }

        return $slots;
    }
}

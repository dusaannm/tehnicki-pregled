<?php

namespace App\Http\Controllers;

use App\Http\Requests\TerminStoreRequest;
use App\Http\Requests\TerminUpdateRequest;
use App\Models\Termin;
use Illuminate\Http\Request;

class TerminController extends Controller
{
    public function index(Request $request)
    {
        $termini = Termin::with(['user', 'usluga', 'vozilo'])->orderBy('datum', 'desc')->get();

        return view('admin.termini.index', [
            'termini' => $termini,
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.termini.create');
    }

    public function store(TerminStoreRequest $request)
    {
        $data = $request->validated();
        $data['datum'] = \Carbon\Carbon::parse($data['datum'])->toDateString();

        $termin = Termin::create($data);

        $request->session()->flash('success', 'Termin kreiran.');

        return redirect()->route('admin.termini.index');
    }

    public function show(Request $request, Termin $termin)
    {
        return view('admin.termini.show', [
            'termin' => $termin,
        ]);
    }

    public function edit(Request $request, Termin $termin)
    {
        $selectedDate = $request->query('datum') ?? $termin->datum;

        $allSlots = $this->generateSlots('08:00', '16:00', 30);

        $taken = Termin::query()
            ->where('datum', $selectedDate)
            ->where('id', '!=', $termin->id) // Exclude current termin so its time shows as available
            ->pluck('vreme')
            ->all();

        $availableSlots = array_values(array_diff($allSlots, $taken));

        return view('admin.termini.edit', [
            'termin' => $termin,
            'availableSlots' => $availableSlots,
            'selectedDate' => $selectedDate,
        ]);
    }

    private function generateSlots(string $start, string $end, int $minutes): array
    {
        $slots = [];
        $t = \Carbon\Carbon::createFromFormat('H:i', $start);
        $endT = \Carbon\Carbon::createFromFormat('H:i', $end);

        while ($t->lt($endT)) {
            $slots[] = $t->format('H:i');
            $t->addMinutes($minutes);
        }

        return $slots;
    }

    public function update(TerminUpdateRequest $request, Termin $termin)
    {
        $data = $request->validated();

        $termin->vozilo->update([
            'marka_model' => $data['marka_model'],
            'registracija' => $data['registracija'],
        ]);

        unset($data['marka_model'], $data['registracija']);

        $data['datum'] = \Carbon\Carbon::parse($data['datum'])->toDateString();

        $termin->update($data);

        $request->session()->flash('success', 'Termin ažuriran.');

        return redirect()->route('admin.termini.index');
    }

    public function destroy(Request $request, Termin $termin)
    {
        $termin->delete();

        return redirect()->route('admin.termini.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Vozilo;
use Illuminate\Http\Request;

class VoziloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vozila = Vozilo::with('user')->get();

        return view('admin.vozila.index', compact('vozila'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vozila.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'marka_model' => ['required', 'string', 'max:255'],
            'registracija' => ['nullable', 'string', 'max:20'],
            'godina' => ['nullable', 'integer', 'min:1900', 'max:'.(date('Y') + 1)],
            'slika' => ['nullable', 'image', 'max:2048'],
        ]);

        Vozilo::create($validated);

        return redirect()->route('admin.vozila.index')
            ->with('success', 'Vozilo uspešno kreirano.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vozilo $vozilo)
    {
        return view('admin.vozila.show', compact('vozilo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vozilo $vozilo)
    {
        return view('admin.vozila.edit', compact('vozilo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $vozilo = Vozilo::findOrFail($id);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'marka_model' => ['required', 'string', 'max:255'],
            'registracija' => ['nullable', 'string', 'max:20'],
            'godina' => ['nullable', 'integer', 'min:1900', 'max:'.(date('Y') + 1)],
            'slika' => ['nullable', 'image', 'max:2048'],
        ]);

        $vozilo->update($validated);

        return redirect()->route('admin.vozila.index')
            ->with('success', 'Vozilo uspešno ažurirano.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vozilo $vozilo)
    {
        $vozilo->delete();

        return redirect()->route('admin.vozila.index')
            ->with('success', 'Vozilo uspešno obrisano.');
    }
}

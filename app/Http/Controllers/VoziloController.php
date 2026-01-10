<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoziloStoreRequest;
use App\Http\Requests\VoziloUpdateRequest;
use App\Models\Vozilo;
use Illuminate\Http\Request;

class VoziloController extends Controller
{
    public function index(Request $request)
    {
        $vozila = Vozilo::all();

        return view('admin.vozila.index', [
            'vozila' => $vozila,
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.vozila.create');
    }

    public function store(VoziloStoreRequest $request)
    {
        $vozilo = Vozilo::create($request->validated());

        $request->session()->flash('success', 'Vozilo kreirano.');

        return redirect()->route('admin.vozila.index');
    }

    public function show(Request $request, Vozilo $vozilo)
    {
        return view('admin.vozila.show', [
            'vozilo' => $vozilo,
        ]);
    }

    public function edit(Request $request, Vozilo $vozilo)
    {
        return view('admin.vozila.edit', [
            'vozilo' => $vozilo,
        ]);
    }

    public function update(VoziloUpdateRequest $request, Vozilo $vozilo)
    {
        $vozilo->update($request->validated());

        $request->session()->flash('success', 'Vozilo ažurirano.');

        return redirect()->route('admin.vozila.index');
    }

    public function destroy(Request $request, Vozilo $vozilo)
    {
        $vozilo->termins()->delete();
        $vozilo->delete();

        return redirect()->route('admin.vozila.index');
    }
}

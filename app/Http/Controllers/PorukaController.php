<?php

namespace App\Http\Controllers;

use App\Http\Requests\PorukaStoreRequest;
use App\Http\Requests\PorukaUpdateRequest;
use App\Models\Poruka;
use Illuminate\Http\Request;

class PorukaController extends Controller
{
    public function index(Request $request)
    {
        $poruke = Poruka::latest()->get();

        return view('admin.poruke.index', [
            'poruke' => $poruke,
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.poruke.create');
    }

    public function store(PorukaStoreRequest $request)
    {
        $poruka = Poruka::create($request->validated());

        $request->session()->flash('success', 'Poruka poslata.');

        return redirect()->route('admin.poruke.index');
    }

    public function show(Request $request, Poruka $poruka)
    {
        return view('admin.poruke.show', [
            'poruka' => $poruka,
        ]);
    }

    public function edit(Request $request, Poruka $poruka)
    {
        return view('admin.poruke.edit', [
            'poruka' => $poruka,
        ]);
    }

    public function update(PorukaUpdateRequest $request, Poruka $poruka)
    {
        $poruka->update($request->validated());

        $request->session()->flash('success', 'Poruka ažurirana.');

        return redirect()->route('admin.poruke.index');
    }

    public function destroy(Request $request, Poruka $poruka)
    {
        $poruka->delete();

        return redirect()->route('admin.poruke.index');
    }
}

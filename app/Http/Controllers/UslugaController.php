<?php

namespace App\Http\Controllers;

use App\Http\Requests\UslugaStoreRequest;
use App\Http\Requests\UslugaUpdateRequest;
use App\Models\Usluga;
use Illuminate\Http\Request;

class UslugaController extends Controller
{
    public function index(Request $request)
    {
        $usluge = Usluga::orderByDesc('featured')->orderBy('naziv')->get();

        return view('admin.usluge.index', compact('usluge'));
    }

    public function create(Request $request)
    {
        return view('admin.usluge.create');
    }

    public function store(UslugaStoreRequest $request)
    {
        $data = $request->validated();
        $data['featured'] = $request->boolean('featured');

        $usluga = Usluga::create($data);

        $request->session()->flash('success', 'Usluga kreirana.');

        return redirect()->route('admin.usluge.index');
    }

    public function show(Request $request, Usluga $usluga)
    {
        return view('admin.usluge.show', [
            'usluga' => $usluga,
        ]);
    }

    public function edit(Request $request, Usluga $usluga)
    {
        return view('admin.usluge.edit', [
            'usluga' => $usluga,
        ]);
    }

    public function update(UslugaUpdateRequest $request, Usluga $usluga)
    {
        $data = $request->validated();
        $data['featured'] = $request->boolean('featured');

        $usluga->update($data);

        $request->session()->flash('success', 'Usluga ažurirana.');

        return redirect()->route('admin.usluge.index');
    }

    public function destroy(Request $request, Usluga $usluga)
    {
        $usluga->termins()->delete();
        $usluga->delete();

        return redirect()->route('admin.usluge.index');
    }
}

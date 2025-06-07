<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Referenz;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReferenzController extends Controller
{
    public function index()
    {
        $referenzen = Referenz::latest()->get();
        return Inertia::render('Admin/Referenzen/Index', compact('referenzen'));
    }

    public function show($slug): Response
    {
        $referenz = Referenz::where('slug', $slug)->firstOrFail();

        return Inertia::render('Referenz/Show', [
            'referenz' => $referenz,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titel' => 'required|string|max:255',
            'ort' => 'nullable|string|max:255',
            'beschreibung' => 'nullable|string',
            'bilder' => 'nullable|string',
        ]);

        Referenz::create($request->all());

        return redirect()->route('admin.referenzen.index')->with('success', 'Referenz erstellt.');
    }

    public function create()
    {
        return Inertia::render('Admin/Referenzen/Create');
    }


    public function edit(Referenz $referenz)
    {
        return Inertia::render('Admin/Referenzen/Edit',  [
            'referenz' => $referenz,
        ]);
    }

    public function update(Request $request, Referenz $referenz)
    {
        $referenz->update($request->all());

        return redirect()->route('admin.referenzen.index')->with('success', 'Referenz aktualisiert.');
    }

    public function destroy(Referenz $referenz)
    {
        $referenz->delete();
        return back()->with('success', 'Referenz gelöscht.');
    }
}

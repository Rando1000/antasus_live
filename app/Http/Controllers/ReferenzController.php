<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Referenz;
use Inertia\Inertia;


class ReferenzController extends Controller
{
     public function index()
    {
        $referenzen = Referenz::select('id', 'slug', 'titel', 'beschreibung', 'bilder', 'ort')
            ->latest()
            ->get();

        return Inertia::render('Referenzen', [
            'referenzen' => $referenzen,
        ]);
    }


    public function show(string $slug)
    {
        $referenz = Referenz::where('slug', $slug)->firstOrFail();

        return Inertia::render('Referenz/Show', [
            'referenz' => $referenz,
        ]);
    }
}

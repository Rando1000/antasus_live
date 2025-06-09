<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TechnologienController extends Controller
{
    public function index()
    {
        return Inertia::render('Leistungen/Technologien', [
            'metaTitle'       => 'Technologien im Glasfaser-Hausanschluss & Tiefbau | ANTASUS Infra',
            'metaDescription' => 'Erfahren Sie alles über modernste Technologien für Glasfaser-Hausanschlüsse und Tiefbauverfahren. Von Bohr- & Einblasverfahren bis GPS-Vermessung.',
        ]);
    }
}

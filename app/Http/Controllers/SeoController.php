<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;

class SeoController extends Controller
{
     public function pillar()
    {
        return Inertia::render('Seo/Glasfaserbau');
    }
}

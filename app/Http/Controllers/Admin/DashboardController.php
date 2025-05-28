<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Referenz;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'services' => Service::count(),
                'items' => ServiceItem::count(),
                'referenzen' => Referenz::count(),
                'users' => User::count(),
            ],
        ]);
    }
}

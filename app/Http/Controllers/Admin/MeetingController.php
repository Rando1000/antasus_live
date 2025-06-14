<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MeetingBooking;
use Inertia\Inertia;

class MeetingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = MeetingBooking::orderBy('start', 'desc')->paginate(20);

        return Inertia::render('Admin/Bookings/Index', [
            'bookings' => $bookings,
        ]);
    }
}

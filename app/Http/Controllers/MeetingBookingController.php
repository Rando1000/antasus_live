<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PendingBooking;
use App\Models\MeetingBooking;
use App\Mail\BookingConfirmationMail;
use Inertia\Inertia;

class MeetingBookingController extends Controller
{






    public function store(Request $request)
{
    $data = $request->validate([
        'type' => 'required|in:online,praesenz',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'nullable|string',
        'topic' => 'nullable|string',
    ]);

    $token = Str::random(64);

    $booking = new MeetingBooking([
        'name' => $data->name,
        'email' => $data->email,
        'start' => $data->start,
        'end' => $data->end,
        'type' => $data->type,
        'topic' => $data->topic,
        'confirmation_token' => $token,
    ]);

    Mail::to($booking->email)->send(new ConfirmMeetingBooking($booking));

    return back()->with('status', 'Buchung eingegangen. Bitte E-Mail bestätigen.');
}

public function storePending(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:online,praesenz',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'name' => 'required|string',
            'email' => 'required|email',
            'topic' => 'nullable|string',
        ]);

        $token = Str::uuid();

        $pending = PendingBooking::create([
            ...$validated,
            'token' => $token,
        ]);

        Mail::to($pending->email)->send(new BookingConfirmationMail($pending));

        return response()->json(['message' => 'Confirmation sent']);
    }

public function confirm($token)
    {
        $pending = PendingBooking::where('token', $token)->firstOrFail();

        // Buchung in finaler Tabelle speichern
        MeetingBooking::create([
            'type' => $pending->type,
            'start' => $pending->start,
            'end' => $pending->end,
            'name' => $pending->name,
            'email' => $pending->email,
            'subject' => $pending->subject,
        ]);

        $pending->delete();

        return Inertia::render('Booking/ConfirmationSuccess'); // Optional: Danke-Seite
    }




}

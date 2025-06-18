<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendingBooking;
use App\Models\MeetingBooking;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\BookingConfirmationMail;
use Inertia\Inertia;


class BookingController extends Controller
{
    public function availableSlots(Request $request)
{
    $request->validate([
        'type' => 'required|string',
        'start' => 'required|date',
        'end' => 'required|date|after_or_equal:start',
    ]);

    $start = $request->start;
    $end = $request->end;

    // Alle bereits gebuchten Termine im gewählten Zeitraum
    $booked = \App\Models\MeetingBooking::whereBetween('start', [$start, $end])
        ->get(['start', 'end']);

    // Belegte Zeiten an FullCalendar zurückgeben
    return response()->json(
        $booked->map(fn ($b) => [
            'title' => 'Belegt',
            'start' => $b->start,
            'end' => $b->end,
            'display' => 'background',
            'color' => '#ccc',
        ])
    );
}


    public function storePending(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:beratung,angebot,hausanschluss,projektplanung',
            'mode' => 'required|in:online,praesenz',
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
            'topic' => $pending->topic,
            'confirmation_token' => $pending->token,
        ]);

        $pending->delete();

        return Inertia::render('Booking/ConfirmationSuccess'); // Optional: Danke-Seite
    }
}

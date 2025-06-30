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
            'mode' => $pending->mode,
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

    public function storeMulti(Request $request)
    {
        try {
        // 1) Spatie-Rolle prüfen (Middleware macht das eigentlich schon)
            if (! $request->user()->hasRole('admin')) {
                abort(403, 'Unauthorized');
            }

            // 2) Payload validieren
            $data = $request->validate([
                'type'         => 'required|in:beratung,angebot,hausanschluss,projektplanung',
                'mode'         => 'required|in:online,praesenz',
                'slots'        => 'required|array|min:1',
                'slots.*.start'=> 'required|date',
                'slots.*.end'  => 'required|date|after:slots.*.start',
                'name'         => 'nullable|string',
                'email'        => 'nullable|email',
                'topic'        => 'nullable|string',
            ]);

            // 3) Ein einziger Token für die ganze Buchung
            do {
                $token = Str::uuid()->toString();
            } while (MeetingBooking::where('confirmation_token', $token)->exists());

            // 4) Alle Slots anlegen
            $bookings = [];
            foreach ($data['slots'] as $slot) {
                $bookings[] = MeetingBooking::create([
                    'type'               => $data['type'],
                    'mode'               => $data['mode'],
                    'start'              => $slot['start'],
                    'end'                => $slot['end'],
                    'name'               => $data['name']  ?? $request->user()->name,
                    'email'              => $data['email'] ?? $request->user()->email,
                    'topic'              => $data['topic'] ?? null,
                    'confirmation_token' => $token,
                ]);
            }

            return response()->json([
                'message'  => 'Multi-Slot-Buchungen angelegt.',
                'bookings' => $bookings,
            ], 201);
            } catch (\Throwable $e) {
            \Log::error('storeMulti failed: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Fehler beim Anlegen der Buchungen: '.$e->getMessage(),
            ], 409);
        }

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminNewBookingMail;
use App\Mail\BookingConfirmationMail;
use App\Mail\MeetingConfirmedMail;
use App\Models\MeetingBooking;
use App\Models\PendingBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class PendingBookingController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'q' => 'nullable|string|max:255',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'per_page' => 'nullable|integer|min:5|max:100',
        ]);

        $q = $request->q;
        $from = $request->date_from;
        $to = $request->date_to;
        $perPage = $request->integer('per_page', 15);

        $pending = PendingBooking::query()
            ->when($q, function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    $qq->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('topic', 'like', "%{$q}%")
                        ->orWhere('type', 'like', "%{$q}%")
                        ->orWhere('mode', 'like', "%{$q}%");
                });
            })
            ->when($from, fn ($x) => $x->where('start', '>=', $from))
            ->when($to, fn ($x) => $x->where('end', '<=', $to))
            ->orderByDesc('start')
            ->paginate($perPage)
            ->withQueryString();

        return Inertia::render('Admin/PendingBookings', [
            'filters' => [
                'q' => $q,
                'date_from' => $from,
                'date_to' => $to,
                'per_page' => $perPage,
            ],
            'pending' => $pending,
        ]);
    }

    public function confirm($id)
    {
        DB::transaction(function () use ($id) {
            $p = PendingBooking::findOrFail($id);

            $meeting = MeetingBooking::create([
                'type' => $p->type,
                'mode' => $p->mode,
                'start' => $p->start,
                'end' => $p->end,
                'name' => $p->name,
                'email' => $p->email,
                'topic' => $p->topic,
                'confirmation_token' => $p->token,
                'confirmed_at' => now(),
            ]);

            // Pending nach Bestätigung löschen
            $p->delete();

            // Admin + Kunde informieren
            Mail::to(config('booking.admin_email', 'info@antasus.de'))
                ->send(new AdminNewBookingMail($meeting));
            Mail::to($meeting->email)
                ->send(new MeetingConfirmedMail($meeting));
        });

        return back()->with('success', 'Buchung manuell bestätigt.');
    }

    public function resend($id)
    {
        $p = PendingBooking::findOrFail($id);
        Mail::to($p->email)->send(new BookingConfirmationMail($p));

        return back()->with('success', 'Bestätigungs-E-Mail erneut gesendet.');
    }

    public function destroy($id)
    {
        $p = PendingBooking::findOrFail($id);
        $p->delete();

        return back()->with('success', 'Pending-Buchung gelöscht.');
    }
}

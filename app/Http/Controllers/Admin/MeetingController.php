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
        $query = MeetingBooking::query();

        // Suche nach Name oder E-Mail
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter nach Status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }
        if ($from = $request->input('from')) {
            $query->whereDate('start', '>=', $from);
        }
        if ($to = $request->input('to')) {
            $query->whereDate('end', '<=', $to);
        }
        if ($request->filled('mode')) {
            $query->where('mode', $request->input('mode'));
        }

        $perPage = $request->input('perPage', 20);

        $bookings = $query->orderBy('start', 'desc')->paginate($perPage)->withQueryString();

        return Inertia::render('Admin/Bookings/Index', [
            'bookings' => $bookings,
            'filters' => [
                'search' => $search,
                'status' => $status,
                'from' => $request->input('from'),
                'to' => $request->input('to'),
                'mode' => $request->input('mode'), // << KORRIGIERT!
            ],
        ]);
    }

    public function updateStatus(Request $request, MeetingBooking $booking)
    {
        $request->validate([
            'status' => 'required|in:neu,bearbeitet,abgesagt',
        ]);

        $booking->update(['status' => $request->status]);

        return redirect()->back();
    }

    public function destroy(MeetingBooking $booking)
{
    $booking->delete();

    return redirect()->back();
}
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Service;
use App\Models\MeetingBooking;
use App\Models\EmailCampaign;
use App\Models\ServiceItem;
use App\Models\Referenz;
use App\Models\Session;
use App\Models\User;
use App\Models\VisitorStat;
use Carbon\Carbon;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {

        $newBookings = MeetingBooking::where('status', 'neu')->latest()->take(5)->get();
        $newBookingCount = MeetingBooking::where('status', 'neu')->count();
        $stats = [
            'services'        => Service::count(),
            'referenzen'      => Referenz::count(),
            'messages'        => EmailCampaign::count(),
            'users'           => User::count(),
            'newBookings'     => MeetingBooking::where('created_at', '>=', now()->subDay())->get(),
            'newBookingCount' => MeetingBooking::where('created_at', '>=', now()->subDay())->count(),
        ];
        $threshold = Carbon::now()->subMinutes(5)->getTimestamp();
        // 2) Online-User (Beispiel mit Cache: einmal pro Minute aktualisieren)
        $userIds = DB::table('sessions')
            ->whereNotNull('user_id')
            ->where('last_activity', '>=', $threshold)
            ->pluck('user_id')
            ->unique()
            ->toArray();

        $onlineUsers = User::whereIn('id', $userIds)
        ->get(['id','name','email']);


        // 4) Alle User mit mindestens einer Rolle
      $usersWithRoles = User::with('roles')->get()->map(function($u) {
            return [
                'id'    => $u->id,
                'name'  => $u->name,
                'email' => $u->email,
                'roles' => $u->getRoleNames()->toArray(),
            ];
        });


        // dd($usersWithRoles);
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'services' => Service::count(),
                'items' => ServiceItem::count(),
                'referenzen' => Referenz::count(),
                'users' => User::count(),
                'newBookings' => $newBookings,
                'newBookingCount' => $newBookingCount,


            ],
            'onlineUsers'     => $onlineUsers,
            'usersWithRoles'  => $usersWithRoles,

        ]);
    }

    /**
     * Aktuell aktive Besucher (letzte 10 Minuten, nur Frontend).
     */
    public function activeVisitors(Request $request)
    {
        $since = now()->subMinutes(10);

        $count = VisitorStat::query()
            ->where('visited_at', '>=', $since)
            ->where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhereHas('user', function ($uq) {
                      $uq->whereDoesntHave('roles', function ($rq) {
                          $rq->where('name', 'admin');
                      });
                  });
            })
            ->distinct('session_id')
            ->count('session_id');

        return response()->json(['count' => $count]);
    }

    /**
     * Verlauf aktiver Besucher (Live-Charts).
     */
    public function activeVisitorsHistory(Request $request)
    {
        $range = $request->input('range', '1h');
        $now = now();

        [$interval, $points] = match ($range) {
            '6h'   => [10, 36],
            '24h'  => [60, 24],
            default => [2, 30],
        };

        $history = [];

        for ($i = $points - 1; $i >= 0; $i--) {
            $from = $now->copy()->subMinutes(($i + 1) * $interval);
            $to   = $now->copy()->subMinutes($i * $interval);

            $count = VisitorStat::query()
                ->whereBetween('visited_at', [$from, $to])
                ->where(function ($q) {
                    $q->whereNull('user_id')
                      ->orWhereHas('user', function ($uq) {
                          $uq->whereDoesntHave('roles', function ($rq) {
                              $rq->where('name', 'admin');
                          });
                      });
                })
                ->distinct('session_id')
                ->count('session_id');

            $history[] = [
                'time' => $to->format('H:i'),
                'count' => $count,
            ];
        }

        $current = VisitorStat::query()
            ->where('visited_at', '>=', $now->copy()->subMinutes(10))
            ->where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhereHas('user', function ($uq) {
                      $uq->whereDoesntHave('roles', function ($rq) {
                          $rq->where('name', 'admin');
                      });
                  });
            })
            ->distinct('session_id')
            ->count('session_id');

        return response()->json([
            'current' => $current,
            'history' => $history,
        ]);
    }

    public function visitorMap()
{
    try {
        $visitors = \App\Models\VisitorStat::latest('visited_at')
            ->limit(100)
            ->get(['ip_address', 'city', 'country', 'visited_at']);

        $geoData = $visitors->map(function ($v) {
            try {
                $geo = geoip($v->ip_address);
                return [
                    'city' => $v->city,
                    'country' => $v->country,
                    'latitude' => $geo->lat ?? null,
                    'longitude' => $geo->lon ?? null,
                    'visited_at' => $v->visited_at,
                ];
            } catch (\Exception $e) {
                return null;
            }
        })->filter()->values();

        return response()->json($geoData);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
    }
}

}

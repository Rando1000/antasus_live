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
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redis;

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

    public function activeVisitors()
    {
        try {
            $all = Redis::hgetall('site:active_visitors');
            $now = time();
            $recent = array_filter($all, fn($ts) => ($now - $ts) < 60);

            return response()->json([
                'count' => count($recent),
                'visitors' => $recent,
            ]);
        } catch (\Throwable $e) {
            \Log::error('Redis error: ' . $e->getMessage());
            return response()->json(['count' => 0, 'error' => $e->getMessage()], 500);
        }
    }

    public function activeVisitorsHistory(Request $request)
{
    $range = $request->input('range', '1h');
    $now = now();
    $result = [];

    if ($range === '1h') {
        $interval = 2; $points = 30;
    } elseif ($range === '6h') {
        $interval = 10; $points = 36;
    } else {
        $interval = 60; $points = 24;
    }

    $labels = [];
    $counts = [];
    try {
        for ($i = $points - 1; $i >= 0; $i--) {
            $time = $now->copy()->subMinutes($i * $interval);
            $key = 'visitors_stats:' . $time->format('YmdHi');
            $labels[] = $time->format('H:i');
            $count = (int) \Illuminate\Support\Facades\Redis::get($key);
            $counts[] = [
                'time' => $labels[count($labels) - 1],
                'count' => $count,
            ];
        }

        $active = \Illuminate\Support\Facades\Redis::hgetall('site:active_visitors');
        $current = 0;
        $nowTimestamp = time();
        foreach ($active as $ts) {
            if ($nowTimestamp - $ts < 600) $current++;
        }

        return response()->json([
            'current' => $current,
            'history' => $counts,
        ]);
    } catch (\Throwable $e) {
        \Log::error('Redis error (history): ' . $e->getMessage());
        return response()->json([
            'current' => 0,
            'history' => [],
            'error' => $e->getMessage(),
        ], 500);
    }
}
}

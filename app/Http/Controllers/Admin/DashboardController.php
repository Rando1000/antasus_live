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
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\VisitorStat;

class VisitorAnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $from       = $request->input('from', now()->subDays(30)->toDateString());
        $to         = $request->input('to', now()->toDateString());
        $search     = $request->input('search', '');
        $country    = $request->input('country', '');
        $city       = $request->input('city', '');
        $deviceType = $request->input('device_type', '');
        $perPage    = intval($request->input('per_page', 30));

        $query = VisitorStat::query()
            ->whereBetween('visited_at', [$from . ' 00:00:00', $to . ' 23:59:59']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('ip_address', 'like', "%$search%")
                  ->orWhere('user_agent', 'like', "%$search%")
                  ->orWhere('url', 'like', "%$search%");
            });
        }
        if ($country) {
            $query->where('country', $country);
        }
        if ($city) {
            $query->where('city', $city);
        }
        if ($deviceType) {
            $query->where('device_type', $deviceType);
        }

        // KPIs & Daten holen

        $uniqueVisitors = (clone $query)
            ->select(DB::raw('COUNT(DISTINCT CONCAT(ip_address, "-", user_agent)) as aggregate'))
            ->value('aggregate');

       $uniqueDevices = (clone $query)
            ->distinct('device_type')
            ->count('device_type');

        $byHour = VisitorStat::selectRaw('DATE_FORMAT(visited_at, "%Y-%m-%d %H:00:00") as hour, count(*) as count')
            ->whereBetween('visited_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $topCountries = VisitorStat::selectRaw('country, count(*) as count')
            ->whereBetween('visited_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
            ->groupBy('country')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        $topCities = VisitorStat::selectRaw('city, count(*) as count')
            ->whereBetween('visited_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
            ->groupBy('city')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        $totalVisits = VisitorStat::whereBetween('visited_at', [$from . ' 00:00:00', $to . ' 23:59:59'])->count();



        // Geräteverteilung nur, wenn Spalte da ist
        $deviceStats = [];
        if (\Schema::hasColumn('visitor_stats', 'device_type')) {
            $deviceStats = VisitorStat::selectRaw('device_type, count(*) as count')
                ->whereBetween('visited_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
                ->groupBy('device_type')
                ->orderByDesc('count')
                ->get();
        }
        // Dropdown-Auswahl für Filter (distinct values)
        $allCountries = VisitorStat::distinct()->pluck('country')->filter()->sort()->values();
        $allCities    = VisitorStat::distinct()->pluck('city')->filter()->sort()->values();
        $allDevices   = VisitorStat::distinct()->pluck('device_type')->filter()->sort()->values();

        // Tabelle für das Dashboard (mit Filter, Suche & Pagination)
        $results = $query->orderByDesc('visited_at')->paginate($perPage);

        // **NEU: Sauberer Kpi-Block**
        $kpis = [
            'total_visits'   => $totalVisits,
            'unique_visitors'=> $uniqueVisitors,
            'by_hour'        => $byHour,
            'top_countries'  => $topCountries,
            'top_cities'     => $topCities,
            'devices'        => $deviceStats,
            'unique_devices'        => $uniqueDevices,
        ];

        // Antwortstruktur wie von deinem Frontend erwartet:
        return response()->json([
            'kpis'      => $kpis,
            'stats'     => $results,
            'dropdowns' => [
                'countries' => $allCountries,
                'cities'    => $allCities,
                'devices'   => $allDevices,
            ],
        ]);
    }
}

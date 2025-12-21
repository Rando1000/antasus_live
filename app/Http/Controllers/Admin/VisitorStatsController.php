<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorStatsController extends Controller
{
    // Dashboard-Stats + List-API (paginiert, filterbar)
    public function index(Request $request)
    {
        $from = $request->input('from', now()->subDays(30)->toDateString());
        $to = $request->input('to', now()->toDateString());
        $search = $request->input('search', '');
        $country = $request->input('country', '');
        $city = $request->input('city', '');
        $deviceType = $request->input('device_type', '');
        $perPage = intval($request->input('per_page', 30));

        $query = VisitorStat::query()
            ->whereBetween('visited_at', ["$from 00:00:00", "$to 23:59:59"]);

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

        // KPIs
        $totalVisits = (clone $query)->count();
        $uniqueVisitors = (clone $query)->distinct('session_id')->count('session_id');
        $topCountries = (clone $query)
            ->select('country', DB::raw('count(*) as count'))
            ->groupBy('country')
            ->orderByDesc('count')
            ->take(10)
            ->get();
        $topDevices = (clone $query)
            ->select('device_type', DB::raw('count(*) as count'))
            ->groupBy('device_type')
            ->get();
        $uniqueDevices = (clone $query)->distinct('device_type')->count('device_type');

        $byHour = (clone $query)
            ->selectRaw('DATE_FORMAT(visited_at, "%Y-%m-%d %H:00:00") as hour, count(*) as count')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        // Filter Dropdowns
        $dropdowns = [
            'countries' => VisitorStat::select('country')->distinct()->pluck('country'),
            'cities' => VisitorStat::select('city')->distinct()->pluck('city'),
            'devices' => VisitorStat::select('device_type')->distinct()->pluck('device_type'),
        ];

        $stats = $query->orderByDesc('visited_at')->paginate($perPage)->withQueryString();

        return response()->json([
            'kpis' => [
                'total_visits' => $totalVisits,
                'unique_visitors' => $uniqueVisitors,
                'top_countries' => $topCountries,
                'devices' => $topDevices,
                'unique_devices' => $uniqueDevices,
                'by_hour' => $byHour,
            ],
            'stats' => $stats,
            'dropdowns' => $dropdowns,
        ]);
    }

    // DSGVO-konforme Einzel-Löschung
    public function destroy($id)
    {
        $deleted = VisitorStat::where('id', $id)->delete();

        return response()->json(['success' => $deleted > 0]);
    }

    // Bulk-Delete (z.B. für DSGVO-Auskunft/Löschungen)
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (! is_array($ids) || empty($ids)) {
            // Wenn keine IDs: alles löschen (Careful!)
            $count = VisitorStat::truncate();

            return response()->json(['success' => true, 'deleted' => 'all']);
        }
        $count = VisitorStat::whereIn('id', $ids)->delete();

        return response()->json(['success' => true, 'deleted' => $count]);
    }

    // ALLES löschen (z.B. Button "Alle Besucherstatistiken löschen")
    public function deleteAll()
    {
        VisitorStat::truncate();

        return response()->json(['success' => true]);
    }

    // Live-Active Visitors (Widget)
    public function active()
    {
        $threshold = now()->subMinutes(15);
        $activeVisitors = VisitorStat::where('visited_at', '>=', $threshold)
            ->distinct('session_id')
            ->count();

        return response()->json(['active' => $activeVisitors]);
    }
}

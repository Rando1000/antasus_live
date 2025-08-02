<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\VisitorStat; // Annahme: VisitorStat ist dein Eloquent Model für das echte Visitor-Log
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class VisitorAnalyticsController extends Controller
{
    /**
     * Dashboard-Daten als JSON (AJAX/Vue)
     */
    public function index(Request $request)
    {
        // Filter aus Request
        $from = $request->input('from', now()->subDays(30)->toDateString());
        $to = $request->input('to', now()->toDateString());
        $search = $request->input('search', '');
        $country = $request->input('country', '');
        $city = $request->input('city', '');
        $deviceType = $request->input('device_type', '');
        $perPage = intval($request->input('per_page', 30));

        // Basis-Query für Hauptliste
        $query = VisitorStat::query()
            ->whereBetween('visited_at', [$from . ' 00:00:00', $to . ' 23:59:59']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('ip_address', 'like', "%$search%")
                  ->orWhere('user_agent', 'like', "%$search%")
                  ->orWhere('url', 'like', "%$search%")
                  ->orWhere('country', 'like', "%$search%")
                  ->orWhere('city', 'like', "%$search%")
                  ->orWhere('referer', 'like', "%$search%");
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

        // Pagination
        $stats = $query->orderByDesc('visited_at')->paginate($perPage);

        // KPIs
        $totalVisits = VisitorStat::whereBetween('visited_at', [$from . ' 00:00:00', $to . ' 23:59:59'])->count();

        $uniqueVisitors = VisitorStat::whereBetween('visited_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
            ->distinct('ip_address')   // Alternativ: 'session_id'
            ->count('ip_address');

        $byHour = VisitorStat::selectRaw('DATE_FORMAT(visited_at, "%Y-%m-%d %H:00:00") as hour, COUNT(*) as count')
            ->whereBetween('visited_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $topCountries = VisitorStat::selectRaw('country, COUNT(*) as count')
            ->whereBetween('visited_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
            ->groupBy('country')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        $topCities = VisitorStat::selectRaw('city, COUNT(*) as count')
            ->whereBetween('visited_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
            ->groupBy('city')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        // Geräteverteilung (für Chart)
        $devices = VisitorStat::selectRaw('device_type, COUNT(*) as count')
            ->whereBetween('visited_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
            ->groupBy('device_type')
            ->orderByDesc('count')
            ->get();

        // Anzahl verschiedener Gerätetypen (unique)
        $uniqueDevices = $devices->count();

        // Summe aller Geräte-Besuche (total)
        $deviceVisits = $devices->sum('count');

        // Dropdowns für Filter (distinct)
        $countries = VisitorStat::whereNotNull('country')
            ->distinct('country')
            ->orderBy('country')
            ->pluck('country')
            ->filter()
            ->values();

        $cities = VisitorStat::whereNotNull('city')
            ->distinct('city')
            ->orderBy('city')
            ->pluck('city')
            ->filter()
            ->values();

        $deviceTypes = VisitorStat::whereNotNull('device_type')
            ->distinct('device_type')
            ->orderBy('device_type')
            ->pluck('device_type')
            ->filter()
            ->values();

        return response()->json([
            'kpis' => [
                'total_visits'    => $totalVisits,
                'unique_visitors' => $uniqueVisitors,
                'top_countries'   => $topCountries,
                'top_cities'      => $topCities,
                'devices'         => $devices,
                'unique_devices'  => $uniqueDevices,
                'device_visits'   => $deviceVisits,
                'by_hour'         => $byHour,
            ],
            'stats' => $stats,
            'dropdowns' => [
                'countries' => $countries,
                'cities'    => $cities,
                'devices'   => $deviceTypes,
            ],
        ]);
    }

    /**
     * CSV-Export (AJAX/Download)
     */
    public function export(Request $request)
    {
        $from = $request->input('from', now()->subDays(30)->toDateString());
        $to = $request->input('to', now()->toDateString());
        $search = $request->input('search', '');
        $country = $request->input('country', '');
        $city = $request->input('city', '');
        $deviceType = $request->input('device_type', '');

        $query = VisitorStat::query()
            ->whereBetween('visited_at', [$from . ' 00:00:00', $to . ' 23:59:59']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('ip_address', 'like', "%$search%")
                  ->orWhere('user_agent', 'like', "%$search%")
                  ->orWhere('url', 'like', "%$search%")
                  ->orWhere('country', 'like', "%$search%")
                  ->orWhere('city', 'like', "%$search%")
                  ->orWhere('referer', 'like', "%$search%");
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

        $rows = $query->orderByDesc('visited_at')->get();

        // CSV-Generierung
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="visitor_stats.csv"',
        ];

        $columns = [
            'visited_at', 'ip_address', 'country', 'city', 'device_type', 'url', 'referer', 'user_agent'
        ];

        $callback = function () use ($rows, $columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns, ';');
            foreach ($rows as $row) {
                fputcsv($handle, [
                    $row->visited_at,
                    $row->ip_address,
                    $row->country,
                    $row->city,
                    $row->device_type,
                    $row->url,
                    $row->referer,
                    $row->user_agent,
                ], ';');
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Einzel-Löschung eines Besuchers (z.B. per ID)
     */
    public function destroy($id)
    {
        $row = \App\Models\VisitorStat::findOrFail($id);
        $row->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Massen-Löschung nach IDs (AJAX)
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || empty($ids)) {
            return response()->json(['success' => false, 'message' => 'Keine IDs angegeben.'], 422);
        }
        $deleted = \App\Models\VisitorStat::whereIn('id', $ids)->delete();

        return response()->json(['success' => true, 'deleted' => $deleted]);
    }

    /**
     * ALLE Besucherstatistiken löschen (z.B. für "Alle löschen"-Button)
     */
    public function deleteAll(Request $request)
    {
        // Optional: Zugriffsbeschränkung/Rolle prüfen!
        \App\Models\VisitorStat::truncate();

        return response()->json(['success' => true, 'deleted' => 'all']);
    }
}

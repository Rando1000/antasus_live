<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorStat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class VisitorAnalyticsController extends Controller
{
    // harte Limits (DoS/Abuse-Schutz)
    private const MAX_RANGE_DAYS = 365;

    private const MAX_PER_PAGE = 200;

    private const DEFAULT_PER_PAGE = 10;

    private const MAX_SEARCH_LEN = 200;

    private const MAX_EXPORT_ROWS = 250000; // je nach Server/Anforderung anpassen

    public function __construct()
    {
        // Zusätzliche Absicherung (Route sollte das auch haben)
        // Gate/Policy: "viewAnalytics", "exportAnalytics", "deleteAnalytics"
        // Du kannst das an dein Permission-System anpassen (spatie/laravel-permission etc.)
    }

    public function index(Request $request)
    {

        $data = $this->validatedFilters($request);

        $query = $this->buildFilteredQuery($request, $data['from'], $data['to']);

        $stats = $query
            ->orderByDesc('visited_at')
            ->paginate($data['per_page'])
            ->withQueryString();

        // KPIs (Zeitraum-only, wie gehabt)
        $totalVisits = VisitorStat::whereBetween('visited_at', [$data['from_dt'], $data['to_dt']])->count();

        $uniqueVisitors = VisitorStat::whereBetween('visited_at', [$data['from_dt'], $data['to_dt']])
            ->distinct('ip_address')
            ->count('ip_address');

        $byHour = VisitorStat::selectRaw('DATE_FORMAT(visited_at, "%Y-%m-%d %H:00:00") as hour, COUNT(*) as count')
            ->whereBetween('visited_at', [$data['from_dt'], $data['to_dt']])
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $topCountries = VisitorStat::selectRaw('country, COUNT(*) as count')
            ->whereBetween('visited_at', [$data['from_dt'], $data['to_dt']])
            ->whereNotNull('country')->where('country', '!=', '')
            ->groupBy('country')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        $topCities = VisitorStat::selectRaw('city, COUNT(*) as count')
            ->whereBetween('visited_at', [$data['from_dt'], $data['to_dt']])
            ->whereNotNull('city')->where('city', '!=', '')
            ->groupBy('city')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        $devices = VisitorStat::selectRaw('device_type, COUNT(*) as count')
            ->whereBetween('visited_at', [$data['from_dt'], $data['to_dt']])
            ->whereNotNull('device_type')->where('device_type', '!=', '')
            ->groupBy('device_type')
            ->orderByDesc('count')
            ->get();

        $countries = VisitorStat::whereNotNull('country')->where('country', '!=', '')
            ->distinct()->orderBy('country')->pluck('country')->values();

        $cities = VisitorStat::whereNotNull('city')->where('city', '!=', '')
            ->distinct()->orderBy('city')->pluck('city')->values();

        $deviceTypes = VisitorStat::whereNotNull('device_type')->where('device_type', '!=', '')
            ->distinct()->orderBy('device_type')->pluck('device_type')->values();

        // Optional: Privacy – IP maskieren (UI)
        // Wenn du IPs im Frontend anzeigen willst: besser maskiert zurückgeben.
        $stats->getCollection()->transform(fn ($r) => tap($r, fn ($x) => $x->ip_address = $this->maskIp($x->ip_address)));

        return response()->json([
            'kpis' => [
                'total_visits' => $totalVisits,
                'unique_visitors' => $uniqueVisitors,
                'top_countries' => $topCountries,
                'top_cities' => $topCities,
                'devices' => $devices,
                'unique_devices' => $devices->count(),
                'device_visits' => (int) $devices->sum('count'),
                'by_hour' => $byHour,
            ],
            'stats' => $stats,
            'dropdowns' => [
                'countries' => $countries,
                'cities' => $cities,
                'devices' => $deviceTypes,
            ],
        ]);
    }

    public function export(Request $request)
    {

        $data = $this->validatedFilters($request);

        $query = $this->buildFilteredQuery($request, $data['from'], $data['to'])
            ->orderByDesc('visited_at');

        // Hard limit: verhindert Export-DoS
        $estimated = (clone $query)->count();
        if ($estimated > self::MAX_EXPORT_ROWS) {
            return response()->json([
                'success' => false,
                'message' => 'Export zu groß. Bitte Zeitraum/Filter einschränken.',
                'limit' => self::MAX_EXPORT_ROWS,
                'count' => $estimated,
            ], 422);
        }

        $fileName = 'visitor_stats_'.$data['from'].'_to_'.$data['to'].'.csv';

        $columns = [
            'visited_at',
            'ip_address',
            'country',
            'city',
            'device_type',
            'url',
            'referer',
            'user_agent',
        ];

        // Audit log (wer exportiert was?)
        Log::info('analytics_export', [
            'user_id' => optional($request->user())->id,
            'from' => $data['from'],
            'to' => $data['to'],
            'search' => $data['search'] !== '' ? '[set]' : '',
            'country' => $data['country'],
            'city' => $data['city'],
            'device_type' => $data['device_type'],
            'rows' => $estimated,
            'ip' => $request->ip(),
        ]);

        return Response::streamDownload(function () use ($query, $columns) {
            $handle = fopen('php://output', 'w');

            // Excel-freundlich
            fwrite($handle, "\xEF\xBB\xBF");

            // Headerzeile
            fputcsv($handle, $columns, ';');

            foreach ($query->cursor() as $row) {
                $fields = [
                    (string) $row->visited_at,
                    // Optional: echte IP oder maskiert – je nach Datenschutz:
                    (string) $row->ip_address,
                    (string) $row->country,
                    (string) $row->city,
                    (string) $row->device_type,
                    (string) $row->url,
                    (string) $row->referer,
                    (string) $row->user_agent,
                ];

                $sanitized = array_map([$this, 'sanitizeCsvField'], $fields);

                fputcsv($handle, $sanitized, ';');
            }

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'no-store, private',
            'Pragma' => 'no-cache',
        ]);
    }

    public function destroy($id)
    {

        $row = VisitorStat::findOrFail($id);
        $row->delete();

        Log::warning('analytics_delete_single', [
            'user_id' => optional(request()->user())->id,
            'visitor_stat_id' => $id,
            'ip' => request()->ip(),
        ]);

        return response()->json(['success' => true]);
    }

    public function bulkDelete(Request $request)
    {

        $validated = $request->validate([
            'ids' => ['required', 'array', 'min:1', 'max:5000'],
            'ids.*' => ['integer', 'distinct'],
        ]);

        $deleted = VisitorStat::whereIn('id', $validated['ids'])->delete();

        Log::warning('analytics_delete_bulk', [
            'user_id' => optional($request->user())->id,
            'count' => count($validated['ids']),
            'deleted' => $deleted,
            'ip' => $request->ip(),
        ]);

        return response()->json(['success' => true, 'deleted' => $deleted]);
    }

    public function deleteAll(Request $request)
    {

        VisitorStat::truncate();

        Log::critical('analytics_delete_all', [
            'user_id' => optional($request->user())->id,
            'ip' => $request->ip(),
        ]);

        return response()->json(['success' => true, 'deleted' => 'all']);
    }

    private function validatedFilters(Request $request): array
    {
        $validated = $request->validate([
            'from' => ['nullable', 'date_format:Y-m-d'],
            'to' => ['nullable', 'date_format:Y-m-d'],
            'search' => ['nullable', 'string', 'max:'.self::MAX_SEARCH_LEN],
            'country' => ['nullable', 'string', 'max:120'],
            'city' => ['nullable', 'string', 'max:120'],
            'device_type' => ['nullable', 'string', 'max:60'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:'.self::MAX_PER_PAGE],
        ]);

        $from = $validated['from'] ?? now()->subDays(30)->toDateString();
        $to = $validated['to'] ?? now()->toDateString();

        // Range Hardening
        $fromDate = \Carbon\Carbon::createFromFormat('Y-m-d', $from)->startOfDay();
        $toDate = \Carbon\Carbon::createFromFormat('Y-m-d', $to)->endOfDay();

        if ($toDate->lt($fromDate)) {
            // swap falls verdreht
            [$fromDate, $toDate] = [$toDate->startOfDay(), $fromDate->endOfDay()];
            $from = $fromDate->toDateString();
            $to = $toDate->toDateString();
        }

        if ($fromDate->diffInDays($toDate) > self::MAX_RANGE_DAYS) {
            // clamp auf MAX_RANGE_DAYS
            $fromDate = $toDate->copy()->subDays(self::MAX_RANGE_DAYS)->startOfDay();
            $from = $fromDate->toDateString();
        }

        $perPage = $validated['per_page'] ?? self::DEFAULT_PER_PAGE;

        return [
            'from' => $from,
            'to' => $to,
            'from_dt' => $fromDate->toDateTimeString(),
            'to_dt' => $toDate->toDateTimeString(),
            'per_page' => (int) $perPage,
            'search' => (string) ($validated['search'] ?? ''),
            'country' => (string) ($validated['country'] ?? ''),
            'city' => (string) ($validated['city'] ?? ''),
            'device_type' => (string) ($validated['device_type'] ?? ''),
        ];
    }

    private function buildFilteredQuery(Request $request, string $from, string $to): Builder
    {
        $search = (string) $request->input('search', '');
        $country = (string) $request->input('country', '');
        $city = (string) $request->input('city', '');
        $deviceType = (string) $request->input('device_type', '');

        $query = VisitorStat::query()
            ->whereBetween('visited_at', [$from.' 00:00:00', $to.' 23:59:59']);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('ip_address', 'like', "%{$search}%")
                    ->orWhere('user_agent', 'like', "%{$search}%")
                    ->orWhere('url', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('referer', 'like', "%{$search}%");
            });
        }

        if ($country !== '') {
            $query->where('country', $country);
        }
        if ($city !== '') {
            $query->where('city', $city);
        }
        if ($deviceType !== '') {
            $query->where('device_type', $deviceType);
        }

        return $query;
    }

    private function sanitizeCsvField(string $value): string
    {
        // normalize new lines (sauber für CSV)
        $value = str_replace(["\r\n", "\r"], "\n", $value);

        // trim extrem lange Felder (user_agent kann eskalieren)
        if (mb_strlen($value) > 2000) {
            $value = mb_substr($value, 0, 2000);
        }

        // CSV/Excel Injection: auch führende Whitespaces + Tab beachten
        $trimmed = ltrim($value);
        if ($trimmed !== '' && preg_match('/^([=\+\-@])/', $trimmed)) {
            return "'".$value;
        }

        return $value;
    }

    // Optional, wenn du IPs maskieren willst (GDPR/Privacy by Design)
    private function maskIp(?string $ip): ?string
    {
        if (! $ip) {
            return $ip;
        }

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $parts = explode('.', $ip);
            $parts[3] = '0';

            return implode('.', $parts);
        }

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            // grob maskiert
            return preg_replace('/^([0-9a-f:]{0,})(:[0-9a-f:]+){2,}$/i', '$1::', $ip);
        }

        return $ip;
    }
}

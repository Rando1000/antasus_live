<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\VisitorStat;
use Torann\GeoIP\Facades\GeoIP;

class TrackVisitor
{
    public function handle($request, Closure $next)
{
    $debug = app()->environment('local'); // Nur lokal debuggen

    $sessionId = $request->cookie('laravel_session') ?? session()->getId();
    $ip        = $request->ip();
    $agent     = substr($request->userAgent() ?? '', 0, 255);
    $path      = '/' . ltrim($request->path(), '/');
    $referer   = $request->header('referer');

    if (
        (Auth::check() && Auth::user()?->hasRole('admin')) ||
        $this->isExcludedPath($path) ||
        $this->isBot($agent) ||
        $this->isTechnicalRequest($request)
    ) {
        if ($debug) \Log::info("🔁 Ignoriert: $path [$ip]");
        return $next($request);
    }

    $deviceType = self::detectDevice($agent);
    $location   = \Torann\GeoIP\Facades\GeoIP::getLocation($ip);

    // --- neu: defensiv normalisieren ---
    $country     = $location->country ?? null;              // "Germany"
    $countryCode = strtoupper($location->iso_code ?? '');   // "DE" (oder leer)
    $region      = $location->state_name ?? null;
    $city        = $location->city ?? null;
    $lat         = $location->lat ?? $location->latitude ?? null;
    $lon         = $location->lon ?? $location->longitude ?? null;

    if (empty($country) || $country === 'Reserved') {
        if ($debug) \Log::warning("🌍 Ungültige GeoIP für $ip");
        return $next($request);
    }

    $recentVisit = VisitorStat::where('session_id', $sessionId)
        ->where('ip_address', $ip)
        ->orderByDesc('visited_at')
        ->first();

    if (!$recentVisit || now()->diffInSeconds($recentVisit->visited_at) > 120) {
        VisitorStat::create([
            'session_id'   => $sessionId,
            'user_id'      => Auth::id(),
            'ip_address'   => $ip,
            'user_agent'   => $agent,
            'device_type'  => $deviceType,
            'url'          => $path,
            'referer'      => $referer,
            'country'      => $country,
            'country_code' => $countryCode ?: null,   // ← neu
            'region'       => $region,
            'city'         => $city,
            'latitude'     => $lat,
            'longitude'    => $lon,
            'visited_at'   => now(),
        ]);

        if ($debug) \Log::info("✅ Besucher erfasst: $path [$ip]");
    } elseif ($debug) {
        \Log::info("⏱️ Besuch ignoriert: kürzlich erfasst [$ip]");
    }

    if ($debug) {
        \Log::debug('GeoIP result', [
            'ip'           => $ip,
            'country'      => $country,
            'country_code' => $countryCode,
            'city'         => $city,
            'lat'          => $lat,
            'lon'          => $lon,
        ]);
    }

    return $next($request);
}

    public static function detectDevice(string $agent): string
    {
        $agent = strtolower($agent);
        return match (true) {
            Str::contains($agent, 'mobile') && !Str::contains($agent, 'tablet') => 'Mobile',
            Str::contains($agent, 'tablet') => 'Tablet',
            Str::contains($agent, 'windows') || Str::contains($agent, 'macintosh') || Str::contains($agent, 'linux') => 'Desktop',
            default => 'Other',
        };
    }

    protected function isBot(string $userAgent): bool
    {
        return preg_match('/(bot|crawl|slurp|spider|mediapartners|facebookexternalhit|google|bing|duckduckbot|yandex|baidu|sogou|exabot|ia_archiver)/i', $userAgent);
    }

    protected function isTechnicalRequest($request): bool
    {
        return $request->ajax() ||
            $request->wantsJson() ||
            $request->header('X-Inertia') ||
            $request->header('Purpose') === 'prefetch';
    }

    protected function isExcludedPath(string $path): bool
    {
        $excludedPrefixes = [
            '/admin', '/dashboard', '/visitor-analytics',
            '/api', '/login', '/logout',
            '/jetstream', '/sanctum', '/password', '/_ignition',
        ];

        foreach ($excludedPrefixes as $prefix) {
            if (Str::startsWith($path, $prefix)) {
                return true;
            }
        }

        return false;
    }
}

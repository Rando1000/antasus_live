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

    // ⬇️ NEU: robuste IP-Ermittlung
    $ip = $this->clientIp($request);

    $agent   = substr($request->userAgent() ?? '', 0, 255);
    $path    = '/' . ltrim($request->path(), '/');
    $referer = $request->header('referer');

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

    $location = \Torann\GeoIP\Facades\GeoIP::getLocation($ip);

    // ⬇️ WICHTIG: Defaults/Privat-IP nie speichern
    if (
        empty($location->country) ||
        $location->country === 'Reserved' ||
        ($location->default ?? false) === true
    ) {
        if ($debug) \Log::warning('🌍 Ungültige/Default GeoIP', [
            'ip' => $ip,
            'loc' => method_exists($location, 'toArray') ? $location->toArray() : $location
        ]);
        return $next($request);
    }

    $recentVisit = VisitorStat::where('session_id', $sessionId)
        ->where('ip_address', $ip)
        ->orderByDesc('visited_at')
        ->first();

    if (!$recentVisit || now()->diffInSeconds($recentVisit->visited_at) > 120) {
        VisitorStat::create([
            'session_id'  => $sessionId,
            'user_id'     => Auth::id(),
            'ip_address'  => $ip,
            'user_agent'  => $agent,
            'device_type' => $deviceType,
            'url'         => $path,
            'referer'     => $referer,
            'country'     => $location->country ?? null,
            'region'      => $location->state_name ?? null,
            'city'        => $location->city ?? null,
            'latitude'    => $location->lat ?? null,
            'longitude'   => $location->lon ?? null,
            'visited_at'  => now(),
        ]);

        if ($debug) \Log::info("✅ Besucher erfasst: $path [$ip]");
    } elseif ($debug) {
        \Log::info("⏱️ Besuch ignoriert: kürzlich erfasst [$ip]");
    }

    if ($debug) {
        \Log::debug('GeoIP result', [
            'ip'      => $ip,
            'country' => $location->country,
            'city'    => $location->city,
            'lat'     => $location->lat,
            'lon'     => $location->lon,
            'default' => $location->default ?? null,
        ]);
    }

    return $next($request);
}

/**
 * Beste Client-IP ermitteln (Cloudflare/Proxy/Docker-fest)
 */
private function clientIp($request): string
{
    $candidates = [];

    // Cloudflare zuerst
    if ($h = $request->header('CF-Connecting-IP')) {
        $candidates[] = $h;
    }

    // Dann X-Forwarded-For (erste echte IP)
    if ($xff = $request->header('X-Forwarded-For')) {
        foreach (explode(',', $xff) as $part) {
            $candidates[] = trim($part);
        }
    }

    // X-Real-IP
    if ($xr = $request->header('X-Real-IP')) {
        $candidates[] = trim($xr);
    }

    // Fallback auf Laravel
    $candidates[] = $request->ip();

    // Erste gültige, öffentliche IP zurückgeben
    foreach ($candidates as $ip) {
        if ($this->isPublicIp($ip)) {
            return $ip;
        }
    }

    // Immerhin irgendwas
    return $candidates[0] ?? '127.0.0.1';
}

private function isPublicIp(string $ip): bool
{
    return (bool) filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
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

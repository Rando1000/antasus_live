<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\VisitorStat;

class TrackVisitor
{
    public function handle($request, Closure $next)
    {
        $debug = false;

        // === 1. Basisdaten vorbereiten ===
        $sessionId = $request->cookie('laravel_session') ?? session()->getId();
        $ip        = $request->ip();
        $agent     = substr($request->userAgent() ?? '', 0, 255);
        $path      = '/' . ltrim($request->path(), '/');
        $referer   = $request->header('referer');

        // === 2. Admins, Bots & technische Pfade ausschließen ===
        if (
            (Auth::check() && Auth::user()?->hasRole('admin')) ||
            $this->isExcludedPath($path) ||
            $this->isBot($agent) ||
            $this->isTechnicalRequest($request)
        ) {
            if ($debug) \Log::info("🔁 Ignoriert: $path [$ip]");
            return $next($request);
        }

        // === 3. Gerätekategorie erkennen ===
        $deviceType = self::detectDevice($agent);

        // === 4. GeoIP-Validierung & Koordinaten erfassen ===
        try {
            $location = geoip()->getLocation($ip);
        } catch (\Exception) {
            $location = (object)[];
        }

        // Nur speichern, wenn gültiges Land vorhanden
        if (empty($location->country) || $location->country === 'Reserved') {
            if ($debug) \Log::warning("🌍 Ungültige GeoIP für $ip");
            return $next($request);
        }

        // === 5. Wiederholte Besuche (innerhalb 2 Minuten) ausschließen ===
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

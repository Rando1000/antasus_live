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

        // === 1. Request-Infos vorbereiten ===
        $sessionId = $request->cookie('laravel_session') ?? session()->getId();
        $ip        = $request->ip();
        $userAgent = strtolower($request->userAgent() ?? '');
        $path      = '/' . ltrim($request->path(), '/');

        // === 2. Admins und Backends vollständig ausschließen ===
        if (
            (Auth::check() && Auth::user()?->hasRole('admin')) ||  // Rollenbasiert statt is_admin
            $this->isExcludedPath($path) ||
            $this->isBot($userAgent) ||
            $this->isTechnicalRequest($request)
        ) {
            if ($debug) \Log::info("🔁 Ignoriert: $path [$ip]");
            return $next($request);
        }

        // === 3. Device-Klassifizierung (Basic-Parser) ===
        $deviceType = match (true) {
            Str::contains($userAgent, 'mobile') && !Str::contains($userAgent, 'tablet') => 'Mobile',
            Str::contains($userAgent, 'tablet') => 'Tablet',
            Str::contains($userAgent, 'windows') || Str::contains($userAgent, 'macintosh') || Str::contains($userAgent, 'linux') => 'Desktop',
            default => 'Other'
        };

        // === 4. Standortdaten (failsafe)
        try {
            $location = geoip($ip);
        } catch (\Exception) {
            $location = (object)[];
        }

        // === 5. Nur tracken, wenn letzter Besuch > 120s zurückliegt
        $alreadyVisited = VisitorStat::where('session_id', $sessionId)
            ->where('ip_address', $ip)
            ->orderByDesc('visited_at')
            ->first();

        if (!$alreadyVisited || now()->diffInSeconds($alreadyVisited->visited_at) > 120) {
            VisitorStat::create([
                'session_id'  => $sessionId,
                'user_id'     => Auth::id(),
                'ip_address'  => $ip,
                'user_agent'  => substr($request->userAgent(), 0, 255),
                'device_type' => $deviceType,
                'url'         => $path,
                'referer'     => $request->header('referer'),
                'country'     => $location->country ?? null,
                'region'      => $location->state_name ?? null,
                'city'        => $location->city ?? null,
                'visited_at'  => now(),
                'latitude'  => $location->lat ?? null,
                'longitude' => $location->lon ?? null,
            ]);

            if ($debug) \Log::info("✅ Besucher erfasst: $path [$ip]");
        } elseif ($debug) {
            \Log::info("⏱️ Besuch zu kurz zurück: $path [$ip]");
        }

        return $next($request);
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

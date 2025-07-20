<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use App\Models\VisitorStat;
use Illuminate\Support\Str;
use Illuminate\Support\Log;

class TrackVisitor
{
    public function handle($request, Closure $next)
    {
        // Bei Admin-Pfaden keine Besucher-Statistik erfassen (optional)
        if (Str::startsWith($request->path(), 'admin')) {
            return $next($request);
        }

        $sessionId = $request->cookie('laravel_session') ?? session()->getId();
        $visitorKey = sha1($sessionId . '|' . ($request->userAgent() ?? ''));
        $ip = $request->ip(); // ZUERST definieren!
        $location = geoip($ip);

        \Log::info('GeoIP', [
            'ip' => $ip,
            'location' => $location ? $location->toArray() : null,
        ]);

        // Besucher als aktiv markieren
        $visitors = Cache::get('site:active_visitors', []);
        $visitors[$visitorKey] = time();
        Cache::put('site:active_visitors', $visitors, now()->addMinutes(15));

        // Schreibe nur einen Stat pro Session/IP+UserAgent und 30 Minuten
        $lastLogKey = 'visitor_lastlog_' . $visitorKey;
        $lastLogged = Cache::get($lastLogKey);

        // Max. 1x pro 30 Minuten einen Stat erfassen
        if (!$lastLogged || now()->diffInMinutes($lastLogged) > 30) {
            $location = geoip($request->ip());

            VisitorStat::create([
                'session_id'  => $sessionId,
                'user_id'     => auth()->id(),
                'ip_address'  => $request->ip(),
                'user_agent'  => substr($request->userAgent(), 0, 255),
                'url'         => $request->fullUrl(),
                'referer'     => $request->header('referer'),
                'country'     => $location->country ?? null,
                'region'      => $location->state_name ?? null,
                'city'        => $location->city ?? null,
                'visited_at'  => now(),
                // Optional: device_type, wenn du das analysierst
                // 'device_type' => $this->detectDevice($request->userAgent()),
            ]);
            Cache::put($lastLogKey, now(), now()->addMinutes(30));
        }

        return $next($request);
    }

    // Optional: Geräteerkennung via UserAgent (Mobile/Desktop/Tablet/Bot)
    protected function detectDevice($userAgent)
    {
        $agent = strtolower($userAgent);
        if (preg_match('/mobile|android|touch|webos|hpwos/', $agent)) return 'mobile';
        if (preg_match('/tablet|ipad/', $agent)) return 'tablet';
        if (preg_match('/bot|crawl|slurp|spider/', $agent)) return 'bot';
        return 'desktop';
    }
}

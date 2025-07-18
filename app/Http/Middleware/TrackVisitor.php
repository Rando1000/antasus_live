<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class TrackVisitor
{
    public function handle($request, Closure $next)
    {
        $sessionId = $request->cookie('laravel_session') ?? session()->getId();
        $visitorId = sha1($sessionId . '|' . ($request->userAgent() ?? ''));

        // Aktuellen Stand aus dem Cache holen
        $visitors = Cache::get('site:active_visitors', []);
        // Aktualisieren/neu eintragen
        $visitors[$visitorId] = time();

        // Im Cache speichern (z. B. für 15 Minuten)
        Cache::put('site:active_visitors', $visitors, now()->addMinutes(15));

        return $next($request);
    }
}


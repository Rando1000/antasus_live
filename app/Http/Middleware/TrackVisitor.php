<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class TrackVisitor
{
    public function handle($request, Closure $next)
    {
        // Ein einzigartiger Key pro Browser/Fenster
        $sessionId = $request->cookie('laravel_session') ?? session()->getId();
        $visitorId = sha1(
            $sessionId . '|' . ($request->userAgent() ?? '')
        );

        // Besucher als aktiv für 10 Minuten markieren
        Redis::hset('site:active_visitors', $visitorId, time());
        Redis::expire('site:active_visitors', 600);

        return $next($request);
    }
}

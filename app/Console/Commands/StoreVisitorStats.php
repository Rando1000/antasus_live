<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

class StoreVisitorStats extends Command
{
    protected $signature = 'stats:store-visitors';
    protected $description = 'Speichert die aktuelle Besucherzahl (aktive Besucher) in Redis als Zeitreihe.';

    public function handle()
    {
        // Aktuelle Zahl ermitteln (z. B. durch bereits bestehende Middleware):
        $all = Redis::hgetall('site:active_visitors');
        $now = Carbon::now();
        $timestamp = $now->format('YmdHi'); // z. B. 202507171547

        // Nur Besucher der letzten 10 Min zählen
        $recent = array_filter($all, fn($ts) => (time() - $ts) < 600);
        $current = count($recent);

        // Key für Zeitreihe bauen (Minute-genau)
        $statKey = "visitors_stats:{$timestamp}";

        // Wert setzen + Ablaufzeit (z.B. 3 Tage)
        Redis::set($statKey, $current);
        Redis::expire($statKey, 60 * 60 * 24 * 30); // 30 Tage Haltbarkeit

        $this->info("Aktive Besucher: $current gespeichert unter $statKey");
    }
}

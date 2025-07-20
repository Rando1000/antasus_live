<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class StoreVisitorStats extends Command
{
    protected $signature = 'stats:store-visitors';
    protected $description = 'Speichert die aktuelle Besucherzahl (aktive Besucher) im Cache als Zeitreihe.';

    public function handle()
    {
        // Holt alle aktiven Besucher aus dem Cache
        $all = Cache::get('site:active_visitors', []);

        // Zählt nur Besucher, die in den letzten 10 Minuten aktiv waren
        $recent = array_filter($all, function($ts) {
            return (time() - $ts) < 600;
        });
        $current = count($recent);

        // Zeitstempel als Key (pro Minute eindeutig)
        $now = Carbon::now();
        $statKey = "visitors_stats:" . $now->format('YmdHi');

        // Besucherzahl im Cache für 30 Tage speichern
        Cache::put($statKey, $current, now()->addDays(30));

        $this->info("Aktive Besucher: $current gespeichert unter $statKey");
        \Log::info('StatKey', ['key' => $statKey, 'current' => $current]);
    }
}

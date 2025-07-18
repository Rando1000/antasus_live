<?php

// namespace App\Console\Commands;

// use Illuminate\Console\Command;
// use Illuminate\Support\Facades\Cache;
// use Carbon\Carbon;

// class StoreVisitorStats extends Command
// {
//     protected $signature = 'stats:store-visitors';
//     protected $description = 'Speichert die aktuelle Besucherzahl (aktive Besucher) in Cache als Zeitreihe.';

//     public function handle()
//     {
//         $all = Cache::get('site:active_visitors', []);
//         $now = Carbon::now();
//         $timestamp = $now->format('YmdHi');

//         $recent = array_filter($all, fn($ts) => (time() - $ts) < 600);
//         $current = count($recent);

//         $statKey = "visitors_stats:{$timestamp}";
//         Cache::put($statKey, $current, now()->addDays(30)); // 30 Tage Haltbarkeit

//         $this->info("Aktive Besucher: $current gespeichert unter $statKey");
//     }
// }

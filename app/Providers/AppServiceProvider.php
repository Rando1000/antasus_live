<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        URL::forceRootUrl('https://www.antasus.de');
        URL::forceScheme('https');
        RateLimiter::for('admin', function (Request $request) {
            $key = $request->user()?->id
                ? 'admin-user-'.$request->user()->id
                : 'admin-ip-'.$request->ip();

            return Limit::perMinute(60)->by($key);
        });
    }
}

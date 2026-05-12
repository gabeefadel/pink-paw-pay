<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;       
use Illuminate\Support\Facades\RateLimiter;    
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        RateLimiter::for('donations', function (Request $request) {
            return Limit::perMinute(3)->by($request->user()?->uuid ?: $request->ip());
        });
    }
}

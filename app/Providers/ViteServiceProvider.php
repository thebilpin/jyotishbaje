<?php

namespace App\Providers;

use App\Services\ViteFallbackService;
use Illuminate\Support\ServiceProvider;

class ViteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Ensure Vite manifest exists in production
        if (config('app.env') === 'production') {
            ViteFallbackService::ensureManifest();
        }
    }
}
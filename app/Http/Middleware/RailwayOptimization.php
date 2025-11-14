<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RailwayOptimization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Set PHP timeouts for Railway environment
        if (config('app.env') === 'production') {
            set_time_limit(300); // 5 minutes max execution
            ini_set('max_input_time', 60);
            ini_set('default_socket_timeout', 30);
        }

        // Log slow requests
        $start = microtime(true);
        
        $response = $next($request);
        
        $duration = microtime(true) - $start;
        if ($duration > 5) { // Log requests taking more than 5 seconds
            Log::warning("Slow request detected", [
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'duration' => $duration,
                'user_id' => auth()->id(),
            ]);
        }

        return $response;
    }
}
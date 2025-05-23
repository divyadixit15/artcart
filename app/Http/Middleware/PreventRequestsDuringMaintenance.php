<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventRequestsDuringMaintenance
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the app is in maintenance mode
        if (app()->isDownForMaintenance()) {
            return response()->view('errors::503', [], 503);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentifyTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get current domain
        $host = $request->getHost();
        
        // Store domain in session for easy access
        session(['current_domain' => $host]);
        
        // Optional: You can also set it in config
        config(['app.current_domain' => $host]);
        
        return $next($request);
    }
}

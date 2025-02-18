<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsCoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== 'kasir') {
            return redirect()->route('page.dashboard');
        }

        return $next($request);
    }
}
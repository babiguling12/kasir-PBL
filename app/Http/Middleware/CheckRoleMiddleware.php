<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
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

        
        $role = auth()->user()->role;

        // $request->routeIs() untuk mengecek apakah route yang diakses sedang berjalan
        if ($role === 'kasir' && !$request->routeIs('kasir.dashboard')) {
            return redirect()->route('kasir.dashboard');
        } elseif ($role !== 'kasir' && !$request->routeIs('core.dashboard')) {
            return redirect()->route('core.dashboard');
        }

        return $next($request);
    }
}

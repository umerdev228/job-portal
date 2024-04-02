<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::user()->role === $roles[0] && request()->is('admin/*')) {
            return $next($request);
        }
        elseif (Auth::user()->role === $roles[0] && request()->is('seeker/*')) {
            return $next($request);
        }
        elseif (Auth::user()->role === $roles[0] && request()->is('provider/*')) {
            return $next($request);
        }
        else {
            return redirect()->route('home')->with('error', 'Unauthorized.');
        }
    }
}

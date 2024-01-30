<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        foreach ($role as $item) {
            if (Auth::user()->role == $item) {
                return $next($request);
            }
        }

        return redirect()->route('forbidden');
    }
}

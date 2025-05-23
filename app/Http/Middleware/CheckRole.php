<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        foreach ($roles as $role) {
            $method = 'is' . ucfirst(Str::camel($role));
            if (method_exists(auth()->user(), $method) && auth()->user()->$method()) {
            return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}

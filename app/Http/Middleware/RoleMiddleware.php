<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        // Not logged in
        if (!session('login_id')) {
            return redirect('/login');
        }

        // Wrong role
        if (session('login_role') !== $role) {
            return redirect('/login')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}
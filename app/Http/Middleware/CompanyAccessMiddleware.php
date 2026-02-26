<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyAccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            abort(403);
        }

        // Super Admin can access everything
        if ($user->hasRole('Super Admin')) {
            return $next($request);
        }

        // Normal user must have company_id
        if (!$user->company_id) {
            abort(403, 'No company assigned.');
        }

        return $next($request);
    }
}

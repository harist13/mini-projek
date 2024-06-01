<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        if ($user->hasAnyRole($roles)) {
            return $next($request);
        }

        if ($user->hasRole('user')) {
        
             abort(403, 'USER DOES NOT HAVE RIGHT ROLE');
        }

        return redirect('/login');
    }
}

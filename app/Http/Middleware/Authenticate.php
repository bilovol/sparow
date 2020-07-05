<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    public function handle($request, \Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            return response()->json('You shall not pass! 401 Unauthorized. With love your Gandalf!', 401);
        }

        return $next($request);
    }
}

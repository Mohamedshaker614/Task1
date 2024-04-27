<?php

namespace App\Http\Middleware;

use App\Utility\Guard;
use Closure;

class UserMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authUser = auth()->user();
        if (!$authUser) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Utility\Guard;
use Closure;

class AdminMiddleware
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
        $authUser = auth(Guard::ADMINS)->user();
        if (!$authUser) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}

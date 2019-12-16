<?php

namespace Cesi\Core\app\Http\Middleware;

use Closure;

class UseCesiAuthGuardInsteadOfDefaultAuthGuard
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        app('auth')->setDefaultDriver(config('cesi.core.guard'));

        return $next($request);
    }
}

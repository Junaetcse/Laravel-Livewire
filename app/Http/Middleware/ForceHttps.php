<?php

namespace App\Http\Middleware;

use Closure;

class ForceHttps
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
    //     if (config('app.https_redirect') === true and
    //     (
    //         !$request->secure() or
    //         (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) and $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'http')
    //     )
    // ) {
    //     return redirect()->secure($request->path());
    // }
        return $next($request);
    }
}

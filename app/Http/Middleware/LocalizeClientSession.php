<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocalizeClientSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('ClientLocale') || $request->hasHeader('clientlocale') || $request->hasHeader('client_locale')) {
            app()->setLocale(
                $request->header('ClientLocale', $request->header('clientlocale', $request->header('client_locale')))
            );
        }
        return $next($request);
    }
}

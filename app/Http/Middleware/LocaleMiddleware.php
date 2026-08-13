<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('locale') and in_array(session('locale'), ['tm', 'ru', 'en'])) {
            app()->setLocale(session('locale'));
        } else {
            app()->setLocale(env('APP_LOCALE', 'en'));
        }
        return $next($request);
    }
}

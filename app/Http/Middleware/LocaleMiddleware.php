<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', config('app.locale', 'tk'));

        if ($locale === 'tm') {
            $locale = 'tk';
        }

        if (in_array($locale, ['tk', 'ru', 'en'])) {
            app()->setLocale($locale);
        } else {
            app()->setLocale('tk');
        }

        return $next($request);
    }
}
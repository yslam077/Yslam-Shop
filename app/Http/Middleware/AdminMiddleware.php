<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Проверяем: 
        // 1. Авторизован ли пользователь в базе (Auth::check())
        // 2. Является ли он админом согласно колонке is_admin в БД
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect()->route('home.index')->with('error', 'Доступ ограничен!');
        }

        return $next($request);
    }
}
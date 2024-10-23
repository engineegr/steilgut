<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LocalizationMethod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $sessionStoredLocale = Session::get('STEILGUT_LOCALE');
        if ($sessionStoredLocale && !App::isLocale($sessionStoredLocale)) {
            App::setLocale($sessionStoredLocale);
        }
        return $next($request);
    }
}

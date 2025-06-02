<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = Session::get('locale', config('app.locale'));
        if (in_array($locale, ['en', 'ar'])) {
            App::setLocale($locale);
        } else {
            App::setLocale(config('app.fallback_locale'));
        }
        return $next($request);
    }
}
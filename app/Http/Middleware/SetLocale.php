<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        //dd(app('app_locale'));
        App::setLocale(app('app_locale'));
        return $next($request);
    }
}

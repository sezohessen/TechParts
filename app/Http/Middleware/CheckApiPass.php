<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckApiPass
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
        // Check Password
        if ($request->api_password !== env('API_PASSWORD','c956e699668df75c74f')) {
            return response()->json(['Message' => 'Unauthenticated: You need Api password to complete the process, contact the developer.']);
        }
        return $next($request);
    }
}

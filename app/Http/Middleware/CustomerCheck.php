<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerCheck
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
        try {
            if (auth('customer')->check()) {
                return $next($request);
            }
            return redirect()->route('home');
        } catch (\Throwable $th) {
            return redirect()->route('home');
        }
    }
}

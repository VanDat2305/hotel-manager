<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
            Alert::error(__('You need to login'));
            return redirect()->route('login');
        } catch (\Throwable $th) {
            return redirect()->route('home');
        }
    }
}

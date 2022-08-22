<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isManager
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
            $checkAdmin = Auth::check() && Auth::user()->role_id == config('custom.user_roles.admin');
            if ($checkAdmin) {
                return $next($request);
            }
            return redirect()->route('client.home');
        } catch (\Throwable $th) {
            return redirect()->route('client.home');
        }
    }
}

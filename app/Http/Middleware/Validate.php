<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class Validate
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
       
        if (
            auth()->check() &&
            (auth()->user()->hasRole('customer') || auth()->user()->status == User::STATUS_SUSPENDED)
        ) {
            auth()->logout();

            return redirect()->to('login')->withErrors(['email' => 'These credentials do not match our records.']);
        }

        return $next($request);
    }
}

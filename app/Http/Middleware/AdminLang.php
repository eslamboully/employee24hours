<?php

namespace App\Http\Middleware;

use Closure;

class AdminLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('admin-lang')) {
            App()->setLocale(session('admin-lang'));
        } else {
            App()->setLocale('en');
        }
        return $next($request);
    }
}

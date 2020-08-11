<?php

namespace App\Http\Middleware;

use Closure;

class CompanyLang
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
        if (session()->has('company-lang')) {
            App()->setLocale(session('company-lang'));
        } else {
            App()->setLocale('ar');
        }
        return $next($request);
    }
}

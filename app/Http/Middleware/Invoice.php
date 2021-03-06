<?php

namespace App\Http\Middleware;

use Closure;

class Invoice
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
        if(!$request->session()->has('data')){
            // dd($request->session()->has('data'));
            return redirect('/user');
        }
        return $next($request);
    }
}

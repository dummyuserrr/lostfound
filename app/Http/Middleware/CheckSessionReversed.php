<?php

namespace App\Http\Middleware;

use Closure;

class CheckSessionReversed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(session()->has('status')){
            abort(404); // user already logged in
        }else{
            return $next($request);
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserSession
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
            return $next($request);
        }else{
            session()->flash('loginfirst', 1);
            return redirect('/');
        }
    }
}

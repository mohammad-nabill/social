<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class test2
{
   
    public function handle(Request $request, Closure $next)
    {

        if(!auth()->user()){
            return redirect('login');
            
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class social
{
   
    public function handle(Request $request, Closure $next)
    {

        if(!auth()->user()){
            return redirect('social/login');
            
        }
        return $next($request);
    }
}

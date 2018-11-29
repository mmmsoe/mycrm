<?php

namespace App\Http\Middleware;

use Closure;

class UppercaseMakeModel
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
        header("Access-Control-Allow-Origin: *");
        
        $request->make = strtoupper($request->make);
        $request->model = strtoupper($request->model);

        return $next($request);
    }
}

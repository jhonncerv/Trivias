<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class caducanServicios
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
        $tiempo = Carbon::create(2017, 4, 20,0,0,0,'America/Mexico_City');
        if($tiempo->isPast()){
            return redirect()->route('despedida');
        }
        return $next($request);
    }
}

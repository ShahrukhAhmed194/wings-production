<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FestivalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $festival = $request->festival;
        if (!isset($festival->id)) return redirect('/')->with('error-alert2', 'Invalid Request.');
        if ($festival->registration_last_date < date('Y-m-d')) {
            return redirect('/')->with('error-alert2', 'Registration date is over.');
        }
        return $next($request);
    }
}

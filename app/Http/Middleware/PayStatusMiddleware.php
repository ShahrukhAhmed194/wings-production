<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PayStatusMiddleware
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
        if (Auth::user()->status != 'before_submit' && Auth::user()->payment_status == 'unpaid') {
            //return redirect()->route('user.pay')->with('error-alert2', 'Please pay now to active your membership.');
            return redirect()->route('user.pay');
        }
        return $next($request);
    }
}

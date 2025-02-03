<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MembershipMiddleware
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
        if (Auth::user()->status == 'before_submit') {
            return redirect()->route('user.form')->with('error-alert2', 'Please submit membership form!');
        }elseif(Auth::user()->status == 'pending'){
            return redirect()->route('userDashboard')->with('error-alert2', 'Your membership is not active!');
        }elseif(Auth::user()->status == 'canceled'){
            return redirect()->route('userDashboard')->with('error-alert2', 'Your membership account is canceled!');
        }elseif(!Auth::user()->member_id){
            return redirect()->route('userDashboard')->with('error-alert2', 'Your membership is not active!');
        }
        return $next($request);
    }
}

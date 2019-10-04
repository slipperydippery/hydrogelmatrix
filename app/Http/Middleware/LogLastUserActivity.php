<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Carbon\Carbon;

class LogLastUserActivity
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
        if($user = Auth::user()) {
            $user->seen_at = Carbon::now();
            $user->save();
        }

        return $next($request);
    }
}

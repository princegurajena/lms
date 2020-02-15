<?php

namespace App\Http\Middleware;

use Closure;

class UserMustCompleteProfile
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
        if (!auth()->user()->profile_completed)
        {
            return redirect('/profile')->with('message' , 'Please complete your profile');
        }

        return $next($request);
    }
}

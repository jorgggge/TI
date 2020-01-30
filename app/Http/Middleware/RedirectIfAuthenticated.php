<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //If logged in redirects user to home instead of accessing register route
         if (Auth::guard($guard)->check()) {
             $user = Auth::user();
             if($user->hasRole('superadmin')) {
                 return redirect('/superAdmin');
             } elseif ($user->hasRole('admin')) {
                 return redirect('/admin');
             } elseif ($user->hasRole('analista')) {
                 return redirect('/analista');
             } elseif ($user->hasRole('comun')){
                 return redirect('/comun');
             } else{
                 return redirect('/login');
             }
         }
        return $next($request);
    }
}
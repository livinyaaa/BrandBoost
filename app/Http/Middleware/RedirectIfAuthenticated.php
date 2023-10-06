<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string ...$guards
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
{
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            
            // Check user role and redirect appropriately.
            if($user->role == 0) {
                return redirect('/admin/dashboard');  // Updated
            } else if($user->role == 1) {
                return redirect('/business/dashboard');  // Updated
            }

            // Default redirection if the user role doesn't match any criteria.
            return redirect(RouteServiceProvider::HOME);
        }
    }

    return $next($request);
}

}


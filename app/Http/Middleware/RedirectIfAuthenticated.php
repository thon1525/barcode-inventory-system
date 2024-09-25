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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                
             //   return redirect(RouteServiceProvider::HOME);
            //     if(RouteServiceProvider::HOME){
            //         return redirect(RouteServiceProvider::HOME);
            //     }
            //     elseif(RouteServiceProvider::CUSTOMER){
            //         return redirect(RouteServiceProvider::CUSTOMER);
            //     }
            //     elseif(RouteServiceProvider::EMPLOYER){
            //     return redirect(RouteServiceProvider::EMPLOYER);
            //    }

            if ($guard === 'admin') {
                return redirect(RouteServiceProvider::HOME);
            } elseif ($guard === 'customer') {
                return redirect(RouteServiceProvider::CUSTOMER);
            } elseif ($guard === 'employee') {
                return redirect(RouteServiceProvider::EMPLOYER);
            }
            }
           
        }

        return $next($request);
    }
}

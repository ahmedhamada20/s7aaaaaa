<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckAdminLogin
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->roles()->first()->allowed_route == 'admin'  || Auth::user()->roles()->first()->allowed_route == 'supervisor' ) {
                return $next($request);
            } else {
                return Redirect::back();
            }
        }


    }

}

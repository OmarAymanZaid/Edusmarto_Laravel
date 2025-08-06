<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::check())
        {
            if(Auth::user()-> roleID == config('constants.role.STUDENT'))
            {
                return $next($request);
            }
            else
            {
                Auth::logout();
                return to_route('login.show');
            }
        }
        else
        {
            Auth::logout();
            return to_route('login.show');
        }
    }
}

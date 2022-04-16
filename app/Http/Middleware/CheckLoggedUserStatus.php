<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class CheckLoggedUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(isUserLogged()) {
//            \Log::info(varDump(auth()->user()->status, ' -1 CheckLoggedUserStatus auth()->user()->status::'));
//            \Log::info(varDump(Route::current()->getName(), ' -Route::current()->getName() $::'));
            if (Route::current()->getName() != 'logout.perform') {
                if (auth()->user()->status != 'A') {   //  N => New(Waiting activation), A=>Active, I=>Inactive
//                    \Log::info(varDump(-13, ' -13 Auth::logout()::'));
                    return redirect(route('logout.perform'));
                }
            }
        }

        return $next($request);
    }
}

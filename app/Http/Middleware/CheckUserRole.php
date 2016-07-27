<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class CheckUserRole
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

        $user_role = Auth::user()->role;
        if($user_role === 'admin'){
            // ako je prijavljeni korisnik admin tada ga pusti da izvrsi zahtjev
            return $next($request);
        }
        else{

            // abort(403, "Samo administrator moze pristupiti ovoj stranici");
            $message = "Samo administrator moze pristupiti ovoj stranici";
            $array = array('kod' => 403, 'poruka' => $message);
            return response($array,403)->header('Content-Type', 'application/json');
        }

    }
}

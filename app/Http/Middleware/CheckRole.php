<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if($user_role == 'admin'){
            // ako je prijavljeni korisnik admin tada ga pusti da izvrsi zahtjev
            return $next($request);
        }
        else{
            abort(403, "Samo administrator moze pristupiti ovoj stranici");
        }

    }
}

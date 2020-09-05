<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;

class logined
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
        $user = DB::selectOne("select * from users where id=?", [Auth::id()]);
        $cart_count = DB::select("select * from cart where user_id=?", [Auth::id()]);
        if ($user) {
            view()->share("username", $user->username);
            view()->share("cart_count", count($cart_count) );
            return $next($request);
        }      
        view()->share("username", "");
        return $next($request);
    }
}

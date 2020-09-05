<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class admin
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
        if (!Auth::check()) {
            
            return redirect("/login");
        }
        $admin = DB::selectOne("select * from role_users where user_id=?", [Auth::id()]);
        if($admin){
            return $next($request);
        }else{
            return redirect("/");
        }
        
    }
}

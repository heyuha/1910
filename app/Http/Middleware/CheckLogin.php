<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        // 判断用户是否登陆
        $adminuser = session('adminuser');
        // dd($adminuser);
        if(!$adminuser){

            // 从cookie取用户信息 如果有存入session
           $cookie_adminuser = request()->Cookie('adminuser');
            if($cookie_adminuser){
                session(['adminuser'=>unserialize($cookie_adminuser)]);
            }else{
                return redirect("/login");
            }
            
        }
        return $next($request);
    }
}

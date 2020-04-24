<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Login;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    public function logindo(Request $request){
    	$login = $request->except("_token");

    	$adminuser = Login::where('login_name',$login['login_name'])->first();
        //  dd(encrypt('123456'));
    	// dd(decrypt($adminuser->login_pwd));
    	if(decrypt($adminuser->login_pwd)!=$login['login_pwd']){
    		return redirect("/login")->with('msg','用户名或密码不对！');
    	}

        // 七天免登录
        if(isset($login['isrember'])){
            // 存入cookie
            Cookie::queue("adminuser",serialize($adminuser),24*60*7);
        }

    	session(["adminuser"=>$adminuser]);
    	return redirect("/goods");
    }

    public function test(){
        echo Cookie::get('num');
    }



}

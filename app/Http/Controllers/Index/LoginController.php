<?php

namespace App\Http\Controllers\Index;

use App\Mail\SendCodeEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Loginreg;
use App\Goods;
use DB;
use Illuminate\Support\Facades\Redis;
use App\Member;
class LoginController extends Controller
{
    
	// 登录
	public function login(){
		return view("index.login");
	}


	// 注册
	public function reg(){
		return view("index.reg");
	}

	// 手机号发送短信验证码
	public function sendSms(Request $request){
		$mobile = $request->mobile;
		$reg = '/^1[3|5|6|7|8|9]\d{9}$/';
		if(!preg_match($reg,$mobile)){
			echo json_encode(['code'=>'00001','msg'=>"手机号格式不正确"]);die;
		}

		// 生成随机验证码
		$code = rand(100000,999999);
		// 发送
		$res = $this->SendByMobile($mobile,$code);
		if($res['Message']=="OK"){
			session(['code',$code]);
			echo json_encode(['code'=>'00000','msg'=>"发送成功"]);die;
		}else{
			echo json_encode(['code'=>'00001','msg'=>"发送失败"]);die;
		}

	}


	public function SendByMobile($mobile,$code){
		// Download：https://github.com/aliyun/openapi-sdk-php
		// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md
		AlibabaCloud::accessKeyClient('LTAI4Fpn8d2VBz4Tx5BVApqV', '3DGzDSaCcyYcYxH80LJapEgDjSobh5')
		                        ->regionId('cn-hangzhou')
		                        ->asDefaultClient();
		try {
		    $result = AlibabaCloud::rpc()
		                          ->product('Dysmsapi')
		                          // ->scheme('https') // https | http
		                          ->version('2017-05-25')
		                          ->action('SendSms')
		                          ->method('POST')
		                          ->host('dysmsapi.aliyuncs.com')
		                          ->options([
		                                        'query' => [
		                                          'RegionId' => "cn-hangzhou",
		                                          'PhoneNumbers' => $mobile,
		                                          'SignName' => "宇豪影视",
		                                          'TemplateCode' => "SMS_185241548",
		                                          'TemplateParam' => "{code:$code}",
		                                        ],
		                                    ])
		                          ->request();
		    return $result->toArray();
		} catch (ClientException $e) {
		    return $e->getErrorMessage() . PHP_EOL;
		} catch (ServerException $e) {
		    return $e->getErrorMessage() . PHP_EOL;
		}
	}


	// 邮箱发送验证码
	public function sendEmail(Request $request){
		$email = $request->email;
		// PHP验证邮箱
		$reg = '/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/';
		if(!preg_match($reg,$email)){
			echo json_encode(['code'=>'00001','msg'=>"邮箱格式不正确"]);die;
		}

		// 生成随机验证码
		$code = rand(100000,999999);
		// 发送
		$res = $this->sendByEmail($email,$code);
		session(['code'=>$code]);
		
		echo json_encode(['code'=>'00001','msg'=>"发送成功"]);exit;
		
	}

	// 使用邮箱发送短信验证码
	public function sendByEmail($email,$code){
		Mail::to($email)->send(new SendCodeEmail($code));
	}


	// 执行注册添加
	public function regstore(Request $request){
		// 接值
		// $code = session("code");
		// dd($code);
		$regInfo = $request->except('_token','repassword');
		$res = Loginreg::create($regInfo);
		if($res){
			return redirect("/login");
		}
	}

	// 登录验证账号密码是否正确
	public function loginstore(Request $request){
		$login = $request->except("_token");
		// dd($login);
    	$memberInfo = Member::where('user_name',$login['user_name'])->first();
        //  dd(encrypt('123456'));
    	// dd(decrypt($adminuser->login_pwd));
    	// dd($memberInfo);
    	if(decrypt($memberInfo['user_pwd'])!=$login['user_pwd']){
    		return redirect("/login")->with('msg','用户名或密码不对！');
    	}

        
    	session(["member"=>$memberInfo]);
    	
    	if($login['refer']){
    		return redirect($post['refer']);
    	}
    	$goodsInfo = Goods::all();
		return view("/index/prolist",['goodsInfo'=>$goodsInfo]);

	}

	// 详情页
	public function proinfo($id){
		// dd($id);
		// Redis::del();
		$visit = Redis::setnx('visit_'.$id,1)?1:Redis::incr('visit_'.$id);

		// dd($visit);
		$goods = DB::table('goods')->where("goods_id",$id)->first();
		// dump($num);
		return view("/index/proinfo",['goodsInfo'=>$goods,'visit'=>$visit]);
	}


}

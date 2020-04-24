<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use App\Goods;
class CartController extends Controller
{
    // 介入购物车
    public function cartadd(){
    	// 接值
    	$buy_number = request()->buy_number;
    	$goods_id = request()->goods_id;
    	// echo $buy_number.'-'.$goods_id;
    	$user = session("member");
 		// dd($user);
    	// echo $goods_id;
    	// 判断用户是否登陆   
    	if(!$user){ 
    		ShowMsg("00001","未登录");
    	}
    	// 根据商品id查询商品表
    	$goodsInfo = Goods::select('goods_id','goods_name','goods_price','goods_img','goods_num')->first($goods_id);
    	// dd($goodsInfo);
    	// dd($goodsInfo->goods_num);

    	if($goodsInfo->goods_num < $buy_number){
    		// 如果购买数量大于库存提示库存不足
    		ShowMsg("00002","库存不足");
    	}

    	$where = [
    		'user_id' => $user->user_id,
    		'goods_id' => $goods_id
    	];
    	$cart = Cart::where($where)->first();
    	// dd($cart);
    	if($cart){
    		// 更新购买数量
    		$buy_number = $cart->buy_number + $buy_number;
    		// dd($buy_number);

    		if($goodsInfo->goods_num < $buy_number){
    			$buy_number = $goodsInfo->goods_num;
    		}
    		$res = Cart::where("cart_id",$cart->cart_id)->update(['buy_number'=>$buy_number]);

    	}else{
    		// 添加购物车数据
    		$data = [
    			'user_id'=>$user->user_id,
    			'buy_number'=>$buy_number,
    			'addtime'=>time()
    		];
    		$data = array_merge($data,$goodsInfo->toArray());
    		// dd($data);
    		unset($data['goods_num']);
    		$res = Cart::create($data);
    	}

    	if($res!==false){
    		ShowMsg("00000","成功");
    	}

    } 

    // 购物车
    public function cartcar(){
        
        $user_id = session("member")->user_id;
        // dd($user_id);
        $cart = \DB::select("select *,buy_number*goods_price as price from cart where user_id=?",[$user_id]);
        // dd($cart);

        // 每个商品的购买数量
        $buy_number = array_column($cart,'buy_number');
        // dd($count);

        //总商品购买数量
        $count = array_sum($buy_number);
        // dd($count);

        // 购物城id
        $cart_id = array_column($cart,'cart_id');
        // dd($cart_id);/
        $checkedbuynunber = array_combine($cart_id,$buy_number);
        // dd($checkedbuynunber);

        // 总价
        $totalprice = array_sum(array_column($cart,'price'));
        // dd($totalprice);

        return view("index.car",compact('cart','count','checkedbuynunber','totalprice'));
    }

    // 结算
    public function cartpay($id){
        // echo $id;
        $cartInfo = Cart::where('cart_id',$id)->first();
        // dd($cartInfo);
        return view("index.pay",['cartInfo'=>$cartInfo]);
    }





}

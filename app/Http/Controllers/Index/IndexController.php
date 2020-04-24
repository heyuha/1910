<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{



    public function index(){
    	// $slide = Cache::get('slide');
        // $slide = Redis::get('slide');
 // cache(['slide'=>$null],60);
        $slide = cache('slide');
        dump($slide);
    	// dump($slide);
    	if(!$slide){
    		// echo "DB==";
    		$slide = Goods::get();
            cache(['slide'=>$slide],60);
    		// Cache::put('slide',$slide,60);
            // $slide = serialize($slide);
            // Redis::setex('slide',60,$slide);

    	}
        // $slide = unserialize($slide);
    	// dd($slide);
    	return view("index.index",['slide'=>$slide]);
    }
}

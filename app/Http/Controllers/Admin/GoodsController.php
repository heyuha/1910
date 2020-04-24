<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGoodsPost;
use App\Cate;
use App\Brand;
use App\Goods;
use DB;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    	// 接受搜索的值
    	$cate_id = request()->cate_id;
    	$brand_id = request()->brand_id;
    	$goods_name = request()->goods_name;

    	// 拼接where
    	$where = [];

    	if($goods_name){
    		$where[] = ['goods_name','like',"%$goods_name%"];
    	}
    	if($cate_id){
    		$where[] = ['goods.cate_id',$cate_id];
    	}
    	if($brand_id){
    		$where[] = ['goods.brand_id',$brand_id];
    	}


    	// 获取到分类表数据
    	$cateInfo = Cate::all();
    	$cateInfo = createTree($cateInfo);
    	// dd($cateInfo);
    	// 获取到品牌表数据
    	$brandInfo = Brand::all();

        // 调用modelgoods封装的方法
        $goodsInfo = Goods::getGoods($where);

        // dd($goodsInfo);
       return view('admin.goods.index',['goodsInfo'=>$goodsInfo,'cateInfo'=>$cateInfo,'brandInfo'=>$brandInfo,'cate_id'=>$cate_id,'brand_id'=>$brand_id,'goods_name'=>$goods_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {	
    	// 获取分类表数据
    	$cateInfo = Cate::all();
    	// 调用无限极分类
    	$cateInfo = createTree($cateInfo);

    	// 获取品牌表数据
    	$brandInfo = Brand::all();
    	// dd($brandInfo);

       	return view("admin.goods.create",['cateInfo'=>$cateInfo,'brandInfo'=>$brandInfo]);
    }

   

     

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoodsPost $request)
    {
        //执行添加
        $post = $request->except("_token");
        // 处理单个图片
        if($request->hasFile('goods_img')){
            $post['goods_img'] = upload('goods_img');
        }

        // 上传相册
        if(isset($post['goods_imgs'])){
        	$imgs = $post['goods_imgs'] = moreupload('goods_imgs');
        	$post['goods_imgs'] = implode('|',$imgs);
        	// dd($post['goods_img']);
        }

        // 添加入库
        $res = Goods::create($post);
        if($res){
        	return redirect('/goods');
        }
    }


    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goodsInfo = DB::table('goods')->where("goods_id",$id)->first();
        // dd($res);
        // 查询分类数据
        $cateInfo = Cate::all();
        $cateInfo = createTree($cateInfo);
        // dd($cateInfo);
        // 查询品牌数据
        $brandInfo = Brand::all();
        return view('admin.goods.edit',['goodsInfo'=>$goodsInfo,'brandInfo'=>$brandInfo,'cateInfo'=>$cateInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGoodsPost $request, $id)
    {
        // dd($id);
        $post = $request->except("_token");
        // 处理单个图片
        if($request->hasFile('goods_img')){
            $post['goods_img'] = upload('goods_img');
        }

        // // 上传相册
        // if(isset($post['goods_imgs'])){
        //     $imgs = $post['goods_imgs'] = moreupload('goods_imgs');
        //     $post['goods_imgs'] = implode('|',$imgs);
        //     // dd($post['goods_img']);
        // }

        // 添加入库
        $res = Goods::where('goods_id',$id)->update($post);
        if($res!==false){
            return redirect('/goods');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Goods::where('goods_id',$id)->delete($id);
        if($res){
            return redirect('/goods');
        }

    }
}

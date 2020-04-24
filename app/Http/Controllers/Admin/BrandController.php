<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\StoreBrandPost;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 列表展示
    public function index()
    {

        // 接受搜索的值
        $brand_name = request()->brand_name;
        $where = [];
        if($brand_name){
            $where[] = ['brand_name','like',"%$brand_name%"];
        }

        // 获取偏移量
        $pageSize = config('app.pageSize');
        // dd($pageSize);
       $brand = DB::table('brand')->where($where)->paginate($pageSize);
       // dd($brand);
       dump(request()->ajax());
       // 判断是否是ajax请求
       if(request()->ajax()){
            return view('admin.brand.ajaxindex',['brand'=>$brand,'brand_name'=>$brand_name]);
       }
       return view("admin.brand.index",['brand'=>$brand,'brand_name'=>$brand_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.brand.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandPost $request)
    // public function store(Request $request)
    {
        // 获取所有的值
        // except 排除接受...
        // only 只接受、、、
        $post = $request->except(['_token']);
        // dump($post);die;

        // 获取图片
        if($request->hasFile('brand_img')){
            $post['brand_img'] = upload('brand_img');
        }

        

        $res = DB::table('brand')->insert($post);
        if($res){
            return redirect('/brand');
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
       //根据id获取记录信息
        $brand = DB::table('brand')->where('brand_id',$id)->first();
        return view("admin.brand.edit",['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = $request->except('_token');
        $res = DB::table('brand')->where('brand_id',$id)->update($post);
        if($res!==false){
            return redirect('/brand');
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
       $res = DB::table('brand')->where('brand_id',$id)->delete();
       if($res){
            return redirect("/brand");
       }
    }
}

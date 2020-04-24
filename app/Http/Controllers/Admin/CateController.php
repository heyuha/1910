<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cate;
use DB;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate = Cate::all();
        // 调用无限极分类
        $cate = createTree($cate);
        return view("admin.cate.index",['cate'=>$cate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Cate::all();
        // 调用无限极分类
        $cate=createTree($cate);
        // dd($cate);

        return view('admin.cate.create',['cate'=>$cate]);   
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->except("_token");
        $res = Cate::create($post);
        if($res){
            // 跳转
            return redirect("/cate");
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
        $res = DB::table('category')->where('cate_id',$id)->first();
        // 调用无限极分类
        // $res = $this->createTree($res);
        return view('admin.cate.edit',['cate'=>$res]);
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
        // 接值
        $post = $request->except("_token");
        $res = DB::table('category')->where("cate_id",$id)->update($post);
        if($res!==false){
            return redirect('/cate');
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
        $res = DB::table('category')->where('cate_id',$id)->delete();
        if($res){
            return redirect("/cate");
        }
    }
}

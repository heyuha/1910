<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminInfo = Admin::all();
        return view("admin.admin.index",['adminInfo'=>$adminInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo "ddd";
        return view("admin.admin.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 接值
        $post = $request->except("_token");
        // dd($post);
        // 处理时间
        $post['admin_time'] = time();
        // $post['admin_pwd'] = enctype($post['admin_pwd']);
        $res = Admin::create($post);
        if($res){
            return redirect("/admin");
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
        //修改第一个页面
        // 根据id获取记录信息
        $adminInfo = Admin::where('admin_id',$id)->first();
        return view("admin.admin.edit",['adminInfo'=>$adminInfo]);
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
        $post['admin_time'] = time();
        $res = Admin::where('admin_id',$id)->update($post);
        if($res!==false){
            return redirect("/admin");
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
        $res = Admin::where('admin_id',$id)->delete();
        if($res){
            return redirect('/admin');
        }
    }
}

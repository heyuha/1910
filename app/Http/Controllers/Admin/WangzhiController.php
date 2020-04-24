<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// 引入model
use App\Wangzhi;
use DB;
class WangzhiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取搜索的值
        $wangzhi_name = request()->wangzhi_name;
        // dd($wangzhi_name);
        $where = [];
        if($wangzhi_name){
            $where[] = ['wangzhi_name','like',"%$wangzhi_name%"];
        }

        $wangzhiInfo = Wangzhi::where($where)->paginate(3);
        // dd($wangzhiInfo);
        return view("admin.wangzhi.index",['wangzhiInfo'=>$wangzhiInfo,'wangzhi_name'=>$wangzhi_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $wangzhiInfo = Wangzhi::all();
        // dd($wangzhiInfo);
        return view("admin.wangzhi.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $wangzhiInfo = $request->except(['_token']);
        // dd($wangzhiInfo);
        // 处理单个图片
        if($request->hasFile('wangzhi_img')){
            $wangzhiInfo['wangzhi_img'] = upload('wangzhi_img');
        }
        // dd($wangzhiInfo);
        $res = Wangzhi::create($wangzhiInfo);
        if($res){
        	return redirect("/wangzhi");
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
        $wangzhiInfo = Wangzhi::where('wangzhi_id',$id)->first();
        // dd($wangzhiInfo);
        return view("admin.wangzhi.edit",['wangzhiInfo'=>$wangzhiInfo]);
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
        $wangzhiInfo = $request->except("_token");
        // 处理单个图片
        if($request->hasFile('wangzhi_img')){
            $wangzhiInfo['wangzhi_img'] = upload('wangzhi_img');
        }
        $res = Wangzhi::where('wangzhi_id',$id)->update($wangzhiInfo);
        if($res!==false){
            return redirect('/wangzhi');
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
        //
        $res = Wangzhi::where('wangzhi_id',$id)->delete($id);
        if($res){
            return redirect('/wangzhi');
        }
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    // 指定表明
    protected $table="goods";
    // 指定主键id
    protected $primarKey="goods_id";
    // 关闭时间chuo1
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];



    public static function getGoods($where){
    	$goodsInfo =  self::select('goods.*','category.cate_name','brand.brand_name')
        					->leftjoin("category",'goods.cate_id','=','category.cate_id')
        					->leftjoin('brand','goods.brand_id','=','brand.brand_id')
        					->where($where)
        					->paginate(3);

        return $goodsInfo;
    }
}

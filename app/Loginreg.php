<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loginreg extends Model
{
     // 指定表明
    protected $table="loginreg";
    // 指定主键id
    protected $primarKey="id";
    // 关闭时间chuo1
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}

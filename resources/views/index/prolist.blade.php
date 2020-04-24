@extends('layouts.shop')
@section('title','注册')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <form action="#" method="get" class="prosearch"><input type="text" /></form>
      </div>
     </header>
     <ul class="pro-select">
      <li class="pro-selCur"><a href="javascript:;">新品</a></li>
      <li><a href="javascript:;">销量</a></li>
      <li><a href="javascript:;">价格</a></li>
     </ul><!--pro-select/-->
     <div class="prolist">

      <dl>
       @foreach($goodsInfo as $k=>$v)
       <dt><a href="{{url('/login/proinfo/'.$v->goods_id)}}"><img src="http://uploads.1910.com/{{$v->goods_img}}" width="100" height="100" /></a></dt>
       
       <dd>
        <h3><a href="proinfo.html">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$v->goods_price}}</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
      @endforeach
       <div class="clearfix"></div>
      </dl>
      
      @endsection
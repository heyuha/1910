@extends('layouts.shop')
@section('title','购物车列表')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
      @csrf
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     @foreach($cart as $k=>$v)
     <div class="dingdanlist">
      <table>
        @if($k==0)
       <tr>
        <td width="100%" colspan="4">
          <a href="javascript:;"><input id="boxs" type="checkbox" name="1" /> 全选
          </a>
        </td>
       </tr>
       @endif
       <tr>
        <td width="4%"><input type="checkbox" value="{{$v->cart_id}}" class="box" name="1" /></td>
        <td class="dingimg" width="15%"><img src="http://uploads.1910.com/{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{date('Y-m-d H:i:s',$v->addtime)}}</time>
        </td>
        <td align="right"><input type="text" id="buy_{{$v->cart_id}}" value="{{$v->cart_id}}" class="spinnerExample" /></td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->goods_price}}</strong></th>
       </tr>
        <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">¥{{$totalprice}}</strong></td>
       <td width="40%"><a href="{{url('/cart/cartpay/'.$v->cart_id)}}" class="jiesuan">去结算</a></td>
      </tr>
      </table>
     </div><!--dingdanlist/-->
     @endforeach
     <div class="height1"></div>
     <div class="gwcpiao">
    </div><!--gwcpiao/-->
    </div><!--maincont-->



  <script>
    $("#boxs").click(function(){
        // alert(123)
        var _this = $(this)
        // 获取当前复选框状态是否选中
        var boxs = _this.prop("checked");
          $(".box").prop("checked",boxs);
          
    })
  </script>




      @endsection
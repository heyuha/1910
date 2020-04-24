<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
		<form action="">
			分类名称<select name="cate_id">
				<option value="0">请选择</option>
				@foreach($cateInfo as $k=>$v)
				<option value="{{$v->cate_id}}" @if($v->cate_id==$cate_id)selected;@endif>{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
				@endforeach
			</select>
			品牌名称<select name="brand_id">
				<option value="0">请选择</option>
				@foreach($brandInfo as $k=>$v)
				<option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
				@endforeach
			</select>
			商品名称<input type="text" value="{{$goods_name}}" name="goods_name">
					
			<input type="submit" value="搜索">
		</form>
		<table>
			<tr>
				<td>商品id</td>
				<td>商品名称</td>
				<td>商品货号</td>
				<td>商品价格</td>
				<td>商品图片</td>
				<td>商品相册</td>
				<td>商品库存</td>
				<td>分类名称</td>
				<td>所属品牌</td>
				<td>是否精品</td>
				<td>是否热卖</td>
				<td>是否显示</td>
				<td>是否幻灯片展示</td>
				<td>商品介绍</td>
				<td>操作</td>
			</tr>
			@foreach($goodsInfo as $v)
			<tr>
				<td>{{$v->goods_id}}</td>
				<td>{{$v->goods_name}}</td>
				<td>{{$v->goods_no}}</td>
				<td>{{$v->goods_price}}</td>
				<td><img src="http://uploads.1910.com/{{$v->goods_img}}" width="80pxs" alt=""></td>
				<td>
					@if(isset($v->goods_imgs))
					@php $imgs=explode('|',$v->goods_imgs);@endphp
						@foreach($imgs as $vv)
						<img src="http://uploads.1910.com/{{$vv}}" width="100px">
						@endforeach
					@endif
				</td>
				<td>{{$v->goods_num}}</td>
				<td>{{$v->cate_name}}</td>
				<td>{{$v->brand_name}}</td>
				<td>@if($v->is_best==1)是@endif @if($v->is_best==2)否@endif</td>
				<td>@if($v->is_hot==1)是@endif @if($v->is_hot==2)否@endif</td>
				<td>@if($v->is_show==1)是@endif @if($v->is_show==2)否@endif</td>
				<td>@if($v->is_slide==1)是@endif @if($v->is_slide==2)否@endif</td>
				<td>{{$v->goods_content}}</td>
				<td>
					<a href="{{url('/goods/destroy/'.$v->goods_id)}}">删除</a>
					<a href="{{url('/goods/edit/'.$v->goods_id)}}">修改</a>
				</td>
			</tr>
			@endforeach
		</table>
		{{$goodsInfo->links()}}
	</center>
</body>
</html>
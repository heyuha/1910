<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
		<!-- @if($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif -->
		<form action="{{url('/goods/update/'.$goodsInfo->goods_id)}}" method="post" enctype="multipart/form-data">
		<table>
			@csrf
			<tr>
				<td>商品名称</td>
				<td><input type="text" value="{{$goodsInfo->goods_name}}" name="goods_name"><span style="color:red">{{$errors->first('goods_name')}}</span></td>
			</tr>
			<tr>
				<td>商品货号</td>
				<td><input type="text" value="{{$goodsInfo->goods_no}}" name="goods_no"></td>
			</tr>
			<tr>
				<td>商品价格</td>
				<td><input type="text" value="{{$goodsInfo->goods_price}}" name="goods_price"><span style="color:red">{{$errors->first('goods_price')}}</span></td>
			</tr>
			<tr>
				<td>商品图片</td>
				<td><input type="file" name="goods_img"></td>
			</tr>
			<tr>
				<td>商品相册</td>
				<td><input type="file" name="goods_imgs[]" multiple="multiple"></td>
			</tr>
			<tr>
				<td>商品库存</td>
				<td><input type="text"  value="{{$goodsInfo->goods_num}}" name="goods_num"><span style="color:red">{{$errors->first('goods_num')}}</span></td>
			</tr>
			<tr>
				<td>分类名称</td>
				<td>
					<select name="cate_id" id="">
						<option value="">请选择</option>
						@foreach($cateInfo as $v)
						<option value="{{$v->cate_id}}">{{str_repeat('|-',$v->level)}}{{$v->cate_name}}</option>
						@endforeach
					</select>
					<span style="color:red">{{$errors->first('cate_id')}}</span>
				</td>
			</tr>
			<tr>
				<td>所属品牌</td>
				<td>
					<select name="brand_id">
						<option value="">请选择</option>
						@foreach($brandInfo as $v)
						<option value="{{$v->brand_id}}" @if($goodsInfo->brand_id==$v->brand_id);selected;@endif>{{$v->brand_name}}</option>
						@endforeach
					</select>
					<span style="color:red">{{$errors->first('brand_id')}}</span>
				</td>
			</tr>
			<tr>
				<td>是否精品</td>
				<td>
					<input type="radio" name="is_best" @if($goodsInfo->is_best==1)checked @endif value="1">是
					<input type="radio" name="is_best" @if($goodsInfo->is_best==2)checked @endif  value="2">否
				</td>
			</tr>
			<tr>
				<td>是否热卖</td>
				<td>
					<input type="radio" name="is_hot" @if($goodsInfo->is_hot==1)checked @endif  value="1">是
					<input type="radio" name="is_hot" @if($goodsInfo->is_hot==2)checked @endif  value="2">是
				</td>
			</tr>
			<tr>
				<td>是否显示</td>
				<td>
					<input type="radio" name="is_show" @if($goodsInfo->is_show==1)checked @endif  value="1">是
					<input type="radio" name="is_show" @if($goodsInfo->is_show==2)checked @endif  value="2">是
				</td>
			</tr>
			<tr>
				<td>商品介绍</td>
				<td>
					<textarea name="goods_content" id="" cols="30" rows="10">{{$goodsInfo->goods_content}}</textarea>
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="添加"></td>
				<td></td>
			</tr>
		</table>
		</form>
	</center>
</body>
</html>
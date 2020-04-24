<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- <mate name="csrf-token" content="{{ csrf_token() }}"> -->
</head>
<body>
	<center>
		<a href="{{url('/brand/create')}}">添加</a>
	
	<form action="">
		商品名称<input type="text" value="{{$brand_name}}" name="brand_name">
		<input type="submit" value="搜索">
	</form>

		<table>
			<tr>
				<th>商品id</th>
				<th>商品名称</th>
				<th>商品网址</th>
				<th>商品logo</th>
				<th>商品介绍</th>
				<th>操作</th>
			</tr>
			<tbody id="pageitem">
			@foreach($brand as $v)
			<tr>
				<td>{{$v->brand_id}}</td>
				<td>{{$v->brand_name}}</td>
				<td>{{$v->brand_url}}</td>
				<td><img src="http://uploads.1910.com/{{$v->brand_img}}" width="80px"></td>
				<td>{{$v->brand_content}}</td>
				<td>
					<a href="{{url('/brand/destroy/'.$v->brand_id)}}">删除</a>
					<a href="{{url('/brand/edit/'.$v->brand_id)}}">修改</a>
				</td>
			</tr>
			@endforeach
			</tbody>
		</table>
		{{$brand->appends(['brand_name'=>$brand_name])->links()}}
	</center>
</body>
</html>
<script src="/jquery.js"></script>
<script>
	$(document).ready(function(){
		$(document).on("click",'.page-link a',function(){

			var url = $(this).attr("href");
			// alert(url)
			$.get(url,function(res){
				$("#pageitem").html(res);
			})
			// $.ajaxSetup({ headres: {'X-XSRF-TOKEN':$('make[name="csrf-token"]').attr('content')} })
			// $.post(url,function(res){
			// 	$("#pageitem").html(res);
			// })

			return false;
		});
	})
</script>
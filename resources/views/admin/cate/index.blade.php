<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
		<a href="{{url('/cate/create')}}">添加</a>
	
	

		<table>
			<tr>
				<td>分类id</td>
				<td>分类名称</td>
				<td>是否显示</td>
				<td>是否在导航展示</td>
				<td>操作</td>
			</tr>
			@foreach($cate as $v)
			<tr>
				<td>{{$v->cate_id}}</td>
				<td>{{str_repeat('|—',$v->level)}}{{$v->cate_name}}</td>
				<td>@if($v->cate_show==1)是@endif @if($v->cate_show==2)否@endif</td>
				<td>@if($v->cate_nav_show==1)是@endif @if($v->cate_nav_show==2)否@endif</td>
				<td>
					<a href="{{url('/cate/destroy/'.$v->cate_id)}}">删除</a>
					<a href="{{url('/cate/edit/'.$v->cate_id)}}">修改</a>
				</td>
			</tr>
			@endforeach
		</table>
		
	</center>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
		<form action="">
			网站名称<input type="text" value="{{$wangzhi_name}}" name="wangzhi_name">
			<input type="submit" value="搜索">
		</form>
		<table>
			<tr>
				<td>网站id</td>
				<td>网站名称</td>
				<td>网站网址</td>
				<td>网站logo</td>
				<td>连接类型</td>
				<td>状态</td>
				<td操作></td>
			</tr>
			@foreach($wangzhiInfo as $k=>$v)
			<tr>
				<td>{{$v->wangzhi_id}}</td>
				<td>{{$v->wangzhi_name}}</td>
				<td>{{$v->wangzhi_wangzhi}}</td>
				<td><img src="http://uploads.1910.com/{{$v->wangzhi_img}}" width="80px"></td>
				<td>@if($v->wangzhi_leixing==1)是@endif @if($v->wangzhi_leixing==2)否@endif</td>
				<td>@if($v->is_show==1)是@endif @if($v->is_show==2)否@endif</td>
				<td>
					<a href="{{url('/wangzhi/destroy/'.$v->wangzhi_id)}}">删除</a>
					<a href="{{url('/wangzhi/edit/'.$v->wangzhi_id)}}">修改</a>
				</td>
			</tr>
			@endforeach
		</table>
		{{$wangzhiInfo->links()}}
	</center>
</body>
</html>
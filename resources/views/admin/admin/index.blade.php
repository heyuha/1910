<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
		<table border=1>
			<tr>
				<td>管理员id</td>
				<td>管理员账号</td>
				<td>管理员手机号</td>
				<td>管理员邮箱</td>
				<td>添加时间</td>
				<td>操作</td>
			</tr>
			@foreach($adminInfo as $k=>$v)
			<tr>
				<td>{{$v->admin_id}}</td>
				<td>{{$v->admin_name}}</td>
				<td>{{$v->admin_tel}}</td>
				<td>{{$v->admin_email}}</td>
				<td>{{date('Y-m-d H:i:s',$v->admin_time)}}</td>
				<td>
					<a href="{{url('/admin/destroy/'.$v->admin_id)}}">删除</a>
					<a href="{{url('/admin/edit/'.$v->admin_id)}}">修改</a>
				</td>
			</tr>
			@endforeach
		</table>
	</center>
</body>
</html>
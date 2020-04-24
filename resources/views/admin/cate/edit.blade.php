<!doctype html>
<html lang="en">
<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
<head>
	<meta charset="UTF-8">
	<title>Document</title>

</head>
<body>
	<center>
		<form action="{{url('/cate/update/'.$cate->cate_id)}}" method="post">
		<table>
			@csrf
			<tr>
				<td>分类名称</td>
				<td><input type="text" name="cate_name" value="{{$cate->cate_name}}"></td>
			</tr>
			<tr>
				<td>父级分类</td>
				<td>
					<select name="p_id">
						<option value="">请选择</option>
						
					</select>
				</td>
			</tr>
			<tr>
				<td>是否展示</td>
				<td>
					<input type="radio"  value="1" name="cate_show">是
					<input type="radio" value="2" name="cate_show">否	
				</td>
			</tr>
			<tr>
				<td>是否在导航栏展示</td>
				<td>
					<input type="radio"  value="1" name="cate_nav_show">是
					<input type="radio" value="2" name="cate_nav_show">否
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
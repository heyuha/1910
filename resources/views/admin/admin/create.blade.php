<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
		<form action="{{url('/admin/store')}}" method="post">
			<table>
				@csrf
				<tr>
					<td>管理员帐号</td>
					<td><input type="text" name="admin_name"></td>
				</tr>
				<tr>
					<td>管理员手机号</td>
					<td><input type="text" name="admin_tel"></td>
				</tr>
				<tr>
					<td>管理员邮箱</td>
					<td><input type="text" name="admin_email"></td>
				</tr>
				<tr>
					<td>管理员密码</td>
					<td><input type="text" name="admin_pwd"></td>
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
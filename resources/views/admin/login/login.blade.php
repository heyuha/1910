<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
		<b style="color:red">{{session('msg')}}</b>
		<form action="{{url('/login/logindo')}}" method="post">
		<table>
			@csrf
			<tr>
				<td>用户名</td>
				<td><input type="text" name="login_name"></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type="password"  name="login_pwd"></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="isrember">七天免登录</td>
			</tr>
			<tr>
				<td><input type="submit" value="登录"></td>
				<td></td>
			</tr>
		</table>
		</form>
	</center>
</body>
</html>
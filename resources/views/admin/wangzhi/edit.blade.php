<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>

		<form action="{{url('/wangzhi/update/'.$wangzhiInfo->wangzhi_id)}}" method="post" enctype="multipart/form-data">
			<table>
				@csrf
				<tr>
					<td>网站名称</td>
					<td><input type="text" value={{$wangzhiInfo->wangzhi_name}} name="wangzhi_name"></td>
				</tr>
				<tr>
					<td>网站网址</td>
					<td><input type="text" value={{$wangzhiInfo->wangzhi_wangzhi}} name="wangzhi_wangzhi"></td>
				</tr>
				<tr>
					<td>连接类型</td>
					<td>
						<input type="radio" name="wangzhi_leixing" @if($wangzhiInfo->wangzhi_leixing==1)checked @endif  value="1" >是
						<input type="radio" name="wangzhi_leixing" @if($wangzhiInfo->wangzhi_leixing==2)checked @endif  value="2">否
					</td>
				</tr>
				<tr>
					<td>图片logo</td>
					<td><input type="file" name="wangzhi_img">
						<img src="http://upload.1910.com/{{$wangzhiInfo->wangzhi_img}}" width="80px">
					</td>
				</tr>
				<tr>
					<td>网站联系人</td>
					<td><input type="text" value={{$wangzhiInfo->wangzhi_man}}  name="wangzhi_man"></td>
				</tr>
				<tr>
					<td>网站介绍</td>
					<td>
						<textarea name="wangzhi_desc" id="" cols="30" rows="10">{{$wangzhiInfo->wangzhi_desc}}</textarea>
					</td>
				</tr>
				<tr>
					<td>是否显示</td>
					<td>
						<input type="radio" name="is_show" @if($wangzhiInfo->is_show==1)checked @endif value="1">是
						<input type="radio" name="is_show" @if($wangzhiInfo->is_show==2)checked @endif value="2">否
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
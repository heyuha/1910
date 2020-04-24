<tbody>
			@foreach($brand as $v)
			<tr id="pageitem">
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
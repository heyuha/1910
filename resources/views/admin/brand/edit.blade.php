<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <center>
    <form action="{{url('/brand/update/'.$brand->brand_id)}}" method="post">
      <table>
        @csrf
        <tr>
          <td>品牌名称</td>
          <td><input type="text" value="{{$brand->brand_name}}" name="brand_name">
            <span style="color:yellow">{{$errors->first('brand_name')}}</span></td>
        </tr>
        <tr>
          <td>品牌网址</td>
          <td><input type="text" value="{{$brand->brand_url}}" name="brand_url">
              <span style="color:yellow">{{$errors->first('brand_url')}}</span>
          </td>
        </tr>
        <tr>
          <td>品牌logo</td>
          <td><input type="file" name="brand_img"></td>
        </tr>
        <tr>
          <td>品牌描述</td>
          <td>
            <textarea name="brand_content" id="" cols="30" rows="10">{{$brand->brand_content}}</textarea>
          </td>
        </tr>
        <tr>
          <td>添加</td>
          <td><input type="submit" value="修改"></td>
        </tr>
      </table>
    </form>
  </center>
</body>
</html>
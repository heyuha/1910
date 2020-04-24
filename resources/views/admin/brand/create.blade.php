<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <center>
    <form action="{{url('/brand/store')}}" method="post" enctype="multipart/form-data">
      <table>
        @csrf
        <tr>
          <td>品牌名称</td>
          <td><input type="text" name="brand_name">
            <span style="color:yellow">{{$errors->first('brand_name')}}</span></td>
        </tr>
        <tr>
          <td>品牌网址</td>
          <td><input type="text" name="brand_url">
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
            <textarea name="brand_content" id="" cols="30" rows="10"></textarea>
          </td>
        </tr>
        <tr>
          <td>添加</td>
          <td><input type="submit" value="添加"></td>
        </tr>
      </table>
    </form>
  </center>
</body>
</html>
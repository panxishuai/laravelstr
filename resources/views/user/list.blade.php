<!DOCTYPE html>
<html>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>添加页面</title>
<table>

    <tr>
        <td>ID</td>
        <td>用户名</td>
        <td>密码</td>
        <td>操作</td>
    </tr>
    @foreach($user as $k =>$v)
    <tr>
        <td>{{ $v->id }}</td>
        <td>{{ $v->username }}</td>
        <td>{{ $v->password }}</td>
        <td><a href="/user/edit/{{ $v->id }}">修改</a><a href="">删除</a></td>
    </tr>
    @endforeach
</table>
<style>
    table,
    tr,
    td {
        border: 1px solid black;
    }
</style>

</html>
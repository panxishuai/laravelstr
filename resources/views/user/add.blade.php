<!DOCTYPE html>
<html>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>添加页面</title>
<form action="{{ url('user/store') }}" method="post">
    <table>

        <tr>
            <td>用户名</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>密码</td>
            <td><input type="password" name="password"></td>
        </tr>
        {{ csrf_field() }}
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> -->
        <tr>
            <td></td>
            <td><input type="submit" value="提交"></td>
        </tr>
    </table>
</form>

</html>
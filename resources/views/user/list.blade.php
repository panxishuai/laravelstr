<!DOCTYPE html>
<html>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>添加页面</title>
<script src="/js/layer/layer/jquery.js"></script>
<script src="/js/layer/layer/layer.js"></script>

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
        <td><a href="/user/edit/{{ $v->id }}">修改</a><a href="javascript:;" onclick="delConfirm({{ $v->id }})">删除</a></td>
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
<script>
    function delConfirm(id) {
        layer.confirm('您确认要删除么？', {
            btn: ['确认', '取消']
        }, function() {
            $.get('/user/del/' + id, function(data) {
                if (data.status == 0) {
                    // $(this).parents('td').remove();
                    layer.msg('删除成功', {
                        icon: 1
                    }, function() {
                        location.reload();
                    });
                } else {
                    layer.msg(data.message, {
                        icon: 5
                    });
                }
            })
        });
    }
</script>

</html>
<!doctype html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>后台登录-X-admin2.1</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
    <script type="text/javascript" src="./js/cookie.js"></script>

</head>

<body class="login-bg">

    <div class="login layui-anim layui-anim-up">
        <div class="message">管理登录</div>
        <div id="darkbannerwrap"></div>
        <!-- @if(is_object($errors))
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @else
        <li>{{ $errors }}</li>
        @endif -->
        <form method="post" class="layui-form" action="{{ url('admin/dologin') }}">
            {{ csrf_field() }}
            <input name="username" placeholder="用户名" type="text" lay-verify="required" class="layui-input">
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码" type="password" class="layui-input">
            <hr class="hr15">
            <hr class="hr20">
            <input name="code" style="width:150px;height:40px; float:left;" lay-verify="required" placeholder="验证码" type="password" class="layui-input">
            <img src="{{ url('admin/code') }}" style="float: right;" onclick="this.src=' {{ url('admin/code/') }}?'+Math.random() " />
            <input value="登录" lay-submit style="width:100%;" type="submit">
            <hr class="hr15">
        </form>
    </div>

    <script>
        $(function() {
            layui.use('form', function() {

                var a = "<?php
                            if (is_object($errors)) {
                                if ((count($errors) > 0)) {
                                    echo $errors[0];
                                }
                            } else {
                                echo $errors;
                            }
                            ?>";
                if (a) {
                    layer.msg(a);
                }
                var form = layui.form;
                form.on('submit(login)', function(data) {

                    // layer.msg(JSON.stringify(data.field), function() {
                    //     location.href = 'index.html'
                    // });
                    return false;
                });
            });
        })
    </script>
</body>

</html>
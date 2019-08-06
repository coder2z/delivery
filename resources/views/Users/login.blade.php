<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>配货管理系统-登陆</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/xadmin.css">
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
    <script type="text/javascript" src="./js/jquery.form.js" ></script>
    <script type="text/javascript" src="./js/cookie.js"></script>

</head>
<body class="login-bg">

<div class="login layui-anim layui-anim-up">
    <div class="message">配货管理系统-登陆</div>
    <div id="darkbannerwrap"></div>

    <form method="post" class="layui-form" id="form" onsubmit="return false;">
        <input name="number" placeholder="身份证号" type="text" lay-verify="required|identity" class="layui-input">
        <hr class="hr15">
        <input name="password" lay-verify="required|password" placeholder="密码" type="password" class="layui-input">
        <hr class="hr15">
        {{--传递token--}}{{csrf_field()}}
        <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
        <hr class="hr20">
    </form>
    <a href="/register" class="layui-btn layui-btn-fluid layui-btn-normal">注册</a>
</div>
<script>
    $(function () {
        layui.use('form', function () {
            var form = layui.form;
            form.verify({
                password: [
                    /^[\S]{6,12}$/
                    ,'密码必须6到12位，且不能出现空格'
                ],
            });
            form.on('submit(login)', function (data) {
                $.ajax({
                    layerIndex: -1,
                    beforeSend: function () {
                        this.layerIndex = layer.load(1, {shade: [0.5, '#393D49']});
                    },
                    type: 'POST',
                    url: '/users/login',
                    data: $('#form').serialize(),
                    dataType: 'json',
                    success: function (data) {
                        if (data.check==0) {
                            layer.alert('账号审核中或者已被禁用',{title:'提示',icon:2});
                        }
                        else if (data) {
                            layer.msg('登陆成功', {icon: 1, time: 800},function () {
                                window.location.href='index';
                            })
                        }else
                        {
                            layer.alert('账号或者密码错误',{title:'提示',icon:2});
                        }
                    },
                    complete: function () {
                        layer.close(this.layerIndex);
                    },
                });
            });
        });
    })
</script>
</body>
</html>
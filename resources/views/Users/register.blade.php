<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>配货管理系统-注册</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script src="/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/jquery.form.js"></script>
</head>
<body class="login-bg">

<div class="login layui-anim layui-anim-up">
    <div class="message">配货管理系统-注册</div>
    <div id="darkbannerwrap"></div>
    <form class="layui-form" id="form" onsubmit="return false;">
        <input name="name" placeholder="用户名" type="text" lay-verify="required" class="layui-input">
        <hr class="hr15">
        <input name="number" lay-verify="required|identity" placeholder="身份证" type="text" class="layui-input">
        <hr class="hr15">
        <input name="tel" lay-verify="required|phone|number" placeholder="电话" type="text" class="layui-input">
        <hr class="hr15">
        <div class="layui-form-item">
            <label class="layui-form-label">职务</label>
            <div class="layui-input-block">
                <input type="radio" name="token" value="1" title="发运科人员">
                <input type="radio" name="token" value="0" title="销售员" checked>
            </div>
        </div>
        <input name="password" id="password" lay-verify="required|password" placeholder="密码" type="password" class="layui-input">
        <hr class="hr15">
        <input name="rpassword" id="rpassword" lay-verify="required|password|repass" placeholder="确认密码" type="password" class="layui-input">
        <hr class="hr15">
        {{--传递token--}}{{csrf_field()}}
        <input value="注册" lay-submit="" lay-filter="register" style="width:100%;" type="submit">
        <hr class="hr20">
    </form>
    <a href="/" class="layui-btn layui-btn-fluid layui-btn-normal">登陆</a>
</div>
<script>
    $(function () {
        layui.use('form', function () {
            var form = layui.form;
            form.verify({
                password: [/^[\S]{6,12}$/,'密码必须6到12位，且不能出现空格']
                ,repass: function(value){
                if($('#password').val()!=$('#rpassword').val()){
                    return '两次密码不一致';
                }
            }
            });

            form.on('submit(register)', function (data) {
                $.ajax({
                    layerIndex: -1,
                    beforeSend: function () {
                        this.layerIndex = layer.load(1, {shade: [0.5, '#393D49']});
                    },
                    type: 'POST',
                    url: '/users/register',
                    data: $('#form').serialize(),
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            layer.msg('注册成功', {icon: 1, time: 800},function () {
                                window.location.href='/';
                            })
                        } else {
                            layer.alert('注册失败', {title: '提示', icon: 5});
                        }
                    },
                    complete: function () {
                        layer.close(this.layerIndex);
                    },
                    error: function (msg) {
                        if (msg.status == 422) {
                            var allerror ='';
                            if (msg.responseJSON[0].name!==undefined){
                                allerror += msg.responseJSON[0].name+"<br>";
                            }
                            if (msg.responseJSON[0].password!==undefined){
                                allerror += msg.responseJSON[0].password+"<br>";
                            }
                            if (msg.responseJSON[0].number!==undefined){
                                allerror += msg.responseJSON[0].number+"<br>";
                            }
                            if (msg.responseJSON[0].token!==undefined){
                                allerror += msg.responseJSON[0].token+"<br>";
                            }
                            if (msg.responseJSON[0].rpassword!==undefined){
                                allerror += msg.responseJSON[0].rpassword+"<br>";
                            }
                            if (msg.responseJSON[0].tel!==undefined){
                                allerror += msg.responseJSON[0].tel+"<br>";
                            }
                            layer.alert(allerror,{title:'提示',icon:0});
                        }
                    }
                });
            });
        });
    })
</script>
</body>
</html>
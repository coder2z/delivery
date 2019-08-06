<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>修改密码</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/lib/layui/layui.js" charset="utf-8"></script>
    <script src="/js/jquery.form.js" type="text/javascript"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-body">
    <form class="layui-form" id="form" action="/excel/export" method="post">
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                轻型货车
            </label>
            <div class="layui-input-inline">
                <input type="text" id="light" name="light" required="" lay-verify="required|nonull"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                中型货车
            </label>
            <div class="layui-input-inline">
                <input type="text" id="heavy" name="heavy" required="" lay-verify="required|nonull"
                       autocomplete="off" class="layui-input">
                {{csrf_field()}}
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="save" lay-submit="">
                生成订单
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;

        form.verify({
            nonull: [/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)$/,'应该输入正整数']
        });
        //监听提交
        form.on('submit(save)', function(data){
            form.submit();
        });
    });
</script>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>查看公司</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <form class="layui-form" id="form" onsubmit="return false;">
        <div class="layui-form-item" >
            <label for="L_pass" class="layui-form-label">
                承接范围
            </label>
            <div class="layui-input-block" id="checkbox">
            </div>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'post',
            url: '/company/allranges',
            data:{id: "{{$id}}"},
            dataType: 'json',
            success:function (data) {
                for (var i = data.length - 1; i >= 0; i--) {
                    $("#checkbox").append('<input type="checkbox" name="range[]" title="'+data[i].region+'" value="'+data[i].id+'" lay-skin="primary" checked>');
                }
                form.render();
            },
        });
        //监听提交
        form.on('submit(save)', function(data){
            var formdata = $('#form').serialize();
            return false;
        });
    });
</script>
</body>

</html>
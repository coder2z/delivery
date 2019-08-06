<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>添加公司</title>
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
    <form class="layui-form" id="form" onsubmit="return false;">
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                公司名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="name" name="name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                联系人
            </label>
            <div class="layui-input-inline">
                <input type="text" id="contacts" name="contacts" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
                {{--传递token--}}{{csrf_field()}}
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                联系电话
            </label>
            <div class="layui-input-inline">
                <input type="text" id="tel" name="tel" required="" lay-verify="phone"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item" >
            <label for="L_pass" class="layui-form-label">
                承接范围
            </label>
            <div class="layui-input-block" id="checkbox">

            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                地址
            </label>
            <div class="layui-input-inline">
                <input type="text" id="address" name="address" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="save" lay-submit="">
                添加
            </button>
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
            type: 'get',
            url: '/company/get_range',
            dataType: 'json',
            success:function (data) {
                for (var i = data.length - 1; i >= 0; i--) {
                    $("#checkbox").append('<input id="'+data[i].id+'" type="checkbox" name="range[]" title="'+data[i].region+'" value="'+data[i].id+'" lay-skin="primary">');
                }
                form.render();
            },
        });
        $.ajax({
            type: 'get',
            url: '/company/getnexus',
            dataType: 'json',
            success:function (data) {
                for (var i = data.length - 1; i >= 0; i--) {
                        $('#'+data[i].ranges_id+'').attr("disabled",true);
                }
                form.render();
            },
        });
        //监听提交
        form.on('submit(save)', function(data){
            var formdata = $('#form').serialize();
            $.ajax({
                layerIndex:-1,
                beforeSend: function () {
                    this.layerIndex = layer.load(3, { shade: [0.5, '#393D49'] });
                },
                type:'POST',
                url:'/company/add',
                data:formdata,
                dataType:'json',
                success:function(result){
                    if(result){
                        layer.msg('订单录入成功!', {icon: 1, time: 1000});
                        $("form")[0].reset(); //清空表单
                    }else {
                        layer.msg('订单录入失败!', {icon: 2, time: 2000});
                    }
                },
                complete: function () {
                    layer.close(this.layerIndex);
                },
            });
            return false;
        });
    });
</script>
</body>

</html>
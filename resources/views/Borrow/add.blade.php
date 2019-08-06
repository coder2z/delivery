<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>配货管理系统-订单录入</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/lib/layui/layui.js" charset="utf-8"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-body">
    <form class="layui-form" onsubmit="return false;" id="form">
        <div class="layui-form-item">
            <label for="receiver" class="layui-form-label">
                <span class="x-red">*</span>收货人
            </label>
            <div class="layui-input-inline">
                <input type="text" id="receiver" name="receiver" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>省份
            </label>
            <div class="layui-input-inline">
                <select name="rangs_id" id="rangs_id">
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="site" class="layui-form-label">
                <span class="x-red">*</span>具体地址
            </label>
            <div class="layui-input-inline">
                <input type="text" id="site" name="site" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
                {{--传递token--}}{{csrf_field()}}
                <input type="text" name="user_id" value="{{{Auth::guard('user')->user()->id}}}" style="display:none">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="tel" class="layui-form-label">
                <span class="x-red">*</span>电话
            </label>
            <div class="layui-input-inline">
                <input type="text" id="tel" name="tel" required="" lay-verify="phone"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="goods" class="layui-form-label">
                <span class="x-red">*</span>药品
            </label>
            <div class="layui-input-inline">
                <input type="text" id="goods" name="goods" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="specifications" class="layui-form-label">
                <span class="x-red">*</span>规格
            </label>
            <div class="layui-input-inline">
                <input type="text" id="specifications" name="specifications" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" placeholder="例:10g*20袋/包">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="specifications" class="layui-form-label">
                <span class="x-red">*</span>重量/KG/箱
            </label>
            <div class="layui-input-inline">
                <input type="text" id="weight" name="weight" required="" lay-verify="required|nonull|number1"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="number" class="layui-form-label">
                <span class="x-red">*</span>数量/箱
            </label>
            <div class="layui-input-inline">
                <input type="text" id="number" name="number" required="" lay-verify="required|nonull"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="sale" class="layui-form-label">
                <span class="x-red">*</span>销售额/元
            </label>
            <div class="layui-input-inline">
                <input type="text" id="sale" name="sale" required="" lay-verify="required|nonull"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="enddate" class="layui-form-label">
                <span class="x-red">*</span>交货期/天
            </label>
            <div class="layui-input-inline">
                <input type="text" id="enddate" name="enddate" required="" lay-verify="required|nonull|number1"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button class="layui-btn" lay-filter="add" lay-submit="">
                订单录入
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form', 'layer'], function () {
        $ = layui.jquery;
        var form = layui.form
            , layer = layui.layer;

        form.verify({
            nonull: [/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)$/,'应该输入正整数'],
            number1: [/^(?!00)(?:[0-9]{1,3}|1000)$/,'输入的数字过大']
        });
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'get',
            url: '/borrow/rangs',
            dataType: 'json',
            success:function (data) {
                for (var i = data.length - 1; i >= 0; i--) {
                    $("#rangs_id").append('<option value ="'+data[i].id+'">'+data[i].region+'</option>');
                }
                form.render('select');
            },
        });

        form.on('submit(add)', function(data){
            var formdata = $('#form').serialize();
            $.ajax({
                layerIndex:-1,
                beforeSend: function () {
                    this.layerIndex = layer.load(3, { shade: [0.5, '#393D49'] });
                },
                type:'POST',
                url:'/borrow/add',
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
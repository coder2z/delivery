<html>
<head>
    <meta charset="UTF-8">
    <title>配货管理系统订单</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript"src="/js/md5.min.js"></script>
    <script src="/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/xadmin.js"></script>
    <script type="text/javascript" src="/js/cookie.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap.css  "/>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="/js/dataTables.bootstrap.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="layui-anim layui-anim-up">
<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
   href="javascript:location.replace(location.href);" title="刷新">
    <i class="layui-icon" style="line-height:35px">ဂ</i></a>
<div class="x-body">
    <table class="layui-table" id="datatable">
        <thead>
        <tr>
            <th >ID</th>
            <th width="500px">公司名</th>
            <th>联系人</th>
            <th>联系电话</th>
            <th>管理区域</th>
            <th>地址</th>
            <th>操作</th>
        </thead>
        <tbody id="tbody">



        </tbody>
    </table>
</div>
<script>
    layui.use('laydate', function () {
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });


    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: '/company/index',
        success:function (data) {
            for (var i = data.length - 1; i >= 0; i--) {
                var html1 = '<tr><td>' + data[i].id + '</td><td>' + data[i].name + '</td><td>' + data[i].contacts + '</td><td>' + data[i].tel + '</td><td><a onclick="x_admin_show(\'查看全部\',\'/company/allranges/'+data[i].id+'\',600,400)">查看全部</a></td><td>' + data[i].address + '</td><td class="td-status">';
                var html2 ='<a title="删除" onclick="member_del(this,' + data[i].id + ')" href="javascript:;"><i class="layui-icon">&#xe640;</i></a><a title="修改" onclick="x_admin_show(\'修改公司\',\'/company/update/'+data[i].id+'\',600,400)" href="javascript:;"><i class="layui-icon">&#xe631;</i></a></td></tr>';
                $('#tbody').append(html1+html2);
            }
            $('#datatable').dataTable({
                "oLanguage": {
                    "sLengthMenu": "每页显示 _MENU_ 条记录",
                    "sZeroRecords": "对不起，查询不到任何相关数据",
                    "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_条记录",
                    "sInfoEmtpy": "找不到相关数据",
                    "sInfoFiltered": "数据表中共为 _MAX_ 条记录)",
                    "sProcessing": "正在加载中...",
                    "sSearch": "搜索",
                    "oPaginate": {
                        "sFirst": "第一页",
                        "sPrevious": " 上一页 ",
                        "sNext": " 下一页 ",
                        "sLast": " 最后一页 "
                    },
                },
                "iDisplayLength": 10,
            });
            $('table').dataTable();
        },
    });

    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $.ajax({
                layerIndex:-1,
                beforeSend: function () {
                    this.layerIndex = layer.load(3, { shade: [0.5, '#393D49'] });
                },
                type:'post',
                url:'/company/del',
                data: {'id': id},
                dataType:'json',
                success:function(data){
                    if(data){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    }
                },
                complete: function () {
                    layer.close(this.layerIndex);
                },
                error:function(data){
                    alert("删除失败");
                }
            });
        });
    }
</script>

</body>

</html>
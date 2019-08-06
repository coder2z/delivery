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
<div class="x-body">
    <xblock>
        <button class="layui-btn " onclick="x_admin_show('导出','/borrow/export',600,400)"><i class="layui-icon">&#xe629;</i>导出
        </button>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
           href="javascript:location.replace(location.href);" title="刷新">
            <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </xblock>
    <table class="layui-table" id="datatable">
        <thead>
        <tr>
            <th>订单号</th>
            <th>收货人</th>
            <th>地址</th>
            <th>电话</th>
            <th>药品</th>
            <th>规格</th>
            <th>数量/箱</th>
            <th>重量/KG/箱</th>
            <th>销售额/元</th>
            <th>下单日期</th>
            <th>交货期/天</th>
            <th>状态</th>
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
    document.onkeydown = function () {
        if (window.event && window.event.keyCode == 13) {
            window.event.returnValue = false;
        }
    };
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: '/borrow/index',
        success:function (data) {
            for (var i = data.length - 1; i >= 0; i--) {
                var html1 = '<tr><td>' + data[i].id + '</td><td>' + data[i].receiver + '</td><td>' + data[i].site + '</td><td>' + data[i].tel + '</td><td>' + data[i].goods + '</td><td>' + data[i].specifications + '</td><td>' + data[i].number + '</td><td>' + data[i].weight + '</td><td>' + data[i].sale + '</td><td>' + data[i].order_time + '</td><td>' + data[i].enddate + '</td><td class="td-status">';
                if (data[i].status == 0) {
                    var html2 = '<span class="layui-btn layui-btn-disabled layui-btn-mini">未处理</span></td>';
                } else{
                    var html2 = '<span class="layui-btn layui-btn-normal layui-btn-mini">已处理</span></td>';
                }
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
</script>

</body>

</html>
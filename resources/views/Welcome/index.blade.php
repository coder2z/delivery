<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>欢迎页面-配货管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript"src="/js/md5.min.js"></script>
    <script src="/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/xadmin.js"></script>
    <script type="text/javascript" src="/js/cookie.js"></script>
</head>
<body>
<div class="x-body">
    <blockquote class="layui-elem-quote">欢迎管理员：
        <span class="x-red">{{Auth::guard('user')->user()->name}}</span>！当前时间:{{date('Y-m-d H:i:s',time())}}
        <fieldset class="layui-elem-field">
            <legend>数据统计</legend>
            <div class="layui-field-box">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body">
                            <div class="layui-carousel x-admin-carousel x-admin-backlog" lay-anim=""
                                 lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 90px;">
                                <div carousel-item="">
                                    <ul class="layui-row layui-col-space10 layui-this">
                                        <li class="layui-col-xs2">
                                            <a href="javascript:;" class="x-admin-backlog-body">
                                                <h3>订单数</h3>
                                                <p>
                                                    <cite id="order">N/A</cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs2">
                                            <a href="javascript:;" class="x-admin-backlog-body">
                                                <h3>已发货</h3>
                                                <p>
                                                    <cite id="shipped">N/A</cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs2">
                                            <a href="javascript:;" class="x-admin-backlog-body">
                                                <h3>未发货</h3>
                                                <p>
                                                    <cite id="unshipped">N/A</cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs2">
                                            <a href="javascript:;" class="x-admin-backlog-body">
                                                <h3>会员数</h3>
                                                <p>
                                                    <cite id="users">N/A</cite></p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset class="layui-elem-field">
            <legend>系统信息</legend>
            <div class="layui-field-box">
                <table class="layui-table">
                    <tbody>
                    <tr>
                        <th>服务器解译引擎</th>
                        <td>{{$_SERVER['SERVER_SOFTWARE']}}</td>
                    </tr>
                    <tr>
                        <th>php版本号</th>
                        <td>{{PHP_VERSION}}</td>
                    </tr>
                    <tr>
                        <th>Http版本号</th>
                        <td>{{$_SERVER['SERVER_PROTOCOL']}}</td>
                    </tr>
                    <tr>
                        <th>网站根目录</th>
                        <td>{{$_SERVER['DOCUMENT_ROOT']}}</td>
                    </tr>
                    <tr>
                        <th>PHP脚本最大执行时间</th>
                        <td>{{ini_get('max_execution_time').' Seconds'}}</td>
                    </tr>
                    <tr>
                        <th>客户端IP</th>
                        <td>{{$_SERVER['REMOTE_ADDR']}}</td>
                    </tr>
                    <tr>
                        <th>请求IP</th>
                        <td>{{GetHostByName($_SERVER['SERVER_NAME'])}}</td>
                    </tr>
                    <tr>
                        <th>服务器域名</th>
                        <td>{{$_SERVER['HTTP_HOST']}}</td>
                    </tr>
                    <tr>
                        <th>服务器Web端口</th>
                        <td>{{$_SERVER['SERVER_PORT']}}</td>
                    </tr>
                    <tr>
                        <th>系统类型</th>
                        <td>{{php_uname('s')}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </blockquote>
</div>
<script>
    $.ajax({
        type: 'get',
        url: '/welcome/index',
        dataType: 'json',
        success:function (data) {
            $("#order").html(data.order);
            $("#shipped").html(data.shipped);
            $("#unshipped").html(data.unshipped);
            $("#users").html(data.users);
        },
    });
</script>
</body>
</html>
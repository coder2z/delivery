<!doctype html>
<html  class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>配货管理系统</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript"src="https://cdn.bootcss.com/blueimp-md5/2.10.0/js/md5.min.js"></script>
    <script src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
    <script type="text/javascript" src="./js/cookie.js"></script>
    <script>
        // 是否开启刷新记忆tab功能
        // var is_remember = false;
    </script>
</head>
<body>
<!-- 顶部开始 -->
<div class="container">
    <div class="logo"><a href="./index">配货管理系统</a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="iconfont">&#xe699;</i>
    </div>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
                <a href="javascript:;">{{Auth::guard('user')->user()->name}}</a>
                <dl class="layui-nav-child"> <!-- 二级菜单 -->
                    <dd><a onclick="x_admin_show('修改密码','/user/password/{{Auth::guard('user')->user()->id}}',600,400)">修改密码</a></dd>
                    <dd><a href="/users/logout">注销登陆</a></dd>
            </dl>
        </li>
    </ul>

</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            @if(Auth::guard('user')->user()->token==2)
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b8;</i>
                    <cite>会员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li date-refresh="1">
                        <a _href="/user/index">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>会员列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
                <li>
                    <a href="javascript:;">
                        <i class="iconfont">&#xe6e9;</i>
                        <cite>物流公司</cite>
                        <i class="iconfont nav_right">&#xe697;</i>
                    </a>
                    <ul class="sub-menu">
                        <li date-refresh="1">
                            <a _href="/company/index">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>物流公司列表</cite>
                            </a>
                        </li >
                    </ul>
                    <ul class="sub-menu">
                        <li date-refresh="1">
                            <a _href="/company/add">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>添加物流公司</cite>
                            </a>
                        </li >
                    </ul>
                </li>
            @endif
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>订单管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    @if(Auth::guard('user')->user()->token==2||Auth::guard('user')->user()->token==0)
                    <li>
                        <a _href="/borrow/add">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>录入订单</cite>
                        </a>
                    </li >
                        <li>
                            <a _href="/borrow/useradd">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>我录入的订单</cite>
                            </a>
                        </li >
                    @endif
                    @if(Auth::guard('user')->user()->token==2)
                            <li>
                                <a _href="/borrow/admin">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>订单管理</cite>
                                </a>
                            </li >
                    @endif
                    @if(Auth::guard('user')->user()->token==2||Auth::guard('user')->user()->token==1)
                    <li>
                        <a _href="/borrow/index">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>订单列表</cite>
                        </a>
                    </li >
                    @endif
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
    <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
        <ul class="layui-tab-title">
            <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>
        </ul>
        <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
            <dl>
                <dd data-type="this">关闭当前</dd>
                <dd data-type="other">关闭其它</dd>
                <dd data-type="all">关闭全部</dd>
            </dl>
        </div>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='./welcome' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
        </div>
        <div id="tab_show"></div>
    </div>
</div>
<div class="page-content-bg"></div>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->
<!-- 底部开始 -->
<div class="footer">
    <div class="copyright">配货管理系统</div>
</div>
<!-- 底部结束 -->
</body>
</html>
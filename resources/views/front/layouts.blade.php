<!DOCTYPE html>
<!--[if IE 8]> <html lang="{{app()->getLocale()}}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="{{app()->getLocale()}}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{app()->getLocale()}}">
<!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <title>专业稳定的网络加速器，一款不断满足用户需求的网络加速工具。</title>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    @yield('css')
    <!-- END PAGE LEVEL PLUGINS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png"
          href="/images/logo.ico"
          sizes="48X48"/>
    <meta name="application-name" content="穿云梯"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="description" content="穿云梯是国内用户登录海外网站的最佳网络工具，无论你是追逐国外明星、潮人博主、还是观看视频、直播、或是区块链玩家，基本满足用户需求；除此以外，海外用户可以利用我们的服务回国听音乐、网易云、观看优酷、腾讯、爱奇艺、电视剧、电源、直播、体育、AB站等。">
    <meta name="keywords" content="vpn,翻墙,免费SSR,免费节点,国内节点,国外节点,多国IP,网络加速器,区块链,脸书,facebook,youtube,twitter,海淘,网络安全,海外业务,科学上网,vps,免费梯子,小火箭,shadowsocksR,potatso,tg,telegram,高速稳定,无限流量,Netflix">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <script type='text/javascript' src='/js/front/jquery/1.12.4/jquery.min.js?ver=1.11.3'></script>

    <link rel="stylesheet" href="/css/front/normalize.css?v=1.6">

    <link rel="preload" href="/css/front/base.css" onload="this.rel='stylesheet'"
          as="style">
    <noscript>
        <link rel="stylesheet" href="/css/front/base.css" type='text/css'
              media='all'>
    </noscript>
    <link rel="preload" href="/css/front/sprite.css"
          onload="this.rel='stylesheet'" as="style">
    <noscript>
        <link rel="stylesheet" href="/css/front/sprite.css" type='text/css'
              media='all'>
    </noscript>
    {{--百度站长统计--}}
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?08105322cddc42dc0c011d66dc7bd29c";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>
<body class="page-template page-template-page-nord-style-v3-2-light-header-footer page-template-page-nord-style-v3-2-light-header-footer-php page page-id-56742 page-child parent-pageid-29187 zh-language">
<header class="Header Header--light">
    <nav class="Navigation Navigation--light">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-xs-10">
                    <a href="/front">
                        <img src="/images/logo1.svg"
                             alt="logo" class="Logo" style="width: 60px"/>
                        <img src="/images/logo2.png?v=1.0"
                             alt="logo" class="Logo" style="width: 85px"/>
                        <span class="slogen">| &nbsp;专业稳定的网络加速器 </span>
                    </a>
                </div>

                <div class="col-xs-2 col-md-9 visible-xs visible-sm mt-3 text-right rtl-flip">
                    <button
                            type="button"
                            data-toggle="toggle"
                            data-target="sidebar"
                            data-body-class="Sidebar--active"
                            class="NavbarToggle NavbarToggle--light"
                    >
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar top-bar"></span>
                        <span class="icon-bar middle-bar"></span>
                        <span class="icon-bar bottom-bar"></span>
                    </button>
                </div>

                <div class="col-md-7 col-xs-12" style="height: 60px;line-height: 60px">
                    <div class="navbar-collapse Navigation__body">
                        <div class="HeaderMenu HeaderMenu--light">
                            <ul class="pull-sm-none pull-md-right pull-lg-right pull-xs-none">
                                <li>
                                    <a
                                            href="/front"
                                            role="menuitem"
                                            class="Link mb-0"
                                    >
                                        <span>首页</span>
                                    </a>
                                </li>
                                <li>
                                    <a
                                            href="/front/order"
                                            role="menuitem"
                                            class="Link mb-0"
                                    >
                                        <span>购买中心</span>
                                    </a>
                                </li>
                                {{--<li>--}}
                                    {{--<a--}}
                                            {{--href="/front/servers"--}}
                                            {{--role="menuitem"--}}
                                            {{--class="Link mb-0"--}}
                                    {{-->--}}
                                        {{--<span>服务器</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                <li>
                                    <a
                                            href="/front/download"
                                            role="menuitem"
                                            class="Link mb-0"
                                    >
                                        <span>教程中心</span>
                                    </a>
                                </li>
                                <li>
                                    <a
                                            href="/front/support"
                                            role="menuitem"
                                            class="Link mb-0"
                                    >
                                        <span>帮助中心</span>
                                    </a>
                                </li>
                                <li>
                                    <a
                                            href="/front/refer"
                                            role="menuitem"
                                            class="Link mb-0"
                                    >
                                        <span>代理中心</span>
                                    </a>
                                </li>
                                <li>
                                    @if(Session::has('user'))
                                        <a class="Button Button--primary Button--small" href="/user" role="button" tabindex="0"><span>我的账户</span></a>
                                        <a class="Button Button--primary Button--small" href="{{url('logouttofront')}}" role="button" tabindex="0"><span>退出</span></a>
                                    @else
                                        <a class="Button Button--primary Button--small" href="/login" role="button" tabindex="0"><span>登陆</span></a>
                                        <a class="Button Button--primary Button--small" href="/register" role="button" tabindex="0"><span>注册</span></a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div id="sidebar" class="Sidebar">
        <div class="Sidebar__backdrop" data-toggle="toggle" data-target="sidebar"
             data-body-class="Sidebar--active"></div>
        <div class="Sidebar__body hidden-md hidden-lg">
            <div class="p-7 text-right">
                <button
                        type="button"
                        data-toggle="toggle"
                        data-target="sidebar"
                        data-body-class="Sidebar--active"
                        class="NavbarToggle active"
                >
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-bar"></span>
                    <span class="icon-bar middle-bar"></span>
                    <span class="icon-bar bottom-bar"></span>
                </button>
            </div>

            <div class="mb-12">
                <div class="px-8">
                    <div class="SidebarMenu">
                        <ul>
                            {{--<li>--}}
                                {{--<a href="/front/features">产品特性</a>--}}
                            {{--</li>--}}
                            <li>
                                <a href="/front">首页</a>
                            </li>
                            <li style="display: none">
                                <a href="/front/order">购买中心</a>
                            </li>
                            {{--<li>--}}
                                {{--<a href="/front/servers">服务器</a>--}}
                            {{--</li>--}}
                            <li>
                                <a href="/front/download">下载中心</a>
                            </li>
                            <li>
                                <a href="/front/support">帮助中心</a>
                            </li>
                            @if(Session::has('user'))
                                <li>
                                    <a href="/user"><span>我的账户</span></a>
                                </li>
                            @else
                                <li>
                                    <a href="/login"><span>登陆</span></a>
                                </li>
                                <li>
                                    <a href="/register"><span>注册</span></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@yield('content')
<footer class="Footer">
    <div class="container">
        <div class="my-sm-12 my-md-14" style="margin-top: 30px;margin-bottom: 10px">
            <div class="col-md-6 col-md-offset-3 col-sm-12 Footer__menu" style="text-align: center">
                <div class="col-xs-6 col-sm-3">
                    <a href="/front/aboutus">
                        <div class="p-3 p-sm-0">
                            <div class="text-uppercase text-ellipsis micro text-muted mb-6">
                                <strong>关于我们</strong>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <a href="/front/privacy">
                        <div class="p-3 p-sm-0">
                            <div class="text-uppercase text-ellipsis micro text-muted mb-6">
                                <strong>隐私服务</strong>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <a href="/front/survice">
                        <div class="p-3 p-sm-0">
                            <div class="text-uppercase text-ellipsis micro text-muted mb-6">
                                <strong>使用条款</strong>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <a href="/front/support">
                        <div class="p-3 p-sm-0">
                            <div class="text-uppercase text-ellipsis micro text-muted mb-6">
                                <strong>帮助中心</strong>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="text-align: center;font-size: 10px;height: 40px;line-height: 40px">
        <span>Copyright © 2018 穿云梯加速器</span>
    </div>
</footer>

<div id="fb-root"></div>
<div class="staging-env"></div>

<script type='text/javascript' src='/js/front/base.min.js'></script>

</html>
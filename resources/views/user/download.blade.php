@extends('user.layouts')

@section('css')
    <style type="text/css">
        .ticker {
            background-color: #fff;
            margin-bottom: 20px;
            border: 1px solid #e7ecf1!important;
            border-radius: 4px;
            -webkit-border-radius: 4px;
        }
        .ticker ul {
            padding: 0;
        }
        .ticker li {
            list-style: none;
            padding: 15px;
        }
        .panel-body,.panel-body p{
            text-align: center;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .panel-body .t2{
            font-size: 24px;
            font-weight: 900;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .dow{
            /*margin-top: 20px;*/
        }
    </style>
@endsection
@section('title', '下载中心')

@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img class="img" src="/images/window.svg" width="50px" height="50px">
                        <p class="t2">Windows客户端1</p>
                        <a class="btn btn-lg red dow" href="{{url('downloadApp/windows')}}">下载</a>
                        <a target="_blank"  class="btn btn-lg blue dow" href="/download_vpn/windows/ssr.pdf">教程</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="/images/ios.svg" width="50px" height="50px">
                        <p class="t2">IOS客户端</p>
                        <a target="_blank" class="btn btn-lg red dow" href="/download_vpn/iOS/ios.pdf?v=1.0">查看教程</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="/images/Android.svg" width="50px" height="50px">
                        <p class="t2">Android客户端</p>
                        <a class="btn btn-lg red dow" href="{{url('downloadApp/android')}}">下载</a>
                        <a target="_blank"  class="btn btn-lg blue dow" href="/download_vpn/android/android.pdf">教程</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="/images/Mac.svg" width="50px" height="50px">
                        <p class="t2">Mac客户端</p>
                        <a class="btn btn-lg red dow" href="{{url('downloadApp/mac')}}">下载</a>
                        <a target="_blank"  class="btn btn-lg blue dow" href="/download_vpn/macOs/mac.pdf">教程</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img class="img" src="/images/window.svg" width="50px" height="50px">
                        <p class="t2">Windows客户端2</p>
                        <a class="btn btn-lg red dow" href="{{url('downloadApp/windowstap')}}">下载</a>
                        <a target="_blank" class="btn btn-lg blue dow" href="/download_vpn/windows/sstap.pdf">教程</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/jquery-qrcode/jquery.qrcode.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/js/layer/layer.js" type="text/javascript"></script>
@endsection

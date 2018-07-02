@extends('front.layouts2')

@section('css')

@endsection
@section('content')
    <style>
        .icon{
            font-size: 45px;
        }
    </style>
    <div class="row" style="border-bottom: 1px solid #f8f8f8;margin-bottom: 20px;padding-left: 18%;padding-right: 18%">
        <div class="col-md-6 col-xs-12 col-sm-12">
            <img src="/images/down.png" class="img-responsive" alt="Responsive image">
        </div>
        <div class="col-md-6 col-xs-12 col-sm-12" style="margin-top: 20px">
            <h3 class="Title">支持各主流系统平台使用</h3>
            <p style="margin-top: 20px">本站提供SS/SSR协议节点，是目前加速最流行的解决方案。支持Windows、Mac、iOS、Android 终端，下载软件添加节点即可使用。如果您是新手用户不清楚如何使用，建议花一点时间查看下面使用教程。</p>
        </div>
    </div>
    <div class="row" style="padding-left: 18%;padding-right: 18%">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <div>
                <div class="Paper bg-bw-1 PlanCard text-center PlanCard--type-special sha-1 sha-3-hover">
                    <div class="PlanCard__body p-5">
                        <div class="PlanCard__name pb-3 pt-5 pt-sm-7 pt-md-5">
                            <img src="/images/window.svg" width="50px" height="50px">
                            {{--<i class="icon fab fa-android" style="color: #424242"></i>--}}
                            <p class="Text fwb c-bw-12">
                                <span>
                                    <span>
                                        ShadowsocksR for
                                    </span>
                                    <br/>
                                    Windows
                                </span>
                            </p>
                        </div>
                        <div class="PlanCard__description">
                            <a class="Button Button--primary" href="{{url('downloadApp/windows')}}"> 下载 </a>
                            <a href="/download_vpn/windows/ssr.pdf" target="_blank" class="Button" style="color: #f64f64;font-size: 14px"> 查看教程 </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <div>
                <div class="Paper bg-bw-1 PlanCard text-center PlanCard--type-special sha-1 sha-3-hover">
                    <div class="PlanCard__body p-5">
                        <div class="PlanCard__name pb-3 pt-5 pt-sm-7 pt-md-5">
                            <img src="/images/ios.svg" width="50px" height="50px">
                            {{--<i class="icon fab fa-android" style="color: #424242"></i>--}}
                            <p class="Text fwb c-bw-12">
                                <span>
                                    <span>
                                        ShadowsocksR for
                                    </span>
                                    <br/>
                                    IOS
                                </span>
                            </p>
                        </div>
                        <div class="PlanCard__description">
                            <a class="Button Button--primary" target="_blank" class="btn btn-lg red dow" href="/download_vpn/iOS/ios.pdf?v=1.0">查看教程</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <div>
                <div class="Paper bg-bw-1 PlanCard text-center PlanCard--type-special sha-1 sha-3-hover">
                    <div class="PlanCard__body p-5">
                        <div class="PlanCard__name pb-3 pt-5 pt-sm-7 pt-md-5">
                            <img src="/images/Android.svg" width="50px" height="50px">
                            {{--<i class="icon fab fa-android" style="color: #424242"></i>--}}
                            <p class="Text fwb c-bw-12">
                                <span>
                                    <span>
                                        ShadowsocksR for
                                    </span>
                                    <br/>
                                    Android
                                </span>
                            </p>
                        </div>
                        <div class="PlanCard__description">
                            <a class="Button Button--primary" href="{{url('downloadApp/android')}}"> 下载 </a>
                            <a target="_blank" href="/download_vpn/android/android.pdf"  class="Button" style="background-color: #ffffff;color: #f64f64;font-size: 14px"> 查看教程 </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <div>
                <div class="Paper bg-bw-1 PlanCard text-center PlanCard--type-special sha-1 sha-3-hover">
                    <div class="PlanCard__body p-5">
                        <div class="PlanCard__name pb-3 pt-5 pt-sm-7 pt-md-5">
                            <img src="/images/Mac.svg" width="50px" height="50px">
                            {{--<i class="icon fab fa-android" style="color: #424242"></i>--}}
                            <p class="Text fwb c-bw-12">
                                <span>
                                    <span>
                                        ShadowsocksX for
                                    </span>
                                    <br/>
                                    Mac
                                </span>
                            </p>
                        </div>
                        <div class="PlanCard__description">
                            <a class="Button Button--primary" href="{{url('downloadApp/mac')}}"> 下载 </a>
                            <a target="_blank" href="/download_vpn/macOs/mac.pdf" class="Button" style="color: #f64f64;font-size: 14px"> 查看教程 </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-left: 18%;padding-right: 18%;margin-top: 20px">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div>
            <div class="Paper bg-bw-1 PlanCard text-center PlanCard--type-special sha-1 sha-3-hover">
                <div class="PlanCard__body p-5">
                    <div class="PlanCard__name pb-3 pt-5 pt-sm-7 pt-md-5">
                        <img src="/images/window.svg" width="50px" height="50px">
                        {{--<i class="icon fab fa-android" style="color: #424242"></i>--}}
                        <p class="Text fwb c-bw-12">
                                <span>
                                    <span>
                                        SSTap for
                                    </span>
                                    <br/>
                                    Windows
                                </span>
                        </p>
                    </div>
                    <div class="PlanCard__description">
                        <a class="Button Button--primary" href="{{url('downloadApp/windowstap')}}"> 下载 </a>
                        <a href="/download_vpn/windows/sstap.pdf" target="_blank" class="Button" style="color: #f64f64;font-size: 14px"> 查看教程 </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div style="margin-bottom: 200px">

    </div>
@endsection

@section('script')

@endsection
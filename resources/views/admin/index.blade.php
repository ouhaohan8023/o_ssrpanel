@extends('admin.layouts')

@section('title', '控制面板')
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('wSifGFeO5mQoCWB4/userList');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-soft">
                                <span data-counter="counterup" data-value="{{$userCount}}"></span>
                            </h3>
                            <small>总用户数</small>
                        </div>
                        <div class="icon">
                            <i class="icon-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('wSifGFeO5mQoCWB4/userListToday');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-soft">
                                <span data-counter="counterup" data-value="{{$userCountToday}}"></span>
                            </h3>
                            <small>今日新注册用户数</small>
                        </div>
                        <div class="icon">
                            <i class="icon-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('wSifGFeO5mQoCWB4/userListTodayActiveInSeven');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span data-counter="counterup" data-value="{{$activeUserCount}}">0</span>
                            </h3>
                            <small>7日内活跃用户</small>
                        </div>
                        <div class="icon">
                            <i class="icon-user"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('wSifGFeO5mQoCWB4/userListTodayActiveOnLine');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span data-counter="counterup" data-value="{{$onlineUserCount}}">0</span>
                            </h3>
                            <small>当前在线</small>
                        </div>
                        <div class="icon">
                            <i class="icon-user"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('wSifGFeO5mQoCWB4/userList?expireWarning=1&enable=1');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                <span data-counter="counterup" data-value="{{$expireWarningUserCount}}">0</span>
                            </h3>
                            <small>已激活临近到期</small>
                        </div>
                        <div class="icon">
                            <i class="icon-user-unfollow"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/wSifGFeO5mQoCWB4/orderList?username=&is_expire=&is_coupon=&pay_way=&status=2');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                <span data-counter="counterup" data-value="{{$allInCome}}">0</span>
                            </h3>
                            <small>总收入</small>
                        </div>
                        <div class="icon">
                            <i class="icon-user-unfollow"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('/wSifGFeO5mQoCWB4/orderListToday?username=&is_expire=&is_coupon=&pay_way=&status=2');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                <span data-counter="counterup" data-value="{{$todayInCome}}">0</span>
                            </h3>
                            <small>今日收入</small>
                        </div>
                        <div class="icon">
                            <i class="icon-user-unfollow"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                $<span data-counter="counterup" data-value="{{$totalBalance}}"></span>
                            </h3>
                            <small>总余额</small>
                        </div>
                        <div class="icon">
                            <i class="icon-diamond"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('wSifGFeO5mQoCWB4/userList?expireWarning=1&enable=0');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-blue-sharp">
                                <span data-counter="counterup" data-value="{{$expireWarningUserCount_n}}">0</span>
                            </h3>
                            <small>未激活临近到期</small>
                        </div>
                        <div class="icon">
                            <i class="icon-user-unfollow"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('wSifGFeO5mQoCWB4/nodeList');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-blue-sharp">
                                <span data-counter="counterup" data-value="{{$nodeCount}}"></span>
                            </h3>
                            <small>节点数量</small>
                        </div>
                        <div class="icon">
                            <i class="icon-list"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('wSifGFeO5mQoCWB4/trafficLog');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-blue-sharp"> {{$totalFlowCount}} </h3>
                            <small>总消耗流量</small>
                        </div>
                        <div class="icon">
                            <i class="icon-speedometer"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('wSifGFeO5mQoCWB4/trafficLog');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-blue-sharp"> {{$flowCount}} </h3>
                            <small>30日内消耗流量</small>
                        </div>
                        <div class="icon">
                            <i class="icon-speedometer"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green">
                                $<span data-counter="counterup" data-value="{{$totalWaitRefAmount}}"></span>
                            </h3>
                            <small>待提现佣金</small>
                        </div>
                        <div class="icon">
                            <i class="icon-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green">
                                $<span data-counter="counterup" data-value="{{$totalRefAmount}}"></span>
                            </h3>
                            <small>已支出佣金</small>
                        </div>
                        <div class="icon">
                            <i class="icon-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('wSifGFeO5mQoCWB4/referUser');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green">
                                <span data-counter="counterup" data-value="{{$userReferCount}}"></span>
                            </h3>
                            <small>代理转化用户总数</small>
                        </div>
                        <div class="icon">
                            <i class="icon-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('wSifGFeO5mQoCWB4/refer');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green">
                                <span data-counter="counterup" data-value="{{$userReferCountPay}}"></span>
                            </h3>
                            <small>代理转化并付款用户数</small>
                        </div>
                        <div class="icon">
                            <i class="icon-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('wSifGFeO5mQoCWB4/refer');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                <span data-counter="counterup" data-value="{{$userReferMoneyAll}}"></span>
                            </h3>
                            <small>代理推广总金额</small>
                        </div>
                        <div class="icon">
                            <i class="icon-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('wSifGFeO5mQoCWB4/refer?status=0');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                <span data-counter="counterup" data-value="{{$userReferMoney}}">0</span>
                            </h3>
                            <small>代理待提现金额</small>
                        </div>
                        <div class="icon">
                            <i class="icon-user-unfollow"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered" onclick="skip('wSifGFeO5mQoCWB4/refer?status=1');">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-red">
                                <span data-counter="counterup" data-value="{{$userReferMoneySuccess}}">0</span>
                            </h3>
                            <small>代理已提现金额</small>
                        </div>
                        <div class="icon">
                            <i class="icon-user-unfollow"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        function skip(url) {
            window.location.href = url;
        }
    </script>
@endsection

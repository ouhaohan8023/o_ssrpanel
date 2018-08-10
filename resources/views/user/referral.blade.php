@extends('user.layouts')

@section('css')
    <link href="/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <style>
        .fancybox > img {
            width: 75px;
            height: 75px;
        }
        .clickSpan {
            margin-left: 20px;
        }
    </style>
@endsection
@section('title', trans('home.panel'))
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="note note-info">
                    <p>边用边赚钱，成为穿云梯代理最高享受50%佣金待遇！
                        <a href="/front/refer" class="btn red mt-clipboard" data-clipboard-action="copy" data-clipboard-target="#mt-target-1">
                            立即查看代理详情！
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light form-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-link font-blue"></i>
                            <span class="caption-subject font-blue bold">{{trans('home.referral_my_link')}}</span>
                            <span class="caption-subject font-blue clickSpan">点击次数：{{$clickNums}} 次</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="mt-clipboard-container">
                            <input type="text" id="mt-target-1" class="form-control" value="{{$link}}" />
                            <a href="javascript:;" class="btn blue mt-clipboard" data-clipboard-action="copy" data-clipboard-target="#mt-target-1">
                                <i class="icon-note"></i> {{trans('home.referral_button')}}
                            </a>
                        </div>
                    </div>
                </div>
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <span class="caption-subject bold"> {{trans('home.referral_title')}} </span>
                            <span class="caption-subject bold clickSpan"> 总佣金： {{$referMoneyAll or '0'}} 元</span>
                            <span class="caption-subject bold clickSpan"> 已提现： {{$referMoneyGet or '0'}} 元</span>
                            <span class="caption-subject bold clickSpan"> 待提现： {{$referMoneyWait or '0'}} 元</span>
                        </div>
                        <div class="actions">
                            <button type="submit" class="btn red" onclick="extractMoney()"> {{trans('home.referral_table_apply')}} </button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> {{trans('home.referral_table_user')}} </th>
                                    <th> {{trans('home.referral_table_amount')}} </th>
                                    <th> {{trans('home.referral_table_commission')}} </th>
                                    <th> {{trans('home.referral_table_status')}} </th>
                                    <th> {{trans('home.referral_table_date')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($referralLogList->isEmpty())
                                    <tr>
                                        <td colspan="6" style="text-align: center;"> {{trans('home.referral_table_none')}} </td>
                                    </tr>
                                @else
                                    @foreach($referralLogList as $key => $referralLog)
                                        <tr class="odd gradeX">
                                            <td> {{$key + 1}} </td>
                                            <td> {{$referralLog->user->username}} </td>
                                            <td> ￥{{$referralLog->amount}} </td>
                                            <td> ￥{{$referralLog->ref_amount}} </td>
                                            <td>
                                                @if ($referralLog->status == 1)
                                                    <span class="label label-sm label-danger">申请中</span>
                                                @elseif($referralLog->status == 2)
                                                    <span class="label label-sm label-default">已提现</span>
                                                @else
                                                    <span class="label label-sm label-info">未提现</span>
                                                @endif
                                            </td>
                                            <td> {{$referralLog->created_at}} </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-sm-5">
                                <div class="dataTables_info" role="status" aria-live="polite">{{trans('home.referral_summary', ['total' => $referralLogList->total(), 'amount' => $canAmount, 'money' => $referral_money])}}</div>
                            </div>
                            <div class="col-md-7 col-sm-7">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $referralLogList->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <span class="caption-subject bold"> 推广会员 </span>
                            <span class="caption-subject bold clickSpan"> 总用户数： {{$allNum or '0'}} </span>
                            <span class="caption-subject bold clickSpan"> 已消费用户数： {{$payNum or '0'}} </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> 用户名 </th>
                                    <th> 是否消费 </th>
                                    <th> 状态 </th>
                                    <th> 注册时间 </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($refer->isEmpty())
                                    <tr>
                                        <td colspan="6" style="text-align: center;"> {{trans('home.referral_table_none')}} </td>
                                    </tr>
                                @else
                                    @foreach($refer as $key => $v)
                                        <tr class="odd gradeX">
                                            <td> {{$key + 1}} </td>
                                            <td> {{$v->username}} </td>
                                            <td>
                                                @if($v['pay'])
                                                    <span class="label label-sm label-danger">已消费</span>
                                                    @else
                                                    <span class="label label-sm label-danger">未消费</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($v['status'] == '-1')
                                                    <span class="label label-sm label-danger">禁用</span>
                                                    @elseif($v['status'] == 0)
                                                    <span class="label label-sm label-default">未激活</span>
                                                @elseif($v['status'] == 1)
                                                    <span class="label label-sm label-info">正常</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{$v['created_at']}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        {{--<div class="row">--}}
                            {{--<div class="col-md-7 col-sm-7">--}}
                                {{--<div class="dataTables_paginate paging_bootstrap_full_number pull-right">--}}
                                    {{--{{ $refer->links() }}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/clipboardjs/clipboard.min.js" type="text/javascript"></script>
    <script src="/assets/pages/scripts/components-clipboard.min.js" type="text/javascript"></script>
    <script src="/js/layer/layer.js" type="text/javascript"></script>

    <script type="text/javascript">
        // 申请提现
        function extractMoney() {
            $.post("{{url('user/extractMoney')}}", {_token:'{{csrf_token()}}'}, function (ret) {
                layer.msg(ret.message, {time:1000});
            });
        }
    </script>
@endsection

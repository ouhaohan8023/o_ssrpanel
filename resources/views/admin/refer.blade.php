@extends('admin.layouts')

@section('css')
    <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/css/datepicker/datepicker.css" rel="stylesheet" type="text/css" >
@endsection
@section('title', '控制面板')
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <span class="caption-subject bold uppercase"> 代理交易列表 </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row" style="padding-bottom:5px;">
                            <div class="col-md-2 col-sm-2">
                                <input type="text" class="col-md-4 form-control input-sm" name="user_id" value="{{Request::get('user_id')}}" id="user_id" placeholder="用户名" onkeydown="if(event.keyCode==13){doSearch();}">
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <input type="text" class="col-md-4 form-control input-sm" name="ref_user_id" value="{{Request::get('ref_user_id')}}" id="ref_user_id" placeholder="上级代理" onkeydown="if(event.keyCode==13){doSearch();}">
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <input type="text" class="col-md-4 form-control input-sm" name="sn" value="{{Request::get('sn')}}" id="sn" placeholder="订单号" onkeydown="if(event.keyCode==13){doSearch();}">
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <input type="text" class="col-md-4 form-control input-sm" name="start_time" value="{{Request::get('start_time')}}" id="dp1" placeholder="订单生成时间（开始）" onkeydown="if(event.keyCode==13){doSearch();}">
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <input type="text" class="col-md-4 form-control input-sm" name="end_time" value="{{Request::get('end_time')}}" id="dp2" placeholder="订单生成时间（结束）" onkeydown="if(event.keyCode==13){doSearch();}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <select class="form-control input-sm" name="status" id="status" onChange="doSearch()">
                                    <option value="" @if(Request::get('status') == '') selected @endif>状态</option>
                                    <option value="1" @if(Request::get('status') == '1') selected @endif>已提现</option>
                                    <option value="0" @if(Request::get('status') == '0') selected @endif>未提现</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <button type="button" class="btn btn-sm blue" onclick="doSearch();">查询</button>
                                <button type="button" class="btn btn-sm grey" onclick="doReset();">重置</button>
                            </div>
                        </div>
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> 用户名 </th>
                                    <th> 代理 </th>
                                    <th> 订单号 </th>
                                    <th> 订单金额 </th>
                                    <th> 提成 </th>
                                    <th> 状态 </th>
                                    <th> 生成时间 </th>
                                    {{--<th> 操作 </th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                    @if ($data->isEmpty())
                                        <tr>
                                            <td colspan="10" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach ($data as $refer)
                                            <tr class="odd gradeX {{$refer->trafficWarning ? 'danger' : ''}}">
                                                <td> {{$refer->id}} </td>
                                                <td> {{$refer->user->username}} </td>
                                                <td> {{$refer->userRefer->username}} </td>
                                                <td> {{$refer->order->order_sn}} </td>
                                                <td> {{$refer->amount}} </td>
                                                <td> {{$refer->ref_amount}} </td>
                                                <td>
                                                    @if($refer->status)
                                                        <span class="label label-info">已提现</span>
                                                    @else
                                                        <span class="label label-danger">未提现</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$refer->created_at}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$data->total()}} 个账号</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $data->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/js/layer/layer.js" type="text/javascript"></script>
    <script src="/js/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script type="text/javascript">

        // 搜索
        function doSearch() {
            var user_id = $("#user_id").val();
            var ref_user_id = $("#ref_user_id").val();
            var sn = $("#sn").val();
            var start_time = $('#dp1').val();
            var end_time = $('#dp2').val();
            var status = $('#status option:checked').val();

            window.location.href = '{{url('wSifGFeO5mQoCWB4/refer')}}' + '?user_id=' + user_id + '&ref_user_id=' + ref_user_id + '&sn=' + sn + '&status=' + status + '&start_time=' + start_time + '&end_time=' + end_time ;
        }

        // 重置
        function doReset() {
            window.location.href = '{{url('wSifGFeO5mQoCWB4/refer')}}';
        }

        $(document).ready(function () {
            $('#dp1,#dp2').datepicker(
                {
                    format : 'yyyy-mm-dd'
                }
            ).on('changeDate', function(ev){
                $('#dp1,#dp2').datepicker('hide')
            });
        })
    </script>
@endsection
@extends('admin.layouts')

@section('title', '节点状态')
@section('css')
    <link href="/css/nodestatus/circliful.css" rel="stylesheet" type="text/css" />
    <style>
        .node_status_title {
            text-align: center;
            font-size: 20px;
            font-weight: 800;
            text-align: center;

        }
    </style>
@endsection
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
                            <span class="caption-subject bold uppercase"> 节点状态 --最后更新时间：{{$time['time']}}</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            @foreach($datas as $data)
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
                                    <div class="node_status_title">
                                        {{$data['ss_node']['name']}}
                                    </div>
                                    <div id="test-circle_{{$data['l_sn_id']}}" data-animation="1" data-animationStep="8" data-percent="{{$data['sum']}}"></div>
                                </div>
                            @endforeach
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
    <script src="/js/nodestatus/circliful.min.js"></script>
    <script>
        $( document ).ready(function() {
            @foreach($datas as $data)
                $("#test-circle_{{$data['l_sn_id']}}").circliful();
            @endforeach

            // $("#test-circle5").circliful({
            //     animationStep: 5,
            //     foregroundBorderWidth: 5,
            //     backgroundBorderWidth: 15,
            //     percent: 90,
            //     halfCircle: 1,
            // });
            // $("#test-circle").circliful();
        });

    </script>
@endsection

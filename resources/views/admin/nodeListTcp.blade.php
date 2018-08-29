@extends('admin.layouts')

@section('css')
    <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection
@section('title', '控制面板')
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <span class="caption-subject bold uppercase"> 节点列表 </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                {{--<button class="btn sbold blue" onclick="addNode()"> 添加节点 </button>--}}
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr>
                                    <th> <span class="node-id"><a href="javascript:showIdTips();">ID</a></span> </th>
                                    <th> 节点名称 </th>
                                    <th> 域名 </th>
                                    <th> IP </th>
                                    <th> TCP状态 </th>
                                    <th> PING状态 </th>

                                </tr>
                                </thead>
                                <tbody>
                                    @if($nodeList->isEmpty())
                                        <tr>
                                            <td colspan="10" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach($nodeList as $node)
                                            <tr class="odd gradeX">
                                                <td> {{$node->SS->id}} </td>
                                                <td>
                                                    @if(!$node->SS->status)
                                                        <span class="label label-warning" title="维护中">{{$node->SS->name}}</span>
                                                    @else
                                                        {{$node->SS->name}}
                                                    @endif
                                                </td>
                                                <td> <span class="label label-info">{{$node->SS->server}}</span> </td>
                                                <td> <span class="label label-danger">{{$node->SS->ip}}</span> </td>
                                                <td>
                                                    @if($node->t_tcp_status) <span class="label label-info">正常</span> @endif
                                                    @if(!$node->t_tcp_status) <span class="label label-danger">异常</span> @endif
                                                </td>
                                                <td>
                                                    @if($node->t_icmp_status) <span class="label label-info">正常</span> @endif
                                                    @if(!$node->t_icmp_status) <span class="label label-danger">异常</span> @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$nodeList->total()}} 个节点</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $nodeList->links() }}
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
@endsection
@extends('front.layouts')

@section('content')
    <style>
        .PlanCard__total-full-price:after{
            border-bottom: 2px solid #999;
        }
        .mb-sm-11{
                margin-bottom: 10px;
        }
        @media (min-width: 768px){
            .mb-sm-7 {
                margin-top: 32px;
            }
        }
        .mb-5 {
            margin-top: 16px;
        }

    </style>
    <hr class="bg-bw-4 my-0">
    <main>
        <div class="bg-bw-2">
            <div class="container" style="margin-top: 10px">
                <img src="/images/buy_center.jpg?v=1.0" class="img-responsive" alt="Responsive image">
            </div>
            <div id="plan-section" class="PlanCardsSection">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="SectionLabel fwm lead mb-5 mb-sm-7"><span
                                        class="SectionLabel__badge mr-4"><span class="Badge c-bw-1 bg-bw-11"><span>计划一</span></span></span>
                                <h2 class="Title lead SectionLabel__text c-bw-12 fwm"><span>入门级(节点数量5-10，不含国内节点)</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row row__flex mb-9 mb-sm-11">
                        @foreach($goodList['fresh'] as $fresh)
                            <div class="col-xs-12 col-sm-4 pb-6 pb-sm-7">
                                <div>
                                    <a href="/user/addOrder?goods_id={{$fresh->id}}">
                                    <div class="Paper bg-bw-1 PlanCard text-center PlanCard--type-special sha-1 sha-3-hover">
                                        <div class="PlanCard__body p-5">
                                            <div class="PlanCard__indicators">
                                                <div class="PlanCard__radio"><span
                                                            class="isvg loaded SVG-wrapper SVG-loaded"><svg
                                                                viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                                                class="SVG SVG--inline scale-24 js-SVG--with-scale c-bw-1"><path
                                                                    d="M13 5.496L11.571 4 6.47 9.342 4.43 7.205 3 8.701l3.47 3.632z"
                                                                    fill="#151922"></path></svg></span></div>
                                            </div>
                                            <div class="PlanCard__name pb-3 pt-5 pt-sm-7 pt-md-5"><p
                                                        class="Text fwb c-bw-12"><span>{{$fresh->name}}</span></p>
                                            </div>
                                            <div class="PlanCard__pricing fwb mt-2 c-bw-12"><span>¥</span>
                                                <h2 class="Title d-inline-block pl-2 lh1">{{$fresh->price}} </h2>
                                                <span class="d-block small fwm mb-4 mb-md-5 mt-2">
                                                    @if($fresh->price != 18)
                                                        <s style="color:#f64f64;">￥{{$fresh->p}}</s>&nbsp;{{$fresh->discount}}折
                                                    @else
                                                        &nbsp;
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="PlanCard__description">
                                                <div class="mb-6"><span
                                                            class="Badge c-red-6 bg-red-2"><span>{{$fresh->desc}}</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="SectionLabel fwm lead mb-5 mb-sm-7"><span
                                        class="SectionLabel__badge mr-4"><span class="Badge c-bw-1 bg-bw-11"><span>计划二</span></span></span>
                                <h2 class="Title lead SectionLabel__text c-bw-12 fwm"><span>专业级（节点数量>10，包含国内和CN2节点）</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row row__flex mb-9 mb-sm-11">
                        @foreach($goodList['pro'] as $fresh)
                            <div class="col-xs-12 col-sm-4 pb-6 pb-sm-7">
                                <div>
                                    <a href="/user/addOrder?goods_id={{$fresh->id}}">

                                    <div class="Paper bg-bw-1 PlanCard text-center PlanCard--type-special sha-1 sha-3-hover">
                                        <div class="PlanCard__body p-5">
                                            <div class="PlanCard__indicators">
                                                <div class="PlanCard__radio"><span
                                                            class="isvg loaded SVG-wrapper SVG-loaded"><svg
                                                                viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                                                class="SVG SVG--inline scale-24 js-SVG--with-scale c-bw-1"><path
                                                                    d="M13 5.496L11.571 4 6.47 9.342 4.43 7.205 3 8.701l3.47 3.632z"
                                                                    fill="#151922"></path></svg></span></div>
                                            </div>
                                            <div class="PlanCard__name pb-3 pt-5 pt-sm-7 pt-md-5"><p
                                                        class="Text fwb c-bw-12"><span>{{$fresh->name}}</span></p>
                                            </div>
                                            <div class="PlanCard__pricing fwb mt-2 c-bw-12"><span>¥</span>
                                                <h2 class="Title d-inline-block pl-2 lh1">{{$fresh->price}}</h2>
                                                <span class="d-block small fwm mb-4 mb-md-5 mt-2">
                                                    @if($fresh->price != 30)
                                                        <s style="color:#f64f64;">￥{{$fresh->p}}</s>&nbsp;{{$fresh->discount}}折
                                                    @else
                                                        &nbsp;
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="PlanCard__description">
                                                <div class="mb-6"><span
                                                            class="Badge c-red-6 bg-red-2"><span>{{$fresh->desc}}</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function buy(id) {
            window.location.href='/user/addOrder?goods_id='+id;
        }
    </script>
@endsection
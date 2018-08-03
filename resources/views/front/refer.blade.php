@extends('front.layouts')

@section('title', '穿云梯加速器')
@section('content')
    <style>
        .indexImg{
            height: 96px;
        }
        .title_ohh{
            font-weight: 600;
        }
        .content_ohh{
            color: #333;
        }
        .base{
            font-size: 20px;
        }
        .TableCard__item{
            width: 80%;
            margin-left: 10%;
            text-align: center;
        }
    </style>

    <div class="BaseTemplate AffiliateProgram">
        <section class="BannerWrapper text-center">
            <div class="Background Background--hidden-sm-up" style="background-image:url('/images/refer_011.jpg');background-repeat:no-repeat;background-position:center bottom;background-size:cover">
                <div class="Background Background--hidden-xs" style="background-image:url('/images/refer_011.jpg');background-color:transparent;background-repeat:no-repeat;background-position:center;background-size:cover">
                    <div class="container">
                        <div class="Banner">
                            <div class="row d-sm-flex">
                                <div class="col-xs-12 col-sm-12 my-auto py-sm-11 py-md-14 pt-11 pb-11">
                                    <h1 class="Title h2 mb-5 mb-sm-6 text-xs-center"><span>合作共赢，共举大事</span></h1>
                                    <p class="Text mb-5 mb-sm-6 text-xs-center fwm"><span>马上加入穿云梯网络加速器代理团队，享受高佣金政策待遇！</span></p>
                                    <div class="mb-5 mb-sm-4"><a class="Button Button--primary Button--large Button--outline Button--block-xs d-sm-inline-block mb-5 mb-sm-4 mr-sm-4" role="button" tabindex="0"><span>QQ：2747305744</span></a><a class="Button Button--primary Button--large Button--outline Button--block-xs d-sm-inline-block mb-sm-4" role="button" tabindex="0"><span>微信：chuanyunti</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="SectionWrapper py-11 py-sm-12 py-md-14">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-offset-1 col-sm-10 text-center">
                            <h3 class="Title mb-6"><span>为什么要加入我们？</span></h3>
                            {{--<p class="Text small c-bw-9 mb-6"><span>Make money in 3 easy steps.</span></p>--}}
                        </div>
                    </div>
                    <div class="row row__flex row--justify-between">
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="FeatureItem text-center px-md-6 py-7 py-sm-8">
                                <div><img src="/images/refer_03.svg" class="Image mb-6" alt="Sign up">
                                    <h6 class="Title base mb-3 fwm"><span class="vertical-middle"><span>高佣金丰厚待遇</span></span>
                                    </h6>
                                    <p class="Text small mb-0"><span>最高享受50%佣金，其次用户续费代理依然获得佣金</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="FeatureItem text-center px-md-6 py-7 py-sm-8">
                                <div><img src="/images/refer_02.svg" class="Image mb-6" alt="Get material">
                                    <h6 class="Title base mb-3 fwm"><span class="vertical-middle"><span>好产品值得为身边朋友推荐</span></span>
                                    </h6>
                                    <p class="Text small mb-0"><span>高质量产品，贴心的服务，值得推荐使用</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="FeatureItem text-center px-md-6 py-7 py-sm-8">
                                <div><img src="/images/refer_04.svg" class="Image mb-6" alt="Commisions">
                                    <h6 class="Title base mb-3 fwm"><span class="vertical-middle"><span>推广工作简单</span></span>
                                    </h6>
                                    <p class="Text small mb-0"><span>微信朋友圈，QQ群发，简单转播，无需专业技术</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-bw-2">
            <div class="SectionWrapper py-11 py-sm-12 py-md-14">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-offset-1 col-sm-10 text-center">
                            <h3 class="Title mb-4 mb-sm-6"><span>代理制度</span></h3>
                            {{--<p class="Text small c-bw-9"><span>Our commission rates are one of the best in the industry. What you earn depends on the subscription<br class="visible-md visible-lg"> plan ordered by each customer you refer.</span></p>--}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-offset-1 col-xs-offset-1 col-sm-offset-1 col-xs-10 col-sm-10 col-lg-10 py-10 py-sm-10">
                            <p class="Text c-bw-9 fwm py-4 pt-md-0" style="font-size: 23px;font-weight: 700"><span>入门型用户</span></p>
                            <div class="Paper bg-bw-1 TableCard px-5 py-4 p-sm-5 p-md-6 sha-1">
                                <div>
                                    <div class="TableCard__item d-flex align-items-center py-4">
                                        <p class="Text small fwm c-bw-12 mb-sm-2 mb-md-0" style="width: 10%"><span>类型</span></p>
                                        <p class="Text lead  fwb c-bw-12" style="width: 30%;color: #f64f64;">1月计划</p>
                                        <p class="Text lead  fwb c-bw-12" style="width: 30%;color: #f64f64;">3月计划</p>
                                        <p class="Text lead  fwb c-bw-12" style="width: 30%;color: #f64f64;">12月计划</p>
                                    </div>
                                    <hr class="my-0">
                                </div>
                                <div>
                                    <div class="TableCard__item d-flex align-items-center py-4">
                                        <p class="Text small fwm c-bw-12 mb-sm-2 mb-md-0" style="width: 10%"><span>费用</span></p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">18元</p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">42元</p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">138元</p>
                                    </div>
                                </div>
                                <div>
                                    <div class="TableCard__item d-flex align-items-center py-4">
                                        <p class="Text small fwm c-bw-12 mb-sm-2 mb-md-0" style="width: 10%"><span>首次消费佣金</span></p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">40%</p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">30%</p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">20%</p>
                                    </div>
                                </div>
                                <div>
                                    <div class="TableCard__item d-flex align-items-center py-4">
                                        <p class="Text small fwm c-bw-12 mb-sm-2 mb-md-0" style="width: 10%"><span>续费佣金</span></p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">20%</p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">20%</p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">20%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-offset-1 col-xs-offset-1 col-sm-offset-1 col-xs-10 col-sm-10 col-lg-10 py-10 py-sm-10">
                            <p class="Text c-bw-9 fwm py-4 pt-md-0" style="font-size: 23px;font-weight: 700"><span>专业型用户</span></p>
                            <div class="Paper bg-bw-1 TableCard px-5 py-4 p-sm-5 p-md-6 sha-1">
                                <div>
                                    <div class="TableCard__item d-flex align-items-center py-4">
                                        <p class="Text small fwm c-bw-12 mb-sm-2 mb-md-0" style="width: 10%"><span>类型</span></p>
                                        <p class="Text lead  fwb c-bw-12" style="width: 30%;color: #f64f64;">1月计划</p>
                                        <p class="Text lead  fwb c-bw-12" style="width: 30%;color: #f64f64;">3月计划</p>
                                        <p class="Text lead  fwb c-bw-12" style="width: 30%;color: #f64f64;">12月计划</p>
                                    </div>
                                    <hr class="my-0">
                                </div>
                                <div>
                                    <div class="TableCard__item d-flex align-items-center py-4">
                                        <p class="Text small fwm c-bw-12 mb-sm-2 mb-md-0" style="width: 10%"><span>费用</span></p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">30元</p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">70元</p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">228元</p>
                                    </div>
                                </div>
                                <div>
                                    <div class="TableCard__item d-flex align-items-center py-4">
                                        <p class="Text small fwm c-bw-12 mb-sm-2 mb-md-0" style="width: 10%"><span>首次消费佣金</span></p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">50%</p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">40%</p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">30%</p>
                                    </div>
                                </div>
                                <div>
                                    <div class="TableCard__item d-flex align-items-center py-4">
                                        <p class="Text small fwm c-bw-12 mb-sm-2 mb-md-0" style="width: 10%"><span>续费佣金</span></p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">20%</p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">20%</p>
                                        <p class="Text lead ml-auto fwb c-bw-12" style="width: 30%">20%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
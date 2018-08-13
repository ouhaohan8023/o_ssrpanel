@extends('front.layouts2')

@section('content')
    <style>
        .wp-AccordionCardItem__wrapper{
            background-color: #FFFFFF;
        }
    </style>
    <div class="BaseTemplate FAQ bg-bw-2">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
                        <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=2747305744&site=qq&menu=yes">
                            <img src="/images/kefu.jpg" class="img-responsive" alt="Responsive image" style="margin-top: 10px">
                        </a>
                        <div id="section-general" class="mb-11 mb-md-13" style="margin-bottom: 40px">
                            <h2 class="Title h5 pb-5" style="margin-top: 10px">功能使用疑问</h2>
                            <div class="wp-Accordion wp-Accordion--card" id="general" role="tablist"
                                 aria-multiselectable="true">
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#general"
                                         href="#collapse-general-1" aria-expanded="false"
                                         aria-controls="collapse-general-1">
                                        <div role="tab" id="heading-1">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        免费，入门，专业套餐之间有什么区别？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-general-1" class="wp-AccordionCardItem__content collapse"
                                             role="tabpanel" aria-labelledby="heading-1">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    1.免费用户指的是通过手机号注册，免费7天，可用流量为10G的用户。可以试用7-8个节点，包括国内外。<br/>
                                                    2.入门级用户指的是购买了加速套餐，可以享用对应套餐的流量数的用户，提供了15-20个节点，包括国内外。<br/>
                                                    3.专业级用户指的是购买了VIP不限量套餐，为穿云梯VIP用户，流量不限制，提供了24-30个节点，包括国内外以及独享节点。付款后，可以联系客服提供您的账号，我们会安排相应技术客服，点对点解决您的问题，享受VIP王者待遇！
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#general"
                                         href="#collapse-general-1" aria-expanded="false"
                                         aria-controls="collapse-general-1">
                                        <div role="tab" id="heading-1">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        设备数量限制是什么意思？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-general-1" class="wp-AccordionCardItem__content collapse"
                                             role="tabpanel" aria-labelledby="heading-1">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    设备数量是指同时在线的设备个数。比如您购买的套餐设备数量限制是2台，这意味着您可以在多个设备上使用我们的节点，但最多可以只支持2台设备同时使用客户端联网。
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#general"
                                         href="#collapse-general-2" aria-expanded="false"
                                         aria-controls="collapse-general-2">
                                        <div role="tab" id="heading-2">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        有没有免费获得试用的机会？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-general-2" class="wp-AccordionCardItem__content collapse"
                                             role="tabpanel" aria-labelledby="heading-2">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    可以通过手机号注册获得七天10G流量免费试用。
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#general"
                                         href="#collapse-general-3" aria-expanded="false"
                                         aria-controls="collapse-general-3">
                                        <div role="tab" id="heading-3">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        国内和国外节点有什么区别？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-general-3" class="wp-AccordionCardItem__content collapse"
                                             role="tabpanel" aria-labelledby="heading-3">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    如果需要查看海外网站的用户，可以选择负载率低的国外节点。如果需要查看国内网站的用户，则可选择负载率低的国内节点。穿云梯VPN服务为用户提供了数十个国内外节点。
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#general"
                                         href="#collapse-general-4" aria-expanded="false"
                                         aria-controls="collapse-general-4">
                                        <div role="tab" id="heading-4">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        Windows客户端，线路连接之后，无法登录网站？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-general-4" class="wp-AccordionCardItem__content collapse"
                                             role="tabpanel" aria-labelledby="heading-4">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    出现这种情况，有可能是受到浏览器插件干扰或者360安全卫士等软件拦截的缘故。请您关闭360安全卫士或查看所使用的浏览器，在设置中找到影响浏览器的插件，关闭插件即可。如问题持续，可提交工单或联系客服。
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#general"
                                         href="#collapse-general-5" aria-expanded="false"
                                         aria-controls="collapse-general-5">
                                        <div role="tab" id="heading-5">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        穿云梯VPN提供的节点速度如何，稳定吗？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-general-5" class="wp-AccordionCardItem__content collapse"
                                             role="tabpanel" aria-labelledby="heading-5">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    我们承诺使用高质量高带宽服务器节点，保证各类型网络都能告诉接入，保证国内外线路常年24小时高速稳定。同时，我们会用户提供大量优质节点，能有效避免突发大流量引起的服务器不稳定。
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#general"
                                         href="#collapse-general-6" aria-expanded="false"
                                         aria-controls="collapse-general-6">
                                        <div role="tab" id="heading-6">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        Windows、Mac客户端是不是一定要安装ShadowsocksR才能使用你们提供的节点？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-general-6" class="wp-AccordionCardItem__content collapse"
                                             role="tabpanel" aria-labelledby="heading-6">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    是的。详细可以查看安装使用教程。IOS以及Android有我们自己的app，请查看教程中心。
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#general"
                                         href="#collapse-general-7" aria-expanded="false"
                                         aria-controls="collapse-general-7">
                                        <div role="tab" id="heading-7">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        苹果客户端除了美服能够下载Potatso以外，还有其他方法能够下载或者使用你们的节点吗？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-general-7" class="wp-AccordionCardItem__content collapse"
                                             role="tabpanel" aria-labelledby="heading-7">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    穿云梯已经推出自己的IOS及Android App客户端啦！具体请查看【教程中心】
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#general"
                                         href="#collapse-general-8" aria-expanded="false"
                                         aria-controls="collapse-general-8">
                                        <div role="tab" id="heading-8">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        提交工单后一般多长时间会得到你们的回复？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-general-8" class="wp-AccordionCardItem__content collapse"
                                             role="tabpanel" aria-labelledby="heading-8">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    首先我们承诺会用最快速度解决您的问题，同时您可以咨询或留言QQ客服，我们会不超过24小时回复您的疑问。
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#general"
                                         href="#collapse-general-9" aria-expanded="false"
                                         aria-controls="collapse-general-9">
                                        <div role="tab" id="heading-9">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        你们会不定期更新节点吗？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-general-9" class="wp-AccordionCardItem__content collapse"
                                             role="tabpanel" aria-labelledby="heading-9">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    会的，为了更好服务穿云梯VPN用户，我们将不定时增加服务器节点，务求会用户提供更多高质量、稳定的节点服务。
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#general"
                                         href="#collapse-general-10" aria-expanded="false"
                                         aria-controls="collapse-general-10">
                                        <div role="tab" id="heading-10">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        更新节点后，我的客户端会自动更新吗？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-general-10" class="wp-AccordionCardItem__content collapse"
                                             role="tabpanel" aria-labelledby="heading-10">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    只要你是我们的套餐会员，并且提交了订阅节点服务（可在用户中心点击订阅节点），那么套餐用户的客户端的节点也会自动更新。
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="section-billing-and-sales" class="mb-11 mb-md-13">
                            <h2 class="Title h5 pb-5">套餐使用疑问</h2>
                            <div class="wp-Accordion wp-Accordion--card" id="billing-and-sales" role="tablist"
                                 aria-multiselectable="true">
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#billing-and-sales"
                                         href="#collapse-billing-and-sales-1" aria-expanded="false"
                                         aria-controls="collapse-billing-and-sales-1">
                                        <div role="tab" id="heading-1">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        服务计时没有结束时能否续费？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-billing-and-sales-1"
                                             class="wp-AccordionCardItem__content collapse" role="tabpanel"
                                             aria-labelledby="heading-1">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    能续费。续费之后的天数等于套餐包含的天数加上之前剩余的天数。
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#billing-and-sales"
                                         href="#collapse-billing-and-sales-2" aria-expanded="false"
                                         aria-controls="collapse-billing-and-sales-2">
                                        <div role="tab" id="heading-2">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        套餐结束日期还没到，但流量已经完成怎么办？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-billing-and-sales-2"
                                             class="wp-AccordionCardItem__content collapse" role="tabpanel"
                                             aria-labelledby="heading-2">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                   只能重新订阅套餐，计费日期从订购新套餐日期开始。（例如：用户本来的结束日期在2018-6-25，但在2018-6-18的时候已经把流量用完了，那么如果他在当天重新订阅套餐日期是一个月，那么新套餐的计算时间是从2018-6-18开始顺数30天）
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#billing-and-sales"
                                         href="#collapse-billing-and-sales-3" aria-expanded="false"
                                         aria-controls="collapse-billing-and-sales-3">
                                        <div role="tab" id="heading-3">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        流量还用完，到套餐结束日已经到了怎么办？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-billing-and-sales-3"
                                             class="wp-AccordionCardItem__content collapse" role="tabpanel"
                                             aria-labelledby="heading-3">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    套餐流量会在服务到期后清零并且不累积。如果在未过期之前续订其他套餐，使用期限会进行叠加并延长。
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#billing-and-sales"
                                         href="#collapse-billing-and-sales-4" aria-expanded="false"
                                         aria-controls="collapse-billing-and-sales-4">
                                        <div role="tab" id="heading-4">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        穿云梯VPN支持哪些支付渠道？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-billing-and-sales-4"
                                             class="wp-AccordionCardItem__content collapse" role="tabpanel"
                                             aria-labelledby="heading-4">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    穿云梯VPN目前支持以下支付方式：微信，支付宝，PayPal和信用卡。
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#billing-and-sales"
                                         href="#collapse-billing-and-sales-5" aria-expanded="false"
                                         aria-controls="collapse-billing-and-sales-5">
                                        <div role="tab" id="heading-5">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        套餐流量是怎样计算监控的？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-billing-and-sales-5"
                                             class="wp-AccordionCardItem__content collapse" role="tabpanel"
                                             aria-labelledby="heading-5">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    用户中心有流量日志，能够查看各自24小时和30天的流量使用情况。
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wp-AccordionCardItem js-AccordionCardItem panel py-3">
                                    <div class="wp-AccordionCardItem__wrapper p-5 py-sm-6 px-sm-7 sha-1 sha-2-hover d-block"
                                         role="button" data-toggle="collapse" data-parent="#billing-and-sales"
                                         href="#collapse-billing-and-sales-6" aria-expanded="false"
                                         aria-controls="collapse-billing-and-sales-6">
                                        <div role="tab" id="heading-6">
                                            <div class="wp-AccordionCardItem__title">
                                                <div class="c-bw-12 d-flex">
                                                    <h3 class="Title base fwm c-bw-12 pr-4">
                                                        如果不想用了，可以退款吗？
                                                    </h3>
                                                    <span class="SVG-wrapper">
                                                        <img
                                                                src="/images/chevrons-down.svg"
                                                                alt="chevrons up"
                                                                class="SVG scale-16 js-SVG--with-scale">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapse-billing-and-sales-6"
                                             class="wp-AccordionCardItem__content collapse" role="tabpanel"
                                             aria-labelledby="heading-6">
                                            <div class="pt-3 pt-sm-5 c-bw-9 small">
                                                <span>
                                                    非常遗憾的告诉用户，我们将会竭尽所能为您解决所有问题，而且由于用户使用套餐节点服务期间产生了成本，因此目前我们没有退款的办理，请谅解。
                                                </span>
                                            </div>
                                        </div>
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
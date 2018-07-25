<?php
namespace App\Http\Controllers;

use App\Components\Yzy;
use App\Http\Models\Coupon;
use App\Http\Models\Goods;
use App\Http\Models\GoodsLabel;
use App\Http\Models\Order;
use App\Http\Models\Payment;
use App\Http\Models\PaymentCallback;
use App\Http\Models\ReferralLog;
use App\Http\Models\User;
use App\Http\Models\UserLabel;
use Illuminate\Http\Request;
use Response;
use Redirect;
use Log;
use DB;

class PaymentController extends Controller
{
    protected static $config;

    function __construct()
    {
        self::$config = $this->systemConfig();
    }

    // 创建支付单
    public function create(Request $request)
    {
        $goods_id = intval($request->get('goods_id'));
        $coupon_sn = $request->get('coupon_sn');
        $user = $request->session()->get('user');

        $goods = Goods::query()->where('id', $goods_id)->where('status', 1)->first();
        if (!$goods) {
            return Response::json(['status' => 'fail', 'data' => '', 'message' => '创建支付单失败：商品或服务已下架']);
        }

        // 判断是否开启有赞云支付
        if (!self::$config['is_youzan']) {
            return Response::json(['status' => 'fail', 'data' => '', 'message' => '创建支付单失败：系统并未开启在线支付功能']);
        }

        // 判断是否存在同个商品的未支付订单
        $existsOrder = Order::query()->where('goods_id', $goods_id)->where('status', 0)->where('user_id', $user['id'])->first();
        if ($existsOrder) {
            return Response::json(['status' => 'fail', 'data' => '', 'message' => '创建支付单失败：尚有未支付的订单，请先去支付']);
        }

        // 使用优惠券
        if ($coupon_sn) {
            $coupon = Coupon::query()->where('sn', $coupon_sn)->whereIn('type', [1, 2])->where('is_del', 0)->where('status', 0)->first();
            if (!$coupon) {
                return Response::json(['status' => 'fail', 'data' => '', 'message' => '创建支付单失败：优惠券不存在']);
            }

            // 计算实际应支付总价
            $amount = $coupon->type == 2 ? $goods->price * $coupon->discount : $goods->price - $coupon->amount;
            $amount = $amount > 0 ? $amount : 0;
        } else {
            $amount = $goods->price;
        }

        // 如果最后总价格为0，则不允许创建支付单
        if ($amount <= 0) {
            return Response::json(['status' => 'fail', 'data' => '', 'message' => '创建支付单失败：合计价格为0，无需使用在线支付']);
        }

        DB::beginTransaction();
        try {
            $user = $request->session()->get('user');
            $orderSn = date('ymdHis') . mt_rand(100000, 999999);
            $sn = makeRandStr(12);

            // 生成订单
            $order = new Order();
            $order->order_sn = $orderSn;
            $order->user_id = $user['id'];
            $order->goods_id = $goods_id;
            $order->coupon_id = !empty($coupon) ? $coupon->id : 0;
            $order->origin_amount = $goods->price;
            $order->amount = $amount;
            $order->expire_at = date("Y-m-d H:i:s", strtotime("+" . $goods->days . " days"));
            $order->is_expire = 0;
            $order->pay_way = 2;
            $order->status = 0;
            $order->save();

            // 生成支付单
            $yzy = new Yzy();
            $result = $yzy->createQrCode($goods->name, $amount * 100, $orderSn);
            if (isset($result['error_response'])) {
                Log::error('【有赞云】创建二维码失败：' . $result['error_response']['msg']);

                throw new \Exception($result['error_response']['msg']);
            }

            $payment = new Payment();
            $payment->sn = $sn;
            $payment->user_id = $user['id'];
            $payment->oid = $order->oid;
            $payment->order_sn = $orderSn;
            $payment->pay_way = 1;
            $payment->amount = $amount;
            $payment->qr_id = $result['response']['qr_id'];
            $payment->qr_url = $result['response']['qr_url'];
            $payment->qr_code = $result['response']['qr_code'];
            $payment->qr_local_url = $this->base64ImageSaver($result['response']['qr_code']);
            $payment->status = 0;
            $payment->save();

            DB::commit();

            return Response::json(['status' => 'success', 'data' => $sn, 'message' => '创建支付单成功']);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('创建支付订单失败：' . $e->getMessage());

            return Response::json(['status' => 'fail', 'data' => '', 'message' => '创建支付单失败：' . $e->getMessage()]);
        }
    }

    // 支付单详情
    public function detail(Request $request, $sn,$yq=0)
    {
        if (empty($sn)) {
            return Redirect::to('user/goodsList');
        }

        $user = $request->session()->get('user');

        $payment = Payment::query()->with(['order', 'order.goods'])->where('sn', $sn)->where('user_id', $user['id'])->first();
        if (!$payment) {
            return Redirect::to('user/goodsList');
        }

        $order = Order::query()->where('oid', $payment->oid)->first();
        if (!$order) {
            $request->session()->flash('errorMsg', '订单不存在');

            return Response::view('payment/' . $sn);
        }

        if($yq) {
          $view['ways'] = '支付宝';
        }else{
          $view['ways'] = '支付宝、QQ、微信';
        }

        $view['payment'] = $payment;
        $view['website_analytics'] = self::$config['website_analytics'];
        $view['website_customer_service'] = self::$config['website_customer_service'];

        return Response::view('payment/detail', $view);
    }

    // 获取订单支付状态
    public function getStatus(Request $request)
    {
        $sn = $request->get('sn');

        if (empty($sn)) {
            return Response::json(['status' => 'fail', 'data' => '', 'message' => '请求失败']);
        }

        $user = $request->session()->get('user');
        $payment = Payment::query()->where('sn', $sn)->where('user_id', $user['id'])->first();
        if (!$payment) {
            return Response::json(['status' => 'fail', 'data' => '', 'message' => '支付失败']);
        }

        if ($payment->status) {
            return Response::json(['status' => 'success', 'data' => '', 'message' => '支付成功']);
        } else if ($payment->status < 0) {
            return Response::json(['status' => 'fail', 'data' => '', 'message' => '支付失败']);
        } else {
            return Response::json(['status' => 'fail', 'data' => '', 'message' => '等待支付']);
        }
    }

    // 有赞云回调日志
    public function callbackList(Request $request)
    {
        $status = $request->get('status', 0);

        $query = PaymentCallback::query();

        if ($status) {
            $query->where('status', $status);
        }

        $view['list'] = $query->orderBy('id', 'desc')->paginate(10);

        return Response::view('payment/callbackList', $view);
    }

    // E聚合
    public function ECharge (Request $request)
    {
      $url = 'http://pay.heiyaogy.com/API/Bank/';
      $data['LinkID'] = 'BBC'.time().substr(ip2long($request->ip()), -6).rand(1000,9999);
      $data['ForUserId'] = '796561';
      $data['Channelid'] = '7771';
      $data['Moneys'] = '1';
      $data['AssistStr'] = '';
      $data['ReturnUrl'] = 'https://chuanyunti.com/e_charge_return';
      $NotifyUrl = '';
      $key = 'iXtzDCgX1aHkcOO30Zz7UO2bOoY3O0nA';

      $Sign = 'LinkID='.$data['LinkID'].'&ForUserId='.$data['ForUserId'].'&Channelid='.$data['Channelid'].'&Moneys='.$data['Moneys'].'&AssistStr='.$data['AssistStr'].'&ReturnUrl='.$data['ReturnUrl'].'&Key='.$key;
      var_dump($Sign);die;
      $data['Sign'] = md5($Sign);

      var_dump($data);die;
      $po = curlGet($url,'post',$data);
      echo '啊是大';
      header("Content-Type: text/html;charset=gbk");
      var_dump($po);die;
    }

    // E聚合回调
    public function EChargeReturn (Request $request)
    {
      $id = $request->get('LinkID');
      $code = $request->get('sErrorCode');
      $money = $request->get('Moneys');
      Log::info('EQ订单号：'.$id."/n金额：".$money."/n状态：".$code);
    }

  // 创建支付单
    public function createByOhh(Request $request)
    {
      $goods_id = intval($request->get('goods_id'));
      $coupon_sn = $request->get('coupon_sn');
      $user = $request->session()->get('user');

      $goods = Goods::query()->where('id', $goods_id)->where('status', 1)->first();
      if (!$goods) {
        return Response::json(['status' => 'fail', 'data' => '', 'message' => '创建支付单失败：商品或服务已下架']);
      }

      // 判断是否开启eq支付
//      if (!self::$config['is_youzan']) {
//        return Response::json(['status' => 'fail', 'data' => '', 'message' => '创建支付单失败：系统并未开启在线支付功能']);
//      }

      // 判断是否存在同个商品的未支付订单
      $existsOrder = Order::query()->where('goods_id', $goods_id)->where('status', 0)->where('user_id', $user['id'])->first();
      if ($existsOrder) {
        return Response::json(['status' => 'fail', 'data' => '', 'message' => '创建支付单失败：尚有未支付的订单，请先去支付']);
      }

      // 使用优惠券
      if ($coupon_sn) {
        $coupon = Coupon::query()->where('sn', $coupon_sn)->whereIn('type', [1, 2])->where('is_del', 0)->where('status', 0)->first();
        if (!$coupon) {
          return Response::json(['status' => 'fail', 'data' => '', 'message' => '创建支付单失败：优惠券不存在']);
        }

        // 计算实际应支付总价
        $amount = $coupon->type == 2 ? $goods->price * $coupon->discount : $goods->price - $coupon->amount;
        $amount = $amount > 0 ? $amount : 0;
      } else {
        $amount = $goods->price;
      }

      // 如果最后总价格为0，则不允许创建支付单
      if ($amount <= 0) {
        return Response::json(['status' => 'fail', 'data' => '', 'message' => '创建支付单失败：合计价格为0，无需使用在线支付']);
      }

      DB::beginTransaction();
      try {
        $user = $request->session()->get('user');
        $orderSn = 'BBC'.time().substr(ip2long($request->ip()), -6).rand(1000,9999);
        $sn = makeRandStr(12);

        // 生成订单
        $order = new Order();
        $order->order_sn = $orderSn;
        $order->user_id = $user['id'];
        $order->goods_id = $goods_id;
        $order->coupon_id = !empty($coupon) ? $coupon->id : 0;
        $order->origin_amount = $goods->price;
        $order->amount = $amount;
        $order->expire_at = date("Y-m-d H:i:s", strtotime("+" . $goods->days . " days"));
        $order->is_expire = 0;
        $order->pay_way = 2;
        $order->status = 0;
        $order->p_type = 1;
        $order->save();

        // 生成支付单
        $token = env('YQTOKEN'); //你的Token
        $secret = env('YQSECRET'); //你的Secret
        $url = env('YQURL');

        $params = array(
            'orderid' => $orderSn, //订单号
            'type' => env('YQTYPE'), //支付渠道
            'money' => $request->get('money'), //金额
            'attach' => '穿云梯加速器--'.$request->get('money').'元', //备注
            'ip' => $request->ip(), //客户端IP
            'callbackurl' => env('CALLBACKURL'), //回调
            'notifyurl' => env('NOTIFYURL'), //异步回调
        );
        ksort($params);
        $str = '';
        foreach($params as $key=>$rs)
        {
          $str .= $key.'='.$rs.'&';
        }
        $str .= 'key='.$secret; //你的密钥
        $params['sign'] = strtolower(md5($str));
        $paramstring = http_build_query($params);
        $content = self::makeCurl($url,$paramstring,1,$token);
        $result = json_decode($content,true);
        Log::info('支付回調：'.$content);

        $payment = new Payment();
        $payment->sn = $sn;
        $payment->user_id = $user['id'];
        $payment->oid = $order->oid;
        $payment->order_sn = $orderSn;
        $payment->pay_way = 1;
        $payment->amount = $amount;
        $payment->qr_url = $result['data']['pay_url'];
        $payment->qr_local_url = $result['data']['pay_url'];
        $payment->status = 0;
        $payment->save();

        DB::commit();

        return Response::json(['status' => 'success', 'data' => $sn, 'message' => '创建支付单成功']);
      } catch (\Exception $e) {
        DB::rollBack();

        Log::error('EQ创建支付订单失败：' . $e->getMessage());

        return Response::json(['status' => 'fail', 'data' => '', 'message' => '创建支付单失败：' . $e->getMessage()]);
      }
    }

    protected function makeCurl($url,$params=false,$ispost=0,$token){
      $httpInfo = array();
      $ch = curl_init();
      $headers = array();
      array_push($headers, "token: " . $token);
      if (1 == strpos("$".$url, "https://"))
      {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      }    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
      curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      if( $ispost )
      {
        curl_setopt( $ch , CURLOPT_POST , true );
        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
        curl_setopt( $ch , CURLOPT_URL , $url );
      }
      else
      {
        if($params){
          curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
        }else{
          curl_setopt( $ch , CURLOPT_URL , $url);
        }
      }
      $response = curl_exec( $ch );
      if ($response === FALSE) {
        return false;
      }
      $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
      $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
      curl_close( $ch );
      return $response;
    }

    // 易企支付回调
    public function YQChargeReturn (Request $request)
    {
      $status = $request->get('status');
      $code = $request->get('orderid');
      $money = $request->get('money');

      $payment = Payment::query()->where(['order_sn'=>$code,'status'=>0])->first();
      if($payment) {
        if($status=='0000'){
          // 处理订单
          DB::beginTransaction();
          try {
            // 更新支付单
            Payment::query()->where(['order_sn'=>$code,'status'=>0])->update(['status'=>1]);

            // 更新订单
            $order = Order::query()->with(['user'])->where('oid', $payment->oid)->first();
            $order->status = 2;
            $order->save();

            // 优惠券置为已使用
            $coupon = Coupon::query()->where('id', $order->coupon_id)->first();
            if ($coupon) {
              if ($coupon->usage == 1) {
                $coupon->status = 1;
                $coupon->save();
              }

              // 写入日志
              $couponLog = new CouponLog();
              $couponLog->coupon_id = $coupon->id;
              $couponLog->goods_id = $order->goods_id;
              $couponLog->order_id = $order->oid;
              $couponLog->save();
            }

            // 如果买的是套餐，则先将之前购买的所有套餐置都无效，并扣掉之前所有套餐的流量
            $goods = Goods::query()->where('id', $order->goods_id)->first();
            if ($goods->type == 2) {
              $existOrderList = Order::query()
                  ->with(['goods'])
                  ->whereHas('goods', function ($q) {
                    $q->where('type', 2);
                  })
                  ->where('user_id', $order->user_id)
                  ->where('oid', '<>', $order->oid)
                  ->where('is_expire', 0)
                  ->get();

              foreach ($existOrderList as $vo) {
                Order::query()->where('oid', $vo->oid)->update(['is_expire' => 1]);
                User::query()->where('id', $order->user_id)->decrement('transfer_enable', $vo->goods->traffic * 1048576);
              }
            }

            // 把商品的流量加到账号上
            User::query()->where('id', $order->user_id)->increment('transfer_enable', $goods->traffic * 1048576);

            // 套餐就改流量重置日，流量包不改
            if ($goods->type == 2) {
              // 将商品的有效期和流量自动重置日期加到账号上
              $traffic_reset_day = in_array(date('d'), [29, 30, 31]) ? 28 : abs(date('d'));
              User::query()->where('id', $order->user_id)->update(['traffic_reset_day' => $traffic_reset_day, 'expire_time' => date('Y-m-d', strtotime("+" . $goods->days . " days", strtotime($order->user->expire_time))), 'enable' => 1]);
            } else {
              // 将商品的有效期和流量自动重置日期加到账号上
              User::query()->where('id', $order->user_id)->update(['expire_time' => date('Y-m-d', strtotime("+" . $goods->days . " days")), 'enable' => 1]);
            }

            // 写入用户标签
            if ($goods->label) {
              // 取出现有的标签
              $userLabels = UserLabel::query()->where('user_id', $order->user_id)->pluck('label_id')->toArray();
              $goodsLabels = GoodsLabel::query()->where('goods_id', $order->goods_id)->pluck('label_id')->toArray();
              $newUserLabels = array_merge($userLabels, $goodsLabels);

              // 删除用户所有标签
              UserLabel::query()->where('user_id', $order->user_id)->delete();

              // 生成标签
              foreach ($newUserLabels as $vo) {
                $obj = new UserLabel();
                $obj->user_id = $order->user_id;
                $obj->label_id = $vo;
                $obj->save();
              }
            }

            // 写入返利日志
            if ($order->user->referral_uid) {
              $referralLog = new ReferralLog();
              $referralLog->user_id = $order->user_id;
              $referralLog->ref_user_id = $order->user->referral_uid;
              $referralLog->order_id = $order->oid;
              $referralLog->amount = $order->amount;
              $referralLog->ref_amount = $order->amount * self::$config['referral_percent'];
              $referralLog->status = 0;
              $referralLog->save();
            }

            DB::commit();
            Log::info('易企支付订单号(有效)：'.$status."/n金额：".$money."/n状态：".$code);
          } catch (\Exception $e) {
            DB::rollBack();

            Log::info('【易企支付】更新支付单和订单异常：' . $e->getMessage());
          }
        }else{
          Payment::query()->where(['order_sn'=>$code,'status'=>0])->update(['status'=>'-1']);
          Order::query()->where(['order_sn'=>$code])->update(['status'=>'-1']);
          Log::info('易企支付订单号(有效)：'.$status."/n金额：".$money."/n状态：".$code);
        }

      }else{
        Log::info('易企支付订单号(无效)：'.$status."/n金额：".$money."/n状态：".$code);
      }
    }
}
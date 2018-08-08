<?php

namespace App\Http\Controllers;

use App\Http\Models\Invite;
use App\Http\Models\SsConfig;
use App\Http\Models\User;
use App\Http\Models\UserLabel;
use App\Http\Models\UserSubscribeLog;
use App\Http\Models\Verify;
use App\Http\Models\YwLog;
use App\Http\Models\YwStatus;
use App\Jobs\MailQueue;
use Illuminate\Http\Request;
use Captcha;
use Response;
use Redirect;
use Cache;
/**
 * 注册控制器
 * Class LoginController
 *
 * @package App\Http\Controllers
 */
class RegisterController extends Controller
{
    protected static $config;

    function __construct()
    {
        self::$config = $this->systemConfig();
    }

    // 注册页
    public function index(Request $request)
    {
        $cacheKey = 'register_times_' . md5($request->getClientIp()); // 注册限制缓存key

        if ($request->method() == 'POST') {
            $username = trim($request->get('username'));
            $password = trim($request->get('password'));
            $repassword = trim($request->get('repassword'));
            $captcha = trim($request->get('captcha'));
            $code = trim($request->get('code'));
            $register_token = $request->get('register_token');
            $aff = intval($request->get('aff', 0));

            // 防止重复提交
            $session_register_token = $request->session()->get('register_token');
            if (empty($register_token) || $register_token != $session_register_token) {
                $request->session()->flash('errorMsg', '请勿重复请求，刷新一下页面再试试');

                return Redirect::back()->withInput();
            } else {
                $request->session()->forget('register_token');
            }

            if (empty($username)) {
                $request->session()->flash('errorMsg', '请输入用户名');

                return Redirect::back()->withInput();
            } else if ($this->TenMinutesEmail($username)) {
              $request->session()->flash('errorMsg', '禁用此邮箱');

              return Redirect::back()->withInput();
            }else if (empty($password)) {
                $request->session()->flash('errorMsg', '请输入密码');

                return Redirect::back()->withInput();
            } else if (empty($repassword)) {
                $request->session()->flash('errorMsg', '请重新输入密码');

                return Redirect::back()->withInput();
            }else if (strlen($password)<8) {
              $request->session()->flash('errorMsg', '密码必须大于8位');

              return Redirect::back()->withInput();
            } else if (md5($password) != md5($repassword)) {
                $request->session()->flash('errorMsg', '两次输入密码不一致，请重新输入');

                return Redirect::back()->withInput($request->except(['password', 'repassword']));
            } else if (false === filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $request->session()->flash('errorMsg', '用户名必须是合法邮箱，请重新输入');

                return Redirect::back()->withInput();
            }

            // 是否校验验证码
            if (self::$config['is_captcha']) {
                if (!Captcha::check($captcha)) {
                    $request->session()->flash('errorMsg', '验证码错误，请重新输入');

                    return Redirect::back()->withInput($request->except(['password', 'repassword']));
                }
            }

            // 是否开启注册
            if (!self::$config['is_register']) {
                $request->session()->flash('errorMsg', '系统维护暂停注册');

                return Redirect::back();
            }

            // 如果需要邀请注册
            if (self::$config['is_invite_register']) {
                if (empty($code)) {
                    $request->session()->flash('errorMsg', '请输入邀请码');

                    return Redirect::back()->withInput();
                }

                // 校验邀请码合法性
                $code = Invite::query()->where('code', $code)->where('status', 0)->first();
                if (empty($code)) {
                    $request->session()->flash('errorMsg', '邀请码不可用，请更换邀请码后重试');

                    return Redirect::back()->withInput($request->except(['code']));
                }
            }

            // 24小时内同IP注册限制
            if (self::$config['register_ip_limit']) {
                if (Cache::has($cacheKey)) {
                    $registerTimes = Cache::get($cacheKey);
                    if ($registerTimes >= self::$config['register_ip_limit']) {
                        $request->session()->flash('errorMsg', '系统已开启防刷机制，请勿频繁注册');

                        return Redirect::back()->withInput($request->except(['code']));
                    }
                }
            }

            // 校验用户名是否已存在
            $exists = User::query()->where('username', $username)->first();
            if ($exists) {
                $request->session()->flash('errorMsg', '用户名已存在，请更换用户名');

                return Redirect::back()->withInput();
            }

            // 校验aff对应账号是否存在
            if ($aff) {
                $affUser = User::query()->where('id', $aff)->first();
                $referral_uid = $affUser ? $aff : 0;
            } else {
                $referral_uid = 0;
            }

            // 最后一个可用端口
            $last_user = User::query()->orderBy('id', 'desc')->first();
            $port = self::$config['is_rand_port'] ? $this->getRandPort() : $last_user->port + 1;

            // 默认加密方式、协议、混淆
            $method = SsConfig::query()->where('type', 1)->where('is_default', 1)->first();
            $protocol = SsConfig::query()->where('type', 2)->where('is_default', 1)->first();
            $obfs = SsConfig::query()->where('type', 3)->where('is_default', 1)->first();

            // 创建新用户
            $transfer_enable = $referral_uid ? (self::$config['default_traffic'] + self::$config['referral_traffic']) * 1048576 : self::$config['default_traffic'] * 1048576;
            $user = new User();
            $user->username = $username;
            $user->password = md5($password);
            $user->port = $port;
            $user->passwd = makeRandStr();
            $user->transfer_enable = $transfer_enable;
            $user->method = $method ? $method->name : 'aes-192-ctr';
            $user->protocol = $protocol ? $protocol->name : 'auth_chain_a';
            $user->obfs = $obfs ? $obfs->name : 'tls1.2_ticket_auth';
            $user->enable_time = date('Y-m-d H:i:s');
            $user->expire_time = date('Y-m-d H:i:s', strtotime("+" . self::$config['default_days'] . " days"));
            $user->reg_ip = $request->getClientIp();
            $user->referral_uid = $referral_uid;
            $user->u_contract_1 = $username;//记录邮箱
          $user->save();

            // 注册次数+1
            if ($user->id) {
                if (Cache::has($cacheKey)) {
                    Cache::increment($cacheKey);
                } else {
                    Cache::put($cacheKey, 1, 1440); // 24小时
                }
            }

            // 初始化默认标签
            if (count(self::$config['initial_labels_for_user']) > 0 && $user->id) {
                $labels = explode(',', self::$config['initial_labels_for_user']);
                foreach ($labels as $label) {
                    $userLabel = new UserLabel();
                    $userLabel->user_id = $user->id;
                    $userLabel->label_id = $label;
                    $userLabel->save();
                }
            }

            // 更新邀请码
            if (self::$config['is_invite_register'] && $user->id) {
                Invite::query()->where('id', $code->id)->update(['fuid' => $user->id, 'status' => 1]);
            }

            // 发送邮件
            if (self::$config['is_active_register']) {
                // 生成激活账号的地址
                $token = md5(self::$config['website_name'] . $username . microtime());
                $verify = new Verify();
                $verify->user_id = $user->id;
                $verify->username = $username;
                $verify->token = $token;
                $verify->status = 0;
                $verify->save();

                $activeUserUrl = self::$config['website_url'] . '/active/' . $token;
                $title = '注册激活';
                $content = '请求地址：' . $activeUserUrl;

                try {
                  $this->dispatch(new MailQueue($username,$activeUserUrl));
//                  MailQueue::dispatch(Mail::to($username)->send(new activeUser(self::$config['website_name'], $activeUserUrl)));
                    $this->sendEmailLog($user->id, $title, $content);
                } catch (\Exception $e) {
                    $this->sendEmailLog($user->id, $title, $content, 0, $e->getMessage());
                }

                $request->session()->flash('regSuccessMsg', '注册成功：激活邮件已发送，请查看邮箱');
            } else {
                // 如果不需要激活，则直接给推荐人加流量
                if ($referral_uid) {
                    $transfer_enable = self::$config['referral_traffic'] * 1048576;

                    User::query()->where('id', $referral_uid)->increment('transfer_enable', $transfer_enable);
                    User::query()->where('id', $referral_uid)->update(['enable' => 1]);
                }

                $request->session()->flash('regSuccessMsg', '注册成功');
            }

            return Redirect::to('login');
        } else {
            $request->session()->put('register_token', makeRandStr(16));

            // 如果第一次打开带返aff，则存储aff，防止再次打开无返利aff
          $affUID = intval($request->get('aff'));
            if ($affUID) {
                if (!$request->session('id',$affUID)->get('register_aff')) {
                    User::query()->where('id',$affUID)->increment('u_refer_link');
                    $request->session()->put('register_aff', intval($request->get('aff')));
                }
            }

            $view['is_captcha'] = self::$config['is_captcha'];
            $view['is_register'] = self::$config['is_register'];
            $view['is_invite_register'] = self::$config['is_invite_register'];
            $view['website_analytics'] = self::$config['website_analytics'];
            $view['website_customer_service'] = self::$config['website_customer_service'];

            return Response::view('register', $view);
        }
    }

    public function indexByPhone(Request $request)
    {
      $cacheKey = 'register_times_' . md5($request->getClientIp()); // 注册限制缓存key

      if ($request->method() == 'POST') {
        $smscode = trim($request->get('smscode'));
        $username = trim($request->get('username'));
        $password = trim($request->get('password'));
        $repassword = trim($request->get('repassword'));
        $captcha = trim($request->get('captcha'));
        $code = trim($request->get('code'));
        $register_token = $request->get('register_token');
        $aff = intval($request->get('aff', 0));

        $timeBefore = time()-1800;
        $smsData = \DB::table('smscode')->where([['c_phone','=',$username],['c_time','>=',$timeBefore],])->orderBy('c_id','DESC')->first();
//        print_r($smsData);die;
        if(!$smsData){
          $request->session()->flash('errorMsg', '验证码错误，请重新获取验证码');
          return Redirect::back()->withInput();
        }
        if(strtolower($smscode) != $smsData->c_code){
          $request->session()->flash('errorMsg', '短信验证码错误');
          return Redirect::back()->withInput();
        }
        // 防止重复提交
        $session_register_token = $request->session()->get('register_token');
        if (empty($register_token) || $register_token != $session_register_token) {
          $request->session()->flash('errorMsg', '请勿重复请求，刷新一下页面再试试');

          return Redirect::back()->withInput();
        } else {
          $request->session()->forget('register_token');
        }

        if (empty($username)) {
          $request->session()->flash('errorMsg', '请输入用户名');

          return Redirect::back()->withInput();
        } else if (empty($password)) {
          $request->session()->flash('errorMsg', '请输入密码');

          return Redirect::back()->withInput();
        } else if (empty($repassword)) {
          $request->session()->flash('errorMsg', '请重新输入密码');

          return Redirect::back()->withInput();
        } else if (strlen($password)<8) {
          $request->session()->flash('errorMsg', '密码必须大于8位');

          return Redirect::back()->withInput();
        } else if (md5($password) != md5($repassword)) {
          $request->session()->flash('errorMsg', '两次输入密码不一致，请重新输入');

          return Redirect::back()->withInput($request->except(['password', 'repassword']));
        }

        // 是否校验验证码
        if (self::$config['is_captcha']) {
          if (!Captcha::check($captcha)) {
            $request->session()->flash('errorMsg', '验证码错误，请重新输入');

            return Redirect::back()->withInput($request->except(['password', 'repassword']));
          }
        }

        // 是否开启注册
        if (!self::$config['is_register']) {
          $request->session()->flash('errorMsg', '系统维护暂停注册');

          return Redirect::back();
        }

        // 如果需要邀请注册
        if (self::$config['is_invite_register']) {
          if (empty($code)) {
            $request->session()->flash('errorMsg', '请输入邀请码');

            return Redirect::back()->withInput();
          }

          // 校验邀请码合法性
          $code = Invite::query()->where('code', $code)->where('status', 0)->first();
          if (empty($code)) {
            $request->session()->flash('errorMsg', '邀请码不可用，请更换邀请码后重试');

            return Redirect::back()->withInput($request->except(['code']));
          }
        }

        // 24小时内同IP注册限制
        if (self::$config['register_ip_limit']) {
          if (Cache::has($cacheKey)) {
            $registerTimes = Cache::get($cacheKey);
            if ($registerTimes >= self::$config['register_ip_limit']) {
              $request->session()->flash('errorMsg', '系统已开启防刷机制，请勿频繁注册');

              return Redirect::back()->withInput($request->except(['code']));
            }
          }
        }

        // 校验用户名是否已存在
        $exists = User::query()->where('username', $username)->first();
        if ($exists) {
          $request->session()->flash('errorMsg', '用户名已存在，请更换用户名');

          return Redirect::back()->withInput();
        }

        // 校验aff对应账号是否存在
        if ($aff) {
          $affUser = User::query()->where('id', $aff)->first();
          $referral_uid = $affUser ? $aff : 0;
        } else {
          $referral_uid = 0;
        }

        // 最后一个可用端口
        $last_user = User::query()->orderBy('id', 'desc')->first();
        $port = self::$config['is_rand_port'] ? $this->getRandPort() : $last_user->port + 1;

        // 默认加密方式、协议、混淆
        $method = SsConfig::query()->where('type', 1)->where('is_default', 1)->first();
        $protocol = SsConfig::query()->where('type', 2)->where('is_default', 1)->first();
        $obfs = SsConfig::query()->where('type', 3)->where('is_default', 1)->first();

        // 创建新用户
        $transfer_enable = $referral_uid ? (self::$config['default_traffic'] + self::$config['referral_traffic']) * 1048576 : self::$config['default_traffic'] * 1048576;
        $user = new User();
        $user->username = $username;
        $user->password = md5($password);
        $user->port = $port;
        $user->passwd = makeRandStr();
        $user->transfer_enable = $transfer_enable;
        $user->method = $method ? $method->name : 'aes-192-ctr';
        $user->protocol = $protocol ? $protocol->name : 'auth_chain_a';
        $user->obfs = $obfs ? $obfs->name : 'tls1.2_ticket_auth';
        $user->enable_time = date('Y-m-d H:i:s');
        $user->expire_time = date('Y-m-d H:i:s', strtotime("+" . self::$config['default_days'] . " days"));
        $user->reg_ip = $request->getClientIp();
        $user->referral_uid = $referral_uid;
        $user->status = 1;//直接激活
        $user->u_phone_status = 1;//已绑定手机
        $user->u_contract_0 = $username;//记录手机
        $user->save();

        // 注册次数+1
        if ($user->id) {
          if (Cache::has($cacheKey)) {
            Cache::increment($cacheKey);
          } else {
            Cache::put($cacheKey, 1, 1440); // 24小时
          }
        }

        // 初始化默认标签
        if (count(self::$config['initial_labels_for_user']) > 0 && $user->id) {
          $labels = explode(',', self::$config['initial_labels_for_user']);
          foreach ($labels as $label) {
            $userLabel = new UserLabel();
            $userLabel->user_id = $user->id;
            $userLabel->label_id = $label;
            $userLabel->save();
          }
        }

        // 更新邀请码
        if (self::$config['is_invite_register'] && $user->id) {
          Invite::query()->where('id', $code->id)->update(['fuid' => $user->id, 'status' => 1]);
        }

        $request->session()->flash('regSuccessMsg', '注册成功，请在下方登陆');
        return Redirect::to('login');
      } else {
        $request->session()->put('register_token', makeRandStr(16));

        // 如果第一次打开带返aff，则存储aff，防止再次打开无返利aff
        if (intval($request->get('aff'))) {
          if (!$request->session()->get('register_aff')) {
            $request->session()->put('register_aff', intval($request->get('aff')));
          }
        }

        $view['is_captcha'] = self::$config['is_captcha'];
        $view['is_register'] = self::$config['is_register'];
        $view['is_invite_register'] = self::$config['is_invite_register'];
        $view['website_analytics'] = self::$config['website_analytics'];
        $view['website_customer_service'] = self::$config['website_customer_service'];

        return Response::view('registerphone', $view);
      }
    }



    public function test2(){
//      测试python脚本
//      $site_name = env('APP_SITENAME');
//      $cmd = 'sh /home/wwwroot/'.$site_name.'/public/python/ssr_auto_install/run_ssr_auto_install.sh 149.28.131.192 3306 BS_shadowAccount rgay5qBtTXcQWbv3 shadow3 10 1 95.179.145.163 22 root 5]jBL2SPQ3_}K}Ts /home/wwwroot/'.$site_name.'/public/python/ssr_auto_install';
////      $cmd = 'sh /home/wwwroot/'.$site_name.'/public/python/ssr_auto_install/run_ssr_auto_install.sh  149.28.131.192 3306 BS_shadowAccount rgay5qBtTXcQWbv3 shadow3 11 1 104.238.150.175 22 root \'S)3deLvt!}KR3${R\' /home/wwwroot/shadow3.com/public/python/ssr_auto_install';
//      $last_line  = shell_exec($cmd);
//      print_r(shell_exec('whoami'));
////      echo $cmd;
//      echo "<pre>$last_line</pre>";

//      测试http/https
//      echo url('aaa');

      //测试邮箱
//      $activeUserUrl = 123;
//      $username = '137454534@qq.com';
//      $ret = Mail::to($username)->send(new activeUser(self::$config['website_name'], $activeUserUrl));
//      var_dump($ret);die;
      //测试 自动统计任务
//      YwStatus::query()->forceDelete();
//      die;
//      $InList = YwNode::query()->get()->toArray();
////      var_dump($InList);die;
//      $OutList = SsNode::query()->get()->toArray();
////      var_dump($OutList);die;
//      foreach ($InList as $k => $v) {
//        foreach ($OutList as $z => $b) {
//          $this->hhh($v['n_id'],$b['id']);
//        }
//      }
//      $in=14;
//      $out=11;
//      $find = YwLog::query()->where([['l_n_id','=',$in],['l_sn_id','=',$out]])->orderBy('l_time','DESC')->first()->toArray();
//      $exist = YwStatus::query()->where([['l_n_id','=',$in],['l_sn_id','=',$out]])->exists();
//      if($exist){
//        $ret = YwStatus::query()->where([['l_n_id','=',$in],['l_sn_id','=',$out]])->update(['l_status'=>$find['l_status'],'l_time'=>date('Y-m-d H:i:s')]);
//      }else{
//        $ret = YwStatus::query()->insert(['l_n_id'=>$find['l_n_id'],'l_sn_id'=>$find['l_sn_id'],'l_status'=>$find['l_status'],'l_time'=>date('Y-m-d H:i:s')]);
//      }
//      var_dump($ret);
//      $username = 'ouhaohan@gmail.com';
//      $activeUserUrl = 'baidu.com';
////      MailQueue::dispatch();
//      $this->dispatch(new MailQueue($username,$activeUserUrl));
//      $this->dispatch(new MailQueue($username,$activeUserUrl));

//      $request_times = UserSubscribeLog::query()->where('sid', 157)->where('request_time', '>=', date("Y-m-d H:i:s", strtotime("-24 hours")))->distinct('request_ip')->count('request_ip');
//      var_dump($request_times);die;

    }

    protected function hhh($in,$out){
      $find = YwLog::query()->where([['l_n_id','=',$in],['l_sn_id','=',$out]])->orderBy('l_time','DESC')->first()->toArray();
      $exist = YwStatus::query()->where([['l_n_id','=',$in],['l_sn_id','=',$out]])->exists();
      if($exist){
        $ret = YwStatus::query()->where([['l_n_id','=',$in],['l_sn_id','=',$out]])->update(['l_status'=>$find['l_status'],'l_time'=>date('Y-m-d H:i:s')]);
      }else{
        $ret = YwStatus::query()->insert(['l_n_id'=>$find['l_n_id'],'l_sn_id'=>$find['l_sn_id'],'l_status'=>$find['l_status'],'l_time'=>date('Y-m-d H:i:s')]);
      }
    }

  public function sendSms(Request $request){
      $data['c_phone'] = $request->input('phone');
      if(strlen($data['c_phone'])!=11){
        echo strlen($data['c_phone']);
        return 405;//手机号码错误
      }else{
        //同一个号码一小时5次限制
        $count1 = \DB::table('smscode')->where($data)->where('c_time','>=',time()-3600)->count();
        if($count1 > 10){
          return 406;
        }
        //同一个ip一小时10次限制
        $ip =  $request->getClientIp();
//        $area = self::getCity($ip);
        $f['c_ip'] = $ip;
        $count1 = \DB::table('smscode')->where($f)->where('c_time','>=',time()-3600)->count();
        if($count1 > 20){
          return 407;
        }

        $data['c_ip'] = $ip;
        $randStr = str_shuffle('1234567890');
        $data['c_code'] = substr($randStr,0,4);
        $data['c_country'] = 'wait';
        $data['c_city'] = 'wait';
        $data['c_time'] = time();
        $data['c_back'] = DoSend($data['c_phone'],[$data['c_code'],'30分钟'],env('TEMPID'));
        $data['c_code'] = strtolower($data['c_code']);
        $ret = \DB::table('smscode')->insert($data);
        if($ret){
          return 200;
        }else{
          return 400;//存储失败
        }
      }


  }

  /**
   * 获取ip地址
   */
  protected function getip(){
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
      $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
      $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
      $ip = getenv("REMOTE_ADDR");
    else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
      $ip = $_SERVER['REMOTE_ADDR'];
    else
      $ip = "unknown";
    return($ip);
  }

  /**
   * 获取地址
   */
  protected function getCity($ip = '')
  {
    $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
    $ip=json_decode(file_get_contents($url));
    if((string)$ip->code=='1'){
      return false;
    }
    $data = (array)$ip->data;
    return $data;
  }

  /**
   * 判断是否为临时邮箱
   */
  protected function TenMinutesEmail($username){
    if(strstr($username,'molms')
        ||strstr($username,'bnuis')
        ||strstr($username,'urltc')
        ||strstr($username,'lakqs')
        ||strstr($username,'www.bccto.me')
        ||strstr($username,'bccto.me')
        ||strstr($username,'4059.com')
        ||strstr($username,'4057.com')
        ||strstr($username,'chaichuang.com')
        ||strstr($username,'a7996.com')
        ||strstr($username,'3202.com')
        ||strstr($username,'xianbeitang.com')
        ||strstr($username,'dawin.com')
        ||strstr($username,'cr219.com')
        ||strstr($username,'jnpayy.com')
        ||strstr($username,'jiaxin8736.com')
        ||strstr($username,'cuirushi.org')
        ||strstr($username,'chacuo.net')
        ||strstr($username,'027168.com')
        ||strstr($username,'uzxia.com')
        ||strstr($username,'10minutemail.info')
        ||strstr($username,'emlhub.com')
        ||strstr($username,'10mail.org')
        ||strstr($username,'yomail.info')
        ||strstr($username,'emltmp.com')
        ||strstr($username,'emlpro.com')
        ||strstr($username,'emlhub.com')
        ||strstr($username,'10mail.org')
        ||strstr($username,'10mail.org')
        ||strstr($username,'lrc8.com')
        ||strstr($username,'1otc.com')
        ||strstr($username,'yopmail')
        ||strstr($username,'cool.fr.nf')
        ||strstr($username,'jetable.fr.nf')
        ||strstr($username,'nospam.ze.tc')
        ||strstr($username,'nomail.xl.cx')
        ||strstr($username,'mega.zik.dj')
        ||strstr($username,'speed.1s.fr')
        ||strstr($username,'courriel.fr.nf')
        ||strstr($username,'moncourrier.fr.nf')
        ||strstr($username,'monemail.fr.nf')
        ||strstr($username,'monmail.fr.nf')
        ||strstr($username,'robo3.co')
        ||strstr($username,'lgad.uu.me')
        ||strstr($username,'kpooa.com')
        ||strstr($username,'sharklasers.com')
        ||strstr($username,'boximail.com')
        ||strstr($username,'mt2015.com')
        ||strstr($username,'TempInbox.com')
        ||strstr($username,'TempEmail.net')
        ||strstr($username,'yuoia.com')
        ||strstr($username,'mt2015.com')
    ){
      return true;
    }else{
      return false;
    }
  }

}

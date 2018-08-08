<?php

namespace App\Http\Controllers;

use App\Http\Models\AppPush;
use App\Http\Models\User;
use App\Jobs\PushApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Redirect;

class PushController extends Controller
{
  public function push(Request $request)
  {
    $get['content'] = $request->get("content");
    $get['user'] = $request->get("user");
    if($get['user']){
      $u = 'Subscribed Users';
    }else{
      $u = 'Oscar';
    }
    if($get['content'] == '' || $get['user'] == ''){
      return view('admin.push');
    }else{
      $response = $this->sendMessage($get['content'],$u);

      $datas = json_decode($response, true);
      $data['p_o_id'] = $datas['id'];
      $data['p_nums'] = $datas['recipients'];
      $data['p_back'] = $response;
      $data['p_content'] = json_encode($get);
      AppPush::query()->create($data);
      $request->session()->flash('successMsg', '发送成功');
      return Redirect::back();

    }

  }

  public function test(){
    $config = $this->systemConfig();
    $userList = User::query()->where('transfer_enable', '>', 0)->whereIn('status', [0, 1])->where('enable', 1)->get();
    $u = [];
//    $i = 0;
    foreach ($userList as $user) {
      // 用户名不是邮箱的跳过
      if (false === filter_var($user->username, FILTER_VALIDATE_EMAIL)) {
        continue;
      }

      $lastCanUseDays = floor(round(strtotime($user->expire_time) - strtotime(date('Y-m-d H:i:s'))) / 3600 / 24);
      if ($lastCanUseDays > 0 && $lastCanUseDays <= $config['expire_days']) {
        $content = '账号还剩' . $lastCanUseDays . '天即将过期';
//        $u[$i]['user'] = ["field" => "tag", "key" => "user", "relation" => "=", "value" => $user->username];
//        $u[$i]['content'] = $content;
//        $i++;
        $u['user'] = ["field" => "tag", "key" => "user", "relation" => "=", "value" => $user->username];
        $u['content'] = $content;
//        dispatch(new PushApp($u)->onQueue('OneSignal'));
        PushApp::dispatch($u)->onQueue('OneSignal');
        unset($u);
      }
    }
//    echo '<pre>';
//    var_dump($u);die;
//    $this->dispatch(new PushApp($u));
//    PushApp::dispatch($u);

//    $u = [
////        ["field" => "tag", "key" => "user", "relation" => "=", "value" => "13303463126"],
//        ["field" => "tag", "key" => "user", "relation" => "=", "value" => "13303463125"]
//
//    ];
//    $ct = 'asdlklkdajslkd asd asd as dsa d';
//    $data = $this->sendMessageFilter($ct,$u);
//
//    var_dump($data);
  }
  /**
   *
   * Send to all subscribers
   * 内容 @param $ct
   * 用户:Oscar为测试 @param $u
   * @return mixed
   */
  protected function sendMessage($ct,$u) {
    $content      = array(
        "en" => $ct
    );
    $fields = array(
        'app_id' => env('ONESIGNAL_KEY'),
        'included_segments' => array(
            $u
        ),
        'data' => array(
            "foo" => "bar"
        ),
        'contents' => $content,
    );

    $fields = json_encode($fields);
//    echo '<pre>';
//    print("\nJSON sent:\n");
//    print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic '.env('ONESIGNAL_API')
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
  }


}

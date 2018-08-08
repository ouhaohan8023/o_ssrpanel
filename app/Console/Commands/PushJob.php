<?php

namespace App\Console\Commands;

use App\Http\Models\Config;
use App\Http\Models\User;
use App\Jobs\PushApp;
use Illuminate\Console\Command;
use Log;

class PushJob extends Command
{
    protected $signature = 'pushJob';
    protected $description = '推送过期提醒';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
      $config = $this->systemConfig();
      $userList = User::query()->where('transfer_enable', '>', 0)->whereIn('status', [0, 1])->where('enable', 1)->get();
      $u = [];
      foreach ($userList as $user) {
        $lastCanUseDays = ceil(round(strtotime($user->expire_time) - strtotime(date('Y-m-d H:i:s'))) / 3600 / 24);
        if ($lastCanUseDays > 0 && $lastCanUseDays <= $config['expire_days']) {
          $content = '小主！您的账号还剩' . $lastCanUseDays . '天就要过期啦！';
          $u['user'] = [["field" => "tag", "key" => "user", "relation" => "=", "value" => $user->username]];
          $u['content'] = $content;
//        $this->sendMessageFilter($u['content'],$u['user']);
          PushApp::dispatch($u)->onQueue('OneSignal');
          unset($u);
        }
      }
      Log::info('定时任务：' . $this->description);
    }

    // 系统配置
    public function systemConfig()
    {
      $config = Config::query()->get();
      $data = [];
      foreach ($config as $vo) {
        $data[$vo->name] = $vo->value;
      }

      return $data;
    }
}

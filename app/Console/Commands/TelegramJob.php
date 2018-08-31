<?php

namespace App\Console\Commands;

use App\Http\Models\SsNodeTcpIcmp;
use Illuminate\Console\Command;
use App\Http\Models\Invite;
use Log;

class TelegramJob extends Command
{
    protected $signature = 'telegramJob';
    protected $description = '节点TCP阻断Telegram通知';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
      $s = SsNodeTcpIcmp::query()->with('SS')->where('tg',0)->where('t_tcp_status',0)->get();
      foreach ($s as $k => $v){
        if(empty($v->SS)){
          continue;
        }
        $msg = '
*大哥，他们又杀了我们一个兄弟！:*
*ip:'.$v->SS->ip.'*
*名称:'.$v->SS->client_name.'*';
        //tg 通知
        $method = 'sendMessage';
        $backMsg['chat_id'] = env('TELEGRAM_GROUP');
        $backMsg['text'] = $msg;
        $backMsg['parse_mode'] = 'Markdown';
        telegramFunction($method,$backMsg);
        SsNodeTcpIcmp::query()->where('t_id',$v['t_id'])->update(['tg',1]);//失败的，通知过一次，就不通知了
      }
      SsNodeTcpIcmp::query()->where('t_tcp_status',1)->where('tg',1)->update(['tg',0]);//由异常变为正常，重置通知状态
      Log::info('定时任务：' . $this->description);
    }
}

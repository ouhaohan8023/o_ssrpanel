<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Models\Config;
use App\Http\Models\UserSubscribe;
use App\Http\Models\UserSubscribeLog;
use Log;

class AutoMysqlBackUpJob extends Command
{
    protected $signature = 'autoMysqlBackUpJob';
    protected $description = '数据库远程备份';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
      $file_name=exec(cat /home/www/nowJob);
      $ip_addr='154.85.192.90';
      $path='/home/www/chuanYunTiBackUp';
      $ex = exec('scp ~/'.$file_name.' root@'.$ip_addr.':'.$path.'');

      Log::info('定时任务：' . $this->description.'exec:'.$ex);
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Models\Config;
use App\Http\Models\UserSubscribe;
use App\Http\Models\UserSubscribeLog;
use Log;

class AutoMysqlBackUpRemoteJob extends Command
{
    protected $signature = 'autoMysqlBackUpRemoteJob';
    protected $description = '数据库远程备份';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

      $file_name=exec('cat '.\config('local_path').'nowJob');
      $root=\config('remote_root');
      $ip_addr=\config('remote_ip');
      $path=\config('remote_path');
      $localPath=\config('local_path');
      exec('scp '.$localPath.$file_name.' '.$root.'@'.$ip_addr.':'.$path.'');

      Log::info('定时任务：' . $this->description);
    }
}

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
    protected $description = '数据库本地备份';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
      $filename = date("YmdHis").'_'.rand(0,10000).'.sql';
      exec('echo '.$filename.' > '.\config('app.local_path').'nowJob');
      exec('mysqldump -uroot -proot shadow3 >'.\config('app.local_path').$filename);
      Log::info('定时任务：' . $this->description.'文件名：'.$filename);
    }
}

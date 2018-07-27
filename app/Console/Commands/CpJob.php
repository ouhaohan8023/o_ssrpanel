<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Models\Invite;
use Log;

class CpJob extends Command
{
    protected $signature = 'cPJob';
    protected $description = '同步接口与项目的有赞二维码';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
      $data = date('Ymd');
      $path = '/assets/images/qrcode/' . $data . '/';
      if (!file_exists(public_path($path))) { //检查是否有该文件夹，如果没有就创建，并给予最高权限
        mkdir(public_path($path), 0700, true);
      }
        exec('cp -rf /home/wwwroot/api.chuanyunti.com/public/assets/images/qrcode/'.$data.'/*  /home/wwwroot/hjcqns.chuanyunti.com/public/assets/images/qrcode/'.$data.'/');
        Log::info('定时任务：' . $this->description);
    }
}

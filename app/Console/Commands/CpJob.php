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
        exec('cp -a /home/wwwroot/api.chuanyunti.com/public/assets/images/qrcode /home/wwwroot/hjcqns.chuanyunti.com/public/assets/images/qrcode');
        Log::info('定时任务：' . $this->description);
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Models\Invite;
use Log;

class DeleteAuthJob extends Command
{
    protected $signature = 'deleteAuthJob';
    protected $description = '清除过期的token';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
      $time = date("Y-m-d H:i:s",time()-15*86400);
      \DB::table("oauth_access_tokens")->where('created_at','<=',$time)->delete();
      Log::info('定时任务：'.$this->description);
    }
}

<?php

namespace App\Console\Commands;

use App\Http\Models\YwLog;
use App\Http\Models\YwStatus;
use Illuminate\Console\Command;
use App\Http\Models\SsNode;
use App\Http\Models\SsNodeTrafficHourly;
use App\Http\Models\UserTrafficLog;
use Log;

class AutoStatisticsNodeHourlyTestJob extends Command
{
    protected $signature = 'autoStatisticsNodeHourlyTestJob';
    protected $description = '自动统计节点每小时状态';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $nodeList = SsNode::query()->where('status', 1)->orderBy('id', 'asc')->get();
        foreach ($nodeList as $node) {
            $this->statisticsByNode($node->id);
        }

        Log::info('定时任务：' . $this->description);
    }

    private function statisticsByNode($out,$in)
    {
      $find = YwLog::query()->where([['l_n_id','=',$in],['l_sn_id','=',$out]])->orderBy('l_time','DESC')->first()->toArray();
      $findInStatus = YwStatus::query()->where([['l_n_id','=',$in],['l_sn_id','=',$out]])->orderBy('l_time','DESC')->first();
      if($findInStatus) {
        YwStatus::query()->where([['l_n_id','=',$in],['l_sn_id','=',$out]])->update(['l_status'=>$find['l_status']]);
      }else{
        YwStatus::query()->save($find);
      }

    }

}

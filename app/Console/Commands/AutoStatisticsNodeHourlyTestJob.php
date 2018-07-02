<?php

namespace App\Console\Commands;

use App\Http\Models\YwLog;
use App\Http\Models\YwNode;
use App\Http\Models\YwStatus;
use Illuminate\Console\Command;
use App\Http\Models\SsNode;
use App\Http\Models\SsNodeTrafficHourly;
use App\Http\Models\UserTrafficLog;
use Log;

class AutoStatisticsNodeHourlyTestJob extends Command
{
    protected $signature = 'autoStatisticsNodeHourlyTestJob';
    protected $description = '自动统计节点每小时状态(国内节点pingSSR节点)';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
      $InList = YwNode::query()->get()->toArray();
      $OutList = SsNode::query()->get()->toArray();
      foreach ($InList as $k => $v) {
        foreach ($OutList as $z => $b) {
          $this->statisticsByNode($v['n_id'],$b['id']);
        }
      }
      YwLog::query()->forceDelete();
      Log::info('定时任务：' . $this->description);
    }

  /**
   * @param $in // 国内节点
   * @param $out  // SSR节点
   */
    private function statisticsByNode($in,$out)
    {
//      $in = 1 ;
//      $out = 1;
      $find = YwLog::query()->where([['l_n_id','=',$in],['l_sn_id','=',$out]])->orderBy('l_time','DESC')->first();
      if($find){
        $find = $find->toArray();
        $exist = YwStatus::query()->where([['l_n_id','=',$in],['l_sn_id','=',$out]])->exists();
        if($exist){
          YwStatus::query()->where([['l_n_id','=',$in],['l_sn_id','=',$out]])->update(['l_status'=>$find['l_status'],'l_time'=>date('Y-m-d H:i:s')]);
        }else{
          YwStatus::query()->insert($find);
        }
      }
    }

}

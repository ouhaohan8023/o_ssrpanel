<?php

namespace App\Console\Commands;

use App\Http\Models\SsNodeTrafficDaily;
use Illuminate\Console\Command;

class AutoCountNodeFlow extends Command
{
    protected $signature = 'autoCountNodeFlow';
    protected $description = '计算上一天的流量消耗并插入数据库';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
      $s = '-1 days';
      $data = date('Y-m-d', strtotime($s));
      $flowCount = SsNodeTrafficDaily::query()->where('created_at', '>=', $data)->sum('total');
      $add['flow'] = $flowCount;
      $add['created_at'] = $data;
      $add['flow_read'] = flowAutoShow($flowCount);
//        $sql = "INSERT ss_node_flow_log('s_flow,s_flow_read,created_at') VALUE (".$add['flow']." ".$add['flow_read']." ".$add['created_at'].")";
      \DB::insert("insert into ss_node_flow_log (s_flow,s_flow_read,created_at) values (?,?,?)",[$add['flow'] ,$add['flow_read'],$add['created_at']]);
      \Log::info('定时任务：' . $this->description);
    }
}

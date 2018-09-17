<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 节点流量统计
 * Class SsUserTrafficDaily
 *
 * @package App\Http\Models
 */
class SsNodeFlowLog extends Model
{
    protected $table = 'ss_node_flow_log';
    protected $primaryKey = 's_id';

}
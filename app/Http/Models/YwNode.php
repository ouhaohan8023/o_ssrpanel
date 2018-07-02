<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 国内机器，用于测试国内节点联通ss节点的状态
 * Class SsNode
 *
 * @package App\Http\Models
 */
class YwNode extends Model
{
    protected $table = 'yw_node';
    protected $primaryKey = 'n_id';
}
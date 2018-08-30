<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * SS节点信息
 * Class SsNode
 *
 * @package App\Http\Models
 */
class SsNodeTcpIcmp extends Model
{
    protected $table = 'ss_node_tcp_icmp';
    protected $primaryKey = 't_id';

  function SS()
  {
    return $this->hasOne(SsNode::class, 'id', 't_s_id');
  }

//  function getUpdateAtAttritube($v){
////    return date("y-m-d H:i:s",$v);
//  }

  function getEndAtAttritube($v){
    return date("y-m-d H:i:s",$v);
  }
}
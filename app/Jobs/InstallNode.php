<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InstallNode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $data_ip;
    private $data_port;
    private $data_root;
    private $data_pwd;
  private $data_data;
  private $node_id;
  private $node_trans;
  private $node_ip;
  private $node_root;
  private $node_pwd;
  private $node_port;
  private $path;

  /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data_ip,$data_port,$data_root,$data_pwd,$data_data,$node_id,$node_trans,$node_ip,$node_root,$node_pwd,$node_port,$path)
    {
      $this->data_ip = $data_ip;
      $this->data_port = $data_port;
      $this->data_root = $data_root;
      $this->data_pwd = $data_pwd;
      $this->data_data = $data_data;
      $this->node_id = $node_id;
      $this->node_trans = $node_trans;
      $this->node_ip = $node_ip;
      $this->data_ip = $data_ip;
      $this->node_root = $node_root;
      $this->node_pwd = $node_pwd;
      $this->node_port = $node_port;
      $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
      $command = 'sh '.$this->path.'/run_ssr_auto_install.sh '.$this->data_ip.' '.$this->data_port.' '.$this->data_root.' '.$this->data_pwd.' '.$this->data_data.' '.$this->node_id.' '.$this->node_trans.' '.$this->node_ip.' '.$this->node_port.' '.$this->node_root.' \''.$this->node_pwd.'\' '.$this->path;
//    var_dump($command);
      $ret = shell_exec($command);
      Log::info('安装新节点：'.$ret);
    }
}

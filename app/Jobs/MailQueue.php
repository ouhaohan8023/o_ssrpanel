<?php

namespace App\Jobs;

use App\Http\Models\Config;
use App\Mail\activeUser;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class MailQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $url;
    private $config;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user,$url)
    {
        //
      $this->config = $this->systemConfig();
      $this->user = $user;
      $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
//      $web_name =
      \Mail::to($this->user)->send(new activeUser( $this->config['website_name'], $this->url));
      Log::info('邮件发送');
    }

    // 系统配置
    public function systemConfig()
    {
      $config = Config::query()->get();
      $data = [];
      foreach ($config as $vo) {
        $data[$vo->name] = $vo->value;
      }

      return $data;
    }
}

<?php

namespace App\Jobs;

use App\Http\Models\AppPush;
use App\Http\Models\Config;
use App\Mail\activeUser;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class PushApp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
      $this->data = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//      foreach ($this->data as $v){
        $user = $this->data['user'];
        $content = $this->data['content'];
        $response = $this->sendMessageFilter($content,$user);

//        $datas = json_decode($response, true);
//        $data['p_o_id'] = $datas['id'];
//        $data['p_nums'] = $datas['recipients'];
//        $data['p_back'] = $response;
//        $data['p_content'] = json_encode($this->data);
//        AppPush::query()->create($data);
      Log::info(\GuzzleHttp\json_encode($this->data));

      Log::info($response);
        Log::info('推播成功：'.$user['value']);
//      }
    }

  /**
   * Send based on filters/tags
   */
  protected function sendMessageFilter($ct,$u)
  {
    $content = array(
        "en" => $ct
    );

    $fields = array(
        'app_id' => env('ONESIGNAL_KEY'),
        'filters' => $u,
        'data' => array("foo" => "bar"),
        'contents' => $content
    );

    $fields = json_encode($fields);
//    print("\nJSON sent:\n");
//    print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        'Authorization: Basic '.env('ONESIGNAL_API')));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
  }
}

<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use App\Traits\ResponseTrait;


class PublishTopicSubscriber
{
     
     /**
     * Response Trait.
     *
     * @return void
     */
    use ResponseTrait;


    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        $data = $event->publish;
       
        $apiurl = env('PUBLISH_REMOTE_URL');

         //GuzzleHttp\Client


        try{

         $URI  = $apiurl . "subscribers";
         
         $request = Http::post($URI , [
                                  'topic' => $data["topic"],
                                  'data'  => $data["data"]
                                  ]           
                      );

         $response = $request->json();

         return $response;

        }catch(Exception $e){
            return $this->Exception($e);
        }
                          
    }
}

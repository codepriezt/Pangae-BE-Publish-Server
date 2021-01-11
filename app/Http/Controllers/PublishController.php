<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Publish\CreateRequest;
use App\Services\PublishService;

class PublishController extends Controller
{

    /**
     * protected class property
     * @var   App\Services\PublicService 
     */
     protected $PublishService;



     /**
      * Create an class instance 
      * @var   App\Services\PublicService 
     */
     public  function __construct(PublishService $PublishService){
     	$this->PublishService = $PublishService;
     }

     
     /**
     * trigger a publish to messages 
     * @var   App\Services\SubscriptionService 
     */
     public function publish(CreateRequest $request){
     	$topic = $request->input("topic");
     	$data = $request->validated();
     	return $this->PublishService->publish($data , $topic);
     }

}

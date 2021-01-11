<?php
namespace App\Services;

use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Events\PublishTopic;
use App\Repositories\MessageRepository;
use GuzzleHttp\Client;




class PublishService{

    /**
     * Using the ResponseTrait
     * 
     * @var  \App\Traits\ResponseTrait
     */
    use ResponseTrait;
    
    
   
    /**
     * constant variables for this instance
     * @return void
     */
     const topic_does_not_exist = "Subscription Created Successfully";



   
    /**
     * Creating instance of a class
     * @param  App\Reposiotory\MessageRepository
     * @return void
     */

     public function __construct(MessageRepository $MessageRepository){
     	$this->MessageRepository = $MessageRepository;
     }
     



     /**
      * publish a message to a topic
      * @param array $data
      * @param string $topic
      * @return void
      */
     public function publish(array $data , string $topicTitle){

     	$topic = DB::table('topics as t')->where(['name' => $topicTitle])->first();

     	
     	if(is_null($topic)){
     		return $this->error(self::topic_does_not_exist , $this->$code422);
     	}

     	$createDetails = ["topic_id" => $topic->id , 'body' => $data["message"]];

     	DB::beginTransaction();

     	try{
     		$create = $this->MessageRepository->create($createDetails);

     	  }catch(Exception $e){
     	  	DB::rollback();

     	  	return $this->Exception($e);
     	 }

     	 DB::commit();

     	 

     	 $data = ['topic'=> $topicTitle , 'data' => ["id" => $create->id , "message"=> $create->body]];


     	$publish = event(new PublishTopic($publish = $data));

     	return $publish;

     }


}


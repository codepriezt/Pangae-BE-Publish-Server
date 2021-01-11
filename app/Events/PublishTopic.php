<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PublishTopic
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * Create Class Poperty.
     *
     * @return void
    */
    public $publish;
    

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($publish)
    {
        $this->publish = $publish;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

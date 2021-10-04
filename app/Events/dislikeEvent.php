<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class dislikeEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $dislike;
    public  $posd ;
    public $pd;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($dislike,$posd,$pd)
    {
        $this->dislike=$dislike;
        $this->posd=$posd;
        $this->pd=$pd;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
       
      return new Channel('dislikeEvent');
    }
    public function broadcastAs()
        { 
            return 'dislikeEvent';
        }
}

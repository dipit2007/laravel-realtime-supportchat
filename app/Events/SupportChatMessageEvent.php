<?php

namespace App\Events;

use App\SupportChatMessage;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SupportChatMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Message
     *
     * @var Message
     */
    public $message;
    public $to_user_id;
    public $created_at;
    public $fromuser;
    public $touser;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(SupportChatMessage $message)
    {
        $this->message = $message->message;
        $this->to_user_id = $message->to_user_id;
        $this->created_at = $message->created_at;
        $this->fromuser = $message->fromuser;
        $this->touser = $message->touser;        
        //$this->message->touser = $message->touser;
        //$this->message->fromuser = $message->fromuser;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('support.' . $this->to_user_id);
    }
}

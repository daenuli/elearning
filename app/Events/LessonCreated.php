<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LessonCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * @var string
     */
    public $message;
    
    /**
     * @var string
     */
    public $avatar;
    
    /**
     * @var string
     */
    public $user_name;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $user = Auth::user();

        $this->message = $message;
        $this->avatar = $user->getAvatar();
        $this->user_name = $user->name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('lesson-created-notification');
    }
}

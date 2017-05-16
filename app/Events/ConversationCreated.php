<?php

namespace App\Events;

use App\Models\Conversation;
use App\Transformers\ConversationTransformer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ConversationCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;
	
    
    public $conversation;
	/**
	 * Create a new event instance.
	 *
	 * @param Conversation $conversation
	 */
    public function __construct(Conversation $conversation)
    {
        $this->conversation = $conversation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
	    $channels = [];
	
	    $this->conversation->usersExceptCurrentlyAuthenticated->each( function($user) use (&$channels) {
		    $channels[] = new PrivateChannel('user'. $user->id);
	    });
	
	    return $channels;
    }
    
    public function broadcastWith()
    {
    	return fractal()
		    ->item($this->conversation)
		    ->parseIncludes(['user', 'users'])
		    ->transformWith(new ConversationTransformer())
		    ->toArray();
    }
    
}

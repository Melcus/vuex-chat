<?php

namespace App\Policies;

use App\Models\Conversation;
use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Conversation $conversation)
    {
    	return $this->affect($user, $conversation);
    }
    
    public function affect(User $user, Conversation $conversation)
    {
    	return $user->isInConversation($conversation);
    }
}

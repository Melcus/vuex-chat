<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/


use App\Models\Conversation;

Broadcast::channel('user{id}*', function ($user, $id) {
	return (int) $user->id === (int) $id;
});

Broadcast::channel('conversation{id}*' , function ($user , $conversationId) {
	return $user->isInConversation(Conversation::find($conversationId));
});
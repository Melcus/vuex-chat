<?php

namespace App\Http\Controllers\Api;

use App\Events\UserAddedToConversation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConversationUserRequest;
use App\Models\Conversation;
use App\Transformers\ConversationTransformer;
use Illuminate\Http\Request;

class ConversationUserController extends Controller
{
	public function store(StoreConversationUserRequest $request , Conversation $conversation)
	{
		$this->authorize('affect' , $conversation);
		
		$conversation->users()->syncWithoutDetaching($request->recipients);
		
		$conversation->load(['users']);
		
		broadcast(new UserAddedToConversation($conversation))->toOthers();
		
		
		return fractal()
			->item($conversation)
			->parseIncludes(['user' , 'users'])
			->transformWith(new ConversationTransformer())
			->toArray();
		
		
		
		
	}
}

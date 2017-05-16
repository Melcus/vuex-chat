<?php

namespace App\Providers;

use App\Models\Conversation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    
        Broadcast::routes();
	
	
	    
	   
	    
//	    Broadcast::channel('user.{id}', function ($user, $userId) {
//		    return (int) $user->id === (int) $userId;
//	    });
	 

	    
        require base_path('routes/channels.php');
    }
}

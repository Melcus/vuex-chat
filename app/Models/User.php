<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
	use Notifiable, Searchable;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name' , 'email' , 'password' ,
	];
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password' , 'remember_token' ,
	];
	
	
	public function conversations()
	{
		return $this->belongsToMany(Conversation::class)->whereNull('parent_id')->orderby('last_reply' , 'desc');
	}
	
	public function isInConversation(Conversation $conversation)
	{
		return $this->conversations->contains($conversation);
	}
	
	public function avatar($size = 45)
	{
		return 'https://www.gravatar.com/avatar/' . md5($this->email) . 'x?s=' . $size . '&d=mm';
	}
	
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
	protected $dates = ['last_reply'];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function users()
	{
		return $this->belongsToMany(User::class);
	}
	
	public function usersExceptCurrentlyAuthenticated()
	{
		return $this->users()->where('user_id' , '!=' , \Auth::user()->id);
	}
	
	public function replies()
	{
		return $this->hasMany(Conversation::class , 'parent_id')->latestFirst(); //latest first
	}
	
	public function parent()
	{
		return $this->belongsTo(Conversation::class , 'parent_id');
	}
	
	public function touchLastReply()
	{
		$this->last_reply = \Carbon\Carbon::now();
		$this->save();
	}
	
	public function isReply()
	{
		return $this->parent_id !== NULL;
	}
	
	
	public function scopeLatestFirst($query)
	{
		return $query->orderBy('created_at' , 'desc');
	}
	
	
}

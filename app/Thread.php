<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
	protected $guarded = [];

	// helpers
	public function path() 
    {
    	return '/threads/' . $this->id;
    }

    // Relationships
	public function creator()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
	
	public function replies() 
	{
		return $this->hasMany(Reply::class);
	}

	// Scopes and functions
	public function addReply($reply)
	{
		$this->replies()->create($reply);
	}
}

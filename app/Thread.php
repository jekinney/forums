<?php

namespace App;

use App\Traits\RecordsActivity;
use App\Filters\ThreadFilters;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
	use RecordsActivity;
	
	protected $guarded = [];

	protected $with = ['creator'];

	protected static function boot()
	{
		parent::boot();

		static::addGlobalScope('replyCount', function($builder) {
			$builder->withCount('replies');
		});

		static::deleting(function($thread) {
			$thread->replies->each(function($reply) {
           		$reply->delete();
        	});
		});
	}

	// helpers
	public function path() 
    {
    	return "/threads/{$this->channel->slug}/{$this->id}";
    }

    // Relationships
    public function channel() 
    {
    	return $this->belongsTo(Channel::class);
    }
    
	public function creator()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
	
	public function replies() 
	{
		return $this->hasMany(Reply::class)->withCount('favorites');
	}

	// Scopes and functions
	public function addReply($reply)
	{
		$this->replies()->create($reply);
	}

	public function scopeFilter($query, ThreadFilters $filters)
	{
		return $filters->apply($query);
	}
}

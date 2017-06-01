<?php

namespace App\Traits;

use App\Activity;

trait RecordsActivity 
{
	protected static function bootRecordsActivity()
	{
		if(auth()->guest()) return;
		
		static::created(function($model) {
			$model->recordActivity('created');
		});

		static::deleted(function($model) {
			$model->recordActivity('deleted');
		});

		static::updated(function($model) {
			$model->recordActivity('updated');
		});
	}

	public function activity() 
	{
		return $this->morphMany(Activity::class, 'subject');
	}

	protected function recordActivity($event)
	{
		$this->activity()->create([
			'user_id' => auth()->id(),
			'type' => $this->getActivityType($event),
		]);
	}

	protected function getActivityType($event)
	{
		$type = strtolower((new \ReflectionClass($this))->getShortName());

		return "{$event}_{$type}";
	}
}
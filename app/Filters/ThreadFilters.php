<?php

namespace App\Filters;

use App\User;

class ThreadFilters extends Filters
{

	protected $filters = ['by', 'popular'];
	
	/**
	 * Filter threads by user
	 *
	 * @param string $username
	 * @return Builder
	 */
	protected function by($username)
	{
		$user = User::where('name', $username)->firstOrFail();

		return $this->builder->where('user_id', $user->id);
	}

	/**
	 * Filter query by repliy count/popular
	 *
	 * @return Builder
	 */
	protected function popular()
	{
		$this->builder->getQuery()->orders = [];
		return $this->builder->orderBy('replies_count', 'desc');
	}
}
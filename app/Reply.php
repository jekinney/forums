<?php

namespace App;

use App\Traits\Favoritable;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable, RecordsActivity;
     /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
	protected $guarded = [];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['owner', 'favorites'];

	// Relationships
    /**
     * A reply has an owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * A reply has an thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
    	return $this->belongsTo(Thread::class);
    }

    /**
     * A reply can have favorites.
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function favorites()
    {
        return $this->morphMany(favorite::class, 'favoritable');
    }

    // Helpers and Queries
}

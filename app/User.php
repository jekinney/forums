<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // relationships
    public function threads()
    {
        return $this->hasMany(Thread::class)->latest();
    }

    public function replies() 
    {
        return $this->hasMany(Reply::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }
}

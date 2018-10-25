<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFirstNameAttribute()
    {
        $array = explode(' ',trim($this->name));
        return $array[0];
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'creator_id');
    }

    public function getPastEventsAttribute()
    {
        return $this->events()->whereDate('ends_at', '<=', now()->toDateTimeString())->get();
    }

    public function getCurrentEventsAttribute()
    {
        return $this->events()
                    ->whereDate('starts_at', '<=', now()->toDateTimeString())
                    ->whereDate('ends_at', '>=', now()->toDateTimeString())
                    ->get();
    }

    public function getUpcomingEventsAttribute()
    {
        return $this->events()->whereDate('starts_at', '>', now()->toDateTimeString())->get();
    }
}

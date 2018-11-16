<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\HasBonus;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasBonus;

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

    public function bonuses()
    {
        return $this->hasMany(Bonus::class)->valid($this->membership);
    }

    public function membership()
    {
        return $this->hasOne(Membership::class);
    }

    public function subscribe(Plan $plan)
    {
        $starts_at = office()->nextBusinessDay();

        $this->membership()->create([
            'plan_id' => $plan->id,
            'next_payment_at' => $plan->renewsAt($starts_at),
            'created_at' => $starts_at
        ])->start();
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

    public function getEventsArrayAttribute()
    {
        return $this->events->map(function ($item, $key) {
            return $item->only(['id', 'title', 'start', 'end', 'plan_id']);
        });
    }
}

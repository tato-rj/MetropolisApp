<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Requests\CreateEventForm;
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
        return $this->hasMany(Bonus::class);//->valid($this->membership);
    }

    public function membership()
    {
        return $this->hasOne(Membership::class);
    }

    public function subscribe(Plan $plan, $reference)
    {
        $this->membership()->create([
            'plan_id' => $plan->id,
            'next_payment_at' => $plan->renewsAt(),
            'reference' => $reference,
        ])->start();
    }

    public function schedule(CreateEventForm $form, $reference = null)
    {
        $event = $this->events()->create([
            'reference' => $reference ?? null,
            'space_id' => $form->space_id,
            'fee' => $form->space->priceFor($form->participants, $form->duration, $form->user->bonusesLeft($form->space)),
            'participants' => $form->participants,
            'emails' => serialize($form->emails),
            'starts_at' => $form->starts_at,
            'ends_at' => $form->ends_at,
            'verified_at' => $reference ? null : now(),
            'status_id' => $reference ? 0 : 3
        ]);

        $form->user->useBonus($event, $form->duration);

        return $event;
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

    public function getCurrentEventCountdownAttribute()
    {
        $mostCurrentEvent = $this->currentEvents->first();

        if (! $mostCurrentEvent || now()->isWeekend())
            return null;

        if ($mostCurrentEvent->ends_at->isSameDay(now()))
            return ['name' => $mostCurrentEvent->space->name, 'end' => $mostCurrentEvent->ends_at->toDateTimeString()];

        return ['name' => $mostCurrentEvent->space->name, 'end' => now()->setTime(office()->day_ends_at,0,0)->toDateTimeString()];
    }

    public function getUpcomingEventsAttribute()
    {
        return $this->events()->whereDate('starts_at', '>', now()->toDateTimeString())->get();
    }

    public function getEventsArrayAttribute()
    {
        return $this->events()->whereNotIn('status_id', [6,7])->get()->map(function ($item, $key) {
            return $item->only(['id', 'title', 'start', 'end', 'plan_id', 'notified_at', 'statusForUser']);
        });
    }
}

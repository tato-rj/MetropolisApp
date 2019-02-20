<?php

namespace App;

use App\Contracts\Person;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Requests\SpaceSearchForm;
use App\Notifications\MailResetPasswordNotification;
use App\Traits\{HasBonus, HasCreditCard};

class User extends Authenticatable implements MustVerifyEmail, Person
{
    use Notifiable, HasBonus, HasCreditCard;

    protected $guarded = [];
    protected $dates = ['email_verified_at'];
    protected $hidden = ['password', 'remember_token'];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordNotification($token));
    }

    public function getFirstNameAttribute()
    {
        $array = explode(' ',trim($this->name));
        return $array[0];
    }

    public function isAdmin()
    {
        return false;
    }

    public function events()
    {
        return $this->morphMany(Event::class, 'creator');
    }

    public function workshops()
    {
        return $this->belongsToMany(Workshop::class, 'user_workshops')->withTimestamps();
    }

    public function upcomingWorkshops()
    {
        return $this->belongsToMany(Workshop::class, 'user_workshops')->upcoming()->withPivot('reference', 'transaction_code', 'verified_at', 'status_id');        
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->latest();
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }

    public function membership()
    {
        return $this->hasOne(Membership::class);
    }

    public function getHasPlanAttribute()
    {
        return $this->membership()->exists();
    }

    public function subscribe(Plan $plan, $reference)
    {
        $this->membership()->create([
            'plan_id' => $plan->id,
            'next_payment_at' => $plan->renewsAt(),
            'reference' => $reference,
        ])->start();
    }

    public function schedule(SpaceSearchForm $form, $reference = null)
    {
        $event = $this->events()->create([
            'reference' => $reference ?? null,
            'space_id' => $form->space->id,
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

    public function signup(Workshop $workshop, $reference = null)
    {
        $status = $reference ? 0 : 3;
        
        $this->workshops()->attach($workshop->id, 
            [
                'reference' => $reference,
                'status_id' => $status
            ]);

        return $this->workshops()->latest()->first()->reservation;
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

    public function eventsArray($editable = true)
    {
        $fields = ['id', 'title', 'start', 'end', 'plan_id', 'notified_at', 'statusForUser'];

        if ($editable)
            array_push($fields, 'editable');

        return $this->events()->whereNotIn('status_id', [6,7])->get()->map(function ($item, $key) use ($fields) {
            return $item->only($fields);
        });
    }
}

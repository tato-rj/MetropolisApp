<?php

namespace App;

use App\Contracts\Person;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\Admin\ResetPasswordNotification;

class Admin extends Authenticatable implements Person
{
    use Notifiable;

    protected $guard = 'admin';
    protected $guarded = [];
    protected $hidden = ['password', 'remember_token'];

    public function events()
    {
        return $this->morphMany(Event::class, 'creator');
    }

    public function isAdmin()
    {
        return true;
    }
    
    public function isManager()
    {
    	return $this->role == 'manager';
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function scopeByEmail($query, $email)
    {
        return $query->where('email', $email)->first();
    }
}

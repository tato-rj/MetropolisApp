<?php

namespace App;

class Membership extends Metropolis
{
    public function plan()
    {
    	return $this->belongsTo(Plan::class);
    }

    public function user()
    {
    	return $this->hasOne(User::class);
    }
}

<?php

namespace App;

class Plan extends Metropolis
{
    public function memberships()
    {
    	return $this->hasMany(Membership::class);
    }
}

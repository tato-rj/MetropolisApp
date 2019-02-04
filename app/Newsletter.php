<?php

namespace App;

class Newsletter extends Metropolis
{
    public function scopeStoreOrFail($query, $email)
    {
    	if ($query->where('email', $email)->exists())
    		return null;

    	return $this->create(['email' => $email]);
    }
}
